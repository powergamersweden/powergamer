<?php namespace SuperPowers\Composer;

class ReviewStars extends SuperComposer {

	function view($params = array()) {

		$style = '';

		if(empty($params['score'])) {
			if(array_key_exists('score', $params) && $params['score'] == null ){
				$style = 'empty';
			}
			$params['score'] = "0.0";
		}

		$stars = array();

		$score = floatval($params['score']);
		$int = (int)$params['score'];

		$diff = $score - $int;

		for($i = 0; $i < 5; $i++) {

			if($i < $int) {
				$stars[] = 'fill';
			} else if($diff > 0.4) {
				$stars[] = 'half';
				$diff = 0;
			} else {
				$stars[] = '';
			}
		}

		return array(
			"stars" => $stars,
			"style" => $style
		);
	}
}