<div class="article-list">
	<?php foreach($posts as $post): ?>
		<div class="article-list-item article-type-<?php echo $post['type'] ?>">

			<a href="<?php echo $post['link'] ?>" class="article-link"></a>
			<div class="article-image-list">
				<img src="<?php echo $post['image'] ?>" />
			</div>
			<div class="article-about">Publicerad den <?php echo $post['date'] ?></div>
			<h3 class="article-title"><?php echo $post['title'] ?></h3>
			<div class="item-content"><?php echo $post['content'] ?></div>
		</div>
	<?php endforeach ?>
</div>