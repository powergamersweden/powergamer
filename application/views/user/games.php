<?php if(empty($games)): ?>
	<h2 class="big-center">Vad är detta? Inga spel?</h2>
<?php endif ?>

<?php _view('game.grid', array('games' => $games)); ?>