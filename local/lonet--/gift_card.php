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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$result = false;
	$order_product = [];
    if (isset($_POST['gift_amount']) && isset($_POST['gift_count'])) {
        $order_product['product_code'] = 'giftcard';
        $order_product['price'] = $_POST['gift_amount'] * $_POST['gift_count'];
        $order_product['count'] = $_POST['gift_count'];        
        $order_product['type'] = 'amount';
        $order_product['amount'] = $_POST['gift_amount'];
        $order_product['isactive'] = 1;
        $order_product['canedit'] = 0;
        order::add_product($order_product);
        $result = true;
    }
	order::update_current_transaction();
	if ($result) {
        header('Location: ' . $CFG->wwwroot . '/local/lonet/book.php');
        exit();
    }
} else {
    //$title = get_string('editlessons', 'local_lonet');
    $title = 'Gift Card';

    $PAGE->set_context(context_system::instance());
    $PAGE->set_pagelayout('list');
    $PAGE->set_title($title);
    $PAGE->set_heading($title);
    $PAGE->set_url($_SERVER['REQUEST_URI'] ?? '/local/lonet/gift_card.php');

    // $booking = order::get_booking();
    $SESSION->wantsurl = $CFG->wwwroot . $_SERVER['REQUEST_URI'] ?? '';	

    echo $OUTPUT->header();
    ?>
    
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
			$(document).on('change', '[name="gift_amount"], [name="gift_count"]', function(e) {
                $('.price').text($('[name="gift_amount"]').val() * $('[name="gift_count"]').val());
                $('.value').text($('[name="gift_amount"]').val());
			});
		});
	</script>

    <div class="row">
        <div class="col-sm-8 user-row">
            <h2><?= get_string('h1_page_giftcard', 'theme_lonet') ?></h2>
            <div class="gift-card">
                <img src="/local/lonet/pix/Gift_card_christmas.png" alt="Gift Card">
                <span class="value-container"><span class="value"><?= 20 ?></span> EUR</span>
            </div>
        </div>
        <div class="col-sm-4 col-options">
            <div class="col-sm-12 user-row">
                <h2><?= get_string('totalprice', 'local_lonet') ?> <span class="pull-right">&euro; <span class="price"><?= 20 ?></span>.00</span></h2>
                <br>
                <?php if ($status) { ?>
                    <div class="alert alert-danger">
                        <?= get_string('paymentstatus_' . $status, 'local_lonet') ?>
                    </div>
                    <br>
                <?php } ?>
                <form method="post">
                    <div class="row">
                        <div class="col-sm-12">
                            <label><?= get_string('cardvalue', 'local_lonet') ?> </label>
                        </div>
                        <div class="col-sm-12">
                            <select name="gift_amount" class="form-control" style="width: 100%;">
                                <option value="20" selected>20 EUR</option>
                                <option value="30">30 EUR</option>
                                <option value="50">50 EUR</option>
                                <option value="75">75 EUR</option>
                                <option value="100">100 EUR</option>
                                <option value="300">300 EUR</option>
                                <option value="500">500 EUR</option>
                                <option value="1000">1000 EUR</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <label><?= get_string('how_many_cards', 'local_lonet') ?></label>
                        </div>
                        <div class="col-sm-12">
                            <select name="gift_count" class="form-control" style="width: 100%;">
                                <option value="1" selected>1</option>
                                <?php foreach (range(2, 10) as $count) { ?>
                                    <option value="<?= $count ?>"><?= $count ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <br>
                    <?php if (!isloggedin() || isguestuser()) { ?>
                    <p><a class="btn btn-block btn-success login cd-popup-trigger" href="#"><?= get_string('ihaveaccount', 'local_lonet') ?></a></p>
                    <p><a class="btn btn-block btn-success" href="/login/signup.php#"><?= get_string('idonthaveaccount', 'local_lonet') ?></a></p>
                    <?php } else { ?>
                    <p><button type="submit" class="btn btn-block btn-success"><?= get_string('submit', 'core_moodle') ?></button></p>
                    <?php } ?>
                </form>
            </div>
        </div>
    </div>
    <?php echo $OUTPUT->footer();
}
