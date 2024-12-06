<?php

?>
<style>
.container-sidebar {
	position: fixed;
	display: flex;
	right: 0;
	top: 55%;
	z-index: 12;
	background: #f5f5f5;
	-webkit-box-shadow: -1px 1px 3px 0px rgba(0,0,0,0.5);
	-moz-box-shadow: -1px 1px 3px 0px rgba(0,0,0,0.5);
	box-shadow: -1px 1px 3px 0px rgba(0,0,0,0.5);
}
#switcher {
	background-color: #499306;
	width: 60px;
	cursor: pointer;
	color: #002b46;
	padding: 5px 17px;
}
#switcher .fa {
	font-size: 27px;
	color: #ffffff;
}
#sidebar {
	display: block;
	border-top: 2px solid #499306;
	border-bottom: 2px solid #499306;
	width: 0;
	height: 180px;
	overflow: hidden;
	-webkit-transition: width 0.6s ease-in-out, background 0.6s ease-in-out;
	-moz-transition: width 0.6s ease-in-out, background 0.6s ease-in-out;
	-o-transition: width 0.6s ease-in-out, background 0.6s ease-in-out;
	transition: width 0.6s ease-in-out, background 0.6s ease-in-out;
	background: transparent;
}
#sidebar.visible {
	width: 300px;
}
#sidebar-inner {
	width: 300px;
	overflow: hidden;
	padding: 5px 15px;
	background: transparent;
}
#sidebar-inner > p {
	color: #002b46;
	text-transform: uppercase;
	font-family: "Arial Black",Gadget,sans-serif;
}
#sidebar-inner ul {
	list-style: none;
    margin: 0 0 10px 15px;
}
#sidebar-inner li {
	margin-bottom: 10px;
}
@media (max-width: 768px) {
	.container-sidebar {display: none;}
}
.instagram-follow {
	background: #ffffff;
	border-radius: 3px;
	font-size: 12px;
	color: #000000;	
    padding: 3px 6px;
}
.instagram-follow > img {
	margin: -2px 0 0 3px;
}
</style>

<script>
	<?php if (!isloggedin()) { ?>
		var cname = 'social_links_seen';
		var cvalue = getCookie('social_links_seen');
		cvalue = (cvalue == "" ? 0 : parseInt(cvalue));
		if (cvalue < 1) {
			setTimeout(function() { $('#sidebar').addClass('visible'); }, 60000);
			setCookie(cname, parseInt(cvalue + 1), 90);
		}		
	<?php } ?>
	$(document).on('click', '#switcher', function(e) {
		$('#sidebar').toggleClass('visible');
	});
</script>

<div class="container-sidebar">
	<div id="switcher">
		<p>&nbsp;</p>
		<span class="fa fa-facebook-square"></span>
		<br><span class="fa fa-twitter"></span>
		<br><span class="fa fa-instagram"></span>
		<br><span class="fa fa-linkedin"></span>
	</div>
	<div id="sidebar">
		<div id="sidebar-inner">
			<p><?= get_string('followus', 'theme_lonet') ?></p>
			<ul>
				<li>
					<div class="fb-like" data-href="https://www.facebook.com/lonet.academy/" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
					<script async src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0"></script>
				</li>
				<li>
					<a href="https://twitter.com/lonet_academy?ref_src=twsrc%5Etfw" class="twitter-follow-button" data-show-count="false">Follow @lonet_academy</a>
					<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
				</li>
				<li style="margin-top: -3px;">
					<a href="https://www.instagram.com/lonet.academy/" target="_blank" rel="noopener noreferrer" class="instagram-follow">Follow <img src="/theme/lonet/pix/instagram.png" alt="Instagram"></a>
				</li>
				<li>
					<script src="//platform.linkedin.com/in.js" type="text/javascript"></script>
					<script type="IN/FollowCompany" data-id="27194217" data-counter="right"></script>
				</li>
			</ul>
		</div>
	</div>
</div>