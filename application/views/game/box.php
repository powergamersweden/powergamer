<div class="game-info">
	<div class="game-info-background" style="background-image: url('<?php echo $background ?>')"></div>
	<div class="game-info-content <?php echo (!empty($title))?'with-title':'' ?>">
		<?php if(!empty($boxart)): ?>
			<img class="box-art" src="<?php echo $boxart ?>" />
		<?php else: ?>
			<div class="image-replacement"></div>
		<?php endif ?>

		<div class="game-info-content">
			<?php if(!empty($title)): ?>
				<h2><a href="<?php echo $link ?>"><?php echo $title ?></a></h2>
			<?php endif ?>
			<p><?php echo $content ?></p>
		</div>
		<div class="clear"></div>
		<div class="game-info-footer">
			<div class="info-col"><a href="#link">2014-12-04</a></div>
			<div class="info-col"><?php echo $genre ?></div>
			<div class="info-col"><?php echo $developer ?></div>
			<div class="info-col"><?php echo $publisher ?></div>
		</div>

	</div>
</div>