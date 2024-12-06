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

$transaction = order::get_transaction();
$DB->update_record('lonet_order_transaction', [
	'id' => $transaction->id,
	'data' => json_encode(['status' => 'expired', 'reason' => 'payment session expired']),
]);
order::set_transaction_id(null);
order::end_payment_session();

header('Location: ' . $CFG->wwwroot . '/local/lonet/book.php?status=expired');
exit();
