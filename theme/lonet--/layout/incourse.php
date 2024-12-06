<?php require_once(dirname(__FILE__).'/_header.php'); ?>
<body <?php echo $OUTPUT->body_attributes(); ?>>
	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WKZRDMK"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->
	<?php echo $OUTPUT->standard_top_of_body_html() ?>
	<div id="page">
		<?php require_once(dirname(__FILE__).'/_menu.php'); ?>
		<div id="page-content" class="row-fluid">
			<div class="container-fluid bg-grey">
				<div id="region-main-box" class="span12">
					<div class="row-fluid">
						<section id="region-main" class="<?= (is_siteadmin() ? 'span9 pull-right' : 'span12') ?>">
							<?php
							 echo $OUTPUT->course_content_header();
							 echo $OUTPUT->main_content();
							 echo $OUTPUT->course_content_footer();
							 ?>
						</section>
						<?php if (is_siteadmin()) { echo $OUTPUT->blocks('side-pre', 'span3 desktop-first-column'); } ?>
					</div>
				</div>
			</div>
		</div>
		<!-- End Page-content -->
		<?php require_once(dirname(__FILE__).'/_footer.php'); ?>
		