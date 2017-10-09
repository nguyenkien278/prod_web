<?php

/*
Plugin Name: [AS] Heading
Plugin URI: http://amsterdamstandard.com/
Description: AS Component - Heading
Author: Amsterdam Standard
Version: 1
Author URI: http://amsterdamstandard.com/
*/

class AS_Heading extends WP_Widget
{

// constructor
    function AS_Heading()
    {
// Give widget name here
        parent::__construct(false, $name = __('AS Heading', 'wp_widget_plugin')); 
    }


    function form($instance)
    {

// Check values
        if ($instance) {
            $title = esc_attr($instance['title']);
        } else {
            $title = '';
        }
        ?>

        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'wp_widget_plugin'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
                   name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>"/>
        </p>
        <?php
    }


    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        return $instance;
    }


    function widget($args, $instance)
    {
        extract($args);

        $title = apply_filters('widget_title', $instance['title']);
        echo '<h2 class="h1">';
        if ($title) {
            echo  $title;
        }
        echo '</h2>';
    }

}
add_action('widgets_init', create_function('', 'return register_widget("AS_Heading");'));
