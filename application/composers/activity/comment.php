<?php namespace SuperPowers\Composer;

class ActivityComment extends SuperComposer {


	function view($params = array())
	{
		$comment = $params['comment'];

		return array(
			'image' => $this->user->image($comment->user->id),
			'link' => $this->user->getUserLink($comment->user->id),
			'author' => $comment->user->data->display_name,
			'subtitle' => $this->user->getProperty($comment->user->id, 'title'),
			'date'  => $comment->date,
			'content' => $comment->comment,
		);
	}

}