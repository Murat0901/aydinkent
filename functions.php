<?php

function load_stylesheets()
{

    wp_register_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), false, 'all');
    wp_enqueue_style('bootstrap');

    wp_register_style('style', get_template_directory_uri() . '/style.css', array(), false, 'all');
    wp_enqueue_style('style');

}

add_action('wp_enqueue_scripts', 'load_stylesheets');


function loadjs()
{


    wp_register_script('customjs', get_template_directory_uri() . '/js/scripts.js', '', 1, true);
    wp_enqueue_script('customjs');

    wp_register_script('jquery', get_template_directory_uri() . '/js/jquery-3.5.1.js', '', 1, true);
    wp_enqueue_script('jquery');


}

add_action('wp_enqueue_scripts', 'loadjs');

add_theme_support('menus');

register_nav_menus(

    array(

        'top-menu' => __('Top Menu', 'theme'),
        'footer-menu' => __('Footer Menu', 'theme'),

    )

    );
/**
 * Register Custom Navigation Walker
 */
function register_navwalker(){
	require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';
}
add_action( 'after_setup_theme', 'register_navwalker' );

add_theme_support( 'post-thumbnails' );

add_image_size('smallest', 300, 300, true);
add_image_size('largest', 800, 800, true);


//Widget Ekle

function wpb_init_widgets($id){
    register_sidebar( array(
        'name' => 'Son Yazılar',
        'id' => 'recentposts',
        'before_widget' => '<div class="recent-posts">',
        'after_widget' => '</div>',
        'before_title' => '<h4>',
        'after_title' => '</h4>'
    ));
}

add_action('widgets_init', 'wpb_init_widgets');

function custom_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );