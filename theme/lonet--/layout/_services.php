<?php
$display_servicesbox = (empty($PAGE->theme->settings->displayservicesbox) ||$PAGE->theme->settings->displayservicesbox < 1) ? 0 : 1;

if ($display_servicesbox) {
    if (!empty($PAGE->theme->settings->servicesheading)) {
       $servicesheading = theme_lonet_get_setting('servicesheading',true);
    }else {
       $servicesheading = '';
    }
    if (!empty($PAGE->theme->settings->servicestagline)) {
       $servicestagline = theme_lonet_get_setting('servicestagline',true);
    }else {
       $servicestagline = '';
    }
    for ($i = 1; $i <= 4; $i++) {
       $sb_icon = 'servicesbox' . $i . 'icon';
       if (!empty($PAGE->theme->settings->$sb_icon)) {
          ${$sb_icon} = $PAGE->theme->setting_file_url($sb_icon, $sb_icon);
       } else {
           ${$sb_icon} = $OUTPUT->image_url('icon1', 'theme');
       }
       $sb_heading = 'servicesbox' . $i . 'heading';
       if (!empty($PAGE->theme->settings->$sb_heading)) {
           ${$sb_heading} = theme_lonet_get_setting($sb_heading, true);
       }else {
           ${$sb_heading} = '';
       }
       $sb_content = 'servicesbox' . $i . 'content';
       if (!empty($PAGE->theme->settings->$sb_content)) {
           ${$sb_content} = theme_lonet_get_setting($sb_content, true);
       }else {
           ${$sb_content} = '';
       }
       $sb_url = 'servicesbox' . $i . 'url';
       if (!empty($PAGE->theme->settings->$sb_url)) {
           ${$sb_url} =$PAGE->theme->settings->$sb_url;
       }else {
           ${$sb_url} = '';
       }
    }
?>
	<div class="servicesbox">
		<div class="container-fluid">
			<h1><?= get_string('benefitstitle', 'theme_lonet') ?></h1>
			<span><?= get_string('benefitssubtitle', 'theme_lonet') ?></span>
			<hr>
			<div class="row-fluid h-center">
				<?php
                $j = 1;
				for ($i = 1; $i <= 4; $i++) { 
					if ($i !== 3) {
						?>
						<div class="span3 draw meet">
							<div class="con">
								<?php if(${'servicesbox'.$i.'icon'}) {?>
									<a href="<?php echo ${'servicesbox'.$i.'url'} ?>"><img src="<?php echo '/theme/lonet/pix/benefits/benefit-'.$j++.'.png' ?>" alt="" /></a>
								<?php }?>
								<h5><a href="<?php echo ${'servicesbox'.$i.'url'} ?>"><?= get_string('benefitsheading'.$i, 'theme_lonet') ?></a></h5>
								<?php if(${'servicesbox'.$i.'content'}) {?>
									<p><?php echo ${'servicesbox'.$i.'content'} ?></p>
								<?php }?>
							</div>
						</div>
						<?php
					}
				} ?>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	<?php
} ?>

