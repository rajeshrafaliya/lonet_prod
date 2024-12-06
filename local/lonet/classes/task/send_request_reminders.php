<?php
namespace local_lonet\task;

defined('MOODLE_INTERNAL') || die();

use local_lonet\order_product;

class send_request_reminders extends \core\task\scheduled_task {
	public function get_name() {
		return get_string('sendrequestreminders', 'local_lonet');
	}

	public function execute() {
		global $DB;		
		$current_time = time();
		$lessons = $DB->get_records_sql('
			SELECT op.*
			FROM {lonet_order_product} op
			LEFT JOIN {lonet_order_transaction} ot ON ot.orderid = op.orderid AND ot.iscompleted = 0
			WHERE op.status = ' . order_product::STATUS_WAITING . '
				AND op.next_reminder <= ' . $current_time . ' 
				AND op.next_reminder <= ot.createdat + (21600 * 3)
		');
		foreach ($lessons as $lesson) {
			order_product::sendRequestReminder($lesson);
		}
	}

}
