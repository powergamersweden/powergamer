<?php namespace SuperPowers;

class Video extends SuperObject {

	function getIdFromString($string){

		preg_match("/(youtu.be\/|youtube.com\/(watch\?(.*&)?v=|(embed|v)\/))([^\?&\"\'> ]+)/", $string, $matches);

		if(!empty($matches[5])){
			return $matches[5];
		}

		return null;
	}

	/**
	 * @param string $url
	 * @return null|string
	 */
	function parseUrl($url) {
		$parts = parse_url($url);
		parse_str($parts['query'], $query);

		if(!empty($query['v'])){
			return $query['v'];
		}

		return null;
	}

	function latestVideo(){

		$args = array(
			'post_type'      => 'video',
			'posts_per_page' => 1
		);

		$posts = get_posts( $args );

		return $posts[0];
	}

	function get($count = 5, $page = 1, $category = null, $search = null) {

		$args = array(
			'post_type'      => 'video',
			'posts_per_page' => $count,
			'paged'         => $page
		);

		if(!empty($category)) {
			$args['video-category'] = $category;
		}

		if(!empty($search)) {
			$args['s'] = $search;
		}

		$query = new \WP_Query($args);

		return $query;//$query->get_posts();
	}

	function getGameVideos($gameId, $count = 10, $page = 1) {

		global $wpdb;
		$table = "{$wpdb->prefix}video";

		$offset = $count*($page-1);

		$videos = $wpdb->get_results("SELECT videoId from {$table} WHERE gameId = {$gameId} LIMIT {$count} OFFSET {$offset}");

		$videos = array_map(function($video) { return $video->videoId; }, $videos);

		return $videos;
	}

	function saveVideoToGame($videoId, $gameId) {
		global $wpdb;
		$table = "{$wpdb->prefix}video";

		$query = $wpdb->prepare("INSERT INTO {$table} (videoId, gameId) VALUES (%d, %d) ON DUPLICATE KEY UPDATE gameId=values(gameId)", $videoId, $gameId);
		$wpdb->query($query);
	}

	function removeVideo($videoId){
		global $wpdb;
		$table = "{$wpdb->prefix}video";

		$query = $wpdb->prepare("DELETE FROM {$table} WHERE videoId = %d", $videoId);
		$wpdb->query($query);
	}

	function getCategories($videoPageId, $active = null) {
		$videoPage = get_permalink($videoPageId);
		$categories = get_terms(array('video-category'));

		return array_map(function($cat) use($videoPage, $active) {
			$active = ($cat->slug == $active);

			return array(
				'title' => $cat->name,
				'link'  => "{$videoPage}?category={$cat->slug}",
				'active' => $active
			);
		}, $categories);
	}

	function getPostCategories($postId) {
		$videoPage = $this->getPage();
		$videoPage = get_permalink($videoPage->ID);

		$categories = array_map(function($category) use($videoPage){
			return array(
				'title' => $category->name,
				'link'  => "{$videoPage}?category={$category->slug}"
			);
		}, wp_get_post_terms($postId, 'video-category'));

		return $categories;
	}

	/**
	 * @return null|\WP_Post
	 */
	function getPage() {
		return get_page_by_title('videos');
	}

}