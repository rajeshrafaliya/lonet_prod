<?php
use local_lonet\order_product;
use local_lonet\schedule;
use local_lonet\schedule_form;
use local_lonet\user;

require_once('../../config.php');
require_once($CFG->dirroot.'/local/lonet/lib.php');
require_once($CFG->libdir.'/componentlib.class.php');

global $USER;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && isset($_POST['Schedule'])) {
	$result = false;
	$action = $_POST['action'];
	$attributes = $_POST['Schedule'];
	if (in_array($action, ['delete', 'unblock'])) {
		if ($DB->delete_records('lonet_schedule', ['id' => $attributes['id']])) {
			$result = true;
		}
	} else {
		if (isset($attributes['weekdays'])) {
			if ($attributes['weekdays']) {
				$attributes['weekdays'] = json_encode($attributes['weekdays']);
			}		
		} else {
			$attributes['weekdays'] = null;
		}
		foreach(['datefrom', 'dateto'] as $attribute) {
			if (isset($attributes[$attribute])) {
				if ($attributes[$attribute]) {
					$attributes[$attribute] = (new DateTime($attributes[$attribute], core_date::get_user_timezone_object()))->getTimestamp();
				}		
			} else {
				if ($action == 'block' && $attribute == 'dateto' && $attributes['datefrom']) {
					$attributes[$attribute] = $attributes['datefrom'] + 86400;
				} else {
					$attributes[$attribute] = null;
				}
			}
		}
		foreach(['timefrom', 'timeto'] as $attribute) {
			if (isset($attributes[$attribute])) {
				$attributes['isdst'] = date('I');
				if ($attributes[$attribute]) {
					$currentYear = date('Y');
					$date = (date('I') ? $currentYear.'-06-01' : $currentYear.'-12-01');
					// $date = (date('I') ? '2017-06-01' : '2017-12-01');
					$attributes[$attribute] = (new DateTime($date . ' ' . $attributes[$attribute], core_date::get_user_timezone_object()))->getTimestamp();
				}		
			} else {
				if ($action == 'block' && $attribute == 'timeto' && $attributes['timefrom']) {
					$attributes[$attribute] = $attributes['timefrom'] + 1800;
				} else {
					$attributes[$attribute] = null;
				}
			}
		}
		
		if (isset($attributes['id']) && $attributes['id']) {
			$result = $DB->update_record('lonet_schedule', $attributes);
		} else {
			$result = $DB->insert_record('lonet_schedule', $attributes);
		}

		//START SCARCITY
		if($_POST['scarcityfeature']){
			$scarcityfeature = $_POST['scarcityfeature'];
			$order_data = [
	            'userid' => $attributes['teacherid'],
	            'fieldname' => 'scarcityfeature',
	            'fielddata' => $scarcityfeature,
	        ];
	        $aclrecord = $DB->get_record('lonet_userdata', array('userid'=>$attributes['teacherid'],'fieldname'=>'scarcityfeature'));
			//if (isset($attributes['scarcityfeature']) && $attributes['scarcityfeature']) {
	        if (empty($aclrecord)) {
	        	$order_id = $DB->insert_record('lonet_userdata', $order_data);
				//$record = $DB->update_record('lonet_userdata', $order_data);
			} else {
				$rec = new stdClass();
		        $rec->id = $aclrecord->id;
		        $rec->fieldname = 'scarcityfeature';
		        $rec->fielddata = $scarcityfeature;
		        $DB->update_record('lonet_userdata', $rec);
				//$order_id = $DB->insert_record('lonet_userdata', $order_data);
			}
		}
		//END SCARCITY
	}
	echo $result;
	exit();
}

$title = get_string('schedule', 'local_lonet');

$PAGE->set_context(context_system::instance());
$PAGE->set_pagelayout('base');
$PAGE->set_title($title);
$PAGE->set_heading($title);

$week = (isset($_GET['week']) ? $_GET['week'] : 0);
$teacherid = (isset($_GET['teacherid']) ? $_GET['teacherid'] : (isset($_POST['teacherid']) ? $_POST['teacherid'] : null));
$teacher = ($teacherid ? user::get_by_id($teacherid) : $USER);

$PAGE->set_url('/local/lonet/edit.php?teacherid=' . $teacher->id);

if ($teacher) {
	$schedule = schedule::get_schedule($teacher->id);
}

$weekdays_array = [];
foreach (range(1,7) as $day) {
	$weekdays_array[$day] = get_string(strtolower(jddayofweek($day - 1, 1)), 'core_calendar');
}

$from = get_string('from', 'local_lonet');
$to = get_string('to', 'local_lonet');

echo $OUTPUT->header();
?>

<style>
	.mform .fitem div.fitemtitle {float:none; text-align:left; width:auto; margin-right:30px;}
	.mform .fitem .felement {margin-left:0; display:inline-block;}
	.form-item, .mform .fitem {display:inline-block; vertical-align:text-top; margin-left:15px;}
</style>

<script>
	$(document).ready(function() {
		$('fieldset').removeClass('hidden');
		
		$('.btn-edit').click(function(e) {
			var row = $(this).parents('.row-block');
			row.children('input, select').prop('disabled', false);
			row.children('.btn-edit, [data-action="save"]').toggle();
		});
		
		function postEdit(data, reload = true) {
			$.ajax({
				type: 'POST',
				url: '/local/lonet/edit.php',
				dataType: 'json',
				data: data,
				success: function(result){
					if (result) {
						swal(
							'<?= get_string('thankyou', 'local_lonet') ?>!',
							'<?= get_string('calendarhasbeenupdated', 'local_lonet') ?>',
							'info'
						).then((ok) => {
							if (ok) {
								if (reload) {
									window.location.reload();
								} else {
									changeWeek();
								}
							}
						});								
					} else {
						swal('<?= get_string('changenotallowed', 'local_lonet') ?>', '<?= get_string('youhavelessons', 'local_lonet') ?>', 'error');
					}
				},
				error: function(xhr, ajaxOptions, thrownError){
					swal('Server Error Occured', xhr.responseText, 'error');
				}
			});
		}
		
		$(document).on('click', '.btn-action, .btn-blockthis[data-action], .btn-unblockthis[data-action]', function(e) {
			swal({
				title: '<?= get_string('areyousure', 'local_lonet') ?>',
				text: '<?= get_string('theywillupdatecalendar', 'local_lonet') ?>', 
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
					if (action == 'save' || action == 'delete') {
						var row = $(this).parents('.row-block');
						$('#action').val(action);
						var data = $('#action, #teacherid').serialize() + '&' + row.children('input, select').serialize();
						postEdit(data);
					} else if (action == 'block' || action == 'unblock') {
						var schedule = {};
						if (action == 'block') {
							schedule.teacherid = $('#teacherid').val();
							if ($(this).parent().attr('data-datetime').length > 0) {
								var datetime = $(this).parent().attr('data-datetime').split(' ');
								schedule.datefrom = datetime[0];
								schedule.timefrom = datetime[1];
							}
							if ($(this).parent().attr('data-timestamp').length > 0) {
								schedule.timestamp = $(this).parent().attr('data-timestamp');
							}
						} else {
							schedule.id = $(this).attr('data-id');
						}
						var data = {
							action: action,
							Schedule: schedule
						};
						postEdit(data, false);
					}
				}
			});
		});
		
		function sendResponse(id, action) {
			$.ajax({
				type: 'POST',
				url: '/local/lonet/respond.php',
				dataType: 'json',            
				data: {
					id: id,
					action: action
				},
				success: function(result){
					if (result.is_success) {
						changeWeek();
						swal('Success', result.message, 'info');
					} else {
						swal('Error Occured', 'Please try again.', 'error');
					}
				},
				error: function(xhr, ajaxOptions, thrownError){
					swal('Server Error Occured', xhr.responseText, 'error');
				}
			});
		}
		
		$(document).on('click', '.btn-confirm[data-action], .btn-decline[data-action]', function(e) {
			var id = $(this).attr('data-id');
			var action = $(this).attr('data-action');
			var action_text = (action == 'notcomplete' ? '' : action);
			var role = 'teacher';
			if (action) {
				if (action == 'notcomplete' || (role == 'teacher' && (action == 'cancel' || action == 'decline'))) {						
					$('label[for="cancelreason"] > span').hide();
					$('label[for="cancelreason"] > span.' + action).show();
					$('#cancelreason').val('');
					$('#cancelreason > option').hide();
					$('#cancelreason > option.' + action).show();
					$('#id').val(id);
					$('#action').val(action);
					$('#reason-modal').modal('toggle');
				} else {
					swal({
						title: 'Are you sure' + (action_text ? ' you want to ' + action_text + ' this lesson' : '') + '?',
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
							sendResponse(id, action);
						}
					});
				}
			} else {
				swal('Error Occured', 'Please try again.', 'error');
			}
		});
		
		$('#cancelreason').change(function(e) {
			if ($(this).val() == 'other') {
				$('#cancelreason_other').prop('required', true);
				$('#cancelreason_other').slideDown();
			} else {
				$('#cancelreason_other').prop('required', false);
				$('#cancelreason_other').slideUp();
			}
		});
		
		$('#reason-form').submit(function(e) {
			e.preventDefault();
			$('#reason-modal').modal('toggle');
			$.ajax({
				type: 'POST',
				url: '/local/lonet/respond.php',
				dataType: 'json',
				data: $(this).serialize() + '&' + $('#action').serialize(),
				success: function(result){
					if (result.is_success) {
						changeWeek();
						swal('Success', result.message, 'info');
					} else {
						swal('Error Occured', 'Please try again.', 'error');
					}
				},
				error: function(xhr, ajaxOptions, thrownError){
					swal('Server Error Occured', xhr.responseText, 'error');
				}
			});
		});
	})
</script>

<?php if ($teacher && user::is_teacher($teacher) && ($USER->id == $teacher->id || is_siteadmin())) { ?>
	<div class="container-fluid bg-grey">
		<p><span class="fa fa-info-circle"></span> <?= get_string('schedulechangesinfo', 'local_lonet') ?></p>
		<?= get_string('editscheduleinfo', 'local_lonet') ?>
		<input type="hidden" id="teacherid" name="Schedule[teacherid]" value="<?= $teacher->id ?>">
		<input type="hidden" id="action" name="action">
		<br>

		<div class="row">
			<div class="col-lg-4">
				<div class="row-block">
					<?php
					$aclrecord = $DB->get_record('lonet_userdata', array('userid'=>$teacher->id,'fieldname'=>'scarcityfeature'));
					$fielddata = $aclrecord->fielddata;
					if($fielddata == '5'){$a = 'selected';}
					if($fielddata == '1'){$b = 'selected';}
					if($fielddata == '2'){$c = 'selected';}
					if($fielddata == '3'){$d = 'selected';}
					if($fielddata != '5' && $fielddata != '1' && $fielddata != '2' && $fielddata != '3'){$e = 'selected';}
					?>
			        <?= get_string('scarcity_field', 'local_lonet') ?>
					<select name="scarcityfeature" id="scarcityfeature" style="width: 100%;" data-flag="true" required>
						<option value="5" <?= $a ?>><?= get_string('scarcity_field_option5', 'local_lonet') ?></option>
						<option value="1" <?= $b ?>><?= get_string('scarcity_field_option1', 'local_lonet') ?></option>
						<option value="2" <?= $c ?>><?= get_string('scarcity_field_option2', 'local_lonet') ?></option>
						<option value="3" <?= $d ?>><?= get_string('scarcity_field_option3', 'local_lonet') ?></option>
						<option value="4" <?= $e ?>><?= get_string('scarcity_field_option4', 'local_lonet') ?></option>
				 	</select>
					<div style="padding-left: 57%"><?= get_string('blockdays', 'local_lonet') ?></div>
					<?php foreach (schedule::get_blocked_days($teacherid) as $schedule) {
						$weekdays = (is_array($schedule->weekdays) ? $schedule->weekdays : json_decode($schedule->weekdays)); ?>
						<input type="hidden" name="Schedule[id]" value="<?= $schedule->id ?>">
						<select name="Schedule[weekdays][]" multiple>
							<?php foreach ($weekdays_array as $value => $label) { ?>
								<option value="<?= $value ?>" <?= (in_array($value, $weekdays) ? 'selected' : '') ?>><?= $label ?></option>
							<?php } ?>
						</select>
						<p></p>
						<p>
							<button type="button" class="btn btn-success btn-action" data-action="save"><?= get_string('savechanges') ?></button>
						</p>
				</div>
					<?php } ?>
			</div>
			<div class="col-lg-8">
				<div class="row">
            		<div class="col-lg-12">
            			<br/><br/><br/>
            		</div>
        		</div>
				<div class="row">
					<div class="col-md-6 col-lg-12">
						<?= get_string('blocktimes', 'local_lonet') ?>
						<?php foreach (schedule::get_blocked_times($teacherid) as $schedule) {
							//$timefrom = ($schedule->timefrom ? (new DateTime('now', core_date::get_user_timezone_object()))->setTimestamp($schedule->timefrom)->format('H:i') : null);
							$timefrom = $schedule->timefrom;
							//$timeto = ($schedule->timeto ? (new DateTime('now', core_date::get_user_timezone_object()))->setTimestamp($schedule->timeto)->format('H:i') : null);
							$timeto = $schedule->timeto;
							?>
							<div class="row-block">
								<input type="hidden" name="Schedule[id]" value="<?= $schedule->id ?>">
                                <?= schedule::getTimeInput('Schedule[timefrom]', $timefrom, ['disabled' => true]) ?> - &nbsp;<?= schedule::getTimeInput('Schedule[timeto]', $timeto, ['disabled' => true]) ?>
								<button type="button" class="btn btn-info btn-edit"><?= get_string('edit') ?></button>
								<button type="button" class="btn btn-success btn-action" data-action="save" style="display:none;"><?= get_string('savechanges') ?></button>
								<button type="button" class="btn btn-success btn-action" data-action="delete"><?= get_string('unblock', 'local_lonet') ?></button>
							</div>
						<?php } ?>
						<br>
						<div class="row-block">
							<input type="hidden" name="Schedule[id]" value="0">
                            <?= schedule::getTimeInput('Schedule[timefrom]', null) ?> - &nbsp;<?= schedule::getTimeInput('Schedule[timeto]', null) ?>
							<button type="button" class="btn btn-danger btn-action" data-action="save"><?= get_string('block', 'local_lonet') ?></button>
						</div>
						<br>
					</div>
					<div class="col-md-6 col-lg-12">
						<?= get_string('blockdates', 'local_lonet') ?>
						<?php foreach (schedule::get_blocked_dates($teacherid) as $schedule) {
							$datefrom = ($schedule->datefrom ? (new DateTime('now', core_date::get_user_timezone_object()))->setTimestamp($schedule->datefrom)->format('Y-m-d') : null);
							$dateto = ($schedule->dateto ? (new DateTime('now', core_date::get_user_timezone_object()))->setTimestamp($schedule->dateto)->format('Y-m-d') : null); ?>
							<div class="row-block">
								<input type="hidden" name="Schedule[id]" value="<?= $schedule->id ?>">
								<input type="date" name="Schedule[datefrom]" value="<?= $datefrom ?>" disabled> - &nbsp;<input type="date" name="Schedule[dateto]" value="<?= $dateto ?>" disabled>
								<button type="button" class="btn btn-info btn-edit"><?= get_string('edit') ?></button>
								<button type="button" class="btn btn-success btn-action" data-action="save" style="display:none;"><?= get_string('savechanges') ?></button>
								<button type="button" class="btn btn-success btn-action" data-action="delete"><?= get_string('unblock', 'local_lonet') ?></button>
							</div>
						<?php } ?>
						<br>
						<div class="row-block">
							<input type="hidden" name="Schedule[id]" value="0">
							<input type="date" name="Schedule[datefrom]"> - &nbsp;<input type="date" name="Schedule[dateto]">
							<button type="button" class="btn btn-danger btn-action" data-action="save"><?= get_string('block', 'local_lonet') ?></button>
						</div>
					</div>
				</div>
			</div>
		</div>
        <div class="row">
            <div class="col-lg-12">
                <?= get_string('blockdatetimes', 'local_lonet') ?>
                <?php foreach (schedule::get_blocked_datetimes($teacherid) as $schedule) {
                    $datefrom = ($schedule->datefrom ? (new DateTime('now', core_date::get_user_timezone_object()))->setTimestamp($schedule->datefrom)->format('Y-m-d') : null);
                    $dateto = ($schedule->dateto ? (new DateTime('now', core_date::get_user_timezone_object()))->setTimestamp($schedule->dateto)->format('Y-m-d') : null);
                    $timefrom = $schedule->timefrom;
                    $timeto = $schedule->timeto;
                    ?>
                    <div class="row-block">
                        <input type="hidden" name="Schedule[id]" value="<?= $schedule->id ?>">
                        <input type="date" name="Schedule[datefrom]" value="<?= $datefrom ?>" disabled> - &nbsp;<input type="date" name="Schedule[dateto]" value="<?= $dateto ?>" disabled>
                        <?= schedule::getTimeInput('Schedule[timefrom]', $timefrom, ['disabled' => true]) ?> - &nbsp;<?= schedule::getTimeInput('Schedule[timeto]', $timeto, ['disabled' => true]) ?>
                        <button type="button" class="btn btn-info btn-edit"><?= get_string('edit') ?></button>
                        <button type="button" class="btn btn-success btn-action" data-action="save" style="display:none;"><?= get_string('savechanges') ?></button>
                        <button type="button" class="btn btn-success btn-action" data-action="delete"><?= get_string('unblock', 'local_lonet') ?></button>
                    </div>
                <?php } ?>
                <br>
                <div class="row-block">
                    <input type="hidden" name="Schedule[id]" value="0">
                    <input type="date" name="Schedule[datefrom]"> - &nbsp;<input type="date" name="Schedule[dateto]">
                    <?= schedule::getTimeInput('Schedule[timefrom]', null) ?> - &nbsp;<?= schedule::getTimeInput('Schedule[timeto]', null) ?>
                    <button type="button" class="btn btn-danger btn-action" data-action="save"><?= get_string('block', 'local_lonet') ?></button>
                </div>
                <br>
            </div>
        </div>
	</div>
	<div class="container-fluid">
		<div class="schedule-container">
			<?= renderFile('_schedule.php', ['teacherid' => $teacherid, 'week' => $week, 'edit' => 1]) ?>
		</div>
		<a class="btn btn-success" href="/teacher/<?= $teacher->id ?>"><span class="fa fa-angle-left"></span>&nbsp;&nbsp;<?= get_string('backtoteacherprofile', 'local_lonet') ?></a>
	</div>
	
	<div id="reason-modal" class="modal" tabindex="-1" role="dialog" data-keyboard="true">
		<div class="modal-dialog " role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<form id="reason-form" action="/local/lonet/respond.php">
					<div class="modal-body">
						<div class="row">
							<div class="col-xs-12">
								<input type="hidden" id="id" name="id">
								<!--<input type="hidden" id="action" name="action">-->
								<label class="control-label" for="cancelreason">
									<span class="decline" style="display:none;"><?= get_string('whatisyourreasonfordecline', 'local_lonet') ?>?</span>
									<span class="cancel" style="display:none;"><?= get_string('whatisyourreasonforcancel', 'local_lonet') ?>?</span>
									<span class="notcomplete" style="display:none;"><?= get_string('whatisyourreasonfornotcomplete', 'local_lonet') ?>?</span>
								</label>
								<select id="cancelreason" class="form-control" name="cancelreason" required>
									<option class="decline cancel notcomplete"></option>
									<?php foreach (order_product::get_cancel_reasons() as $value => $label) { ?>
										<option value="<?= $value ?>" class="decline cancel"><?= $label ?></option>
									<?php } ?>
									<?php foreach (order_product::get_notcomplete_reasons() as $value => $label) { ?>
										<option value="<?= $value ?>" class="notcomplete"><?= $label ?></option>
									<?php } ?>
									<option value="other" class="decline cancel notcomplete">Other Reason</option>
								</select>
								<input type="text" id="cancelreason_other" name="cancelreason_other" style="display:none;" placeholder="Please specify">
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-success"><?= get_string('submit', 'core_moodle') ?></button>
						<button type="button" class="btn btn-danger" data-dismiss="modal"><?= get_string('close', 'core_form') ?></button>
					</div>
				</form>
			</div>
		</div>
	</div>
<?php } ?>
<br>
<?= $OUTPUT->footer() ?>
