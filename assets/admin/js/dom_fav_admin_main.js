jQuery(document).ready(function ($) {

	/************************************** Get Ajax URL********************************/
  	var ajaxURL = dom_admin_fav_list.ajax_url;
  	if (dom_admin_fav_list.ajax_url.includes("mydashboard")) {
    	ajaxURL = dom_admin_fav_list.ajax_url.replace("mydashboard", "wp-admin");
  	}
  	/************************************************************************************/

  	////////////////////////////////////////////////////////////////////////////////////////
  	////////////////////////////////////////////////////////////////////////////////////////
  	////////////////////////////////////////////////////////////////////////////////////////

  	$(document).on('click', '.fav_admin_paginations', function fav_admin_paginations_num(e){

  		var default_page  = 1;
    	var that          = $(this);
    	var current_page  = $(this).attr("data-page");
    	var page          = parseInt(current_page)+parseInt(default_page);
    	//console.log(current_page);

    	$(".admin_fav_loadmore_loading_div").fadeIn();
    	$('.fav_admin_paginations').removeClass('active_btn');
    	var pagi_id = $(this).attr("id");
    	 $('#'+pagi_id).addClass('active_btn');
	    ///////////loadpore post by ajax//////////
		var ajax_data = {
		  action: 		"admin_all_fav_post_loadmore",
		  security: 	dom_admin_fav_list.security,
		  page: 		page,
		  current_page: current_page,
		};

		$.ajax({
			type: 	"post",
			url: 	ajaxURL,
			data: 	ajax_data,
			beforeSend: function () {
			  
			},
			success: function (data_res) {
			  //console.log(page);
			  var isFindInArr   = JSON.parse(data_res);
			  $(".admin_fav_loadmore_loading_div").fadeOut();
			  $(".fav_admin_paginations_pre").attr("data-page",current_page);
			  $(".fav_admin_paginations_next").attr("data-page",current_page);
			  $(".post_fav_count_admin_table").html(isFindInArr.data);
			},
		});
		///////////end loadpore post by ajax//////////

      	//e.preventDefault();

  	});


  	////////////////////////////////////////////////////////////////////////////////////////
  	////////////////////////////////////////////////////////////////////////////////////////
  	////////////////////////////////////////////////////////////////////////////////////////

  	$(document).on('click', '.fav_admin_paginations_pre', function fav_admin_paginations_pre(e){

  		var default_page  = 1;
    	var that          = $(this);
    	var current_page  = $(this).attr("data-page");
    	var page          = parseInt(current_page)+parseInt(default_page);
    	//console.log(current_page);

    	$(".admin_fav_loadmore_loading_div").fadeIn();
	    ///////////loadpore post by ajax//////////
		var ajax_data = {
		  action: 		"admin_pre_fav_post_loadmore",
		  security: 	dom_admin_fav_list.security,
		  page: 		page,
		  current_page: current_page,
		};

		$.ajax({
			type: 	"post",
			url: 	ajaxURL,
			data: 	ajax_data,
			beforeSend: function () {
			  
			},
			success: function (data_res) {
			  //console.log(page);
			  var isFindInArr   = JSON.parse(data_res);
			  $('.fav_admin_paginations').removeClass('active_btn');
			  $('#fav_admin_paginations'+isFindInArr.current_page).addClass('active_btn');
			  $(".admin_fav_loadmore_loading_div").fadeOut();
			  $(".post_fav_count_admin_table").html(isFindInArr.data);
			  $(".fav_admin_paginations_pre").attr("data-page",isFindInArr.current_page);
			  $(".fav_admin_paginations_next").attr("data-page",isFindInArr.current_page);
			},
		});
		///////////end loadpore post by ajax//////////

      	//e.preventDefault();

  	});



  	////////////////////////////////////////////////////////////////////////////////////////
  	////////////////////////////////////////////////////////////////////////////////////////
  	////////////////////////////////////////////////////////////////////////////////////////

  	$(document).on('click', '.fav_admin_paginations_next', function fav_admin_paginations_next(e){

  		var default_page  = 1;
    	var that          = $(this);
    	var current_page  = $(this).attr("data-page");
    	var page          = parseInt(current_page)+parseInt(default_page);
    	//console.log(current_page);

    	$(".admin_fav_loadmore_loading_div").fadeIn();
	    ///////////loadpore post by ajax//////////
		var ajax_data = {
		  action: 		"admin_next_fav_post_loadmore",
		  security: 	dom_admin_fav_list.security,
		  page: 		page,
		  current_page: current_page,
		};

		$.ajax({
			type: 	"post",
			url: 	ajaxURL,
			data: 	ajax_data,
			beforeSend: function () {
			  
			},
			success: function (data_res) {
			  //console.log(page);
			  var isFindInArr   = JSON.parse(data_res);
			  $('.fav_admin_paginations').removeClass('active_btn');
			  $('#fav_admin_paginations'+isFindInArr.current_page).addClass('active_btn');
			  $(".admin_fav_loadmore_loading_div").fadeOut();
			  $(".post_fav_count_admin_table").html(isFindInArr.data);
			  $(".fav_admin_paginations_pre").attr("data-page",isFindInArr.current_page);
			  $(".fav_admin_paginations_next").attr("data-page",isFindInArr.current_page);
			},
		});
		///////////end loadpore post by ajax//////////

      	//e.preventDefault();

  	});




  	////////////////////////////////////////////////////////////////////////////////////////
  	///////////////////////////// admin fav post paginations ///////////////////////////////
  	////////////////////////////////////////////////////////////////////////////////////////

  	$(document).on('click', '.fav_admin_paginations', function fav_admin_pagi_num_count(e){

  		var default_page  = 1;
    	var that          = $(this);
    	var current_page  = $(this).attr("data-page");
    	var total_page  = $(this).attr("data-total_page");
    	var page          = parseInt(current_page)+parseInt(default_page);
    	//console.log(current_page);

    	$(".admin_fav_loadmore_loading_div").fadeIn();
	    ///////////loadpore post by ajax//////////
		var ajax_data = {
		  action: 		"fav_admin_pagi_num_count_20",
		  security: 	dom_admin_fav_list.security,
		  page: 		page,
		  current_page: current_page,
		  total_page: total_page,
		};

		$.ajax({
			type: 	"post",
			url: 	ajaxURL,
			data: 	ajax_data,
			beforeSend: function () {
			  
			},
			success: function (data_res) {
			  //console.log(page);
			  var isFindInArr   = JSON.parse(data_res);
			  $('.fav_admin_paginations_ul').html(isFindInArr.data);
			  $('.fav_admin_paginations').removeClass('active_btn');
			  $('#fav_admin_paginations'+isFindInArr.current_page).addClass('active_btn');

			},
		});
		///////////end loadpore post by ajax//////////

      	//e.preventDefault();

  	});
  
});//////////////////////////////////// THE END ////////////////////////////////////////
