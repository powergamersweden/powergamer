<?php if(!empty($posts)): ?>

	<h2 class="section-title">Senaste om <?php echo $title ?></h2>

	<?php _view('common.list', array('posts' => $posts)) ?>

<?php endif ?>