<?php namespace SuperPowers\Composer;

class UserActivitydetail extends SuperComposer {

	function view($params = array())
	{
		$activity = $this->activity->get($params['postId'], $params['userId']);

		$params['activity'] = $activity;
		return $params;
	}


}