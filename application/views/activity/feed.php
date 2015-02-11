<div class="activity activity-feed">

	<img class="author-image" src="<?php echo $image ?>">
	<div class="content">
		<span class="author-title <?php echo (!empty($subtitle))?'premium':'' ?>"><a href="<?php echo $authorLink ?>"><?php echo $author ?></a></span>
		<?php if(!empty($subtitle)): ?>
			<span class="author-subtitle"><?php echo $subtitle ?></span>
		<?php endif ?>
		<span class="activity-date date">den <?php echo $date ?></span>

		<p><?php echo $content ?></p>

		<?php if(!empty($youtube)): ?>
			<div class="video-player" data-id="<?php echo $youtube ?>">
				<div class="video-player-placeholder" style="background-image: url('<?php echo $youtubeImage; ?>')"></div>
				<div class="video-player-button-play"></div>
				<div id="youtube<?php echo $youtube ?>"></div>
			</div>
		<?php endif ?>

		<div class="toolbar">
			<?php _view('activity.footer', array('isLoggedInUser' => $isLoggedInUser, 'comments' => $comments)) ?>
		</div>
	</div>
	<ul class="activity-comments">
		<?php foreach($comments as $comment): ?>
			<?php _view('activity.comment', array('comment' => $comment)) ?>
		<?php endforeach ?>
	</ul>
	<?php _view('activity.commentform', array('activityId' => $activityId)) ?>
</div>
