<?php
require_once('config.php');

$title = 'Cookie Policy';

$PAGE->set_context(context_system::instance());
$PAGE->set_pagelayout('base');
$PAGE->set_title($title);
$PAGE->set_heading($title);
$PAGE->set_url('/cookie-policy.php');

echo $OUTPUT->header();
?>

<h2><?= $title ?></h2>
<!-- OneTrust Cookies Policy start -->
<div id="optanon-cookie-policy"></div>
<!-- OneTrust Cookies Policy end -->

<?= $OUTPUT->footer() ?>
