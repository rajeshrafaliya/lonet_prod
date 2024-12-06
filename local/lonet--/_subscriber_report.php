<?php
use local_lonet\subscriber_request;

defined('MOODLE_INTERNAL') || die();

global $CFG;
global $DB;

foreach (['date_from', 'date_to'] as $attribute) {
	${$attribute} = (isset(${$attribute}) ? ${$attribute} : null);
}

$userTimezone = core_date::get_user_timezone_object();
$current_date = new DateTime('now', $userTimezone);
$date_to = $date_to ?: $current_date->format('Y-m-d');
$date_from = $date_from ?: $current_date->modify('-30 days')->format('Y-m-d');
$timestamp_from = (new DateTime($date_from . ' 00:00:00', $userTimezone))->getTimestamp();
$timestamp_to = (new DateTime($date_to . ' 23:59:59', $userTimezone))->getTimestamp();

$subscriber_report = $DB->get_records_sql("SELECT * FROM {lonet_subscriber} WHERE createdat BETWEEN $timestamp_from AND $timestamp_to ORDER BY createdat DESC");
?>

<script>
	$(document).ready(function() {
        function submitForm(e) {
            window.location.href = '<?= $CFG->wwwroot ?>/local/lonet/admin.php?report=subscriber&' + $('.thead input, .thead select').serialize();
        }
		$('thead input, thead select').change(submitForm);
		$('.btn-select-period').click(submitForm);
        $('.btn-copy').click(function(e) {
            let emailList = document.getElementById('email-list');
            if (emailList.value != '') {
                emailList.select();
                try {
                    document.execCommand('copy');
                    swal({
                        title: 'Email list copied!',
                        text: '', 
                        icon: 'success',
                        timer: 2000,
                    });
                } catch (error) {
                    //
                }
            }
        });
	});
</script>

<div class="thead text-right" style="padding-bottom:10px;">
    <button class="btn btn-success btn-copy pull-left"><span class="fa fa-copy"></span></button>
	<div class="text-right">
        Subscribe period from&nbsp;<input type="date" name="date_from" value="<?= $date_from ?>">
        to&nbsp;<input type="date" name="date_to" value="<?= $date_to ?>">
        &nbsp;<button class="btn btn-success btn-select-period"><span class="fa fa-check"></span></button>
    </div>
</div>
<table class="table table-striped table-bordered">
	<thead class="thead">
		<tr>
			<th>ID</th>
			<th>Email</th>
			<th>Full Name</th>
			<th>Phone Number</th>
			<th>Skype</th>
			<th>Comment</th>
			<th>Referrer</th>
			<th><?= get_string('createdat', 'local_lonet') ?></th>
		</tr>
	</thead>
	<tbody>
		<?php $email_list = '';
        foreach ($subscriber_report as $subscriber) {
            $email_list .= ($subscriber->email ? ($email_list ? ',' : '') . $subscriber->email : '');
            ?>
            <tr>
                <td><?= $subscriber->id ?></td>
                <td class="subscriber-email"><?= $subscriber->email ?></td>
                <td><?= $subscriber->name ?></td>
                <td><?= $subscriber->phone_number ?></td>
                <td><?= $subscriber->skype ?></td>
                <td><?= $subscriber->comment ?></td>
                <td><?= $subscriber->referrer ?></td>
                <td><?= (new DateTime('now', $userTimezone))->setTimestamp($subscriber->createdat)->format('d.m.Y') ?></td>
            </tr>
        <?php } ?>
	</tbody>
</table>
<textarea id="email-list" rows=1 style="width: 100%;"><?= $email_list ?></textarea>
