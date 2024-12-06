<?php
use local_lonet\order;
use local_lonet\lesson;
use local_lonet\order_product;
use local_lonet\promo_code;
use local_lonet\teacher;
use local_lonet\user;
//defined('MOODLE_INTERNAL') || die();

require_once('../../config.php');
require_once($CFG->dirroot.'/local/lonet/lib.php');

global $DB;
global $SESSION;
global $USER;

require_login();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$result = false;
	$order_product = [];
	if (isset($_POST['action']) && $_POST['action'] == 'promo') {
		if (isset($_POST['promo_code'])) {
			order::set_promo_code($_POST['promo_code']);
		} else {
			order::set_promo_code(null);
		}
		header('Location: ' . $CFG->wwwroot . '/local/lonet/book.php');
		exit();
	} elseif (isset($_POST['action']) && $_POST['action'] == 'phone1') {
		if (isset($_POST['phone1'])) {
			$USER->phone1 = $_POST['phone1'];
            $DB->update_record('user', $USER);
		}
		exit();
	} elseif (!isset($_POST['lessons'])) {
		$result = get_string('error_lessonnotfound', 'local_lonet');
	} else {
		foreach ($_POST['lessons'] as $lesson_data) {
			if ($lesson = $DB->get_record('lonet_lesson', ['id' => $lesson_data['lessonid']])) {
				$order_product['teacherid'] = $lesson->teacherid;
				$order_product['lessonid'] = $lesson->id;
				$order_product['studentid'] = $USER->id;
				$order_product['starttime'] = (new DateTime($lesson_data['datetime'], core_date::get_user_timezone_object()))->getTimestamp();
				$order_product['endtime'] = $order_product['starttime'] + $lesson->length;
				$order_product['language'] = $lesson_data['language'];
				$order_product['length'] = $lesson->length;
				$order_product['price'] = lesson::get_price($lesson);
				$order_product['commission'] = get_config('local_lonet', 'commissionperlesson');
				$order_product['discount'] = 0;
				$order_product['promotionapplied'] = 0;
				$order_product['payoutamount'] = $order_product['price'] - $order_product['commission'];
				/*
				$transaction = $DB->start_delegated_transaction();
				try {
					$result = $DB->insert_record('lonet_order_product', $order_product);
					if ($result) {
						$transaction->allow_commit();
						$body = get_string('youbookedlesson_mail', 'local_lonet', [
							'name' => $USER->firstname,
							'datetime' => $_POST['datetime']
						]);
						sendMail($USER, get_string('youbookedlesson', 'local_lonet'), $body);
						$result = true;
					} else {
						$transaction->rollback();
						$result = get_string('error_ordernotsaved', 'local_lonet');
					}
				} catch (\Exception $e) {
					$transaction->rollback($e);
				}
				*/
				$DB->insert_record('lonet_order_book', $order_product);
				order::add_product($order_product);
				$result = true;
			}
		}
	}
	order::update_current_transaction();
	echo json_encode($result);
} else {
	//$title = get_string('editlessons', 'local_lonet');
	$title = 'Book Now';

	$PAGE->set_context(context_system::instance());
	$PAGE->set_pagelayout('list');
	$PAGE->set_title($title);
	$PAGE->set_heading($title);
	$PAGE->set_url('/local/lonet/book.php');
	
	$booking = order::get_booking();	
	$status = (isset($_GET['status']) ? $_GET['status'] : '');
	
	echo $OUTPUT->header(); ?>
    
    <style>
        .gift-card {
            position: relative;
        }
        .gift-card > img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
        }
        .gift-card > .value-container {
			position: absolute;
            top: 58%;
            right: 70%;
            font-size: 50px;
            color: #FFFFFF;
            font-weight: bold;
            font-family: Times New Roman;
            /*text-shadow: 2px 2px #FFFFFF;*/
        }
        .gift-card > .value-container > .value {
            font-size: inherit;
            color: inherit;
            font-weight: inherit;
            font-family: inherit;
        }
        @media screen and (min-width: 480px) and (max-width: 768px) {
            .gift-card > .value-container {
                font-size: 40px;
            }
        }
        @media screen and (max-width: 480px) {
            .gift-card > .value-container {
                font-size: 20px;
            }
        }
    </style>
	<script>
		$(document).ready(function() {
			$(document).on('change', '[name="promo_code"]', function(e) {
				$('.col-promo-options .fa-check, .promo-error').hide();
				$('.col-promo-options button').show();
			});
			$(document).on('change', '[name="phone1"]', function(e) {
                let form = $(this).closest('form');
                $.post('<?= $CFG->wwwroot ?>' + form.attr('action'), form.serialize() + '&action=phone1');
			});
			
			$('.btn-remove-lesson').click(function(e) {
				var lesson = $(this).parent().parent();
				$.ajax({
					type: 'POST',
					url: '/local/lonet/remove.php',
					dataType: 'json',            
					data: {
						index: $(this).attr('data-index'),
					},
					success: function(result) {
						if (result === true) {
							//lesson.remove();
							window.location.reload();
						} else {
							swal('Error Occured', result, 'error');
						}
					},
					error: function(xhr, ajaxOptions, thrownError){
						swal('Server Error Occured', xhr.responseText, 'error');
					}
				});
			});
			
			$(document).on('click', '.btn-payment', function(e) {
				e.preventDefault();
				if ($('#agreewith').is(':checked')) {
					if ($(this).attr('data-type') == 'balance') {
						swal({
							title: '<?= get_string('areyousure') ?>',
							text: '', 
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
								window.location.href = '<?= $CFG->wwwroot ?>' + $(this).attr('href');
							}
						});
					} else {
						window.location.href = '<?= $CFG->wwwroot ?>' + $(this).attr('href');
					}
				} else {
					swal('You must agree with Terms and Conditions to continue.', '', 'warning');
				}
			});
		});
	</script>
	<?php
    if ($booking['order_products']) {
        $lessons = [];
        $giftcards = [];
        foreach ($booking['order_products'] as $i => $product) {
            if ($product['product_code'] === 'giftcard') {
                $giftcards[$i] = $product;
            } else {
                $lessons[$i] = $product;
            }
        }
        $used_balance = order::get_used_balance_amount();
        $order_amount = order::get_transaction()->amount - $used_balance;
        $available_balance = user::get_available_balance($USER->id) - $used_balance;

		//START RAJESH 10_12_2022
		$balancetext = '';
		if($available_balance < 0)
			$balancetext = '<span class="pull-right">&euro; <span class="price">' . $available_balance . '</span>.00</span></span>';
		//END RAJESH 10_12_2022
        ?>
		<div class="row">
			<div class="col-sm-8 user-row">
                <?php if ($lessons) { ?>
                    <h2><?= get_string('lessons', 'local_lonet') ?>
                    	<?= $balancetext ?>
                    </h2>
                    <?php foreach ($lessons as $index => $order_product) {
                        $order_product = (object) $order_product;
                        $teacher = $DB->get_record('user', ['id' => $order_product->teacherid]);
                        $lesson = $DB->get_record('lonet_lesson', ['id' => $order_product->lessonid]); ?>
                        <div class="row lesson-row margin-bottom">
                            <div class="col-xs-9 col-sm-10">
                                <div class="row">
                                    <div class="col-sm-5">
                                        <?= order_product::get_time_label($order_product) ?>
                                    </div>
                                    <div class="col-xs-8 col-sm-5">
                                        <?= $lesson->name ?>
                                        <br><?= get_string('with', 'local_lonet') ?> <a href="/teacher/<?= $teacher->id ?>" target="_blank"><?= fullname($teacher, true) ?></a>
                                    </div>
                                    <div class="col-xs-4 col-sm-2">
                                        <?= lesson::get_booking_price_html($lesson, $order_product->price) ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-3 col-sm-2 text-right">
                                <button type="button" class="btn btn-danger btn-remove-lesson" data-index="<?= $index ?>"><span class="fa fa-trash"></span></button>
                            </div>
                        </div>
                    <?php } ?>
				<?php } ?>
                <?php if ($giftcards) { ?>
                    <h2><?= get_string('giftcards', 'local_lonet') ?> for language classes with tutors on Lonet.Academy</h2>
                    <?php foreach ($giftcards as $index => $giftcard) {
                        $giftcard = (object) $giftcard; ?>
                        <div class="row lesson-row margin-bottom">
                            <div class="col-xs-9 col-sm-10">
                                <div class="row">
                                    <div class="col-sm-5">
                                        <b>Valid Through:</b>&nbsp;<?= (new \DateTime('+90 days'))->format('d.m.Y') ?>
                                    </div>
                                    <div class="col-xs-8 col-sm-5">
                                        <b>€</b>&nbsp;<?= $giftcard->amount ?>&nbsp;&times;&nbsp;<?= $giftcard->count ?>
                                    </div>
                                    <div class="col-xs-4 col-sm-2">
                                        <b>€</b>&nbsp;<?= $giftcard->price ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-3 col-sm-2 text-right">
                                <button type="button" class="btn btn-danger btn-remove-lesson" data-index="<?= $index ?>"><span class="fa fa-trash"></span></button>
                            </div>
                            <div class="col-sm-12" style="margin-top: 10px;">
                                <div class="gift-card">
                                  <img src="/local/lonet/pix/Gift_card_christmas.png" alt="Gift Card">
                                    <span class="value-container"><span class="value"><?= $giftcard->amount ?></span> EUR</span>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
				<?php } ?>
			</div>
			<div class="col-sm-4 col-options">
				<div class="col-sm-12 user-row">
					<h2><?= get_string('totalprice', 'local_lonet') ?> <span class="pull-right">&euro; <span class="price"><?= order::get_price() ?></span>.00</span></h2>
                    <?php if ($used_balance) { ?>
                        <h4><?= get_string('paidfrombalance', 'local_lonet') ?> <span class="pull-right">&euro; <span class="price" style="font-size: 1.2em;"><?= $used_balance ?></span>.00</span></h4>
                        <h4><?= get_string('remainingamount', 'local_lonet') ?> <span class="pull-right">&euro; <span class="price" style="font-size: 1.2em;"><?= $order_amount ?></span>.00</span></h4>
                    <?php } ?>
					<br>
					<?php if ($status) { ?>
						<div class="alert alert-danger">
							<?= get_string('paymentstatus_' . $status, 'local_lonet') ?>
						</div>
                        <br>
					<?php } ?>
					<?php if (promo_code::has_active_codes()) { ?>
						<form action="/local/lonet/book.php" method="post">
							<div class="row">
								<div class="col-sm-8">
									<input type="text" name="promo_code" class="form-control" placeholder="<?= get_string('promocode', 'local_lonet') ?>" value="<?= $booking['promo_code']['code'] ?>" style="width: 100%;">
								</div>
								<div class="col-sm-4 col-promo-options" style="padding-left: 0;">
									<span class="fa fa-check" style="color: #499306; <?= ($booking['promo_code']['id'] && !$booking['promo_code']['error'] ? '' : 'display: none;') ?>"></span>
									<button type="submit" name="action" value="promo" class="btn btn-info btn-block" style="<?= ($booking['promo_code']['code'] ? 'display: none;' : '') ?>"><?= get_string('apply', 'local_lonet') ?></button>
								</div>
								<div class="col-sm-12 promo-error" style="color: #d9534f; <?= ($booking['promo_code']['error'] ? '' : 'display: none;') ?>">
									<?= $booking['promo_code']['error'] ?>
								</div>
							</div>
						</form>
						<br>
					<?php } ?>
                    <form action="/local/lonet/book.php" method="post">
                        <div class="row">
                            <div class="col-sm-12">
                                <label>WhatsApp number</label>
                            </div>
                            <div class="col-sm-12">
                                <input type="text" name="phone1" class="form-control" value="<?= $USER->phone1 ?>" style="width: 100%;">
                            </div>
                        </div>
                    </form>
					<br>
					<p>
						<label>
							<input type="checkbox" id="agreewith">
							<?= get_string('agreewith', 'local_lonet', '<a href="' . $CFG->wwwroot . '/terms-and-conditions" target="_blank">' .  get_string('terms', 'theme_lonet') . '</a>')?>
						</label>
					</p>
					<?php
                    if ($order_amount > 0) {
                        if ($available_balance > 0) {
                            if ($order_amount <= $available_balance) {
                                ?>
                                <p><a class="btn btn-block btn-success btn-payment" href="/local/lonet/payment/balance.php" data-type="balance"><?= get_string('payfrombalance', 'local_lonet') ?></a></p>
                            <?php } else { ?>
                                <p><a class="btn btn-block btn-success btn-payment" href="/local/lonet/payment/balance.php" data-type="balance"><?= get_string('usebalance', 'local_lonet') ?></a></p>
                                <br>
                                <?php
                            }
                        }
                        ?>
						<p><a class="btn btn-block btn-success btn-payment" href="/local/lonet/payment.php?method=card" data-type="card"><?= get_string('paywithcard', 'local_lonet') ?></a></p>
						<p>
                            <a class="btn btn-block btn-success btn-payment" href="/local/lonet/payment.php?method=paypal" data-type="paypal"><?= get_string('paywith', 'local_lonet') ?> <img src="<?= $CFG->wwwroot ?>/theme/lonet/pix/payment/paypal.png"> *</a>
                            <span style="font-size: 90%">* <?= get_string('paypal_fee_message', 'local_lonet') ?></span>
                        </p>
                    <?php } else { ?>
						<p><a class="btn btn-block btn-success btn-payment" href="/local/lonet/payment/balance.php" data-type="balance"><?= get_string('confirmbooking', 'local_lonet') ?></a></p>
					<?php } ?>
				</div>
			</div>
		</div>
	<?php } else { ?>
		<div class="alert alert-danger">
			<?= get_string('emptycart', 'local_lonet') ?>
		</div>
	<?php } ?>
<?php echo $OUTPUT->footer();
} ?>
