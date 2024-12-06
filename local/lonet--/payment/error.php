<?php
use local_lonet\order;
use local_lonet\order_transaction;

require_once('../../../config.php');

global $DB;

$title = get_string('payment', 'local_lonet');

$PAGE->set_context(context_system::instance());
$PAGE->set_pagelayout('base');
$PAGE->set_title($title);
$PAGE->set_heading($title);
$PAGE->set_url('/local/lonet/book.php');

$transaction_id = (isset($_GET['dts_reference']) ? $_GET['dts_reference'] : null);
$transaction = order::get_transaction();

if ($transaction && $transaction_id == $transaction->transactionid) {
	$reason = '';
	$status = order_transaction::get_transaction_status($transaction_id);
	if (isset($status->information)) {
		$reason = $status->information;
	}
	$DB->update_record('lonet_order_transaction', [
		'id' => $transaction->id,
		'data' => json_encode(['status' => 'error', 'reason' => $reason]),
	]);
} else {
	$DB->update_record('lonet_order_transaction', [
		'id' => $transaction->id,
		'data' => json_encode(['status' => 'error', 'reason' => 'Unresolved result']),
	]);
}

order::set_transaction_id(null);
order::end_payment_session();

header('Location: ' . $CFG->wwwroot . '/local/lonet/book.php?status=error');
exit();
