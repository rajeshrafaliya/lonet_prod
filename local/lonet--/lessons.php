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
	$triallesson = $DB->get_record('lonet_lesson', ['teacherid' => $teacherid, 'istrial' => 1]);
	if (!$triallesson) {
		$DB->insert_record('lonet_lesson', ['teacherid' => $teacherid, 'name' => 'Trial Lesson', 'length' => 1800, 'istrial' => 1]);
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
					var row = $(this).parent().parent();
					if (action == 'delete' && !row.find('input[name="Lesson[id]"]').val()) {
						row.remove();
					} else {
						row.find('input[name="action"]').val(action);
						$.ajax({
							type: 'POST',
							url: '/local/lonet/lessons.php',
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
							url: '/local/lonet/deletegrouplesson.php',
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
	});
</script>
<div class="container-fluid">
	<p><span class="fa fa-info-circle"></span> <?= get_string('lessonchangesinfo', 'local_lonet') ?></p>
	<br>
	<table>
		<thead>
			<tr>
				<th><?= get_string('lessonname', 'local_lonet') ?></th>
				<th><?= get_string('language', 'local_lonet') ?></th>
				<th><?= get_string('price', 'local_lonet') ?></th>
				<th><?= get_string('length', 'local_lonet') ?></th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach (lesson::get_by_teacherid($teacherid) as $lesson) { ?>
				<tr>
					<td>
						<input type="hidden" name="action">
						<input type="hidden" name="Lesson[id]" value="<?= $lesson->id ?>">
						<input type="hidden" name="Lesson[teacherid]" value="<?= $lesson->teacherid ?>">
						<input type="text" name="Lesson[name]" value="<?= $lesson->name ?>" <?= ($lesson->istrial ? 'disabled' : '') ?>>
					</td>
					<td>
						<select name="Lesson[language]" <?= ($lesson->istrial ? 'disabled' : '') ?>>
							<option></option>
							<?php foreach ($languages as $code => $name) { ?>
								<option value="<?= $code ?>" <?= ($lesson->language == $code ? 'selected' : '') ?>><?= $name ?></option>
							<?php } ?>
						</select>
					</td>
					<td>
						&nbsp;<b>&euro;</b> <input type="number" name="Lesson[price]" value="<?= $lesson->price ?>">
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
						<button type="button" class="btn btn-success btn-action" data-action="save"><?= get_string('savechanges') ?></button>
						<?php if (!$lesson->istrial) { ?>
							<button type="button" class="btn btn-danger btn-action" data-action="delete"><span class="fa fa-trash"></span></button>
						<?php } ?>
					</td>
				</tr>
			<?php } ?>
			<tr><td colspan=5>&nbsp;</td></tr>
			<tr>
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
					&nbsp;<b>&euro;</b> <input type="number" name="Lesson[price]">
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
					<button type="button" class="btn btn-success btn-action" data-action="save"><?= get_string('savechanges') ?></button>
				</td>
			</tr>
		</tbody>
	</table>
	<!-------------------------- Group Lesson---------------------------->
	<br>
	<h3><?= get_string('grouplessons', 'local_lonet') ?></h3>
	<table class="grouplessontable">
		<thead>
			<tr class="text-left">
				<th><?= get_string('lessonname', 'local_lonet') ?></th>
				<th><?= get_string('language', 'local_lonet') ?></th>
				<th class="perperson"><?= get_string('priceperperson', 'local_lonet') ?></th>
				<th class="maxamount"><?= get_string('maxamountstudent', 'local_lonet') ?></th>
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
				<tr>
				<td><?= $glesson->lessonname ?></td>
				<td><?= $name ?></td>
				<td class="perperson text-center"><?= $glesson->priceperperson ?></td>
				<td class="text-center"><?= $glesson->maxamount ?></td>
				<td><?= $lessondate; ?></td>
				<td><?= $glessontimes->timefrom ?> - &nbsp;<?= $glessontimes->timeto ?></td>
				<td>
					<a href="<?= $CFG->wwwroot.'/local/lonet/addgrouplesson.php?id='.$glesson->id.'&teacherid='.$teacherid.''?>" class="btn btn-success"><?= get_string('editgrouplesson','local_lonet') ?></a>
					<a href="<?= $CFG->wwwroot.'/local/lonet/lessons.php?copyof='.$glesson->id.'&teacherid='.$teacherid.'&action=copy'?>" class="btn btn-success"><?= get_string('copylesson','local_lonet') ?></a>	
					<?php if (!$glesson->istrial) { ?>
						<button type="button" class="btn btn-danger btn-action-group" data-grouplesson="<?= $glesson->id ?>" data-action="groupdelete"><span class="fa fa-trash"></span></button>
					<?php } ?>
				</td>
				</tr>
			<?php } ?>
			<tr><td colspan=5><a href="<?= $CFG->wwwroot.'/local/lonet/addgrouplesson.php?teacherid='.$teacherid.''?>" class="btn btn-success"><?= get_string('addgrouplesson','local_lonet') ?></a></td></tr>
		</tbody>
	</table>
	<br>
	<a class="btn btn-success" href="/teacher/<?= $teacherid ?>"><span class="fa fa-angle-left"></span>&nbsp;&nbsp;<?= get_string('backtoteacherprofile', 'local_lonet') ?></a>
</div>
<br>
<?= $OUTPUT->footer() ?>
