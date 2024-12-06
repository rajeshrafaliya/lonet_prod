<?php
use local_lonet\order;
use local_lonet\order_transaction;

require_once ('../../../config.php');
require_once ($CFG->dirroot . '/local/lonet/lib.php');

global $DB;
global $USER;

$title = get_string('payment', 'local_lonet');

$PAGE->set_context(context_system::instance());
$PAGE->set_pagelayout('base');
$PAGE->set_title($title);
$PAGE->set_heading($title);
$PAGE->set_url('/local/lonet/confirmation.php');
// $transaction_id = (isset($_GET['dts_reference']) ? $_GET['dts_reference'] : null);
$transaction_id = (isset($_GET['payment_reference']) ? $_GET['payment_reference'] : null);
$paymentId = (isset($_GET['paymentId']) ? $_GET['paymentId'] : null);
$PayerID = (isset($_GET['PayerID']) ? $_GET['PayerID'] : null);
$token = (isset($_GET['token']) ? $_GET['token'] : null);

$transaction = order::get_transaction();
//echo "<pre>";
//print_r($_REQUEST);
//print_r($_GET);
//print_r($transaction);die;
$data = json_encode(['status' => 'unresolved', 'reason' => 'Your payment could not be resolved.']);
$error = '';

if ($transaction) {
    if ($transaction->method == 'card' && $transaction_id == $transaction->transactionid) {
        $curl = curl_init();
        // // curl_setopt($curl, CURLOPT_POST, 1);
        // if ($data) {
        //     curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        // }
        $username = '1ed7a3a8060ad4f0'; // API USERNAME FROM GENERAL SETTINGS
        $password = '1568d32959896d809c6f17d12e74c393'; // API SECRET FROM GENERAL SETTINGS
																										  
																						   
																																						 
        $url = 'https://pay.every-pay.eu/api/v4/payments/' . $transaction_id . '?api_username=' . $username . '&payment_reference=' . $transaction_id;
        // echo $url;
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_USERPWD, "$username:$password"); //HTTP BASIC AUTH

        $result = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if (curl_errno($curl)) {
            $error_msg = curl_error($curl);
        }
        curl_close($curl);
        $data = json_decode($result);
        
        file_put_contents($CFG->dirroot.'/local/lonet/log/response.log', "\n\n" . date('Y-m-d H:i:s') . ": " . $result, FILE_APPEND);

        /*$transaction_book = order::get_order_book($transaction_id);
        if($transaction_book){
            //$transaction_book->id = $transaction->transactionid;
            $transaction_book->status = $data->payment_state;
            $transaction_book->data = json_encode($data);
            $transaction_book->iscompleted = ($data->payment_state == 'settled' ? '1' : '0');
            echo "<pre>";
            print_r($transaction_book);
            $DB->update_record('lonet_order_book', $transaction_book);
        }*/
        
        if ($data->payment_state == 'settled') {
            $transaction->data = json_encode(['success' => true, 'output' => $data]);
            $DB->update_record('lonet_order_transaction', $transaction);
            order::complete_booking($transaction);
            header('Location: ' . $CFG->wwwroot . '/local/lonet/confirmation.php');
        } else if ($data->payment_state != 'settled'){
            $transaction = order::get_transaction();
            $DB->update_record('lonet_order_transaction', [
                'id' => $transaction->id,
                'data' => json_encode(['success' => false, 'output' => $data]),
            ]);
            order::set_transaction_id(null);
            order::end_payment_session();

            header('Location: ' . $CFG->wwwroot . '/local/lonet/book.php');

        }
        exit();
    } 
    elseif ($transaction->method == 'paypal' && $token && $paymentId == $transaction->transactionid) 
    {
        //$access_token = 'A21AAL30jkjkxjKX4DSBLI5jQEU6FicQnKcZ3gH_DsKsZA33Vb_h2Nv9awGKseMI6rqZzaNHpY-Sb6e9f1AetZqXJ4xkBL94w';
        $url = 'https://api.paypal.com/v1/payments/payment/' . $paymentId . '/execute';

        $payment = array(
            'payer_id' => $PayerID,
            'transactions' => array(
                array(
                    'amount' => array(
                        'currency' => 'EUR',
                        'total' => $transaction->amount
                    )
                )
            )
        );

        $payment_data = json_encode($payment);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payment_data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Authorization: Bearer ' . order_transaction::get_paypal_token()
        ));
        $result = curl_exec($ch);
        curl_close($ch);

// The $result variable will contain the response from the API call
// You can check the payment state in the response to ensure that it was completed successfully
        $data = json_decode($result);

        file_put_contents($CFG->dirroot.'/local/lonet/log/paypal.log', "\n\n" . date('Y-m-d H:i:s') . ": " . $result, FILE_APPEND);
//print_r($data);
//die();
        if ($data->state == 'approved' || $data->state == 'completed') {
            $transaction->data = json_encode(['success' => true, 'output' => $data]);
            $DB->update_record('lonet_order_transaction', $transaction);
            order::complete_booking($transaction);
            header('Location: ' . $CFG->wwwroot . '/local/lonet/confirmation.php');
        } else if ($data->state != 'approved' && $data->state != 'completed'){
            $transaction = order::get_transaction();
            $DB->update_record('lonet_order_transaction', [
                'id' => $transaction->id,
                'data' => json_encode(['success' => false, 'output' => $data]),
            ]);
            order::set_transaction_id(null);
            order::end_payment_session();

            header('Location: ' . $CFG->wwwroot . '/local/lonet/book.php');
        }
        exit();
    } else {
        $error = 'Transaction <strong>' . $transaction->reference . '</strong> result could not be saved.';
    }
} else {
    $error = 'Your payment result could not be saved.';
}
if ($error) {
    if ($transaction) {
        $DB->update_record('lonet_order_transaction', [
            'id' => $transaction->id,
            'data' => $data,
        ]);
    }
    order::set_booking(null);

    echo $OUTPUT->header();

    echo '<div class="alert alert-danger">
		' . $error . '
		<br>
		Please contact Customer Service at <a href="mailto:lonet@lonet.academy">lonet@lonet.academy</a>.
	</div>';

    echo $OUTPUT->footer();
} else {

    order::complete_booking($transaction);

    header('Location: ' . $CFG->wwwroot . '/local/lonet/confirmation.php');
    exit();
}
