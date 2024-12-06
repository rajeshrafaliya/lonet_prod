<?php
$display_aboutus = (empty($PAGE->theme->settings->displayaboutus) ||$PAGE->theme->settings->displayaboutus < 1) ? 0 : 1;

if ($display_aboutus) { 
   if (!empty($PAGE->theme->settings->aboutusheading)) {
       $aboutusheading = theme_lonet_get_setting('aboutusheading',true);
   }else {
       $aboutusheading = '';
   }
   if (!empty($PAGE->theme->settings->aboutustagline)) {
       $aboutustagline = theme_lonet_get_setting('aboutustagline',true);
   }else {
       $aboutustagline = '';
   }
   for ($i = 1; $i <= 4; $i++) {
       $au_url = 'aboutus' . $i . 'url';
       $au_image = 'aboutus' . $i . 'image';
       $au_heading = 'aboutus' . $i . 'heading';
       $au_content = 'aboutus' . $i . 'content';
       if (!empty($PAGE->theme->settings->$au_url)) {
           ${$au_url} = theme_lonet_get_setting($au_url, true);
       }else {
           ${$au_url} = '';
       }
       if (!empty($PAGE->theme->settings->$au_image)) {
          ${$au_image} = $PAGE->theme->setting_file_url($au_image, $au_image);
       } else {
           ${$au_image} = $OUTPUT->image_url('header-block-icon1', 'theme');
       }
       if (!empty($PAGE->theme->settings->$au_heading)) {
           ${$au_heading} = theme_lonet_get_setting($au_heading, true);
       }else {
           ${$au_heading} = '';
       }
       if (!empty($PAGE->theme->settings->$au_content)) {
           ${$au_content} = theme_lonet_get_setting($au_content, true);
       }else {
           ${$au_content} = '';
       }
   }

    $language = explode('_', current_language())[0];
    $about_us_id = 26;
    if ($language == 'lv') {
        $about_us_id = 27;
    }
    if ($language == 'ru') {
        $about_us_id = 28;
    }
?>
	<div class="header-blocks clearfix container-fluid">
		<?php if ($aboutusheading) { ?>
			<h1><a href="/mod/page/view.php?id=<?= $about_us_id ?>"><?= get_string('abouttitle', 'theme_lonet') ?></a></h1>
			<div class="heading_line">
				<div><i class='fa fa-graduation-cap' aria-hidden='true'></i></div>
			</div>
		<?php } ?>
		<?php if ($aboutustagline) { ?>
			<p class="tagline"><?= get_string('aboutsubtitle', 'theme_lonet') ?></p>
		<?php } ?>
		<div class="row-fluid" style="margin-top: 10px;">
			<?php for ($i = 1; $i <= 4; $i++) { ?>
				<a href="<?php echo ${'aboutus'.$i.'url'} ?>" class="span3 hvr-float-shadow">
					<img src="<?php echo ${'aboutus'.$i.'image'} ?>" alt=""/>
					<h4><?= get_string('aboutheading'.$i, 'theme_lonet') ?></h4>
					<p><?= get_string('abouttext'.$i, 'theme_lonet') ?></p>
				</a>
			<?php } ?>
		</div>
	</div>
<?php } ?>
