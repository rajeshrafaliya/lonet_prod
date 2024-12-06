<?php
namespace local_lonet;

defined('MOODLE_INTERNAL') || die();

use \core_date;
use \DateTime;

require_once('../../config.php');
require_once($CFG->libdir.'/formslib.php');

class schedule_form extends \moodleform {
	public static function get_new($teacherid) {
		return (object) [
			'id' => 0,
			'teacherid' => $teacherid,
			'weekdays' => '',
			'starttime' => '',
			'endtime' => '',
			'breakstarttime' => '',
			'breakendtime' => '',
			'guardtime' => '',
		];
	}

    public function definition() {
        global $CFG;
 
        $mform = $this->_form;
 
        $mform->addElement('hidden', 'id');
        $mform->setType('id', PARAM_INT);
        $mform->addElement('hidden', 'teacherid');
        $mform->setType('teacherid', PARAM_INT);
 
		$weekdays_array = [];
		for ($i = 1; $i <= 7; $i++) {
			$weekdays_array[$i] = get_string(strtolower(jddayofweek($i - 1, 1)), 'core_calendar');
		}
		$weekdays = $mform->addElement('select', 'weekdays', get_string('weekdays', 'local_lonet'), $weekdays_array);
        $mform->setType('select', PARAM_RAW);
        //$mform->setDefault('weekdays', []);
		$weekdays->setMultiple(true);

        $mform->addElement('select', 'starttime', get_string('workhours', 'local_lonet'), schedule::get_times_array('from'));
        $mform->setType('starttime', PARAM_INT);
        //$mform->setDefault('starttime', 32400);
		
		$mform->addElement('select', 'endtime', '&nbsp;', schedule::get_times_array('to'));
        $mform->setType('endtime', PARAM_INT);
        //$mform->setDefault('endtime', 61200);

        $mform->addElement('select', 'breakstarttime', get_string('breakstarttime', 'local_lonet'), schedule::get_times_array('from'));
        $mform->setType('breakstarttime', PARAM_INT);
		//$mform->setDefault('breakstarttime', 0);
		
		$mform->addElement('select', 'breakendtime', get_string('breakendtime', 'local_lonet'), schedule::get_times_array('to'));
        $mform->setType('breakendtime', PARAM_INT);
        //$mform->setDefault('breakendtime', 0);
		
		$mform->addElement('duration', 'guardtime', get_string('guardtime', 'local_lonet'));
		//$mform->addElement('select', 'guardtime', get_string('guardtime', 'local_lonet'), range(1,24));
        $mform->setType('guardtime', PARAM_INT);
        $mform->setDefault('guardtime', get_config('local_lonet', 'minguardtime'));
 
		$this->add_action_buttons(false);
        /*$mform->addElement('hidden', 'email', get_string('email'));
        $mform->setType('email', PARAM_NOTAGS);*/
    }
	/*
    function validation($data, $files) {
        return [];
    }
	*/
}
