<?php
function my_child_theme_enqueue_styles() {
    $parent_style = 'storefront-style'; 

    wp_enqueue_style($parent_style, get_template_directory_uri() . '/style.css');
    
    wp_enqueue_style('child-style', 
        get_stylesheet_directory_uri() . '/style.css', 
        array($parent_style), 
        wp_get_theme()->get('Version')
    );

    wp_enqueue_style(
        'child-globals',
        get_stylesheet_directory_uri() . '/assets/css/global/globals.css',
        array('child-style'),
        wp_get_theme()->get('Version')
    );

    wp_enqueue_style(
        'child-colors',
        get_stylesheet_directory_uri() . '/assets/css/global/colors.css',
        array('child-globals'),
        wp_get_theme()->get('Version')
    );
}
add_action('wp_enqueue_scripts', 'my_child_theme_enqueue_styles');

// Register primary nav menu location
function saltera_register_menus() {
    register_nav_menus(['primary' => __('Primary Navigation', 'storefront-child')]);
}
add_action('after_setup_theme', 'saltera_register_menus');

// Remove Storefront's default header hooks so they don't render inside our custom header
function saltera_remove_storefront_header() {
    remove_action('storefront_header', 'storefront_header_container',                  0);
    remove_action('storefront_header', 'storefront_skip_links',                        5);
    remove_action('storefront_header', 'storefront_social_icons',                     10);
    remove_action('storefront_header', 'storefront_site_branding',                    20);
    remove_action('storefront_header', 'storefront_secondary_navigation',             30);
    remove_action('storefront_header', 'storefront_product_search',                   40);
    remove_action('storefront_header', 'storefront_header_container_close',           41);
    remove_action('storefront_header', 'storefront_primary_navigation_wrapper',       42);
    remove_action('storefront_header', 'storefront_primary_navigation',               50);
    remove_action('storefront_header', 'storefront_header_cart',                      60);
    remove_action('storefront_header', 'storefront_primary_navigation_wrapper_close', 68);
}
add_action('init', 'saltera_remove_storefront_header');

// Enqueue navbar JS
function saltera_enqueue_scripts() {
    wp_enqueue_script('saltera-navbar', get_stylesheet_directory_uri() . '/assets/js/navbar.js', [], null, true);
}
add_action('wp_enqueue_scripts', 'saltera_enqueue_scripts');

// Redirect to checkout when Buy Now button is used
add_filter( 'woocommerce_add_to_cart_redirect', function ( $url ) {
    if ( ! empty( $_GET['buy_now'] ) ) {
        return wc_get_checkout_url();
    }
    return $url;
} );

// ACF Options page for site-wide settings (announcement bar text, etc.)
if ( function_exists( 'acf_add_options_page' ) ) {
    acf_add_options_page([
        'page_title' => 'Site Settings',
        'menu_title' => 'Site Settings',
        'menu_slug'  => 'site-settings',
        'capability' => 'edit_posts',
        'redirect'   => false,
    ]);
}