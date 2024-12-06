<?php
use local_lonet\order;
use local_lonet\lesson;
use local_lonet\order_product;
use local_lonet\teacher;
use local_lonet\user;
//defined('MOODLE_INTERNAL') || die();

require_once('../../config.php');
require_once($CFG->dirroot.'/local/lonet/lib.php');

global $DB;
global $SESSION;
global $USER;

//$title = get_string('editlessons', 'local_lonet');
$title = 'Confirmation';

$PAGE->set_context(context_system::instance());
$PAGE->set_pagelayout('list');
$PAGE->set_title($title);
$PAGE->set_heading($title);
$PAGE->set_url('/local/lonet/confirmation.php');

$booking = order::get_booking();

if ($booking['order_products']) {
	echo $OUTPUT->header();
	$transaction = order::get_transaction();
    $lessons = [];
    $giftcards = [];
    $lang_camp = [];
	$orderteacherid = 0;
    foreach ($booking['order_products'] as $i => $product) {
        if ($product['product_code'] === 'giftcard') {
            $giftcards[$i] = $product;
        }
        else if($product['product_code'] == 'Camp with private accommodation' || 
                        $product['product_code'] == 'Camp with group accommodation' ||
                        $product['product_code'] == 'Only camp (no accommodation)' ||
                        $product['product_code'] == 'Travel companion (group accommodation)' ||
                        $product['product_code'] == 'MEET-UP CAMP June 2022'){
                            $lang_camp[$i] = $product;
                        }
        else {
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
		echo '<div style="width: 873px;margin: 0 auto;margin-top: 32px;"><div class="progress" style="height: 16px;border-radius: 60px;border: 1px solid #E5E7EB;background: #F9FAFB;box-shadow: none;"><div class="progress-bar" role="progressbar" style="width: 100%;height: 16px;background: #8DF1BF;border-radius: 60px;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div></div></div>';
	}	
	
	
    ?>	
	
	<div class="row mx-0" style="display:flex;justify-content:space-between;padding:64px;">
		<div class="col-sm-8 user-row" style="background:#FFFFFF;">
            <?php if ($lessons) { ?>
                <h2 class="my-0"><?= get_string('lessons', 'local_lonet') ?></h2>
				<div class="selectedlessoncontainer mt-0">
                <?php foreach ($lessons as $index => $order_product) {
                    if (!empty($order_product['is_confirmed'])) {
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
						?>
                        <!--div class="row lesson-row margin-bottom">
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
                                &nbsp;
                            </div>
                        </div-->
						<div class="indiselect">
							<div class="secondbox">
								<div class="row1">
									<div class="lname"><?= $lesson->name ?></div>
									<div class="ldate"><?= order_product::get_time_label_date($order_product) ?></div>
								</div>
								<div class="row2">
									<?php 
									if(!isset($order_product->offer)){
										echo '<div class="tname">with '.fullname($teacher, true).'</div>';
									}else{
										echo '<div class="tname">you can book any type of lessons with any educator</div>';
									}
									?>
									<div class="ltime"><?= order_product::get_time_label_time($order_product) ?></div>
								</div>
							</div>
						</div>
                    <?php }
                }
				echo '</div>';
            } ?>
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
                                    &nbsp;
                                </div>
                                <div class="col-xs-4 col-sm-2">
                                    &nbsp;
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-3 col-sm-2 text-right">
                            &nbsp;
                        </div>
                        <div class="col-sm-12" style="margin-top: 10px;">
                            <?= $SESSION->${'gc' . $transaction->orderid} ?? '' ?>
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>
            <?php if ($lang_camp) { ?>
                <h2>MEETUP CAMP IN BARCELONA. AUGUST 24 – 29, 2021</h2>
                <?php foreach ($lang_camp as $index => $camp) {
                    $camp = (object) $camp; 
                    
                    ?>
                    <div class="row lesson-row margin-bottom">
                        <div class="col-xs-9 col-sm-10">
                            <div class="row">
                                <div class="col-sm-8">
                                    <b>Camp Package:</b>&nbsp;<?= $camp->product_code ?>
                                </div>
                                <div class="col-xs-4 col-sm-4">
                                    Amount : <?= $camp->amount ?>&nbsp;<b>€</b>
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-xs-3 col-sm-2 text-right">
                            &nbsp;
                        </div>
                        <div class="col-sm-12" style="margin-top: 10px;">
                            <?= $SESSION->${'gc' . $transaction->orderid} ?? '' ?>
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>
		</div>
		<div class="col-sm-4 col-options">
			<div class="col-sm-12 user-row" style="padding: 32px 24px;border-radius: 40px;background:#EFEDE6;box-shadow: 0px 2px 6px 0px rgba(16, 24, 40, 0.06)">
				<h2><?= get_string('totalprice', 'local_lonet') ?> <span class="pull-right">&euro; <span class="price"><?= $transaction->amount ?></span></span></h2><!--.00-->
				<div class="alert alert-success" style="background-color: rgba(206, 19, 105, 0.5);color: #FFFFFF;text-shadow: none;">
					Your order has been received.
					<br>
					Your order reference is <strong><?= $transaction->reference ?></strong>.
				</div>
				<br>
				<p><a class="btn btn-block btn-success" href="/local/lonet/receipt.php?id=<?= $booking['order_id'] ?>" target="_blank" rel="noopener noreferrer" style="border-radius: 60px; border: 1px solid rgba(17, 24, 39, 0.15); background: #CE1369; box-shadow: 0px 1px 0px 0px rgba(0, 0, 0, 0.04);padding: 12px 20px;color:#FFFFFF;text-align: center;font-size: 18px;text-shadow: none;">Print Receipt</a></p>
			</div>
		</div>
	</div>
	
	<h5 class="my-0 successfullyreq">You successfully requested a lesson</h5>
	<h6 class="my-0 cong">Congratulations! While others are only planning you are already doing.</h6>
	<h5 class="my-0 nextsteps">Next steps</h5>
	<div class="steps">
		<div class="step1">
			<h6 class="my-0 stitle1">1. Check your email</h6>
			<p class="my-0 stitle2">We've sent you the order confirmation to your email.</p>
		</div>
		<div class="step2">
			<h6 class="my-0 stitle1">2. Wait for confirmation</h6>
			<p class="my-0 stitle2">You will receive confirmation in 24 hours maximum. As soon as the educator confirms your request, you can text them through the messenger.</p>	
		</div>
		<div class="step3">
			<h6 class="my-0 stitle1">3. Get ready!</h6>
			<p class="my-0 stitle2">Get ready for the meeting :)))</p>
		</div>
	</div>
	<div style="text-align:center;margin-top:64px;margin-bottom:64px;"><a href="/user/<?= $USER->id ?>" class="btn bcktoteacher" style="width:200px;">Ok</a></div>
	<?php echo $OUTPUT->footer();
	order::set_booking(null);
} else {
	order::set_booking(null);
	header('Location: ' . $CFG->wwwroot . '/local/lonet/book.php');
	exit();
} ?>
