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
	<h3><?= $title ?></h3>
	<br>

	<ul class="nav nav-tabs">
		<li class="active"><a data-toggle="tab" href="#balance"><?= get_string('balancereport', 'local_lonet') ?></a></li>
	</ul>
	
	<div class="tab-content">
		<div id="balance" class="tab-pane fade in active">
			<div class="container-fluid">
				<p><b>&euro;</b> <?= number_format(user::get_balance($user->id), 2) ?></p>
				<div class="row row-header hidden-xs">
					<div class="col-xs-9">
						<div class="row">
							<div class="col-sm-4"><?= get_string('reference', 'local_lonet') ?></div>
							<div class="col-sm-4"><?= get_string('dateandtime', 'local_lonet') ?></div>
							<div class="col-sm-4"><?= get_string('amount', 'local_lonet') ?></div>
						</div>
					</div>
					<div class="col-xs-3">
						<?= get_string('receipt', 'local_lonet') ?>
					</div>
				</div>
				<?php $now = time();
				// $getfirstpromo = $DB->get_record_sql("SELECT * FROM {lonet_order} WHERE studentid=".$user->id." AND promocodeid IS NOT NULL order by id ASC LIMIT 0,1");
				$getfirstpromos = $DB->get_records_sql("SELECT * FROM {lonet_order} WHERE studentid=".$user->id." AND promocodeid IS NOT NULL group by promocodeid");
				$promoorderids = [];
				foreach($getfirstpromos as $singlepromo){
					$promoorderids[] = $singlepromo->id;
				}
				foreach ($order_transactions as $transaction) { 
				//only status 5 balance is counting in balance caluclation- for 2775 user it's discarding order- 11135 because it's staus is 1
/* 				if(!empty($transaction->orderid) && !$DB->record_exists_sql("SELECT * FROM {lonet_order_product} WHERE orderid=".$transaction->orderid."")){
					if(!$DB->record_exists_sql("SELECT * FROM {lonet_order_transaction} WHERE reference='".$transaction->reference."' AND method IN('reward','bank')")){
						continue;
					}
				} */
				?>
					<div class="row row-transaction <?= ($transaction->isincoming ? 'bg-success' : '') ?>">
						<div class="col-xs-9">
							<div class="row">
								<div class="col-sm-4">
									<?= $transaction->reference ?>
								</div>
								<div class="col-sm-4">
									<?= user::get_time_label($transaction->datetime) ?>
								</div>
								<div class="col-sm-4">
									<?= ($transaction->isincoming ? '' : '-') ?> <b>&euro;</b> 
                                    <?php if ($transaction->processing_fee > 0) { ?>
                                        <?= ($transaction->amount - $transaction->processing_fee) ?> (+ <?= $transaction->processing_fee ?>) 
                                    <?php } else { ?>
                                        <?= $transaction->amount ?>
                                    <?php } ?>
								</div>
							</div>
						</div>
						<div class="col-xs-3">
							<?php if ($transaction->orderid) { ?>
								<a class="btn btn-info" href="/local/lonet/receipt.php?id=<?= $transaction->orderid ?>" target="_blank" rel="noopener noreferrer"><span class="fa fa-file-text"><span></a>
							<?php } ?>
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
						<div class="col-xs-9">
							<div class="row">
								<div class="col-sm-4">
									<?= $getpromocode->code ?>
								</div>
								<div class="col-sm-4">
									<?= user::get_time_label($transaction->datetime) ?>
								</div>
								<div class="col-sm-4">
									<b>&euro;</b> 
									<?= $getpromocode->amount ?>
								</div>
							</div>
						</div>
					</div>
				<?php } ?>
				<?php } ?>
				<?php } ?>
			</div>
		</div>
	</div>
<?php } ?>
<?= $OUTPUT->footer() ?>
