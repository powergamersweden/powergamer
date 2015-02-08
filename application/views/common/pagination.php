<ul class="pagination">
	<?php foreach($pagination as $button): ?>
		<li class="<?php echo $button['class'] ?>"><a href="<?php echo $button['link'] ?><?php echo (!empty($hash)?$hash:'') ?>"><?php echo $button['title'] ?></a></li>
	<?php endforeach ?>
</ul>