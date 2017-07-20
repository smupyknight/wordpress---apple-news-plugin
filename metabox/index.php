<?php

	require_once 'action/save.php';

	if ( $settings->show_publish_option === 'yes' ) {
		$publish_types = $settings->publish_types;
		if ( ! is_array( $publish_types) ) {
			$publish_types = array( $publish_types );
		}

		foreach ( $publish_types as $publish_type ) {
			add_action( 'add_meta_boxes_' . $publish_type, 'add_publish_options_meta_box' );
		}
	}

	// Publish options meta box
	function add_publish_options_meta_box( $post ) {
		add_meta_box(
			'publish_option',
			__( 'Apple News', 'apple-news' ),
			'publish_options_meta_box',
			$post->post_type,
			apply_filters( 'apple_news_publish_meta_box_context', 'side' ),
			apply_filters( 'apple_news_publish_meta_box_priority', 'high' )
		);
	}

	function publish_options_meta_box( $post ) {
		$bp_apple_news_auto_publish = get_post_meta( $post->ID, 'bp_apple_news_auto_publish', true );
		require_once 'view/metabox_publish_options.php';
	}