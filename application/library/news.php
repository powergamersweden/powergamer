<?php namespace SuperPowers;

class News extends SuperObject {

	function recent($count = 40, $page = 1){
		$args = array(
			'post_type'      => array('review'),//array('news','podcast', 'review', 'article','hardware','video'),
			'posts_per_page' => $count,
			'offset'         => ($count * ($page-1))
		);

		$posts = get_posts( $args );

		return $posts;
	}

	function getGameNews($gameId, $count = 10, $page = 1){

		$posts = $this->getGamePosts($gameId, array('news'), $count, $page);

		return $posts;
	}

	function getGameRecent($gameId, $count = 10, $page = 1){

		$posts = $this->getGamePosts($gameId, array('news','podcast','article','hardware'), $count, $page );

		$videos = $this->video->getGameVideos($gameId, $count, $page);

		$posts = array_map(function($post){ return $post->ID; }, $posts);

		$posts = array_merge($posts, $videos);

		if(empty($posts))
			return array();

		$posts = get_posts(array(
			'post__in' => $posts,
			'post_type' => array('news','podcast','article','hardware','video')
		));

		return $posts;
	}

	function getGameVideos($gameId, $count = 10, $page = 1){

		$posts = $this->getGamePosts($gameId, array('video'), $count, $page);

		return $posts;
	}

	function getGamePosts($gameId, $types = array('news'), $count = 10, $page = 1){

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
			'post_type'      => $types,
			'tax_query'      => $tax_query,
			'posts_per_page' => $count,
			'offset'         => ($count * ($page-1))
		);

		$posts = get_posts( $args );

		return $posts;
	}

	function format(Array $posts, $type = 'news'){
		return array_map(function($post) use ($type){
			$post = get_post($post);

			$title = $post->post_title;

			if($post->post_type == 'review'){
				$title = "Recension: {$title}";
			}

			return array(
				'title'     => $title,
				'link'      => get_permalink($post->ID),
				'image'     => $this->getThumbnail($post->ID),
				'content'   => strip_tags($this->post->content($post->ID, 200)),
				'date'      => $this->post->date($post->ID),
				'type'      => $post->post_type
			);
		}, $posts);
	}

	function getThumbnail($postId) {

		$image = $this->property->getValue($postId, 'info', 'image');

		if(empty($image)){
			$post = get_post($postId);
			if($post->post_type == 'video'){
				$youtubeId = $this->property->getValue($post->ID, 'info', 'url');
				$youtubeId = $this->video->parseUrl($youtubeId);
				$url = "http://img.youtube.com/vi/{$youtubeId}/0.jpg";


				$base = wp_upload_dir();

				$path = "{$base['basedir']}/download/{$youtubeId}.jpg";
				$dest = "{$base['basedir']}/download/generated/{$youtubeId}.jpg";

				if(!file_exists($dest)){
					$this->cache->ensureStructure($path);

					$imageContent = file_get_contents($url);

					file_put_contents($path, $imageContent);

					$def = $this->definition->property('video', null, 'info', 'image');

					$size = explode('x',$def['size']['default']);
					$this->image->create($path, $dest, $size[0], $size[1]);

				}

				$image = "{$base['baseurl']}/download/generated/{$youtubeId}.jpg";
			} else if($post->post_type == 'review'){
				$game = $this->game->getGameForReview($postId);

				$image = $this->game->newsImage($game->ID, 'small');
			}
		}

		return $image;

	}

}