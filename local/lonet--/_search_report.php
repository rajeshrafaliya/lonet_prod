<?php
defined('MOODLE_INTERNAL') || die();

global $CFG;
global $DB;

$search_report = $DB->get_records('lonet_search', [], 'createdat DESC');
?>

<table class="table table-striped table-bordered">
	<thead class="thead">
		<tr>
			<th>ID</th>
			<th><?= get_string('search') ?></th>
			<th>Result Count</th>
			<th>Results</th>
			<th><?= get_string('user') ?></th>
			<th>Created At</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($search_report as $search) {				
			$user = ($search->userid ? $DB->get_record('user', ['id' => $search->userid]) : null); ?>
			<tr>
				<td><?= $search->id ?></td>
				<td><?= $search->content ?></td>
				<td><?= $search->resultscount ?></td>
				<td>
                    <?php if ($results = json_decode($search->results)) {
                        foreach ($results as $result) { ?>
                            <p><a href="<?= $result->url ?>" target="_blank"><?= $result->name . $result->icon ?></a></p>
                        <?php }
                    } ?>
                </td>
				<td><?= ($user ? '<a href="/user/' . $user->id . '" target="_blank" rel="noopener noreferrer">' . $user->email . '</a>' : '-') ?></td>
				<td><?= (new DateTime('now', core_date::get_user_timezone_object()))->setTimestamp($search->createdat)->format('d.m.Y H:i') ?></td>
			</tr>
		<?php } ?>
	</tbody>
</table>
