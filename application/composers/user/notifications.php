<?php namespace SuperPowers\Composer;

class UserNotifications extends SuperComposer {

	function view($params = array())
	{
		return array(
			'notifications' => $this->notification->getList(array('game', 'feed'), $this->user->id())
		);
	}


}