<div class="user-activity-feed">

	<?php if(empty($notifications)): ?>
		<h2 class="big-center">Du har inga notiser</h2>
	<?php else: ?>
		<?php foreach($notifications as $notification): ?>
		<?php _view('user.notification', array('notification' => $notification)) ?>
		<?php endforeach ?>
	<?php endif ?>
</div>