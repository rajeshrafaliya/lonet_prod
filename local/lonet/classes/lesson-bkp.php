<?php
namespace local_lonet;

defined('MOODLE_INTERNAL') || die();

class lesson {
    public static function get_by_id($id) {
        global $DB;
        return $DB->get_record('lonet_lesson', ['id' => $id]);
    }

	public static function get_by_teacherid($teacherid, $language = null) {
        global $DB;
		return $DB->get_records('lonet_lesson', ['teacherid' => $teacherid, 'isactive' => 1], 'istrial DESC, name ASC');
		/*
		return $DB->get_records_sql('
			SELECT *
			FROM {lonet_lesson}
			WHERE teacherid = ' . $teacherid . '
				AND isactive = 1
				' . ($language ? 'AND (language = \'' . $language . '\' OR language IS NULL OR language = \'\')' : '') . '
			ORDER BY istrial DESC, name ASC
		');
		*/
	}
		
	public static function get_triallesson($teacherid) {
        global $DB;
		return $DB->get_record('lonet_lesson', ['teacherid' => $teacherid, 'istrial' => 1]);
	}
	
	public static function get_price($lesson) {
		return $lesson->price + get_config('local_lonet', 'commissionperlesson');
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
	
	public static function get_learner_lessons($lessonid) {
        global $DB;
        return $DB->get_records('lonet_order_product', ['lessonid' => $lessonid]);
	}
}
