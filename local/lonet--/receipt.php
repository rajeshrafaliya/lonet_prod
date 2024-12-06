<?php
use local_lonet\order_transaction;
use local_lonet\lesson;

global $DB;
global $CFG;

require_once('../../config.php');
require_once($CFG->dirroot.'/local/lonet/lib.php');

$id = (isset($_GET['id']) ? $_GET['id'] : null);
/*
$title = get_string('transactionhistory', 'local_lonet');

$PAGE->set_context(context_system::instance());
$PAGE->set_pagelayout('base');
$PAGE->set_title($title);
$PAGE->set_heading($title);
$PAGE->set_url('/local/lonet/wallet.php?id=' . $id);

echo $OUTPUT->header();
*/
if ($id && $order = $DB->get_record('lonet_order', ['id' => $id])) {	
	$customer = $DB->get_record('user', ['id' => $order->studentid]);
	if ($USER->id == $order->studentid || is_siteadmin()) {
        $transaction = $DB->get_record('lonet_order_transaction', ['orderid' => $order->id, 'iscompleted' => 1]);
        $products = $DB->get_records('lonet_order_product', ['orderid' => $order->id]);
        $giftcards = $DB->get_records('lonet_promo_code', ['orderid' => $order->id]);
        $lang_camp = [];
        
        foreach($giftcards as $obj){
            if($obj->package_name == 'Camp with private accommodation' || 
                        $obj->package_name == 'Camp with group accommodation' ||
                        $obj->package_name == 'Only camp (no accommodation)' ||
                        $obj->package_name == 'Travel companion (group accommodation)' ||
                        $obj->package_name == 'MEET-UP CAMP June 2022'){
                               $lang_camp[] = $obj;
                               unset($giftcards[$obj->id]);
                               
            }
        }
       
        $title = 'Receipt for order ' . $transaction->reference;
        
        $PAGE->set_context(context_system::instance());
        $PAGE->set_pagelayout('print');
        $PAGE->set_title($title);
        $PAGE->set_heading($title);
        $PAGE->set_url('/local/lonet/receipt.php?id=' . $id);
        
        echo $OUTPUT->header(); ?>
        
        <style>
            body {padding:15px 30px;max-width:1024px;margin:auto;}
            h1 {text-align:center;}
            table {border-collapse:collapse;text-align:left;}
            table, th, td {border:1px solid black;}
            th, td {padding:0 5px;}
        </style>
        
        <p>
            <!--img src="<?php //$OUTPUT->get_compact_logo_url(200, 75)->out(false) ?>" alt="LONET.academy" style="float:right;"-->
            <img src="<?= $CFG->wwwroot ?>/theme/lonet/pix/receipt_logo.png" alt="LONET.academy" style="float:right;width:123px;">
            SIA "LONET" 
            <br>Legal Address: Vidzemes aleja 3 - 63, LV-1024, Rīga, Latvija
            <br>CRN: 40203091983
            <br>Phone: +371 27 344 201 (10:00 - 22:00 (GMT+2))
            <br>Email: lonet@lonet.academy
            <br>Website: <?= $CFG->wwwroot ?>
        </p>
        <h1><?= get_string('orderreceipt', 'local_lonet') ?></h1>
        <div style="width:49%;display:inline-block;">
            <p>
                <strong>Customer:</strong>
                <br>Name: <?= fullname($customer, true) ?>
                <br>Email: <?= $customer->email ?>
            </p>
        </div>
        <div style="width:50%;display:inline-block;text-align:right;">
            <p>
                <strong>Payment Date:</strong>
                <br><?= date('d/m/Y', $transaction->createdat) ?>
            </p>
            <p>
                <strong>Reference:</strong>
                <br><?= $transaction->reference ?>
            </p>
            <p>
                <strong>Payment Method:</strong>
                <br><?= order_transaction::getMethodName($transaction->method) ?>
            </p>
        </div>
         <?php if ($products || $giftcards || $lang_camp) {
			$ispromo = false;
			foreach ($products as $product) {
				if($product->promotionapplied){
					if(!$DB->record_exists_sql("SELECT * FROM {lonet_order_transaction} WHERE orderid = ".$product->orderid." and method='card'")){
						$ispromo = true;
					}
				}
			}
		?>
            <?php if ($products) { ?>
                <h2>Requested Lessons</h2>
                <table style="width:100%;">
                    <thead>
                        <tr>
                            <th>Lesson ID</th>
							<?php if($ispromo) {?>
                            <th>Coupon</th>
							<?php } ?>
                            <th>Name</th>
                            <th>Discount</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
						<!---- modified by Nitesh--->
                        <?php foreach ($products as $product) {
							if($product->isgrouplesson){
								$lesson = lesson::get_grouplesson_by_id($product->lessonid);
								$lprice = lesson::get_grouplesson_price($lesson);
							}else{
								$lesson = $DB->get_record('lonet_lesson', ['id' => $product->lessonid]);
								$lprice = $product->price;
							}
                            $teacher = $DB->get_record('user', ['id' => $product->teacherid]); ?>
                            <tr>
                                <td><?= $product->id ?></td>
								<?php if($ispromo) {?>
                                <td><?=  $DB->get_record('lonet_promo_code', ['id' => $order->promocodeid])->code; ?></td>
								<?php } ?>
                                <td><?= $lesson->name ?> with <?= fullname($teacher, true) ?></td>
                                <td>&euro; <?= number_format($product->discount, 2) ?></td>
                                <td>&euro; <?= number_format($lprice, 2) ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php } ?>
            <?php if ($giftcards) { ?>
                <h2>Gift Cards</h2>
                <table style="width:100%;">
                    <thead>
                        <tr>
                            <th>Code</th>
                            <th>Valid Through</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($giftcards as $giftcard) {
                            $lesson = $DB->get_record('lonet_lesson', ['id' => $giftcard->lessonid]);
                            $teacher = $DB->get_record('user', ['id' => $giftcard->teacherid]); ?>
                            <tr>
                                <td><?= $giftcard->code ?></td>
                                <td><?= date('d.m.Y', $giftcard->validthrough) ?></td>
                                <td>&euro; <?= number_format($giftcard->amount, 2) ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php } ?>
            <?php if ($lang_camp) { ?>
                <h2>MeetUp Summer 2021 in Barcelona</h2>
                <table style="width:100%;">
                    <thead>
                        <tr>
                            <th>Purchase ID</th>
                            <th>Package</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($lang_camp as $camp) {
                            //$lesson = $DB->get_record('lonet_lesson', ['id' => $giftcard->lessonid]);
                            //$teacher = $DB->get_record('user', ['id' => $giftcard->teacherid]); ?>
                            <tr>
                                <td><?= $camp->code ?></td>
                                <td><?= $camp->package_name ?></td>
                                <td>&euro; <?= number_format($camp->amount, 2) ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php } ?>
            <p style="text-align:right;font-size:16px;">
                <!-- START RAJESH 14_12_2022 -->
                <?php if ($transaction->minus_amount < 0) { ?>
                    Balance : &euro; <?= number_format(abs($transaction->minus_amount),2) ?><br>
                <?php } ?>
                <!-- RAJESH 14_12_2022 -->
                <strong>Total: </strong> &euro; <?= number_format($transaction->amount - $transaction->processing_fee + $transaction->used_balance_amount, 2) ?>
                <?php if ($transaction->used_balance_amount) { ?>
                <br><strong>Balance Discount: </strong>- &euro; <?= number_format($transaction->used_balance_amount, 2) ?>
                <?php } ?>
                <?php if ($transaction->processing_fee > 0) { ?>
                <br><strong>PayPal Payment Commission: </strong>+ &euro; <?= number_format($transaction->processing_fee, 2) ?>
                <?php } ?>
                <?php if ($transaction->processing_fee > 0 || $transaction->used_balance_amount) { ?>
                <br><strong>Paid: </strong> &euro; <?= number_format($transaction->amount, 2) ?>
                <?php } ?>
            </p>
            <?php if ($products) { ?>
                <br>
                <br>
                <p>Please wait for the requested lessons confirmation from the Teacher.</p>
                <p>In case you will not get the confirmation or decline in 24 hours, please contact Lonet support at lonet@lonet.academy.</p>
            <?php } ?>
        <?php } else { ?>
            <h2><?= ($transaction->method === 'reward' ? 'Referral reward ' . $transaction->description : 'Addition to Wallet') ?></h2>
            <p style="text-align:right;font-size:16px;">
                <strong>Total: </strong> &euro; <?= number_format($transaction->amount - $transaction->processing_fee + $transaction->used_balance_amount, 2) ?>
                <?php if ($transaction->used_balance_amount) { ?>
                <br><strong>Balance Discount: </strong>- &euro; <?= number_format($transaction->used_balance_amount, 2) ?>
                <?php } ?>
                <?php if ($transaction->processing_fee > 0) { ?>
                <br><strong>PayPal Payment Commission: </strong>+ &euro; <?= number_format($transaction->processing_fee, 2) ?>
                <?php } ?>
                <?php if ($transaction->processing_fee > 0 || $transaction->used_balance_amount) { ?>
                <br><strong>Paid: </strong> &euro; <?= number_format($transaction->amount, 2) ?>
                <?php } ?>
            </p>
        <?php } ?>
        <?php echo $OUTPUT->footer();
    }
} ?>
