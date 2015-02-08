<?php namespace SuperPowers\Composer;

class UserActivity extends SuperComposer {

	function view($params = array())
	{
		$activities = $this->activity->getList(array('feed', 'game'), $params['userId']);

		$params['image'] = $this->user->image($this->user->id());
		$params['activities'] = $activities;
		$params['isLoggedInUser'] = $this->user->is($params['userId']);

		return $params;
	}


}