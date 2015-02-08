<?php namespace SuperPowers\Composer;

class UserGames extends SuperComposer {

	function view($params = array())
	{
		$games = $this->user->getGames($params['userId']);

		$params['games'] = $this->game->format($games);

		return $params;
	}
}