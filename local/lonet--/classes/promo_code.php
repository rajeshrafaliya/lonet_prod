<?php
namespace local_lonet;

defined('MOODLE_INTERNAL') || die();

class promo_code {
    public static function get_by_id($id) {
        global $DB;
        return $DB->get_record('lonet_promo_code', ['id' => $id]);
    }

    public static function get_by_code($code) {
        global $DB;
		return $DB->get_record_select('lonet_promo_code', "LOWER(code) = '" . strtolower($code) . "'");
	}
	
	public static function get_lesson_count($promo_code, $for_user = true) {
        global $DB;
		global $USER;
		$record = $DB->get_record_sql('
			SELECT COUNT(DISTINCT op.id) as `count`
			FROM {lonet_order_product} op
			LEFT JOIN {lonet_order} o ON o.id = op.orderid
			WHERE o.promocodeid = ' . $promo_code->id . ' 
				AND op.promotionapplied = 1 
				' . ($for_user ? 'AND op.studentid = ' . $USER->id : '') . '
		');
		return $record->count;
	}
	
	public static function get_amount($promo_code, $for_user = true) {
        global $DB;
		global $USER;
		$record = $DB->get_record_sql('
			SELECT SUM(DISTINCT op.discount) as `amount`
			FROM {lonet_order_product} op
			LEFT JOIN {lonet_order} o ON o.id = op.orderid
			WHERE o.promocodeid = ' . $promo_code->id . ' 
				AND op.promotionapplied = 1 
				' . ($for_user ? 'AND op.studentid = ' . $USER->id : '') . '
		');
		return $record->amount;
	}
	
	public static function is_valid($promo_code) {
		$is_valid = true;
		if (
			!$promo_code->isactive
			|| ($promo_code->validthrough && $promo_code->validthrough < time())
			|| ($promo_code->type == 'discount'
				&& (
					($promo_code->lessoncount && $promo_code->lessoncount <= self::get_lesson_count($promo_code, false))
					|| ($promo_code->lessoncountperlearner <= self::get_lesson_count($promo_code))
				)
			)
			|| ($promo_code->type == 'amount' && $promo_code->amount <= self::get_amount($promo_code))			
		) {
			$is_valid = false;
		}
		return $is_valid;
	}
	
	public static function get_available_lesson_count($promo_code) { //for current user
		$count = 0;
		if ($promo_code->type == 'discount') {
			$count = $promo_code->lessoncountperlearner - self::get_lesson_count($promo_code);
			if ($promo_code->lessoncount) {
				$count_total = $promo_code->lessoncount - self::get_lesson_count($promo_code, false);
				$count = ($count_total < $count ? $count_total : $count);
			}
		}
		return ($count < 0 ? 0 : $count);
	}
	
	public static function get_available_amount($promo_code) { //for current user
		$amount = 0;
		if ($promo_code->type == 'amount') {
			$amount = $promo_code->amount - self::get_amount($promo_code);
		}
		return ($amount < 0 ? 0 : $amount);
	}
	
    public static function has_active_codes() {
        global $DB;
		$records = $DB->get_records('lonet_promo_code', ['isactive' => 1]);
		return ($records ? true : false);
	}
    
    public static function generateGiftCard($code, $value, $expiry_date) {
        global $CFG;
        $path = "/local/lonet/gc/$code.png";
        $card = imagecreatefrompng($CFG->dirroot . '/local/lonet/pix/Gift_card_christmas.png');
        $text_color = imagecolorallocate($card,255,255,255);//106,43,5
       //$shadow_color = imagecolorallocate($card, 184, 113, 57);
        $font = $CFG->dirroot . '/local/lonet/font/giftcard.ttf';
        //imagettftext($card, 35, 0, 402, 532, $shadow_color, $font, $code);
        imagettftext($card, 35, 0, 440, 500, $text_color, $font, $code);// fontsize, X, left, top
        //imagettftext($card, 75, 0, 152, 402, $shadow_color, $font, $value);
        imagettftext($card, 50, 0, 70, 380, $text_color, $font, $value);// fontsize, X, left, top
        //imagettftext($card, 22, 0, 662, 570, $shadow_color, $font, $expiry_date);
        imagettftext($card, 25, 0, 440, 540, $text_color, $font, $expiry_date);// fontsize, X, left, top
        imagepng($card, $CFG->dirroot . $path);
        imagedestroy($card);
        return $CFG->wwwroot . $path;
    }
}
