<?php
namespace local_lonet\task;

defined('MOODLE_INTERNAL') || die();

use local_lonet\order_product;
use local_lonet\lesson;

class expire_requests extends \core\task\scheduled_task {
	public function get_name() {
		return get_string('expirerequests', 'local_lonet');
	}

	public function execute() {
		global $DB;
		
		$current_time = time();

		$expired_requests = $DB->get_records_sql('
			SELECT op.*
			FROM {lonet_order_product} op
			LEFT JOIN {lonet_order_transaction} ot ON ot.orderid = op.orderid AND ot.iscompleted = 1
			WHERE op.status = ' . order_product::STATUS_WAITING . '
				AND ot.createdat <= ' . ($current_time - 86400) . ' 
		');
		foreach ($expired_requests as $expired_request) {
			//added by Nitesh
			if(isset($expired_request->isgrouplesson) && ($expired_request->isgrouplesson > 0)){
				$record = lesson::get_grouplesson_by_id($expired_request->lessonid);
			}else{
				$record = $DB->get_record('lonet_lesson', ['id' => $expired_request->lessonid]);
			}
			if(!empty($record)){
				if(isset($record->offer) && !empty($record->offer)){continue;}
			}
			$expired_request->status = order_product::STATUS_EXPIRED;
			$expired_request->canceltime = $current_time;
			$expired_request->cancellerid = $expired_request->teacherid;
			if ($DB->update_record('lonet_order_product', $expired_request)) {
				$learner = $DB->get_record('user', ['id' => $expired_request->studentid]);
				sendMail($learner, 'lessonexpire', [
					'fullname' => fullname($learner, true),
					'lessonname' => order_product::get_name($expired_request),
					'lessondate' => order_product::get_date($expired_request, $learner),
					'lessontime' => order_product::get_time($expired_request, $learner),
					'profilelink' => '<a href="' . $CFG->wwwroot . '/user/profile.php">' . get_string('profilepage', 'local_lonet') . '</a>',
					'termslink' => '<a href="' . $CFG->wwwroot . '/terms-and-conditions">' . get_string('terms', 'theme_lonet') . '</a>'
				]);
			}
		}
	}

}
