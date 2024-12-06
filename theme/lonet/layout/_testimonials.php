<?php
use local_lonet\user;

global $DB;
global $SESSION;

$language = substr($SESSION->lang ?? 'en', 0, 2);
if (!$language) {
    $language = 'en';
}
$limit = ($is_mobile ? 1 : 2);
$testimonials = $DB->get_records_sql('SELECT * FROM {lonet_testimonial} WHERE isactive = 1 AND `language` = \'' . $language . '\' ORDER BY createdat DESC LIMIT ' . $limit);

if ($testimonials) {
    $count = count($testimonials);
    $class = ($count == 1 ? 'col-sm-offset-1 col-sm-10' : 'col-sm-6');
    $userTimezone = core_date::get_user_timezone_object(); ?>
    <div class="container container-testimonials">
        <div class="row row-testimonials">
            <div class="col-sm-12">
                <h1><?= get_string('whatmemberssay', 'theme_lonet') ?></h1>
            </div>
            <?php foreach ($testimonials as $testimonial) { ?>
                <div class="<?= $class ?> container-review">
                    <p>
                        <?= user::getPublicDisplay($testimonial->userid) ?>
                        <span class="review-date"><?= (new DateTime('now', $userTimezone))->setTimestamp($testimonial->createdat)->format('D, M j, Y'); ?></span>
                        <br>
                        <i style="font-size: 0.9em"><?= user::getTestimonialSubtitle($testimonial->userid) ?></i>
                    </p>
                    <blockquote><i><?= $testimonial->abstract ?></i></blockquote>
                        <?php if ($testimonial->url) { ?>
                        <p class="text-right">
                            <a href="<?= $testimonial->url ?>" target="_blank"><?= get_string('readfulltestimonial', 'theme_lonet') ?>...</a>
                        </p>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            var maxHeight = 0;
            $('.container-review blockquote').each(function() {
                let height = $(this).height();
                maxHeight = height > maxHeight ? height : maxHeight;
            });
            $('.container-review blockquote').css('height', maxHeight + 'px');
        });
    </script>
<?php } ?>
