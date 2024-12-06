<?php
// https://stackoverflow.com/questions/14152911/how-do-i-adjust-the-timezone-information-when-sending-this-ical-invite
require_once('../config.php');
//require_once($CFG->dirroot.'/course/lib.php');
require_once($CFG->dirroot.'/calendar/lib.php');
require_once($CFG->libdir.'/bennu/bennu.inc.php');

$orderid = required_param('id', PARAM_INT);
//check order_product
$orderdetail = $DB->get_record_sql("SELECT * FROM {lonet_order_product} WHERE id=".$orderid."");
if($orderdetail->isgrouplesson > 0){
	$lessondetail = $DB->get_record_sql("SELECT lessonname as name FROM {lonet_group_lessons} WHERE id=".$orderdetail->lessonid."");
}else{
	$lessondetail = $DB->get_record_sql("SELECT name FROM {lonet_lesson} WHERE id=".$orderdetail->lessonid."");
}

if($USER->timezone == 99){
	$timezone = $CFG->timezone;
}else{
	$timezone = $USER->timezone;
}
$datetime_eur = date_create("now", timezone_open($timezone));
$offset = timezone_offset_get(timezone_open($timezone), $datetime_eur);
/* echo $offset.'---';
echo $orderdetail->starttime-$offset;
echo '---';
echo $orderdetail->starttime-10800;die; */
$start = (new DateTime('now', core_date::get_user_timezone_object()))->setTimestamp($orderdetail->starttime-($offset))->format('Ymd\THis\Z'); //('%Y%m%dT%H%M%SZ', $t);
$end = (new DateTime('now', core_date::get_user_timezone_object()))->setTimestamp($orderdetail->endtime-($offset))->format('Ymd\THis\Z');

$ical = new iCalendar;
$ical->add_property('method', 'PUBLISH');

$hostaddress = str_replace('http://', '', $CFG->wwwroot);
$hostaddress = str_replace('https://', '', $hostaddress);

// $me = new calendar_event($event); // To use moodle calendar event services.
$ev = new iCalendar_event; // To export in ical format.
$ev->add_property('uid', $orderid.'@'.$hostaddress);

// Set iCal event summary from event name.
$ev->add_property('summary', $lessondetail->name);
$ev->add_property('description', $lessondetail->name);

$ev->add_property('class', 'PUBLIC'); // PUBLIC / PRIVATE / CONFIDENTIAL
// $ev->add_property('last-modified', Bennu::timestamp_to_datetime($event->timemodified));
$ev->add_property('last-modified', time());
$ev->add_property('dtstamp', Bennu::timestamp_to_datetime()); // now
$ev->add_property('dtstart', $start);
$ev->add_property('dtend', $end);
$ical->add_component($ev);


$serialized = $ical->serialize();
if(empty($serialized)) {
    // TODO
    die('bad serialization');
}

$filename = 'icalexport.ics';

header('Last-Modified: '. gmdate('D, d M Y H:i:s', time()) .' GMT');
header('Cache-Control: private, must-revalidate, pre-check=0, post-check=0, max-age=0');
header('Expires: '. gmdate('D, d M Y H:i:s', 0) .'GMT');
header('Pragma: no-cache');
header('Accept-Ranges: none'); // Comment out if PDFs do not work...
header('Content-disposition: attachment; filename='.$filename);
header('Content-length: '.strlen($serialized));
header('Content-type: text/calendar; charset=utf-8');

echo $serialized;
