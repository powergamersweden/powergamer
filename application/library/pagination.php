<?php namespace SuperPowers;

class Pagination extends SuperObject {


	function create(\WP_Query $query, $url){

		$buttons = array();

		if($query->max_num_pages == 1){
			return $buttons;
		}

		// Prev button
		$buttons[] = $this->createButton('&laquo;', add_query_arg('page', $query->query_vars['paged']-1, $url), ($query->query_vars['paged'] == 1)?'inactive':'');

		$current = $query->query_vars['paged'];
		$max = $query->max_num_pages;
		$offset = 2;

		for($i = 0; $i < $query->max_num_pages; $i++) {

			$pageNum = $i + 1;
			$isCurrent = ($pageNum == $query->query_vars['paged']);
			$button = $this->createButton($pageNum, add_query_arg('page', $pageNum, $url), $isCurrent?'active':'');

			if(!$isCurrent && $query->max_num_pages > 6){


				if($max - $current <= $offset) {
					$offset = 2 + (2 - ($max-$current));
				} else if($current <= 2) {
					$offset = 2 + (3 - $current);
				}

				if($pageNum < $current && ($current - $pageNum) <= $offset ) {
					$buttons[] = $button;
				}
				else if($pageNum > $current && ($pageNum - $current) <= $offset ){
					$buttons[] = $button;
				}
			} else {
				$buttons[] = $button;
			}


		}

		// Next button
		$buttons[] = $this->createButton('&raquo;', add_query_arg('page', $query->query_vars['paged']+1, $url), ($query->max_num_pages == $query->query_vars['paged'])?'inactive':'');

		return $buttons;
	}

	function createButton($title, $link, $class = ''){
		return array(
			'class'  => $class,
			'title'  => $title,
			'link'   => $link
		);
	}
}