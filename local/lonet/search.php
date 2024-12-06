<?php
use local_lonet\category;
use local_lonet\language;
use local_lonet\teacher;

require_once('../../config.php');
require_once($CFG->dirroot.'/local/lonet/lib.php');
require_once($CFG->libdir.'/componentlib.class.php');

global $USER;

$title = get_string('searchresults');

$PAGE->set_context(context_system::instance());
$PAGE->set_pagelayout('base');
$PAGE->set_title($title);
$PAGE->set_heading($title);
$PAGE->set_url('/local/lonet/search.php');

$results = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['content']) && $content = $_POST['content']) {
    $content = trim($content);
    $search_phrase = strtolower($content);
	$attributes = [
        'content' => $content,
        'userid' => $USER->id,
        'createdat' => time(),
    ];
    $searches = $DB->get_records_sql("
        SELECT *
        FROM {lonet_search} ls
        WHERE LOWER(ls.content) = '$search_phrase'
            AND ls.createdat >= " . (time() - 43200) . "
    ");
    if ($searches) {
        $search_record = array_values($searches)[0];
        if ($search_record->resultscount > 0) {
            $results = json_decode($search_record->results);
        }
    } else {
        $records = $DB->get_records_sql("
            SELECT *
            FROM {lonet_language} ll
            WHERE code = '$search_phrase'
                OR LOWER(name) like '%$search_phrase%'
                OR LOWER(name_en) like '%$search_phrase%'
                OR LOWER(name_es) like '%$search_phrase%'
                OR LOWER(name_lv) like '%$search_phrase%'
                OR LOWER(name_ru) like '%$search_phrase%'
            ORDER BY name
        ");
        if ($records) {
            foreach ($records as $record) {
                if (teacher::get_by_language($record->code)) {
                    $results[] = (object) [
                        'name' => category::get_name($record->code) . ' ' . get_string('languageteachers', 'local_lonet'),
                        'url' => language::get_full_url($record),
                        'icon' => ($record->flag ? ' <span class="flag flag-' . $record->flag . '"></span>' : '')
                    ];
                }
            }
        }
    }
    $attributes['results'] = json_encode($results);
    $attributes['resultscount'] = count($results);
    $DB->insert_record('lonet_search', $attributes);
    
    echo json_encode(['url' => (isset($results[0]) ? $CFG->wwwroot . $results[0]->url : '')]);
    exit();
}

echo $OUTPUT->header();

if ($results) { ?>
	<h3><?= $title ?></h3>
	<br>
	<div class="container-fluid bg-grey">
		<?php foreach ($results as $result) { ?>
            <p><a href="<?= $result->url ?>" target="_blank"><?= $result->name . $result->icon ?></a></p>
		<?php } ?>
	</div>
    <br>
<?php } else {
    echo '<div class="alert alert-info">' . get_string('noresults') . '</div>';
}

echo $OUTPUT->footer();
