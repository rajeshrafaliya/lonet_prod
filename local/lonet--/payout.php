<?php
use local_lonet\order_product;
use local_lonet\payout_request;
use local_lonet\teacher;

require_once('../../config.php');
require_once($CFG->dirroot.'/local/lonet/lib.php');

global $DB;
global $USER;

require_login();

$PAGE->set_context(context_system::instance());

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $action = (isset($_POST['action']) ? $_POST['action'] : null);
        if ($action) {
            $test = $not_existing;
            if ($action == 'calculate') {
                echo payout_request::get_amount($_POST['PayoutRequest']['lessons']);
                exit();
            } elseif (in_array($action, ['save', 'request'])) {			
                $result = ['status' => false];
                $payout_request = teacher::get_payout_request($USER->id);
                if (!$payout_request) {
                    $DB->insert_record('lonet_payout_request', ['teacherid' => $USER->id, 'createdat' => time()]);
                    $payout_request = teacher::get_payout_request($USER->id);
                }
                if ($payout_request) {
                    $payout_request->lessons = json_encode($_POST['PayoutRequest']['lessons']);
                    if ($action == 'request') {
                        $payout_request->isconfirmed = 1;
                        $payout_request->createdat = time();
                        foreach (payout_request::get_all_attributes() as $attr => $options) {
                            $payout_request->$attr = $_POST['PayoutRequest'][$attr];
                        }
                    }
                    $DB->update_record('lonet_payout_request', $payout_request);
                    if ($action == 'request') {
                        foreach ($_POST['PayoutRequest']['lessons'] as $id) {
                            if ($lesson = $DB->get_record('lonet_order_product', ['id' => $id])) {
                                $lesson->payoutamount = order_product::get_payout_amount($lesson);
                                $lesson->payoutrequestid = $payout_request->id;
                                $DB->update_record('lonet_order_product', $lesson);
                            }
                        }
                        sendMail($USER, 'payoutrequestrequested', [
                            'fullname' => fullname($USER, true),
                            'reference' => payout_request::get_reference($payout_request),
                            'link' => $payout_request->id
                        ]);
                    }
                    $result['status'] = true;
                }
                echo json_encode($result);
                exit();
            }
        }
	} catch (\Exception $e) {
        file_put_contents($CFG->dirroot.'/local/lonet/log/payout.log', print_r($_POST), FILE_APPEND);
        file_put_contents($CFG->dirroot.'/local/lonet/log/payout.log', print_r($e->getMessage()), FILE_APPEND);
        file_put_contents($CFG->dirroot.'/local/lonet/log/payout.log', print_r($e->getTraceAsString()), FILE_APPEND);
    }
}

$id = (isset($_GET['id']) && $_GET['id'] ? $_GET['id'] : $USER->id);
$title = get_string('requestpayout', 'local_lonet');

$PAGE->set_pagelayout('base');
$PAGE->set_title($title);
$PAGE->set_heading($title);
$PAGE->set_url('/local/lonet/payout.php?id=' . $id);

echo $OUTPUT->header();

if ($id && $user = $DB->get_record('user', ['id' => $id])) {
	if (teacher::can_request_payout($user)) {
	// if (true) { //remove this condition
		$data_model = payout_request::get_data_model($id);
        $withdrawal_options = payout_request::getWithdrawalOptions();
		echo renderFile('_payout_list.php', ['user' => $user]); ?>
		<script>
			$(document).ready(function() {
				$('#withdrawaltype').change(function(e) {
                    let selected_type = '[data-withdrawal-type="' + $(this).val() + '"]';
                    let selected = $(selected_type);
                    let notSelected = $('[data-withdrawal-type]:not(' + selected_type + ')');
                    selected.show();
                    selected.filter('[data-required]').prop('required', true);
                    notSelected.hide();
                    notSelected.filter('input, select').prop('required', false);
				});
                
				$('#accountcountry').change(function(e) {
					if ($(this).val() == 'Latvia') {
						$('#iknumber').prop('required', true);
						$('.field-iknumber').show();
					} else {
						$('.field-iknumber').hide();
						$('#iknumber').prop('required', false);
					}
				});
                
                $('#withdrawaltype').change();
                $('#accountcountry').change();
				
				$('#payout-form').submit(function(e) {
					e.preventDefault();					
					swal({
						title: '<?= get_string('areyousure') ?>',
						text: 'Payout request amount -  € ' + $('#selected-amount').text(), 
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
					}).then((isSure) => {
						if (isSure) {						
							data = $(this).serialize() + '&action=request&' + $('[name="PayoutRequest[lessons][]"]').serialize();
							$.ajax({
								type: 'POST',
								url: '/local/lonet/payout.php',
								dataType: 'json',            
								data: data,
								success: function(result){
									if (result.status == 1) {
										$('#payout-modal').modal('toggle');
										swal({
											title: 'Your request has been sent!',
											text: '', 
											icon: 'success',
											buttons: {
												confirm: {
													text: 'OK',
													value: true,
													visible: true,
													className: 'btn-success',
													closeModal: true
												}
											},
											dangerMode: true,
										}).then((isSure) => {
											window.location.href = '<?= $CFG->wwwroot ?>/user/profile.php?teacher_profile=1';
										});
									} else {
										swal('Error Occured', 'Your payout request could not be saved', 'error');
									}
								},
								error: function(xhr, ajaxOptions, thrownError){
									swal('Server Error Occured', xhr.responseText, 'error');
								}
							});
						}
					});
				});
			});
		</script>
		<div id="payout-modal" class="modal" tabindex="-1" role="dialog" data-keyboard="true">
			<div class="modal-dialog " role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>
					<form id="payout-form" action="/local/lonet/payout.php">
						<div class="modal-body">
							<div class="row">
								<?php foreach ([
                                    'request' => 'get_request_attributes',
                                    'account' => 'get_account_attributes',
                                    'paypal' => 'get_paypal_attributes',
                                    'user' => 'get_user_attributes'
                                ] as $type => $method) {
                                    $type = (isset($withdrawal_options[$type]) ? 'data-withdrawal-type="' . $type . '"' : ''); ?>
                                    <?php foreach (payout_request::$method() as $attr => $options) { ?>
                                        <div class="col-xs-12 field-<?= $attr ?>" style="margin-bottom: 10px; <?= ($attr == 'iknumber' ? 'display: none;' : '') ?>" <?= $type ?>>
                                            <label class="control-label" for="<?= $attr ?>">
                                                <?= get_string($attr, 'local_lonet') ?>
                                                <?= (in_array($attr, ['accountnumber', 'accountswift']) ? '&nbsp;<span class="tooltip"><span class="fa fa-info-circle"></span><span class="tooltiptext">' . get_string($attr . '_desc', 'local_lonet') . '</span></span>' : '') ?>
                                            </label>
                                            <?php switch ($attr) {
                                                case 'withdrawaltype': ?>
                                                    <select id="<?= $attr ?>" name="PayoutRequest[<?= $attr ?>]" <?= $options ?> <?= $type ?>>
                                                        <?php foreach ($withdrawal_options as $value => $label) {
                                                            echo '<option value="'. $value . '" ' . ($value == $data_model->$attr ? 'selected' : '') . '>'. $label . '</option>';
                                                        } ?>
                                                    </select>
                                                    <?php
                                                    break;
                                                case 'accountcountry': ?>
                                                    <select id="<?= $attr ?>" name="PayoutRequest[<?= $attr ?>]" <?= $options ?> <?= $type ?>>
                                                        <option></option>
                                                        <?php foreach (['Latvia', 'Other'] as $country) {
                                                            echo '<option value="'. $country . '" ' . ($country == $data_model->$attr ? 'selected' : '') . '>'. $country . '</option>';
                                                        } ?>
                                                    </select>
                                                    <?php
                                                    break;
                                                default: ?>
                                                    <input type="text" id="<?= $attr ?>" name="PayoutRequest[<?= $attr ?>]" value="<?= $data_model->$attr ?>" <?= $options ?> <?= $type ?>>
                                            <?php } ?>
                                        </div>
                                    <?php } ?>
								<?php } ?>
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
	<?php } else {
		echo 'Page not found.';
	}
}

echo $OUTPUT->footer(); ?>
