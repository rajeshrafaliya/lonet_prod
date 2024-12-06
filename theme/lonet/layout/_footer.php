 <?php
use local_lonet\category;
use local_lonet\language;
use local_lonet\user;

if (in_array($PAGE->pagelayout, ['mypublic'])) {
	require_once(dirname(__FILE__).'/_side.php');
}

if (!isloggedin() || isguestuser()) {
    if (strpos($_SERVER['REQUEST_URI'], 'signup') === false && strpos($_SERVER['REQUEST_URI'], 'login') === false) {
        echo '<div id="show-special-offer" class="hidden"></div>';
    }
	require_once(dirname(__FILE__).'/_email_popup.php');
?>
	<div class="container py-5 mailerlitecform hidden">
		<div class="row">
			<div class="span6" style="float: none; margin: 0 auto;">
			  <span class="py-2 title"><?= get_string('subebook','local_lonet'); ?></span>
			  <form method="post" id="form-subscribemailer" class="subscribemailer" action="<?php echo $CFG->httpswwwroot; ?>/local/lonet/subscribemailer.php">
					<div class="col-sm-12 px-0 my-3">
					<label for="subname" class="col-sm-2 col-form-label pl-0 py-2"><?= get_string('name'); ?></label>
					<input type="text" name="subscribemailer[name]" class="form-control" id="subname" required>
					</div>
					<div class="col-sm-12 px-0 mb-3">
					<label for="inputEmail" class="col-sm-2 col-form-label pl-0 py-2"><?= get_string('email','local_lonet'); ?></label>
					<input type="email" name="subscribemailer[email]" class="form-control" id="inputEmail" required>
					</div>
					
					<div class="row mb15"> 
						<div class="col-xs-12"> 
							<div class="ml-form-interestGroupsRow ml-block-groups ml-validate-required"> 
								<div class="ml-form-interestGroupsRowCheckbox group" style="display:none"> 
									<label> <input type="hidden" name="groups[]" value="94771110564857015" checked="checked" aria-invalid="false"> 
									<div class="label-description d-inline-block"></div> 
									</label> 
								</div>
								<div class="ml-form-interestGroupsRowCheckbox group" style=""> 
									<label> 
									<input type="checkbox" name="groups[]" value="120825779718194373" aria-invalid="false"> 
									<div class="label-description d-inline-block">Newsletter in English</div> 
									</label> 
								</div> 
								<div class="ml-form-interestGroupsRowCheckbox group" style=""> 
									<label> 
									<input type="checkbox" name="groups[]" value="120825779722388678" aria-invalid="false"> 
									<div class="label-description d-inline-block">Newsletter in Russian</div> 
									</label> 
								</div> 
								<div class="ml-form-interestGroupsRowCheckbox last-group" style=""> 
									<label> 
									<input type="checkbox" name="groups[]" value="120825779726582985" aria-invalid="false"> 
									<div class="label-description d-inline-block">Newsletter in Latvian</div> 
									</label> 
								</div> 
							</div> 
						</div> 
					</div>
					
					<div class="col-sm-12" style="padding-left:100px;">
						<button type="submit" class="btn btn-success subscribemailer" style="border: none;color: #fff;font-family: 'Open Sans',Arial,Helvetica,sans-serif;font-size: 16px;font-weight: 700;line-height: 22px;padding: 15px 30px;text-transform: uppercase;"><?= get_string('subscribe','local_lonet'); ?></button>
					</div>
				</form>
			</div>
		</div>
	</div>
<?php
}
$language = explode('_', current_language())[0];
if ($display_footer) {
	$partnership_link = '/corporate-partnership';
	$careers_link = '/careers';
	$faq_link = '/how-to-learn-languages';
	// $howitworks_link = '/how-it-works';
	$howitworks_link = '/best-language-platform-for-tutors-and-coaches';
	$aboutmissionvalues_link = '/about-mission-values';// /aboutmissionvalues
    $giftcards_link = '/language-gift-cards';
    $language_camp_link = '/language-camp';
    $language_tutor_consultation = '/language-tutor-consultation';
	if ($language == 'es') {
		// $howitworks_link = '/como-funciona';
		$aboutmissionvalues_link = '/mision-y-valores';// /aboutmissionvalues
		$language_tutor_consultation = '/language-tutor-consultation';
	}
	if ($language == 'lv') {
		$partnership_link = '/ka-atri-apgut-sveshvalodu';
        // $faq_link = '/ka-macities-svesvalodas';
        // $howitworks_link = '/ka-tas-darbojas';
        $aboutmissionvalues_link = '/misija-un-vertibas';// /par misijas vērtībām
        $giftcards_link = '/valodu-kursi-davanu-kartes';
        $language_camp_link = '/language-camp';
        $language_tutor_consultation = '/ka-izveleties-labako-svesvalodas-skolotaju';
	}
	if ($language == 'ru') {
		$partnership_link = '/kak_bystro_vyuchit_inostrannyi_yazyk';
		$careers_link = '/prepodavaty-yazyk-po-skype';
		// $faq_link = '/FAQ-kak-uchitj-inostrannije-yaziki';
		// $howitworks_link = '/kak-eto-rabotayet';
		$aboutmissionvalues_link = '/missiya-i-tsennosti';
        $giftcards_link = '/podarochnye-karty-yazykovye-kursi';
        $language_camp_link = '/language-camp';
        $language_tutor_consultation = '/konsultacija-skype-repetitor';
	}
	?>
	<footer id="page-footer">
	   <div class="container-fluid container-footer">
		  <div class="row">
			 <div class="col-lg-4 col-sm-12 col-md-3">
				<img class="contactlonet" src="<?= $CFG->wwwroot ?>/theme/lonet/pix/lonet_footer.svg">
				<ul class="contactus_ul">
				   <li>
						<strong>SIA "LONET"</strong>
						<br><?= $footersection1address ?>
						<br>Rīga, Latvija
						<br><?= get_string('crn', 'theme_lonet') ?>: 40203091983
					   <?php if($footersection1contactno) { ?>
					   <li><?php echo $footersection1contactno ?></li>
					   <?php } ?>
				   </li>
				   <?php if($footersection1email) { ?>
				   <li><a href="mailto:<?php echo $footersection1email ?>"><?php echo $footersection1email ?></a></li>
				   <?php } ?>
				   <li class="socialmediaicons">
				   <a href="https://www.facebook.com/lonet.academy" target="_blank"><img class="fb" src="<?= $CFG->wwwroot ?>/theme/lonet/pix/fb.svg"></a>
				   <a href="https://www.instagram.com/lonet.academy/" target="_blank"><img class="insta" src="<?= $CFG->wwwroot ?>/theme/lonet/pix/insta.svg"></a>
				   <a href="https://www.linkedin.com/company/lonet/" target="_blank"><img class="linkedin" src="<?= $CFG->wwwroot ?>/theme/lonet/pix/linkedin.svg"></a>
				   <a href="https://www.youtube.com/@lonetacademy5349" target="_blank"><img class="youtube" src="<?= $CFG->wwwroot ?>/theme/lonet/pix/youtube.svg"></a>
				   </li>
				   <?= ($footersection1content ? $footersection1content : '') // <br><br> ?>
				</ul>
			 </div>
			 <div class="secondsection" style="display: flex;flex-direction: column;">
				 <div class="aboutussection">
					 <div class="col-lg-2 col-sm-6 col-md-2 px-0">
						<h5><?= get_string('aboutus', 'theme_lonet') ?></h5>
						<ul class="common">
						   <li><a href="<?= $aboutmissionvalues_link ?>"><?= get_string('aboutmissionvalues', 'theme_lonet') ?></a></li>
						   <li><a href="/"><?= get_string('ourvalues', 'theme_lonet') ?></a></li>
						   <li><a href="/"><?= get_string('history', 'theme_lonet') ?></a></li>
						   <li><a href="/"><?= get_string('ourpartners', 'theme_lonet') ?></a></li>
						   <li><a href="/contact-us"><?= get_string('contactus', 'theme_lonet') ?></a></li>
						</ul>
					 </div>
					 <div class="col-lg-2 col-sm-6 col-md-2 px-0">
						<h5><?= get_string('forlearners', 'theme_lonet') ?></h5>
						<ul class="common">
							<!--li><a href="<?= $howitworks_link ?>"><?= get_string('howitworks', 'theme_lonet') ?></a></li-->
							<li><a href="/language-tutor-consultation">Free consulation</a></li>
							<li><a href="/login/signup.php"><?= get_string('join', 'theme_lonet') ?></a></li>
						   <li><a href="<?= $faq_link ?>"><?= get_string('faq', 'theme_lonet') ?></a></li>
						   <li><a href="/blog">Our blog</a></li>
						   <li class="d-none hidden"><a href="<?= $giftcards_link ?>"><?= get_string('giftcard', 'theme_lonet') ?></a></li>
						</ul>
					 </div>
					 <div class="col-lg-2 col-sm-6 col-md-2 px-0">
						<h5><?= get_string('foreducators', 'theme_lonet') ?></h5>
						<ul class="common">
							<li><a href="<?= $howitworks_link ?>"><?= get_string('howitworks', 'theme_lonet') ?></a></li>
							<li><a href="/login/signup.php"><?= get_string('apply', 'theme_lonet') ?></a></li>
						   <!--li><a href="<?= $faq_link ?>"><?= get_string('faq', 'theme_lonet') ?></a></li-->
						   <li><a href="/language-tutor-consultation"><?= get_string('talktokristine', 'theme_lonet') ?></a></li>
						   <li><a href="/"><?= get_string('educatorsconduct', 'theme_lonet') ?></a></li>
						   <li><a href="/"><?= get_string('codeofethics', 'theme_lonet') ?></a></li>
						</ul>
					 </div>
					 <div class="col-lg-2 col-sm-6 col-md-3 px-0">
						<h5><?= get_string('popularlanglesson', 'theme_lonet') ?></h5>
						<ul class="common">
							<?php
								foreach (['en', 'de', 'it', 'lv', 'ru', 'es'] as $lang_code) {
									$lang_model = language::get_by_code($lang_code);   
										?> <li><a href="<?= language::get_full_url($lang_model) ?>"><?= category::get_name($lang_code) ?> <?= get_string('language', 'theme_lonet') ?></a></li> <?php
								}
							?>
						</ul>
					 </div>
				 </div>
				 <div class="paymentsection" style="display:flex;gap:130px;">
					<div class="partnership hidden">
						<h5>Partnership</h5>
						<ul class="common">
						   <li><a href="#">Our partners</a></li>
						</ul>
					</div>
					<div class="paymentcards">
					<h5>Payment methods</h5>
					<img class="" src="<?= $CFG->wwwroot ?>/theme/lonet/pix/pmethods.png">
					</div>
				 </div>
			 </div>
		  </div>
		  <hr style="margin-top:32px;margin-bottom:32px;">
		  <div class="row footer_2">
		  <div class="col-lg-9 col-sm-6 col-md-2">
			<ul>
			<li class="d-inline"><a href="/terms-and-conditions">Terms and Conditions</a></li>
			<li class="d-inline"><a href="/privacy-policy" class="pl-5">Privacy Policy</a></li>
			</ul>
		  </div>
		  <div class="col-lg-3 col-sm-6 col-md-2"><p>© 2024 Lonet. All rights reserved.</p></div>
		  </div>
	   </div>
	</footer>
<?php } ?>

<div class="bottom-footer">
	<div id="course-footer"><?php echo $OUTPUT->course_footer(); ?></div>
	<p class="helplink"><?php echo $OUTPUT->page_doc_link(); ?></p>
	<?php
		echo $html->footnote;
		echo $OUTPUT->login_info();
		echo $OUTPUT->standard_footer_html();
	?> 
	<?php if ($hascopyright) {?>
		<br>
		<p class="copy">&copy; <?= date("Y") ?> <?= $hascopyright ?></p>
	<?php } ?> 
</div>

</div>
<?php //Floating button
if(strpos($_SERVER['REQUEST_URI'], '/language-tutor-consultation') === false){
?>	
	<a href="/language-tutor-consultation" class="float-consultation-button" target="_blank">
		<?= get_string('bookaconsult','theme_lonet') ?>
	</a>
<?php
}	
?>
<?php echo $OUTPUT->standard_end_of_body_html(); ?>
    <div id="loader" style="display:none;top: 0px;
    position: absolute;">
  <!-- Customize your loader here -->
  <img src="https://i.gifer.com/ZKZg.gif" alt="Loading...">
</div>
<?php /*if (!empty($PAGE->theme->settings->backtotop)) { ?>
<div id="backtotop" style="display: none;"> 
   <a class="scrollup" href="javascript:void(0);" title="<?php echo get_string('backtotop', 'theme_lonet')?>">
   </a>
</div>
<?php }*/ ?>

<?php if (strpos($_SERVER['HTTP_HOST'], 'lonet.academy') !== false) { ?>
<!--script type="text/javascript">
    window._mfq = window._mfq || [];
    (function() {
        var mf = document.createElement("script");
        mf.type = "text/javascript"; mf.async = true;
        mf.src = "//cdn.mouseflow.com/projects/62d1dfac-cc7e-4965-984d-5dd5b973efde.js";
        document.getElementsByTagName("head")[0].appendChild(mf);
    })();
</script-->

<?php /*<script type="text/javascript">
var LHCChatOptions = {};
LHCChatOptions.opt = {widget_height:340,widget_width:300,popup_height:520,popup_width:500,domain:'lonet.academy'};
(function() {
var _l = '';var _m = document.getElementsByTagName('meta');var _cl = '';for (i=0; i < _m.length; i++) {if ( _m[i].getAttribute('http-equiv') == 'content-language' ) {_cl = _m[i].getAttribute('content');}}if (document.documentElement.lang != '') _l = document.documentElement.lang;if (_cl != '' && _cl != _l) _l = _cl;if (_l == undefined || _l == '') {_l = '';} else {_l = _l[0].toLowerCase() + _l[1].toLowerCase(); if ('eng' == _l) {_l = ''} else {_l = _l + '/';}}
var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
var referrer = (document.referrer) ? encodeURIComponent(document.referrer.substr(document.referrer.indexOf('://')+1)) : '';
var location  = (document.location) ? encodeURIComponent(window.location.href.substring(window.location.protocol.length)) : '';
po.src = 'https://help.lonet.academy/index.php/'+_l+'chat/getstatus/(click)/internal/(position)/bottom_right/(ma)/br/(top)/350/(units)/pixels/(leaveamessage)/true/(department)/1/(disable_pro_active)/true/(theme)/1?r='+referrer+'&l='+location;
var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
})();
</script>*/ ?>
<?php } ?>

<script type="text/javascript">
	$(window).scroll(function(){
	  var sticky = $('.top-section'),
		  scroll = $(window).scrollTop();

	  if (scroll >= 100) sticky.addClass('fixed');
	  else sticky.removeClass('fixed');
	});
    $('[data-background]').each(function(e) {
        $(this).css('background-image', 'url(' + $(this).data('background') + ')');
    });
    $('img[data-src]').each(function(e) {
        $(this).attr('src', $(this).data('src'));
    });
	
	$('#form-subscribemailer').submit(function(e) {
		e.preventDefault();
		$.ajax({
			url: $(this).attr('action'),
			type: 'post',
			data: $(this).serialize(),
			success: function() {
				$('#form-subscribemailer')[0].reset();
				swal({
					icon: 'success',
					title: 'You are subscribed.',
					timer: 2000,
				});
			}
		});
	});

document.addEventListener('DOMContentLoaded', function() {
    const slider = document.getElementById('slider');
    const slideLeftButton = document.getElementById('slide-left');
    const slideRightButton = document.getElementById('slide-right');

    let currentPosition = 0;

    slideRightButton.addEventListener('click', () => {
        const maxScrollLeft = slider.scrollWidth - slider.clientWidth;
        if (currentPosition < maxScrollLeft) {
            currentPosition += 160;
            slider.style.transform = `translateX(-${currentPosition}px)`;
        }
    });

    slideLeftButton.addEventListener('click', () => {
        if (currentPosition > 0) {
            currentPosition -= 160;
            slider.style.transform = `translateX(-${currentPosition}px)`;
        }
    });
});
document.addEventListener('DOMContentLoaded', function() {
    const slider = document.getElementById('slider1');
    const slideLeftButton = document.getElementById('slide-left1');
    const slideRightButton = document.getElementById('slide-right1');

    let currentPosition = 0;

    slideRightButton.addEventListener('click', () => {
        const maxScrollLeft = slider.scrollWidth - slider.clientWidth;
        if (currentPosition < maxScrollLeft) {
            currentPosition += 160;
            slider.style.transform = `translateX(-${currentPosition}px)`;
        }
    });

    slideLeftButton.addEventListener('click', () => {
        if (currentPosition > 0) {
            currentPosition -= 160;
            slider.style.transform = `translateX(-${currentPosition}px)`;
        }
    });
});

/* function findtoggleDropdown() {
	var dropdownMenu = document.getElementById("dropdownMenu");
	var dropdownButtonIcondown = document.querySelector(".findbestmatch .dropdown-button .cdown");
	var dropdownButtonIconup = document.querySelector(".findbestmatch .dropdown-button .cup");
	if (dropdownMenu.style.display === "block") {
		dropdownMenu.style.display = "none";
		dropdownButtonIconup.classList.add("hidden");
		dropdownButtonIcondown.classList.remove("hidden");
	} else {
		dropdownMenu.style.display = "block";
		dropdownButtonIcondown.classList.add("hidden");
		dropdownButtonIconup.classList.remove("hidden");
	}
} */
function findtoggleDropdown() {
    var $dropdownMenu = $('#dropdownMenu');

    if ($dropdownMenu.is(':visible')) {
        $dropdownMenu.slideUp(600); // Slide up with a duration of 300ms
    } else {
        $dropdownMenu.slideDown(600); // Slide down with a duration of 300ms
    }
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
	if (!event.target.matches('.findbestmatch .dropdown-button')) {
		var dropdowns = document.getElementsByClassName("dropdown-content");
		var dropdownButtonIcondown = document.querySelector(".findbestmatch .dropdown-button .cdown");
		var dropdownButtonIconup = document.querySelector(".findbestmatch .dropdown-button .cup");
		for (var i = 0; i < dropdowns.length; i++) {
			var openDropdown = dropdowns[i];
			if (openDropdown.style.display === "block") {
				openDropdown.style.display = "none";
				dropdownButtonIconup.classList.add("hidden");
				dropdownButtonIcondown.classList.remove("hidden");
			}
		}
	}
}
$('.readmore').click(function(e) {
    e.preventDefault();
    var action = $(this).attr("data-action");
    var tch = $(this).attr("data-teacher");
    if(action == 'showmore'){
        $('.'+tch+ ' .showmore').addClass('hidden');
        $('.'+tch+ ' .showless').removeClass('hidden');
        $('.'+tch+ ' .shorttext').addClass('hidden');
        $('.'+tch+ ' .longtext').removeClass('hidden');
    }else{
        $('.'+tch+ ' .showless').addClass('hidden');
        $('.'+tch+ ' .showmore').removeClass('hidden');
        $('.'+tch+ ' .longtext').addClass('hidden');
        $('.'+tch+ ' .shorttext').removeClass('hidden');

    }
});
$(document).on("click",".hourlyrate",function(e) {
    var teachmodal = $(this).attr("data-teachermodal");
    $('.'+teachmodal).modal('show');
});
$(document).on("click","#price-modal .close",function(e) {
    $('#price-modal').modal('hide');
});

$(document).on('click', '.acontainer .label', function(e) {
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
}

//profile page
/* var fixmeTop = $('.profilemaincontentarea .rightsidecontent').offset().top;       // get initial position of the element
$(window).scroll(function() {
    var currentScroll = $(window).scrollTop();
    if (currentScroll >= fixmeTop) {
        $('.profilemaincontentarea .rightsidecontent').css({
            position: 'fixed',
            right: '12.7%',
            top: 0
        });
    } else {
        $('.profilemaincontentarea .rightsidecontent').css({
            position: 'static'
        });
    }

}); */
$('.lflagboxs').slick({
		prevArrow:"<button type='button' class='slick-prev pull-left'><i class='fa fa-arrow-left' aria-hidden='true'></i></button>",
		nextArrow:"<button type='button' class='slick-next pull-right'><i class='fa fa-arrow-right' aria-hidden='true'></i></button>",
		dots: false,
		infinite: false,
		speed: 1000,
		slidesToShow: 7,
		slidesToScroll: 3,
	  responsive: [
		{
		  breakpoint: 1149,
		  settings: {
			slidesToShow: 4,
			slidesToScroll: 3,
		  }
		},
		{
		  breakpoint: 1024,
		  settings: {
			slidesToShow: 4,
			slidesToScroll: 2,
		  }
		},
		{
		  breakpoint: 600,
		  settings: {
			slidesToShow: 2,
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

$('#page-login-signup .felement.fpassword').append('<button class="toggle-sensitive-btn btn btn-secondary eye-icon" type="button" id="toggle-password"><i class="icon fa fa-eye fa-fw" aria-hidden="true"></i></button>');
document.addEventListener('DOMContentLoaded', function () {
    const togglePassword = document.querySelector('#page-login-signup #toggle-password');
    const passwordField = document.querySelector('#page-login-signup #id_password'); // Ensure the ID matches the password field

    togglePassword.addEventListener('click', function () {
        const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordField.setAttribute('type', type);

        // Toggle the eye / eye-slash icon
        this.querySelector('i').classList.toggle('fa-eye');
        this.querySelector('i').classList.toggle('fa-eye-slash');
    });
});

//edit.php page
window.onload = function() {
	var elements = document.querySelectorAll('.felement.error');
	if (elements.length > 0) { // Check if there are any elements
		setTimeout(function() {
			elements[0].scrollIntoView({ behavior: 'smooth' }); // Scroll the first element into view
		}, 100);
	}
	$('#fitem_id_profile_field_tutorrole').before('<p style="font-size: 18px;color: #000;">Choose your role as a Language Tutor, Trainer or a Coach. You can choose maximum 2 roles.</p>');
};
/*       document.onreadystatechange = function () {
         if (document.readyState !== "complete") {
            document.querySelector("body").style.visibility = "hidden";
            document.getElementById("loader").style.visibility = "visible";
         } else {
            setTimeout(() => {
               document.getElementById("loader").style.display ="none";
               document.querySelector("body").style.visibility = "visible";
            }, 3000)
         }
      }; */

window.onload = function() {
    // Function to update the URL
    function updateURLForLanguage(lang) {
        var currentURL = window.location.href;
        var urlObject = new URL(currentURL); // Create a URL object for easier manipulation

        // Check if we're on the home page
        if (urlObject.origin + urlObject.pathname === 'https://dev.lonet.academy/' || urlObject.origin + urlObject.pathname === 'https://dev.lonet.academy') {
            // Remove the 'lang' query parameter if it exists
            if (urlObject.searchParams.has('lang')) {
                urlObject.searchParams.delete('lang');  // Remove the 'lang' query parameter
                currentURL = urlObject.origin + urlObject.pathname + urlObject.search;  // Rebuild URL without 'lang'
            }

            // Check if the language is one of the supported languages
            if (lang === 'en' || lang === 'lv' || lang === 'es' || lang === 'ru') {
                // Check if the URL already includes the language path
                if (!currentURL.includes('/' + lang)) {
                    // Append the language code to the URL path
                    var newURL = currentURL.endsWith('/') ? currentURL + lang : currentURL + '/' + lang;
                    window.history.replaceState(null, '', newURL);  // Update the URL without reloading
                }
            }
        }
    }

    // Assign the PHP variable to JavaScript (make sure this outputs correctly)
    var currentLanguage = '<?= $language; ?>'; 
    updateURLForLanguage(currentLanguage);
};

</script>

<style>
.mailerlitecform{
	width: 100% !important;
	background: #fafafa;
	color:#727272;
}
.mailerlitecform .title{
	font-size: 16px;
}
.mailerlitecform .title b{
	color: #000;
}
@media (min-width: 1200px){
.mailerlitecform .span6 {
    width: 670px;
}
}
#form-subscribemailer{
	margin-left:145px;
}
@media (max-width: 500px){
#form-subscribemailer {
    margin-left: 20px;
}
.mailerlitecform .title{
    padding-left: 20px;
    padding-right: 20px;
    display: block;
}
}
.float-consultation-button{
	position:fixed;
	width:271px;
	bottom:40px;
	right:40px;
  	z-index:100;

	border-radius: 60px;
    border: 1px solid rgba(17, 24, 39, 0.15);
    background: #CE1369;
    box-shadow: 0px 1px 0px 0px rgba(0, 0, 0, 0.04);
    color: #FFFFFF;
    text-align: center;
    font-size: 18px;
    font-style: normal;
    font-weight: 500;
    line-height: 24px;
    display: flex;
    padding: 12px 20px;
    justify-content: center;
    align-items: center;
    gap: 10px;
    width: 271px;
	height:60px;
	text-shadow:none;
	outline:none;
}

@media screen and (max-width: 600px) {
	.float-consultation-button {
		width:calc(100% - 20px);
		left: 10px;
		right: 10px;
		bottom: 10px;
	}
}
</style>
<?= user::getSchema() ?>
</body>
</html>