<?php
namespace local_lonet\task;

defined('MOODLE_INTERNAL') || die();

use local_lonet\user;

class send_reminders_notbooked_lesson extends \core\task\scheduled_task {
	public function get_name() {
		return get_string('sendreminders_notbooked_lesson', 'local_lonet');
	}

	public function execute() {
		global $CFG,$DB;		
		$current_time = time();

		//$sql = 'SELECT u.* FROM {user} u where u.id in (1660,1661)';

		$sql = 'SELECT u.* FROM {user} u
		LEFT JOIN {lonet_order_product} op ON u.id=op.studentid
		LEFT JOIN {user_info_data} uid ON uid.userid=u.id AND uid.fieldid = 6
		WHERE u.deleted=0 AND u.suspended=0 AND u.confirmed=1 
		AND (op.starttime < '.$current_time.' OR op.id IS NULL) AND uid.data = "Learner"
		AND u.id NOT IN (SELECT DISTINCT(studentid) AS userid FROM {lonet_order_product} WHERE starttime >= '.$current_time.')
		GROUP BY u.id
		ORDER BY u.id DESC';

$i=0;
		$lessons = $DB->get_records_sql($sql);
		foreach ($lessons as $lesson) {
			$i++;
			file_put_contents($CFG->dirroot . '/local/lonet/send_reminders.json', $i);//,FILE_APPEND
		}
	}

}
