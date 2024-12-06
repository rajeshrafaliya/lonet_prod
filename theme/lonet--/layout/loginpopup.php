<?php
$social_auth_html = '';
$authsequence = get_enabled_auth_plugins(true); // Get all auths, in sequence.
$potentialidps = array();
foreach ($authsequence as $authname) {
    $authplugin = get_auth_plugin($authname);
    $potentialidps = array_merge($potentialidps, $authplugin->loginpage_idp_list($this->page->url->out(false)));
}

if (!empty($potentialidps)) {
    $social_auth_html .= '<div class="potentialidps">';
    $social_auth_html .= '<h6>' . get_string('potentialidps', 'auth') . '</h6>';
    $social_auth_html .= '<div class="potentialidplist">';
    foreach ($potentialidps as $idp) {
        $social_auth_html .= '<div class="col-sm-6 potentialidp">';
        //$social_auth_html .= '<a class="btn btn-default btn-block" ';
        $social_auth_html .= '<a class="btn" ';
        $social_auth_html .= 'href="' . $idp['url']->out() . '" title="' . s($idp['name']) . '">';
        if (!empty($idp['iconurl'])) {
            $social_auth_html .= '<img src="' . s($idp['iconurl']) . '" width="24" height="24" class="m-r-1"/>';
        }
        $social_auth_html .= s($idp['name']) . '</a></div>';
    }
    $social_auth_html .= '</div>';
//    $social_auth_html .= '<br>';
    $social_auth_html .= '</div>';
}
?>

<div class="cd-popup cd-popup-login" role="alert">
   <div class="cd-popup-container">
      <div class="log">
        <?= $social_auth_html ?>
        <div>OR</div>
         <h2><?= get_string('login') ?></h2>         
         <form method="post" id="cf_login" class="loginform" action="<?php echo $CFG->httpswwwroot; ?>/login/index.php">
            <div class="inputarea">
               <input type="text" name="username" id="username" placeholder="<?php echo get_string('username'); ?>" autocomplete="off" />
               <input type="password" id="password" name="password" placeholder="<?php echo get_string('password'); ?>" autocomplete="off" />
               <!--<div class="rememberpass">
                        <input type="checkbox" name="rememberusername" id="rememberusername" value="1">
                        <label for="rememberusername"><?= get_string('rememberusername', 'admin') ?></label>
                    </div>-->
               <div class="clearfix"></div>
			   <button><?= get_string('login') ?></button>
            </div>
            <div class="clearfix"></div>
            <label></label>
            <div class="forgotPassword langmenuContainer">
               <?php
                  if(!empty($CFG->registerauth)){
                  	 $authplugin = get_auth_plugin($CFG->registerauth);
                  	 if($authplugin->can_signup()){
                  		//echo html_writer::link($CFG->wwwroot.'/login/signup.php', 'Sign Up');	//TODO   this should come through the language file 	
                  		?>
               <a href="<?php echo $CFG->wwwroot.'/login/signup.php' ?>"><?= get_string('register', 'theme_lonet') ?></a>
               <a href=" <?php echo $CFG->wwwroot.'/login/signup.php' ?>">|</a>
               <?php
                  }
                  }
                  ?>
               <a href=" <?php echo $CFG->wwwroot.'/login/forgot_password.php' ?>"><?= get_string('forgotten') ?></a>
            </div>
            <div class="clearfix"></div>
         </form>
      </div>
      <a href="#0" class="cd-popup-close img-replace">Close</a>
   </div>
   <!-- cd-popup-container -->
</div>
<script type="text/javascript">
		document.getElementById("username").placeholder = '<?= get_string('email') ?>';
		document.getElementById("password").placeholder = '<?= get_string('password') ?>';
</script>