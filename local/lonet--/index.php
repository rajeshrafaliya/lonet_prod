<?php
use local_lonet\category;
use local_lonet\language;
use local_lonet\teacher;
use local_lonet\user;

require_once('../../config.php');
require_once($CFG->dirroot.'/local/lonet/lib.php');
global $SESSION,$USER,$PAGE;

$PAGE->requires->css('/local/lonet/style.css');

$language_model = null;
if (isset($_GET['url'])) {
    $language_model = language::get_by_url($_GET['url']);
    $language = $language_model->code ?? null;
} else {
    $language = (isset($_GET['language']) ? $_GET['language'] : null);
}
//echo "<pre>";
//print_r($_REQUEST);
if(isset($_GET['language_teacher'])){
    $language = ($_GET['language_teacher'] ?? 0);
    $language_url = "?language_teacher=".$language;
}

$page = (int) ($_GET['page'] ?? 1);

$demourl = '';
switch ($language_model->code ?? $language) {
    case 'ar':
        $demourl = user::getEmbedUrl('https://www.youtube.com/watch?v=VvJ10UJqL6E&t=26s', 1);
        break;
    case 'en':
        $demourl = user::getEmbedUrl('https://www.youtube.com/watch?v=F91latl0GxE', 1);
        break;
    case 'es':
        $demourl = user::getEmbedUrl('https://www.youtube.com/watch?v=VUCYA0SC_Fw&t=155s ', 1);
        break;
    case 'de':
        $demourl = user::getEmbedUrl('https://www.youtube.com/watch?v=D77xmrqKSkQ', 1);
        break;
    case 'it':
        $demourl = user::getEmbedUrl('https://www.youtube.com/watch?v=8fb5KJZMeKs', 1);
        break;
    case 'lv':
        $demourl = user::getEmbedUrl('https://www.youtube.com/watch?v=6JzZkI3OgrI', 1);
        break;
}

$language_name = category::get_name($language);
if (substr($SESSION->lang, 0, 2) == 'ru') {
    switch ($language) {
        case 'he':
            $language_name = mb_strtolower($language_name) . 'у';
            $title = rtrim(get_string('languagetutors', 'local_lonet', $language_name), 'языку');
            break;
        case 'hi':
            $language_name = mb_strtolower($language_name);
            $title = rtrim(get_string('languagetutors', 'local_lonet', $language_name), 'языку');
            break;
        case 'la':
            $language_name = 'латыни, латинскому';
            break;
        default:
            $language_name = mb_substr(mb_strtolower($language_name), 0, -2) . 'ому';
    }
}
if (!isset($title)) {
    $title = ($language ? get_string('languagetutors', 'local_lonet', $language_name) : get_string('h1_teacher_list', 'local_lonet'));
}
$page_url = language::get_full_url($language_model).$language_url;
$PAGE->set_context(context_system::instance());
$PAGE->set_pagelayout('list');
$PAGE->set_title($title);
$PAGE->set_heading($title);
$PAGE->set_url($page_url);

$teachers = teacher::get_by_language($language, $page);
$clanguage = explode('_', current_language())[0];
// $grouplessonlink = language::get_grouplesson_page_url($clanguage);
$grouplessonlink = language::get_full_url_group($clanguage,$language);
echo $OUTPUT->header();
$buttons_top = '<span class="container-buttons pull-right">
	<span class="badge badge-teacher" style="text-transform: uppercase;position: absolute;margin-left: -25px;">'.get_string('badge_new','local_lonet').'</span>
	<a class="btn btn-success btn-lonet btn-sm" href="'.$grouplessonlink.'&lang='.$clanguage.'" target="_blank" rel="noopener noreferrer">'.get_string('grouplessons','local_lonet').'</a>	
    <a class="btn btn-success btn-lonet btn-sm" href="/language-tutor-consultation" target="_blank" rel="noopener noreferrer">' . get_string('applyforconsultation', 'theme_lonet') . '</a>
    ' . ($USER->id <= 0 ? '<a class="btn btn-success btn-lonet btn-sm" href="/login/signup.php" target="_blank" rel="noopener noreferrer">' . get_string('register', 'theme_lonet') . '</a>' : '') . '
    ' . ($demourl ? '<a class="btn btn-success btn-lonet btn-sm" href="#demo">' . get_string('watchdemolesson', 'local_lonet') . '</a>' : '') . '
</span>';
$buttons_bottom = ($USER->id <= 0 ? '<p class="container-buttons text-right">
    <a class="btn btn-success btn-lonet btn-sm" href="/login/signup.php" target="_blank" rel="noopener noreferrer">' . get_string('register', 'theme_lonet') . '</a>
    <a class="btn btn-success btn-lonet btn-sm" href="/login/signup.php?teacher=1" target="_blank" rel="noopener noreferrer">' . get_string('becometeacher', 'theme_lonet') . '</a>
</p>' : '');

if ($teachers) { ?>
    <style>
        .hero-unit {
            padding: 30px 30px 20px;
        }
        .hero-unit li {
            margin: 5px 0 5px 15px;
        }
        .hero-unit h1 {
            margin-top: 0;
            font-size: 1.6em;
        }
        .hero-unit .link {
            margin-top: 10px;
        }
        .hero-unit-content {
            height: auto;
            overflow: hidden;
        }
        
        a[disabled] {
            color: gray;
            cursor: default;
            pointer-events: none;
        }
        
        .teacher-pagination > a {
            margin: 2px 4px;
            padding: 4px 10px;
            border-radius: 4px;
            color: white;
        }
        .teacher-pagination > a.active {
            background: #499306;
        }
    </style>
<script>

$(document).ready(function() {
  $('#language_teacher').on('change', function() {
     
        //document.forms[languageteacher].submit();
     this.form.submit()
     
  });
});


</script>
    <script>
        $(document).ready(function() {
            $('.btn-view-schedule').click(function(e) {
                e.stopPropagation();
                $.ajax({
                    type: 'GET',
                    url: '/local/lonet/ajax_schedule_container.php?teacherid=' + $(this).attr('data-teacherid') + '&language=<?= $language ?>',
                    dataType: 'text',
                    success: function(result){
                        if (result) {
                            $('#schedule-modal .modal-content').html(result);
                            $('#schedule-modal').modal();
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError){
                        swal('Server Error Occured', xhr.responseText, 'error');
                    }
                });
            });
            $('.btn-view-reviews').click(function(e) {
                e.stopPropagation();
                $.ajax({
                    type: 'GET',
                    url: '/local/lonet/ajax_reviews.php?teacherid=' + $(this).attr('data-teacherid'),
                    dataType: 'text',
                    success: function(result){
                        if (result) {
                            $('#reviews-modal .modal-body').html(result);
                            $('#reviews-modal').modal();
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError){
                        swal('Server Error Occured', xhr.responseText, 'error');
                    }
                });
            });
            $(document).on('click', '.expandgroup', function(e) {
				$('.grouplessoncontainer').slideToggle();
			});  
            $(document).on('click', '.expandindi', function(e) {
				$('.indilessoncontainer').slideToggle();
			});		           
            $(document).on('click', '.btn-expand-hero-unit', function(e) {
                $('.hero-unit-content').css('height', 'auto');
                $(this).toggleClass('btn-expand-hero-unit btn-compress-hero-unit').children().toggle();
            });
            $(document).on('click', '.btn-compress-hero-unit', function(e) {
                $('.hero-unit-content').removeAttr('style');
                $(this).toggleClass('btn-expand-hero-unit btn-compress-hero-unit').children().toggle();
            });
        })
    </script>
<?php } ?>

        
 <div class="awesomplete_dropdown">
  
   <form name= "languageteacher"   action="/language-teachers" method="get" class="" id="yui_3_17_2_1_1642587425534_25">
  <select name="language_teacher" id="language_teacher" style="width: 100%;" data-flag="true">
  <option value="0"> --- <?= get_string('chooselanguage', 'theme_lonet') ?> --- </option>
<option value="ar" <?php if(isset($language) && $language=='ar'){?> selected="selected"<?php } ?>> Arabic</option>
<option value="zh" <?php if(isset($language) && $language=='zh'){?> selected="selected"<?php } ?>> Chinese</option>
<option value="da" <?php if(isset($language) && $language=='da'){?> selected="selected"<?php } ?>> Danish</option>
<option value="de" <?php if(isset($language) && $language=='de'){?> selected="selected"<?php } ?>> German</option>
<option value="nl" <?php if(isset($language) && $language=='nl'){?> selected="selected"<?php } ?>> Dutch</option>
<option value="el" <?php if(isset($language) && $language=='el'){?> selected="selected"<?php } ?>> Greek</option>
<option value="en" <?php if(isset($language) && $language=='en'){?> selected="selected"<?php } ?>> English</option>
<option value="et" <?php if(isset($language) && $language=='et'){?> selected="selected"<?php } ?>> Estonian</option>
<option value="fa" <?php if(isset($language) && $language=='fa'){?> selected="selected"<?php } ?>> Persian</option>
<option value="fi" <?php if(isset($language) && $language=='fi'){?> selected="selected"<?php } ?>> Finnish</option>
<option value="fr" <?php if(isset($language) && $language=='fr'){?> selected="selected"<?php } ?>> French</option>
<option value="id" <?php if(isset($language) && $language=='id'){?> selected="selected"<?php } ?>> Indonesian</option>
<option value="it" <?php if(isset($language) && $language=='it'){?> selected="selected"<?php } ?>> Italian</option>
<option value="la" <?php if(isset($language) && $language=='la'){?> selected="selected"<?php } ?>> Latin</option>
<option value="lv" <?php if(isset($language) && $language=='lv'){?> selected="selected"<?php } ?>> Latvian</option>
<option value="mk" <?php if(isset($language) && $language=='mk'){?> selected="selected"<?php } ?>> Macedonian</option>
<option value="pt" <?php if(isset($language) && $language=='pt'){?> selected="selected"<?php } ?>> Portuguese</option>
<option value="ru" <?php if(isset($language) && $language=='ru'){?> selected="selected"<?php } ?>> Russian</option>
<option value="es" <?php if(isset($language) && $language=='es'){?> selected="selected"<?php } ?>> Spanish</option>
<option value="sv" <?php if(isset($language) && $language=='sv'){?> selected="selected"<?php } ?>> Swedish</option>
<option value="tr" <?php if(isset($language) && $language=='tr'){?> selected="selected"<?php } ?>> Turkish</option>
  </select>
   </form>
</div>             
        
        
<?php 
if (get_string_manager()->string_exists('listpromo_' . $language, 'local_lonet') && $listpromo = get_string('listpromo_' . $language, 'local_lonet')) { 
?>
    <div class="hero-unit">
		<?php
			$body = $listpromo;
			if (\core_text::strlen($body) < 800) {
				$trimlistpromo = $body;
			}else{
				// $trimlistpromo = \core_text::substr($body, 0, 800);
				$trimlistpromo = $body;
			}
		?>
        <div class="hero-unit-content"><?= $trimlistpromo ?></div>
        <?php if ($listpromo) { ?>
            <div class="link text-right hidden">
                <a href="#" class="btn-expand-hero-unit"><span><?= get_string('readmore', 'theme_lonet') ?></span><span style="display: none;"><?= get_string('readless', 'theme_lonet') ?></span>...</a>
            </div>
        <?php } ?>
    </div>
<?php } ?>

<?= $buttons_top ?>
<h1><?= $title ?></h1>
<?php
    $teacher_count = count(teacher::get_by_language($language));
    if ($teacher_count > 10) {
        ?>
        <?php /* ?>
        <div class="text-right" style="margin-bottom: 5px;">
            <a <?= ($page > 1 ? 'href="' . $page_url . (strpos($page_url, '?') !== false ? '&' : '?') . 'page=' . ($page - 1) . '"' : 'href="#" disabled') ?>>Previous Page</a>
            <a <?= ($teacher_count > 10 * $page ? 'href="' . $page_url . (strpos($page_url, '?') !== false ? '&' : '?') . 'page=' . ($page + 1) . '"' : 'href="#" disabled') ?> style="margin-left: 10px;">Next Page</a>
        </div>
        <?php */ ?>
        <div class="teacher-pagination text-center" style="margin-bottom: 5px;">
            <a <?= ($page > 1 ? 'href="' . $page_url . (strpos($page_url, '?') !== false ? '&' : '?') . 'page=' . ($page - 1) . '" style="font-size: 18px;"' : 'href="#" style="visibility: hidden;"') ?>>&lsaquo;</a>
            <?php
            $p = 1;
            do {
                ?><a <?= ($page == $p ? 'href="#" class="active" disabled' : 'href="' . $page_url . (strpos($page_url, '?') !== false ? '&' : '?') . 'page=' . $p . '"') ?>><?= $p ?></a>&nbsp;<?php
            } while ($teacher_count > 10 * $p++);
            ?>
            <a <?= ($teacher_count > 10 * $page ? 'href="' . $page_url . (strpos($page_url, '?') !== false ? '&' : '?') . 'page=' . ($page + 1) . '" style="font-size: 18px;"' : 'href="#" style="visibility: hidden;"') ?>>&rsaquo;</a>
        </div>
    <?php } ?>
<?php
if ($teachers) {
    foreach ($teachers as $teacher) {

    	if($_GET['language_teacher'])
        	$url = $page_url . '/' . language::get_url_by_code($teacher->profile_field_languagesteaching[0]) . '/' . $teacher->id;
        else
        	$url = $page_url . '/' . ($language ? '' : language::get_url_by_code($teacher->profile_field_languagesteaching[0]) . '/') . $teacher->id;
        //$url = $page_url . '/' . language::get_url_by_code($teacher->profile_field_languagesteaching[0]) . '/' . $teacher->id;
        ?>
        <div class="col-sm-12 user-row in-list" style="border-radius: 6px;">
            <div class="row">
                <div class="col-xs-6 col-sm-2 no-padding-r">
                    <div class="user-picture-container">
                        <a href="<?= $CFG->wwwroot ?><?= $url ?>" target="_blank" style="margin-bottom: 5px;"><?= $OUTPUT->user_picture($teacher, ['size' => '100', 'link' => false]) ?></a>
                        <?php foreach (user::getBadges($teacher->id, $language, $teacher->profile_field_badges) as $badge) {
                            if ($badge !== 'none') {
                                echo '<br><span class="badge badge-teacher" style="text-transform: uppercase">' . get_string('badge_' . $badge, 'local_lonet') . '</span>';
                            }
                        } ?>
                    </div>
                    <div class="text-center" style="margin-top: 15px;">
                        <p style="line-height: 1.15;"><small><?= get_string('lessoncount_label', 'local_lonet') ?></small><br><?= teacher::get_lesson_count($teacher) ?></p>
                        <p style="line-height: 1.15;"><small><?= get_string('studentcount_label', 'local_lonet') ?></small><br><?= teacher::get_student_count($teacher) ?></p>
                        <?= teacher::scarcityfeature($teacher) ?>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-3 text-center pull-right">
                    <br>
                    <button type="button" class="btn btn-success btn-view-schedule" data-teacherid="<?= $teacher->id ?>"><?= get_string('booklesson', 'local_lonet') ?></button>
                    <br>
                    <br>
                    <?= teacher::render_rating($teacher) ?>
                    <?= teacher::get_hourly_rate_label($teacher) ?>
                    <?= teacher::set_teacherdata_in_html($teacher->profile_field_studentageyouteach,'studentageyouteach','style="text-align:left;margin-left:33%;margin-top:10%;font-weight:600"','<img src="/theme/lonet/pix/icons/teacher.png">') ?>
                </div>
				<?php
					$nameParts = explode(" ", $teacher->lastname);
					$lastNameInitial = $nameParts[0][0] . ".";
				?>
                <div class="col-xs-12 col-sm-7">
                    <h3><a href="<?= $CFG->wwwroot ?><?= $url ?>" target="_blank" style="font-size: 1em; color: #002b46;"><?= $teacher->firstname.' '.$lastNameInitial ?></a> <div class="indicator <?= (user::is_online($teacher) ? 'online' : '') ?>"></div></h3>
                    <p class="user-languages"><b><?= get_string('teaches', 'local_lonet') ?></b>: <?= user::get_languages_from_data($teacher->profile_field_languagesteaching) ?></p>
<!--'<a href="/user/' . $user->id . '" target="_blank" rel="noopener noreferrer">
                <strong>' . $user->firstname . ' ' . substr($user->lastname, 0, 1) . '.</strong>
            </a>';-->         
                    <p class="user-languages"><b><?= get_string('speaks', 'local_lonet') ?></b>: <?= user::get_languages_from_data($teacher->profile_field_languagesspeaking) ?></p>
                    <p class="user-languages"><b><?= get_string('nativelanguage', 'local_lonet') ?></b>: <?= user::get_languages_from_data($teacher->profile_field_languagesnative) ?></p>
                    <div class="user-description"><?= $teacher->profile_field_teacherintroduction ?></div>
                    <p>
                        <a href="<?= $url ?>" class="btn btn-success" data-teacherid="<?= $teacher->id ?>" target="_blank"><?= get_string('viewprofile', 'local_lonet') ?></a>
                        <button type="button" class="btn btn-success btn-view-schedule" data-teacherid="<?= $teacher->id ?>"><?= get_string('booklesson_extra', 'local_lonet') ?></button>
                        <button type="button" class="btn btn-success btn-view-reviews" data-teacherid="<?= $teacher->id ?>"><?= get_string('viewreviews', 'local_lonet') ?></button>
                    </p>
                </div>
            </div>
        </div>
    <?php } ?>
    <?php
    $teacher_count = count(teacher::get_by_language($language));
    if ($teacher_count > 10) {
        ?>
        <?php /* ?>
        <div class="text-right" style="margin-bottom: 5px;">
            <a <?= ($page > 1 ? 'href="' . $page_url . (strpos($page_url, '?') !== false ? '&' : '?') . 'page=' . ($page - 1) . '"' : 'href="#" disabled') ?>>Previous Page</a>
            <a <?= ($teacher_count > 10 * $page ? 'href="' . $page_url . (strpos($page_url, '?') !== false ? '&' : '?') . 'page=' . ($page + 1) . '"' : 'href="#" disabled') ?> style="margin-left: 10px;">Next Page</a>
        </div>
        <?php */ ?>
        <div class="teacher-pagination text-center" style="margin-bottom: 5px;">
            <a <?= ($page > 1 ? 'href="' . $page_url . (strpos($page_url, '?') !== false ? '&' : '?') . 'page=' . ($page - 1) . '" style="font-size: 18px;"' : 'href="#" style="visibility: hidden;"') ?>>&lsaquo;</a>
            <?php
            $p = 1;
            do {
                ?><a <?= ($page == $p ? 'href="#" class="active" disabled' : 'href="' . $page_url . (strpos($page_url, '?') !== false ? '&' : '?') . 'page=' . $p . '"') ?>><?= $p ?></a>&nbsp;<?php
            } while ($teacher_count > 10 * $p++);
            ?>
            <a <?= ($teacher_count > 10 * $page ? 'href="' . $page_url . (strpos($page_url, '?') !== false ? '&' : '?') . 'page=' . ($page + 1) . '" style="font-size: 18px;"' : 'href="#" style="visibility: hidden;"') ?>>&rsaquo;</a>
        </div>
    <?php } ?>
    <?= $buttons_bottom ?>
<?php } ?>
<div class="clearfix"></div>
<br>

<?php 
if (get_string_manager()->string_exists('listdesc_' . $language, 'local_lonet') && $listdesc = get_string('listdesc_' . $language, 'local_lonet')) { 
?>
    <div class="hero-unit">
        <?= $demourl ? '<div id="demo">
            <div class="media-16x9">
                <iframe src="' . $demourl . '" allowfullscreen="" frameborder="0"></iframe>
            </div>
            <br>
        </div>' : '' ?>
        <?= $listdesc ?>
    </div>
<?php } ?>

<div id="schedule-modal" class="modal" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
        </div>
    </div>
</div>
<div id="reviews-modal" class="modal" tabindex="-1" role="dialog" data-keyboard="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><?= get_string('close', 'core_form') ?></button>
            </div>
        </div>
    </div>
</div>

<?= $OUTPUT->footer() ?>
