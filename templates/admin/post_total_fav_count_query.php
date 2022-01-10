<?php


if(is_user_logged_in()){

	$user_id        = get_current_user_id();
	$fav_post_query = post_total_fav_count_query();
  //$fav_total_post = count($fav_post_query);


  function post_total_fav_count_order_desc($a, $b) {
    if ($a['total_fav'] == $b['total_fav']) return 0;
    return ($a['total_fav'] > $b['total_fav']) ? -1 : 1;
  }
  usort($fav_post_query, "post_total_fav_count_order_desc");  


	?>
    <?php if ($fav_post_query): ?>
      <?php  
        $limit          = 20;
        $total_item     = count($fav_post_query);
        $total_pages    = ceil($total_item/$limit);  
        $fav_post_query = array_slice( $fav_post_query, 0, $limit ); 
      ?>
    <hr>
    <h1>Favorites Post List</h1>
    <h3>Total <?php echo $total_item ?> Posts Added To Favorites</h3>
    <div class="admin_fav_loadmore_loading_div" style="display: none">
      <img class="admin_fav_loadmore_loading_img" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/loading.gif" alt="" >
    </div>
    <table class="post_fav_count_admin_table">
      	<tr>
		 	    <th>Post title</th>
		      <th>Post Type</th>
		      <th>Total Favorite Count</th>
		    </tr>
        <?php foreach ($fav_post_query as $fav_post): ?>
          <?php 
            $post_id        = $fav_post['post_id'];
            $post_type      = $fav_post['postTypeName'];
            $post_title     = $fav_post['post_title'];
            $image_url      = $fav_post['image_url'];
            $post_permalink = $fav_post['post_permalink'];
            $total_fav      = $fav_post['total_fav'];
          ?>

          	<tr id="fav-<?php echo esc_attr($post_id); ?>" class="favs-list-item">
          		<td class="t-f-c-td"><?php echo $post_title ?></td>
              <td class="t-f-c-td"><?php echo $post_type ?></td>
			        <td class="t-f-c-td"><?php echo $total_fav ?></td>
            </tr>

        <?php endforeach ?>
    </table>



      <?php 
      echo "<br>";
      ?>
      <ul class="fav_admin_paginations_ul">
      <li class="fav_admin_paginations_pre" data-total_page="<?php echo $total_pages ?>" data-page="1" > << </li>
      <?php

      for( $i=1; $i<= $total_pages; $i++ ){
        if ($i<= 20) {
          echo '<li class="fav_admin_paginations" id="fav_admin_paginations'.$i.'" data-total_page="'. $total_pages .'" data-page="'.$i.'" >'. $i.'</li>';
        }
        if ($i == 21) {
          echo '<li class="fav_admin_paginations" id="fav_admin_paginations'.$i.'" data-total_page="'. $total_pages .'" data-page="'.$i.'" >'. '...'.'</li>';
        }
      }
      ?>
      <li class="fav_admin_paginations_next" data-total_page="<?php echo $total_pages ?>" data-page="1" > >> </li>
      </ul>
      <?php

      ?>


    <?php else: /// if no post found ?>
      <h4 class="no-note-xl">No Favourites Found</h4>
    <?php endif ?>
<?php
}/// end if user login
?>




