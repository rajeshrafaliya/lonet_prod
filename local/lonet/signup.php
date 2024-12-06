<?php
require_once('../../config.php');
require_once($CFG->dirroot.'/local/lonet/lib.php');

$title = 'Refer a Friend'; // get_string('referafriend', 'local_lonet');

$PAGE->set_context(context_system::instance());

$PAGE->set_pagelayout('base');
$PAGE->set_title($title);
$PAGE->set_heading($title);
$PAGE->set_url('/local/lonet/invite.php');

$_SESSION['referral_code'] = $_GET['ref'] ?? '';
header('Location: ' . $CFG->wwwroot . '/login/signup.php');
exit();

echo $OUTPUT->header();
echo $_SESSION['referral_code'];
echo $OUTPUT->footer();