<?php
use local_lonet\user;

require_once('../../config.php');
require_once($CFG->dirroot.'/local/lonet/lib.php');

global $DB;
global $USER;

$PAGE->set_context(context_system::instance());

require_login();

$url = 'https://lonet.academy/login/signup.php?ref=' . user::getReferralCodeById($USER->id);
$sent = 0;
$existing = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $emails_string = (isset($_POST['emails']) ? $_POST['emails'] : null);
        if ($emails_string) {
            $emails = explode(' ', $emails_string);
            foreach ($emails as $email) {
                $email = trim($email);
                if ($DB->get_record('user', ['email' => $email])) {
                    $existing++;
                } else {
                    $recipient = (object) [
                        'email' => $email,
                        'firstname' => $email,
                        'lastname' => '',
                        'maildisplay' => true,
                        'mailformat' => 1,
                        'id' => -1,
                        'firstnamephonetic' => '',
                        'lastnamephonetic' => '',
                        'middlename' => '',
                        'alternatename' => '',
                    ];
                    sendMail($recipient, 'referfriend', [
                        'link' => $url,
                        'name' => $USER->firstname,
                        'image' => $OUTPUT->user_picture($USER, ['size' => '72', 'link' => false]),
                    ]);
                    $sent++;
                }
            }
        }
	} catch (\Exception $e) {
        file_put_contents($CFG->dirroot.'/local/lonet/log/invite.log', print_r($_POST), FILE_APPEND);
        file_put_contents($CFG->dirroot.'/local/lonet/log/invite.log', print_r($e->getMessage()), FILE_APPEND);
        file_put_contents($CFG->dirroot.'/local/lonet/log/invite.log', print_r($e->getTraceAsString()), FILE_APPEND);
    }
}

// $id = (isset($_GET['id']) && $_GET['id'] ? $_GET['id'] : $USER->id);
$title = 'Refer a Friend'; // get_string('referafriend', 'local_lonet');

$PAGE->set_pagelayout('base');
$PAGE->set_title($title);
$PAGE->set_heading($title);
$PAGE->set_url('/local/lonet/invite.php');

echo $OUTPUT->header();
?>

<style>
.container-fluid.bg-grey{background:#FFFFFF;}
#referral-url {
    position: absolute;
    z-index: -1;
    bottom: 0;
}
.rtitle{
	color: #000;
	text-align: center;
	font-size: 24px;
	font-style: normal;
	font-weight: 700;
	line-height: normal;
}
.invite_page_subtitle{
	color: #4B5563;
	text-align: center;
	font-size: 20px;
	font-style: normal;
	font-weight: 400;
	line-height: normal;
}
.emaillabel{
	color: #4B5563;
	font-size: 18px;
	font-style: normal;
	font-weight: 500;
width: 885px;
    padding-bottom: 8px;
    margin: 0 auto;
}
#referral-email{
	width:680px;
	color: var(--Neutral-400, #9CA3AF);
font-size: 16px;
font-style: normal;
font-weight: 400;
line-height: 18px; 
height: 40px !important;
padding: 8px 12px !important;
	border-radius: 8px;
border: 1px solid var(--Neutral-200, #E5E7EB);
background: var(--Generic-White, #FFF);
box-shadow: 0px 1px 2px 0px rgba(16, 24, 40, 0.04), 0px 1px 2px 0px rgba(16, 24, 40, 0.04);
}
.send,.send:hover,.send:focus{
	border-radius: 60px;
border: 1px solid var(--Neutral-600, #4B5563);
background: var(--Generic-White, #FFF);
box-shadow: 0px 1px 0px 0px rgba(0, 0, 0, 0.04);
color: var(--Neutral-600, #4B5563);
text-align: center;
font-size: 18px;
font-style: normal;
font-weight: 400;
line-height: 24px; 
padding: 12px 20px;
text-shadow:none;
width: 141px;
outline:none;
}
.formfields{
	    width: 100%;
    display: flex;
    justify-content: center;
    gap: 64px;
	margin-bottom:32px;
}
.or{
	color: var(--Black, #000);
text-align: center;
font-size: 18px;
font-style: normal;
font-weight: 500;
margin-bottom:32px;
}
.btn-copy-link,.btn-copy-link:hover,.btn-copy-link:focus{
	    border-radius: 60px;
    border: 1px solid var(--Neutral-600, #4B5563);
    background: var(--Generic-White, #FFF);
    color: var(--Neutral-600, #4B5563);
    text-align: center;
    font-size: 18px;
    width: 215px;
    padding: 12px 20px;
    font-style: normal;
    box-shadow: 0px 1px 0px 0px rgba(0, 0, 0, 0.04);
    font-weight: 400;
    display: flex;
    justify-content: center;
    gap: 8px;
}
.copydiv{
width: 100%;
    display: flex;
    justify-content: center;	
}
.stepsdiv{
	width: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
	margin:0;
	gap:27px;
}
.steps{
	font-size: 18px;
    border-radius: 40px;
    background: var(--Neutral-50, #F9FAFB);
    box-shadow: 0px 2px 6px 0px rgba(16, 24, 40, 0.06);
    display: flex;
    padding: 34px 24px;
    justify-content: center;
    align-items: center;
    gap: 10px;
    width: 873px;
color: #374151;
text-align: center;
font-size: 20px;
font-style: normal;
font-weight: 500;
line-height: normal;
}
.invite_page_subtitle span{
	color: var(--Neutral-600, #4B5563);
font-size: 20px;
font-style: normal;
font-weight: 700;
line-height: normal;
}
</style>

<script>
	$(document).ready(function() {
        $('.btn-copy-link').click(function(e) {
            let referralLink = document.getElementById('referral-url');
            referralLink.select();
            document.execCommand('copy');
        });
	});
</script>

<h1 class="rtitle hidden"><?= get_string('invite_page_title', 'local_lonet') ?></h1>
<p class="invite_page_subtitle hidden">Invite a friend and when they take a lesson you will get <span>€10</span> on your balance in Lonet.Academy.<p>

<form method="post" class="referform navbar-form pull-left" style="margin-top: 64px;width:100%">
	<p class="emaillabel"><?= get_string('invite_page_email_title', 'local_lonet') ?></p>
    <div class="formfields">
        <input type="text" class="span11" id="referral-email" name="emails" placeholder="Fill in your friend’s email address">
        <button type="submit" class="btn btn-warning btn-large send"><?= get_string('invite_page_send_button', 'local_lonet') ?></button>
    </div>
</form>
<div class="alert" style="visibility: hidden;"></div>

<?php if ($sent) { ?>
<div class="alert alert-success" style="font-size: 18px;text-align: center;">
    <?= ($sent > 1 ? "$sent invites sent." : 'Invite sent.') ?>
</div>
<?php } ?>
<?php if ($existing) { ?>
<div class="alert alert-warning" style="font-size: 18px;text-align: center;">
    <?= "$existing invite(s) were not sent to existing users." ?>
</div>
<?php } ?>
<p class="or">or</p>
<div class="row-fluid" style="display:flex;">
    <div class="span3 hidden">
<!--        <a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode($url) ?>" target="_blank" class="btn btn-large btn-info btn-block" style="background: #4267B2;">
            <span class="fa fa-facebook" style="margin-right: 10px"></span><?= get_string('invite_page_button_facebook', 'local_lonet') ?>
        </a>
-->      
        <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?= urlencode($url) ?>" target="_blank" class="btn btn-large btn-info btn-block" style="background: #4267B2;">
            <span class="fa fa-linkedin" style="margin-right: 10px"></span><?= get_string('invite_page_button_linkedin', 'local_lonet') ?>
        </a>
    </div>
    <div class="span3 hidden">
        <a href="https://twitter.com/intent/tweet?url=<?= urlencode($url) ?>&text=<?= urlencode('Get EUR 10 credit for Lonet.Academy now!') ?>" target="_blank" class="btn btn-large btn-info btn-block" style="background: #1DA1F2;">
            <span class="fa fa-twitter" style="margin-right: 10px"></span><?= get_string('invite_page_button_twitter', 'local_lonet') ?>
        </a>
    </div>
    <div class="copydiv">
        <button type="button" class="btn btn-large btn-block btn-copy-link"><svg xmlns="http://www.w3.org/2000/svg" width="21" height="20" viewBox="0 0 21 20" fill="none">
  <path d="M11.4919 7.24035C11.8661 7.4191 12.2167 7.66343 12.5267 7.97335C13.9911 9.43782 13.9911 11.8122 12.5267 13.2766L8.77665 17.0267C7.31218 18.4911 4.93782 18.4911 3.47335 17.0267C2.00888 15.5622 2.00888 13.1878 3.47335 11.7234L4.93749 10.2592M16.0625 9.74079L17.5267 8.27665C18.9911 6.81218 18.9911 4.43782 17.5267 2.97335C16.0622 1.50888 13.6878 1.50888 12.2234 2.97335L8.47335 6.72335C7.00888 8.18782 7.00888 10.5622 8.47335 12.0267C8.78327 12.3366 9.13394 12.5809 9.50812 12.7597" stroke="#1F2937" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
</svg><?= get_string('invite_page_button_link', 'local_lonet') ?></button>
    </div>
</div>

<section class="container-fluid text-center" style="margin-top: 64px;">
    <h2 style="color: #374151;
text-align: center;
font-size: 24px;
font-style: normal;
font-weight: 700;
line-height: normal;margin-bottom:32px;"><?= get_string('invite_page_referral_title', 'local_lonet') ?></h2>
    <div class="row stepsdiv">
        <div class="col-sm-12 steps">
            <?php //get_string('invite_page_referral_subtitle_1', 'local_lonet') ?>
			1. Get your friends to join Lonet.Academy by following the invitation link.
        </div>
        <div class="col-sm-12 steps">
            <?php// get_string('invite_page_referral_subtitle_2', 'local_lonet') ?>
			2. Your friend gets €10 to spend on their first lesson on Lonet.Academy.
        </div>
        <div class="col-sm-12 steps">
            <?php // get_string('invite_page_referral_subtitle_3', 'local_lonet') ?>
			3. You get €10 to spend on Lonet.Academy after your friend completes their first lesson.
        </div>
    </div>
</section>

<input id="referral-url" value="<?= $url ?>">

<?php echo $OUTPUT->footer(); ?>
