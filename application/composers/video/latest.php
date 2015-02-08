<?php namespace SuperPowers\Composer;

class VideoLatest extends SuperComposer {
	function view($params = array())
	{
		$slug = null;
		$category = null;

		if(!empty($params['postId'])) {
			$categories = wp_get_post_terms($params['postId'], 'video-category');
			if(!empty($categories)) {
				$slug = $categories[0]->slug;
				$category = $categories[0]->name;
			}
		}

		/** @var \WP_Query $query */
		$query = $this->video->get(5, 1, $slug);
		$videoPage = $this->video->getPage();

		$more = get_permalink($videoPage->ID);

		if($slug) {
			$more = add_query_arg('category', $slug, $more) . '#videos';
		}

		return array(
			'posts' => $this->news->format($query->get_posts()),
			'more'  => $more,
			'title' => !empty($category)?"Senaste {$category}":null
		);
	}
}