<?php
use local_lonet\order;
use local_lonet\order_transaction;
use local_lonet\user;

require_once('../../../config.php');
require_once($CFG->dirroot.'/local/lonet/lib.php');

global $DB;
global $USER;

$title = get_string('payment', 'local_lonet');

$PAGE->set_context(context_system::instance());
$PAGE->set_pagelayout('base');
$PAGE->set_title($title);
$PAGE->set_heading($title);
$PAGE->set_url('/local/lonet/confirmation.php');

order::confirm_current_products();
$transaction = order::get_transaction();
$balance = user::get_available_balance($USER->id) - order::get_used_balance_amount();

if ($transaction) {
    if ($balance >= $transaction->amount) {
        order::complete_booking($transaction, false);
        header('Location: ' . $CFG->wwwroot . '/local/lonet/confirmation.php');
        exit();
    } elseif ($balance) {
        order::set_used_balance_amount($balance);
        header('Location: ' . $CFG->wwwroot . '/local/lonet/book.php');
        exit();
    } else {
        order::set_transaction_id(null);
        header('Location: ' . $CFG->wwwroot . '/local/lonet/book.php?status=error');
        exit();
    }
} else {
	header('Location: ' . $CFG->wwwroot . '/local/lonet/book.php');
	exit();
}