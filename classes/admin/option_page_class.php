<?php

class Dom767_Fav_Option_Page{
    public function __construct(){
        //add_action( 'plugins_loaded', array( $this, 'dom767_favorites_load_textdomain' ) );
        add_action('admin_menu',array($this,'dom767_fav_create_admin_page'));
        add_action('admin_post_dom767_fav_admin_page',array($this,'dom767_fav_save_form'));
        //add_action( 'admin_init', array( $this, 'fav_options_sutup_sections' ) );
        //add_action( 'admin_init', array( $this, 'fav_options_sutup_fields' ) );

    }

    public function dom767_fav_create_admin_page(){
        $page_title = __('DOM767 Fav Settings', 'dom767_fav');
        $menu_title = __('DOM767 Fav Settings', 'dom767_fav');
        $capability = 'manage_options';
        $slug       = 'dom767_fav_setting_page';
        $callback   = array($this, 'dom767_fav_page_content');
        add_menu_page($page_title, $menu_title, $capability, $slug, $callback);
    }


    public function dom767_fav_page_content(){
        require_once plugin_dir_path(__FILE__)."../../templates/admin/form.php";
    }


    public function dom767_fav_save_form(){
        //print_r($_POST);
        //die();
        check_admin_referer("dom767_fav");
        if (isset($_POST['dom767_fav_longitude2'])) {
            update_option('dom767_fav_longitude2', sanitize_text_field($_POST['dom767_fav_longitude2']));
        }
        wp_redirect('admin.php?page=dom767_fav_setting_page');
    }
}
new Dom767_Fav_Option_Page;