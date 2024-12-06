<?php
use \DateTime;

require_once('../../config.php');
require_once($CFG->dirroot.'/local/lonet/lib.php');

$teacherid = (isset($_GET['teacherid']) ? $_GET['teacherid'] : null);
$title = get_string('schedule', 'local_lonet');

$PAGE->set_context(context_system::instance());
$PAGE->set_pagelayout('base');
$PAGE->set_title($title);
$PAGE->set_heading($title);
$PAGE->set_url('/local/lonet/schedule.php?teacherid=' . $teacherid);

$week = (isset($_GET['week']) ? $_GET['week'] : 0);

echo $OUTPUT->header();

if ($teacherid) { ?>
	<?= renderFile('_schedule.php', ['teacherid' => $teacherid, 'week' => $week]) ?>
<?php } else { ?>
	<div class="alert alert-danger">
		<?= get_string('notsetup', 'local_lonet') ?>
	</div>
<?php }?>
<br>
<?= $OUTPUT->footer() ?>

