<?php
/*
	PARAMS:
		$teacherid
		$week
*/
use local_lonet\schedule;

defined('MOODLE_INTERNAL') || die();

global $CFG;
global $USER;

if (!isset($edit)) {
	$edit = 0;
}
$dates = schedule::get_dates($week, $edit);
$schedule = schedule::get_schedule($teacherid, $week, $edit);
?>
<style>
    #clone {
        position: absolute;
        pointer-events: none;
        visibility: hidden;
        margin: auto;
        z-index: 9999;
    }
    #clone thead {
        visibility: visible;
    }
    #clone tbody {
        display: none;
    }
    #clone thead th {
        background: white;
        border-bottom: 1px solid #ddd;
    }
    @media screen and (max-width: 500px) {
        #clone {
            display: none;
        }
    }
    .tooltip {
        z-index: 98;
    }
</style>
<script>
	function changeWeek(week = <?= $week ?>) {
		$.ajax({
			type: 'GET',
			url: '<?= $CFG->wwwroot ?>/local/lonet/ajax_schedule_profile.php?teacherid=<?= $teacherid ?><?= ($edit ? '&edit=1' : '') ?>&week=' + week,
			dataType: 'text',
			success: function(result){
				if (result) {
					$('.schedule-container').html(result);
				}
			},
			error: function(xhr, ajaxOptions, thrownError){
				swal('Server Error Occured', xhr.responseText, 'error');
			}
		});
	}
	$(document).ready(function() {
		<?php if ($edit) { ?>
            $(document).on('scroll', function(e) {
                let table = $('.schedule');
                let scroll = $(this).scrollTop();
                let anchor_top = $('.schedule').offset().top - 105;
                if (scroll > anchor_top) {
                    var top = scroll + 105;
                    if ($('#clone').length < 1) {
                        table.clone().attr('id', 'clone').css({ width: table.outerWidth() + 'px', top: top + 'px' }).appendTo($('.schedule-table-container'));
                        $('#clone').find('tbody').remove();
                    } else {
                        $('#clone').css({ top: top + 'px' });
                    }
                } else {
                    $('#clone').remove();
                }
            });
		<?php } else { ?>
            $('#schedule-modal .modal-body').on('scroll', function(e) {
                let table = $('.schedule');
                let scroll = $(this).scrollTop();
                let anchor_top = $('.schedule').offset().top + table.find('thead').height();
                if (scroll > anchor_top) {
                    var top = scroll;
                    if ($('#clone').length < 1) {
                        table.clone().attr('id', 'clone').css({ width: table.outerWidth() + 'px', top: top + 'px' }).appendTo($('.schedule-table-container'));
                        $('#clone').find('tbody').remove();
                    } else {
                        $('#clone').css({ top: top + 'px' });
                    }
                } else {
                    $('#clone').remove();
                }
            });
		<?php } ?>        
		// $('[data-week]').click(function(e) {
		$(document).on('click', '[data-week]', function(e) {
			changeWeek($(this).attr('data-week'));
		});
		<?php if ($USER->id && !$edit) { ?>
			var lessons = {};
			var index = 0;
			// $('td.bg-success').hover(function(e) {
			$(document).on('mouseenter', 'td.bg-success', function(e) {
				if (!$(this)[0].hasAttribute('data-index')) {
					var lesson = $('#lesson-selection input:checked');
					var count = lesson.attr('data-length') / 1800;
					var next = $(this).parent().nextAll(':lt(' + (count - 1) + ')').children('td.bg-success:nth-child(' + ($(this).index() + 1) + ')');
					if (next.length === (count - 1)) {
						$(this).addClass('hover');
						next.addClass('hover');
					} else {
						$('td.hover').removeClass('hover');
					}
				}
			});
			$(document).on('mouseleave', 'td.bg-success', function(e) {
				 $('td.hover').removeClass('hover');
			});
			// }, function(e) {
				// $('td.hover').removeClass('hover');
			// });
			
			// $('.schedule').on('click', 'td.bg-success', function(e) {
			$(document).on('click', 'td.bg-success', function(e) {
				var lesson = $('#lesson-selection input:checked');
				var language = $('#language-selection input:checked');

				if (lesson.length < 1) {
					swal('<?= get_string('selectlesson', 'local_lonet') ?>!', '', 'error');
					return;
				}
				var is_trial = lesson.attr('data-trial');
				if (is_trial == 1 && $('td[data-trial="1"]').length > 0) {
					swal('<?= get_string('singletriallesson', 'local_lonet') ?>!', '', 'error');
					return;
				}
				var first = $(this);
				var count = lesson.attr('data-length') / 1800;
				var isgrouplesson = $.base64.decode(lesson.attr('data-grouplesson'));
				console.log(isgrouplesson);
				if(isgrouplesson > 0){
					var lessondatentime = lesson.attr('data-gdate')+' '+lesson.attr('data-gtimefrom');
					var maxamountreq = $.base64.decode(lesson.attr('data-maxamountreq'));
					var userbooked = $.base64.decode(lesson.attr('data-currentusers'));
				}
				var next = $(this).parent().nextAll(':lt(' + (count - 1) + ')').children('td.bg-success:nth-child(' + ($(this).index() + 1) + ')');
				if (next.length === (count - 1)) {
					var datetime = first.attr('data-datetime');
					var datetimestamp = first.attr('data-timestamp');
					if(isgrouplesson > 0){
						if(datetime == lessondatentime){
							if(maxamountreq <= userbooked){
								swal('Booking is full.');
								return;
							}
						}else{
							swal('You are not allowed to book outside time. time slot is '+lesson.attr('data-gdate')+' '+lesson.attr('data-gtimefrom')+':'+lesson.attr('data-gtimeto'));
							return;
						}
					}
					lessons[index] = {
						lessonid: lesson.val(),
						datetime: datetime,
						endtime: lesson.attr('data-gdate')+' '+lesson.attr('data-gtimeto'),
						isgrouplesson: isgrouplesson,
						language: lesson.attr('data-language') ? lesson.attr('data-language') : language.val()
					};
					$(this).attr('data-trial', is_trial);
					$(this).attr('data-index', index);
					$(this).attr('data-removeindex', $(this).index());
					next.attr('data-index', index);
					$(this).attr('class', 'bg-selected first rclass_'+lesson.val()+''+$(this).index()+' bg_selected_lesson_'+$(this).index());
					next.attr('class', 'bg-selected rclass_'+lesson.val()+''+$(this).index()+' bg_selected_lesson_'+$(this).index());
					$(this).html(lesson.attr('data-shortname') + ' <button class="btn btn-danger pull-right btn-remove-lesson" data-lesson='+lesson.val()+'><span class="fa fa-trash-o"></span></button>');
					index++;
					
					 $.ajax({
						url: '<?= $CFG->wwwroot ?>/local/lonet/showlisting.php',
						method: 'GET',
						dataType : 'html',
						data: { datetimestamp: datetimestamp, lesson: lesson.val(), bookingteacher: <?= $teacherid ?>,isgrouplesson: isgrouplesson, index:$(this).index() },
						success: function(response) {
							$('.selectedlessoncontainer').append(response);
						},
						error: function() {
							console.log('Error processing timestamp.');
						}
					});
					$('.step-3').slideDown();
					var sellessonlen = $('.selectedlessoncontainer .indiselect').length+1;
					var lesstext = (sellessonlen > 1) ? 'lessons' : 'lesson';
					$('.step-3 .lcount').html(sellessonlen);
					$('.step-3 .ltext').html(lesstext);
				}
			});
			
			// $('.schedule').on('click', '.btn-remove-lesson', function(e) {
			$(document).on('click', '.btn-remove-lesson', function(e) {
				lesson_id = $(this).attr('data-lesson');
				lesson_index = $(this).parent().attr('data-index');
				lesson_rindex = $(this).parent().attr('data-removeindex');
				delete lessons[lesson_index];
				$('#lesson-'+lesson_id).prop('checked', false);
				$('.lessondiv_'+lesson_id).removeClass('clicked');
				$('[data-index="' + lesson_index + '"]').html('');
				$('[data-index="' + lesson_index + '"]').attr('class', 'bg-success');
				$('[data-index="' + lesson_index + '"]').removeAttr('data-index data-trial');
				$('.indiselect.removediv_'+lesson_rindex).remove();
				
				var sellessonlen = $('.selectedlessoncontainer .indiselect').length;
				var lesstext = (sellessonlen > 1) ? 'lessons' : 'lesson';
				$('.step-3 .lcount').html(sellessonlen);
				$('.step-3 .ltext').html(lesstext);
					
				if (Object.keys(lessons).length <= 0) {
					$('.step-3').slideUp();
				}
			});
			
			$('.step-3').click(function(e) {
				$.ajax({
					type: 'POST',
					url: '<?=$CFG->wwwroot ?>/local/lonet/book.php',
					dataType: 'json',            
					data: {
						teacherid: <?= $teacherid ?>,
						lessons: lessons,
						lessonid: $('#lesson-selection input:checked').val(),
					},
					success: function(result) {
						if (result === true) {
							window.location.replace('<?= $CFG->wwwroot ?>/local/lonet/book.php');
						} else {
							swal('Error Occured', result, 'error');                           
						}
					},
					error: function(xhr, ajaxOptions, thrownError){
						// swal('Server Error Occured', xhr.responseText, 'error');
                        window.location.replace('<?= $CFG->wwwroot ?>/user/edit.php?id=<?= $USER->id ?>&course=1'); 
					}
				});
			});
			$('#lesson-selection input').change(function(e) {
				$('.step-2').slideDown();
				$('.schedule-container').slideDown();
			})
		<?php } elseif (!$USER->id) { ?>
			$('.schedule').on('click', 'td.bg-success', function(e) {
                window.location.href = '<?= $CFG->wwwroot ?>/login/signup.php';
				/* $('.cd-popup-trigger').click(); */
			});
		<?php } ?>			
        $('#language-selection input').change(function(e) {
            var language = $('#language-selection input:checked');
            $('#lesson-selection input:not([data-language=""]) + label').hide();
            $('#lesson-selection input[data-language="' + language.val() + '"] + label').show();
            $('.step-1, #lesson-selection').slideDown();
        })
		$(document).on('scroll', function(e) {
			var table = $('.schedule');
			var scroll = $(this).scrollTop();
			var anchor_top = $('.schedule').offset().top - 105;
			var table_bottom = table.offset().top + table.outerHeight() - $('#clone').outerHeight()-105;
			if (scroll > anchor_top) {
				var top = scroll + 105;
				if ($('#clone').length < 1) {
					if(scroll >= table_bottom) {
						$('#clone').remove(); // Hide the clone when scrolling past the bottom of the table
					}else{
						table.clone().attr('id', 'clone').css({ width: table.outerWidth() + 'px', top: top + 'px' }).appendTo($('.schedule-table-container'));
						$('#clone').find('tbody').remove();
					}
				} else {
					if(scroll >= table_bottom) {
						$('#clone').remove(); // Hide the clone when scrolling past the bottom of the table
					}else{
						$('#clone').css({ top: top + 'px' });
					}
				}
			} else {
				$('#clone').remove();
			}
		});

		$(document).on('click', '.removeselect', function(e) {
			var rid = $(this).attr('data-removeid');
			var rclass = $(this).attr('data-removeclass');
			rindex = $(this).attr('data-rindex');
			lesson_index = $('.bg_selected_lesson_'+rindex).attr('data-index');
			delete lessons[lesson_index];
			// $('.bg_selected_lesson_'+rindex).removeAttr('data-index data-trial');
			// $('.bg_selected_lesson_'+rindex).html('');
			// $('.bg_selected_lesson_'+rindex).attr('class', 'bg-success');			
			$('.schedule-table-container .rclass_'+rclass).removeAttr('data-index data-trial');
			$('.schedule-table-container .rclass_'+rclass).html('');
			$('.schedule-table-container .rclass_'+rclass).attr('class', 'bg-success');
			// $('.indiselect.removediv_'+rindex).remove();
			$('.indiselect.rclass_'+rclass).remove();
			$('#lesson-'+rid).prop('checked', false);
			$('.lessondiv_'+rid).removeClass('clicked');
			
			var sellessonlen = $('.selectedlessoncontainer .indiselect').length;
			var lesstext = (sellessonlen > 1) ? 'lessons' : 'lesson';
			$('.step-3 .lcount').html(sellessonlen);
			$('.step-3 .ltext').html(lesstext);
			
			if (Object.keys(lessons).length <= 0) {
				$('.step-3').slideUp();
			}
		});
	});
</script>
<!--div class="step-3" style="display: none;">
<button class="btn btn-success"><?= get_string('confirmandpay', 'local_lonet') ?></button>
</div-->
<div class="schedule-table-container" style="overflow-x: auto;">
<h5 class="my-0">Choose a date that works for you</h5>
<p class="my-0">We understand plans change. You can cancel up to 12 hours before your lesson.</p>
<?php if ($edit) { ?>
	<p style="padding: 5px 0 0">
		<button class="btn-blockthis">B</button> - <?= get_string('block', 'local_lonet') ?>
		&nbsp;<button class="btn-unblockthis">U</button> - <?= get_string('unblock', 'local_lonet') ?>
		&nbsp;&nbsp;<button class="btn-confirm">C</button> - <?= get_string('confirm', 'local_lonet') ?>
		&nbsp;<button class="btn-decline">D</button> - <?= get_string('decline', 'local_lonet') ?>
		&nbsp;<button class="btn-message" style="background: none;border: none;box-shadow: none;"><i class="fa fa-commenting-o pull-right"></i></button> - <?= get_string('msgtogroup', 'local_lonet') ?>
	</p>
<?php }
if(isloggedin()){
	if ($USER->timezone == 99) {
		$user_timezone = $CFG->timezone;
	} else {
		$user_timezone = $USER->timezone;
	}
	echo '<p style="color:#6B7280;">Based on your timezone:  ' . $user_timezone.'</p>';
}else{
	$user_timezone = $CFG->timezone;
	echo '<p style="color:#6B7280;">Based on server timezone:  ' . $user_timezone.'</p>';
}
 ?>
<div style="display: flex; gap: 30px;align-items: center;justify-content: space-between;margin-top:32px;margin-bottom:32px;">
	<span style="border-radius: 2px;background: #8DF1BF;padding: 5px 11px;color: #000;font-size: 14px;font-weight: 400;line-height: 20px;">Available</span>
	<div style="justify-content: space-between;display: flex;gap: 30px;">
	<?= ($week ? '<button style="border:none;background:none;outline:none;box-shadow:none;" data-week="' . ($week - 1) . '"><svg xmlns="http://www.w3.org/2000/svg" width="7" height="12" viewBox="0 0 7 12" fill="none"><path d="M6 11L1 6L6 1" stroke="#374151" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>/svg></button>' : '&nbsp;') ?>
	<button class="pull-right" style="border:none;background:none;outline:none;box-shadow:none;" data-week="<?= ($week + 1) ?>"><svg xmlns="http://www.w3.org/2000/svg" width="7" height="12" viewBox="0 0 7 12" fill="none"><path d="M1 1L6 6L1 11" stroke="#374151" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></button>
	</div>
	</div>
	<!--div class="schedule-table-container" style="overflow-x: auto;"-->
    <table class="table table-bordered schedule">
        <thead>
            <tr>
                <th></th>
                <?php foreach ($dates as $label) { echo '<th>' . $label . '</th>'; } ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($schedule as $time => $info) { ?>
                <tr>
                    <td><?= $info['label'] ?></td>
                    <?php foreach ($info['days'] as $date => $attributes) { ?>
                        <td class="<?= $attributes['class'] ?>" data-datetime="<?= $date . ' ' . $time ?>" data-timestamp="<?= (new DateTime($date . ' ' . $time, core_date::get_user_timezone_object()))->getTimestamp() ?>"><?= ($edit ? $attributes['buttons'] : '') ?></td>
                    <?php } ?>
                </tr>
            <?php } ?>
        </tbody>
    </table>
	<!--div class="step-3" style="display: none;">
	<button class="btn btn-success"><?= get_string('confirmandpay', 'local_lonet') ?></button>
	</div-->
</div>
