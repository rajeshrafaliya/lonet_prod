<?php
use local_lonet\user;
use local_lonet\subscriber;
require_once('../../config.php');
require_once($CFG->dirroot.'/local/lonet/lib.php');
global $SESSION,$USER,$PAGE;
$PAGE->set_context(context_system::instance());
$PAGE->set_pagelayout('list');
$title = 'Free Consultation';
$PAGE->set_title($title);
$PAGE->set_heading($title);
$PAGE->set_url($PAGE->url);
$PAGE->requires->css('/local/lonet/style.css?ver=1.9');
$has_applied = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['Subscriber'])) {
        $recaptcha_secret = $CFG->recaptchaprivatekey;
        $recaptcha_response = $_POST['g-recaptcha-response'];

        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$recaptcha_secret&response=$recaptcha_response");
        $responseKeys = json_decode($response, true);
        if(intval($responseKeys["success"]) !== 1) {
			redirect($PAGE->url, 'Security check failed.Please try again.', 5, \core\output\notification::NOTIFY_ERROR);
		}else{
			$attributes = $_POST['Subscriber'];
			$attributes['referrer'] = $_SERVER['HTTP_REFERER'];
			$attributes['createdat'] = time();
			if ($DB->insert_record('lonet_subscriber', $attributes)) {
				user::addUserToMailingList(null, ['email' => $attributes['email'], 'name' => $attributes['name']]);
				subscriber::sendAdminEmail((object) $attributes);
				$has_applied = true;
			}
		}
}
echo $OUTPUT->header();
//top section

if ($has_applied) { ?>
    <script>
        $(document).ready(function() {
            $('.select-timezone').click(function(e) {
                if ($('#id_timezone').val()) {
                    $('.container-timezone').slideUp();
					$('#calendar-timezone').css("margin-top", "64px");
					$('#calendar-timezone').css("margin-bottom", "24px");
					$('#calendar').css("margin-bottom", "64px");
					$('.gm-style-iw').children().css('max-width', "250px !important");
                    $('#calendar-timezone').html("<strong><?= get_string('yourtimezone', 'local_lonet') ?>: </strong><span>" + $('#id_timezone').val()+'</span>');
                    caleandar(document.getElementById('calendar'));
                }
            });
			$(document).on('click', '.cld-day.currMonth:not(.disableDay)', function(e) {
				swal({
					title: "<?= get_string('fullybooked', 'local_lonet') ?>",
					text: "<?= get_string('willcontact', 'local_lonet') ?>",
					icon: '<?= $CFG->wwwroot ?>/theme/lonet/pix/swal-circle.png'
				}).then((result) => {
					if (result) {
						window.location.href = '<?= $CFG->wwwroot ?>/language-teachers';
					}
				});
			});

        });
    </script>
    <div class="consultsubmit text-center" style="padding: 32px 112px;">
        <h3 class="my-0"><?= get_string('thankyouforapplication', 'local_lonet') ?></h3>
        <p class="my-0"><?= get_string('schedulesession', 'local_lonet') ?></p>
    </div>
    <div class="container-timezone">
	<div class="container-timezone-drop">
		<?php 
			$timezones = core_date::get_list_of_timezones();
			echo '<label for="id_timezone" class="form-label">Timezone</label>';
			echo  '<select name="timezone" id="id_timezone">';
			echo '<option value="">Choose your timezone</option>';
			foreach ($timezones as $key => $value) {
				echo  '<option value="'.$key.'">'.$value.'</option>';
			}
			echo '</select>';
		?>
    </div>
        <button class="btn btn-info select-timezone"><?= get_string('continue', 'core_moodle') ?></button>
    </div>
    <div id="calendar-timezone" style="width:400px;margin:auto;"></div>
    <div id="calendar"></div>
<?php 
}else{
$ip_address = $_SERVER['HTTP_CLIENT_IP'] ?? $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'] ?? '';
?>
<div class="facultysection1">
<h3 class="my-0"><?= get_string('choosebesttutor','local_lonet') ?></h3>
<p class="my-0 para1"><?= get_string('checkfaq','local_lonet') ?></p>
<p class="my-0 para2"><?= get_string('talkkristine','local_lonet') ?></p>
</div>

<div class="videosection">
<iframe width="857" height="517" src="https://www.youtube.com/embed/mKop0SXPtK8?si=drE4usO7yfOOP1Co" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
</div>
<?php $checksvg = '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25" fill="none">
<path d="M9.58333 13L11.5278 14.9444L15.4167 11.0556M21.25 13C21.25 17.8325 17.3325 21.75 12.5 21.75C7.66751 21.75 3.75 17.8325 3.75 13C3.75 8.16751 7.66751 4.25 12.5 4.25C17.3325 4.25 21.25 8.16751 21.25 13Z" stroke="#CE1369" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
</svg>'; ?>
<div class="applyconsult">
	<h5 class="my-0"><?= get_string('applyfreeconsult','local_lonet') ?></h5>
	<div class="consulttopic">
		<h5 class="my-0 second"><?= get_string('whatget','local_lonet') ?></h5>
		<div class="consulttopic1">
			<div class=""><?= $checksvg ?></div>
			<div class="desc">
			<h6 class="my-0 labe">Personalized Answers</h6>
			<p class="my-0">Should I choose a language tutor or a coach in my personal case?  Why?</p>
			</div>
		</div>
		<div class="consulttopic2">
			<div class=""><?= $checksvg ?></div>
			<div class="desc">
			<h6 class="my-0 labe">Experience online learning</h6>
			<p class="my-0">Is a native tutor better for me or someone who speaks my language?</p>
			</div>
		</div>
		<div class="consulttopic3">
			<div class=""><?= $checksvg ?></div>
			<div class="desc">
			<h6 class="my-0 labe">Understand Lonet Academy</h6>
			<p class="my-0">I have a special case and I want to talk to an expert before I'll book my first lesson.</p>
			</div>
		</div>
		<div class="consulttopic4">
			<div class=""><?= $checksvg ?></div>
			<div class="desc">
			<h6 class="my-0 labe">Expert tutor matching</h6>
			<p class="my-0">I like one tutor on the website, but I am not sure if they would be a good match for me. Can you tell me please?</p>
			</div>
		</div>
	</div>
	
	<div class="submitinfo" style="margin-top:32px;">
	<h6 class="my-0">Please submit your information:</h6>
	<form class="consultform mform" method='POST' id="form-apply">
	<div class="namediv">
		<label for="InputName" class="form-label">Name</label>
		<p class="nameerror my-1" style="display:none;"></p>
		<div class="input-group">
		<input type="text" class="form-control" id="InputName" name="Subscriber[name]" maxlength="255" autocomplete="off" placeholder="Fill in your name" required>
		</div>
	</div>	
	<div class="emaildiv">
		<label for="InputName" class="form-label">Email</label>
		<p class="emailerror my-1" style="display:none;"></p>
		<div class="input-group">
		<input type="email" class="form-control" id="Inputemail" name="Subscriber[email]" maxlength="255" autocomplete="off" placeholder="Fill in your email address" required>
		</div>
	</div>
	<div class="langdiv">
		<label for="InputLang" class="form-label">Language you want to learn</label>
		<p class="langerror my-1" style="display:none;"></p>
		<div class="input-group">
		<input type="text" class="form-control" id="Inputlang" name="Subscriber[comment]" maxlength="255" autocomplete="off" required>
		</div>
	</div>
	<div class="phonediv">
		<label for="phone" class="form-label">Phone Number</label>
		<p class="phoneerror my-1" style="display:none;"></p>
		<div class="input-group">
		<input type="tel" name="Subscriber[phone_number]" class="form-control" id="phone" maxlength="255" autocomplete="off" value="" required>
		</div>
		<div id="phone-helper" style="display: none; color: red;">Please enter a phone number in an international format (e.g. +37122334455)</div>
	</div>
<div class="form-check privacycheck">
	<input type="checkbox" class="form-check-input" id="PrivacyCheck" required>
	<label class="form-check-label" for="PrivacyCheck">I understand and agree with the <a href="/terms-and-conditions" target="_blank">Terms and Conditions</a> and <a href="/privacy-policy" target="_blank">Privacy Policy</a></label><span class="required">&nbsp;*</span>
</div>	
<div class="g-recaptcha" data-sitekey="<?=$CFG->recaptchapublickey?>"></div>
<div style="display: flex;justify-content: center;margin-bottom: 32px;"><button type="submit" value=1>Submit</button></div>
	</form>
	</div>
	
<!------------------------------------------faq container--------------------------------------->
<div class="faqcontainer" style="padding: 64px 320px;">
<div class="faqbox">
<h4 class="my-0"><?= get_string('faq','local_lonet') ?></h4>
<div class="custom_accordion-body">
	<div class="custom_accordion">
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
	</div>
	<div style="width: 100%;text-align: center; margin-top: 32px;"><button id="loadMoreBtn" onclick="loadMore()">Load More</button></div>
</div>
</div>
</div>
</div>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script>
	validateForm = function() {
		return $('#phone-helper').is(':visible') ? false : true;
	};
	$(document).ready(function() {
		$('#phone').blur(function(e) {
			var regex = /^(\+{1}[0-9]{9,20}){1}$/;
			console.log(regex.test($(this).val()));
			if (!regex.test($(this).val())) {
				$('#phone-helper').fadeIn();
			} else {
				$('#phone-helper').fadeOut();
			}
		});
		<?php if ($ip_address) { ?>
		$.get('https://ipapi.co/<?= $ip_address ?>/country_calling_code', '', function(result) {
			if (result.length > 1) {
				$('#phone').val(result);
			}
		});
		<?php } ?>            
	});
</script>
<script>
/* $(document).on('click', '.acontainer .label', function(e) {
if($(this).closest(".acontainer").hasClass("active")) {
  $(this).closest(".acontainer").find(".content").slideUp('slow');
		  $(this).closest(".acontainer").removeClass("active");
	$(this).closest(".content").removeClass("active");
}else{
$(".acontainer").removeClass("active");
  $(".acontainer").find(".content").slideUp('slow');
	$(this).closest(".acontainer").addClass("active");
	$(this).closest(".acontainer").find(".content").slideDown('slow');
	$(".acontainer").find(".content").show();
}
});

function loadMore() {
    var hiddenItems = document.querySelectorAll('.acontainer[style*="display:none"]');
    for (var i = 0; i < hiddenItems.length; i++) {
        hiddenItems[i].style.display = 'block';
    }
    document.getElementById('loadMoreBtn').style.display = 'none';
} */
</script>
<?php } ?>
<div class="suboverrideimg contactsuboverride" style="margin-top:-140px;width:auto;right:0;">
<img src="<?= $CFG->wwwroot ?>/theme/lonet/pix/suboverride.png">
</div>
<?php
subscribe_newsletter();
echo $OUTPUT->footer();


