<?php
use local_lonet\category;
use local_lonet\language;
use local_lonet\teacher;
use local_lonet\user;
use local_lonet\lesson;

require_once('../../config.php');
require_once($CFG->dirroot.'/local/lonet/lib.php');
require_once($CFG->dirroot.'/user/profile/lib.php');
global $SESSION,$USER,$PAGE;

$PAGE->requires->css('/local/lonet/style.css');

//check lib/outputcomponents.php - for lang menu input hidden name language_teacher
$language_model = null;
if (isset($_GET['url'])) {
    $language_model = language::get_by_url_group($_GET['url']);
    $language = $language_model->code ?? null;
} else {
    // $language = (isset($_GET['language']) ? $_GET['language'] : null);
    $language = (isset($_GET['lang']) ? $_GET['lang'] : null);
}
if(isset($_GET['language_teacher'])){
    $language = ($_GET['language_teacher'] ?? 0);
    $language_url = "?language_teacher=".$language;
}else{
	$language = '0';
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
// $language = empty($language) ? $SESSION->lang : $language; //this condition added because $_GET['url'] not working but it's working in lonet/index.php. something to do with rewrite
$language_name = category::get_name_grouplesson($language);
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
// echo 'lang select in header-'.$SESSION->lang;
if (!isset($title)) {
    $title = ($language ? get_string('gl_metatitle_'.$SESSION->lang, 'local_lonet', $language_name) : get_string('h1_teacher_list_group', 'local_lonet'));
}
$page_url = language::get_full_url_group($language_model).$language_url;
$PAGE->set_context(context_system::instance());
$PAGE->set_pagelayout('list');
$PAGE->set_title($title);
$PAGE->set_heading($title);
$PAGE->set_url($page_url);

// $teachers = teacher::get_by_language($language, $page);
$teachers = lesson::get_grouplesson_by_language($language, $page);
// print_object($teachers);die;
echo $OUTPUT->header();

$buttons_top = '';
$buttons_bottom = '';
?>

        
<div class="awesomplete_dropdown">
  
<form name= "languageteacher"   action="" method="get" class="" id="yui_3_17_2_1_1642587425534_25">
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
        
<?php if (get_string_manager()->string_exists('listpromo_' . $language, 'local_lonet') && $listpromo = get_string('listpromo_' . $language, 'local_lonet')) { ?>
    <div class="hero-unit d-none">
		<?php
			$body = $listpromo;
			if (\core_text::strlen($body) < 800) {
				$trimlistpromo = $body;
			}else{
				$trimlistpromo = \core_text::substr($body, 0, 800);
			}
		?>
        <div class="hero-unit-content"><?= $trimlistpromo ?></div>
        <?php if ($listpromo) { ?>
            <div class="link text-right">
                <a href="#" class="btn-expand-hero-unit"><span><?= get_string('readmore', 'theme_lonet') ?></span><span style="display: none;"><?= get_string('readless', 'theme_lonet') ?></span>...</a>
            </div>
        <?php } ?>
    </div>
<?php } ?>

<?= $buttons_top ?>
<h1 class="here"><?= $title ?></h1>
<?php
    // $teacher_count = count(teacher::get_by_language($language));
    $teacher_count = count(lesson::get_grouplesson_by_language($language));
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
		$teacherdetail = $DB->get_record_sql("SELECT * FROM {user} WHERE id=".$teacher->teacherid."");
		profile_load_data($teacherdetail);
    	if($_GET['language_teacher'])
        	$url = $page_url . '/' . language::get_url_by_code($teacherdetail->profile_field_languagesteaching[0]) . '/' . $teacherdetail->id;
        else
        	$url = $page_url . '/' . ($language ? '' : language::get_url_by_code($teacherdetail->profile_field_languagesteaching[0]) . '/') . $teacherdetail->id;
        //$url = $page_url . '/' . language::get_url_by_code($teacher->profile_field_languagesteaching[0]) . '/' . $teacher->id;
        ?>
        <div class="col-sm-12 user-row in-list grouplesson_information mb-5" style="border-radius: 6px;">
            <div class="row">
                <div class="col-xs-6 col-sm-2 no-padding-r">
                    <div class="user-picture-container">
                        <a href="<?= $CFG->wwwroot ?>/user/<?=$teacherdetail->id ?>" target="_blank" style="margin-bottom: 5px;"><?= $OUTPUT->user_picture($teacherdetail, ['size' => '100', 'link' => false]) ?></a>
                        <?php foreach (user::getBadges($teacherdetail->id, $language, $teacherdetail->profile_field_badges) as $badge) {
                            if ($badge !== 'none') {
                                echo '<br><span class="badge badge-teacher" style="text-transform: uppercase">' . get_string('badge_' . $badge, 'local_lonet') . '</span>';
                            }
                        } ?>
                    </div>
                    <div class="text-center" style="margin-top: 15px;">
						<h3><a href="<?= $CFG->wwwroot ?>/user/<?=$teacherdetail->id ?>" target="_blank" style="font-size: 1em; color: #002b46;"><?= fullname($teacherdetail, true) ?></a> <div class="indicator <?= (user::is_online($teacherdetail) ? 'online' : '') ?>"></div></h3>
                        <p style="line-height: 1.15;"><small><?= get_string('lessoncount_label', 'local_lonet') ?></small><br><?= teacher::get_lesson_count($teacherdetail) ?></p>
                        <p style="line-height: 1.15;"><small><?= get_string('studentcount_label', 'local_lonet') ?></small><br><?= teacher::get_student_count($teacherdetail) ?></p>
						<p><b>
						<?php
						$glessonmembers = lesson::count_group_lessons_members($teacher->id);
						$placeleftno = $teacher->maxamount-$glessonmembers;
						if($placeleftno > 0 && $placeleftno <=2){
							if($placeleftno == 1){
								echo '<span class="redm fa fa-clock-o pr-1" data-toggle="tooltip" title= "'.get_string("scarcity_field_tag1", "local_lonet").'" style="vertical-align:bottom;"></span>';
							}
							if($placeleftno == 2){
								echo '<span class="redm fa fa-clock-o pr-1" data-toggle="tooltip" title= "'.get_string("scarcity_field_tag2", "local_lonet").'" style="vertical-align:bottom;"></span>';
							}
						}elseif(empty($placeleftno) && $placeleftno < 1){
							echo '<span class="redm fa fa-minus-circle pr-1" data-toggle="tooltip" title= "'.get_string("scarcity_field_tooltip5", "local_lonet").'" style="vertical-align:bottom;"></span>';
						}else{
						    echo '<span class="greenm fa fa-clock-o pr-1" data-toggle="tooltip" title="'.get_string("scarcity_field_tooltip4", "local_lonet").'" style="vertical-align:bottom;"></span>';
						}
						echo ($placeleftno > 0 && $placeleftno < 2) ? 'Only ' : '';
						echo $teacher->maxamount-$glessonmembers;
						echo ($placeleftno < 2) ? ' Place left' : ' Places left';
						?>
						</b></p>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-3 text-center pull-right">
                    <br>
					<?php 
					$lessondatedisplay = ($teacher->timefrom ? (new DateTime('now', core_date::get_user_timezone_object()))->setTimestamp($teacher->timefrom)->format('D, M j') : null); 
					$glessontimes = lesson::get_grouplesson_times_withoutsecond($teacher->id);
					$lessondateattr = ($teacher->timefrom ? (new DateTime('now', core_date::get_user_timezone_object()))->setTimestamp($teacher->timefrom)->format('Y-m-d') : null);
					$lessonendtimeattr = ($teacher->timeto ? (new DateTime('now', core_date::get_user_timezone_object()))->setTimestamp($teacher->timefrom)->format('Y-m-d') : null);
					// if($teacher->maxamount-$glessonmembers > 0){
					?>
                    <button type="button" class="btn btn-success btn-view-schedule-group" data-placeleft="<?= $teacher->maxamount-$glessonmembers ?>" data-lessonid="<?= $teacher->id ?>" data-datetime="<?= $lessondateattr.' '.$glessontimes->timefrom ?>" data-endtime="<?= $lessonendtimeattr.' '.$glessontimes->timeto ?>" data-isgrouplesson=1 data-language="<?= $teacher->language ?>" data-teacherid="<?= $teacherdetail->id ?>"><?= get_string('joinlesson', 'local_lonet') ?></button>
					<?php// } ?>
                    <br>
                    <br>
                    <?= teacher::render_rating($teacherdetail) ?>
					<i class='fa fa-money' style='font-size:20px;vertical-align:middle;'></i>&nbsp;<span><b><?= get_string('price', 'local_lonet') ?>:</b></span>&nbsp;
                    &euro;<?= lesson::get_grouplesson_price($teacher) ?>
					<div style="text-align:left;margin-left:33%;margin-top:10%;font-weight:600">
					<img src="/theme/lonet/pix/icons/teacher.png">&nbsp;<?= get_string('age','local_lonet')?>
					<ul style="font-weight:100">
					<?php
					foreach(json_decode($teacher->ageteach) as $value) {
						echo '<li>'.$value.'</li>';
					}
					?>
					</ul></div>
					<div style="text-align:left;margin-left:33%;margin-top:10%;font-weight:600">
					<img src="/theme/lonet/pix/icons/bar-chart.png">&nbsp;<?= get_string('level','local_lonet')?>
					<ul style="font-weight:100">
					<?php
					foreach(json_decode($teacher->levelteach) as $value) {
						echo '<li>'.$value.'</li>';
					}
					?>
					</ul></div>
					<div style="text-align:left;margin-left:33%;margin-top:10%;font-weight:600">
					<img src="/theme/lonet/pix/icons/globe-with-meridians.png">&nbsp;<?= get_string('place','local_lonet')?>
					<ul style="font-weight:100">
					<?php
					foreach($teacherdetail->profile_field_onlinetools as $value) {
						echo '<li>'.$value.'</li>';
					}
					?>
					</ul></div>
                </div>
                <div class="col-xs-12 col-sm-7">
					<button class="px-5" style="background: gold;border: none;font-weight: bolder;border-radius: 20px;pointer-events: none;"><?= get_string('grouplesson','local_lonet')?></button>
                    <h3 class="d-inline-block" style="vertical-align:middle;"><a href="#" style="font-size: 1em; color: #002b46;"><?= $teacher->lessonname ?></a></h3>
					<?php
						$langs = get_string_manager()->get_list_of_translations(); 
						if(!empty($teacher->language)){
							$exp = explode('(',$langs[$teacher->language]);
							$grouplesson_lang = $exp[0];
						}else{
							$grouplesson_lang = 'N/A';
						}
					?>
					<p class="user-languages"><b><?= get_string('language', 'local_lonet') ?></b>: <?= $grouplesson_lang ?></p>
					<!--<p><button class="px-5" style="background: gold;border: none;font-weight: bolder;border-radius: 20px;pointer-events: none;">NEW</button></p-->
                    <p class="user-languages"><b><?= get_string('duration', 'local_lonet') ?></b>: <?= get_string('numminutes', 'core_moodle', ((abs($teacher->timefrom-$teacher->timeto) / 60) - 10)) ?></p>   
                    <p class="user-languages"><b><?= get_string('date', 'local_lonet') ?></b>: <?= $lessondatedisplay ?></p>
                    <p class="user-languages <?php if(!isloggedin()) { ?>d-inline<?php }?>"><b><?= get_string('time', 'local_lonet') ?></b>: <span class="glessonstarttime_<?=$teacher->id?>"><?= $glessontimes->timefrom ?></span>&nbsp;</p>   
					<?php if(!isloggedin()){?>
                    <p class="user-languages d-inline">
					<?php
						$choices = core_date::get_list_of_timezones($CFG->timezone,false);
						echo '<select class="selecttimezone" data-glessonid='.$teacher->id.' data-timefrom='.$teacher->timefrom.'>';
						foreach($choices as $key=>$value){
							$selected = ($key == $CFG->timezone) ? 'selected' : '';
							echo '<option value='.$key.' '.$selected.'>'.$value.'</option>';
						}
						echo '</select>';
					?>
					</p>    
					<?php } ?>
					<p class="user-languages"><b><?= get_string('maxattendees', 'local_lonet') ?></b>: <?= $teacher->maxamount ?></p>
					<p class="user-languages"><b><?= get_string('minattendees', 'local_lonet') ?></b>: <?= $teacher->minamount ?></p>
					<p class="user-languages"><h3 style="color:#002b46;"><img src="<?=$CFG->wwwroot?>/theme/lonet/pix/lessonabout.png" width="25">&nbsp;<?= get_string('whatislesson', 'local_lonet') ?></h3></p>
                    <div class="user-description"><?= $teacher->lesson_desc ?></div>					
					
					<p class="user-languages"><h3 style="color:#002b46;"><img src="<?=$CFG->wwwroot?>/theme/lonet/pix/youlearn.png" width="25">&nbsp;<?= get_string('whatulearn', 'local_lonet') ?></h3></p>
                    <div class="user-description"><?= $teacher->whatlearn ?></div>
                    <p>
                        <button type="button" class="btn btn-success btn-view-reviews" data-teacherid="<?= $teacherdetail->id ?>"><?= get_string('viewreviews', 'local_lonet') ?></button>
						<a class="btn btn-success btn-message" href="<?= $CFG->wwwroot ?>/message/index.php?id=<?= $teacherdetail->id ?>" target="_blank" rel="noopener noreferrer"><span class="fa fa-comment"></span> <?= get_string('contactteacher', 'local_lonet') ?></a>

						<?php //if($teacher->maxamount-$glessonmembers > 0){ ?>
							<button type="button" class="btn btn-success btn-view-schedule-group" data-placeleft="<?= $teacher->maxamount-$glessonmembers ?>" data-lessonid="<?= $teacher->id ?>" data-datetime="<?= $lessondateattr.' '.$glessontimes->timefrom ?>" data-endtime="<?= $lessonendtimeattr.' '.$glessontimes->timeto ?>" data-isgrouplesson=1 data-language="<?= $teacher->language ?>" data-teacherid="<?= $teacherdetail->id ?>"><?= get_string('bookmyplace', 'local_lonet') ?></button>
						<?php //} ?>
                    </p>
                </div>
            </div>
        </div>
    <?php } ?>
    <?php
    // $teacher_count = count(teacher::get_by_language($language));
    $teacher_count = count(lesson::get_grouplesson_by_language($language));
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
<?php } else{
	echo '<h3 style="color: #FFFFFF;">No Group Lesson Found.</h3>';
}?>
<div class="clearfix"></div>
<br>

<?php //if (get_string_manager()->string_exists('listdesc_' . $language, 'local_lonet') && $listdesc = get_string('listdesc_' . $language, 'local_lonet')) { ?>
    <!--div class="hero-unit">
        <?= $demourl ? '<div id="demo">
            <div class="media-16x9">
                <iframe src="' . $demourl . '" allowfullscreen="" frameborder="0"></iframe>
            </div>
            <br>
        </div>' : '' ?>
        <?= $listdesc ?>
    </div-->
<?php //} ?>


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
<script>

$(document).ready(function() {
	$('#language_teacher').on('change', function() {
	 this.form.submit()
	});
	$('.btn-view-reviews').click(function(e) {
		e.stopPropagation();
		$.ajax({
			type: 'GET',
			url: '<?= $CFG->wwwroot ?>/local/lonet/ajax_reviews.php?teacherid=' + $(this).attr('data-teacherid'),
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
	// $(document).on("click", ".btn-view-schedule-group", function(e) {alert('hi');
	$('.btn-view-schedule-group').click(function(e) {
		var placeleft = $(this).attr('data-placeleft');
		if(placeleft < 1){
			swal("<?= get_string('noplaceleft','local_lonet') ?>");
			return false;
		}
		var index = 0;
		var lessons = {};
		lessons[index] = {
			lessonid: $(this).attr('data-lessonid'),
			datetime: $(this).attr('data-datetime'),
			endtime: $(this).attr('data-endtime'),
			// endtime: null,
			isgrouplesson: 1,
			language: $(this).attr('data-language'),
		};
		$.ajax({
			type: 'POST',
			url: '<?= $CFG->wwwroot ?>/local/lonet/book.php',
			dataType: 'json',            
			data: {
				teacherid: $(this).attr('data-teacherid'),
				lessons: lessons,
				lessonid: $(this).attr('data-lessonid'),
			},
			success: function(result) {
				if (result === true) {
					// window.location.replace('<?= $CFG->wwwroot ?>/local/lonet/book.php');
					window.open('<?= $CFG->wwwroot ?>/local/lonet/book.php', '_blank', 'noopener, noreferrer');

				} else {
					swal('Error Occured', result, 'error');                           
				}
			},
			error: function(xhr, ajaxOptions, thrownError){
				// swal('Server Error Occured', xhr.responseText, 'error');
				window.location.replace('<?= $CFG->wwwroot ?>/user/edit.php?id=<?= $USER->id ?>&course=1'); 
			}
		});
	});
	//convert time according to timezone before login
	$(document).on("change", ".selecttimezone", function() {
		var lessonid =  $(this).attr('data-glessonid');
        var time= $(this).attr('data-timefrom');
		var timezone = $(this).val();
		$.ajax({
			cache: false,
			type: 'POST',
			url: '<?= $CFG->wwwroot ?>/local/lonet/timechange.php',
			data: {
				timezone: timezone,
				time: time,
				id: lessonid,
				'sesskey': M.cfg.sesskey
			},
			dataType : 'json',
			success: function(data) {
				$('.glessonstarttime_'+data.glesson).text(data.timefrom);
			},
			error: function(xhr, status, error) {
			console.log(xhr + '\n' + error + '\n' + status);
			}
		});
	});
});
</script>
<?php if ($teachers) { ?>
<style>
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
<?php } ?>
<?= $OUTPUT->footer() ?>
