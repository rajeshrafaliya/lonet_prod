<?php
require_once('../../config.php');
require_once($CFG->dirroot.'/local/lonet/lib.php');
global $SESSION,$USER,$PAGE;
$PAGE->set_context(context_system::instance());
$PAGE->set_pagelayout('list');
$title = 'The Best Platform For Language Tutors and Language Coaches';
$PAGE->set_title($title);
$PAGE->set_heading($title);
$PAGE->set_url($PAGE->url);
$PAGE->requires->css('/local/lonet/style.css?ver=1.9');
$PAGE->requires->css('/theme/lonet/style/slick-theme.css');
$PAGE->requires->css('/theme/lonet/style/slick.css');
echo $OUTPUT->header();
//top section
?>
<div class="tutorsection1">
<h1 class="my-0"><?= get_string('platformforlang','local_lonet') ?></h1>
<p class="my-0"><?= get_string('platformforlangdesc','local_lonet') ?></p>
<a href="/login/signup.php" class="tutorapply"><?= get_string('platformforlangapply','local_lonet') ?></a>
</div>

<!--------------Benifits --------------------->
<div class="tutorsection2">
<h3 class="my-0"><?= get_string('benifitofpart','local_lonet') ?></h3>
<div class="heartboxes">
	<div class="box">
	<img src="<?= $CFG->wwwroot ?>/theme/lonet/pix/heart.png" />
	<h6 class="my-0"><?= get_string('maximizeearn','local_lonet') ?></h6>
	<p class="my-0"><?= get_string('maximizeearndesc','local_lonet') ?></p>
	</div>
	<div class="box">
	<img src="<?= $CFG->wwwroot ?>/theme/lonet/pix/heart.png" />
	<h6 class="my-0"><?= get_string('focuson','local_lonet') ?></h6>
	<p class="my-0"><?= get_string('focusondesc','local_lonet') ?></p>
	</div>
	<div class="box">
	<img src="<?= $CFG->wwwroot ?>/theme/lonet/pix/heart.png" />
	<h6 class="my-0"><?= get_string('buildbrand','local_lonet') ?></h6>
	<p class="my-0"><?= get_string('buildbranddesc','local_lonet') ?></p>
	</div>
	<div class="box">
	<img src="<?= $CFG->wwwroot ?>/theme/lonet/pix/heart.png" />
	<h6 class="my-0"><?= get_string('growprof','local_lonet') ?></h6>
	<p class="my-0"><?= get_string('growprofdesc','local_lonet') ?></p>
	</div>
	<div class="box">
	<img src="<?= $CFG->wwwroot ?>/theme/lonet/pix/heart.png" />
	<h6 class="my-0"><?= get_string('enjoypay','local_lonet') ?></h6>
	<p class="my-0"><?= get_string('enjoypaydesc','local_lonet') ?></p>
	</div>
	<div class="box">
	<img src="<?= $CFG->wwwroot ?>/theme/lonet/pix/heart.png" />
	<h6 class="my-0"><?= get_string('growwithus','local_lonet') ?></h6>
	<p class="my-0"><?= get_string('growwithusdesc','local_lonet') ?></p>
	</div>
</div>
</div>
<!-------------Joins-------------------------->
<div class="tutorsection3">
<h3 class="my-0"><?= get_string('joinlonet','local_lonet') ?></h3>
<div class="joinboxes">
	<div class="joinbox">
		<h3 class="my-0"><?= get_string('langcoach','local_lonet') ?></h3>
		<p class="my-0"><?= get_string('ifyou','local_lonet') ?></p>
		<ul>
		<li><?= get_string('arecoach','local_lonet') ?></li>
		<li class="addpadding"><?= get_string('holdquali','local_lonet') ?></li>
		<li><?= get_string('positivepsyco','local_lonet') ?></li>
		</ul>
	</div>
	<div class="joinbox">
		<h3 class="my-0"><?= get_string('langtutor','local_lonet') ?></h3>
		<p class="my-0"><?= get_string('ifyou','local_lonet') ?></p>
		<ul>
		<li><?= get_string('holdteaching','local_lonet') ?></li>
		<li class="addpadding"><?= get_string('areteacher','local_lonet') ?></li>
		<li><?= get_string('holddegree','local_lonet') ?></li>
		</ul>
	</div>
	<div class="joinbox">
		<h3 class="my-0"><?= get_string('langtrainer','local_lonet') ?></h3>
		<p class="my-0"><?= get_string('ifyou','local_lonet') ?></p>
		<ul>
		<li><?= get_string('arespeaker','local_lonet') ?></li>
		<li class="addpadding"><?= get_string('havetutexp','local_lonet') ?></li>
		<li><?= get_string('passionaboutlang','local_lonet') ?></li>
		</ul>
	</div>
</div>
<a href="/login/signup.php" class="tutorapply"><?= get_string('wanttoapply','local_lonet') ?></a>
</div>
<!------------how work--------------->
<div class="tutorsection4">
<h3 class="my-0"><?= get_string('lonetforedu','local_lonet') ?></h3>
<p class="my-0 toppara"><?= get_string('lonetforedudesc','local_lonet') ?></p>
<div class="howboxes">
	<div class="leftbox">
	<div class="applylonet current tablink" data-target="applylonet_toggle">
		<h6 class="my-0"><?= get_string('applyanedu','local_lonet') ?></h6>
		<?= get_string('educapsvg','local_lonet') ?>
	</div>
	<div class="applicationbox tablink" data-target="application_toggle">
		<h6 class="my-0"><?= get_string('completeappli','local_lonet') ?></h6>
		<?= get_string('checkcirclesvg','local_lonet') ?>
	</div>
	<div class="setprofilebox tablink" data-target="setprofile_toggle">
		<h6 class="my-0"><?= get_string('setprofile','local_lonet') ?></h6>
		<?= get_string('profilesvg','local_lonet') ?>
	</div>
	</div>
	<div class="rightbox">
		<!-- apply as an educator -->
		<div class="applylonet_toggle tabtarget">
			<p class="chooserole"><?= get_string('chooserole','local_lonet') ?></p>
			<p class="freeaccount"><?= get_string('freeaccount','local_lonet') ?></p>
			<ul>
			<li><p class="my-0"><span><?= get_string('langtutor','local_lonet') ?>:</span> <?= get_string('langtutormsg','local_lonet') ?></p></li>	
			<li style="padding-top:32px;padding-bottom:32px;"><p class="my-0"><span><?= get_string('langcoach','local_lonet') ?>:</span> <?= get_string('langcoachmsg','local_lonet') ?></p></li>	
			<li><p class="my-0"><span><?= get_string('langtrainer','local_lonet') ?>:</span> <?= get_string('langtrainermsg','local_lonet') ?></p></li>
			</ul>
		</div>
		<!----Complete your application -->
		<div class="application_toggle tabtarget hidden">
		<p class="chooserole"><?= get_string('completeappli','local_lonet') ?></p>
		<ul>
		<li><p class="my-0"><span><?= get_string('showcaseexp','local_lonet') ?></span> <?= get_string('showcaseexpdesc','local_lonet') ?></p></li>	
		<div class="expertiselist">
			<ul>
			<li><p class="my-0"><span><?= get_string('education','local_lonet') ?></span> <?= get_string('educationdesc','local_lonet') ?></p></li>	
			<li><p class="my-0" style="padding-top:20px;padding-bottom:20px;"><span><?= get_string('experience','local_lonet') ?></span> <?= get_string('experiencedesc','local_lonet') ?></p></li>
			<li><p class="my-0"><span><?= get_string('yourapproch','local_lonet') ?></span> <?= get_string('yourapprochdesc','local_lonet') ?></p></li>
			</ul>
		</div>
		<li><p class="my-0"><span><?= get_string('scheduleinter','local_lonet') ?>:</span> <?= get_string('scheduleinterdesc','local_lonet') ?></p></li>
		</ul>
		</div>
		<!---set your profile--->
		<div class="setprofile_toggle tabtarget hidden">
			<ul style="padding-top:16px;">
			<li><p class="my-0"><span><?= get_string('setrates','local_lonet') ?></span> <?= get_string('setratesdesc','local_lonet') ?></p></li>	
			<li style="padding-top:32px;padding-bottom:32px;"><p class="my-0"><span><?= get_string('setavail','local_lonet') ?></span> <?= get_string('setavaildesc','local_lonet') ?></p></li>
			<li><p class="my-0"><span><?= get_string('managecal','local_lonet') ?></span> <?= get_string('managecaldesc','local_lonet') ?></p></li>
			</ul>
			<p class="freeaccount"><?= get_string('youallset','local_lonet') ?></p>
		</div>
	</div>
</div>
</div>
<!------------------A thriving community for educators and learners at Lonet-->
<div class="tutorsection5" style="padding: 64px 112px;">
	<div class="tutorsection51">
		<div class="leftbox">
			<h3 class="my-0"><?= get_string('thrivcommunity','local_lonet') ?></h3>
			<p class="my-0"><?= get_string('thrivcommunitydesc','local_lonet') ?></p>
		</div>
		<div class="rightbox">
			<img src="<?= $CFG->wwwroot ?>/theme/lonet/pix/fortutor.png">
		</div>
	</div>
	<div class="suboverrideimg hidden" style="margin-top:-275px;">
	<img src="<?= $CFG->wwwroot ?>/theme/lonet/pix/fortutor_loading.png">
	</div>
	<div class="tutorsection52">
		<div class="heartboxes">
			<div class="box">
			<img src="<?= $CFG->wwwroot ?>/theme/lonet/pix/heart.png" />
			<h6 class="my-0"><?= get_string('maximizeearn','local_lonet') ?></h6>
			<p class="my-0"><?= get_string('maximizeearn2desc','local_lonet') ?></p>
			</div>
			<div class="box">
			<img src="<?= $CFG->wwwroot ?>/theme/lonet/pix/heart.png" />
			<h6 class="my-0"><?= get_string('focuson','local_lonet') ?></h6>
			<p class="my-0"><?= get_string('focuson2desc','local_lonet') ?></p>
			</div>
			<div class="box">
			<img src="<?= $CFG->wwwroot ?>/theme/lonet/pix/heart.png" />
			<h6 class="my-0"><?= get_string('growbrand','local_lonet') ?></h6>
			<p class="my-0"><?= get_string('growbranddesc','local_lonet') ?></p>
			</div>
		</div>
	</div>
</div>
<!-------------------Hear from our happy teachers----->
<!-- <div class="tutorsection6" style="padding: 64px 112px;">
<h3 class="my-0"><?= get_string('hearfrom','local_lonet') ?></h3>
<p class="my-0 toppara6"><?= get_string('hearfromdesc','local_lonet') ?></p>
</div> -->
<div class="tutorsection7" style="padding: 64px 112px;background:#F9FAFB;">


	<div class="trustpilot_container" style="padding:64px 0px;">
	<h3><?= get_string('teachersaboutus','local_lonet') ?></h3>
    <div class="reviewcards">
		<div class="review-card">
			<div class="review-header">
				<div class="stars"><img src="<?= $CFG->wwwroot ?>/theme/lonet/pix/trustpilot/5stars.svg"></div>
				<div class="verified"><img src="<?= $CFG->wwwroot ?>/theme/lonet/pix/trustpilot/verified.svg"></div>
			</div>
			<div class="review-title">Great communication and support.</div>
			<div class="review-content" data-toggle="tooltip" title="Lonet Academy is a great company to work for. The personnel are very reachable and ready to help with any questions that I have.
Very quickly after I made a profile with them, two students picked me as their tutor and they are excellent students who are serious about learning.
I have not requested payment yet so I can't tell about that end.
Only negative so far is setting your schedule. It is very tedious every week.">
				Lonet Academy is a great company to work for. The personnel are very reachable and ready to...
			</div>
			<div class="review-footer">
				<div class="review-author">Alissa Lechleitner</div>
				<div class="review-date">&nbsp;July, 2024</div>
			</div>
		</div>
		<div class="review-card">
			<div class="review-header">
				<div class="stars"><img src="<?= $CFG->wwwroot ?>/theme/lonet/pix/trustpilot/5stars.svg"></div>
				<div class="verified"><img src="<?= $CFG->wwwroot ?>/theme/lonet/pix/trustpilot/verified.svg"></div>
			</div>
			<div class="review-title">Lonet Academy is a great platform </div>
			<div class="review-content" data-toggle="tooltip" title="Lonet Academy is a great platform for teachers. As a student the most important thing for me is to be able to make my own schedule. Lonet allows me to manage both job and studies. I would recommend Lonet to all teachers, especially younger tutors who are students like me or have multiple jobs!">
				Lonet Academy is a great platform for teachers. As a student the most important thing for ...</div>
			<div class="review-footer">
				<div class="review-author">Lana Pribišević</div>
				<div class="review-date">&nbsp;September, 2024</div>
			</div>
		</div>
		<div class="review-card">
			<div class="review-header">
				<div class="stars"><img src="<?= $CFG->wwwroot ?>/theme/lonet/pix/trustpilot/5stars.svg"></div>
				<div class="verified"><img src="<?= $CFG->wwwroot ?>/theme/lonet/pix/trustpilot/verified.svg"></div>
			</div>
			<div class="review-title">It is convenient and easy platform </div>
			<div class="review-content" data-toggle="tooltip" title="It is convenient and easy platform for experienced teachers, also for starting teachers to get experience.

I also enjoy that the system is quick and available for using it everywhere.">
				It is convenient and easy platform for experienced teachers, also for starting teachers...</div>
			<div class="review-footer">
				<div class="review-author">Kristi Kiilman</div>
				<div class="review-date">&nbsp;September, 2024</div>
			</div>
		</div>
		<div class="review-card">
			<div class="review-header">
				<div class="stars"><img src="<?= $CFG->wwwroot ?>/theme/lonet/pix/trustpilot/5stars.svg"></div>
				<div class="verified"><img src="<?= $CFG->wwwroot ?>/theme/lonet/pix/trustpilot/verified.svg"></div>
			</div>
			<div class="review-title">Top notch!</div>
			<div class="review-content" data-toggle="tooltip" title="I have the pleasure of teaching English and German on Lonet Academy, and it is a fantastic experience! The platform is user-friendly, allowing me to easily connect with my students and tailor lessons to their individual needs. The tools available for interactive learning are excellent, which helps me make each lesson engaging and effective. The support from the Lonet Academy team is also top-notch, ensuring that both teachers and students have a smooth and productive learning experience. I highly recommend Lonet Academy to any language teacher looking for a professional and supportive platform to grow their teaching practice!">
				I have the pleasure of teaching English and German on Lonet Academy, and it is...
				<br><br>
			</div>
			<div class="review-footer">
				<div class="review-author">Dario</div>
				<div class="review-date">&nbsp;July, 2024</div>
			</div>
		</div>
	</div>
	<div class="trustscore">
	<p>TrustScore<span class="px-1">4.4</span>Showing our 15 start reviews.</p>
	<a href="https://www.trustpilot.com/review/lonet.academy?languages=all" style="color:#374151;"><img src="<?= $CFG->wwwroot ?>/theme/lonet/pix/trustpilot/star.svg" style="vertical-align:baseline">Trustpilot</a>
	</div>
	</div>



<div class="happyboxes hidden">
    <div class="testimonial-card">
        <div class="text"><?= get_string('teacher1comment','local_lonet') ?></div>
        <div class="profile">
            <img src="<?= $CFG->wwwroot ?>/theme/lonet/pix/teacher1.svg" />
            <div class="name-date">
                <p class="name my-0">Jaxson Mango</p>
                <p class="date my-0">2024-04-22</p>
            </div>
        </div>
    </div>
    <div class="testimonial-card">
        <div class="text"><?= get_string('teacher2comment','local_lonet') ?></div>
        <div class="profile">
            <img src="<?= $CFG->wwwroot ?>/theme/lonet/pix/teacher2.svg" />
            <div class="name-date">
                <p class="name my-0">Emery Bator</p>
                <p class="date my-0">2024-04-23</p>
            </div>
        </div>
    </div>
    <div class="testimonial-card">
        <div class="text"><?= get_string('teacher3comment','local_lonet') ?></div>
        <div class="profile">
            <img src="<?= $CFG->wwwroot ?>/theme/lonet/pix/teacher3.svg" />
            <div class="name-date">
                <p class="name my-0">Zaire Press</p>
                <p class="date my-0">2024-04-24</p>
            </div>
        </div>
    </div>
    <div class="testimonial-card">
        <div class="text"><?= get_string('teacher4comment','local_lonet') ?></div>
        <div class="profile">
            <img src="<?= $CFG->wwwroot ?>/theme/lonet/pix/teacher4.svg" />
            <div class="name-date">
                <p class="name my-0">Jaxson Mango</p>
                <p class="date my-0">2024-04-22</p>
            </div>
        </div>
    </div>
    <div class="testimonial-card">
        <div class="text"><?= get_string('teacher5comment','local_lonet') ?></div>
        <div class="profile">
            <img src="<?= $CFG->wwwroot ?>/theme/lonet/pix/teacher5.svg" />
            <div class="name-date">
                <p class="name my-0">Emery Bator</p>
                <p class="date my-0">2024-04-23</p>
            </div>
        </div>
    </div>
    <div class="testimonial-card">
        <div class="text"><?= get_string('teacher6comment','local_lonet') ?></div>
        <div class="profile">
            <img src="<?= $CFG->wwwroot ?>/theme/lonet/pix/teacher6.svg" />
            <div class="name-date">
                <p class="name my-0">Zaire Press</p>
                <p class="date my-0">2024-04-24</p>
            </div>
        </div>
    </div>
</div>
</div>
<!------ready to Join-------->
<div class="tutorsection8 text-center" style="padding: 64px 112px;">
<h3 class="my-0"><?= get_string('ready2join','local_lonet') ?></h3>
<p class="my-0 toppara8"><?= get_string('ready2joindesc','local_lonet') ?></p>
<a href="/login/signup.php" class="tutorapply"><?= get_string('applynow','local_lonet') ?></a>
</div>
<!----------------------------------------------------Our customer say------------------------------------------>
<div class="ourcustomersay" style="background:#FFF;">
<div class="contentbox">
<p><?= get_string('customersay','local_lonet') ?><span class="px-2 excel"><?= get_string('excellent','local_lonet') ?></span><img src="<?= $CFG->wwwroot ?>/theme/lonet/pix/trustpilot/45stars.svg"></p>
<p class="text-center"><span class="outof">4.4</span> <?= get_string('outof','local_lonet') ?> 15 &nbsp;&nbsp;<img src="<?= $CFG->wwwroot ?>/theme/lonet/pix/trustpilot/star.svg" style="vertical-align:baseline">Trustpilot</p>
</div>
</div>
<!------------------------------------------faq container--------------------------------------->
<div class="faqcontainer" style="padding: 64px 320px;">
<div class="faqbox">
<h4 class="my-0"><?= get_string('faq','local_lonet') ?></h4>
<div class="custom_accordion-body">
	<div class="custom_accordion">
		<div class="acontainer" id="acontainer_1">
		  <div class="label"><?= get_string('becometutor_faq1_question','local_lonet') ?></div>
		  <div class="content" style="display:none;">
		  <p class="my-0"><?= get_string('becometutor_faq1_answer','local_lonet') ?></p>
		  </div>
		</div>
		<div class="acontainer" id="acontainer_2">
		  <div class="label"><?= get_string('becometutor_faq2_question','local_lonet') ?></div>
		  <div class="content" style="display:none;">
		  <p  class="my-0"><?= get_string('becometutor_faq2_answer','local_lonet') ?></p>
			</div>
		</div>
		<div class="acontainer" id="acontainer_3">
		  <div class="label"><?= get_string('becometutor_faq3_question','local_lonet') ?></div>
		  <div class="content" style="display:none;">
		  <p  class="my-0"><?= get_string('becometutor_faq3_answer','local_lonet') ?></p>
			</div>
		</div>
		<div class="acontainer" id="acontainer_4" style="display:none;">
		  <div class="label"><?= get_string('becometutor_faq4_question','local_lonet') ?></div>
		  <div class="content" style="display:none;">
		  <p class="my-0"><?= get_string('becometutor_faq4_answer','local_lonet') ?></p>
		  </div>
		</div>
		<div class="acontainer" id="acontainer_5" style="display:none;">
		  <div class="label"><?= get_string('becometutor_faq5_question','local_lonet') ?></div>
		  <div class="content" style="display:none;">
		  <p  class="my-0"><?= get_string('becometutor_faq5_answer','local_lonet') ?></p>
			</div>
		</div>
	</div>
	<div style="width: 100%;text-align: center; margin-top: 32px;"><button id="loadMoreBtn" onclick="loadMore()"><?= get_string('becometutor_faq_loadmore','local_lonet') ?></button></div>
</div>
</div>
</div>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script type="text/javascript">
$('.howboxes .tablink').on('click', function(e) {
  e.preventDefault();
  $('.howboxes .tablink').removeClass('current');
  $(this).addClass('current');
  $('.tabtarget').addClass('hidden');
  var tabID = $(this).attr('data-target');
  $('.' + tabID).removeClass('hidden');
});

$('.happyboxes').slick({
		prevArrow:"<button type='button' class='slick-prev pull-left'><i class='fa fa-arrow-left' aria-hidden='true'></i></button>",
		nextArrow:"<button type='button' class='slick-next pull-right'><i class='fa fa-arrow-right' aria-hidden='true'></i></button>",
		dots: false,
		infinite: false,
		speed: 1000,
		slidesToShow: 3,
		slidesToScroll: 3,
	  responsive: [
		{
		  breakpoint: 1149,
		  settings: {
			slidesToShow: 3,
			slidesToScroll: 3,
		  }
		},
		{
		  breakpoint: 1024,
		  settings: {
			slidesToShow: 2,
			slidesToScroll: 2,
		  }
		},
		{
		  breakpoint: 600,
		  settings: {
			slidesToShow: 1,
			slidesToScroll: 1
		  }
		},
		{
		  breakpoint: 480,
		  settings: {
			slidesToShow: 1,
			slidesToScroll: 1
		  }
		}
	  ]
	});
$('[data-toggle="tooltip"]').tooltip();
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
<?php
echo $OUTPUT->footer();
