<?php

/*
Plugin Name: [AS] Testimonial
Plugin URI: http://amsterdamstandard.com/
Description: AS Component - Testimonial
Author: Amsterdam Standard
Version: 1
Author URI: http://amsterdamstandard.com/
*/

class AS_Testimonial extends WP_Widget
{

    function AS_Testimonial()
    {
        parent::__construct(false, $name = __('AS Testimonial', 'wp_widget_plugin')); 

    }

    function form($instance)
    {
        if ($instance) {
            $background = esc_attr($instance['background']);
            $quote = esc_attr($instance['quote']);
            $author = esc_attr($instance['author']);
            $link = esc_attr($instance['link']);
        } else {
            $title = '';
            $link = '';
            $author = '';
            $quote = '';
            $background = '';
        }
        ?>

        <table class="fl-form-table">
            <tbody>
            <tr id="fl-field-poster" class="fl-field" data-type="photo"
                data-preview="{&quot;type&quot;:&quot;refresh&quot;}" style="display: table-row;">
                <th>
                    <label for="<?php echo $this->get_field_name('background'); ?>">
                        Background image </label>
                </th>
                <td class="replace">
                    <?php if (!$background): ?>
                        <div class="fl-photo-field fl-builder-custom-field fl-photo-empty">
                            <a class="fl-photo-select" href="javascript:void(0);" onclick="return false;">Select
                                Photo</a>
                            <div class="fl-photo-preview">
                                <div class="fl-photo-preview-img">
                                    <img class="noobo" src="">
                                </div>
                                <select name="poster_src">
                                </select>
                                <br>
                                <a class="fl-photo-edit" href="javascript:void(0);" onclick="return false;">Edit</a>
                                <a class="fl-photo-replace" href="javascript:void(0);"
                                   onclick="return false;">Replace</a>
                                <div class="fl-clear"></div>
                            </div>
                            <input class="bastardo" name="<?php echo $this->get_field_name('background'); ?>"
                                   type="hidden"
                                   value="<?= $background; ?>">
                        </div>
                    <?php else: ?>
                        <div class="fl-photo-field fl-builder-custom-field">
                            <a class="fl-photo-select" href="javascript:void(0);" onclick="return false;">Select
                                Photo</a>
                            <div class="fl-photo-preview">
                                <div class="fl-photo-preview-img">
                                    <img class="noobo" src="<?= $background; ?>">
                                </div>
                                <select name="poster_src">
                                    <option value="<?= $background; ?>">Thumbnail - 150 x 150</option>
                                    <option value="<?= $background; ?>">Medium - 300 x 169</option>
                                    <option value="<?= $background; ?>" selected="selected">Full Size - 790 x 445
                                    </option>
                                </select>
                                <br>
                                <a class="fl-photo-edit" href="javascript:void(0);" onclick="return false;">Edit</a>
                                <a class="fl-photo-replace" href="javascript:void(0);"
                                   onclick="return false;">Replace</a>
                                <div class="fl-clear"></div>
                            </div>
                            <input class="bastardo" name="<?php echo $this->get_field_name('background'); ?>"
                                   type="hidden" value="<?= $background; ?>">
                        </div>
                    <?php endif; ?>
                    <!--
					<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script> 
					this a the reason conflict js in admin/appearance/widget page
					-->
                    <script>
                        (function ($) {
                            setInterval(function () {
                                var img = $(".noobo");
                                if (img) {
                                    $(".bastardo").val(img.attr('src'));
                                }
                            }, 500);
                        })(jQuery);
                    </script>
                </td>
            </tr>
            <tr id="fl-field-video_type" class="fl-field" data-type="select"
                data-preview="{&quot;type&quot;:&quot;refresh&quot;}">
                <th>
                    <label for="video_type">
                        Content </label>
                </th>
                <td>
                    <input class="widefat"
                           id="<?php echo $this->get_field_id('quote'); ?>"
                           name="<?php echo $this->get_field_name('quote'); ?>"
                           type="text"
                           value="<?php echo $quote; ?>"/>
                </td>

            </tr>

            <tr id="fl-field-video_type" class="fl-field" data-type="select"
                data-preview="{&quot;type&quot;:&quot;refresh&quot;}">
                <th>
                    <label for="video_type">
                        Author </label>
                </th>
                <td>

                    <input class="widefat"
                           id="<?php echo $this->get_field_id('author'); ?>"
                           name="<?php echo $this->get_field_name('author'); ?>"
                           type="text"
                           value="<?php echo $author; ?>"/>
                </td>

            </tr>

            <tr id="fl-field-video_type" class="fl-field" data-type="select"
                data-preview="{&quot;type&quot;:&quot;refresh&quot;}">
                <th>
                    <label for="video_type">
                        Link </label>
                </th>
                <td>

                    <input class="widefat"
                           name="<?php echo $this->get_field_name('link'); ?>"
                           type="text"
                           value="<?php echo (isset($instance['link'])) ? esc_attr($instance['link']) : ''; ?>"/>
                </td>
            </tr>

            </tbody>
        </table>
        <?php
    }


    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;

        $instance['background'] = strip_tags($new_instance['background']);
        $instance['quote'] = strip_tags($new_instance['quote']);
        $instance['author'] = strip_tags($new_instance['author']);
        $instance['link'] = strip_tags($new_instance['link']);


        return $instance;
    }


    function widget($args, $instance)
    {
        extract($args);
        ?>
        <section class="page-item testimonial" onclick="javascript:location.href='/<?= $instance['link']; ?>'"
                 style="background-image:url(<?= str_replace("-150x150" , "", $instance['background']); ?>);">
            <blockquote class="fadeInUp">
                <p>
                    <a href="<?= $instance['link']; ?>">
                        <?= $instance['quote']; ?>
                    </a>
                </p>
                <footer>
                    <a href="<?= $instance['link']; ?>">
                        <?= $instance['author']; ?>
                    </a>
                </footer>
            </blockquote>
        </section>
        <?php
    }

}

add_action('widgets_init', create_function('', 'return register_widget("AS_Testimonial");'));
