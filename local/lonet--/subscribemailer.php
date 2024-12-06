<?php
use local_lonet\user;

//defined('MOODLE_INTERNAL') || die();

require_once('../../config.php');
require_once($CFG->dirroot.'/local/lonet/lib.php');

global $DB;
global $USER;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['subscribemailer'])) {
	$attributes = $_POST['subscribemailer'];
	user::addUserToMailingList_notloggedin($attributes['name'], $attributes['email'], $_POST['groups']);
	echo true;
} else {
	echo false;
}
?>