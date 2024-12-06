<?php
namespace local_lonet;

defined('MOODLE_INTERNAL') || die();

use \core_date;
use \DateTime;

class lesson {
    public static function get_by_id($id) {
        global $DB;
        return $DB->get_record('lonet_lesson', ['id' => $id]);
    }
    public static function get_grouplesson_by_id($id) {
        global $DB;
        return $DB->get_record_sql("SELECT *, lessonname as name  FROM {lonet_group_lessons} WHERE id=".$id."");
    }
    public static function get_grouplesson_levels() {
        global $DB;
        return $DB->get_records_sql("SELECT ll.fielddata AS id, ll.fielddata AS data FROM {lonet_userdata} ll WHERE ll.fieldname='levelyouteach'");
    }   
	public static function get_grouplesson_agestudents() {
        global $DB;
        return $DB->get_records_sql("SELECT ll.fielddata AS id, ll.fielddata AS data FROM {lonet_userdata} ll WHERE ll.fieldname='studentageyouteach'");
    }
	public static function get_grouplesson_by_language($language, $page = null) {
		global $DB;
        $limit = 10;
        $offset = $page !== null && is_numeric($page) ? ($limit * $page) - $limit : 0;
		if ($language) {
			$teachers = $DB->get_records_sql('SELECT * FROM {lonet_group_lessons} WHERE isactive = 1 AND lessondate > '.time().' AND language="'.$language.'" ORDER BY lessondate ASC
                ' . ($page !== null && is_numeric($page) ? "LIMIT $limit OFFSET $offset" : '') . '
			');
		} else {
			$teachers = $DB->get_records_sql('SELECT * FROM {lonet_group_lessons} WHERE isactive = 1 AND lessondate > '.time().' ORDER BY lessondate ASC
                ' . ($page !== null && is_numeric($page) ? "LIMIT $limit OFFSET $offset" : '') . '
			');
		}
		return $teachers;
	}
	public static function get_by_teacherid($teacherid, $language = null) {
        global $DB;
		return $DB->get_records('lonet_lesson', ['teacherid' => $teacherid, 'isactive' => 1], 'istrial DESC, name ASC');
	}	
	public static function get_triallesson($teacherid) {
        global $DB;
		return $DB->get_record('lonet_lesson', ['teacherid' => $teacherid, 'istrial' => 1]);
	}
	
	public static function get_price($lesson) {
		return $lesson->price + get_config('local_lonet', 'commissionperlesson');
	}
	public static function get_grouplesson_price($lesson) {
		return $lesson->priceperperson + get_config('local_lonet', 'commissionperlesson');
	}	
	public static function get_booking_price_html($lesson, $price) {
		$html = '';
		$price_full = self::get_price($lesson);
		if ($price != $price_full) {
			$html .= "<s style=\"font-size: 0.9em;\">&euro; $price_full</s> ";
		}
		$html .= "<b>&euro;</b> $price";
		return $html;
	}
	public static function get_booking_price_html_grouplesson($lesson, $price) {
		$html = '';
		$price_full = self::get_grouplesson_price($lesson);
		if ($price != $price_full) {
			$html .= "<s style=\"font-size: 0.9em;\">&euro; $price_full</s> ";
		}
		$html .= "<b>&euro;</b> $price";
		return $html;
	}	
	public static function get_learner_lessons($lessonid) {
        global $DB;
        return $DB->get_records('lonet_order_product', ['lessonid' => $lessonid]);
	}
	//added by nitesh
	public static function get_learner_group_lessons($glessonid) {
        global $DB;
        return $DB->get_records('lonet_order_product', ['lessonid' => $glessonid, 'isgrouplesson' => 1]);
	}
	public static function count_group_lessons_members($glessonid) {
        global $DB;
        // return $DB->get_records('lonet_order_product', ['lessonid' => $glessonid, 'isgrouplesson' => 1]);
        return $DB->count_records_sql("SELECT count(studentid) FROM {lonet_order_product} WHERE lessonid=".$glessonid." AND isgrouplesson=1 AND status =1");
	}
	public static function get_grouplesson_by_teacherid($teacherid, $language = null) {
        global $DB;
		// return $DB->get_records('lonet_group_lessons', ['teacherid' => $teacherid, 'isactive' => 1], 'istrial DESC, lessonname ASC');
		if(!empty($language)){
			$sql = "SELECT * FROM {lonet_group_lessons} WHERE teacherid = ".$teacherid." AND isactive = 1 AND language = '".$language."' AND lessondate > ".time()." ORDER BY lessondate ASC LIMIT 0, 1";
		}else{
			$sql = "SELECT * FROM {lonet_group_lessons} WHERE teacherid = ".$teacherid." AND isactive = 1 AND lessondate > ".time()." ORDER BY lessondate ASC LIMIT 0, 1";
		}
		return $DB->get_records_sql($sql, []);
	}
	public static function get_grouplesson_times($glessonid) {
        global $DB;
		// $result = [];
		$record = $DB->get_record_sql('
			SELECT * FROM
			{lonet_group_lessons}
			WHERE id='.$glessonid.'');
			
			$userTimezone = \core_date::get_user_timezone_object();
			$record->timefrom = (new DateTime('now', $userTimezone))->setTimestamp($record->timefrom)->format('H:i:s');
			$record->timeto = (new DateTime('now', $userTimezone))->setTimestamp($record->timeto)->format('H:i:s');
			if ($record->timefrom > $record->timeto) { //breaking into two intervals
				if ($record->timeto > '00:29:59') {
					$result = (object) ['id' => $record->id, 'isdst' => $record->isdst, 'timefrom' => '00:00:00', 'timeto' => $record->timeto];
				}
				if ($record->timefrom < '23:29:59') {
					$result = (object) ['id' => $record->id, 'isdst' => $record->isdst, 'timefrom' => $record->timefrom, 'timeto' => '23:59:00'];
				}
			} else {
				$result = $record;
			}
		
		return $result;
	}
	public static function get_grouplesson_times_withoutsecond($glessonid) {
        global $DB;
		// $result = [];
		$record = $DB->get_record_sql('
			SELECT * FROM
			{lonet_group_lessons}
			WHERE id='.$glessonid.'');
			
        $userTimezone = \core_date::get_user_timezone_object();
			$record->timefrom = (new DateTime('now', $userTimezone))->setTimestamp($record->timefrom)->format('H:i');
			$record->timeto = (new DateTime('now', $userTimezone))->setTimestamp($record->timeto)->format('H:i');
			if ($record->timefrom > $record->timeto) { //breaking into two intervals
				if ($record->timeto > '00:29:59') {
					$result = (object) ['id' => $record->id, 'isdst' => $record->isdst, 'timefrom' => '00:00', 'timeto' => $record->timeto];
				}
				if ($record->timefrom < '23:29:59') {
					$result = (object) ['id' => $record->id, 'isdst' => $record->isdst, 'timefrom' => $record->timefrom, 'timeto' => '23:59'];
				}
			} else {
				$result = $record;
			}
		
		return $result;
	}
	public function getObjectsByLanguage($array, $language) {
		$result = array();

		foreach ($array as $key => $object) {
			if ($object->language === $language) {
				$result[$key] = $object;
			}
		}

		return $result;
	}
}
