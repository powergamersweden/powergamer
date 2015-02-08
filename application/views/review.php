<?php _view('common.header', array('title' => $title)); ?>

<?php _view('game.header', array('postId' => $gameId, 'view' => $view) ); ?>

<section class="main-content">
	<div class="inner">

		<div class="content">
			<?php echo $content ?>
		</div>

		<?php _view('common.author', array('authorId' => $authorId)); ?>

		<div class="inner-left">
			<?php _view('comment.list') ?>

		</div>
		<div class="inner-right">

			<?php _view('common.share') ?>

			<?php _view('game.similar', array('postId' => $gameId)) ?>

			<?php _view('ads.300x250') ?>


		</div>
	</div>


	<div class="clear"></div>
</section>

<?php $app->html->view('common.footer') ?>


