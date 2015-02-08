<?php namespace SuperPowers;

class User extends SuperObject {

	function getGames($userId){
		global $wpdb;
		$table = "{$wpdb->prefix}subscriptions";

		$games = $wpdb->get_results("SELECT gameId from {$table} WHERE userId = {$userId}");

		return array_map(function($game){
			return $game->gameId;
		}, $games);
	}

	function addGame($gameId) {
		global $wpdb;
		$table = "{$wpdb->prefix}subscriptions";

		$userId = $this->id();
		$query = $wpdb->prepare("INSERT INTO {$table} (userId, gameId) VALUES (%d, %d) ON DUPLICATE KEY UPDATE gameId=values(gameId)", $userId, $gameId );
		$wpdb->query($query);
	}

	function removeGame($gameId){
		global $wpdb;
		$table = "{$wpdb->prefix}subscriptions";

		$query = $wpdb->prepare("DELETE FROM {$table} WHERE gameId = %d", $gameId);
		$wpdb->query($query);
	}

	function isFavoriteGame($gameId) {

		if($userId = $this->id()){
			global $wpdb;
			$table = "{$wpdb->prefix}subscriptions";

			$game = $wpdb->get_var("SELECT gameId from {$table} WHERE userId = {$userId} AND gameId = {$gameId}");

			return (!empty($game));
		}

		return false;
	}

	function isLoggedIn(){
		$user = wp_get_current_user();

		return ($user->ID != 0);
	}

	function id(){

		$user = wp_get_current_user();

		if($user)
		{
			return $user->ID;
		}

		return null;
	}

	function is($id){
		return ($id == $this->id());
	}

	function url(){

		if(!$this->isLoggedIn())
			return null;

		$url = home_url();
		$user = wp_get_current_user();

		return "$url/user/{$user->data->user_nicename}";
	}

	function getUserLink($id){
		$user = get_user_by('id', $id);

		$url = home_url();

		return "$url/user/{$user->data->user_nicename}";
	}

	function title($id){
		return $this->getProperty($id, 'title');
	}

	function image($id){
		return $this->getProperty($id, 'profile-image');
	}

	function setImage($id, $temp){
		$base = wp_upload_dir();
		$path = "{$base['basedir']}/users/{$id}.jpg";

		$this->image->create($temp, $path, 200, 200);

		$this->setProperty($id, 'profile-image', "{$base['baseurl']}/users/{$id}.jpg");
	}

	function getProperty($id, $property, $default = null){
		$value = get_user_meta($id, $property, true);

		if(!$value){
			return $default;
		}

		return $value;
	}

	function setProperty($id, $property, $value) {
		return update_user_meta($id, $property, $value);
	}

	function nickname(){
		$user = wp_get_current_user();

		return $user->data->user_nicename;
	}

	function get($id){
		return get_user_by('id', $id);
	}
}