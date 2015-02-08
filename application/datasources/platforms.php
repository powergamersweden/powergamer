<?php namespace SuperPowers\Datasource;

class Platforms extends SuperDatasource {

	function isGrouped() {
		return true;
	}

	function get() {
		if(empty($this->data))
		{
			$this->data = array(
				'Misc' => array(
					'pc'            => 'PC',
				),
				'Console' => array(
					'xbox360'       => 'Xbox 360',
					'xboxone'       => 'Xbox One',

					'ps3'           => 'Playstation 3',
					'ps4'           => 'Playstation 4',

					'nintendowii'   => 'Nintendo Wii',
					'nintendowiiu'  => 'Nintendo Wii U',
				),
				'Handheld' => array(
					'nintendo3ds'   => 'Nintendo 3DS',
					'nintendods'    => 'Nintendo DS',
				),
				'Phone' => array(
					'ios'           => 'Apple iOS',
					'android'       => 'Google Android'
				)
			);
		}

		return $this->data;
	}

}