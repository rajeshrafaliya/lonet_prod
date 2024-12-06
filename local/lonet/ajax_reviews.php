<?php
use local_lonet\teacher;

require_once('../../config.php');
require_once($CFG->dirroot.'/local/lonet/lib.php');

$teacherid = (isset($_GET['teacherid']) ? $_GET['teacherid'] : null);

if ($teacherid) {
	$reviews = teacher::get_reviews($teacherid);
}
if ($teacherid && $reviews) { ?>
	<div class="row">
		<?= renderFile('_reviews.php', ['reviews' => $reviews]) ?>
	</div>
<?php } else { ?>
	<div class="alert alert-danger">
		<?= get_string('notrated', 'local_lonet') ?>
	</div>
<?php }?>
