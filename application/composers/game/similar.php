<?php namespace SuperPowers\Composer;

class GameSimilar extends SuperComposer {

	function view($params = array()) {

		$games = array();
		$similarGames = $this->game->getSimilarGames($params['postId']);


		foreach($similarGames as $game){

			$games[] = array(
				'title'     => $game->post_title,
				'link'      => get_permalink($game->ID),
				'boxart'    => $this->game->boxart($game->ID, 'small'),
				'score'     => $this->game->getScore($game->ID)
			);
		}

		return array(
			'games' => $games
		);
	}
}