<?php require_once(dirname(__FILE__).'/_header.php'); ?>
<body <?php echo $OUTPUT->body_attributes(); ?>>
	<?php echo $OUTPUT->standard_top_of_body_html() ?>
	<div id="page" style="background: #fafafa;">
		<?php require_once(dirname(__FILE__).'/_menu.php'); ?>
		<!-- Start Page-content -->
		<div id="page-content">
			<div id="region-main-box">
				<section id="region-main" class="container-fluid" style="max-width: unset;">
					<div class="row">
						<div class="col-sm-4 col-md-3" style="padding-left: 0;">
							<?php echo $OUTPUT->blocks('side-pre', ''); ?>
						</div>
						<div class="col-sm-8 col-md-9" style="padding-left: 0;">
							<?php  echo $OUTPUT->main_content(); ?>
						</div>
					</div>
				</section>
			</div>
		</div>
		<!-- End Page-content -->
		<?php require_once(dirname(__FILE__).'/_footer.php'); ?>