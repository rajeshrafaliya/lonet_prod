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
$typeoft = (isset($_GET['typeoftutor']) ? $_GET['typeoftutor'] : 0);
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
if(isset($typeoft)){
	$teachers = teacher::get_by_language_withoutpagination($language);
}else{
	$teachers = teacher::get_by_language($language, $page);
}
$clanguage = explode('_', current_language())[0];
// $grouplessonlink = language::get_grouplesson_page_url($clanguage);
$grouplessonlink = language::get_full_url_group($clanguage,$language);
echo $OUTPUT->header();
$buttons_top = '<span class="container-buttons pull-right hidden">
	<span class="badge badge-teacher" style="text-transform: uppercase;position: absolute;margin-left: -25px;">'.get_string('badge_new','local_lonet').'</span>
	<a class="btn btn-success btn-lonet btn-sm" href="'.$grouplessonlink.'&lang='.$clanguage.'" target="_blank" rel="noopener noreferrer">'.get_string('grouplessons','local_lonet').'</a>	
    <a class="btn btn-success btn-lonet btn-sm" href="/language-tutor-consultation" target="_blank" rel="noopener noreferrer">' . get_string('applyforconsultation', 'theme_lonet') . '</a>
    ' . ($USER->id <= 0 ? '<a class="btn btn-success btn-lonet btn-sm" href="/login/signup.php" target="_blank" rel="noopener noreferrer">' . get_string('register', 'theme_lonet') . '</a>' : '') . '
    ' . ($demourl ? '<a class="btn btn-success btn-lonet btn-sm" href="#demo">' . get_string('watchdemolesson', 'local_lonet') . '</a>' : '') . '
</span>';
$buttons_bottom = ($USER->id <= 0 ? '<p class="container-buttons text-right hidden">
    <a class="btn btn-success btn-lonet btn-sm" href="/login/signup.php" target="_blank" rel="noopener noreferrer">' . get_string('register', 'theme_lonet') . '</a>
    <a class="btn btn-success btn-lonet btn-sm" href="/login/signup.php?teacher=1" target="_blank" rel="noopener noreferrer">' . get_string('becometeacher', 'theme_lonet') . '</a>
</p>' : '');

//if ($teachers) { ?>
<script>

$(document).ready(function() {
  $('#language_teacher,#typeoftutor').on('change', function() {
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
			$(document).on('click', '.readmore_promo', function(e) {
				e.preventDefault();
				
				// Toggle the visibility of the description
				$('.hero-unit .ldesc').slideToggle(600);
				
				// Toggle the text between 'Read more...' and 'Show less'
				if ($(this).text() === "Read more...") {
					$(this).text("Show less");
				} else {
					$(this).text("Read more...");
				}
			});
        })
    </script>
<?php// } ?>           
        
        
<?php
if (get_string_manager()->string_exists('listpromo_' . $language, 'local_lonet') && $listpromo = get_string('listpromo_' . $language, 'local_lonet')) {
?>
    <div class="hero-unit hidden">
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
<h1 class="hidden"><?= $title ?></h1>
<div class="selecttutorinfo">
	<h3><?= get_string('selecttutor', 'local_lonet') ?></h3>
	<p class="my-0"><?= get_string('selecttutor_desc', 'local_lonet') ?></p>
	<p class="my-0"><?= get_string('langgurantee', 'local_lonet') ?></p>
</div>
<div class="langilearn mb-5">
	<div class="awesomplete_dropdown">
		<form name= "languageteacher"   action="/language-teachers" method="get" class="">
		<select name="language_teacher" id="language_teacher" style="width: 100%;" data-flag="true">
		<option value="0"><?= get_string('langilearn', 'local_lonet') ?></option>
		<option value="ar" <?php if(isset($language) && $language=='ar'){?> selected="selected"<?php } ?>> Arabic</option>
		<option value="ca" <?php if(isset($language) && $language=='ca'){?> selected="selected"<?php } ?>> Catalan</option>
		<option value="zh" <?php if(isset($language) && $language=='zh'){?> selected="selected"<?php } ?>> Chinese</option>
		<option value="da" <?php if(isset($language) && $language=='da'){?> selected="selected"<?php } ?>> Danish</option>
		<option value="de" <?php if(isset($language) && $language=='de'){?> selected="selected"<?php } ?>> German</option>
		<option value="nl" <?php if(isset($language) && $language=='nl'){?> selected="selected"<?php } ?>> Dutch</option>
		<option value="el" <?php if(isset($language) && $language=='el'){?> selected="selected"<?php } ?>> Greek</option>
		<option value="en" <?php if(isset($language) && $language=='en'){?> selected="selected"<?php } ?>> English</option>
		<option value="en_us" <?php if(isset($language) && $language=='en_us'){?> selected="selected"<?php } ?>> English (United States)</option>
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
		<select name="typeoftutor" id="typeoftutor" style="width: 100%;" data-flag="true">
		<option value="0" <?php if(empty($typeoft)){?> selected="selected"<?php }?>><?= get_string('typeofeduc', 'local_lonet') ?></option>
		<option value="tutor" <?php if($typeoft === 'tutor'){?> selected="selected"<?php } ?>><?= get_string('langtutor', 'local_lonet') ?></option>
		<option value="coach" <?php if(isset($typeoft) && $typeoft === 'coach'){?> selected="selected"<?php } ?>><?= get_string('langcoach', 'local_lonet') ?></option>
		<option value="trainer" <?php if(isset($typeoft) && $typeoft === 'trainer'){?> selected="selected"<?php } ?>><?= get_string('langtrainer', 'local_lonet') ?></option>
		</select>
		<input type="hidden" name="lang" value=<?= $clanguage ?> />

		</form>
	</div>  
	<div><a class="freeconsult" href="/language-tutor-consultation" target="_blank" rel="noopener noreferrer"><?= get_string('freeconsult', 'local_lonet') ?></a></div>
</div>
<?php
	if(empty($typeoft)){
		$teacher_count = count(teacher::get_by_language($language));
	}else{
		$teacher_count = 0;
		foreach ($teachers as $teacher) {
			$appliedrole = false;
			if(isset($typeoft) && $typeoft=='tutor' && $teacher->profile_field_tutorrole){$appliedrole = true;}
			if(isset($typeoft) && $typeoft=='coach' && $teacher->profile_field_coachrole){$appliedrole = true;}
			if(isset($typeoft) && $typeoft=='trainer' && $teacher->profile_field_trainerrole){$appliedrole = true;}
			if(!$appliedrole){continue;}
			$teacher_count++;
		}
	}
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
		if(!empty($typeoft)){
			$appliedrole = false;
			if(isset($typeoft) && $typeoft == 'tutor' && $teacher->profile_field_tutorrole){$appliedrole = true;}
			if(isset($typeoft) && $typeoft == 'coach' && $teacher->profile_field_coachrole){$appliedrole = true;}
			if(isset($typeoft) && $typeoft == 'trainer' && $teacher->profile_field_trainerrole){$appliedrole = true;}
			if(!$appliedrole){continue;}
		}
    	if($_GET['language_teacher']){
        	$rawurl = $page_url . '/' . language::get_url_by_code($teacher->profile_field_languagesteaching[0]) . '/' . $teacher->id;
			$parsed_url = parse_url($rawurl);
			$path = $parsed_url['query'];
			$exurl = explode('/',$path);
			if($langurl = $DB->get_record_sql("SELECT * FROM {lonet_language} WHERE code='".$clanguage."' LIMIT 0,1")){
				$urlpath = $langurl->url_{$clanguage};
				$url = language::get_full_url($clanguage).'/'.$exurl[1].'/'.$exurl[2];
			}else{
				$url = '/language-teachers/'.$exurl[1].'/'.$exurl[2];
			}
        }else{
			if(empty($typeoft)){
				// if(empty($_GET['language_teacher'])){
					// $url = '/language-teachers/' . ($language ? '' : language::get_url_by_code($teacher->profile_field_languagesteaching[0]) . '/') . $teacher->id;
				// }else{
					$url = $page_url . '/' . ($language ? '' : language::get_url_by_code($teacher->profile_field_languagesteaching[0]) . '/') . $teacher->id;
				// }
			}else{
				$url = '/language-teachers/' . ($language ? '' : language::get_url_by_code($teacher->profile_field_languagesteaching[0]) . '/') . $teacher->id;
			}
		}
        //$url = $page_url . '/' . language::get_url_by_code($teacher->profile_field_languagesteaching[0]) . '/' . $teacher->id;
		$usercontext = context_user::instance($teacher->id);
		$userpicf3 = $OUTPUT->user_picture($teacher, ['size' => '254', 'link' => false]);
		if($DB->record_exists_sql("SELECT * FROM {files} WHERE component='user' AND filearea='icon' AND itemid=0 AND contextid=".$usercontext->id." AND filename LIKE '%original%'")){
			$userpic = str_replace('/f3','/original', $userpicf3);
		}else{
			$userpic =  $userpicf3;
		}
        ?>
        <div class="user-row-container" style="padding-left:40px;padding-right:40px;">
        <div class="user-row in-list">
                <div class="" style="width:254px;">
					 <div class="pull-right"><div class="indicator <?= (user::is_online($teacher) ? 'online' : '') ?>"></div></div>
                    <div class="user-picture-container">
                        <a href="<?= $CFG->wwwroot ?><?= $url ?>" target="_blank" style="margin-bottom: 5px;"><?= $userpic ?></a>
                        <?php foreach (user::getBadges($teacher->id, $language, $teacher->profile_field_badges) as $badge) {
                            if ($badge !== 'none') {
                                echo '<br><span class="badge badge-teacher mt-3" style="text-transform: uppercase">' . get_string('badge_' . $badge, 'local_lonet') . '</span>';
                            }
                        } ?>
                    </div>
                    <div class="text-center UsrDtail">
                        <p class="lessoncomp mt-3"><b><?= get_string('completed', 'local_lonet') ?>: </b><?= teacher::get_lesson_count($teacher) ?>&nbsp;<?= get_string('smalllessons', 'local_lonet') ?></p>
                        <p class="studentscount"><b><?= get_string('students', 'local_lonet') ?>: </b><?= teacher::get_student_count($teacher) ?></p>
                        <?= teacher::scarcityfeature($teacher) ?>
                    </div>
                </div>
				<?php
					$nameParts = explode(" ", $teacher->lastname);
					$lastNameInitial = $nameParts[0][0] . ".";
				?>
                <div class="teacherinfocontainer">
				<div class="firstrow">
					<h3 class="my-0" style="flex-grow:.5;"><a class="teachername" href="<?= $CFG->wwwroot ?><?= $url ?>" target="_blank"><?= $teacher->firstname.' '.$lastNameInitial ?></a></h3>
					<?= teacher::render_rating_new($teacher) ?>
					<?= teacher::get_hourly_rate_label_new($teacher) ?>
				</div>
				<div class="secondrow tutortypediv">
					<?php
						if($teacher->profile_field_tutorrole){
							echo '<p class="my-0 tuttype tutor">Lonet.<span>Tutor</span></p>';
						}
						if($teacher->profile_field_coachrole){
							echo '<p class="my-0 tuttype coach">Lonet.<span>Coach</span></p>';
						}
						if($teacher->profile_field_trainerrole){
							echo '<p class="my-0 tuttype trainer">Lonet.<span>Trainer</span></p>';
						}
					?>
				</div>
				<div class="thirdrow">
					<div class="block1">
					<div class="teaches">
						<div class="labe"><?= get_string('teaches', 'local_lonet') ?>:&nbsp;</div>
						<div class="teachflags"><?= !empty($teacher->profile_field_languagesteaching[0]) ? user::get_languages_from_data($teacher->profile_field_languagesteaching) : '' ?></div>
					</div>
					<div class="speaks">
						<div class="labe"><?= get_string('speaks', 'local_lonet') ?>:&nbsp;</div>
						<div class="speakflags"><?= !empty($teacher->profile_field_languagesspeaking[0]) ? user::get_languages_from_data($teacher->profile_field_languagesspeaking) : '' ?></div>
					</div>
					<div class="language">
						<div class="labe"><?= get_string('native', 'local_lonet') ?>:&nbsp;</div>
						<div class="nativeflags"><?= !empty($teacher->profile_field_languagesnative[0]) ? user::get_languages_from_data($teacher->profile_field_languagesnative) : '' ?></div>
					</div>
					</div>
					<div class="block2">
					<p class="labe"><?= get_string('studentageyouteach', 'local_lonet') ?></p>
					<ul class="mx-0">
					<?php foreach($teacher->profile_field_studentageyouteach as $singleteach) { 
						echo  '<li>'.$singleteach.'</li>';
					} ?>
					</ul>
					</div>
					<div class="block3">
					<p class="labe"><?= get_string('connectvia', 'local_lonet') ?></p>
					<div style="gap: 12px;display: flex;align-items: center;">
					<?php
					if(!empty($teacher->profile_field_onlinetools)){
						foreach($teacher->profile_field_onlinetools as $value) {
							if($value == 'Zoom'){
								echo get_string('zoom', 'local_lonet');
							}elseif($value == 'Google Hangouts'){
								echo get_string('meet', 'local_lonet');
							}else if($value == 'Skype'){
								echo get_string('skype', 'local_lonet');
							}
						}
					}else{
						echo 'N/A';
					}
					?>
					</div>
					</div>
				</div>
				<div class="fourthrow">
				<div class="box1" style="width:659px;">
				<div class="user-description <?= 'teachbox'.$teacher->id.''?>">
				<?php
					if(!empty($teacher->profile_field_teacherintroduction)){
						$fulldesc = (\core_text::strlen($teacher->profile_field_teacherintroduction) > 220) ? \core_text::substr($teacher->profile_field_teacherintroduction , 0, 220)." ..." : $teacher->profile_field_teacherintroduction ;
						echo '<p class="shorttext">'.$fulldesc.'</p>';
						echo '<p class="longtext hidden">'.$teacher->profile_field_teacherintroduction.'</p>';
						if(\core_text::strlen($teacher->profile_field_teacherintroduction) > 220){ 
							echo '<a href="#" class="readmore showmore py-3" data-action="showmore" data-teacher="teachbox'.$teacher->id.'">Show more...</a>';
							echo '<a href="#" class="readmore showless py-3 hidden" data-action="showless" data-teacher="teachbox'.$teacher->id.'">Show less...</a>';
						}
					}elseif(!empty($teacher->profile_field_trainerintroduction)){
						$fulldesc = (\core_text::strlen($teacher->profile_field_trainerintroduction) > 220) ? \core_text::substr($teacher->profile_field_trainerintroduction , 0, 220)." ..." : $teacher->profile_field_trainerintroduction ;
						echo '<p class="shorttext">'.$fulldesc.'</p>';
						echo '<p class="longtext hidden">'.$teacher->profile_field_trainerintroduction.'</p>';
						if(\core_text::strlen($teacher->profile_field_trainerintroduction) > 220){ 
							echo '<a href="#" class="readmore showmore py-3" data-action="showmore" data-teacher="teachbox'.$teacher->id.'">Show more...</a>';
							echo '<a href="#" class="readmore showless py-3 hidden" data-action="showless" data-teacher="teachbox'.$teacher->id.'">Show less...</a>';
						}
					}elseif(!empty($teacher->profile_field_describecoachvalue)){
						$fulldesc = (\core_text::strlen($teacher->profile_field_describecoachvalue) > 220) ? \core_text::substr($teacher->profile_field_describecoachvalue , 0, 220)." ..." : $teacher->profile_field_describecoachvalue ;
						echo '<p class="shorttext">'.$fulldesc.'</p>';
						echo '<p class="longtext hidden">'.$teacher->profile_field_describecoachvalue.'</p>';
						if(\core_text::strlen($teacher->profile_field_describecoachvalue) > 220){ 
							echo '<a href="#" class="readmore showmore py-3" data-action="showmore" data-teacher="teachbox'.$teacher->id.'">Show more...</a>';
							echo '<a href="#" class="readmore showless py-3 hidden" data-action="showless" data-teacher="teachbox'.$teacher->id.'">Show less...</a>';
						}
					}else{
						$fulldesc = '';
					}
				 ?>			
				 </div>
				</div>
				<div class="box2">
				<a href="<?= $url ?>" class="viewprofile" data-teacherid="<?= $teacher->id ?>" target="_blank"><?= get_string('viewprofile', 'local_lonet') ?></a>
				<?php if($USER->id != $teacher->id){?>
					<a href="<?= $CFG->wwwroot?>/teacher/<?= $teacher->id ?>#chooselessons" class="booklesson btn btn-success btn-view-scheduleee" data-teacherid="<?= $teacher->id ?>"><?= get_string('booklesson', 'local_lonet') ?></a>
				<?php } ?>
				</div>
				</div>
                </div>
        </div>
        </div>

<div id="price-modal" class="modal teachmodal<?=$teacher->id?>" tabindex="-1" role="dialog" data-keyboard="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
				<h5 class="modal-title">Book with Confidence!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M5 15L15 5M5 5L15 15" stroke="#1F2937" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></button>
            </div>
            <div class="modal-body">
			<ul class="ml-0">
				<li><?= get_string('bluecheck', 'local_lonet') ?> Safe payment by card or PayPal</li>
				<li><?= get_string('bluecheck', 'local_lonet') ?> You can cancel 12 hours before</li>
				<li><?= get_string('bluecheck', 'local_lonet') ?> Use your balance</li>
			</ul>	
			<!--div class="teachflags2"><?= user::get_languages_from_data($teacher->profile_field_languagesteaching) ?></div>
			<p class="indilesson">Individual lessons:</p>
			<div class="indilesson_price">
				<span>Beginners 30 min $20</span>
				<span>Intermediate 50 min $50</span>
				<span>Intermediate 50 min $50</span>
				<span>Intermediate 50 min $50</span>
			</div>
			<p class="grouplesson mt-3">Group lessons:</p>
			<div class="grouplesson_price">
				<span>Beginners 30 min $20</span>
				<span>Intermediate 50 min $50</span>
			</div-->
            </div>
        </div>
    </div>
</div>		
		
    <?php } 
	
	if(empty($typeoft)){
		$teacher_count = count(teacher::get_by_language($language));
	}else{
		$teacher_count = 0;
		foreach ($teachers as $teacher) {
			$appliedrole = false;
			if(isset($typeoft) && $typeoft=='tutor' && $teacher->profile_field_tutorrole){$appliedrole = true;}
			if(isset($typeoft) && $typeoft=='coach' && $teacher->profile_field_coachrole){$appliedrole = true;}
			if(isset($typeoft) && $typeoft=='traier' && $teacher->profile_field_trainerrole){$appliedrole = true;}
			if(!$appliedrole){continue;}
			$teacher_count++;
		}
	}
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
<div class="becometutor" style="padding:64px; 112px">
	<div class="contentbox">
	<?php if($typeoft === 'tutor'){ ?>
		<h3><?= get_string('becometutor', 'local_lonet') ?></h3>
	<?php }elseif($typeoft === 'coach'){ ?>
		<h3><?= get_string('becomecoach', 'local_lonet') ?></h3>
	<?php } elseif($typeoft === 'trainer'){ ?>
		<h3><?= get_string('becometrainer', 'local_lonet') ?></h3>
	<?php }else{ ?>
		<h3><?= get_string('wanttojoin', 'local_lonet') ?></h3>
	<?php }?>
	<p><?= get_string('becometutor_desc', 'local_lonet') ?></p>
		<div class="buttns">
			<a class="apply" href="/login/signup.php" target="_blank" rel="noopener noreferrer"><?= get_string('apply', 'local_lonet') ?></a>
			<a href="/best-language-platform-for-tutors-and-coaches" class="seebenefits"><?= get_string('seebenefits', 'local_lonet') ?></a>
		</div>
	</div>
	</div>
<div class="clearfix"></div>
<br>

<?php 
//if (get_string_manager()->string_exists('listdesc_' . $language, 'local_lonet') && $listdesc = get_string('listdesc_' . $language, 'local_lonet')) { 
if((get_string_manager()->string_exists('listpromo_'.$language, 'local_lonet') && $listpromo = get_string('listpromo_'.$language, 'local_lonet')) || (get_string_manager()->string_exists('listdesc_'.$language, 'local_lonet') && $listdesc = get_string('listdesc_'.$language, 'local_lonet'))) {
?>
	<?= $demourl ? '<div id="demo" style="width: 100%;display: flex;justify-content: center;">
		<div class="videoiframe">
			<iframe src="' . $demourl . '" allowfullscreen="" frameborder="0" style="width: 1000px;height: 570px;"></iframe>
		</div>
		<br>
	</div>' : '' ?>
    <div class="hero-unit this" style="border-radius: 40px;background: #F9FAFB;width: 1216px;padding: 32px;margin: 0 auto;margin-top:24px;">
        <div class="lpromo"><?php echo get_string('listpromo_'.$language, 'local_lonet'); ?></div>
		<div class="ldesc" style="display:none;"><?php echo get_string('listdesc_'.$language, 'local_lonet'); ?></div>
		<a href="javascript:void(0);" class="readmore_promo" style="color: #CE1369;font-size: 18px;font-weight: 700;">Read more...</a>
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
            <div class="modal-footer ">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><?= get_string('close', 'core_form') ?></button>
            </div>
        </div>
    </div>
</div>
<style>
.teachflags2{display:flex;gap:8px;margin-top: 16px; margin-bottom: 16px;
}
.teachflags2 img{width:26px !important;height:26px !important;margin-left:24px;}
.teachflags2 a{
	color: #374151;
font-size: 18px;
font-style: normal;
font-weight: 400;
line-height: 24px;
}
#price-modal .close{
	text-shadow:none !important;
	box-shadow:none !important;
	background: none !important;
}
#price-modal .modal-content{
	border-radius: 40px;
    background: #FFF;
    width: 810px;
    padding: 24px 32px;
}
#price-modal .modal-header,#price-modal .modal-body {padding: 0px !important; border: none !important;overflow-y:unset;}
#price-modal .modal-header h5{
	color: #000;
	font-size: 20px;
    font-style: normal;
    font-weight: 500;
    flex-grow: 1;
    line-height: normal;
}
#price-modal .modal-header{display: flex;}
#price-modal ul li svg{vertical-align: bottom;}
#price-modal ul{padding-top: 16px;}
#price-modal ul li{
	list-style:none;
    color: #170F83;
    font-size: 16px;
    font-style: normal;
    font-weight: 400;
    line-height: 24px;
}
#price-modal .indilesson,#price-modal .grouplesson{
	color: #4B5563;
	font-size: 18px;
	font-style: normal;
	font-weight: 400;
	line-height: 24px;
}
#price-modal .indilesson_price span,#price-modal .grouplesson_price span{
	border-radius: 40px;
    border: 1px solid #9CA3AF;
    padding: 8px 14px;
    color: #6B7280;
    font-size: 14px;
    font-style: normal;
    font-weight: 400;
    line-height: 20px;
}
.videoiframe{
	width: 1048px;
    height: 618px;
    border-radius: 20px;
    background: #EFEDE6;
    padding: 24px;
}
.hero-unit p,.hero-unit ul,.hero-unit ul li,.hero-unit figcaption{
	color: var(--Black, #000);
	font-size: 18px;
	font-style: normal;
	font-weight: 400;
	line-height: 24px;
}
.hero-unit a{
	    color: #CE1369;
    font-size: 18px;
    font-style: normal;
    font-weight: 700;
    line-height: 24px;
}
.hero-unit strong{font-size:18px;}
</style>
<?= $OUTPUT->footer() ?>
