<?php $videourl = get_config('local_lonet', 'videourl');
if ($videourl) { ?>
   <style>
		#video-popup .modal-dialog {
			width: 70%;
			margin: 10% auto 0;
			-webkit-transition: width 0.5s ease-in;
			-moz-transition: width 0.5s ease-in;
			-ms-transition: width 0.5s ease-in;
			-o-transition: width 0.5s ease-in;
			transition: width 0.5s ease-in;
		}	
		#video-popup.playing .modal-dialog {
			width: 80%;
		}			
		@media screen and (min-width: 1200px) {
			#video-popup .modal-dialog {
				width: 50%;
				margin: auto;
			}	
			#video-popup.playing .modal-dialog {
				width: 60%;
			}			
		}			
		.container-video {
			position: relative;
			padding-bottom: 56.25%;
		}			
		.container-video iframe {
			position: absolute;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;		
		}			
		#button-close {
			position: absolute;
			z-index: 10;
			top: 0;
			right: 0;
			border-color: white;
			border-width: 2px;
		}
   </style>
   <script>
		$(document).ready(function() {
			<?php if (!isloggedin()) { ?>
				var cname = 'video_seen';
				var cvalue = getCookie('video_seen');
				cvalue = (cvalue == "" ? 0 : parseInt(cvalue));
				if (cvalue < 2) {
					$('#video-popup').modal('show');
					setCookie(cname, parseInt(cvalue + 1), 90);
				}
			<?php } ?>
			var player;
			window.onYouTubeIframeAPIReady = function() {
				player = new YT.Player('player', {
					events: {
					'onStateChange': onPlayerStateChange
					}
				});
			}

			function onPlayerStateChange(e) {
				if (e.data == YT.PlayerState.PLAYING) {
					$('#video-popup').addClass('playing');
				} else if (e.data != YT.PlayerState.PAUSED) {
					$('#video-popup').removeClass('playing');
				}
			}
			
			var tag = document.createElement('script');
			tag.src = "https://www.youtube.com/iframe_api";
			var firstScriptTag = document.getElementsByTagName('script')[0];
			firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
			
			$('#video-popup').on('hidden, hidden.bs.modal', function () {
				player.stopVideo();
			})			
			
			$(document).on('click', '.btn-play-video', function () {
				$('#video-popup').modal('show');
				player.playVideo();
			})
		});
   </script>
   
	<div id="video-popup" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-body">
					<button id="button-close" type="button" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-times"></span></button>
					<div class="container-video">
						<iframe id="player" width="560" height="315" src="<?= $videourl ?>?rel=0&controls=0&pc=docs&modestbranding=1&showinfo=0&enablejsapi=1" frameborder="0" allow="encrypted-media" allowfullscreen></iframe>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php } ?>
