<?php

    dom767_build_theme_option(
        array(
            'title' => esc_html__( 'Favorites Settings', TIELABS_TEXTDOMAIN ),
            'id'    => 'favorites-tab',
            'type'  => 'tab-title',
        ));

# Global favorites Settings
    dom767_build_theme_option(
        array(
            'title' => esc_html__('Select Post Types to show favorites Feature', TIELABS_TEXTDOMAIN ),
            'id'    => 'favorites-meta-settings',
            'type'  => 'header',
        ));
$posttypes = get_post_types();
/*foreach ($posttypes as $posttype) {

    dom767_build_theme_option(
        array(
            'name' => $posttype,
            'id'   => 'show_favorites_cpt_'.$posttype,
            'type' => 'checkbox',
        ));
}*/

/*    dom767_build_theme_option(
        array(
            'name' => 'Pages',
            'id'   => 'show_favorites_cpt_'.'page',
            'type' => 'checkbox',
        ));*/

    dom767_build_theme_option(
        array(
            'name' => 'News',
            'id'   => 'show_favorites_cpt_'.'post',
            'type' => 'checkbox',
        ));

    dom767_build_theme_option(
        array(
            'name' => 'Jobs',
            'id'   => 'show_favorites_cpt_'.'jobs',
            'type' => 'checkbox',
        ));

    dom767_build_theme_option(
        array(
            'name' => 'Announcements',
            'id'   => 'show_favorites_cpt_'.'announcement',
            'type' => 'checkbox',
        ));

    dom767_build_theme_option(
        array(
            'name' => 'Events',
            'id'   => 'show_favorites_cpt_'.'ajde_events',
            'type' => 'checkbox',
        ));

    dom767_build_theme_option(
        array(
            'name' => 'Businesses Listings',
            'id'   => 'show_favorites_cpt_'.'w2dc_listing',
            'type' => 'checkbox',
        ));

    dom767_build_theme_option(
        array(
            'name' => 'Dompedia',
            'id'   => 'show_favorites_cpt_'.'dompedia',
            'type' => 'checkbox',
        ));

    dom767_build_theme_option(
        array(
            'name' => 'Knowledge Base',
            'id'   => 'show_favorites_cpt_'.'knowledge_base',
            'type' => 'checkbox',
        ));

