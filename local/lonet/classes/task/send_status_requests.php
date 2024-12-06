<?php
namespace local_lonet\task;

defined('MOODLE_INTERNAL') || die();

use local_lonet\order_product;

class send_status_requests extends \core\task\scheduled_task {
	public function get_name() {
		return get_string('sendstatusrequests', 'local_lonet');
	}

	public function execute() {
		global $CFG;
		global $DB;
		$current_time = time();
		$sql = '
			SELECT op.*
			FROM {lonet_order_product} op
			WHERE op.status = ' . order_product::STATUS_CONFIRMED . '
				AND (
					(op.studentstatusrequestsent = 0 AND op.studentcompleted = 0)
					OR
					(op.teacherstatusrequestsent = 0 AND op.teachercompleted = 0)
				)
				AND op.endtime < ' . ($current_time - 3600) . ' 
		';
		$lessons = $DB->get_records_sql($sql);
//		file_put_contents($CFG->dirroot . '/local/lonet/send_request.json', $sql,FILE_APPEND);
//		echo $sql;
//		die();		
		foreach ($lessons as $lesson) {
			order_product::send_status_request($lesson);
		}
	}
}
