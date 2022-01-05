<?php
/*
Plugin Name:    DOM767 Favorites
Plugin URI:     https://www.dom767.com/
Description:    This plugin is for favorites posts and custom posts
Version:        1.1.0
Author:         Ibrahim Abdullah
Author URI:     https://www.dom767.com/
License:        GPLv2 or later
Text Domain:    dom767_fav
Domain Path:    /languages/
*/

define( "DOM767_ASSETS_DIR", plugin_dir_url( __FILE__ ) . "assets/" );
define( "DOM767_ASSETS_PUBLIC_DIR", plugin_dir_url( __FILE__ ) . "assets/public" );
define( "DOM767_ASSETS_ADMIN_DIR", plugin_dir_url( __FILE__ ) . "assets/admin" );
define( 'DOM767_VERSION', time() );

class DOM767_Favorites {

    private $version;

    public function __construct() {

        $this->version = time();

        add_action('init',array($this,'dom767_init'));

        //add_action( 'plugins_loaded', array( $this, 'dom767_favorites_load_textdomain' ) );
        //add_action('admin_menu',array($this,'dom_fevorites_create_setting'));
        //add_action( 'admin_init', array( $this, 'fav_options_sutup_sections' ) );
        //add_action( 'admin_init', array( $this, 'fav_options_sutup_fields' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'dom767_load_fav_front_assets' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'load_dom767_fav_admin_assets' ) );


    }


    //////////// register and deregister assates //////////////
    function dom767_init(){
        /*wp_deregister_style('fontawesome-css');
        wp_register_style('fontawesome-css','//use.fontawesome.com/releases/v5.2.0/css/all.css');*/

        //wp_deregister_script('tinyslider-js');
        //wp_register_script('tinyslider-js','//cdn.jsdelivr.net/npm/tiny-slider@2.8.5/dist/tiny-slider.min.js',null,'1.0',true);
    }


    ////////// load assate for admin panel //////////
    function load_dom767_fav_admin_assets( $screen ) {

        wp_enqueue_script( 'dom_fav_admin_main-js', DOM767_ASSETS_ADMIN_DIR . "/js/dom_fav_admin_main.js", array( 'jquery' ), $this->version, true );
    }

    ////////// load assate for front end //////////
    function dom767_load_fav_front_assets() {
        wp_enqueue_style( 'dom767-fav-main-css', DOM767_ASSETS_PUBLIC_DIR . "/css/dom_fav_main.css", null, $this->version );

        wp_enqueue_script( 'dom767-fav-main-assets', DOM767_ASSETS_PUBLIC_DIR . "/js/fav_main_scripts_new.js", array( 'jquery' ), $this->version, true );

        wp_localize_script('dom767-fav-main-assets', 'dom_fav_list', array('ajax_url'=> admin_url('admin-ajax.php'), 'security'=> wp_create_nonce('ajax_nonce')));

    }


}////DOM767_Favorites class end
new DOM767_Favorites();


require plugin_dir_path( __FILE__ ) . 'favorite_functions.php';
require plugin_dir_path( __FILE__ ) . 'classes/admin/option_page_class.php';
require plugin_dir_path( __FILE__ ) . 'classes/admin/page_templater.php';




function dom_fav_filter_hug($value)
{
    echo $value;
    return;
}
add_filter("test_dom_fav_filter_hug", "dom_fav_filter_hug");

//apply_filter('test_dom_fav_filter_hug', $value);











