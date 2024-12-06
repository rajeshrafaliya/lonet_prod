<?php
namespace local_lonet;

defined('MOODLE_INTERNAL') || die();

use \core_date;
use \DateTime;

class schedule {
    private static $timeList;
    
    public static function get_by_teacherid($teacherid) {
        global $DB;
        return $DB->get_records('lonet_schedule', ['teacherid' => $teacherid]);
    }
	
	public static function get_blocked_days($teacherid) {
        global $DB;
		$records = $DB->get_records_sql('
			SELECT * FROM
			{lonet_schedule} s
			WHERE s.teacherid = ' . $teacherid . '
				AND s.weekdays IS NOT NULL
				AND s.datefrom IS NULL
				AND s.timefrom IS NULL
		');
		if (!$records) {
			if ($DB->insert_record('lonet_schedule', [
				'teacherid' => $teacherid,
				'weekdays' => '[]',
			])) {
				$records = self::get_blocked_days($teacherid);
			}
		}
		return $records;
	}
	public static function get_blocked_dates($teacherid) {
        global $DB;
		$records = $DB->get_records_sql('
			SELECT * FROM
			{lonet_schedule} s
			WHERE s.teacherid = ' . $teacherid . '
				AND s.weekdays IS NULL
				AND s.datefrom IS NOT NULL
				AND s.timefrom IS NULL
		');
		return $records;
	}
	public static function get_blocked_times($teacherid) {
        global $DB;
		$result = [];
		$records = $DB->get_records_sql('
			SELECT * FROM
			{lonet_schedule} s
			WHERE s.teacherid = ' . $teacherid . '
				AND s.weekdays IS NULL
				AND s.datefrom IS NULL
				AND s.timefrom IS NOT NULL
		');
        $userTimezone = core_date::get_user_timezone_object();
		foreach ($records as $record) { //setting time labels
			$record->timefrom = (new DateTime('now', $userTimezone))->setTimestamp($record->timefrom)->format('H:i:s');
			$record->timeto = (new DateTime('now', $userTimezone))->setTimestamp($record->timeto)->format('H:i:s');
			if ($record->timefrom > $record->timeto) { //breaking into two intervals
				if ($record->timeto > '00:29:59') {
					$result[] = (object) ['id' => $record->id, 'isdst' => $record->isdst, 'timefrom' => '00:00:00', 'timeto' => $record->timeto];
				}
				if ($record->timefrom < '23:29:59') {
					$result[] = (object) ['id' => $record->id, 'isdst' => $record->isdst, 'timefrom' => $record->timefrom, 'timeto' => '23:59:00'];
				}
			} else {
				$result[] = $record;
			}
		}
		return $result;
	}
	public static function get_blocked_datetimes($teacherid) {
        global $DB;
        $result = [];
		$records = $DB->get_records_sql('
			SELECT * FROM
			{lonet_schedule} s
			WHERE s.teacherid = ' . $teacherid . '
				AND s.weekdays IS NULL
				AND s.datefrom IS NOT NULL
				AND s.timefrom IS NOT NULL
				AND (s.datefrom > ' . time() . ' OR s.dateto > ' . time() . ')
		');
        $userTimezone = core_date::get_user_timezone_object();
		foreach ($records as $record) { //setting time labels
			$record->timefrom = (new DateTime('now', $userTimezone))->setTimestamp($record->timefrom)->format('H:i:s');
			$record->timeto = (new DateTime('now', $userTimezone))->setTimestamp($record->timeto)->format('H:i:s');
			if ($record->timefrom > $record->timeto) { //breaking into two intervals
				if ($record->timeto > '00:29:59') {
					$r1 = clone $record;
					$r1->timefrom = '00:00:00';
					$result[] = $r1;
				}
				if ($record->timefrom < '23:29:59') {
					$r2 = clone $record;
					$r2->timeto = '23:59:00';
					$result[] = $r2;
				}
			} else {
				$result[] = $record;
			}
		}
		return $result;
	}

	public static function get_blocked($teacherid) {
        global $DB;
		$blocked = [];
		$timestamp = time();
		$datecheck = '(s.dateto IS NULL OR (s.datefrom >= ' . $timestamp . ' AND s.dateto > ' . $timestamp . '))';
		
		$blocked['days'] = self::get_blocked_days($teacherid);
		$blocked['dates'] = self::get_blocked_dates($teacherid);
		$blocked['times'] = self::get_blocked_times($teacherid);
		$blocked['datetimes'] = self::get_blocked_datetimes($teacherid);

		return $blocked;
	}

	public static function get_schedule($teacherid, $week = 0, $edit = false) {
		global $DB;
		$array = [];		
		$blocked = self::get_blocked($teacherid);		
		$dates = self::get_dates($week, $edit);
		$booked = order_product::get_booked_times($teacherid);
        $userTimezone = core_date::get_user_timezone_object();
		$currentYear = date('Y');
		$datetime_dst = new DateTime(''.$currentYear.'-06-01 00:00:00', $userTimezone);
		$datetime_notdst = new DateTime(''.$currentYear.'-12-01 00:00:00', $userTimezone);		
		// $datetime_dst = new DateTime('2017-06-01 00:00:00', $userTimezone);
		// $datetime_notdst = new DateTime('2017-12-01 00:00:00', $userTimezone);
		$waiting_ids = [];
		for ($i = 0; $i < 24; $i++) {
			$hours = ($i < 10 ? '0' : '') . $i;
			foreach (['00', '30'] as $index => $minutes) {
				if (!(!$i && !$index)) {
					$datetime_dst = $datetime_dst->modify('+30 minute');
					$datetime_notdst = $datetime_notdst->modify('+30 minute');
				}
				$time = $hours . ':' . $minutes;
				$label = ($index ? '&nbsp;' : $time);
				$timestamp_dst = $datetime_dst->getTimestamp();
				$timestamp_notdst = $datetime_notdst->getTimestamp();
				$timestring = $time . ':00';
				$classbytime = 'bg-success';
				$hide_time = false;
				foreach ($blocked['times'] as $blocked_time) {
					if (
						$timestring >= $blocked_time->timefrom
						&& (
							!$blocked_time->timeto
							|| $timestring < $blocked_time->timeto
						)
					) {
						$classbytime = '';
						if (
							$blocked_time->timefrom < '00:30:00'
							|| $blocked_time->timeto > '23:30:00'
						) {
							$hide_time = true;
						}
						break;
					}
				}
				if (!$hide_time) {
					$array[$time] = [
						'label' => $label,
						'days' => []
					];
				} else {
					continue;
				}
				foreach ($dates as $date => $label) {
					$class = $classbytime;
					$buttons = '';
					if (in_array($date . ' ' . $time, $booked)) {
						//$class = 'bg-unavailable';
						$class = '';
						if ($edit && $key = array_search($date . ' ' . $time, $booked)) {
							$key_parts = explode('/', $key);
							$lessonid = $key_parts[1];
							if ($lesson = $DB->get_record('lonet_order_product', ['id' => $lessonid])) {
                                switch ($lesson->status) {
                                    case order_product::STATUS_WAITING:
                                        $class = 'bg-danger';
                                        if (!isset($waiting_ids[$date]) || $waiting_ids[$date] != $lessonid) {
                                            $buttons = '
                                                <button class="btn-decline pull-right" data-action="decline" data-id="' . $lessonid . '">D</button>
                                                <button class="btn-confirm pull-right" data-action="confirm" data-id="' . $lessonid . '">C</button>
                                            ';
                                            $waiting_ids[$date] = $lessonid;
                                        }
                                        break;
                                    case order_product::STATUS_CONFIRMED:
                                    case order_product::STATUS_COMPLETED:
										if($lesson->isgrouplesson > 0){
											$groupmsg = '<span class=" pull-right">
                                            <a href="'.$CFG->wwwroot.'/local/lonet/groupmessage.php?lessonid='.$lesson->lessonid.'&teacherid='.$teacherid.'"><i class="fa fa-commenting-o pull-right" style="font-size: 16px; line-height: 1.4;"></i></a>
                                        </span>';
										}else{
											$groupmsg = '';
										}
                                        $buttons = '<span class="tooltip pull-right">
                                            <span class="fa fa-info-circle pull-right" style="font-size: 16px; line-height: 1.4;"></span>
                                            <span class="tooltiptext">' . order_product::getLessonNameForTeacher($lesson) . '</span>
                                        </span>'.$groupmsg.'';
                                }
							}
						}
					} else {
						$day = (new DateTime($date, $userTimezone))->format('N');
						$timestamp = (new DateTime($date . ' ' . $time, $userTimezone))->getTimestamp();
						if ($timestamp - time() < 86400) {
							$class = '';
						}
						if ($class) {
							foreach ($blocked['days'] as $blocked_day) {
								$days = (is_array($blocked_day->weekdays) ? $blocked_day->weekdays : json_decode($blocked_day->weekdays));
								if (in_array($day, $days)) {
									$class = '';
									break;
								}
							}
						}
						if ($class) {
							foreach ($blocked['dates'] as $blocked_date) {
								if (
									$timestamp >= $blocked_date->datefrom
									&& (
										!$blocked_date->dateto
										|| $timestamp <= ($blocked_date->dateto + 86400) //include date to as blocked
									)
								) {
									$class = '';
									break;
								}
							}
						}
						if ($class) {
							foreach ($blocked['datetimes'] as $blocked_datetime) {
                                $datestring_from = (new DateTime('now', $userTimezone))->setTimestamp($blocked_datetime->datefrom)->format('Y-m-d');
                                $datestring_to = $blocked_datetime->dateto ? (new DateTime('now', $userTimezone))->setTimestamp($blocked_datetime->dateto)->format('Y-m-d') : null;
								if (
									$timestamp == $blocked_datetime->timestamp
									||
									(
										!$blocked_datetime->timestamp
                                        && $date >= $datestring_from
										&& (
											!$blocked_datetime->dateto
                                            || $date < $datestring_to
										)
										&& $timestring >= $blocked_datetime->timefrom
										&& (
											!$blocked_datetime->timeto
											|| $timestring < $blocked_datetime->timeto
										)
									)
								) {
									$class = '';
									$buttons = '<button class="btn-unblockthis pull-right" data-action="unblock" data-id="' . $blocked_datetime->id . '">U</button>';
									break;
                                // } else {
                                // if ($date == '2020-11-24') {
                                    // var_dump($blocked_datetime);
                                // }
                                }
							}
						}
						if (!$buttons && $class == 'bg-success') {
							$buttons = '<button class="btn-blockthis pull-right" data-action="block">B</button>';
						}
					}
					$array[$time]['days'][$date] = [
						'class' => $class,
						'buttons' => $buttons,
						//will be adding other attributes as needed
					];
				}
			}
		}
		return $array;
	}
	
	public static function get_dates($week = 0, $edit = false) {
		$dates = [];
		$date = new DateTime(($edit ? 'now' : '+1 days'));
		if ($week > 0) {
			$date->modify('+' . ($week * 7) . ' days');
		}
		for ($i = 1; $i <= 7; $i++) {
			$dates[(clone $date)->format('Y-m-d')] = (clone $date)->format('D, M j');
			$date->modify('+1 day');
		}
		return $dates;
	}
	
	public static function get_times_array($direction) {
		$array = [];
		$timestamp = 0;
		for ($i = 0; $i <= 24; $i++) {
			$hours = ($i < 10 ? '0' : '') . $i;
			foreach (['00', '30'] as $minutes) {
				if ($i == 24 && ($minutes == '30' || $direction == 'from')) {
					break;
				}
				if ($direction == 'to' && $i == 0 && $minutes == '00') {
					$timestamp += 1800;
					continue;
				}
				$time = $hours . ':' . $minutes;
				$array[$timestamp] = $time;
				$timestamp += 1800;
			}
		}
		return $array;
	}
	
	public static function add_schedule($attributes) {
		$ins->id = insert_record('lonet_schedule', $attributes);
	}
    
    public static function getTimeList() {
        if (self::$timeList === null) {
            $result;
            for ($h = 0; $h < 24; $h++) {
                for ($m = 0; $m < 60; $m += 30) {
                    $value = sprintf('%02d', $h) . ':' . sprintf('%02d', $m);
                    $label = $value;
                    $value .= ':00';
                    $result[$value] = $label;
                }
            }
            $result['23:59:00'] = '24:00';
            self::$timeList = $result;
        }
        return self::$timeList;
    }
    
    public static function getTimeInput($name, $value, $options = []) {
        $result = '<select name="' . $name . '"';
        foreach ($options as $option => $option_value) {
            $result .= ' ' . $option . ($option_value !== true ? '="' . $option_value . '"' : '');
        }
        $result .= '>';
        $result .= '<option' . ($value === null ? ' selected' : '') . '></option>';
        foreach (self::getTimeList() as $time => $label) {
            $result .= '<option value="' . $time . '"' . ($time === $value ? ' selected' : '') . '>' . $label .'</option>';
        }
        $result .= '</select>';
        return $result;
    }
}
