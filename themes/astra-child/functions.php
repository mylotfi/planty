<?php

if ( !defined( 'ABSPATH' ) ) exit;

if ( !function_exists( 'chld_thm_cfg_locale_css' ) ):
    function chld_thm_cfg_locale_css( $uri ){
        if ( empty( $uri ) && is_rtl() && file_exists( get_template_directory() . '/rtl.css' ) )
            $uri = get_template_directory_uri() . '/rtl.css';
        return $uri;
    }
endif;
add_filter( 'locale_stylesheet_uri', 'chld_thm_cfg_locale_css' );
         
if ( !function_exists( 'child_theme_configurator_css' ) ):
    function child_theme_configurator_css() {
        wp_enqueue_style( 'chld_thm_cfg_child', trailingslashit( get_stylesheet_directory_uri() ) . 'style.css', array( 'astra-theme-css' ) );
    }
endif;
add_action( 'wp_enqueue_scripts', 'child_theme_configurator_css', 10 );

function ajout_lien_admin($items, $args) {

    if (is_user_logged_in() && current_user_can('administrator') && $args->theme_location == "primary"  ) {
        $lien_admin = '<li id="lien_admin" class="menu-item menu-item-object-page"><a href="' . admin_url() . '">Admin</a></li>';
        $items .= $lien_admin;
    }

    return $items;
}

if (has_nav_menu('main_menu')) {
    add_filter('wp_nav_menu_items', 'ajout_lien_admin', 10, 2);
}

add_filter('wp_nav_menu_items', 'ajout_lien_admin', 10, 3);

