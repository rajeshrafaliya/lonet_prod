<?php
use local_lonet\user;
use local_lonet\lesson;

require_once('../../config.php');
require_once($CFG->dirroot.'/local/lonet/lib.php');
require_once($CFG->dirroot.'/message/lib.php');
require_once($CFG->libdir . '/formslib.php');
$lessonid = required_param('lessonid', PARAM_INT);
$teacherid = required_param('teacherid', PARAM_INT);
require_login();
global $USER,$CFG,$DB;
$is_teacher = user::is_teacher($USER); //added by Nitesh
if(!is_teacher && !is_siteadmin()){
	print_error('You are not allowed.');
}
$PAGE->set_url('/local/lonet/groupmessage.php', array('lessonid' => $lessonid));
$systemcontext = context_system::instance();
$PAGE->set_context($systemcontext);
class groupmessage_form extends moodleform {
	public function definition() {
		global $CFG,$COURSE,$DB;

		$mform =& $this->_form;
		$lessonid = $this->_customdata['lesson'];
		$teacherid = $this->_customdata['teacherid'];

		$mform->addElement('hidden', 'lessonid', $lessonid);
		$mform->setType('lessonid', PARAM_INT);		
		
		$mform->addElement('hidden', 'teacherid', $teacherid);
		$mform->setType('teacherid', PARAM_INT);		
		
		$getstudents = $DB->get_records_sql("SELECT * FROM {lonet_order_product} WHERE lessonid=".$lessonid." AND status IN (0,1,5) AND isgrouplesson=1");
		$students = [];
		foreach($getstudents as $sstudent){
			$userdetail = \core_user::get_user($sstudent->studentid);
			$students[$sstudent->studentid] = fullname($userdetail);
		}

		$mform->addElement('select', 'groupusers', get_string('groupusers', 'local_lonet'), $students);
		$mform->getElement('groupusers')->setMultiple(true);
		// $mform->getElement('groupusers')->setSelected($students);
		$mform->addElement('textarea', 'message', get_string("message",'local_lonet'), 'wrap="virtual" rows="10" cols="90"');

		$buttons = array();
		$buttons[] =& $mform->createElement('submit', 'sendmessage', get_string('send','local_lonet'));
		$buttons[] =& $mform->createElement('cancel');

		$mform->addGroup($buttons, 'buttons', '', array(' '), false);
	}
	function validation($data, $files) {
		global $DB;
		$errors = parent::validation($data, $files);
		if(empty($data['groupusers'])){
			$errors['groupusers'] = get_string('selectusererror','local_lonet');
		}
		if(empty($data['message'])){
			$errors['message'] = get_string('errorgroupmsg','local_lonet');
		}
		return $errors;
	}
}
$mform = new groupmessage_form(null, ['lesson' => $lessonid, 'teacherid' => $teacherid]);
/* $getstudents = $DB->get_records_sql("SELECT * FROM {lonet_order_product} WHERE lessonid=".$lessonid." AND isgrouplesson=1");
$students = [];
foreach($getstudents as $sstudent){
	$userdetail = \core_user::get_user($sstudent->studentid);
	$students[$sstudent->studentid] = fullname($userdetail);
}
$data = (object) [
	'groupusers' => $students
];
$mform->set_data($data); */
if ($mform->is_cancelled()) {
	$editreturn = $CFG->wwwroot.'/local/lonet/edit.php?teacherid='.$_REQUEST['teacherid'];
	redirect($editreturn);
}
if ($mform->is_submitted() && $mform->is_validated() && confirm_sesskey()) {
	$data = $mform->get_data();
	$site = get_site();
	$text = html_to_text($data->message);
    // $userfrom = core_user::get_support_user();
    $userfrom = \core_user::get_user($data->teacherid);
	$lesson = lesson::get_grouplesson_by_id($data->lessonid);
	$subject = $lesson->name;
	foreach($data->groupusers as $suser){
		message_post_message($userfrom, \core_user::get_user($suser), $data->message, FORMAT_MOODLE);
	}
	$successreturn = $CFG->wwwroot.'/local/lonet/edit.php?teacherid='.$data->teacherid;
	redirect($successreturn);
}

$pagetitle = get_string('groupmsg','local_lonet');
$PAGE->set_title($pagetitle);
$PAGE->set_heading($pagetitle);
echo $OUTPUT->header();
echo $OUTPUT->heading($pagetitle);
$mform->display();
echo $OUTPUT->footer();