<?php namespace SuperPowers\Composer;

class DrawerGames extends SuperComposer {
	function view($params = array())
	{
		$user = wp_get_current_user();
		
		$gameIds = $this->user->getGames($user->ID);

		$games = array();

		foreach($gameIds as $gameId) {
			$game = get_post($gameId);
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