<?php
	$settings = [
		'api_channel' 			=> 		'',
		'api_key' 				=> 		'',
		'api_secret' 			=> 		'',
		'site_title'			=>		'',
		'publish_types'			=>		[],
		'show_publish_option' 	=> 		'',
		'site_title'			=>		''
	];

	$settings = json_decode( get_option( 'bp-apple-news-settings', json_encode($settings) ) );