
<h1>Options Page</h1>
<form method="post" action=" <?php echo admin_url('admin-post.php') ?>">
	<?php
		wp_nonce_field("dom767_fav");
		$dom767_fav_longitude = get_option('dom767_fav_longitude2');
	?>

	<label for="dom767_fav_longitude2" > <?php _e('DOM767 Test text', 'dom767_fav'); ?> </label>
	<input type="text" name="dom767_fav_longitude2" id="dom767_fav_longitude2" value="<?php echo esc_attr($dom767_fav_longitude) ?>">
	<input type="hidden" name="action" value="dom767_fav_admin_page">
	<?php 
		submit_button('Save') ;
	?>
</form>
