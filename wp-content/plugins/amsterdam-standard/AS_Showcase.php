<?php

/*
Plugin Name: [AS] Showcase
Plugin URI: http://amsterdamstandard.com/
Description: AS Component - Iphones showcase
Author: Amsterdam Standard
Version: 1
Author URI: http://amsterdamstandard.com/
*/

class AS_Showcase extends WP_Widget
{

// constructor
    function AS_Showcase()
    {
// Give widget name here
        parent::__construct(false, $name = __('AS Showcase', 'wp_widget_plugin')); 
    }


    function form($instance)
    {

// Check values
        if ($instance) {
            $title = esc_attr($instance['title']);
            $imgs = json_decode(($instance['imgs']));
        } else {
            $title = '';
            $imgs = '';
        }
        ?>

        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'wp_widget_plugin'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
                   name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>"/>
        </p>
        <?php for ($i = 0; $i < 12; $i++): ?>
        <p>
            <label for="<?php echo $this->get_field_id('imgs'); ?>">Gallery img <?= $i + 1; ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('imgs'); ?>"
                   name="<?php echo $this->get_field_name('imgs'); ?>[]" type="text"
                   value="<?php echo (isset($imgs[$i])) ? $imgs[$i] : ''; ?>"/>
        </p>
    <?php endfor; ?>
        <?php
    }


    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);

        $instance['imgs'] = json_encode($new_instance['imgs']);
        return $instance;
    }


    function widget($args, $instance)
    {
        extract($args);

        $title = apply_filters('widget_title', $instance['title']);

        ?>
        <section class="page-item showcase text-center">
            <div class="wrapper-xl">
                <header><h1><?= $title; ?></h1></header>

                <div id="gallery_carousel" class="carousel slide" style="height: 449px;"> <!-- data-ride="carousel" -->
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="#gallery_carousel" data-slide-to="0" class="active"></li>
                        <li data-target="#gallery_carousel" data-slide-to="1" class=""></li>
                        <li data-target="#gallery_carousel" data-slide-to="2" class=""></li>
                    </ol>

                    <div class="carousel-inner" role="listbox">
                        <?php for ($i = 0;
                                   $i < 3;
                                   $i++): ?>
                            <div class="item <?php echo ($i == 0)? 'active': ''; ?> ">
                                <div class="showcase-thumbs">
                                    <?php for ($j = $i * 4; $j < $i * 4 + 4; $j++): ?>
                                        <picture class="animated slideIn">
                                            <img src="<?= json_decode($instance['imgs'])[$j]; ?>" alt="">
                                        </picture>
                                    <?php endfor; ?>
                                </div>
                            </div>
                        <?php endfor; ?>
                    </div>
                </div>


                <a href="https://jmango360.com/showcase" class="btn">View our gallery for more great examples</a>
            </div>
        </section>


        <?php


    }

}

add_action('widgets_init', create_function('', 'return register_widget("AS_Showcase");'));
