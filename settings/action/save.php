<?php
	if (!empty($_POST) && isset($_POST['api_channel'])) {
		update_option( 'bp-apple-news-settings', json_encode($_POST) );
	}