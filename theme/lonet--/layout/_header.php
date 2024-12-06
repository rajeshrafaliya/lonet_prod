<?php
use local_lonet\user;

// Get the HTML for the settings bits.
$html = theme_lonet_get_html_for_settings($OUTPUT, $PAGE);

if (!empty($PAGE->theme->settings->favicon)) {
      $favicon = $PAGE->theme->setting_file_url('favicon', 'favicon');
} else {
       $favicon = $OUTPUT->image_url('favicon', 'theme');
}

$hasfacebook = $PAGE->theme->settings->facebook;
$hastwitter = $PAGE->theme->settings->twitter;
$hasgoogleplus = $PAGE->theme->settings->googleplus;

if (!empty($PAGE->theme->settings->timing)) {
   $timing = theme_lonet_get_setting('timing',true);
}else {
   $timing = '';
}
if (!empty($PAGE->theme->settings->email)) {
   $email = theme_lonet_get_setting('email',true);
}else {
   $email = '';
}

$display_footer = (empty($PAGE->theme->settings->displayfooter) ||$PAGE->theme->settings->displayfooter < 1) ? 0 : 1;
for ($i = 1; $i <= 4; $i++) {
   $fs_heading = 'footersection' . $i . 'heading';
   if (!empty($PAGE->theme->settings->$fs_heading)) {
       ${$fs_heading} = theme_lonet_get_setting($fs_heading,'format_html');
   }else {
       ${$fs_heading} = '';
   }
   if ($i == 2 || $i == 3) {
       for ($j = 1; $j <= 5; $j++) {
           $fs_link = 'footersection' . $i . 'link' . $j;
           $fs_link_url = 'footersection' . $i . 'link' . $j . 'url';
           ${$fs_link} = (!empty($PAGE->theme->settings->$fs_link) ? theme_lonet_get_setting($fs_link, true) : '');
           ${$fs_link_url} = (!empty($PAGE->theme->settings->$fs_link_url) ? theme_lonet_get_setting($fs_link_url, true) : '');
       }
   }
}
if (!empty($PAGE->theme->settings->footersection1content)) {
   $footersection1content = theme_lonet_get_setting('footersection1content',true);
}else {
   $footersection1content = '';
}
if (!empty($PAGE->theme->settings->footersection1email)) {
   $footersection1email = theme_lonet_get_setting('footersection1email',true);
}else {
   $footersection1email = '';
}
if (!empty($PAGE->theme->settings->footersection1contactno)) {
   $footersection1contactno = theme_lonet_get_setting('footersection1contactno',true);
}else {
   $footersection1contactno = '';
}
if (!empty($PAGE->theme->settings->footersection1address)) {
   $footersection1address = theme_lonet_get_setting('footersection1address',true);
}else {
   $footersection1address = '';
}

if (!empty($PAGE->theme->settings->copyright)) {
   $hascopyright = theme_lonet_get_setting('copyright',true);
}
else {
   $hascopyright = '';
}

if (!empty($PAGE->theme->settings->backtotop)) {
 $PAGE->requires->js('/theme/lonet/yui/bttotop.js');
}

$display_subscribe = (empty($PAGE->theme->settings->displaysubscribe) ||$PAGE->theme->settings->displaysubscribe < 1) ? 0 : 1;

$useragent = (isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '');
$is_mobile = preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4));

$meta_title = user::getMetaTitle() ?? $OUTPUT->page_title();
$meta_description = user::getMetaDescription() ?? $meta_title;
$canonical_url = user::getCanonicalUrl();

echo $OUTPUT->doctype() ?>
<html <?= $OUTPUT->htmlattributes() ?>>
	<head>
        <meta http-equiv="x-ua-compatible" content="IE=edge">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link rel="canonical" href="<?= $canonical_url ?>">
		<title><?= $meta_title ?></title>
        <meta name="description" content="<?= $meta_description ?>">
        <link rel="shortcut icon" href="<?= $favicon ?>" />        
        
        <meta property="og:type" content="website">
        <?php if ($_SERVER['SCRIPT_NAME'] === '/login/signup.php') { ?>
        <meta property="og:url" content="<?= user::getCurrentUrl() ?>">
        <meta property="og:title" content="Get EUR 10 credit for Lonet.Academy now!">
        <meta property="og:description" content="Get EUR 10 credit for Lonet.Academy now!">
        <meta property="og:image" content="https://lonet.academy/local/lonet/pix/referral_bonus.png">
        <?php } else { ?>
        <meta property="og:url" content="<?= $canonical_url ?>">
        <meta property="og:title" content="<?= $meta_title ?>">
        <meta property="og:description" content="<?= $meta_description ?>">
        <?php } ?>
        
        <?= user::getMetaRobotsTag() ?>
        <?= user::getHrefLangTags() ?>
        
        <link rel="preload" href="<?= $CFG->wwwroot ?>/theme/lonet/font/OpenSans-Regular.ttf">
        <link rel="preload" href="<?= $CFG->wwwroot ?>/theme/lonet/font/OpenSans-SemiBold.ttf">
        
        <script>window.onerror =  function() { return true; };</script>
		<?= $OUTPUT->standard_head_html() ?>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>    
  <link rel="stylesheet" type="text/css" href="<?= $CFG->wwwroot ?>/theme/lonet/style/jquery-eu-cookie-law-popup.css"/>
  <script src="<?= $CFG->wwwroot ?>/theme/lonet/javascript/jquery-eu-cookie-law-popup.js"></script>    
        <?php if (strpos($_SERVER['HTTP_HOST'], 'lonet.academy') !== false) { ?>
            <!-- OneTrust Cookies Consent Notice start -->
            <!--<script src="https://cdn.cookielaw.org/langswitch/fb795c13-f10a-4428-bcad-04ea57a8eb9e.js" type="text/javascript" charset="UTF-8"></script>
            <script type="text/javascript">
            function OptanonWrapper() { }
            </script>-->
            <!-- OneTrust Cookies Consent Notice end -->
            
            <!-- Global site tag (gtag.js) - Google Analytics -->
            <script async src="https://www.googletagmanager.com/gtag/js?id=UA-115475854-1"></script>
            <script>
              window.dataLayer = window.dataLayer || [];
              function gtag(){dataLayer.push(arguments);}
              gtag('js', new Date());

              gtag('config', 'UA-115475854-1');
            </script>

            <!-- Google Tag Manager -->
            <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
            new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
            })(window,document,'script','dataLayer','GTM-KLLLN83');</script>
            <!-- End Google Tag Manager -->

            <!-- Google Tag Manager OLD -->
            <script type="text/javascript">
            (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
            new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
            })(window,document,'script','dataLayer','GTM-WKZRDMK');
            </script>
            <!-- End Google Tag Manager -->

            <!-- Facebook Pixel Code -->
            <script type="text/javascript">
            !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,document,'script','https://connect.facebook.net/en_US/fbevents.js');fbq('init', '160173538159820'); fbq('track', 'PageView');
            </script>
            <noscript><img height="1" width="1" src="https://www.facebook.com/tr?id=160173538159820&ev=PageView&noscript=1"/></noscript>
            <!-- End Facebook Pixel Code -->
        <?php } ?>
		<script>
			function setCookie(cname, cvalue, exdays) {
				var d = new Date();
				d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
				var expires = "expires="+d.toUTCString();
				document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
			}
			function getCookie(cname) {
				var name = cname + "=";
				var ca = document.cookie.split(';');
				for(var i = 0; i < ca.length; i++) {
					var c = ca[i];
					while (c.charAt(0) == ' ') {
						c = c.substring(1);
					}
					if (c.indexOf(name) == 0) {
						return c.substring(name.length, c.length);
					}
				}
				return "";
			}
		</script>
		<style>
			@font-face {
				font-family: 'open_sansregular';
				src: url('<?= $CFG->wwwroot ?>/theme/lonet/font/OpenSans-Regular.ttf');
				font-weight: normal;
				font-style: normal;
			}
            @font-face {
                font-family: 'open_sansbold';
                src: url('<?= $CFG->wwwroot ?>/theme/lonet/font/OpenSans-SemiBold.ttf');
                font-weight: normal;
                font-style: normal;
            }
			@font-face {
				font-family: 'FontAwesome';
				src: url('<?= $CFG->wwwroot ?>/theme/lonet/font/fontawesome-webfont.eot?v=3.2.1');
				src: url('<?= $CFG->wwwroot ?>/theme/lonet/font/fontawesome-webfont.eot?#iefix&v=3.2.1') format('embedded-opentype'),
				url('<?= $CFG->wwwroot ?>/theme/lonet/font/fontawesome-webfont.woff?v=3.2.1')
				format('woff'),
				url('<?= $CFG->wwwroot ?>/theme/lonet/font/fontawesome-webfont.ttf?v=3.2.1') format('truetype'),
				url('<?= $CFG->wwwroot ?>/theme/lonet/font/fontawesome-webfont.svg#fontawesomeregular?v=3.2.1')
				format('svg');
				font-weight: normal;
				font-style: normal;
			}
		</style>
	</head>
