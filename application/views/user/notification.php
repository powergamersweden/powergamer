<div class="activity activity-feed notification notification-type-<?php echo $type ?>" data-id="<?php echo $id ?>">


	<a class="notification-link" href="<?php echo $link ?>"></a>
	<img class="author-image" src="<?php echo $image ?>">
	<div class="content">
		<span class="author-title"><?php echo $title ?></span>
		<span class="activity-date date">den <?php echo $date ?></span>
		<p><?php echo $content ?></p>

	</div>
	<div class="toolbar">
		<a href="#remove" class="link right remove-notification">Ta bort</a>
	</div>
	<div class="clear"></div>
</div>
