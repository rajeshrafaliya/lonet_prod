<?php
use local_lonet\language;
require_once('../../config.php');
require_once($CFG->dirroot.'/local/lonet/lib.php');
global $SESSION,$USER,$PAGE;
$PAGE->set_context(context_system::instance());
$PAGE->set_pagelayout('list');
$title = 'FAQ: How to learn a language? Language tutor vs language coach';
$PAGE->set_title($title);
$PAGE->set_heading($title);
$PAGE->set_url($PAGE->url);
$PAGE->requires->css('/local/lonet/style.css?ver=1.9');
echo $OUTPUT->header();
?>
<div class="faqtopsection">
<h1 class="my-0">How to learn a language <br> with a language tutor or a language coach</h1>
<p class="my-0">Our answers to the most frequently asked questions about how to learn a language</p>
</div>
<div class="faq-circles-img" style="margin: 10px;position: absolute;width: auto;left: 64px;">
	<img src="<?= $CFG->wwwroot ?>/theme/lonet/pix/SpeechCircles.svg">
</div>
<!------------------------------------------faq container--------------------------------------->
<div class="faqcontainer faqpage" style="padding: 64px 320px;">
	<div class="faqbox">
		<h4 class="my-0"><?= get_string('faq','local_lonet') ?></h4>
		<div class="custom_accordion-body">
			<div class="custom_accordion">
				<div class="acontainer" id="acontainer_1">
				  <div class="label">How to learn a language in a record time?</div>
				  <div class="content" style="display:none;">
				  <p class="my-0">
						While many strive to learn a language quickly, <strong style="font-size: 18px !important;">we recommend focusing on the process</strong> rather than the quick results. It is important to know that language fluency is a non-specific objective. With every new step, you feel the progress, but at the same time, you need to feel more fluent.</br></br>
						There is a big part of psychology in the learning process, which makes it very personal and individual. <strong style="font-size: 18px !important;">Everyone has their motivation, style of learning, challenges, and barriers. All of them influence your pace of learning.</strong></br></br>
						We recommend working with a personal language coach who will help you understand your unique strengths, strategies, and style of learning that fits you the best. </br></br>
						Together with your language coach you will work out the best strategy and plan for you to learn a language in your record time.</br></br>			  
				  </p>
				  </div>
				</div>
				<div class="acontainer" id="acontainer_2">
				  <div class="label">How to choose the best language tutor for me?</div>
					<div class="content" style="display:none;">
						<p class="my-0">
							First, understand <strong style="font-size: 18px !important;">what is your goal</strong> in language learning. This will help you select the tutors <strong style="font-size: 18px !important;">who specialize in a specific area.</strong> For example, if your goal is to integrate into the target language society (you moved to a new country), then choose a language tutor or trainer who knows the cultural aspects of that language. They might be a native trainer or a tutor living in that country.</br></br>
							Second, read the description of the tutor's profile, reviews, and testimonials, and watch the introduction video. <strong style="font-size: 18px !important;">There should be a "click" :)))</strong> Trust your gut feeling and <strong style="font-size: 18px !important;">pay attention to what resonates with you,</strong> and which of them "clicks" with you. It is very important to choose a tutor who you like as a personality, and who you respect, understand, and trust. All these aspects are subjective and individual, and no one can give you a proper recommendation here. Listen to what people say, but more importantly, listen to yourself first.</br></br>
							The creator of Lonet, Kristine, will be happy to help you with suggestions on what might be important in your case if you <a href="https://lonet.academy/language-tutor-consultation" style="color:#6B7280;text-decoration:underline;text-underline-offset:4px;font-size:18px;">sign up for a free consultation</a> with her.</br></br>
						</p>
					</div>
				</div>
				<div class="acontainer" id="acontainer_3">
				  <div class="label">What are the best languages to learn for career opportunities?</div>
					<div class="content" style="display:none;">
						<p class="my-0">
							The best languages to learn for international business are <strong style="font-size: 18px !important;">Spanish</strong> and <strong style="font-size: 18px !important;">Mandarin Chinese.</strong> Spanish is also considered to be the best language for career opportunities in healthcare and healthcare business.</br></br>
							Best languages to learn for a career in science and engineering (after English) are <strong style="font-size: 18px !important;">German, French</strong> and <strong style="font-size: 18px !important;">Russian.</strong> They are dominant European languages in science and engineering nowadays.</br></br>
							Also, there is plenty of other career opportunities for <strong style="font-size: 18px !important;">German</strong> language speakers, in the field of: </br></br>
						</p>
						<ul style="margin-bottom: 25px;">
							<li>international law,</li>
							<li>commerce,</li>
							<li>international affairs,</li>
							<li>economics and finance,</li>
							<li>political science,</li>
							<li>philosophy,</li>
							<li>art, literature and music.</li>
						</ul>
						<p class="my-0">
							<strong style="font-size: 18px !important;">French</strong> is also a dominant language of modern telecommunications and environmental science.</br></br>
							The best languages to learn for a career in political science and diplomacy are <strong style="font-size: 18px !important;">Arabic</strong> and <strong style="font-size: 18px !important;">Russian</strong>. <strong style="font-size: 18px !important;">Russian</strong> is a language to learn if you are interested in scientific research, energy, or petroleum. Russian language skills are also highly-valued in the fields of cybersecurity and computer science, geology, mathematics and chemistry.
							Read more on our article about <a href="https://lonet.academy/blog/foreign-languages-to-learn-for-career-opportunities/" target="_blank">what language to learn after English</a>.				  
						</p>
					</div>
				</div>
				<div class="acontainer" id="acontainer_4">
				  <div class="label">How long does it take to learn a language?</div>
				  <div class="content" style="display:none;">
				  <p class="my-0">
					It is very individual. Several factors influence your pace of language learning. They are:</br></br>
					- your previous experience and other language skills (if you are a multi-lingual already), </br>
					- your motivation (your internal/intrinsic driver), </br>
					- your availability (how much time you can dedicate), </br>
					- your level of grit (how persistent and consistent you are), </br>
					- your choice of material, </br>
					- style of learning, </br>
					- successful strategy </br>
					- and support (a faithful language tutor and/or trainer or coach to support you).
					</br></br>
					In practice, it may take <strong style="font-size: 18px !important;">from 2 to 6 months to be able to converse</strong> in the language. <strong style="font-size: 18px !important;">From 6 months to 2 years start reading literature/books</strong> in the target language. <strong style="font-size: 18px !important;">From 1 year to 2 years to get to a stable B2 level (intermediate)</strong>, being able to speak, understand, and discuss general topics (from the weather and interests to news and technology).
					A lot depends on empowering support! To learn a language quickly, and efficiently and to enjoy the process, we recommend hiring a great language coach and/or tutor or trainer. They will help you <strong style="font-size: 18px !important;">set a SMART goal, work out a successful strategy and plan</strong>, and support you on the journey.</br></br>
					Check the Lonet selected <a href="/language-teachers?typeoftutor=tutor">best language tutors</a>, <a href="/language-teachers?typeoftutor=coach">language coaches</a>, and <a href="/language-teachers?typeoftutor=trainer">language trainers</a> for you.</br></br>
				  </p>
				  </div>
				</div>
				<div class="acontainer" id="acontainer_5">
				  <div class="label">What is the difference between a language tutor and a language coach?</div>
				  <div class="content" style="display:none;">
				  <div style="display: flex;align-items: center;gap: 10px;">
				  <div class="leftbox">
				  <p class="my-0">A TUTOR helps to solve a PROBLEM of language skills</p></br>
				  <p class="my-0">VS</p></br>
				  <p class="my-0">A language COACH solves the PROBLEM of confidence and motivation.</p>
				  </div>
				  <div class="rightbox"><img src="<?=$CFG->wwwroot?>/theme/lonet/pix/faq1.svg"></div>
				  </div>
				</div>
				</div>				
				<div class="acontainer" id="acontainer_6">
				  <div class="label">How does a language tutor help me? How to learn a language with a tutor.</div>
				  <div class="content" style="display:none;">
				  <p class="my-0">
					Turn to a Tutor if you want to improve specific language skills:</br></br>
					📍 Work on your grammar, vocabulary, or pronunciation.</br>
					A tutor creates a learning plan that suits you best. Provides practice exercises to help you train your skills.
					</br></br>
					📍 Prepare for TOEFL, IELTS, DELE, or school exams.</br>
					A tutor helps you with test-specific strategies, practice tests, and targeted skill development: reading, listening, writing, and speaking.</br></br>
					📍 Follow the structured lesson plans, assignments, and homework, and track your progress with the guidance of a tutor.</br></br>
					📍 Get real-time feedback. The tutor corrects and guides you, giving immediate feedback on your learning progress.</br></br>
					📍 Get valuable professional advice. The tutor gives you clear instructions on what to do, what to say, what to memorize, and what to repeat.</br></br>
					Read our article about whether it is <a href="https://lonet.academy/blog/learn-language-with-tutors-online/" target="_blank">worth hiring a language tutor to learn a language</a>.
				  </p>
				</div>
				</div>				
				<div class="acontainer" id="acontainer_7">
				  <div class="label">How does a language coach help me? How to learn a language with a<br> language coach.</div>
				  <div class="content" style="display:none;">
				  <p class="my-0">
					Turn to a Language Coach if you look for confidence, motivation, empowerment, and fluency:</br></br>
					📍Get confident.</br>
					With the coaching techniques, your language coach will help you explore and discover your unique strengths and opportunities. You will build your confidence on top of that!</br></br>
					📍 Find your motivation.</br>
					Coaching will help you formulate your learning goals. Some powerful questions and visualization techniques will help you see future success. You will find what motivates you and gives you a sense of freedom.</br></br>
					📍 Create a learning strategy.</br>
					Explore your strengths, weaknesses, learning preferences, and potential barriers to language learning. The language coach will facilitate your self-discovery, empowerment, and growth mindset. You will develop a learning strategy that works best for you.</br></br>
					📍 Get fluent.</br>
					Fluency is a contradictory topic. State clearly what fluency means to you. Find out where you are now on your way to that. Set a specific fluency measurement, figure out the best ways to achieve it, and get committed.</br></br>
					📍 Develop a powerful learning mindset.</br>
					Integrate your language skills into your daily life, and identify the best opportunities for language practice. Develop a successful learning routine. Explore the power of habit and reflection.</br></br>
				  </p>
				</div>
				</div>
			</div>
			<div style="width: 100%;text-align: center; margin-top: 32px;display:none"><button id="loadMoreBtn" onclick="loadMore()">Load More</button></div>
		</div>
	</div>
</div>
<div class="suboverrideimg contactsuboverride" style="margin-top:-80px;width:auto;right:0;">
	<img src="<?= $CFG->wwwroot ?>/theme/lonet/pix/suboverride.png">
</div>
<!-----------------------------------------------------Ready to start--------------------------------->
<div class="findmatchcontainer faq">
	<h3 class="my-0">Ready to start?</h3>
	<div class="findbestmatch">
		<h5 style="color: #FFFFFF;text-align: center;font-size: 24px;font-style: normal;font-weight: 700;line-height: normal;">Find your best match</h5>
		<div class="dropdown">
		<button class="dropdown-button" onclick="findtoggleDropdown()">Choose language 
		<!--img class="cdown hidden" src="<?= $CFG->wwwroot ?>/theme/lonet/pix/cheveron-down.png" alt="" />
		<img class="cup hidden" src="<?= $CFG->wwwroot ?>/theme/lonet/pix/cheveron-up.png" alt="" /-->
		</button>
		<div class="dropdown-content" id="dropdownMenu">
		<ul>
		<?php
		$langs = language::get_all_with_teachers();
		foreach ($langs as $value) {
			$urll = language::get_full_url($value);
			echo '<li><a href="'.$urll.'"><img src="'.$CFG->wwwroot.'/theme/lonet/pix/flag/'.$value->code.'.png" alt="'.$value->name.' flag" width="26"> '.$value->name.'</a></li>';
		}
		?>
		</ul>
		</div>
		</div>
	</div>
</div>
<?php
echo $OUTPUT->footer();


