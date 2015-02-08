<?php _view('common.header') ?>

	<section class="main-content">
		<div class="inner">

			<div class="inner-left">

				<div class="user-activity-create">

					<form action="<?php echo $url ?>" method="post">
						<img class="author-image" src="<?php echo $image ?>">
						<div class="activity-form-inner">
							<textarea placeholder="Vad gör du just nu?" name="post" class="post"></textarea>
							<button class="button button-small right" type="submit">Skicka</button>
							<input type="hidden" name="userId" value="<?php echo $userId ?>">
							<input type="hidden" name="form" value="feed">
							<input type="hidden" name="communityPage" value="true">
						</div>
					</form>

					<div class="clear"></div>
				</div>

				<div class="user-activity-feed">

					<?php foreach($activities as $activity): ?>

						<?php _view("activity.{$activity->type}", array('activity' => $activity)) ?>

					<?php endforeach ?>

				</div>

				<div class="button-holder">
					<button class="ladda-button button button-center button-wide button-small load-activity"><span class="ladda-label">Visa fler</span></button>
				</div>

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