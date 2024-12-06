<?php
use local_lonet\order;

require_once('../../config.php');
require_once($CFG->dirroot.'/local/lonet/lib.php');

$result = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['index'])) {
	order::remove_lesson($_POST['index']);
	$result = true;
}
echo json_encode($result);
exit();