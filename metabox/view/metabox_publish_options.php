<div id="apple-news-publish-options">
	<span> Publish to apple news </span>
	<select id="auto_publish" name="bp_apple_news_auto_publish">
		<option value="yes" <?= $bp_apple_news_auto_publish == 'yes' ? 'selected' : ''; ?> > yes </option>
		<option value="no" <?= $bp_apple_news_auto_publish != 'yes' ? 'selected' : ''; ?> > no </option>
	</select>
</div>