<?php
require_once('../../config.php');
    require_once($CFG->libdir.'/adminlib.php');
    require_once($CFG->libdir.'/authlib.php');
    require_once($CFG->dirroot.'/user/filters/lib.php');
    require_once($CFG->dirroot.'/user/lib.php');
$PAGE->set_url('/local/custom/deletebulk.php', array());
$systemcontext = context_system::instance();
$PAGE->set_context($systemcontext);
$PAGE->set_pagelayout('admin');
require_login();
global $DB;
$deleteusers = $DB->get_records_sql("SELECT * FROM {user} WHERE deleted=1");
foreach($deleteusers as $user){
	
    // Generate username from email address, or a fake email.
    $delemail = !empty($user->email) ? $user->email : $user->username . '.' . $user->id . '@unknownemail.invalid';
    $delname = clean_param($delemail . "." . time(), PARAM_USERNAME);

    // Workaround for bulk deletes of users with the same email address.
    while ($DB->record_exists('user', array('username' => $delname))) { // No need to use mnethostid here.
        $delname++;
    }
    $updateuser = new stdClass();
    $updateuser->id           = $user->id;
    $updateuser->deleted      = 1;
    $updateuser->username     = $delname;            // Remember it just in case.
    $updateuser->email        = md5($user->username);// Store hash of username, useful importing/restoring users.
    $updateuser->password        = md5($user->password);// Store hash of username, useful importing/restoring users.
    $updateuser->idnumber     = '';                  // Clear this field to free it up.
    $updateuser->picture      = 0;
    $updateuser->timemodified = time();

    // Don't trigger update event, as user is being deleted.
    user_update_user($updateuser, false, false);
}