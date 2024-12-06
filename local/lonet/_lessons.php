<?php
use local_lonet\order_product;

global $DB;
global $USER;

$user = (isset($user) ? $user : null);
$fullhistory = (isset($fullhistory) ? $fullhistory : false);
$role = (isset($role) ? $role : false);

$student_lessons = ($fullhistory ? order_product::get_student_lessons($user) : order_product::get_upcoming_student_lessons($user));
$teacher_lessons = ($fullhistory ? order_product::get_teacher_lessons($user) : order_product::get_upcoming_teacher_lessons($user));

if ($student_lessons || $teacher_lessons) { ?>
	<script>
		$(document).ready(function() {
			function sendResponse(id, action, row) {
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
							row.replaceWith(result.html);
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
			
			$('.btn-respond').click(function(e) {
				var row = $(this).parents('.row-lesson');
				var id = row.attr('data-id');
				var action = $(this).attr('data-action');
				var action_text = (action == 'notcomplete' ? '' : action);
				var role = $(this).attr('data-role');				
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
						}).then((willDelete) => {
							if (willDelete) {
								sendResponse(id, action, row);
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
					data: $(this).serialize(),
					success: function(result){
						if (result.is_success) {
							row = $('.row-lesson[data-id="' + $('#id').val() + '"]');
							row.replaceWith(result.html);
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
			
			$(document).on('click', '.btn-rate-teacher', function(e) {
				$('#rating-modal').remove();
				var row = $(this).parents('.row-lesson');
				$.ajax({
					type: 'GET',
					url: '/local/lonet/ajax_rate.php?lessonid=' + row.attr('data-id'),
					dataType: 'text',
					success: function(result){
						if (result) {
							$('body').append(result);
							$('#rating-modal').modal();
						}
					},
					error: function(xhr, ajaxOptions, thrownError){
						swal('Server Error Occured', xhr.responseText, 'error');
					}
				});
			});
			$('.exportcal').click(function (e) {
			   e.preventDefault();
			   var copyText = $(this).attr('href');
			   document.addEventListener('copy', function(e) {
				  e.clipboardData.setData('text/plain', copyText);
				  e.preventDefault();
			   }, true);

			   document.execCommand('copy');  
			   console.log('copied text : ', copyText);
			   alert('Calendar URL: ' + copyText); 
			 });
		});
	</script>

	<!-- profile container -->
	<div class="row user-row"><div class="col-xs-12">
	<!-- profile container -->
	
	<?php if ($fullhistory) { ?>
		<h2><?= get_string('lessonhistory', 'local_lonet') ?></h2>
		<ul class="nav nav-tabs">
			<?= ($teacher_lessons ? '<li class="active"><a data-toggle="tab" href="#teaching">' . get_string('teachinghistory', 'local_lonet') . '</a></li>' : '') ?>
			<?= ($student_lessons ? '<li ' . (!$teacher_lessons ? 'class="active"' : '') . '><a data-toggle="tab" href="#learning">' . get_string('learninghistory', 'local_lonet') . '</a></li>' : '') ?>
		</ul>
		
		<div class="tab-content">
			<?php if ($teacher_lessons) { ?>
				<div id="teaching" class="tab-pane fade in active">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Date & Time</th>
                                <th>Name</th>
                                <th>Language</th>
                                <th>Tutor</th>
                                <th>Learner</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach (order_product::getLessonData($teacher_lessons) as $data) { ?>
                            <tr class="row-lesson <?= $data['html_class'] ?>" data-id="<?= $data['id'] ?>">
                                <td><?= $data['id'] ?></td>
                                <td><?= $data['datetime'] ?></td>
                                <td><?= $data['name'] ?></td>
                                <td><?= $data['language'] ?></td>
                                <td><?= $data['tutor'] ?></td>
                                <td><?= $data['learner'] ?></td>
                                <td><?= $data['status'] ?></td>
                                <td><?= $data['actions'] ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
				</div>
			<?php }
			if ($student_lessons) { ?>
				<div id="learning" class="tab-pane fade <?= ($teacher_lessons ? '' : 'in active') ?>">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Date & Time</th>
                                <th>Name</th>
                                <th>Language</th>
                                <th>Tutor</th>
                                <th>Learner</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach (order_product::getLessonData($student_lessons) as $data) { ?>
                            <tr class="row-lesson <?= $data['html_class'] ?>" data-id="<?= $data['id'] ?>">
                                <td><?= $data['id'] ?></td>
                                <td><?= $data['datetime'] ?></td>
                                <td><?= $data['name'] ?></td>
                                <td><?= $data['language'] ?></td>
                                <td><?= $data['tutor'] ?></td>
                                <td><?= $data['learner'] ?></td>
                                <td><?= $data['status'] ?></td>
                                <td><?= $data['actions'] ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
				</div>
			<?php } ?>			
		</div>
	<?php } else { ?>
		<?php if ($role == 'teacher' && $teacher_lessons) { ?>
			<h3><?= get_string('teaching', 'local_lonet') ?></h3>
			<div id="teaching" class="container-fluid">
				<?php foreach ($teacher_lessons as $lesson) {
					echo order_product::get_lesson_html($lesson);
				} ?>
			</div>
		<?php } elseif ($role == 'learner' && $student_lessons) { ?>
			<h3><?= get_string('learning', 'local_lonet') ?></h3>
			<div id="learning" class="container-fluid">
				<?php foreach ($student_lessons as $lesson) {
					echo order_product::get_lesson_html($lesson);
				} ?>
			</div>
		<?php } ?>	
	<?php } ?>
	
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

	<!-- profile container -->
	</div></div>
	<!-- profile container -->
<?php } ?>