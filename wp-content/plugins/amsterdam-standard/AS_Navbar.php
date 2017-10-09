<?php

/*
Plugin Name: [AS] Navbar
Plugin URI: http://amsterdamstandard.com/
Description: AS Component - Navbar
Author: Amsterdam Standard
Version: 1.4
Author URI: http://amsterdamstandard.com/
*/

class AS_Navbar extends WP_Widget
{

    function AS_Navbar()
    {
        parent::__construct(false, $name = __('AS Navbar', 'wp_widget_plugin')); 
    }
    function form($instance)
    {
        if (isset($instance['data'])){
        $data = json_decode($instance['data']);
        } else {
            $data = null;
        }
        ?>
        <table class="fl-form-table biczo">
            <tbody>
            <tr id="fl-field-video_type" class="fl-field" data-type="select">
                <td>
                    <label> Background color </label>
                </td>
                <td>
                    <input type="color" name="widget-as_navbar[][background_color]"
                           value="<?=$data->background_color;?>">
                </td>
            </tr>
            <tr id="fl-field-video_type" class="fl-field" style="box-shadow:0 2px #cfcfcf;" data-type="select">
                <td>
                    <label> Background opacity </label>
                </td>
                <td>
                    <input type="number" name="widget-as_navbar[][background_opacity]" min=0 max=100
                           value="<?=$data->background_opacity;?>">%
                </td>
            </tr>
            </tbody>
        </table>

        <?php
    }

    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['data'] = json_encode($new_instance);

        return $instance;
    }

    function widget($args, $instance)
    {
        extract($args);
            $data = (json_decode($instance['data']));
        ?>
        <script type="text/javascript" src="https://jmango360.com/wp-includes/js/jquery/jquery.js?ver=1.12.4"></script>
        <script>
            jQuery(document).ready(function () {
                function hexToRgb(hex) {
                    // Expand shorthand form (e.g. "03F") to full form (e.g. "0033FF")
                    var shorthandRegex = /^#?([a-f\d])([a-f\d])([a-f\d])$/i;
                    hex = hex.replace(shorthandRegex, function (m, r, g, b) {
                        return r + r + g + g + b + b;
                    });

                    var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
                    return result ? {
                            r: parseInt(result[1], 16),
                            g: parseInt(result[2], 16),
                            b: parseInt(result[3], 16)
                        } : null;
                }

                var color = hexToRgb("<?=$data->background_color?>");
                var alpha = parseInt(<?=$data->background_opacity;?>) / 100;

                background = "rgba({r},{g},{b},{a})".replace("{r}", color.r).replace("{g}", color.g).replace("{b}", color.b).replace("{a}", alpha);
                jQuery("<style type='text/css'> .stickkyy{ background: "+ background+"!important;} </style>").appendTo("head");


            });
        </script>
        <?php
    }

}

add_action('widgets_init', create_function('', 'return register_widget("AS_Navbar");'));
