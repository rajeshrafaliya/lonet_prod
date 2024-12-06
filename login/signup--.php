<?php

// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * user signup page.
 *
 * @package    core
 * @subpackage auth
 * @copyright  1999 onwards Martin Dougiamas  http://dougiamas.com
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require('../config.php');
require_once($CFG->dirroot . '/user/editlib.php');
require_once($CFG->libdir . '/authlib.php');

// Try to prevent searching for sites that allow sign-up.
if (!isset($CFG->additionalhtmlhead)) {
    $CFG->additionalhtmlhead = '';
}
$CFG->additionalhtmlhead .= '<meta name="robots" content="noindex" />';

if (!$authplugin = signup_is_enabled()) {
    print_error('notlocalisederrormessage', 'error', '', 'Sorry, you may not use this page.');
}

//HTTPS is required in this page when $CFG->loginhttps enabled
$PAGE->https_required();

$referral_code = ($_GET['ref'] ?? '');
if (empty($SESSION->referral_code)) {
    if ($referral_code) {
        $SESSION->referral_code = $referral_code;
    }
} elseif (!$referral_code) {
    $referral_code = $SESSION->referral_code;
}

$PAGE->set_url('/login/signup.php' . ($referral_code ? "?ref=$referral_code" : ''));
$PAGE->set_context(context_system::instance());

// If wantsurl is empty or /login/signup.php, override wanted URL.
// We do not want to end up here again if user clicks "Login".
if (empty($SESSION->wantsurl)) {
    $SESSION->wantsurl = $CFG->wwwroot . '/';
} else {
    $wantsurl = new moodle_url($SESSION->wantsurl);
    if ($PAGE->url->compare($wantsurl, URL_MATCH_BASE)) {
        $SESSION->wantsurl = $CFG->wwwroot . '/';
    }
}

if (isloggedin() and !isguestuser()) {
    // Prevent signing up when already logged in.
    echo $OUTPUT->header();
    echo $OUTPUT->box_start();
    $logout = new single_button(new moodle_url($CFG->httpswwwroot . '/login/logout.php',
        array('sesskey' => sesskey(), 'loginpage' => 1)), get_string('logout'), 'post');
    $continue = new single_button(new moodle_url('/'), get_string('cancel'), 'get');
    echo $OUTPUT->confirm(get_string('cannotsignup', 'error', fullname($USER)), $logout, $continue);
    echo $OUTPUT->box_end();
    echo $OUTPUT->footer();
    exit;
}

$mform_signup = $authplugin->signup_form();

if ($mform_signup->is_cancelled()) {
    redirect(get_login_url());

} else if ($user = $mform_signup->get_data()) {
    // Add missing required fields.
    $user = signup_setup_new_user($user);
    
    $authplugin->user_signup($user, true); // prints notice and link to login/index.php
    exit; //never reached
}


else if ($user = $mform_signup->get_data()) {
    // Add missing required fields.
    $user = signup_setup_new_user($user);
    
    if (!empty($_POST['t_field'])) {
        // Automated submission detected, reject the signup.
        // You can return an error message or redirect to an error page.
        $result = 'Automated submissions are not allowed.';
        file_put_contents($CFG->dirroot.'/local/lonet/log/payout.log', "\n\n" . date('Y-m-d H:i:s') . ": " . $result, FILE_APPEND);
    } else {
        $authplugin->user_signup($user, true); // prints notice and link to login/index.php
        exit; //never reached
    }
}






// make sure we really are on the https page when https login required
$PAGE->verify_https_required();


$newaccount = get_string('newaccount');
$login      = get_string('login');

$PAGE->navbar->add($login);
$PAGE->navbar->add($newaccount);

$PAGE->set_pagelayout('login');
$PAGE->set_title($newaccount);
$PAGE->set_heading(get_string('h1_signup', 'local_lonet'));

echo $OUTPUT->header();

if ($mform_signup instanceof renderable) {
    // Try and use the renderer from the auth plugin if it exists.
    try {
        $renderer = $PAGE->get_renderer('auth_' . $authplugin->authtype);
    } catch (coding_exception $ce) {
        // Fall back on the general renderer.
        $renderer = $OUTPUT;
    }
    echo $renderer->render($mform_signup);
} else {
    // Fall back for auth plugins not using renderables.
    $mform_signup->display();
}

echo "<script>
    $(document).ready(function() {
        $('label[for=\"id_timezone\"]').append('<span class=\"req\"></span>');
        $('.req').html(' *').css('color', 'crimson');

        const timezoneSelect = $('#id_timezone');
        timezoneSelect.attr('required', true);
        if (timezoneSelect.val() == 99) {
            timezoneSelect.prepend($('<option val=\"\"></option>'));
            timezoneSelect.val('');
        }
    });
</script>
<script>
    $(function () {
        $('#fitem_id_profile_field_othersource').hide();
        $('#fitem_id_profile_field_socialnetworks').hide();
        $('#id_profile_field_referrer').change(function () {
            if ($(this).val() == 'found on social networks') {
                $('#fitem_id_profile_field_socialnetworks').show();
            } else {
                $('#fitem_id_profile_field_socialnetworks').hide();
            }            
            if ($(this).val() == 'other source') {
                $('#fitem_id_profile_field_othersource').show();
            } else {
                $('#fitem_id_profile_field_othersource').hide();
            }
        });
    });
</script>
<script>
    $(function () {
        $('#fitem_id_profile_field_wantlearnlang').show();
        $('#id_profile_field_role').change(function () {
            if ($(this).val() == 'Teacher') {
                $('#fitem_id_profile_field_wantlearnlang').hide();
            } else {
                $('#fitem_id_profile_field_wantlearnlang').show();
                $('#fitem_id_profile_field_wantlearnlang').attr('required', '');
                $('#fitem_id_profile_field_wantlearnlang').attr('data-error', 'This field is required.');
            }
        });
    });
</script>
";
//                document.getElementById('id_profile_field_wantlearnlang').innerHTML = '<span color'red'>*</span>';
echo $OUTPUT->footer();
