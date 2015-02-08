<?php namespace SuperPowers\Composer;

class CommonHeader extends SuperComposer {

	function view($params = array())
	{
		$title = "PowerGamer.se";

		if(!empty($params['title'])) {
			$title = $params['title'] . ' | ' . $title;
		}

		$pages = $this->menu->getMain();

		return array(
			"title" => $title,
			"pages" => $pages,
			"home"  => $this->menu->homeUrl(),
			"user"  => $this->user->url(),
			"logout" => $this->user->url() . "?logout=true",
			"image" => $this->user->image($this->user->id()),
			"notifications" => $this->notification->count($this->user->id()),
			"signedin" => is_user_logged_in()
		);
	}
}