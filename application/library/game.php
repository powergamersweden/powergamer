<?php namespace SuperPowers;

class Game extends SuperObject {

	function save($postId, $reviewId) {

		if(!empty($reviewId) && $reviewId != '-1') {
			global $wpdb;
			$table = "{$wpdb->prefix}game";

			$query = $wpdb->prepare("INSERT INTO {$table} (id, review) VALUES (%d, %d) ON DUPLICATE KEY UPDATE review=values(review)", $postId, $reviewId);
			$wpdb->query($query);
		}
	}

	function getUsers($gameId){
		global $wpdb;
		$table = "{$wpdb->prefix}subscriptions";

		$users = $wpdb->get_results("SELECT userId from {$table} WHERE gameId = {$gameId}");

		return array_map(function($user){
			return $user->userId;
		}, $users);
	}

	/**
	 * @param string $reviewId
	 * @return null|\WP_Post
	 */

	function getGameForReview($reviewId) {
		global $wpdb;
		$table = "{$wpdb->prefix}game";

		$game = $wpdb->get_var("SELECT id from {$table} WHERE review = {$reviewId}");

		if($game)
			return get_post($game);

		return null;
	}

	function getReviewForGame($gameId) {
		global $wpdb;
		$table = "{$wpdb->prefix}game";

		$review = $wpdb->get_var($wpdb->prepare("SELECT review from {$table} WHERE id = %d", $gameId));

		if($review)
			return get_post($review);

		return null;
	}

	function getScore($gameId){
		$review = $this->getReviewForGame($gameId);

		if($review) {
			return $this->property->getValue($review->ID, 'info', 'score');
		}

		return null;
	}

	function getTerms($gameId, $type) {
		$terms = wp_get_post_terms($gameId, $type);

		$termsArray = array();

		foreach($terms as $term) {
			$termsArray[] = array(
				'link' => get_term_link($term),
				'title' => $term->name
			);
		}

		return $termsArray;
	}

	function getTermsLinks($gameId, $type = 'genre'){
		$terms = $this->getTerms($gameId, $type);

		$string = '';

		foreach($terms as $term){
			$string .= "<a href='{$term['link']}'>{$term['title']}</a>, ";
		}

		$string = substr($string, 0, -2);

		return $string;
	}

	function getTermsString($gameId, $type = 'genre'){
		$terms = $this->getTerms($gameId, $type);

		$string = '';

		foreach($terms as $term){
			$string .= "{$term['title']}, ";
		}

		$string = substr($string, 0, -2);

		return $string;
	}

	function getSimilarGames($gameId){

		$terms = wp_get_post_terms($gameId, 'tag');

		$tax_query = array(
			'relation' => 'OR'
		);

		foreach($terms as $term) {
			$tax_query[] = array(
				'taxonomy'  => 'tag',
				'field'     => 'slug',
				'terms'     => $term->slug
			);
		}

		$args = array(
			'post_type'      => 'game',
			'exclude'        => $gameId,
			'tax_query'      => $tax_query,
			'posts_per_page' => 5
		);

		$posts = get_posts( $args );

		return $posts;
	}

	function boxart($gameId, $size = 'default') {

		$boxart = $this->property->getValue($gameId, 'settings', 'boxart', array('size' => $size, 'fit' => false, 'constrain' => 'width'));

		if(empty($boxart)){
			$boxart = get_template_directory_uri() . '/assets/build/images/boxart-replacement.jpg';
		}

		return $boxart;
	}

	function newsImage($gameId){

		$boxart = $this->property->getValue($gameId, 'settings', 'boxart', array('size' => 'thumbnail'));

		return $boxart;
	}

	function format(Array $games) {

		return array_map(function($post) {
			$post = get_post($post);
			return array(
				'title'     => $post->post_title,
				'link'      => get_permalink($post->ID),
				'image'     => $this->boxart($post->ID),
				'content'   => strip_tags($this->post->content($post->ID, 200)),
				'date'      => $this->post->date($post->ID),
				'type'      => $post->post_type
			);
		}, $games);
	}
}