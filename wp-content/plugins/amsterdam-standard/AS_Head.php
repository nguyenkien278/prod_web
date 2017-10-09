<?php

/*
Plugin Name: [AS] Head
Plugin URI: http://amsterdamstandard.com/
Description: AS Component - Head
Author: Amsterdam Standard
Version: 1
Author URI: http://amsterdamstandard.com/
*/

class AS_Head extends WP_Widget
{

// constructor
    function AS_Head()
    {
// Give widget name here
        parent::__construct(false, $name = __('AS Head', 'wp_widget_plugin')); 
    }


    function form($instance)
    {

// Check values
        if ($instance) {
            $content = esc_attr($instance['content']);
            $background = esc_attr($instance['background']);
        } else {
            $background = '';
            $content = '';
        }
        ?>

        <p>
            <label
                for="<?php echo $this->get_field_id('background'); ?>"><?php _e('Background image', 'wp_widget_plugin'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('background'); ?>"
                   name="<?php echo $this->get_field_name('background'); ?>" type="text"
                   value="<?php echo $background; ?>"/>
        </p>

        <p>
            <?php
            $settings =   array(
                'wpautop' => true, // use wpautop?
                'media_buttons' => true, // show insert/upload button(s)
                'textarea_name' => $this->get_field_name('content'), // set the textarea name to something different, square brackets [] can be used here
                'textarea_rows' => get_option('default_post_edit_rows', 10), // rows="..."
                'tabindex' => '',
                'editor_css' => '', // intended for extra styles for both visual and HTML editors buttons, needs to include the <style> tags, can use "scoped".
                'editor_class' => '', // add extra class(es) to the editor textarea
                'teeny' => true, // output the minimal editor config used in Press This
                'dfw' => true, // replace the default fullscreen with DFW (supported on the front-end in WordPress 3.4)
                'tinymce' => true, // load TinyMCE, can be used to pass settings directly to TinyMCE using an array()
                'quicktags' => false // load Quicktags, can be used to pass settings directly to Quicktags using an array()
            );

            wp_editor($content, $this->get_field_name('content'), $settings);
            ?>
        </p>
        <?php
    }


    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['content'] = $new_instance['content'];
        $instance['background'] = strip_tags($new_instance['background']);
        return $instance;
    }


    function widget($args, $instance)
    {
        extract($args);
        ?>

        <section class="page-item intro" style="overflow: hidden;">

            <div class="jumbotron"
                 style="background-image:url(<?= $instance['background']?>);">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-11 col-lg-push-1 col-md-push-1 col-sm-push-1">
                            <header>
<?= $instance['content'];?>
                            </header>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php
    }

}

add_action('widgets_init', create_function('', 'return register_widget("AS_Head");'));
