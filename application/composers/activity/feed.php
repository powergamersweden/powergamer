<?php namespace SuperPowers\Composer;

class ActivityFeed extends SuperComposer {

	function view($params = array())
	{
		$activity = $params['activity'];

		$comments = $this->activity->getComments($activity->id);

		return array(
			'content' => $activity->content,
			'author' => $activity->user->data->display_name,
			'authorLink' => $this->user->getUserLink($activity->user->id),
			'date' => $activity->date,
			'userId' => $activity->user->ID,
			'activityId' => $activity->id,
			'comments' => $comments,
			'image' => $this->user->image($activity->user->id),
			'isLoggedInUser' => $this->user->is($activity->user->id),
			'subtitle' => $this->user->getProperty($activity->user->id, 'title'),
			'youtube' => $activity->youtube,
			'youtubeImage' => "http://img.youtube.com/vi/{$activity->youtube}/sddefault.jpg",
			'activityLink' => $this->activity->url($activity->user->id, $activity->id)
		);
	}


}