<div class="article-list article-list-small article-list-type-review ">

	<?php foreach($games as $game): ?>
		<div class="article-list-item">
			<a href="<?php echo $game['link'] ?>" class="article-link"></a>
			<?php if(!empty($game['boxart'])): ?>
				<img class="article-image-list" src="<?php echo $game['boxart'] ?>" />
			<?php else: ?>
				<div class="image-replacement"></div>
			<?php endif ?>
			<div class="article-title"><?php echo $game['title'] ?></div>

			<?php _view('review.stars', array('score' => $game['score'])) ?>
		</div>
	<?php endforeach ?>
</div>