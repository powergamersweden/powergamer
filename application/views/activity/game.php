<div class="activity activity-game">

	<div class="content">
		<img class="author-image" src="<?php echo $image ?>">
		<div class="author">
			<span class="author-title <?php echo (!empty($subtitle))?'premium':'' ?>"><a href="<?php echo $authorLink ?>"><?php echo $author ?></a></span>
			<?php if(!empty($subtitle)): ?>
				<span class="author-subtitle"><?php echo $subtitle ?></span>
			<?php endif ?>
		</div>
		<span class="activity-date date">den <?php echo $date ?></span>

		<p class="activity-content">Började följa <a href="<?php echo $link ?>"><?php echo $title ?></a></p>
		<div class="game-info">
			<?php if(!empty($boxart)): ?>
				<img class="box-art" src="<?php echo $boxart ?>" />
			<?php else: ?>
				<div class="image-replacement"></div>
			<?php endif ?>
			<div class="game-about">
				<a class="game-title" href="<?php echo $link ?>"><?php echo $title ?></a>
				<p><?php echo $content ?></p>
			</div>
		</div>
		<div class="clear"></div>
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