<?php
$THEME->name = 'lonet';
$THEME->doctype = 'html5';
$THEME->parents = array('bootstrapbase','clean');
$THEME->sheets = array('bootstrap.min','font-awesome.min','flags.min','multi-select','calendar','awesomplete.min','custom','short');
$THEME->supportscssoptimisation = false;
$THEME->yuicssmodules = array();
$THEME->enable_dock = false;
$THEME->editor_sheets = array();
$THEME->layouts = array(
	'admin' => array(
		'file' => 'admin.php',
		'regions' => array('side-pre'),
		'defaultregion' => 'side-pre',
		'options' => array('nonavbar'=>true),
	),
	'base' => array(
		'file' => 'base.php',
		'options' => array('dark'=>true),
	),
	'incourse' => array(
		//'file' => 'base.php',
		'file' => 'incourse.php',
		'regions' => array('side-pre'),
		'defaultregion' => 'side-pre',
		'options' => array('nonavbar'=>true, 'dark'=>true),
	),
	// The site home page.
	'frontpage' => array(
	'file' => 'frontpage.php',
	'regions' => array('side-pre','side-post'),
	'defaultregion' => 'side-pre',
	'options' => array('nonavbar'=>true, 'frontpage'=>true),
	),
	// Main course page.
	'course' => array(
	'file' => 'course.php',
	'regions' => array('side-pre','side-post'),
	'defaultregion' => 'side-pre',
	'options' => array('langmenu'=>true),
	),
	'list' => array(
		'file' => 'list.php',
		'options' => array('dark'=>true),
	),
	// User profile page.
	'mypublic' => array(
	'file' => 'mypublic.php',
	'options' => array('dark'=>true),
	),
	// Login page.
	'login' => array(
	'file' => 'login.php',
	'regions' => array(),
	'options' => array('langmenu'=>true),
	),
	'print' => [
		'file' => 'print.php'
	]
);
$THEME->rendererfactory = 'theme_overridden_renderer_factory';
$THEME->csspostprocess = 'theme_lonet_process_css';
$THEME->javascripts_footer = array('main','common');
$THEME->javascripts = array(/*'jquery-3.2.1.min',*/'jquery-1.11.3.min', 'jquery.fancybox.pack', 'bootstrap.min', 'sweetalert.min', 'jquery.multi-select', 'ouibounce.min', 'calendar.min', 'awesomplete.min', 'jquery.base64.min');