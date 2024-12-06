<?php require_once(dirname(__FILE__).'/_header.php'); ?>
<body <?php echo $OUTPUT->body_attributes(); ?>>
	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WKZRDMK"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->
	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WKZRDMK"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->
   <?php echo $OUTPUT->standard_top_of_body_html() ?>
   <div id="page">
   <?php require_once(dirname(__FILE__).'/innerbanner.php'); ?>
<!-- Start Page-content -->
   <div id="page-content" class="row-fluid">
      <div class="container-fluid">
         <section id="region-main" class="span12">
            <?php echo $OUTPUT->main_content(); ?>
         </section>
      </div>
   </div>
       <!-- End Page-content -->
   <?php require_once(dirname(__FILE__).'/_footer.php'); ?>