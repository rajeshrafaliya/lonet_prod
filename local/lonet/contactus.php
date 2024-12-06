<?php
require_once('../../config.php');
require_once($CFG->dirroot.'/local/lonet/lib.php');
global $SESSION,$USER,$PAGE;
$PAGE->set_context(context_system::instance());
$PAGE->set_pagelayout('list');
$PAGE->set_title($title);
$PAGE->set_heading($title);
$PAGE->set_url($PAGE->url);
$PAGE->requires->css('/local/lonet/style.css');
echo $OUTPUT->header();
echo '<div class="contactbox">
<h5 class="my-0">'.get_string('contactinfo','local_lonet').'</h5>
<div>
<div class="emailbox">
<div><img src="'.$CFG->wwwroot.'/theme/lonet/pix/contactus/email.svg" alt=""></div>
<div>
<h6>'.get_string('email','local_lonet').'</h6>
<p>lonet@lonet.academy</p>
</div>
</div>
<div class="address">
<div><img src="'.$CFG->wwwroot.'/theme/lonet/pix/contactus/message.svg" alt=""></div>
<div>
<h6>'.get_string('contactaddress','local_lonet').'</h6>
<p>Vidzemes aleja 3 - 63, LV-1024, Rīga, Latvia</p>
</div>
</div>
<div class="whatsapp">
<div><img src="'.$CFG->wwwroot.'/theme/lonet/pix/contactus/whatsapp.svg" alt=""></div>
<div>
<h6>'.get_string('contactwhat','local_lonet').'</h6>
<p>+371 27 344 201</p>
</div>
</div>
</div>

<div class="followus">
<p>'.get_string('followus','local_lonet').'</p>
<a href="https://www.youtube.com/@lonetacademy5349" target="_blank"><img src="'.$CFG->wwwroot.'/theme/lonet/pix/contactus/yt.png" alt="Lonet Academy Youtube Channel" style="width: 30px;height: 21.1px;"></a>
<a href="https://www.instagram.com/lonet.academy/" target="_blank"><img src="'.$CFG->wwwroot.'/theme/lonet/pix/contactus/insta.png" alt="Lonet Academy Instagram Page" style="width: 29.982px;height: 29.994px;"></a>
<a href="https://www.linkedin.com/company/lonet/" target="_blank"><img src="'.$CFG->wwwroot.'/theme/lonet/pix/contactus/linkedin.png" alt="Lonet Academy Linkedin Page" style="width: 30px;height: 30px;"></a>
<a href="https://www.facebook.com/lonet.academy" target="_blank"><img src="'.$CFG->wwwroot.'/theme/lonet/pix/contactus/fb.png" alt="Lonet Academy Page" style="width: 30px;height: 30px;"></a>
</div>
</div>';
?>
<div class="suboverrideimg contactsuboverride" style="margin-top:-140px;width:auto;right:0;">
<img src="<?= $CFG->wwwroot ?>/theme/lonet/pix/suboverride.png">
</div>
<?php
subscribe_newsletter();
echo $OUTPUT->footer();
