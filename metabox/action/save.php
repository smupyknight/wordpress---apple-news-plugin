<?php
	add_action( 'save_post', 'save_publish_option', 10, 2 );

	function save_publish_option($id, $post) {
		update_post_meta( $id, 'bp_apple_news_auto_publish', $_POST['bp_apple_news_auto_publish'] );
	}