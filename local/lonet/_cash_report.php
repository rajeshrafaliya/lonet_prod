<?php
use local_lonet\order_product;

defined('MOODLE_INTERNAL') || die();

global $CFG,$DB,$PAGE,$FULLME;

foreach (['completed_from','completed_to','date_from', 'date_to', 'payment_date_from', 'payment_date_to', 'reference', 'teacher_id', 'student_id', 'transaction_type', 'promo_code','lesson_status'] as $attribute) {
	${$attribute} = (isset(${$attribute}) ? ${$attribute} : null);
}

$userTimezone = core_date::get_user_timezone_object();
$current_date = new DateTime('now', $userTimezone);
$date_to = $date_to ?: (!$payment_date_to ? $current_date->format('Y-m-d') : null);
$date_from = $date_from ?: (!$payment_date_from ? $current_date->modify('-30 days')->format('Y-m-d') : null);
$timestamp_from = ($date_from ? (new DateTime($date_from . ' 00:00:00', $userTimezone))->getTimestamp() : null);
$timestamp_to = ($date_to ? (new DateTime($date_to . ' 23:59:59', $userTimezone))->getTimestamp() : null);
$timestamp_payment_from = ($payment_date_from ? (new DateTime($payment_date_from . ' 00:00:00', $userTimezone))->getTimestamp() : null);
$timestamp_payment_to = ($payment_date_to ? (new DateTime($payment_date_to . ' 23:59:59', $userTimezone))->getTimestamp() : null);
$timestamp_completed_from = ($completed_from ? (new DateTime($completed_from . ' 00:00:00', $userTimezone))->getTimestamp() : null);
$timestamp_completed_to = ($completed_to ? (new DateTime($completed_to . ' 23:59:59', $userTimezone))->getTimestamp() : null);																	
$select = 'SELECT
	op.*,
	ot.reference `reference`,
	pr.paidat `paidat`,
    ot.createdat `transactiondate`,
    ot.method `transactiontype`,
	pc.code `promocode`'
;
$from  = 'FROM {lonet_order_product} op
	LEFT JOIN {lonet_order} o ON o.id = op.orderid
	RIGHT JOIN {lonet_order_transaction} ot ON ot.orderid = o.id AND ot.iscompleted = 1
	LEFT JOIN {lonet_payout_request} pr ON pr.id = op.payoutrequestid
	LEFT JOIN {lonet_promo_code} pc ON pc.id = o.promocodeid AND op.promotionapplied = 1'
;
$and_where_time = 
	($timestamp_from ? 'AND op.starttime >= ' . $timestamp_from : '') . '
	' . ($timestamp_to ? 'AND op.starttime <= ' . $timestamp_to : '') . '
	' . ($timestamp_payment_from ? 'AND ot.createdat >= ' . $timestamp_payment_from : '') . '
	' . ($timestamp_payment_to ? 'AND ot.createdat <= ' . $timestamp_payment_to : '')
;
$and_where = $and_where_time . '
	' . ($reference ? 'AND ot.reference = \'' . $reference .'\'' : '') . '
	' . ($teacher_id ? 'AND op.teacherid = ' . $teacher_id : '') . '
	' . ($student_id ? 'AND op.studentid = ' . $student_id : '') . '
	' . ($transaction_type ? 'AND ot.method = \'' . $transaction_type .'\'' : '') . '
	' . ($promo_code ? 'AND pc.id = ' . $promo_code : '')
;
/* $and_completed = 
	($timestamp_completed_from ? 'AND op.studentcompleted >= ' . $timestamp_completed_from : '') . '
	' . ($timestamp_completed_to ? 'AND op.studentcompleted <= ' . $timestamp_completed_to : '') . '
	' . ($timestamp_completed_from || $timestamp_completed_to? 'AND op.status='.order_product::STATUS_COMPLETED : '')
; */
//Modified by Nitesh
$lvar = ['waiting' => order_product::STATUS_WAITING, 'confirmed' => order_product::STATUS_CONFIRMED, 'declined' => order_product::STATUS_DECLINED,'expired' => order_product::STATUS_EXPIRED,'cancelled' => order_product::STATUS_CANCELED,'completed' => order_product::STATUS_COMPLETED,'notcompleted' => order_product::STATUS_NOTCOMPLETED,'deleted' => order_product::STATUS_DELETED];
$status_value = $lvar[$lesson_status];
$status_completed = (!empty($lesson_status)) ? 'AND op.status='.intval($status_value) : '';
$and_completed = 
	($timestamp_completed_from ? ' op.studentcompleted >= ' . $timestamp_completed_from : '') . '
	' . ($timestamp_completed_to ? 'AND op.studentcompleted <= ' . $timestamp_completed_to : '');
$or_completed = 
	($timestamp_completed_from ? ' op.teachercompleted >= ' . $timestamp_completed_from : '') . '
	' . ($timestamp_completed_to ? 'AND op.teachercompleted <= ' . $timestamp_completed_to : '');
$combineandor = (!empty($timestamp_completed_from) || !empty($timestamp_completed_to)) ? ' AND ('. $and_completed.' AND '.$or_completed.')' : '';
$cash_sql = '(
	' . $select . '
	' . $from . '
	WHERE ot.iscompleted = 1 /*op.status IN (' . order_product::STATUS_COMPLETED . ', ' . order_product::STATUS_NOTCOMPLETED . ', ' . order_product::STATUS_CANCELED . ')*/
	' . $and_where . '
	'. $combineandor .'
	'.$status_completed.'	
) t1';
$cash_report = $DB->get_records_sql('
	SELECT * FROM
	' . $cash_sql . '
	ORDER BY starttime ASC
');
$cash_report_totals = $DB->get_record_sql('
	SELECT
		FORMAT(SUM(price+discount), 2) `price`,
		FORMAT(SUM(price+discount-payoutamount), 2) `commission`
	FROM ' . $cash_sql . '
');
$reference_options = $DB->get_records_sql('
	SELECT DISTINCT ot.reference `reference`
	' . $from . '
	WHERE op.status = ' . order_product::STATUS_COMPLETED . '
		' . $and_where_time . '
		' . ($teacher_id ? 'AND op.teacherid = ' . $teacher_id : '') . '
		' . ($student_id ? 'AND op.studentid = ' . $student_id : '') . '
	ORDER BY ot.reference ASC
');
$teacher_options = $DB->get_records_sql('
	SELECT DISTINCT
		op.teacherid `teacherid`,
		u.email `email`
	' . $from . '
	LEFT JOIN {user} u ON u.id = op.teacherid
	WHERE op.status = ' . order_product::STATUS_COMPLETED . '
		' . $and_where_time . '
		' . ($reference ? 'AND ot.reference = \'' . $reference .'\'' : '') . '
		' . ($student_id ? 'AND op.studentid = ' . $student_id : '') . '
	ORDER BY u.email ASC
');
$student_options = $DB->get_records_sql('
	SELECT DISTINCT
		op.studentid `studentid`,
		CONCAT(u.firstname, \' \', u.lastname) `fullname`
	' . $from . '
	LEFT JOIN {user} u ON u.id = op.studentid
	WHERE op.status = ' . order_product::STATUS_COMPLETED . '
		' . $and_where_time . '
		' . ($reference ? 'AND ot.reference = \'' . $reference .'\'' : '') . '
		' . ($teacher_id ? 'AND op.teacherid = ' . $teacher_id : '') . '
	ORDER BY fullname ASC
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
	$(document).ready(function() {
        function submitForm(e) {
            window.location.href = '<?= $CFG->wwwroot ?>/local/lonet/admin.php?report=cash&' + $('.thead input, .thead select').serialize();
        }
		$('thead input, thead select').change(submitForm);
		$('.btn-select-period').click(submitForm);
	});
</script>

<div class="thead text-right" style="padding-bottom:10px;">
	<div class="text-right">
        Lesson period from&nbsp;<input type="date" name="date_from" value="<?= $date_from ?>">
        to&nbsp;<input type="date" name="date_to" value="<?= $date_to ?>">
        &nbsp;<button class="btn btn-success btn-select-period"><span class="fa fa-check"></span></button>
    </div>
	<div class="text-right hidden">
        Lesson completed from&nbsp;<input type="date" name="completed_from" value="<?= $completed_from ?>">
        to&nbsp;<input type="date" name="completed_to" value="<?= $completed_to ?>">
        &nbsp;<button class="btn btn-success btn-select-period"><span class="fa fa-check"></span></button>
    </div>
    <span class="pull-left" style="font-size: 0.9em; padding-top: 10px;">Total <?= count($cash_report) ?> items.</span>
	<div class="text-right">
        Transaction period from&nbsp;<input type="date" name="payment_date_from" value="<?= $payment_date_from ?>">
        to&nbsp;<input type="date" name="payment_date_to" value="<?= $payment_date_to ?>">
        &nbsp;<button class="btn btn-success btn-select-period"><span class="fa fa-check"></span></button>
    </div>
</div>
<?php
$exporturl = str_replace('admin.php','cash_report_export.php', $FULLME);
echo '<a href="'.$exporturl.'" class="pull-left" style="font-size: 0.9em; padding-top: 10px;"> Download as excel </a>';
?>									   
<table class="table table-striped table-bordered">
	<thead class="thead">
		<tr>
			<th><?= get_string('lessonid', 'local_lonet') ?></th>
			<th><?= get_string('reference', 'local_lonet') ?></th>
			<th><?= get_string('teacher', 'local_lonet') ?></th>
			<th><?= get_string('learner', 'local_lonet') ?></th>
			<th><?= get_string('promocode', 'local_lonet') ?></th>
			<th>Discount</th>
			<th><?= get_string('price', 'local_lonet') ?></th>
			<th><?= get_string('payouttoteacher', 'local_lonet') ?></th>
			<th><?= get_string('commission', 'local_lonet') ?></th>
			<th>Lesson Date</th>
			<th>Transaction Date</th>
			<th>Transaction Type</th>
			<th>Lesson Status</th>
			<th>Lesson Completed</th>								   
		</tr>
		<tr>
			<th></th>
			<th>
				<select name="reference">
					<option></option>
					<?php foreach ($reference_options as $reference_option) { ?>
						<option value="<?= $reference_option->reference ?>" <?= ($reference_option->reference == $reference ? 'selected' : '') ?>><?= $reference_option->reference ?></option>
					<?php } ?>
				</select>
			</th>
			<th>
				<select name="teacher_id">
					<option></option>
					<?php foreach ($teacher_options as $teacher_option) { 
						$userdetail = $DB->get_record_sql("SELECT * FROM {user} WHERE id=".$teacher_option->teacherid."");
						$userfullname = (!filter_var($teacher_option->email, FILTER_VALIDATE_EMAIL)) ? fullname($userdetail) : $teacher_option->email;
					?>
						<option value="<?= $teacher_option->teacherid ?>" <?= ($teacher_option->teacherid == $teacher_id ? 'selected' : '') ?>><?= $userfullname ?></option>
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
			<th>
				<select name="promo_code">
					<option></option>
					<?php foreach ($promo_code_options as $promo_code_option) { ?>
						<option value="<?= $promo_code_option->id ?>" <?= ($promo_code_option->id == $promo_code ? 'selected' : '') ?>><?= $promo_code_option->code ?></option>
					<?php } ?>
				</select>
			</th>
			<th></th>
			<th></th>
			<th></th>
			<th></th>
			<th></th>
			<th></th>
			<th>
				<select name="transaction_type">
					<option></option>
					<?php foreach (['balance', 'card', 'paypal'] as $method) { ?>
						<option value="<?= $method ?>" <?= ($method == $transaction_type ? 'selected' : '') ?>><?= $method ?></option>
					<?php } ?>
				</select>
			</th>
			<th>
				<select name="lesson_status">
					<option></option>
					<?php foreach (['waiting', 'confirmed', 'declined','expired','cancelled','completed','notcompleted','deleted'] as $lstatus) { ?>
						<option value="<?= $lstatus ?>" <?= ($lstatus == $lesson_status ? 'selected' : '') ?>><?= $lstatus ?></option>
					<?php } ?>
				</select>			
			</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$total_payout = 0;
		$commissiontotal = [];
		// print_object($cash_report);die;
		foreach ($cash_report as $cash) {
			$student = $DB->get_record('user', ['id' => $cash->studentid]);						
			$teacher = $DB->get_record('user', ['id' => $cash->teacherid]);
			$payout = order_product::get_payout_amount($cash); 
			$total_payout += $payout; ?>
			<tr>
				<td><?= $cash->id ?></td>
				<td><?= $cash->reference ?></td>
				<td><a href="/teacher/<?= $teacher->id ?>" target="_blank" rel="noopener noreferrer"><?= $teacher->email ?></a></td>
				<td><a href="/user/<?= $student->id ?>" target="_blank" rel="noopener noreferrer"><?= fullname($student, true) ?></a></td>
				<td><?= $cash->promocode ?></td>
				<td><?= number_format($cash->discount, 2) ?></td>
				<td><?= number_format(($cash->discount + $cash->price), 2) . ($cash->promotionapplied ? '<span class="tooltip"><span class="fa fa-info-circle pull-right" style="color: #01c0d1;"></span><span class="tooltiptext">' . $cash->promocode . '</span></span>' : '') ?></td>
				<td><?= number_format($payout, 2) . ($cash->paidat ? '<span class="fa fa-check pull-right" style="color: #499306;"></span>' : ($cash->payoutrequestid ? '<span class="fa fa-clock-o pull-right" style="color: #FF7900;"></span>' : '')) ?></td>
				<?php if($cash->status == 4){ 
					$commissiontotal[] = $cash->commission;
				?>
					<td><?= $cash->commission ?></td>
				<?php } elseif($cash->status == 2 || $cash->status == 3){
					$commissiontotal[] = 0;
				?>
					<td>0</td>
				<?php } else{ 
					$commissiontotal[] = number_format(($cash->discount + $cash->price - $cash->payoutamount), 2);
				?>
					<td><?= number_format(($cash->discount + $cash->price - $cash->payoutamount), 2) ?></td>
				<?php } ?>
				<td><?= (new DateTime('now', $userTimezone))->setTimestamp($cash->starttime)->format('d.m.Y') ?></td>
				<td><?= (new DateTime('now', $userTimezone))->setTimestamp($cash->transactiondate)->format('d.m.Y') ?></td>
				<td><?= $cash->transactiontype ?></td>
				<td><?= order_product::get_status_label($cash, true) ?></td>
				<td><?= !empty($cash->studentcompleted) ? (new DateTime('now', $userTimezone))->setTimestamp($cash->studentcompleted)->format('d.m.Y') : '' ?></td>
			</tr>
		<?php } ?>
	</tbody>
	<tfoot>
		<tr>
			<td colspan=6></td>
			<td><?= $cash_report_totals->price ?></td>
			<td><?= number_format($total_payout, 2) ?></td>
			<!--td><?php //$cash_report_totals->commission ?></td-->
			<td>
			<?php
				$comm = !empty($commissiontotal) ? array_sum($commissiontotal) : 0;
				echo number_format($comm, 2);
			?>
			</td>
			<td colspan=4></td>
		</tr>
	</tfoot>
</table>
