<?php
namespace local_lonet;

use \core_date;

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot.'/user/profile/lib.php');

class teacher {
	public static function get_by_language($language, $page = null) {
		global $DB;
        $limit = 10;
        $offset = $page !== null && is_numeric($page) ? ($limit * $page) - $limit : 0;
		if ($language) {
			$teachers = $DB->get_records_sql('
				SELECT DISTINCT u.*
				FROM {user} u
                ' . self::getTeacherListJoinCondition() . '
				LEFT JOIN {user_info_data} uid_langs ON uid_langs.userid = u.id AND uid_langs.fieldid = 10
				LEFT JOIN {lonet_lesson} ll ON ll.teacherid = u.id
				WHERE u.deleted = 0
                    ' . self::getActiveCondition() . '
                    AND ll.id IS NOT NULL
                    AND uid_langs.data LIKE \'%' . $language . '%\'
				ORDER BY u.lastaccess DESC
                ' . ($page !== null && is_numeric($page) ? "LIMIT $limit OFFSET $offset" : '') . '
			');
		} else {
			$teachers = $DB->get_records_sql('
				SELECT DISTINCT u.*
				FROM {user} u
				' . self::getTeacherListJoinCondition() . '
				LEFT JOIN {lonet_lesson} ll ON ll.teacherid = u.id
				WHERE u.deleted = 0
                    ' . self::getActiveCondition() . '
                    AND ll.id IS NOT NULL
				ORDER BY u.lastaccess DESC
                ' . ($page !== null && is_numeric($page) ? "LIMIT $limit OFFSET $offset" : '') . '
			');
		}
		foreach ($teachers as $teacher) {
			profile_load_data($teacher);
		}
		return $teachers;
	}
    
    public static function getTeacherListJoinCondition() {
        return '
            LEFT JOIN {role_assignments} ra ON ra.userid = u.id AND ra.roleid = 3
            LEFT JOIN {user_info_data} uid ON uid.userid = u.id AND uid.fieldid = 6
            LEFT JOIN {user_info_data} uid_interview ON uid_interview.userid = u.id AND uid_interview.fieldid = 23
            LEFT JOIN {user_info_data} uid_lecture ON uid_lecture.userid = u.id AND uid_lecture.fieldid = 24
            LEFT JOIN {user_preferences} up ON up.userid = u.id AND up.name = \'teacher_declinetime\'
        ';
    }
    
    public static function getNewCondition() {
        return '
            AND u.deleted = 0
            AND uid.data = \'Teacher\'
            AND (up.id IS NULL OR up.value < u.timemodified)
            AND (uid_interview.id IS NULL OR uid_interview.data <> 1 OR uid_lecture.id IS NULL OR uid_lecture.data <> 1)
        ';
    }
    
    public static function getActiveCondition() {
        return '
            AND u.deleted = 0
            AND uid.data = \'Teacher\'
            AND ra.id IS NOT NULL
            AND (uid_interview.id IS NOT NULL AND uid_interview.data = 1)
            AND (uid_lecture.id IS NOT NULL AND uid_lecture.data = 1)
        ';
    }
    
    public static function getInactiveCondition() {
        return '
            AND uid.data = \'Teacher\'
            AND ra.id IS NULL
            AND (uid_interview.id IS NOT NULL AND uid_interview.data = 1)
            AND (uid_lecture.id IS NOT NULL AND uid_lecture.data = 1)
        ';
    }
	
	public static function get_new() {
		global $DB;
		return $DB->get_records_sql('
            SELECT u.*, uh.id `changedat`, ra.id `isconfirmedteacher`
            FROM {user} u
            ' . self::getTeacherListJoinCondition() . '
            LEFT JOIN {lonet_user_history} uh ON uh.userid = u.id AND uh.seenat IS NULL
            WHERE u.deleted = 0
                ' . self::getNewCondition() . '
            ORDER BY uh.createdat DESC, u.timemodified DESC
        ');
	}
	public static function get_active() {
		global $DB;
		return $DB->get_records_sql('
            SELECT u.*, uh.id `changedat`, ra.id `isconfirmedteacher`
			FROM {user} u
            ' . self::getTeacherListJoinCondition() . '
            LEFT JOIN {lonet_user_history} uh ON uh.userid = u.id AND uh.seenat IS NULL
			WHERE u.deleted = 0
                ' . self::getActiveCondition() . '
            ORDER BY uh.createdat DESC, u.timecreated DESC
		');
	}
    public static function get_inactive() {
		global $DB;
		return $DB->get_records_sql('
            SELECT u.*, uh.id `changedat`, ra.id `isconfirmedteacher`
			FROM {user} u
            ' . self::getTeacherListJoinCondition() . '
            LEFT JOIN {lonet_user_history} uh ON uh.userid = u.id AND uh.seenat IS NULL
			WHERE u.deleted = 0
                ' . self::getInactiveCondition() . '
            ORDER BY uh.createdat DESC, u.timecreated DESC
		');
    }
	public static function get_changed($type = 'all') {
		global $DB;
        switch ($type) {
            case 'all':
                return $DB->get_records_sql('
                    SELECT u.*
                    FROM {user} u
                    LEFT JOIN {user_info_data} uid ON uid.userid = u.id AND uid.fieldid = 6
                    LEFT JOIN {lonet_user_history} uh ON uh.userid = u.id
                    WHERE uid.data = \'Teacher\'
                        AND uh.id IS NOT NULL
                        AND uh.seenat IS NULL
                    ORDER BY u.timecreated DESC
                ');
            case 'new':
                return $DB->get_records_sql('
                    SELECT u.*
                    FROM {user} u
                    ' . self::getTeacherListJoinCondition() . '
                    LEFT JOIN {lonet_user_history} uh ON uh.userid = u.id
                    WHERE uh.id IS NOT NULL
                        AND uh.seenat IS NULL
                        ' . self::getNewCondition() . '
                    ORDER BY u.timecreated DESC
                ');
            case 'active':
                return $DB->get_records_sql('
                    SELECT u.*
                    FROM {user} u
                    ' . self::getTeacherListJoinCondition() . '
                    LEFT JOIN {lonet_user_history} uh ON uh.userid = u.id
                    WHERE uh.id IS NOT NULL
                        AND uh.seenat IS NULL
                        ' . self::getActiveCondition() . '
                    ORDER BY u.timecreated DESC
                ');
        }
	}
    
    public static function getSchemaBreadcrumbList($language) {
        global $CFG;
        $data = [
            "@context" => "https://schema.org/", 
            "@type" => "BreadcrumbList", 
            "itemListElement" => []
        ];
        $lang_url = language::get_full_url_by_code($language);
        $i = 1;
        foreach (self::get_by_language($language) as $teacher) {
            $data['itemListElement'][] = [
                "@type" => "ListItem", 
                "position" => $i++, 
                "name" => fullname($teacher, true),
                "item" => $CFG->wwwroot . $lang_url . '/' . $teacher->id
            ];
        }        
        return '<script type="application/ld+json">' . json_encode($data) . '</script>';
    }
	
	public static function get_languages($teacherid) {
		global $DB;
		$languages = [];
		if ($teacher = $DB->get_record('user', ['id' => $teacherid])) {
			profile_load_data($teacher);
			$languages = user::get_languages_from_data($teacher->profile_field_languagesteaching, true);
		}
		return $languages;
	}
	
	public static function get_trial_price($teacher) {
		$price = get_config('local_lonet', 'commissionperlesson');
		if ($triallesson = lesson::get_triallesson($teacher->id)) {
			$price += $triallesson->price;
		}
		return $price;
	}
	
	public static function get_hourly_rate($teacher) {
		global $DB;
		$record = $DB->get_record_sql('
			SELECT AVG(l.price) as `price`
			FROM {lonet_lesson} l
			WHERE l.teacherid = ' . $teacher->id . '
                AND isactive = 1
		');
		return ($record ? $record->price + get_config('local_lonet', 'commissionperlesson') : false);
	}
	public static function get_hourly_rate_min($teacher) {
		global $DB;
		$record = $DB->get_record_sql('
			SELECT MIN(l.price) as `price`
			FROM {lonet_lesson} l
			WHERE l.teacherid = ' . $teacher->id . '
                AND isactive = 1
		');
		return ($record ? $record->price + get_config('local_lonet', 'commissionperlesson') : false);
	}
	public static function get_hourly_rate_max($teacher) {
		global $DB;
		$record = $DB->get_record_sql('
			SELECT MAX(l.price) as `price`
			FROM {lonet_lesson} l
			WHERE l.teacherid = ' . $teacher->id . '
                AND isactive = 1
		');
		return ($record ? $record->price + get_config('local_lonet', 'commissionperlesson') : false);
	}
	public static function get_hourly_rate_label($teacher) {
		$html = '';
		if ($min = self::get_hourly_rate_min($teacher)) {
			// $max = self::get_hourly_rate_max($teacher);
			$html = "<i class='fa fa-money' style='font-size:20px'></i> ".strtolower(get_string('price', 'local_lonet')) . ' ';
			// if ($min == $max) {
				// $html .= '&euro;' . $min;
			// } else {
				$html .= get_string('from', 'local_lonet') . ' &euro;' . $min; // . ' ' . get_string('to', 'local_lonet') . ' &euro;' . $max;
			// }
		}
		// if ($trialprice = self::get_trial_price($teacher)) {
			// $html .= '<br>&euro;' . $trialprice . ' ' . get_string('fortrial', 'local_lonet');
		// }
		return $html;
	}
	
	public static function get_student_count($teacher) {
		global $DB;
		$record = $DB->get_record_sql('
			SELECT COUNT(DISTINCT u.id) as `count`
			FROM {lonet_order_product} ss
			LEFT JOIN {user} u ON u.id = ss.studentid
			WHERE ss.teacherid = ' . $teacher->id . '
			AND ss.endtime < NOW()
            AND ss.status = ' . order_product::STATUS_COMPLETED . '
		');
		return $record->count;
	}
	
	public static function get_lesson_count($teacher) {
		global $DB;
		$record = $DB->get_record_sql('
			SELECT COUNT(DISTINCT ss.id) as `count`
			FROM {lonet_order_product} ss
			WHERE ss.teacherid = ' . $teacher->id . '
			AND ss.endtime < NOW()
            AND ss.status = ' . order_product::STATUS_COMPLETED . '
		');
		return $record->count;
	}
	
	public static function get_rating_count($teacher) {
		global $DB;
		$record = $DB->get_record_sql('
			SELECT COUNT(op.rating) as `count`
			FROM {lonet_order_product} op
			WHERE op.teacherid = ' . $teacher->id . '
				AND op.rating IS NOT NULL
				AND op.rating > 0
			GROUP BY op.teacherid
		');
		return ($record ? $record->count : null);
	}

	public static function get_rating($teacher) {
		global $DB;
		$rating = $DB->get_record_sql('
			SELECT ROUND(SUM(op.rating)/COUNT(op.rating),2) as `rating`
			FROM {lonet_order_product} op
			WHERE op.teacherid = ' . $teacher->id . '
				AND op.rating IS NOT NULL
				AND op.rating > 0
			GROUP BY op.teacherid
		');
		return ($rating ? $rating->rating : 0);
	}
	
	public static function render_rating($teacher) {
		$html = '';
		$rating = self::get_rating($teacher);
		$title = ($rating ? $rating : get_string('notrated', 'local_lonet'));
		$html = '<p title="' . $title . '">';
		$html .= self::render_stars($rating);
		$html .= '</p>';
		return $html;
	}
	public static function render_stars($rating) {
		$html = '';
		for ($i = 1; $i <= 5; $i++) {
			//$html .= '<span class="star ' . ($rating < $i && $i - $rating > 0.5 ? 'empty' : '') . '">&starf;</span>';
			$diff = $i - $rating;
			if ($diff < 0.33) {
				$class = 'star';
			} elseif ($diff > 0.66) {
				$class = 'star-o';
			} else {
				$class = 'star-half-o';
			}
			$html .= '<span class="star fa fa-' . $class . '"></span>';
		}
		return $html;
	}
    
    public static function getAggregateOffer($teacher) {
		global $DB;
		$record = $DB->get_record_sql('
			SELECT
                MIN(l.price) as `min`,
                MAX(l.price) as `max`,
                COUNT(l.id) as `count`
			FROM {lonet_lesson} l
			WHERE l.teacherid = ' . $teacher->id . '
                AND isactive = 1
		');
        $commission = get_config('local_lonet', 'commissionperlesson');
        if (!$record || !$record->count) {
            return '';
        }
        return ',
  "offers": {
    "@type": "AggregateOffer",
    "url": "' . user::getCurrentUrl() . '",
    "priceCurrency": "EUR",
    "lowPrice": "' . ($record->min + $commission) . '",
    "highPrice": "' . ($record->max + $commission) . '",
    "offerCount": "' . $record->count . '"
  }
        ';
    }
    public static function getAggregateRating($teacher) {
		global $DB;
		$record = $DB->get_record_sql('
			SELECT
				ROUND(AVG(op.rating)) AS `avg`,
				COUNT(op.rating) AS `count`
			FROM {lonet_order_product} op
			WHERE op.teacherid = ' . $teacher->id . '
				AND op.rating IS NOT NULL
				AND op.rating > 0
		');
        if (!$record || !$record->count) {
            return '';
        }
        return ',
  "aggregateRating": {
    "@type": "AggregateRating",
    "ratingValue": "' . $record->avg . '",
    "bestRating": "5",
    "worstRating": "1",
    "ratingCount": "' . $record->count . '",
    "reviewCount": "1"
  }
        ';
    }
    public static function getReview($teacher) {
		global $DB;
        $result = '';
		$records = self::getFeaturedReviews($teacher);
        if (!$records) {
            return '';
        }
        $result = ',"review": [';
        foreach ($records as $record) {
            $student = user::get_by_id($record->studentid);
            $name = $student->firstname . ($student->lastname ? ' ' . substr($student->lastname, 0, 1) . '.' : '');
            $result .= '{
    "@type": "Review",
    "name": "' . $name . '",
    "reviewBody": "' . preg_replace("/\r|\n/", "", str_replace('"', '&quot;', $record->comment)) . '",
    "reviewRating": {
      "@type": "Rating",
      "ratingValue": "' . $record->rating . '",
      "bestRating": "5",
      "worstRating": "1"
    },
    "datePublished": "' . date('Y-m-d', $record->starttime) . '",
    "author": {"@type": "Person", "name": "' . $name . '"},
    "publisher": {"@type": "Organization", "name": "' . $name . '"}
            },';
        }
        $result = rtrim($result, ',');
        $result .= ']';
        return $result;
    }
    
    public static function getFeaturedReviews($teacher) {
		global $DB;
        return $DB->get_records_sql('
            SELECT op.starttime, op.studentid, op.rating, op.comment
            FROM {lonet_order_product} op
            WHERE op.teacherid = ' . $teacher->id . '
                AND op.rating = 5
                AND op.comment IS NOT NULL
                AND op.comment <> \'\'
            ORDER BY op.starttime ASC
        ');
    }
	
	public static function get_reviews($teacherid) {
		global $DB;
		return $DB->get_records_sql('
			SELECT op.id `id`, 
				op.rating `rating`,
				op.comment `comment`,
				CONCAT(u.firstname, \' \', LEFT(u.lastname, 1), \'.\') `author`,
				op.starttime `date`,
				u.id `authorid`
			FROM {lonet_order_product} op
			LEFT JOIN {user} u ON u.id = op.studentid
			WHERE op.teacherid = ' . $teacherid . '
				AND op.rating > 0
                AND (
                    (op.comment IS NOT NULL AND op.comment <> \'\')
                    OR (
                        (op.comment IS NULL OR op.comment = \'\')
                        AND NOT EXISTS (
                            SELECT op2.id
                            FROM {lonet_order_product} op2
                            WHERE op2.studentid = op.studentid
                                AND op2.teacherid = op.teacherid
                                AND op2.comment IS NOT NULL
                                AND op2.comment <> \'\'
                            LIMIT 1
                        )
                        /*
                        AND op.id = (
                            SELECT op3.id
                            FROM {lonet_order_product} op3
                            WHERE op3.studentid = op.studentid
                                AND op3.teacherid = op.teacherid
                                AND (op3.comment IS NULL OR op3.comment = \'\')
                            ORDER BY op3.starttime DESC
                            LIMIT 1
                        )
                        */
                    )
                )
            GROUP BY op.comment, op.studentid
			ORDER BY op.starttime DESC
		');
	}
    
	public static function get_acceptance_rate($teacherid) {
		global $DB;
		$rate = 100;
		$all_lessons = $DB->get_record_sql('
			SELECT COUNT(op.id) `count`
			FROM {lonet_order_product} op
			WHERE op.teacherid = ' . $teacherid . '
		');
		if ($all_lessons->count) {
			$accepted_lessons = $DB->get_record_sql('
				SELECT COUNT(op.id) `count`
				FROM {lonet_order_product} op
				WHERE op.teacherid = ' . $teacherid . '
					AND (op.cancellerid IS NULL OR op.cancellerid <> ' . $teacherid . ')
			');
			$rate = round(($accepted_lessons->count / $all_lessons->count) * 100);
		}
		return $rate;
	}
	
	public static function get_payout_request($teacherid) {
		global $DB;
		return $DB->get_record_select('lonet_payout_request',  'teacherid = ' . $teacherid . ' AND paidat IS NULL');
	}

	public static function get_payout_count($teacherid) {
		global $DB;
		$record = $DB->get_record_sql('
				SELECT COUNT(distinct(teacherid)) as `count` 
				FROM {lonet_payout_request} 
				WHERE teacherid = ' . $teacherid . ' AND MONTH(FROM_UNIXTIME(createdat, "%Y-%m-%d %h:%i:%s")) = MONTH(CURRENT_DATE())
				AND YEAR(FROM_UNIXTIME(createdat, "%Y-%m-%d %h:%i:%s")) = YEAR(CURRENT_DATE())
			');
		return $record->count;
	}
	
    public static function get_user_status() {
        return 'INNER JOIN {user} u ON u.id = t.teacherid AND u.deleted = 0 AND u.suspended = 0';
    }

	public static function get_relatedteachers($userid,$languages = null) {
		global $DB;
		$sql = '
				SELECT t.teacherid,"bookagain" AS buttonname 
				FROM {lonet_order_product} t
				' . self::get_user_status() . '
				' . self::getTeacherListJoinCondition() . '
				WHERE t.STATUS=' . order_product::STATUS_COMPLETED . ' and t.studentid = ' . $userid . '
				' . self::getActiveCondition() . '
				GROUP BY t.teacherid
				ORDER BY COUNT(t.id) DESC,t.starttime DESC
				LIMIT 3';

		$records_bookagain = $DB->get_records_sql($sql);

		$sql = 'SELECT t.teacherid,"recommended" AS buttonname 
				FROM {lonet_order_product} t 
				' . self::get_user_status() . '
				' . self::getTeacherListJoinCondition() . '
				WHERE t.endtime < NOW() 
				' . self::getActiveCondition() . '
				AND t.status = '. order_product::STATUS_COMPLETED . '
				AND t.LANGUAGE IN (
					SELECT IFNULL(l.code,"") AS language
					FROM {user} u1
					LEFT JOIN {user_info_data} uid1 ON uid1.userid = u1.id AND uid1.fieldid = 30
					LEFT JOIN {lonet_language} l ON l.name = uid1.data AND l.isactive = 1
					WHERE u1.id = ' . $userid . '
					)
				GROUP BY t.teacherid 
				ORDER BY COUNT(DISTINCT t.id) DESC 
				LIMIT 3';
//echo $sql;
		$records_recommended = $DB->get_records_sql($sql);/*'SELECT t.userid AS teacherid, "recommended" AS buttonname FROM {lonet_user_badge} t INNER JOIN {user} u ON u.id = t.userid AND u.deleted = 0 AND u.suspended = 0 WHERE t.isactive = 1 AND t.LANGUAGE IN ('.$languages.')'*/

		$sql = 'SELECT t.teacherid,"mostbooked" AS buttonname 
				FROM {lonet_order_product} t 
				' . self::get_user_status() . '
				' . self::getTeacherListJoinCondition() . '
				WHERE t.endtime < NOW() 
				' . self::getActiveCondition() . '
				AND t.status = '. order_product::STATUS_COMPLETED;
			
		if(!empty($languages))
				$sql .= " AND t.LANGUAGE IN (".$languages.")";
		$sql .= ' GROUP BY t.teacherid 
		ORDER BY COUNT(DISTINCT t.id) DESC 
		LIMIT 3';
//echo $languages."RAJESH".$sql;
		$records_mostbooked = $DB->get_records_sql($sql);

		$array_merge = array_merge($records_bookagain,$records_mostbooked,$records_recommended);
		$data= json_decode( json_encode($array_merge), true);
		$tempArr = array_unique(array_column($data, 'teacherid'));
		$array_unique = array_intersect_key($data, $tempArr);
		$sliced_array = array_slice($array_unique, 0, 3);
		return $sliced_array;
	}

	public static function get_pending_payout_request_amount($teacherid) {
		global $DB;
		//Modified by Nitesh
		$amount = 0;
		$sixmonth = strtotime('-180 days');
		$payout_request = self::get_payout_request($teacherid);
		if ($payout_request && $payout_request->isconfirmed) {
			// $lessons = $DB->get_records('lonet_order_product', ['payoutrequestid' => $payout_request->id]);
			$lessons = $DB->get_records_sql('
				SELECT op.*
				FROM {lonet_order_product} op
				INNER JOIN {lonet_order} ord ON ord.id = op.orderid
				WHERE op.payoutrequestid = '. $payout_request->id .'
					AND op.starttime > '. $sixmonth .'
			');
			foreach ($lessons as $lesson) {
				$amount += $lesson->payoutamount;
			}
		}
		return ($amount ? number_format($amount, 2) : 0);
	}
	
	public static function get_payout_balance($userid) {
		global $DB;
		$lost = $DB->get_record_sql('
			SELECT SUM(op.commission) `balance`
			FROM {lonet_order_product} op
			WHERE op.teacherid = ' . $userid . '
				AND op.payoutrequestid IS NULL
				AND (
					(
						op.status = ' . order_product::STATUS_CANCELED . '
						AND op.cancellerid = op.teacherid
						AND op.canceltime > op.starttime - 43200
					)
					OR
					(
						op.status = ' . order_product::STATUS_NOTCOMPLETED . '
						AND op.teachernotcompletereason <> \'Learner didn\\\'t show up.\'
					)
				)
		');
		$earned = $DB->get_record_sql('
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
				)
		');
		return $earned->balance - $lost->balance;
	}
	
	public static function can_request_payout($teacher) {
		global $USER;
		if ($teacher->id == $USER->id && user::is_teacher($teacher)) {						
			//$day = (new \DateTime('now', core_date::get_user_timezone_object($teacher)))->format('j');
			//return ($day <= 5 && !self::get_payout_request($teacher->id) && self::get_payout_balance($teacher->id) >= get_config('local_lonet', 'minpayoutamount'));
			$payout_request = self::get_payout_request($teacher->id);
			return (user::get_available_balance($teacher->id) > 0 && (!$payout_request || !$payout_request->isconfirmed));
		}
		return false;
	}
	
	public static function get_lessons_for_payout($teacherid) {
		global $DB;
		$sixmonth = strtotime('-180 days');//added by Nitesh
		return $DB->get_records_sql('
			SELECT op.*
			FROM {lonet_order_product} op
			INNER JOIN {lonet_order} ord ON ord.id = op.orderid
			WHERE op.teacherid = ' . $teacherid . '
				AND op.payoutrequestid IS NULL
				AND op.status IN (' . order_product::STATUS_COMPLETED . ', ' . order_product::STATUS_NOTCOMPLETED . ', ' . order_product::STATUS_CANCELED . ')
				AND ord.createdat > '. $sixmonth .'
		');
	}
    
    public static function getVideoUrlLabel($teacher) {
        $length = 25;
        $label = $teacher->profile_field_videourl;
        if ($label) {
            if (strlen($label) >= $length) {
                $label = substr($label, 0, $length) . '...';
            }
        }
        return $label;
    }
    public static function scarcityfeature($teacher) {
		$html = '';
		$fielddata = user::get_userdata($teacher->id,'scarcityfeature');
		if($fielddata == '5'){
			$icon = '<span class="redm fa fa-minus-circle" tabindex="0" data-toggle="tooltip" title="'.get_string('scarcity_field_tooltip5', 'local_lonet').'" data-animation="true"></span>';
			$tag = get_string('scarcity_field_tag5', 'local_lonet');
		}elseif($fielddata == '1'){
			$icon = '<span class="redm fa fa-clock-o" tabindex="0" data-toggle="tooltip" title="'.get_string('scarcity_field_tooltip1', 'local_lonet').'" data-animation="true"></span>';
			$tag = get_string('scarcity_field_tag1', 'local_lonet');
		}elseif($fielddata == '2'){
			$icon = '<span class="redm fa fa-clock-o" data-toggle="tooltip" title="'.get_string('scarcity_field_tooltip2', 'local_lonet').'"></span>';
			$tag = get_string('scarcity_field_tag2', 'local_lonet');
		}elseif($fielddata == '3'){
			$icon = '<span class="redm fa fa-clock-o" data-toggle="tooltip" title="'.get_string('scarcity_field_tooltip3', 'local_lonet').'"></span>';
			$tag = get_string('scarcity_field_tag3', 'local_lonet');
		}elseif($fielddata == '4'){
			$icon = '<span class="greenm fa fa-check-circle" data-toggle="tooltip" title="'.get_string('scarcity_field_tooltip4', 'local_lonet').'"></span>';
			$tag = get_string('scarcity_field_tag4', 'local_lonet');
		}

		$html .= '<p><b>'.$icon .' '.$tag.'</b></p>';
		return $html;
	}
	public static function set_teacherdata_in_html($data, $string,$style,$icon=null) {
		global $DB;
		if ($data) {
			$html = '<div '.$style.'>';
			$html .= $icon.' '.get_string($string, 'local_lonet').'';
			$html .= '<ul style="font-weight:100">';
			foreach($data as $value) {
					$html .= '<li>'.$value.'</li>';
				}
			$html .= '</ul></div>';
			return $html;
			}
	}
}
