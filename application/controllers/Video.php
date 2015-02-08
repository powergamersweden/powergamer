<?php namespace SuperPowers\Controller;

class Video extends SuperTypeController {

	public function getDefinition()
	{
		return array(
			'groups' => array(
				'info' => $this->create->group('info', 'Video info', array(
					'repeatable' => false,
					'properties' => array(
						$this->create->property('url', 'textfield', array(
							'label'      => 'Youtube url:',
							'placeholder' => 'Enter youtube.com video url'
						)),
						$this->create->property('game', 'dropdown', array(
							'label' => 'Select game:',
							'datasource' => 'posts',
							'posttype'  => 'game'
						)),
						$this->create->property('image', 'image', array(
							'label' => 'Image',
							'size' => array(
								'default' => '200x112'
							)
						))
					)
				))
			)
		);
	}

	protected function view()
	{
		$post = get_post($this->postId);
		$game = $this->property->getValue($this->postId, 'info', 'game');
		$categories = $this->video->getPostCategories($this->postId);

		return array(
			'title'         => $post->post_title,
			'content'       => $post->post_content,
			'postId'        => $post->ID,
			'gameId'        => $game,
			'date'          => $this->post->date($post->ID),
			'tags'          => $categories
		);
	}

	public function listView()
	{
		$title = 'Nyheter';
		$posts = array();
		$game = null;

		// Specific game videos
		if($this->postId) {
			$game = get_post($this->postId);
			$title = "Videos | {$game->post_title}";
			$posts = $this->video->getGameVideos($game->ID);
		}

		$args = array(
			'postId'    => $this->postId,
			'title'     => $title,
			'view'      => 'videos',
			'posts'     => $this->news->format($posts, 'video'),
			'gameId'    => $game->ID
		);

		$this->html->view('news.list', $args);
		exit();
	}

	public function save($args)
	{
		$game = $args['superpowers']['info'][0]['game'];

		if(!empty($game) && $game != '-1'){
			$this->video->saveVideoToGame($this->postId, $game);

			$game = get_post($game);

			$notification = "{$game->post_title} har en ny video";

			$users = $this->game->getUsers($game->ID);

			foreach($users as $userId) {
				$this->notification->create('game', $game->ID, $notification, $userId);
			}

		} else {
			$this->video->removeVideo($this->postId);
		}

		parent::save($args);
	}
}