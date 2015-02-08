<?php _view('common.header', array('title' => $title)); ?>

<?php if(!empty($postId)): ?>
	<?php _view('game.header', array('postId' => $postId, 'view' => $view)) ?>
<?php endif ?>

<section class="main-content">
	<div class="inner">

		<div class="inner-left">

			<?php _view('common.list', array('posts' => $posts)) ?>

		</div>
		<div class="inner-right">

			<?php if(!empty($gameId)): ?>
				<?php _view('game.similar', array('postId' => $gameId)) ?>
			<?php endif ?>

		</div>
	</div>
</section>

<?php _view('common.footer') ?>


