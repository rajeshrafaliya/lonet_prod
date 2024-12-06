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
    if (isset($_POST['camp_amount']) && isset($_POST['gift_count'])) {
        $order_product['product_code'] = $_POST['package'];
        $order_product['price'] = $_POST['camp_amount'] * $_POST['gift_count'];
        $order_product['count'] = $_POST['gift_count'];        
        $order_product['type'] = 'amount';
        $order_product['amount'] = $_POST['camp_amount'];
        $order_product['isactive'] = 1;
        $order_product['canedit'] = 0;
        order::add_product($order_product);
        $result = true;
    //     echo __line__;
    //  print_r($order_product);
    //  die();
    }
    order::update_current_transaction();
    
    if ($result) {
        header('Location: ' . $CFG->wwwroot . '/local/lonet/language_book.php');
        exit();
    }
} else {
    //$title = get_string('editlessons', 'local_lonet');
    $title = 'Language Camp Booking';

    $PAGE->set_context(context_system::instance());
    $PAGE->set_pagelayout('list');
    $PAGE->set_title($title);
    $PAGE->set_heading($title);
    $PAGE->set_url($_SERVER['REQUEST_URI'] ?? '/local/lonet/language_camp.php');

    // $booking = order::get_booking();
    $SESSION->wantsurl = $CFG->wwwroot . $_SERVER['REQUEST_URI'] ?? ''; 

    echo $OUTPUT->header();
    ?>
    
    <style>
        .gift-card {
            position: relative;
            text-align: center;
        }
        .gift-card > img {
            width: 100%;
            height: auto;
            /*border-radius: 10px;*/
        }
        .gift-card > .value-container {
            position: absolute;
            top: 60%;
            right: 50%;
            font-size: 75px;
            color: #6A2B05;
            font-weight: bold;
            font-family: Times New Roman;
            text-shadow: 2px 2px #B87139;
        }
        .gift-card > .value-container > .value {
            font-size: inherit;
            color: inherit;
            font-weight: inherit;
            font-family: inherit;
        }
        .hero-unit {
  padding: 15px;
  font-size: 18px;
  font-weight: 200;
  line-height: 30px;
  color: inherit;
  background-color: #eee;
  -webkit-border-radius: 6px;
  -moz-border-radius: 6px;
  border-radius: 6px;
}
        @media screen and (max-width: 762px) {
            .gift-card > .value-container {
                font-size: 10vw;
            }
        }
    </style>
    <script>
        $(document).ready(function() {
            $(document).on('change', '[name="camp_amount"], [name="gift_count"]', function(e) {
                $('.price').text($('[name="camp_amount"]').val() * $('[name="gift_count"]').val());
                $('.value').text($('[name="camp_amount"]').val());
            });
            
            $(document).on('change', '#package-name', function(e) {
                if(this.value == "Camp with private accommodation"){
                    $('#camp_amount').val("780");
                    $('#camp_amount').trigger('change');
                }
                else if (this.value == "Camp with group accommodation" )
                {
                    $('#camp_amount').val("570");
                    $('#camp_amount').trigger('change');
                }
                else if (this.value == "MEET-UP CAMP June 2022" )
                {
                    $('#camp_amount').val("450");
                    $('#camp_amount').trigger('change');
                }
                else
                {
                    $('#camp_amount').val("450");
                    $('#camp_amount').trigger('change');
                }
                
            });
        });
    </script>

    <div class="row">
        <div class="col-sm-8 user-row">
            <h2>MEET-UP CAMP IN BARCELONA. JUNE 6-11, 2022</h2>
            <div class="hero-unit" id="yui_3_17_2_1_1625732372554_26">
                <div class="hero-unit-content" style="height: auto;"><h4>In cooperation with the professional tutors Lonet.Academy is happy to invite you to the most diverse and spectacular city of Spain for a 6 day adventure camp to meet for an intensive mind and body training this summer.</h4>
				<h5>Join the adventure camp to: </h5>
                    <ul>
						<li>learn languages (English and Spanish), </li>
						<li>do the sunrise body stretching activities on the beach, </li>
						<li>learn and play beach volleyball,</li>
						<li>do fitness sessions,</li>
						<li>get acquainted with the city of Barcelona, its history and architecture,</li>
						<li>enjoy Catalan cuisine</li>
						<li>engage in various group activities aimed to brush up your English and Spanish and spend incredible 6 days in Barcelona, one of the most wonderful Mediterranean cities</li>
                    </ul>
                <h5>Dates: June 6-11, 2022<br/>Place: Barcelona, Spain</h5>
                </div>
            </div>
			<div class="gift-card">
                <img src="/local/lonet/pix/lang_camp.jpg" alt="Gift Card">
                <br>
				<b><u>INCLUDED:</u></b>
				<br>
				10 hours of English lessons<br>
				Morning stretching trainings on the beach<br>
				Beach volleyball training and games<br>
				City tour in Barcelona<br>
				Dinner with a Spanish cuisine<br>
				Salsa/bachata dancing session<br>
				Sangria night with snacks<br>
				And more activities that are meant to be a surprise.
            </div>

        </div>
        <div class="col-sm-4 col-options">
            <div class="col-sm-12 user-row">
                <h2><?= get_string('totalprice', 'local_lonet') ?> <span class="pull-right">&euro; <span class="price"><?= 450 ?></span>.00</span></h2>
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
                            <label>CHOOSE A PACKAGE</label>
                        </div>
                        <div class="col-sm-12">
                            <select name="package" id="package-name" class="form-control" style="width: 100%;">
                                <!--<option value="Camp with private accommodation" selected>Camp with private accommodation </option>
                                <option value="Camp with group accommodation">Camp with group accommodation</option>
                                <option value="Travel companion (group accommodation)">Travel companion (group accommodation)</option>-->
                                <option value="MEET-UP CAMP June 2022" selected>MEET-UP CAMP June 2022</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <label>Package Value</label>
                        </div>
                        <div class="col-sm-12">
                            <select name="camp_amount" id="camp_amount" class="form-control" style="width: 100%;" readonly>
                                <!--<option value="780" hidden selected>780 EUR</option>
                                <option value="570" hidden>570 EUR</option>
                                <option value="380" hidden>380 EUR</option>-->
                                <option value="450" hidden selected>450 EUR</option>
                            </select>
                        </div>
                    </div>
                    <div class="row" ><!--style="display:none;"-->
                        <div class="col-sm-12">
                            <label>Quantity</label>
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
                    <input type="hidden" name="isCampBooking" value="1">
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
