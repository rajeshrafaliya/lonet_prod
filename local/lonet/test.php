<?php
use local_lonet\language;
use local_lonet\order;
use local_lonet\order_product;
use local_lonet\order_transaction;
use local_lonet\payout_request;
use local_lonet\promo_code;
use local_lonet\subscriber;
use local_lonet\teacher;
use local_lonet\user;

require_once('../../config.php');
require_once($CFG->dirroot.'/local/lonet/lib.php');

global $DB;
global $USER;

if (is_siteadmin()) {
    $PAGE->set_context(context_system::instance());
    
    /*
    foreach ([5569, 5496] as $id) {
        $lesson = order_product::get_by_id($id);
        $student = order_product::get_learner($lesson);
        $teacher = order_product::get_teacher($lesson);
        order_product::addTeacherReward($lesson, $student, $teacher);
    }
    */
    
    /* payout request email
    $payout_request = teacher::get_payout_request(483);
    sendMail($USER, 'payoutrequestrequested', [
        'fullname' => fullname($USER, true),
        'reference' => payout_request::get_reference($payout_request),
        'link' => $payout_request->id
    ]);
    */
    
    // echo promo_code::generateGiftCard('PC1589191220191', '100 EUR', date('d/m/y', time() +  + (86400 * 90)));
        
    // order_product::send_feedback_request($DB->get_record('lonet_order_product', ['id' => 1638]));
    
    /*
    foreach ($DB->get_records_sql("
        SELECT l.*
        FROM {lonet_language} l
        ORDER BY l.code ASC
    ") as $lang) {
        foreach (['listpromo', 'listdesc', 'meta_title_teacher_list', 'meta_description_teacher_list'] as $attr) {
            echo nl2br("\$string['{$attr}_{$lang->code}'] = '';\n");
        }
    }
    */
    
    // user::addUserToMailingList(2);
    
    /*
    foreach (teacher::get_active() as $teacher) {
        if (!in_array($teacher->id, [3, 342, 359, 380])) {
            if (
                $DB->insert_record('user_info_data', [
                    'userid' => $teacher->id,
                    'fieldid' => 23,
                    'data' => 1,
                ])
                && $DB->insert_record('user_info_data', [
                    'userid' => $teacher->id,
                    'fieldid' => 24,
                    'data' => 1,
                ])
            ) {
                //
            } else {
                echo '#' . $teacher->id;
            }
        }
    }
    */
    
    /*
    subscriber::sendSubscriberEmail('christina.forskip@gmail.com');
    subscriber::sendSubscriberEmail('grandovska@inbox.lv');
    subscriber::sendSubscriberEmail('lats200@inbox.lv');
    */
    /*
    echo $OUTPUT->header();
    echo '<button type="button" class="btn btn-primary" onClick="$(\'#image-popup\').modal(\'show\');">
        Launch demo modal
    </button>';
    echo renderFile('_email_popup.php');
    echo $OUTPUT->footer();
    */
    
	/*
	$user_copy = clone $USER;
	sendMail(get_admins()[25], 'userdeleted', ['fullname' => fullname($user_copy, true), 'email' => $user_copy->email, 'type' => get_string((user::is_teacher($user_copy) ? 'teacher' : 'learner'), 'local_lonet')]);
	*/


	/* send confirmation emails
	$student = $DB->get_record('user', ['id' => 67]);
	$teacher = $DB->get_record('user', ['id' => 3]);
	sendMail($student, 'paymentreceived', ['fullname' => 'Inga Rusanova', 'reference' => 'LONET75/1']);
	sendMail($teacher, 'newrequest', [
		'fullname' => 'Christina Baltach',
		'reference' => 'LONET75/1',
		'count' => 1,
		'profilelink' => '<a href="' . $CFG->wwwroot . '/user/profile.php?teacher_profile=1">' . get_string('profilepage', 'local_lonet') . '</a>',
	]);
	*/
	
	// transaction status
    $reference = (isset($_GET['r']) ? $_GET['r'] : null);
	if ($reference) {
		print_r(order_transaction::get_transaction_status($reference, null, 1));
	} else {
		echo order_transaction::call_test_setup();
	}
	//
	
	/*
	$lesson = $DB->get_record_sql('
		SELECT op.*
		FROM {lonet_order_product} op
		WHERE op.id = 68
	');
	if ($lesson) {
		if (!$lesson->studentcompleted) {
			$button_style = 'color:#ffffff;padding:4px 12px;margin-right:10px;border-radius:4px;text-decoration:none;';
			$attributes = [
				'lessonname' => order_product::get_name($lesson),
				'complete' => '<a href="' . $CFG->wwwroot . '/local/lonet/respond.php?id=' . $lesson->id . '&action=complete" style="background:#499306;' . $button_style . '">' . get_string('markcompleted', 'local_lonet') . '</a>',
				'notcomplete' => '<a href="' . $CFG->wwwroot . '/local/lonet/respond.php?id=' . $lesson->id . '&action=notcomplete" style="background:#d9534f;' . $button_style . '">' . get_string('marknotcompleted', 'local_lonet') . '</a>',
			];
			$student = $DB->get_record('user', ['id' => $lesson->studentid]);
			sendMail($student, 'lessonstatusrequest', array_merge($attributes, [
				'fullname' => fullname($student, true),
				'lessondate' => order_product::get_date($lesson, $student),
				'lessontime' => order_product::get_time($lesson, $student),
			]));
		}
	}
	*/
}