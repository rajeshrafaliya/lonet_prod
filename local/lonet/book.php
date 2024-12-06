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
	// } elseif (!isset($_POST['lessons'])) {
	} elseif (!isset($_POST['lessonid'])) {
		$result = get_string('error_lessonnotfound', 'local_lonet');
	} else {
		foreach ($_POST['lessons'] as $lesson_data) {
			if(empty($lesson_data['isgrouplesson']) || !isset($lesson_data['isgrouplesson'])){
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
		}else{
				if ($lesson = $DB->get_record('lonet_group_lessons', ['id' => $lesson_data['lessonid']])) {
					$starttime = (new DateTime($lesson_data['datetime'], core_date::get_user_timezone_object()))->getTimestamp();
					$endtime = (new DateTime($lesson_data['endtime'], core_date::get_user_timezone_object()))->getTimestamp();
					$timeinsec =  $endtime - $starttime;
					$order_product['teacherid'] = $lesson->teacherid;
					$order_product['lessonid'] = $lesson->id;
					$order_product['studentid'] = $USER->id;
					$order_product['starttime'] = $starttime;
					$order_product['endtime'] = $endtime;
					$order_product['language'] = $lesson_data['language'];
					$order_product['length'] = $timeinsec;
					$order_product['price'] = lesson::get_grouplesson_price($lesson);
					$order_product['commission'] = get_config('local_lonet', 'commissionperlesson');
					$order_product['discount'] = 0;
					$order_product['promotionapplied'] = 0;
					$order_product['payoutamount'] = $order_product['price'] - $order_product['commission'];
					$order_product['isgrouplesson'] = 1;
					$DB->insert_record('lonet_order_book', $order_product);
					$order_product['offer'] = 1;
					order::add_product($order_product);
					$result = true;
				}
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
	if(isset($_GET['offerid'])){
		if ($offer = $DB->get_record('lonet_lesson', ['id' => $_GET['offerid']])) {
			$order_product['teacherid'] = $offer->teacherid;
			$order_product['lessonid'] = $offer->id;
			$order_product['studentid'] = $USER->id;
			$order_product['starttime'] = time();
			$order_product['endtime'] = time();
			$order_product['language'] = $offer->language;
			$order_product['length'] = 0;
			$order_product['price'] = $offer->price;
			$order_product['commission'] = 0;
			$order_product['discount'] = 0;
			$order_product['promotionapplied'] = 0;
			$order_product['payoutamount'] = 0;
			$DB->insert_record('lonet_order_book', $order_product);
			$order_product['offer'] = 1;
			order::add_product($order_product);
			redirect($CFG->wwwroot.'/local/lonet/book.php');
		}
	}
	
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
		.pagedatacontainer{padding:20px 64px 64px 64px;}
		.booktopmsg p{
			color:  #4B5563;
			font-size: 18px;
			font-style: normal;
			font-weight: 500;
		}
		.booktopmsg h6{
			color: var(--Black, #000);
			font-size: 24px;
			font-style: normal;
			font-weight: 700;
			line-height: normal;
			padding-bottom:12px;
		}
		.bestoffer{
			display: flex;
			align-items: flex-start;
			gap: 32px;
			justify-content:center;
			margin-bottom:64px;
		}
		.gooddeal p,.safepkg p,.bestvalue p{
			color: #6B7280;
			font-size: 14px;
			font-style: normal;
			font-weight: 400;
			line-height: 20px;
		}
		.gooddeal h6,.safepkg h6,.bestvalue h6{
			color: #111827;
			font-size: 20px;
			font-style: normal;
			font-weight: 500;
			line-height: normal;
		}
		.gooddeal,.bestvalue{
			border-radius: 40px;
			border: 2px solid #170F83;
			background: #FFFFFF;
			box-shadow: 0px 2px 6px 0px rgba(16, 24, 40, 0.06);
			display: flex;
			width: 359px;
			padding: 24px 32px;
			flex-direction: column;
			justify-content: center;
			align-items: flex-start;
			gap: 10px;
			align-self: stretch;
			height: 150px;
		}
		.safepkg .mostpop{
			border-radius: 24px;
			background: #8DF1BF;
			color: #4B5563;
			text-align: center;
			font-size: 12px;
			font-style: normal;
			font-weight: 500;
			line-height: normal;
			text-transform: capitalize;
			padding: 2px 6px;
		}
		.safepkg{
			border-radius: 40px;
			border: 2px solid #CE1369;
			background: #FFFFFF;
			box-shadow: 0px 8px 24px -3px rgba(16, 24, 40, 0.05), 0px 8px 24px -3px rgba(16, 24, 40, 0.10);
			display: flex;
			width: 359px;
			padding: 24px 32px;
			flex-direction: column;
			justify-content: center;
			align-items: flex-start;
			gap: 10px;
			height: 150px;
		}
		.dealprice{
			display: flex;
			justify-content: center;
			width: 100%;
			align-items: center;
			gap:12px;
		}
		.dealprice .sprice{
			color: #9CA3AF;
			text-align: center;
			font-size: 24px;
			font-style: normal;
			font-weight: 500;
			text-decoration:line-through;
			line-height: 36px;
		}
		.dealprice .fprice{
			color: var(--Neutral-900, #111827);
			font-size: 28px;
			font-style: normal;
			font-weight: 700;
			line-height: 36px;
		}
		.paylesstxt{
			padding-top: 12px;
			padding-bottom: 12px;
			color: #170F83;
			font-size: 24px;
			font-style: normal;
			font-weight: 700;
			line-height: normal;
			width:100%;
			text-align:center;
		}
		.investandsave{display:flex;width:100%;text-align:center;flex-direction:column;gap:21px;}
		.investandsave .first{
			color: #000;
			font-size: 24px;
			font-style: normal;
			font-weight: 700;
			line-height: normal;
		}
		.investandsave .second{
			color: #4B5563;
			text-align: center;
			font-size: 18px;
			font-style: normal;
			font-weight: 500;
			padding-bottom: 64px;
		}
		.totalprice{
			color: #000;
			font-size: 24px;
			font-style: normal;
			font-weight: 700;
			line-height: normal;
		}
		.booktopmsg{
			margin-bottom: 12px;
		}
		.agreewith {
			margin-top:32px;
			margin-bottom:32px;
		}
		.agreewith a{
			color:#6B7280;
			font-size: 14px;
			font-style: normal;
			font-weight: 400;
			line-height: normal;
			text-decoration-line: underline;
			text-underline-offset: 2px;
		}
		.btn.bycard{
			border-radius: 60px;
			border: 1px solid rgba(17, 24, 39, 0.15);
			background: #CE1369;
			box-shadow: 0px 1px 0px 0px rgba(0, 0, 0, 0.04);
			padding: 12px 20px;
			color: #FFFFFF;
			text-align: center;
			font-size: 18px;
			font-style: normal;
			font-weight: 400;
			line-height: 24px;
		}
		.btn.bypaypal,.bybalance,.btn.bypaypal:hover,.bybalance:hover{
			border-radius: 60px;
			border: 1px solid #4B5563;
			background: #FFFFFF !important;
			box-shadow: 0px 1px 0px 0px rgba(0, 0, 0, 0.04) !important;
			color: #4B5563 !important;
			font-size: 18px;
			font-style: normal !important;
			font-weight: 400;
			line-height: 24px;
			padding: 12px 20px;
			text-shadow: none;
		}
		.bybalance.disabled{
			pointer-events:none;
		}
		.selectedlessoncontainer{
			margin-bottom: 48px;
		}
		.bybalance{
			margin-bottom:22px;
			margin-top:22px;
		}
		.applypromo{
			border-radius: 60px;
			border: 1px solid #4B5563;
			background: #FFFFFF !important;
			box-shadow: 0px 1px 0px 0px rgba(0, 0, 0, 0.04);
			color: #4B5563;
			font-size: 18px;
			font-style: normal;
			font-weight: 400;
			padding: 8px 20px;
			text-shadow:none;
			line-height: 24px;
		}
		.promoinput{
			width: 100% !important;
			border-radius: 8px !important;
			border: 1px solid #E5E7EB !important;
			background: #FFFFFF;
			box-shadow: 0px 1px 2px 0px rgba(16, 24, 40, 0.04), 0px 1px 2px 0px rgba(16, 24, 40, 0.04) !important;
			padding: 8px 12px !important;
			height: 40px !important;
		}
		.paymentbtns{
			height:497px;
			width:355px;
			border-radius: 40px;
			background: #EFEDE6;
			box-shadow: 0px 2px 6px 0px rgba(16, 24, 40, 0.06);
			padding: 32px 24px;
		}
		.teacherinfo{
			 display: flex;
			 flex-direction: row;
			 justify-content: center;
			 align-items: center;
			 gap: 12px;
			 margin-top: 32px;
		}
		.teacherinfo .teacherdetail{
			flex-direction: column;
			display: flex;
			gap: 8px;
		}
		.picturecontainer img{
			border-radius: 400px;
			border: 2px solid #FFFFFF;
		}
		.teacherdetail .excellentchoice{
			color: #4B5563;
			text-align: center;
			font-size: 18px;
			font-style: normal;
			font-weight: 400;
			line-height: 24px;
		}
		.teacherdetail .teachername{
			color: #000;
			text-align: center;
			font-size: 20px;
			font-style: normal;
			font-weight: 500;
			line-height: normal;
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
					url: '<?= $CFG->wwwroot ?>/local/lonet/remove.php',
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
							icon: '<?= $CFG->wwwroot ?>/theme/lonet/pix/swal-circle.png',
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
			if($('.selectedlessoncontainer.deals').length > 0){
				$('.btn-payment.bybalance').addClass('disabled');
				$('.btn-payment.bybalance').removeAttr("href");
			}
		});
	</script>
	<?php
    if ($booking['order_products']){
        $lessons = [];
        $giftcards = [];
		$orderteacherid = 0;
        foreach ($booking['order_products'] as $i => $product) {
            if ($product['product_code'] === 'giftcard') {
                $giftcards[$i] = $product;
            } elseif($product['offer'] > 0){
				$offers[$i] = $product;
			}else {
                $lessons[$i] = $product;
            }
			$orderteacherid = $product['teacherid'];
        }
		if(!empty($orderteacherid)){
			$usercontext = context_user::instance($orderteacherid);
			$bteacher = user::get_by_id($orderteacherid);
			$userpicf3 = $OUTPUT->user_picture($bteacher, ['size' => '150', 'link' => false]);
			if($DB->record_exists_sql("SELECT * FROM {files} WHERE component='user' AND filearea='icon' AND itemid=0 AND contextid=".$usercontext->id." AND filename LIKE '%original%'")){
				$userpic = str_replace('/f3','/original', $userpicf3);
			}else{
				$userpic =  $userpicf3;
			}
			echo '<div class="teacherinfo">
				<div class="picturecontainer">'.$userpic.'</div>
				<div class="teacherdetail">
					<span class="teachername">'.fullname($bteacher).'</span>
					<span class="excellentchoice">Excellent Choice!</span>
				</div>
			</div>';
			echo '<div style="width: 873px;margin: 0 auto;margin-top: 32px;"><div class="progress" style="height: 16px;border-radius: 60px;border: 1px solid #E5E7EB;background: #F9FAFB;box-shadow: none;"><div class="progress-bar" role="progressbar" style="width: 50%;height: 16px;background: #8DF1BF;border-radius: 60px;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div></div></div>';
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
		<div class="pagedatacontainer">
		<!------------------------------------------Offer start here -------------------------->
		<?php
			echo '<h5 class="my-0 paylesstxt">Pay less get more!</h5>
			<p class="my-0" style="color: #4B5563; font-size: 18px;font-weight: 500;text-align: center;padding-bottom: 12px;">Put money on your balance now and book your lessons later.</p>';
			echo '<div class="bestoffer">';
			$offersinfo = $DB->get_records_sql("SELECT * FROM {lonet_lesson} WHERE teacherid=3 AND offer=1 AND isactive=1");
			foreach($offersinfo as $singleoffer){
			if(strtolower($singleoffer->name) == 'good deal') { ?>
			<a href="<?= $CFG->wwwroot?>/local/lonet/book.php?offerid=<?= $singleoffer->id ?>">
				<div class="gooddeal">
					<h6 class="my-0">GOOD DEAL</h6>
					<p class="my-0">Pay €<?= $singleoffer->price ?> and get €150 on your balance!</p>
					<div class="dealprice">
						<h4 class="my-0 fprice">€<?= $singleoffer->price ?></h4>
						<h4 class="my-0 sprice">€150</h4>
					</div>
				</div>
			</a>
			<?php
			} 
			if(strtolower($singleoffer->name) == 'safe package') { ?>
				<a href="<?= $CFG->wwwroot?>/local/lonet/book.php?offerid=<?= $singleoffer->id ?>">
				<div class="safepkg">
					<div style="display: flex;width: 276px;align-items: center;gap: 30px;">
						<h6 class="my-0">SAFE PACKAGE</h6>
						<span class="mostpop">Most popular</span>
					</div>
					<p class="my-0">Pay €<?= $singleoffer->price ?>, get €200 to spend on any lesson with any educator!</p>
					<div class="dealprice">
						<h4 class="my-0 fprice">€<?= $singleoffer->price ?></h4>
						<h4 class="my-0 sprice">€200</h4>
					</div>
				</div>
				</a>
			<?php
			} 
			if(strtolower($singleoffer->name) == 'best value') { ?>
			<a href="<?= $CFG->wwwroot?>/local/lonet/book.php?offerid=<?= $singleoffer->id ?>">
				<div class="bestvalue">
					<h6 class="my-0">BEST VALUE</h6>
					<p class="my-0">Pay €<?= $singleoffer->price ?>, get €400 to spend on any lesson with any educator!</p>
					<div class="dealprice">
						<h4 class="my-0 fprice">€<?= $singleoffer->price ?></h4>
						<h4 class="my-0 sprice">€400</h4>
					</div>
				</div>
			</a>
			<?php }
				}
			?>
			</div>
			<!----------------------------------offers end here-------------------------->	
		<div class="row mx-0" style="display:flex;justify-content:space-between;">
			<div class="col-sm-8 user-row" style="background:#FFFFFF;">
                <?php if ($lessons) { ?>
                    <h2 class="my-0"><?= get_string('lessons', 'local_lonet') ?>
                    	<?= $balancetext ?>
                    </h2>
					<div class="selectedlessoncontainer mt-0">
                    <?php foreach ($lessons as $index => $order_product) {
                        $order_product = (object) $order_product;
                        $teacher = $DB->get_record('user', ['id' => $order_product->teacherid]);
						if($order_product->isgrouplesson){
							// $lesson = $DB->get_record_sql("SELECT *, lessonname as name  FROM {lonet_group_lessons} WHERE id=".$order_product->lessonid."");
							$lesson = lesson::get_grouplesson_by_id($order_product->lessonid);
							$order_product->price = lesson::get_grouplesson_price($lesson);
							$lprice = lesson::get_booking_price_html_grouplesson($lesson, $order_product->price);
						}else{
							$lesson = $DB->get_record('lonet_lesson', ['id' => $order_product->lessonid]);
							$lprice = lesson::get_booking_price_html($lesson, $order_product->price);
						}
						echo '<div class="indiselect"><div class="leftbox"><span class="removeselect btn-remove-lesson" data-index='.$index.'>'.get_string("trashicon","local_lonet").'</span></div><div class="secondbox"><div class="row1"><div class="lname">'.$lesson->name.'</div><div class="ldate">'. order_product::get_time_label_date($order_product).'</div></div><div class="row2"><div class="tname">with '.fullname($teacher, true).'</div><div class="ltime">'. order_product::get_time_label_time($order_product).'</div></div></div></div>';
						?>
                        <!--div class="row lesson-row margin-bottom hidden">
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
                                        <?= $lprice ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-3 col-sm-2 text-right">
                                <button type="button" class="btn btn-danger btn-remove-lesson" data-index="<?= $index ?>"><span class="fa fa-trash"></span></button>
                            </div>
                        </div-->
                    <?php } ?>
					</div>
				<?php } ?>
				<!-----------------------------------------Offers-------------------------------------->
               <?php if ($offers) { ?>
                    <h2 class="my-0">Balance top up</h2>
					<div class="selectedlessoncontainer deals my-0">
                    <?php foreach ($offers as $index => $order_product) {
                        $order_product = (object) $order_product;
                        $teacher = $DB->get_record('user', ['id' => $order_product->teacherid]);
						if($order_product->isgrouplesson){
							// $lesson = $DB->get_record_sql("SELECT *, lessonname as name  FROM {lonet_group_lessons} WHERE id=".$order_product->lessonid."");
							$lesson = lesson::get_grouplesson_by_id($order_product->lessonid);
							$order_product->price = lesson::get_grouplesson_price($lesson);
							$lprice = lesson::get_booking_price_html_grouplesson($lesson, $order_product->price);
						}else{
							$lesson = $DB->get_record('lonet_lesson', ['id' => $order_product->lessonid]);
							$lprice = lesson::get_booking_price_html($lesson, $order_product->price);
						}
						echo '<div class="indiselect"><div class="leftbox"><span class="removeselect btn-remove-lesson" data-index='.$index.'>'.get_string("trashicon","local_lonet").'</span></div><div class="secondbox"><div class="row1"><div class="lname">'.$lesson->name.'</div><div class="ldate">&euro;'. $order_product->price.'</div></div><div class="row2"><div class="tname">you can book any type of lessons with any educator</div><div class="ltime hidden">'. order_product::get_time_label_time($order_product).'</div></div></div></div>';
						?>
                    <?php } ?>
					</div>
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
		<div class="booktopmsg text-center" style="margin-top:48px;">
			<h6 class="my-0">You’re almost there</h6>
			<p class="my-0">After you complete your payment, you'll receive an invoice on your email.</p>
		</div>
			</div>
			<div class="col-sm-4 col-optionss paymentbtns">
				<div class="col-sm-12 user-rows px-0">
					<h2 class="totalprice text-center my-0"><?= get_string('totalprice', 'local_lonet') ?>&nbsp;&euro;<?= order::get_price() ?></h2>
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
								<span style="color: #4B5563;font-size: 18px;font-weight: 500;padding-left:15px;padding-right:15px;">Have a Promo Code?</span>
								<div class="col-sm-8">
									<input type="text" name="promo_code" class="form-control promoinput" placeholder="<?= get_string('promocode', 'local_lonet') ?>" value="<?= $booking['promo_code']['code'] ?>" style="width: 100%;">
								</div>
								<div class="col-sm-4 col-promo-options" style="padding-left: 0;">
									<span class="fa fa-check" style="color: #499306; <?= ($booking['promo_code']['id'] && !$booking['promo_code']['error'] ? '' : 'display: none;') ?>"></span>
									<button type="submit" name="action" value="promo" class="btn btn-info btn-block applypromo" style="<?= ($booking['promo_code']['code'] ? 'display: none;' : '') ?>"><?= get_string('apply', 'local_lonet') ?></button>
								</div>
								<div class="col-sm-12 promo-error" style="color: #d9534f; <?= ($booking['promo_code']['error'] ? '' : 'display: none;') ?>">
									<?= $booking['promo_code']['error'] ?>
								</div>
							</div>
						</form>
					<?php } ?>
                    <form action="/local/lonet/book.php" method="post" class='hidden'>
                        <div class="row">
                            <div class="col-sm-12">
                                <label>WhatsApp number</label>
                            </div>
                            <div class="col-sm-12">
                                <input type="text" name="phone1" class="form-control" value="<?= $USER->phone1 ?>" style="width: 100%;">
                            </div>
                        </div>
                    </form>
					<div style="display:flex;align-items:center;" class="agreewith">
						<input type="checkbox" id="agreewith" style="width:20px;">
						<label style="color:#6B7280;font-size: 14px;">
							<?= get_string('agreewith', 'local_lonet', '<a href="' . $CFG->wwwroot . '/terms-and-conditions" target="_blank">' .  get_string('terms', 'theme_lonet') . '</a>')?>
						</label>
					</div>
					<p><a class="btn btn-block btn-success btn-payment bycard" href="/local/lonet/payment.php?method=card" data-type="card"><?= get_string('paywithcard', 'local_lonet') ?></a>
					<span style="font-size: 90%;color: #9CA3AF;text-align: center;font-size: 14px;">* <?= get_string('card_fee_message', 'local_lonet') ?></span>
					</p>
					<?php
                    if ($order_amount > 0) {
                        if ($available_balance > 0) {
                            if ($order_amount <= $available_balance) {
                                ?>
                                <p><a class="btn btn-block btn-success btn-payment bybalance withlogo" href="/local/lonet/payment/balance.php" data-type="balance">
								<?= get_string('lonetlogo_btn', 'local_lonet') ?>
								<?= get_string('payfrombalance', 'local_lonet') ?>
								</a></p>
                            <?php } else { ?>
                                <p><a class="btn btn-block btn-success btn-payment bybalance" href="/local/lonet/payment/balance.php" data-type="balance"><?= get_string('usebalance', 'local_lonet') ?></a></p>
                                <?php
                            }
                        }
                        ?>
						<p>
                            <a class="btn btn-block btn-success btn-payment bypaypal" href="/local/lonet/payment.php?method=paypal" data-type="paypal">Pay with PayPal *</a>
                            <span style="font-size: 90%;color: #9CA3AF;text-align: center;font-size: 14px;">* <?= get_string('paypal_fee_message', 'local_lonet') ?></span>
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
	<div class="investandsave hidden" style="display:flex;width:100%;text-align:center;flex-direction:column;gap:21px;margin-top:32px;">
		<h5 class="my-0 first">Invest and save</h5>
		<h5 class="my-0 second">Put money on your balance now and book your lessons later.</br>
		Use your balance within 85 days.</h5>
	</div>
</div>
<?php echo $OUTPUT->footer();
} ?>
