<?php
//use local_lonet\teacher;
use local_lonet\user;

defined('MOODLE_INTERNAL') || die();

global $CFG;
global $DB;

$testimonial_report = $DB->get_records_sql('SELECT * FROM {lonet_testimonial} ORDER BY createdat DESC');

$language_options = [
    'en' => 'English',
    'es' => 'Spanish',
    'lv' => 'Latvian',
    'ru' => 'Russian',
];
?>

<style>
	tr:not(.editable) input,
	tr:not(.editable) select,
	tr:not(.editable) textarea,
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
    textarea {
        min-width: 300px;
        width: 100%;
    }
</style>

<script>
	$(document).on('click', '.btn-save', function(e) {
		var row = $(this).parents('tr');
		var id = row.attr('data-key');
		var data = 'action=save&' + row.find('input, select, textarea').serialize() + '&Testimonial[id]=' + id;
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
				var data = 'action=save&Testimonial[isactive]=0&Testimonial[id]=' + id;
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
			<th><?= get_string('user') ?></th>
			<th>Text</th>
			<th>Language</th>
			<th>URL</th>
			<th>Visible</th>
			<th><?= get_string('createdat', 'local_lonet') ?></th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<tr class="row-add editable" data-key=0 style="display: none;">
			<td><input type="number" name="Testimonial[userid]" required min=0></td>
			<td><textarea name="Testimonial[abstract]" required rows=5></textarea></td>
			<td>
                <select name="Testimonial[language]" required>
                    <?php foreach ($language_options as $code => $name) { ?>
                        <option value="<?= $code ?>"><?= $name ?></option>
                    <?php } ?>
                </select>
            </td>
			<td><input type="text" name="Testimonial[url]"></td>
			<td><input type="checkbox" name="Testimonial[isactive]" value="1" checked></td>
			<td><input type="date" name="Testimonial[createdat]"></td>
			<td>
				<button class="btn btn-success btn-save"><span class="fa fa-check"></span></button>
				<button class="btn btn-warning btn-cancel"><span class="fa fa-times"></span></button>
			</td>
		</tr>
		<?php
		foreach ($testimonial_report as $record) {
			$user = ($record->userid ? $DB->get_record('user', ['id' => $record->userid]) : null);
			$createdat = ($record->createdat ? (new DateTime('now', core_date::get_user_timezone_object()))->setTimestamp($record->createdat)->format('Y-m-d') : null);
			?>
			<tr data-key=<?= $record->id ?>>
				<td>
					<input type="number" name="Testimonial[userid]" required  min=0 value="<?= $record->userid ?>">
					<div class="value"><?= user::getPublicDisplay($record->userid) ?></div>
				</td>
				<td>
					<textarea name="Testimonial[abstract]" required rows=5><?= $record->abstract ?></textarea>
					<div class="value"><?= $record->abstract ?></div>
				</td>
				<td>
                    <select name="Testimonial[language]" required>
                        <?php foreach ($language_options as $code => $name) { ?>
                            <option value="<?= $code ?>" <?= ($code == $record->language ? 'selected' : '') ?>><?= $name ?></option>
                        <?php } ?>
                    </select>
					<div class="value"><?= $language_options[$record->language] ?></div>
				</td>
				<td>
					<input type="text" name="Testimonial[url]" value="<?= $record->url ?>">
					<div class="value"><?= ($record->url ? '<a href="' . $record->url . '" target="_blank">' . $record->url . '</a>' : '-') ?></div>
				</td>
				<td>
					<input type="checkbox" name="Testimonial[isactive]" value="1" <?= ($record->isactive ? 'checked' : '') ?>>
					<div class="value"><?= ($record->isactive ? get_string('yes') : get_string('no')) ?></div>
				</td>
				<td>
					<input type="date" name="Testimonial[createdat]" value="<?= $createdat ?>">
					<div class="value"><?= ($createdat ? $createdat : '-') ?></div>
				</td>
				<td>
					<button class="btn btn-success btn-edit"><span class="fa fa-pencil"></span></button>
					<button class="btn btn-success btn-save"><span class="fa fa-check"></span></button>
					<button class="btn btn-warning btn-cancel"><span class="fa fa-times"></span></button>
					<?php if ($record->isactive) { ?>
                        <button class="btn btn-danger btn-delete"><span class="fa fa-eye-slash"></span></button>
                    <?php } ?>
				</td>
			</tr>
		<?php } ?>
	</tbody>
</table>
