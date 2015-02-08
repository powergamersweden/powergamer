
<div class="article-list article-grid article-grid-games">

	<?php foreach(array_chunk($games, 4) as $chunk): ?>

		<div class="article-grid-row">

			<?php foreach($chunk as $game): ?>
				<div class="article-list-item article-type-<?php echo $game['type'] ?>">

					<a href="<?php echo $game['link'] ?>" class="article-link"></a>
					<div class="article-image-list">
						<?php if(!empty($game['image'])): ?>
							<img src="<?php echo $game['image'] ?>" />
						<?php else: ?>
							<div class="image-replacement"></div>
						<?php endif ?>
					</div>
					<h3 class="article-title"><?php echo $game['title'] ?></h3>
				</div>
			<?php endforeach ?>

			<div class="clear"></div>
		</div>

	<?php endforeach ?>
</div>