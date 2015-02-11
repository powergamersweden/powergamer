<?php if(count($comments) == 0): ?>
	<a href="#comment" class="link activity-comment-link">Kommentera</a>
<?php else: ?>
	<a href="#comment" class="link activity-comment-link"><?php echo count($comments) ?> kommentarer</a>
<?php endif ?>

<?php if($isLoggedInUser): ?>
	<a href="#remove" class="link activity-remove-link right">Ta bort</a>
<?php endif ?>
<a href="#share" class="link activity-share-link right">Dela</a>