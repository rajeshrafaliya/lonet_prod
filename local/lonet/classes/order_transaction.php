<?php
namespace local_lonet;

use \core_date;
use \DateTime;

defined('MOODLE_INTERNAL') || die();

class order_transaction {
	public static function create() {
		global $DB;
		global $USER;

		//START RAJESH 10_12_2022
		$minus_amount = 0;
		$available_balance = user::get_available_balance($USER->id);
		if($available_balance < 0)
			$minus_amount = $available_balance;
		//END RAJESH

		$order_id = order::get_order_id();
		$count = $DB->count_records('lonet_order_transaction', ['orderid' => $order_id]);
		$attempt = $count + 1;
		return $DB->insert_record('lonet_order_transaction', [
			'orderid' => $order_id,
			'attempt' => $attempt,
			'reference' => 'LONET' . $order_id . '/' . $attempt,
			'userid' => $USER->id,
			'isincoming' => 1,
			'amount' => order::get_price(),
            'processing_fee' => 0,
            'used_balance_amount' => 0,
            'minus_amount' => $minus_amount,
			'iscompleted' => 0,
			'createdat' => time()
		], true);
	}
	public static function get_by_id($id) {
		global $DB;
		return $DB->get_record('lonet_order_transaction', ['id' => $id]);
	}
	
	public static function call_setup($method = 'paypal') {
		global $CFG;
		global $DB;
		global $USER;
		
		$success = false;
		$result = '<div class="alert alert-danger">Transaction initialization failed.</div>';
		$transaction = order::get_transaction();
		if ($transaction->method === $method) {
            if ($transaction->transactionid && $transaction->data) {
                return json_decode($transaction->data, true);
            }
        } else {
			$transaction->method = $method;
			$DB->update_record('lonet_order_transaction', $transaction);
		}
		$order = order::get_order();
				
		$client = 21921683;
		$password = 'xmV579MUF';
		$page_set_id = 2207;
		$url = 'https://mars.transaction.datacash.com/Transaction';
		$paypal_url = 'https://www.paypal.com/cgi-bin/webscr?cmd=_express-checkout&useraction=commit&token=';
		
		if ($_SERVER['HTTP_HOST'] == 'guru.triz.co.in') {
			$client = 88121553;
			$password = 'Hx5GXWTQJav7';
			$page_set_id = 164;
			$url = 'https://accreditation.datacash.com/Transaction/acq_a';
			$paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr?cmd=_express-checkout&useraction=commit&token=';
		}

		$PayPalTxn = ($method == 'paypal' ? '<PayPalTxn>
			<cancel_url>' . $CFG->wwwroot . '/local/lonet/payment/cancel.php</cancel_url>
			<method>set_express_checkout</method>
			<return_url>' . $CFG->wwwroot . '/local/lonet/payment/return.php</return_url>
			<description>Payment for lessons via LONET.academy</description>
			<email>' . $order->email . '</email>
			<no_shipping>1</no_shipping>
			<solution_type>Mark</solution_type>
		</PayPalTxn>' : '');
		
		$data = '<Request version="2"> 
			<Authentication> 
				<client>' . $client . '</client>
				<password>' . $password . '</password> 
			</Authentication> 
			<Transaction> 
				<TxnDetails>
					<merchantreference>' . $transaction->reference . '</merchantreference> 
					<amount currency="EUR">' . $transaction->amount . '</amount>
				</TxnDetails> 
				' . $PayPalTxn . '
			</Transaction> 
		</Request>';

		$response = (object) self::get_curl_response($url, $data, 'POST', 'xml');

//	file_put_contents($CFG->dirroot.'/local/lonet/log/response.log', "\nResponse: " . print_r($response, true), FILE_APPEND);
	
		if (isset($response->datacash_reference)) {
			$attributes = [
				'id' => $transaction->id,
				'transactionid' => $response->datacash_reference
			];
			$status = (isset($response->status) ? (int) $response->status : false);
			if ($response->status == 1) {
				if ($method == 'paypal' && isset($response->PayPalTxn)) {
					$paypal = (array) $response->PayPalTxn;
					$paypal = (object) $paypal;
					$token = $paypal->token;
					if ($token) {
						$result = 'Location: ' . $paypal_url . $token;
						$success = true;
					}
				}
                $attributes['data'] = json_encode(['success' => $success, 'output' => $result]);
			} else {
				$attributes['data'] = json_encode($response);
			}
			$DB->update_record('lonet_order_transaction', $attributes);
		}
		if (!$success) {
			order::set_transaction_id(null);
		} elseif ($method == 'paypal') {
			header($result);
            $result = '<script>window.location.replace(\'' . str_replace('Location: ', '', $result) . '\')</script>';
			exit();
		}
		return ['success' => $success, 'output' => $result];
	}
	
	public static function get_paypal_details($reference, $transaction) {
		$result = false;
		
		$client = 21921683;
		$password = 'xmV579MUF';
		$page_set_id = 2207;
		$url = 'https://mars.transaction.datacash.com/Transaction';
		
		if ($_SERVER['HTTP_HOST'] == 'guru.triz.co.in') {
			$client = 88121553;
			$password = 'Hx5GXWTQJav7';
			$page_set_id = 164;
			$url = 'https://accreditation.datacash.com/Transaction/acq_a';
		}
				
		$data = '<Request version="2"> 
			<Authentication> 
				<client>' . $client . '</client>
				<password>' . $password . '</password> 
			</Authentication> 
			<Transaction>
				<PayPalTxn>
					<reference>' . $reference . '</reference>
					<method>get_express_checkout_details</method>
				</PayPalTxn>
				<TxnDetails>
					<merchantreference>' . $transaction->reference . ($transaction->method == 'paypal' ? 'g' : '') . '</merchantreference>
				</TxnDetails>
			</Transaction>
		</Request>';
		
		$response = (object) self::get_curl_response($url, $data, 'POST', 'xml');
		if (isset($response->PayPalTxn)) {
			$paypal = (array) $response->PayPalTxn;
			$paypal = (object) $paypal;
            if (empty($paypal->errorcode) && empty($paypal->Errors) && empty($paypal->errors)) {
                $result = true;
            }
		}
		
		return $result;
	}
	
	public static function do_paypal_payment($reference) {
		$result = false;
		 $transaction = order::get_transaction();
		
		if (self::get_paypal_details($reference, $transaction)) {
			$client = 21921683;
			$password = 'xmV579MUF';
			$page_set_id = 2207;
			$url = 'https://mars.transaction.datacash.com/Transaction';
			
			if ($_SERVER['HTTP_HOST'] == 'guru.triz.co.in') {
				$client = 88121553;
				$password = 'Hx5GXWTQJav7';
				$page_set_id = 164;
				$url = 'https://accreditation.datacash.com/Transaction/acq_a';
			}
						
			$data = '<Request version="2"> 
				<Authentication> 
					<client>' . $client . '</client>
					<password>' . $password . '</password> 
				</Authentication> 
				<Transaction>
					<PayPalTxn>
						<reference>' . $reference . '</reference>
						<method>do_express_checkout_payment</method>
					</PayPalTxn>
					<TxnDetails>
						<merchantreference>' . $transaction->reference . ($transaction->method == 'paypal' ? 'd' : '') . '</merchantreference>
						<amount currency="EUR">' . $transaction->amount . '</amount>
					</TxnDetails>
				</Transaction>
			</Request>';
			
			$response = (object) self::get_curl_response($url, $data, 'POST', 'xml');
			if (isset($response->PayPalTxn)) {
				$paypal = (array) $response->PayPalTxn;
				$paypal = (object) $paypal;
				if (empty($paypal->errorcode) && empty($paypal->Errors) && empty($paypal->errors)) {
					$result = true;
				}
			}
		}
		
		return $result;
	}
	
	public static function get_transaction_status($transaction_id = null, $transaction = null, $reference) {
		$client = 21921683;
		$password = 'xmV579MUF';
		$page_set_id = 2207;
		$url = 'https://mars.transaction.datacash.com/Transaction';
		
		if ($_SERVER['HTTP_HOST'] == 'guru.triz.co.in') {
			$client = 88121553;
			$password = 'Hx5GXWTQJav7';
			$page_set_id = 164;
			$url = 'https://accreditation.datacash.com/Transaction/acq_a';
		}
		
		if (!$transaction) {
			$transaction = ($transaction_id ? self::get_by_id($transaction_id) : order::get_transaction());
		}
		
		$data = '<Request version="2"> 
			<Authentication> 
				<client>' . $client . '</client>
				<password>' . $password . '</password> 
			</Authentication> 
			<Transaction>
				<HistoricTxn>
					<reference>' . $reference . '</reference>
					<method>query</method>
				</HistoricTxn>
			</Transaction>
		</Request>';
		
		$response = (object) self::get_curl_response($url, $data, 'POST', 'xml');
	
		return $response;
	}
	
	public static function get_curl_response($service_url, $data, $type, $format = 'string', $token = null) {
		global $CFG;
		$result = false;
		$log_data = true;
		if ($format == 'string') {
			$data_string = http_build_query($data);
		} elseif ($format == 'json') {
			$data_string = urlencode(json_encode($data, JSON_UNESCAPED_SLASHES));
		} elseif ($format == 'xml') {
			$data_string = $data;
		}
		$c = curl_init($service_url);
		curl_setopt($c, CURLOPT_CONNECTTIMEOUT, 3);
		curl_setopt($c, CURLOPT_TIMEOUT, 10);
		curl_setopt($c, CURLOPT_CUSTOMREQUEST, $type);
		curl_setopt($c, CURLOPT_POSTFIELDS, $data_string);
		curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
		if ($token) {
			curl_setopt($c, CURLOPT_HTTPHEADER, ['Authorization: Bearer ' . $token]);
		}
//		file_put_contents($CFG->dirroot.'/local/lonet/log/transaction.log', "\n\n" . date('Y-m-d H:i:s') . ": " . $service_url, FILE_APPEND);
		$response = curl_exec($c);
		if ($log_data) {
//			file_put_contents($CFG->dirroot.'/local/lonet/log/transaction.log', "\nData: " . print_r($data_string, true), FILE_APPEND);
		}
//		file_put_contents($CFG->dirroot.'/local/lonet/log/transaction.log', "\nResponse: " . print_r($response, true), FILE_APPEND);
		$error = curl_errno($c);
		if (!$error) {
			if ($format == 'xml') {
				$result = (array) simplexml_load_string($response);
			} else {
				$temp = json_decode($response);
				if (json_last_error() == JSON_ERROR_NONE) {
					$result = $temp;
				} else {
					$result = $response;
				}
			}
		} else {
//			file_put_contents($CFG->dirroot.'/local/lonet/log/transaction.log', "\nError: " . print_r($error, true), FILE_APPEND);
		}
		curl_close($c);
		return $result;
	}
	
	public static function get_user_transactions($userid) {
		global $DB;
		//to show transaction by balance , removed a condition from below query on line 372 "AND ot.isincoming = 1"
		//RAJESH 14_12_2022 line 379 if(used_balance_amount > 0,1,ot.isincoming) AS `isincoming`,
		//RAJESH 14_12_2022 line 386 remove condition AND (ot.isincoming = 1 OR used_balance_amount > 0)

		// removed  + ot.used_balance_amount
		$query  = '
			SELECT * FROM (
			SELECT
				ot.reference `reference`,
				ot.isincoming `isincoming`,
				FORMAT(ot.amount, 2) `amount`,
                ot.processing_fee `processing_fee`,
				ot.orderid `orderid`,
				ot.createdat `datetime`,
				NULL `lessonid`
			FROM {lonet_order_transaction} ot
			WHERE ot.userid = ' . $userid . '
				AND ot.iscompleted = 1
				
			UNION ALL
			SELECT
				op.id `reference`,
				0 `isincoming`,
				FORMAT(op.price, 2) `amount`,
                0 `processing_fee`,
				NULL `orderid`,
				op.endtime `datetime`,
				op.lessonid `lessonid`
			FROM {lonet_order_product} op
			WHERE op.studentid = ' . $userid . '
				AND (
					op.status = ' . order_product::STATUS_COMPLETED . '
					OR (
						op.status = ' . order_product::STATUS_NOTCOMPLETED . '
						AND op.teachernotcompletereason = \'Learner didn\\\'t show up.\'
					)
				)
			UNION ALL
			SELECT
				op.id `reference`,
				0 `isincoming`,
				FORMAT(op.commission, 2) `amount`,
                0 `processing_fee`,
				NULL `orderid`,
				op.endtime `datetime`,
				op.lessonid `lessonid`
			FROM {lonet_order_product} op
			WHERE op.teacherid = ' . $userid . '
				AND (
                    (op.payoutrequestid IS NOT NULL AND op.payoutamount < 0)
                    OR (
						op.status = ' . order_product::STATUS_NOTCOMPLETED . '
                        AND LOWER(COALESCE(op.teachernotcompletereason, \'\')) NOT LIKE \'%learner%\'
                        OR LOWER(COALESCE(op.studentnotcompletereason, \'\')) LIKE \'%teacher%\'
                    )
                )
			UNION ALL
			SELECT
				CONCAT(\'PR-\', op.payoutrequestid) `reference`,
				0 `isincoming`,
				FORMAT(SUM(op.payoutamount), 2) `amount`,
                0 `processing_fee`,
				NULL `orderid`,
				pr.createdat `datetime`,
				NULL `lessonid`
			FROM {lonet_order_product} op
			LEFT JOIN {lonet_order} ord ON ord.id = op.orderid	 
            LEFT JOIN {lonet_payout_request} pr ON pr.id = op.payoutrequestid
			WHERE op.teacherid = ' . $userid . '
                AND pr.paidat IS NOT NULL
            GROUP BY op.payoutrequestid
			UNION ALL
			SELECT
				op.id `reference`,
				0 `isincoming`,
				FORMAT((CASE WHEN (op.canceltime > op.starttime - 43200) THEN op.price ELSE op.commission END), 2)`amount`,
                0 `processing_fee`,
				NULL `orderid`,
				op.endtime `datetime`,
				op.lessonid `lessonid`
			FROM {lonet_order_product} op
			WHERE op.studentid = ' . $userid . '
				AND op.status = ' . order_product::STATUS_CANCELED . '
				AND op.cancellerid = op.studentid
			UNION ALL
			SELECT
				op.id `reference`,
				1 `isincoming`,
				FORMAT(op.payoutamount, 2) `amount`,
                0 `processing_fee`,
				NULL `orderid`,
				op.endtime `datetime`,
				op.lessonid `lessonid`
			FROM {lonet_order_product} op
			WHERE op.teacherid = ' . $userid . '
				AND (
					op.status = ' . order_product::STATUS_COMPLETED . '
                    OR (
						op.status = ' . order_product::STATUS_NOTCOMPLETED . '
                        AND LOWER(COALESCE(op.teachernotcompletereason, \'\')) LIKE \'%learner%\'
                        AND LOWER(COALESCE(op.studentnotcompletereason, \'\')) NOT LIKE \'%teacher%\'
                    )
               		OR (
						op.status = 4
						AND op.cancellerid = op.studentid
						AND op.canceltime > op.starttime - 43200
					)
				)
                AND op.payoutamount > 0
            UNION ALL
            SELECT 
                otr.reference `reference`,
                otr.isincoming `isincoming`,
                FORMAT(otr.amount, 2) `amount`,
                0 `processing_fee`,
                NULL `orderid`,
				otr.createdat `datetime`,
				NULL `lessonid`
            FROM {lonet_order_transaction_return} otr
            WHERE otr.userid = ' . $userid . '
			) t
			ORDER BY datetime DESC
		';//AND LOWER(COALESCE(op.teachernotcompletereason, \'\')) NOT LIKE \'%student%\' OR LOWER(COALESCE(op.teachernotcompletereason, \'\')) LIKE \'%student%\'
		// echo $query;
		return $DB->get_records_sql($query);
	}
	
	public static function get_time_label($transaction) {
		return (new DateTime('now', core_date::get_user_timezone_object()))->setTimestamp($transaction->createdat)->format('D, M j, Y H:i');
	}
	
	public static function get_allowed_payment_methods() {
		//return ['balance', 'card', 'paypal'];
		return ['card', 'paypal']; //for payment page only
	}
    
    public static function getPaymentMethods() {
		return ['balance', 'bank', 'card', 'paypal', 'reward'];
    }
    
    public static function getMethodNames() {
        return [
            'balance' => 'Wallet Ballance',
            'bank' => 'Bank Transfer',
            'card' => 'Card Payment',
            'paypal' => 'PayPal',
            'reward' => 'Reward',
        ];
    }
    
    public static function getMethodName($code) {
        return self::getMethodNames()[$code] ?? 'default';
    }

    public static function get_paypal_token() {
    	
		// $clientId = 'ATLRVMx9tl9AlrGdwFPTI1OPMMcCAuYBbX9e_nXhJjU5632Q2CcpLLjOl5KZVNXvJcKbOKhOoQhv-vUa';
		// $clientSecret = 'EHZGV8T_F1LSykB6e_7wr4I-uIFUsGqfzpbvXkoLb9cPPbuu9Y9sXXyrpi-KHX0sdnHYmX2tX2e2BvPr';	
		
		$clientId = 'AcvCc__h39uL-Bbnl8f353LiKk1jfiHGgDuOyh62QmQjflOWZpES9_RiNw76IScJqmQnt19mpwAodWDT';
		$clientSecret = 'ECIzTnxDQeALtjOlgbLSdR7JnzDQFgYYMmw4Mswp6ypa0pbgf5Xii8cUDljzz5oOwR_xNriu9t7vPUtv';

		$ch = curl_init();

		// curl_setopt($ch, CURLOPT_URL, "https://api.paypal.com/v1/oauth2/token");
		curl_setopt($ch, CURLOPT_URL, "https://api-m.sandbox.paypal.com/v1/oauth2/token");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_USERPWD, $clientId . ":" . $clientSecret);

		$headers = array();
		$headers[] = "Accept: application/json";
		$headers[] = "Accept-Language: en_US";
		$headers[] = "Content-Type: application/x-www-form-urlencoded";
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$result = curl_exec($ch);
		if (curl_errno($ch)) {
		    echo 'Error:' . curl_error($ch);
		}
		curl_close ($ch);

		$response = json_decode($result);
		$accessToken = $response->access_token;
		return $accessToken;
	}
}
