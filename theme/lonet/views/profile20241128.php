<?php

use local_lonet\category;
use local_lonet\language;
use local_lonet\teacher;
use local_lonet\user;
use local_lonet\lesson;
// use local_lonet\wallet;

global $CFG,$DB,$USER,$PAGE,$OUTPUT;

require_once($CFG->dirroot . '/user/profile/lib.php');
require_once($CFG->dirroot . '/local/lonet/lib.php');
$week = (isset($_GET['week']) ? $_GET['week'] : 0);
$current_language = (isset($_GET['lang']) ? $_GET['lang'] : $USER->lang);
$lessons = ($id ? lesson::get_by_teacherid($id, $current_language) : []);
$useragent = (isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '');
$is_mobile = preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i', $useragent) || preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i', substr($useragent, 0, 4));
$reviews = teacher::get_reviews($user->id);
if (!$user) {
    echo '<div class="alert alert-danger">User #' . $id . ' not found. </div>';
} else {
$nameParts = explode(" ", $user->lastname);
$lastNameInitial = $nameParts[0][0] . ".";
$userfullname = $user->firstname.' '.$lastNameInitial;
$language_book = explode('_', current_language())[0];
?>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.btn-view-schedule').click(function(e) {
                e.stopPropagation();
                $.ajax({
                    type: 'GET',
                    url: '/local/lonet/ajax_schedule_container.php?teacherid=' + $(this).attr('data-teacherid'),
                    dataType: 'text',
                    success: function(result) {
                        if (result) {
                            $('#schedule-modal .modal-content').html(result);
                            $('#schedule-modal').modal();
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
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
            $('.btn-delete-account').click(function(e) {
                swal({
                    title: '<?= get_string('areyousuredelete', 'local_lonet') ?>',
                    text: '',
                    icon: 'warning',
                    buttons: {
                        cancel: {
                            text: '<?= get_string('no') ?>',
                            value: false,
                            visible: true,
                            className: 'btn-danger',
                            closeModal: true,
                        },
                        confirm: {
                            text: '<?= get_string('yes') ?>',
                            value: true,
                            visible: true,
                            className: 'btn-success',
                            closeModal: true
                        }
                    },
                    dangerMode: true,
                }).then((isSure) => {
                    if (isSure) {
                        $.ajax({
                            type: 'POST',
                            url: '/local/lonet/delete.php',
                            dataType: 'json',
                            success: function(result) {
                                if (result.status == true) {
                                    swal(result.message, '', 'info');
                                } else if ($result.message) {
                                    swal(result.message, '', 'error');
                                }
                            },
                            error: function(xhr, ajaxOptions, thrownError) {
                                swal('Server Error Occured', xhr.responseText, 'error');
                            }
                        });
                    }
                });
            });
            <?= (isset($_GET['book']) ? "$('.btn-view-schedule').click();" : '') ?>
            $('.btn-add-to-wallet').click(function(e) {
                $('#wallet-modal').modal('show');
            });
            $(document).on('click', '.expandgroup', function(e) {
				$('.grouplessoncontainer').slideToggle();
			});  
            $(document).on('click', '.expandindi', function(e) {
				$('.indilessoncontainer').slideToggle();
			});	
            $(document).on('click', '.first.customtabs .tab', function(e) {
				$('.first.customtabs .tab').removeClass('active');
				$(this).addClass('active');
				$('.profilemaincontentarea .tabcontent').hide();
				var tabclass = $(this).attr('data-tab');
				$('.profilemaincontentarea .'+tabclass).show();
			});	
            $(document).on('click', '.second.customtabs .tab', function(e) {
				$('.indilessons').hide();
				$('.indilessons_group').hide();
				$('.second.customtabs .tab').removeClass('active');
				$(this).addClass('active');
				var lang = $(this).attr('data-lang');
				$('.indilessons.tab_'+lang).show();
				$('.indilessons_group.tab_'+lang).show();
				$('.profilelangtab').prop('checked', false);
				$('#language-' + lang).prop('checked', true);
			});	
			$(document).on('click', '.indilessons .lessondiv', function(e) {
				<!-- $('.indilessons .lessondiv').removeClass('clicked'); -->
				<!-- $('.indilessons_group .lessondiv').removeClass('clicked'); -->
				$(this).addClass('clicked');
				var currlesson = $(this).attr('data-lesson');
				$('.lessonchecks').prop('checked', false);
				$('#lesson-'+currlesson).prop('checked', true);
				$('.schedule-container').removeClass('hidden');
				$('html, body').animate({
					scrollTop: $('.schedule-table-container').offset().top
				}, 1000);
			});
			$(document).on('click', '.indilessons_group .lessondiv', function(e) {
				<!-- $('.indilessons_group .lessondiv').removeClass('clicked'); -->
				<!-- $('.indilessons .lessondiv').removeClass('clicked'); -->
				$(this).addClass('clicked');
				var currlesson = $(this).attr('data-lesson');
				<!-- $('.indilesson_group .lessonchecks').prop('checked', false); -->
				$('#glesson-'+currlesson).prop('checked', true);
				$('.schedule-container').removeClass('hidden');
				$('html, body').animate({
					scrollTop: $('.schedule-table-container').offset().top
				}, 1000);
			});
			
			$(document).on('click', '.bookcallbtn', function(e) {
				var currlesson = $(this).attr('data-lesson');
				$('.lessondiv_'+currlesson).trigger('click');
			});			
			
			$(document).on('click', '.imhappy', function(e) {
				$('#learnearn-modal').modal('hide');
			});			
			$(document).on('click', '.iminterested', function(e) {
				$('#learnearn-modal').modal();
			});

			var maxToShow = 3; // Start by showing this many reviews
			var totalReviews = <?= count($reviews) ?>; // Total number of reviews

			$('#load-morer').on('click', function() {
				var hiddenReviews = $('.hidden-review').length;
				var toShow = Math.min(hiddenReviews, maxToShow);

				$('.hidden-review:lt(' + toShow + ')').slideDown().removeClass('hidden-review');

				if (hiddenReviews <= maxToShow) {
					$(this).hide(); // Hide "Load More" if all reviews are shown
				}
				$('#show-lessr').show(); // Show the "Show Less" button
			});

			$('#show-lessr').on('click', function() {
				var shownReviews = $('.container-review').not('.hidden-review').length;
				var toHide = Math.min(shownReviews, maxToShow);

				$('.container-review').not('.hidden-review').slice(-toHide).slideUp(function() {
					$(this).addClass('hidden-review');
				});

				$('#load-morer').show(); // Show the "Load More" button
				if ($('.container-review').not('.hidden-review').length <= maxToShow + 3) {
					$(this).hide(); // Hide "Show Less" if only the initial set is shown
				}
			});
			
			///auto scroll page
			  window.onload = function() {
				var hash = window.location.hash;
				if (hash === '#chooselessons') {
				  // var element = document.getElementById('chooselessons');
				  var element = document.getElementById('scrollhere');
				  if (element) {
					// Wait for a brief moment to ensure all content is loaded
					setTimeout(function() {
					  element.scrollIntoView({ behavior: 'smooth' });
					}, 100);
				  }
				}
			  };
			$("[data-toggle=popover]").popover({placement : 'top',trigger: 'hover',html: 'true'});
        })
    </script>
<!----------------------------------------------------------------------------Student dashboard---------------------------------------------------------->
<?php 
/* if ($is_teacher){ 
	echo '<h6 class="my-5 text-center" style="color: #111827;font-size: 28px;font-weight: 700;line-height: 36px;">'. fullname($user).' - online language tutor</h6>';
} */
if($USER->id == $user->id){
	echo '<style>.indilessons .indilesson{pointer-events:none;}</style>';
}
if (!$show_teacher){ ?>
<div class="studentdash">
<div class="student_learnearn mb-5">
	<h5 class="my-0 ltitle">Learn & Earn!</h5>
	<h5 class="my-0 ldesc1">Hit milestones and get rewards!</h5>
	<h5 class="my-0 ldesc2">50 lessons = €10, 100 lessons = €25, and more!</h5>
	<a href="#" class="btn interested iminterested">Interested</a>
</div>

<div class="learningprogress hidden">
	<h5 class="my-0 ltitle">Learning progress</h5>
	<div class="analytics">
	<div class="anafirstbox">
		<div class="selectdays">
			<select>
			<option>Last 30 days</option>
			</select>
		</div>
		<p class="my-0">Period 10.06.24-10.07.24 compared to 10.04.24-10.05.24</p>
	</div>
	<div class="anasecondbox">
		<div class="hour">
			<h4 class="my-0 hournumber">120</h4>
			<h5 class="my-0 hourstudied">Hours studied</h5>
			<p class="my-0 growthicon">
			<svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26" fill="none">
			  <path d="M14.0095 7.94434H22.0984M22.0984 7.94434V16.0332M22.0984 7.94434L14.0095 16.0332L9.9651 11.9888L3.89844 18.0554" stroke="#22C55E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
			</svg> 1%
			</p>
		</div>
		<div class="lcompleted">
			<h4 class="my-0 hournumber">120</h4>
			<h5 class="my-0 hourstudied">Hours studied</h5>
			<p class="my-0 downicon">
			<svg xmlns="http://www.w3.org/2000/svg" width="27" height="26" viewBox="0 0 27 26" fill="none">
			  <path d="M14.6736 18.0554H22.7625M22.7625 18.0554V9.96656M22.7625 18.0554L14.6736 9.96656L10.6292 14.011L4.5625 7.94434" stroke="#EF4444" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
			</svg> 2%
			</p>		
		</div>
		<div class="milestones">
			<h4 class="my-0 hournumber">10</h4>
			<p class="my-0">Lessons to	<span>Milestone 3</span></p>
		</div>
		<div class="dedication">
		<h4 class="my-0 hournumber">100%</h4>
		<h5 class="my-0 hourstudied">Dedication level</h5>
		</div>
	</div>
	</div>
</div>
</div>
<?php } ?>
<!----------------------------------------------------------------------------Student dashboard---------------------------------------------------------->
<!---------------------------------------------------------------------------New profile design---------------------------------------------------------->
<?php 
if ($show_teacher){ 
$userteach_arr =  user::get_languages_from_data($user->profile_field_languagesteaching,true);
$userteach = implode('  ', $userteach_arr);

$speaks_arr = user::get_languages_from_data($user->profile_field_languagesspeaking, true);
$speaks = implode('  ', $speaks_arr);
?>
<div class="mainprofilepagecontainer">
<div class="profiletopsection">
	<h6 class="my-0"><?= $userfullname ?> - online language tutor</h6>
	<?php
		echo '<div style="display: flex; gap: 10px;">';
		if($user->profile_field_tutorrole){
			echo '<p class="my-0 tuttype tutor">Lonet.<span>Tutor</span></p>';
		}
		if($user->profile_field_coachrole){
			echo '<p class="my-0 tuttype coach">Lonet.<span>Coach</span></p>';
		}
		if($user->profile_field_trainerrolerole){
			echo '<p class="my-0 tuttype trainer">Lonet.<span>Trainer</span></p>';
		}
		echo '</div>';
	?>
	<div class="teachspeak">
		<div class="teaches">
			<div class="labe">Speaks:</div>
			<div class="teachlang"><?= $speaks ?></div>
		</div>
		<div class="speaks">
			<div class="labe">Teaches:</div>
			<div class="speaklang"><?= $userteach ?></div>
		</div>
	</div>
</div>
<?php } ?>
<?php if ($can_edit) { ?>
	<?= renderFile($CFG->dirroot . '/local/lonet/_lessons_profile.php', ['user' => $user, 'fullhistory' => false, 'role' => ($show_teacher ? 'teacher' : 'learner')]) ?>
<?php } ?>

<div class="profilemaincontentarea">
<div class="leftsidecontent">
<?php //if ($show_teacher && $videourl = user::get_video_embed_url($user) && !$is_teacher) { ?>
<?php if ($videourl = user::get_video_embed_url($user)) { ?>
	<div class="uservideo">
		<iframe src="<?= $videourl ?>" frameborder="0" allowfullscreen style="width:100%; height:517px;"></iframe>
	</div>
<?php }
//-------------------------------------Stats Card--------------------------
if ($show_teacher){ 
	$progress = ($show_teacher ? teacher::get_acceptance_rate($user->id) : user::get_profile_completion($user));
	// $label = ($show_teacher ? get_string('Acceptance_Rate', 'theme_lonet') : get_string('Profile_Completion', 'theme_lonet')); 
	$label = 'My responsiveness rate';
?>
	<div class="stats_card">
		<div class="experience">
		<h4 class="my-0 strong">
		<?php 
			if($user->profile_field_teachingexperience == 'more than 1 year'){
				echo '1+';
			}elseif($user->profile_field_teachingexperience == 'more than 3 years'){
				echo '3+';
			}elseif($user->profile_field_teachingexperience == 'more than 5 years'){
				echo '5+';
			}elseif($user->profile_field_teachingexperience == 'more than 10 years'){
				echo '10+';
			}else{
				echo 'N/A';
			}
		?>
		</h4>
		<h4 class="my-0">Years of experience</h4>
		</div>
		<div class="age">
		<h4 class="my-0 strong"><?= ($user->profile_field_youngestage) ? $user->profile_field_youngestage.'+' : 'N/A'; ?></h4>
		<h4 class="my-0">Youngest age I accept</h4>
		</div>
		<div class="price_from">
		<h4 class="my-0 strong">&euro;<?= teacher::get_trial_price($user) ?></h4>
		<h4 class="my-0">Price starts from</h4>
		</div>
		<div class="acceptance">
		<h4 class="my-0 strong"><?= $progress ?>%</h4>
		<h4 class="my-0"><?= $label ?></h4>
		</div>
	</div>
<?php
}
$hobbies = core_tag_tag::get_item_tags('core', 'user', $user->id); 
$myeducation = ($user->profile_field_education ? $user->profile_field_education : get_string('noeducationlisted', 'local_lonet'));
?>
<!--------------------------------Tabs------------------------------------->
<div class="first customtabs">
  <div class="tab active" data-tab='aboutme'><h5 class="my-0">About me</h5></div>
  <?php 
  if ($show_teacher){ 
	if($user->profile_field_tutorrole == 1){
		echo '<div class="tab" data-tab="mytutor"><h5 class="my-0">My tutoring</h5></div>';
	}
	if($user->profile_field_coachrole == 1){
		echo '<div class="tab" data-tab="mycoach"><h5 class="my-0">My coaching</h5></div>';
	}
	if($user->profile_field_trainerrole == 1){
		echo '<div class="tab" data-tab="mytraining"><h5 class="my-0">My training</h5></div>';
	}
	}
  ?>
</div>

<div class="aboutme tabcontent mt-3">
	<p class="my-0 para"><?= format_text($user->profile_field_aboutme['text']) ?></p>
	<div class="myedu">
		<h5 class="my-0">My education:</h5>
		<p class="my-0"><?= $myeducation ?></p>
	</div>
	<div class="experiencein">
		<h6 class="my-0">I work in:</h6>
		<div class="experiencepill">
		<?php if(!empty($user->profile_field_occupation)) { echo'<span>'.$user->profile_field_occupation.'</span>';} ?>
		</div>
	</div>
	<div class="hobbies">
		<h6 class="my-0">My hobbies and interests:</h6>
		<div class="hobbiespill">
		<?php 
		foreach($hobbies as $singlehobby){
			echo '<span>'.$singlehobby->rawname.'</span>';
		}
		?>
		</div>
	</div>
	<div class="membersince">
	<h6 class="my-0">Member since:</h6>
	<span class="date" style="padding-left:8px;padding-right:24px;"><?= date('j M Y', $user->timecreated); ?></span>	
	
	<h6 class="my-0">Timezone:</h6>
	<?php
		$timezone = $user->timezone;
		if ($timezone == 99 || $timezone === '' || $timezone === null) {
			$utimezone = date_default_timezone_get();
		} else {
			$utimezone = $timezone;
		}
	?>
	<span class="date" style="padding-left:8px;padding-right:24px;"><?= $utimezone ?></span>
	<span class="location hidden">
		<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
		  <path d="M14.1007 12.8995C13.5075 13.4927 12.3487 14.6515 11.4138 15.5863C10.6328 16.3674 9.36738 16.3672 8.58633 15.5862C7.66878 14.6686 6.53036 13.5302 5.89966 12.8995C3.63501 10.6348 3.63501 6.96313 5.89966 4.69848C8.1643 2.43384 11.836 2.43384 14.1007 4.69848C16.3653 6.96313 16.3653 10.6348 14.1007 12.8995Z" stroke="#6B7280" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
		  <path d="M12.1748 8.79899C12.1748 10 11.2012 10.9736 10.0002 10.9736C8.79915 10.9736 7.82554 10 7.82554 8.79899C7.82554 7.59798 8.79915 6.62437 10.0002 6.62437C11.2012 6.62437 12.1748 7.59798 12.1748 8.79899Z" stroke="#6B7280" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
		</svg>
		<?= $user->profile_field_citizenship ?>
	</span>
	</div>
</div>
<div class="mytutor tabcontent mt-3" style="display:none;">
<div class="my-0 para"><?= format_text($user->profile_field_teacherdescription['text']) ?></div>
<div class="my-0 para"><?= format_text($user->profile_field_lessonplan['text']) ?></div>
	<div class="certs">
		<h5 class="my-0">Certificates:</h5>
		<p class="my-0"><?= $user->profile_field_teachingcertificates ?></p>
	</div>	
	<div class="levels">
		<h5 class="my-0">Levels I teach:</h5>
		<div class="levelspill">
		<?php 
			foreach($user->profile_field_levelyouteach as $lteach){
				echo '<span>'.$lteach.'</span>';
			}
		?>
		</div>
	</div>	
	<div class="connectvia">
		<h5 class="my-0">I prefer to connect via:</h5>
		<?php
			if(!empty($user->profile_field_onlinetools)){
				foreach($user->profile_field_onlinetools as $value) {
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
	<div class="specialin">
		<h5 class="my-0">I am specialized in:</h5>
		<div class="spacialinpill" style="display: flex;align-items: flex-start;gap: 24px;flex-wrap: wrap;">
		<?php
			if(!empty($user->profile_field_bestatteaching)){
				foreach($user->profile_field_bestatteaching as $value) {
					echo '<span>'.$value.'</span>';
				}
			}else{
				echo '<span>N/A</span>';
			}
		?>
		</div>
	</div>
</div>
<?php
$coachlangs = user::get_languages_from_data($user->profile_field_coachlanguagesteaching,true);
?>
<div class="mycoach tabcontent mt-3" style="display:none;">
<div class="my-0 para"><?= format_text($user->profile_field_describecoachvalue['text']) ?></div>
<div class="my-0 para"><?= format_text($user->profile_field_coachingstyle['text']) ?></div>
	<div class="langs">
		<h5 class="my-0">Languages I coach in:</h5>
		<div class="langsflags">
		<?php  foreach($coachlangs as $key => $value){ ?>
			<div><img src="<?=$CFG->wwwroot?>/theme/lonet/pix/flag/<?= $key ?>.png" alt="<?= $key ?>" width="20" height="20"> <?= $value ?></div>
		<?php } ?>
		</div>
	</div>
	<div class="levels">
		<h5 class="my-0">Levels I coach:</h5>
		<div class="levelspill">
		<?php
		foreach($user->profile_field_levelyoucoach as $levelcoach){
			echo '<span>'.$levelcoach.'</span>';
		}
		?>
		</div>
	</div>	
	<div class="certs">
		<h5 class="my-0">Certificates:</h5>
		<p class="my-0"><?= $user->profile_field_coachingcert ?></p>
	</div>	
	<div class="connectvia">
		<h5 class="my-0">I prefer to connect via:</h5>
		
		<?php
			if(!empty($user->profile_field_onlinetools)){
				foreach($user->profile_field_onlinetools as $value) {
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
	<div class="specialin">
		<h5 class="my-0">I am specialized in:</h5>
		<div class="spacialinpill" style="display: flex;align-items: flex-start;gap: 24px;flex-wrap: wrap;">
		<?php
			if(!empty($user->profile_field_coachspecialization)){
				foreach($user->profile_field_coachspecialization as $value) {
					echo '<span>'.$value.'</span>';
				}
			}else{
				echo '<span>N/A</span>';
			}
		?>
		</div>
	</div>
</div>
<div class="mytraining tabcontent mt-3" style="display:none;">
<div class="my-0 para"><?= format_text($user->profile_field_trainerdescription['text']) ?></div>
<div class="my-0 para"><?= format_text($user->profile_field_trainingimpact['text']) ?></div>
	<div class="levels">
		<h5 class="my-0">Levels I train:</h5>
		<div class="levelspill">
		<?php
		foreach($user->profile_field_levelyoutrain as $leveltrain){
			echo '<span>'.$leveltrain.'</span>';
		}
		?>
		</div>
	</div>	
	<div class="connectvia">
		<h5 class="my-0">I prefer to connect via:</h5>
		
		<?php
			if(!empty($user->profile_field_onlinetools)){
				foreach($user->profile_field_onlinetools as $value) {
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
	<div class="typeoflessons">
		<h5 class="my-0">Types of lessons</h5>
		<div class="typeoflessonspill">
		<span>Conversational skills</span>
		<span>Exam preparation</span>
		<span>Listening skills</span>
		<span>Vocabulary boost</span>
		<span>Everyday language</span>
		<span>Language for traveling</span>
		</div>
	</div>
</div>
<!-----------------------------------------choose lessons---------------------------------->
<?php if ($show_teacher){?>
<div class="scrollhere" id="scrollhere" style="margin-bottom: 64px;display: flex;"></div>
<div class="chooselessons mt-0" id="chooselessons">
<h5 class="my-0 heading">Choose a lesson:</h5>
<?php
$current_language = empty($current_language) ? 'en' : $current_language;
$teachlanguages = ($id ? teacher::get_languages($id) : []);
$has_language_selection = (count($teachlanguages) > 0);
$can_book_trial = user::can_book_trial($id, ($current_language ? $current_language : (!$has_language_selection ? key($teachlanguages) : null)));
if ($has_language_selection) {
	echo '<div class="second customtabs mt-0" id="language-selection">';
	$j = 1;
	foreach ($teachlanguages as $code => $language) { ?>
		<input type="radio" class="profilelangtab" id="language-<?= $code ?>" name="language" value="<?= $code ?>" <?= ($code == $current_language ? 'checked' : '') ?>>
		<!--label for="language-<?php //$code ?>"><strong><?php //$language ?></strong></label-->
		<!--div class="tab <?= ($code == $current_language ? 'active' : '') ?>" data-lang='<?= $code ?>' data-tab='<?= $language ?>'><h5 class="my-0"><?= $language ?></h5></div-->
		<div class="tab <?= ($j == 1 ? 'active' : '') ?>" data-lang='<?= $code ?>' data-tab='<?= $language ?>'><h5 class="my-0"><?= $language ?></h5></div>
	<?php $j++; }
	echo '</div>';
	$k =1;
	foreach ($teachlanguages as $code => $language) {
		$flessons = lesson::getObjectsByLanguage($lessons,$code);
		$grouplessons = ($id ? lesson::get_grouplesson_by_teacherid($id, $code) : []);
/* 		if(count($teachlanguages) > 1){
			// $style = (!$has_language_selection || !$code || $code == $current_language ? '' : 'display: none;');
			$style = ($k=1) ? '' : 'display: none';
		}else{
			$style = '';
		} */
		$style = ($k==1) ? '' : 'display: none';
		if(!empty($flessons)){
			echo  '<div class="indilessons tab_'.$code.' '.$k.'" id="lesson-selection" style="'.$style.'">';
			echo '<h6 class="my-0 indititle">Individual lessons</h6>';
			echo '<div class="indilesson">';
			$i=1;
			if ($can_book_trial) {
				if($getrial = $DB->get_record_sql("SELECT * FROM {lonet_lesson} WHERE teacherid=".$user->id." AND istrial=1 AND isactive=1 AND name='Discovery Call' LIMIT 0,1")){
					$flessons[$getrial->id] = $getrial;
				}
			}
			// print_object($flessons);
			foreach ($flessons as $lesson) {
				// if (!$lesson->istrial || $can_book_trial) {
				$lessname = (\core_text::strlen($lesson->name) > 18) ? \core_text::substr($lesson->name, 0, 18)." ..." : $lesson->name;
				$shortlessname = (\core_text::strlen($lesson->name) > 15) ? \core_text::substr($lesson->name, 0, 15)." .." : $lesson->name;
		 ?>
					<input class="lessonchecks" type="radio" id="lesson-<?= $lesson->id ?>" name="lessonid" data-grouplesson= "<?= base64_encode(0) ?>" data-length="<?= $lesson->length ?>" data-shortname="<?= $shortlessname ?>" data-name="<?= $lesson->name ?>" value="<?= $lesson->id ?>" data-trial="<?= ($lesson->istrial ? 1 : 0) ?>" data-language="<?= $lesson->language ?>">

					<!--label for="lesson-<?= $lesson->id ?>"><strong><?= $lesson->name ?></strong> &euro;<?= lesson::get_price($lesson)?> (<?= get_string('nummin', 'core_moodle', max(30, (($lesson->length / 60) - 10))) ?>)</label-->
					
					<div class="lessondiv lessondiv_<?= $lesson->id ?>" data-lesson="<?= $lesson->id ?>">
					<h6 class="my-0 lname" data-toggle="popover" data-title="" data-content="<?= $lesson->name ?>" style="color: #000;font-size: 18px;font-weight: 500;"><?= $lessname ?> | <?= get_string('nummin', 'core_moodle', max(30, (($lesson->length / 60) - 10))) ?></h6>
					<h4 class="my-0 lprice" style="color: #170F83;font-size: 20px;font-weight: 700;line-height: 36px;">&euro;<?= lesson::get_price($lesson)?></h4>
					</div>
					<?php $i++;?>
			<?php //}
			}
			echo '</div>';
			echo '</div>';
		}
		
		/*****************************************Group lessons********************************************/
		if(!empty($grouplessons)){
		echo  '<div class="indilessons_group profilepage tab_'.$code.'" id="lesson-selection" style="'.$style.'">';
		echo '<h6 class="my-0 indititle">Group lessons</h6>';
		echo '<div class="indilesson_group">';
		$i=1;
		foreach ($grouplessons as $glesson) {
			if (!$glesson->istrial || $can_book_trial) {
			$lessname = (\core_text::strlen($glesson->lessonname) > 18) ? \core_text::substr($glesson->lessonname, 0, 18)." ..." : $glesson->lessonname;
			$lesson_desc = (\core_text::strlen($glesson->lesson_desc) > 50) ? \core_text::substr(strip_tags($glesson->lesson_desc), 0, 50)." ..." : $glesson->lesson_desc;
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
		<input class="lessonchecks" type="radio" id="glesson-<?= $glesson->id ?>" name="lessonid" data-maxamountreq="<?= base64_encode($glesson->maxamount) ?>" data-currentusers="<?= base64_encode($glessonmembers) ?>" data-grouplesson= "<?= base64_encode(1) ?>" data-length="<?= abs($timeinsec) ?>" data-name="<?= $glesson->lessonname ?>" value="<?= $glesson->id ?>" data-trial="<?= ($glesson->istrial ? 1 : 0) ?>" data-language="<?= $glesson->language ?>" data-gdate="<?=$lessondate;?>" data-gtimefrom="<?= $glessontimes->timefrom ?>" data-gtimeto="<?= $glessontimes->timeto ?>">
		
		<div class="lessondiv" data-lesson="<?= $glesson->id ?>">
			<div class="infocontainer">
				<div class="firstbox">
					<div class="nameprice">
					<h6 class="my-0 lname" data-toggle="popover" data-title="" data-content="<?= $glesson->lessonname ?>" style="color: #000;font-size: 18px;font-weight: 500;"><?= ucfirst($lessname) ?></h6>
					<h4 class="my-0 lprice" style="color: #170F83;font-size: 20px;font-weight: 700;line-height: 36px;">&euro;<?= lesson::get_price($glesson)?></h4>
					</div>
					<p class="my-0 lessondesc" data-toggle="popover" data-html="true" data-title="" data-content="<?= $glesson->lesson_desc ?>"><?= $lesson_desc ?></p>
				</div>
				<div class="secondcontainer">
					<div class="secondbox">
						<p class="my-0">Duration: <span><?= get_string('numminutes', 'core_moodle', ((abs($glesson->timefrom-$glesson->timeto) / 60) - 10)) ?></span></p>
						<p class="my-0">Date: <span><?= $lessondatedisplay; ?></span>
						<p class="my-0">Time: <span><?= $glessontimes->timefrom; ?></span>
						<p class="my-0">Attendees: <span><?=$glesson->minamount;?>-<?=$glesson->maxamount;?></span>
						<p class="my-0">Places left: <span><?= $glesson->maxamount-$glessonmembers;?></span>&nbsp;&nbsp;(<?= $attendees_msg; ?>)</p>						
					</div>
					<div class="thirdbox">
					<h6 class="my-0">What is the lesson about:</h6>
					<p class="my-0">
						Let's talk about something interesting! 
						In July I suggest a topic of water  :))))
						- watersports and activities (focus on vocabulary);
						- returning to Titanic (audio content to speak about);
						- Four Women and a Wild River (video content to discuss)
						We will use the National Geographic Learning students' material "Life" to practice your speaking.
						You will participate in group discussions and share your ideas and thoughts.
						Join this interactive class today and enhance your speaking skills in English!					
					</p>
					</div>
					<div class="forthbox">
					<h6 class="my-0">What will you learn:</h6>
					<p class="my-0">
						You will speak about water in different contexts. You will learn to use specific phrases to describe and express your ideas, and opinions and to ask questions.  
						- B2 level vocabulary (intermediate) about sports and leisure activities connected with water;
						- B2 level phrases about describing experiences (in the past) and opinions;
						- Pronunciation of "t" and "d"" in -ed endings;
						- reflecting on the opinions and ideas of others (agreeing, disagreeing).					
					</p>
					</div>
				</div>
			</div>
		</div>
		<?php $i++;?>
		<?php }
		}
		echo '</div>';
		echo '</div>';
	}
	$k++;
	}
?>
		<div class="schedule-container hidden" <?= ($USER->id ? 'style="display:block;"' : '') ?>>
			<?= renderFile('_schedule_profile.php', ['teacherid' => $id, 'week' => $week]) ?>
		</div>
		
		<!----------------------- lesson selected--------------------->
		<div class="selectedlessoncontainer"></div>
		
		<div class="step-3 text-center" style="display: none;">
		<h6 class="my-0">You’ve selected <span class="lcount">1</span> <span class="ltext">lesson</span>.</h6>
		<p class="my-0 sellesson">Select more lessons or proceed to payment.</p>
		<button class="btn btn-success">Proceed to payment</button>
		</div>
<?php }
?>
</div>
<?php if ($show_teacher && $reviews) { ?>
	<div class="reviewaboutme" id="ratings">
		<div class="col-sm-12">
			<h5 class="my-0">Reviews about me:</h5>
		</div>
		<?= renderFile($CFG->dirroot . '/local/lonet/_reviews.php', ['reviews' => $reviews]) ?>
	</div>
<?php } ?>
<!------------------------------------------Review about me-------------------------------->
	<!--div class="reviewaboutme">
		<h5 class="my-0">Reviews about me:</h5>
		<div class="reviews">
		<div class="review">
		<p class="my-0 comment">OMG, I've never had so much fun learning a language! Lindsay is amazing – they make everything interesting and their energy is contagious. Highly recommend!!!</p>
		<div class="profile">
			<img src="<?=$CFG->wwwroot?>/theme/lonet/pix/teacher1.svg">
			<div class="name-date">
				<p class="name my-0">Jaxson Mango</p>
				<p class="date my-0">2024-04-22</p>
			</div>
		</div>
		</div>
		<div class="review">
		<p class="my-0 comment">Lindsay helped me overcome my fear of speaking and finally reach fluency. They're patient, supportive, and always make learning feel achievable.</p>
		<div class="profile">
			<img src="<?=$CFG->wwwroot?>/theme/lonet/pix/teacher2.svg">
			<div class="name-date">
				<p class="name my-0">Emery Bator</p>
				<p class="date my-0">2024-04-23</p>
			</div>
		</div>
		</div>
		<div class="review">
		<p class="my-0 comment">Got the score I needed on my proficiency exam thanks to Lindsay. Their targeted preparation and study strategies were a game-changer.</p>
		<div class="profile">
			<img src="<?=$CFG->wwwroot?>/theme/lonet/pix/teacher3.svg">
			<div class="name-date">
				<p class="name my-0">Zaire Press</p>
				<p class="date my-0">2024-04-24</p>
			</div>
		</div>
		</div>
		<div class="review">
		<p class="my-0 comment">Lindsay doesn't just teach grammar – they share insights into the culture, history, and everyday life, making the language come alive.</p>
		<div class="profile">
			<img src="<?=$CFG->wwwroot?>/theme/lonet/pix/teacher3.svg">
			<div class="name-date">
				<p class="name my-0">Abram Baptista</p>
				<p class="date my-0">2024-04-24</p>
			</div>
		</div>
		</div><div class="review">
		<p class="my-0 comment">Highly recommend Lindsay. Knowledgeable, friendly, and helped me improve quickly.</p>
		<div class="profile">
			<img src="<?=$CFG->wwwroot?>/theme/lonet/pix/teacher1.svg">
			<div class="name-date">
				<p class="name my-0">Zaire Baptista</p>
				<p class="date my-0">2024-04-24</p>
			</div>
		</div>
		</div>
		<div class="review">
		<p class="my-0 comment">Learning with Lindsay is a blast! We even laugh through my pronunciation mistakes. Turns out, language learning doesn't have to be painful.</p>
		<div class="profile">
			<img src="<?=$CFG->wwwroot?>/theme/lonet/pix/teacher2.svg">
			<div class="name-date">
				<p class="name my-0">James Vetrovs</p>
				<p class="date my-0">2024-05-08</p>
			</div>
		</div>
		</div>
		</div>
	</div-->
<?php }
//------------------------------------------Most popular------------------------------
if (!$show_teacher) { ?>
	<div class="row user-row mostpopular">
	<div class="col-xs-12 text-center user-description-full mb-5">
	<h5 class="my-0" style="color: #374151;font-size: 24px;font-weight: 700;">Curious to try different approaches?</h5>
	<p class="my-0">We've handpicked the perfect trio to elevate your learning:</p>
	</div>
	<?php 
	if($user->profile_field_languageslearning != '')
		$languages = "'" . implode ( "', '", $user->profile_field_languageslearning) . "'";
	elseif($user->profile_field_wantlearnlang != '')
		$languages = "'" . language::get_code_by_name($user->profile_field_wantlearnlang) . "'";
	//    $languages = "'" . implode ( "', '", $user->profile_field_languageslearning) . "'";
	foreach (teacher::get_relatedteachers($user->id,$languages) as $key => $val) {
		if($val['teacherid'] != $user->id){
		$teacher = user::get_by_id($val['teacherid']);
		?>
			<div class="col-sm-4 text-center">
				<div class="user-picture-container">
				<?php
					$usercontext = context_user::instance($teacher->id);
					$userpicf3 = $OUTPUT->user_picture($teacher, ['size' => '150', 'link' => false]);
					if($DB->record_exists_sql("SELECT * FROM {files} WHERE component='user' AND filearea='icon' AND itemid=0 AND contextid=".$usercontext->id." AND filename LIKE '%original%'")){
						$userpic = str_replace('/f3','/original', $userpicf3);
					}else{
						$userpic =  $userpicf3;
					}				
				?>
					<?php //$OUTPUT->user_picture($teacher, ['size' => '100']) ?>
					<a href="<?= $CFG->wwwroot ?>/user/profile.php?id=<?= $teacher->id ?>&lang=<?= explode('_', current_language())[0] ?>&teacher_profile=1" target="_blank" style="margin-bottom: 5px;"><?= $userpic ?></a>
					<div class="indicator <?= (user::is_online($teacher) ? 'online' : '') ?>"></div>
					<h1 class="card-title mb-0" style="font-size: 1.4em; color: #1a1a1a; line-height: normal;"><?= fullname($teacher, true) ?></h1>
					<div class="tutortypediv" style="min-height:100px;">
					<?php
						if($teacher->profile_field_tutorrole){
							echo '<p class="my-0 tuttype tutor">Lonet.<span>Tutor</span></p>';
						}
						if($teacher->profile_field_coachrole){
							echo '<p class="my-0 tuttype coach">Lonet.<span>Coach</span></p>';
						}
						if($teacher->profile_field_trainerrolerole){
							echo '<p class="my-0 tuttype trainer">Lonet.<span>Trainer</span></p>';
						}
						if($disclesson = $DB->get_record_sql("SELECT * FROM {lonet_lesson} WHERE teacherid=".$teacher->id." AND name='Discovery call' ORDER BY id desc LIMIT 0,1")){
							$dprice = $disclesson->price + get_config("local_lonet", "commissionperlesson");
							echo '<p class="my-3" style="color:#CE1369;font-size:18px;">'.$disclesson->name.'&nbsp;&euro;'.$dprice.'</p>';
						}
					?>
					</div>
					<p class="hidden"><button type="button" class="btn btn-block btn-success btn-view-schedule login-required" data-teacherid="<?= $teacher->id ?>"><?= get_string($val['buttonname'], 'local_lonet') ?></button></p>
					<a class="btn interested" href="<?= $CFG->wwwroot ?>/user/profile.php?id=<?= $teacher->id ?>&lang=<?= explode('_', current_language())[0] ?>&teacher_profile=1" target="_blank" style="margin-bottom: 5px;width:150px;">View profile</a>
				</div>
			</div>
		  <?php }
	  } ?>  
	</div>
<?php } ?>
</div>
<?php
if($show_teacher && !$is_self){
	echo '<div class="rightsidecontent" style="border-radius:0px;background:none;height:auto;padding:0px;">';
	$usercontext = context_user::instance($user->id);
	$userpicf3 = $OUTPUT->user_picture($user, ['size' => '225', 'link' => false]);
	if($DB->record_exists_sql("SELECT * FROM {files} WHERE component='user' AND filearea='icon' AND itemid=0 AND contextid=".$usercontext->id." AND filename LIKE '%original%'")){
		$userpic = str_replace('/f3','/original', $userpicf3);
	}else{
		$userpic =  $userpicf3;
	}
?>
<div style="border-radius: 40px;
    background: #EFEDE6;display: flex;
    width: 280px;
    height: 584px;
    padding: 32px 16px;
    flex-direction: column;
    align-items: center;">
	<a href="<?= $CFG->wwwroot ?><?= $url ?>" target="_blank"><?= $userpic ?></a>
	<?= teacher::render_rating_new($user) ?>
	<h4 class="my-0 hundlessons hidden">100 <span>lessons</span></h4>
	<?php
	$discovery_lesson = $DB->get_record_sql("SELECT * FROM {lonet_lesson} WHERE name='Discovery Call' AND teacherid=".$user->id." ORDER BY id desc LIMIT 0,1");
	if($discovery_lesson){
		$finalp = $discovery_lesson->price + get_config("local_lonet", "commissionperlesson");
		echo '<div class="ldetail">
			<div style="display: flex;justify-content: space-between;">
			<h5 class="my-0 lname">'.$discovery_lesson->name.'</h5>
			<h5 class="my-0 lprice">&euro;'.$finalp.'</h5>
			</div>
			<p class="my-0 lduration">'.get_string("nummin", "core_moodle", max(30, (($discovery_lesson->length / 60) - 10))).'</p>
		</div>
		<a href="#" class="bookcallbtn" data-lesson='.$discovery_lesson->id.'>Book a call</a>';
	}
	echo '</div>';
	if(is_siteadmin()){		
		echo '<div class="loginrightsidecontent mt-5" style="display: flex; width: 384px;flex-direction: column;align-items: center;gap:32px;">';
		echo '<div class="userbal rightcommon">
			<div class="leftside">
				<h6 class="my-0 rtitle">Balance</h6>
				<h6 class="mt-3 mb-0 amount">&euro; '.number_format(user::get_balance($user->id), 2).'</h6>
				<h6 class="my-0 availbal">&euro; '.number_format(user::get_available_balance($user->id), 2).' '.get_string('available', 'local_lonet').'</h6>
			</div>
			<div class="rightside">'.get_string('balanceicon','local_lonet').'</div>
		</div>';

		echo '<div class="transaction rightcommon"><div class="leftside"><a href="'.$CFG->wwwroot.'/local/lonet/wallet.php?id='.$user->id.'" class="rtitle">Transaction history</a></div><div class="rightside">'.get_string('transactionicon','local_lonet').'</div></div>';
		
		if ($show_teacher) {
			if (teacher::can_request_payout($user)) {
				echo '<div class="transaction rightcommon"><div class="leftside"><a href="'.$CFG->wwwroot.'/local/lonet/payout.php?id='.$user->id.'" class="rtitle">'.get_string("requestpayout", "local_lonet").'</a></div><div class="rightside amount">&euro; '.number_format(user::get_available_balance($user->id), 2).'</div></div>';
			} elseif ($pending_amount = teacher::get_pending_payout_request_amount($user->id)) {
				echo '<div class="transaction rightcommon"><div class="leftside"><a href="'.$CFG->wwwroot.'/local/lonet/wallet.php?id='.$user->id.'" class="rtitle">Pending Payout Request</a></div><div class="rightside amount">&euro; '.$pending_amount.'</div></div>';
			}
		}
		if ($is_teacher) {
			if ($can_edit) {
				echo '<div class="editlessons rightcommon"><div class="leftside"><a href="'.$CFG->wwwroot.'/local/lonet/lessons.php?teacherid='.$user->id.'" class="rtitle">Edit lessons</a></div><div class="rightside">'.get_string('editlessonicon','local_lonet').'</div></div>';
				
				echo '<div class="editschedule rightcommon"><div class="leftside"><a href="'.$CFG->wwwroot.'/local/lonet/edit.php?teacherid='.$user->id.'" class="rtitle">Edit schedule</a></div><div class="rightside">'.get_string('scheduleicon','local_lonet').'</div></div>';	
			}
		}
		echo '<div class="lessonhistory rightcommon"><div class="leftside"><a href="'.$CFG->wwwroot.'/local/lonet/history.php?id='.$user->id.'" class="rtitle">Lesson history</a></div><div class="rightside">'.get_string('lessonhistoryicon','local_lonet').'</div></div>';	
		
		if ($is_self) {
			echo '<div class="editprofile rightcommon"><div class="leftside"><a href="'.$CFG->wwwroot.'/user/editadvanced.php?&id='.$user->id.'" class="rtitle">Edit profile</a></div><div class="rightside">'.get_string('editprofileicon','local_lonet').'</div></div>';
			echo '<div class="changepass rightcommon"><div class="leftside"><a href="'.$CFG->wwwroot.'/login/change_password.php" class="rtitle">Change password</a></div><div class="rightside">'.get_string('changepassicon','local_lonet').'</div></div>';
		}else{
			echo '<div class="editprofile rightcommon"><div class="leftside"><a href="/user/'.$user->id.'/edit" class="rtitle" target="_blank" rel="noopener noreferrer">Edit profile</a></div><div class="rightside">'.get_string('editprofileicon','local_lonet').'</div></div>';
		}
		if ($is_self) {
			$can_delete = user::can_delete_account($id);
			echo '<div class="deleteprofile rightcommon"><div class="leftside"><a href="javascript:void(0);" class="rtitle btn-delete-account" '.($can_delete ? '' : 'disabled').' data-toggle="tooltip" title="'.($can_delete ? "" : get_string("youcannotdeleteaccount", "local_lonet")).'">Delete profile</a></div><div class="rightside">'.get_string('bigtrashicon','local_lonet').'</div></div>';
		}
		if(is_siteadmin()) {
			echo '<div class="loginas rightcommon"><div class="leftside"><a href="/course/loginas.php?user='.$user->id.'&sesskey='.$USER->sesskey.'" class="rtitle">Log in As</a></div><div class="rightside hidden">'.get_string('editprofileicon','local_lonet').'</div></div>';		
			echo '<div class="userlogs rightcommon"><div class="leftside"><a href="/report/log/user.php?id='.$user->id.'&course=1&mode=all" class="rtitle">User Logs</a></div><div class="rightside hidden">'.get_string('editprofileicon','local_lonet').'</div></div>';	
		}
		if (!$show_teacher) {
			if ($language_book == 'lv') {
				$cover_url = "/local/lonet/pix/gramata_LV.png";
				$ebook_pdf = "/blog/wp-content/uploads/2021/11/eBook-LV-single-page.pdf";
			}else{
				$cover_url = "/local/lonet/pix/gramata_ENG.png";
				$ebook_pdf = "/blog/wp-content/uploads/2021/11/How-To-Learn-A-Language-In-A-Record-Time.pdf";
			}		  
			echo '<div class="editprofile rightcommon"><div class="leftside"><a href="'.$ebook_pdf.'" class="rtitle" target="_blank" rel="noopener noreferrer">Download an ebook</div></div>';
		 } 		
		echo '<div class="loveservice">
			<h5 class="my-0 ltitle">Love our service?</h5>
			<h6 class="my-0 pt-2 secondtitle">Let us know on Trustpilot!</h6>
			<p class="my-0 serdesc">We value your opinion! Tell us about your experience</p>
			<a href="https://www.trustpilot.com/review/lonet.academy" target="_blank" class="btn interested">Leave a review</a>
		</div>';
		
		echo '<div class="loveservice referafriend">
			<h5 class="my-0 ltitle">Invite a friend and get €10</h5>
			<p class="my-0 serdesc">If you enjoy using Lonet.Academy, share it with friends.</p>
			<a href="/local/lonet/invite.php" class="btn interested">Invite now</a>
		</div>';	
		echo '<div class="loveservice followus">
			<h5 class="my-0 ltitle">Follow us on social media</h5>
			<p class="my-0 serdesc">Follow us for exclusive deals, daily inspiration, and learning hacks.</p>
			<div style="display: flex;gap: 16px;align-items: center;">
			<a href="https://www.facebook.com/lonet.academy" target="_blank">'.get_string('fbicon','local_lonet').'</a>
			<a href="https://www.instagram.com/lonet.academy/" target="_blank">'.get_string('instaicon','local_lonet').'</a>
			<a href="https://www.linkedin.com/company/lonet/" target="_blank">'.get_string('linkedinicon','local_lonet').'</a>
			<a href="https://www.youtube.com/@lonetacademy5349" target="_blank">'.get_string('youtubeicon','local_lonet').'</a>
			</div>
		</div>';
		echo '</div>';//rightsidecontent
	}
	echo '</div>';
}else{							
	echo '<div class="loginrightsidecontent" style="display: flex; width: 384px;flex-direction: column;align-items: center;gap:32px;">';
	echo '<div class="userbal rightcommon">
		<div class="leftside">
			<h6 class="my-0 rtitle">Balance</h6>
			<h6 class="mt-3 mb-0 amount">&euro; '.number_format(user::get_balance($user->id), 2).'</h6>
			<h6 class="my-0 availbal">&euro; '.number_format(user::get_available_balance($user->id), 2).' '.get_string('available', 'local_lonet').'</h6>
		</div>
		<div class="rightside">'.get_string('balanceicon','local_lonet').'</div>
	</div>';

	echo '<div class="transaction rightcommon"><div class="leftside"><a href="'.$CFG->wwwroot.'/local/lonet/wallet.php?id='.$user->id.'" class="rtitle">Transaction history</a></div><div class="rightside">'.get_string('transactionicon','local_lonet').'</div></div>';
	
	if ($show_teacher) {
		if (teacher::can_request_payout($user)) {
			echo '<div class="transaction rightcommon"><div class="leftside"><a href="'.$CFG->wwwroot.'/local/lonet/payout.php?id='.$user->id.'" class="rtitle">'.get_string("requestpayout", "local_lonet").'</a></div><div class="rightside amount">&euro; '.number_format(user::get_available_balance($user->id), 2).'</div></div>';
		} elseif ($pending_amount = teacher::get_pending_payout_request_amount($user->id)) {
			echo '<div class="transaction rightcommon"><div class="leftside"><a href="'.$CFG->wwwroot.'/local/lonet/wallet.php?id='.$user->id.'" class="rtitle">Pending Payout Request</a></div><div class="rightside amount">&euro; '.$pending_amount.'</div></div>';
		}
	}
	if ($is_teacher) {
		if ($can_edit) {
			echo '<div class="editlessons rightcommon"><div class="leftside"><a href="'.$CFG->wwwroot.'/local/lonet/lessons.php?teacherid='.$user->id.'" class="rtitle">Edit lessons</a></div><div class="rightside">'.get_string('editlessonicon','local_lonet').'</div></div>';
			
			echo '<div class="editschedule rightcommon"><div class="leftside"><a href="'.$CFG->wwwroot.'/local/lonet/edit.php?teacherid='.$user->id.'" class="rtitle">Edit schedule</a></div><div class="rightside">'.get_string('scheduleicon','local_lonet').'</div></div>';	
		}
	}
	echo '<div class="lessonhistory rightcommon"><div class="leftside"><a href="'.$CFG->wwwroot.'/local/lonet/history.php?id='.$user->id.'" class="rtitle">Lesson history</a></div><div class="rightside">'.get_string('lessonhistoryicon','local_lonet').'</div></div>';	
	
	if ($is_self) {
		echo '<div class="editprofile rightcommon"><div class="leftside"><a href="'.$CFG->wwwroot.'/user/editadvanced.php?&id='.$user->id.'" class="rtitle">Edit profile</a></div><div class="rightside">'.get_string('editprofileicon','local_lonet').'</div></div>';
		echo '<div class="changepass rightcommon"><div class="leftside"><a href="'.$CFG->wwwroot.'/login/change_password.php" class="rtitle">Change password</a></div><div class="rightside">'.get_string('changepassicon','local_lonet').'</div></div>';
	}else{
		echo '<div class="editprofile rightcommon"><div class="leftside"><a href="/user/'.$user->id.'/edit" class="rtitle" target="_blank" rel="noopener noreferrer">Edit profile</a></div><div class="rightside">'.get_string('editprofileicon','local_lonet').'</div></div>';
	}
	if ($is_self) {
		$can_delete = user::can_delete_account($id);
		echo '<div class="deleteprofile rightcommon"><div class="leftside"><a href="javascript:void(0);" class="rtitle btn-delete-account" '.($can_delete ? '' : 'disabled').' data-toggle="tooltip" title="'.($can_delete ? "" : get_string("youcannotdeleteaccount", "local_lonet")).'">Delete profile</a></div><div class="rightside">'.get_string('bigtrashicon','local_lonet').'</div></div>';
	}
	if(is_siteadmin()) {
		echo '<div class="loginas rightcommon"><div class="leftside"><a href="/course/loginas.php?user='.$user->id.'&sesskey='.$USER->sesskey.'" class="rtitle">Log in As</a></div><div class="rightside hidden">'.get_string('editprofileicon','local_lonet').'</div></div>';		
		echo '<div class="userlogs rightcommon"><div class="leftside"><a href="/report/log/user.php?id='.$user->id.'&course=1&mode=all" class="rtitle">User Logs</a></div><div class="rightside hidden">'.get_string('editprofileicon','local_lonet').'</div></div>';	
	}
	if (!$show_teacher) {
		if ($language_book == 'lv') {
			$cover_url = "/local/lonet/pix/gramata_LV.png";
			$ebook_pdf = "/blog/wp-content/uploads/2021/11/eBook-LV-single-page.pdf";
		}else{
			$cover_url = "/local/lonet/pix/gramata_ENG.png";
			$ebook_pdf = "/blog/wp-content/uploads/2021/11/How-To-Learn-A-Language-In-A-Record-Time.pdf";
		}		  
		echo '<div class="editprofile rightcommon"><div class="leftside"><a href="'.$ebook_pdf.'" class="rtitle" target="_blank" rel="noopener noreferrer">Download an ebook</div></div>';
	 } 
	
	echo '<div class="loveservice">
		<h5 class="my-0 ltitle">Love our service?</h5>
		<h6 class="my-0 pt-2 secondtitle">Let us know on Trustpilot!</h6>
		<p class="my-0 serdesc">We value your opinion! Tell us about your experience</p>
		<a href="https://www.trustpilot.com/review/lonet.academy" target="_blank" class="btn interested">Leave a review</a>
	</div>';
	
	echo '<div class="loveservice referafriend">
		<h5 class="my-0 ltitle">Invite a friend and get €10</h5>
		<p class="my-0 serdesc">If you enjoy using Lonet.Academy, share it with friends.</p>
		<a href="/local/lonet/invite.php" class="btn interested">Invite now</a>
	</div>';	
	echo '<div class="loveservice followus">
		<h5 class="my-0 ltitle">Follow us on social media</h5>
		<p class="my-0 serdesc">Follow us for exclusive deals, daily inspiration, and learning hacks.</p>
		<div style="display: flex;gap: 16px;align-items: center;">
		<a href="https://www.facebook.com/lonet.academy" target="_blank">'.get_string('fbicon','local_lonet').'</a>
		<a href="https://www.instagram.com/lonet.academy/" target="_blank">'.get_string('instaicon','local_lonet').'</a>
		<a href="https://www.linkedin.com/company/lonet/" target="_blank">'.get_string('linkedinicon','local_lonet').'</a>
		<a href="https://www.youtube.com/@lonetacademy5349" target="_blank">'.get_string('youtubeicon','local_lonet').'</a>
		</div>
	</div>';
	echo '</div>';//rightsidecontent	
}

?>




</div><!-----profilemaincontentarea-->



<!------------------------------------------faq container--------------------------------------->
<div class="faqcontainer" style="padding: 64px 320px;">
<div class="faqbox">
<h4 class="my-0"><?= get_string('faq','local_lonet') ?></h4>
<div class="custom_accordion-body">
	<div class="custom_accordion">
	<?php if($USER->profile['role'] == 'Learner' || !isloggedin()){  ?>
		<div class="acontainer" id="acontainer_1">
		  <div class="label">Can I book only 1 lesson or do I have to buy a package of lessons?</div>
		  <div class="content" style="display:none;">
		  <p class="my-0">
				You can book only 1 lesson. We provide you with freedom of choice. We respect your budget planning and strive for freedom and flexibility, as some of our main values.
				</br>
				</br>
				However, if you want to book more lessons and plan your schedule for some period in advance, you can book a set of them (as many as you feel confident). 
				</br>
				</br>
				Also, to support your motivation and discipline in language learning, we offer several special deals that allow you to put a specific amount of money in your online wallet and get more while booking your lessons later. You can do it with your next booking of a lesson:		  
		  </p>
		  </div>
		</div>
		<div class="acontainer" id="acontainer_2">
		  <div class="label">If a tutor cancels a lesson, do I get my money back?</div>
		  <div class="content" style="display:none;">
		  <p  class="my-0">If a tutor cancels a lesson that has been confirmed before, you get the total amount paid for this lesson back to your online wallet balance. You can use this balance to book the next lessons on lonet.</p>
			</div>
		</div>
		<div class="acontainer" id="acontainer_3">
		  <div class="label">How do I know if I need a language tutor, coach or trainer?</div>
		  <div class="content" style="display:none;">
		  <p  class="my-0">
			To provide a short answer to this question, we would say as follows:
			Go to a tutor if: you want to study the language. You will learn grammar rules, and practice reading, writing, and listening skills. If you are a beginner or an elementary-level learner, choose a tutor. With a tutor, you will work on and improve your language skills.
			</br>
			</br>
			Go to a trainer if: you want to develop your speaking skills mainly. Choose a native trainer to train your accent, speaking skills, and conversational vocabulary, get cultural insights, and have nice targeted conversations in the language with a native speaker-trainer.
			</br>
			</br>
			Go to a language coach if: you are at the intermediate and upper-intermediate level of the language and want to develop your specific language skills. If you want to become a confident language speaker, fluent in a specific area, in a language for specific purposes, and break all the barriers you have in your language learning, choose a language coach. 
		  </p>
			</div>
		</div>
		<div class="acontainer" id="acontainer_4" style="display:none;">
		  <div class="label">I am not good at languages, I don’t have time, I am too old to learn a language. How can Lonet help me?</div>
		  <div class="content" style="display:none;">
		  <p class="my-0">
				<a href="https://lonet.academy/language-tutor-consultation" target="_blank">Book a free consultation session with Kristine</a> and tell her about your concerns. She is a creator of Lonet.Academy, a language learning expert, a polyglot, and a performance coach. She is happy to provide valuable advice and insights, according to your unique needs and personal situation.		  
		  </p>
		  </div>
		</div>
		<div class="acontainer" id="acontainer_5" style="display:none;">
		  <div class="label">I booked my lessons with a tutor, but now I want to change the tutor. How can I do it?</div>
		  <div class="content" style="display:none;">
		  <p  class="my-0">
				In the case if you booked the lessons and the tutor has already confirmed them, you can cancel your lessons (by going to your pending lessons and pressing the button “cancel”), but in this case, you will get your money back to your balance (online wallet) with a deduction of 5 eur per each lesson canceled. You can still use the remaining balance to book your lessons with another tutor. </br></br>
				To avoid this we recommend buying special deals with us, that provide you with a specific amount of money in your online wallet (with a more than paid value) and you can use this balance later when you are confident to book.				
		  </p>
		</div>
		</div>
<?php } else{ ?>
<div class="acontainer" id="acontainer_1">
		  <div class="label">Can I cancel a lesson?</div>
		  <div class="content" style="display:none;">
		  <p class="my-0">
			Yes, you can cancel a lesson, even if you have confirmed it before. Please note that in this case, Lonet’s commission of 5 EUR will be deducted (charged) from your balance. To avoid the learner's frustration, we recommend you send a message to the learner, informing them about the reasons, and apologizing for the cancellation.
			</br>
			</br>
			When an educator cancels a lesson, the learner receives the full amount back on their balance, which they can use again for the new booking. 	  
		  </p>
		  </div>
		</div>
		<div class="acontainer" id="acontainer_2">
		  <div class="label">When do I get paid?</div>
		  <div class="content" style="display:none;">
		  <p  class="my-0">Please proceed with your payout request every month. Educators get paid once a month. 
			Please note that the minimum payout amount should not be less than EUR 50. For more details please read the Terms And Conditions.
			</p>
			</div>
		</div>
		<div class="acontainer" id="acontainer_3">
		  <div class="label">How can I request the payout?</div>
		  <div class="content" style="display:none;">
		  <p  class="my-0">
				When you have a balance available in your wallet and it is more than EUR 50, please press the button “REQUEST PAYOUT” and provide your payment details and instructions.
				The payments are being made by a bank transfer or by PayPal. 
				For more details, please read the Terms And Conditions. 
		  </p>
			</div>
		</div>
		<div class="acontainer" id="acontainer_4" style="display:none;">
		  <div class="label">Why I cannot request for payout some of my lessons?</div>
		  <div class="content" style="display:none;">
		  <p class="my-0">
				This may happen with the lessons that are expired. According to the Terms and Conditions, the amounts for the lessons that are older than 180 days (6 months) expire. The amounts for the lessons with the status “expired” are not paid out. Please request your balance for payout timely (accordingly). 
		  </p>
		  </div>
		</div>
<?php }?>
	</div>
	<div style="width: 100%;text-align: center; margin-top: 32px;"><button id="loadMoreBtn" onclick="loadMore()">Load More</button></div>
</div>
</div>
</div>
</div> <!----main profilepage div-->
<!---------------------------------------------------------------------------New profile design---------------------------------------------------------->
<div id="schedule-modal" class="modal" tabindex="-1" role="dialog" data-keyboard="true">
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
<div id="learnearn-modal" class="modal" tabindex="-1" role="dialog" data-keyboard="true">
    <div class="modal-dialog " role="document" style="width:1172px;">
        <div class="modal-content" style="padding:64px;">
            <div class="modal-header hidden">
				<h5 class="modal-title">Book with Confidence!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M5 15L15 5M5 5L15 15" stroke="#1F2937" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></button>
            </div>
            <div class="modal-body px-0 py-0">
				<div class="modallogo text-center" style="margin-bottom:32px;"><img src="<?= $CFG->wwwroot ?>/theme/lonet/pix/lonetlogo_black.png"/></div>
				<h5 class="my-0 congtitle" style="color: #000; text-align: center;font-size: 24px;font-weight: 700;padding-bottom:0px;">Congratulations! You're Earning as You Learn!</h5>
				<p class="my-0 text-center hidden">Your language learning journey is paying off – literally!</p>
				<p class="my-0 text-center hidden">We're thrilled to celebrate your progress with our exclusive milestone rewards program.</p>
				<h5 class="hidden" style="margin-top:24px;margin-bottom:64px;color: #170F83;text-align: center;font-size: 24px;font-weight: 700;">Here's how it works:</h5>
				<div class="firstrow" style="width: 100%;display: flex;gap: 32px;justify-content: center;margin-top: 32px;margin-bottom: 32px;">
					<a href="#">
						<div class="gooddeal">
							<h6 class="my-0">Milestone 1: 50 lessons</h6>
							<p class="my-0">Complete <span>50 lessons</span> and get <span>€10</span> added to your account balance.</p>
							<div class="dealprice">
								<h4 class="my-0 fprice">€10</h4>
							</div>
						</div>
					</a>
					<a href="#">
						<div class="gooddeal">
							<h6 class="my-0">Milestone 2: 100 lessons</h6>
							<p class="my-0">Reach <span>100 lessons</span> and earn an extra <span>€25</span> added to your account balance.</p>
							<div class="dealprice">
								<h4 class="my-0 fprice">€25</h4>
							</div>
						</div>
					</a>
				</div>
				<div class="secondrow" style="width: 100%;display: flex;gap: 32px;justify-content: center;margin-top: 32px;margin-bottom: 32px;">
					<a href="#">
						<div class="gooddeal">
							<h6 class="my-0">Milestone 3: 130 lessons</h6>
							<p class="my-0">Hit <span>130 lessons</span> and receive another <span>€10</span>.</p>
							<div class="dealprice">
								<h4 class="my-0 fprice">€10</h4>
							</div>
						</div>
					</a>
					<a href="#">
						<div class="gooddeal">
							<h6 class="my-0">Milestone 4: 180 lessons</h6>
							<p class="my-0">Conquer <span>180 lessons</span> and enjoy another bonus of </span>€25</span>.</p>
							<div class="dealprice">
								<h4 class="my-0 fprice">€25</h4>
							</div>
						</div>
					</a>					
				</div>
				<p style="width:749px;color: #111827;text-align:center;margin:0 auto;font-size: 18px;font-weight: 400;">Thank you for choosing us.Keep practicing, keep achieving, and keep earning!</p>
				<div class="text-center" style="margin-top:32px;"><a href="javascript:void(0);" class="btn interested imhappy">I am happy!</a></div>
            </div>
        </div>
    </div>
</div>
<?php } ?>
