<?php
defined('MOODLE_INTERNAL') || die();
function local_custom_before_http_headers() {
    global $SESSION, $CFG, $PAGE;

    // Get the current URL path
    $url_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    // Extract the language code from the URL (assumes the first segment is the language code)
    $path_segments = explode('/', trim($url_path, '/'));
    if (!empty($path_segments[0])) {
        $lang_code = $path_segments[0];
        // Define the supported languages (based on what you allow)
        $supported_languages = ['en', 'es', 'lv', 'ru'];
        if (in_array($lang_code, $supported_languages)) {
		// if (in_array($lang_code, get_string_manager()->get_list_of_translations())) {
            // Use Moodle's set user language function
            $SESSION->lang = $lang_code;
            current_language();
        }
    }
}
function local_custom_extend_navigation(global_navigation $navigation) {
	global $CFG,$PAGE;
	$t = $CFG->wwwroot.'/';
	if($PAGE->url->out() === $t){
		local_custom_before_http_headers();
	}
}
function local_custom_delete_bot(){
	global $CFG,$DB;
	require_once($CFG->dirroot.'/user/lib.php');
	$notconfirmed = $DB->get_records_sql("SELECT * FROM {user} WHERE confirmed=0 AND deleted=0");
	foreach($notconfirmed as $deleteuser){
		$timeDiff = abs(time() - $deleteuser->timecreated);
		$numberDays = $timeDiff/86400; 
		$numberDays = intval($numberDays);
		mtrace("User with id ".$deleteuser->id." = ".$numberDays);
		if($numberDays > 1){
			mtrace("User with id ".$deleteuser->id." deleted");
			// delete_user($deleteuser); - not working because grade folder missing in moodle
			$deleteuser->deleted = 1;
			$DB->update_record('user', $deleteuser);
		}
	}
}
function local_custom_blog_notification(){
	global $CFG,$DB;
	$from = core_user::get_support_user();
	$language = 'en';
	$posts = json_decode(file_get_contents($CFG->dirroot . '/local/lonet/posts.json'))->$language;
	if ($posts) {
		foreach($posts as $post){
			if($DB->record_exists_sql("SELECT * FROM {custom_blog_noti} WHERE blogurl LIKE '%".$post->url."%' AND sent=1")){
				continue;
			}
			$allusers = $DB->get_records_sql("SELECT * FROM {user} WHERE deleted=0 AND suspended=0 AND confirmed=1");
			foreach($allusers as $touser){
				$eventdata = new \core\message\message();
				$eventdata->courseid = SITEID;
				$eventdata->component = 'local_custom';
				$eventdata->name = 'blognotification';
				$eventdata->userfrom = $from;
				$eventdata->userto = $touser;
				$eventdata->subject = $post->title;
				$eventdata->fullmessage = html_to_text($post->content);
				$eventdata->fullmessageformat = FORMAT_PLAIN;
				$eventdata->fullmessagehtml = $post->content;
				$eventdata->notification = 1;
				$eventdata->contexturl = $post->url;	
				$eventdata->contexturlname = format_string($post->title, true);
				$eventdata->smallmessage = $post->title;
				message_send($eventdata);
				mtrace("notification sent to userid-".$touser->id." for blog - ".$post->title."");
			}
			$postsent = new stdClass();
			$postsent->blogurl = $post->url;
			$postsent->sent = 1;
			$postsent->timecreated = time();
			$DB->insert_record('custom_blog_noti', $postsent);
		}
	}
}
function local_custom_newsletter_notification(){
	global $CFG,$DB;
	$from = core_user::get_support_user();
	$news = $DB->get_records_sql("SELECT * FROM {custom_sendnews} WHERE sent = 0");
	if ($news) {
		foreach($news as $singlenews){
			$allusers = $DB->get_records_sql("SELECT * FROM {user} WHERE deleted=0 AND suspended=0 AND confirmed=1");
			foreach($allusers as $touser){
				$eventdata = new \core\message\message();
				$eventdata->courseid = SITEID;
				$eventdata->component = 'local_custom';
				$eventdata->name = 'newsletternotification';
				$eventdata->userfrom = $from;
				$eventdata->userto = $touser;
				$eventdata->subject = $singlenews->title;
				$eventdata->fullmessage = html_to_text($singlenews->description);
				$eventdata->fullmessageformat = FORMAT_PLAIN;
				$eventdata->fullmessagehtml = $singlenews->description;
				$eventdata->notification = 1;
				$eventdata->contexturl = $singlenews->url;	
				$eventdata->contexturlname = format_string($singlenews->title, true);
				$eventdata->smallmessage = $singlenews->title;
				message_send($eventdata);
				mtrace("notification sent to userid-".$touser->id." for newsletter - ".$singlenews->url."");
			}
			$singlenews->sent = 1;
			$DB->update_record('custom_sendnews', $singlenews);
		}
	}
}