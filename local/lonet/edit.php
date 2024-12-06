<?php
use local_lonet\order_product;
use local_lonet\schedule;
use local_lonet\schedule_form;
use local_lonet\user;

require_once('../../config.php');
require_once($CFG->dirroot.'/local/lonet/lib.php');
require_once($CFG->libdir.'/componentlib.class.php');
$PAGE->requires->css('/local/lonet/style.css?ver=1.9');
global $USER;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && isset($_POST['Schedule'])) {
	$result = false;
	$action = $_POST['action'];
	$attributes = $_POST['Schedule'];
	$attributes_recurring = $_POST['recurring_schedule'];
	if (in_array($action, ['delete', 'unblock'])) {
		if(!empty($attributes['id'])){
			if ($DB->delete_records('lonet_schedule', ['id' => $attributes['id']])) {
				$result = true;
			}
		}
		if(!empty($attributes_recurring['id'])){
			if ($DB->delete_records('lonet_schedule', ['id' => $attributes_recurring['id']])) {
				$result = true;
			}
		}
	} else {
		if (isset($attributes['weekdays'])) {
			if ($attributes['weekdays']) {
				$attributes['weekdays'] = json_encode($attributes['weekdays']);
			}		
		} else {
			$attributes['weekdays'] = null;
		}		
		if (isset($attributes_recurring['weekdays'])) {
			if ($attributes_recurring['weekdays']) {
				$attributes_recurring['weekdays'] = json_encode($attributes_recurring['weekdays']);
			}		
		} else {
			$attributes_recurring['weekdays'] = null;
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
		foreach(['timefrom', 'timeto'] as $attribute) {
			if (isset($attributes_recurring[$attribute])) {
				$attributes_recurring['isdst'] = date('I');
				if ($attributes_recurring[$attribute]) {
					$currentYear = date('Y');
					$date = (date('I') ? $currentYear.'-06-01' : $currentYear.'-12-01');
					$attributes_recurring[$attribute] = (new DateTime($date . ' ' . $attributes_recurring[$attribute], core_date::get_user_timezone_object()))->getTimestamp();
				}		
			} else {
				if ($action == 'block' && $attribute == 'timeto' && $attributes_recurring['timefrom']) {
					$attributes_recurring[$attribute] = $attributes_recurring['timefrom'] + 1800;
				} else {
					$attributes_recurring[$attribute] = null;
				}
			}
		}
		if (isset($attributes['id']) && $attributes['id']) {
			$result = $DB->update_record('lonet_schedule', $attributes);
		} else {
			$result = $DB->insert_record('lonet_schedule', $attributes);
		}		
		$attributes_recurring['datefrom'] = null;
		$attributes_recurring['dateto'] = null;
		// $attributes_recurring['ends'] = (new DateTime($attributes_recurring['ends'], core_date::get_user_timezone_object()))->getTimestamp();
		$attributes_recurring['isrecurring'] = 1;
		if (isset($attributes_recurring['id']) && $attributes_recurring['id']) {
			$result = $DB->update_record('lonet_schedule', $attributes_recurring);
		} else {
			$result = $DB->insert_record('lonet_schedule', $attributes_recurring);
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
	#page-local-lonet-edit .tutorsection4{
		padding-top:32px !important;
	}
	#page-local-lonet-edit .ms-container{
		margin-left: auto;
		margin-right: auto;
	}
	#page-local-lonet-edit .container-fluid:not(.container-footer){
		background: #FFFFFF !important;
		max-width: 100% !important;
		padding: 0px 112px;
	}
	.blockdaysave .btn, .btn.btn-save{
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
	select[name="Schedule[timeto]"]:disabled,select[name="Schedule[timefrom]"]:disabled,input[name="Schedule[datefrom]"]:disabled,input[name="Schedule[dateto]"]:disabled{
		background:#EEE !important;
	}
	select[name="Schedule[timeto]"],select[name="Schedule[timefrom]"],input[name="Schedule[dateto]"],input[name="Schedule[datefrom]"],select[name="recurring_schedule[timefrom]"],select[name="recurring_schedule[timeto]"], #recurring_ends, #recurring_weekdays{
		border-radius: 8px;
		height: 48px !important;
		padding: 12px !important;
		border: 1px solid #E5E7EB;
		background: #FFFFFF;
		box-shadow: 0px 1px 2px 0px rgba(16, 24, 40, 0.04), 0px 1px 2px 0px rgba(16, 24, 40, 0.04);
		color: #9CA3AF;
		font-size: 18px;
		font-style: normal;
		font-weight: 400;
		line-height: 24px;
	}
	.blocktimecontainer .row-block .btn:not(.btn-save),.blockdatecontainer .row-block .btn:not(.btn-save),.blockdatetimecontainer .row-block .btn:not(.btn-save),.blockdatetimecontainer_recurring .row-block .btn:not(.btn-save){
		background: none;
		outline: none;
		border: none;
		box-shadow:none;
		text-shadow:none;
	}
	.studentaccept{
		width: 100%;
		border-radius: 8px;
		border: 1px solid #E5E7EB;
		background: #FFFFFF;
		height: 42px !important;
		box-shadow: 0px 1px 2px 0px rgba(16, 24, 40, 0.04), 0px 1px 2px 0px rgba(16, 24, 40, 0.04);
		padding: 12px !important;
		color: #6B7280;
		font-size: 16px;
		font-style: normal;
		font-weight: 400;
		line-height: 18px;
		margin-bottom: 32px !important;
	}
	.bcktoteacher{
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
	.custom_accordion .acontainer{width:672px !important;}
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
				url: '<?= $CFG->wwwroot; ?>/local/lonet/edit.php',
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
			var actiontext = '<?= get_string('areyousure', 'local_lonet') ?>';
			var actionfortext = $(this).attr('data-action');
			if(actionfortext == 'block'){
				var actiontext = '<?= get_string('areyousureblock', 'local_lonet') ?>';
			}
			if(actionfortext == 'unblock'){
				var actiontext = '<?= get_string('areyousureunblock', 'local_lonet') ?>';
			}
			swal({
				title: actiontext,//'<?= get_string('areyousure', 'local_lonet') ?>',
				text: '<?= get_string('theywillupdatecalendar', 'local_lonet') ?>', 
				icon: '<?= $CFG->wwwroot ?>/local/lonet/pix/exclamation-circle-black.png',
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
						icon: '<?= $CFG->wwwroot ?>/local/lonet/pix/exclamation-circle-black.png',
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
		
		$('.blocktimecontainer .row-block select').on('change', function(){
			var allSelected = true;
			$('.blocktimecontainer .row-block.new select').each(function() {
				if (!$(this).val()) {
					allSelected = false;
				}
			});
			if (allSelected) {
				$('.blocktimecontainer .btn-save').prop('disabled', false);
			} else {
				$('.blocktimecontainer .btn-save').prop('disabled', true);
			}
		});		
		$('.blockdatecontainer .row-block input[type="date"]').on('change', function(){
			var allFilled = true;
            $('.blockdatecontainer .row-block input[type="date"]').each(function() {
                if (!$(this).val()) {
                    allFilled = false;
                }
            });
            if (allFilled) {
                $('.blockdatecontainer .btn-save').prop('disabled', false);
            } else {
                $('.blockdatecontainer .btn-save').prop('disabled', true);
            }
		});
		$('.blockdatetimecontainer .row-block input[type="date"], .blockdatetimecontainer .row-block select').on('change', function(){
			var $rowBlock = $(this).closest('.row-block'); // Limit to the closest row-block
			var allFilled = true;

			// Check all date inputs within the current row-block
			$rowBlock.find('input[type="date"]').each(function(index) {
				var value = $(this).val().trim();
				// console.log('Date Input ' + index + ':', value);
				if (value === '') {
					allFilled = false;
					// console.log('Date Input ' + index + ' is empty.');
					return false; // Exit the loop early
				}
			});
			
			// Check all select elements within the current row-block
			$rowBlock.find('select').each(function(index) {
				var value = $(this).val();
				// console.log('Select ' + index + ':', value);
				if (value === '' || value === null) {
					allFilled = false;
					// console.log('Select ' + index + ' is not selected.');
					return false; // Exit the loop early
				}
			});

			// console.log('All Filled:', allFilled);
			$rowBlock.find('.btn-save').prop('disabled', !allFilled);
		});


	
		 $(document).on('click', '.datetimeshowall', function(e) {
			 if($('.datetimeshowall').text() == 'Show more'){
				$('.blockdatetimecontainer .hideit').show();
				$('.blockdatetimecontainer .datetimeshowall').text('Show less');
			 }else{
				$('.blockdatetimecontainer .hideit').hide();
				$('.blockdatetimecontainer .datetimeshowall').text('Show more');
			 }
		 });
		 $(document).on('click', '.dateshowall', function(e) {
			 if($('.dateshowall').text() == 'Show more'){
				$('.blockdatecontainer .hideit').show();
				$('.blockdatecontainer .dateshowall').text('Show less');
			 }else{
				$('.blockdatecontainer .hideit').hide();
				$('.blockdatecontainer .dateshowall').text('Show more');
			 }
		 });
		 $(document).on('click', '.timeshowall', function(e) {
			 if($('.timeshowall').text() == 'Show more'){
				$('.blocktimecontainer .hideit').show();
				$('.blocktimecontainer .timeshowall').text('Show less');
			 }else{
				$('.blocktimecontainer .hideit').hide();
				$('.blocktimecontainer .timeshowall').text('Show more');
			 }
		 });
		 $(document).on('click', '.datetimeshowall_recurring', function(e) {
			 if($('.datetimeshowall_recurring').text() == 'Show more'){
				$('.blockdatetimecontainer_recurring .hideit').show();
				$('.blockdatetimecontainer_recurring .datetimeshowall_recurring').text('Show less');
			 }else{
				$('.blockdatetimecontainer_recurring .hideit').hide();
				$('.blockdatetimecontainer_recurring .datetimeshowall_recurring').text('Show more');
			 }
		 });

		$('.blockdatetimecontainer_recurring .row-block.new select').on('change', function(){
			var allSelected = true;
			$('.blockdatetimecontainer_recurring .row-block.new select').each(function() {
				if (!$(this).val()) {
					allSelected = false;
				}
			});
			if (allSelected) {
				$('.blockdatetimecontainer_recurring .row-block.new .btn-save').prop('disabled', false);
			} else {
				$('.blockdatetimecontainer_recurring .row-block.new .btn-save').prop('disabled', true);
			}
		});		
	})
</script>

<?php if ($teacher && user::is_teacher($teacher) && ($USER->id == $teacher->id || is_siteadmin())) { 
$DB->delete_records('lonet_schedule', ['teacherid' => $teacher->id, 'weekdays' => NULL, 'datefrom' => NULL, 'timefrom' => NULL]);
?>
	<div class="tutorsection4 px-0">
	<h3 class="my-0">Set your availability</h3>
	<p class="my-0 toppara">Easily manage your teaching schedule and only block off slots when you're not available for bookings.</p>
	<div class="howboxes">
		<div class="leftbox">
		<div class="applylonet tablink" data-target="applylonet_toggle" style="justify-content:center;">
			<h6 class="my-0">Your schedule is open 24/7 </h6>
		</div>
		<div class="applicationbox tablink" data-target="application_toggle" style="justify-content:center;">
			<h6 class="my-0">Block unavailable time slots</h6>
		</div>
		<div class="setprofilebox tablink" data-target="setprofile_toggle" style="justify-content:center;">
			<h6 class="my-0">Update your schedule when necessary</h6>
		</div>
		</div>
		<div class="rightbox">
			<!-- apply as an educator -->
			<div class="applylonet_toggle tabtarget">
				<p class="chooserole">How it works:</p>
				<ul>
				<li><p class="my-0"><span>By default your schedule is open 24/7, until you block the unavailable time slots.</span></p></li>	
				<li style="padding-top:32px;padding-bottom:32px;"><p class="my-0"><span>Block unavailable time slots. We recommend blocking your night hours and your normal days off.</span></p></li>	
				<li><p class="my-0"><span>Make sure your schedule is updated for the nearest 2 - 4 weeks, to avoid availability conflicts with your other events.</span> </p></li>	
				<p class="freeaccount px-0" style="background:#FFFFFF;">🔥 If you know you have a recurring conflict, like a weekly meeting, block out that time every week.</p>
				</ul>
			</div>
			<!----Complete your application -->
			<div class="application_toggle tabtarget hidden">
			<p class="chooserole">Complete your application</p>
			<ul>
			<li><p class="my-0"><span><?= get_string('showcaseexp','local_lonet') ?></span> <?= get_string('showcaseexpdesc','local_lonet') ?></p></li>	
			<div class="expertiselist">
				<ul>
				<li><p class="my-0"><span><?= get_string('education','local_lonet') ?></span> <?= get_string('educationdesc','local_lonet') ?></p></li>	
				<li><p class="my-0" style="padding-top:20px;padding-bottom:20px;"><span><?= get_string('experience','local_lonet') ?></span> <?= get_string('experiencedesc','local_lonet') ?></p></li>
				<li><p class="my-0"><span><?= get_string('yourapproch','local_lonet') ?></span> <?= get_string('yourapprochdesc','local_lonet') ?></p></li>
				</ul>
			</div>
			<li><p class="my-0"><span><?= get_string('scheduleinter','local_lonet') ?>:</span> <?= get_string('scheduleinterdesc','local_lonet') ?></p></li>
			</ul>
			</div>
			<!---set your profile--->
			<div class="setprofile_toggle tabtarget hidden">
				<ul style="padding-top:16px;">
				<li><p class="my-0"><span><?= get_string('setrates','local_lonet') ?></span> <?= get_string('setratesdesc','local_lonet') ?></p></li>	
				<li style="padding-top:32px;padding-bottom:32px;"><p class="my-0"><span><?= get_string('setavail','local_lonet') ?></span> <?= get_string('setavaildesc','local_lonet') ?></p></li>
				<li><p class="my-0"><span><?= get_string('managecal','local_lonet') ?></span> <?= get_string('managecaldesc','local_lonet') ?></p></li>
				</ul>
				<p class="freeaccount"><?= get_string('youallset','local_lonet') ?></p>
			</div>
		</div>
	</div>
	</div>

	<div class="tutorsection4 px-0 hidden" style="padding-bottom:24px;">
	<h3 class="my-0">Your booking and availability settings</h3>
	</div>

	<div class="container-fluid bg-grey">
		<p class="text-center">
			<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
			<path d="M10 7.66667V10.5833M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10ZM10 12.9167H10.0058V12.9225H10V12.9167Z" stroke="#374151" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
			</svg>
			<span style="vertical-align:text-bottom;color: #374151;font-size: 18px;"><?= get_string('schedulechangesinfo', 'local_lonet') ?></span>
		 </p>		
		<input type="hidden" id="teacherid" name="Schedule[teacherid]" value="<?= $teacher->id ?>">
		<input type="hidden" id="action" name="action">

		<div class="row mx-0" style="border-radius: 40px;background: #F9FAFB;padding: 64px;margin-top:72px;margin-bottom:72px;">
			<div class="col-lg-12">
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
			        <div style="color: #4B5563;font-size: 18px;font-weight: 500;"><?= get_string('scarcity_field', 'local_lonet') ?></div>
					<select name="scarcityfeature" class="studentaccept" id="scarcityfeature" style="width: 100%;" data-flag="true" required>
						<option value="5" <?= $a ?>><?= get_string('scarcity_field_option5', 'local_lonet') ?></option>
						<option value="1" <?= $b ?>><?= get_string('scarcity_field_option1', 'local_lonet') ?></option>
						<option value="2" <?= $c ?>><?= get_string('scarcity_field_option2', 'local_lonet') ?></option>
						<option value="3" <?= $d ?>><?= get_string('scarcity_field_option3', 'local_lonet') ?></option>
						<option value="4" <?= $e ?>><?= get_string('scarcity_field_option4', 'local_lonet') ?></option>
				 	</select>
					<div style="width:100%;text-align:center;color: #4B5563;font-size: 18px;font-weight: 500;margin-bottom: 12px;"><?= get_string('blockdays', 'local_lonet') ?></div>
					<?php foreach (schedule::get_blocked_days($teacherid) as $schedule) {
						$weekdays = (is_array($schedule->weekdays) ? $schedule->weekdays : json_decode($schedule->weekdays)); ?>
						<input type="hidden" name="Schedule[id]" value="<?= $schedule->id ?>">
						<select name="Schedule[weekdays][]" multiple>
							<?php foreach ($weekdays_array as $value => $label) { ?>
								<option value="<?= $value ?>" <?= (in_array($value, $weekdays) ? 'selected' : '') ?>><?= $label ?></option>
							<?php } ?>
						</select>
						<p></p>
						<p class="text-center blockdaysave">
							<button type="button" class="btn btn-success btn-action btn-save" data-action="save"><?= get_string('savechanges') ?></button>
						</p>
				</div>
					<?php } ?>
			</div>
			<div class="blocktimecontainer" style="width:100%;display:flex;flex-direction:row;justify-content:space-between;padding-bottom:32px;">
				<div class="title" style="color: #4B5563;font-size: 18px;font-weight: 500;"><?= get_string('blocktimes', 'local_lonet') ?></div>
				<div class="timeinputrow">
					<?php 
					$k = 1;
					foreach (schedule::get_blocked_times($teacherid) as $schedule) {
						//$timefrom = ($schedule->timefrom ? (new DateTime('now', core_date::get_user_timezone_object()))->setTimestamp($schedule->timefrom)->format('H:i') : null);
						$timefrom = $schedule->timefrom;
						//$timeto = ($schedule->timeto ? (new DateTime('now', core_date::get_user_timezone_object()))->setTimestamp($schedule->timeto)->format('H:i') : null);
						$timeto = $schedule->timeto;
						$hideitk = ($k>3) ? 'hideit' : '';
						$hidecssk = ($k>3) ? 'style="display:none;"' : '';
						?>
						<div class="row-block <?= $hideitk ?>" <?= $hidecssk ?>>
							<input type="hidden" name="Schedule[id]" value="<?= $schedule->id ?>">
							<?= schedule::getTimeInput('Schedule[timefrom]', $timefrom, ['disabled' => true]) ?> - &nbsp;<?= schedule::getTimeInput('Schedule[timeto]', $timeto, ['disabled' => true]) ?>
							<button type="button" class="btn btn-info btn-edit"><?= get_string('pencilediticon','local_lonet') ?></button>
							<button type="button" class="btn btn-success btn-action btn-save" data-action="save" style="display:none;"><?= get_string('savechanges') ?></button>
							<button type="button" class="btn btn-success btn-action" data-action="delete"><?= get_string('trashicon', 'local_lonet') ?></button>
						</div>
					<?php $k++; } ?>
					<div class="row-block new">
						<input type="hidden" name="Schedule[id]" value="0">
						<?= schedule::getTimeInput('Schedule[timefrom]', null) ?> - &nbsp;<?= schedule::getTimeInput('Schedule[timeto]', null) ?>
						<button type="button" class="btn btn-danger btn-action btn-save" data-action="save" disabled><?= get_string('savechanges') ?></button>
					</div>
				<?php if($k>3){ ?>
				<p class="timeshowall" style="text-align: center;font-size: 18px;font-weight: 500;padding-top: 32px;cursor: pointer;">Show more</p>
				<?php } ?>
				</div>
			</div>
			<div class="blockdatecontainer" style="width:100%;display:flex;flex-direction:row;justify-content:space-between;padding-bottom:32px;">
				<div class="title" style="color: #4B5563;font-size: 18px;font-weight: 500;"><?= get_string('blockdates', 'local_lonet') ?></div>
				<div class="dateinputrow">
				<?php 
				$j = 1;
				foreach (schedule::get_blocked_dates($teacherid) as $schedule) {
					$datefrom = ($schedule->datefrom ? (new DateTime('now', core_date::get_user_timezone_object()))->setTimestamp($schedule->datefrom)->format('Y-m-d') : null);
					$dateto = ($schedule->dateto ? (new DateTime('now', core_date::get_user_timezone_object()))->setTimestamp($schedule->dateto)->format('Y-m-d') : null); 
					$hideitj = ($j>3) ? 'hideit' : '';
					$hidecssj = ($j>3) ? 'style="display:none;"' : '';
					?>
					<div class="row-block <?= $hideitj ?>" <?= $hidecssj ?>>
						<input type="hidden" name="Schedule[id]" value="<?= $schedule->id ?>">
						<input type="date" name="Schedule[datefrom]" value="<?= $datefrom ?>" disabled> - &nbsp;<input type="date" name="Schedule[dateto]" value="<?= $dateto ?>" disabled>
						<button type="button" class="btn btn-info btn-edit"><?= get_string('pencilediticon', 'local_lonet') ?></button>
						<button type="button" class="btn btn-success btn-action btn-save" data-action="save" style="display:none;"><?= get_string('savechanges') ?></button>
						<button type="button" class="btn btn-success btn-action" data-action="delete"><?= get_string('trashicon', 'local_lonet') ?></button>
					</div>
				<?php $j++; } ?>
				<div class="row-block">
					<input type="hidden" name="Schedule[id]" value="0">
					<input type="date" name="Schedule[datefrom]"> - &nbsp;<input type="date" name="Schedule[dateto]">
					<button type="button" class="btn btn-danger btn-action btn-save" data-action="save" disabled><?= get_string('savechanges') ?></button>
				</div>
				<?php if($j>3){ ?>
				<p class="dateshowall" style="text-align: center;font-size: 18px;font-weight: 500;padding-top: 32px;cursor: pointer;">Show more</p>
				<?php } ?>
				</div>
			</div>
			<div class="blockdatetimecontainer" style="width:100%;display:flex;flex-direction:row;justify-content:space-between;padding-bottom:32px;">
				<div class="title" style="color: #4B5563;font-size: 18px;font-weight: 500;"><?= get_string('blockdatetimes', 'local_lonet') ?></div>
				<div class="datetimeinputrow">
				<?php 
				$i = 1;
				foreach (schedule::get_blocked_datetimes($teacherid) as $schedule) {
					$datefrom = ($schedule->datefrom ? (new DateTime('now', core_date::get_user_timezone_object()))->setTimestamp($schedule->datefrom)->format('Y-m-d') : null);
					$dateto = ($schedule->dateto ? (new DateTime('now', core_date::get_user_timezone_object()))->setTimestamp($schedule->dateto)->format('Y-m-d') : null);
					$timefrom = $schedule->timefrom;
					$timeto = $schedule->timeto;
					$hideit = ($i>3) ? 'hideit' : '';
					$hidecss = ($i>3) ? 'style="display:none;"' : '';
					?>
					<div class="row-block <?= $hideit ?>" <?= $hidecss ?>>
						<input type="hidden" name="Schedule[id]" value="<?= $schedule->id ?>">
						<input type="date" name="Schedule[datefrom]" value="<?= $datefrom ?>" disabled> - &nbsp;<input type="date" name="Schedule[dateto]" value="<?= $dateto ?>" disabled>
						<?= schedule::getTimeInput('Schedule[timefrom]', $timefrom, ['disabled' => true]) ?> - &nbsp;<?= schedule::getTimeInput('Schedule[timeto]', $timeto, ['disabled' => true]) ?>
						<button type="button" class="btn btn-info btn-edit"><?= get_string('pencilediticon', 'local_lonet') ?></button>
						<button type="button" class="btn btn-success btn-action btn-save" data-action="save" style="display:none;"><?= get_string('savechanges') ?></button>
						<button type="button" class="btn btn-success btn-action" data-action="delete"><?= get_string('trashicon', 'local_lonet') ?></button>
					</div>
				<?php $i++; } ?>
				<div class="row-block">
					<input type="hidden" name="Schedule[id]" value="0">
					<input type="date" name="Schedule[datefrom]"> - &nbsp;<input type="date" name="Schedule[dateto]">
					<?= schedule::getTimeInput('Schedule[timefrom]', null) ?> - &nbsp;<?= schedule::getTimeInput('Schedule[timeto]', null) ?>
					<button type="button" class="btn btn-danger btn-action btn-save" data-action="save" disabled><?= get_string('savechanges') ?></button>
				</div>
				<?php if($i>3){ ?>
				<p class="datetimeshowall" style="text-align: center;font-size: 18px;font-weight: 500;padding-top: 32px;cursor: pointer;">Show more</p>
				<?php } ?>
				</div>
			</div>
			
			<!------------------------------------------------------------------------New recurring---------------------------------------------------->
			<div class="blockdatetimecontainer_recurring" style="width:100%;display:flex;flex-direction:row;justify-content:space-between;padding-bottom:32px;">
			<div class="title" style="color: #4B5563;font-size: 18px;font-weight: 500;">Recurring Block Day & Time Period</div>
				<div class="datetimeinputrow">
				<?php 
 				$i = 1;
				foreach (schedule::get_blocked_times_recurring($teacherid) as $schedule) {
					// $datefrom = ($schedule->datefrom ? (new DateTime('now', core_date::get_user_timezone_object()))->setTimestamp($schedule->datefrom)->format('Y-m-d') : null);
					// $dateto = ($schedule->dateto ? (new DateTime('now', core_date::get_user_timezone_object()))->setTimestamp($schedule->dateto)->format('Y-m-d') : null);
					// $ends = ($schedule->ends ? (new DateTime('now', core_date::get_user_timezone_object()))->setTimestamp($schedule->ends)->format('Y-m-d') : null);
					$timefrom = $schedule->timefrom;
					$timeto = $schedule->timeto;
					$hideit = ($i>3) ? 'hideit' : '';
					$hidecss = ($i>3) ? 'style="display:none;"' : '';
					$weekdays_recurring = (is_array($schedule->weekdays) ? $schedule->weekdays : json_decode($schedule->weekdays));
					?>
					<div class="row-block <?= $hideit ?>" <?= $hidecss ?>>
						<input type="hidden" name="recurring_schedule[id]" value="<?= $schedule->id ?>">
						<!--input type="date" name="Schedule[datefrom]" value="<?= $datefrom ?>" disabled> - &nbsp;<input type="date" name="Schedule[dateto]" value="<?= $dateto ?>" disabled-->
						<select name="recurring_schedule[weekdays][]" id="recurring_weekdays">
							<?php foreach ($weekdays_array as $value => $label) { ?>
								<option value="<?= $value ?>" <?= (in_array($value, $weekdays_recurring) ? 'selected' : '') ?>><?= $label ?></option>
							<?php } ?>
						</select>
						<?= schedule::getTimeInput('recurring_schedule[timefrom]', $timefrom, ['disabled' => true]) ?> - &nbsp;<?= schedule::getTimeInput('recurring_schedule[timeto]', $timeto, ['disabled' => true]) ?>
						
						<!--input type="date" name="recurring_schedule[ends]" id="recurring_ends" value=""-->
						<button type="button" class="btn btn-info btn-edit"><?= get_string('pencilediticon', 'local_lonet') ?></button>
						<button type="button" class="btn btn-success btn-action btn-save" data-action="save" style="display:none;"><?= get_string('savechanges') ?></button>
						<button type="button" class="btn btn-success btn-action" data-action="delete"><?= get_string('trashicon', 'local_lonet') ?></button>
					</div>
				<?php $i++; 
				}
				?>
				<div class="row-block new" style="width: 100%;">
					<input type="hidden" name="Schedule[id]" value="0">
						<select name="recurring_schedule[weekdays][]" id="recurring_weekdays">
							<?php foreach ($weekdays_array as $value => $label) { ?>
								<!--option value="<?= $value ?>" <?= (in_array($value, $weekdays) ? 'selected' : '') ?>><?= $label ?></option-->
								<option value="<?= $value ?>"><?= $label ?></option>
							<?php } ?>
						</select>
					<!--input type="date" name="Schedule[datefrom]"> - &nbsp;<input type="date" name="Schedule[dateto]"-->
					<?= schedule::getTimeInput('recurring_schedule[timefrom]', null) ?> - &nbsp;<?= schedule::getTimeInput('recurring_schedule[timeto]', null) ?>
					<!--input type="date" name="recurring_schedule[ends]" id="recurring_ends"-->
					<input type="hidden" name="recurring_schedule[teacherid]" value="<?= $teacherid ?>">
					<button type="button" class="btn btn-danger btn-action btn-save" data-action="save" disabled><?= get_string('savechanges') ?></button>
				</div>
				<?php if($i>3){ ?>
				<p class="datetimeshowall_recurring" style="text-align: center;font-size: 18px;font-weight: 500;padding-top: 32px;cursor: pointer;">Show more</p>
				<?php } ?>
				</div>
			</div>
			<!------------------------------------------------------------------------New recurring---------------------------------------------------->
		</div>
	</div>
	<div class="container-fluid">
		<div class="schedule-container">
			<?= renderFile('_schedule.php', ['teacherid' => $teacherid, 'week' => $week, 'edit' => 1]) ?>
		</div>
		<a class="btn btn-success bcktoteacher mt-5" href="/teacher/<?= $teacher->id ?>"><span class="fa fa-angle-left"></span>&nbsp;&nbsp;<?= get_string('backtoprofile', 'local_lonet') ?></a>
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
<!------------------------------------------faq container--------------------------------------->
<div class="faqcontainer" style="padding: 64px 320px;">
<div class="faqbox">
<h4 class="my-0"><?= get_string('faq','local_lonet') ?></h4>
<div class="custom_accordion-body">
	<div class="custom_accordion">
		<div class="acontainer" id="acontainer_1">
		  <div class="label">What if I forget to block a time slot and I get a lesson request for this time?</div>
		  <div class="content" style="display:none;">
		  <p class="my-0">We suggest to confirm the request and to write (via messenger on Lonet) to the learner a request to proceed with the lesson in another day or time. We encourage you to communicate with the learners and make them know you are flexible, friendly, and open for accepting their requests (even if you made a mistake and missed to block some time slot). Usually, the learners appreciate open style of communication and they agree to postpone the lesson to another time or day.</p>
		  </div>
		</div>
		<div class="acontainer" id="acontainer_2">
		  <div class="label">Do I have to check the learner's time zone when I get a booking?</div>
		  <div class="content" style="display:none;">
		  <p  class="my-0">No, you don't have to worry about the learner's time zone. The learner sees your schedule in their time zone. The system adjusts the demonstration of your schedule to them according to the time zone they set in their profile. We make it easy for you not to worry about the time zone adjustments, as you may get learners from all over the world.</p>
			</div>
		</div>
		<div class="acontainer" id="acontainer_3">
		  <div class="label">Why are today and tomorrow blocked in my schedule?</div>
		  <div class="content" style="display:none;">
		  <p  class="my-0">The system automatically blocks 24 hours, to avoid last-minute lesson requests. We understand that to provide a qualitative session you need time to prepare for the session, and sometimes send preliminary information or questions to the learner. We believe it helps you secure better time management and planning.</p>
			</div>
		</div>
	</div>
</div>
</div>
</div>
<?= $OUTPUT->footer() ?>
