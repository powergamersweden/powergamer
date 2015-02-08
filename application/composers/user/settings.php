<?php namespace SuperPowers\Composer;

class UserSettings extends SuperComposer {

	function view($params = array())
	{
		$user = get_user_by('id', $params['userId']);

		$params['profile'] = (object)array(
			'firstname' => $this->user->getProperty($user->ID, 'first_name', ''),
			'lastname'  => $this->user->getProperty($user->ID, 'last_name', ''),
			'email'     => !empty($user->data->user_email)?$user->data->user_email:'',
			'title'     => $this->user->title($user->ID)
		);

		$params['general'] = (object)array(
			'videoQuality' => $this->user->getProperty($user->ID, 'video-quality', 'medium'),
			'notifications' => $this->user->getProperty($user->ID, 'notifications', 'true')
		);


		return $params;
	}


}