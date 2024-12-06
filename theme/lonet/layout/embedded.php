<?php require_once(dirname(__FILE__).'/_header.php'); ?>
<body <?php echo $OUTPUT->body_attributes(); ?>>
	<!-- Google Tag Manager (noscript) -->
	<!--noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WKZRDMK"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->
   <?php echo $OUTPUT->standard_top_of_body_html() ?>
   <div id="page">
       <!-- Start Page-content -->
      <div id="page-content" class="clearfix">
         <?php echo $OUTPUT->main_content(); ?>
      </div>
       <!-- End Page-content -->
   </div>
   <?php echo $OUTPUT->standard_end_of_body_html() ?>
</body>
</html>