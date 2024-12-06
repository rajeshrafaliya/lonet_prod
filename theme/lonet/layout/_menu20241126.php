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
$language = explode('_', current_language())[0];
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
	<div class="headermenu">
		<div class="left w-100">
			<a href="<?= $CFG->wwwroot ?>"><img class="fb" src="<?= $CFG->wwwroot ?>/theme/lonet/pix/logo_header.png" width="70"></a>
			<?php if($language == 'en'){
				echo '<a href="/language-teachers" class="blesson">Find my teacher</a>';
				echo '<a href="/best-language-platform-for-tutors-and-coaches" class="foredu">For educators</a>';
				// echo '<a href="/how-it-works" class="howwork">How it works</a>';
				echo '<a href="/language-tutor-consultation" class="howwork">Free consultation</a>';
			} if($language == 'es'){
				echo '<a href="/profesores-online" class="blesson">Elige tu profesor</a>';
				echo '<a href="/best-language-platform-for-tutors-and-coaches" class="foredu">For educators</a>';
				// echo '<a href="/como-funciona" class="howwork">¿Cómo funciona?</a>';
				echo '<a href="/language-tutor-consultation" class="howwork">Free consultation</a>';
			} if($language == 'lv'){
				echo '<a href="/valodu-kursi" class="blesson">Izvēlies skolotāju</a>';
				echo '<a href="/best-language-platform-for-tutors-and-coaches" class="foredu">Pasniedzējiem</a>';
				// echo '<a href="/ka-tas-darbojas" class="howwork">Kā tas darbojas</a>';
				echo '<a href="/language-tutor-consultation" class="howwork">Bezmaksas konsultācija</a>';
			} if($language == 'ru'){
				echo '<a href="/repetitor" class="blesson">Выбери учителя</a>';
				echo '<a href="/best-language-platform-for-tutors-and-coaches" class="foredu">Для преподавателей</a>';
				// echo '<a href="/kak-eto-rabotayet" class="howwork">Как это работает</a>';
				echo '<a href="/language-tutor-consultation" class="howwork">Бесплатная консультация</a>';
			}
			if(is_siteadmin()){
				echo '<a href="'.$CFG->wwwroot.'/local/lonet/admin.php">Admin</a>';
			}
			?>
		</div>
		<div class="right">
			<span class="site-name-full"><?= $this->lang_menu() ?></span>
			<?php
			if (!isloggedin() || isguestuser()) { ?>
				<a class="newlogin login cd-popup-trigger" href="<?php echo new moodle_url('/login/index.php', array('sesskey'=>sesskey())), get_string('login') ?> ">
				<?php echo get_string('login') ?>
				</a>
				<?php
			}else{ ?>
				<?php 
				echo $OUTPUT->navbar_plugin_output();
				echo $OUTPUT->user_menu();
			}
			?>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false">
  <div class="modal-dialog" role="document">
      <form name="fromSaveModel" id="fromSaveModel"  action="#" method="post">
    <div class="modal-content">
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
<?php 
if(!isloggedin()){ 
	require_once(dirname(__FILE__).'/loginpopup.php');
}
?>
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