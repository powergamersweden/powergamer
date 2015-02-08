<li>
	<img class="author-image" src="<?php echo $image ?>">
	<div class="content">
		<span class="author-title <?php echo (!empty($subtitle))?'premium':'' ?>"><a href="<?php echo $link ?>"><?php echo $author ?></a></span>
		<?php if(!empty($subtitle)): ?>
			<span class="author-subtitle"><?php echo $subtitle ?></span>
		<?php endif ?>
		<span class="activity-date date">den <?php echo $date ?></span>
		<p><?php echo $content ?></p>
	</div>
</li>