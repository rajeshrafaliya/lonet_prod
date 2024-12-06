<?php
function renderFile($file, $params = []) {
    if ($params) {
        extract($params);
    }
	ob_start();
    include($file);
    $content = ob_get_contents(); 
    ob_end_clean();
    return $content;
}

function sendMail($recipient, $mail, $data, $with_signature = true) {
	$site = get_site();
    $sitename  = format_string($site->fullname);
	
	$subject = get_string('email_' . $mail . '_subject', 'local_lonet', array_merge(['sitename' => $sitename], $data));
	$body = get_string('email_' . $mail . '_html', 'local_lonet', $data);
    if ($with_signature) {
        $body .= get_string('emailsignature', 'local_lonet', $sitename, $recipient->lang);
    }
	$text = html_to_text($body);
    $from = core_user::get_support_user();
	
	#tests
	$to = clone $recipient;
	//$to->email = 'agnese.skuja@batsoft.lv';
	#
	
    return email_to_user($to, $from, $subject, $text, $body);
}
function sendMail_booking($recipient, $mail, $data, $with_signature = true) {
	$site = get_site();
    $sitename  = format_string($site->fullname);
	
	$subject = get_string('email_' . $mail . '_subject', 'local_lonet', array_merge(['sitename' => $sitename], $data));
	$body = get_string('email_' . $mail . '_html', 'local_lonet', $data);
    if ($with_signature) {
        $body .= get_string('emailsignature', 'local_lonet', $sitename, $recipient->lang);
    }
	$text = html_to_text($body);
    $from = core_user::get_support_user();
	
	#tests
	$to = clone $recipient;
	//$to->email = 'agnese.skuja@batsoft.lv';
	#
	$eventdata = new \core\message\message();
	$eventdata->courseid = SITEID;
	$eventdata->component = 'local_custom';
	$eventdata->name = 'booking';
	$eventdata->userfrom = $from;
	$eventdata->userto = $to;
	$eventdata->subject = $subject;
	$eventdata->fullmessage = $text;
	$eventdata->fullmessageformat = FORMAT_PLAIN;
	$eventdata->fullmessagehtml = $body;
	$eventdata->notification = 1;
	$contexturl = new \moodle_url('/user/profile.php', []);
	$eventdata->contexturl = $contexturl->out();	
	$eventdata->contexturlname = format_string($data->lessonname, true);
	$eventdata->smallmessage = $subject;
	return message_send($eventdata);
    // return email_to_user($to, $from, $subject, $text, $body);
}
