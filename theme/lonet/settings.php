<?php

$settings = null;
defined('MOODLE_INTERNAL') || die;
$ADMIN->add('themes', new admin_category('theme_lonet', 'Lonet'));

// General setting page.
$temp = new admin_settingpage('theme_lonet_general',  get_string('generalsettings', 'theme_lonet'));

    // favicon.
    $name = 'theme_lonet/favicon';
    $title = get_string('favicon', 'theme_lonet');
    $description = get_string('favicondesc', 'theme_lonet');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'favicon');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Show site name along with small logo.
    $name = 'theme_lonet/sitename';
    $title = get_string('sitename', 'theme_lonet');
    $description = get_string('sitenamedesc', 'theme_lonet');
    $setting = new admin_setting_configcheckbox($name, $title, $description, 1);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // timing.
    $name = 'theme_lonet/timing';
    $title = get_string('timing', 'theme_lonet');
    $description = get_string('timingdesc', 'theme_lonet');
    $default = 'Monday - Friday : 10:00-17:00';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

     // email.
    $name = 'theme_lonet/email';
    $title = get_string('email', 'theme_lonet');
    $description = get_string('emaildesc', 'theme_lonet');
    $default = 'info@lonet.edu';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // Facebook url setting.
    $name = 'theme_lonet/facebook';
    $title = get_string('facebook', 'theme_lonet');
    $description = get_string('facebookdesc', 'theme_lonet');
    $default = 'http://www.facebook.com/mycollege';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // twitter url setting.
    $name = 'theme_lonet/twitter';
    $title = get_string('twitter', 'theme_lonet');
    $description = get_string('twitterdesc', 'theme_lonet');
    $default = 'http://www.twitter.com/mycollege';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    // googleplus url setting.
    $name = 'theme_lonet/googleplus';
    $title = get_string('googleplus', 'theme_lonet');
    $description = get_string('googleplusdesc', 'theme_lonet');
    $default = 'http://www.googleplus.com/mycollege';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // loginbackground file setting.
    $name = 'theme_lonet/loginbackground';
    $title = get_string('loginbackground','theme_lonet');
    $description = get_string('loginbackgrounddesc', 'theme_lonet');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'loginbackground');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // innerbanner file setting.
    $name = 'theme_lonet/innerbanner';
    $title = get_string('innerbanner','theme_lonet');
    $description = get_string('innerbannerdesc', 'theme_lonet');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'innerbanner');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // innerbannerheading.
    $name = 'theme_lonet/innerbannerheading';
    $title = get_string('innerbannerheading', 'theme_lonet');
    $description = get_string('innerbannerheadingdesc', 'theme_lonet');
    $default = 'Lonet - Education Moodle Theme';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // innerbannertagline.
    $name = 'theme_lonet/innerbannertagline';
    $title = get_string('innerbannertagline', 'theme_lonet');
    $description = get_string('innerbannertaglinedesc', 'theme_lonet');
    $default = 'ONE HOME PAGE+UNLIMITED COLOR VARIATION+AWESOME LAYERS PAGE BUILDER+EASY TO CUSTOMIZE+FULLY RESPONSIVE
    ';
    $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // announcementsbg file setting.
    $name = 'theme_lonet/announcementsbg';
    $title = get_string('announcementsbg','theme_lonet');
    $description = get_string('announcementsbgdesc', 'theme_lonet');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'announcementsbg');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // sitebluecolor.
    $name = 'theme_lonet/sitebluecolor';
    $title = get_string('sitebluecolor', 'theme_lonet');
    $description = get_string('sitebluecolordesc', 'theme_lonet');
    $default = '#002b46';
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default);
    $temp->add($setting);

    // sitegreencolor.
    $name = 'theme_lonet/sitegreencolor';
    $title = get_string('sitegreencolor', 'theme_lonet');
    $description = get_string('sitegreencolordesc', 'theme_lonet');
    $default = '#499306';
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default);
    $temp->add($setting);

    // salmoncolor.
    $name = 'theme_lonet/salmoncolor';
    $title = get_string('salmoncolor', 'theme_lonet');
    $description = get_string('salmoncolordesc', 'theme_lonet');
    $default = '#fc6d65';
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default);
    $temp->add($setting);

    // orangecolor.
    $name = 'theme_lonet/orangecolor';
    $title = get_string('orangecolor', 'theme_lonet');
    $description = get_string('orangecolordesc', 'theme_lonet');
    $default = '#ff9800';
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default);
    $temp->add($setting);

    // cyancolor.
    $name = 'theme_lonet/cyancolor';
    $title = get_string('cyancolor', 'theme_lonet');
    $description = get_string('cyancolordesc', 'theme_lonet');
    $default = '#009688';
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default);
    $temp->add($setting);

    // skybluecolor.
    $name = 'theme_lonet/skybluecolor';
    $title = get_string('skybluecolor', 'theme_lonet');
    $description = get_string('skybluecolordesc', 'theme_lonet');
    $default = '#01c0d1';
    $setting = new admin_setting_configcolourpicker($name, $title, $description, $default);
    $temp->add($setting);

 $ADMIN->add('theme_lonet', $temp);

/* Featured Courses Settings */
	$temp = new admin_settingpage('theme_lonet_featuredcourses', get_string('featuredcourses', 'theme_lonet'));
	

    $name = 'theme_lonet/displayfeaturedcourse';
    $title = get_string('displayfeaturedcourse','theme_lonet');
    $description = get_string('displayfeaturedcoursedesc', 'theme_lonet');
    $default = 1;
    $choices = array(0=>'No', 1=>'Yes');
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $temp->add($setting);

    
    /**  course 1 **/
     
    $name = 'theme_lonet/course1ShowHide';
    $title = get_string('course1ShowHide','theme_lonet');
    $description = get_string('courseShowHidedesc', 'theme_lonet');
    $default = 1;
    $choices = array(0=>'No', 1=>'Yes');
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $temp->add($setting);
    

    $name = 'theme_lonet/course1title';
    $title = get_string('course1title', 'theme_lonet');
    $description = get_string('course1titledesc', 'theme_lonet');
    $default = 'Application software';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Image.
    $name = 'theme_lonet/course1image';
    $title = get_string('course1image', 'theme_lonet');
    $description = get_string('course1imagedesc', 'theme_lonet');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'course1image');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Caption.
    $name = 'theme_lonet/course1caption';
    $title = get_string('course1caption', 'theme_lonet');
    $description = get_string('course1captiondesc', 'theme_lonet');
    $default = 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

// course1buttontext.
    $name = 'theme_lonet/course1buttontext';
    $title = get_string('course1buttontext', 'theme_lonet');
    $description = get_string('course1buttontextdesc', 'theme_lonet');
    $default = 'Read More';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    $name = 'theme_lonet/course1url';
    $title = get_string('course1url', 'theme_lonet');
    $description = get_string('course1urldesc', 'theme_lonet');
    $default = '#';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    /**  course 2 **/

    $name = 'theme_lonet/course2ShowHide';
    $title = get_string('course2ShowHide','theme_lonet');
    $description = get_string('courseShowHidedesc', 'theme_lonet');
    $default = 1;
    $choices = array(0=>'No', 1=>'Yes');
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $temp->add($setting);
    

    $name = 'theme_lonet/course2title';
    $title = get_string('course2title', 'theme_lonet');
    $description = get_string('course2titledesc', 'theme_lonet');
    $default = 'System management';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Image.
    $name = 'theme_lonet/course2image';
    $title = get_string('course2image', 'theme_lonet');
    $description = get_string('course2imagedesc', 'theme_lonet');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'course2image');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Caption.
    $name = 'theme_lonet/course2caption';
    $title = get_string('course2caption', 'theme_lonet');
    $description = get_string('course2captiondesc', 'theme_lonet');
    $default = 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

// course2buttontext.
    $name = 'theme_lonet/course2buttontext';
    $title = get_string('course2buttontext', 'theme_lonet');
    $description = get_string('course2buttontextdesc', 'theme_lonet');
    $default = 'Read More';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    $name = 'theme_lonet/course2url';
    $title = get_string('course2url', 'theme_lonet');
    $description = get_string('course2urldesc', 'theme_lonet');
    $default = '#';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    /*
     *  course 3
     */

    $name = 'theme_lonet/course3ShowHide';
    $title = get_string('course3ShowHide','theme_lonet');
    $description = get_string('courseShowHidedesc', 'theme_lonet');
    $default = 1;
    $choices = array(0=>'No', 1=>'Yes');
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $temp->add($setting);
    

    $name = 'theme_lonet/course3title';
    $title = get_string('course3title', 'theme_lonet');
    $description = get_string('course3titledesc', 'theme_lonet');
    $default = 'Networking';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);


    // Image.
    $name = 'theme_lonet/course3image';
    $title = get_string('course3image', 'theme_lonet');
    $description = get_string('course3imagedesc', 'theme_lonet');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'course3image');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Caption.
    $name = 'theme_lonet/course3caption';
    $title = get_string('course3caption', 'theme_lonet');
    $description = get_string('course3captiondesc', 'theme_lonet');
    $default = 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

// course3buttontext.
    $name = 'theme_lonet/course3buttontext';
    $title = get_string('course3buttontext', 'theme_lonet');
    $description = get_string('course3buttontextdesc', 'theme_lonet');
    $default = 'Read More';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    $name = 'theme_lonet/course3url';
    $title = get_string('course3url', 'theme_lonet');
    $description = get_string('course3urldesc', 'theme_lonet');
    $default = '#';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    /*
     * course 4
     */

    $name = 'theme_lonet/course4ShowHide';
    $title = get_string('course4ShowHide','theme_lonet');
    $description = get_string('courseShowHidedesc', 'theme_lonet');
    $default = 1;
    $choices = array(0=>'No', 1=>'Yes');
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $temp->add($setting);
    

    $name = 'theme_lonet/course4title';
    $title = get_string('course4title', 'theme_lonet');
    $description = get_string('course4titledesc', 'theme_lonet');
    $default = 'Management information system';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    
    // Image.
    $name = 'theme_lonet/course4image';
    $title = get_string('course4image', 'theme_lonet');
    $description = get_string('course4imagedesc', 'theme_lonet');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'course4image');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);


    // Caption.
    $name = 'theme_lonet/course4caption';
    $title = get_string('course4caption', 'theme_lonet');
    $description = get_string('course4captiondesc', 'theme_lonet');
    $default = 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

// course4buttontext.
    $name = 'theme_lonet/course4buttontext';
    $title = get_string('course4buttontext', 'theme_lonet');
    $description = get_string('course4buttontextdesc', 'theme_lonet');
    $default = 'Read More';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    
    $name = 'theme_lonet/course4url';
    $title = get_string('course4url', 'theme_lonet');
    $description = get_string('course4urldesc', 'theme_lonet');
    $default = '#';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    /*
     * course 5
     */

    $name = 'theme_lonet/course5ShowHide';
    $title = get_string('course5ShowHide','theme_lonet');
    $description = get_string('courseShowHidedesc', 'theme_lonet');
    $default = 1;
    $choices = array(0=>'No', 1=>'Yes');
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $temp->add($setting);
    

    $name = 'theme_lonet/course5title';
    $title = get_string('course5title', 'theme_lonet');
    $description = get_string('course5titledesc', 'theme_lonet');
    $default = 'Troubleshooting';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    
    // Image.
    $name = 'theme_lonet/course5image';
    $title = get_string('course5image', 'theme_lonet');
    $description = get_string('course5imagedesc', 'theme_lonet');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'course5image');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);


    // Caption.
    $name = 'theme_lonet/course5caption';
    $title = get_string('course5caption', 'theme_lonet');
    $description = get_string('course5captiondesc', 'theme_lonet');
    $default = 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

// course5buttontext.
    $name = 'theme_lonet/course5buttontext';
    $title = get_string('course5buttontext', 'theme_lonet');
    $description = get_string('course5buttontextdesc', 'theme_lonet');
    $default = 'Read More';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    
    $name = 'theme_lonet/course5url';
    $title = get_string('course5url', 'theme_lonet');
    $description = get_string('course5urldesc', 'theme_lonet');
    $default = '#';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
 

    /*
     * course 6
     */

    $name = 'theme_lonet/course6ShowHide';
    $title = get_string('course6ShowHide','theme_lonet');
    $description = get_string('courseShowHidedesc', 'theme_lonet');
    $default = 1;
    $choices = array(0=>'No', 1=>'Yes');
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $temp->add($setting);
    

    $name = 'theme_lonet/course6title';
    $title = get_string('course6title', 'theme_lonet');
    $description = get_string('course6titledesc', 'theme_lonet');
    $default = 'Software development';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    
    // Image.
    $name = 'theme_lonet/course6image';
    $title = get_string('course6image', 'theme_lonet');
    $description = get_string('course6imagedesc', 'theme_lonet');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'course6image');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Caption.
    $name = 'theme_lonet/course6caption';
    $title = get_string('course6caption', 'theme_lonet');
    $description = get_string('course6captiondesc', 'theme_lonet');
    $default = 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
// course6buttontext.
    $name = 'theme_lonet/course6buttontext';
    $title = get_string('course6buttontext', 'theme_lonet');
    $description = get_string('course6buttontextdesc', 'theme_lonet');
    $default = 'Read More';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    $name = 'theme_lonet/course6url';
    $title = get_string('course6url', 'theme_lonet');
    $description = get_string('course6urldesc', 'theme_lonet');
    $default = '#';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    /*
     * course 7
     */

    $name = 'theme_lonet/course7ShowHide';
    $title = get_string('course7ShowHide','theme_lonet');
    $description = get_string('courseShowHidedesc', 'theme_lonet');
    $default = 1;
    $choices = array(0=>'No', 1=>'Yes');
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $temp->add($setting);
    

    $name = 'theme_lonet/course7title';
    $title = get_string('course7title', 'theme_lonet');
    $description = get_string('course7titledesc', 'theme_lonet');
    $default = 'Web designing';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    
    // Image.
    $name = 'theme_lonet/course7image';
    $title = get_string('course7image', 'theme_lonet');
    $description = get_string('course7imagedesc', 'theme_lonet');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'course7image');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    
    // Caption.
    $name = 'theme_lonet/course7caption';
    $title = get_string('course7caption', 'theme_lonet');
    $description = get_string('course7captiondesc', 'theme_lonet');
    $default = 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

// course7buttontext.
    $name = 'theme_lonet/course7buttontext';
    $title = get_string('course7buttontext', 'theme_lonet');
    $description = get_string('course7buttontextdesc', 'theme_lonet');
    $default = 'Read More';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    
    $name = 'theme_lonet/course7url';
    $title = get_string('course7url', 'theme_lonet');
    $description = get_string('course7urldesc', 'theme_lonet');
    $default = '#';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);


    /*
     * course 8
     */

    $name = 'theme_lonet/course8ShowHide';
    $title = get_string('course8ShowHide','theme_lonet');
    $description = get_string('courseShowHidedesc', 'theme_lonet');
    $default = 1;
    $choices = array(0=>'No', 1=>'Yes');
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $temp->add($setting);
    

    $name = 'theme_lonet/course8title';
    $title = get_string('course8title', 'theme_lonet');
    $description = get_string('course8titledesc', 'theme_lonet');
    $default = 'System engineering';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    
    // Image.
    $name = 'theme_lonet/course8image';
    $title = get_string('course8image', 'theme_lonet');
    $description = get_string('course8imagedesc', 'theme_lonet');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'course8image');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);


    // Caption.
    $name = 'theme_lonet/course8caption';
    $title = get_string('course8caption', 'theme_lonet');
    $description = get_string('course8captiondesc', 'theme_lonet');
    $default = 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

// course8buttontext.
    $name = 'theme_lonet/course8buttontext';
    $title = get_string('course8buttontext', 'theme_lonet');
    $description = get_string('course8buttontextdesc', 'theme_lonet');
    $default = 'Read More';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    
    $name = 'theme_lonet/course8url';
    $title = get_string('course8url', 'theme_lonet');
    $description = get_string('course8urldesc', 'theme_lonet');
    $default = '#';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);


    /*
     * course 9
     */

    $name = 'theme_lonet/course9ShowHide';
    $title = get_string('course9ShowHide','theme_lonet');
    $description = get_string('courseShowHidedesc', 'theme_lonet');
    $default = 1;
    $choices = array(0=>'No', 1=>'Yes');
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $temp->add($setting);
    

    $name = 'theme_lonet/course9title';
    $title = get_string('course9title', 'theme_lonet');
    $description = get_string('course9titledesc', 'theme_lonet');
    $default = 'Multimedia system';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    
     // Image.
    $name = 'theme_lonet/course9image';
    $title = get_string('course9image', 'theme_lonet');
    $description = get_string('course9imagedesc', 'theme_lonet');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'course9image');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);


    // Caption.
    $name = 'theme_lonet/course9caption';
    $title = get_string('course9caption', 'theme_lonet');
    $description = get_string('course9captiondesc', 'theme_lonet');
    $default = 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

// course9buttontext.
    $name = 'theme_lonet/course9buttontext';
    $title = get_string('course9buttontext', 'theme_lonet');
    $description = get_string('course9buttontextdesc', 'theme_lonet');
    $default = 'Read More';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    
    $name = 'theme_lonet/course9url';
    $title = get_string('course9url', 'theme_lonet');
    $description = get_string('course9urldesc', 'theme_lonet');
    $default = '#';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);


    /*
     * course 10
     */

    $name = 'theme_lonet/course10ShowHide';
    $title = get_string('course10ShowHide','theme_lonet');
    $description = get_string('courseShowHidedesc', 'theme_lonet');
    $default = 1;
    $choices = array(0=>'No', 1=>'Yes');
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $temp->add($setting);
    

    $name = 'theme_lonet/course10title';
    $title = get_string('course10title', 'theme_lonet');
    $description = get_string('course10titledesc', 'theme_lonet');
    $default = 'Web technology';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    
    // Image.
    $name = 'theme_lonet/course10image';
    $title = get_string('course10image', 'theme_lonet');
    $description = get_string('course10imagedesc', 'theme_lonet');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'course10image');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Caption.
    $name = 'theme_lonet/course10caption';
    $title = get_string('course10caption', 'theme_lonet');
    $description = get_string('course10captiondesc', 'theme_lonet');
    $default = 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
// course10buttontext.
    $name = 'theme_lonet/course10buttontext';
    $title = get_string('course10buttontext', 'theme_lonet');
    $description = get_string('course10buttontextdesc', 'theme_lonet');
    $default = 'Read More';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    $name = 'theme_lonet/course10url';
    $title = get_string('course10url', 'theme_lonet');
    $description = get_string('course10urldesc', 'theme_lonet');
    $default = '#';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    /** course 11 **/

    $name = 'theme_lonet/course11ShowHide';
    $title = get_string('course11ShowHide','theme_lonet');
    $description = get_string('courseShowHidedesc', 'theme_lonet');
    $default = 1;
    $choices = array(0=>'No', 1=>'Yes');
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $temp->add($setting);
    

    $name = 'theme_lonet/course11title';
    $title = get_string('course11title', 'theme_lonet');
    $description = get_string('course11titledesc', 'theme_lonet');
    $default = 'Computer graphics';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    
    // Image.
    $name = 'theme_lonet/course11image';
    $title = get_string('course11image', 'theme_lonet');
    $description = get_string('course11imagedesc', 'theme_lonet');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'course11image');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);


    // Caption.
    $name = 'theme_lonet/course11caption';
    $title = get_string('course11caption', 'theme_lonet');
    $description = get_string('course11captiondesc', 'theme_lonet');
    $default = 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

// course11buttontext.
    $name = 'theme_lonet/course11buttontext';
    $title = get_string('course11buttontext', 'theme_lonet');
    $description = get_string('course11buttontextdesc', 'theme_lonet');
    $default = 'Read More';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    
    $name = 'theme_lonet/course11url';
    $title = get_string('course11url', 'theme_lonet');
    $description = get_string('course11urldesc', 'theme_lonet');
    $default = '#';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    /*
     * course 12
     */

    $name = 'theme_lonet/course12ShowHide';
    $title = get_string('course12ShowHide','theme_lonet');
    $description = get_string('courseShowHidedesc', 'theme_lonet');
    $default = 1;
    $choices = array(0=>'No', 1=>'Yes');
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $temp->add($setting);
    

    $name = 'theme_lonet/course12title';
    $title = get_string('course12title', 'theme_lonet');
    $description = get_string('course12titledesc', 'theme_lonet');
    $default = 'Mobile computing';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    
    // Image.
    $name = 'theme_lonet/course12image';
    $title = get_string('course12image', 'theme_lonet');
    $description = get_string('course12imagedesc', 'theme_lonet');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'course12image');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);


    // Caption.
    $name = 'theme_lonet/course12caption';
    $title = get_string('course12caption', 'theme_lonet');
    $description = get_string('course12captiondesc', 'theme_lonet');
    $default = 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

// course12buttontext.
    $name = 'theme_lonet/course12buttontext';
    $title = get_string('course12buttontext', 'theme_lonet');
    $description = get_string('course12buttontextdesc', 'theme_lonet');
    $default = 'Read More';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
    
    
    $name = 'theme_lonet/course12url';
    $title = get_string('course12url', 'theme_lonet');
    $description = get_string('course12urldesc', 'theme_lonet');
    $default = '#';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);


$ADMIN->add('theme_lonet', $temp);


/* Front Page Settings */
	$temp = new admin_settingpage('theme_lonet_frontpage', get_string('frontpagesettings', 'theme_lonet'));

    // banner1image file setting.
    $name = 'theme_lonet/banner1image';
    $title = get_string('banner1image','theme_lonet');
    $description = get_string('banner1imagedesc', 'theme_lonet');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'banner1image');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // banner1heading.
    $name = 'theme_lonet/banner1heading';
    $title = get_string('banner1heading', 'theme_lonet');
    $description = get_string('banner1headingdesc', 'theme_lonet');
    $default = 'Better Education For a Better World';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    $ADMIN->add('theme_lonet', $temp);

    
// Services Box.

$temp = new admin_settingpage('theme_lonet_servicesbox',  get_string('servicesboxsettings', 'theme_lonet'));


    $name = 'theme_lonet/displayservicesbox';
    $title = get_string('displayservicesbox','theme_lonet');
    $description = get_string('displayservicesboxdesc', 'theme_lonet');
    $default = 1;
    $choices = array(0=>'No', 1=>'Yes');
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $temp->add($setting);

    // servicesboximage file setting.
    $name = 'theme_lonet/servicesboximage';
    $title = get_string('servicesboximage','theme_lonet');
    $description = get_string('servicesboximagedesc', 'theme_lonet');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'servicesboximage');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // servicesheading.
    $name = 'theme_lonet/servicesheading';
    $title = get_string('servicesheading', 'theme_lonet');
    $description = get_string('servicesheadingdesc', 'theme_lonet');
    $default = 'OUR SERVICES';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // servicestagline.
    $name = 'theme_lonet/servicestagline';
    $title = get_string('servicestagline', 'theme_lonet');
    $description = get_string('servicestaglinedesc', 'theme_lonet');
    $default = 'Our services & offers';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // servicesbox1icon.
    $name = 'theme_lonet/servicesbox1icon';
    $title = get_string('servicesbox1icon', 'theme_lonet');
    $description = get_string('servicesbox1icondesc', 'theme_lonet');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'servicesbox1icon');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // servicesbox1heading.
    $name = 'theme_lonet/servicesbox1heading';
    $title = get_string('servicesbox1heading', 'theme_lonet');
    $description = get_string('servicesbox1headingdesc', 'theme_lonet');
    $default = 'Online & Offline courses';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // servicesbox1content.
    $name = 'theme_lonet/servicesbox1content';
    $title = get_string('servicesbox1content', 'theme_lonet');
    $description = get_string('servicesbox1contentdesc', 'theme_lonet');
    $default = 'There are many variations of passages of Lorem Ipsum available.';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // servicesbox1url.
    $name = 'theme_lonet/servicesbox1url';
    $title = get_string('servicesbox1url', 'theme_lonet');
    $description = get_string('servicesbox1urldesc', 'theme_lonet');
    $default = '#';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);


    // servicesbox2icon.
    $name = 'theme_lonet/servicesbox2icon';
    $title = get_string('servicesbox2icon', 'theme_lonet');
    $description = get_string('servicesbox2icondesc', 'theme_lonet');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'servicesbox2icon');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // servicesbox2heading.
    $name = 'theme_lonet/servicesbox2heading';
    $title = get_string('servicesbox2heading', 'theme_lonet');
    $description = get_string('servicesbox2headingdesc', 'theme_lonet');
    $default = 'Notification & Emails';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // servicesbox2content.
    $name = 'theme_lonet/servicesbox2content';
    $title = get_string('servicesbox2content', 'theme_lonet');
    $description = get_string('servicesbox2contentdesc', 'theme_lonet');
    $default = 'There are many variations of passages of Lorem Ipsum available.';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // servicesbox2url.
    $name = 'theme_lonet/servicesbox2url';
    $title = get_string('servicesbox2url', 'theme_lonet');
    $description = get_string('servicesbox2urldesc', 'theme_lonet');
    $default = '#';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);



    // servicesbox3icon.
    $name = 'theme_lonet/servicesbox3icon';
    $title = get_string('servicesbox3icon', 'theme_lonet');
    $description = get_string('servicesbox3icondesc', 'theme_lonet');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'servicesbox3icon');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // servicesbox3heading.
    $name = 'theme_lonet/servicesbox3heading';
    $title = get_string('servicesbox3heading', 'theme_lonet');
    $description = get_string('servicesbox3headingdesc', 'theme_lonet');
    $default = 'Advanced Statistics';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // servicesbox3content.
    $name = 'theme_lonet/servicesbox3content';
    $title = get_string('servicesbox3content', 'theme_lonet');
    $description = get_string('servicesbox3contentdesc', 'theme_lonet');
    $default = 'There are many variations of passages of Lorem Ipsum available.';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // servicesbox3url.
    $name = 'theme_lonet/servicesbox3url';
    $title = get_string('servicesbox3url', 'theme_lonet');
    $description = get_string('servicesbox3urldesc', 'theme_lonet');
    $default = '#';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);


    // servicesbox4icon.
    $name = 'theme_lonet/servicesbox4icon';
    $title = get_string('servicesbox4icon', 'theme_lonet');
    $description = get_string('servicesbox4icondesc', 'theme_lonet');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'servicesbox4icon');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // servicesbox4heading.
    $name = 'theme_lonet/servicesbox4heading';
    $title = get_string('servicesbox4heading', 'theme_lonet');
    $description = get_string('servicesbox4headingdesc', 'theme_lonet');
    $default = 'Social LMS';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // servicesbox4content.
    $name = 'theme_lonet/servicesbox4content';
    $title = get_string('servicesbox4content', 'theme_lonet');
    $description = get_string('servicesbox4contentdesc', 'theme_lonet');
    $default = 'There are many variations of passages of Lorem Ipsum available.';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // servicesbox4url.
    $name = 'theme_lonet/servicesbox4url';
    $title = get_string('servicesbox4url', 'theme_lonet');
    $description = get_string('servicesbox4urldesc', 'theme_lonet');
    $default = '#';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
                                     
    $ADMIN->add('theme_lonet', $temp);

// Aboutus setting page.
$temp = new admin_settingpage('theme_lonet_aboutus',  get_string('aboutussettings', 'theme_lonet'));
 
    $name = 'theme_lonet/displayaboutus';
    $title = get_string('displayaboutus','theme_lonet');
    $description = get_string('displayaboutusdesc', 'theme_lonet');
    $default = 1;
    $choices = array(0=>'No', 1=>'Yes');
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $temp->add($setting);

    // aboutusheading.
    $name = 'theme_lonet/aboutusheading';
    $title = get_string('aboutusheading', 'theme_lonet');
    $description = get_string('aboutusheadingdesc', 'theme_lonet');
    $default = 'To Know About Us';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // aboutustagline.
    $name = 'theme_lonet/aboutustagline';
    $title = get_string('aboutustagline', 'theme_lonet');
    $description = get_string('aboutustaglinedesc', 'theme_lonet');
    $default = 'Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // aboutus1url.
    $name = 'theme_lonet/aboutus1url';
    $title = get_string('aboutus1url', 'theme_lonet');
    $description = get_string('aboutus1urldesc', 'theme_lonet');
    $default = '#';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // aboutus1image.
    $name = 'theme_lonet/aboutus1image';
    $title = get_string('aboutus1image', 'theme_lonet');
    $description = get_string('aboutus1imagedesc', 'theme_lonet');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'aboutus1image');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // aboutus1heading.
    $name = 'theme_lonet/aboutus1heading';
    $title = get_string('aboutus1heading', 'theme_lonet');
    $description = get_string('aboutus1headingdesc', 'theme_lonet');
    $default = 'Our College';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // aboutus1content.
    $name = 'theme_lonet/aboutus1content';
    $title = get_string('aboutus1content', 'theme_lonet');
    $description = get_string('aboutus1contentdesc', 'theme_lonet');
    $default = 'There are many variations of passages of Lorem Ipsum available.';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);


    // aboutus2url.
    $name = 'theme_lonet/aboutus2url';
    $title = get_string('aboutus2url', 'theme_lonet');
    $description = get_string('aboutus2urldesc', 'theme_lonet');
    $default = '#';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // aboutus2image.
    $name = 'theme_lonet/aboutus2image';
    $title = get_string('aboutus2image', 'theme_lonet');
    $description = get_string('aboutus2imagedesc', 'theme_lonet');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'aboutus2image');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // aboutus2heading.
    $name = 'theme_lonet/aboutus2heading';
    $title = get_string('aboutus2heading', 'theme_lonet');
    $description = get_string('aboutus2headingdesc', 'theme_lonet');
    $default = 'Admissions';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // aboutus2content.
    $name = 'theme_lonet/aboutus2content';
    $title = get_string('aboutus2content', 'theme_lonet');
    $description = get_string('aboutus2contentdesc', 'theme_lonet');
    $default = 'There are many variations of passages of Lorem Ipsum available.';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // aboutus3url.
    $name = 'theme_lonet/aboutus3url';
    $title = get_string('aboutus3url', 'theme_lonet');
    $description = get_string('aboutus3urldesc', 'theme_lonet');
    $default = '#';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // aboutus3image.
    $name = 'theme_lonet/aboutus3image';
    $title = get_string('aboutus3image', 'theme_lonet');
    $description = get_string('aboutus3imagedesc', 'theme_lonet');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'aboutus3image');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // aboutus3heading.
    $name = 'theme_lonet/aboutus3heading';
    $title = get_string('aboutus3heading', 'theme_lonet');
    $description = get_string('aboutus3headingdesc', 'theme_lonet');
    $default = 'Scholarships';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // aboutus3content.
    $name = 'theme_lonet/aboutus3content';
    $title = get_string('aboutus3content', 'theme_lonet');
    $description = get_string('aboutus3contentdesc', 'theme_lonet');
    $default = 'There are many variations of passages of Lorem Ipsum available.';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);


    // aboutus4url.
    $name = 'theme_lonet/aboutus4url';
    $title = get_string('aboutus4url', 'theme_lonet');
    $description = get_string('aboutus4urldesc', 'theme_lonet');
    $default = '#';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // aboutus4image.
    $name = 'theme_lonet/aboutus4image';
    $title = get_string('aboutus4image', 'theme_lonet');
    $description = get_string('aboutus4imagedesc', 'theme_lonet');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'aboutus4image');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // aboutus4heading.
    $name = 'theme_lonet/aboutus4heading';
    $title = get_string('aboutus4heading', 'theme_lonet');
    $description = get_string('aboutus4headingdesc', 'theme_lonet');
    $default = 'Take a Tour';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // aboutus4content.
    $name = 'theme_lonet/aboutus4content';
    $title = get_string('aboutus4content', 'theme_lonet');
    $description = get_string('aboutus4contentdesc', 'theme_lonet');
    $default = 'There are many variations of passages of Lorem Ipsum available.';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);


    $ADMIN->add('theme_lonet', $temp);

/* Footer Settings */
	$temp = new admin_settingpage('theme_lonet_footer', get_string('footersettings', 'theme_lonet'));

    $name = 'theme_lonet/displayclientlogoarea';
    $title = get_string('displayclientlogoarea','theme_lonet');
    $description = get_string('displayclientlogoareadesc', 'theme_lonet');
    $default = 1;
    $choices = array(0=>'No', 1=>'Yes');
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $temp->add($setting);


    // clientlogo1.
    $name = 'theme_lonet/clientlogo1';
    $title = get_string('clientlogo1', 'theme_lonet');
    $description = get_string('clientlogo1desc', 'theme_lonet');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'clientlogo1');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // clientlogo2.
    $name = 'theme_lonet/clientlogo2';
    $title = get_string('clientlogo2', 'theme_lonet');
    $description = get_string('clientlogo2desc', 'theme_lonet');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'clientlogo2');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // clientlogo3.
    $name = 'theme_lonet/clientlogo3';
    $title = get_string('clientlogo3', 'theme_lonet');
    $description = get_string('clientlogo3desc', 'theme_lonet');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'clientlogo3');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // clientlogo4.
    $name = 'theme_lonet/clientlogo4';
    $title = get_string('clientlogo4', 'theme_lonet');
    $description = get_string('clientlogo4desc', 'theme_lonet');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'clientlogo4');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // clientlogo5.
    $name = 'theme_lonet/clientlogo5';
    $title = get_string('clientlogo5', 'theme_lonet');
    $description = get_string('clientlogo5desc', 'theme_lonet');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'clientlogo5');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // clientlogo6.
    $name = 'theme_lonet/clientlogo6';
    $title = get_string('clientlogo6', 'theme_lonet');
    $description = get_string('clientlogo6desc', 'theme_lonet');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'clientlogo6');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // clientlogo7.
    $name = 'theme_lonet/clientlogo7';
    $title = get_string('clientlogo7', 'theme_lonet');
    $description = get_string('clientlogo7desc', 'theme_lonet');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'clientlogo7');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // clientlogo8.
    $name = 'theme_lonet/clientlogo8';
    $title = get_string('clientlogo8', 'theme_lonet');
    $description = get_string('clientlogo8desc', 'theme_lonet');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'clientlogo8');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    $name = 'theme_lonet/displayfooter';
    $title = get_string('displayfooter','theme_lonet');
    $description = get_string('displayfooterdesc', 'theme_lonet');
    $default = 1;
    $choices = array(0=>'No', 1=>'Yes');
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $temp->add($setting);

    // footersection1heading.
    $name = 'theme_lonet/footersection1heading';
    $title = get_string('footersection1heading', 'theme_lonet');
    $description = get_string('footersection1headingdesc', 'theme_lonet');
    $default = 'ABOUT ACADEMIC';
    $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);


    // footersection1content.
    $name = 'theme_lonet/footersection1content';
    $title = get_string('footersection1content', 'theme_lonet');
    $description = get_string('footersection1contentdesc', 'theme_lonet');
    $default = 'Duis autem vel eum iriure dolor inhendrerit in vulputate velit esse molestieconsequat, vel illum dolore eu feugiatnulla facilisis at vero eros.';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);


    // footersection1email.
    $name = 'theme_lonet/footersection1email';
    $title = get_string('footersection1email', 'theme_lonet');
    $description = get_string('footersection1emaildesc', 'theme_lonet');
    $default = 'cmsbrand93@gmail.com';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);


    // footersection1contactno.
    $name = 'theme_lonet/footersection1contactno';
    $title = get_string('footersection1contactno', 'theme_lonet');
    $description = get_string('footersection1contactnodesc', 'theme_lonet');
    $default = '+00 123-456-789';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // footersection1address.
    $name = 'theme_lonet/footersection1address';
    $title = get_string('footersection1address', 'theme_lonet');
    $description = get_string('footersection1addressdesc', 'theme_lonet');
    $default = '123 6th St.Melbourne, FL 32904';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);


    // footersection2heading.
    $name = 'theme_lonet/footersection2heading';
    $title = get_string('footersection2heading', 'theme_lonet');
    $description = get_string('footersection2headingdesc', 'theme_lonet');
    $default = 'INFORMATION';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);


    // footersection2link1.
    $name = 'theme_lonet/footersection2link1';
    $title = get_string('footersection2link1', 'theme_lonet');
    $description = get_string('footersection2link1desc', 'theme_lonet');
    $default = 'About Us';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // footersection2link1url.
    $name = 'theme_lonet/footersection2link1url';
    $title = get_string('footersection2link1url', 'theme_lonet');
    $description = get_string('footersection2link1urldesc', 'theme_lonet');
    $default = '#';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // footersection2link2.
    $name = 'theme_lonet/footersection2link2';
    $title = get_string('footersection2link2', 'theme_lonet');
    $description = get_string('footersection2link2desc', 'theme_lonet');
    $default = 'Our Stories';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // footersection2link2url.
    $name = 'theme_lonet/footersection2link2url';
    $title = get_string('footersection2link2url', 'theme_lonet');
    $description = get_string('footersection2link2urldesc', 'theme_lonet');
    $default = '#';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // footersection2link3.
    $name = 'theme_lonet/footersection2link3';
    $title = get_string('footersection2link3', 'theme_lonet');
    $description = get_string('footersection2link3desc', 'theme_lonet');
    $default = 'My Account';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // footersection2link3url.
    $name = 'theme_lonet/footersection2link3url';
    $title = get_string('footersection2link3url', 'theme_lonet');
    $description = get_string('footersection2link3urldesc', 'theme_lonet');
    $default = '#';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);


    // footersection2link4.
    $name = 'theme_lonet/footersection2link4';
    $title = get_string('footersection2link4', 'theme_lonet');
    $description = get_string('footersection2link4desc', 'theme_lonet');
    $default = 'Our History';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // footersection2link4url.
    $name = 'theme_lonet/footersection2link4url';
    $title = get_string('footersection2link4url', 'theme_lonet');
    $description = get_string('footersection2link4urldesc', 'theme_lonet');
    $default = '#';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // footersection2link5.
    $name = 'theme_lonet/footersection2link5';
    $title = get_string('footersection2link5', 'theme_lonet');
    $description = get_string('footersection2link5desc', 'theme_lonet');
    $default = 'Sprcialist Info';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // footersection2link5url.
    $name = 'theme_lonet/footersection2link5url';
    $title = get_string('footersection2link5url', 'theme_lonet');
    $description = get_string('footersection2link5urldesc', 'theme_lonet');
    $default = '#';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);



    // footersection3heading.
    $name = 'theme_lonet/footersection3heading';
    $title = get_string('footersection3heading', 'theme_lonet');
    $description = get_string('footersection3headingdesc', 'theme_lonet');
    $default = 'STUDENT HELP';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);


    // footersection3link1.
    $name = 'theme_lonet/footersection3link1';
    $title = get_string('footersection3link1', 'theme_lonet');
    $description = get_string('footersection3link1desc', 'theme_lonet');
    $default = 'My Info';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // footersection3link1url.
    $name = 'theme_lonet/footersection3link1url';
    $title = get_string('footersection3link1url', 'theme_lonet');
    $description = get_string('footersection3link1urldesc', 'theme_lonet');
    $default = '#';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // footersection3link2.
    $name = 'theme_lonet/footersection3link2';
    $title = get_string('footersection3link2', 'theme_lonet');
    $description = get_string('footersection3link2desc', 'theme_lonet');
    $default = 'My Questions';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // footersection3link2url.
    $name = 'theme_lonet/footersection3link2url';
    $title = get_string('footersection3link2url', 'theme_lonet');
    $description = get_string('footersection3link2urldesc', 'theme_lonet');
    $default = '#';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // footersection3link3.
    $name = 'theme_lonet/footersection3link3';
    $title = get_string('footersection3link3', 'theme_lonet');
    $description = get_string('footersection3link3desc', 'theme_lonet');
    $default = 'F.A.Q';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // footersection3link3url.
    $name = 'theme_lonet/footersection3link3url';
    $title = get_string('footersection3link3url', 'theme_lonet');
    $description = get_string('footersection3link3urldesc', 'theme_lonet');
    $default = '#';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);


    // footersection3link4.
    $name = 'theme_lonet/footersection3link4';
    $title = get_string('footersection3link4', 'theme_lonet');
    $description = get_string('footersection3link4desc', 'theme_lonet');
    $default = 'Serch Courses';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // footersection3link4url.
    $name = 'theme_lonet/footersection3link4url';
    $title = get_string('footersection3link4url', 'theme_lonet');
    $description = get_string('footersection3link4urldesc', 'theme_lonet');
    $default = '#';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // footersection3link5.
    $name = 'theme_lonet/footersection3link5';
    $title = get_string('footersection3link5', 'theme_lonet');
    $description = get_string('footersection3link5desc', 'theme_lonet');
    $default = 'Latest Informations';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // footersection3link5url.
    $name = 'theme_lonet/footersection3link5url';
    $title = get_string('footersection3link5url', 'theme_lonet');
    $description = get_string('footersection3link5urldesc', 'theme_lonet');
    $default = '#';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);


    // footersection4heading.
    $name = 'theme_lonet/footersection4heading';
    $title = get_string('footersection4heading', 'theme_lonet');
    $description = get_string('footersection4headingdesc', 'theme_lonet');
    $default = 'INSTAGRAM';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // instagram1image.
    $name = 'theme_lonet/instagram1image';
    $title = get_string('instagram1image', 'theme_lonet');
    $description = get_string('instagram1imagedesc', 'theme_lonet');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'instagram1image');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // instagram2image.
    $name = 'theme_lonet/instagram2image';
    $title = get_string('instagram2image', 'theme_lonet');
    $description = get_string('instagram2imagedesc', 'theme_lonet');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'instagram2image');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);


    // instagram3image.
    $name = 'theme_lonet/instagram3image';
    $title = get_string('instagram3image', 'theme_lonet');
    $description = get_string('instagram3imagedesc', 'theme_lonet');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'instagram3image');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);


    // instagram4image.
    $name = 'theme_lonet/instagram4image';
    $title = get_string('instagram4image', 'theme_lonet');
    $description = get_string('instagram4imagedesc', 'theme_lonet');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'instagram4image');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);


    // instagram5image.
    $name = 'theme_lonet/instagram5image';
    $title = get_string('instagram5image', 'theme_lonet');
    $description = get_string('instagram5imagedesc', 'theme_lonet');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'instagram5image');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);


    // instagram6image.
    $name = 'theme_lonet/instagram6image';
    $title = get_string('instagram6image', 'theme_lonet');
    $description = get_string('instagram6imagedesc', 'theme_lonet');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'instagram6image');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);


    // followus.
    $name = 'theme_lonet/followus';
    $title = get_string('followus', 'theme_lonet');
    $description = get_string('followusdesc', 'theme_lonet');
    $default = 'Follow Us';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // followusurl.
    $name = 'theme_lonet/followusurl';
    $title = get_string('followusurl', 'theme_lonet');
    $description = get_string('followusurldesc', 'theme_lonet');
    $default = '#';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);


    // Copyright setting.
    $name = 'theme_lonet/copyright';
    $title = get_string('copyright', 'theme_lonet');
    $description = get_string('copyrightdesc', 'theme_lonet');
    $default = 'CmsBrand';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $temp->add($setting);;   
    
    
    // back to top button
    $name = 'theme_lonet/backtotop';
    $title = get_string('backtotop','theme_lonet');
    $description = get_string('backtotopdesc', 'theme_lonet');
    $default = '1';
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
    $temp->add($setting);


    // Footnote setting.
    $name = 'theme_lonet/footnote';
    $title = get_string('footnote', 'theme_lonet');
    $description = get_string('footnotedesc', 'theme_lonet');
    $default = '';
    $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

$ADMIN->add('theme_lonet', $temp);