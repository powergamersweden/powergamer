<?php _view('common.header', array('title' => $title)); ?>

<section class="main-content">
	<div class="inner">

		<div class="inner-left">
			<div class="content">
				<div class="date">Publicerad den <?php echo $date ?></div>
				<ul class="tags">
					<?php foreach($tags as $tag): ?>
						<li><a href="<?php echo $tag['link'] ?>"><?php echo $tag['title'] ?></a></li>
					<?php endforeach ?>
				</ul>
				<div class="clear"></div>
				<h1 class="title"><?php echo $title ?></h1>
				<?php echo $content ?>
			</div>

			<?php _view('common.author', array('authorId' => $authorId)); ?>

			<?php _view('comment.list') ?>

		</div>
		<div class="inner-right">

			<?php _view('video.latest') ?>

			<?php _view('ads.300x250') ?>

		</div>
	</div>
</section>

<?php $app->html->view('common.footer') ?>


