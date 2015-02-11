<?php namespace SuperPowers\Controller;

class Game extends SuperTypeController {

	/**
	 * @property \SuperPowers\Game game
	 */

	public function getDefinition()
	{
		return array(
			'groups' => array(
				'settings' => $this->create->group('settings', 'Game settings', array(
					'repeatable' => false,
					'properties' => array(
						$this->create->property('release-date', 'date', array(
							'label' => 'Release date',
							'time' => true
						)),
						$this->create->property('email', 'email', array(
							'label' => "This is my email test?"
						)),
						$this->create->property('boolean', 'bool', array(
							'label' => "This is my bool test?"
						)),
						$this->create->property('review', 'dropdown', array(
							'datasource'    => 'posts',
							'posttype'      => 'review',
							'label'         => 'Select game review'
						)),
						$this->create->property('boxart', 'image', array(
							'label' => 'Add box art:',
							'size' => array(
								'default' => '600x734',
								'medium' => '200x150',
								'small' => '60x75',
								'thumbnail' => '200x112'
							)
						)),
						$this->create->property('background', 'image', array(
							'label'         => 'Add background image:',
							'size'         => array(
								'default'   => '1200x420',
								'small'     => '710x230'
							)
						)),

					)
				))
			)
		);
	}

	protected function view()
	{
		$post = get_post($this->postId);

		$boxart         = $this->property->value('info', 'boxart', array('size' => 'default'));
		$headerImage    = $this->property->value('info', 'reviewHeader');
		$score          = $this->property->value('info', 'score');

		return array(
			'title'         => $post->post_title,
			'headerImage'   => $headerImage,
			'boxart'        => $boxart,
			'score'         => $score,
			'content'       => $post->post_content,
			'postId'        => $post->ID,
			'view'          => 'game',
		);
	}

	public function save($args)
	{
		$review = $args['superpowers']['settings'][0]['review'];
		$old = $this->property->getValue($this->postId, 'settings', 'review');

		if($review && $review != $old) {
			$game = get_post($this->postId);

			$notification = "{$game->post_title} har en ny recension";

			$users = $this->game->getUsers($game->ID);

			foreach($users as $userId) {
				$this->notification->create('game', $game->ID, $notification, $userId);
			}
		}
		$release = $this->property->getValue($this->postId, 'settings','release-date');

		$this->game->save($this->postId, $review);

		parent::save($args);
	}

	protected function renderSubview($view)
	{
		if($view == 'videos'){
			$view = 'video';
		}

		/** @var SuperTypeController $controller */
		$controller = $this->load->controller($view);

		if($controller){

			$this->app->controller = $controller;
			$controller->load($view, null);

			if($view == 'review') {
				$review = $this->property->value('settings', 'review');
				$controller->setPost($review);

				$controller->render();
			} else {
				$controller->setPost($this->postId);
				$controller->listView();
			}



		}
	}


}