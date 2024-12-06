<?php
   // Set default (LTR) layout mark-up for a three column page.
   $regionmainbox = 'span9';
   $regionmain = 'span8 pull-right';
   $sidepre = 'span4 desktop-first-column';
   $sidepost = 'span3 pull-right';
   // Reset layout mark-up for RTL languages.
   if (right_to_left()) {
       $regionmainbox = 'span9 pull-right';
       $regionmain = 'span8';
       $sidepre = 'span4 pull-right';
       $sidepost = 'span3 desktop-first-column';
   }
   ?>
<?php require_once(dirname(__FILE__).'/_header.php'); ?>
<body <?php echo $OUTPUT->body_attributes(); ?>>
	<!-- Google Tag Manager (noscript) -->
	<!--noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WKZRDMK"
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
            <div id="region-main-box" class="<?php echo $regionmainbox; ?>">
               <div class="row-fluid">
                  <section id="region-main" class="<?php echo $regionmain; ?>">
                     <?php echo $OUTPUT->main_content(); ?>
                  </section>
                  <?php echo $OUTPUT->blocks('side-pre', $sidepre); ?>
               </div>
            </div>
            <?php echo $OUTPUT->blocks('side-post', $sidepost); ?>
         </div>
      </div>
       <!-- End Page-content -->
      <?php echo $OUTPUT->standard_end_of_body_html() ?>
   </div>
</body>
</html>