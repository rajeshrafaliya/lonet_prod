<?php
defined('MOODLE_INTERNAL') || die;

if (is_siteadmin()) {
    $ADMIN->add('root', new admin_category('lonet', get_string('lonetadmin', 'local_lonet')));
	
    $settings = new admin_settingpage('local_lonet',  get_string('generalsettings', 'local_lonet'));
    $settings->add(new admin_setting_configtext(
		'local_lonet/commissionperlesson',
		 get_string('commissionperlesson', 'local_lonet'),
		 get_string('commissionperlesson_desc', 'local_lonet'),
		 3,
		 PARAM_INT
	));
    $settings->add(new admin_setting_configtext(
		'local_lonet/minpayoutamount',
		 get_string('minpayoutamount', 'local_lonet'),
		 get_string('minpayoutamount_desc', 'local_lonet'),
		 100,
		 PARAM_INT
	));
    $settings->add(new admin_setting_configtext(
		'local_lonet/videourl',
		 get_string('videourl', 'local_lonet'),
		 get_string('videourl_desc', 'local_lonet'),
		 ''
	));
    $settings->add(new admin_setting_configcheckbox(
		'local_lonet/showpopup',
		 get_string('showpopup', 'local_lonet'),
		 get_string('showpopup_desc', 'local_lonet'),
		 1
	));
	$ADMIN->add('lonet', $settings);
	
    $ADMIN->add('lonet', new admin_externalpage('teacherreport', get_string('teacherreport', 'local_lonet'), $CFG->wwwroot . '/local/lonet/admin.php?report=teacher'));
    $ADMIN->add('lonet', new admin_externalpage('orderreport', get_string('orderreport', 'local_lonet'), $CFG->wwwroot . '/local/lonet/admin.php?report=order'));
    $ADMIN->add('lonet', new admin_externalpage('cashreport', get_string('cashreport', 'local_lonet'), $CFG->wwwroot . '/local/lonet/admin.php?report=cash'));
    $ADMIN->add('lonet', new admin_externalpage('payoutreport', get_string('payoutreport', 'local_lonet'), $CFG->wwwroot . '/local/lonet/admin.php?report=payout'));
    $ADMIN->add('lonet', new admin_externalpage('promoreport', get_string('promoreport', 'local_lonet'), $CFG->wwwroot . '/local/lonet/admin.php?report=promo'));
    $ADMIN->add('lonet', new admin_externalpage('searchreport', get_string('searchreport', 'local_lonet'), $CFG->wwwroot . '/local/lonet/admin.php?report=search'));
    $ADMIN->add('lonet', new admin_externalpage('testimonialreport', get_string('testimonialreport', 'local_lonet'), $CFG->wwwroot . '/local/lonet/admin.php?report=testimonial'));
    $ADMIN->add('lonet', new admin_externalpage('subscriberreport', get_string('subscriberreport', 'local_lonet'), $CFG->wwwroot . '/local/lonet/admin.php?report=subscriber'));
    $ADMIN->add('lonet', new admin_externalpage('languagereport', get_string('languagereport', 'local_lonet'), $CFG->wwwroot . '/local/lonet/admin.php?report=language'));
	$ADMIN->add('lonet', new admin_externalpage('newsletter', get_string('sendnews', 'local_lonet'), $CFG->wwwroot . '/local/custom/sendnews.php'));
}
