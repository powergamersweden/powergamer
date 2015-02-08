<?php namespace SuperPowers\Composer;

class CommonAuthor extends SuperComposer {

	function view($params = array())
	{
		$author = $this->user->get($params['authorId']);

		return array(
			'title'     => $author->data->display_name,
			'link'      => $this->user->getUserLink($author->ID),
			'subtitle'  => $this->user->getProperty($author->ID, 'title'),
			'image'     => $this->user->image($author->ID)
		);
	}

}