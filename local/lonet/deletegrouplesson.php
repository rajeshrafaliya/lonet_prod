<?php
require_once('../../config.php');
$gid = required_param('id', PARAM_INT);
$result = $DB->update_record('lonet_group_lessons', ['id' => $gid, 'isactive' => 0]);
// echo json_encode($result);
echo $result;
exit();