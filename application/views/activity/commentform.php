<div class="comment-form">
	<form>
		<img class="author-image" src="<?php echo $image ?>">
		<div class="comment-form-inner">
			<textarea placeholder="Skriv en kommentar..." class="comment"></textarea>
			<input type="hidden" class="activityId" value="<?php echo $activityId ?>">
			<button class="button-submit-comment button button-small" type="submit">Skicka</button>
		</div>
	</form>

	<div class="clear"></div>
</div>