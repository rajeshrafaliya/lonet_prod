<?php
use local_lonet\teacher;

defined('MOODLE_INTERNAL') || die();

global $CFG;
global $DB;

$promo_report = $DB->get_records_sql('SELECT * FROM {lonet_promo_code} WHERE isactive = 1 ORDER BY createdat DESC');

$teacher_options = teacher::get_active();
?>

<style>
	tr:not(.editable) input,
	tr:not(.editable) select,
	tr:not(.editable) .btn-save,
	tr:not(.editable) .btn-cancel,
	tr.editable .btn-edit,
	tr.editable .btn-delete,
	tr.editable .value {
		display: none;
	}
	input[type="number"] {
		width: 100px;
	}
</style>

<script>
	$(document).on('change', '[name="PromoCode[type]"]', function(e) {
		if ($(this).val() == 'amount') {
			$('[name="PromoCode[discount]"], [name="PromoCode[lessoncountperlearner]"], [name="PromoCode[lessoncount]"]').hide();
			$('[name="PromoCode[amount]"]').show();
		} else if ($(this).val() == 'discount') {
			$('[name="PromoCode[amount]"]').hide();
			$('[name="PromoCode[discount]"], [name="PromoCode[lessoncountperlearner]"], [name="PromoCode[lessoncount]"]').show();
		}
	});
	$(document).on('click', '.btn-save', function(e) {
		var row = $(this).parents('tr');
		var id = row.attr('data-key');
		var data = 'action=save&' + row.find('input, select').serialize() + '&PromoCode[id]=' + id;
		$.ajax({
			type: 'POST',
			url: '/local/lonet/admin.php',
			dataType: 'json',
			data: data,
			success: function(result) {
				if (result.success) {
					window.location.reload();
				} else {
					swal('Error Occured', result.error, 'error');
				}
			},
			error: function(xhr, ajaxOptions, thrownError){
				swal('Server Error Occured', xhr.responseText, 'error');
			}
		});
	});
	$(document).on('click', '.btn-delete', function(e) {
		var row = $(this).parents('tr');
		swal({
			title: '<?= get_string('areyousure', 'local_lonet') ?>',
			text: '', 
			icon: 'warning',
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
				var id = row.attr('data-key');
				var data = 'action=save&PromoCode[isactive]=0&PromoCode[id]=' + id;
				$.ajax({
					type: 'POST',
					url: '/local/lonet/admin.php',
					dataType: 'json',
					data: data,
					success: function(result) {
						if (result.success) {
							window.location.reload();
						} else {
							swal('Error Occured', result.error, 'error');
						}
					},
					error: function(xhr, ajaxOptions, thrownError){
						swal('Server Error Occured', xhr.responseText, 'error');
					}
				});
			}
		});
	});
</script>
<div class="thead text-right" style="padding-bottom:10px;">
	<button class="btn btn-success btn-add"><span class="fa fa-plus"></span></button>
</div>
<table class="table table-striped table-bordered table-report">
	<thead class="thead">
		<tr>
			<th><?= get_string('code', 'local_lonet') ?></th>
			<th><?= get_string('type', 'local_lonet') ?></th>
			<th><?= get_string('amounteuro', 'local_lonet') ?></th>
			<th><?= get_string('discounteuro', 'local_lonet') ?></th>
			<th><?= get_string('lessoncountperlearner', 'local_lonet') ?></th>
			<th><?= get_string('lessoncount', 'local_lonet') ?></th>
			<th><?= get_string('teacher', 'local_lonet') ?></th>
			<th><?= get_string('validthrough', 'local_lonet') ?></th>
			<th><?= get_string('createdat', 'local_lonet') ?></th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<tr class="row-add editable" data-key=0 style="display: none;">
			<td><input type="text" name="PromoCode[code]" required></td>
			<td>
				<select name="PromoCode[type]" required>
					<option></option>
					<?php foreach (['amount', 'discount'] as $type) { ?>
						<option value="<?= $type ?>"><?= $type ?></option>
					<?php } ?>
				</select>
			</td>
			<td><input type="number" name="PromoCode[amount]" min=1></td>
			<td><input type="number" name="PromoCode[discount]" min=1 max=<?= get_config('local_lonet', 'commissionperlesson') ?>></td>
			<td><input type="number" name="PromoCode[lessoncountperlearner]" min=1></td>
			<td><input type="number" name="PromoCode[lessoncount]"></td>
			<td>
				<select name="PromoCode[teacherid]">
					<option></option>
					<?php foreach ($teacher_options as $teacher_option) { ?>
						<option value="<?= $teacher_option->id ?>"><?= $teacher_option->email ?></option>
					<?php } ?>
				</select>
			</td>
			<td><input type="date" name="PromoCode[validthrough]"></td>
			<td></td>
			<td>
				<button class="btn btn-success btn-save"><span class="fa fa-check"></span></button>
				<button class="btn btn-warning btn-cancel"><span class="fa fa-times"></span></button>
			</td>
		</tr>
		<?php
		foreach ($promo_report as $record) {
			$teacher = ($record->teacherid ? $DB->get_record('user', ['id' => $record->teacherid]) : null);
			$validthrough = ($record->validthrough ? (new DateTime('now', core_date::get_user_timezone_object()))->setTimestamp($record->validthrough)->format('Y-m-d') : null);
			?>
			<tr data-key=<?= $record->id ?>>
				<td>
					<input type="text" name="PromoCode[code]" required value="<?= $record->code ?>">
					<div class="value"><?= $record->code ?></div>
				</td>
				<td>
					<select name="PromoCode[type]" required>
						<?php foreach (['amount', 'discount'] as $type) { ?>
							<option value="<?= $type ?>" <?= ($record->type == $type ? 'selected' : '') ?>><?= $type ?></option>
						<?php } ?>
					</select>
					<div class="value"><?= $record->type ?></div>
				</td>
				<td>
					<input type="number" name="PromoCode[amount]" min=1 value="<?= $record->amount ?>">
					<div class="value"><?= ($record->amount ? $record->amount : '-') ?></div>
				</td>
				<td>
					<input type="number" name="PromoCode[discount]" min=1 max=<?= get_config('local_lonet', 'commissionperlesson') ?> value="<?= $record->discount ?>">
					<div class="value"><?= ($record->discount ? $record->discount : '-') ?></div>
				</td>
				<td>
					<input type="number" name="PromoCode[lessoncountperlearner]" min=1 value="<?= $record->lessoncountperlearner ?>">
					<div class="value"><?= ($record->lessoncountperlearner ? $record->lessoncountperlearner : '-') ?></div>
				</td>
				<td>
					<input type="number" name="PromoCode[lessoncount]" value="<?= $record->lessoncount ?>">
					<div class="value"><?= ($record->lessoncount ? $record->lessoncount : '-') ?></div>
				</td>
				<td>
					<select name="PromoCode[teacherid]">
						<option></option>						
						<?php foreach ($teacher_options as $teacher_option) { ?>
							<option value="<?= $teacher_option->id ?>" <?= ($teacher_option->id == $record->teacherid ? 'selected' : '') ?>><?= $teacher_option->email ?></option>
						<?php } ?>
					</select>
					<div class="value"><?= ($teacher ? $teacher->email : '-') ?></div>
				</td>
				<td>
					<input type="date" name="PromoCode[validthrough]" value="<?= $validthrough ?>">
					<div class="value"><?= ($validthrough ? $validthrough : '-') ?></div>
				</td>
				<td><?= (new DateTime('now'))->setTimestamp($record->createdat)->format('Y-m-d') ?></td>
				<td>
                    <?php if ($record->canedit) { ?>
					<button class="btn btn-success btn-edit"><span class="fa fa-pencil"></span></button>
					<button class="btn btn-success btn-save"><span class="fa fa-check"></span></button>
					<button class="btn btn-warning btn-cancel"><span class="fa fa-times"></span></button>
					<button class="btn btn-danger btn-delete"><span class="fa fa-trash"></span></button>
                    <?php } ?>
				</td>
			</tr>
		<?php } ?>
	</tbody>
</table>
