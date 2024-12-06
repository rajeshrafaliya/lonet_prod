<?php
use local_lonet\order_transaction;
use local_lonet\user;

global $DB;

require_once('../../config.php');
require_once($CFG->dirroot.'/local/lonet/lib.php');

$id = (isset($_GET['id']) ? $_GET['id'] : null);
$title = get_string('transactionhistory', 'local_lonet');

$PAGE->set_context(context_system::instance());
$PAGE->set_pagelayout('base');
$PAGE->set_title($title);
$PAGE->set_heading($title);
$PAGE->set_url('/local/lonet/wallet.php?id=' . $id);

echo $OUTPUT->header();

global $USER;

if ($id && ($USER->id == $id || is_siteadmin() || user::is_bookkeeper()) && $user = $DB->get_record('user', ['id' => $id])) {
	$order_transactions = order_transaction::get_user_transactions($id); ?>

	<script>
		$(document).ready(function() {
			$('.btn-cancel-lesson').click(function(e) {
				var row = $(this).parents('.row-lesson');
				$.ajax({
					type: 'POST',
					url: '/local/lonet/cancel.php',
					dataType: 'text',            
					data: {
						id: row.attr('data-id'),
					},
					success: function(result){
						if (result) {
							row.addClass('bg-danger');
							row.find('.btn-message, .btn-cancel-lesson').remove();
							swal('Lesson Cancelled', result, 'info');
						} else {
							swal('Error Occured', 'Cancellation was unsuccessful.', 'error');
						}
					},
					error: function(xhr, ajaxOptions, thrownError){
						swal('Server Error Occured', xhr.responseText, 'error');
					}
				});
			});
			$('.btn-rate-teacher').click(function(e) {
				$('#rating-modal').remove();
				var row = $(this).parents('.row-lesson');
				alert(row.attr('data-id'));
				$.ajax({
					type: 'GET',
					url: '/local/lonet/ajax_rate.php?lessonid=' + row.attr('data-id'),
					dataType: 'text',
					success: function(result){
						if (result) {
							$('body').append(result);
							$('#rating-modal').modal();
						}
					},
					error: function(xhr, ajaxOptions, thrownError){
						swal('Server Error Occured', xhr.responseText, 'error');
					}
				});
			});
		});
	</script>
	<h3 class="thistorytitle"><?= $title ?></h3>
	<br>

	<!--ul class="nav nav-tabs">
		<li class="active"><a data-toggle="tab" href="#balance"><?= get_string('balancereport', 'local_lonet') ?></a></li>
	</ul-->
	
	<div class="tab-content" id="transactionhistory">
		<div id="balance" class="tab-pane fade in active">
			<div class="container-fluid">
				<p class="thistorybalance my-0">&euro;<?= number_format(user::get_balance($user->id), 2) ?></p>
				<div class="row row-header hidden-xs">
					<div class="col-xs-12">
						<div class="row">
							<div class="col-sm-2 px-0 head"><?= get_string('reference', 'local_lonet') ?></div>
							<div class="col-sm-2 px-0 head"><?= get_string('lessonid', 'local_lonet') ?></div>
							<div class="col-sm-4 px-0 head"><?= get_string('dateandtime', 'local_lonet') ?></div>
							<!--div class="col-sm-2 px-0 head"><?= get_string('status') ?></div-->
							<div class="col-sm-2 px-0 head"><?= get_string('amount', 'local_lonet') ?></div>
							<div class="col-xs-2 px-0 head"><?= get_string('receipt', 'local_lonet') ?></div>
						</div>
					</div>
				</div>
				<?php $now = time();
				// $getfirstpromo = $DB->get_record_sql("SELECT * FROM {lonet_order} WHERE studentid=".$user->id." AND promocodeid IS NOT NULL order by id ASC LIMIT 0,1");
				$getfirstpromos = $DB->get_records_sql("SELECT * FROM {lonet_order} WHERE studentid=".$user->id." AND promocodeid IS NOT NULL group by promocodeid");
				$promoorderids = [];
				foreach($getfirstpromos as $singlepromo){
					$promoorderids[] = $singlepromo->id;
				}
//        if (is_siteadmin()) {
//          print_object($order_transactions);
//        }
//        $count_incomming = 0.00;
//        $count_outgoing = 0.00;
//        $total_used_balance = 0.00;
				foreach ($order_transactions as $transaction) {
				//only status 5 balance is counting in balance caluclation- for 2775 user it's discarding order- 11135 because it's staus is 1
/* 				if(!empty($transaction->orderid) && !$DB->record_exists_sql("SELECT * FROM {lonet_order_product} WHERE orderid=".$transaction->orderid."")){
					if(!$DB->record_exists_sql("SELECT * FROM {lonet_order_transaction} WHERE reference='".$transaction->reference."' AND method IN('reward','bank')")){
						continue;
					}
				} */
          if ($transaction->isincoming) {
             $count_incomming = $count_incomming + $transaction->amount - $transaction->processing_fee;
          } else {
            $total_used_balance = $total_used_balance + $transaction->amount;
          }
           
           if ($transaction->lessonid > 0) {
//             print_object(["lession ID" => $transaction->lessionid]);
             $count_outgoing = $count_outgoing + $transaction->amount;
           }
				?>
					<div class="row row-transaction <?= ($transaction->isincoming ? 'bg-success' : '') ?>">
						<div class="col-xs-12">
							<div class="row">
								<div class="col-sm-2 data">
									<?= $transaction->reference ?>
								</div>
								<div class="col-sm-2 data">
								<?php
								preg_match('/(\d+)/', $transaction->reference, $matches);
								$ordid = $matches[1];
								if($ordid){
									$lessonsql = $DB->get_record_sql("SELECT * FROM {lonet_order_product} WHERE id=".$ordid."");
									if(!empty($lessonsql->lessonid)){
										$lessonrecord = $DB->get_record_sql("SELECT * FROM {lonet_lesson} WHERE id=".$lessonsql->lessonid."");
										if($lessonrecord->offer > 0){
											echo '';
										}else{
											if (stripos($transaction->reference, 'lonet') !== false) {
												echo '';
											}else{
												echo $lessonsql->lessonid;
											}
										}
									}else{
										echo $lessonsql->lessonid;
									}
								}else{
									echo '';
								}
								?></div>
								<div class="col-sm-4 data">
									<?= user::get_time_label($transaction->datetime) ?>
								</div>
								<!--div class="col-sm-2 data">status</div-->
								<div class="col-sm-2 data">
									<?= ($transaction->isincoming ? '' : '-') ?> <b>&euro;</b> 
                                    <?php if ($transaction->processing_fee > 0) { ?>
                                        <?= ($transaction->amount - $transaction->processing_fee) ?> (+ <?= $transaction->processing_fee ?>) 
                                    <?php } else { ?>
                                        <?= $transaction->amount ?>
                                    <?php } ?>
								</div>
								
						<div class="col-xs-2 text-center">
							<?php if ($transaction->orderid) { ?>
								<a class="btn btn-info" href="/local/lonet/receipt.php?id=<?= $transaction->orderid ?>" target="_blank" rel="noopener noreferrer"><span class="fa fa-file-text"><span></a>
							<?php } ?>
						</div>
							</div>
						</div>
					</div>
				<?php
				// if($getfirstpromo->id == $transaction->orderid){
				if(in_array($transaction->orderid, $promoorderids)){
				$orderpid = $DB->get_record_sql("SELECT * FROM {lonet_order} WHERE id=".$transaction->orderid."");
				if($getpromocode = $DB->get_record_sql("SELECT * FROM {lonet_promo_code} WHERE id=".$orderpid->promocodeid." AND isactive=1")){
				// if($getpromocode = $DB->get_record_sql("SELECT * FROM {lonet_promo_code} WHERE id=".$orderpid->promocodeid."")){
				?>
					<div class="row row-transaction bg-success">
						<div class="col-xs-12">
							<div class="row">
								<div class="col-sm-2 data">
									<?= $getpromocode->code ?>
								</div>
								<div class="col-sm-2 data"></div>
								<div class="col-sm-4 data">
									<?= user::get_time_label($transaction->datetime) ?>
								</div>
								<!--div class="col-sm-2 data"></div-->
								<div class="col-sm-2 data">
									<b>&euro;</b> 
									<?= $getpromocode->amount ?>
								</div>
							</div>
						</div>
					</div>
				<?php }
				}
				}
//        if(is_siteadmin()){ 
//          $total_left = $count_incomming - $count_outgoing;
//          $total_available = $count_incomming - $total_used_balance;
//          echo "OUTGOING AMOUNT TOTAL: ".$count_outgoing."<br>";
//          echo "INCOMING AMOUNT TOTAL: ".$count_incomming."<br>";
//          echo "TOTAL USED BOOKED: ".$total_used_balance."<br>";
//          echo "TOTAL TO SPEND: ".$total_left."<br>";
//          echo "TOTAL AVAIL BAL: ".$total_available;
//        }
				?>
			</div>
		</div>
	</div>
<?php } ?>
<?= $OUTPUT->footer() ?>
