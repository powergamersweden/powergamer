<div class="activity activity-feed" data-id="<?php echo $activityId ?>" data-user="<?php echo $userId ?>">

	<div class="content">
		<img class="author-image" src="<?php echo $image ?>">
		<div class="author">
			<span class="author-title <?php echo (!empty($subtitle))?'premium':'' ?>"><a href="<?php echo $authorLink ?>"><?php echo $author ?></a></span>
			<?php if(!empty($subtitle)): ?>
				<span class="author-subtitle"><?php echo $subtitle ?></span>
			<?php endif ?>
		</div>
		<span class="activity-date date">den <?php echo $date ?></span>

		<div class="inner-content">
			<p class="activity-content"><?php echo $content ?></p>

			<?php if(!empty($youtube)): ?>
				<div class="video-player" data-id="<?php echo $youtube ?>">
					<div class="video-player-placeholder" style="background-image: url('<?php echo $youtubeImage; ?>')"></div>
					<div class="video-player-button-play"></div>
					<div id="youtube<?php echo $youtube ?>"></div>
				</div>
			<?php endif ?>
		</div>
		<div class="toolbar">
			<?php _view('activity.footer', array('isLoggedInUser' => $isLoggedInUser, 'comments' => $comments)) ?>
		</div>
	</div>
	<?php _view('activity.share', array('link' => $activityLink)) ?>

	<ul class="activity-comments">
		<?php foreach($comments as $comment): ?>
			<?php _view('activity.comment', array('comment' => $comment)) ?>
		<?php endforeach ?>
	</ul>
	<?php _view('activity.commentform', array('activityId' => $activityId)) ?>
</div>
