<?php
use local_lonet\user;

require_once('../../config.php');
require_once($CFG->dirroot.'/local/lonet/lib.php');

$title = get_string('delete');

$PAGE->set_context(context_system::instance());
$PAGE->set_title($title);
$PAGE->set_heading($title);
$PAGE->set_url('/local/lonet/delete.php');

global $DB;
global $USER;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$result = ['status' => false, 'message' => ''];
	if (user::can_delete_account($USER->id)) {
		sendMail($USER, 'confirmdeletion', ['fullname' => fullname($USER, true), 'sitename' => format_string(get_site()->fullname), 'link' => $CFG->wwwroot . '/local/lonet/delete.php?token=' . md5($USER->email)]);
		$result['status'] = true;
		$result['message'] = get_string('confirmdeletion', 'local_lonet', $USER->email);
	} else {
		$result['message'] = get_string('youcannotdeleteaccount', 'local_lonet');
	}
	echo json_encode($result);
} else {	
	echo $OUTPUT->header();	
	
	$error = null;
	if (!isloggedin() || isguestuser()) {
		$error = get_string('loggedinnot');
	} elseif (!user::can_delete_account($USER->id)) {
		$error = get_string('youcannotdeleteaccount', 'local_lonet');
	}
	$token = (isset($_GET['token']) ? $_GET['token'] : null);
	if (!$error && (!$token || md5($USER->email) !== $token)) {
		$error = get_string('invaliddeletiontoken', 'local_lonet');
	}
	if ($error) {
		echo '<div class="alert alert-error alert-block fade in" role="alert">' . $error . '</div>';
		echo $OUTPUT->footer();
		exit;
	} else {
		$current_time = time();
		$user_copy = clone $USER;
		if ($DB->update_record('user', [
			'id' => $USER->id,
			'deleted' => 1,
			'username' => $current_time,
			'password' => $USER->email,
			'email' => $current_time
		])) {
			sendMail(get_admins()[25], 'userdeleted', ['fullname' => fullname($user_copy, true), 'email' => $user_copy->email, 'type' => get_string((user::is_teacher($user_copy) ? 'teacher' : 'learner'), 'local_lonet')]);
			echo '<div class="alert alert-success alert-block fade in" role="alert">' . get_string('youraccountdeleted', 'local_lonet') . '</div>';
		}		
		echo $OUTPUT->footer();
	}
}
