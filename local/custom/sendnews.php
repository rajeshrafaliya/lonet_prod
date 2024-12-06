<?php
require_once('../../config.php');
require_once($CFG->libdir . '/formslib.php');
$PAGE->set_url('/local/custom/sendnews.php', array());
$systemcontext = context_system::instance();
$PAGE->set_context($systemcontext);
$PAGE->set_pagelayout('admin');
require_login();
class sendnews_form extends moodleform {
	public function definition() {
		global $CFG,$COURSE;

		$mform =& $this->_form;
		$attributes=array('size'=>'60');
		$mform->addElement('text', 'newstitle', get_string('sendnewstitle', 'local_lonet'), $attributes);
		$mform->setType('newstitle', PARAM_RAW);
		
		$mform->addElement('text', 'newsurl', get_string('sendnewsurl', 'local_lonet'), $attributes);
		$mform->setType('newsurl', PARAM_RAW);
		
		$mform->addElement('editor', 'newsdesc', get_string('sendnewsdesc', 'local_lonet'));
		$mform->setType('newsdesc', PARAM_RAW);
		
		$buttons[] =& $mform->createElement('submit', 'sendnews', get_string('send', 'local_lonet'));
		$buttons[] =& $mform->createElement('cancel');

		$mform->addGroup($buttons, 'buttons', '', array(' '), false);
	}
}
$mform = new sendnews_form($CFG->wwwroot.'/local/custom/sendnews.php',array(),'post','',array('id'=> 'sendnewsform'));
if ($mform->is_cancelled()) {
	redirect($CFG->wwwroot);
}
if ($mform->is_submitted() && $mform->is_validated() && confirm_sesskey()) {
	$data = $mform->get_data();
	$postsent = new stdClass();
	$postsent->title = $data->newstitle;
	$postsent->url = $data->newsurl;
	$postsent->description = $data->newsdesc['text'];
	$postsent->timecreated = time();
	$DB->insert_record('custom_sendnews', $postsent);
	redirect($CFG->wwwroot);
}
$pagetitle = get_string('sendnews','local_lonet');
$PAGE->set_title($pagetitle);
$PAGE->set_heading($pagetitle);
echo $OUTPUT->header();
$OUTPUT->heading($pagetitle);
$mform->display();
echo $OUTPUT->footer();