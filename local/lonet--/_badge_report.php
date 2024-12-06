<?php
use local_lonet\teacher;

defined('MOODLE_INTERNAL') || die();

global $CFG;
global $DB;

$badge_report = $DB->get_records_sql('SELECT * FROM {lonet_user_badge} WHERE isactive = 1');

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
	$(document).on('click', '.btn-save', function(e) {
		var row = $(this).parents('tr');
		var id = row.attr('data-key');
		var data = 'action=save&' + row.find('input, select').serialize() + '&UserBadge[id]=' + id;
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
				var data = 'action=save&UserBadge[isactive]=0&UserBadge[id]=' + id;
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
			<th><?= get_string('teacher', 'local_lonet') ?></th>
			<th><?= get_string('language', 'local_lonet') ?></th>
			<th>Badge</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<tr class="row-add editable" data-key=0 style="display: none;">
            <td>
                <select name="UserBadge[userid]" required>
                    <option></option>						
                    <?php foreach ($teacher_options as $teacher_option) { ?>
                        <option value="<?= $teacher_option->id ?>"><?= $teacher_option->email ?></option>
                    <?php } ?>
                </select>
            </td>
            <td><input type="text" name="UserBadge[language]"></td>
            <td>
                <select name="UserBadge[badge]" required>
                    <?php foreach (['new', 'bestprice', 'recommended', 'specialoffer', 'native'] as $badge) { ?>
                        <option value="<?= $badge ?>"><?= get_string('badge_' . $badge, 'local_lonet') ?></option>
                    <?php } ?>
                </select>
            </td>
			<td>
				<button class="btn btn-success btn-save"><span class="fa fa-check"></span></button>
				<button class="btn btn-warning btn-cancel"><span class="fa fa-times"></span></button>
			</td>
		</tr>
		<?php
		foreach ($badge_report as $record) {
			$teacher = ($record->userid ? $DB->get_record('user', ['id' => $record->userid]) : null);
			?>
			<tr data-key=<?= $record->id ?>>
				<td>
					<select name="UserBadge[userid]" required>
						<option></option>						
						<?php foreach ($teacher_options as $teacher_option) { ?>
							<option value="<?= $teacher_option->id ?>" <?= ($teacher_option->id == $record->userid ? 'selected' : '') ?>><?= $teacher_option->email ?></option>
						<?php } ?>
					</select>
					<div class="value"><?= ($teacher ? $teacher->email : '-') ?></div>
				</td>
				<td>
					<input type="text" name="UserBadge[language]" value="<?= $record->language ?>">
					<div class="value"><?= ($record->language ? $record->language : '-') ?></div>
				</td>
				<td>
					<select name="UserBadge[badge]" required>
						<?php foreach (['new', 'bestprice', 'recommended', 'specialoffer', 'native'] as $badge) { ?>
							<option value="<?= $badge ?>" <?= ($record->badge == $badge ? 'selected' : '') ?>><?= get_string('badge_' . $badge, 'local_lonet') ?></option>
						<?php } ?>
					</select>
					<div class="value"><?= $record->badge ?></div>
				</td>
				<td>
					<button class="btn btn-success btn-edit"><span class="fa fa-pencil"></span></button>
					<button class="btn btn-success btn-save"><span class="fa fa-check"></span></button>
					<button class="btn btn-warning btn-cancel"><span class="fa fa-times"></span></button>
					<button class="btn btn-danger btn-delete"><span class="fa fa-trash"></span></button>
				</td>
			</tr>
		<?php } ?>
	</tbody>
</table>
