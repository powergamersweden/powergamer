<?php _view('common.header') ?>


<?php _view('feature.big') ?>

		<section class="main-content">
			<div class="inner">

				<div class="inner-left">

					<h2 class="section-title">Just nu på PowerGamer.se</h2>
					<?php _view('common.list', array('posts' => $posts)) ?>


				</div>
				<div class="inner-right">
					<?php _view('video.latest') ?>

					<?php _view('ads.300x250') ?>

					<?php _view('video.latest') ?>

					<?php _view('ads.300x250') ?>
				</div>

			</div>
		</section>

<?php _view('common.footer') ?>