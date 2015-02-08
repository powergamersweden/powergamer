<div class="game-header" data-id="<?php echo $gameId ?>">
	<div class="header-background" style="background-image: url('<?php echo $background ?>')"></div>
	<div class="inner header-content">

		<div class="box-art-wrapper">
			<?php if(!empty($boxart)): ?>
				<img class="box-art" src="<?php echo $boxart ?>" />
			<?php else: ?>
				<div class="image-replacement"></div>
			<?php endif ?>
			<a class="button-game-subscribe <?php echo ($favorite)?'is-favorite':''; ?>" data-icon="D"></a>
		</div>

		<div class="review-head">
			<h1><?php echo $title ?></h1>
			<h3><?php echo $platforms ?></h3>
			<?php _view('review.stars', array('score' => $score)) ?>
		</div>
		<div class="review-details">
			<h4><a href="#link"><?php echo $release ?></a></h4>
			<h4><?php echo $genre ?></h4>
		</div>

		<div class="game-header-menu">
			<?php foreach($menuLinks as $link): ?>

				<a href="<?php echo $link['link'] ?>" class="<?php echo $link['class'] ?>"><?php echo $link['title'] ?></a>

			<?php endforeach ?>
		</div>


	</div>
</div>