<?php namespace SuperPowers\Composer;

class GameRecent extends SuperComposer {

	function view($params = array()) {

		global $post;

		$posts = $this->news->getGameRecent($post->ID);

		return array(
			'title' => $post->post_title,
			'posts' => $this->news->format($posts)
		);
	}
}