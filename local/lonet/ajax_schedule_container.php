<?php
use local_lonet\category;
use local_lonet\lesson;
use local_lonet\teacher;
use local_lonet\user;

require_once('../../config.php');
require_once($CFG->dirroot.'/local/lonet/lib.php');

$PAGE->set_context(context_system::instance());
$teacherid = (isset($_GET['teacherid']) ? $_GET['teacherid'] : null);
$week = (isset($_GET['week']) ? $_GET['week'] : 0);
$current_language = (isset($_GET['language']) ? $_GET['language'] : null);
$lessons = ($teacherid ? lesson::get_by_teacherid($teacherid, $current_language) : []);
$grouplessons = ($teacherid ? lesson::get_grouplesson_by_teacherid($teacherid, $current_language) : []);
$languages = ($teacherid ? teacher::get_languages($teacherid) : []);
$has_language_selection = (count($languages) > 1);
$can_book_trial = user::can_book_trial($teacherid, ($current_language ? $current_language : (!$has_language_selection ? key($languages) : null)));

if ($teacherid && $lessons) { ?>
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
	</div>
	<div class="modal-body">
		<div class="row">
			<?php if (!$has_language_selection) { ?>
				<div id="language-selection" class="col-sm-12" style="display: none;">
					<input type="radio" name="language" value="<?= key($languages) ?>" checked style="display: none;">
				</div>
			<?php } else { ?>
				<div class="col-sm-12 step-0">
					<p><strong><?= get_string('step', 'local_lonet') ?> 1: <?= get_string('selectlanguage', 'local_lonet') ?><strong></p>
				</div>
				<div id="language-selection" class="col-sm-12">
					<?php foreach ($languages as $code => $language) { ?>
						<input type="radio" id="language-<?= $code ?>" name="language" value="<?= $code ?>" <?= ($code == $current_language ? 'checked' : '') ?>>
						<label for="language-<?= $code ?>"><strong><?= $language ?></strong></label>
					<?php } ?>
				</div>
			<?php } ?>
			<div class="col-sm-12 step-1" <?= ($has_language_selection && !$current_language ? 'style="display: none;"' : '') ?>>
				<p><strong><?= get_string('step', 'local_lonet') ?> <?= ($has_language_selection ? 2 : 1) ?>: <?= get_string('selectlesson', 'local_lonet') ?><strong></p>
			</div>
			<div id="lesson-selection" class="col-sm-12" <?= ($has_language_selection && !$current_language ? 'style="display: none;"' : '') ?>>
				<div class="expandindi"><span class="btn"><?= get_string('indilessons','local_lonet')?></span><p></p></div>
				<div class="indilessoncontainer" style="display:none;">
				<?php foreach ($lessons as $lesson) {
					if (!$lesson->istrial || $can_book_trial) {
						$style = (!$has_language_selection || !$lesson->language || $lesson->language == $current_language ? '' : 'style="display: none;"'); ?>
						<input type="radio" id="lesson-<?= $lesson->id ?>" name="lessonid" data-grouplesson= "<?= base64_encode(0) ?>" data-length="<?= $lesson->length ?>" data-name="<?= $lesson->name ?>" value="<?= $lesson->id ?>" data-trial="<?= ($lesson->istrial ? 1 : 0) ?>" data-language="<?= $lesson->language ?>">
						<label for="lesson-<?= $lesson->id ?>" <?= $style ?>><strong><?= $lesson->name ?></strong> &euro;<?= lesson::get_price($lesson)?> (<?= get_string('numminutes', 'core_moodle', max(30, (($lesson->length / 60) - 10))) ?>)</label>
					<?php }
				} ?>
				</div>
				<div class="expandgroup"><span class="btn"><?= get_string('grouplessons','local_lonet')?></span><p></p></div>
				<div class="grouplessoncontainer" style="display:none;">
				<?php foreach ($grouplessons as $glesson) {
					if (!$glesson->istrial || $can_book_trial) {
						$timeinsec =  $glesson->timeto - $glesson->timefrom;
						$glessontimes = lesson::get_grouplesson_times_withoutsecond($glesson->id);
						$glessonmembers = lesson::count_group_lessons_members($glesson->id);
						$lessondate = ($glesson->timefrom ? (new DateTime('now', core_date::get_user_timezone_object()))->setTimestamp($glesson->timefrom)->format('Y-m-d') : null);
						$lessondatedisplay = ($glesson->timefrom ? (new DateTime('now', core_date::get_user_timezone_object()))->setTimestamp($glesson->timefrom)->format('D, M j') : null);
						$style = (!$has_language_selection || !$glesson->language || $glesson->language == $current_language ? '' : 'style="display: none;"'); 
						if(empty($glessonmembers)){
							$attendees_msg = 'Be the first!';
						}
						$attendees_per = ($glessonmembers/$glesson->maxamount)*100;
						if($attendees_per > 70){
							$attendees_msg = 'Likely to sell out';
						}
						?>
						<input type="radio" id="lesson-<?= $glesson->id ?>" name="lessonid" data-maxamountreq="<?= base64_encode($glesson->maxamount) ?>" data-currentusers="<?= base64_encode($glessonmembers) ?>" data-grouplesson= "<?= base64_encode(1) ?>" data-length="<?= abs($timeinsec) ?>" data-name="<?= $glesson->lessonname ?>" value="<?= $glesson->id ?>" data-trial="<?= ($glesson->istrial ? 1 : 0) ?>" data-language="<?= $glesson->language ?>" data-gdate="<?=$lessondate;?>" data-gtimefrom="<?= $glessontimes->timefrom ?>" data-gtimeto="<?= $glessontimes->timeto ?>">
						<label for="lesson-<?= $glesson->id ?>" <?= $style ?>>
						<strong><?= $glesson->lessonname ?></strong></br>
						<span>Price: &euro;<?= lesson::get_grouplesson_price($glesson)?></span></br>
						<span>Duration: <?= get_string('numminutes', 'core_moodle', ((abs($glesson->timefrom-$glesson->timeto) / 60) - 10)) ?></span></br>
						<span>Date: <?= $lessondatedisplay; ?></span></br>
						<span>Time: <?= $glessontimes->timefrom; ?></span></br>
						<span>Attendees: <?=$glesson->minamount;?>-<?=$glesson->maxamount;?></span></br>
						<span>Places left: <?= $glesson->maxamount-$glessonmembers;?><span>&nbsp;&nbsp;(<?= $attendees_msg; ?>)</span></span>
						</label>
					<?php }
				} ?>
				</div>
			</div>
			<div class="col-sm-12 step-2" style="display: none;">
				<strong><?= get_string('step', 'local_lonet') ?> <?= ($has_language_selection ? 3 : 2) ?>: <?= get_string('selecttime', 'local_lonet') ?></strong>
			</div>
			<div class="col-sm-12 step-3" style="display: none;">
				<button class="btn btn-success"><?= get_string('confirmandpay', 'local_lonet') ?></button>
			</div>
		</div>
		<div class="schedule-container" <?= ($USER->id ? 'style="display:none;"' : '') ?>>
			<?= renderFile('_schedule.php', ['teacherid' => $teacherid, 'week' => $week]) ?>
		</div>
		<div class="row">
			<div class="col-sm-12 step-3" style="display: none;">
				<button class="btn btn-success"><?= get_string('confirmandpay', 'local_lonet') ?></button>
			</div>
		</div>
	</div>
<?php } else { ?>
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
	</div>
	<div class="modal-body">
		<div class="alert alert-danger">
			<?= get_string('notsetup', 'local_lonet') ?>
		</div>
	</div>
<?php }?>
