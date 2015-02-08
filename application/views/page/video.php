<?php _view('common.header', array('title' => $title)) ?>

<?php _view('video.header', array('postId' => $latestVideo->ID, 'title' => $latestVideo->post_title)) ?>

	<section class="main-content video-archive" id="videos">
		<div class="inner left-menu">

			<div class="inner-left">
				<h2 class="section-title lightweight">Kategorier</h2>
				<div class="menu">
					<?php foreach($categories as $cat): ?>
						<a href="<?php echo $cat['link'] ?>#videos" title="<?php echo $cat['title'] ?>" class="<?php echo $cat['active']?'active':'' ?>"><?php echo $cat['title'] ?></a>
					<?php endforeach ?>
				</div>

				<h2 class="section-title lightweight">Sök video</h2>
				<div class="menu">
					<form method="get">
						<input class="menu-search" placeholder="" name="search" type="search" value="<?php echo $search ?>" autocomplete="off">
						<?php if(!empty($categorySlug)): ?>
							<input type="hidden" name="category" value="<?php echo $categorySlug ?>">
						<?php endif ?>
						<p class="input-hint">Tryck enter för att söka</p>
					</form>
				</div>
			</div>
			<div class="inner-right">
				<?php if(!empty($posts)): ?>
					<h2 class="section-title"><?php echo $category ?></h2>

					<?php _view('common.grid', array('posts' => $posts)) ?>

					<?php _view('common.pagination', array('pagination' => $pagination, 'hash' => $hash )) ?>
				<?php endif ?>

				<?php if(empty($posts)): ?>
					<h2 class="big-center">Hittade inga videos</h2>
				<?php endif ?>
			</div>
		</div>
	</section>

<?php _view('common.footer') ?>