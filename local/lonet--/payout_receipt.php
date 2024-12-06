<?php
use local_lonet\order_product;
use local_lonet\payout_request;

global $CFG;
global $DB;
global $USER;

require_once('../../config.php');
require_once($CFG->dirroot.'/local/lonet/lib.php');

require_login();

$id = (isset($_GET['id']) ? $_GET['id'] : null);

if ($id && $payout_request = $DB->get_record('lonet_payout_request', ['id' => $id])) {
	if ($USER->id == $payout_request->teacherid || is_siteadmin()) {
		$teacher = $DB->get_record('user', ['id' => $payout_request->teacherid]);
		// $sixmonth = strtotime('-365 days');//added by Nitesh
		// $products = $DB->get_records('lonet_order_product', ['payoutrequestid' => $payout_request->id]);
		$products = $DB->get_records_sql('
			SELECT op.*
			FROM {lonet_order_product} op
			INNER JOIN {lonet_order} ord ON ord.id = op.orderid
			WHERE op.payoutrequestid = '. $payout_request->id .'
		');
		$reference = payout_request::get_reference($payout_request);
        
        $is_bank = $payout_request->withdrawaltype == payout_request::TYPE_ACCOUNT;
        $is_paypal = $payout_request->withdrawaltype == payout_request::TYPE_PAYPAL;
        
        $withdrawal_options = payout_request::getWithdrawalOptions();
		
		$title = 'Receipt for payout request ' . $reference;
		
		$PAGE->set_context(context_system::instance());
		$PAGE->set_pagelayout('print');
		$PAGE->set_title($title);
		$PAGE->set_heading($title);
		$PAGE->set_url('/local/lonet/payout_receipt.php?id=' . $id);
		
		echo $OUTPUT->header(); ?>
		
		<style>
			body {padding:15px 30px;max-width:1024px;margin:auto;}
			h1 {text-align:center;}
			table {border-collapse:collapse;text-align:left;}
			table, th, td {border:1px solid black;}
			th, td {padding:0 5px;}
		</style>
		
		<p>
			<img src="<?= $OUTPUT->get_compact_logo_url(200, 75)->out(false) ?>" alt="LONET.academy" style="float:right;">
			SIA "LONET" 
			<br>Legal Address: Vidzemes aleja 3 - 63, LV-1024, Rīga, Latvija
			<br>CRN: 40203091983
			<br>Phone: +371 27 344 201 (10:00 - 22:00 (GMT+2))
			<br>Email: lonet@lonet.academy
			<br>Website: <?= $CFG->wwwroot ?>
		</p>
		<h1><?= get_string('payoutreceipt', 'local_lonet') ?></h1>
		<div style="width:49%;display:inline-block;">
			<p>
				<strong>Beneficiary:</strong>
				<br>Name: <?= fullname($teacher, true) ?>
				<br>Email: <?= $teacher->email ?>
				<?= ($payout_request->accountcountry == 'Latvia' ? '<br>' . get_string('iknumber', 'local_lonet') . ': ' . $payout_request->iknumber : '') ?>
				<br>Address: <?= $payout_request->accountaddress ?>
			</p>
			<p>
				<strong>Beneficiary <?= ($is_bank ? 'Bank' : 'PayPal') ?> Details:</strong>
                <?php if ($is_bank) { ?>
                    <br>Bank: <?= $payout_request->accountbank ?>
                    <br>Account Holder: <?= $payout_request->accountname ?>
                    <br>Account Number: <?= $payout_request->accountnumber ?>
                    <br>SWIFT Code: <?= $payout_request->accountswift ?>
                <?php } elseif ($is_paypal) { ?>
                    <br>Account Holder: <?= $payout_request->accountname ?>
                    <br>Email: <?= $payout_request->paypalemail ?>
                <?php } ?>
			</p>
		</div>
		<div style="width:50%;display:inline-block;text-align:right;">
			<p>
				<strong>Request Date:</strong>
				<br><?= date('d/m/Y', $payout_request->createdat) ?>
			</p>
			<p>
				<strong>Reference:</strong>
				<br><?= $reference ?>
			</p>
			<p>
				<strong>Payment Method:</strong>
				<br><?= $withdrawal_options[$payout_request->withdrawaltype] ?>
			</p>
		</div>
		<h2>Requested Payout</h2>
		<table style="width:100%;">
			<thead>
				<tr>
					<th>Lesson ID</th>
					<th>Name</th>
					<th>Amount</th>
				</tr>
			</thead>
			<tbody>
				<?php $total = 0;
				foreach ($products as $product) {
					$total += $product->payoutamount; ?>
					<tr>
						<td><?= $product->id ?></td>
						<td><?= order_product::get_name($product, true) ?></td>
						<td>&euro; <?= number_format($product->payoutamount, 2) ?></td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
		<p style="text-align:right;font-size:16px;">
			<strong>Total: </strong> &euro; <?= number_format($total, 2) ?>
		</p>
		<br>
		<br>
		<p>Please wait for the payment confirmation/remittance copy.</p>
		<p>In case you will not get the payment confirmation and/or funds in 30 calendar days, please contact Lonet support at lonet@lonet.academy.</p>
		<?php echo $OUTPUT->footer();
	} else {
        print_error('notlocalisederrormessage', 'error', '', 'Page not found.');
    }
} else {
    print_error('notlocalisederrormessage', 'error', '', 'Page not found.');
}
?>
