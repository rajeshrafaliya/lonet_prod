<?php
namespace local_lonet;

use \core_date;
use \DateTime;
use \local_lonet\lesson;

defined('MOODLE_INTERNAL') || die();

class order {
	public static function create() {
		global $DB;
		global $USER;
		return $DB->insert_record('lonet_order', [
			'studentid' => $USER->id,
			'firstname' => $USER->firstname,
			'lastname' => $USER->lastname,
			'email' => $USER->email,
			'ipaddress' => $_SERVER['REMOTE_ADDR'],
			'createdat' => time()
		], true);
	}
	public static function get_by_id($id) {
		global $DB;
		return $DB->get_record('lonet_order', ['id' => $id]);
	}

	public static function get_order_book($transactionid) {
		global $DB;
		return $DB->get_record('lonet_order_book', ['transactionid' => $transactionid]);
	}
	
	public static function get_booking() {
		global $SESSION;
		global $CFG;
		if (!isset($SESSION->booking)) {
			$SESSION->booking = [
				'order_id' => null,
				'order_transaction_id' => null,
				'promo_code' => [
					'code' => null,
					'id' => null,
					'error' => null,
				],
				'order_products' => [],
				'active_payment_session' => 0,
                'used_balance_amount' => 0
			];
		}
		//file_put_contents($CFG->dirroot.'/local/lonet/log/paypal.log', "\n\n" . date('Y-m-d H:i:s') . ": " . $SESSION->booking, FILE_APPEND);
		return $SESSION->booking;
	}
	public static function set_booking($booking) {
		global $SESSION;
        if ($booking === null) {
            $SESSION->${'gc' . $SESSION->booking['order_id']} = null;
        }
		$SESSION->booking = $booking;
	}
	
	public static function get_order_id() {
		$booking = self::get_booking();
		if (!$booking['order_id']) {
			self::set_order_id(self::create());
		}
		$booking = self::get_booking();
		return $booking['order_id'];
	}
	public static function set_order_id($order_id) {
		$booking = self::get_booking();
		$booking['order_id'] = $order_id;
		self::set_booking($booking);
	}
	public static function get_order() {
		return self::get_by_id(self::get_order_id());
	}
	
	public static function get_transaction_id() {
		$booking = self::get_booking();
		if (!$booking['order_transaction_id']) {
			self::set_transaction_id(order_transaction::create());
		}
		$booking = self::get_booking();
		return $booking['order_transaction_id'];
	}
	public static function set_transaction_id($transaction) {
		$booking = self::get_booking();
		$booking['order_transaction_id'] = $transaction;
		self::set_booking($booking);
	}
	public static function get_transaction() {
		return order_transaction::get_by_id(self::get_transaction_id());
	}
    
    public static function get_used_balance_amount() {
        return self::get_booking()['used_balance_amount'] ?? 0;
    }    
    public static function set_used_balance_amount($amount) {
		$booking = self::get_booking();
		$booking['used_balance_amount'] = $amount;
		self::set_booking($booking);
    }
	
	public static function get_lessons() {
		$products = self::get_products();
        foreach ($products as $i => $product) {
            if ($product['product_code'] !== 'lesson') {
                unset($products[$i]);
            }
        }
        return $products;
	}	
	public static function get_giftcards() {
		$products = self::get_products();
        foreach ($products as $i => $product) {
            if ($product['product_code'] !== 'giftcard') {
                unset($products[$i]);
            }
        }
        return $products;
	}
	
	public static function get_language_camp() {
		$products = self::get_products();
        foreach ($products as $i => $product) {
            if ($product['product_code'] !== 'Camp with private accommodation' && 
                $product['product_code'] !== 'Camp with group accommodation' &&
                $product['product_code'] !== 'Only camp (no accommodation)' &&
                $product['product_code'] !== 'Travel companion (group accommodation)' &&
            	$product['product_code'] !== 'MEET-UP CAMP June 2022') {
                unset($products[$i]);
            }
        }
        return $products;
	}
	
	public static function get_products() {
		$booking = self::get_booking();
		return $booking['order_products'];
	}
	public static function add_product($product) {
		$booking = self::get_booking();
        $product['product_code'] = $product['product_code'] ?? 'lesson';
		$booking['order_products'][] = $product;
		$booking['order_products'] = array_unique($booking['order_products'], SORT_REGULAR);
		self::set_booking($booking);
		self::set_lesson_prices();
	}
	public static function remove_lesson($index) {
		$booking = self::get_booking();
		if (isset($booking['order_products'][$index])) {
			unset($booking['order_products'][$index]);
			self::set_booking($booking);
			self::set_lesson_prices();
		}		
	}
	public static function remove_lessons() {
		$booking = self::get_booking();
		$booking['order_products'] = [];
		self::set_booking($booking);
	}
	
	public static function get_promo_code_id() {
		$booking = self::get_booking();
		return $booking['promo_code']['id'];
	}
	
	public static function get_promo_code() {
		$booking = self::get_booking();
		return $booking['promo_code'];
	}
	public static function set_promo_code($promo_code) {
		$booking = self::get_booking();
		if ($promo_code) {
			$booking['promo_code']['code'] = $promo_code;
			$booking['promo_code']['id'] = null;
			$booking['promo_code']['error'] = null;
			if ($promotion = promo_code::get_by_code($promo_code)) {				
				if (promo_code::is_valid($promotion)) {
					$booking['promo_code']['id'] = $promotion->id;
				} else {
					$booking['promo_code']['error'] = get_string('promocodenotvalid', 'local_lonet');
				}
			} else {
				$booking['promo_code']['error'] = get_string('promocodenotfound', 'local_lonet');
			}
		} else {
			foreach ($booking['promo_code'] as $attr => $value) {
				$booking['promo_code'][$attr] = null;
			}
		}
		self::set_booking($booking);
		self::set_lesson_prices();
	}
	
	public static function set_lesson_prices() {
		global $DB;
		$booking = self::get_booking();
		$lessons = self::get_lessons();		
		if ($booking['promo_code']['id'] && $promotion = promo_code::get_by_id($booking['promo_code']['id'])) {
		    
			$available_count = promo_code::get_available_lesson_count($promotion);
			$available_amount = promo_code::get_available_amount($promotion);
			$j = 1;
			foreach ($lessons as $i => $lesson) {
				if(isset($lesson->isgrouplesson) && $lesson->isgrouplesson > 0){
					$price = lesson::get_grouplesson_price($DB->get_record('lonet_group_lessons', ['id' => $lesson['lessonid']]));
				}else{
					$price = lesson::get_price($DB->get_record('lonet_lesson', ['id' => $lesson['lessonid']]));
				}
				$commission = get_config('local_lonet', 'commissionperlesson');
				$discount = 0;
				$promotionapplied = 0;
				$payoutamount = $price - $commission;
				if (!$promotion->teacherid || $lesson['teacherid'] == $promotion->teacherid) {
					switch ($promotion->type) {
						case 'amount':
							if ($available_amount > 0) {
								if ($available_amount >= $price) {								
									$available_amount -= $price;
									
									// RAJESH 25_01 
									/*$discount = $price;
									$price = 0;
									$commission = 0;
									*/
									$discount = 0;
									$price = $price;
									$commission = $commission;
								} else {
									$price -= $available_amount;
									$commission -= $available_amount;
									$discount = $available_amount;
									
									$available_amount = 0;
								}
								$promotionapplied = 1;
							}
							break;
						case 'discount':
							if ($j <= $available_count) {
								$discount = $promotion->discount;
								$commission -= $discount;
								$price -= $discount;
								$promotionapplied = 1;
							}
					}
					foreach (['price', 'commission'] as $attr) {
						if (${$attr} < 0) {
							${$attr} = 0;
						}
					}
				}
				$lessons[$i]['price'] = $price;
				$lessons[$i]['commission'] = $commission;
				$lessons[$i]['discount'] = $discount;
				$lessons[$i]['promotionapplied'] = $promotionapplied;
				$lessons[$i]['payoutamount'] = $payoutamount;
				$j++;
			}			
		} else {
			foreach ($lessons as $i => $lesson) {
				if(isset($lesson->isgrouplesson) && $lesson->isgrouplesson > 0){
					$price = lesson::get_grouplesson_price($DB->get_record('lonet_group_lessons', ['id' => $lesson['lessonid']]));
				}else{
					$price = lesson::get_price($DB->get_record('lonet_lesson', ['id' => $lesson['lessonid']]));
				}			    
				$lessons[$i]['price'] = $price;
				$lessons[$i]['commission'] = get_config('local_lonet', 'commissionperlesson');
				$lessons[$i]['discount'] = 0;
				$lessons[$i]['promotionapplied'] = 0;
				$lessons[$i]['payoutamount'] = $lessons[$i]['price'] - $lessons[$i]['commission'];
			}	
		}
		if(isset($_POST['isCampBooking'])){
		    if($_POST['isCampBooking'] == '1'){
		        $booking['order_products'] = array_merge($lessons, self::get_language_camp());
		    }
		    else{
		        $booking['order_products'] = array_merge($lessons, self::get_giftcards());
		    }
		}else{
		    $booking['order_products'] = array_merge($lessons, self::get_giftcards());
		}
		
		self::set_booking($booking);
		self::update_current_transaction();
	}
	
	public static function get_price() {
		/* admin tests */
		global $USER,$DB;
		//if ($USER->id == 2 && is_siteadmin()) return 1;
		/* admin tests */
		//START RAJESH 10_12_2022
		$available_balance = user::get_available_balance($USER->id);
		//END RAJESH
		$price = 0;
		foreach (self::get_products() as $product) {
			$product = (object) $product;
			if(isset($product->isgrouplesson) && $product->isgrouplesson > 0){
				$gprice = lesson::get_grouplesson_price($DB->get_record('lonet_group_lessons', ['id' => $product->lessonid]));
				$price += $gprice;
			}else{
				$price += $product->price;
			}
		}
		if($available_balance < 0)
			return $price - $available_balance;
		else
			return $price;
	}
	
	public static function start_payment_session() {
		$booking = self::get_booking();
		$booking['active_payment_session'] = 1;
		self::set_booking($booking);
	}
	public static function end_payment_session() {
		$booking = self::get_booking();
		$booking['active_payment_session'] = 0;
		self::set_booking($booking);
	}
	
	public static function update_current_transaction() {
		global $DB;
		$booking = self::get_booking();
		if (!$booking['active_payment_session']) {
			$transaction = self::get_transaction();
			$price = self::get_price();
			if ($transaction->amount != $price) {
				$transaction->amount = $price;
				$DB->update_record('lonet_order_transaction', $transaction);
			}
		}
	}
	
	public static function confirm_current_products() {
		$booking = self::get_booking();
		if (!$booking['active_payment_session']) {
			self::update_current_transaction();
			foreach ($booking['order_products'] as $index => $product) {
				$product['is_confirmed'] = 1;
				$booking['order_products'][$index] = $product;
			}
			self::set_booking($booking);
		}
	}
	
	public static function complete_booking($transaction, $is_incoming = true) {
		global $CFG;
		global $DB;
		global $SESSION;
		global $USER;
		$data = [
			'id' => $transaction->id,
			'iscompleted' => 1
		];
		if (!$is_incoming) {
			$data['method'] = 'balance';
			$data['isincoming'] = 0;
		}
		$DB->update_record('lonet_order_transaction', $data);
		$get_order_id = $DB->get_record_sql("SELECT * FROM {lonet_order_transaction} WHERE id=".$transaction->id."")->orderid;
		$booking = self::get_booking();
		if ($booking['promo_code']['id']) {
			$DB->update_record('lonet_order', ['id' => $booking['order_id'], 'promocodeid' => $booking['promo_code']['id']]);
		}
        $first_reminder = $transaction->createdat + 21600;
        $validthrough = $transaction->createdat + (86400 * 90); // 90 days
		$teacher_lessons = [];
		$giftcards = [];
		$lang_camp = [];
		file_put_contents($CFG->dirroot.'/local/lonet/log/paypal.log', "\n\n" . date('Y-m-d h:m:s') . ": " . "<pre>".print_r($booking, true)."</pre>", FILE_APPEND);
		if(!empty($booking['order_products'])){
		foreach ($booking['order_products'] as $order_product) {
			if (!empty($order_product['is_confirmed'])) {
			    
				unset($order_product['is_confirmed']);
				$order_product['orderid'] = $booking['order_id'];
                $product_code = $order_product['product_code'];
                unset($order_product['product_code']);
                if ($product_code === 'giftcard') {
                    $count = $order_product['count'];
                    unset($order_product['price']);
                    unset($order_product['count']);
                    for ($i = 0; $i < $count; $i++) {
                        $order_product['code'] = 'PC' . $booking['order_id'] . $i . date('dmY');
                        $order_product['createdat'] = $transaction->createdat;
                        $order_product['validthrough'] = $validthrough;
                        $DB->insert_record('lonet_promo_code', $order_product);
                        $giftcards[] = promo_code::generateGiftCard($order_product['code'], $order_product['amount'] . ' EUR', date('d/m/y', $validthrough));
                    }
                }
                else if($product_code == 'Camp with private accommodation' || 
                        $product_code == 'Camp with group accommodation' ||
                        $product_code == 'Only camp (no accommodation)' ||
                        $product_code == 'Travel companion (group accommodation)' ||
            			$product_code == 'MEET-UP CAMP June 2022'){
                        $order_product['code'] = 'PC' . $booking['order_id'] . $i . date('dmY');
                        $order_product['createdat'] = $transaction->createdat;
                        $order_product['validthrough'] = '';
                        $order_product['package_name'] = $product_code;
                        
                        $DB->insert_record('lonet_promo_code', $order_product);
                        $lang_camp[] = $order_product;
                        
                }
                else {
                    $order_product['next_reminder'] = $first_reminder;
					if($order_product['isgrouplesson']){
						// $lesson = $DB->get_record_sql("SELECT *, lessonname as name  FROM {lonet_group_lessons} WHERE id=".$order_product['lessonid']."");
						$lesson = lesson::get_grouplesson_by_id($order_product['lessonid']);
						$order_product['price'] = lesson::get_grouplesson_price($lesson);
					}
                    $DB->insert_record('lonet_order_product', $order_product);
                    $teacher_lessons[$order_product['teacherid']][] = $order_product;
                }
			}
			file_put_contents($CFG->dirroot.'/local/lonet/log/paypal.log', "\n\n" . date('Y-m-d h:m:s') . ": " . "<pre>".print_r($order_product, true)."</pre>", FILE_APPEND);
		}
		}else{
			if($is_incoming){
				$order_session = $DB->get_record_sql("SELECT * FROM {order_session} WHERE orderid=".$get_order_id."");
				$orderdetail = json_decode($order_session->order_products);
				$order_products = $orderdetail->order_products;
				foreach ($order_products as $order_product) {
					if (!empty($order_product->is_confirmed)) {
						unset($order_product->is_confirmed);
						$order_product->orderid = $get_order_id;
						$product_code = $order_product->product_code;
						unset($order_product->product_code);
/* 						if ($product_code === 'giftcard') {
							$count = $order_product['count'];
							unset($order_product['price']);
							unset($order_product['count']);
							for ($i = 0; $i < $count; $i++) {
								$order_product['code'] = 'PC' . $booking['order_id'] . $i . date('dmY');
								$order_product['createdat'] = $transaction->createdat;
								$order_product['validthrough'] = $validthrough;
								$DB->insert_record('lonet_promo_code', $order_product);
								$giftcards[] = promo_code::generateGiftCard($order_product['code'], $order_product['amount'] . ' EUR', date('d/m/y', $validthrough));
							}
						} */
						if($product_code == 'Camp with private accommodation' || 
								$product_code == 'Camp with group accommodation' ||
								$product_code == 'Only camp (no accommodation)' ||
								$product_code == 'Travel companion (group accommodation)' ||
								$product_code == 'MEET-UP CAMP June 2022'){
								$order_product->code = 'PC' . $get_order_id . $i . date('dmY');
								$order_product->createdat = $transaction->createdat;
								$order_product->validthrough = '';
								$order_product->package_name = $product_code;
								
								$DB->insert_record('lonet_promo_code', $order_product);
								$lang_camp[] = $order_product;
								
						}
						else {
							$order_product->next_reminder = $first_reminder;
							if(isset($order_product->isgrouplesson) && !empty($order_product->isgrouplesson)){
								// $lesson = $DB->get_record_sql("SELECT *, lessonname as name  FROM {lonet_group_lessons} WHERE id=".$order_product['lessonid']."");
								$lesson = lesson::get_grouplesson_by_id($order_product->lessonid);
								$order_product->price = lesson::get_grouplesson_price($lesson);
							}
							$DB->insert_record('lonet_order_product', $order_product);
							$teacher_lessons[$order_product->teacherid][] = $order_product;
						}
					}
				}
			}
		}
		foreach ($teacher_lessons as $teacherid => $lessons) {
			$teacher = get_complete_user_data('id', $teacherid);
			sendMail_booking($teacher, 'newrequest', [
				'fullname' => fullname($teacher, true),
				'reference' => $transaction->reference,
				'count' => count($lessons),
				'hours' => 24,
				'profilelink' => '<a href="' . $CFG->wwwroot . '/user/profile.php?teacher_profile=1">' . get_string('profilepage', 'local_lonet') . '</a>',
			]);
		}
        $yourproducts = '';

        if ($teacher_lessons) {
        	$mail = ($is_incoming ? 'paymentreceived' : 'requestreceived');
            $yourproducts .= get_string('yourlessons', 'local_lonet');
        }
        if ($giftcards) {
        	$mail = ($is_incoming ? 'paymentreceived' : 'giftcardconfirm');
            $giftcards_html = '';
            foreach ($giftcards as $giftcard) {
                $giftcards_html .= '<img src="' . $giftcard . '" alt="Gift Card" style="margin-bottom: 15px; border-radius: 10px;" width="500">';
            }
            $yourproducts .= get_string('yourgiftcards', 'local_lonet', $giftcards_html);
            $SESSION->${'gc' . $booking['order_id']} = $giftcards_html;
        }
        if($lang_camp){
            // $temp_html = '<h2>MeetUp Summer 2021 in Barcelona</h2>
            //     <table style="width:100%;border:1px solid black;">
            //         <thead>
            //             <tr style="1px solid black;text-align:center;">
            //                 <th style="1px solid black;">Purchase ID</th>
            //                 <th style="1px solid black;">Package</th>
            //                 <th style="1px solid black;">Price</th>
            //             </tr>
            //         </thead>
            //         <tbody>';
                    
            //         foreach ($lang_camp as $camp) {
            //                 // print_r($lang_camp);
            //                 // die();
            //         $temp_html .='        <tr style="1px solid black;text-align:center;">
            //                     <td style="1px solid black;">'.$camp["code"].'</td>
            //                     <td style="1px solid black;">'. $camp["package_name"].'</td>
            //                     <td style="1px solid black;">&euro;'. number_format($camp["amount"], 2) .'</td>
            //                 </tr>';
            //              } 
            //      $temp_html .='   </tbody>
            //     </table>';
            $mail =  'paymentreceived_camp';
            $yourproducts .= "Please wait for the place confirmation.<br/>";
        }
		sendMail_booking($USER, $mail, ['lessonname' => 'Lesson','fullname' => fullname($USER, true), 'reference' => $transaction->reference, 'link' => $transaction->orderid, 'yourproducts' => $yourproducts]);
		
		if ($is_incoming) {
			self::end_payment_session();
		}
		$DB->delete_records('order_session', ['orderid' => $get_order_id]);
	}
}
