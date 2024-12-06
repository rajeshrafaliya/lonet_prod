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
	<div class="container py-5 mailerlitecform">
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
									<label> <input type="hidden" name="groups[]" value="46432276" checked="checked" aria-invalid="false"> 
									<div class="label-description d-inline-block"></div> 
									</label> 
								</div>
								<div class="ml-form-interestGroupsRowCheckbox group" style=""> 
									<label> 
									<input type="checkbox" name="groups[]" value="112212054" aria-invalid="false"> 
									<div class="label-description d-inline-block">Newsletter in English</div> 
									</label> 
								</div> 
								<div class="ml-form-interestGroupsRowCheckbox group" style=""> 
									<label> 
									<input type="checkbox" name="groups[]" value="112212056" aria-invalid="false"> 
									<div class="label-description d-inline-block">Newsletter in Russian</div> 
									</label> 
								</div> 
								<div class="ml-form-interestGroupsRowCheckbox last-group" style=""> 
									<label> 
									<input type="checkbox" name="groups[]" value="112212058" aria-invalid="false"> 
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
if ($display_footer) {
	$language = explode('_', current_language())[0];
	$partnership_link = '/corporate-partnership';
	$careers_link = '/careers';
	$faq_link = '/how-to-learn-languages';
	$howitworks_link = '/how-it-works';
	$aboutmissionvalues_link = '/about-mission-values';// /aboutmissionvalues
    $giftcards_link = '/language-gift-cards';
    $language_camp_link = '/language-camp';
    $language_tutor_consultation = '/language-tutor-consultation';
	if ($language == 'es') {
		$howitworks_link = '/como-funciona';
		$aboutmissionvalues_link = '/mision-y-valores';// /aboutmissionvalues
		$language_tutor_consultation = '/language-tutor-consultation';
	}
	if ($language == 'lv') {
		$partnership_link = '/ka-atri-apgut-sveshvalodu';
        $faq_link = '/ka-macities-svesvalodas';
        $howitworks_link = '/ka-tas-darbojas';
        $aboutmissionvalues_link = '/misija-un-vertibas';// /par misijas vērtībām
        $giftcards_link = '/valodu-kursi-davanu-kartes';
        $language_camp_link = '/language-camp';
        $language_tutor_consultation = '/ka-izveleties-labako-svesvalodas-skolotaju';
	}
	if ($language == 'ru') {
		$partnership_link = '/kak_bystro_vyuchit_inostrannyi_yazyk';
		$careers_link = '/prepodavaty-yazyk-po-skype';
		$faq_link = '/FAQ-kak-uchitj-inostrannije-yaziki';
		$howitworks_link = '/kak-eto-rabotayet';
		$aboutmissionvalues_link = '/missiya-i-tsennosti';
        $giftcards_link = '/podarochnye-karty-yazykovye-kursi';
        $language_camp_link = '/language-camp';
        $language_tutor_consultation = '/konsultacija-skype-repetitor';
	}
	?>
	<footer id="page-footer">
	   <div class="container-fluid container-footer">
		  <div class="row">
			 <div class="col-sm-12 col-md-3">
				<h5><?= get_string('contactus', 'theme_lonet') ?></h5>
				<ul>
				   <li>
						<strong>SIA "LONET"</strong>
						<br><?= get_string('legaladdress', 'theme_lonet') ?>: <?= $footersection1address ?>
						<br><?= get_string('crn', 'theme_lonet') ?>: 40203091983
				   </li>
				   <?php if($footersection1email) { ?>
				   <li><a href="mailto:<?php echo $footersection1email ?>"><?php echo $footersection1email ?></a></li>
				   <?php } ?>
				   <?php if($footersection1contactno) { ?>
				   <li><?php echo $footersection1contactno ?> <span style="font-size:0.8em;">10:00 - 22:00 (GMT+2)</span></li>
				   <?php } ?>
				   <?= ($footersection1content ? $footersection1content : '') // <br><br> ?>
				</ul>
			 </div>
			 <div class="col-sm-6 col-md-2">
				<h5><?= get_string('aboutus', 'theme_lonet') ?></h5>
				<ul class="common">
				   <li><a href="<?= $howitworks_link ?>"><?= get_string('howitworks', 'theme_lonet') ?></a></li>
				   <li><a href="<?= $aboutmissionvalues_link ?>"><?= get_string('aboutmissionvalues', 'theme_lonet') ?></a></li>
				   <?php if ($language != 'en') { ?><li><a href="<?= $faq_link ?>"><?= get_string('frequentlyaskedquestions', 'theme_lonet') ?></a></li><?php } ?>
				   <?php if ($language != 'en') { ?><li><a href="<?= $partnership_link ?>"><?= get_string('corporate', 'theme_lonet') ?></a></li><?php } ?>
				   <?php if ($language == 'ru') { ?><li><a href="<?= $careers_link ?>"><?= get_string('careers', 'theme_lonet') ?></a></li><?php } ?>
				</ul>
			 </div>
			 <div class="col-sm-6 col-md-2">
				<h5><?= get_string('information', 'theme_lonet') ?></h5>
				<ul class="common">
				   <li><a href="/terms-and-conditions"><?= get_string('terms', 'theme_lonet') ?></a></li>
				   <li><a href="/privacy-policy"><?= get_string('pricavy', 'theme_lonet') ?></a></li>
				   <li><a href="/contact-us"><?= get_string('contactus', 'theme_lonet') ?></a></li>
				   <li><a href="<?= $language_tutor_consultation ?>"><?= get_string('freeconsultation', 'theme_lonet') ?></a></li>
				   <li><a href="<?= $giftcards_link ?>"><?= get_string('giftcards', 'theme_lonet') ?></a></li>
				   <li><a href="/local/lonet/language_camp.php"><?= get_string('languagecamplink', 'theme_lonet') ?></a></li>
				   <li><a href="/blog<?= $language && $language !== 'en' ? "/$language" : '' ?>" target="_blank"><?= get_string('blog', 'theme_lonet') ?></a></li>
				</ul>
			 </div>
			 <div class="col-sm-6 col-md-2">
				<h5><?= get_string('paymentmethods', 'theme_lonet') ?></h5>
				<img class="payment-methods" src="<?= $CFG->wwwroot ?>/theme/lonet/pix/payment/methods-square-small.png">
				<!--<img src="<?= $OUTPUT->get_logo_url()->out(false) ?>" width="100%" alt="<?= $SITE->fullname ?>" style="max-width: 250px;">-->
			 </div>
			 <div class="col-sm-6 col-md-3">
				<h5><?= get_string('populartutors', 'theme_lonet') ?>:</h5>
				<ul class="common">
                    <?php
                    if ($language === 'ru') {
                        foreach ([
                            'en' => 'английскому',
                            'zh' => 'китайскому',
                            'it' => 'итальянскому',
                            'ar' => 'арабскому',
                            'es' => 'испанскому'
                        ] as $lang_code => $lang_name) {
                            $lang_model = language::get_by_code($lang_code);
                            ?> <li><a href="<?= language::get_full_url($lang_model) ?>">Репетиторы по <?= $lang_name ?> языку</a></li> <?php
                        }
                    } else {
                        foreach (['en', 'ru', 'it', 'ar', 'es'] as $lang_code) {
                            $lang_model = language::get_by_code($lang_code);   
                            if ($language === 'es') {
                                ?> <li><a href="<?= language::get_full_url($lang_model) ?>">Tutores de <?= category::get_name($lang_code) ?> en línea </a></li> <?php
                            } else {
                                ?> <li><a href="<?= language::get_full_url($lang_model) ?>"><?= category::get_name($lang_code) ?> <?= get_string('onlinetutors', 'theme_lonet') ?></a></li> <?php
                            }
                        }
                    }
                    ?>
				</ul>
			 </div>
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
<a href="https://wa.me/send?phone=37127344201&text=Hi" class="floatwa" target="_blank">
<i class="fa fa-whatsapp my-float" style="margin-top:16px;"></i>
</a>
<?php echo $OUTPUT->standard_end_of_body_html(); ?>
  
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
.floatwa{
	position:fixed;
	width:60px;
	height:60px;
	bottom:40px;
	right:40px;
	background-color:#25d366;
	color:#FFF;
	border-radius:50px;
	text-align:center;
  font-size:30px;
	box-shadow: 2px 2px 3px #999;
  z-index:100;
}
</style>
<?= user::getSchema() ?>

</body>
</html>