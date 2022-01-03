   
jQuery(document).ready(function ($) {


  /************************************** Get Ajax URL********************************/
  var ajaxURL = dom_fav_list.ajax_url;
  if (dom_fav_list.ajax_url.includes("mydashboard")) {
    ajaxURL = dom_fav_list.ajax_url.replace("mydashboard", "wp-admin");
  }
  /************************************************************************************/

  //////////////////////////////////////////////////////////////////////////////////////
  //////////// If click on the fav-icon, the item will add to the fav list /////////////
  /////////// And the header fav list and fav-icon(fas/far) will be updated ////////////
  //////////////////////////////////////////////////////////////////////////////////////
  $(document).on('click', '.addOrRemoveFavClass', function fav_add_remove_main(e){
    
    var fav_id    = '#'+ $(this).attr("id");                  /// clicked fav weap id
    var post_id   = $(this).attr("data-post_id");             /// clicked post ID
    var post_type = $(this).attr("data-post_type");           /// clicked post type
    var userid    = $(this).attr("data-userid");              /// login user ID
    var icon      = $(this).find('svg').attr('data-prefix');  /// clicked icon class
    
    if (userid > 0) { /////////////// if user login ////////////////////

      $('.addOrRemoveFavClass').prop("disabled",true);  /// Desabled click

      var this_class      = $(this);
      var this_class_1    = '.addOrRemoveFavClass_' + post_id; /// class with posts Id
      var find_loader_img = $(this).find('img');
          $(find_loader_img).fadeIn(1);

      if (icon == 'far' ) {
        $(this_class).find('span').text('Adding ...'); 
      }else{
        $(this_class).find('span').text('Removeing ...');
      }

      //////////////// update fav list data by ajax //////////////////
      var ajax_data = {
          action: "header_fav_list_temp",
          security: dom_fav_list.security,
          post_id : post_id
        };

      $.ajax({
        type: "post",
        url: ajaxURL,
        data: ajax_data,
        beforeSend: function () {
          
        },
        success: function (data_res) {
          $('.addOrRemoveFavClass').prop("disabled",false);/// enable click
          var isFindInArr = JSON.parse(data_res);
          var ex_fav_count = isFindInArr.ex_fav_count; /// before clicked post count
          var post_count = isFindInArr.post_count; /// after clicked post count
          var svg_class = $(this_class).find('svg').attr('data-prefix');
              $(find_loader_img).fadeOut(1);

          if (post_count < 1) {
            $('.favorite-count-em').fadeOut(1);///change total fav count
          }
          //console.log(post_count);
          if (ex_fav_count < 1) { /// if there is no Id in cookies 
            var count_element  = $("<em>", { class: "favorite-count-em" });/// htm element
            $(".fav_list_header_menu_btn").append(count_element); /// add html element
            $(".favorite-count-em").text(post_count); /// add text count 
          }else{ //// if alrady has some id in cookies
            if (post_count > 99) {
              var count_99 = '99+';
              $('.favorite-count-em').html(count_99);///change total fav count
            }else{
              $('.favorite-count-em').html(post_count);///change total fav count
            }
          }/// end if


          //if (post_type == 'ajde_events') { /// if post type is event
            if (svg_class == 'far' ) {
              $(this_class_1).each(function(){
                $(this_class_1).find('svg').attr('data-prefix', 'fas'); 
                $(this_class_1).find('span').text('Remove from favorites');
              })
            }else{
              $(this_class_1).each(function(){
                $(this_class_1).find('svg').attr('data-prefix', 'far'); 
                $(this_class_1).find('span').text('Add to favorites'); 
              })
            }
          /*}else{
            
            if (svg_class == 'far' ) {
              $(this_class).find('svg').attr('data-prefix', 'fas'); 
              $(this_class).find('span').text('Remove from favorites');
            }else{
              $(this_class).find('svg').attr('data-prefix', 'far'); 
              $(this_class).find('span').text('Add to favorites'); 
            }
          }*/

          $("#header_favorites_list_ul").html(isFindInArr.data);
        },
      });
      /////////////// end update fav list data by ajax /////////////////
    }else{ ////////////////////////// if user not login ////////////////

      var favorite_cookies_get    = (typeof Cookies.get("favorite_cookies") != "undefined") ? Cookies.get("favorite_cookies") : '';
      var setCookiesDataArray     = favorite_cookies_get;  /// Cookies string data
      var favorite_cookies_array  = (favorite_cookies_get != '')? favorite_cookies_get.split(","): []; /// string to array
      var count_cookies_array     = favorite_cookies_array.length; /// count cookie array data
      var ex_fav_count            = count_cookies_array ;
      var ex_cookies_arr          = favorite_cookies_array ;
      var that                    = $(this);
      var this_class_1            = '.addOrRemoveFavClass_' + post_id; /// class with posts Id
      var find_loader_img         = $(this).find('img');
      var isIdInCookies           = $.inArray( post_id, favorite_cookies_array ); ////////
          ///if ID alrady exist in the cookies array than get array key number otherwise -1

      if (isIdInCookies == -1) { ////If this item ID is not in the cookie, the item will be added////
        if (count_cookies_array < 7) { ///If the cookie data is less than 7,   ||

          /*--------------------------------------------------------------*/
          $('.addOrRemoveFavClass').prop("disabled",true); /// disabled click
          $(find_loader_img).fadeIn(1);
          if (icon == 'far' ) {
            $(this).find('span').text('Adding ...'); 
          }else{
            $(this).find('span').text('Removeing ...');
          }
          /*--------------------------------------------------------------*/

          if (count_cookies_array < 1) {/// If cookies string array is empty, add this ID in cookies
            setCookiesDataArray   += post_id; /// Add this item ID in cookies array as string 
          }else{ //// If alrady has some ID in cookies
            setCookiesDataArray   += ','+post_id; ///Add this item ID with ',' in cookies array str
          }/// end if

          Cookies.set("favorite_cookies", setCookiesDataArray, { /// set new fav cookies data for 7 days
            expires: 7,
          });


          ///////////update fav list data by ajax//////////
          var ajax_data = {
              action: "header_fav_list_temp",
              security: dom_fav_list.security,
              post_id : post_id,
              ex_fav_count: ex_fav_count,
              ex_cookies : ex_cookies_arr,
            };

          $.ajax({
            type: "post",
            url: ajaxURL,
            data: ajax_data,
            beforeSend: function () {
              
            },
            success: function (data_res) {
              var isFindInArr = JSON.parse(data_res);
              $(find_loader_img).fadeOut(1);
              $('.addOrRemoveFavClass').prop("disabled",false);/// Enable click

              //if (post_type == 'ajde_events') { /// if post type is event
                $(this_class_1).each(function(){
                  $(this_class_1).find('svg').attr('data-prefix', 'fas'); 
                  $(this_class_1).find('span').text('Remove from favorites');
                })
              /*}else{/// if post type is not event
                $(that).find('svg').attr('data-prefix', 'fas'); /// Replace data-prefix val to fas
                $(that).find('span').text('Remove from favorites');  /// Replace inner span text
              }*/

              if (count_cookies_array < 1) {/// When the cookie has no ID 
                var count_element  = $("<em>", { class: "favorite-count-em" });/// htm element
                $(".fav_list_header_menu_btn").append(count_element);///Add html header fav icon
                $(".favorite-count-em").text(count_cookies_array + 1);///Add count to count element
              }else{//// When there is a ID in cookie
                $('.favorite-count-em').text(count_cookies_array + 1);///Add count to count element
              }

              $("#header_favorites_list_ul").html(isFindInArr.data); /// show query post items
              
            },
          });
          ///////////update fav list data by ajax//////////
        }else{ /// ///If the cookie data is = 7

          //alert("As a guest user you are allowed to make maximum 5 Favourite CPTs.");
          $(this).find('.noneuserpopupbox').toggleClass("show");
          $(this).find('span').fadeToggle();
        } /// End if cookies not more than 5 
      }else{ ////// If the item id alrady exist in the cookies //////
        /*--------------------------------------------------------------*/
        $('.addOrRemoveFavClass').prop("disabled",true); /// disabled click
        $(find_loader_img).fadeIn(1);
        if (icon == 'far' ) {
          $(this).find('span').text('Adding ...'); 
        }else{
          $(this).find('span').text('Removeing ...');
        }
        /*--------------------------------------------------------------*/

        //////////////////////////////////////////////////////////////////////////
        var arr_filtered_id = _.without(favorite_cookies_array, post_id);/// Remove this post ID 
        var arr_without_id  = ''; ///Var for creating a new string cookies array
        var i;
        for (i = 0; i < arr_filtered_id.length; ++i) {
          if (arr_filtered_id.length - 1 != i) { /// if not last val of array
            arr_without_id += arr_filtered_id[i] + ',';
          }else{  /// if last val of array
            arr_without_id += arr_filtered_id[i] ;
          }///End if
        }///End for loop
        //////////////////////////////////////////////////////////////////////////

        Cookies.set("favorite_cookies", arr_without_id, {/// set new fav cookies data for 7 days
          expires: 7,
        });

        ///////////update fav list data by ajax//////////
        var ajax_data = {
            action: "header_fav_list_temp",
            security: dom_fav_list.security,
            post_id : post_id,
            ex_cookies : ex_cookies_arr,
          };

        $.ajax({
          type: "post",
          url: ajaxURL,
          data: ajax_data,
          beforeSend: function () {
            
          },
          success: function (data_res) {
            var isFindInArr = JSON.parse(data_res);
            $(find_loader_img).fadeOut(1);
            $('.addOrRemoveFavClass').prop("disabled",false);/// enable click

            //if (post_type == 'ajde_events') { /// if post type is event
              $(this_class_1).each(function(){
                $(this_class_1).find('svg').attr('data-prefix', 'far'); /// replace data-prefix val to far
                $(this_class_1).find('span').text('Add to favorites');  /// Replace inner span text
              })
           /* }else{/// if post type is not event
              $(that).find('svg').attr('data-prefix', 'far'); /// replace data-prefix val to far
              $(that).find('span').text('Add to favorites');  /// Replace inner span text
            }*/


            $('.favorite-count-em').html(count_cookies_array - 1);///change total fav count on header
            var post_count = isFindInArr.post_count; /// after clicked post count
            if (post_count < 1) {
              $('.favorite-count-em').fadeOut(1);///change total fav count
            }

            $("#header_favorites_list_ul").html(isFindInArr.data);
          },
        });
        ///////////End update fav data list by ajax//////////
      }///end if
    }//// end if //////////////////// if user not login ////////////////
    e.preventDefault();
    //e.stopPropagation();
  });
  /***************************************END******************************************/

  //////////////////////////////////////////////////////////////////////////////////////
  ///////// If click on the delete-icon, the item will delete from the fav list ////////
  /////////// And the header fav list and fav-icon(fas/far) will be updated ////////////
  //////////////////////////////////////////////////////////////////////////////////////
  $(document).on('click', '.fav_list_delete_wrap', function fav_list_delete_main(e){
    
    var post_id       = $(this).find('span').attr('data-id');
    var user_id       = $(this).find('span').attr('data-user-id');
    var this_class_1  = '.addOrRemoveFavClass_' + post_id; /// class with posts Id
    var post_type     = $(this).find('span').attr("data-post_type"); 
    var icon_id       = '#addOrRemoveFavId' + post_id;
    var list_id       = '#fav-' + post_id;

    if (user_id > 0) {
      $('.fav_list_delete_wrap').prop("disabled",true);/// disabled click when processing
      $(this).siblings('.please-wait').fadeIn(1);

      ///////////update fav list data by ajax//////////
      var ajax_data = {
          action: "header_fav_list_temp",
          security: dom_fav_list.security,
          post_id : post_id,
        };

      $.ajax({
        type: "post",
        url: ajaxURL,
        data: ajax_data,
        beforeSend: function () {
          
        },
        success: function (data_res) {
          $('.fav_list_delete_wrap').prop("disabled",false);  /// enable click when finish
          var isFindInArr = JSON.parse(data_res);
          var ex_fav_count = isFindInArr.ex_fav_count;///post count before clicking
          var post_count = isFindInArr.post_count; ///post count after clicking
          if (post_count > 99) {
            var count_99 = '99+';
            $('.favorite-count-em').html(count_99);///change total fav count
          }else{
            $('.favorite-count-em').html(post_count);///change total fav count
          }

          ////change all fav page load more btn total page count///
          var total_pages = isFindInArr.total_pages;
          $('#all_fav_list_loadmore_btn_id').attr("data-total_page",total_pages);
          ////end change all fav page load more btn total page count///

          if (post_count < 1) {
            $('.favorite-count-em').fadeOut(1);///If fav post count less than 1, hide count element
          }
          $("#header_favorites_list_ul").html(isFindInArr.data);

          //if (post_type == 'ajde_events') {
            $(this_class_1).each(function(){
              $(this_class_1).find('svg').attr('data-prefix', 'far');///Replace the val of data-prefix to "far"
              $(this_class_1).find('span').text('Add to favorites');
            })
          /*}else{
            $(icon_id).find('svg').attr('data-prefix', 'far');///Replace the val of data-prefix to "far"
            $(icon_id).find('span').text('Add to favorites');
          }*/

          $(list_id).fadeOut(1); ///hide this fav post from all fav listing page  
        },
      });
      ///////////end update fav list data by ajax//////////
    }else{//// if user not logedin

      $('.fav_list_delete_wrap').prop("disabled",true);/// disabled click when processing
      $(this).siblings('.please-wait').fadeIn(1);
      var favorite_cookies_get    = (typeof Cookies.get("favorite_cookies") != "undefined") ? Cookies.get("favorite_cookies") : '';
      var setCookiesDataArray     = favorite_cookies_get;  /// Cookies string data
      var favorite_cookies_array  = (favorite_cookies_get != '') ? 
                                    favorite_cookies_get.split(",") : []; /// string to array
      var count_cookies_array     = favorite_cookies_array.length;   /// count cookie array data
      var ex_fav_count            = count_cookies_array ;
      var ex_cookies_arr          = favorite_cookies_array ;

        //////////////////////////////////////////////////////////////////////////
        var arr_filtered_id = _.without(favorite_cookies_array, post_id);//remove post id 
        var arr_without_id  = ''; ///creating new string cookies data
        var i;
        for (i = 0; i < arr_filtered_id.length; ++i) {
          if (arr_filtered_id.length - 1 != i) { /// if not last val of array
            arr_without_id += arr_filtered_id[i] + ',';
          }else{  /// if last val of array
            arr_without_id += arr_filtered_id[i] ;
          }///end if
        }///end for loop
        //////////////////////////////////////////////////////////////////////////

        Cookies.set("favorite_cookies", arr_without_id, {/// set new fav cookies data for 7 days
          expires: 7,
        });

        ///////////update header fav list by ajax//////////
        var ajax_data = {
            action: "header_fav_list_temp",
            security: dom_fav_list.security,
            post_id : post_id,
            ex_fav_count: ex_fav_count,
            ex_cookies : ex_cookies_arr,
          };

        $.ajax({
          type: "post",
          url: ajaxURL,
          data: ajax_data,
          beforeSend: function () {
            
          },
          success: function (data_res) {
            var isFindInArr = JSON.parse(data_res);
            $('.fav_list_delete_wrap').prop("disabled",false);  /// enable click when finish
            $('.favorite-count-em').html(count_cookies_array - 1);///change total fav count on header
            //if (post_type == 'ajde_events') {/// if posts type is event
              $(this_class_1).each(function(){
                $(this_class_1).find('svg').attr('data-prefix', 'far');///Replace the val of data-prefix to "far"
                $(this_class_1).find('span').text('Add to favorites');
              })
            /*}else{ /// if posts type is not event
              $(icon_id).find('svg').attr('data-prefix', 'far'); /// replace data-prefix val to far
              $(icon_id).find('span').text('Add to favorites');
            }*/
            var post_count = isFindInArr.post_count; /// after clicked post count
            if (post_count < 1) {
              $('.favorite-count-em').fadeOut(1);///change total fav count
            }
            
            $("#header_favorites_list_ul").html(isFindInArr.data);
          },
        });
        ///////////end update header fav list by ajax//////////
    }///end if user not logedin
    e.preventDefault();
  });
  /***************************************END*****************************************/

  //////////////////////////////////////////////////////////////////////////////////////
  /////////////// If click on the delete-icon from 'All fav page' //////////////////////
  ///////////////////// the item will delete from the fav list /////////////////////////
  //////////////////// And the header fav list will be updated /////////////////////////
  //////////////////////////////////////////////////////////////////////////////////////

  $(document).on('click', '.fav_page_list_delete_wrap', function page_fav_list_delete_main(e){
    
    var post_id = $(this).find('span').attr('data-id');
    var user_id = $(this).find('span').attr('data-user-id');
    var icon_id = '#addOrRemoveFavId' + post_id;
    var list_id = '#fav-' + post_id;
    var that    = $(this);

    if (user_id > 0) {
      $('.fav_page_list_delete_wrap').prop("disabled",true);/// disabled click when processing
      $(that).find('.fav_click_del_loading_spinner').fadeIn(1);

      ///////////update page fav list by ajax//////////
      var ajax_data = {
          action: "header_fav_list_temp2",
          security: dom_fav_list.security,
          post_id : post_id,
        };

      $.ajax({
        type: "post",
        url: ajaxURL,
        data: ajax_data,
        beforeSend: function () {
          
        },
        success: function (data_res) {
          $('.fav_page_list_delete_wrap').prop("disabled",false);  /// enable click when finished
          var isFindInArr   = JSON.parse(data_res);
          var ex_fav_count  = isFindInArr.ex_fav_count; /// post count before clicking 
          var post_count    = isFindInArr.post_count; /// post count after clicking

          ////change all fav page load more btn total page count///
          var total_pages = isFindInArr.total_pages;
          $('#all_fav_list_loadmore_btn_id').attr("data-total_page",total_pages);
          ////end change all fav page load more btn total page count///
          if (post_count > 99) {
            var count_99 = '99+';
            $('.favorite-count-em').html(count_99);///change total fav count
          }else{
            $('.favorite-count-em').html(post_count);///change total fav count
          }
          if (post_count < 1) {
            $('.favorite-count-em').fadeOut(1);///Hide header fav count element when there is no fav
          }
          $("#header_favorites_list_ul").html(isFindInArr.data);
          $(list_id).fadeOut(1);
          //$(icon_id).find('svg').attr('data-prefix', 'far'); /// replace data-prefix val to far
          //$(icon_id).find('span').text('Add to favorites');
        },
      });
      ///////////end update page fav list by ajax//////////

    }///end if
      e.preventDefault();
  });
  /***************************************END******************************************/


  //////////////////////////////////////////////////////////////////////////////////////
  ///////// If click on the all_fav_list_loadmore_btn from 'All fav page' //////////////
  //////////////////////////////// Load more fav post //////////////////////////////////
  //////////////////////////////////////////////////////////////////////////////////////

  //$(document).on('click', '#all_fav_list_loadmore_btn_id', function all_page_fav_list_loadmore(e){
  $(window).scroll(function() {
    if($(window).scrollTop() + $(window).height() == $(document).height()) {

    var default_page  = 1;
    var that          = $('#all_fav_list_loadmore_btn_id');
    var current_page  = $('#all_fav_list_loadmore_btn_id').attr("data-page");
    var page          = parseInt(current_page)+parseInt(default_page);
    $(that).find('p').text('LOADING...');
    $('.fav_loadmore_loading_img').fadeIn(1);

      ///////////loadpore post by ajax//////////
      var ajax_data = {
          action: "all_fav_page_post_loadmore",
          security: dom_fav_list.security,
          page: page,
        };

      $.ajax({
        type: "post",
        url: ajaxURL,
        data: ajax_data,
        beforeSend: function () {
          
        },
        success: function (data_res) {
          //console.log(page);
          var isFindInArr   = JSON.parse(data_res);
          //$(".favs-list-group").append(isFindInArr.data);
          $(".favs-list-group").html(isFindInArr.data);
          $('.fav_loadmore_loading_img').fadeOut(1);
          $(that).find('p').text('Load More Fav List');
          var total_pages = isFindInArr.total_pages;
          $(that).attr("data-total_page",total_pages);
          $(that).attr("data-page",page);
          if (page >= total_pages) {
            $(that).fadeOut(1);
          }
        },
      });
      ///////////end loadpore post by ajax//////////

      //e.preventDefault();
    }
  });
  /***************************************END******************************************/
  
});//////////////////////////////////// THE END ////////////////////////////////////////
