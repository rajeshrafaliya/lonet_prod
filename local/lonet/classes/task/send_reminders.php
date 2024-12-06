<?php
namespace local_lonet\task;

defined('MOODLE_INTERNAL') || die();

use local_lonet\order_product;

class send_reminders extends \core\task\scheduled_task {
	public function get_name() {
		return get_string('sendreminders', 'local_lonet');
	}

	public function execute() {
		global $CFG;
		global $DB;
		$current_time = time();
		$sql = '
			SELECT op.*
			FROM {lonet_order_product} op
			WHERE op.status = ' . order_product::STATUS_CONFIRMED . '
				AND op.starttime > ' . $current_time . ' 
				AND (
					(
						(op.studentreminder24sent = 0 OR op.teacherreminder24sent = 0)
						AND op.starttime <= ' . ($current_time + 86400) . '
					)
					OR
					(
						(op.studentreminder1sent = 0 OR op.teacherreminder1sent = 0)
						AND op.starttime <= ' . ($current_time + 3600) . '
					)
				)
		';
		$lessons = $DB->get_records_sql($sql);
//		file_put_contents($CFG->dirroot . '/local/lonet/send_reminders.json', $sql,FILE_APPEND);
//		echo $sql;
//		die();
		foreach ($lessons as $lesson) {
			order_product::send_reminder($lesson);
		}
	}

}
