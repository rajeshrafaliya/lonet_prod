<?php
use local_lonet\payout_request;

defined('MOODLE_INTERNAL') || die();

global $CFG;
global $DB;

foreach (['date_from', 'date_to', 'payment_date_from', 'payment_date_to', 'reference', 'teacher_id', 'paid', 'notpaid'] as $attribute) {
	${$attribute} = (isset(${$attribute}) ? ${$attribute} : null);
}

if (!$paid && !$notpaid) {
    $paid = 1;
    $notpaid = 1;
}

$userTimezone = core_date::get_user_timezone_object();
$current_date = new DateTime('now', $userTimezone);
$date_to = $date_to ?: (!$payment_date_to ? $current_date->format('Y-m-d') : null);
$date_from = $date_from ?: (!$payment_date_from ? $current_date->modify('-30 days')->format('Y-m-d') : null);
$timestamp_from = ($date_from ? (new DateTime($date_from . ' 00:00:00', $userTimezone))->getTimestamp() : null);
$timestamp_to = ($date_to ? (new DateTime($date_to . ' 23:59:59', $userTimezone))->getTimestamp() : null);
$timestamp_payment_from = ($payment_date_from ? (new DateTime($payment_date_from . ' 00:00:00', $userTimezone))->getTimestamp() : null);
$timestamp_payment_to = ($payment_date_to ? (new DateTime($payment_date_to . ' 23:59:59', $userTimezone))->getTimestamp() : null);

$from = 'FROM {lonet_payout_request} pr';
//Added by Nitesh
// $sixmonth = strtotime('-180 days');
$payout_report = $DB->get_records_sql('
	SELECT
		pr.id `id`,
		pr.teacherid `teacherid`,
		FORMAT(SUM(op.payoutamount), 2) `amount`,
		pr.withdrawaltype `withdrawaltype`,
		pr.createdat `createdat`,
		pr.paidat `paidat`
	' . $from . '
	LEFT JOIN {lonet_order_product} op ON op.payoutrequestid = pr.id
	LEFT JOIN {lonet_order} ord ON ord.id = op.orderid
	WHERE pr.isconfirmed = 1
        ' . ($paid && $notpaid ? '' : ($paid ? 'AND pr.paidat IS NOT NULL' : 'AND pr.paidat IS NULL')) . '
        ' . ($timestamp_from ? 'AND pr.createdat >= ' . $timestamp_from : '') . '
        ' . ($timestamp_to ? 'AND pr.createdat <= ' . $timestamp_to : '') . '
        ' . ($timestamp_payment_from ? 'AND pr.paidat >= ' . $timestamp_payment_from : '') . '
        ' . ($timestamp_payment_to ? 'AND pr.paidat <= ' . $timestamp_payment_to : '') . '
		' . ($teacher_id ? 'AND pr.teacherid = ' . $teacher_id : '') . '
	GROUP BY pr.id
    ORDER BY pr.createdat DESC
');
		// AND op.starttime > '. $sixmonth .'
// AND ord.createdat > '. $sixmonth .'
$teacher_options = $DB->get_records_sql('
	SELECT DISTINCT
		pr.teacherid `teacherid`,
		u.email `email`
	' . $from . '
	LEFT JOIN {user} u ON u.id = pr.teacherid
	ORDER BY u.email ASC
');

$withdrawal_options = payout_request::getWithdrawalOptions();
?>

<script>
	$(document).ready(function() {
        function submitForm(e) {
            window.location.href = '<?= $CFG->wwwroot ?>/local/lonet/admin.php?report=payout&' + $('.thead input, .thead select').serialize();
        }
		$('thead input, thead select').change(submitForm);
		$('.btn-select-period').click(submitForm);
	});
</script>

<div class="thead text-right" style="padding-bottom:10px;">
	<div class="text-right">
        Request period from&nbsp;<input type="date" name="date_from" value="<?= $date_from ?>">
        to&nbsp;<input type="date" name="date_to" value="<?= $date_to ?>">
        &nbsp;<button class="btn btn-success btn-select-period"><span class="fa fa-check"></span></button>
    </div>
	<div class="text-right">
        Confirmation period from&nbsp;<input type="date" name="payment_date_from" value="<?= $payment_date_from ?>">
        to&nbsp;<input type="date" name="payment_date_to" value="<?= $payment_date_to ?>">
        &nbsp;<button class="btn btn-success btn-select-period"><span class="fa fa-check"></span></button>
    </div>
</div>
<table class="table table-striped table-bordered">
	<thead class="thead">
		<tr>
			<th>ID</th>
			<th>Reference</th>
			<th><?= get_string('teacher', 'local_lonet') ?></th>
			<th>Amount</th>
			<th>Type</th>
			<th>Details</th>
			<th>Requested At</th>
			<th>Confirmed At</th>
			<th></th>
		</tr>
		<tr>
			<th></th>
			<th>
				<input type="text" name="reference" value="<?= $reference ?>">
            </th>
			<th>
				<select name="teacher_id">
					<option></option>
					<?php foreach ($teacher_options as $teacher_option) { ?>
						<option value="<?= $teacher_option->teacherid ?>" <?= ($teacher_option->teacherid == $teacher_id ? 'selected' : '') ?>><?= $teacher_option->email ?></option>
					<?php } ?>
				</select>
			</th>
			<th></th>
			<th></th>
			<th></th>
			<th></th>
			<th>
                <input type="checkbox" class="checkbox payout-confirmation-checkbox" id="paid" name="paid" <?= ($paid ? 'checked' : '') ?>>
				<label for="paid">Show confirmed requests</label>
                <br>
                <input type="checkbox" class="checkbox payout-confirmation-checkbox" id="notpaid" name="notpaid" <?= ($notpaid ? 'checked' : '') ?>>
				<label for="notpaid">Show not confirmed requests</label>
            </th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($payout_report as $payout) {
            $payout_reference = payout_request::get_reference($payout);
            if (!$reference || $reference && $payout_reference == $reference) {
                $teacher = $DB->get_record('user', ['id' => $payout->teacherid]); ?>
                <tr>
                    <td><?= $payout->id ?></td>
                    <td><?= $payout_reference ?></td>
                    <td><a href="/teacher/<?= $teacher->id ?>" target="_blank" rel="noopener noreferrer"><?= $teacher->email ?></a></td>
                    <td><?= $payout->amount ?></td>
                    <td><?= $withdrawal_options[$payout->withdrawaltype] ?></td>
                    <?php /* <td><?= payout_request::get_account_html($payout->id) ?></td> */ ?>
                    <td><a href="<?= $CFG->wwwroot ?>/local/lonet/payout_receipt.php?id=<?= $payout->id ?>" class="btn btn-info" target="_blank" rel="noopener noreferrer"><span class="fa fa-file-text"></span></a></td>
                    <td><?= (new DateTime('now', $userTimezone))->setTimestamp($payout->createdat)->format('d.m.Y') ?></td>
                    <td><?= ($payout->paidat ? (new DateTime('now', $userTimezone))->setTimestamp($payout->paidat)->format('d.m.Y') : '-') ?></td>
                    <td>
                        <?php if (!$payout->paidat) { ?>
                            <form method="post">
                                <input type="hidden" name="id" value="<?= $payout->id ?>">
                                <button type="submit" name="action" value="pay" class="btn btn-success" onClick="return confirm('Confirm payment of payout request #<?= $payout->id ?>?');"><span class="fa fa-check"></span></button>
                            </form>
                        <?php } ?>
                    </td>
                </tr>
            <?php }
        } ?>
	</tbody>
</table>
