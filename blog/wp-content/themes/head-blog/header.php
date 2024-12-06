<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>

<!--<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6179092967353896" crossorigin="anonymous"></script>-->

		<meta http-equiv="content-type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo( 'charset' ); ?>" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		<?php wp_head(); ?>
		  <script async src="https://www.googletagmanager.com/gtag/js?id=G-5RRQ6B8VBT"></script>
		  <script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('js', new Date());

			gtag('config', 'G-5RRQ6B8VBT');
		  </script>
	</head>
	<body id="blog" <?php body_class(); ?>>
        <?php wp_body_open(); ?>

<!--<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6179092967353896"
     crossorigin="anonymous"></script>

<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-6179092967353896"
     data-ad-slot="8803699500"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>-->
		<?php get_template_part( 'template-parts/template-part', 'topnav' ); ?>
