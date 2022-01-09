
<h1>Select Post Types to show favorites Feature</h1>
<form method="post" action=" <?php echo admin_url('admin-post.php') ?>">
	<?php
		wp_nonce_field("dom767_fav");

		//$posttypes = get_post_types();
		$posttypes = array('post','w2dc_listing', 'jobs', 'ajde_events', 'dompedia', 'announcement', 'knowledge_base');
		//var_dump(get_post_types());
		foreach ($posttypes as $posttype) {
		$obj = get_post_type_object( $posttype );
		$postTypeName = $obj->labels->singular_name;
		$show_favorites_cpt = get_option('show_favorites_cpt_'.$posttype);
		?>

		<div id="show_favorites_cpt_post-item" class="option-item ">
			<span class="tie-label"><?php echo$postTypeName ?></span>
			<input type="hidden" name="show_favorites_cpt_<?php echo $posttype ?>" value="0">
			<input id="show_favorites_cpt_<?php echo $posttype ?>" class="tie-js-switch" name="show_favorites_cpt_<?php echo $posttype ?>" type="checkbox" value="1" <?php  echo ($show_favorites_cpt == '1')? 'checked':'' ?> style="display: none" />
		</div>

		
		<?php
		}

	?>

	<input type="hidden" name="action" value="dom767_fav_admin_page">
	<?php 
		submit_button('Save') ;
	?>
</form>


<?php require_once plugin_dir_path( __FILE__ ) . 'post_total_fav_count_query.php'; ?>


