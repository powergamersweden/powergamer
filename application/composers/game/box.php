<?php namespace SuperPowers\Composer;

class GameBox extends SuperComposer {

	function view($params = array()) {

		$post = get_post($params['gameId']);

		$review = $this->property->getValue($post->ID, 'settings', 'review');
		$release = $this->property->getValue($post->ID, 'settings', 'release');
		$boxart = $this->property->getValue($post->ID, 'settings', 'boxart');
		$background = $this->property->getValue($post->ID, 'settings', 'background');

		$title = null;
		$link = null;

		if(!empty($params['title'])){
			if(is_string($params['title'])){
				$title = $params['title'];
			} else {
				$title = $post->post_title;
			}

			$link = get_permalink($post->ID);
		}

		return array(
			'title'         => $title,
			'link'          => $link,
			'boxart'        => $boxart,
			'background'    => $background,
			'release'       => $release,
			'content'       => $post->post_content,
			'genre'         => $this->game->getTermsLinks($post->ID, 'genre'),
			'developer'     => $this->game->getTermsLinks($post->ID, 'developer'),
			'publisher'     => $this->game->getTermsLinks($post->ID, 'publisher'),
		);
	}
}