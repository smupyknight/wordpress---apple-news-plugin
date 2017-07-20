<?php

	require_once 'mime-builder.php';

	$mime_builder = new MIME_Builder;

	function sign( $url, $verb, $content = null ) {

		global $mime_builder, $settings;

		$current_date = date( 'c' );
		$request_info = $verb . $url . $current_date;
		if ( 'POST' === $verb ) {
			$content_type = 'multipart/form-data; boundary=' . $mime_builder->boundary();
			$request_info .= $content_type . $content;
		}

		$secret_key = base64_decode( $settings->api_secret );
		$hash       = hash_hmac( 'sha256', $request_info, $secret_key, true );
		$signature  = base64_encode( $hash );

		return 'HHMAC; key=' . $settings->api_key . '; signature=' . $signature . '; date=' . $current_date;
	}

	function do_publish( $id, $post ) {

		global $mime_builder, $settings;

		$article_id = get_post_meta( $id, 'apple_news_api_id', true );

		$article = generate_apple_news_format( $id, $post );
		$content = '';

		$meta = ['data' => ['revision' => '', 'accessoryText' => '<channel><title>W3Schools Home Page</title><link>https://www.w3schools.com</link></channel>'] ];
		if ( $article_id ) {
			$url = 'https://news-api.apple.com/articles/' . $article_id;
			
			$revision = get_post_meta( $id, 'apple_news_api_revision', true );
			$meta['data']['revision'] = $revision;
			
		} else {
			$url = 'https://news-api.apple.com/channels/' . $settings->api_channel . '/articles';
		}

		$content .= $mime_builder->add_metadata( $meta );
		$content .= $mime_builder->add_json_string( 'my_article', 'article.json', $article );
		$content .= $mime_builder->close();

		// Build the post request args
		$args = array(
			'headers' => array(
				'Authorization' => sign( $url, 'POST', $content ),
				'Content-Length' => strlen( $content ),
				'Content-Type' => 'multipart/form-data; boundary=' . $mime_builder->boundary(),
			),
			'body' => $content,
		);

		$default_args = apply_filters( 'apple_news_request_args', array(
			'timeout' => 30, // required because we need to package all images
			'reject_unsafe_urls' => true,
		) );

		// Allow filtering and merge with the default args
		$args = apply_filters( 'apple_news_post_args', wp_parse_args( $args, $default_args ), $post_id );

		// Perform the request
		$response = wp_safe_remote_post( esc_url_raw( $url ), $args );

		$result = json_decode( $response[ 'body' ] );
		update_post_meta( $id, 'apple_news_api_id', sanitize_text_field( $result->data->id ) );
		update_post_meta( $id, 'apple_news_api_created_at', sanitize_text_field( $result->data->createdAt ) );
		update_post_meta( $id, 'apple_news_api_modified_at', sanitize_text_field( $result->data->modifiedAt ) );
		update_post_meta( $id, 'apple_news_api_share_url', sanitize_text_field( $result->data->shareUrl ) );
		update_post_meta( $id, 'apple_news_api_revision', sanitize_text_field( $result->data->revision ) );
	}

	function do_delete( $id ) {

		if ( !( $article_id = get_post_meta( $id, 'apple_news_api_id', true ) ) ) {
			return;
		}

		$url = 'https://news-api.apple.com/articles/' . $article_id;

		// Build the delete request args
		$args = array(
			'headers' => array(
				'Authorization' => sign( $url, 'DELETE' ),
			),
			'method' => 'DELETE',
		);

		$default_args = apply_filters( 'apple_news_request_args', array(
			'timeout' => 30, // required because we need to package all images
			'reject_unsafe_urls' => true,
		) );

		// Allow filtering and merge with the default args
		$args = apply_filters( 'apple_news_delete_args', wp_parse_args( $args, $default_args ) );

		// Perform the delete
		$response = wp_safe_remote_request( esc_url_raw( $url ), $args );

		delete_post_meta( $id, 'apple_news_api_id' );
		delete_post_meta( $id, 'apple_news_api_created_at' );
		delete_post_meta( $id, 'apple_news_api_modified_at' );
		delete_post_meta( $id, 'apple_news_api_share_url' );
		delete_post_meta( $id, 'apple_news_api_revision' );
	}

	function perform_action( $id, $post ) {
		if ( get_post_meta( $id, 'bp_apple_news_auto_publish', true ) == 'yes' ) {
			do_publish( $id, $post );
		}
		else {
			do_delete( $id );
		}
	}

	add_action( 'save_post', 'perform_action', 20, 2 );
	add_action( 'before_delete_post', 'do_delete', 20, 2 );
