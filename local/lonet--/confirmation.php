<?php
use local_lonet\order;
use local_lonet\lesson;
use local_lonet\order_product;
use local_lonet\teacher;
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
    }
    ?>	
	
	<div class="row">
		<div class="col-sm-8 user-row">
            <?php if ($lessons) { ?>
                <h2><?= get_string('lessons', 'local_lonet') ?></h2>
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
                                        <?= $lprice ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-3 col-sm-2 text-right">
                                &nbsp;
                            </div>
                        </div>
                    <?php }
                }
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
			<div class="col-sm-12 user-row">
				<h2><?= get_string('totalprice', 'local_lonet') ?> <span class="pull-right">&euro; <span class="price"><?= $transaction->amount ?></span></span></h2><!--.00-->
				<div class="alert alert-success">
					Your order has been received.
					<br>
					Your order reference is <strong><?= $transaction->reference ?></strong>.
				</div>
				<br>
				<p><a class="btn btn-block btn-success" href="/local/lonet/receipt.php?id=<?= $booking['order_id'] ?>" target="_blank" rel="noopener noreferrer">Print Receipt</a></p>
			</div>
		</div>
	</div>
	
	<?php echo $OUTPUT->footer();
	order::set_booking(null);
} else {
	order::set_booking(null);
	header('Location: ' . $CFG->wwwroot . '/local/lonet/book.php');
	exit();
} ?>
