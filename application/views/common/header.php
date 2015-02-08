<?php _view('common.head', array('title' => $title)); ?>

<?php _view('drawer.drawer'); ?>

<header class="header header-main">
	<div class="inner">
		<div class="left">
			<a class="logo" href="<?php echo $home ?>"></a>
		</div>
		<div class="center">

		</div>

		<?php if($signedin): ?>
			<div class="user-panel">
				<div class="user-controlls">
					<a href="<?php echo $user ?>" class="user-link" <?php echo (!empty($notifications))?"data-number='{$notifications}'":"" ?>>
						<img src="<?php echo $image ?>" class="user-image"/>
					</a>
					<a class="user-controll messages notify" data-icon="A" data-number="2" href="<?php echo $user ?>?tab=messages"></a>
					<button class="user-controll drawer" data-icon="E"></button>
					<a href="<?php echo $logout ?>" class="user-controll signout" data-icon="C"></a>

				</div>
			</div>

		<?php else : ?>
			<div class="right">

				<div class="icon-holder">
					<a class="rounded-icon rounded-icon-favorites" data-icon="l" href="#show-fav"></a>
					<a class="rounded-icon rounded-icon-user" data-icon="b" href="#userlogin"></a>
				</div>

				<!--
				<div class="header-search">
					<div class="input-holder-search">
						<input type="text" placeholder="Sök"/>
					</div>
				</div>
				-->
			</div>
		<?php endif ?>
	</div>
	<div class="menu menu-main">
		<div class="inner">
			<?php foreach($pages as $page): ?>
				<a class="menu-link" href="<?php echo $page['link'] ?>"><?php echo $page['title'] ?></a>
			<?php endforeach ?>
			<!--<a class="menu-link" href="#home">Nyheter</a>
			<a class="menu-link" href="#review">Recensioner</a>
			<a class="menu-link" href="#articles">Artiklar</a>
			<a class="menu-link" href="#hardware">Hårdvara</a>
			<a class="menu-link" href="#video">Videos</a>
			<a class="menu-link" href="#podcasts">Podcasts</a>
			<a class="menu-link" href="#community">Community</a>
			<a class="menu-link" href="#forum">Forum</a>-->
		</div>
	</div>
</header>