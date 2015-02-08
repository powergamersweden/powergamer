<?php return array(
	"page"  => array(
		"id" => "page",
		"label" => "Page",
		"subtypes" => array(
			"front" => array(
				"id" => "front",
				"label" => "Front"
			),
			"video" => array(
				"id" => "video",
				"label" => "Video archive"
			),
			"community" => array(
				"id" => "community",
				"label" => "Community feed"
			)
		)
	),
	"game" => array(
		"id" => "game",
		"label" => "Game",
		"menu_icon" => "dashicons-shield",
		"taxonomy" => array(

			array(
				'id' => 'platform',
				'label' => 'Platform'
			),
			array(
				'id' => 'genre',
				'label' => 'Genre'
			),
			array(
				'id' => 'publisher',
				'label' => 'Publisher'
			),
			array(
				'id' => 'developer',
				'label' => 'Developer'
			),
			array(
				'id' => 'tag',
				'label' => 'Tag'
			),
		)
	),
	"review" => array(
		"id"        => "review",
		"label"     => "Review",
		"menu_icon" => "dashicons-star-filled",
	),
	"video" => array(
		"id" => "video",
		"label" => "Video",
		"menu_icon" => "dashicons-video-alt3",
		"taxonomy" => array(
			array(
				"id" => 'tag',
				"label" => "Tag"
			),
			array(
				"id" => "video-category",
				"label" => "Category"
			)
		)
	),
	"news" => array(
		"id"   => "news",
		"label"  => "News",
		"taxonomy" => array(
			array(
				'id' => 'tag',
				'label' => 'Tag'
			),
		)
	)
);