<h2 class="section-title"><?php echo (empty($title)?'Senaste videos':$title) ?></h2>

<div class="article-list article-list-small article-list-type-video">

	<?php foreach($posts as $post): ?>

		<div class="article-list-item article-type-video">

			<a href="<?php echo $post['link'] ?>" class="article-link" title="<?php echo $post['title'] ?>"></a>
			<div class="article-image-list">
				<img src="<?php echo $post['image'] ?>" />
			</div>
			<div class="article-title"><?php echo _limit($post['title'], 60) ?></div>

		</div>

	<?php endforeach ?>

	<a class="button list-item-read-more" href="<?php echo $more ?>">
		Fler videos
	</a>
</div>