<?php

	require_once 'action/save.php';
	require_once 'action/load.php';

	add_action( 'admin_menu', 'bp_apple_news_menu' );

	function bp_apple_news_menu() {
		add_menu_page( 'Apple News Settings', 'Apple News Settings', 'manage_options', 'bp-apple-news-options', 'bp_apple_news_options' );
	}

	function bp_apple_news_options() {
		if ( !current_user_can( 'manage_options' ) )  {
			wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
		}

		include_once 'view/page.php';
	}