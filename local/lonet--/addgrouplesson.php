<?php
use local_lonet\lesson;
use local_lonet\user;
use local_lonet\schedule;
use local_lonet\schedule_form;

require_once('../../config.php');
require_once($CFG->dirroot.'/local/lonet/lib.php');
$lid = optional_param('id', 0, PARAM_INT);
require_login();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['groupaction']) && isset($_POST['grouplesson'])) {
	// print_object($_POST);die;
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
		$attributes['lesson_desc'] = $attributes['desclesson'];
		$attributes['whatlearn'] = $attributes['whatlearn'];
		$attributes['levelteach'] = json_encode($attributes['level']);
		$attributes['ageteach'] = json_encode($attributes['ageteach']);
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
if(!is_siteadmin()){
	if($teacherid !== $USER->id){
		print_error("You are not allowed to edit other teachers lesson.");
	}
}
$lessondata = lesson::get_grouplesson_by_id($lid);
$title = get_string('addgrouplesson', 'local_lonet');
$PAGE->set_context(context_system::instance());
$PAGE->set_pagelayout('base');
$PAGE->set_title($title);
$PAGE->set_heading($title);
$PAGE->set_url('/local/lonet/addgrouplesson.php' . ($teacherid ? '?teacherid=' . $teacherid : ''));
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
echo $OUTPUT->heading(get_string('addgrouplesson','local_lonet'));
?>
 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.3.2/ckeditor.js" ></script>
<script>
	$(document).ready(function() {
		$(document).on("click", ".btn-action-group", function(e) {
			if($(this).attr('data-action') == 'groupsave'){
				// var rowcheck = $(this).parent().parent();
				var bdays = $('input[name="grouplesson[lessondate]"]').attr('data-blockdays');
				var sdate = $('input[name="grouplesson[lessondate]"]').val();
				var lname = $('input[name="grouplesson[lessonname]"]').val();
				var lang = $('select[name="grouplesson[language]"]').val();
				var pperson = $('input[name="grouplesson[priceperperson]"]').val();
				var maxamount = $('input[name="grouplesson[maxamount]"]').val();
				var minamount = $('input[name="grouplesson[minamount]"]').val();
				var timef = $('select[name="grouplesson[timefrom]"]').val();
				var timet = $('select[name="grouplesson[timeto]"]').val();
				// var desclesson = $('textarea[name="grouplesson[desclesson]"]').val();
				var desclesson = CKEDITOR.instances.desclesson.getData();
				// var whatlearn = $('textarea[name="grouplesson[whatlearn]"]').val();
				var whatlearn = CKEDITOR.instances.whatlearn.getData();
				var levelteach = $('select[name="grouplesson[levelteach]"]').val();
				var ageteach = $('select[name="grouplesson[ageteach]"]').val();
				// console.log(sdate+'-'+timef+'-'+timet+'-'+lname+'-'+lang+'-'+pperson+'-'+maxamount);
				if(sdate == "" || lname == "" || lang == undefined || pperson == "" || maxamount == "" || minamount == "" || timef == "" || timet == ""  || desclesson == ""  || whatlearn == ""){	
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
							// $('input[name="grouplesson[lessonname]"]').val('');
							// $('select[name="grouplesson[language]"]').val('');
							// $('input[name="grouplesson[priceperperson]"]').val('');
							// $('input[name="grouplesson[maxamount]"]').val('');
							$('input[name="grouplesson[lessondate]"]').val('');
							$('select[name="grouplesson[timefrom]"]').val('');
							$('select[name="grouplesson[timeto]"]').val('');
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
					var row = $(this).parent().parent();
					if (action == 'groupdelete' && !row.find('input[name="grouplesson[id]"]').val()) {
						row.remove();
					} else {
						row.find('input[name="groupaction"]').val(action);
						CKEDITOR.instances.desclesson.updateElement();
						CKEDITOR.instances.whatlearn.updateElement();
						$.ajax({
							type: 'POST',
							url: '<?= $CFG->wwwroot ?>/local/lonet/addgrouplesson.php',
							dataType: 'json',
							data: $('input, select, textarea').serialize(),
							success: function(result){
								if (result) {
									swal(
										'<?= get_string('thankyou', 'local_lonet') ?>!',
										'<?= get_string('changessaved', 'local_lonet') ?>',
										'info'
									).then((ok) => {
										if (ok) {
											// window.location.reload();
											window.location = '/local/lonet/lessons.php?teacherid=<?=$teacherid?>';
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
		var editor_config = {
			toolbar: [
				{name: 'basicstyles', items: ['Bold','Italic','Underline','Strike','-','RemoveFormat']},
				{name: 'format', items: ['Format']},
				{name: 'paragraph', items: ['Indent','Outdent','-','BulletedList','NumberedList']},
				{name: 'link', items: ['Link','Unlink']},
			{name: 'undo', items: ['Undo','Redo']},
			{ name: 'styles' },
		{ name: 'colors' },
			],

		};

		CKEDITOR.replace('desclesson', editor_config );
		CKEDITOR.replace('whatlearn', editor_config );
	});
</script>
<?php
	foreach (schedule::get_blocked_days($teacherid) as $schedule) {
		$weekdays = json_decode($schedule->weekdays);
	}
		$lessonname = '';
		$llang = '';
		$lpriceperperson = '';
		$lmaxamount = '';
		$lminamount = '';
		$lessondate = '';
		$lesson_desc = '';
		$whatlearn = '';
	if(!empty($lid)){
		$lessonname = $lessondata->name;
		$llang = $lessondata->language ;
		$lpriceperperson = $lessondata->priceperperson;
		$lmaxamount = $lessondata->maxamount ;
		$lminamount = $lessondata->minamount ;
		$glessontimes = lesson::get_grouplesson_times($lid);
		$lessondate = ($lessondata->timefrom ? (new DateTime('now', core_date::get_user_timezone_object()))->setTimestamp($lessondata->timefrom)->format('Y-m-d') : null);
		$lesson_desc = $lessondata->lesson_desc;
		$whatlearn = $lessondata->whatlearn;
	}
?>
<div class="container-fluid">
<form action="" method="get" class="grouplessonform">
<input type="hidden" name="groupaction">
<input type="hidden" name="grouplesson[id]" value="<?= $lid ?>">
<input type="hidden" name="grouplesson[teacherid]" value="<?= $teacherid ?>">	
  <div class="form-grouplesson">
    <label for="lessonname"><?= get_string('lessonname', 'local_lonet') ?></label>
   <input type="text" name="grouplesson[lessonname]" id="lessonname" value="<?= $lessonname ?>">
  </div>
  <div class="form-grouplesson">
    <label for="language"><?= get_string('language', 'local_lonet') ?></label>
	<select id="language" name="grouplesson[language]">
		<option></option>
		<?php foreach ($languages as $code => $name) { ?>
			<option value="<?= $code ?>" <?= ($llang== $code ? 'selected' : '') ?>><?= $name ?></option>
		<?php } ?>
	</select>
  </div>
  <div class="form-grouplesson">
    <label for="priceperperson"><?= get_string('price', 'local_lonet') ?>(<b>&euro;</b>)</label>
	<input type="number" name="grouplesson[priceperperson]" id="priceperperson" value="<?= $lpriceperperson ?>">
  </div>
  <div class="form-grouplesson">
    <label for="maxamount"><?= get_string('maxamountstudent', 'local_lonet') ?></label>
	<input type="number" name="grouplesson[maxamount]" value="<?= $lmaxamount ?>">
  </div>
   <div class="form-grouplesson">
    <label for="maxamount"><?= get_string('minamountstudent', 'local_lonet') ?></label>
	<input type="number" name="grouplesson[minamount]" value="<?= $lminamount ?>">
  </div>
  <div class="form-grouplesson">
    <label for="lessondate"><?= get_string('date', 'local_lonet') ?></label>
	<input type="date" name="grouplesson[lessondate]" data-blockdays= "<?= implode(',',$weekdays) ?>" id="lessondate" value="<?= $lessondate; ?>">
  </div>  
  <div class="form-grouplesson">
    <label for="timeperiod"><?= get_string('timeperiod', 'local_lonet') ?></label>
	<?php if(empty($lid)) { ?>
	<?= schedule::getTimeInput('grouplesson[timefrom]', null) ?> - &nbsp;	<?= schedule::getTimeInput('grouplesson[timeto]', null) ?>
	<?php } else{ ?>
	<?= schedule::getTimeInput('grouplesson[timefrom]', $glessontimes->timefrom) ?> - &nbsp;<?= schedule::getTimeInput('grouplesson[timeto]', $glessontimes->timeto) ?>
	<?php } ?>
  </div>  
  <div class="form-grouplesson desclessondiv">
    <label for="desclesson"><?= get_string('desclesson', 'local_lonet') ?></label>
	<textarea id="desclesson" class="form-control mt-2" name="grouplesson[desclesson]" rows=5 cols=80><?=$lesson_desc ?></textarea>
  </div>  
  <div class="form-grouplesson whatlearndiv">
    <label for="whatlearn"><?= get_string('whatlearn', 'local_lonet') ?></label>
	<textarea id="whatlearn" class="form-control mt-2" name="grouplesson[whatlearn]" rows=5 cols=80><?=$whatlearn ?></textarea>
  </div>  
  <div class="form-grouplesson level">
    <label for="level"><?= get_string('levelteach', 'local_lonet') ?></label>
	<?php $levelteach = (empty($lessondata->levelteach) ? [] : json_decode($lessondata->levelteach)); ?>
	<select id="level" name="grouplesson[level][]" class="mt-2" multiple>
		<?php foreach (lesson::get_grouplesson_levels() as $value) {?>
			<option value="<?= $value->id ?>" <?= (in_array($value->id, $levelteach) ? 'selected' : '') ?>><?= $value->data ?></option>
		<?php } ?>
	</select>
  </div>
  <div class="form-grouplesson ageofstudents">
    <label for="ageofstudents"><?= get_string('agestudentteach', 'local_lonet') ?></label>
	<?php $ageteach = (empty($lessondata->ageteach) ? [] : json_decode($lessondata->ageteach)); ?>
	<select name="grouplesson[ageteach][]" multiple class="mt-2">
		<?php foreach (lesson::get_grouplesson_agestudents() as $value) {?>
			<option value="<?= $value->id ?>" <?= (in_array($value->id, $ageteach) ? 'selected' : '') ?> ><?= $value->data ?></option>
		<?php } ?>
	</select>
  </div>  
  <div class="form-grouplesson">
    <button type="button" class="btn btn-success btn-action-group" data-action="groupsave"><?= get_string('savechanges') ?></button>
  </div>
</form>

	<br>
	<a class="btn btn-success" href="/teacher/<?= $teacherid ?>"><span class="fa fa-angle-left"></span>&nbsp;&nbsp;<?= get_string('backtoteacherprofile', 'local_lonet') ?></a>
</div>
<br>
<style>form.form-grouplesson {
    display: table;
	width:100%;
}

div.form-grouplesson {
    display: table-row;
}

label,
input {
    display: table-cell;
    margin-bottom: 10px;
}

label {
    padding-right: 10px;
}
</style>
<?= $OUTPUT->footer() ?>
