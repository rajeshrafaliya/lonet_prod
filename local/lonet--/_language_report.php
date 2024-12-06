<?php
use local_lonet\language;

defined('MOODLE_INTERNAL') || die();

global $CFG;
global $DB;

$where = '';
foreach (['code', 'name_en', /*'name_lv', 'name_ru', */'isactive'] as $attribute) {
	${$attribute} = (isset(${$attribute}) && ${$attribute} !== '' ? ${$attribute} : null);
    if (${$attribute} !== null) {
        $where .= ($where ? ' AND ' : 'WHERE ') . ($attribute == 'isactive' ? "$attribute = " . ${$attribute} : "LOWER($attribute) LIKE '%" . strtolower(${$attribute}) . "%'");
    }
}

$language_report = $DB->get_records_sql('SELECT * FROM {lonet_language} ' . $where . ' ORDER BY sortorder ASC, name_en ASC');
$language_report_group = $DB->get_records_sql('SELECT * FROM {lonet_language_group} ' . $where . ' ORDER BY sortorder ASC, name_en ASC');

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
</style>

<script>
	$(document).ready(function() {
        function submitForm(e) {
            window.location.href = '<?= $CFG->wwwroot ?>/local/lonet/admin.php?report=language&' + $('.thead input, .thead select').serialize();
        }
		$('thead input, thead select').change(submitForm);
        
        $(document).on('click', '.btn-edit', function(e) {
            $(this).parents('tr').addClass('editable');
        });
        $(document).on('click', '.btn-save', function(e) {
            var row = $(this).parents('tr');
            var id = row.attr('data-key');
            var tab = row.attr('data-tab');
			if(tab== 'group'){
				var data = 'action=save&' + row.find('input, select, textarea').serialize() + '&groupLanguage[id]=' + id;
			}else{
				var data = 'action=save&' + row.find('input, select, textarea').serialize() + '&Language[id]=' + id;
			}
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
        $(document).on('click', '.btn-cancel', function(e) {
            var row = $(this).parents('tr');
            row.removeClass('editable');
        });
	});
</script>
<?php
$activenormal = '';
$activegroup = '';

if($_GET['tab'] == 'group'){
	$activegroup = 'active';
}else{
	$activenormal = 'active';
}
?>
<ul class="nav nav-tabs">
	<li class="<?= $activenormal ?>"><a data-toggle="tab" href="#normal">Normal Lessons</a></li>
	<li class="<?= $activegroup ?>"><a data-toggle="tab" href="#group">Group Lessons</a></li>
</ul>
<div class="tab-content">
	<div id="normal" class="tab-pane fade in <?= $activenormal ?>">
		<table class="table table-striped table-bordered">
			<thead class="thead">
				<tr>
					<th style="max-width: 50px;">Code</th>
					<th>Name (English)</th>
					<th>Name (Español)</th>
					<th>Name (Latviešu)</th>
					<th>Name (Русский)</th>
					<th>URL (English)</th>
					<th>URL (Español)</th>
					<th>URL (Latviešu)</th>
					<th>URL (Русский)</th>
					<th>Active</th>
					<th></th>
				</tr>
				<tr class="editable">
					<input name="tab" type="hidden" value="normal">
					<th>
						<input name="code" type="text" value="<?= $code ?>" style="width: 75px;">
					</th>
					<th>
						<input name="name_en" type="text" value="<?= $name_en ?>">
					</th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th>
						<select name="isactive">
							<option></option>
							<?php foreach ([1 => 'Yes', 0 => 'No'] as $value => $label) { ?>
								<option value="<?= $value ?>" <?= ((string) $value === $isactive ? 'selected' : '') ?>><?= $label ?></option>
							<?php } ?>
						</select>
					</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($language_report as $record) { ?>
					<tr data-tab='normal' data-key=<?= $record->id ?>>
						<td><?= $record->code ?></td>
						<?php foreach ($language_options as $code => $name) { ?>
						<td>
							<input type="text" name="Language[name_<?= $code ?>]" value="<?= $record->{"name_$code"} ?>">
							<div class="value"><?= $record->{"name_$code"} ?></div>
						</td>                
						<?php } ?>
						<?php foreach ($language_options as $code => $name) { ?>
						<td>
							<input type="text" name="Language[url_<?= $code ?>]" value="<?= $record->{"url_$code"} ?>">
							<div class="value"><?= $record->{"url_$code"} ?></div>
						</td>              
						<?php } ?>
						<td>
							<input type="checkbox" name="Language[isactive]" value="1" <?= ($record->isactive ? 'checked' : '') ?>>
							<div class="value"><?= ($record->isactive ? get_string('yes') : get_string('no')) ?></div>
						</td>
						<td>
							<button class="btn btn-success btn-edit"><span class="fa fa-pencil"></span></button>
							<button class="btn btn-success btn-save"><span class="fa fa-check"></span></button>
							<button class="btn btn-warning btn-cancel"><span class="fa fa-times"></span></button>
						</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
</div>
<div id="group" class="tab-pane fade in <?= $activegroup ?>">
	<table class="table table-striped table-bordered">
		<thead class="thead">
			<tr>
				<th style="max-width: 50px;">Code</th>
				<th>Name (English)</th>
				<th>Name (Español)</th>
				<th>Name (Latviešu)</th>
				<th>Name (Русский)</th>
				<th>URL (English)</th>
				<th>URL (Español)</th>
				<th>URL (Latviešu)</th>
				<th>URL (Русский)</th>
				<th>Active</th>
				<th></th>
			</tr>
			<tr class="editable">
				<input name="tab" type="hidden" value="group">
				<th>
					<input name="code" type="text" value="" style="width: 75px;">
				</th>
				<th>
					<input name="name_en" type="text" value="<?= $name_en ?>">
				</th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th>
					<select name="isactive">
						<option></option>
						<?php foreach ([1 => 'Yes', 0 => 'No'] as $value => $label) { ?>
							<option value="<?= $value ?>" <?= ((string) $value === $isactive ? 'selected' : '') ?>><?= $label ?></option>
						<?php } ?>
					</select>
				</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($language_report_group as $record) { ?>
				<tr data-tab='group' data-key=<?= $record->id ?>>
					<td><?= $record->code ?></td>
					<?php foreach ($language_options as $code => $name) { ?>
					<td>
						<input type="text" name="groupLanguage[name_<?= $code ?>]" value="<?= $record->{"name_$code"} ?>">
						<div class="value"><?= $record->{"name_$code"} ?></div>
					</td>                
					<?php } ?>
					<?php foreach ($language_options as $code => $name) { ?>
					<td>
						<input type="text" name="groupLanguage[url_<?= $code ?>]" value="<?= $record->{"url_$code"} ?>">
						<div class="value"><?= $record->{"url_$code"} ?></div>
					</td>              
					<?php } ?>
					<td>
						<input type="checkbox" name="groupLanguage[isactive]" value="1" <?= ($record->isactive ? 'checked' : '') ?>>
						<div class="value"><?= ($record->isactive ? get_string('yes') : get_string('no')) ?></div>
					</td>
					<td>
						<button class="btn btn-success btn-edit"><span class="fa fa-pencil"></span></button>
						<button class="btn btn-success btn-save"><span class="fa fa-check"></span></button>
						<button class="btn btn-warning btn-cancel"><span class="fa fa-times"></span></button>
					</td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
</div>
</div>