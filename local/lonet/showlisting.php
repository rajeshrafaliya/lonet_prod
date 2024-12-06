<?php
define('AJAX_SCRIPT', true);
require('../../config.php');
// require_sesskey();
global $CFG,$DB,$USER;

$datetimestamp      = required_param('datetimestamp', PARAM_INT);
$lesson      = required_param('lesson', PARAM_INT);
$bookingteacher = required_param('bookingteacher', PARAM_INT); 
$isgrouplesson = required_param('isgrouplesson', PARAM_INT); 
$index = optional_param('index', 0,  PARAM_INT);

$user = $DB->get_record_sql("SELECT * FROM {user} WHERE id=".$bookingteacher."");
$userTimezone = \core_date::get_user_timezone_object();
$timefrom = (new DateTime('now', $userTimezone))->setTimestamp($datetimestamp)->format('H:i');
$formattedDate = (new DateTime('now', $userTimezone))
    ->setTimestamp($datetimestamp)
    ->format('D, M d, Y');
$rclass = $lesson.''.$index;

if($isgrouplesson > 0){
	$lessondata = $DB->get_record_sql("SELECT * FROM {lonet_group_lessons} WHERE id=".$lesson."");
	$lname = $lessondata->lessonname;
	$timeto = $lessondata->timeto;
}else{
	$lessondata = $DB->get_record_sql("SELECT * FROM {lonet_lesson} WHERE id=".$lesson."");
	$lname = $lessondata->name;
	$length = $lessondata->length;
	$timeto = (new DateTime('now', $userTimezone))->setTimestamp($datetimestamp+$length)->format('H:i');
}
echo '<div class="indiselect rclass_'.$rclass.' removediv_'.$index.'"><div class="leftbox"><span class="removeselect" data-rindex='.$index.' data-removeid='.$lesson.' data-removeclass='.$rclass.'>'.get_string("trashicon","local_lonet").'</span></div><div class="secondbox"><div class="row1"><div class="lname">'.$lname.'</div><div class="ldate">'.$formattedDate.'</div></div><div class="row2"><div class="tname">with '.fullname($user).'</div><div class="ltime">'.$timefrom.' - '.$timeto.'</div></div></div></div>';
die;		