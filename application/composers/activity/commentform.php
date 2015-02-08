<?php namespace SuperPowers\Composer;

class ActivityCommentform extends SuperComposer {
	function view($params = array())
	{
		$params['image'] = $this->user->image($this->user->id());

		return $params;
	}


}