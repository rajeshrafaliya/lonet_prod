<?php
use local_lonet\teacher;
use local_lonet\user;

defined('MOODLE_INTERNAL') || die();

global $DB;
global $OUTPUT;
?>

<?php foreach ($reviews as $review) { ?>
	<div class="col-sm-12 container-review">
		<p>
			<?= user::getPublicDisplay($review->authorid) ?>
			<span class="review-date"><?= (new DateTime('now', core_date::get_user_timezone_object()))->setTimestamp($review->date)->format('D, M j, Y'); ?></span>
		</p>
		<?= teacher::render_stars($review->rating) ?>
		<blockquote><i><?= $review->comment ?></i></blockquote>
	</div>
<?php } ?>
