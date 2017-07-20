<?php
	global $settings;
?>

<h3> Settings </h3>

<form method="post">

	<table class="form-table apple-news">
		<tbody>
			<tr>
				<th scope="row">Apple News API</th>
				<td>
					<fieldset>
						<label class="setting-container">
							<span class="label-name">Channel ID</span>
							<input type="text" id="api_channel" name="api_channel" value="<?= $settings->api_channel ?>" size="20" required="">
						</label>
						
						<br>
						
						<label class="setting-container">
							<span class="label-name">API Key ID</span>
							<input type="text" id="api_key" name="api_key" value="<?= $settings->api_key ?>" size="20" required="">
						</label>
						
						<br>
							
						<label class="setting-container">
							<span class="label-name">API Key Secret</span>
							<input type="password" id="api_secret" name="api_secret" value="<?= $settings->api_secret ?>" size="20" required="">
						</label>
						
						<br>

						<label class="setting-container">
							<span class="label-name">Site title</span>
							<input type="text" id="site_title" name="site_title" value="<?= stripslashes( $settings->site_title ) ?>" size="20" required="">
						</label>
						
						<br>
					
					</fieldset>
				</td>
			</tr>
		</tbody>
	</table>

	<table class="form-table apple-news">
		<tbody>
			<tr>
				<th scope="row">Post Types</th>
				<td>
					<fieldset>
						<label class="setting-container">
							<span class="label-name">Post Types</span>
							<?php 
								$post_types = get_post_types( array(
									'public' => true,
									'show_ui' => true,
								), 'objects' );
							?>
							<select id="publish_types" name="publish_types[]" multiple="multiple">
								<?php foreach ($post_types as $post_type) { ?>
									<option value="<?= $post_type->name ?>" <?= $settings->publish_types && in_array( $post_type->name, $settings->publish_types ) ? 'selected' : '' ?> ><?= $post_type->label ?></option>
								<?php } ?>
							</select>
						</label>
						
						<br>
						
						<label class="setting-container">
							<span class="label-name">Show a publish meta box on post types that have Apple News enabled.</span>
							<select id="show_publish_option" name="show_publish_option">
								<option value="yes" <?= $settings->show_publish_option == 'yes' ? 'selected' : '' ?> >yes</option>
								<option value="no" <?= $settings->show_publish_option == 'no' ? 'selected' : '' ?> >no</option>
							</select>
						</label>
						
						<br>
					
					</fieldset>
				</td>
			</tr>
		</tbody>
	</table>

	<input type="submit" id="submit" class="button button-primary" value="Save Changes">

</form>