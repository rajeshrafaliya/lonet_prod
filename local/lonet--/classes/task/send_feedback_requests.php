<?php
namespace local_lonet\task;

defined('MOODLE_INTERNAL') || die();

use local_lonet\order_product;

class send_feedback_requests extends \core\task\scheduled_task {
	public function get_name() {
		return get_string('sendfeedbackrequests', 'local_lonet');
	}

	public function execute() {
		global $DB;		
		$current_time = time();
		$lessons = $DB->get_records_sql('
			SELECT op.*
			FROM {lonet_order_product} op
			WHERE op.status = ' . order_product::STATUS_COMPLETED . '
				AND op.endtime < ' . ($current_time - 86400) . ' 
				AND op.endtime > ' . ($current_time - (86400 * 3)) . ' 
                AND op.rating IS NULL
                AND op.feedbackrequestsent = 0
                AND (
                    SELECT op2.id
                    FROM {lonet_order_product} op2
                    WHERE op2.studentid = op.studentid
                        AND op2.teacherid = op.teacherid
                        AND op2.rating IS NOT NULL
                    LIMIT 1
                ) IS NULL
		');
		foreach ($lessons as $lesson) {
			order_product::send_feedback_request($lesson);
		}
	}
}
