<div class="video-header">
	<div class="header-background" style="background-image: url('<?php echo $background ?>')"></div>
	<div class="inner header-content">

		<div class="video-player" data-id="<?php echo $videoId ?>">
			<div class="video-player-placeholder" style="background-image: url('<?php echo $image; ?>')"></div>
			<div class="video-player-button-play"></div>
			<div id="youtube<?php echo $videoId ?>"></div>
		</div>

		<?php if(!empty($title)): ?>
			<h1 class="video-title"><a href="<?php echo $link ?>"><?php echo $title ?></a></h1>
			<a href="<?php echo $link ?>#comments" class="video-comment-link">2 kommentarer</a>
		<?php endif ?>

	</div>

</div>