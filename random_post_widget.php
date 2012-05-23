<?php
/*
Plugin Name:       	Random Post for Widget
Plugin URI:        	http://www.shashionline.in/random-post-widget-wordpress/
Description: 		Random Post for Widget will show random post on your sidebar
Author URI:        	http://www.shashionline.in/about-me/
Author:            	Shashidhar Kumar
Donate link: 		http://www.shashionline.in/
Tags: 				plugin, posts, random, random post, random posts, simple plugin, widget, Wordpress
Requires at least: 	3.0
Tested up to: 		3.3.2
Stable tag: 		trunk
Version:           	1.0
License: 			GPLv2 or later
License URI: 		http://www.gnu.org/licenses/gpl-2.0.html
*/
 
 
class RandomPostForWidget extends WP_Widget
{
  function RandomPostForWidget()
  {
    $widget_ops = array('classname' => 'RandomPostForWidget', 'description' => 'Displays a random post' );
    $this->WP_Widget('RandomPostForWidget', 'Random Post', $widget_ops);
  }
 
  function form($instance)
  {
    $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
    $title = $instance['title'];
	$noofpost = $instance['noofpost'];
?>
  <p>
  <label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label>
  <label for="<?php echo $this->get_field_id('noofpost'); ?>">No. of Post: <input class="widefat" id="<?php echo $this->get_field_id('noofpost'); ?>" name="<?php echo $this->get_field_name('noofpost'); ?>" type="text" value="<?php echo attribute_escape($noofpost); ?>" /></label>
  </p>
<?php
  }
 
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
	$instance['noofpost'] = $new_instance['noofpost'];
    return $instance;
  }
 
  function widget($args, $instance)
  {
    extract($args, EXTR_SKIP);
 
    echo $before_widget;
    $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
	$noofpost = $instance['noofpost'];
 
    if (!empty($title))
      echo $before_title . $title . $after_title;
	if (!empty($noofpost))
		{
	  		$noofpost;
	  	}
	else
		{
	 		$noofpost=5; 
	  	}
    // WIDGET CODE GOES HERE
	//query_posts('posts_per_page=2&orderby=rand');
	query_posts('posts_per_page='.$noofpost.'&orderby=rand');
	if (have_posts()) : 
		echo "<ul>";
		while (have_posts()) : the_post(); 
			echo "<li><a href='".get_permalink()."'>".get_the_title();
			//echo the_post_thumbnail(array(220,200));
			echo "</a></li>";	
	 
		endwhile;
		echo "</ul>";
	endif; 
	wp_reset_query();
 
    echo $after_widget;
  }
 
}
add_action( 'widgets_init', create_function('', 'return register_widget("RandomPostForWidget");') );?>