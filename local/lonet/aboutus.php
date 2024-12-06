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
?>
<div class="aboutus_section1" style="background-image:url('<?= $CFG->wwwroot ?>/theme/lonet/pix/about_us_hero.png');height: 642px;padding: 72px 112px;background-repeat:no-repeat;">
<div>
<h3 class="my-0">Transforming learning, connecting futures</h3>
<p>We redefine personalized language learning by classifying language educators into roles of language tutors, coaches, and language trainers.</p>
</div>
</div>
<div class="missionstatementbox">
	<h3><?= get_string('missionstatement','local_lonet') ?></h3>
	<div class="outmissioncontainer">
		<div class="ourmissiontitle"><?= get_string('ourmissionis','local_lonet') ?></div>
		<div class="ourmissions">
			<div class="button-container">
				<div class="button button-1"><?= get_string('tocreate','local_lonet') ?></div>
				<div class="button button-2"><?= get_string('asafe','local_lonet') ?></div>
			</div>
			<div class="button-container">
				<div class="button button-1"><?= get_string('for','local_lonet') ?></div>
				<div class="button button-2"><?= get_string('eduaroundwrld','local_lonet') ?></div>
			</div>
			<div class="button-container">
				<div class="button button-1"><?= get_string('by','local_lonet') ?></div>
				<div class="button button-2"><?= get_string('easetouseinno','local_lonet') ?></div>
			</div>
			<div class="button-container">
				<div class="button button-1"><?= get_string('where','local_lonet') ?></div>
				<div class="button button-2"><?= get_string('connect_engage','local_lonet') ?></div>
			</div>
		</div>
	</div>
</div>
<div class="psychology">
	<div class="leftbox">
	<h3 class="my-0"><?= get_string('corephilo','local_lonet') ?></h3>
	<p class="my-0"><?= get_string('corephilo_desc','local_lonet') ?></p>
	</div>
	<div class="rightbox">
	<img src="<?= $CFG->wwwroot ?>/theme/lonet/pix/mindset.png">
	</div>
</div>
<h3 class="missionsingletitle my-0"><?= get_string('lonetmission','local_lonet') ?></h3>
<div class="onamission">
	<h4 class="my-0"><?= get_string('missionculture','local_lonet') ?></h4>
	<p class="my-0 py-0"><?= get_string('onamission_desc','local_lonet') ?></p>
</div>
<div class="visionboxes">
<div class="ourvisi">
<h4 class="my-0"><?= get_string('ourvision','local_lonet') ?></h4>
<p class="my-0 pt-1"><?= get_string('ourvisiondesc','local_lonet') ?></p>
</div>
<div class="ourbeli">
<h4 class="my-0"><?= get_string('ourbelive','local_lonet') ?></h4>
<p class="my-0 pt-1"><?= get_string('ourbelivedesc','local_lonet') ?></p>
</div>
</div>
<?= subscribe_newsletter() ?>
<?php
echo $OUTPUT->footer();
