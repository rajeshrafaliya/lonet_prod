<?php
use local_lonet\order_product;

global $DB;
global $USER;
?>

<script>
	$(document).ready(function() {
		var id = <?= $id ?>;
		var action = '<?= $action ?>';				
		if (id && action && action == 'notcomplete' || (role == 'teacher' && (action == 'cancel' || action == 'decline'))) {						
			$('label[for="cancelreason"] > span').hide();
			$('label[for="cancelreason"] > span.' + action).show();
			$('#cancelreason').val('');
			$('#cancelreason > option').hide();
			$('#cancelreason > option.' + action).show();
			$('#id').val(id);
			$('#action').val(action);
			$('#reason-modal').modal('toggle');
		}
		
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
				data: $(this).serialize(),
				success: function(result){
					if (result.is_success) {
						$('#lesson-container').html(result.html);
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
	});
</script>


<div id="lesson-container"><div>

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
							<input type="hidden" id="action" name="action">
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