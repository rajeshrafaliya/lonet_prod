<?php
namespace local_lonet;

use \core_date;
use \DateTime;

defined('MOODLE_INTERNAL') || die();

class payout_request {
    const TYPE_ACCOUNT = 'account';
    const TYPE_PAYPAL = 'paypal';
    
    public static function getWithdrawalOptions() {
        $options = [];
        foreach ([self::TYPE_ACCOUNT, self::TYPE_PAYPAL] as $option) {
            $options[$option] = get_string('withdrawaltype' . $option, 'local_lonet');
        }
        return $options;
    }
    
	public static function get_reference($request) {
		return $request->id . '-' . (new DateTime('now', core_date::get_user_timezone_object()))->setTimestamp($request->createdat)->format('dmY');
	}
	
	public static function get_amount($data) {
		global $DB;
		$result = 0;
		if ($data) {
			$sql = 'SELECT * FROM {lonet_order_product} WHERE id IN (';
			$ids = '';
			foreach ($data as $id) {
				$ids .= ($ids ? ', ' : '') . $id;
			}
			$sql .= $ids . ')';
			$records = $DB->get_records_sql($sql);
			foreach ($records as $record) {
				$result += order_product::get_payout_amount($record);
			}
		}
		return $result;
	}
	
	public static function get_account_attributes() {
		return [
			'accountbank' => 'required data-required style="width: 90%;"',
			'accountnumber' => 'required data-required style="width: 90%;"',
			'accountswift' => 'style="width: 45%;"',
		];
	}
	public static function get_paypal_attributes() {
		return [
			'paypalemail' => 'data-required style="width: 90%;"',
		];
	}
    public static function get_request_attributes() {
		return [
			'withdrawaltype' => 'required style="width: 45%;"',
		]; 
    }
    public static function get_user_attributes() {
		return [
			'accountname' => 'required style="width: 90%;"',
			'accountaddress' => 'required style="width: 90%;"',
			'accountcountry' => 'required style="width: 45%;"',
			'iknumber' => 'style="width: 45%;"'
		]; 
    }
    public static function get_required_attributes() {
		return array_merge(self::get_request_attributes(), self::get_user_attributes());        
    }
    
    public static function get_all_attributes() {
		return array_merge(
            self::get_required_attributes(),
            self::get_account_attributes(),
            self::get_paypal_attributes()
        );     
    }
	
	public static function get_data_model($teacherid) {
		global $DB;
		global $USER;
		$model = $DB->get_record_sql('
			SELECT * FROM {lonet_payout_request}
			WHERE teacherid = ' . $teacherid . ' AND paidat IS NOT NULL
			ORDER BY createdat DESC
			LIMIT 1;
		');
		if (!$model) {
			$model = (object) [];
			foreach (['get_required_attributes', 'get_account_attributes', 'get_paypal_attributes'] as $method) {
                foreach (self::$method() as $attr => $options) {
                    $model->$attr = '';
                }
			}
			$teacher = get_complete_user_data('id', $teacherid);
			profile_load_data($teacher);
			$model->accountname = fullname($teacher, true);
			$model->accountcountry = ($teacher->country == 'LV' ? 'Latvia' : 'Other');
            $model->paypalemail = $teacher->email;
			$model->iknumber = $teacher->profile_field_iknumber;
		}
		return $model;
	}
	
	public static function get_account_html($id) {
		global $DB;
		$html = '';
		if ($record = $DB->get_record('lonet_payout_request', ['id' => $id])) {
			foreach (self::get_account_attributes() as $attr => $options) {
				if ($record->$attr) {
					$html .= ($html ? '<br>' : '') . get_string($attr, 'local_lonet') . ': <strong>' . $record->$attr . '</strong>';
				}
			}
		}
		return $html;
	}
}
