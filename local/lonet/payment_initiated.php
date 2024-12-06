<?php

use local_lonet\order;
use local_lonet\order_transaction;

class PaymentInitiated
{
    
    public function callPaymentApi($amount = 0, $orderid = 0, $method = 'card')
    {
        global $DB,$CFG,$USER;
        $transaction = order::get_transaction();
		if ($transaction->method === $method) {
            if ($transaction->transactionid && $transaction->data) {
                return json_decode($transaction->data, true);
            }
        } else {
			$transaction->method = $method;
			$DB->update_record('lonet_order_transaction', $transaction);
		}
        $generated_timestamp = date('c');
        $generated_nonce = uniqid(); //UNIQUE VALUE FOR EACH REQUEST

        $count = $DB->count_records('lonet_order_transaction', ['orderid' => $orderid]);
        $attempt = $count + 1;
        $params = array(
            "timestamp" => $generated_timestamp, //TIMESTAMP ISO 8601
            "api_username" => '1ed7a3a8060ad4f0', // API USERNAME FROM GENERAL SETTINGS
            "account_name" => "EUR3D1", //NAME OF PROCESSING ACCOUNT FROM THE PORTAL
            "amount" => $amount,
            "order_reference" => 'LONET' . $orderid . '/' . $attempt,
            "email" => $USER->email,
            "nonce" => $generated_nonce,
            "customer_url" => $CFG->wwwroot . "/local/lonet/payment/return.php",//URL WHERE CUSTOMER WILL BE REDIRECTED AFTER PAYMENT
        );
//echo "RAJESH CARD";
//die();
        // $resultArray = $this->curlCall("https://pay.every-pay.eu/api/v4/payments/oneoff", $params);
        $resultArray = $this->curlCall("https://pay.every-pay.eu/api/v4/payments/oneoff", $params);

        $result = json_decode($resultArray, true);

        file_put_contents($CFG->dirroot.'/local/lonet/log/transaction.log', "\n\n" . date('Y-m-d H:i:s') . ": " . $resultArray, FILE_APPEND);

        if (isset($result['payment_link']) && !empty($result['payment_link'])) {
            $transaction->transactionid = $result['payment_reference'];
            $DB->update_record('lonet_order_transaction', $transaction);

            //$transaction->status = $result['payment_state'];
            //$DB->update_record('lonet_order_book', $transaction);
            $url = "Location: " . $result['payment_link'];
            header($url, true);
            exit();
        }
    }
    public function curlCall($url, $data)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_POST, 1);
        if ($data) {
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        $username = '1ed7a3a8060ad4f0'; // API USERNAME FROM GENERAL SETTINGS
        $password = '1568d32959896d809c6f17d12e74c393'; // API SECRET FROM GENERAL SETTINGS
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_USERPWD, "$username:$password"); //HTTP BASIC AUTH

        $result = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if (curl_errno($curl)) {
            $error_msg = curl_error($curl);
        }
        curl_close($curl);
        return $result;

    }

	public function callPayPalApi($amount = 0, $orderid = 0, $method = 'paypal')
    {
        global $DB,$CFG,$USER;
        $transaction = order::get_transaction();
		if ($transaction->method === $method) {
            if ($transaction->transactionid && $transaction->data) {
                return json_decode($transaction->data, true);
            }
        } else {
			$transaction->method = $method;
			$DB->update_record('lonet_order_transaction', $transaction);
		}

		$count = $DB->count_records('lonet_order_transaction', ['orderid' => $orderid]);
		$attempt = $count + 1;
        $order_reference = 'LONET' . $orderid . '/' . $attempt;

        // Construct the payment request in JSON format
		$payment_data = array(
		    'intent' => 'sale',
		    'payer' => array(
		        'payment_method' => 'paypal'
		    ),
		    'transactions' => array(
		        array(
		            'amount' => array(
		            	'currency' => 'EUR',
		                'total' => $transaction->amount
		            ),
		            'description' => $USER->email . ' - Payment for Lonet.Academy',
		            'payment_options' => array(
		                'allowed_payment_method' => 'INSTANT_FUNDING_SOURCE'
		            ),
		            'item_list' => array(
		                'items' => array(
		                    array(
		                        'name' => $order_reference,
		                        'quantity' => 1,
		                       	'currency' => 'EUR',
		                        'price' => $transaction->amount
		                    )
		                )
		            )
		        )
		    ),
		    'redirect_urls' => array(
		        'return_url' => $CFG->wwwroot . '/local/lonet/payment/return.php',
		        'cancel_url' => $CFG->wwwroot . '/local/lonet/payment/cancel.php'
		    )
		);
		$payment_json = json_encode($payment_data);

        // $resultArray = $this->curlPaypal("https://api.paypal.com/v1/payments/payment", $payment_json);
        $resultArray = $this->curlPaypal("https://api.paypal.com/v1/payments/payment", $payment_json);
        $result = json_decode($resultArray);

        file_put_contents($CFG->dirroot.'/local/lonet/log/transaction.log', "\n\n" . date('Y-m-d H:i:s') . ": " . $resultArray, FILE_APPEND);

       // Handle success
        $DB->update_record('lonet_order_transaction', ['id' => $transaction->id, 'transactionid' => $result->id]);//, 'data' => $resultArray
	    
	    $approval_url = '';
	    foreach ($result->links as $link) {
	        if ($link->rel == 'approval_url') {
	            $approval_url = $link->href;
	            break;
	        }
	    }
	    if ($approval_url != '') {
	        // Redirect the user to the approval URL
	        //header('Location: ' . $approval_url);
	        $url = "Location: " . $approval_url;
            header($url, true);
            exit();
	    } else {
	        // Handle error
	        echo 'Error: Approval URL not found.<br>';
	        exit();
	    }
    }
    public function curlPaypal($url, $data)
    {
    	//$access_token = //'A21AAL30jkjkxjKX4DSBLI5jQEU6FicQnKcZ3gH_DsKsZA33Vb_h2Nv9awGKseMI6rqZzaNHpY-Sb6e9f1AetZqXJ4xkBL94w';
        // Set the cURL options
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		    'Content-Type: application/json',
		    'Authorization: Bearer ' . order_transaction::get_paypal_token()
		));

		// Make the API request and get the response
		$result = curl_exec($ch);
		$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
        return $result;
	}
}
