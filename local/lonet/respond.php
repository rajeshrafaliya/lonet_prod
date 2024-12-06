<?php
use local_lonet\order_product;

require_once('../../config.php');
require_once($CFG->dirroot.'/local/lonet/lib.php');

global $DB;
global $SESSION;
global $USER;

$PAGE->set_context(context_system::instance());
$PAGE->set_title('Update Lesson Status');
$PAGE->set_url('/local/lonet/respond.php');

require_login();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id']) && isset($_POST['action'])) {
	$result = [
		'is_success' => false,
		'message' => '',
		'html' => '',
	];
	$action = $_POST['action'];
	$id = $_POST['id'];
	$cancelreason = (isset($_POST['cancelreason']) ? $_POST['cancelreason'] : '');
	$cancelreason_other = (isset($_POST['cancelreason_other']) ? $_POST['cancelreason_other'] : '');
	$reason = ($cancelreason == 'other' ? $cancelreason_other : $cancelreason);
	if ($lesson = $DB->get_record('lonet_order_product', ['id' => $id])) {
		$student = $DB->get_record('user', ['id' => $lesson->studentid]);
		$teacher = $DB->get_record('user', ['id' => $lesson->teacherid]);
		$send_to_student = true;
		switch ($action) {
			case 'confirm':
				$lesson->status = order_product::STATUS_CONFIRMED;
				break;
			case 'decline':
				$lesson->status = order_product::STATUS_DECLINED;
				$lesson->canceltime = time();
				$lesson->cancellerid = $USER->id;
				$lesson->cancelreason = $reason;
				break;
			case 'cancel':
				$lesson->status = $lesson->status == order_product::STATUS_WAITING ? order_product::STATUS_DELETED : order_product::STATUS_CANCELED;
				$lesson->canceltime = time();
				$lesson->cancellerid = $USER->id;
				$lesson->cancelreason = $reason;
				if ($USER->id == $lesson->studentid) {
					$send_to_student = false;
				}
				break;
			case 'complete':
				if ($USER->id == $lesson->teacherid) {
					$lesson->teachercompleted = time();
				}
				if ($USER->id == $lesson->studentid) {
					$lesson->studentcompleted = time();
				}
				if ($lesson->teachercompleted > 1 && $lesson->studentcompleted > 1) {
					$lesson->status = order_product::STATUS_COMPLETED;
				}
				break;
			case 'notcomplete':
				if ($USER->id == $lesson->teacherid) {
					$lesson->teachercompleted = -1;
					if ($reason) {
						$lesson->teachernotcompletereason = $reason;
					}
				}
				if ($USER->id == $lesson->studentid) {
					$lesson->studentcompleted = -1;
					if ($reason) {
						$lesson->studentnotcompletereason = $reason;
					}
				}
				if ($lesson->teachercompleted == -1 && $lesson->studentcompleted == -1) {
					$lesson->status = order_product::STATUS_NOTCOMPLETED;
				}
				break;
			default:
				echo json_encode($result);
				exit();
		}
		if ($DB->update_record('lonet_order_product', $lesson)) {
            order_product::addTeacherReward($lesson, $student);
			if (!in_array($action, ['complete', 'notcomplete'])) {
				$recipient = ($send_to_student ? $student : $teacher);
				$mail = 'lesson' . $action . ($action == 'cancel' ? ($send_to_student ? 'learner' : 'teacher') : '');
                $session_lang_temp = $SESSION->lang;
                $SESSION->lang = $recipient->lang ?: 'en';
				sendMail_booking($recipient, $mail, [
					'fullname' => fullname($recipient, true),
					'lessonname' => order_product::get_name($lesson, true),
					'lessondate' => order_product::get_date($lesson, $recipient),
					'lessontime' => order_product::get_time($lesson, $recipient),
					'teachername' => fullname($teacher, true),
					'profilelink' => '<a href="' . $CFG->wwwroot . '/user/profile.php">' . get_string('profilepage', 'local_lonet') . '</a>',
					'termslink' => '<a href="' . $CFG->wwwroot . '/terms-and-conditions">' . get_string('terms', 'theme_lonet') . '</a>'
				]);
                $SESSION->lang = $session_lang_temp;
			}
			$result['is_success'] = true;
			$result['message'] = get_string('lessonstatus_' . $action, 'local_lonet', ['date' => order_product::get_date($lesson), 'time' => order_product::get_time($lesson)]);
			$result['html'] = order_product::get_lesson_html_profile($lesson);
		}
	}
	echo json_encode($result);
	exit();
} else {
	echo $OUTPUT->header();
	
	$id = (isset($_GET['id']) ? $_GET['id'] : null);
	$action = (isset($_GET['action']) ? $_GET['action'] : null);
	if ($id && $action) {
		if ($lesson = $DB->get_record('lonet_order_product', ['id' => $id])) {
			$message = '';
			$student = $DB->get_record('user', ['id' => $lesson->studentid]);
			$teacher = $DB->get_record('user', ['id' => $lesson->teacherid]);
			if ($lesson->status == order_product::STATUS_CONFIRMED) {
				if ($action == 'complete') {
					if ($USER->id == $lesson->teacherid) {
						$lesson->teachercompleted = time();
					}
					if ($USER->id == $lesson->studentid) {
						$lesson->studentcompleted = time();
					}
					if ($lesson->teachercompleted > 1 && $lesson->studentcompleted > 1) {
						$lesson->status = order_product::STATUS_COMPLETED;
					}
					if ($DB->update_record('lonet_order_product', $lesson)) {
						$message = get_string('lessonstatus_' . $action, 'local_lonet', ['date' => order_product::get_date($lesson), 'time' => order_product::get_time($lesson)]);
					}
				} elseif ($action == 'notcomplete') {
					if ($USER->id == $lesson->teacherid || $USER->id == $lesson->studentid) {
						$message = renderFile('_reasons.php', ['id' => $id, 'action' => $action]);
					} else {
						$message = 'Lesson not found';
					}
				}
			} elseif (in_array($action, ['complete', 'notcomplete'])) {
				$message = get_string('lessonstatus_' . $action, 'local_lonet', ['date' => order_product::get_date($lesson), 'time' => order_product::get_time($lesson)]);
			} ?>
			<script>
				$(document).on('click', '.btn-rate-teacher', function(e) {
					$('#rating-modal').remove();
					$.ajax({
						type: 'GET',
						url: '/local/lonet/ajax_rate.php?lessonid=<?= $lesson->id ?>',
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
			</script>
			<div class="row">
				<div class="col-md-6">
					<?= $message ?>
				</div>
				<div class="col-md-6 text-right">
					&nbsp;&nbsp;
					<?php if ($action == 'complete') {
						if (order_product::can_rate($lesson)) {
							echo order_product::get_rate_button();
						}
						if ($lesson->status = order_product::STATUS_COMPLETED) {
							echo order_product::get_next_lesson_button($lesson);
						}
					} ?>
				</div>
			</div>
		<?php } else {
			echo 'Lesson not found';
		}
	}
	
	echo $OUTPUT->footer();
}
?>
