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
#referral-url {
    position: absolute;
    z-index: -1;
    bottom: 0;
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

<h1><?= get_string('invite_page_title', 'local_lonet') ?></h1>
<p style="font-size: 1.5em;"><?= get_string('invite_page_subtitle', 'local_lonet') ?><p>
<br>
<p><?= get_string('invite_page_email_title', 'local_lonet') ?></p>

<form method="post" class="navbar-form pull-left" style="margin-bottom: 45px;">
    <div class="input-group input-group-large">
        <input type="text" class="span11" id="referral-email" name="emails" style="height: 44px !important; padding: 11px 19px; font-size: 17.5px;">
        <button type="submit" class="btn btn-warning btn-large"><?= get_string('invite_page_send_button', 'local_lonet') ?></button>
    </div>
</form>

<br>
<br>
<div class="alert" style="visibility: hidden;"></div>

<?php if ($sent) { ?>
<div class="alert alert-success">
    <?= ($sent > 1 ? "$sent invites sent." : 'Invite sent.') ?>
</div>
<?php } ?>
<?php if ($existing) { ?>
<div class="alert alert-warning">
    <?= "$existing invite(s) were not sent to existing users." ?>
</div>
<?php } ?>

<div class="row-fluid">
    <div class="span3">
<!--        <a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode($url) ?>" target="_blank" class="btn btn-large btn-info btn-block" style="background: #4267B2;">
            <span class="fa fa-facebook" style="margin-right: 10px"></span><?= get_string('invite_page_button_facebook', 'local_lonet') ?>
        </a>
-->      
        <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?= urlencode($url) ?>" target="_blank" class="btn btn-large btn-info btn-block" style="background: #4267B2;">
            <span class="fa fa-linkedin" style="margin-right: 10px"></span><?= get_string('invite_page_button_linkedin', 'local_lonet') ?>
        </a>
    </div>
    <div class="span3">
        <a href="https://twitter.com/intent/tweet?url=<?= urlencode($url) ?>&text=<?= urlencode('Get EUR 10 credit for Lonet.Academy now!') ?>" target="_blank" class="btn btn-large btn-info btn-block" style="background: #1DA1F2;">
            <span class="fa fa-twitter" style="margin-right: 10px"></span><?= get_string('invite_page_button_twitter', 'local_lonet') ?>
        </a>
    </div>
    <div class="span3">
        <button type="button" class="btn btn-large btn-block btn-copy-link"><?= get_string('invite_page_button_link', 'local_lonet') ?></button>
    </div>
</div>

<section class="container-fluid text-center" style="margin-top: 90px;">
    <h2><?= get_string('invite_page_referral_title', 'local_lonet') ?></h2>
    <div class="row">
        <div class="col-sm-4" style="font-size: 18px;">
            <?= get_string('invite_page_referral_subtitle_1', 'local_lonet') ?>
        </div>
        <div class="col-sm-4" style="font-size: 18px;">
            <?= get_string('invite_page_referral_subtitle_2', 'local_lonet') ?>
        </div>
        <div class="col-sm-4" style="font-size: 18px;">
            <?= get_string('invite_page_referral_subtitle_3', 'local_lonet') ?>
        </div>
    </div>
</section>

<input id="referral-url" value="<?= $url ?>">

<?php echo $OUTPUT->footer(); ?>
