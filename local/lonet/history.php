<?php
use local_lonet\user;

global $DB;
global $USER;

require_once('../../config.php');
require_once($CFG->dirroot.'/local/lonet/lib.php');

$id = (isset($_GET['id']) && $_GET['id'] ? $_GET['id'] : $USER->id);
$title = get_string('lessonhistory', 'local_lonet');

$PAGE->set_context(context_system::instance());
$PAGE->set_pagelayout('base');
$PAGE->set_title($title);
$PAGE->set_heading($title);
$PAGE->set_url('/local/lonet/history.php?id=' . $id);

echo $OUTPUT->header();

if ($id && $user = $DB->get_record('user', ['id' => $id])) {
	if ($id == $USER->id || is_siteadmin() || user::is_bookkeeper()) {
		echo renderFile('_lessons_history.php', ['user' => $user, 'fullhistory' => true]);
	} else {
		echo 'Page not found.';
	}
}

echo $OUTPUT->footer();
