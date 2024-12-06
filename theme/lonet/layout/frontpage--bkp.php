<?php
   $regionmainbox = 'span12';
   $regionmain = 'span12';
   $sidepre = 'span3';
   $sidepost = 'span3 ';
   global $CFG;
   ?>
<?php require_once(dirname(__FILE__).'/_header.php'); ?>
<body <?php echo $OUTPUT->body_attributes(); ?>>
   <?php echo $OUTPUT->standard_top_of_body_html() ?>
   <div id="page">
         <?php 
         $language = explode('_', current_language())[0];
         if (!isloggedin() or isguestuser()) { 
		 ?>
		 <!-- MailerLite Universal -->
			<script>
			(function(m,a,i,l,e,r){ m['MailerLiteObject']=e;function f(){
			var c={ a:arguments,q:[]};var r=this.push(c);return "number"!=typeof r?r:f.bind(c.q);}
			f.q=f.q||[];m[e]=m[e]||f.bind(f.q);m[e].q=m[e].q||f.q;r=a.createElement(i);
			var _=a.getElementsByTagName(i)[0];r.async=1;r.src=l+'?v'+(~~(new Date().getTime()/1000000));
			_.parentNode.insertBefore(r,_);})(window, document, 'script', 'https://static.mailerlite.com/js/universal.js', 'ml');

			var ml_account = ml('accounts', '1267354', 'i1g2b8w6m0', 'load');
			</script>
			<!-- End MailerLite Universal -->

			<!--div class="modal fade" id="myModal">
             <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                 <div class="modal-content">
                        <?php 
	/* 					if ($language == 'en') {
							 $url = $CFG->wwwroot.'/theme/lonet/pix/popup/ENG_v1.png';
						  }elseif($language == 'es') { 
							 $url = $CFG->wwwroot.'/theme/lonet/pix/popup/ESP_v1.png';
						  }elseif($language == 'lv') { 
							 $url = $CFG->wwwroot.'/theme/lonet/pix/popup/LV_v1.png';
						  }elseif($language == 'ru') { 
							 $url = $CFG->wwwroot.'/theme/lonet/pix/popup/RUS_v1.png';
						  }  */
						?>
                           <a href="/login/signup.php?popup=1" target="_blank"><img class="img-fluid" src="<?php //echo $url; ?>" id="imagepreview" ></a>
                 </div>
             </div>
         </div>
		 <script type="text/javascript">
          $(window).on('load',function(){
          var delayMs = 15000; // delay in milliseconds
          
          setTimeout(function(){
              $('#myModal').modal('show');
              $(".modal-backdrop.in").hide();
          }, delayMs);
      });
      </script>-->
      <?php } ?>      
   <?php require_once(dirname(__FILE__).'/_menu.php'); ?>   
   <?php require_once(dirname(__FILE__).'/_slider.php'); ?>
   <?php // require_once(dirname(__FILE__).'/_testimonials.php'); ?>
   <?php require_once(dirname(__FILE__).'/_featured.php'); ?>
   <?php require_once(dirname(__FILE__).'/_services.php'); ?>
   <?php require_once(dirname(__FILE__).'/_aboutus.php'); ?>
   
   <div id="page-content" class="row-fluid" style="display: none;">
      <div class="container-fluid">
         <div id="region-main-box" class="<?php echo $regionmainbox; ?>">
            <div class="row-fluid">
               <section id="region-main" class="<?php echo $regionmain; ?>">
                  <?php
                     //echo $OUTPUT->course_content_header();
                     echo $OUTPUT->main_content();
                     //echo $OUTPUT->course_content_footer();
                  ?>
               </section>
            </div>
         </div>
      </div>
   </div>
   
   <?php require_once(dirname(__FILE__).'/_posts.php'); ?>
   <?php require_once(dirname(__FILE__).'/_video.php'); ?>
   <?php require_once(dirname(__FILE__).'/_footer.php'); ?>
   