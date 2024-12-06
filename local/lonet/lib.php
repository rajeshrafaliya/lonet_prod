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
function subscribe_newsletter(){
	global $CFG;
	echo '<div class="subnews" style="background: #F9FAFB;padding:64px;">
	<div class="subnews_container">
	<div class="box2" style="display: flex;flex-direction: column;align-items: center;">
        <h3>Subscribe to our newsletter</h3>
        <p class="mb-0">Get our weekly news and interesting information about languages.</p>
        <form method="post" id="form-subscribemailer" class="subscribemailer ml-0" action="'.$CFG->httpswwwroot.'/local/lonet/subscribemailer.php">
            <input type="email" name="subscribemailer[email]" placeholder="Your email" id="inputEmail" required style="height: 48px !important; padding: 14px 12px;">
			<input type="hidden" name="groups[]" value="94771110564857015" checked="checked" aria-invalid="false"> 
            <button class="subbtn">Subscribe</button>
        </form>	
	</div>
	</div>
	</div>';
}