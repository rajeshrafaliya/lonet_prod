<?php
namespace local_lonet\task;

defined('MOODLE_INTERNAL') || die();

use local_lonet\order_product;

class update_statuses extends \core\task\scheduled_task {
	public function get_name() {
		return get_string('updatestatuses', 'local_lonet');
	}

	public function execute() {
		global $DB;		
		$current_time = time();
		$lessons = $DB->get_records_sql('
			SELECT op.*
			FROM {lonet_order_product} op
			WHERE op.status = ' . order_product::STATUS_CONFIRMED . '
				AND op.endtime < ' . $current_time . '
				AND (
					(op.teachercompleted > 1 AND op.studentcompleted >= 0 AND op.teachercompleted <= ' . ($current_time - 43200) . ')
					OR
					(op.studentcompleted > 1 AND op.studentcompleted <= ' . ($current_time - 43200) . ')
					OR
					(
                        (
                            op.studentcompleted < 0
                            OR op.teachercompleted < 0
                        )
                        AND op.endtime <= ' . ($current_time - 43200) . '
                    )
				)
		');
		foreach ($lessons as $lesson) {
			if ($lesson->studentcompleted > 1 || $lesson->teachercompleted > 1) {
				$lesson->status = order_product::STATUS_COMPLETED;
                $student = order_product::get_learner($lesson);
                order_product::addTeacherReward($lesson, $student);
			} 
			$DB->update_record('lonet_order_product', $lesson);
		}
	}

}
