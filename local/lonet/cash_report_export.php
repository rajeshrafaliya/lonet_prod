<?php
use local_lonet\order_product;
require_once('../../config.php');
global $USER,$CFG,$DB,$PAGE;
require_once("$CFG->libdir/excellib.class.php");
$completed_from = $_GET['completed_from'];
$completed_to = $_GET['completed_to'];
$date_from = $_GET['date_from'];
$date_to = $_GET['date_to'];
$payment_date_from = $_GET['payment_date_from'];
$payment_date_to = $_GET['payment_date_to'];
$reference = $_GET['reference'];
$teacher_id = $_GET['teacher_id'];
$student_id = $_GET['student_id'];
$transaction_type = $_GET['transaction_type'];
$promo_code = $_GET['promo_code'];
$lesson_status = $_GET['lesson_status'];


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
$table = new html_table();
$table->head = array(get_string('lessonid', 'local_lonet'),get_string('reference', 'local_lonet'),get_string('teacher', 'local_lonet'), get_string('learner', 'local_lonet'), get_string('promocode', 'local_lonet'), 'Discount',get_string('price', 'local_lonet'),get_string('payouttoteacher', 'local_lonet'),get_string('commission', 'local_lonet'),'Lesson Date','Transaction Date','Transaction Type','Lesson Status','Lesson Completed');
$row = array();
$total_payout = 0;
$commissiontotal = [];
foreach ($cash_report as $cash) {
	$student = $DB->get_record('user', ['id' => $cash->studentid]);						
	$teacher = $DB->get_record('user', ['id' => $cash->teacherid]);
	$payout = order_product::get_payout_amount($cash); 
	$total_payout += $payout;
	if($cash->status == 4){
		$commissiontotal[] = $cash->commission;
		$commi = $cash->commission;
	} elseif($cash->status == 2 || $cash->status == 3){
		$commissiontotal[] = 0;
		$commi= 0;
	} else{ 
		$commissiontotal[] = number_format(($cash->discount + $cash->price - $cash->payoutamount), 2);
		$commi = number_format(($cash->discount + $cash->price - $cash->payoutamount), 2);
	}
	$studentcompleted = !empty($cash->studentcompleted) ? (new DateTime('now', $userTimezone))->setTimestamp($cash->studentcompleted)->format('d.m.Y') : '';
	
	$table->data[] = [$cash->id,$cash->reference,$teacher->email,fullname($student, true),$cash->promocode,number_format($cash->discount, 2),number_format(($cash->discount + $cash->price), 2),number_format($payout, 2),$commi,(new DateTime('now', $userTimezone))->setTimestamp($cash->starttime)->format('d.m.Y'),(new DateTime('now', $userTimezone))->setTimestamp($cash->transactiondate)->format('d.m.Y'),$cash->transactiontype,order_product::get_status_label($cash, true),$studentcompleted];
}
$comm = !empty($commissiontotal) ? array_sum($commissiontotal) : 0;
$static_row = [
    '', // Lesson ID
    '', // Reference
    '', // Teacher
    '', // Learner
    '', // Promocode
	'',
    $cash_report_totals->price, // Total Price
    number_format($total_payout, 2), // Total Payout to Teacher
    number_format($comm, 2), // Total Commission
    '', // Lesson Date
    '', // Transaction Date
    '', // Transaction Type
    '', // Lesson Status
    ''  // Lesson Completed
];

$table->data[] = $static_row;
$title = 'cash';
$filename = $title."_report_".userdate(time(),'%m-%d-%y');
$workbook = new MoodleExcelWorkbook($filename);
$workbook->send($filename);
$worksheet = $workbook->add_worksheet($filename);
$boldformat = $workbook->add_format();
$boldformat->set_bold(true);
$row = $col = 0;
foreach ($table->head as $colname) {
$worksheet->write_string($row, $col++, $colname, $boldformat);
}
$row++; $col = 0;
foreach ($table->data as $entry) {
	foreach ($entry as $value) {
		$worksheet->write_string($row, $col++, $value);
	}
	$row++; $col = 0;
}
$workbook->close();
exit();
?>
