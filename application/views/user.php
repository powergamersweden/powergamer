<?php _view('common.header', array('title' => $title)); ?>

<section class="main-content user-profile">
	<div class="inner left-sidebar">

		<div class="inner-left">

			<div class="user-profile-info">
				<img class="profile-image" src="<?php echo $image ?>">
				<h1 class="profile-title"><?php echo $title ?></h1>
				<?php if(!empty($userTitle)): ?>
				<span class="profile-subtitle"><?php echo $userTitle ?></span>
				<?php endif ?>
			</div>

			<div class="menu">
				<?php foreach($menu as $id => $item): ?>
					<a <?php echo (!empty($item['number'])?"data-number='{$item['number']}'":'') ?> href="<?php echo $item['link'] ?>" title="<?php echo $item['title'] ?>" class="<?php echo $id ?> <?php echo $item['active']?'active':'' ?>"><?php echo $item['title'] ?></a>
				<?php endforeach ?>
			</div>

		</div>
		<div class="inner-right">

			<?php _view("user.{$tab}", array('userId' => $userId, 'url' => $url, 'postId' => $postId)) ?>

		</div>
	</div>
</section>

<?php $app->html->view('common.footer') ?>


