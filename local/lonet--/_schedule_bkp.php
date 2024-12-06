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
			url: '/local/lonet/ajax_schedule.php?teacherid=<?= $teacherid ?><?= ($edit ? '&edit=1' : '') ?>&week=' + week,
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
		$('[data-week]').click(function(e) {
			changeWeek($(this).attr('data-week'));
		});
		<?php if ($USER->id && !$edit) { ?>
			var lessons = {};
			var index = 0;
			$('td.bg-success').hover(function(e) {
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
			}, function(e) {
				$('td.hover').removeClass('hover');
			});
			
			$('.schedule').on('click', 'td.bg-success', function(e) {
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
				var next = $(this).parent().nextAll(':lt(' + (count - 1) + ')').children('td.bg-success:nth-child(' + ($(this).index() + 1) + ')');
				if (next.length === (count - 1)) {
					var datetime = first.attr('data-datetime');
					lessons[index] = {
						lessonid: lesson.val(),
						datetime: datetime,
						language: lesson.attr('data-language') ? lesson.attr('data-language') : language.val()
					};
					$(this).attr('data-trial', is_trial);
					$(this).attr('data-index', index);
					next.attr('data-index', index);
					$(this).attr('class', 'bg-selected first');
					next.attr('class', 'bg-selected');
					$(this).html(lesson.attr('data-name') + ' <button class="btn btn-danger pull-right btn-remove-lesson"><span class="fa fa-trash-o"></span></button>');
					index++;
					$('.step-3').slideDown();
				}
			});
			
			$('.schedule').on('click', '.btn-remove-lesson', function(e) {
				lesson_index = $(this).parent().attr('data-index');
				delete lessons[lesson_index];
				$('[data-index="' + lesson_index + '"]').html('');
				$('[data-index="' + lesson_index + '"]').attr('class', 'bg-success');
				$('[data-index="' + lesson_index + '"]').removeAttr('data-index data-trial');
				if (Object.keys(lessons).length <= 0) {
					$('.step-3').slideUp();
				}
			});
			
			$('.step-3').click(function(e) {
				$.ajax({
					type: 'POST',
					url: '/local/lonet/book.php',
					dataType: 'json',            
					data: {
						teacherid: <?= $teacherid ?>,
						lessons: lessons
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
	});
</script>

<?php if ($edit) { ?>
	<p style="padding: 5px 0 0">
		<button class="btn-blockthis">B</button> - <?= get_string('block', 'local_lonet') ?>
		&nbsp;<button class="btn-unblockthis">U</button> - <?= get_string('unblock', 'local_lonet') ?>
		&nbsp;&nbsp;<button class="btn-confirm">C</button> - <?= get_string('confirm', 'local_lonet') ?>
		&nbsp;<button class="btn-decline">D</button> - <?= get_string('decline', 'local_lonet') ?>
	</p>
<?php } ?>
<p style="padding: 5px 0;">
	<?= ($week ? '<button data-week="' . ($week - 1) . '"><span class="fa fa-chevron-left"></span></button>' : '&nbsp;') ?>
	<button class="pull-right" data-week="<?= ($week + 1) ?>"><span class="fa fa-chevron-right"></span></button>
</p>
<div class="schedule-table-container" style="overflow-x: auto;">
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
</div>
