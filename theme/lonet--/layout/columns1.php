<?php require_once(dirname(__FILE__).'/_header.php'); ?>
<body <?php echo $OUTPUT->body_attributes(); ?>>
	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WKZRDMK"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->
   <?php echo $OUTPUT->standard_top_of_body_html() ?>
   <div id="page">
   <?php require_once(dirname(__FILE__).'/_menu.php'); ?>
   <?php require_once(dirname(__FILE__).'/innerbanner.php'); ?>
   <div class="container-fluid">
      <div id="page-navbar" class="clearfix">
         <nav class="breadcrumb-nav"><?php echo $OUTPUT->navbar(); ?></nav>
         <div class="breadcrumb-button"><?php echo $OUTPUT->page_heading_button(); ?></div>
      </div>
   </div>
       <!-- Start Page-content --> 
   <div id="page-content" class="row-fluid">
      <div class="container-fluid">
         <section id="region-main" class="span12">
            <?php
               echo $OUTPUT->course_content_header();
               echo $OUTPUT->main_content();
               echo $OUTPUT->course_content_footer();
               ?>
         </section>
      </div>
   </div>
       <!-- End Page-content -->
   <?php require_once(dirname(__FILE__).'/_footer.php'); ?>