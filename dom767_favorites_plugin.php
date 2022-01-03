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



function dom_fav_filter_hug($value)
{
    echo $value;
    return;
}
add_filter("test_dom_fav_filter_hug", "dom_fav_filter_hug");

//apply_filter('test_dom_fav_filter_hug', $value);


/**
 * ===================================================================
 * =================Load Page Templates Function=======================
*/
class PageTemplater {
  
    private static $instance; //A reference to an instance of this class.
    protected $templates; //The array of templates that this plugin tracks.

    //Returns an instance of this class.
    public static function get_instance() {
        if ( null == self::$instance ) {
            self::$instance = new PageTemplater();
        }
        return self::$instance;
    } 

    //Initializes the plugin by setting filters and administration functions.
    private function __construct() {
        $this->templates = array();
        // Add a filter to the attributes metabox to inject template into the cache.
        if ( version_compare( floatval( get_bloginfo( 'version' ) ), '4.7', '<' ) ) {
            // 4.6 and older
            add_filter(
                'page_attributes_dropdown_pages_args',
                array( $this, 'register_project_templates' )
            );
        } 
    else {
            // Add a filter to the wp 4.7 version attributes metabox
            add_filter(
                'theme_page_templates', array( $this, 'add_new_template' )
            );
        }
        // Add a filter to the save post to inject out template into the page cache
        add_filter(
            'wp_insert_post_data', 
            array( $this, 'register_project_templates' ) 
        );
        // Add a filter to the template include to determine if the page has our 
        // template assigned and return it's path
        add_filter(
            'template_include', 
            array( $this, 'view_project_template') 
        );
        // Add your templates to this array.
        $this->templates = array(
            '/page-templates/all-favorites.php' => 'All Favourites by plugin',
            //'/page-templates/all-favorites-1.php' => 'All Favourites list 1',
            //'/page-templates/all-favorites-2.php' => 'All Favourites list 2',
        );  
    } 

    //Adds our template to the page dropdown for v4.7+
    public function add_new_template( $posts_templates ) {
        $posts_templates = array_merge( $posts_templates, $this->templates );
        return $posts_templates;
    }

    /**
     * Adds our template to the pages cache in order to trick WordPress
     * into thinking the template file exists where it doens't really exist.
     */
    public function register_project_templates( $atts ) {
        // Create the key used for the themes cache
        $cache_key = 'page_templates-' . md5( get_theme_root() . '/' . get_stylesheet() );
        // Retrieve the cache list. 
        // If it doesn't exist, or it's empty prepare an array
        $templates = wp_get_theme()->get_page_templates();
        if ( empty( $templates ) ) {
            $templates = array();
        } 
        // New cache, therefore remove the old one
        wp_cache_delete( $cache_key , 'themes');
        // Now add our template to the list of templates by merging our templates
        // with the existing templates array from the cache.
        $templates = array_merge( $templates, $this->templates );
        // Add the modified cache to allow WordPress to pick it up for listing
        // available templates
        wp_cache_add( $cache_key, $templates, 'themes', 1800 );
        return $atts;
    } 

    /**
     * Checks if the template is assigned to the page
     */
    public function view_project_template( $template ) {
        // Get global post
        global $post;
        // Return template if post is empty
        if ( ! $post ) {
            return $template;
        }
        // Return default template if we don't have a custom one defined
        if ( ! isset( $this->templates[get_post_meta( 
            $post->ID, '_wp_page_template', true 
        )] ) ) {
            return $template;
        } 
        $file = plugin_dir_path( __FILE__ ). get_post_meta( 
            $post->ID, '_wp_page_template', true
        );
        // Just to be safe, we check if the file exist first
        if ( file_exists( $file ) ) {
            return $file;
        } else {
            echo $file;
        }
        // Return template
        return $template;
    }
} 
add_action( 'plugins_loaded', array( 'PageTemplater', 'get_instance' ) );