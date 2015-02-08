<?php namespace SuperPowers;

class Notification extends SuperObject
{

	function create($type, $id = null, $content, $user = null, $createdBy = null)
	{
		if($user == $createdBy)
			return false;

		$enabled = $this->user->getProperty($user, 'notifications', 'true');

		if($enabled == 'false')
			return false;

		global $wpdb;
		$table = "{$wpdb->prefix}notification";

		$query = $wpdb->prepare("INSERT INTO {$table} (id, type, content, user, createdBy, date) VALUES (%s, %s, %s, %d, %d, NOW())", $id, $type, $content, $user, $createdBy);
		$wpdb->query($query);
	}

	function getList($types = array('feed', 'game'), $userId = null) {
		global $wpdb;
		$table = "{$wpdb->prefix}notification";

		$in = "";
		foreach($types as $type){
			$in .= "'$type',";
		}

		$in = rtrim($in, ",");

		$user = '';

		if($userId !== null){
			$user = "AND user = {$userId} ";
		}

		$results = $wpdb->get_results("SELECT * FROM {$table} WHERE type IN ({$in}) {$user} ORDER BY date DESC");

		return $results;
	}

	function get($id, $userId) {
		global $wpdb;
		$table = "{$wpdb->prefix}notification";

		$notification = $wpdb->get_row("SELECT * FROM {$table} WHERE id = {$id} AND user = {$userId}");

		return $notification;
	}

	function delete($id) {

		global $wpdb;

		$table = "{$wpdb->prefix}notification";

		$notification = $wpdb->query("DELETE FROM {$table} WHERE id = {$id}");
	}

	function count($userId){

		$enabled = $this->user->getProperty($userId, 'notifications', 'true');

		if($enabled == 'false')
			return 0;

		global $wpdb;
		$table = "{$wpdb->prefix}notification";

		return $wpdb->get_var("SELECT count(*) FROM {$table} WHERE user = {$userId}");
	}
}