<?php
use local_lonet\lesson;
use local_lonet\user;
use local_lonet\schedule;
use local_lonet\schedule_form;

require_once('../../config.php');
require_once($CFG->dirroot.'/local/lonet/lib.php');
$teacherID = optional_param('teacherid', 0, PARAM_INT);
$copylessonid = optional_param('copyof', 0, PARAM_INT);
$copyaction = optional_param('action', 0, PARAM_TEXT);
$currtab = optional_param('tab', 'indilessons', PARAM_TEXT);
require_login();
//copy grouplesson
if(!empty($copylessonid) && !empty($copylessonid)){
	$copyrecord = $DB->get_record_sql("SELECT * FROM {lonet_group_lessons} WHERE id=".$copylessonid."");
	$DB->insert_record('lonet_group_lessons', $copyrecord);
	redirect($CFG->wwwroot.'/local/lonet/lessons.php?teacherid='.$teacherID);
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && isset($_POST['Lesson'])) {
	$result = false;
	$attributes = $_POST['Lesson'];
	if ($_POST['action'] == 'save') {
		if ($attributes['id']) {
			if (lesson::get_learner_lessons($attributes['id'])) {
				if ($DB->update_record('lonet_lesson', ['id' => $attributes['id'], 'isactive' => 0])) {
					unset($attributes['id']);
					$result = $DB->insert_record('lonet_lesson', $attributes);
				}
			} else {
				$result = $DB->update_record('lonet_lesson', $attributes);
			}
		} else {
			$result = $DB->insert_record('lonet_lesson', $attributes);
		}
	} else {
		$result = $DB->update_record('lonet_lesson', ['id' => $attributes['id'], 'isactive' => 0]);
	}
	echo $result;
	exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['groupaction']) && isset($_POST['grouplesson'])) {
	$result = false;
	$attributes = $_POST['grouplesson'];
	if ($_POST['groupaction'] == 'groupsave') {
		//timezone convert
		$datearr = explode('-',$attributes['lessondate']);
		$timefromarr = explode(':',$attributes['timefrom']);
		$timetoarr = explode(':',$attributes['timeto']);
		unset($attributes['lessondate']);
		unset($attributes['timefromarr']);
		unset($attributes['timetoarr']);
		$attributes['lessondate'] = make_timestamp($datearr[0],$datearr[1],$datearr[2], 0, 0, 0, $USER->timezone, true); //dst true
		$attributes['timefrom'] = make_timestamp($datearr[0],$datearr[1],$datearr[2], $timefromarr[0], $timefromarr[1], $timefromarr[2], $USER->timezone, true); //dst true
		$attributes['timeto'] = make_timestamp($datearr[0],$datearr[1],$datearr[2], $timetoarr[0], $timetoarr[1], $timetoarr[2], $USER->timezone, true); //dst true

		if ($attributes['id']) {
			if (lesson::get_learner_group_lessons($attributes['id'])) {
				if ($DB->update_record('lonet_group_lessons', ['id' => $attributes['id'], 'isactive' => 0])) {
					unset($attributes['id']);
					$result = $DB->insert_record('lonet_group_lessons', $attributes);
				}
			} else {
				$result = $DB->update_record('lonet_group_lessons', $attributes);
			}
		} else {
			$result = $DB->insert_record('lonet_group_lessons', $attributes);
		}
	} else {
		$result = $DB->update_record('lonet_group_lessons', ['id' => $attributes['id'], 'isactive' => 0]);
	}
	echo $result;
	exit();
}

$teacherid = (isset($_GET['teacherid']) ? $_GET['teacherid'] : null);
$title = get_string('editlessons', 'local_lonet');

$PAGE->set_context(context_system::instance());
$PAGE->set_pagelayout('base');
$PAGE->set_title($title);
$PAGE->set_heading($title);
$PAGE->set_url('/local/lonet/lessons.php' . ($teacherid ? '?teacherid=' . $teacherid : ''));
$PAGE->requires->css('/local/lonet/style.css');
if ($teacherid) {
	$triallesson = $DB->get_record('lonet_lesson', ['teacherid' => $teacherid, 'istrial' => 1, 'isactive' => 1]);
	if (!$triallesson) {
		$DB->insert_record('lonet_lesson', ['teacherid' => $teacherid, 'name' => 'Discovery call', 'length' => 1800, 'istrial' => 1, 'isactive' => 1]);
	}
	$teacher = get_complete_user_data('id', $teacherid);
	profile_load_data($teacher);
	$languages = user::get_languages_from_data($teacher->profile_field_languagesteaching, true);
}

echo $OUTPUT->header(); 
?>
<script>
	$(document).ready(function() {
		$('.btn-action').click(function(e) {
			var actions = $(this).attr('data-action');
			var rowsaving = $(this).attr('data-row');
			if(actions == 'save' && rowsaving != 'alreadysave'){
				var indilessoncount = $('.indilessons tbody tr').length - 1;
				if(indilessoncount > 6){
					swal({
						title: 'Lesson limit reached',
						text: 'You\'ve reached the maximum of 6 lessons. To add more, please delete or edit existing lessons.',
						icon: 'info',
						confirmButtonText: 'Ok',
						className: 'lessonlimitreach',
						icon: '<?= $CFG->wwwroot ?>/local/lonet/pix/exclamation-circle-black.png'
					});
					return false;
				}
			}
			swal({
				title: '<?= get_string('areyousure', 'local_lonet') ?>',
				text: '', 
				icon: 'warning',
				className: 'indilessonpop',
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
					var action = $(this).attr('data-action');
					var row = $(this).parent().parent();
					if (action == 'delete' && !row.find('input[name="Lesson[id]"]').val()) {
						row.remove();
					} else {
						row.find('input[name="action"]').val(action);
						$.ajax({
							type: 'POST',
							url: '<?= $CFG->wwwroot ?>/local/lonet/lessons.php',
							dataType: 'json',
							data: row.find('input, select').serialize(),
							success: function(result){
								if (result) {
									swal(
										'<?= get_string('thankyou', 'local_lonet') ?>!',
										'<?= get_string('changessaved', 'local_lonet') ?>',
										'info'
									).then((ok) => {
										if (ok) {
											window.location.reload();
										}
									});	
								} else {
									swal('Error Occured', 'Information not updated!', 'error');
								}
							},
							error: function(xhr, ajaxOptions, thrownError){
								swal('Server Error Occured', xhr.responseText, 'error');
							}
						});
					}
				}
			});
			
		});
		
		$(document).on("click", ".btn-action-group", function(e) {
			if($(this).attr('data-action') == 'groupsave'){
				var rowcheck = $(this).parent().parent();
				var bdays = rowcheck.find('input[name="grouplesson[lessondate]"]').attr('data-blockdays');
				var sdate = rowcheck.find('input[name="grouplesson[lessondate]"]').val();
				var lname = rowcheck.find('input[name="grouplesson[lessonname]"]').val();
				var lang = rowcheck.find('select[name="grouplesson[language]"]').val();
				var pperson = rowcheck.find('input[name="grouplesson[priceperperson]"]').val();
				var maxamount = rowcheck.find('input[name="grouplesson[maxamount]"]').val();
				var timef = rowcheck.find('select[name="grouplesson[timefrom]"]').val();
				var timet = rowcheck.find('select[name="grouplesson[timeto]"]').val();
				// console.log(sdate+'-'+timef+'-'+timet+'-'+lname+'-'+lang+'-'+pperson+'-'+maxamount);
				if(sdate == "" || lname == "" || lang == undefined || pperson == "" || maxamount == "" || timef == "" || timet == ""){
					swal('<?= get_string('filldetails', 'local_lonet') ?>');
					return false;
				}
				const d = new Date(sdate);
				var day = d.getDay();
				if(day == 0){
					day = 7;
				}
				
				if(bdays.indexOf(day) != -1){
					swal({
						title: '<?= get_string('blockdayerr', 'local_lonet') ?>',
						text: '', 
						icon: 'warning',
						buttons: {
					confirm: {
						text: '<?= get_string('ok') ?>',
						value: true,
						visible: true,
						className: 'btn-success',
						closeModal: true
					}
						},
						dangerMode: true,
					}).then((isSure) => {
						if (isSure) {							
							// rowcheck.find('input[name="grouplesson[lessonname]"]').val('');
							// rowcheck.find('select[name="grouplesson[language]"]').val('');
							// rowcheck.find('input[name="grouplesson[priceperperson]"]').val('');
							// rowcheck.find('input[name="grouplesson[maxamount]"]').val('');
							rowcheck.find('input[name="grouplesson[lessondate]"]').val('');
							rowcheck.find('select[name="grouplesson[timefrom]"]').val('');
							rowcheck.find('select[name="grouplesson[timeto]"]').val('');
						}
					});
					return false;
				}//if
			}
			swal({
				title: '<?= get_string('areyousure', 'local_lonet') ?>',
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
					var action = $(this).attr('data-action');
					var gid = $(this).attr('data-grouplesson');
					var row = $(this).parent().parent();
					// if (action == 'groupdelete' && !row.find('input[name="grouplesson[id]"]').val()) {
					if (action == 'groupdelete') {
						// row.remove();
					// } else {
						row.find('input[name="groupaction"]').val(action);
						$.ajax({
							type: 'POST',
							url: '<?= $CFG->wwwroot ?>/local/lonet/deletegrouplesson.php',
							dataType: 'json',
							data: {
								id : gid,
							},
							success: function(result){
								if (result) {
									swal(
										'<?= get_string('thankyou', 'local_lonet') ?>!',
										'<?= get_string('changessaved', 'local_lonet') ?>',
										'info'
									).then((ok) => {
										if (ok) {
											window.location.reload();
										}
									});	
								} else {
									swal('Error Occured', 'Information not updated!', 'error');
								}
							},
							error: function(xhr, ajaxOptions, thrownError){
								swal('Server Error Occured', xhr.responseText, 'error');
							}
						});
					}
				}
			});
			
		});
		
		$(document).on('click', '.first.customtabs .tab', function(e) {
			$('.first.customtabs .tab').removeClass('active');
			$(this).addClass('active');
			$('.tabcontent').hide();
			var tabclass = $(this).attr('data-tab');
			$('.'+tabclass).show();
		});	
		
		 $('.indilessons .new-row-block input[type="text"],.indilessons .new-row-block input[type="number"], .indilessons .new-row-block select').on('mouseout', function(){
			var allFilled = true;
            $('.indilessons .new-row-block input[type="text"]').each(function() {
                if (!$(this).val()) {
                    allFilled = false;
                }
            });
            $('.indilessons .new-row-block input[type="number"]').each(function() {
                if (!$(this).val()) {
                    allFilled = false;
                }
            });
                      
            // Enable or disable button based on allFilled
            if (allFilled) {
                $('.indilessons .new-row-block .btnsave').prop('disabled', false);
            } else {
                $('.indilessons .new-row-block .btnsave').prop('disabled', true);
            }
		 });
	});
</script>
<style>
#region-main{
	background: #FFFFFF;
	padding: 0px !important;
}
.indilessons .inditip span,.grouplessons .inditip span{
	color: #374151;
	font-size: 18px;
	font-style: normal;
	font-weight: 700;
	line-height: 24px
}
.indilessons .inditip,.grouplessons .inditip{
	color: #374151;
	font-size: 18px;
	line-height: 24px;
	width: 780px;
	padding: 16px;
	margin: 0 auto;
	margin-top:32px !important;
	margin-bottom:32px !important;
}
.indilessons table .btn-action:not(.btnsave),.grouplessontable .actionbtns .btn{
	background: none;
	outline: none;
	border: none;
	box-shadow:none;
	text-shadow:none;
}
.indilessons table .btnsave{
	color: #FFFFFF;
    font-size: 18px;
    font-style: normal;
    font-weight: 400;
    line-height: 24px;
    padding: 12px 20px;
    justify-content: center;
    align-items: center;
    border-radius: 60px;
    border: 1px solid rgba(17, 24, 39, 0.15);
    background: #CE1369;
    box-shadow: 0px 1px 0px 0px rgba(0, 0, 0, 0.04);
    text-shadow: none;
}
.indilessons table th,.grouplessontable th{
	color: #4B5563;
	text-align: center;
	font-size: 18px;
	font-style: normal;
	font-weight: 500;
}
.indilessons table input[name="Lesson[name]"]{
	width:360px;
}
.indilessons table input[name="Lesson[name]"],.indilessons table input[name="Lesson[price]"],.indilessons table select[name="Lesson[language]"],.indilessons table select[name="Lesson[length]"]{
	color: #4B5563;
    font-size: 18px;
    font-style: normal;
    font-weight: 400;
    line-height: 24px;
    border-radius: 8px;
    border: 1px solid #E5E7EB;
    background: #FFFFFF;
    box-shadow: 0px 1px 2px 0px rgba(16, 24, 40, 0.04), 0px 1px 2px 0px rgba(16, 24, 40, 0.04);
    height: 48px !important;
    padding: 8px 12px !important;
}
.eurosign{
	color: #4B5563;
    text-align: center;
    font-size: 18px;
    font-style: normal;
    font-weight: 700;
}
.lessonlimitreach .swal-text{
	color: #374151;
	text-align: center;
	font-size: 18px;
	font-style: normal;
	font-weight: 400;
	line-height: 24px;
}
.lessonlimitreach.swal-modal,.indilessonpop.swal-modal{
	width: 592px !important;
    height: 356px !important;
    padding: 32px !important;
}
.lessonlimitreach .swal-button--confirm{
	border-radius: 60px;
    border: 1px solid #4B5563;
    background: #FFFFFF;
    box-shadow: 0px 1px 0px 0px rgba(0, 0, 0, 0.04);
    color: #4B5563;
    text-align: center;
    font-size: 18px;
    font-style: normal;
    font-weight: 400;
    line-height: 24px;
}
.lessonlimitreach .swal-title{
	padding-bottom: 6px !important;
}
.glessonrow td{
	font-size: 18px;
	text-align:center;
}
.addagrouplessonlink{
	display: inline-flex;
	align-items: center;
	color: #4B5563;
	font-size: 18px;
	font-style: normal;
	font-weight: 400;
	line-height: 24px;
	padding-top:32px;
}

</style>
	<div class="tutorsection4 px-0">
	<h3 class="my-0">Design your lessons your way</h3>
	<p class="my-0 toppara pb-0">Customize your lessons by setting the name, duration, and price.</p>
	<p class="my-0 toppara pt-0">You're in complete control of your content!</p>
	</div>
<div class="first customtabs mt-0" style="justify-content:center;">
  <div class="tab <?= ($currtab == 'indilessons') ? 'active' : '' ?>" data-tab="indilessons"><h5 class="my-0">Individual lessons</h5></div>
  <div class="hidden tab <?= ($currtab == 'grouplessons') ? 'active' : '' ?>" data-tab="grouplessons"><h5 class="my-0">Group lessons</h5></div>
  <div class="hidden tab <?= ($currtab == 'packages') ? 'active' : '' ?>" data-tab="packages"><h5 class="my-0">Packages</h5></div>
</div>
<div class="container-fluid">
	<div class="indilessons tabcontent" <?= ($currtab == 'indilessons') ? '' : 'style="display:none;"'; ?>>
	<p class="inditip"><span>Tip:</span> To make it easy for students, start by creating no more than 3 different lesson types. You can always add, remove, or update your lessons. The maximum lesson type limit is 6.</p>
	<div style="display: flex;justify-content: center;">
	<table style="border-collapse: separate;border-spacing: 12px;">
		<thead>
			<tr>
				<th><?= get_string('lessonname', 'local_lonet') ?></th>
				<th><?= get_string('language', 'local_lonet') ?></th>
				<th>
					<?= get_string('price', 'local_lonet') ?>&nbsp;
					<span>
					<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15" fill="none">
					  <path d="M8.08333 9.83333H7.5V7.5H6.91667M7.5 5.16667H7.50583M12.75 7.5C12.75 10.3995 10.3995 12.75 7.5 12.75C4.6005 12.75 2.25 10.3995 2.25 7.5C2.25 4.6005 4.6005 2.25 7.5 2.25C10.3995 2.25 12.75 4.6005 12.75 7.5Z" stroke="#4B5563" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
					</svg>
					</span>
				</th>
				<th><?= get_string('length', 'local_lonet') ?></th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach (lesson::get_by_teacherid($teacherid) as $lesson) {
			if($lesson->offer > 0){continue;}
			?>
				<tr>
					<td>
						<input type="hidden" name="action">
						<input type="hidden" name="Lesson[id]" value="<?= $lesson->id ?>">
						<input type="hidden" name="Lesson[teacherid]" value="<?= $lesson->teacherid ?>">
						<!--input type="text" name="Lesson[name]" value="<?= $lesson->name ?>" <?= (($lesson->istrial || $lesson->name == "Discovery call") ? 'disabled' : '') ?>-->
						<input type="text" name="Lesson[name]" value="<?= $lesson->name ?>">
					</td>
					<td>
						<select name="Lesson[language]" <?= (($lesson->istrial || $lesson->name == "Discovery call")  ? 'disabled' : '') ?>>
							<option></option>
							<?php foreach ($languages as $code => $name) { ?>
								<option value="<?= $code ?>" <?= ($lesson->language == $code ? 'selected' : '') ?>><?= $name ?></option>
							<?php } ?>
						</select>
					</td>
					<td>
						<b class="eurosign">&euro;</b> <input type="number" name="Lesson[price]" value="<?= $lesson->price ?>">
					</td>
					<td>
						<select name="Lesson[length]">
							<?php foreach ([30, 60, 90] as $minutes) {
								$seconds = $minutes * 60; ?>
								<option value="<?= $seconds ?>" <?= ($lesson->length == $seconds ? 'selected' : '') ?>><?= $minutes ?> min</option>
							<?php } ?>
						</select>
					</td>					
					<td>
						<button type="button" class="btn btn-success btn-action btnsave" data-action="save" data-row="alreadysave"><?= get_string('savechanges') ?></button>
						<?php if (!$lesson->istrial && $lesson->name !== "Discovery call") { ?>
							<button type="button" class="btn btn-danger btn-action" data-action="delete"><?= get_string('trashicon','local_lonet') ?></button>
						<?php } ?>
					</td>
				</tr>
			<?php } ?>
			<tr class="new-row-block">
				<td>
					<input type="hidden" name="action">
					<input type="hidden" name="Lesson[id]" value="0">
					<input type="hidden" name="Lesson[teacherid]" value="<?= $teacherid ?>">					
					<input type="text" name="Lesson[name]">
				</td>
				<td>
					<select name="Lesson[language]">
						<option></option>
						<?php foreach ($languages as $code => $name) { ?>
							<option value="<?= $code ?>" <?= ($lesson->language == $code ? 'selected' : '') ?>><?= $name ?></option>
						<?php } ?>
					</select>
				</td>
				<td>
					<b class="eurosign">&euro;</b> <input type="number" name="Lesson[price]">
				</td>
				<td>
					<select name="Lesson[length]">
						<?php foreach ([30, 60, 90] as $minutes) {
							$seconds = $minutes * 60; ?>
							<option value="<?= $seconds ?>"><?= $minutes ?> min</option>
						<?php } ?>
					</select>
				</td>
				<td>
					<button type="button" class="btn btn-success btn-action btnsave" data-action="save" disabled><?= get_string('savechanges') ?></button>
				</td>
			</tr>
		</tbody>
	</table>
	</div>
	</div>
	<!-------------------------- Group Lesson---------------------------->
	<div class="grouplessons tabcontent" <?= ($currtab == 'grouplessons') ? '' : 'style="display:none;"'; ?>>
	<!--h3><?= get_string('grouplessons', 'local_lonet') ?></h3-->
	<p class="inditip"><span>Tip:</span> The price you set for a group lesson is the price per student.</p>
	<table class="grouplessontable">
		<thead>
			<tr class="text-left">
				<th><?= get_string('lessonname', 'local_lonet') ?></th>
				<th><?= get_string('language', 'local_lonet') ?></th>
				<th class="perperson"><?= get_string('priceperperson', 'local_lonet') ?></th>
				<th class="maxamount"><?= get_string('maxlearners', 'local_lonet') ?></th>
				<th><?= get_string('date', 'local_lonet') ?></th>
				<th><?= get_string('time', 'local_lonet') ?></th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php 
				foreach (schedule::get_blocked_days($teacherid) as $schedule) {
					$weekdays = json_decode($schedule->weekdays);
				}
				foreach (lesson::get_grouplesson_by_teacherid($teacherid) as $glesson) {
					$glessontimes = lesson::get_grouplesson_times($glesson->id);
					// $lessondate = ($glesson->lessondate ? (new DateTime('now', core_date::get_user_timezone_object()))->setTimestamp($glesson->lessondate)->format('Y-m-d') : null); //causing issue
					$lessondate = ($glesson->timefrom ? (new DateTime('now', core_date::get_user_timezone_object()))->setTimestamp($glesson->timefrom)->format('Y-m-d') : null);
			?>
				<tr class="glessonrow">
				<td><?= $glesson->lessonname ?></td>
				<td><?= $name ?></td>
				<td class="perperson text-center"><?= $glesson->priceperperson ?></td>
				<td class="text-center"><?= $glesson->maxamount ?></td>
				<td><?= $lessondate; ?></td>
				<td><?= $glessontimes->timefrom ?> - &nbsp;<?= $glessontimes->timeto ?></td>
				<td class="actionbtns">
					<a href="<?= $CFG->wwwroot.'/local/lonet/addgrouplesson.php?id='.$glesson->id.'&teacherid='.$teacherid.''?>" class="btn btn-success"><?= get_string('pencilediticon','local_lonet') ?></a>
					<a href="<?= $CFG->wwwroot.'/local/lonet/lessons.php?tab=grouplessonscopyof='.$glesson->id.'&teacherid='.$teacherid.'&action=copy&tab=grouplessons'?>" class="btn btn-success"><?= get_string('copyicon','local_lonet') ?></a>			
					<?php if (!$glesson->istrial) { ?>
						<button type="button" class="btn btn-danger btn-action-group" data-grouplesson="<?= $glesson->id ?>" data-action="groupdelete"><?= get_string('trashicon','local_lonet') ?></button>
					<?php } ?>
				</td>
				</tr>
			<?php } ?>
			<tr><td colspan=7 class="text-center">
			<a href="<?= $CFG->wwwroot.'/local/lonet/addgrouplesson.php?teacherid='.$teacherid.''?>" class="addagrouplessonlink">
			<svg xmlns="http://www.w3.org/2000/svg" width="41" height="40" viewBox="0 0 41 40" fill="none">
			  <path d="M20.5 15.3333V20M20.5 20V24.6667M20.5 20H25.1667M20.5 20H15.8333M34.5 20C34.5 27.732 28.232 34 20.5 34C12.768 34 6.5 27.732 6.5 20C6.5 12.268 12.768 6 20.5 6C28.232 6 34.5 12.268 34.5 20Z" stroke="#4B5563" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
			</svg>			
			<?= get_string('addgrouplesson','local_lonet') ?></a></td></tr>
		</tbody>
	</table>
	</div>
	<!-------------------------- Packages ---------------------------->
	<div class="packages tabcontent" <?= ($currtab == 'packages') ? '' : 'style="display:none;"'; ?>>
	<!--h3><?= get_string('grouplessons', 'local_lonet') ?></h3-->
	<p class="inditip"><span>Tip:</span> The price you set for a group lesson is the price per student.</p>
	<table class="grouplessontable">
		<thead>
			<tr class="text-left">
				<th><?= get_string('lessonname', 'local_lonet') ?></th>
				<th><?= get_string('language', 'local_lonet') ?></th>
				<th class="perperson"><?= get_string('priceperperson', 'local_lonet') ?></th>
				<th class="maxamount"><?= get_string('maxlearners', 'local_lonet') ?></th>
				<th><?= get_string('date', 'local_lonet') ?></th>
				<th><?= get_string('time', 'local_lonet') ?></th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php 
				foreach (schedule::get_blocked_days($teacherid) as $schedule) {
					$weekdays = json_decode($schedule->weekdays);
				}
				foreach (lesson::get_grouplesson_by_teacherid($teacherid) as $glesson) {
					$glessontimes = lesson::get_grouplesson_times($glesson->id);
					// $lessondate = ($glesson->lessondate ? (new DateTime('now', core_date::get_user_timezone_object()))->setTimestamp($glesson->lessondate)->format('Y-m-d') : null); //causing issue
					$lessondate = ($glesson->timefrom ? (new DateTime('now', core_date::get_user_timezone_object()))->setTimestamp($glesson->timefrom)->format('Y-m-d') : null);
			?>
				<tr class="glessonrow">
				<td><?= $glesson->lessonname ?></td>
				<td><?= $name ?></td>
				<td class="perperson text-center"><?= $glesson->priceperperson ?></td>
				<td class="text-center"><?= $glesson->maxamount ?></td>
				<td><?= $lessondate; ?></td>
				<td><?= $glessontimes->timefrom ?> - &nbsp;<?= $glessontimes->timeto ?></td>
				<td class="actionbtns">
					<a href="<?= $CFG->wwwroot.'/local/lonet/addgrouplesson.php?id='.$glesson->id.'&teacherid='.$teacherid.''?>" class="btn btn-success"><?= get_string('pencilediticon','local_lonet') ?></a>
					<a href="<?= $CFG->wwwroot.'/local/lonet/lessons.php?tab=grouplessonscopyof='.$glesson->id.'&teacherid='.$teacherid.'&action=copy&tab=grouplessons'?>" class="btn btn-success"><?= get_string('copyicon','local_lonet') ?></a>			
					<?php if (!$glesson->istrial) { ?>
						<button type="button" class="btn btn-danger btn-action-group" data-grouplesson="<?= $glesson->id ?>" data-action="groupdelete"><?= get_string('trashicon','local_lonet') ?></button>
					<?php } ?>
				</td>
				</tr>
			<?php } ?>
			<tr><td colspan=7 class="text-center">
			<a href="<?= $CFG->wwwroot.'/local/lonet/addgrouplesson.php?teacherid='.$teacherid.''?>" class="addagrouplessonlink">
			<svg xmlns="http://www.w3.org/2000/svg" width="41" height="40" viewBox="0 0 41 40" fill="none">
			  <path d="M20.5 15.3333V20M20.5 20V24.6667M20.5 20H25.1667M20.5 20H15.8333M34.5 20C34.5 27.732 28.232 34 20.5 34C12.768 34 6.5 27.732 6.5 20C6.5 12.268 12.768 6 20.5 6C28.232 6 34.5 12.268 34.5 20Z" stroke="#4B5563" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
			</svg>			
			<?= get_string('addgrouplesson','local_lonet') ?></a></td></tr>
		</tbody>
	</table>
	</div>
	</br>
	</br>
	<a class="bcktoteacher" href="/teacher/<?= $teacherid ?>"><span class="fa fa-angle-left"></span>&nbsp;&nbsp;<?= get_string('backtoprofile', 'local_lonet') ?></a>
</div>

<?= $OUTPUT->footer() ?>
