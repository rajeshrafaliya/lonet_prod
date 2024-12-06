<?php

function theme_lonet_process_css($css, $theme) {
global $OUTPUT;
    // Set the background image for the logo.
    $logo = $theme->setting_file_url('logo', 'logo');
    $css = theme_lonet_set_logo($css, $logo);
    
       // Set the background image for the servicesboximage.
    $servicesboximage = $theme->setting_file_url('servicesboximage', 'servicesboximage');
    
    if(!isset($servicesboximage)){
	     $servicesboximage = $OUTPUT->pix_url('servicesboximage', 'theme');
	    }
	     	$css = theme_lonet_set_servicesboximage($css, $servicesboximage);
    
    
    // Set the background image for the loginbackground.
    $loginbackground = $theme->setting_file_url('loginbackground', 'loginbackground');
    
    if(!isset($loginbackground)){
	     $loginbackground = $OUTPUT->pix_url('loginbackground', 'theme');
	    }
	     	$css = theme_lonet_set_loginbackground($css, $loginbackground);
    
    // Set the background image for the innerbanner.
    $innerbanner = $theme->setting_file_url('innerbanner', 'innerbanner');
    
    if(!isset($innerbanner)){
	     $innerbanner = $OUTPUT->pix_url('innerbanner', 'theme');
	    }
	     	$css = theme_lonet_set_innerbanner($css, $innerbanner);
    
    // Set the background image for the announcementsbg.
    $announcementsbg = $theme->setting_file_url('announcementsbg', 'announcementsbg');
    
    if(!isset($announcementsbg)){
	     $announcementsbg = $OUTPUT->pix_url('announcementsbg', 'theme');
	    }
	     	$css = theme_lonet_set_announcementsbg($css, $announcementsbg);
    
    // Set custom CSS.
    if (!empty($theme->settings->customcss)) {
        $customcss = $theme->settings->customcss;
    } else {
        $customcss = null;
    }
    $css = theme_lonet_set_customcss($css, $customcss);
    
    // Set the sitebluecolor.
    if (empty($theme->settings->sitebluecolor)) {
        $sitebluecolor = '#002b46'; // Default.
    } else {
        $sitebluecolor = $theme->settings->sitebluecolor;
    }
    $css = lonet_set_sitebluecolor($css, $sitebluecolor);
    
    // Set the sitegreencolor.
    if (empty($theme->settings->sitegreencolor)) {
        $sitegreencolor = '#499306'; // Default.
    } else {
        $sitegreencolor = $theme->settings->sitegreencolor;
    }
    $css = lonet_set_sitegreencolor($css, $sitegreencolor);
    
    // Set the salmoncolor.
    if (empty($theme->settings->salmoncolor)) {
        $salmoncolor = '#fc6d65'; // Default.
    } else {
        $salmoncolor = $theme->settings->salmoncolor;
    }
    $css = lonet_set_salmoncolor($css, $salmoncolor);
    
    // Set the orangecolor.
    if (empty($theme->settings->orangecolor)) {
        $orangecolor = '#ff9800'; // Default.
    } else {
        $orangecolor = $theme->settings->orangecolor;
    }
    $css = lonet_set_orangecolor($css, $orangecolor);
    
    // Set the cyancolor.
    if (empty($theme->settings->cyancolor)) {
        $cyancolor = '#009688'; // Default.
    } else {
        $cyancolor = $theme->settings->cyancolor;
    }
    $css = lonet_set_cyancolor($css, $cyancolor);
    
    // Set the skybluecolor.
    if (empty($theme->settings->skybluecolor)) {
        $skybluecolor = '#01c0d1'; // Default.
    } else {
        $skybluecolor = $theme->settings->skybluecolor;
    }
    $css = lonet_set_skybluecolor($css, $skybluecolor);

    return $css;
}


function theme_lonet_set_logo($css, $logo) {
    $tag = '[[setting:logo]]';
    $replacement = $logo;
    if (is_null($replacement)) {
        $replacement = '';
    }

    $css = str_replace($tag, $replacement, $css);

    return $css;
}
function theme_lonet_set_servicesboximage($css, $servicesboximage) {
    $tag = '[[setting:servicesboximage]]';
    $replacement = $servicesboximage;
    if (is_null($replacement)) {
        $replacement = '';
    }

    $css = str_replace($tag, $replacement, $css);

    return $css;
}
function theme_lonet_set_loginbackground($css, $loginbackground) {
    $tag = '[[setting:loginbackground]]';
    $replacement = $loginbackground;
    if (is_null($replacement)) {
        $replacement = '';
    }

    $css = str_replace($tag, $replacement, $css);

    return $css;
}
function theme_lonet_set_innerbanner($css, $innerbanner) {
    $tag = '[[setting:innerbanner]]';
    $replacement = $innerbanner;
    if (is_null($replacement)) {
        $replacement = '';
    }

    $css = str_replace($tag, $replacement, $css);

    return $css;
}
function lonet_set_sitebluecolor($css, $sitebluecolor) {
    $tag = '[[setting:sitebluecolor]]';
    $css = str_replace($tag, $sitebluecolor, $css);
    return $css;
}
function lonet_set_sitegreencolor($css, $sitegreencolor) {
    $tag = '[[setting:sitegreencolor]]';
    $css = str_replace($tag, $sitegreencolor, $css);
    return $css;
}
function lonet_set_salmoncolor($css, $salmoncolor) {
    $tag = '[[setting:salmoncolor]]';
    $css = str_replace($tag, $salmoncolor, $css);
    return $css;
}
function lonet_set_orangecolor($css, $orangecolor) {
    $tag = '[[setting:orangecolor]]';
    $css = str_replace($tag, $orangecolor, $css);
    return $css;
}
function lonet_set_cyancolor($css, $cyancolor) {
    $tag = '[[setting:cyancolor]]';
    $css = str_replace($tag, $cyancolor, $css);
    return $css;
}
function lonet_set_skybluecolor($css, $skybluecolor) {
    $tag = '[[setting:skybluecolor]]';
    $css = str_replace($tag, $skybluecolor, $css);
    return $css;
}
function theme_lonet_set_announcementsbg($css, $announcementsbg) {
    $tag = '[[setting:announcementsbg]]';
    $replacement = $announcementsbg;
    if (is_null($replacement)) {
        $replacement = '';
    }

    $css = str_replace($tag, $replacement, $css);

    return $css;
}







function theme_lonet_pluginfile($course, $cm, $context, $filearea, $args, $forcedownload, array $options = array()) {
    if ($context->contextlevel == CONTEXT_SYSTEM and ($filearea === 'logo' || $filearea === 'smalllogo')) {
        $theme = theme_config::load('lonet');
        // By default, theme files must be cache-able by both browsers and proxies.
        if (!array_key_exists('cacheability', $options)) {
            $options['cacheability'] = 'public';
        }
        return $theme->setting_file_serve($filearea, $args, $forcedownload, $options);
    } else if ($context->contextlevel == CONTEXT_SYSTEM and $filearea === 'banner1image') {
        $theme = theme_config::load('lonet');
        return $theme->setting_file_serve('banner1image', $args, $forcedownload, $options);
    } else if ($context->contextlevel == CONTEXT_SYSTEM and $filearea === 'banner2image') {
        $theme = theme_config::load('lonet');
        return $theme->setting_file_serve('banner2image', $args, $forcedownload, $options);
    } else if ($context->contextlevel == CONTEXT_SYSTEM and $filearea === 'banner3image') {
        $theme = theme_config::load('lonet');
        return $theme->setting_file_serve('banner3image', $args, $forcedownload, $options);
    } else if ($context->contextlevel == CONTEXT_SYSTEM and $filearea === 'course1image') {
        $theme = theme_config::load('lonet');
        return $theme->setting_file_serve('course1image', $args, $forcedownload, $options);
    } else if ($context->contextlevel == CONTEXT_SYSTEM and $filearea === 'course2image') {
        $theme = theme_config::load('lonet');
        return $theme->setting_file_serve('course2image', $args, $forcedownload, $options);
    } else if ($context->contextlevel == CONTEXT_SYSTEM and $filearea === 'course3image') {
        $theme = theme_config::load('lonet');
        return $theme->setting_file_serve('course3image', $args, $forcedownload, $options);
    } else if ($context->contextlevel == CONTEXT_SYSTEM and $filearea === 'course4image') {
        $theme = theme_config::load('lonet');
        return $theme->setting_file_serve('course4image', $args, $forcedownload, $options);
    }  else if ($context->contextlevel == CONTEXT_SYSTEM and $filearea === 'course5image') {
        $theme = theme_config::load('lonet');
        return $theme->setting_file_serve('course5image', $args, $forcedownload, $options);
    }  else if ($context->contextlevel == CONTEXT_SYSTEM and $filearea === 'course6image') {
        $theme = theme_config::load('lonet');
        return $theme->setting_file_serve('course6image', $args, $forcedownload, $options);
    }else if ($context->contextlevel == CONTEXT_SYSTEM and $filearea === 'course7image') {
        $theme = theme_config::load('lonet');
        return $theme->setting_file_serve('course7image', $args, $forcedownload, $options);
    }else if ($context->contextlevel == CONTEXT_SYSTEM and $filearea === 'course8image') {
        $theme = theme_config::load('lonet');
        return $theme->setting_file_serve('course8image', $args, $forcedownload, $options);
    }else if ($context->contextlevel == CONTEXT_SYSTEM and $filearea === 'course9image') {
        $theme = theme_config::load('lonet');
        return $theme->setting_file_serve('course9image', $args, $forcedownload, $options);
    }else if ($context->contextlevel == CONTEXT_SYSTEM and $filearea === 'course10image') {
        $theme = theme_config::load('lonet');
        return $theme->setting_file_serve('course10image', $args, $forcedownload, $options);
    }else if ($context->contextlevel == CONTEXT_SYSTEM and $filearea === 'course11image') {
        $theme = theme_config::load('lonet');
        return $theme->setting_file_serve('course11image', $args, $forcedownload, $options);
    }else if ($context->contextlevel == CONTEXT_SYSTEM and $filearea === 'course12image') {
        $theme = theme_config::load('lonet');
        return $theme->setting_file_serve('course12image', $args, $forcedownload, $options);
    }else if ($context->contextlevel == CONTEXT_SYSTEM and $filearea === 'loginbackground') {
        $theme = theme_config::load('lonet');
        return $theme->setting_file_serve('loginbackground', $args, $forcedownload, $options);
    } else if ($context->contextlevel == CONTEXT_SYSTEM and $filearea === 'innerbanner') {
        $theme = theme_config::load('lonet');
        return $theme->setting_file_serve('innerbanner', $args, $forcedownload, $options);
    } else if ($context->contextlevel == CONTEXT_SYSTEM and $filearea === 'announcementsbg') {
        $theme = theme_config::load('lonet');
        return $theme->setting_file_serve('announcementsbg', $args, $forcedownload, $options);
    } else if ($context->contextlevel == CONTEXT_SYSTEM and $filearea === 'servicesboximage') {
        $theme = theme_config::load('lonet');
        return $theme->setting_file_serve('servicesboximage', $args, $forcedownload, $options);
    } else if ($context->contextlevel == CONTEXT_SYSTEM and $filearea === 'servicesbox1icon') {
        $theme = theme_config::load('lonet');
        return $theme->setting_file_serve('servicesbox1icon', $args, $forcedownload, $options);
    } else if ($context->contextlevel == CONTEXT_SYSTEM and $filearea === 'servicesbox2icon') {
        $theme = theme_config::load('lonet');
        return $theme->setting_file_serve('servicesbox2icon', $args, $forcedownload, $options);
    } else if ($context->contextlevel == CONTEXT_SYSTEM and $filearea === 'servicesbox3icon') {
        $theme = theme_config::load('lonet');
        return $theme->setting_file_serve('servicesbox3icon', $args, $forcedownload, $options);
    } else if ($context->contextlevel == CONTEXT_SYSTEM and $filearea === 'servicesbox4icon') {
        $theme = theme_config::load('lonet');
        return $theme->setting_file_serve('servicesbox4icon', $args, $forcedownload, $options);
    } else if ($context->contextlevel == CONTEXT_SYSTEM and $filearea === 'aboutus1image') {
        $theme = theme_config::load('lonet');
        return $theme->setting_file_serve('aboutus1image', $args, $forcedownload, $options);
    } else if ($context->contextlevel == CONTEXT_SYSTEM and $filearea === 'aboutus2image') {
        $theme = theme_config::load('lonet');
        return $theme->setting_file_serve('aboutus2image', $args, $forcedownload, $options);
    } else if ($context->contextlevel == CONTEXT_SYSTEM and $filearea === 'aboutus3image') {
        $theme = theme_config::load('lonet');
        return $theme->setting_file_serve('aboutus3image', $args, $forcedownload, $options);
    } else if ($context->contextlevel == CONTEXT_SYSTEM and $filearea === 'aboutus4image') {
        $theme = theme_config::load('lonet');
        return $theme->setting_file_serve('aboutus4image', $args, $forcedownload, $options);
    } else if ($context->contextlevel == CONTEXT_SYSTEM and $filearea === 'clientlogo1') {
        $theme = theme_config::load('lonet');
        return $theme->setting_file_serve('clientlogo1', $args, $forcedownload, $options);
    } else if ($context->contextlevel == CONTEXT_SYSTEM and $filearea === 'clientlogo2') {
        $theme = theme_config::load('lonet');
        return $theme->setting_file_serve('clientlogo2', $args, $forcedownload, $options);
    } else if ($context->contextlevel == CONTEXT_SYSTEM and $filearea === 'clientlogo3') {
        $theme = theme_config::load('lonet');
        return $theme->setting_file_serve('clientlogo3', $args, $forcedownload, $options);
    } else if ($context->contextlevel == CONTEXT_SYSTEM and $filearea === 'clientlogo4') {
        $theme = theme_config::load('lonet');
        return $theme->setting_file_serve('clientlogo4', $args, $forcedownload, $options);
    } else if ($context->contextlevel == CONTEXT_SYSTEM and $filearea === 'clientlogo5') {
        $theme = theme_config::load('lonet');
        return $theme->setting_file_serve('clientlogo5', $args, $forcedownload, $options);
    } else if ($context->contextlevel == CONTEXT_SYSTEM and $filearea === 'clientlogo6') {
        $theme = theme_config::load('lonet');
        return $theme->setting_file_serve('clientlogo6', $args, $forcedownload, $options);
    } else if ($context->contextlevel == CONTEXT_SYSTEM and $filearea === 'clientlogo7') {
        $theme = theme_config::load('lonet');
        return $theme->setting_file_serve('clientlogo7', $args, $forcedownload, $options);
    } else if ($context->contextlevel == CONTEXT_SYSTEM and $filearea === 'clientlogo8') {
        $theme = theme_config::load('lonet');
        return $theme->setting_file_serve('clientlogo8', $args, $forcedownload, $options);
    } else if ($context->contextlevel == CONTEXT_SYSTEM and $filearea === 'instagram1image') {
        $theme = theme_config::load('lonet');
        return $theme->setting_file_serve('instagram1image', $args, $forcedownload, $options);
    } else if ($context->contextlevel == CONTEXT_SYSTEM and $filearea === 'instagram2image') {
        $theme = theme_config::load('lonet');
        return $theme->setting_file_serve('instagram2image', $args, $forcedownload, $options);
    } else if ($context->contextlevel == CONTEXT_SYSTEM and $filearea === 'instagram3image') {
        $theme = theme_config::load('lonet');
        return $theme->setting_file_serve('instagram3image', $args, $forcedownload, $options);
    } else if ($context->contextlevel == CONTEXT_SYSTEM and $filearea === 'instagram4image') {
        $theme = theme_config::load('lonet');
        return $theme->setting_file_serve('instagram4image', $args, $forcedownload, $options);
    } else if ($context->contextlevel == CONTEXT_SYSTEM and $filearea === 'instagram5image') {
        $theme = theme_config::load('lonet');
        return $theme->setting_file_serve('instagram5image', $args, $forcedownload, $options);
    } else if ($context->contextlevel == CONTEXT_SYSTEM and $filearea === 'instagram6image') {
        $theme = theme_config::load('lonet');
        return $theme->setting_file_serve('instagram6image', $args, $forcedownload, $options);
    } else if ($context->contextlevel == CONTEXT_SYSTEM and $filearea === 'favicon') {
        $theme = theme_config::load('lonet');
        return $theme->setting_file_serve('favicon', $args, $forcedownload, $options);
    } else{
        send_file_not_found();
    }
}


function theme_lonet_set_customcss($css, $customcss) {
    $tag = '[[setting:customcss]]';
    $replacement = $customcss;
    if (is_null($replacement)) {
        $replacement = '';
    }

    $css = str_replace($tag, $replacement, $css);

    return $css;
}

function theme_lonet_get_html_for_settings(renderer_base $output, moodle_page $page) {
    global $CFG;
    $return = new stdClass;

    $return->navbarclass = '';
    if (!empty($page->theme->settings->invert)) {
        $return->navbarclass .= ' navbar-inverse';
    }

    // Only display the logo on the front page and login page, if one is defined.
    if (!empty($page->theme->settings->logo) &&
            ($page->pagelayout == 'frontpage' || $page->pagelayout == 'login')) {
        $return->heading = html_writer::tag('div', '', array('class' => 'logo'));
    } else {
        $return->heading = $output->page_heading();
    }

    $return->footnote = '';
    if (!empty($page->theme->settings->footnote)) {
        $return->footnote = '<div class="footnote text-center">'.format_text($page->theme->settings->footnote).'</div>';
    }

    return $return;
}

/**
 * All theme functions should start with theme_lonet_
 * @deprecated since 2.5.1
 */
function lonet_process_css() {
    throw new coding_exception('Please call theme_'.__FUNCTION__.' instead of '.__FUNCTION__);
}

/**
 * All theme functions should start with theme_lonet_
 * @deprecated since 2.5.1
 */
function lonet_set_logo() {
    throw new coding_exception('Please call theme_'.__FUNCTION__.' instead of '.__FUNCTION__);
}

/**
 * All theme functions should start with theme_lonet_
 * @deprecated since 2.5.1
 */
function lonet_set_customcss() {
    throw new coding_exception('Please call theme_'.__FUNCTION__.' instead of '.__FUNCTION__);
}
function theme_lonet_get_setting($setting, $format = false) {
    global $CFG;
    require_once($CFG->dirroot . '/lib/weblib.php');
    static $theme;
    if (empty($theme)) {
        $theme = theme_config::load('lonet');
    }
    if (empty($theme->settings->$setting)) {
        return false;
    } else if (!$format) {
        return $theme->settings->$setting;
    } else if ($format === 'format_text') {
        return format_text($theme->settings->$setting, FORMAT_PLAIN);
    } else if ($format === 'format_html') {
        return format_text($theme->settings->$setting, FORMAT_HTML, array('trusted' => true, 'noclean' => true));
    } else {
        return format_string($theme->settings->$setting);
    }
}