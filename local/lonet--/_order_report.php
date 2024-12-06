<?php
use local_lonet\order_transaction;

defined('MOODLE_INTERNAL') || die();

global $CFG;
global $DB;

foreach (['date_from', 'date_to', 'payment_type', 'reference', 'student_id', 'completed', 'notcompleted', 'promo_code'] as $attribute) {
	${$attribute} = (isset(${$attribute}) ? ${$attribute} : null);
}

if (!$completed && !$notcompleted) {
    $completed = 1;
}

$userTimezone = core_date::get_user_timezone_object();
$current_date = new DateTime('now', $userTimezone);
$date_to = $date_to ?: $current_date->format('Y-m-d');
$date_from = $date_from ?: $current_date->modify('-30 days')->format('Y-m-d');
$timestamp_from = (new DateTime($date_from . ' 00:00:00', $userTimezone))->getTimestamp();
$timestamp_to = (new DateTime($date_to . ' 23:59:59', $userTimezone))->getTimestamp();

$from = '
    FROM {lonet_order} o
    LEFT JOIN {lonet_order_transaction} ot ON ot.orderid = o.id AND ot.iscompleted = 1
';
$where = 'WHERE transactiondate >= ' . $timestamp_from . '
    ' . 'AND transactiondate <= ' . $timestamp_to . '
    ' . ($completed && $notcompleted ? '' : ($completed ? 'AND iscompleted = 1' : 'AND iscompleted = 0'))
;

$inner_sql = 'SELECT
        o.id,
        o.studentid `studentid`,
        ot.reference `reference`,
        COALESCE(ot.iscompleted, 0) `iscompleted`,
        COALESCE(ot.createdat, o.createdat) `transactiondate`,
        ot.method `transactiontype`,
        pc.code `promocode`,
        pc.id `promocodeid`,
        ot.amount `amount`,
        ot.used_balance_amount `used_balance_amount`,
        ot.description `description`,
        LEFT(ot.transactionid, 15) `transactionid`
    ' . $from . '
    LEFT JOIN {lonet_promo_code} pc ON pc.id = o.promocodeid
';
$order_report = $DB->get_records_sql('
    SELECT *
    FROM (' . $inner_sql . ') t
    ' . $where . '
        ' . ($reference ? 'AND reference = \'' . $reference .'\'' : '') . '
        ' . ($payment_type ? 'AND transactiontype = \'' . $payment_type .'\'' : '') . '
        ' . ($student_id ? 'AND studentid = ' . $student_id : '') . '
        ' . ($promo_code ? 'AND promocodeid = \'' . $promo_code . '\'' : '') . '
    ORDER BY transactiondate ASC
');

$reference_options = $DB->get_records_sql('
	SELECT DISTINCT reference
    FROM (' . $inner_sql . ') t
	' . $where . '
	ORDER BY reference ASC
');
$student_options = $DB->get_records_sql('
    SELECT DISTINCT
        studentid,
		CONCAT(u.firstname, \' \', u.lastname) `fullname`
    FROM (' . $inner_sql . ') t
    LEFT JOIN {user} u ON u.id = t.studentid
	' . $where . '
	ORDER BY email ASC
');
$new_student_options = $DB->get_records_sql('
    SELECT DISTINCT
        u.id,
		CONCAT(u.firstname, \' \', u.lastname) `fullname`
    FROM {user} u
    WHERE u.deleted = 0
	ORDER BY CONCAT(u.firstname, \' \', u.lastname) ASC
');
$promo_code_options = $DB->get_records_sql('
	SELECT
		pc.id,
        pc.code
	FROM {lonet_promo_code} pc
	ORDER BY pc.code ASC
');
?>

<style>
	.tooltiptext {
		max-width: 150px;
	}
</style>

<script>
	$(document).on('click', '.btn-save', function(e) {
		var row = $(this).parents('tr');
		var id = row.attr('data-key');
		var data = 'action=add&' + row.find('input, select, textarea').serialize() + '&Order[id]=' + id;
		$.ajax({
			type: 'POST',
			url: '/local/lonet/admin.php',
			dataType: 'json',
			data: data,
			success: function(result) {
				if (result.success) {
					window.location.reload();
				} else {
					swal('Error Occured', result.error, 'error');
				}
			},
			error: function(xhr, ajaxOptions, thrownError){
				swal('Server Error Occured', xhr.responseText, 'error');
			}
		});
	});
    
	$(document).ready(function() {
        function submitForm(e) {
            window.location.href = '<?= $CFG->wwwroot ?>/local/lonet/admin.php?report=order&' + $('.thead input, .thead select').serialize();
        }
		$('thead input, thead select').change(submitForm);
		$('.btn-select-period').click(submitForm);
        $('[data-toggle="tooltip"]').tooltip();
	});
</script>

<div class="thead text-right" style="padding-bottom:10px;">
    <span class="pull-left" style="font-size: 0.9em; padding-top: 10px;">Total <?= count($order_report) ?> items.</span>
	<div class="text-right">
        Period from&nbsp;<input type="date" name="date_from" value="<?= $date_from ?>">
        to&nbsp;<input type="date" name="date_to" value="<?= $date_to ?>">
        &nbsp;<button class="btn btn-success btn-select-period"><span class="fa fa-check"></span></button>
    </div>
</div>
<table class="table table-striped table-bordered">
	<thead class="thead">
		<tr>
			<th>#</th>
			<th><?= get_string('reference', 'local_lonet') ?></th>
			<th><?= get_string('learner', 'local_lonet') ?></th>
			<th>Amount</th>
			<th><?= get_string('promocode', 'local_lonet') ?></th>
			<th>Transaction Type</th>
			<th>Processing Transaction ID</th>
			<th>Transaction Date</th>
			<th>Is Completed</th>
		</tr>
		<tr>
			<th><button class="btn btn-success btn-add"><span class="fa fa-plus"></span></button></th>
			<th>
				<select name="reference">
					<option></option>
					<?php foreach ($reference_options as $reference_option) { ?>
						<option value="<?= $reference_option->reference ?>" <?= ($reference_option->reference == $reference ? 'selected' : '') ?>><?= $reference_option->reference ?></option>
					<?php } ?>
				</select>
			</th>
			<th>
				<select name="student_id">
					<option></option>
					<?php foreach ($student_options as $student_option) { ?>
						<option value="<?= $student_option->studentid ?>" <?= ($student_option->studentid == $student_id ? 'selected' : '') ?>><?= $student_option->fullname ?></option>
					<?php } ?>
				</select>
			</th>
			<th></th>
			<th>
				<select name="promo_code">
					<option></option>
					<?php foreach ($promo_code_options as $promo_code_option) { ?>
						<option value="<?= $promo_code_option->id ?>" <?= ($promo_code_option->id == $promo_code ? 'selected' : '') ?>><?= $promo_code_option->code ?></option>
					<?php } ?>
				</select>
			</th>
			<th>
				<select name="payment_type">
					<option></option>
					<?php foreach (order_transaction::getPaymentMethods() as $payment_method) { ?>
						<option value="<?= $payment_method ?>" <?= ($payment_method == $payment_type ? 'selected' : '') ?>><?= $payment_method ?></option>
					<?php } ?>
				</select>
            </th>
			<th></th>
			<th></th>
			<th>
                <input type="checkbox" class="checkbox payout-confirmation-checkbox" id="completed" name="completed" <?= ($completed ? 'checked' : '') ?>>
				<label for="completed">Show completed orders</label>
                <br>
                <input type="checkbox" class="checkbox payout-confirmation-checkbox" id="notcompleted" name="notcompleted" <?= ($notcompleted ? 'checked' : '') ?>>
				<label for="notcompleted">Show not completed orders</label>
            </th>
		</tr>
	</thead>
	<tbody>
		<tr class="row-add editable" data-key=0 style="display: none;">
			<td></td>
			<td><input type="text" name="OrderTransaction[reference]" required></td>
			<td>
				<select name="Order[studentid]" required>
					<option></option>
					<?php foreach ($new_student_options as $new_student_option) { ?>
						<option value="<?= $new_student_option->id ?>"><?= $new_student_option->fullname ?></option>
					<?php } ?>
				</select>
			</td>
			<td><input type="number" name="OrderTransaction[amount]" required min=0></td>
			<td></td>
			<td>
				<select name="OrderTransaction[method]" required>
					<option></option>
					<?php foreach (order_transaction::getPaymentMethods() as $payment_method) { ?>
						<option value="<?= $payment_method ?>"><?= $payment_method ?></option>
					<?php } ?>
				</select>
            </td>
			<td></td>
			<td></td>
			<td>
				<button class="btn btn-success btn-save"><span class="fa fa-check"></span></button>
				<button class="btn btn-warning btn-cancel"><span class="fa fa-times"></span></button>
			</td>
		</tr>
		<?php
        $total_amount = 0;
		foreach ($order_report as $order) {
            $total_amount += $order->amount;
			$student = $DB->get_record('user', ['id' => $order->studentid]); ?>
			<tr>
				<td><?= $order->id ?></td>
				<td><?= $order->reference ?></td>
				<td><a href="/user/<?= $student->id ?>" target="_blank" rel="noopener noreferrer"><?= fullname($student, true) ?></a></td>
				<td><?= number_format($order->amount, 2) ?></td>
				<td><?= $order->promocode ?></td>
				<td>
                    <?= $order->transactiontype ?>
                    <?php if ($order->description) { ?>
                    <span class="fa fa-info-circle pull-right" data-toggle="tooltip" title="<?= $order->description ?>"></span>
                    <?php } ?>
                </td>
				<td><?= $order->transactionid ?></td>
				<td><?= (new DateTime('now', $userTimezone))->setTimestamp($order->transactiondate)->format('d.m.Y') ?></td>
				<td><?= get_string(($order->iscompleted ? 'yes' : 'no')) ?></td>
            </tr>
            <?php if ($order->used_balance_amount && $order->iscompleted) {
                $total_amount += $order->used_balance_amount;
                ?>
                <tr>
                    <td><?= $order->id ?></td>
                    <td><?= $order->reference ?></td>
                    <td><a href="/user/<?= $student->id ?>" target="_blank" rel="noopener noreferrer"><?= fullname($student, true) ?></a></td>
                    <td><?= number_format($order->used_balance_amount, 2) ?></td>
                    <td><?= $order->promocode ?></td>
                    <td>balance</td>
                    <td></td>
                    <td><?= (new DateTime('now', $userTimezone))->setTimestamp($order->transactiondate)->format('d.m.Y') ?></td>
                    <td><?= get_string(($order->iscompleted ? 'yes' : 'no')) ?></td>
                </tr>
            <?php } ?>
		<?php } ?>
	</tbody>
	<tfoot>
		<tr>
			<td colspan=3></td>
			<td><?= number_format($total_amount, 2) ?></td>
			<td colspan=5></td>
		</tr>
	</tfoot>
</table>
