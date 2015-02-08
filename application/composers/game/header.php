<?php namespace SuperPowers\Composer;

class GameHeader extends SuperComposer {

	function view($params = array()) {

		$post = get_post($params['postId']);

		$reviewLink = null;
		$review     = $this->property->getValue($post->ID, 'settings', 'review');
		$release    = $this->property->getValue($post->ID, 'settings', 'release');
		$boxart     = $this->game->boxart($post->ID);
		$background = $this->property->getValue($post->ID, 'settings', 'background');

		$score = null;

		if($review){
			$score  = $this->property->getValue($review, 'info', 'score');
		}

		$menuLinks = $this->getMenu($post->ID, $params['view']);

		return array(
			'gameId'        => $post->ID,
			'title'         => $post->post_title,
			'boxart'        => $boxart,
			'background'    => $background,
			'score'         => $score,
			'release'       => $release,
			'menuLinks'     => $menuLinks,
			'platforms'     => $this->game->getTermsLinks($post->ID, 'platform'),
			'genre'         => $this->game->getTermsLinks($post->ID, 'genre'),
			'favorite'      => $this->user->isFavoriteGame($post->ID)
		);
	}

	private function getMenu($postId, $view) {

		$controller = _controller();
		$post = get_post($controller->postId);
		$game = get_post($postId);

		$links = array();

		$review = $this->property->getValue($game->ID, 'settings', 'review');

		$gameUrl = get_permalink($game->ID);

		$links[] = array(
			'title' => $game->post_title,
			'link'  => $gameUrl,
			'class' => ($view == 'game')?'active':''
		);

		if($review){
			$review = get_post($review);

			$links[] = array(
				'title' => "Recension",
				'link'  => $gameUrl . 'review/',
				'class' => ($view == 'review')?'active':''
			);
		}

		// Temp links
		$links[] = array(
			'title' => "Nyheter",
			'link'  => $gameUrl . 'news/',
			'class' => ($view == 'news')?'active':''
		);

		$links[] = array(
			'title' => "Videos",
			'link'  => $gameUrl . 'videos/',
			'class' => ($view == 'videos')?'active':''
		);

		return $links;
	}
}