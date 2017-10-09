<?php

/*
Plugin Name: [AS] Facts
Plugin URI: http://amsterdamstandard.com/
Description: AS Component - Facts
Author: Amsterdam Standard
Version: 1
Author URI: http://amsterdamstandard.com/
*/

class AS_Facts extends WP_Widget
{

    function AS_Facts()
    {
        parent::__construct(false, $name = __('AS Facts', 'wp_widget_plugin')); 
    }

    function form($instance)
    {
        if ($instance) {
            $title = esc_attr($instance['title']);

        } else {
            $title = '';
            $facts = [];
            $instance['facts_1_text'] = '';
            $instance['facts_1_percent'] = '';

            $instance['facts_2_text'] = '';
            $instance['facts_2_percent'] = '';

            $instance['facts_3_text'] = '';
            $instance['facts_3_percent'] = '';

            $instance['facts_4_text'] = '';
            $instance['facts_4_percent'] = '';
        }
        ?>

        <table class="fl-form-table">
            <tbody>
            <tr id="fl-field-video_type" class="fl-field" data-type="select"
                data-preview="{&quot;type&quot;:&quot;refresh&quot;}">
                <th>
                    <label for="video_type">
                        Title </label>
                </th>
                <td colspan="2">

                    <input class="widefat"
                           id="<?php echo $this->get_field_id('title'); ?>"
                           name="<?php echo $this->get_field_name('title'); ?>"
                           type="text"
                           style="    width: 100% !important;"
                           value="<?php echo $title; ?>"/>
                </td>
            </tr>

            <tr id="fl-field-video_type" class="fl-field" data-type="select"
                data-preview="{&quot;type&quot;:&quot;refresh&quot;}">
                <th>
                    <label for="video_type">
                        Fact 1. </label>
                </th>
                <td>

                    <input class="widefat"
                           name="<?php echo $this->get_field_name('facts_1_text'); ?>"
                           type="text"
                           value="<?php echo esc_attr($instance['facts_1_text']) ?>"/>
                </td>
                <td>
                    <input class="widefat"
                           name="<?php echo $this->get_field_name('facts_1_percent'); ?>"
                           type="text"
                           placeholder="%"
                           value="<?php echo esc_attr($instance['facts_1_percent']) ?>"/>
                </td>
            </tr>

            <tr id="fl-field-video_type" class="fl-field" data-type="select"
                data-preview="{&quot;type&quot;:&quot;refresh&quot;}">
                <th>
                    <label for="video_type">
                        Fact 2. </label>
                </th>
                <td>

                    <input class="widefat"
                           name="<?php echo $this->get_field_name('facts_2_text'); ?>"
                           type="text"
                           value="<?php echo esc_attr($instance['facts_2_text']) ?>"/>
                </td>
                <td>
                    <input class="widefat"
                           name="<?php echo $this->get_field_name('facts_2_percent'); ?>"
                           type="text"
                           placeholder="%"
                           value="<?php echo esc_attr($instance['facts_2_percent']) ?>"/>
                </td>
            </tr>

            <tr id="fl-field-video_type" class="fl-field" data-type="select"
                data-preview="{&quot;type&quot;:&quot;refresh&quot;}">
                <th>
                    <label for="video_type">
                        Fact 3. </label>
                </th>
                <td>

                    <input class="widefat"
                           name="<?php echo $this->get_field_name('facts_3_text'); ?>"
                           type="text"
                           value="<?php echo esc_attr($instance['facts_3_text']) ?>"/>
                </td>
                <td>
                    <input class="widefat"
                           name="<?php echo $this->get_field_name('facts_3_percent'); ?>"
                           type="text"
                           placeholder="%"
                           value="<?php echo esc_attr($instance['facts_3_percent']) ?>"/>
                </td>
            </tr>

            <tr id="fl-field-video_type" class="fl-field" data-type="select"
                data-preview="{&quot;type&quot;:&quot;refresh&quot;}">
                <th>
                    <label for="video_type">
                        Fact 4. </label>
                </th>
                <td>

                    <input class="widefat"
                           name="<?php echo $this->get_field_name('facts_4_text'); ?>"
                           type="text"
                           value="<?php echo esc_attr($instance['facts_4_text']) ?>"/>
                </td>
                <td>
                    <input class="widefat"
                           name="<?php echo $this->get_field_name('facts_4_percent'); ?>"
                           type="text"
                           placeholder="%"
                           value="<?php echo esc_attr($instance['facts_4_percent']) ?>"/>
                </td>
            </tr>

            </tbody>
        </table>

        <?php
    }


    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;

        $instance['title'] = strip_tags($new_instance['title']);

        $instance['facts_1_text'] = strip_tags($new_instance['facts_1_text']);
        $instance['facts_1_percent'] = strip_tags($new_instance['facts_1_percent']);

        $instance['facts_2_text'] = strip_tags($new_instance['facts_2_text']);
        $instance['facts_2_percent'] = strip_tags($new_instance['facts_2_percent']);

        $instance['facts_3_text'] = strip_tags($new_instance['facts_3_text']);
        $instance['facts_3_percent'] = strip_tags($new_instance['facts_3_percent']);

        $instance['facts_4_text'] = strip_tags($new_instance['facts_4_text']);
        $instance['facts_4_percent'] = strip_tags($new_instance['facts_4_percent']);

        return $instance;
    }


    function widget($args, $instance)
    {
        extract($args);

        $title = apply_filters('widget_title', $instance['title']);
        ?>
        <section class="page-item factsandfigures">
            <h2 class="h1"><?= $title; ?></h2>
            <div class="wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <article>
                                <header><h1 class="count"><?= $instance['facts_1_percent'] ?>%</h1></header>
                                <?= $instance['facts_1_text'] ?>
                            </article>
                        </div>
                        <?php if ($instance['facts_2_text']): ?>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <article>
                                    <header><h1 class="count"><?= $instance['facts_2_percent'] ?>%</h1></header>
                                    <?= $instance['facts_2_text'] ?>
                                </article>
                            </div>
                        <?php endif; ?>
                        <?php if ($instance['facts_3_text']): ?>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <article>
                                    <header><h1 class="count"><?= $instance['facts_3_percent'] ?>%</h1></header>
                                    <?= $instance['facts_3_text'] ?>
                                </article>
                            </div>
                        <?php endif; ?>
                        <?php if ($instance['facts_4_text']): ?>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <article>
                                    <header><h1 class="count"><?= $instance['facts_4_percent'] ?>%</h1></header>
                                    <?= $instance['facts_4_text'] ?>
                                </article>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }

}

add_action('widgets_init', create_function('', 'return register_widget("AS_Facts");'));
