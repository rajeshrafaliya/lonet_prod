<?php
use local_lonet\order;
use local_lonet\category;
use local_lonet\teacher;
use local_lonet\user;
use local_lonet\language;
global $DB;
global $CFG;
global $OUTPUT;
global $USER;

if( isset( $_POST['totallesson']  )  ){
    $optionTeacher = $_POST['totallesson'];
    $urlredirects = $_POST['urlredirects'];
    $order_data = [
            'userid' => $USER->id,
            'fieldname' => 'learningchallenge',
            'fielddata' =>$optionTeacher,
        ];
    $aclrecord = $DB->get_record('lonet_userdata', array('userid'=>$USER->id,'fieldname'=>'learningchallenge'));
    if (empty($aclrecord)) {
        $order_id = $DB->insert_record('lonet_userdata', $order_data);
        header("Location: $urlredirects");
    }else{
        $rec = new stdClass();
        $rec->id = $aclrecord->id;
        $rec->fieldname = 'learningchallenge';
        $rec->fielddata   = $optionTeacher;
        $DB->update_record('lonet_userdata', $rec);
        header("Location: $urlredirects");   
    }
}

?>

<style>
.nav-collapse.in {
    padding-bottom: 75px;
    overflow: visible;
}
</style>

<script>
	$(document).ready(function() {
		var nothingFound = null;

        function handleSearch(e) {
            let searchContainer = $(this).parents('.container-search');
            let nothingFoundEl = searchContainer.find('.nothing-found');
            let searchForm = searchContainer.find('.search-form');
            if (nothingFound) {
                clearTimeout(nothingFound);
                nothingFoundEl.fadeOut();
            }
            if (e.type == 'submit' || (e.type == 'keyup' && e.keyCode == 13)) {
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: '/local/lonet/search.php',
                    dataType: 'json',
                    data: searchForm.serialize(),
                    success: function(result){
                        if (result && result.url) {
                            window.location.href = result.url;
                        } else {
                            nothingFoundEl.fadeIn();
                            nothingFound = setTimeout(function() { nothingFoundEl.fadeOut() }, 3 * 1000);
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError){
                        nothingFoundEl.fadeIn();
                        nothingFound = setTimeout(function() { nothingFoundEl.fadeOut() }, 3 * 1000);
                        $('html, body').animate({
                            scrollTop: $(".course_container").offset().top - 250
                        }, 1000);
                    }
                });
            }
        }
        
        $('.search-form').submit(handleSearch);
        $('.search-box').keyup(handleSearch);
    });
</script>
<!-- Start header top section -->
<div class="top-section <?= (isloggedin() && !isguestuser() ? 'logged-in' : '') ?>">
	 <div class="container-fluid">
			<div class="row-fluid">
				 <div class="pull-left social-icons">
						<?php if($hasfacebook) { ?>
						<a href="<?php echo $hasfacebook; ?>" target="_blank" >
						<i class="fa fa-facebook" aria-hidden="true"></i>
						</a>
						<?php }else { ?>
						<?php } ?>
						<?php if($hastwitter) { ?>
						<a href="<?php echo $hastwitter; ?>" target="_blank" >
						<i class="fa fa-twitter" aria-hidden="true"></i>
						</a>
						<?php }else { ?>
						<?php } ?>
						<?php if($hasgoogleplus) { ?>
						<a href="<?php echo $hasgoogleplus; ?>" target="_blank" >
						<i class="fa fa-google-plus" aria-hidden="true"></i>
						</a>
						<?php }else { ?>
						<?php } ?>
				 </div>
				 <div class="pull-left contact-topbar">
						<?php if($timing) { ?>
				<span>
					<i class="fa fa-clock-o"></i> <?php echo $timing ?>
				</span>
						<?php } ?>
						<?php if($email) { ?>
				<!--<span class="<?= (isloggedin() && !isguestuser() ? 'hidden-xs' : '') ?>">-->
					<span class="hidden-xs">
					<i class="fa fa-envelope"></i><a class="text-light" href="mailto:<?php echo $email ?>"> <?php echo $email ?></a>
				</span>
						<?php } ?>
				 </div>
				<!--div class="col-sm-5 text-center">
				 	<span class="message-topbar hidden-xs">
                        <?php //if (!isloggedin() || isguestuser()) {?>    
	                    <a class="login cd-popup-trigger" href="<?php// echo new moodle_url('/login/index.php', array('sesskey'=>sesskey())) ?> "><?php //echo  get_string('topheadermessage', 'local_lonet') ?></a>
                       <?php// } else {?>
                        <a href="javascript:void(0)"  data-toggle="modal" data-target="#exampleModal"><?= get_string('topheadermessage', 'local_lonet') ?></a>
                       <?php// } ?>
                        </span>
				 </div-->
				 <div class="loginsection pull-right">
				 	<span class="site-name-full"><?= $this->lang_menu() ?></span> <!--hidden-xs-->
			<?php if (isloggedin() && !isguestuser()) {
				echo $OUTPUT->user_menu();
			} else { ?>
				<!--<span class="site-name-full hidden-xs"><?= $SITE->fullname ?></span>-->
				<?php require_once(dirname(__FILE__).'/loginpopup.php');
			} ?>
				 </div>
				 <!-- end div .loginsection -->
				 <div class="clearfix"></div>
			</div>
	 </div>
</div>
<!-- End header top section -->

<div class="topshadow-con hidden-xs">
	 <div class="topshadow"></div>
</div>
<?php 
$language = explode('_', current_language())[0];
$grouplessonlink = language::get_grouplesson_page_url($language);
?>
<!-- Start header custom section -->
<div class="custom-section">
	<div class="container-fluid">
		<div class="pull-left">
			<a class="logo" href="<?php echo $CFG->wwwroot;?>"><img src="<?= $OUTPUT->get_compact_logo_url(200, 75)->out(false) ?>" width="100%" alt="<?= $SITE->fullname ?>"></a>
		</div>
		<header role="banner" class="navbar <?php echo $html->navbarclass ?> pull-right container-search">
			<nav role="navigation" class="navbar-inner">
			<span class="badge badge-teacher pull-left" style="text-transform: uppercase;position: absolute;margin-left: -25px;"><?= get_string('badge_new','local_lonet') ?></span>
			<a class="btn btn-success btn-lonet btn-sm pull-left" style="margin-top: 13px;margin-bottom: 13px;text-transform: initial;" href="<?= $grouplessonlink ?>" target="_blank" rel="noopener noreferrer"><?= get_string('grouplessons','local_lonet') ?></a>	
				<form action="<?= $CFG->wwwroot ?>/local/lonet/search.php" method="post" class="search-form menu-search-box">
					<span class="nothing-found" style="display: none; font-size: 12px; color: grey; padding-right: 5px;"><?= get_string('noresults') ?></span>
					<input type="text" name="content" class="form-control search-box awesomplete" data-list="<?= category::get_data_list() ?>" placeholder="<?= get_string('findlanguage', 'theme_lonet') ?>" style="<?= $language=='es' ? 'width:170px' : '' ?>;">
					<button type="submit" class="btn btn-success"><span class="fa fa-search"></span></button>
				</form>
				<?php //echo $OUTPUT->navbar_home(); ?>
				<!--<a class="brand" title="Home" href="<?= $CFG->wwwroot?>"><?= get_string('home', 'core_moodle') ?></a>-->
				<?php echo $OUTPUT->navbar_button(); ?>
				<?php //echo $OUTPUT->search_box(); ?>
				<div class="nav-collapse collapse pull-right">
					<?php echo $OUTPUT->custom_menu(); ?>
					<ul class="nav pull-right">
						<li><?php echo $OUTPUT->page_heading_menu(); ?></li>
						<?php
						if (!isloggedin()) { ?>
							<li>
								<a class="brand" href="<?= $CFG->wwwroot ?>/login/signup.php"><?= get_string('register', 'theme_lonet') ?></a>
							</li>
							<?php
						} ?>

						<?php
						if (!isloggedin() || isguestuser()) { ?>
							<li>
								<!--<i class="fa fa-sign-in" aria-hidden="true"></i>-->
								<a class="login cd-popup-trigger" href="<?php echo new moodle_url('/login/index.php', array('sesskey'=>sesskey())), get_string('login') ?> ">
									<?php echo get_string('login') ?>
								</a>
							</li>
							<?php
						} else {
							if (order::get_products()) { ?>
								<li>
									<a class="menu-shopping" href="/local/lonet/book.php"><span class="fa fa-shopping-cart"></span></a>
								</li>
								<?php
							}
							if (is_siteadmin() || user::is_bookkeeper() || user::is_seo_manager() || user::is_teacher_manager()) {
								$changed = count(teacher::get_changed()); ?>
								<li>
									<a href="/local/lonet/admin.php">Admin<?= ($changed ? ' <span class="badge badge-important">'.$changed.'</span>' : '') ?></a>
								</li>
								<?php
							}
						} ?>
						<?= $OUTPUT->navbar_plugin_output() ?>
					</ul>
				</div>
			</nav>
		</header>
		<div class="clearfix"></div>
	</div>
</div>
<!-- End header custom section -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false">
  <div class="modal-dialog" role="document">
      <form name="fromSaveModel" id="fromSaveModel"  action="#" method="post">
    <div class="modal-content">
<!--	<div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?= get_string('topheadermessage', 'local_lonet') ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
-->      
      <div class="modal-body">
          <?php
          $learningTextGoal ='';
          $learningGoals = $DB->get_record('lonet_userdata', array('userid'=>$USER->id,'fieldname'=>'learningchallenge'));
          if ($learningGoals->fielddata) {
               $learningTextGoal =  $learningGoals->fielddata;
           }
          $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
          ?>
   <div class="form-group">
   	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <label for="totallesson"><?= get_string('challenge_fieldlabel', 'local_lonet') ?></label>
    <input type="number" min="1" step="1" value="<?php echo $learningTextGoal; ?>" name="totallesson" class="form-control" id="totallesson" aria-describedby="totallesson" placeholder="" required>
    <input type="hidden" value="<?php echo $actual_link; ?>" name="urlredirects">
  </div>
      </div>
      <div class="modal-footer">
      	<div class="col-sm-10 text-left">
		<?php
		if(isloggedin()){
			echo  get_string('challenge_textlink1', 'local_lonet',$USER->id);
		}else{
			echo  get_string('challenge_textlink1', 'local_lonet',1);
		}
		?>
      	<p style="font-size:12px !important;font-weight: bold;color:#499306;"><?= get_string('challenge_textlink2', 'local_lonet') ?></p></div>
        <!--<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
        <div class="col-sm-2"><button type="button" class="btn btn-primary reserve-button teacherOption"><?= get_string('save', 'local_lonet') ?></button></div>
      </div>
    </div>
      </form>
  </div>
</div>
<script>
$(document).ready(function() {
  $('.teacherOption').on('click', function() {
        //document.forms[languageteacher].submit();
     this.form.submit()
     
  });
});
</script>
<?php
if($language == 'lv' || $language == 'ru'){
	echo '<style>
	.navbar .nav>li>a{
		padding: 43px 5px !important;
		padding-bottom: 48px !important;
	}
</style>';
}
?>