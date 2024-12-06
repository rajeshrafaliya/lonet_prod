<?php
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
	echo '<div class="signupformcontainer">';
	echo '<h6 class="my-0">Log in or register with</h6>';
	$social_auth_html = '';
	$authsequence = get_enabled_auth_plugins(true); // Get all auths, in sequence.
	$potentialidps = array();
	foreach ($authsequence as $authname) {
		$authplugin = get_auth_plugin($authname);
		$potentialidps = array_merge($potentialidps, $authplugin->loginpage_idp_list($PAGE->url->out(false)));
	}
	if (!empty($potentialidps)) {
		$social_auth_html .= '<div class="potentialidps" style="margin-top:24px;margin-bottom:24px;">';
		$social_auth_html .= '<div class="potentialidplist">';
		foreach ($potentialidps as $idp) {
			$social_auth_html .= '<div class="col-sm-6 potentialidp">';
			$social_auth_html .= '<a class="" ';
			$social_auth_html .= 'href="' . $idp['url']->out() . '" title="' . s($idp['name']) . '">';
			if (!empty($idp['iconurl'])) {
				if($idp['name'] == 'Google'){
					$social_auth_html .= '<img src="'.$CFG->wwwroot.'/theme/lonet/pix/auth/google.svg"/>';
				}elseif($idp['name'] == 'LinkedIn' || $idp['name'] == 'Linkedin'){
					$social_auth_html .= '<img src="'.$CFG->wwwroot.'/theme/lonet/pix/auth/linkedin.svg"/>';
				}elseif($idp['name'] == 'facebook'){
					$social_auth_html .= '<img src="'.$CFG->wwwroot.'/theme/lonet/pix/auth/facebook.svg"/>';
				}else{	
					$social_auth_html .= '<img src="' . s($idp['iconurl']) . '"/>';
				}
			}
			$social_auth_html .= '</a></div>';
		}
		$social_auth_html .= '</div>';
		$social_auth_html .= '</div>';
	}
	echo $social_auth_html;
	echo '<h6 class="my-0" style="padding-bottom:24px;">or email</h6>';
    echo $renderer->render($mform_signup);
	echo '</div>';
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
echo '<style>
#page-login-signup .top-section {
	display:none;
}
#mform1{width: 480px;}
#mform1 #fitem_id_email{display: flex;flex-direction: column;}
#mform1 .fitemtitle{width: 100%;text-align: left;}
#mform1 .felement.ftext,#mform1 .felement.fpassword,#mform1 .felement.fselect,#mform1 .felement.fcheckbox{width: 100%;margin-left: 0px;}
#page-login-signup [role="main"]{
	display: flex;
    width: 100%;
    justify-content: center;
}
#fitem_id_profile_field_referrer,#fitem_id_profile_field_wantlearnlang,#fitem_id_profile_field_videourl,#fitem_id_profile_field_useinmarketing,#fitem_id_profile_field_citizenship,#fitem_id_profile_field_iknumber,#id_policyagreement .ftoggler, #id_policyagreement #fitem_id_policylink,#fitem_id_policyagreed .fitemtitle, #id_category_1 .ftoggler, #id_category_2 .ftoggler,.collapsible-actions{display:none !important;}
#id_category_1,#id_category_2,#id_category_6{padding:0px !important;}
fieldset.hidden{padding:0px;margin:0px;}
.signupformcontainer{
	display: flex;
    width: 873px;
    padding: 32px 0px;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    border-radius: 40px;
    background: var(--Colors-Primary, #FFF);
}
#page-login-signup{background: #F9FAFB;}
#page-login-signup label{
	color: var(--Neutral-600, #4B5563);
	font-size: 18px;
	font-style: normal;
	font-weight: 500;
	line-height: 0%;
}
#fitem_id_policyagreed label,#fitem_id_policyagreed a{
color: #6B7280;
font-size: 14px;
font-style: normal;
font-weight: 400;
line-height: normal;
}
#fitem_id_policyagreed a{text-decoration:underline;}
#id_policyagreed{width:24px;}
#id_firstname,#id_email,#id_password,#id_timezone,#id_profile_field_role{
	border-radius: 8px;
    border: 1px solid var(--Neutral-200, #E5E7EB);
    height: 40px !important;
    padding: 8px 12px !important;
	width: 480px;
    background: var(--Colors-Primary, #FFF);
    box-shadow: 0px 1px 2px 0px rgba(16, 24, 40, 0.04), 0px 1px 2px 0px rgba(16, 24, 40, 0.04);
	outline:none;
}
#page-login-signup .fitem{
	margin-bottom: 32px;
}
#page-login-signup #id_submitbutton,#page-login-signup #id_submitbutton:focus{
	width: 200px;
	padding: 12px 20px;
	border-radius: 60px;
	border: 1px solid rgba(17, 24, 39, 0.15);
	background: #CE1369;
	box-shadow: 0px 1px 0px 0px rgba(0, 0, 0, 0.04);
	color: #FFF;
	text-align: center;
	font-size: 18px;
	font-style: normal;
	font-weight: 400;
	line-height: 24px; 
	text-shadow:none;
	outline:none;
}
#page-login-signup .signupformcontainer h6{
	color: var(--Neutral-500, #6B7280);
	text-align: center;
	font-size: 20px;
	font-style: normal;
	font-weight: 500;
	line-height: normal;
}
#fitem_id_recaptcha_element .fitemtitle{display:none;}
#fitem_id_recaptcha_element .felement.frecaptcha,#fitem_id_submitbutton{
	margin: 0;
	display: flex;
	justify-content: center;
	align-items: center;
	width: 100%;
flex-direction: column;
}
#fitem_id_submitbutton .fsubmit{margin:0;}
#fitem_id_policyagreed{margin-bottom:24px !important;}
</style>';
echo $OUTPUT->footer();
