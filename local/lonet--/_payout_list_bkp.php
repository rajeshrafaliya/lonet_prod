<?php
use local_lonet\order_product;
use local_lonet\payout_request;
use local_lonet\teacher;

global $CFG;
global $DB;
global $USER;

$user = (isset($user) ? $user : null);

if ($lessons = teacher::get_lessons_for_payout($user->id)) {
	$payout_request = teacher::get_payout_request($user->id);
	$saved_data = ($payout_request && $payout_request->lessons ? json_decode($payout_request->lessons) : []);
    $selected_amount = payout_request::get_amount($saved_data);
    ?>
	<script>
        window.selectedAmount = <?= $selected_amount ?>;
		$(document).ready(function() {			
			$(document).on('click', '.btn-save-payout', function(e) {
				data = 'action=save&' + $('[name="PayoutRequest[lessons][]"]').serialize();
				$.ajax({
					type: 'POST',
					url: '/local/lonet/payout.php',
					dataType: 'json',            
					data: data,
					success: function(result){
						if (result) {
							swal('Your changes have been saved!', '', 'success');
						} else {
							swal('Error Occured', 'Your changes could not be saved', 'error');
						}
					},
					error: function(xhr, ajaxOptions, thrownError){
						swal('Server Error Occured', xhr.responseText, 'error');
					}
				});
			});
			
			$(document).on('click', '.btn-request-payout', function(e) {
				if (selectedAmount < <?= get_config('local_lonet', 'minpayoutamount') ?>) {
					swal('Minimal payout amount is € <?= get_config('local_lonet', 'minpayoutamount') ?>', 'For other options, please send a request to support service: lonet@lonet.academy', 'error');
				} else {
					$('#payout-modal').modal('toggle');
				}
			});
				
			function updateSelectedAmount() {
				data = 'action=calculate&' + $('[name="PayoutRequest[lessons][]"]').serialize();
				$.ajax({
					type: 'POST',
					url: '/local/lonet/payout.php',
					dataType: 'html',            
					data: data,
					success: function(result){
                        selectedAmount = result;
						$('#selected-amount').html(Number(result).toFixed(2));
					},
					error: function(xhr, ajaxOptions, thrownError){
						swal('Server Error Occured', xhr.responseText, 'error');
					}
				});
			}
			
			$(document).on('click', '.btn-select-all', function(e) {
				$('#payout-list .payout-confirmation-checkbox').prop('checked', true);
				updateSelectedAmount();
			});
			$(document).on('change', '.payout-confirmation-checkbox', function(e) {
				updateSelectedAmount();
			});
		});
	</script>

	<!-- profile container -->
	<div class="row user-row"><div class="col-xs-12">
	<!-- profile container -->
	<?php if (teacher::get_payout_count($user->id)) {?>
		<h2 style="color:red"><?= get_string('requestpayout_message', 'local_lonet') ?></h2>
	<?php } else { ?>
		<h2><?= get_string('requestpayout', 'local_lonet') ?></h2>
		<p class="text-right"><button type="button" class="btn btn-success btn-select-all">Select All</button></p>
		<table id="payout-list" class="table table-striped table-bordered">
			<thead>
				<tr>
					<th>#</th>
					<th>Lesson</th>
					<th>Date</th>
					<th>Student</th>
					<th>Amount, &euro;</th>
					<th>Lesson Status</th>
					<th>Confirm Amount</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($lessons as $lesson) {
					echo order_product::get_lesson_for_payout_html($lesson, in_array($lesson->id, $saved_data));
				} ?>
			</tbody>
			<tfoot>
				<th colspan=4></th>
				<th><?= number_format(teacher::get_payout_balance($user->id), 2) ?></th>
				<th></th>
				<th id="selected-amount"><?= number_format($selected_amount, 2) ?></th>
			</tfoot>
		</table>
		<p class="text-right">
			<button type="button" class="btn btn-success btn-save-payout"><?= get_string('save', 'local_lonet') ?></button>
			<button type="button" class="btn btn-success btn-request-payout"><?= get_string('confirmrequestpayout', 'local_lonet') ?></button>
		</p>
	<?php } ?>		
	<!-- profile container -->
	</div></div>
	<!-- profile container -->
<?php } ?>