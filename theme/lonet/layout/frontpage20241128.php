<?php
	use local_lonet\language;
	use local_lonet\user;
   $regionmainbox = 'span12';
   $regionmain = 'span12';
   $sidepre = 'span3';
   $sidepost = 'span3 ';
   global $CFG,$USER;
   ?>
<?php require_once(dirname(__FILE__).'/_header.php'); ?>

<body <?php echo $OUTPUT->body_attributes(); ?>>
   <?php echo $OUTPUT->standard_top_of_body_html() ?>
   <div id="page">
         <?php 
         $language = explode('_', current_language())[0];
         if (!isloggedin() or isguestuser()) { 
		 ?>
		 <!-- MailerLite Universal -->
			<script>
			(function(m,a,i,l,e,r){ m['MailerLiteObject']=e;function f(){
			var c={ a:arguments,q:[]};var r=this.push(c);return "number"!=typeof r?r:f.bind(c.q);}
			f.q=f.q||[];m[e]=m[e]||f.bind(f.q);m[e].q=m[e].q||f.q;r=a.createElement(i);
			var _=a.getElementsByTagName(i)[0];r.async=1;r.src=l+'?v'+(~~(new Date().getTime()/1000000));
			_.parentNode.insertBefore(r,_);})(window, document, 'script', 'https://static.mailerlite.com/js/universal.js', 'ml');

			var ml_account = ml('accounts', '1267354', 'i1g2b8w6m0', 'load');
			</script>
			<!-- End MailerLite Universal -->
			<!--div class="modal fade" id="myModal">
             <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                 <div class="modal-content">
                        <?php 
	/* 					if ($language == 'en') {
							 $url = $CFG->wwwroot.'/theme/lonet/pix/popup/ENG_v1.png';
						  }elseif($language == 'es') { 
							 $url = $CFG->wwwroot.'/theme/lonet/pix/popup/ESP_v1.png';
						  }elseif($language == 'lv') { 
							 $url = $CFG->wwwroot.'/theme/lonet/pix/popup/LV_v1.png';
						  }elseif($language == 'ru') { 
							 $url = $CFG->wwwroot.'/theme/lonet/pix/popup/RUS_v1.png';
						  }  */
						?>
                           <a href="/login/signup.php?popup=1" target="_blank"><img class="img-fluid" src="<?php //echo $url; ?>" id="imagepreview" ></a>
                 </div>
             </div>
         </div>
		 <script type="text/javascript">
          $(window).on('load',function(){
          var delayMs = 15000; // delay in milliseconds
          
          setTimeout(function(){
              $('#myModal').modal('show');
              $(".modal-backdrop.in").hide();
          }, delayMs);
      });
      </script>-->
      <?php } ?>      
   <?php require_once(dirname(__FILE__).'/_menu.php'); ?>   
   <?php //require_once(dirname(__FILE__).'/_slider.php'); ?>
   <?php // require_once(dirname(__FILE__).'/_testimonials.php'); ?>
   <?php
           $currlang = current_language();
        // $langs = get_string_manager()->get_list_of_translations();
        $langs = language::get_all_with_teachers();
		if(isloggedin()){
			if(!empty($USER->lastlogin)){
				user::addUserToMailingList($USER->id);
			}
		}
   ?>
	<!-- End header top section -->
	<div class="besttutorsection">
		<div class="second">
		<h3 class="3k">3K+ <img src="<?= $CFG->wwwroot ?>/theme/lonet/pix/Avatars.svg"></h3>
		<div class="third"><p class="happylearner mb-0"><?= get_string('happylearners','theme_lonet') ?></p></div>
		</div>
		<div class="first">
			<h1><?= get_string('besttutorselected','theme_lonet') ?></h1>
		</div>
		<div class="findmatchcontainer" style="display: flex;flex-direction: row;justify-content: center;width: 100%;">
			<div class="findbestmatch">
				<h5 class="hidden" style="color: #FFFFFF;text-align: center;font-size: 24px;font-style: normal;font-weight: 700;line-height: normal;">Find your best match</h5>
				<div class="dropdown">
				<button class="dropdown-button" onclick="findtoggleDropdown()"><?= get_string('chooselang','theme_lonet') ?>
				<!--img class="cdown" src="<?= $CFG->wwwroot ?>/theme/lonet/pix/cheveron-down.png" alt=""/-->
				<!--img class="cup hidden" src="<?= $CFG->wwwroot ?>/theme/lonet/pix/cheveron-up.png" alt="" /-->
				</button>
				<div class="dropdown-content" id="dropdownMenu">
				<ul>
				<?php
				foreach ($langs as $value) {
					// $newval =  preg_replace('/\s*\(.*?\)\s*/', '', $value);
					$urll = language::get_full_url($value);
					echo '<li><a href="'.$urll.'"><img src="'.$CFG->wwwroot.'/theme/lonet/pix/flag/'.$value->code.'.png" alt="'.$value->name.' flag" width="26"> '.$value->name.'</a></li>';
				}
				?>
				</ul>
				</div>
				</div>
			</div>
		</div>
	</div>

	<div class="tutorcards">

	<ul class="cards">
	  <li class="cards__item">
		<div class="card">
		  <div class="card__content">
			<div class="card__title"><?= get_string('langcoaches','theme_lonet') ?></div>
			<ul>
			<li><?= get_string('langcoaches1','theme_lonet') ?></li>
			<li class="py-3"><?= get_string('langcoaches2','theme_lonet') ?></li>
			<li><?= get_string('langcoaches3','theme_lonet') ?></li>
			</ul>
			<a href="/language-teachers?typeoftutor=coach" class="card__text py-3"><?= get_string('viewallcoaches','theme_lonet') ?> <img src="<?= $CFG->wwwroot ?>/theme/lonet/pix/RightIcon.png"></a>
		  </div>
		  <div class="card__image card__image--fence"></div>
		</div>
	  </li>
	  <li class="cards__item">
		<div class="card">
		  <div class="card__content">
			<div class="card__title"><?= get_string('langtutors','theme_lonet') ?></div>
			<ul>
			<li><?= get_string('langtutors1','theme_lonet') ?></li>
			<li class="py-3"><?= get_string('langtutors2','theme_lonet') ?></li>
			<li><?= get_string('langtutors3','theme_lonet') ?></li>
			</ul>
			<a href="/language-teachers?typeoftutor=tutor" class="card__text py-3"><?= get_string('viewalltutors','theme_lonet') ?> <img src="<?= $CFG->wwwroot ?>/theme/lonet/pix/RightIcon.png"></a>
		  </div>
		  <div class="card__image card__image--river"></div>
		</div>
	  </li>
	  <li class="cards__item">
		<div class="card">
		  <div class="card__content">
			<div class="card__title"><?= get_string('langtrainers','theme_lonet') ?></div>
			<ul>
			<li><?= get_string('langtrainers1','theme_lonet') ?></li>
			<li class="py-3"><?= get_string('langtrainers2','theme_lonet') ?></li>
			<li><?= get_string('langtrainers3','theme_lonet') ?></li>
			</ul>
			<a href="/language-teachers?typeoftutor=trainer" class="card__text py-3"><?= get_string('viewalltrainers','theme_lonet') ?> <img src="<?= $CFG->wwwroot ?>/theme/lonet/pix/RightIcon.png"></a>
		  </div>
		  <div class="card__image card__image--record"></div>
		</div>
	  </li>
	</ul>
	</div>   
	<!---------------------language flags--------------------------------------->
	<?php $teachlanguages = language::get_all_with_teachers();?>
	<div style="padding:64px 112px;background:#FFFFFF;">
	<h3 class="lflagtitle"><?= get_string('startlearning','theme_lonet') ?></h3>
	<div class="lflagboxs">
		<?php foreach($teachlanguages as $singlelang) {
		 $url2 = language::get_full_url($singlelang);	
		?>
			<div class="language-option">
				<a href="<?= $url2 ?>"><img src="<?= $CFG->wwwroot ?>/theme/lonet/pix/flag/<?= $singlelang->code ?>.png" alt="English" width="60" height="60">
				<span><?= $singlelang->name ?></span></a>
			</div>
		<?php } ?>
    </div>	
    </div>	
	<!---------------------Let's talk------------------------------------------->
	<?php $checksvg = '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25" fill="none">
  <path d="M9.58333 13L11.5278 14.9444L15.4167 11.0556M21.25 13C21.25 17.8325 17.3325 21.75 12.5 21.75C7.66751 21.75 3.75 17.8325 3.75 13C3.75 8.16751 7.66751 4.25 12.5 4.25C17.3325 4.25 21.25 8.16751 21.25 13Z" stroke="#CE1369" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
</svg>'; ?>
	<div class="letstalk">
	<h3><?= get_string('meetcreator','theme_lonet') ?></h3>
	<p class="text-center mb-0 talkpoint"><?= get_string('meetcreatorp1','theme_lonet') ?></p>
	<p class="text-center mb-0 talkpoint"><?= get_string('meetcreatorp2','theme_lonet') ?></p>
	<div class="contentbox">
	<div class="leftbox mb-5">
		<h4><span style="font-weight:700;font-size: 32px;"><?= get_string('imkristine','theme_lonet') ?>,</span></h4>
		<p style="margin-bottom:24px;"><?= get_string('aboutkristine','theme_lonet') ?></p>
		<p class="heretohelptext">Unsure where to start? I'm here to help!</p>
		<ul class="ml-0 mb-0">
			<li><?= $checksvg ?> <?= get_string('chooserighttutor','theme_lonet') ?></li>
			<li class="addpadding"><?= $checksvg ?> <?= get_string('motivatedlearner','theme_lonet') ?></li>
			<li><?= $checksvg ?> <?= get_string('friendlypolicy','theme_lonet') ?></li>
		</ul>
		<p class="journeytogether mb-0"><?= get_string('journeytogether','theme_lonet')?></p>
		<a href="<?= $CFG->wwwroot?>/language-tutor-consultation" class="bookconsultbtn"><?= get_string('bookaconsult','theme_lonet') ?> <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
  <path d="M14.9333 10.1833C14.8937 10.081 14.8342 9.98752 14.7583 9.90826L10.5917 5.7416C10.514 5.6639 10.4217 5.60226 10.3202 5.56021C10.2187 5.51816 10.1099 5.49652 10 5.49652C9.77808 5.49652 9.56525 5.58468 9.40833 5.7416C9.33063 5.8193 9.269 5.91154 9.22695 6.01306C9.1849 6.11457 9.16326 6.22338 9.16326 6.33326C9.16326 6.55518 9.25141 6.76801 9.40833 6.92493L12.1583 9.6666H5.83333C5.61232 9.6666 5.40036 9.75439 5.24408 9.91068C5.0878 10.067 5 10.2789 5 10.4999C5 10.7209 5.0878 10.9329 5.24408 11.0892C5.40036 11.2455 5.61232 11.3333 5.83333 11.3333H12.1583L9.40833 14.0749C9.33023 14.1524 9.26823 14.2446 9.22592 14.3461C9.18362 14.4477 9.16183 14.5566 9.16183 14.6666C9.16183 14.7766 9.18362 14.8855 9.22592 14.9871C9.26823 15.0886 9.33023 15.1808 9.40833 15.2583C9.4858 15.3364 9.57797 15.3984 9.67952 15.4407C9.78107 15.483 9.88999 15.5048 10 15.5048C10.11 15.5048 10.2189 15.483 10.3205 15.4407C10.422 15.3984 10.5142 15.3364 10.5917 15.2583L14.7583 11.0916C14.8342 11.0123 14.8937 10.9189 14.9333 10.8166C15.0167 10.6137 15.0167 10.3861 14.9333 10.1833Z" fill="white"/>
</svg></a>
	</div>
	<div class="rightbox">
	<img src="<?= $CFG->wwwroot ?>/theme/lonet/pix/kristine.png">
	</div>
	</div>
	</div>
   <?php //require_once(dirname(__FILE__).'/_featured.php'); ?>
   <?php require_once(dirname(__FILE__).'/_services.php'); ?>
   <?php require_once(dirname(__FILE__).'/_aboutus.php'); ?>
   
   <div id="page-content" class="row-fluid" style="display: none;">
      <div class="container-fluid">
         <div id="region-main-box" class="<?php echo $regionmainbox; ?>">
            <div class="row-fluid">
               <section id="region-main" class="<?php echo $regionmain; ?>">
                  <?php
                     //echo $OUTPUT->course_content_header();
                     echo $OUTPUT->main_content();
                     //echo $OUTPUT->course_content_footer();
                  ?>
               </section>
            </div>
         </div>
      </div>
   </div>
   <!--------------------------------------------Book call--------------------------------->
	<div class="bookcall">
		<h3><?= get_string('lonetwork','theme_lonet') ?></h3>
		<div class="bookcallcontainer">
		<div class="findmatch">
			<div class="title"><?= get_string('findmatch','theme_lonet') ?></div>
			<div class="subtitle"><?= get_string('picklang','theme_lonet') ?></div>
			<div class="circle-container">
				<div class="circle">1</div>
				<div class="extra-text"><?= get_string('getexcited','theme_lonet') ?></div>
			</div>
		</div>
		<div class="pickdate">
			<div class="title"><?= get_string('bookcall','theme_lonet') ?></div>
			<div class="subtitle"><?= get_string('pickdate','theme_lonet') ?></div>
			<div class="circle-container">
				<div class="circle">2</div>
				<div class="extra-text"><?= get_string('make1step','theme_lonet') ?></div>
			</div>
		</div>
		<div class="connect">
			<div class="title"><?= get_string('getconnect','theme_lonet') ?></div>
			<div class="subtitle"><?= get_string('meetonline','theme_lonet') ?></div>
			<div class="circle-container">
				<div class="circle">3</div>
				<div class="extra-text"><?= get_string('transformfuture','theme_lonet') ?></div>
			</div>
		</div>
		</div>	
	</div>
	<!----------------------------------------------------Our customer say------------------------------------------>
	<div class="ourcustomersay" style="background:#FFF;">
	<div class="contentbox">
	<p>Our customers say<span class="px-2 excel">Excellent</span><img src="<?= $CFG->wwwroot ?>/theme/lonet/pix/trustpilot/45stars.svg"></p>
	<p class="text-center"><span class="outof">4.3</span> out of 5 &nbsp;&nbsp;<img src="<?= $CFG->wwwroot ?>/theme/lonet/pix/trustpilot/star.svg" style="vertical-align:baseline">Trustpilot</p>
	</div>
	</div>
	<!---------------------language flags--------------------------------------->
	<?php $teachlanguages = language::get_all_with_teachers();?>
	<div style="padding:64px 112px;background:#FFFFFF;">
	<h3 class="lflagtitle"><?= get_string('startlearning','theme_lonet') ?></h3>
	<div class="lflagboxs">
		<?php foreach($teachlanguages as $singlelang) {
		 $url2 = language::get_full_url($singlelang);	
		?>
			<div class="language-option">
				<a href="<?= $url2 ?>"><img src="<?= $CFG->wwwroot ?>/theme/lonet/pix/flag/<?= $singlelang->code ?>.png" alt="English" width="60" height="60">
				<span><?= $singlelang->name ?></span></a>
			</div>
		<?php } ?>
    </div>	
    </div>	
	<!---------------------------------------------For coaches,trainer------------------------>
	<div class="fortutor">
		<h3><?= get_string('fortutor','theme_lonet') ?></h3>
		<div class="contentbox">
		<div class="leftbox mb-5" style="z-index:10;">
			<p class="whychoose"><?= get_string('whychoose','theme_lonet') ?></p>
			<p class="joincommunity">We are a <b>purpose-oriented</b> and most <b>educators-friendly</b> online space. Join us on the mission to <b>inspire, educate, and increase well-being.</b></p>
            <ul class="ml-0">
                <li><?= $checksvg ?> No commission for tutors</li>
                <li class="addpadding"><?= $checksvg ?> Motivated learners</li>
                <li><?= $checksvg ?> Tutor-friendly policy</li>
            </ul>
			<a href="/best-language-platform-for-tutors-and-coaches" class="btn seebenifit">See benefits</a>
            <a href="/login/signup.php" class="btn apply">Apply</a>
		</div>
		<div class="rightbox">
		<img src="<?= $CFG->wwwroot ?>/theme/lonet/pix/fortutor.png">
		</div>
		</div>
	</div>
	<div class="suboverrideimg" style="margin-top:-275px;right:33px;z-index:1;">
	<img src="<?= $CFG->wwwroot ?>/theme/lonet/pix/fortutor_loading.png">
	</div>
	<!---------------------------------------------------Trustpilot review---------------------------------------->
	<div class="trustpilot_container">
	<h3><?= get_string('studentsays','theme_lonet') ?></h3>
    <div class="reviewcards">
		<div class="review-card">
			<div class="review-header">
				<div class="stars"><img src="<?= $CFG->wwwroot ?>/theme/lonet/pix/trustpilot/5stars.svg"></div>
				<div class="verified"><img src="<?= $CFG->wwwroot ?>/theme/lonet/pix/trustpilot/verified.svg"></div>
			</div>
			<div class="review-title">Experience was good with teachers…</div>
			<div class="review-content" data-toggle="tooltip" title="Experience was good with teachers Sintija & Jevgenija the have great Teaching methods about Ms Christina helpful 24/24 This is what prompted me to think of studying another language with Lonet.academy. I wish good luck to everyone ✌🏽">
				Experience was good with teachers Sintija & Jevgenija the have great Teaching methods about...
			</div>
			<div class="review-footer">
				<div class="review-author">AMINE AOULI</div>
				<div class="review-date">&nbsp;November, 2023</div>
			</div>
		</div>
		<div class="review-card">
			<div class="review-header">
				<div class="stars"><img src="<?= $CFG->wwwroot ?>/theme/lonet/pix/trustpilot/5stars.svg"></div>
				<div class="verified"><img src="<?= $CFG->wwwroot ?>/theme/lonet/pix/trustpilot/verified.svg"></div>
			</div>
			<div class="review-title">User friendly</div>
			<div class="review-content" data-toggle="tooltip" title="It is great and easy, user friendly platform where I can find exactly what I need">
				It is great and easy, user friendly platform where I can find exactly what I need
			</div>
			<div class="review-footer">
				<div class="review-author">Zane Arente Rimsa</div>
				<div class="review-date">&nbsp;November, 2023</div>
			</div>
		</div>
		<div class="review-card">
			<div class="review-header">
				<div class="stars"><img src="<?= $CFG->wwwroot ?>/theme/lonet/pix/trustpilot/5stars.svg"></div>
				<div class="verified"><img src="<?= $CFG->wwwroot ?>/theme/lonet/pix/trustpilot/verified.svg"></div>
			</div>
			<div class="review-title">THIS TEACHER ROCKS!</div>
			<div class="review-content" data-toggle="tooltip" title="THIS TEACHER ROCKS!
Following her direction will allow me to get to the ‘next level’ in speaking, writing, listening & comprehension and speech.
Ingura has second to none qualifications which takes her out of the crowd.
She is totally committed to her mission of teaching and achieving results. Ingura’s explanations are simple and clear. Her nature is kind, very patient and it is easy to engage with her.
Studying languages with Ingura is a privilege and a unique opportunity to deal with someone possessing an exquisite education and professional command of languages, grammar, history, art and much more. All this added to her ability to teach and use multiple approaches to facilitate the sessions.
In today’s hectic world, there are less people with her profile and even if it took some time to book a lesson with Ingura, it was very much worth the wait.
I have had several sessions studying with Ingura and I am extremely pleased with the experience and quick results achieved from each session.
Without hesitation, it is a good value for money. I think LONET academy is very lucky in having Ingura as a teacher. For sure I feel incredibly lucky for having her as my tutor.
Thank you so much Ingura!">
				THIS TEACHER ROCKS! Following her direction will allow me to get to the ‘next level’ in speaking, writing...
			</div>
			<div class="review-footer">
				<div class="review-author">Louise</div>
				<div class="review-date">&nbsp;August, 2023</div>
			</div>
		</div>
		<div class="review-card">
			<div class="review-header">
				<div class="stars"><img src="<?= $CFG->wwwroot ?>/theme/lonet/pix/trustpilot/5stars.svg"></div>
				<div class="verified"><img src="<?= $CFG->wwwroot ?>/theme/lonet/pix/trustpilot/verified.svg"></div>
			</div>
			<div class="review-title">Perfect for language learning</div>
			<div class="review-content" data-toggle="tooltip" title="It is a great website connecting tutors and learners all around the world. Thank you!">
				It is a great website connecting tutors and learners all around the world. Thank you!
			</div>
			<div class="review-footer">
				<div class="review-author">Polina Smirnova</div>
				<div class="review-date">&nbsp;September, 2024</div>
			</div>
		</div>
	</div>
	<div class="trustscore">
	<p>TrustScore<span class="px-1">4.4</span>Showing our 14 start reviews.</p>
	<img src="<?= $CFG->wwwroot ?>/theme/lonet/pix/trustpilot/star.svg" style="vertical-align:baseline">Trustpilot
	</div>
	</div>
	<!--------------------------------------------------get your ebook-------------------------------------------->
	<div class="ebook" style="padding:64px;">
	<div class="contentbox">
	<p>Register and get a free e-book</p>
	<p>"How to learn a language in a record time"</p>
	<a href="/login/signup.php" class="getbook">Get your e-book!</a>
	</div>
	</div>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<script type="text/javascript">
	$('[data-toggle="tooltip"]').tooltip();
	</script>
   <?php //require_once(dirname(__FILE__).'/_posts.php'); ?>
   <?php //require_once(dirname(__FILE__).'/_video.php'); ?>
   <?php require_once(dirname(__FILE__).'/_footer.php'); ?>
