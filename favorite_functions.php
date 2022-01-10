<?php 


////////////////////////////////////////////////////////////////////
////////////shortcode for fav wrap bookmark icon //////////////////
////////////////////////////////////////////////////////////////////

function fav_wrap_bookmark_icon_shortcode($post_id) {
    if (is_array($post_id)) {
        echo get_fav_wrap_bookmark_icon($post_id['post_id']);
    }else{
        echo get_fav_wrap_bookmark_icon(get_the_ID());
    }
    return ;
}
add_shortcode( 'fav_wrap_bookmark_shortcode', 'fav_wrap_bookmark_icon_shortcode' );
//// print like //echo do_shortcode('[fav_wrap_bookmark_shortcode post_id="'.get_the_ID().'"]');


////////////////////////////////////////////////////////////////////
////////////shortcode fav wrap heart icon //////////////////////////
////////////////////////////////////////////////////////////////////

function fav_wrap_heart_icon_shortcode($post_id) {
    if (is_array($post_id)) {
        echo get_fav_wrap_heart_icon($post_id['post_id']);
    }else{
        echo get_fav_wrap_heart_icon(get_the_ID()); 
    }
    return ;
}
add_shortcode( 'fav_wrap_heart_shortcode', 'fav_wrap_heart_icon_shortcode' );
//// print like //echo do_shortcode('[fav_wrap_heart_shortcode post_id="'.get_the_ID().'"]');

////////////////////////////////////////////////////////////////////
////////////function for fav wrap bookmark icon ////////////////////
////////////////////////////////////////////////////////////////////

function get_fav_wrap_bookmark_icon($post_id) {

    $posttype = get_post_type($post_id); /// get post type by Id
    //if(dom767_get_option('show_favorites_cpt_'.$posttype) ){
    if(get_option('show_favorites_cpt_'.$posttype) ){

        if ( is_user_logged_in() ) {/// if user login

            $user_id        = get_current_user_id();/// get login user ID
            $user_meta      = get_user_meta($user_id, 'user_fav_listing', true)?get_user_meta($user_id,              'user_fav_listing', true):''; /// get fav list
            $fav_list_arr   = ($user_meta) ? json_decode($user_meta, true) : array();/// string to array

        }else{/// if user not login
            
            $get_fav_cookies    = isset( $_COOKIE['favorite_cookies'] ) ? $_COOKIE['favorite_cookies'] : '';
            $fav_list_arr       = explode(",",$get_fav_cookies);///string to array

        }/// end if user not login

        $wrap_div = '<div class="favs-icon-wrap addOrRemoveFavClass addOrRemoveFavClass_'. $post_id .' bookmark_icon" id="addOrRemoveFavId'. $post_id .'" data-post_id="'. $post_id .'" data-post_type="'. $posttype .'" data-userid="'.get_current_user_id() .'" >';

        $fav_popup ='<div class="noneuserpopupbox"> As a guest user you are allowed to make maximum 7 Favourite CPTs.</br><button class="btn noneuserpopupbox_ok" type="button">OK</button></div>';

        $loader_img = '<img class="fav_click_loader_spinner" src="'. get_stylesheet_directory_uri().'/assets/images/fav_loder.gif" alt="">';

        $fav_f = '<span class="fav-icon-info-text">Remove from Favorites</span>
                 <svg class="svg-inline--fa fa-bookmark fa-w-12" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="bookmark" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" data-fa-i2svg=""><path fill="currentColor" d="M384 48V512l-192-112L0 512V48C0 21.5 21.5 0 48 0h288C362.5 0 384 21.5 384 48z"></path></svg>';

        $fav_o = '<span class="fav-icon-info-text">Add to Favorites</span>
                 <svg class="svg-inline--fa fa-bookmark fa-w-12" aria-hidden="true" focusable="false" data-prefix="far" data-icon="bookmark" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" data-fa-i2svg=""><path fill="currentColor" d="M336 0h-288C21.49 0 0 21.49 0 48v431.9c0 24.7 26.79 40.08 48.12 27.64L192 423.6l143.9 83.93C357.2 519.1 384 504.6 384 479.9V48C384 21.49 362.5 0 336 0zM336 452L192 368l-144 84V54C48 50.63 50.63 48 53.1 48h276C333.4 48 336 50.63 336 54V452z"></path></svg>';

        $wrap_end = '</div>'; /// end wrap div

        if (in_array($post_id, $fav_list_arr)) { /// if the post in fav list
            $fav_icon = $fav_f; /// blank icon
        }else{/// if the post not in fav list
            $fav_icon = $fav_o;/// full icon
        }/// end if the post not in fav list

        if ( is_user_logged_in() ) {
            $full_wrap = $wrap_div.$fav_icon.$loader_img.$wrap_end; /// join div
        }else{
            $full_wrap = $wrap_div.$fav_popup.$fav_icon.$loader_img.$wrap_end; /// join div
        }


        return $full_wrap;
    }

} /////get_fav_wrap_bookmark_icon($post_id)/////


////////////////////////////////////////////////////////////////////
///////////////function for fav wrap heart icon ////////////////////
////////////////////////////////////////////////////////////////////

function get_fav_wrap_heart_icon($post_id) {

    $posttype = get_post_type($post_id); /// get post type by Id
    //if(dom767_get_option('show_favorites_cpt_'.$posttype) ){
    if(get_option('show_favorites_cpt_'.$posttype) ){

        if ( is_user_logged_in() ) {/// if user login

            $user_id        = get_current_user_id();/// get login user ID
            $user_meta      = get_user_meta($user_id, 'user_fav_listing', true)?get_user_meta($user_id,              'user_fav_listing', true):''; /// get fav list
            $fav_list_arr   = ($user_meta) ? json_decode($user_meta, true) : array();/// string to array

        }else{/// if user not login
            
            $get_fav_cookies 	= isset( $_COOKIE['favorite_cookies'] ) ? $_COOKIE['favorite_cookies'] : '';
            $fav_list_arr 		= explode(",",$get_fav_cookies);///string to array

        }/// end if user not login

        $wrap_div = '<div class="favs-icon-wrap addOrRemoveFavClass addOrRemoveFavClass_'. $post_id .'" id="addOrRemoveFavId'. $post_id .'" data-post_id="'. $post_id .'" data-post_type="'. $posttype .'"  data-userid="'.get_current_user_id() .'" >';

        $fav_popup ='<div class="noneuserpopupbox"> As a guest user you are allowed to make maximum 7 Favourite CPTs.</br><button class="btn noneuserpopupbox_ok" type="button">OK</button></div>';

        $loader_img = '<img class="fav_click_loader_spinner" src="'. get_stylesheet_directory_uri().'/assets/images/fav_loder.gif" alt="">';

        $fav_f = '<span class="fav-icon-info-text">Remove from Favorites</span>
                 <svg class="svg-inline--fa fa-heart fa-w-16 fav-icon" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="heart" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M472.1 270.5l-193.1 199.7c-12.64 13.07-33.27 13.08-45.91 .0107l-193.2-199.7C-16.21 212.5-13.1 116.7 49.04 62.86C103.3 15.88 186.4 24.42 236.3 75.98l19.7 20.27l19.7-20.27c49.95-51.56 132.1-60.1 187.3-13.12C525.1 116.6 528.2 212.5 472.1 270.5z"></path></svg>';

        $fav_o = '<span class="fav-icon-info-text">Add to Favorites</span>
                 <svg class="svg-inline--fa fa-heart fa-w-16 fav-icon" aria-hidden="true" focusable="false" data-prefix="far" data-icon="heart" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M462.1 62.86C438.8 41.92 408.9 31.1 378.7 32c-37.49 0-75.33 15.4-103 43.98l-19.7 20.27l-19.7-20.27C208.6 47.4 170.8 32 133.3 32C103.1 32 73.23 41.93 49.04 62.86c-62.14 53.79-65.25 149.7-9.23 207.6l193.2 199.7C239.4 476.7 247.6 480 255.9 480c8.332 0 16.69-3.267 23.01-9.804l193.1-199.7C528.2 212.5 525.1 116.6 462.1 62.86zM437.6 237.1l-181.6 187.8L74.34 237.1C42.1 203.8 34.46 138.1 80.46 99.15c39.9-34.54 94.59-17.5 121.4 10.17l54.17 55.92l54.16-55.92c26.42-27.27 81.26-44.89 121.4-10.17C477.1 138.6 470.5 203.1 437.6 237.1z"></path></svg>';

        $wrap_end = '</div>'; /// end wrap div

        if (in_array($post_id, $fav_list_arr)) { /// if the post in fav list
            $fav_icon = $fav_f; /// blank icon
        }else{/// if the post not in fav list
            $fav_icon = $fav_o;/// full icon
        }/// end if the post not in fav list

        if ( is_user_logged_in() ) {
            $full_wrap = $wrap_div.$fav_icon.$loader_img.$wrap_end; /// join div
        }else{
            $full_wrap = $wrap_div.$fav_popup.$fav_icon.$loader_img.$wrap_end; /// join div
        }

        return $full_wrap;
        
    }

} /////get_fav_wrap_heart_icon($post_id)/////


/////////////////////////////////////////////////////////////////////////////////////////
///////////////////// when click on Fav Icon or Delete icon /////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////

add_action( 'wp_ajax_header_fav_list_temp', 'ajax_header_fav_list_temp' );
add_action( 'wp_ajax_nopriv_header_fav_list_temp', 'ajax_header_fav_list_temp' );

function ajax_header_fav_list_temp() {

    ob_start();
    global $wpdb;
    $i = 1;

    if ( is_user_logged_in() ) { /// if user logged in

        $post_id      = isset( $_POST['post_id'] ) ? $_POST['post_id'] : '';///clicked post id
        $post_id      = (int)$post_id;
        $user_id      = get_current_user_id(); /// loged in user ID
        $get_Meta     = get_user_meta( $user_id, 'user_fav_listing', true ) ? get_user_meta( $user_id,            'user_fav_listing', true ):'[]';///logedin user fav meta
        $fav_listing  = [];
        $fav_listing  = (json_decode( $get_Meta, true ) != NULL)? json_decode( $get_Meta, true ):[];
                        /// fav meta convert to array 
        $ex_fav_count = count($fav_listing); /// count total fav listing before click
		$items        = -1; /// set post par page limit
        $test = '';

        /*----------------- get each post total fav count on post meta ---------------*/
        if ( metadata_exists( 'post', $post_id, 'total_fav_listing' ) ) {
            $this_post_fav_total = get_post_meta( $post_id, 'total_fav_listing', true );
            $this_post_fav_total = ($this_post_fav_total != '' )? $this_post_fav_total : '0';
            $this_post_fav_total = (int)$this_post_fav_total;
        }else{
            $this_post_fav_total = 0;
        }
        /*----------------- end each post total fav count on post meta ---------------*/

        /*=====================================================================================*/
        if ( in_array( $post_id, $fav_listing ) ) { /// if post id alrady exists in fav
            $fav_listing = array_diff($fav_listing, array($post_id)); /// removed id from listing
            $this_post_fav_total = ($this_post_fav_total != 0)? $this_post_fav_total - 1 : 0; /// Reduce each post total fav count
        }else{  /// if post id not exists in fav
            array_push($fav_listing, $post_id); /// add item id in fav list array
            $this_post_fav_total = $this_post_fav_total + 1 ; /// increase each post total fav count
        }
        /*=====================================================================================*/

        /*---------------------- update fav listing on user meta -------------------------*/
        if (metadata_exists('user', $user_id, 'user_fav_listing')){  ///if meta key exists
            if (update_user_meta($user_id, "user_fav_listing", json_encode($fav_listing))){///if updated
        		if(is_array( $fav_listing )){
        		  $fav_post_ids_arr = array_values( $fav_listing );
        		  $fav_post_ids_arr = array_reverse($fav_post_ids_arr); /// Reverse array
                  $post_count       = count($fav_post_ids_arr);
        		}
            }
        }else{///if meta key not exists
            if (add_user_meta( $user_id, 'user_fav_listing', json_encode($fav_listing))){///if added

                if(is_array( $fav_listing )){
                  $fav_post_ids_arr = array_values( $fav_listing );
                  $fav_post_ids_arr = array_reverse($fav_post_ids_arr);///Reverse array
                  $post_count       = count($fav_post_ids_arr);
                }
            } 
        }/// end if ///
        /*-------------------- end update fav listing on user meta ----------------------*/

        /*-------------- update each post total fav count on post meta ------------------*/
        if ( metadata_exists( 'post', $post_id, 'total_fav_listing' ) ) {
            update_post_meta( $post_id, 'total_fav_listing', $this_post_fav_total );
        }else{
            add_post_meta( $post_id, 'total_fav_listing', $this_post_fav_total );
        }
        /*-------------- end update each post total fav count on post meta ---------------*/



    }else { /// if user not logged in ////

        $post_id      = isset( $_POST['post_id'] ) ? $_POST['post_id'] : '';///clicked post id
        $post_id      = (int)$post_id;
        $cookie_array = isset( $_COOKIE['favorite_cookies'] ) ? $_COOKIE['favorite_cookies'] : '';
        $fav_listing  = ($cookie_array != '') ? explode( ',', $cookie_array ) : [];
        $ex_cookies   = isset( $_POST['ex_cookies'] ) ? $_POST['ex_cookies'] : '';///past cookies
        $ex_fav_count = isset( $_POST['ex_fav_count'] ) ? $_POST['ex_fav_count'] : 0;
        $items        = 7; /// set post par page limit

        if ( is_array( $fav_listing ) ) {
            $fav_post_ids_arr = array_values( $fav_listing );
            $fav_post_ids_arr = array_reverse($fav_post_ids_arr); /// Reverse array last to 1st
            $post_count       = count($fav_post_ids_arr);
		}

        /*----------------- get each post total fav count on post meta ---------------*/
        if (metadata_exists('post', $post_id, 'total_fav_listing')){ /// if meta key exists
            $this_post_fav_total = get_post_meta( $post_id, 'total_fav_listing', true );
            $this_post_fav_total = ($this_post_fav_total != '' )? $this_post_fav_total : '0';
            $this_post_fav_total = (int)$this_post_fav_total;/// string to integer
        }else{ ///if meta key not exists
            $this_post_fav_total = 0;
        } /// end if

        if ( in_array( $post_id, $ex_cookies ) ) {
            $this_post_fav_total = ($this_post_fav_total != 0)? $this_post_fav_total - 1 : 0;///Reduce each post total fav
        }else{
            $this_post_fav_total = $this_post_fav_total + 1 ; /// increase each post total fav count
        }
        /*----------------- end each post total fav count on post meta ------------------*/

        /*-------------- update each post total fav count on post meta ------------------*/
        if ( metadata_exists( 'post', $post_id, 'total_fav_listing' ) ) {
            update_post_meta( $post_id, 'total_fav_listing', $this_post_fav_total );
        }else{
            add_post_meta( $post_id, 'total_fav_listing', $this_post_fav_total );
        }
        /*-------------- end update each post total fav count on post meta ---------------*/
    }/// end if user not logged in ////
    /***************************************************************************************/

    /*-------------- post query array -----------------*/
    if ( !empty( $fav_post_ids_arr ) ) { /// if there is some post in fav listing

        $total_item     = count($fav_post_ids_arr);
        $total_pages    = ceil($total_item/10);

      	$array_posts_type = array('post', 'jobs', 'w2dc_listing', 'announcement','ajde_events', 'knowledge_base', 'dompedia');
     	$args = array(
        'post_type'      => $array_posts_type,
        'orderby'        => 'post__in',
        'post__in'       => $fav_post_ids_arr,
        'posts_per_page' => $items,
      	);
    }else { /// if there is no post in fav listing
      	$args = array();
    }
    /*-------------- end post query array ---------------*/

    $query = new WP_Query( $args );
 
    if($query->have_posts()):
		while( $query->have_posts() ) : $query->the_post();
			?>
			<li class="fav-<?php echo esc_attr(get_the_ID()); ?>">
              <a class="item__overlay" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"></a>
              <div class="dropdown__items--list--item">
                <div class="dropdown__items--list--item-img">
                    <?php 
                    $image_url = '';
                    if (has_post_thumbnail()) {
                        $src = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );
                        $image_url  = aq_resize($src[0], 100, 100, true);
                    }elseif(get_post_type(get_the_ID()) == 'jobs') {
                        $companies_name = get_the_terms( get_the_ID(), 'company_tax' );
                        $t_id           = $companies_name[0]->term_id;
                        $term_meta      = get_term_meta( $t_id, 'company_term_meta', true );
                        $image_url      = aq_resize($term_meta['company_logo'], 100, 100, true);
                    }
                    ?>
                    <?php if(!empty($image_url)) : ?>
                    <img src="<?php echo $image_url; ?>" alt="">
                    <?php else : ?>
                    <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" color="#000"><path fill="none" d="M0 0h24v24H0z"></path><path d="M21.9 21.9l-8.49-8.49-9.82-9.82L2.1 2.1.69 3.51 3 5.83V19c0 1.1.9 2 2 2h13.17l2.31 2.31 1.42-1.41zM5 18l3.5-4.5 2.5 3.01L12.17 15l3 3H5zm16 .17L5.83 3H19c1.1 0 2 .9 2 2v13.17z"></path></svg>
                  <?php endif;?>
                </div>
                <div class="dropdown__items--list--item-txt">
                  <h3><?php the_title(); ?></h3>
                  <p>
                    <?php
                        //$post_type = get_post_type(get_the_ID());
                        //echo get_cpt_name($post_type);
                        $post_type = get_post_type_object(get_post_type(get_the_ID()))->label;
                        echo ($post_type  == 'Posts')? "News": $post_type;
                    ?>
                  </p>
                </div>
                <div class="fav_list_delete_wrap">
                  <span class="fav_delete_btn" data-post_type="<?php echo get_post_type(get_the_ID()) ?>" data-id="<?php echo get_the_ID(); ?>" data-user-id="<?php echo get_current_user_id(); ?>">
                    <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" color="#aaa"><path d="M0 0h24v24H0z" fill="none"></path><path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"></path></svg>
                    
                  </span>
                </div>
                <div class="please-wait">
                  <div class="please-wait-container">
                    <div class="contents">
                      <p>Please Wait</p>
                      <div class="spinner6" style="margin-left: 5px;">
                          <div class="circle one"></div>
                          <div class="circle two"></div>
                          <div class="circle three"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </li>
	    	<?php 
            if ($i == 15) { //// will show 5 posts then break ////
              break;
            }//// end if////
			$i++; 
		endwhile;
	else :;
	?>
    <h4 class="no-note">No Favourites Found</h4>
    <?php 
	endif; 
	wp_reset_query();

    $output = array();
    $output['data'] = ob_get_clean();
    $output['ex_fav_count']  = $ex_fav_count;
    $output['post_count'] = $post_count;
    $output['total_pages'] = $total_pages;
    echo json_encode($output);
    wp_die();

}
/******************************************END*****************************************/



/////////////////////////////////////////////////////////////////////////////////////////
////////////////////when click on delete Icon from All fav page//////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////

add_action( 'wp_ajax_header_fav_list_temp2', 'ajax_header_fav_list_temp2' );
add_action( 'wp_ajax_nopriv_header_fav_list_temp2', 'ajax_header_fav_list_temp2' );

function ajax_header_fav_list_temp2() {

    ob_start();
    global $wpdb;
    $i = 1;

    if ( is_user_logged_in() ) { /// if user logged in

        $post_id      = isset( $_POST['post_id'] ) ? $_POST['post_id'] : '';///clicked post id
        $post_id      = (int)$post_id;
        $user_id      = get_current_user_id(); /// loged in user ID
        $get_Meta     = get_user_meta( $user_id, 'user_fav_listing', true ) ? get_user_meta( $user_id,            'user_fav_listing', true ):'[]';///logedin user fav meta
        $fav_listing  = [];
        $fav_listing  = (json_decode( $get_Meta, true ) != NULL)? json_decode( $get_Meta, true ):[];
                        /// fav meta convert to array 
        $ex_fav_count = count($fav_listing); /// count total fav listing before click
        $items        = -1; /// set post par page limit

        /*----------------- get each post total fav count on post meta ---------------*/
        if ( metadata_exists( 'post', $post_id, 'total_fav_listing' ) ) {
            $this_post_fav_total = get_post_meta( $post_id, 'total_fav_listing', true );
            $this_post_fav_total = ($this_post_fav_total != '' )? $this_post_fav_total : '0';
            $this_post_fav_total = (int)$this_post_fav_total;
        }else{
            $this_post_fav_total = 0;
        }
        /*----------------- end each post total fav count on post meta ---------------*/

        /*=====================================================================================*/
        if ( in_array( $post_id, $fav_listing ) ) { /// if post id alrady exists in fav
            $fav_listing = array_diff($fav_listing, array($post_id)); /// removed id from listing
            $this_post_fav_total = ($this_post_fav_total != 0)? $this_post_fav_total - 1 : 0; /// Reduce each post total fav count
        }
        /*=====================================================================================*/

        /*---------------------- update fav listing on user meta -------------------------*/
        if (metadata_exists('user', $user_id, 'user_fav_listing')){  ///if meta key exists
            if (update_user_meta($user_id, "user_fav_listing", json_encode($fav_listing))){///if updated
                if(is_array( $fav_listing )){
                  $fav_post_ids_arr = array_values( $fav_listing );
                  $fav_post_ids_arr = array_reverse($fav_post_ids_arr); /// Reverse array
                  $post_count       = count($fav_post_ids_arr);
                }
            }
        }else{///if meta key not exists
            if (add_user_meta( $user_id, 'user_fav_listing', json_encode($fav_listing))){///if meta added

                if(is_array( $fav_listing )){
                  $fav_post_ids_arr = array_values( $fav_listing );
                  $fav_post_ids_arr = array_reverse($fav_post_ids_arr);///Reverse array
                  $post_count       = count($fav_post_ids_arr);
                }
            } 
        }/// end if ///
        /*-------------------- end update fav listing on user meta ----------------------*/

        /*-------------- update each post total fav count on post meta ------------------*/
        if ( metadata_exists( 'post', $post_id, 'total_fav_listing' ) ) {
            update_post_meta( $post_id, 'total_fav_listing', $this_post_fav_total );
        }else{
            add_post_meta( $post_id, 'total_fav_listing', $this_post_fav_total );
        }
        /*-------------- end update each post total fav count on post meta ---------------*/

    }
    /***************************************************************************************/

    /*-------------- post query array -----------------*/
    if ( !empty( $fav_post_ids_arr ) ) { /// if there is some post in fav listing
        $total_item     = count($fav_post_ids_arr);
        $total_pages    = ceil($total_item/10);

        $array_posts_type = array('post', 'jobs', 'w2dc_listing', 'announcement','ajde_events', 'knowledge_base', 'dompedia');
        $args = array(
        'post_type'      => $array_posts_type,
        'orderby'        => 'post__in',
        'post__in'       => $fav_post_ids_arr,
        'posts_per_page' => $items,
        );
    }else { /// if there is no post in fav listing
        $args = array();
    }
    /*-------------- end post query array ---------------*/

    $query = new WP_Query( $args );
 
    if($query->have_posts()):
        while( $query->have_posts() ) : $query->the_post();
            ?>
            <li class="fav-<?php echo esc_attr(get_the_ID()); ?>">
              <a class="item__overlay" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"></a>
              <div class="dropdown__items--list--item">
                <div class="dropdown__items--list--item-img">
                    <?php 
                    $image_url = '';
                    if (has_post_thumbnail()) {
                        $src = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );
                        $image_url  = aq_resize($src[0], 100, 100, true);
                    }elseif(get_post_type(get_the_ID()) == 'jobs') {
                        $companies_name = get_the_terms( get_the_ID(), 'company_tax' );
                        $t_id           = $companies_name[0]->term_id;
                        $term_meta      = get_term_meta( $t_id, 'company_term_meta', true );
                        $image_url      = aq_resize($term_meta['company_logo'], 100, 100, true);
                    }
                    ?>
                    <?php if(!empty($image_url)) : ?>
                    <img src="<?php echo $image_url; ?>" alt="">
                    <?php else : ?>
                    <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" color="#000"><path fill="none" d="M0 0h24v24H0z"></path><path d="M21.9 21.9l-8.49-8.49-9.82-9.82L2.1 2.1.69 3.51 3 5.83V19c0 1.1.9 2 2 2h13.17l2.31 2.31 1.42-1.41zM5 18l3.5-4.5 2.5 3.01L12.17 15l3 3H5zm16 .17L5.83 3H19c1.1 0 2 .9 2 2v13.17z"></path></svg>
                  <?php endif;?>
                </div>
                <div class="dropdown__items--list--item-txt">
                  <h3><?php the_title(); ?></h3>
                  <p>
                    <?php
                        //$post_type = get_post_type(get_the_ID());
                        //echo get_cpt_name($post_type);
                        $post_type = get_post_type_object(get_post_type(get_the_ID()))->label;
                        echo ($post_type  == 'Posts')? "News": $post_type;
                    ?>
                  </p>
                </div>
                <div class="fav_list_delete_wrap">
                  <span class="fav_delete_btn" data-post_type="<?php echo get_post_type(get_the_ID()) ?>" data-id="<?php echo get_the_ID(); ?>" data-user-id="<?php echo get_current_user_id(); ?>">
                    <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" color="#aaa"><path d="M0 0h24v24H0z" fill="none"></path><path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"></path></svg>
                    
                  </span>
                </div>
                <div class="please-wait">
                  <div class="please-wait-container">
                    <div class="contents">
                      <p>Please Wait</p>
                      <div class="spinner6" style="margin-left: 5px;">
                          <div class="circle one"></div>
                          <div class="circle two"></div>
                          <div class="circle three"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </li>
            <?php 
            if ($i == 15) { //// will show 5 posts then break ////
              break;
            }//// end if////
            $i++; 
        endwhile;
    else :;
    ?>
    <h4 class="no-note">No Favourites Found</h4>
    <?php 
    endif; 
    wp_reset_query();

    $output = array();
    $output['data'] = ob_get_clean();
    $output['ex_fav_count']  = $ex_fav_count;
    $output['post_count'] = $post_count;
    $output['total_pages'] = $total_pages;
    echo json_encode($output);
    wp_die();

}



/////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////// All fav page post query //////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////


function all_fav_page_post_query() {


    $fav_listing        = array();

    if(is_user_logged_in()){
        $user_id        = get_current_user_id();
        $fav_listing    = get_user_meta( $user_id, 'user_fav_listing', true);
        $fav_listing    = json_decode($fav_listing, true);
    }
    if ( is_array( $fav_listing ) ) {
        $fav_listing = array_values( $fav_listing );
        $fav_listing = array_reverse($fav_listing); /// Reverse array last to 1st
    }

    if ( !empty( $fav_listing ) ) {
      $array_posts_type = array('post', 'jobs', 'w2dc_listing', 'announcement','ajde_events', 'knowledge_base', 'dompedia');
      $args = array(
        'post_type'      => $array_posts_type,
        'orderby'        => 'post__in',
        'post__in'       => $fav_listing,
        'posts_per_page' => -1,
      );
    }else {
      $args = array();
    }

    $query = new WP_Query( $args);
    $fav_query_data_arr    = array();

    if($query->have_posts()){
        while( $query->have_posts() ){ 
            $query->the_post();
 
            $image_url = '';
            if (has_post_thumbnail()) {
                $src = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );
                $image_url  = aq_resize($src[0], 100, 100, true);
            }elseif(get_post_type(get_the_ID()) == 'jobs') {
                $companies_name = get_the_terms( get_the_ID(), 'company_tax' );
                $t_id           = $companies_name[0]->term_id;
                $term_meta      = get_term_meta( $t_id, 'company_term_meta', true );
                $image_url      = aq_resize($term_meta['company_logo'], 100, 100, true);
            }

            $post_type = get_post_type_object(get_post_type(get_the_ID()))->label;
            $post_type = ($post_type  == 'Posts')? "News": $post_type;

            $fav_query_data_arr[]  = array(
                                'post_id'               => get_the_ID(),
                                'postTypeName'          => $post_type,
                                'post_title'            => get_the_title(),
                                'image_url'             => $image_url,
                                'post_permalink'        => get_the_permalink()
                            );

        }/// end while
    }///end if

    wp_reset_postdata();
    //var_dump($fav_query_data_arr);

    return $fav_query_data_arr;
}///end function



/////////////////////////////////////////////////////////////////////////////////////////
///////////////////// All fav page post query loadmore by ajax //////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////

add_action( 'wp_ajax_all_fav_page_post_loadmore', 'all_fav_page_post_loadmore' );
add_action( 'wp_ajax_nopriv_all_fav_page_post_loadmore', 'all_fav_page_post_loadmore' );

function all_fav_page_post_loadmore() {

    ob_start();
    if(is_user_logged_in()){
      $user_id        = get_current_user_id();
      $fav_post_query = all_fav_page_post_query();  

         if ($fav_post_query){ 
            $limit          = 16;
            $total_item     = count($fav_post_query);
            $total_pages    = ceil($total_item/$limit);  
            $current_page   = isset( $_POST['page'] ) ? $_POST['page'] : 1;
            $current_page   = ( $total_item > 0 ) ? min( $total_pages, $current_page ) : 1;
            //$start          = (int)$current_page * $limit - $limit;
            //$fav_post_query = array_slice( $fav_post_query, $start, $limit );
            $t_limit        = (int)$current_page * $limit;
            $fav_post_query = array_slice( $fav_post_query, 0, $t_limit );

          ?>
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
                  <span class="fav_delete_btn" data-post_type="<?php echo get_post_type($post_id) ?>" data-id="<?php echo $post_id; ?>" data-user-id="<?php echo $user_id; ?>">
                    <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" color="#aaa"><path d="M0 0h24v24H0z" fill="none"></path><path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"></path></svg>
                    
                  </span>
                    <img class="fav_click_del_loading_spinner" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/fav_loder.gif" alt="">
                </div>

              </li>
            <?php endforeach ?>
        <?php }else{ /// if no post found ?>
          <h4 class="no-note-xl">No Favourites Found</h4>
        <?php }///end if no post found ?>


      </div>
    <?php
    }else{/// if user not login
      wp_redirect( home_url() ); exit; 
    }


    $output = array();
    $output['data'] = ob_get_clean();
    $output['total_posts'] = $total_item;
    $output['total_pages'] = $total_pages;

    echo json_encode($output);
    wp_die();

}


////////////////////////////////////////////////////////////////////////////////////////////
////////////////////// function for header fav manu shortcode //////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////

function header_fav_manu_shortcode($user_id) {
    if (is_array($user_id)) {
        echo get_header_fav_manu_list($user_id['user_id']);
    }else{
        echo get_header_fav_manu_list(get_current_user_id());
    }
    return ;
}
add_shortcode( 'header_fav_manu_list_shortcode', 'header_fav_manu_shortcode' );

////// print as //echo do_shortcode('[header_fav_manu_list_shortcode user_id="'.get_current_user_id().'"]');



////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// function for header fav manu ///////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////

function get_header_fav_manu_list($user_id){
   
   ?>
   <li>
      <?php

        $i = 1;

        if ( is_user_logged_in() ) { /// if user logged in

          $user_id     = get_current_user_id(); /// loged in user ID
          $fav_listing = get_user_meta( $user_id, 'user_fav_listing', true );///logedin user fav meta 
          $fav_listing = json_decode( $fav_listing, true ); /// fav meta convert to array
          $items       = -1; /// set post par page limit

          if(is_array( $fav_listing )){
            $fav_post_ids_arr = array_values( $fav_listing );
            $fav_post_ids_arr = array_reverse($fav_post_ids_arr); /// Reverse array last to 1st
          }

        }else { /// if user not logged in
          
          $cookie_array = isset( $_COOKIE['favorite_cookies'] ) ? $_COOKIE['favorite_cookies'] : '';
          $fav_listing  = explode( ',', $cookie_array );
          $items        = 7; /// set post par page limit

          if ( is_array( $fav_listing ) ) {
            $fav_post_ids_arr = array_values( $fav_listing );
            $fav_post_ids_arr = array_reverse($fav_post_ids_arr); /// Reverse array last to 1st
          }
        }

        if ( !empty( $fav_post_ids_arr ) ) {
          $array_posts_type = array('post', 'jobs', 'w2dc_listing', 'announcement','ajde_events', 'knowledge_base', 'dompedia');
          $args = array(
            'post_type'      => $array_posts_type,
            'orderby'        => 'post__in',
            'post__in'       => $fav_post_ids_arr,
            'posts_per_page' => $items,
          );
        }else {
          $args = array();
        }
        $query = new WP_Query( $args );

      ?>

      <button class="fav_list_header_menu_btn" title="Favourites Lists" data-ripple="">
        <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20" stroke="currentColor" color="#000"><path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path></svg>
        <?php if ( $query->post_count > 0 ): ?>
          <?php if ($query->post_count > 99): ?>
            <em class="favorite-count-em">
              <?php echo '99+'; ?>
            </em>
          <?php else: ?>
            <em class="favorite-count-em">
              <?php echo $query->post_count; ?>
            </em>
          <?php endif ?>
        <?php endif;?>
      </button>

      <div class="dropdown__items-wrapper">
        <div class="dropdown__items-list">
          <div class="dropdown__items--list-header">
            <h4 class="dropdown__items--list--header_title"><?php _e('Favourites'); ?></h4>
            <?php if( is_user_logged_in() ) : ?>
              <a class="dropdown__items--list--header_button" href="<?php echo get_site_url(); ?>/all-favourites-list"><?php _e('View All', 'dom767'); ?></a>
            <?php endif; ?>
          </div>
          <div class="devider__one"></div>
          <ul class="header_favorites_list_ul dropdown__items--list-item" id="header_favorites_list_ul">
            <?php
            if($query->have_posts()):
              while( $query->have_posts() ) : $query->the_post();
                ?>
                <li class="fav-<?php echo esc_attr(get_the_ID()); ?>">
                  <a class="item__overlay" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"></a>
                  <div class="dropdown__items--list--item">
                    <div class="dropdown__items--list--item-img">
                        <?php 
                        $image_url = '';
                        if (has_post_thumbnail()) {
                            $src = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );
                            $image_url  = aq_resize($src[0], 100, 100, true);
                        }elseif(get_post_type(get_the_ID()) == 'jobs') {
                            $companies_name = get_the_terms( get_the_ID(), 'company_tax' );
                            $t_id           = $companies_name[0]->term_id;
                            $term_meta      = get_term_meta( $t_id, 'company_term_meta', true );
                            $image_url      = aq_resize($term_meta['company_logo'], 100, 100, true);
                        }
                        ?>
                        <?php if(!empty($image_url)) : ?>
                        <img src="<?php echo $image_url; ?>" alt="">
                        <?php else : ?>
                        <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" color="#000"><path fill="none" d="M0 0h24v24H0z"></path><path d="M21.9 21.9l-8.49-8.49-9.82-9.82L2.1 2.1.69 3.51 3 5.83V19c0 1.1.9 2 2 2h13.17l2.31 2.31 1.42-1.41zM5 18l3.5-4.5 2.5 3.01L12.17 15l3 3H5zm16 .17L5.83 3H19c1.1 0 2 .9 2 2v13.17z"></path></svg>
                      <?php endif;?>
                    </div>
                    <div class="dropdown__items--list--item-txt">
                      <h3><?php the_title(); ?></h3>
                      <p>
                        <?php 
                          //$post_type = get_post_type(get_the_ID());
                          //echo get_cpt_name($post_type);
                          $post_type = get_post_type_object(get_post_type(get_the_ID()))->label;
                          echo ($post_type  == 'Posts')? "News": $post_type;
                        ?>
                      </p>
                    </div>
                    <div class="fav_list_delete_wrap">
                      <span class="fav_delete_btn" data-post_type="<?php echo get_post_type(get_the_ID()) ?>" data-id="<?php echo get_the_ID(); ?>" data-user-id="<?php echo get_current_user_id(); ?>">
                        <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" color="#aaa"><path d="M0 0h24v24H0z" fill="none"></path><path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"></path></svg>
                        
                      </span>
                    </div>
                    <div class="please-wait">
                      <div class="please-wait-container">
                        <div class="contents">
                          <p>Please Wait</p>
                          <div class="spinner6" style="margin-left: 5px;">
                              <div class="circle one"></div>
                              <div class="circle two"></div>
                              <div class="circle three"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </li>
              <?php 
                if ($i == 15) { //// will show 5 posts then break ////
                  break;
                }//// end if////
                $i++; 
              endwhile;
            else :;
            ?>
              <h4 class="no-note">No Favourites Found</h4>
              <?php 
            endif; 
            wp_reset_query();
            ?>
          </ul>
        </div>
      </div>
    </li>


   <?php
}

////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// Post total fav count for admin /////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////

function post_total_fav_count_query() {


    $fav_listing        = array();

    if(is_user_logged_in()){
        $user_id        = get_current_user_id();
        $fav_listing    = get_user_meta( $user_id, 'user_fav_listing', true);
        $fav_listing    = json_decode($fav_listing, true);
    }
    if ( is_array( $fav_listing ) ) {
        $fav_listing = array_values( $fav_listing );
        $fav_listing = array_reverse($fav_listing); /// Reverse array last to 1st
    }

      $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
      $array_posts_type = array('post', 'jobs', 'w2dc_listing', 'announcement','ajde_events', 'knowledge_base', 'dompedia');

      $args = array(
        'post_type'      => $array_posts_type,
        'posts_per_page' => -1,
        'order'          => 'DESC',
        'orderby'        =>'total_fav_listing',

        'meta_query'     => array(
          'total_fav_listing' => array(
            'key'     => 'total_fav_listing',
            'value'   => '1',
            'compare' => '>='
          )
        ),

      );


    $query = new WP_Query( $args);
    $fav_query_data_arr    = array();

    if($query->have_posts()){
        while( $query->have_posts() ){ 
            $query->the_post();
 
            $image_url = '';
            if (has_post_thumbnail()) {
                $src = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );
                $image_url  = aq_resize($src[0], 100, 100, true);
            }elseif(get_post_type(get_the_ID()) == 'jobs') {
                $companies_name = get_the_terms( get_the_ID(), 'company_tax' );
                $t_id           = $companies_name[0]->term_id;
                $term_meta      = get_term_meta( $t_id, 'company_term_meta', true );
                $image_url      = aq_resize($term_meta['company_logo'], 100, 100, true);
            }

            $post_type = get_post_type_object(get_post_type(get_the_ID()))->label;
            $post_type = ($post_type  == 'Posts')? "News": $post_type;
            $this_post_fav_total = get_post_meta( get_the_ID(), 'total_fav_listing', true );

            $fav_query_data_arr[]  = array(
                  'post_id'               => get_the_ID(),
                  'postTypeName'          => $post_type,
                  'post_title'            => get_the_title(),
                  'image_url'             => $image_url,
                  'post_permalink'        => get_the_permalink(),
                  'total_fav'             => $this_post_fav_total,
              );

        }/// end while
    }///end if

    wp_reset_postdata();
    //var_dump($fav_query_data_arr);

    return $fav_query_data_arr;
}///end function



/////////////////////////////////////////////////////////////////////////////////////////
//////////////////////// admin fav post query loadmore by ajax //////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////

add_action( 'wp_ajax_admin_all_fav_post_loadmore', 'admin_all_fav_post_loadmore' );
add_action( 'wp_ajax_nopriv_admin_all_fav_post_loadmore', 'admin_all_fav_post_loadmore' );

function admin_all_fav_post_loadmore() {

    ob_start();
    if(is_user_logged_in()){
        $user_id        = get_current_user_id();
        $fav_post_query = post_total_fav_count_query(); 

        function post_total_fav_count_order_desc($a, $b) {
            if ($a['total_fav'] == $b['total_fav']) return 0;
            return ($a['total_fav'] > $b['total_fav']) ? -1 : 1;
        }
        usort($fav_post_query, "post_total_fav_count_order_desc");  
        
        if ($fav_post_query){

            $limit          = 20;
            $total_item     = count($fav_post_query);
            $total_pages    = ceil($total_item/$limit);  
            $current_page   = isset( $_POST['current_page'] ) ? $_POST['current_page'] : 1;
            $current_page   = ( $total_item > 0 ) ? min( $total_pages, $current_page ) : 1;
            $start          = (int)$current_page * $limit - $limit;
            $fav_post_query = array_slice( $fav_post_query, $start, $limit ); 

            ?>
            <tr>
                <th>Post title</th>
                <th>Post Type</th>
                <th>Total Favorite Count</th>
            </tr>
            <?php
            foreach ($fav_post_query as $fav_post){
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

            <?php 
            }///end foreach
        }else{/// if no post found 
        ?>
        <h4 class="no-note-xl">No Favourites Found</h4>
        <?php 
        } 
    }


    $output = array();
    $output['data'] = ob_get_clean();
    $output['total_posts'] = $total_item;
    $output['total_pages'] = $total_pages;

    echo json_encode($output);
    wp_die();

}



/////////////////////////////////////////////////////////////////////////////////////////
////////////////////// admin fav pre post query loadmore by ajax ////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////

add_action( 'wp_ajax_admin_pre_fav_post_loadmore', 'admin_pre_fav_post_loadmore' );
add_action( 'wp_ajax_nopriv_admin_pre_fav_post_loadmore', 'admin_pre_fav_post_loadmore' );

function admin_pre_fav_post_loadmore() {

    ob_start();
    if(is_user_logged_in()){
        $user_id        = get_current_user_id();
        $fav_post_query = post_total_fav_count_query(); 

        function post_total_fav_count_order_desc($a, $b) {
            if ($a['total_fav'] == $b['total_fav']) return 0;
            return ($a['total_fav'] > $b['total_fav']) ? -1 : 1;
        }
        usort($fav_post_query, "post_total_fav_count_order_desc");  
        
        if ($fav_post_query){

            $limit          = 20;
            $total_item     = count($fav_post_query);
            $total_pages    = ceil($total_item/$limit);  
            $current_page   = isset( $_POST['current_page'] ) ? $_POST['current_page'] : 1;
            $current_page   = ( $total_item > 0 ) ? min( $total_pages, $current_page ) : 1;
            $current_page   = ( $current_page > 1 ) ? $current_page - 1 : 1;
            $start          = (int)$current_page * $limit - $limit;
            $fav_post_query = array_slice( $fav_post_query, $start, $limit ); 

            ?>
            <tr>
                <th>Post title</th>
                <th>Post Type</th>
                <th>Total Favorite Count</th>
            </tr>
            <?php
            foreach ($fav_post_query as $fav_post){
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

            <?php 
            }///end foreach
        }else{/// if no post found 
        ?>
        <h4 class="no-note-xl">No Favourites Found</h4>
        <?php 
        } 
    }


    $output = array();
    $output['data'] = ob_get_clean();
    $output['total_posts'] = $total_item;
    $output['total_pages'] = $total_pages;
    $output['current_page'] = $current_page;

    echo json_encode($output);
    wp_die();

}



/////////////////////////////////////////////////////////////////////////////////////////
////////////////////// admin fav next post query loadmore by ajax ////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////

add_action( 'wp_ajax_admin_next_fav_post_loadmore', 'admin_next_fav_post_loadmore' );
add_action( 'wp_ajax_nopriv_admin_next_fav_post_loadmore', 'admin_next_fav_post_loadmore' );

function admin_next_fav_post_loadmore() {

    ob_start();
    if(is_user_logged_in()){
        $user_id        = get_current_user_id();
        $fav_post_query = post_total_fav_count_query(); 

        function post_total_fav_count_order_desc($a, $b) {
            if ($a['total_fav'] == $b['total_fav']) return 0;
            return ($a['total_fav'] > $b['total_fav']) ? -1 : 1;
        }
        usort($fav_post_query, "post_total_fav_count_order_desc");  
        
        if ($fav_post_query){

            $limit          = 20;
            $total_item     = count($fav_post_query);
            $total_pages    = ceil($total_item/$limit);  
            $current_page   = isset( $_POST['current_page'] ) ? $_POST['current_page'] : 1;
            $current_page   = ( $total_item > 0 ) ? min( $total_pages, $current_page ) : 1;
            $current_page   = ( $current_page < $total_pages ) ? $current_page + 1 : 1;
            $current_page   = ( $current_page == $total_pages ) ? $total_pages : $current_page;
            $start          = (int)$current_page * $limit - $limit;
            $fav_post_query = array_slice( $fav_post_query, $start, $limit ); 

            ?>
            <tr>
                <th>Post title</th>
                <th>Post Type</th>
                <th>Total Favorite Count</th>
            </tr>
            <?php
            foreach ($fav_post_query as $fav_post){
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

            <?php 
            }///end foreach
        }else{/// if no post found 
        ?>
        <h4 class="no-note-xl">No Favourites Found</h4>
        <?php 
        } 
    }


    $output = array();
    $output['data'] = ob_get_clean();
    $output['total_posts'] = $total_item;
    $output['total_pages'] = $total_pages;
    $output['current_page'] = $current_page;

    echo json_encode($output);
    wp_die();

}



/////////////////////////////////////////////////////////////////////////////////////////
////////////////////// fav admin pagination num count 20 by ajax ////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////

add_action( 'wp_ajax_fav_admin_pagi_num_count_20', 'fav_admin_pagi_num_count_20' );
add_action( 'wp_ajax_nopriv_fav_admin_pagi_num_count_20', 'fav_admin_pagi_num_count_20' );

function fav_admin_pagi_num_count_20() {

    ob_start();

        
    $current_page = isset( $_POST['current_page'] ) ? $_POST['current_page'] : 1; 
    $total_pages   = isset( $_POST['total_page'] ) ? $_POST['total_page'] : 1; 

    ?>
      <li class="fav_admin_paginations_pre" data-total_page="<?php echo $total_pages ?>" data-page="1" > << </li>
        <?php

        $pre_num0   = ($current_page >= 10) ? $current_page - 10: 1 ;
        $pre_num    = ($pre_num0 >= 1)? $pre_num0 : 1;

        $next_num0  = $current_page + 10;
        $next_num   = ($next_num0 <= $total_pages)? $next_num0: $total_pages;

        $ls10 = ($current_page < 10)? 10 - $current_page : 0;
        $tnc = $total_pages - $current_page;
        $ad10 = ( $tnc < 10)? 10 - $tnc : 0;
        $next_num = $next_num + $ls10;
        $pre_num = $pre_num - $ad10;

        $pre_hide   = ($pre_num > 1 )? $pre_num - 1: 1;
        $next_hide  = ($next_num < $total_pages ) ? $next_num + 1: $total_pages;

        if ($pre_num > 1) {
          echo '<li class="fav_admin_paginations" id="fav_admin_paginations'.$pre_hide.'" data-total_page="'. $total_pages .'" data-page="'.$pre_hide.'" >'. '...'.'</li>';
        }


        for( $i = $pre_num; $i<= $next_num; $i++ ){
          echo '<li class="fav_admin_paginations" id="fav_admin_paginations'.$i.'" data-total_page="'. $total_pages .'" data-page="'.$i.'" >'. $i.'</li>';
        }

        if ($next_num < $total_pages) {
          echo '<li class="fav_admin_paginations" id="fav_admin_paginations'.$next_hide.'" data-total_page="'. $total_pages .'" data-page="'.$next_hide.'" >'. '...'.'</li>';
        }

        ?>
        <li class="fav_admin_paginations_next" data-total_page="<?php echo $total_pages ?>" data-page="1" > >> </li>



    <?php

    $output = array();
    $output['data'] = ob_get_clean();
    $output['total_pages'] = $total_pages;
    $output['current_page'] = $current_page;

    echo json_encode($output);
    wp_die();

}


/********************************************END******************************************/