<?php
namespace local_lonet;

use \core_date;
use \core_tag_tag;
use \DateTime;

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot.'/user/profile/lib.php');

class user {
	public static function get_by_id($id) {
		global $DB;
		$user = $DB->get_record('user', ['id' => $id]);
		profile_load_data($user);
		return $user;
	}
	
	public static function is_online($user) {
		return (time() - $user->lastaccess <= 300);
	}
    
    public static function getReferralCodeById($id) {
        return 'L' . str_pad($id, 5, 0, STR_PAD_LEFT) . 'A';
    }
    public static function getIdByReferralCode($code) {
        return (int) trim($code, 'LA');
    }
	
	public static function is_teacher($user) {
		global $DB;
		if ($user) {
			if ($DB->get_record('role_assignments', ['roleid' => 3, 'userid' => $user->id])) {
				return true;
			}
		}
		return false;
	}
	
	public static function is_bookkeeper() {
		global $DB;
		global $USER;
		if ($USER) {
			if ($DB->get_record('role_assignments', ['roleid' => 9, 'userid' => $USER->id])) {
				return true;
			}
		}
		return false;
	}
	public static function is_seo_manager() {
		global $DB;
		global $USER;
		if ($USER) {
			if ($DB->get_record('role_assignments', ['roleid' => 10, 'userid' => $USER->id])) {
				return true;
			}
		}
		return false;
	}
	public static function is_teacher_manager() {
		global $DB;
		global $USER;
		if ($USER) {
			if ($DB->get_record('role_assignments', ['roleid' => 11, 'userid' => $USER->id])) {
				return true;
			}
		}
		return false;
	}
	
	public static function get_video_embed_url($user) {
		$url = '';
		if ($videourl = $user->profile_field_videourl) {
            $url = self::getEmbedUrl($videourl);
		}
		return $url;
	}
    
    public static function getEmbedUrl($url, $controls = 0) {
        $embed_url = '';
        if (strpos($url, 'youtube')) {
            if (strpos($url, '/shorts/') !== false) {
                $parts = explode('/shorts/', $url);
            } else {
                $parts = explode('watch?v=', $url);
            }
            $videoid = end($parts);
            $videoparts = explode('&', $videoid);
            $embed_url = 'https://www.youtube.com/embed/' . $videoparts[0] . (isset($videoparts[1]) ? '?start=' . substr($videoparts[1], 2, -1) . '&' : '?') . 'rel=0&controls=' . $controls . '&showinfo=0';
        } elseif (strpos($url, 'youtu.be')) {
            $parts = explode('/', $url);
            $videoid = end($parts);
            $videoparts = explode('?', $videoid);
            $embed_url = 'https://www.youtube.com/embed/' . $videoparts[0] . (isset($videoparts[1]) ? '?start=' . substr($videoparts[1], 2, -1) . '&' : '?') . 'rel=0&controls=' . $controls . '&showinfo=0';
        } elseif (strpos($url, 'player.vimeo')) {
            $embed_url = $url;
        } elseif (strpos($url, 'vimeo')) {
            $parts = explode('/', $url);
            $embed_url = 'https://player.vimeo.com/video/' . end($parts);
        } elseif (strpos($url, 'drive.google')) {
            $videourl_parts = explode('?', $url);
            $url = $videourl_parts[0];
            if (strpos($url, 'preview')) {
                $embed_url = $url;
            } else {
                $parts = explode('/', $url);
                $last = count($parts) - 1;
                $file = (strlen($parts[$last]) > 10 ? $parts[$last] : $parts[$last - 1]);
                $folder = (strlen($parts[$last]) > 10 ? $parts[$last - 1] : $parts[$last - 2]);
                $embed_url = "https://drive.google.com/file/$folder/$file/preview";
            }
        }
        return $embed_url;
    }
    
    public static function getBadges($user_id, $language, $existing = []) {
		global $DB;
        $result = $existing;
        $badges = $DB->get_records_sql('
            SELECT ub.badge 
            FROM {lonet_user_badge} ub 
            WHERE ub.isactive = 1
                AND ub.userid = ' . $user_id . '
                AND (
                    ub.language = \'' . $language . '\'
                    OR ub.language = NULL
                )
        ');
        foreach ($badges as $badge) {
            $result[$badge->badge] = $badge->badge;
        }
        return $result;
    }
	public static function get_userdata($userid, $fieldname=null) {
		global $DB;
		$sql = "SELECT fielddata FROM {lonet_userdata} WHERE userid = '".$userid."' and fieldname = '".$fieldname."'";
		$record = $DB->get_record_sql($sql);
		return $record->fielddata;
	}
	public static function get_lesson_count($user, $year = false) {
			global $DB;
			$sql = "SELECT COUNT(DISTINCT ss.id) as `count`
				FROM {lonet_order_product} ss
				WHERE (ss.studentid = '" . $user->id . "' )";//OR ss.teacherid = '" . $user->id . "'
			if($year)
				$sql .= " AND FROM_UNIXTIME(ss.endtime, '%Y') = YEAR(CURRENT_DATE())";
			else
				$sql .= " AND ss.endtime < NOW()";
			$sql .= " AND ss.status = '". order_product::STATUS_COMPLETED . "'";

			$record = $DB->get_record_sql($sql);
			return $record->count;
		}

	public static function get_languages_from_data($data, $as_array = false) {
		global $CFG,$DB;
		$languages = ($as_array ? [] : '');
		if ($data) {
			foreach($data as $code) {
				if ($as_array) {
					if ($language = $DB->get_record('lonet_language', ['code' => $code])) {
						$languages[$language->code] = category::get_name($code);
					}
				} else {
					$flag = null;
					if ($language = $DB->get_record('lonet_language', ['code' => $code])) {
						$flag = $language->flag;
					}
					$url = language::get_full_url_by_code($code);
					$languages .= '<img src="'.$CFG->wwwroot.'/theme/lonet/pix/flag/'.$code.'.png" alt="'.$code.'" width="16" height="16">';
					// $languages .= '<a href="'.$url.'">'.($languages ? ', ' : '') . category::get_name($code) . ($flag ? ' <span class="flag flag-' . $flag . '"></span></a>' : '');
					$languages .= '<a href="'.$url.'">' . category::get_name($code) .' </a>';
				}
			}
		}
		return $languages;
	}
	
	public static function get_unique_languages_from_data($data, $as_array = false) {
		global $DB;
		$languages = ($as_array ? [] : '');
		if ($data) {
			foreach($data as $code) {
                if (strlen($code) == 2) {
                    if ($as_array) {
                        if ($language = $DB->get_record('lonet_language', ['code' => $code])) {
                            $languages[$language->code] = category::get_name($code);
                        }
                    } else {
                        $flag = null;
                        if ($language = $DB->get_record('lonet_language', ['code' => $code])) {
                            $flag = $language->flag;
                        }
                        $languages .= ($languages ? ', ' : '') . category::get_name($code) . ($flag ? ' <span class="flag flag-' . $flag . '"></span>' : '');
                    }
				}
			}
		}
		return $languages;
	}
	
	public static function get_profile_completion($user) {
		$result = 10;
		foreach ([
			'country',
			'city',
			'picture',
			'profile_field_languagesspeaking',
			'profile_field_languageslearning',
			'profile_field_occupation',
			'profile_field_education',
		] as $attribute) {
			if ($user->$attribute) {
				$result += 10;
			}
		}
		if (isset($user->profile_field_aboutme['text']) && $user->profile_field_aboutme['text']) {
			$result += 10;
		}
		if (core_tag_tag::get_item_tags('core', 'user', $user->id)) {
			$result += 10;
		}
		return $result;
	}
    
    public static function getImageUrl($user) {
        $img = $OUTPUT->user_picture($user);
        $img_part = explode('src="', $img)[1];
        return explode('"', $img_part)[0];
    }
    
    public static function addReferralReward($user, $referral_code, $student_id = null) {
		global $DB;
        $result = true;
        $order_data = [
            'studentid' => $user->id,
            'firstname' => $user->firstname,
            'lastname' => $user->lastname,
            'email' => $user->email,
            'ipaddress' => $_SERVER['REMOTE_ADDR'],
            'createdat' => time(),
        ];
        $student_id = $student_id ?? $order_data['studentid'];
        if ($order_id = $DB->insert_record('lonet_order', $order_data)) {
            $student_id = $student_id ?? $order_data['studentid'];
            $transaction_data = [
                'orderid' => $order_id,
                'attempt' => 1,
                'reference' => 'LONET' . $order_id . '/1',
                'method' => 'reward',
                'amount' => 10,
                'userid' => $order_data['studentid'],
                'isincoming' => 1,
                'description' => $user->id == $student_id ? 'Reward for joining' : 'Reward for inviting user #' . $student_id,
                'transactionid' => $referral_code . '-' . $student_id,
                'iscompleted' => 1,
                'createdat' => $order_data['createdat'],
            ];
            if (!$DB->insert_record('lonet_order_transaction', $transaction_data)) {
                $result = false;
            }
        } else {
            $result = false;
        }
        return $result;
    }
	
	public static function get_balance($userid) {
		global $DB;
		$incoming = $DB->get_record_sql('
			SELECT SUM(balance) `balance`
			FROM (
                SELECT SUM(ot.amount - ot.processing_fee) `balance`
                FROM {lonet_order_transaction} ot
                WHERE ot.userid = ' . $userid . '
                    AND (ot.isincoming = 1 OR ot.used_balance_amount > 0)
                    AND ot.iscompleted = 1
                UNION ALL
                SELECT SUM(otr.amount) `balance`
                FROM {lonet_order_transaction_return} otr
                WHERE otr.userid = ' . $userid . '
                    AND otr.isincoming = 1
			) t1
		');
		
		$sql = '
			SELECT SUM(balance) `balance`
			FROM (
				SELECT SUM(op.price) `balance`
				FROM {lonet_order_product} op
				WHERE op.studentid = ' . $userid . '
					AND (
						op.status = ' . order_product::STATUS_COMPLETED . '
						OR (
							op.status = ' . order_product::STATUS_NOTCOMPLETED . '
                            AND ' . order_product::getNotCompleteByStudentSql() . '
                            AND (op.payoutamount IS NULL OR op.payoutamount > 0)
						)
						OR (
							op.status = ' . order_product::STATUS_CANCELED . '
							AND op.cancellerid = op.studentid
							AND op.canceltime > op.starttime - 43200
						)
					)
				UNION ALL
				SELECT SUM(op.commission) `balance`
				FROM {lonet_order_product} op
				LEFT JOIN {lonet_payout_request} pr ON pr.id = op.payoutrequestid
				WHERE (
						op.studentid = ' . $userid . '
						AND op.status = ' . order_product::STATUS_CANCELED . '
						AND op.cancellerid = op.studentid
						AND op.canceltime < op.starttime - 43200
					)
					OR 
					(
						(
							op.payoutrequestid IS NULL
							OR pr.paidat IS NULL
						) 
						AND op.teacherid = ' . $userid . '
						AND op.status = ' . order_product::STATUS_NOTCOMPLETED . '
                        AND ' . order_product::getNotCompleteByTeacherSql() . '
					)
                UNION ALL
                SELECT SUM(otr.amount) `balance`
                FROM {lonet_order_transaction_return} otr
                WHERE otr.userid = ' . $userid . ' 
                    AND otr.isincoming = 0
                UNION ALL
                SELECT SUM(pc.amount) `balance`
                FROM {lonet_promo_code} pc
                LEFT JOIN {lonet_order} o ON o.id = pc.orderid
                WHERE o.studentid = ' . $userid . ' AND pc.isactive=1
			) t1
		';
		$used = $DB->get_record_sql($sql);
		
		$sql_1 = '
			SELECT SUM(op.payoutamount) `balance`
			FROM {lonet_order_product} op
			LEFT JOIN {lonet_payout_request} pr ON pr.id = op.payoutrequestid
			WHERE op.teacherid = ' . $userid . '
				AND (
					op.payoutrequestid IS NULL
					OR pr.paidat IS NULL
				)
				AND (
					op.status = ' . order_product::STATUS_COMPLETED . '
					OR (
						op.status = ' . order_product::STATUS_NOTCOMPLETED . '
						AND ' . order_product::getNotCompleteByStudentSql() . '
					)
					OR (
						op.status = ' . order_product::STATUS_CANCELED . '
						AND op.cancellerid = op.studentid
						AND op.canceltime > op.starttime - 43200
						)
				)
		';
		$earned = $DB->get_record_sql($sql_1);
		
		//giftcard- added by Nitesh
		$promosql = $DB->get_records_sql("SELECT promocodeid FROM {lonet_order} WHERE `promocodeid` IS NOT NULL AND studentid=".$userid." group by promocodeid");
		$pkeys = array_keys($promosql);
		$promoids = implode(',',$pkeys);
		if(!empty($promoids)){
		$totalamount = $DB->get_record_sql("SELECT sum(amount) as giftcard FROM {lonet_promo_code} WHERE id IN(".$promoids.") AND isactive=1");
			$giftcard =  ($totalamount->giftcard) ? $totalamount->giftcard : 0;
		}else{
			$giftcard = 0;
		}

		// echo "Rajesh=".$incoming->balance. '-'. $used->balance. '+'. $earned->balance.'+'.$giftcard."=END";
		return $incoming->balance - $used->balance + $earned->balance + $giftcard;
	}
	
	public static function get_available_balance($userid) {
        /* TEST */
        // if ($userid == 2) {
            // return 9;
        // }
        /* */
		global $DB;
		$incoming = $DB->get_record_sql('
			SELECT SUM(balance) `balance`
			FROM (
                SELECT SUM(ot.amount - ot.processing_fee) `balance`
                FROM {lonet_order_transaction} ot
                WHERE ot.userid = ' . $userid . '
                    AND (ot.isincoming = 1 OR ot.used_balance_amount > 0)
                    AND ot.iscompleted = 1
                UNION ALL
                SELECT SUM(otr.amount) `balance`
                FROM {lonet_order_transaction_return} otr
                WHERE otr.userid = ' . $userid . '
                    AND otr.isincoming = 1
            ) t1
		');
		$sql = '
			SELECT SUM(balance) `balance`
			FROM (
				SELECT SUM(op.price) `balance`
				FROM {lonet_order_product} op
				WHERE op.studentid = ' . $userid . '
					AND (
						op.status IN (' . order_product::STATUS_WAITING . ', ' . order_product::STATUS_CONFIRMED . ', ' . order_product::STATUS_COMPLETED . ')
						OR
						(
							op.status = ' . order_product::STATUS_NOTCOMPLETED . '
							AND ' . order_product::getNotCompleteByStudentSql() . '
                            AND (op.payoutamount IS NULL OR op.payoutamount > 0)
						)
						OR (
							op.status = ' . order_product::STATUS_CANCELED . '
							AND op.cancellerid = op.studentid
							AND op.canceltime > op.starttime - 43200
						)
					)
				UNION ALL
				SELECT SUM(op.commission) `balance`
				FROM {lonet_order_product} op
				WHERE op.studentid = ' . $userid . '
					AND op.status = ' . order_product::STATUS_CANCELED . '
					AND op.cancellerid = op.studentid
					AND op.canceltime < op.starttime - 43200
				UNION ALL
				SELECT SUM(op.commission) `balance`
				FROM {lonet_order_product} op
				LEFT JOIN {lonet_payout_request} pr ON pr.id = op.payoutrequestid
				WHERE op.teacherid = ' . $userid . '
					AND (
						op.payoutrequestid IS NULL
						OR pr.paidat IS NULL
					)
					AND (
						(
							op.status = ' . order_product::STATUS_CANCELED . '
							AND op.cancellerid = op.teacherid
							AND op.canceltime > op.starttime - 43200
						) OR (
							op.status = ' . order_product::STATUS_NOTCOMPLETED . '
							AND ' . order_product::getNotCompleteByTeacherSql() . '
						)
					)
                UNION ALL
                SELECT SUM(otr.amount) `balance`
                FROM {lonet_order_transaction_return} otr
                WHERE otr.userid = ' . $userid . '
                    AND otr.isincoming = 0
                UNION ALL
                SELECT SUM(pc.amount) `balance`
                FROM {lonet_promo_code} pc
                LEFT JOIN {lonet_order} o ON o.id = pc.orderid
                WHERE o.studentid = ' . $userid . ' AND pc.isactive=1
			) t1
		';
		$used_and_pending = $DB->get_record_sql($sql);
		
		$sql = 'SELECT SUM(op.payoutamount) `balance`
			FROM {lonet_order_product} op
			LEFT JOIN {lonet_payout_request} pr ON pr.id = op.payoutrequestid
			WHERE op.teacherid = ' . $userid . '
				AND (
					op.payoutrequestid IS NULL
					OR pr.paidat IS NULL
				)
				AND (
					op.status = ' . order_product::STATUS_COMPLETED . '
					OR (
						op.status = ' . order_product::STATUS_NOTCOMPLETED . '
						AND ' . order_product::getNotCompleteByStudentSql() . '
					)
					OR (
						op.status = ' . order_product::STATUS_CANCELED . '
						AND op.cancellerid = op.studentid
						AND op.canceltime > op.starttime - 43200
						)
				)';
		$earned = $DB->get_record_sql($sql);
		
		//get deal amount
		$dealbalancearr = [];
		$dealamounts = $DB->get_records_sql("SELECT * FROM {lonet_order_transaction} WHERE `userid` = ".$userid." AND `isincoming` = 1 AND `iscompleted` = 1");
		if(!empty($dealamounts)){
			foreach($dealamounts as $singledeal){
				$decodedata = json_decode($singledeal->data);
				if(isset($decodedata->offer) && !empty($decodedata->offer)){
					$dealbalancearr[] = $decodedata->price;
				}
			}
		}
		$dealbalance = (!empty($dealbalancearr)) ? array_sum($dealbalancearr) : 0;
		
		//giftcard- added by Nitesh
		$promosql = $DB->get_records_sql("SELECT promocodeid FROM {lonet_order} WHERE `promocodeid` IS NOT NULL AND studentid=".$userid." group by promocodeid");
		$pkeys = array_keys($promosql);
		$promoids = implode(',',$pkeys);
		if(!empty($promoids)){
		$totalamount = $DB->get_record_sql("SELECT sum(amount) as giftcard FROM {lonet_promo_code} WHERE id IN(".$promoids.") AND isactive=1");
			$giftcard =  ($totalamount->giftcard) ? $totalamount->giftcard : 0;
		}else{
			$giftcard = 0;
		}
		
		//echo "<br>Haresh=".$incoming->balance. 'R-'. $used_and_pending->balance. 'V+'. $earned->balance. 'S-'.teacher::get_pending_payout_request_amount($userid)."=END";
		return $dealbalance + $incoming->balance - $used_and_pending->balance + $earned->balance - teacher::get_pending_payout_request_amount($userid) - self::get_expired_balance($userid) + $giftcard;
	}
	public static function get_expired_balance($userid) {
		global $DB;
		
		$sixmonth = strtotime('-180 days');
		$sql_11 = '
			SELECT SUM(op.payoutamount) `balance`
			FROM {lonet_order_product} op
			LEFT JOIN {lonet_order} ord ON ord.id = op.orderid
			LEFT JOIN {lonet_payout_request} pr ON pr.id = op.payoutrequestid
			WHERE op.teacherid = ' . $userid . '
				AND (
					op.payoutrequestid IS NULL
					OR pr.paidat IS NULL
				)
				AND (
					op.status = ' . order_product::STATUS_COMPLETED . '
					OR (
						op.status = ' . order_product::STATUS_NOTCOMPLETED . '
						AND ' . order_product::getNotCompleteByStudentSql() . '
					)
					OR (
						op.status = ' . order_product::STATUS_CANCELED . '
						AND op.cancellerid = op.studentid
						AND op.canceltime > op.starttime - 43200
						)
				)AND ord.createdat < '. $sixmonth .'
		';
		$expire = $DB->get_record_sql($sql_11);

		return $expire->balance;
	}	
	public static function can_book_trial($teacherid, $language = null) {
		global $DB;
		global $USER;
		$records_by_teacher = $DB->get_records_sql('
			SELECT op.id
			FROM {lonet_order_product} op
			LEFT JOIN {lonet_lesson} l ON l.id = op.lessonid
			WHERE l.istrial = 1
				AND op.status IN (' . order_product::STATUS_WAITING . ', ' . order_product::STATUS_CONFIRMED . ', ' . order_product::STATUS_COMPLETED . ')
				AND op.studentid = ' . $USER->id . '
				AND op.teacherid = ' . $teacherid . '
		');
        return !$records_by_teacher;
		// $records_by_language = $DB->get_records_sql('
			// SELECT op.id
			// FROM {lonet_order_product} op
			// LEFT JOIN {lonet_lesson} l ON l.id = op.lessonid
			// WHERE l.istrial = 1
				// AND op.status IN (' . order_product::STATUS_WAITING . ', ' . order_product::STATUS_CONFIRMED . ', ' . order_product::STATUS_COMPLETED . ')
				// AND op.studentid = ' . $USER->id . '
				// ' . ($language ? 'AND op.language = \'' . $language . '\'' : '') . '
		// ');
		// return (!$records_by_teacher && count($records_by_language) <= 3);
	}
	
	public static function can_delete_account($userid) {
		global $DB;
		$lessons = $DB->get_records_sql('
			SELECT op.id
			FROM {lonet_order_product} op
			WHERE (op.studentid = ' . $userid . ' OR op.teacherid = ' . $userid . ')
				AND op.status IN (' . order_product::STATUS_WAITING . ', ' . order_product::STATUS_CONFIRMED . ')
		');
		return ($lessons ? false : true);
	}
	
	public static function get_time_label($timestamp) {
		return (new DateTime('now', core_date::get_user_timezone_object()))->setTimestamp($timestamp)->format('D, M j, Y H:i');
	}
    
    public static function get_languages($id) {
        global $DB;
        $languages = [];
        $data = [];
        $records = $DB->get_records_sql('
            SELECT language
            FROM {lonet_order_product}
            WHERE studentid = ' . $id . '
            GROUP BY language
            ORDER BY COUNT(language) DESC
        ');
        foreach ($records as $record) {
            $data[] = $record->language;
        }
		$languages = self::get_languages_from_data($data, true);
		return $languages;
    }
    
    public static function getPublicDisplay($id) {
        global $OUTPUT;
        $html = '';
        $user = self::get_by_id($id);
        if ($user) {
            $html .= $OUTPUT->user_picture($user, ['size' => '62']);
/*             $html .= '<a href="/user/' . $user->id . '" target="_blank" rel="noopener noreferrer">
                <strong>' . $user->firstname . ' ' . substr($user->lastname, 0, 1) . '.</strong>
            </a>'; */
        }
        return $html;
    }
    
    public static function getTestimonialSubtitle($id) {
        global $OUTPUT;
        $html = '';
        $user = self::get_by_id($id);
        if ($user) {
            if (self::is_teacher($user)) {
                if ($languages = teacher::get_languages($id)) {
                    $html = implode(', ', $languages) . ' Tutor';
                }
            } else {
                if ($languages = self::get_languages($id)) {
                    $html = 'Learns ' . implode(', ', $languages) . ' on LONET';
                }
                
            }
        }
        return $html;
    }
 	public static function addUserToMailingList_notloggedin_old($username,$email,$groups) {
		global $CFG;

		$data = [
			'email' => $email,
			'name' => $username,
			'groups' => $groups
		];
        
		$data_string = json_encode($data);
        $service_url = 'https://api.mailerlite.com/api/v2/groups/46432276/subscribers';
		$c = curl_init($service_url);
		curl_setopt($c, CURLOPT_CUSTOMREQUEST, 'POST');
		curl_setopt($c, CURLOPT_POSTFIELDS, $data_string);
		curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($c, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'X-MailerLite-ApiKey: aad70823272938227adba6162f41f210'
        ]);
		curl_close($c);
		
		//add groups
		if(!empty($groups)){
			foreach($groups as $group){
				$curl = curl_init();
				curl_setopt_array($curl, array(
				  CURLOPT_URL => "https://api.mailerlite.com/api/v2/groups/".$group."/subscribers",
				  CURLOPT_RETURNTRANSFER => true,
				  CURLOPT_ENCODING => "",
				  CURLOPT_MAXREDIRS => 10,
				  CURLOPT_TIMEOUT => 30,
				  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				  CURLOPT_CUSTOMREQUEST => "POST",
				  CURLOPT_POSTFIELDS => "{\"email\":\"".$email."\", \"name\": \"".$username."\"}",
				  CURLOPT_HTTPHEADER => array(
					"content-type: application/json",
					"x-mailerlite-apikey: aad70823272938227adba6162f41f210"
				  ),
				));

				$response = curl_exec($curl);
				$err = curl_error($curl);

				curl_close($curl);

				if ($err) {
				  echo "cURL Error #:" . $err;
				} else {
				  echo $response;
				}
			}
		}
    }  
    public static function addUserToMailingList($id = null, $data = []) {
		global $CFG;
		$bearerToken = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI0IiwianRpIjoiZDJmNWVhMjM4Y2ExYWRiNzIzNWExNWQ3MGQ3MmYwZDRkMTcxZjc4NDNkOWI5NzFiZWMwYTY0NDRkMGEwODhiZmI0MTk2MjBjNzVjOThlZTkiLCJpYXQiOjE3MTgxMjQ5ODkuMzU3NzA4LCJuYmYiOjE3MTgxMjQ5ODkuMzU3NzEyLCJleHAiOjQ4NzM3OTg1ODkuMzQ4MDk2LCJzdWIiOiI5OTI4NzIiLCJzY29wZXMiOltdfQ.fujz9hvxhvmzGLYaiDfPyHpUbIIbCNEmfWSGbi2GpkCtcAVy2BufuMeB9gIz5A1LCgoGqYHtphkV-qKNDLn4O_6NuScwWJJVeXmJcxb9_8tI6BjYkPeQmgeJ-gQXPdMBIwOhe-9uQrrtdsKuW3Xe_y9hEmmHp2q-mCdoWq5TmgPa-7iF1wOeYx3L9XB7YejWnQItB_F25u5AvlsZ1_nUzdfGJtG3B2gewKaqHqUVqhtNnmHFHun_qr85NBzx14bnjhNtV8MkQQKrkmMrAPFsLO58L_9KJJL1s_lUqcdchPESyke2qYv-UJpsgsvddoHNak1fVQotlpZeD4pDjy_6fup3TrLqelr2ze8BKifzm32rvx9lf5wWCR_Nr5kH7U_S1lLrducErSocbWv0KOfpED1NvHyxJTjQmK8YTJab-AAmBZrzvBHto7_W-iy6ZsrQ1hdTYrEJrrVOpDVBPasOTmO0p1O_kCF8dnRPdGsK10Wa2tBJl4vPWJw02ZV8GmeF9b-THygi-tNg6qjTLIW_RUHi_lDQbgEqey96JmVm4c8efoSyFvxueNzjmAGPZIKtnDpuui29K24HkyZFbYEMqtTHDQukK-GsrdpUTqQqiFfo2Z8ezXAdQqLZdD7tZd7wORiL9r6OSSZt3qLGfX2hfhAIfDk3OoTy4yhNV-1hIW8';
        if ($id) {
            $user = self::get_by_id($id);
            $data = [
                'email' => $user->email,
                'name' => fullname($user, true),
                'fields' => [
					'name' => fullname($user, true),
                    'country' => $user->country ? get_string($user->country, 'core_countries') : '',
                    'city' => $user->city,
                ],
				'groups' => ['94771110564857015']
            ];
        }
		$data_string = json_encode($data);
        // $service_url = 'https://api.mailerlite.com/api/v2/groups/46432276/subscribers';
        $service_url = "https://connect.mailerlite.com/api/subscribers";
		$c = curl_init($service_url);
		curl_setopt($c, CURLOPT_CUSTOMREQUEST, 'POST');
		curl_setopt($c, CURLOPT_POSTFIELDS, $data_string);
		curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($c, CURLOPT_HTTPHEADER, [
			"content-type: application/json",
			"Accept: application/json",
			'Authorization: Bearer ' . $bearerToken,
        ]);
		file_put_contents($CFG->dirroot.'/local/lonet/log/user.log', "\n\n" . date('Y-m-d H:i:s') . ": " . $service_url, FILE_APPEND);
		file_put_contents($CFG->dirroot.'/local/lonet/log/user.log', "\nData: " . print_r($data_string, true), FILE_APPEND);
		$response = curl_exec($c);
		file_put_contents($CFG->dirroot.'/local/lonet/log/user.log', "\nResponse: " . print_r($response, true), FILE_APPEND);
		if ($error = curl_errno($c)) {
			file_put_contents($CFG->dirroot.'/local/lonet/log/user.log', "\nError: " . print_r($error, true), FILE_APPEND);
		}
		curl_close($c);
    }	
	public static function addUserToMailingList_notloggedin($username,$email,$groups) {
		global $CFG;
		$bearerToken = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI0IiwianRpIjoiZDJmNWVhMjM4Y2ExYWRiNzIzNWExNWQ3MGQ3MmYwZDRkMTcxZjc4NDNkOWI5NzFiZWMwYTY0NDRkMGEwODhiZmI0MTk2MjBjNzVjOThlZTkiLCJpYXQiOjE3MTgxMjQ5ODkuMzU3NzA4LCJuYmYiOjE3MTgxMjQ5ODkuMzU3NzEyLCJleHAiOjQ4NzM3OTg1ODkuMzQ4MDk2LCJzdWIiOiI5OTI4NzIiLCJzY29wZXMiOltdfQ.fujz9hvxhvmzGLYaiDfPyHpUbIIbCNEmfWSGbi2GpkCtcAVy2BufuMeB9gIz5A1LCgoGqYHtphkV-qKNDLn4O_6NuScwWJJVeXmJcxb9_8tI6BjYkPeQmgeJ-gQXPdMBIwOhe-9uQrrtdsKuW3Xe_y9hEmmHp2q-mCdoWq5TmgPa-7iF1wOeYx3L9XB7YejWnQItB_F25u5AvlsZ1_nUzdfGJtG3B2gewKaqHqUVqhtNnmHFHun_qr85NBzx14bnjhNtV8MkQQKrkmMrAPFsLO58L_9KJJL1s_lUqcdchPESyke2qYv-UJpsgsvddoHNak1fVQotlpZeD4pDjy_6fup3TrLqelr2ze8BKifzm32rvx9lf5wWCR_Nr5kH7U_S1lLrducErSocbWv0KOfpED1NvHyxJTjQmK8YTJab-AAmBZrzvBHto7_W-iy6ZsrQ1hdTYrEJrrVOpDVBPasOTmO0p1O_kCF8dnRPdGsK10Wa2tBJl4vPWJw02ZV8GmeF9b-THygi-tNg6qjTLIW_RUHi_lDQbgEqey96JmVm4c8efoSyFvxueNzjmAGPZIKtnDpuui29K24HkyZFbYEMqtTHDQukK-GsrdpUTqQqiFfo2Z8ezXAdQqLZdD7tZd7wORiL9r6OSSZt3qLGfX2hfhAIfDk3OoTy4yhNV-1hIW8';
		$data = [
			'email' => $email,
			'fields' => [
				'name' => $username
			],
			'groups' => $groups
		];
        
		$data_string = json_encode($data);
		if(!empty($groups)){
			foreach($groups as $group){
				$curl = curl_init();
				curl_setopt_array($curl, array(
				  CURLOPT_URL => "https://connect.mailerlite.com/api/subscribers",
				  CURLOPT_RETURNTRANSFER => true,
				  CURLOPT_ENCODING => "",
				  CURLOPT_MAXREDIRS => 10,
				  CURLOPT_TIMEOUT => 30,
				  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				  CURLOPT_CUSTOMREQUEST => "POST",
				  CURLOPT_POSTFIELDS => $data_string,
				  CURLOPT_HTTPHEADER => array(
					"content-type: application/json",
                    "Accept: application/json",
					'Authorization: Bearer ' . $bearerToken,
				  ),
				));
				$response = curl_exec($curl);
				$err = curl_error($curl);
				curl_close($curl);
				if ($err) {
				  echo "cURL Error #:" . $err;
				} else {
				  echo $response;
				}
			}
		}
    }
	public function deleteSubscriberByEmail($email) {
		$bearerToken = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI0IiwianRpIjoiZDJmNWVhMjM4Y2ExYWRiNzIzNWExNWQ3MGQ3MmYwZDRkMTcxZjc4NDNkOWI5NzFiZWMwYTY0NDRkMGEwODhiZmI0MTk2MjBjNzVjOThlZTkiLCJpYXQiOjE3MTgxMjQ5ODkuMzU3NzA4LCJuYmYiOjE3MTgxMjQ5ODkuMzU3NzEyLCJleHAiOjQ4NzM3OTg1ODkuMzQ4MDk2LCJzdWIiOiI5OTI4NzIiLCJzY29wZXMiOltdfQ.fujz9hvxhvmzGLYaiDfPyHpUbIIbCNEmfWSGbi2GpkCtcAVy2BufuMeB9gIz5A1LCgoGqYHtphkV-qKNDLn4O_6NuScwWJJVeXmJcxb9_8tI6BjYkPeQmgeJ-gQXPdMBIwOhe-9uQrrtdsKuW3Xe_y9hEmmHp2q-mCdoWq5TmgPa-7iF1wOeYx3L9XB7YejWnQItB_F25u5AvlsZ1_nUzdfGJtG3B2gewKaqHqUVqhtNnmHFHun_qr85NBzx14bnjhNtV8MkQQKrkmMrAPFsLO58L_9KJJL1s_lUqcdchPESyke2qYv-UJpsgsvddoHNak1fVQotlpZeD4pDjy_6fup3TrLqelr2ze8BKifzm32rvx9lf5wWCR_Nr5kH7U_S1lLrducErSocbWv0KOfpED1NvHyxJTjQmK8YTJab-AAmBZrzvBHto7_W-iy6ZsrQ1hdTYrEJrrVOpDVBPasOTmO0p1O_kCF8dnRPdGsK10Wa2tBJl4vPWJw02ZV8GmeF9b-THygi-tNg6qjTLIW_RUHi_lDQbgEqey96JmVm4c8efoSyFvxueNzjmAGPZIKtnDpuui29K24HkyZFbYEMqtTHDQukK-GsrdpUTqQqiFfo2Z8ezXAdQqLZdD7tZd7wORiL9r6OSSZt3qLGfX2hfhAIfDk3OoTy4yhNV-1hIW8';
		
		$url = "https://connect.mailerlite.com/api/subscribers/" . urlencode($email);

		$ch = curl_init();

		// Set cURL options
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE"); // Use DELETE method
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, [
			"Content-Type: application/json",
			"Authorization: Bearer $bearerToken"
		]);

		$response = curl_exec($ch);
		$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);

		if ($httpCode == 204) {
			echo "Subscriber with email '$email' was deleted successfully.";
		} elseif ($httpCode == 404) {
			echo "Subscriber with email '$email' not found.";
		} else {
			echo "Failed to delete subscriber. Response: $response";
		}
	}
/* METADATA */
    public static function getCurrentTeacherLangCode() {
        $code = null;
        $request_uri = trim($_SERVER['REQUEST_URI'], '/');
        $request_uri_parts = explode('/', $request_uri);
        if (isset($request_uri_parts[1])) {
            $url = $request_uri_parts[1];
            $code = language::get_code_by_url($url);
        }
        if (!$code && isset($_GET['id'])) {
            $code = array_keys(teacher::get_languages($_GET['id']))[0] ?? null;
        }
        return $code;
    }
    
    public static function getCurrentPageTemplate() {
		global $SCRIPT;
        $template = false;
        $template_urls = [
            'home' => '/index.php',
            'teacher' => '/user/profile.php',
            'teacher_list' => '/local/lonet/index.php',
            'languagecamp' => '/local/lonet/language_camp.php',
            'becometutor' => '/local/lonet/becometutor.php',
            'consultation' => '/local/lonet/consultation.php',
            'aboutus' => '/local/lonet/aboutus.php',
            'faq' => '/local/lonet/faq.php'
        ];
        // file_put_contents('test.txt', print_r($_SERVER, true), FILE_APPEND);
        // $script_name = parse_url($_SERVER['SCRIPT_NAME'], PHP_URL_PATH);
        $template = array_search($SCRIPT, $template_urls);
        if ($template === false) {
            $query_string = str_replace(['&lang=en', '&lang=lv', '&lang=ru', 'lang=en', 'lang=lv', 'lang=ru'], '', $_SERVER['QUERY_STRING']);
            $request_uri = $_SERVER['SCRIPT_NAME'] . ($query_string ? '?' . $query_string : '');
            $template_url_sets = [
                'careers' => [
                    '/mod/page/view.php?id=24',
                ],
                'corporate' => [
                    '/mod/page/view.php?id=29',
                    '/mod/page/view.php?id=30',
                ],
                'faq' => [
                    '/mod/page/view.php?id=36', //en
                    '/mod/page/view.php?id=22', //lv
                    '/mod/page/view.php?id=23', //ru
                ],
                'giftcard' => [
                    '/local/lonet/gift_card.php',
                ],
                'howitworks' => [
                	'/local/lonet/how_it_works.php',
                    //'/mod/page/view.php?id=21', //en
                    //'/mod/page/view.php?id=34', //ru
                    //'/mod/page/view.php?id=35', //lv
                ],
                'aboutmissionvalues' => [
                    '/mod/page/view.php?id=37', //en
                    '/mod/page/view.php?id=38', //es
                    '/mod/page/view.php?id=39', //lv
                    '/mod/page/view.php?id=40', //ru
                ],
                'landingpage' => [
                    '/local/lonet/landing_page.php',
                ],/*
                'languagecamp' => [
                    '/local/lonet/language_camp.php',
                ],*/
            ];
            foreach ($template_url_sets as $template_url => $template_url_set) {
                if (array_search($request_uri, $template_url_set) !== false) {
                    $template = $template_url;
                    break;
                }
            }
        }
        if ($template === false) {
            if (strpos($_SERVER['REQUEST_URI'], 'admin') !== false) {
                $template = 'admin';
            } 
        }
        return $template;
    }
    
    public static function getMeta($attr) {
        global $SESSION;
        $template = self::getCurrentPageTemplate();
        switch ($template) {
            case 'becometutor':
                return trim(strip_tags(get_string('meta_' . $attr . '_becometutor', 'local_lonet'))) ?: null;            
			case 'consultation':
                return trim(strip_tags(get_string('meta_' . $attr . '_consultation', 'local_lonet'))) ?: null;			
			case 'aboutus':
                return trim(strip_tags(get_string('meta_' . $attr . '_consultation', 'local_lonet'))) ?: null;
            case 'home':
                return trim(strip_tags(get_string('meta_' . $attr . '_home', 'local_lonet'))) ?: null;
            case 'careers':
            case 'corporate':
            case 'faq':
            case 'giftcard':
            	return trim(strip_tags(get_string('meta_' . $attr . '_page_' . $template, 'theme_lonet'))) ?: null;
            case 'languagecamp':
            	return trim(strip_tags(get_string('meta_' . $attr . '_page_' . $template, 'theme_lonet'))) ?: null;
            case 'howitworks':
                ${$attr} = trim(strip_tags(get_string('meta_' . $attr . '_page_' . $template, 'theme_lonet'))) ?: null;
                if ($attr === 'title') {
                    if (strpos(strtolower(${$attr}), 'lonet.academy') === false) {
                        if (!(${$attr} === 'howitworks' && in_array(substr($SESSION->lang ?? 'en', 0, 2),['lv', 'ru']))) {
                            ${$attr} .= ' | Lonet.Academy';
                        }
                    }
                }
                return ${$attr};
            case 'aboutmissionvalues':
                ${$attr} = trim(strip_tags(get_string('meta_' . $attr . '_page_' . $template, 'theme_lonet'))) ?: null;
                if ($attr === 'title') {
                    if (strpos(strtolower(${$attr}), 'lonet.academy') === false) {
                        if (!(${$attr} === 'aboutmissionvalues' && in_array(substr($SESSION->lang ?? 'en', 0, 2),['lv', 'ru']))) {
                            ${$attr} .= ' | Lonet.Academy';
                        }
                    }
                }
                return ${$attr};
            case 'landingpage':
            	return trim(strip_tags(get_string('meta_' . $attr . '_page_' . $template, 'theme_lonet'))) ?: null;
            case 'teacher':
                if (isset($_GET['id'])) {
                    if ($user = self::get_by_id($_GET['id'])) {
                    	//echo "Rajesh".$user->profile_field_role;
                        if ($user->profile_field_role == 'Teacher') {
                            $string = 'meta_' . $attr . '_teacher';
                            if (get_string_manager()->string_exists($string, 'local_lonet')) {                                
                                if ($attr == 'description') {
                                    $user_languages = user::get_unique_languages_from_data($user->profile_field_languagesteaching, true);
                                    $languages = implode(', ', $user_languages);
                                    $languages_ru = [];
                                    foreach ($user_languages as $language_name) {
                                        $languages_ru[] = mb_substr(mb_strtolower($language_name), 0, -2) . 'ому';
                                    }
                                    $params = [
                                        'name' => $user->firstname,
                                        'full_name' => fullname($user, true),
                                        'location' => $user->country ? get_string($user->country, 'core_countries') : '',
                                        'languages' => $languages,
                                        'languages_lower' => mb_strtolower($languages),
                                        'languages_ru' => implode(', ', $languages_ru),
                                    ];
                                } else{
                                    $params = fullname($user, true);
                                }
                                return trim(strip_tags(get_string($string, 'local_lonet', $params))) ?: null;
                            }
                        }else{
                			return trim(strip_tags(get_string('meta_' . $attr . '_home', 'local_lonet'))) ?: null;
                		}
                    }
                }
            case 'teacher_list':
				if(isset($_GET['url'])) {
                    $code = language::get_code_by_url($_GET['url']);
                    $string = 'meta_' . $attr . '_teacher_list_' . $code;
                    if (get_string_manager()->string_exists($string, 'local_lonet')) {
                        return trim(strip_tags(get_string($string, 'local_lonet'))) ?: null;
                    }
                }else{
                	return trim(strip_tags(get_string('meta_' . $attr . '_page_' . $template, 'theme_lonet'))) ?: null;
                }
            default:
                return null;
        }
    }
    
    public static function getMetaTitle() {
        return self::getMeta('title');
    }
    public static function getMetaDescription() {
        return self::getMeta('description');
    }
    public static function getMetaRobotsTag() {
        $result = '';
        switch (self::getCurrentPageTemplate()) {
            case 'teacher':
                if (isset($_GET['id'])) {
                    if ($user = self::get_by_id($_GET['id'])) {
                        if ($user->profile_field_role != 'Teacher') {
                            $result = '<meta name="robots" content="noindex">';
                        }
                    }
                }
                break;
            case 'admin':
                $result = '<meta name="robots" content="noindex">';
                break;
            default:
                $result = '';
        }
        return $result;
    }
    
    public static function getCurrentUrl() {
        return 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    }
    
    public static function getCanonicalUrl() {
        $host = 'https://' . $_SERVER['HTTP_HOST'];
        $url = $host . explode('?', $_SERVER['REQUEST_URI'])[0];
        if (strpos($url, '.php') >= 0) {
            switch (self::getCurrentPageTemplate()) {
                case 'teacher':
                    if (isset($_GET['id'])) {
                        if ($user = self::get_by_id($_GET['id'])) {
                            if ($user->profile_field_role == 'Teacher') {
                                if ($language_code = self::getCurrentTeacherLangCode()) {
                                    if ($language = language::get_by_url($language_code)) {
                                        $url = $host . language::get_full_url($language) . '/' . $_GET['id'];
                                    }
                                }
                            } else {
                                $url = $host . '/user/' . $_GET['id'];
                            }
                        }
                    }
                    break;
                case 'teacher_list':
                    if (isset($_GET['url'])) {
                        if ($language = language::get_by_url($_GET['url'])) {
                            $url = $host . language::get_full_url($language);
                        }
                    }
            }
        }
        return $url;
    }

public static function send_reminder_notbooked_lesson($user) { //finds one reminder to send and sends it
	global $CFG;
	global $DB;
    
    sendMail($user, 'notbookedlesson', [
        'firstname' => $user->firstname
    ]);  
}
    
    public static function getHrefLangTags() {
        global $SESSION;
        
        $result = '';
        $host = 'https://' . $_SERVER['HTTP_HOST'];
        $uri = $_SERVER['REQUEST_URI'] ?? '';
        $current_lang = substr($SESSION->lang ?? 'en', 0, 2);
        
        switch (self::getCurrentPageTemplate()) {
            case 'teacher':
                if (isset($_GET['id'])) {
                    if ($user = self::get_by_id($_GET['id'])) {
                        if ($user->profile_field_role == 'Teacher') {
                            if ($language_code = self::getCurrentTeacherLangCode()) {
                                if ($language = language::get_by_url($language_code)) {
                                    foreach (['en', 'lv', 'ru'] as $lang) {                
                                        ${'url_' . $lang} = $host . language::get_full_url($language, $lang) . '/' . $_GET['id'];
                                        $result .= '<link rel="alternate" hreflang="' . $lang . '" href="' . ${'url_' . $lang} . '" />';
                                    }
                                }
                            }
                        }
                    }
                }
                break;
            case 'teacher_list':
                if (isset($_GET['url'])) {
                    if ($language = language::get_by_url($_GET['url'])) {
                        foreach (['en', 'lv', 'ru'] as $lang) {                
                            ${'url_' . $lang} = $host . language::get_full_url($language, $lang);
                            $result .= '<link rel="alternate" hreflang="' . $lang . '" href="' . ${'url_' . $lang} . '" />';
                        }
                    }
                }                
        }
        
        if (!$result) {
            $has_current_lang = strpos($uri, "lang=$current_lang") !== false;
            $has_no_lang = strpos($uri, "lang=") === false;
            if ($has_current_lang || $has_no_lang) {
                foreach (['en', 'lv', 'ru'] as $lang) {
                    if ($has_current_lang) {
                        $lang_uri = str_replace("lang=$current_lang", "lang=$lang", $uri);
                    } elseif ($has_no_lang) {
                        $lang_uri = $uri . (strpos($uri, '&') >= 0 ? "?lang=$lang" : "&lang=$lang");
                    }                    
                    ${'url_' . $lang} = $host . $lang_uri;
                    $result .= '<link rel="alternate" hreflang="' . $lang . '" href="' . ${'url_' . $lang} . '" />';
                }
            }
        }
        if ($result && isset($url_en)) {
            $result .= '<link rel="alternate" hreflang="x-default" href="' . trim(str_replace(['&lang=en', 'lang=en'], '', $url_en), '?') . '" />';
        }
        
        return $result;
    }
/* METADATA */

    public static function getSchema() {
        switch (self::getCurrentPageTemplate()) {
            case 'home':
                return '
<script type="application/ld+json">
{
  "@context": "https://schema.org/",
  "@type": "WebSite",
  "name": "Lonet . Academy",
  "url": "https://lonet.academy/",
  "potentialAction": {
    "@type": "SearchAction",
    "target": "{search_term_string}",
    "query-input": "required name=search_term_string"
  }
}
</script>
<script type="application/ld+json">
{
  "@context": "https://schema.org/",
  "@type": "Product",
  "name": "Lonet.Academy",
  "image": "https://lonet.academy/pluginfile.php/1/core_admin/logocompact/200x75/1593553383/logo_small.png",
  "brand": "Lonet.Academy",
  "offers": {
    "@type": "AggregateOffer",
    "url": "https://lonet.academy/",
    "priceCurrency": "EUR",
    "lowPrice": "3",
    "highPrice": "50",
    "offerCount": "15"
  },
  "aggregateRating": {
    "@type": "AggregateRating",
    "ratingValue": "4.8",
    "bestRating": "5",
    "worstRating": "1",
    "ratingCount": "2"
  }
}
</script>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "EducationalOrganization",
  "name": "Lonet.Academy",
  "alternateName": "Lonet Academy",
  "url": "https://lonet.academy/",
  "logo": "https://lonet.academy/pluginfile.php/1/core_admin/logocompact/200x75/1593553383/logo_small.png",
  "sameAs": [
    "https://www.facebook.com/lonet.academy",
    "https://twitter.com/lonet_academy"
  ]
}
</script>
<script type="application/ld+json">
{
  "@context": "https://schema.org/",
  "@type": "HowTo",
  "name": "Choose a language to learn!",
  "step": [{
    "@type": "HowToStep",
    "text": "There are innumerable reasons why there is a need to learn the English language. Aside from being the largest language by a number of speakers, English also ranks number three as the most spoken native language internationally.  Learning business English has become imperative for professionals. Since it is also the language officially recognised globally in commerce, it is also the language of the internet. So, no surprise that more and more people from over the world are looking for the ways of how to learn English fast. Many people prefer to learn English online. There are several ways: you can learn English by Skype or in a webinar online classroom. Thus, every day the demand for good and professional English tutors by Skype is growing around the globe.",
    "name": "English Language",
    "url": "https://lonet.academy/language-teachers/english-tutor-online"
  },{
    "@type": "HowToStep",
    "text": "Do you want to learn Spanish language fast, easily and with the best native professional tutor online? Below you can find the most appropriate Spanish Tutor for you and learn Spanish fast without leaving you comfort zone.",
    "name": "Spanish Language",
    "url": "https://lonet.academy/language-teachers/spanish-tutors-online"
  },{
    "@type": "HowToStep",
    "text": "Lonet.Academy offers you the choice of Chinese tutors by Skype, regardless of your current language level. Improve the overall language level or certain parts of your Chinese language skills. The Chinese tutors will help you to develop your knowledge of Chinese language. Take one-on-one Chinese classes with the experienced professional Chinese tutors by Skype on Lonet.Academy.",
    "name": "Chinese Language",
    "url": "https://lonet.academy/language-teachers/chinese-tutors-by-skype"
  },{
    "@type": "HowToStep",
    "text": "Italy is one of the world’s center of history, culture, civilization and cuisine.  This is one of the main reasons why so many want to learn Italian fast and include Italian or lingua Italiana in second-language learning. Aside from being the official language of Italy and San Marino, Italian is also the third most spoken language in Switzerland. Once you know fluent Italiano, you can easily connect with the heart and soul of Italy and its fabulous history which has enriched many cultures as well.",
    "name": "Italian Language",
    "url": "https://lonet.academy/language-teachers/italian-language-tutors"
  },{
    "@type": "HowToStep",
    "text": "Are you interested to learn al-ʿArabiyyah, one of the most challenging yet extremely rewarding languages? Arabic is spoken by 422 million people across the globe making it number 5 in the rank of most spoken languages.  This Central Semitic language is the language of the Islamic sacred book, the Quran. Aside from being spoken natively by Arab speakers, this lingua franca is learned internationally as the liturgical language of Muslims. It is considered one of the most difficult languages to learn and it is quite difficult to learn Arabic fast. Nevertheless, if you choose the individual approach, then Lonet.Academy is the right place offering the best online Arabic course for Arabic learning.",
    "name": "Arabic Language",
    "url": "https://lonet.academy/language-teachers/arabic-tutors-online"
  },{
    "@type": "HowToStep",
    "text": "Russian language (русский язык) is rich in meaning and beauty. Ranked as the 8th most spoken language in the world and one of the 6 official languages of the United Nations, Russian is growing to be a must-learn for many individuals. Whether you are travelling to Russia, wanting to communicate with a Russian friend, learn a second language, or simply a lover of languages, the dilemma always lies in how to learn Russian fast and easily. Lonet.Academy provides you the opportunity to learn Russian online with the Russian tutors by Skype.",
    "name": "Russian Language",
    "url": "https://lonet.academy/language-teachers/russian-language-tutors"
  },{
    "@type": "HowToStep",
    "text": "Learning fluent Deutsch means you become one of about 280 million German language speaking people.  German is the top spoken native language in the European Union making it a primary global language. Union.  This lingua franca is part of Indo-European languages, specifically derived from the West Germanic language. No surprise that many people strive for learning German language and are looking for the ways of how to learn German fast and easily. One of the most convenient, time and money saving way of learning German is to learn German online. Lonet.Academy suggests to apply for a professional guidance and to take private lessons online with German tutors by Skype.",
    "name": "German Language",
    "url": "https://lonet.academy/language-teachers/german-language-tutors"
  },{
    "@type": "HowToStep",
    "text": "Are you thinking of being a part of the 300 million French-speaking people, otherwise known as Francophones, all over the world?  If so, you are in for a challenge of how to learn French fast.  Learning la langue française may prove to be a different experience than that of other foreign languages.  Though mastering the French language may take some time, it is worth the time and effort.",
    "name": "French Language",
    "url": "https://lonet.academy/language-teachers/french-tutors-online"
  },{
    "@type": "HowToStep",
    "text": "The Latvian language is a beautiful lingua franca that is a surviving Eastern Baltic language and the official language of Latvia. Learn Latvian with the best native Latvian tutors by Skype. Latvian is a unique language that occupies its own important place in history as it closely adheres to many original features of the Indo-European language.  Another interesting fact aside from the 1.5 million native Latvian speakers and another 100,000 based abroad, there are more non-native speakers of the language credited to immigrants which include Russians, Belarusians, and Poles – among many others.",
    "name": "Latvian Language",
    "url": "https://lonet.academy/language-teachers/latvian-tutors-online"
  },{
    "@type": "HowToStep",
    "text": "The Turkish language is a rich and historically vibrant language to learn, with over 80 million native speakers all over the world. It is now in the top 20 most spoken languages in the world. It is the mother tongue to a huge number of people in countries today, including Bosnia and Germany. Also, it is one of the official languages of Cyprus. Of course, it is mostly spoken in Turkey, but has even made its way to Asian countries. With this language growing rapidly in popularity, it&apos;s a great language to learn. At Lonet.Academy we offer you to learn Turkish with the best native Turkish tutors online.",
    "name": "Turkish Language",
    "url": "https://lonet.academy/language-teachers/turkish-language-tutors"
  },{
    "@type": "HowToStep",
    "text": "If You are on this page it means you are considering amongst the best Portuguese tutors for you. Are you interested in learning the Portuguese language? Being interested to learn a new language is easy, but when it comes to searching for the best option and tutor to learn that language, one may face a few challenges. Why not to hire a native Portuguese tutor who will help you to become a great Portuguese speaker?!",
    "name": "Portuguese Language",
    "url": "https://lonet.academy/language-teachers/portuguese-tutors-online"
  },{
    "@type": "HowToStep",
    "text": "Of course it is interesting to learn the language of the 2nd happiest country on earth as declared by the UN World Happiness Report! The Danish language or Dansk is the national language of Denmark. This Nordic country has consistently been topping the list since the 2012 inception of the report. Spoken by 6 million people, the bulk of which are in Denmark, this Germanic language of the North Germanic branch  continues to evolve by adding new words.  In fact, they have specifically created the Danish Language Council or the Dansk Sprognævn to monitor the development of the language. Many people are looking the best ways to learn Danish fast and easily. Therefore the demand for professional Danish tutors, especially for Danish tutors online, is growing every year.",
    "name": "Danish Language",
    "url": "https://lonet.academy/language-teachers/danish-tutors"
  },{
    "@type": "HowToStep",
    "text": "Did you know that Dutch is a close relative of fellow West Germanic languages English and German? The Dutch language is considered a first language to some 24 million people, with another 5 million individuals all over the globe taking it up as a second language. Aside from being the official language of the Netherlands, Dutch is also hailed as one of Belgium’s three official languages. Not surprising that there are more people every year looking for professional Dutch tutors online to learn Dutch fast and easily. At Lonet.Academy the tutors offer to learn Dutch by Skype (one-on-one Dutch classes by Skype) or in a virtual class-room on webinar platforms.",
    "name": "Dutch Language",
    "url": "https://lonet.academy/language-teachers/dutch-language-tutor"
  },{
    "@type": "HowToStep",
    "text": "Below you can find the selected Estonian tutors, who teach Estonian language online, by Skype or in a virtual classroom. Estonian is an official language of Estonia",
    "name": "Estonian Language",
    "url": "https://lonet.academy/language-teachers/estonian-language-tutor"
  },{
    "@type": "HowToStep",
    "text": "If You are on this page it means you are considering amongst the best Finnish tutors for you. Are you interested in learning the Finnish language? Being interested to learn a new language is easy, but when it comes to searching for the best option and tutor to learn that language, one may face a few challenges. Why not to hire a native Finnish tutor who will help you to become a great Finnish speaker?!",
    "name": "Finnish Language",
    "url": "https://lonet.academy/language-teachers/finnish-language-tutor"
  },{
    "@type": "HowToStep",
    "text": "Below you can find the selected Greek tutors, who teach Greek language online, by Skype or in a virtual classroom. Greek is an official language of Greece, Cyprus, and various parts of the Eastern Mediterranean and the Black Sea. It is an independent branch of the Indo-European family of languages. It is one of the ancient Indo-European languages that has been found documented for 3000 years or probably more. The Greek language holds an essential place in the history of the Western world and Christianity. It is a Hellenic language derived from Proto-Greek.  Many new English words have been coined from the Greek language. There are over 13 million native Greek speakers in today&apos;s world.",
    "name": "Greek Language",
    "url": "https://lonet.academy/language-teachers/greek-language-tutor"
  },{
    "@type": "HowToStep",
    "text": "Are an ex-pat in Indonesia? Or are you planning to visit the fourth most populous nation in the world ? Probably you are planning to travel across to the beautiful multilingual Indonesian archipelago? In any case, consider learning the Indonesian Language with the Indonesian Tutors online. Enrich your Indonesian experience and learn Bahasa Indonesia, which is the official language of the country.",
    "name": "Indonesian Language",
    "url": "https://lonet.academy/language-teachers/indonesian-tutor-online"
  },{
    "@type": "HowToStep",
    "text": "Persian is such a beautiful language! As amazing as the landscape of it’s origin – the territory of present days Iran and the motherland of ancient Persian Empire. Only in such a unique and poetic language, as Persian the most wonderful poems and literary works can be written. Knowledge of Persian language opens the door to one of the most versatile Middle Eastern cultures, its literature, history, poetry and art. And the good news is that Persian language is so easy to learn!",
    "name": "Persian Language",
    "url": "https://lonet.academy/language-teachers/persian-language-tutor"
  },{
    "@type": "HowToStep",
    "text": "Learning a new language, for example Swedish language, is a whole new adventure! It is always fun to learn something new. You get to explore a new language, understand the culture, and discover the history of the language with Swedish tutors. In today&apos;s fast-paced world, people are mostly bilingual. Are you bored of being monolingual? You can always learn a new language!",
    "name": "Swedish Language",
    "url": "https://lonet.academy/language-teachers/swedish-language-tutors"
  }]    
}
</script>
                ';
            case 'howitworks':
                return '
<script type="application/ld+json">
{
  "@context": "https://schema.org/",
  "@type": "HowTo",
  "name": "How To Find The Best Language Tutor For You",
  "description": "Here, on Lonet.Academy we truly strive for doing our best in helping the world to learn foreign languages easy, effectively and in enjoyable way. We do our best to select the experienced language tutors and to connect the language learners with language tutors around the world.",
  "image": "https://lonet.academy/pluginfile.php/1/core_admin/logocompact/200x75/1591369732/logo_small.png",
  "totalTime": "PT5M",
  "estimatedCost": {
    "@type": "MonetaryAmount",
    "currency": "EUR",
    "value": ""
  },
  "step": [{
    "@type": "HowToStep",
    "text": "Register on Lonet.Academy. Fill in all the requested fields in the registration form. Then press the button «create my new account». After it please go to your email and follow the link to confirm it",
    "image": "https://lonet.academy/pluginfile.php/70/mod_page/content/19/Screen%20Shot%20_%20time%20zone.png",
    "name": "Create your account",
    "url": "https://lonet.academy/how-it-works"
  },{
    "@type": "HowToStep",
    "text": "Log into the website by pressing the button LOG IN. To log in please use your username (the email address you registered with on Lonet.Academy) and password (that you set while creating your profile). Find the language you want to learn, select it and view the list of language tutors.",
    "image": "https://lonet.academy/pluginfile.php/70/mod_page/content/19/Screen%20Shot%20_%20view%20profile.png",
    "name": "Choose The Best Language Tutor For You",
    "url": "https://lonet.academy/how-it-works"
  },{
    "@type": "HowToStep",
    "text": "Every tutor on Lonet.Academy is independent in setting their own types of the lessons and prices. The prices differ in accordance with the type of the lesson and duration of the lesson. Every tutor sets their own prices for their lessons.",
    "image": "https://lonet.academy/pluginfile.php/70/mod_page/content/19/Screen%20Shot_%20Book%20a%20lesson.png",
    "name": "Request your trial lesson on Lonet.Academy",
    "url": "https://lonet.academy/how-it-works"
  },{
    "@type": "HowToStep",
    "text": "After you have chosen the day and time which is convenient for you and clicked on that field in the calendar, the button «confirm and go to payment» appears above the schedule and also below the schedule. You can click on either of them.",
    "image": "https://lonet.academy/pluginfile.php/70/mod_page/content/19/Screen%20Shot%20_%20confirm%20and%20go%20to%20payment.png",
    "name": "Proceed with the payment",
    "url": "https://lonet.academy/how-it-works"
  },{
    "@type": "HowToStep",
    "text": "After the payment has been made (in 24 hours processing), You will receive the requested lesson&apos;s confirmation from the tutor on your email. The tutor should confirm the requested lesson in 24 hours.Now you can contact the tutor directly, using the onsite messaging tool.",
    "image": "https://lonet.academy/blog/wp-content/uploads/2020/03/English-page-image.png",
    "name": "Take Your trial lesson with the language tutor by Skype"
  },{
    "@type": "HowToStep",
    "text": "During Your trial lesson you will be able to see and decide: If the selected Teacher meets your needs, Whether the lesson suited your expectations, Do you want to continue studies with this tutor and book next lessons with them.",
    "image": "https://lonet.academy/pluginfile.php/1/core_admin/logocompact/200x75/1591369732/logo_small.png",
    "name": "Please leave your feedback after the lesson",
    "url": "https://lonet.academy/how-it-works"
  }]
}
</script>
                ';
                break;
            case 'teacher_list':
                $result = '';
                if (isset($_GET['url'])) {
                    if ($code = language::get_code_by_url($_GET['url'])) {
                        switch ($code) {
                            case 'lv':
                                $result = '
<script type="application/ld+json">
{
  "@context": "https://schema.org/", 
  "@type": "Product", 
  "name": "Latvian language courses – private classes with native tutors by Skype. Lonet.Academy Latvian tutors online will help you to learn Latvian fast and easily!",
  "image": "https://scontent.fath3-4.fna.fbcdn.net/v/t1.0-0/p480x480/31697338_1811380002496597_560718971314110464_o.jpg?_nc_cat=100&_nc_sid=dd9801&_nc_ohc=z-ewbUDwab8AX97TPIl&_nc_ht=scontent.fath3-4.fna&_nc_tp=6&oh=773fa0fe35035a06bdbe5990175a6af3&oe=5F21DF46",
  "description": "The Latvian language is a beautiful lingua franca that is a surviving Eastern Baltic language and the official language of Latvia. Learn Latvian with the best native Latvian tutors by Skype. Latvian is a unique language that occupies its own important place in history as it closely adheres to many original features of the Indo-European language.  Another interesting fact aside from the 1.5 million native Latvian speakers and another 100,000 based abroad, there are more non-native speakers of the language credited to immigrants which include Russians, Belarusians, and Poles – among many others.",
  "brand": "Lonet.Academy",
  "offers": {
    "@type": "AggregateOffer",
    "url": "https://lonet.academy/language-teachers/latvian-tutors-online",
    "priceCurrency": "EUR",
    "lowPrice": "3",
    "highPrice": "50",
    "offerCount": "15"
  },
  "aggregateRating": {
    "@type": "AggregateRating",
    "ratingValue": "4.88",
    "bestRating": "5",
    "worstRating": "1",
    "ratingCount": "3"
  }
}
</script>
                                ';
                                break;
                            case 'en':
                                $result = '
<script type="application/ld+json">
{
    "@context": "https://schema.org/", 
    "@type": "Product", 
    "name": "Learn English online with tutors by Skype. The best English tutors at Lonet.Academy will help you to learn English fast & easily! English classes online.",
    "image": "https://lonet.academy/blog/wp-content/uploads/2019/07/xtutor2.jpg.pagespeed.ic.t7oQb8caH0.webp",
    "description": "There are innumerable reasons why there is a need to learn the English language. Aside from being the largest language by a number of speakers, English also ranks number three as the most spoken native language internationally. Learning business English has become imperative for professionals. Since it is also the language officially recognised globally in commerce, it is also the language of the internet. So, no surprise that more and more people from over the world are looking for the ways of how to learn English fast. Many people prefer to learn English online. There are several ways: you can learn English by Skype or in a webinar online classroom. Thus, every day the demand for good and professional English tutors by Skype is growing around the globe.",
    "brand": "Lonet.Academy",
    "offers": {
        "@type": "AggregateOffer",
        "url": "https://lonet.academy/language-teachers/english-tutor-online ",
        "priceCurrency": "EUR",
        "lowPrice": "3",
        "highPrice": "50",
        "offerCount": "15"
    },
    "aggregateRating": {
        "@type": "AggregateRating",
        "ratingValue": "5",
        "bestRating": "5",
        "worstRating": "1",
        "ratingCount": "11"
    }
}
</script>
                                ';
                                break;
                            case 'ar':
                                $result = '
<script type="application/ld+json">
{
  "@context": "https://schema.org/", 
  "@type": "Product", 
  "name": "Learn Arabic Fast. Best Arabic Language Tutors Online | Lonet.Academy",
  "image": "https://lonet.academy/blog/wp-content/uploads/2020/05/Quran.jpg",
  "description": "Arabic language courses - private classes with native Arabic tutors online. Lonet.Academy is the best online Arabic course for you to learn Arabic fast!",
  "brand": "Lonet.Academy",
  "offers": {
    "@type": "AggregateOffer",
    "url": "https://lonet.academy/language-teachers/arabic-tutors-online",
    "priceCurrency": "EUR",
    "lowPrice": "3",
    "highPrice": "23",
    "offerCount": "14"
  },
  "aggregateRating": {
    "@type": "AggregateRating",
    "ratingValue": "5",
    "bestRating": "5",
    "worstRating": "1",
    "ratingCount": "4"
  }
}
</script>
                                ';
                                break;
                            case 'ca':
                                $result = '
<script type="application/ld+json">
{
  "@context": "https://schema.org/", 
  "@type": "Product", 
  "name": "Learn Catalan With Best Catalan Language Tutors Online | Lonet.Academy",
  "image": "https://lonet.academy/blog/wp-content/uploads/2020/07/Catalan-.jpg",
  "description": "Catalan language online courses - private classes with native tutors. Lonet.Academy Catalan tutors online will help you to learn Catalan fast and easily!",
  "brand": "Lonet.Academy",
  "offers": {
    "@type": "AggregateOffer",
    "url": "https://lonet.academy/language-teachers/catalan-tutor",
    "priceCurrency": "EUR",
    "lowPrice": "6",
    "highPrice": "21",
    "offerCount": "1"
  },
  "aggregateRating": {
    "@type": "AggregateRating",
    "ratingValue": "5",
    "bestRating": "5",
    "worstRating": "1",
    "ratingCount": "1"
  }
}
</script>
                                ';
                                break;
                            case 'nl':
                                $result = '
<script type="application/ld+json">
{
  "@context": "https://schema.org/", 
  "@type": "Product", 
  "name": "Learn Dutch fast and easily! Best Dutch tutors online | Lonet.Academy",
  "image": "https://lonet.academy/blog/wp-content/uploads/2020/04/Dutch-language-.png",
  "description": "Learn Dutch language with tutors by Skype. The best Dutch tutors online at Lonet.Academy will help you to learn Dutch fast & easily! Dutch classes by Skype.",
  "brand": "Lonet.Academy",
  "offers": {
    "@type": "AggregateOffer",
    "url": "https://lonet.academy/language-teachers/dutch-language-tutor",
    "priceCurrency": "EUR",
    "lowPrice": "3",
    "highPrice": "38",
    "offerCount": "3"
  },
  "aggregateRating": {
    "@type": "AggregateRating",
    "ratingValue": "5",
    "bestRating": "5",
    "worstRating": "1",
    "ratingCount": "1"
  }
}
</script>
                                ';
                                break;
                            case 'et':
                                $result = '
<script type="application/ld+json">
{
  "@context": "https://schema.org/", 
  "@type": "Product", 
  "name": "Learn Estonian Fast With Best Estonian Tutors Online | Lonet.Academy",
  "image": "https://lonet.academy/blog/wp-content/uploads/2020/07/estonian.jpg",
  "description": "Learn Estonian language online - private classes with native tutors by Skype. Estonian tutors online. Learn Estonian fast and easily at Lonet.Academy!",
  "brand": "Lonet.Academy",
  "offers": {
    "@type": "AggregateOffer",
    "url": "https://lonet.academy/language-teachers/estonian-language-tutor ",
    "priceCurrency": "EUR",
    "lowPrice": "3",
    "highPrice": "28",
    "offerCount": "3"
  },
  "aggregateRating": {
    "@type": "AggregateRating",
    "ratingValue": "5",
    "bestRating": "5",
    "worstRating": "1",
    "ratingCount": "1"
  }
}
</script>
                                ';
                                break;
                            case 'zh':
                                $result = '
<script type="application/ld+json">
{
  "@context": "https://schema.org/", 
  "@type": "Product", 
  "name": "The Best Chinese Tutors On-Line | Lonet.Academy",
  "image": "https://lonet.academy/blog/wp-content/uploads/2020/07/Catalan-.jpg",
  "description": "Learn Mandarin and Cantonese with the best Chinese tutor on-line. Chinese classes by Skype. Native Chinese tutors of Mandarin and Cantonese | Lonet.Academy",
  "brand": "Lonet.Academy",
  "offers": {
    "@type": "AggregateOffer",
    "url": "https://lonet.academy/language-teachers/catalan-tutor",
    "priceCurrency": "EUR",
    "lowPrice": "9",
    "highPrice": "38",
    "offerCount": "4"
  },
  "aggregateRating": {
    "@type": "AggregateRating",
    "ratingValue": "5",
    "bestRating": "5",
    "worstRating": "1",
    "ratingCount": "1"
  }
}
</script>
                                ';
                                break;
                            case 'fr':
                                $result = '
<script type="application/ld+json">
{
  "@context": "https://schema.org/", 
  "@type": "Product", 
  "name": "Learn French fast and easily! Best French tutors online | Lonet.Academy",
  "image": "",
  "description": "Learn French language with tutors by Skype. The best French tutors at Lonet.Academy will help you how to learn French fast and easy! French classes online.",
  "brand": "Lonet.Academy",
  "offers": {
    "@type": "AggregateOffer",
    "url": "https://lonet.academy/language-teachers/french-tutors-online",
    "priceCurrency": "EUR",
    "lowPrice": "3",
    "highPrice": "50",
    "offerCount": "10"
  },
  "aggregateRating": {
    "@type": "AggregateRating",
    "ratingValue": "5",
    "bestRating": "5",
    "worstRating": "1",
    "ratingCount": "2"
  }
}
</script>
                                ';
                                break;
                            case 'it':
                                $result = '
<script type="application/ld+json">
{
  "@context": "https://schema.org/", 
  "@type": "Product", 
  "name": "How To Learn Italian Fast? - With Italian Language Tutors | Lonet.Academy",
  "image": "",
  "description": "Italian language classes by Skype with the best Italian tutors online. Lonet.Academy Italian tutors online will help you to learn Italian fast and easily!",
  "brand": "Lonet.Academy",
  "offers": {
    "@type": "AggregateOffer",
    "url": "https://lonet.academy/language-teachers/spanish-tutors-online",
    "priceCurrency": "EUR",
    "lowPrice": "3",
    "highPrice": "38",
    "offerCount": "14"
  },
  "aggregateRating": {
    "@type": "AggregateRating",
    "ratingValue": "5",
    "bestRating": "5",
    "worstRating": "1",
    "ratingCount": "5"
  }
}
</script>
                                ';
                                break;
                            case 'de':
                                $result = '
<script type="application/ld+json">
{
  "@context": "https://schema.org/", 
  "@type": "Product", 
  "name": "Learn German Fast With The Best German Tutors Online | Lonet.Academy",
  "image": "",
  "description": "Learn German language with professional German tutors by Skype. Choose the best German tutor for You at Lonet.Academy! One-on-one German classes online.",
  "brand": "Lonet.Academy",
  "offers": {
    "@type": "AggregateOffer",
    "url": "https://lonet.academy/language-teachers/german-language-tutors",
    "priceCurrency": "EUR",
    "lowPrice": "3",
    "highPrice": "38",
    "offerCount": "6"
  },
  "aggregateRating": {
    "@type": "AggregateRating",
    "ratingValue": "5",
    "bestRating": "5",
    "worstRating": "1",
    "ratingCount": "3"
  }
}
</script>
                                ';
                                break;
                            case 'ru':
                                $result = '
<script type="application/ld+json">
{
  "@context": "https://schema.org/", 
  "@type": "Product", 
  "name": "Learn Russian fast and easily! Best Russian tutors online | Lonet.Academy",
  "image": "https://lonet.academy/blog/wp-content/uploads/2020/01/8-steps-how-to-learn-russian.png",
  "description": "Learn Russian language with tutors by Skype. The best Russian tutors at Lonet.Academy will help you to learn Russian fast & easily! Learn Russian online.",
  "brand": "Lonet.Academy",
  "offers": {
    "@type": "AggregateOffer",
    "url": "https://lonet.academy/language-teachers/russian-language-tutors",
    "priceCurrency": "EUR",
    "lowPrice": "3",
    "highPrice": "21",
    "offerCount": "14"
  },
  "aggregateRating": {
    "@type": "AggregateRating",
    "ratingValue": "5",
    "bestRating": "5",
    "worstRating": "1",
    "ratingCount": "2"
  }
}
</script>
                                ';
                                break;
                            case 'es':
                                $result = '
<script type="application/ld+json">
{
  "@context": "https://schema.org/", 
  "@type": "Product", 
  "name": "How to Learn Spanish Fast? With Spanish Tutors Online | Lonet.Academy",
  "image": "https://lonet.academy/blog/wp-content/uploads/2020/07/Spanish-language-04.png",
  "description": "Spanish language individual courses - private classes with native tutors online. Spanish tutors online will help you to learn Spanish fast and easily!",
  "brand": "Lonet.Academy",
  "offers": {
    "@type": "AggregateOffer",
    "url": "https://lonet.academy/language-teachers/spanish-tutors-online",
    "priceCurrency": "EUR",
    "lowPrice": "3",
    "highPrice": "43",
    "offerCount": "14"
  },
  "aggregateRating": {
    "@type": "AggregateRating",
    "ratingValue": "5",
    "bestRating": "5",
    "worstRating": "1",
    "ratingCount": "5"
  }
}
</script>
                                ';
                                break;
                            default:
                                $result = '';
                        }
                        $result .= teacher::getSchemaBreadcrumbList($code);
                    }
                }
                $result .= '<script type="application/ld+json">{"@context":"http://schema.org","@type":"WebSite","name":"Lonet Academy","url":"https://lonet.academy/"}</script>';
                return $result;
            case 'teacher':
                if (isset($_GET['id']) && $user = self::get_by_id($_GET['id'])) {
                    if ($user->profile_field_role == 'Teacher') {
                        if ($user->id == 3) {
                            $description = 'Cambridge Certified English language teacher (ITTC in Bournemouth, UK). My initial education is Bachelor in English Philology and I am passionate about languages, linguistics, reading, and everything that is connected with language learning and teaching process. I have been teaching English by Skype for more than 3 years now. All my students (English learners) are wonderful people with diverse interests from Latvia, Russia, Switzerland, Belarus and Denmark.';
                        } else {
                            if ($description = $user->profile_field_teacherdescription['text'] ?? '') {
                                $description = strip_tags($description);
                                $description = str_replace('"', '&quot;', $description);
                                $description = preg_replace("/\r|\n/", "", $description);
                            }
                        }
                        return str_replace("'", '&apos;', '
<script type="application/ld+json">
{
  "@context": "https://schema.org/",
  "@type": "Product",
  "name": "' . fullname($user, true) . ($user->id == 3 ? ' - Online Language Tutor' : '') . '",
  "image": "https://lonet.academy/user/pix.php/' . $user->id . '/f1.jpg",
  "description": "' . $description . '",
  "brand": "Lonet Academy"
' . teacher::getAggregateOffer($user) . '
' . teacher::getAggregateRating($user) . '
' . teacher::getReview($user) . '
}
</script>
                        ');
                    }
                }
        }
        return null;
    }
}
