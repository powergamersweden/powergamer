<?php namespace SuperPowers\Controller;

class Review extends SuperTypeController {

	public function getDefinition()
	{
		return array(
			'groups' => array(
				'info' => $this->create->group('info', 'Game info', array(
					'repeatable' => false,
					'properties' => array(
						$this->create->property('score', 'slider', array(
							'label'      => 'Score:',
							'datasource' => 'score'
						))
					)
				))
			)
		);
	}

	protected function view()
	{
		$post = get_post($this->postId);

		$game = $this->game->getGameForReview($this->postId);

		return array(
			'title'         => $post->post_title,
			'content'       => $this->post->content($post->ID),
			'gameId'        => $game->ID,
			'view'          => 'review',
			'authorId'      => $post->post_author
		);
	}

	public function save($args)
	{
		parent::save($args);
	}
}