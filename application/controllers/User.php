<?php namespace SuperPowers\Controller;

class User extends SuperTypeController {

	/** @var \WP_User null  */
	public $userObject = null;

	public function getDefinition()
	{
		return array(
			'groups' => array()
		);
	}

	function setPost($postId)
	{
		$user = get_user_by( 'slug', $postId );

		if($user) {
			$this->userObject = $user;
			parent::setPost($user->ID);
		}
	}

	function view() {

		// Handle user logout event
		if(!empty($_GET['logout'])){
			wp_logout();
			$this->app->redirect('');
		}

		$notificationId = empty($_GET['notification'])?null:$_GET['notification'];

		// If user comes in from a notification, remove notification and redirect to location
		if(!empty($notificationId)) {
			$notification = $this->notification->get($notificationId, $this->user->id());
			$this->notification->delete($notificationId);

			switch($notification->type) {

				case 'feed':
					$this->app->redirect("user/{$this->user->nickname()}?activity={$notification->id}");
					break;
				case 'game':
					$game = get_post($notification->id);
					$this->app->redirect("game/{$game->post_name}");
					break;
			}
		}

		$tab = empty($_GET['tab'])?null:$_GET['tab'];
		$activity = empty($_GET['activity'])?null:$_GET['activity'];

		$url = $this->user->getUserLink($this->postId);

		$isLoggedInUser = $this->user->is($this->postId);

		$menu = array(
			'feed' => array(
				'link' => "{$url}",
				'title' => 'Aktivitet',
				'active' => $tab == null
			),
			'games' => array(
				'link' => "{$url}?tab=games",
				'title' => 'Spel',
				'active' => $tab == 'games'
			)
		);

		if($isLoggedInUser){

			$menu['notifications'] =  array(
				'link' => "{$url}?tab=notifications",
				'title' => 'Notiser',
				'active' => $tab == 'notifications',
				'number' => $this->notification->count($this->postId)
			);

			$menu['messages'] =  array(
				'link' => "{$url}?tab=messages",
				'title' => 'Meddelanden',
				'active' => $tab == 'messages',
				'number' => 2
			);

			$menu['settings'] = array(
				'link' => "{$url}?tab=settings",
				'title' => 'Inställningar',
				'active' => $tab == 'settings'
			);
		}

		// Determine if user try to visit non existing tab
		if(!array_key_exists($tab, $menu)){

			// Default to first tab
			$tab = null;
			$menu['feed']['active'] = true;
		}

		// Detailed view for activity
		if($activity) {
			$tab = 'activitydetail';
		}

		return array(
			'title' => $this->userObject->data->display_name,
			'userId' => $this->postId,
			'postId' => $activity,
			'menu' => $menu,
			'tab' => empty($tab)?'activity':$tab,
			'url' => $url,
			'image' => $this->user->image($this->postId),
			'isLoggedInUser' => $isLoggedInUser,
			'userTitle' => $this->user->getProperty($this->postId, 'title')
		);
	}

	public function post($args) {

		if(!empty($args['form'])){

			switch($args['form']){
				case 'feed':
					if(!empty($args['post']) && !empty($args['userId'])) {
						$this->activity->create('feed', $args['userId'], array('content' => $args['post']));
					}
					break;
				case 'settings':
					$this->updateSettings($args);
					break;
			}
		}

		if(!empty($args['communityPage'])) {
			$this->app->redirect('community');
		} else {
			$this->app->redirect("user/{$this->userObject->data->user_login}");
		}

	}

	private function updateSettings($args){

		$data = array(
			'ID' => $this->postId,
			'user_email' => $args['email'],
			'first_name' => $args['firstname'],
			'last_name' => $args['lastname']
		);

		if(!empty($args['password']) && !empty($args['passwordagain']) && $args['password'] == $args['passwordagain'])
		{
			$data['user_pass'] = $args['password'];
		}

		if(!empty($args['title'])){
			$this->user->setProperty($this->postId, 'title', $args['title']);
		}

		wp_update_user($data);

		$this->user->setProperty($this->postId, 'video-quality', $args['video-quality']);
		$this->user->setProperty($this->postId, 'notifications', $args['notifications']);

		if(!empty($_FILES['profileimage']['tmp_name'])){
			$this->user->setImage($this->postId, $_FILES['profileimage']['tmp_name']);
		}


		$this->app->redirect("user/{$this->userObject->data->user_login}?tab=settings");
	}

	public function comment($args) {
		$success = false;
		$view = null;

		if(!empty($args['comment']) && !empty($args['activityId'])){
			$commentId = $this->activity->comment($args['activityId'], $this->user->id(), $args['comment']);
			$success = true;
			$comment = $this->activity->getComment($commentId);

			$activity = $this->activity->get($args['activityId']);
			$notification = "{$this->user->nickname()} har kommenterat ditt inlägg";

			$this->notification->create('feed', $args['activityId'], $notification, $activity->user->ID, $this->user->id());

			$view = _getView('activity.comment', array('comment' => $comment));
		}

		return array(
			'view' => $view,
			'success' => $success
		);
	}

	public function getFeed($args){
		$items = array();
		$success = false;

		if(!empty($args['page'])){
			$userId = !empty($args['userId'])?$args['userId']:null;

			$feed = $this->activity->getList(array('feed','game'), $userId, 10, $args['page']);

			foreach($feed as $post){

				$item = _getView("activity.{$post->type}", array('activity' => $post));
				$items[] = $item;
			}

			$success = true;
		}

		return array(
			'success' => $success,
			'items' => $items
		);
	}

	public function addGame($args) {
		$success = false;

		if(!empty($args['gameId'])){
			$this->user->addGame($args['gameId']);
			$this->activity->create('game', $this->user->id(), null, $args['gameId']);
			$success = true;
		}

		return array(
			'success' => $success
		);
	}

	public function removeGame($args){
		if(!empty($args['gameId'])){
			$this->user->removeGame($args['gameId']);
			$success = true;
		}

		return array(
			'success' => $success
		);
	}

	public function removeNotification($args){
		$success = false;
		$count = null;

		if(!empty($args['notificationId'])){
			$this->notification->delete($args['notificationId']);
			$success = true;
			$count = $this->notification->count($this->user->id());
		}

		return array(
			'success' => $success,
			'count' => $count
		);
	}

	public function countNotification($args){

		return array(
			'success' => true,
			'count' => $this->notification->count($this->user->id())
		);
	}

	public function removeActivity($args){

		$success = false;

		if(!empty($args['activityId']) && !empty($args['userId'])){

			$this->activity->remove($args['activityId'], $args['userId']);
			$success = true;
		}

		return array(
			'success' => $success
		);

	}
}