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

	public static function get_by_language_withoutpagination($language) {
		global $DB;
       
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
				ORDER BY u.lastaccess DESC');
		} else {
			$teachers = $DB->get_records_sql('
				SELECT DISTINCT u.*
				FROM {user} u
				' . self::getTeacherListJoinCondition() . '
				LEFT JOIN {lonet_lesson} ll ON ll.teacherid = u.id
				WHERE u.deleted = 0
                    ' . self::getActiveCondition() . '
                    AND ll.id IS NOT NULL
				ORDER BY u.lastaccess DESC');
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
				AND offer = 0
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
				AND offer = 0
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
				AND offer = 0
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
	public static function get_hourly_rate_label_new($teacher) {
		$html = '';
		if ($min = self::get_hourly_rate_min($teacher)) {
			$max = self::get_hourly_rate_max($teacher);
			// $html = "<i class='fa fa-money' style='font-size:20px'></i> ".strtolower(get_string('price', 'local_lonet')) . ' ';
			$html .= '<p class="hourlyrate" data-teacherid='.$teacher->id.' data-teachermodal ="teachmodal'.$teacher->id.'">';
			$html .= get_string('price', 'local_lonet').' '.get_string('from', 'local_lonet') . '<b> &euro; ' . $min  . '</b> ' . get_string('to', 'local_lonet') . ' <b> &euro; ' . $max.'</b>';
			$html .= '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
  <path d="M14.9333 5.51667C14.8487 5.31304 14.6869 5.15123 14.4833 5.06667C14.3831 5.02397 14.2755 5.00132 14.1666 5H5.83328C5.61227 5 5.40031 5.0878 5.24403 5.24408C5.08775 5.40036 4.99995 5.61232 4.99995 5.83333C4.99995 6.05435 5.08775 6.26631 5.24403 6.42259C5.40031 6.57887 5.61227 6.66667 5.83328 6.66667H12.1583L5.24162 13.575C5.16351 13.6525 5.10151 13.7446 5.05921 13.8462C5.0169 13.9477 4.99512 14.0567 4.99512 14.1667C4.99512 14.2767 5.0169 14.3856 5.05921 14.4871C5.10151 14.5887 5.16351 14.6809 5.24162 14.7583C5.31908 14.8364 5.41125 14.8984 5.5128 14.9407C5.61435 14.983 5.72327 15.0048 5.83328 15.0048C5.94329 15.0048 6.05221 14.983 6.15376 14.9407C6.25531 14.8984 6.34748 14.8364 6.42495 14.7583L13.3333 7.84167V14.1667C13.3333 14.3877 13.4211 14.5996 13.5774 14.7559C13.7336 14.9122 13.9456 15 14.1666 15C14.3876 15 14.5996 14.9122 14.7559 14.7559C14.9122 14.5996 14.9999 14.3877 14.9999 14.1667V5.83333C14.9986 5.72444 14.976 5.61685 14.9333 5.51667Z" fill="#CE1369"/>
</svg>';
$html .= '</p>';
		}
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
	public static function render_rating_new($teacher) {
		$html = '';
		$rawrating = self::get_rating($teacher);
		$rating = number_format($rawrating,2);
		$rating = floor($rating * 10) / 10;
		$title = ($rating ? $rating : get_string('notrated', 'local_lonet'));
		$rting = ($rating > 0) ? $rating : '';
		$html = '<p class="ratingstars" title="' . $title . '">';
		$html .= '<span class="ratingnumbers">'.$rting.'</span> '.self::render_stars_new($rating);
		$html .= '</p>';
		return $html;
	}
    public static function render_stars_new($rating) {
		$html = '';
		for ($i = 1; $i <= 5; $i++) {
			//$html .= '<span class="star ' . ($rating < $i && $i - $rating > 0.5 ? 'empty' : '') . '">&starf;</span>';
			$diff = $i - $rating;
			if ($diff < 0.33) {
				$class = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
						<path d="M0.644058 8.5012C0.365072 8.22222 0.503997 7.74514 0.889147 7.65955L6.20913 6.47734C6.3487 6.44632 6.46831 6.35704 6.53774 6.23206L9.56292 0.786742C9.75342 0.443837 10.2466 0.443837 10.4371 0.786742L13.4623 6.23206C13.5317 6.35704 13.6513 6.44632 13.7909 6.47734L19.1109 7.65955C19.496 7.74514 19.6349 8.22222 19.3559 8.5012L15.1892 12.6679C15.071 12.7861 15.0197 12.9556 15.0525 13.1195L16.2391 19.0527C16.3187 19.4504 15.9164 19.7724 15.5457 19.6076L10.2031 17.2331C10.0738 17.1757 9.92621 17.1757 9.79693 17.2331L4.45425 19.6076C4.08359 19.7724 3.68134 19.4504 3.76089 19.0527L4.94752 13.1195C4.98031 12.9556 4.929 12.7861 4.81078 12.6679L0.644058 8.5012Z" fill="#CE1369" stroke="#CE1369"/>
						</svg>';

			} elseif ($diff > 0.66) {
				$class = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
					<path d="M0.644058 8.5012C0.365072 8.22222 0.503997 7.74514 0.889147 7.65955L6.20913 6.47734C6.3487 6.44632 6.46831 6.35704 6.53774 6.23206L9.56292 0.786742C9.75342 0.443837 10.2466 0.443837 10.4371 0.786742L13.4623 6.23206C13.5317 6.35704 13.6513 6.44632 13.7909 6.47734L19.1109 7.65955C19.496 7.74514 19.6349 8.22222 19.3559 8.5012L15.1892 12.6679C15.071 12.7861 15.0197 12.9556 15.0525 13.1195L16.2391 19.0527C16.3187 19.4504 15.9164 19.7724 15.5457 19.6076L10.2031 17.2331C10.0738 17.1757 9.92621 17.1757 9.79693 17.2331L4.45425 19.6076C4.08359 19.7724 3.68134 19.4504 3.76089 19.0527L4.94752 13.1195C4.98031 12.9556 4.929 12.7861 4.81078 12.6679L0.644058 8.5012Z" fill="url(#paint0_linear_1225_1546)" stroke="white"/>
					<defs>
					<linearGradient id="paint0_linear_1225_1546" x1="0.5" y1="8" x2="19.5" y2="8" gradientUnits="userSpaceOnUse">
					<stop stop-color="white"/>
					<stop offset="0.5" stop-color="white"/>
					<stop offset="0.5" stop-color="white"/>
					</linearGradient>
					</defs>
					</svg>';
			} else {
				$class = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
							<path d="M0.644058 8.5012C0.365072 8.22222 0.503997 7.74514 0.889147 7.65955L6.20913 6.47734C6.3487 6.44632 6.46831 6.35704 6.53774 6.23206L9.56292 0.786742C9.75342 0.443837 10.2466 0.443837 10.4371 0.786742L13.4623 6.23206C13.5317 6.35704 13.6513 6.44632 13.7909 6.47734L19.1109 7.65955C19.496 7.74514 19.6349 8.22222 19.3559 8.5012L15.1892 12.6679C15.071 12.7861 15.0197 12.9556 15.0525 13.1195L16.2391 19.0527C16.3187 19.4504 15.9164 19.7724 15.5457 19.6076L10.2031 17.2331C10.0738 17.1757 9.92621 17.1757 9.79693 17.2331L4.45425 19.6076C4.08359 19.7724 3.68134 19.4504 3.76089 19.0527L4.94752 13.1195C4.98031 12.9556 4.929 12.7861 4.81078 12.6679L0.644058 8.5012Z" fill="url(#paint0_linear_1225_1546)" stroke="#CE1369"/>
							<defs>
							<linearGradient id="paint0_linear_1225_1546" x1="0.5" y1="8" x2="19.5" y2="8" gradientUnits="userSpaceOnUse">
							  <stop stop-color="#CE1369"/>
							  <stop offset="0.5" stop-color="#CE1369"/>
							  <stop offset="0.5" stop-color="white"/>
							</linearGradient>
							</defs>
							</svg>';
			}
			$html .= $class;
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
					// AND ord.createdat > '. $sixmonth .'
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
			// $icon = '<span class="redm fa fa-minus-circle" tabindex="0" data-toggle="tooltip" title="'.get_string('scarcity_field_tooltip5', 'local_lonet').'" data-animation="true"></span>';
			$icon = '<span class="vmiddle" tabindex="0" data-toggle="tooltip" title="'.get_string('scarcity_field_tooltip5', 'local_lonet').'" data-animation="true"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none"><path fill-rule="evenodd" clip-rule="evenodd" d="M15 2.8125C8.26903 2.8125 2.8125 8.26903 2.8125 15C2.8125 21.731 8.26903 27.1875 15 27.1875C21.731 27.1875 27.1875 21.731 27.1875 15C27.1875 8.26903 21.731 2.8125 15 2.8125ZM12.8504 11.5246C12.4843 11.1585 11.8907 11.1585 11.5246 11.5246C11.1585 11.8907 11.1585 12.4843 11.5246 12.8504L13.6742 15L11.5246 17.1496C11.1585 17.5157 11.1585 18.1093 11.5246 18.4754C11.8907 18.8415 12.4843 18.8415 12.8504 18.4754L15 16.3258L17.1496 18.4754C17.5157 18.8415 18.1093 18.8415 18.4754 18.4754C18.8415 18.1093 18.8415 17.5157 18.4754 17.1496L16.3258 15L18.4754 12.8504C18.8415 12.4843 18.8415 11.8907 18.4754 11.5246C18.1093 11.1585 17.5157 11.1585 17.1496 11.5246L15 13.6742L12.8504 11.5246Z" fill="#DC2626"/></svg></span>';
			$tag = get_string('scarcity_field_tag5', 'local_lonet');
		}elseif($fielddata == '1'){
			// $icon = '<span class="redm fa fa-clock-o" tabindex="0" data-toggle="tooltip" title="'.get_string('scarcity_field_tooltip1', 'local_lonet').'" data-animation="true"></span>';
			$icon = '<span class="vmiddle" tabindex="0" data-toggle="tooltip" title="'.get_string('scarcity_field_tooltip1', 'local_lonet').'" data-animation="true"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none"><path fill-rule="evenodd" clip-rule="evenodd" d="M15 25.5C20.799 25.5 25.5 20.799 25.5 15C25.5 9.20101 20.799 4.5 15 4.5C9.20101 4.5 4.5 9.20101 4.5 15C4.5 20.799 9.20101 25.5 15 25.5ZM16 9.75C16 9.19772 15.5523 8.75 15 8.75C14.4477 8.75 14 9.19772 14 9.75V15C14 15.2652 14.1054 15.5196 14.2929 15.7071L18.0052 19.4194C18.3957 19.8099 19.0289 19.8099 19.4194 19.4194C19.8099 19.0289 19.8099 18.3957 19.4194 18.0052L16 14.5858V9.75Z" fill="#F59E0B"/>
			</svg></span>';
			$tag = get_string('scarcity_field_tag1', 'local_lonet');
		}elseif($fielddata == '2'){
			// $icon = '<span class="redm fa fa-clock-o" data-toggle="tooltip" title="'.get_string('scarcity_field_tooltip2', 'local_lonet').'"></span>';
			$icon = '<span class="vmiddle" data-toggle="tooltip" title="'.get_string('scarcity_field_tooltip2', 'local_lonet').'"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none"><path fill-rule="evenodd" clip-rule="evenodd" d="M15 25.5C20.799 25.5 25.5 20.799 25.5 15C25.5 9.20101 20.799 4.5 15 4.5C9.20101 4.5 4.5 9.20101 4.5 15C4.5 20.799 9.20101 25.5 15 25.5ZM16 9.75C16 9.19772 15.5523 8.75 15 8.75C14.4477 8.75 14 9.19772 14 9.75V15C14 15.2652 14.1054 15.5196 14.2929 15.7071L18.0052 19.4194C18.3957 19.8099 19.0289 19.8099 19.4194 19.4194C19.8099 19.0289 19.8099 18.3957 19.4194 18.0052L16 14.5858V9.75Z" fill="#F59E0B"/>
			</svg></span>';
			$tag = get_string('scarcity_field_tag2', 'local_lonet');
		}elseif($fielddata == '3'){
			// $icon = '<span class="redm fa fa-clock-o" data-toggle="tooltip" title="'.get_string('scarcity_field_tooltip3', 'local_lonet').'"></span>';
			$icon = '<span class="vmiddle" data-toggle="tooltip" title="'.get_string('scarcity_field_tooltip3', 'local_lonet').'"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none"><path fill-rule="evenodd" clip-rule="evenodd" d="M15 25.5C20.799 25.5 25.5 20.799 25.5 15C25.5 9.20101 20.799 4.5 15 4.5C9.20101 4.5 4.5 9.20101 4.5 15C4.5 20.799 9.20101 25.5 15 25.5ZM16 9.75C16 9.19772 15.5523 8.75 15 8.75C14.4477 8.75 14 9.19772 14 9.75V15C14 15.2652 14.1054 15.5196 14.2929 15.7071L18.0052 19.4194C18.3957 19.8099 19.0289 19.8099 19.4194 19.4194C19.8099 19.0289 19.8099 18.3957 19.4194 18.0052L16 14.5858V9.75Z" fill="#F59E0B"/>
			</svg></span>';
			$tag = get_string('scarcity_field_tag3', 'local_lonet');
		}elseif($fielddata == '4'){
			// $icon = '<span class="greenm fa fa-check-circle" data-toggle="tooltip" title="'.get_string('scarcity_field_tooltip4', 'local_lonet').'"></span>';
			$icon = '<span class="vmiddle" data-toggle="tooltip" title="'.get_string('scarcity_field_tooltip4', 'local_lonet').'"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none"><path fill-rule="evenodd" clip-rule="evenodd" d="M15 25.5C20.799 25.5 25.5 20.799 25.5 15C25.5 9.20101 20.799 4.5 15 4.5C9.20101 4.5 4.5 9.20101 4.5 15C4.5 20.799 9.20101 25.5 15 25.5ZM19.8656 13.3031C20.3781 12.7905 20.3781 11.9595 19.8656 11.4469C19.353 10.9344 18.522 10.9344 18.0094 11.4469L13.6875 15.7688L11.9906 14.0719C11.478 13.5594 10.647 13.5594 10.1344 14.0719C9.62186 14.5845 9.62186 15.4155 10.1344 15.9281L12.7594 18.5531C13.272 19.0656 14.103 19.0656 14.6156 18.5531L19.8656 13.3031Z" fill="#16A34A"/></svg></span>';
			$tag = get_string('scarcity_field_tag4', 'local_lonet');
		}

		$html .= '<p class="placesleft">'.$icon .' '.$tag.'</p>';
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
