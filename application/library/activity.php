<?php namespace SuperPowers;

class Activity extends SuperObject {

	function url($userId, $activityId){
		$userLink = $this->user->getUserLink($userId);
		return "{$userLink}/?activity={$activityId}";
	}

	function create($type, $userId, $content, $gameId = null){
		global $wpdb;
		$table = "{$wpdb->prefix}activity";
		$users = null;

		if($type == 'feed'){

			$youtube = $this->video->getIdFromString($content['content']);

			if(!empty($youtube)){

				$content['youtube'] = $youtube;
			}

			$content['content'] = $this->replaceLinks($content['content']);
			$parsed = $this->replaceUsers($content['content']);

			$content['content'] = $parsed['content'];
			$users = $parsed['users'];
		}

		$content = serialize($content);

		$query = $wpdb->prepare("INSERT INTO {$table} (type, user, content, game, date) VALUES (%s, %d, %s, %d, NOW())", $type, $userId, $content, $gameId);
		$wpdb->query($query);

		$activityId = $wpdb->insert_id;

		if(!empty($users)){

			$creator = get_user_by('id', $userId);
			$content = "{$creator->data->display_name} har nämnt dig i ett inlägg";

			foreach($users as $user) {

				$this->notification->create('feed', $activityId, $content, $user, $creator->ID);
			}
		}
	}

	function remove($activityId, $userId){

		global $wpdb;
		$table = "{$wpdb->prefix}activity";

		$query = "DELETE FROM {$table} WHERE id = {$activityId} AND user = {$userId}";
		$wpdb->query($query);
	}

	function replaceUsers($content){
		preg_match_all("/(@[a-zA-Z0-9-]+)/", $content, $matches);
		$users = null;

		if(!empty($matches)) {

			foreach($matches[0] as $match){
				$username = str_replace('@', '', $match);
				$user = get_user_by('slug', $username);

				if($user && $user->ID > 0) {
					$title = $user->data->display_name;
					$target = '_self';
					$url = $this->user->getUserLink($user->ID);

					$href = "<a href='{$url}' target='{$target}' title='{$title}'>{$title}</a>";

					$content = str_replace($match, $href, $content);
					$users[] = $user->ID;
				}
			}
		}

		return array('content' => $content, 'users' => $users);
	}

	function replaceLinks($content){
		preg_match("#((http|https|ftp)://(\S*?\.\S*?))(\s|\;|\)|\]|\[|\{|\}|,|\"|'|:|\<|$|\.\s)#ie", $content, $matches);

		if(!empty($matches)){
			$url = rtrim($matches[0], ' ');
			$postId = url_to_postid($url);

			$title = $url;
			$target = '_blank';

			if($postId){
				$post = get_post($postId);
				$title = $post->post_title;
				$target = '_self';
			}
			$href = "<a href='{$url}' target='{$target}' title='{$title}'>{$title}</a>";

			$content = str_replace($url, $href, $content);
		}

		return $content;
	}

	function comment($activityId, $userId, $comment) {
		global $wpdb;
		$table = "{$wpdb->prefix}activity_comment";

		$parsed = $this->replaceUsers($comment);

		$comment = $parsed['content'];
		$users = $parsed['users'];

		if(!empty($users)){

			$creator = get_user_by('id', $userId);
			$content = "{$creator->data->display_name} har nämnt dig i en kommentar";

			foreach($users as $user) {

				$this->notification->create('feed', $activityId, $content, $user, $creator->ID);
			}
		}

		$query = $wpdb->prepare("INSERT INTO {$table} (activity, user, comment, date) VALUES (%d, %d, %s, NOW())", $activityId, $userId, $comment);
		$wpdb->query($query);

		return $wpdb->insert_id;
	}

	function getComment($commentId) {
		global $wpdb;
		$table = "{$wpdb->prefix}activity_comment";

		$comment = $wpdb->get_row("SELECT * FROM {$table} WHERE id = $commentId");

		$comment->date = $this->post->formatDate($comment->date);
		$comment->user = get_user_by('id', $comment->user);
		$comment->comment = stripslashes($comment->comment);

		return $comment;
	}

	function getComments($activityId) {
		global $wpdb;
		$table = "{$wpdb->prefix}activity_comment";

		$comments = $wpdb->get_results("SELECT * FROM {$table} WHERE activity = $activityId ORDER BY date ASC");

		$comments = array_map(function($comment){
			$comment->date = $this->post->formatDate($comment->date);
			$comment->user = get_user_by('id', $comment->user);
			$comment->comment = stripslashes($comment->comment);

			return $comment;
		}, $comments);


		return $comments;
	}

	function get($id) {
		global $wpdb;
		$table = "{$wpdb->prefix}activity";

		$activity = $wpdb->get_row("SELECT * FROM {$table} WHERE id = {$id}");

		return $this->model($activity);
	}

	function getList($types, $userId = null, $limit = 10, $page = 1) {
		global $wpdb;
		$table = "{$wpdb->prefix}activity";

		$in = "";
		foreach($types as $type){
			$in .= "'$type',";
		}

		$in = rtrim($in, ",");

		$user = '';

		if($userId !== null){
			$user = "AND user = {$userId} ";
		}

		$offset = ($limit * ($page-1));

		$results = $wpdb->get_results("SELECT * FROM {$table} WHERE type IN ({$in}) {$user} ORDER BY date DESC LIMIT {$limit} OFFSET {$offset}");

		return array_map(function($activity) {
			return $this->model($activity);
		}, $results);
	}

	function model($activity){

		if($activity->type == 'feed'){
			$content = unserialize($activity->content);
			$activity->content = stripslashes($content['content']);
			$activity->content = nl2br($activity->content);

			$activity->youtube = null;

			if(!empty($content['youtube'])){
				$activity->youtube = $content['youtube'];
			}
		}
		$activity->date = $this->post->formatDate($activity->date);
		$activity->user = get_user_by('id', $activity->user);

		return $activity;
	}
}