<?php namespace SuperPowers\Composer;

class CommonHead extends SuperComposer {

	function view($params = array())
	{
		$type = $this->app->controller->type;

		return array(
			"title" => $params['title'],
			"bodyClass" => "superpowers-type-$type",
			"assets" => get_template_directory_uri() . '/assets/build',
			"api"   => _apiController(),
			'quality' => $this->user->getProperty($this->user->id(), 'video-quality', 'high')
		);
	}
}