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

 // POPULAR POST WIDGET
 class show_popular extends WP_Widget {
 
function show_popular() {
 $widget_ops = array('classname' => 'show_popular', 'description' => __('Show your popular posts.'));
 $this->WP_Widget('show_popular', __('Wpgreen - Popular Posts'), $widget_ops, $control_ops);
 }
 
function widget($args, $instance){
 extract($args);
 
//$options = get_option('custom_recent');
 $title = $instance['title'];
 $postscount = $instance['posts'];
 
//GET the posts
 global $postcount;
 
$myposts = get_posts(array('orderby' => 'comment_count','numberposts' =>$postscount));
 
echo $before_widget . $before_title . $title . $after_title;
 
//SHOW the posts
 foreach($myposts as $post){
 setup_postdata($post);
 
?>
 
<h4><?php the_title(); ?></h4>
 <p>
 <a href="<?php the_permalink() ?>"><?php echo  substr(strip_tags($post->post_content), 0, 80);  ?>...</a></p>
 <?php
 }
 echo $after_widget;
 }
 
function update($newInstance, $oldInstance){
 $instance = $oldInstance;
 $instance['title'] = strip_tags($newInstance['title']);
 $instance['posts'] = $newInstance['posts'];
 
return $instance;
 }
 
function form($instance){
 echo '<p style="text-align:right;"><label  for="'.$this->get_field_id('title').'">' . __('Title:') . '  <input style="width: 200px;" id="'.$this->get_field_id('title').'"  name="'.$this->get_field_name('title').'" type="text"  value="'.$instance['title'].'" /></label></p>';
 
echo '<p style="text-align:right;"><label  for="'.$this->get_field_id('posts').'">' . __('Number of Posts:',  'widgets') . ' <input style="width: 50px;"  id="'.$this->get_field_id('posts').'"  name="'.$this->get_field_name('posts').'" type="text"  value="'.$instance['posts'].'" /></label></p>';
 
echo '<input type="hidden" id="custom_recent" name="custom_recent" value="1" />';
 }
 }
 
add_action('widgets_init', create_function('', 'return register_widget("show_popular");'));
