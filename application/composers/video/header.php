<?php namespace SuperPowers\Composer;

class VideoHeader extends SuperComposer {

	function view($params = array())
	{
		$postId = $params['postId'];
		$youtubeUrl = $this->property->getValue($postId, 'info', 'url');
		$id = $this->video->parseUrl($youtubeUrl);

		$background = "http://img.youtube.com/vi/{$id}/maxresdefault.jpg";
		$image = "http://img.youtube.com/vi/{$id}/maxresdefault.jpg";
		$title = !empty($params['title'])?$params['title']:'';
		$link = !empty($title)?get_permalink($postId):'';

		return array(
			'videoId'       => $id,
			'background'    => $background,
			'image'         => $image,
			'title'         => $title,
			'link'         => $link
		);
	}
}