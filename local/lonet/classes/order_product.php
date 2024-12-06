<?php
namespace local_lonet;

use \core_date;
use \DateTime;
use \local_lonet\lesson;
use local_lonet\user;

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot.'/local/lonet/lib.php');
require_once($CFG->dirroot.'/user/profile/lib.php');

class order_product {
	const STATUS_WAITING = 0;
	const STATUS_CONFIRMED = 1;
	const STATUS_DECLINED = 2;
	const STATUS_EXPIRED = 3;
	const STATUS_CANCELED = 4;
	const STATUS_COMPLETED = 5;
	const STATUS_NOTCOMPLETED = 6;
	const STATUS_DELETED = 7;
	
	public static $statuses = [
		0 => 'waitingconfirmation',
		1 => 'confirmed',
		2 => 'declined',
		3 => 'declined',
		4 => 'canceled',
		5 => 'completed',
		6 => 'notcompleted',
		7 => 'canceled',
	];
	
	public static function get_buttons_html($lesson) {
		global $CFG,$USER;
		$html = '';
		$is_teacher = ($USER->id == $lesson->teacherid ? true : false);
		$is_learner = ($USER->id == $lesson->studentid ? true : false);
		$role = ($is_teacher ? 'teacher' : 'learner');
		switch ($lesson->status) {
			case self::STATUS_WAITING:
				if ($is_teacher) {
					$html .= '<button class="btn btn-success btn-respond" data-action="confirm" data-role="' . $role . '">' . get_string('confirm', 'local_lonet') . '</button>';
					$html .= '<button class="btn btn-danger btn-respond" data-action="decline" data-role="' . $role . '">' . get_string('decline', 'local_lonet') . '</button>';
				} else {
					$html .= '<button class="btn btn-danger btn-respond" data-action="cancel" data-role="' . $role . '">' . get_string('cancel', 'local_lonet') . '</button>';
				}
				break;
			case self::STATUS_CONFIRMED:
				if ($lesson->starttime > time()) {
					$html .= '<button class="btn btn-danger btn-respond" data-action="cancel" data-role="' . $role . '">' . get_string('cancel', 'local_lonet') . '</button>';
					$html .= '<a href="'.$CFG->wwwroot.'/calendar/export_calendar.php?id='.$lesson->id.'" class="btn exportcal">Export for Google Calendar</a>';//Added by Nitesh
				} else {
					if (($is_teacher && !$lesson->teachercompleted) || ($is_learner && !$lesson->studentcompleted)) {
						$html .= '<button class="btn btn-success btn-respond markcompleted" data-action="complete" data-role="' . $role . '">' . get_string('markcompleted', 'local_lonet') . '</button>';
						$html .= '<button class="btn btn-danger btn-respond marknotcompleted" data-action="notcomplete" data-role="' . $role . '">' . get_string('marknotcompleted', 'local_lonet') . '</button>';
					}
				}
				if ($is_learner && self::can_rate($lesson)) {
					$html .= self::get_rate_button();
				}
				if ($lesson->studentcompleted > 0) {
					$html .= self::get_next_lesson_button($lesson);
				}
				if ($link = self::get_message_link($lesson)) {
					$html .= '<a class="btn btn-success btn-message" href="' . $link . '" target="_blank" rel="noopener noreferrer"><span class="fa fa-comment"></span> ' . get_string('contact' . ($is_learner ? 'teacher' : 'learner'), 'local_lonet') . '</a>';
				}				
				break;
			//case self::STATUS_DECLINED:
			//case self::STATUS_EXPIRED:
			//case self::STATUS_CANCELED:
			case self::STATUS_COMPLETED:
				if ($is_learner && self::can_rate($lesson)) {
					$html .= self::get_rate_button();
				}
				if ($is_learner) {
					$html .= self::get_next_lesson_button($lesson);
				}
				break;
		}
		return $html;
	}
	public static function get_lesson_html($lesson) {
		global $USER;
		$teacher = self::get_teacher($lesson);
		$learner = self::get_learner($lesson);
		$is_learner = ($USER->id == $lesson->studentid);
		$is_teacher = ($USER->id == $lesson->teacherid);
		$html = '<div class="row row-lesson ' . ($lesson->canceltime ? 'bg-danger' : '') . '" data-id="' . $lesson->id . '">
			<div class="col-xs-9">
				<div class="row">
					<div class="col-sm-4">
						' . self::get_time_label($lesson) . '
					</div>
					<div class="col-sm-4">
						' . self::get_name($lesson, true) . '
						' . ($is_learner || is_siteadmin() ? '<br>' . get_string('with', 'local_lonet') . ' <a href="/teacher/' . $teacher->id . '" target="_blank">' . fullname($teacher, true) . '</a>' : '') . '
						' . ($is_teacher || is_siteadmin() ? '<br>' . get_string('with', 'local_lonet') . ' <a href="/user/' . $learner->id . '" target="_blank">' . $learner->firstname . '</a>' : '') . '
					</div>
					<div class="col-sm-4">
						' . self::get_status_label($lesson) . '
					</div>
				</div>
			</div>
			<div class="col-xs-3">
				' . self::get_buttons_html($lesson) . '
			</div>
		</div>';		
		return $html;
	}
	public static function get_lesson_html_profile($lesson) {
		global $USER;
		$teacher = self::get_teacher($lesson);
		$learner = self::get_learner($lesson);
		$is_learner = ($USER->id == $lesson->studentid);
		$is_teacher = ($USER->id == $lesson->teacherid);
		$html = '<div class="row row-lesson ' . ($lesson->canceltime ? 'bg-danger' : '') . '" data-id="' . $lesson->id . '">
					<div class="lessoninfo">
						<span class="lname">' . self::get_name($lesson, true) . '</span>
						<span class="with">' . ($is_learner || is_siteadmin() ? '<br>' . get_string('with', 'local_lonet') . ' <a href="/teacher/' . $teacher->id . '" target="_blank">' . fullname($teacher, true) . '</a>' : '') . '
						' . ($is_teacher || is_siteadmin() ? '<br>' . get_string('with', 'local_lonet') . ' <a href="/user/' . $learner->id . '" target="_blank">' . $learner->firstname . '</a>' : '') . '<span class="lname">
					</div>
					<div class="timeinfo">
						' . self::get_time_label_profile($lesson) . '
					</div>
					<div class="lessonstatus">
						' . self::get_status_label($lesson) . '
					</div>
					<div class="buttons">
					' . self::get_buttons_html($lesson) . '
					</div>
		</div>';		
		return $html;
	}

    public static function getLessonNameForTeacher($lesson) {
		global $DB;
		if($lesson->isgrouplesson > 0){
			$getlearners = $DB->get_records_sql("SELECT * FROM {lonet_order_product} WHERE lessonid=".$lesson->lessonid." AND teacherid=".$lesson->teacherid." AND status =1 AND isgrouplesson=1");
			$userinfo = [];
			foreach($getlearners as $singlelearner){
				$userdetail = $DB->get_record_sql("SELECT * FROM {user} WHERE id=".$singlelearner->studentid."");
				$userinfo[] = ' <a href="/user/' . $userdetail->id . '" target="_blank">' . $userdetail->firstname . '</a>';
			}
			return self::get_name($lesson, true) . '<br>' . get_string('with', 'local_lonet') . implode(', ',$userinfo);
		}else{
			$learner = self::get_learner($lesson);
			return self::get_name($lesson, true) . '<br>' . get_string('with', 'local_lonet') . ' <a href="/user/' . $learner->id . '" target="_blank">' . $learner->firstname . '</a>';
		}
    }
	public static function get_lesson_for_payout_html($lesson, $checked = false) {
		global $USER;
		$learner = self::get_learner($lesson);
		$amount = self::get_payout_amount($lesson);
		//added by Nitesh
		$sixmonth = strtotime('-180 days');
		$disab = ($lesson->starttime <= $sixmonth) ? true : false;
		$html = '<tr data-id="' . $lesson->id . '">
			<td>' . $lesson->id . '</td>
			<td>' . self::get_name($lesson, true) . '</td>
			<td>' . self::get_time_label($lesson) . '</td>
			<td><a href="/user/' . $learner->id . '" target="_blank">' . $learner->firstname . '</a></td>
			<td style="width:100px;text-align:center;">&euro;' . $amount . '</td>
			<td>' . self::get_status_label($lesson) . '</td>
			<td>
				' . ($amount < 0 ? '<input type="hidden" name="PayoutRequest[lessons][]" value="' . $lesson->id . '">' : '') . '
				<input type="checkbox" class="checkbox payout-confirmation-checkbox" id="confirm-' . $lesson->id . '" name="PayoutRequest[lessons][]" value="' . $lesson->id . '" ' . ($amount < 0 || $checked ? 'checked' : '') . ($amount < 0 || $disab ?  ' disabled' : '')  . '>
				<label for="confirm-' . $lesson->id . '"></label>
			</td>
		</tr>';		
		return $html;
	}
	
    public static function get_by_id($id) {
        global $DB;
        return $DB->get_record('lonet_order_product', ['id' => $id]);
    }

	public static function get_teacher_lessons($teacher = null) {
        global $DB;
		if (!$teacher) {
			global $USER;
			$teacher = $USER;
		}
		return $DB->get_records_sql('
			SELECT
				sc.*,
				l.name as `name`
			FROM {lonet_order_product} sc
			LEFT JOIN {lonet_lesson} l ON l.id = sc.lessonid
			WHERE sc.isgrouplesson = 0 AND sc.teacherid = ' . $teacher->id . '
				AND sc.status IN (' . self::STATUS_CONFIRMED . ', ' . self::STATUS_CANCELED . ', ' . self::STATUS_COMPLETED . ', ' . self::STATUS_NOTCOMPLETED . ')
			ORDER BY sc.starttime DESC
		') +  $DB->get_records_sql('
			SELECT
				sc.*,
				l.lessonname as `name`
			FROM {lonet_order_product} sc
			LEFT JOIN {lonet_group_lessons} l ON l.id = sc.lessonid
			WHERE sc.isgrouplesson = 1 AND sc.teacherid = ' . $teacher->id . '
				AND sc.status IN (' . self::STATUS_CONFIRMED . ', ' . self::STATUS_CANCELED . ', ' . self::STATUS_COMPLETED . ', ' . self::STATUS_NOTCOMPLETED . ')
			ORDER BY sc.starttime DESC
		');
	}
	public static function get_upcoming_teacher_lessons($teacher = null) {
        global $DB;
		if (!$teacher) {
			global $USER;
			$teacher = $USER;
		}
		return $DB->get_records_sql('
			SELECT
				sc.*,
				l.name as `name`
			FROM {lonet_order_product} sc
			LEFT JOIN {lonet_lesson} l ON l.id = sc.lessonid
			WHERE sc.isgrouplesson=0 AND sc.teacherid = ' . $teacher->id . '
				AND sc.endtime > ' . time() . '
			ORDER BY sc.starttime ASC
		')
		+
		$DB->get_records_sql('
			SELECT
				sc.*,
				l.lessonname as `name`
			FROM {lonet_order_product} sc
			LEFT JOIN {lonet_group_lessons} l ON l.id = sc.lessonid
			WHERE sc.isgrouplesson= 1 AND sc.teacherid = ' . $teacher->id . '
				AND sc.endtime > ' . time() . '
			ORDER BY sc.starttime ASC
		');
	}

	public static function get_student_lessons($student = null, $teacherid = null) {
        global $DB;
		if (!$student) {
			global $USER;
			$student = $USER;
		}		
		return $DB->get_records_sql('
			SELECT
				sc.*,
				l.name as `name`
			FROM {lonet_order_product} sc
			LEFT JOIN {lonet_lesson} l ON l.id = sc.lessonid
			WHERE sc.isgrouplesson=0 AND sc.studentid = ' . $student->id . '
				AND sc.status IN (' . self::STATUS_CONFIRMED . ', ' . self::STATUS_CANCELED . ', ' . self::STATUS_COMPLETED . ', ' . self::STATUS_NOTCOMPLETED . ')
				' . ($teacherid ? 'AND sc.teacherid = ' . $teacherid : '') . '
			ORDER BY sc.starttime DESC
		')
		+
		$DB->get_records_sql('
			SELECT
				sc.*,
				l.lessonname as `name`
			FROM {lonet_order_product} sc
			LEFT JOIN {lonet_group_lessons} l ON l.id = sc.lessonid
			WHERE sc.isgrouplesson=1 AND sc.studentid = ' . $student->id . '
				AND sc.status IN (' . self::STATUS_CONFIRMED . ', ' . self::STATUS_CANCELED . ', ' . self::STATUS_COMPLETED . ', ' . self::STATUS_NOTCOMPLETED . ')
				' . ($teacherid ? 'AND sc.teacherid = ' . $teacherid : '') . '
			ORDER BY sc.starttime DESC
		');
	}
	public static function get_upcoming_student_lessons($student = null, $teacherid = null) {
        global $DB;
		if (!$student) {
			global $USER;
			$student = $USER;
		}
		return $DB->get_records_sql('
			SELECT
				sc.*,
				l.name as `name`
			FROM {lonet_order_product} sc
			LEFT JOIN {lonet_lesson} l ON l.id = sc.lessonid
			WHERE sc.isgrouplesson=0 AND sc.studentid = ' . $student->id . '
				AND sc.endtime > ' . time() . '
			' . ($teacherid ? 'AND sc.teacherid = ' . $teacherid : '') . '
			ORDER BY sc.starttime ASC
		')
		+
		$DB->get_records_sql('
			SELECT
				sc.*,
				l.lessonname as `name`
			FROM {lonet_order_product} sc
			LEFT JOIN {lonet_group_lessons} l ON l.id = sc.lessonid
			WHERE sc.isgrouplesson=1 AND sc.studentid = ' . $student->id . '
				AND sc.endtime > ' . time() . '
			' . ($teacherid ? 'AND sc.teacherid = ' . $teacherid : '') . '
			ORDER BY sc.starttime ASC
		');
	}
    
    public static function getLessonData(&$lessons) {
        $data = [];
        foreach ($lessons as $lesson) {
            $teacher = self::get_teacher($lesson);
            $learner = self::get_learner($lesson);
			if($lesson->starttime < time()){
				$diff = time() - $lesson->starttime;
				$fullDays    = abs(floor($diff/(60*60*24)));	
			}else{
				$fullDays = 0;
			}

            $data[] = [
                'id' => $lesson->id,
                // 'date' => self::get_date($lesson),
                // 'time' => self::get_time($lesson),
                'datetime' => self::get_time_label($lesson),
                'name' => self::get_name($lesson),
                'language' => category::get_name($lesson->language),
                'tutor' => '<a href="/teacher/' . $teacher->id . '" target="_blank">' . fullname($teacher, true) . '</a>', 
                'learner' => '<a href="/user/' . $learner->id . '" target="_blank">' . $learner->firstname . '</a>', 
                'status' => ($fullDays > 180) ? 'Expired' : self::get_status_label($lesson),
                'actions' => ($fullDays > 180) ? '' : self::get_buttons_html($lesson),
                'html_class' => $lesson->status == self::STATUS_CANCELED ? 'bg-danger' : ($lesson->status == self::STATUS_COMPLETED ? 'bg-success' : ''),
            ];
        }
        return $data;
    }

	public static function get_booked_lessons($teacherid) {
        global $DB;
		$records = $DB->get_records_sql('
			SELECT * FROM
			{lonet_order_product} op
			WHERE op.teacherid = ' . $teacherid . '
				AND op.status IN (' . self::STATUS_WAITING . ', ' . self::STATUS_CONFIRMED . ')
		');
		$cart_lessons = order::get_lessons();
		return array_merge($records, $cart_lessons);
	}
	public static function get_booked_times($teacherid) {
		global $USER;
		$times = [];
		$is_teacher = user::is_teacher($USER); //added by Nitesh
		foreach (self::get_booked_lessons($teacherid) as $i => $lesson) {
			if(!$is_teacher){
				if($lesson->isgrouplesson > 0){continue;}
			}
			$lesson = (object) $lesson;
			$length = $lesson->length;
			$datetime = (new DateTime('now', core_date::get_user_timezone_object()));
			while ($length > 0) {
				$length -= 1800;
				$datetime->setTimestamp($lesson->starttime + $length);
				$label = (clone $datetime)->format('Y-m-d H:i');
				$times[$label . '/' . (isset($lesson->id) ? $lesson->id : 'c' . $i)] = $label;
			}
		}
		return $times;
	}
	
    public static function get_name($lesson, $show_language = false) {
        global $DB;
		if(isset($lesson->isgrouplesson) && ($lesson->isgrouplesson > 0)){
			$record = lesson::get_grouplesson_by_id($lesson->lessonid);
		}else{
			$record = $DB->get_record('lonet_lesson', ['id' => $lesson->lessonid]);
		}
		return ($record ? $record->name . ($show_language && $lesson->language ? ' (' . category::get_name($lesson->language) . ')' : ''): '');
    }
	
	public static function get_date($lesson, $user = null) {
		return (new DateTime('now', core_date::get_user_timezone_object($user)))->setTimestamp($lesson->starttime)->format('D, M j, Y');
	}
	public static function get_time($lesson, $user = null) {
		return (new DateTime('now', core_date::get_user_timezone_object($user)))->setTimestamp($lesson->starttime)->format('H:i');
	}
	public static function get_time_label($lesson) {
		$html = '';
		$starttime = (new DateTime('now', core_date::get_user_timezone_object()))->setTimestamp($lesson->starttime);
		$endtime = (new DateTime('now', core_date::get_user_timezone_object()))->setTimestamp($lesson->endtime);
		if ((clone $starttime)->format('Y-m-d') == (clone $endtime)->format('Y-m-d')) {
			$html = (clone $starttime)->format('D, M j, Y') . '<br>' . $starttime->format('H:i') . ' - ' . $endtime->format('H:i');
		} else {
			$html = $starttime->format('D, M j, Y H:i') . ' - ' . $endtime->format('D, M j, Y H:i');
		}
		return $html;
	}
	public static function get_time_label_profile($lesson) {
		$html = '';
		$starttime = (new DateTime('now', core_date::get_user_timezone_object()))->setTimestamp($lesson->starttime);
		$endtime = (new DateTime('now', core_date::get_user_timezone_object()))->setTimestamp($lesson->endtime);
		if ((clone $starttime)->format('Y-m-d') == (clone $endtime)->format('Y-m-d')) {
			$html = (clone $starttime)->format('D, M j, Y') . '<br><span>' . $starttime->format('H:i') . ' - ' . $endtime->format('H:i').'</span>';
		} else {
			$html = $starttime->format('D, M j, Y H:i') . '<br> - ' . $endtime->format('D, M j, Y H:i');
		}
		return $html;									  
	}	
	public static function get_time_label_date($lesson) {
		$html = '';
		$starttime = (new DateTime('now', core_date::get_user_timezone_object()))->setTimestamp($lesson->starttime);
		$endtime = (new DateTime('now', core_date::get_user_timezone_object()))->setTimestamp($lesson->endtime);
		if ((clone $starttime)->format('Y-m-d') == (clone $endtime)->format('Y-m-d')) {
			$html = (clone $starttime)->format('D, M j, Y');
		} else {
			$html = $starttime->format('D, M j, Y H:i') . ' - ' . $endtime->format('D, M j, Y H:i');
		}
		return $html;
	}
	public static function get_time_label_time($lesson) {
		$html = '';
		$starttime = (new DateTime('now', core_date::get_user_timezone_object()))->setTimestamp($lesson->starttime);
		$endtime = (new DateTime('now', core_date::get_user_timezone_object()))->setTimestamp($lesson->endtime);
		if ((clone $starttime)->format('Y-m-d') == (clone $endtime)->format('Y-m-d')) {
			$html = $starttime->format('H:i') . ' - ' . $endtime->format('H:i');
		} else {
			$html = $starttime->format('D, M j, Y H:i') . ' - ' . $endtime->format('D, M j, Y H:i');
		}
		return $html;
	}  
	public static function can_rate($lesson) {
		global $DB;
		global $USER;
		if (
			$lesson->endtime < time()
			&& !$lesson->rating
			&& ($lesson->studentid === $USER->id || is_siteadmin())
			&& ($lesson->studentcompleted > 1 || $lesson->status == self::STATUS_COMPLETED)
		) {
			return true;
		}
		return false;		  
	}
	
	public static function get_payout_amount($lesson) {
        if ($lesson->payoutamount !== null && $lesson->status == self::STATUS_COMPLETED) {
            return $lesson->payoutamount;
        }
		$amount = 0;
		switch ($lesson->status) {
			//case self::STATUS_WAITING:
			//case self::STATUS_CONFIRMED:
			//case self::STATUS_DECLINED:
			//case self::STATUS_EXPIRED:
			case self::STATUS_CANCELED:
                if ($lesson->cancellerid == $lesson->teacherid) {
                    $amount = $lesson->commission * (-1);
                }
				if ($lesson->canceltime > ($lesson->starttime - 43200)) {
					if ($lesson->cancellerid == $lesson->studentid) {
                        if ($lesson->payoutamount !== null) {
                            $amount = $lesson->payoutamount;
                        } else {
                            $amount = $lesson->price - $lesson->commission;
                        }
					}
				}
				break;
			case self::STATUS_COMPLETED:
				$amount = $lesson->price - $lesson->commission;
				break;
			case self::STATUS_NOTCOMPLETED:
				if (
                    (
                        $lesson->teachernotcompletereason == 'Learner didn\'t show up.'
                        || strstr(strtolower($lesson->teachernotcompletereason), 'learner')
                        || !$lesson->teachernotcompletereason
                    )
                    && (
                        (
                            $lesson->studentnotcompletereason != 'Teacher didn\'t show up.'
                            && !strstr(strtolower($lesson->studentnotcompletereason), 'teacher')
                        )
                        || !$lesson->studentnotcompletereason
                    )
                ) {
                    if ($lesson->payoutamount !== null) {
                        $amount = $lesson->payoutamount;
                    } else {
                        $amount = $lesson->price - $lesson->commission;
                    }
				} else {
					$amount = $lesson->commission * (-1);
				}
				break;
		}
		return $amount;//|| strstr(strtolower($lesson->teachernotcompletereason), 'student')
	}
	
	public static function get_message_link($lesson) {
		global $USER;
		$path = false;
		if ($lesson->status == self::STATUS_CONFIRMED && $lesson->starttime > time()) {
			$path = '/message/index.php';
			if ($USER->id === $lesson->studentid) {
				$path .= '?id=' . $lesson->teacherid;
			} elseif ($USER->id === $lesson->teacherid) {
				$path .= '?id=' . $lesson->studentid;
			} else {
				$path = false;
			}
		}
		return $path;		  
	}
	
	public static function get_teacher($lesson) {
		global $DB;
		return $DB->get_record('user', ['id' => $lesson->teacherid]);
	}
	public static function get_learner($lesson) {
		global $DB;
		return $DB->get_record('user', ['id' => $lesson->studentid]);
	}
    
    public static function addTeacherReward(&$lesson, &$student) {
		global $DB;
        if ($lesson->status == self::STATUS_COMPLETED) {
            if ($student->url && $DB->count_records('lonet_order_transaction', ['transactionid' => "{$student->url}-{$student->id}"]) < 2) {
                $teacher = user::get_by_id(user::getIdByReferralCode($student->url));
                user::addReferralReward($teacher, $student->url, $student->id);
            }
        }
    }
	
	public static function get_status_label($lesson, $for_admin = false) {
		$status = self::$statuses[$lesson->status];
		$comment = '';
        switch ($lesson->status) {
            case self::STATUS_DECLINED:
            case self::STATUS_EXPIRED:
            case self::STATUS_CANCELED:
                if ($lesson->status == self::STATUS_EXPIRED && $for_admin) {
                    $status = 'expired';
                } elseif (in_array($lesson->status, [self::STATUS_CANCELED, self::STATUS_DELETED])) {
                    $status .= ($lesson->cancellerid == $lesson->teacherid ? 'byteacher' : ($lesson->cancellerid == $lesson->studentid ? 'bylearner' : ''));
                }
                $start = (new \DateTime())->setTimestamp($lesson->starttime);
                $cancel = (new \DateTime())->setTimestamp($lesson->canceltime);
                $diff = $start->diff($cancel);
                if ($diff->days > 3) {
                    $comment = '<br><i>' . $diff->days . ' days before lesson</i>';
                } else {
                    $hours = ($diff->d * 24) + $diff->h;
                    $comment = '<br><i>' . $hours . ' hour' . ($hours > 1 ? 's ' : ' ') . ($hours >= 12 ? '' : ($diff->m > 0 ? $diff->m . ' minutes ' : '')) . 'before lesson</i>';
                }
                break;
            case self::STATUS_NOTCOMPLETED:
                $comment = ($lesson->teachernotcompletereason ? '<br>T: <i>' . $lesson->teachernotcompletereason . '</i>' : '');
                $comment .= ($lesson->studentnotcompletereason ? '<br>S: <i>' . $lesson->studentnotcompletereason . '</i>' : '');
        }
		return ($status ? '<span class='.$status.'>'.get_string($status, 'local_lonet') : '') . $comment.'</span>';
	}
	
	public static function get_cancel_reasons() {
		return [
			'The requested time is not available any more. Failed to update my schedule.'
				=> 'The requested time is not available any more. Failed to update my schedule.',
			'Due to personal reasons have to decline/cancel this request.'
				=> 'Due to personal reasons have to decline/cancel this request.',
			//'other' => 'Other Reason',
		];
	}
	public static function get_notcomplete_reasons() {
		return [
			'Learner didn\'t show up.' => 'Learner didn\'t show up.',
			'Teacher didn\'t show up.' => 'Teacher didn\'t show up.',
			//'other' => 'Other Reason',
		];
	}
    
    public static function sendRequestReminder($lesson) {
		global $CFG;
		global $DB;
        
        $teacher = get_complete_user_data('id', $lesson->teacherid);
        $transaction = $DB->get_record('lonet_order_transaction', ['orderid' => $lesson->orderid, 'iscompleted' => 1]);
        $lesson_count = count($DB->get_records('lonet_order_product', ['orderid' => $lesson->orderid]));
        $hours = 24;
        for ($i = 21600; $i <= 64800; $i += 21600) {
            if ($transaction->createdat + $i == $lesson->next_reminder) {
                $hours -= ($i / 21600) * 6;
                break;
            }
        }
        $lesson->next_reminder = ($hours > 6 ? $lesson->next_reminder + 21600 : null);
        $DB->update_record('lonet_order_product', $lesson);
        
        sendMail($teacher, 'newrequestreminder', [
            'fullname' => fullname($teacher, true),
            'reference' => $transaction->reference,
            'count' => $lesson_count,
            'hours' => $hours,
            'profilelink' => '<a href="' . $CFG->wwwroot . '/user/profile.php?teacher_profile=1">' . get_string('profilepage', 'local_lonet') . '</a>',
        ]);  
    }
	
	public static function send_reminder($lesson) { //finds one reminder to send and sends it
		global $CFG;
		global $DB;
		global $SESSION;
		$continue = false;
		$attributes = [
			'studentreminder24sent' => 24,
			'teacherreminder24sent' => 24,
			'studentreminder1sent' => 1,
			'teacherreminder1sent' => 1,
		];
		foreach ($attributes as $attribute => $hours) {
			if (!$lesson->$attribute) {
				$student = $DB->get_record('user', ['id' => $lesson->studentid]);
				$teacher = $DB->get_record('user', ['id' => $lesson->teacherid]);
                $recipient_attr = strpos($attribute, 'student') !== false ? 'student' : 'teacher';
				$recipient = ${$recipient_attr};
				profile_load_data($recipient);
                $SESSION->lang = $recipient->lang ?: 'en';
				if ($recipient->{'profile_field_reminder' . $hours . 'h'}) {
					$lesson->$attribute = 1;
					$DB->update_record('lonet_order_product', $lesson);
					sendMail($recipient, 'lessonremind' . $recipient_attr, [
						'fullname' => fullname($recipient, true),
						'teacherfullname' => fullname($teacher, true),
						'studentfullname' => fullname($student, true),
						'lessonname' => self::get_name($lesson),
						'lessondate' => self::get_date($lesson, $recipient),
						'lessontime' => self::get_time($lesson, $recipient),
						'profilelink' => '<a href="' . $CFG->wwwroot . '/user/profile.php">' . get_string('profilepage', 'local_lonet') . '</a>',
					]);
					break;
				}
			}
		}
	}
	
	public static function send_status_request($lesson) { //finds one status request to send and sends it
		global $CFG;
		global $DB;
		global $SESSION;
        $student = $DB->get_record('user', ['id' => $lesson->studentid]);
        $teacher = $DB->get_record('user', ['id' => $lesson->teacherid]);
		if (!$lesson->teacherstatusrequestsent && !$lesson->teachercompleted) {
			$recipient = $teacher;
            $recipient_attr = 'teacher';
			$lesson->teacherstatusrequestsent = 1;
		} elseif (!$lesson->studentstatusrequestsent && !$lesson->studentcompleted) {
			$recipient = $student;
            $recipient_attr = 'student';
			$lesson->studentstatusrequestsent = 1;
		}
		if (isset($recipient)) {
            $SESSION->lang = $recipient->lang ?: 'en';
            $button_style = 'color:#ffffff;padding:4px 12px;margin-right:10px;border-radius:4px;text-decoration:none;white-space:nowrap;line-height:2;';
            $attributes = [
				'fullname' => fullname($recipient, true),
                'lessonname' => self::get_name($lesson),
                'teacherfullname' => fullname($teacher, true),
                'studentfullname' => fullname($student, true),
				'lessondate' => self::get_date($lesson, $recipient),
				'lessontime' => self::get_time($lesson, $recipient),
                'complete' => '<a href="' . $CFG->wwwroot . '/local/lonet/respond.php?id=' . $lesson->id . '&action=complete" style="background:#499306;' . $button_style . '">' . get_string('markcompleted', 'local_lonet') . '</a>',
                'notcomplete' => '<a href="' . $CFG->wwwroot . '/local/lonet/respond.php?id=' . $lesson->id . '&action=notcomplete" style="background:#d9534f;' . $button_style . '">' . get_string('marknotcompleted', 'local_lonet') . '</a>',
            ];            
			$DB->update_record('lonet_order_product', $lesson);
			sendMail($recipient, 'lessonstatusrequest' . $recipient_attr, $attributes);
		}
	}
	
	public static function send_feedback_request($lesson) { //finds one feedback request to send and sends it
		global $CFG;
		global $DB;
		global $SESSION;
        $learner = $DB->get_record('user', ['id' => $lesson->studentid]);
        $teacher = $DB->get_record('user', ['id' => $lesson->teacherid]);
        if ($learner && $teacher) {
            $SESSION->lang = $learner->lang ?: 'en';
            $button_style = 'color:#ffffff;padding:4px 6px;border-radius:4px;text-decoration:none;white-space:nowrap;line-height:2;';
            $language = $SESSION->lang == 'ru' ? category::get_name($lesson->language, false, true) : category::get_name($lesson->language);
            $attributes = [
                'firstname' => $learner->firstname,
                'teacherfullname' => fullname($teacher, true),
                'language' => $language,
                'button' => '<a href="' . $CFG->wwwroot . '/local/lonet/rate.php?lessonid=' . $lesson->id . '" style="background:#499306;' . $button_style . '">' . get_string('leaveyourreview', 'local_lonet') . '</a>',
            ];
            
            $lesson->feedbackrequestsent = 1;
            $DB->update_record('lonet_order_product', $lesson);
            
            sendMail($learner, 'lessonfeedbackrequest', $attributes, false);
		}
	}
	
	public static function get_rate_button() {
		$button =  '<button class="btn btn-success btn-rate-teacher">' . get_string('rate', 'local_lonet') . ' ';
		for ($i = 0; $i < 5; $i++) {
			$button .= '<span class="fa fa-star"></span>';
		}
		$button .= '</button>';
		return $button;
	}
	public static function get_next_lesson_button($lesson) {
		// return '<a href="/teacher/' . $lesson->teacherid . '?book=1" class="btn btn-success">' . get_string('booknextlesson', 'local_lonet') . '</a>';
		return '<a href="/teacher/' . $lesson->teacherid . '" class="btn btn-success bookagain">' . get_string('bookagain', 'local_lonet') . '</a>';
	}
    
    public static function getNotCompleteByStudentSql() {
        return "(
            (
                op.teachernotcompletereason = 'Learner didn\'t show up.'
                OR LOWER(op.teachernotcompletereason) LIKE '%learner%'
                OR op.teachernotcompletereason IS NULL
            )
            AND (
                (
                    op.studentnotcompletereason <> 'Teacher didn\'t show up.'
                    AND LOWER(op.studentnotcompletereason) NOT LIKE '%teacher%'
                )
                OR op.studentnotcompletereason IS NULL
            )
        )";//OR LOWER(op.teachernotcompletereason) LIKE '%student%'  AND LOWER(op.studentnotcompletereason) NOT LIKE '%lonet%'
    }
    public static function getNotCompleteByTeacherSql() {
        return 'NOT ' . self::getNotCompleteByStudentSql();
    }
}
