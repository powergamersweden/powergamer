<?php namespace SuperPowers\Composer;

class ActivityGame extends SuperComposer {

	function view($params = array())
	{
		$activity = $params['activity'];
		$game = get_post($activity->game);

		$comments = $this->activity->getComments($activity->id);

		return array(
			'boxart' => $this->property->getValue($game->ID, 'settings', 'boxart'),
			'title' => $game->post_title,
			'content' => $this->post->limitContent($game->post_content, 300),
			'link' => get_permalink($game->ID),
			'author' => $activity->user->data->display_name,
			'authorLink' => $this->user->getUserLink($activity->user->id),
			'date' => $activity->date,
			'activityId' => $activity->id,
			'comments' => $comments,
			'image' => $this->user->image($activity->user->id),
			'isLoggedInUser' => $this->user->is($activity->user->id),
			'subtitle' => $this->user->getProperty($activity->user->id, 'title')
		);
	}


}