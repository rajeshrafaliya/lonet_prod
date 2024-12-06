<?php
use local_lonet\order_product;

global $CFG,$DB,$USER,$PAGE,$FULLME;

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
							// row.replaceWith(result.html);
							// swal('Success', result.message, 'info');
							swal({
								title: 'Success',
								text: result.message,
								// confirmButtonText: 'Ok',
								className: 'successswal',
								icon: '<?= $CFG->wwwroot ?>/theme/lonet/pix/swal-check-circle.png',
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
									// window.location.href = '<?= $FULLME ?>';
									var baseUrl = '<?= $FULLME ?>';
									var url = new URL(baseUrl);
									url.searchParams.delete('row');
									window.location.href = url.toString()+'&row=row_'+id;										
								}
							});

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
							icon: '<?= $CFG->wwwroot ?>/theme/lonet/pix/swal-circle.png',
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
							// row = $('.row-lesson[data-id="' + $('#id').val() + '"]');
							// row.replaceWith(result.html);
							// swal('Success', result.message, 'info');
							swal({
								title: 'Success',
								text: result.message,
								// confirmButtonText: 'Ok',
								className: 'successswal',
								icon: '<?= $CFG->wwwroot ?>/theme/lonet/pix/swal-check-circle.png',
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
									window.location.href = '<?= $FULLME ?>';
								}
							});
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
			
			$(document).on('click', '#rating-modal .btn-success', function(e) {
				e.preventDefault();
				$.ajax({
					type: 'POST',
					url: '/local/lonet/rate.php',
					dataType: 'text',
					data: $('#rating-form').serialize(),
					success: function(result){
						if (result) {
							$('#rating-modal').modal('toggle');
							swal('Thank You', '', 'success');
						} else {
							swal('Error Occurred', 'Rating not saved!', 'error');
						}
					},
					error: function(xhr, ajaxOptions, thrownError){
						swal('Server Error Occurred', xhr.responseText, 'error');
					}
				});
			});

		});
    document.addEventListener('DOMContentLoaded', function() {
        // Get the current URL parameters
        const urlParams = new URLSearchParams(window.location.search);
        const rowId = urlParams.get('row'); // Get the 'row' parameter from the URL

        if (rowId) {
            const targetElement = document.getElementById(rowId); // Find the element with the matching ID
            if (targetElement) {
                // Get the bounding rectangle of the target element
                var rect = targetElement.getBoundingClientRect();
                // Calculate the position and add margin (e.g., 150px margin)
                var offsetTop = window.pageYOffset + rect.top - 200; 

                // Scroll to the element with offset
                window.scrollTo({ top: offsetTop, behavior: 'smooth' });
            }
        }
    });
	</script>
	<style>
		.nav-tabs{border-bottom:none !important;}
		.nav-tabs li.active a,.nav-tabs li.active a:hover{
			border-bottom: 2px solid #CE1369 !important;
			background:none !important;
		}
		.nav-tabs a,.nav-tabs a:hover{
			border-top: none !important;
			border-left: none !important;
			border-right: none !important;
			color: #111827 !important;
			font-size: 18px;
			font-style: normal;
			font-weight: 700;
			line-height: normal !important;
			padding: 8px !important;
			background:none !important;
		}
		#reason-modal .notcomplete,#reason-modal .cancel,#reason-modal .decline{
			color: #000;
			font-size: 20px;
			font-style: normal;
			font-weight: 500;
			line-height: normal;
		}
		#reason-modal select,#cancelreason_other{
			border-radius: 8px;
			border: 1px solid #E5E7EB;
			background: #FFFFFF;
			box-shadow: 0px 1px 2px 0px rgba(16, 24, 40, 0.04), 0px 1px 2px 0px rgba(16, 24, 40, 0.04);
			height: 48px !important;
			color: #4B5563;
			font-size: 18px;
			font-style: normal;
			font-weight: 400;
			line-height: 24px;
			padding: 12px !important;
			outline:none;
			margin-top:32px !important;
			margin-bottom:32px !important;
		}
		#reason-modal .btn.close,#reason-modal .btn.close:hover, #rating-modal .btn.close, #rating-modal .btn.close:hover{
			padding: 12px 20px;
			border-radius: 60px;
			border: 1px solid #4B5563;
			background: #FFF;
			box-shadow: 0px 1px 0px 0px rgba(0, 0, 0, 0.04);
			color: #4B5563;
			text-align: center;
			font-size: 18px;
			font-style: normal;
			font-weight: 400;
			line-height: 24px; 
			text-shadow:none;
		}
		#reason-modal .btn.sbt,#reason-modal .btn.sbt:hover,#rating-modal .btn.sbt,#rating-modal .btn.sbt:hover{
			border-radius: 60px;
			border: 1px solid rgba(17, 24, 39, 0.15);
			background: #CE1369;
			box-shadow: 0px 1px 0px 0px rgba(0, 0, 0, 0.04);
			padding: 12px 20px;
			color: #FFF;
			text-align: center;
			font-size: 18px;
			font-style: normal;
			font-weight: 400;
			line-height: 24px;
			text-shadow:none;
		}
		#reason-modal #reason-form input,#reason-modal #reason-form select{width:100%;}
		#reason-modal #reason-form{padding:64px;}
		#reason-modal .modal-footer,#rating-modal .modal-footer{
			background: none;
			border: none;
			display: flex;
			align-items: center;
			gap: 32px;
			justify-content: center;
		}
		#reason-modal .modal-dialog,#reason-modal .modal-content{
			width: 528px;
		}
		#lessonhistory .row-lesson.bg-success{
			background: #EFEDE6;
		}		
		#lessonhistory .row-lesson.bg-danger{
			background: #F9FAFB !important;
		}
	</style>
	<!-- profile container -->
	<div class="row user-row"><div class="col-xs-12">
	<!-- profile container -->
	<?php if ($fullhistory) { ?>
		<h2 class="text-center" style="padding-bottom: 72px;color: #374151;font-size: 32px;font-weight: 700;line-height: 40px;letter-spacing: -0.64px;"><?= get_string('lessonhistory', 'local_lonet') ?></h2>
		<ul class="nav nav-tabs">
			<?= ($teacher_lessons ? '<li class="active"><a data-toggle="tab" href="#teacherhistory">' . get_string('teachinghistory', 'local_lonet') . '</a></li>' : '') ?>
			<?= ($student_lessons ? '<li ' . (!$teacher_lessons ? 'class="active"' : '') . '><a data-toggle="tab" href="#lessonhistory">' . get_string('learninghistory', 'local_lonet') . '</a></li>' : '') ?>
		</ul>
		
		<div class="tab-content">
			<?php if ($teacher_lessons) { ?>
				<div id="teacherhistory" class="tab-pane fade in active">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Date & Time</th>
                                <th>Name</th>
                                <th>Language</th>
                                <th>Tutor</th>
                                <?php //(is_siteadmin()) ? '<th>Learner</th>' : ''; ?>
                                <th>Learner</th>
                                <th>Status</th>
                                <?= !empty($data['actions']) ? '<th style="width:20%;"></th>' : '<th></th>'; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach (order_product::getLessonData($teacher_lessons) as $data) { ?>
                            <tr class="row-lesson <?= $data['html_class'] ?>" data-id="<?= $data['id'] ?>">
                                <td><?= $data['id'] ?></td>
                                <td><?= $data['datetime'] ?></td>
                                <td><?= $data['name'] ?></td>
                                <td><?= $data['language'] ?></td>
                                <td class="tutor"><?= $data['tutor'] ?></td>
                                <?php //(is_siteadmin()) ? '<td class="learner">'.$data["learner"].'</td>' : ''; ?>
                                <td class="learner"><?= $data["learner"] ?></td>
                                <td class="lessonstatus"><?= $data['status'] ?></td>
								<?= !empty($data['actions']) ? '<td class="buttons" style="width:20%;">'.$data['actions'].'</td>' : '<td class="buttons">'.$data['actions'].'</td>'; ?>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
				</div>
			<?php }
			if ($student_lessons) { ?>
				<div id="lessonhistory" class="tab-pane fade <?= ($teacher_lessons ? '' : 'in active') ?>">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Date & Time</th>
                                <th>Name</th>
                                <th>Language</th>
                                <th>Tutor</th>
                                <!-- (is_siteadmin()) ? '<th>Learner</th>' : '';-->
                                <th>Learner</th>
                                <th>Status</th>
                                <?= !empty($data['actions']) ? '<th style="width:20%;"></th>' : '<th></th>'; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach (order_product::getLessonData($student_lessons) as $data) { ?>
                            <tr class="row-lesson <?= $data['html_class'] ?>" data-id="<?= $data['id'] ?>">
                                <td><?= $data['id'] ?></td>
                                <td><?= $data['datetime'] ?></td>
                                <td><?= $data['name'] ?></td>
                                <td><?= $data['language'] ?></td>
                                <td class="tutor"><?= $data['tutor'] ?></td>
                                <td class="learner"><?= $data["learner"] ?></td>
								<!-- (is_siteadmin()) ? '<td class="learner">'.$data["learner"].'</td>' : ''; -->
                                <td class="lessonstatus"><?= $data['status'] ?></td>
								<?= !empty($data['actions']) ? '<td class="buttons" style="width:20%;">'.$data['actions'].'</td>' : '<td class="buttons">'.$data['actions'].'</td>'; ?>
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
			<div id="teacherhistory" class="container-fluid">
				<?php foreach ($teacher_lessons as $lesson) {
					echo order_product::get_lesson_html($lesson);
				} ?>
			</div>
		<?php } elseif ($role == 'learner' && $student_lessons) { ?>
			<h3><?= get_string('learning', 'local_lonet') ?></h3>
			<div id="lessonhistory" class="container-fluid">
				<?php foreach ($student_lessons as $lesson) {
					echo order_product::get_lesson_html($lesson);
				} ?>
			</div>
		<?php } ?>	
	<?php } ?>
	
	<div id="reason-modal" class="modal" tabindex="-1" role="dialog" data-keyboard="true">
		<div class="modal-dialog " role="document">
			<div class="modal-content">
				<div class="modal-header hidden">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<form id="reason-form" action="/local/lonet/respond.php">
					<div class="modal-body px-0 py-0">
						<div class="row mx-0" style="overflow:hidden;">
							<div class="col-xs-12 px-0">
								<input type="hidden" id="id" name="id">
								<input type="hidden" id="action" name="action">
								<label class="control-label text-center" for="cancelreason">
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
					<div class="modal-footer px-0 py-0">
						<button type="button" class="btn btn-danger close" data-dismiss="modal"><?= get_string('close', 'core_form') ?></button>
						<button type="submit" class="btn btn-success sbt"><?= get_string('submit', 'core_moodle') ?></button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<!-- profile container -->
	</div></div>
	<!-- profile container -->
<?php } ?>