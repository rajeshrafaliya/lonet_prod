<?php
use local_lonet\payout_request;
use local_lonet\promo_code;
use local_lonet\user;

require_once('../../config.php');
require_once($CFG->dirroot.'/local/lonet/lib.php');
require_once($CFG->dirroot.'/user/profile/lib.php');

$is_bookkeeper = user::is_bookkeeper();
$is_seo_manager = user::is_seo_manager();
$is_teacher_manager = user::is_teacher_manager();

if (is_siteadmin() || $is_bookkeeper || $is_seo_manager || $is_teacher_manager) {
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		global $CFG;
		global $DB;
		global $USER;
		$redirect = true;
		$report = '';
		if (isset($_POST['action'])) {
			$id = (isset($_POST['id']) ? $_POST['id'] : null);
			switch ($_POST['action']) {
                case 'add':
                    $result = ['success' => true, 'error' => ''];
                    if (isset($_POST['Order']) && isset($_POST['OrderTransaction'])) {
                        $order_data = $_POST['Order'];
                        $transaction_data = $_POST['OrderTransaction'];
                        // if (isset($transaction_data['amount']) && $transaction_data['amount'] > 0 && isset($order_data['studentid']) && $student = $DB->get_record('user', ['id' => $order_data['studentid']])) {
                        if (isset($transaction_data['amount']) && isset($order_data['studentid']) && $student = $DB->get_record('user', ['id' => $order_data['studentid']])) {
                            $order_data['firstname'] = $student->firstname;
                            $order_data['lastname'] = $student->lastname;
                            $order_data['email'] = $student->email;
                            $order_data['ipaddress'] = $_SERVER['REMOTE_ADDR'];
                            $order_data['createdat'] = time();
                            if ($order_id = $DB->insert_record('lonet_order', $order_data)) {
                                $transaction_data['orderid'] = $order_id;
                                $transaction_data['attempt'] = 1;
                                $transaction_data['userid'] = $order_data['studentid'];
                                $transaction_data['isincoming'] = 1;
                                $transaction_data['iscompleted'] = 1;
                                $transaction_data['createdat'] = $order_data['createdat'];
                                if (!$DB->insert_record('lonet_order_transaction', $transaction_data)) {
                                    $result['success'] = false;
                                    $result['error'] = 'Unknown error occured while completing order. Please contact technical support2.';
                                }
                            } else {
                                $result['success'] = false;
                                $result['error'] = 'Unknown error occured while saving order. Please contact technical support1.';
                            }
                        } else {
                            $result['success'] = false;
                            $result['error'] = 'Some of required information is not correct.' . json_encode($_POST);
                        }
                    } else {
                        $result['success'] = false;
                        $result['error'] = 'Some of required information is not filled out.';
                    }
					echo json_encode($result);
					exit();
                    break;
				case 'activate':
				case 'approve':
					$report = 'teacher';
					if ($id && $teacher = $DB->get_record('user', ['id' => $id])) {
						if ($DB->insert_record('role_assignments', [
							'roleid' => 3,
							'contextid' => 1,
							'userid' => $id,
							'timemodified' => time(),
							'modifierid' => $USER->id,
						])) {
                            if ($_POST['action'] === 'approve') {
                                sendMail($teacher, 'teacherconfirmed', ['fullname' => fullname($teacher, true), 'link' => $CFG->wwwroot . '/best-language-platform-for-tutors-and-coaches']);
                            }
						}
					}
					break;
				case 'decline':
					$report = 'teacher';
					if ($id && $teacher = $DB->get_record('user', ['id' => $id])) {
						sendMail($teacher, 'teachernotconfirmed', ['fullname' => fullname($teacher, true)]);
						$data = ['userid' => $id, 'name' => 'teacher_declinetime'];
						if ($record = $DB->get_record('user_preferences', $data)) {
							$record->value = time();
							$DB->update_record('user_preferences', $record);
						} else {
							$data['value'] = time();
							$DB->insert_record('user_preferences', $data);
						}
					}
					break;
				case 'cancel':
					$report = 'teacher';
					if ($id && $teacher = $DB->get_record('user', ['id' => $id])) {
						$DB->delete_records('role_assignments', ['userid' => $id, 'roleid' => 3]);
					}
					break;
				case 'pay':
					$report = 'payout';
					if ($id && $record = $DB->get_record('lonet_payout_request', ['id' => $id])) {
						$record->paidat = time();
						$DB->update_record('lonet_payout_request', $record);
						$teacher = $DB->get_record('user', ['id' => $record->teacherid]);
						sendMail_booking($teacher, 'payoutrequestpaid', [
							'fullname' => fullname($teacher, true),
							'reference' => payout_request::get_reference($record),
							'date' => (new DateTime('now', core_date::get_user_timezone_object($teacher)))->setTimestamp($record->paidat)->format('D, M j, Y')
						]);
					}
					break;
				case 'save':
					$report = '';
					$result = ['success' => false, 'error' => ''];
                    $is_valid = false;
                    $table = '';
					if (isset($_POST['PromoCode']) && $data = $_POST['PromoCode']) {
                        $report = 'promo';
                        $table = 'lonet_promo_code';
                        if (!empty($data['createdat'])) {
                            $data['createdat'] = (new DateTime($data['createdat'], core_date::get_user_timezone_object()))->getTimestamp();
                        } elseif (empty($data['id'])) {
                            $data['createdat'] = time();
                        }
                        if (!empty($data['validthrough'])) {
                            $data['validthrough'] = (new DateTime($data['validthrough'], core_date::get_user_timezone_object()))->getTimestamp();
                        }
                        $is_valid = true;
                        if (!isset($data['isactive'])) {
                            if (
                                empty($data['code'])
                                || empty($data['type'])
                                || ($data['type'] == 'amount' && empty($data['amount']))
                                || (
                                    $data['type'] == 'discount'
                                    && (empty($data['discount']) || empty($data['lessoncountperlearner']))
                                )
                            ) {
                                $result['error'] = 'Some of required information is not filled out.';
                                $is_valid = false;
                            } elseif ($data['id'] == 0 && promo_code::get_by_code($data['code'])) {
                                $result['error'] = 'Promo code must be unique!';
                                $is_valid = false;	
                            }
                        }
					} elseif (isset($_POST['UserBadge']) && $data = $_POST['UserBadge']) {
                        $report = 'badge';
                        $table = 'lonet_user_badge';
                        $is_valid = true;
                        if (!isset($data['isactive'])) {
                            if (
                                empty($data['userid'])
                                || empty($data['badge'])
                            ) {
                                $result['error'] = 'Some of required information is not filled out.';
                                $is_valid = false;
                            }
                        }
					} elseif (isset($_POST['Testimonial']) && $data = $_POST['Testimonial']) {
                        $report = 'testimonial';
                        $table = 'lonet_testimonial';
                        if (!empty($data['createdat'])) {
                            $data['createdat'] = (new DateTime($data['createdat'], core_date::get_user_timezone_object()))->getTimestamp();
                        } else {
                            $data['createdat'] = time();
                        }
                        $is_valid = true;
                        if ($data['id'] == 0 && (empty($data['userid']) || empty($data['abstract']))) {
                            $result['error'] = 'Some of required information is not filled out.';
                            $is_valid = false;
                        }
					} elseif (isset($_POST['Language']) && $data = $_POST['Language']) {
                        $report = 'language';
                        $table = 'lonet_language';
                        $data['name'] = $data['name_en'];
                        foreach (['en', 'es', 'lv', 'ru'] as $code) {
                            $attr = 'url_' . $code;
                            $data[$attr] = strtolower($data[$attr]);
                        }
                        $data['url'] = $data['url_en'];
                        $is_valid = true;
                        if ($data['id'] == 0 && empty($data['name_en'])) {
                            $result['error'] = 'Some of required information is not filled out.';
                            $is_valid = false;
                        }
					}elseif (isset($_POST['groupLanguage']) && $data = $_POST['groupLanguage']) {
                        $report = 'language';
                        $table = 'lonet_language_group';
                        $data['name'] = $data['name_en'];
                        foreach (['en', 'es', 'lv', 'ru'] as $code) {
                            $attr = 'url_' . $code;
                            $data[$attr] = strtolower($data[$attr]);
                        }
                        $data['url'] = $data['url_en'];
                        $is_valid = true;
                        if ($data['id'] == 0 && empty($data['name_en'])) {
                            $result['error'] = 'Some of required information is not filled out.';
                            $is_valid = false;
                        }
					}
                    if ($is_valid) {
                        $result['success'] = true;
                        if (!empty($data['id'])) {
                            $DB->update_record($table, $data);
                        } else {
                            $DB->insert_record($table, $data);
                        }
                    }
					echo json_encode($result);
					exit();
					break;
			}
		}
		if ($redirect) {
			header('Location: ' . $CFG->wwwroot . '/local/lonet/admin.php' . ($report ? "?report=$report" : ''));
		}
		exit();
	}
    
    $tabs = ($is_bookkeeper
        ? ['order', 'cash', 'payout', 'promo']
        : ($is_seo_manager
            ? ['search', 'language']
            : ($is_teacher_manager
                ? ['teacher']
                : ['teacher', 'order', 'cash', 'payout', 'promo', 'search', 'testimonial', 'subscriber', 'language', 'badge']
            )
        )
    );
		
	$report = (isset($_GET['report']) ? $_GET['report'] : $tabs[0]);
	$title = get_string($report . 'report', 'local_lonet');

	$PAGE->set_context(context_system::instance());
	$PAGE->set_pagelayout('admin');
	$PAGE->set_title($title);
	$PAGE->set_heading($title);
	$PAGE->set_url('/local/lonet/admin.php');
	
	global $DB;	

	echo $OUTPUT->header();
?>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>

	<style>
        table {
            background: white;
        }
    </style>
    
    <script>
        $(document).on('click', '.btn-add', function(e) {
            $('.row-add').show();
        });
        $(document).on('click', '.btn-edit', function(e) {
            $(this).parents('tr').addClass('editable');
        });
        $(document).on('click', '.btn-cancel', function(e) {
            var row = $(this).parents('tr');
            if (row.hasClass('row-add')) {
                row.hide();
            } else {
                row.removeClass('editable');
            }
        });
    </script>
    
	<ul class="nav nav-tabs">
		<?php foreach ($tabs as $type) { ?>
			<li class="<?= ($type == $report ? 'active' : '') ?>"><a <?= ($type == $report ? '' : 'href="/local/lonet/admin.php?report=' . $type . '"') ?>><?= get_string($type . 'report', 'local_lonet') ?></a></li>
		<?php } ?>
	</ul>
	<div class="tab-content">
		<?= renderFile('_' . $report . '_report.php', $_GET) ?>
	</div>
	<br>
	<?= $OUTPUT->footer() ?>
<?php } else {
	global $CFG;
	header('Location: ' . $CFG->wwwroot);
} ?>
