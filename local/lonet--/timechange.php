<?php
require_once('../../config.php');
require_sesskey();
$timezone = required_param('timezone', PARAM_RAW);
$time = required_param('time', PARAM_RAW);
$id = required_param('id', PARAM_INT);
$userTimezone = \core_date::get_user_timezone_object($timezone);
$timefrom = (new DateTime('now', $userTimezone))->setTimestamp($time)->format('H:i');
$data = array("timefrom" => $timefrom,'glesson'=>$id);
echo json_encode($data);
exit();