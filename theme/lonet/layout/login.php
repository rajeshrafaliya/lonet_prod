<?php require_once(dirname(__FILE__).'/_header.php'); ?>
<body <?php echo $OUTPUT->body_attributes(); ?>>
	<!-- Google Tag Manager (noscript) -->
	<!--noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WKZRDMK"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->
   <?php echo $OUTPUT->standard_top_of_body_html() ?>
   <div id="page">
   <?php require_once(dirname(__FILE__).'/_menu.php'); ?>
  <?php //require_once(dirname(__FILE__).'/innerbanner.php'); ?>
	<div class="loginlogo"><a href="<?= $CFG->wwwroot ?>"><img src="<?= $CFG->wwwroot ?>/theme/lonet/pix/signup_logo.svg" width="168"/></a></div>
       <!-- Start Page-content -->
   <div id="page-content" class="row-fluid">
      <div class="container-fluid">
         <section id="region-main" class="span12">
            <?php echo $OUTPUT->main_content(); ?>
         </section>
      </div>
   </div>
       <!-- End Page-content -->
       	<!-- Start Javascript only for login page -->    
	<script type="text/javascript">
		document.getElementById("username").placeholder = '<?= get_string('email') ?>';
		document.getElementById("password").placeholder = '<?= get_string('password') ?>';
	</script>
	<!-- End Javascript only for login page --> 
   <?php require_once(dirname(__FILE__).'/_footer.php'); ?>