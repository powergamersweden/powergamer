<?php namespace SuperPowers;

class Menu extends SuperObject {

	function getMain(){

		$pages = get_pages(array(
			'exclude' => array($this->frontpage())
		));

		return $this->format($pages);
	}

	function format(Array $pages){

		return array_map(function($page) {
			return array(
				'title' => $page->post_title,
				'link'  => get_permalink($page->ID)
			);
		}, $pages);
	}

	function frontpage() {
		return get_option('page_on_front');
	}

	function homeUrl() {
		return get_home_url();
	}
}