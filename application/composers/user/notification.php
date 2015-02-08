<?php namespace SuperPowers\Composer;

class UserNotification extends SuperComposer {

	function view($params = array())
	{
		$type = 'game';
		$notification = $params['notification'];

		switch($notification->type){
			case 'feed':
				return $this->getFeedDetails($notification);
				break;
			case 'game':
				return $this->getGameDetails($notification);
		}
	}

	function getFeedDetails($notification) {

		$user = $this->user->get($notification->createdBy);

		return array(
			'image' => $this->user->image($user->ID),
			'title' => $user->data->display_name,
			'link'  => $this->user->url() . "?notification={$notification->id}",
			'date'  => $this->post->formatDate("now"),
			'content' => $notification->content,
			'type' => $notification->type,
			'id' => $notification->id
		);
	}

	function getGameDetails($notification) {

		$game = get_post($notification->id);

		return array(
			'image' => $this->game->boxart($game->ID),
			'title' => $game->post_title,
			'link' => $this->user->url() . "?notification={$notification->id}",
			'date' => $this->post->formatDate($notification->date),
			'content' => $notification->content,
			'type' => 'game',
			'id' => $notification->id
		);
	}
}