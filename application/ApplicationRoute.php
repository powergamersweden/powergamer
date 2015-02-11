<?php namespace SuperPowers\Route;

class ApplicationRouter extends BaseRoute {

	function register()
	{
		// Game subpages
		$this->registerSubview('game', 'news');
		$this->registerSubview('game', 'review');
		$this->registerSubview('game', 'videos');

		// User routes
		$this->add('user/([^/]+)/?$', 'index.php?type=user&user=$matches[1]');
		$this->addTag('user');
		$this->addTag('type');
	}
}