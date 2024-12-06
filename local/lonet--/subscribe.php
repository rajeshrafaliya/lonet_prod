<?php
use local_lonet\subscriber;

//defined('MOODLE_INTERNAL') || die();

require_once('../../config.php');
require_once($CFG->dirroot.'/local/lonet/lib.php');

global $DB;
global $USER;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['Subscriber'])) {
	$attributes = $_POST['Subscriber'];
    $attributes['referrer'] = $_SERVER['HTTP_REFERER'];
    $attributes['createdat'] = time();
	if ($DB->insert_record('lonet_subscriber', $attributes)) {
        subscriber::sendSubscriberEmail($attributes['email']);
		echo true;
		exit();
	}
	echo false;
} else {
	echo false;
}
?>