<?php
namespace local_lonet\task;

defined('MOODLE_INTERNAL') || die();

use local_lonet\teacher;

class record_history extends \core\task\scheduled_task {
	public function get_name() {
		return get_string('recordhistory', 'local_lonet');
	}

	public function execute() {
		global $DB;		
		$current_time = time();        
        $teachers = teacher::get_active();
        foreach ($teachers as $teacher) {
            profile_load_data($teacher);
            $records = $DB->get_records('lonet_user_history', ['userid' => $teacher->id], 'createdat DESC');
            if (!$records || $records[0]->profile_field_useinmarketing != $teacher->profile_field_useinmarketing) {
                $DB->insert_record('lonet_user_history', [
                    'userid' => $teacher->id,
                    'profile_field_useinmarketing' => $teacher->profile_field_useinmarketing,
                    'createdat' => $current_time,
                ]);
                if ($records && !$records[0]->seenat) {
                    $data = $records[0];
                    $data->seenat = $current_time;
                    $DB->update_record('lonet_user_history', $data);
                }
            }
        }
	}
}
