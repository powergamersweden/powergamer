<?php _view('common.header', array('title' => $title)); ?>

<?php _view('game.header', array('postId' => $postId, 'view' => $view)) ?>

<section class="main-content">
	<div class="inner">

		<div class="inner-left">

			<?php _view('game.box', array('gameId' => $postId)) ?>

			<?php _view('game.recent') ?>

		</div>
		<div class="inner-right">

			<?php _view('common.share', array('small' => true)) ?>

			<?php _view('game.similar', array('postId' => $postId)) ?>

		</div>
	</div>
</section>

<?php _view('common.footer') ?>


