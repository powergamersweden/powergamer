<?php namespace SuperPowers\Composer;

class DrawerDrawer extends SuperComposer {
	function view($params = array())
	{
		return array(
			'link' => $this->user->url() . '?tab=games'
		);
	}


}