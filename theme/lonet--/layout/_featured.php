<?php
use local_lonet\category;
use local_lonet\language;
use local_lonet\teacher;

global $DB;

$shown = [];
$languages = language::get_all_with_teachers();
?>
<div class="container-fluid">
    <div class="course_container ourfeaturedcourses">
        <div class="col-sm-12">
            <h1><?= get_string('chooselanguage', 'theme_lonet') ?></h1>
        </div>
        <div class="row">
            <?php
            $image_index = 1;
            $max_image_index = 16;
            foreach ($languages as $language) {
                $image = ($language->image ? $language->image : $image_index);
                $code = explode('_', $language->code)[0];
                if (!in_array($code, $shown)) {
                    $url = language::get_full_url($language);
                    $lang_name = category::get_name($code);
                    $bg_image_url = ($image == $image_index ? "/theme/lonet/pix/course/" . str_pad($image, 2, 0, STR_PAD_LEFT) . ".jpg" : "/theme/lonet/pix/course/$image");
                    ?>
                    <div class="item col-xs-6 col-sm-4 col-md-3">
                        <div class="course-box">
                        <a href="<?php echo $url ?>">
                            <div class="course-picture" data-background="<?= $bg_image_url ?>"></div>
                        </a>
                            <div class="course-content">
                                <h2><a href="<?php echo $url ?>"><?= $lang_name ?></a></h2>
                                <a href="<?php echo $url ?>" class="course-link"><?= get_string('viewallteachers', 'theme_lonet') ?></a>
                            </div>
                        </div>
                    </div>
                    <?php
                    if ($image == $image_index) {
                        if (++$image_index > $max_image_index) {
                            $image_index = 1;
                        }
                    }
                    $shown[] = $code;
                }
                ?>
            <?php } ?>
        </div>
    </div>
</div>
