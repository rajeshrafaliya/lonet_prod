<?php
require_once('../../config.php');
require_once($CFG->dirroot.'/local/lonet/lib.php');

$teacherid = (isset($_GET['teacherid']) ? $_GET['teacherid'] : null);
$week = (isset($_GET['week']) ? $_GET['week'] : 0);
$edit = (isset($_GET['edit']) ? $_GET['edit'] : 0);

echo renderFile('_schedule_profile.php', ['teacherid' => $teacherid, 'week' => $week, 'edit' => $edit]);
