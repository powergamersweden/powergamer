<?php if($isLoggedInUser): ?>
	<div class="user-activity-create">

		<form action="<?php echo $url ?>" method="post">
				<img class="author-image" src="<?php echo $image ?>">
				<div class="activity-form-inner">
					<textarea placeholder="Vad gör du just nu?" name="post" class="post"></textarea>
					<button class="button button-small right" type="submit">Skicka</button>
					<input type="hidden" name="userId" value="<?php echo wp_get_current_user()->ID ?>">
					<input type="hidden" name="form" value="feed">
				</div>
		</form>

		<div class="clear"></div>
	</div>
<?php endif ?>

<div class="user-activity-feed" data-user="<?php echo $userId ?>">


	<?php if(empty($activities)): ?>
		<h2 class="big-center">Inga aktiviteter</h2>
	<?php endif ?>

	<?php foreach($activities as $activity): ?>

		<?php _view("activity.{$activity->type}", array('activity' => $activity)) ?>

	<?php endforeach ?>


</div>
<?php if(!empty($activities)): ?>
	<div class="button-holder">
		<button class="ladda-button button button-center button-wide button-small load-activity"><span class="ladda-label">Visa fler</span></button>
	</div>
<?php endif ?>
