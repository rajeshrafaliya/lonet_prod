<?php
namespace local_lonet\task;

defined('MOODLE_INTERNAL') || die();

use local_lonet\order_product;
use local_lonet\user;

class clear_schedule extends \core\task\scheduled_task {
	public function get_name() {
		return get_string('clearschedule', 'local_lonet');
	}

	public function execute() {
		global $DB;

		$users = $DB->get_records_sql('
			SELECT u.*
			FROM {user} u
		');
		foreach ($users as $user) {
			$strlessonscompleted = user::get_lesson_count($user);
            $DB->update_record('user', ['id' => $user->id, 'firstnamephonetic' => $strlessonscompleted]);
		}
	}
}
