<?php
defined('MOODLE_INTERNAL') || die();

$tasks = [
	[
		'classname' => 'local_lonet\task\send_request_reminders',
		'minute' => '*/5',
		'hour' => '*',
		'day' => '*',
		'dayofweek' => '*',
		'month' => '*'
	],
	[
		'classname' => 'local_lonet\task\send_reminders',
		'minute' => '*/5',
		'hour' => '*',
		'day' => '*',
		'dayofweek' => '*',
		'month' => '*'
	],
	[
		'classname' => 'local_lonet\task\send_reminders_notbooked_lesson',
		'minute' => '*/5',
		'hour' => '*',
		'day' => '*',
		'dayofweek' => '*',
		'month' => '*'
	],	
	[
		'classname' => 'local_lonet\task\send_status_requests',
		'minute' => '*/5',
		'hour' => '*',
		'day' => '*',
		'dayofweek' => '*',
		'month' => '*'
	],
	[
		'classname' => 'local_lonet\task\send_feedback_requests',
		'minute' => '0',
		'hour' => '*',
		'day' => '*',
		'dayofweek' => '*',
		'month' => '*'
	],
	[
		'classname' => 'local_lonet\task\expire_requests',
		'minute' => '0',
		'hour' => '*',
		'day' => '*',
		'dayofweek' => '*',
		'month' => '*'
	],
	[
		'classname' => 'local_lonet\task\update_statuses',
		'minute' => '0',
		'hour' => '*',
		'day' => '*',
		'dayofweek' => '*',
		'month' => '*'
	],
	[
		'classname' => 'local_lonet\task\clear_schedule',
		'minute' => '0',
		'hour' => '0',
		'day' => '*',
		'dayofweek' => '*',
		'month' => '*'
	],
	[
		'classname' => 'local_lonet\task\cache_posts',
		'minute' => '15',
		'hour' => '*',
		'day' => '*',
		'dayofweek' => '*',
		'month' => '*'
	],
//	[
//		'classname' => 'local_lonet\task\record_history',
//		'minute' => '*/5',
//		'hour' => '*',
//		'day' => '*',
//		'dayofweek' => '*',
//		'month' => '*'
//	],
];
