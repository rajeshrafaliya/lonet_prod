<?php
use local_lonet\teacher;
use local_lonet\user;

defined('MOODLE_INTERNAL') || die();

global $DB;
global $OUTPUT;

$max_reviews_to_show = 3; // Number of reviews to show initially
$review_count = 1; // Counter to track number of reviews shown
$total_reviews = count($reviews); // Total number of reviews
?>

<div id="reviews-container">
<?php foreach ($reviews as $review) { 
    if(empty($review->authorid)){continue;}
    $user = $DB->get_record_sql("SELECT * FROM {user} WHERE id=".$review->authorid."");
?>
    <div class="col-sm-12 container-review <?= $review_count > $max_reviews_to_show ? 'hidden-review' : '' ?>" <?= $review_count > $max_reviews_to_show ? 'style="display:none;"' : '' ?>>
        <div class="firstsection" style="display: flex;flex-direction: row;align-items:center;">
            <div><?= user::getPublicDisplay($review->authorid) ?></div>
            <div>
                <div>
                    <a class="username" href="/user/<?= $user->id ?>" target="_blank" rel="noopener noreferrer"><?= $user->firstname . ' ' . substr($user->lastname, 0, 1) ?>
                    </a>
                    <span class="review-date"><?= (new DateTime('now', core_date::get_user_timezone_object()))->setTimestamp($review->date)->format('D, M j, Y'); ?></span>
                </div>
                <div>
                    <?= teacher::render_stars_new($review->rating) ?>
                </div>
            </div>
        </div>
        <div class="secondsection">
            <blockquote><?= $review->comment ?></blockquote>
        </div>
    </div>
<?php $review_count++; } ?>
</div>

<?php if ($total_reviews > $max_reviews_to_show) { ?>
	<div class="reviewbtns">
		<button id="load-morer" class="btn btn-primary bookconsultbtn mt-0" style="width:auto;">Load More</button>
		<button id="show-lessr" class="btn btn-secondary showlessr" style="display:none;">Show Less</button>
	</div>
<?php } ?>
