<?php
use local_lonet\teacher;
use local_lonet\user;

defined('MOODLE_INTERNAL') || die();

global $DB;
global $USER;

$changed_new = count(teacher::get_changed('new'));
$changed_active = count(teacher::get_changed('active'));

$teachers_new = teacher::get_new();
$teachers_confirmed = teacher::get_active();
$teachers_inactive = teacher::get_inactive();
$thead_teacher = '<thead>
	<tr>
		<th>' . get_string('email') . '</th>
		<th>' . get_string('name') . '</th>
		<th>' . get_string('teaches', 'local_lonet') . '</th>
		<th>' . get_string('introduction', 'local_lonet') . '</th>
		<th>' . get_string('videourl', 'local_lonet') . '</th>
		<th style="min-width: 180px">Agreed to personal data usage for marketing</th>
		<th>' . get_string('createdat', 'local_lonet') . '</th>
		<th>' . get_string('updatedat', 'local_lonet') . '</th>
		<th></th>
	</tr>
</thead>';

$current_time = time();
?>

<script>
$(document).ready(function() {
    var config = {
        order: [[7, 'desc']],
    };
    $('#new table').DataTable(config);
    $('#active table').DataTable(config);
    $('#inactive table').DataTable(config);
});
</script>

<ul class="nav nav-tabs">
	<li class="active"><a data-toggle="tab" href="#new">New Teachers<?= ($changed_new ? ' <span class="badge badge-important">'.$changed_new.'</span>' : '') ?></a></li>
	<li><a data-toggle="tab" href="#active">Active Teachers<?= ($changed_active ? ' <span class="badge badge-important">'.$changed_active.'</span>' : '') ?></a></li>
	<li><a data-toggle="tab" href="#inactive">Inactive Teachers</a></li>
</ul>
<div class="tab-content">
	<div id="new" class="tab-pane fade in active">
		<table class="table table-striped table-bordered">
			<?= $thead_teacher ?>
			<tbody>
				<?php foreach ($teachers_new as $teacher) {
					profile_load_data($teacher);
					$fullname = fullname($teacher, true); ?>
					<tr>
						<td><?= $teacher->email ?></td>
						<td><?= $fullname ?></td>
						<td><?= user::get_languages_from_data($teacher->profile_field_languagesteaching) ?></td>
						<td><?= $teacher->profile_field_teacherintroduction ?></td>
						<td><?= ($teacher->profile_field_videourl ? '<a href="' . $teacher->profile_field_videourl .'" target="_blank" rel="noopener noreferrer">' . teacher::getVideoUrlLabel($teacher) . '</a>' : '') ?></td>
						<td><?= ($teacher->changedat ? '<strong style="color: indianred;">' . $teacher->profile_field_useinmarketing . '</strong>' : $teacher->profile_field_useinmarketing) ?></td>
						<td><?= date('Y-m-d H:i', $teacher->timecreated) ?></td>
						<td><?= date('Y-m-d H:i', $teacher->timemodified) ?></td>
						<td>
							<a href="/user/<?= $teacher->id ?>" class="btn btn-info" target="_blank" rel="noopener noreferrer"><span class="fa fa-user"></span></a>
							<a href="/user/editadvanced.php?id=<?= $teacher->id ?>" class="btn btn-warning" target="_blank" rel="noopener noreferrer"><span class="fa fa-pencil"></span></a>
							<form method="post">
								<input type="hidden" name="id" value="<?= $teacher->id ?>">
                                <?php if (!$teacher->isconfirmedteacher) { ?>
                                    <button type="submit" name="action" value="approve" class="btn btn-success" onClick="return confirm('Confirm Teacher\'s account for <?= $fullname ?>?');"><span class="fa fa-check"></span></button>
								<?php } ?>
                                <button type="submit" name="action" value="decline" class="btn btn-danger" onClick="return confirm('Decline Teacher\'s account for <?= $fullname ?>?');"><span class="fa fa-remove"></span></button>
							</form>
						</td>
					</tr>
                    <?php
                    if ($teacher->changedat && $USER->id == 3) {
                        $DB->update_record('lonet_user_history', ['id' => $teacher->changedat, 'seenat' => $current_time]);
                    }
                } ?>
			</tbody>
		</table>
	</div>
	<div id="active" class="tab-pane fade">
		<table class="table table-striped table-bordered">
			<?= $thead_teacher ?>
			<tbody>
				<?php foreach ($teachers_confirmed as $teacher) {
					profile_load_data($teacher);
					$fullname = fullname($teacher, true); ?>
					<tr>
						<td><?= $teacher->email ?></td>
						<td><?= $fullname ?></td>
						<td><?= user::get_languages_from_data($teacher->profile_field_languagesteaching) ?></td>
						<td><?= $teacher->profile_field_teacherintroduction ?></td>
						<td><?= ($teacher->profile_field_videourl ? '<a href="' . $teacher->profile_field_videourl .'" target="_blank" rel="noopener noreferrer">' . teacher::getVideoUrlLabel($teacher) . '</a>' : '') ?></td>
						<td><?= ($teacher->changedat ? '<strong style="color: indianred;">' . $teacher->profile_field_useinmarketing . '</strong>' : $teacher->profile_field_useinmarketing) ?></td>
						<td><?= date('Y-m-d H:i', $teacher->timecreated) ?></td>
						<td><?= date('Y-m-d H:i', $teacher->timemodified) ?></td>
						<td>
							<a href="/teacher/<?= $teacher->id ?>" class="btn btn-info" target="_blank" rel="noopener noreferrer"><span class="fa fa-user"></span></a>
                            <a href="/user/editadvanced.php?id=<?= $teacher->id ?>" class="btn btn-warning" target="_blank" rel="noopener noreferrer"><span class="fa fa-pencil"></span></a>
							<form method="post">
								<input type="hidden" name="id" value="<?= $teacher->id ?>">
								<button type="submit" name="action" value="cancel" class="btn btn-danger" onClick="return confirm('Cancel Teacher\'s account for <?= $fullname ?>?');"><span class="fa fa-remove"></span></button>
							</form>
						</td>
					</tr>
                    <?php
                    if ($teacher->changedat && $USER->id == 3) {
                        $DB->update_record('lonet_user_history', ['id' => $teacher->changedat, 'seenat' => $current_time]);
                    }
                } ?>
			</tbody>
		</table>
	</div>
	<div id="inactive" class="tab-pane fade">
		<table class="table table-striped table-bordered">
			<?= $thead_teacher ?>
			<tbody>
				<?php foreach ($teachers_inactive as $teacher) {
					profile_load_data($teacher);
					$fullname = fullname($teacher, true); ?>
					<tr>
						<td><?= $teacher->email ?></td>
						<td><?= $fullname ?></td>
						<td><?= user::get_languages_from_data($teacher->profile_field_languagesteaching) ?></td>
						<td><?= $teacher->profile_field_teacherintroduction ?></td>
						<td><?= ($teacher->profile_field_videourl ? '<a href="' . $teacher->profile_field_videourl .'" target="_blank" rel="noopener noreferrer">' . teacher::getVideoUrlLabel($teacher) . '</a>' : '') ?></td>
						<td><?= ($teacher->changedat ? '<strong style="color: indianred;">' . $teacher->profile_field_useinmarketing . '</strong>' : $teacher->profile_field_useinmarketing) ?></td>
						<td><?= date('Y-m-d H:i', $teacher->timecreated) ?></td>
						<td><?= date('Y-m-d H:i', $teacher->timemodified) ?></td>
						<td>
							<a href="/teacher/<?= $teacher->id ?>" class="btn btn-info" target="_blank" rel="noopener noreferrer"><span class="fa fa-user"></span></a>
                            <a href="/user/editadvanced.php?id=<?= $teacher->id ?>" class="btn btn-warning" target="_blank" rel="noopener noreferrer"><span class="fa fa-pencil"></span></a>
							<form method="post">
								<input type="hidden" name="id" value="<?= $teacher->id ?>">
								<button type="submit" name="action" value="activate" class="btn btn-success" onClick="return confirm('Re-activate Teacher\'s account for <?= $fullname ?>?');"><span class="fa fa-check"></span></button>
							</form>
						</td>
					</tr>
                    <?php
                    if ($teacher->changedat && $USER->id == 3) {
                        $DB->update_record('lonet_user_history', ['id' => $teacher->changedat, 'seenat' => $current_time]);
                    }
                } ?>
			</tbody>
		</table>
	</div>
</div>