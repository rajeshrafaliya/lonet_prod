<?php

use local_lonet\order;
use local_lonet\order_transaction;
require_once '../../config.php';
require_once './payment_initiated.php';
$payment = new PaymentInitiated();
// print_r($_REQUEST);die;
if (isset($_REQUEST['order_reference']) && $_REQUEST['order_reference'] != '') {

    $title = get_string('payment', 'local_lonet');

    $PAGE->set_context(context_system::instance());
    $PAGE->set_pagelayout('base');
    $PAGE->set_title($title);
    $PAGE->set_heading($title);
    $PAGE->set_url('/local/lonet/payment.php');
    //echo $result['output'];

    if (isset($_GET['isCampBooking'])) {
        header('Location: ' . $CFG->wwwroot . '/local/lonet/language_book.php');
        exit();
    }
    echo "payment done";
    //header('Location: ' . $CFG->wwwroot . '/local/lonet/book.php');
    exit();

}

global $DB;
if ($price = order::get_price()) {
    order::confirm_current_products();
    order::start_payment_session();
	
	//added by Nitesh
	$orderdetail = order::get_booking();
	$DB->delete_records('order_session', ['orderid' => $orderdetail['order_id']]);
	$ordersession = new stdClass();
	$ordersession->orderid = $orderdetail['order_id'];
	$ordersession->order_products = json_encode($orderdetail);
	$DB->insert_record('order_session', $ordersession);
	///////////
    $transaction = order::get_transaction();
    if ($used_balance = order::get_used_balance_amount()) {
        if ($price == $transaction->amount) {
            $DB->update_record('lonet_order_transaction', ['id' => $transaction->id, 'amount' => $transaction->amount - $used_balance, 'used_balance_amount' => $used_balance]);
        }
    }

    $method = (isset($_GET['method']) && in_array($_GET['method'], order_transaction::get_allowed_payment_methods()) ? $_GET['method'] : 'card');

    if ($method === 'paypal') {
        $amount_base = $transaction->amount - $transaction->processing_fee;
        $processing_fee = round($amount_base * 0.07, 2);
        $amount = $amount_base + $processing_fee;
        if ($amount != $transaction->amount) {
            $DB->update_record('lonet_order_transaction', ['id' => $transaction->id, 'amount' => $amount, 'processing_fee' => $processing_fee]);
        }
    } elseif ($method == 'card') {
		$amount_base = $transaction->amount - $transaction->processing_fee;
        $processing_fee = round($amount_base * 0.03, 2);
        $amount = $amount_base + $processing_fee;
        if ($amount != $transaction->amount) {
            $DB->update_record('lonet_order_transaction', ['id' => $transaction->id, 'amount' => $amount, 'processing_fee' => $processing_fee]);
        }
    } elseif ($transaction->processing_fee > 0) {
        $DB->update_record('lonet_order_transaction', ['id' => $transaction->id, 'amount' => $transaction->amount - $transaction->processing_fee, 'processing_fee' => 0]);
    }
    $transaction = order::get_transaction();
    if ($method === 'paypal') {
        //$result = order_transaction::call_setup($method);
        $payment->callPayPalApi($transaction->amount, $transaction->orderid, $method);
    } else if ($method === 'card') {
        $payment->callPaymentApi($transaction->amount, $transaction->orderid, $method);
    }

    //print_r($_REQUEST);die;
    if (!$_REQUEST['order_reference']) {
        if (isset($_GET['isCampBooking'])) {
            header('Location: ' . $CFG->wwwroot . '/local/lonet/language_book.php?status=init_failed');
            exit();
        }
        header('Location: ' . $CFG->wwwroot . '/local/lonet/book.php?status=init_failed');
        exit();
    } else {
        $title = get_string('payment', 'local_lonet');

        $PAGE->set_context(context_system::instance());
        $PAGE->set_pagelayout('base');
        $PAGE->set_title($title);
        $PAGE->set_heading($title);
        $PAGE->set_url('/local/lonet/payment.php');
        //echo $result['output'];
        if (isset($_GET['isCampBooking'])) {
            header('Location: ' . $CFG->wwwroot . '/local/lonet/language_book.php');
            exit();
        }
        header('Location: ' . $CFG->wwwroot . '/local/lonet/book.php');
        exit();
        echo $result['output'];
    }
} else {
    if (isset($_REQUEST['isCampBooking'])) {
        header('Location: ' . $CFG->wwwroot . '/local/lonet/language_book.php');
        exit();
    }
    header('Location: ' . $CFG->wwwroot . '/local/lonet/book.php');
    exit();
}
