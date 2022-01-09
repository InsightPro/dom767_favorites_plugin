<?php
/**
 * Template Name: All Favourites 1
 *
 *
 */
defined( 'ABSPATH' ) || exit; // Exit if accessed directly
get_header(); ?>

<?php
if(is_user_logged_in()){
  $user_id        = get_current_user_id();
  $fav_post_query = all_fav_page_post_query();  
  ?>


  <div class="all-favs-wrapper">
    <div class="other-page-titles">
      <h3>- all -</h3><h2>Favourites</h2><h4>Lists</h4>
    </div>

    <?php if ($fav_post_query): ?>
      <?php  
        $limit          = 16;
        $total_item     = count($fav_post_query);
        $total_pages    = ceil($total_item/$limit);  
        $fav_post_query = array_slice( $fav_post_query, 0, $limit ); 
      ?>
      <ul class="favs-list-group">
        <?php foreach ($fav_post_query as $fav_post): ?>
          <?php 
            $post_id        = $fav_post['post_id'];
            $post_type      = $fav_post['postTypeName'];
            $post_title     = $fav_post['post_title'];
            $image_url      = $fav_post['image_url'];
            $post_permalink = $fav_post['post_permalink'];
          ?>

          <li id="fav-<?php echo esc_attr($post_id); ?>" class="favs-list-item">

              <?php if(!empty($image_url)) : ?>
                <div class="favs-item-img" style="background: url('<?php echo $image_url; ?>');"></div>
              <?php else : ?>
                <div class="favs-item-img">
                  <i class="fal fa-image" style="font-size: 70px; color: #a7bbc7;"></i>
                </div>
              <?php endif;?>

            <div  class="dropdown__items--list--item-txt">
              <h3><a href="<?php echo $post_permalink ?>" title="<?php echo $post_title; ?>"><?php echo $post_title; ?></a></h3>
              <p>
                <?php
                 echo $post_type;
                ?>
                
              </p>
            </div>

            <div class="fav_page_list_delete_wrap">
              <span class="fav_delete_btn" data-id="<?php echo $post_id; ?>" data-user-id="<?php echo $user_id; ?>" data-post_type="<?php echo get_post_type(get_the_ID()) ?>" >
                <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" color="#aaa"><path d="M0 0h24v24H0z" fill="none"></path><path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"></path></svg>
                
              </span>
                <img class="fav_click_del_loading_spinner" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/fav_loder.gif" alt="">
            </div>

          </li>
        <?php endforeach ?>
      </ul>
      <?php if ($total_item >= 16): ?>
        <div class="all_fav_list_loadmore_btn btn" id="all_fav_list_loadmore_btn_id" data-page="1" data-total_page="<?php echo $total_pages ?>">
          <p>Load More Fav List</p>
          <img class="fav_loadmore_loading_img" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/loading.gif" alt="">

        </div> 

      <?php endif ?>
    <?php else: /// if no post found ?>
      <h4 class="no-note-xl">No Favourites Found</h4>
    <?php endif ?>


  </div>
<?php
}else{/// if user not login
  wp_redirect( home_url() ); exit; 
}
?>
<?php get_footer(); ?>