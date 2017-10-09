<?php

/*
Plugin Name: [AS] Signup
Plugin URI: http://amsterdamstandard.com/
Description: AS Component - Signup
Author: Amsterdam Standard
Version: 2.0
Author URI: http://amsterdamstandard.com/
*/

class AS_Signup extends WP_Widget
{

    function AS_Signup()
    {
        parent::__construct(false, $name = __('AS Signup', 'wp_widget_plugin')); 
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
                    <input type="color" name="widget-as_signup[][background_color]"
                           value="<?=$data->background_color;?>">
                </td>
            </tr>
            <tr id="fl-field-video_type" class="fl-field" style="box-shadow:0 2px #cfcfcf;" data-type="select">
                <td>
                    <label> Background opacity </label>
                </td>
                <td>
                    <input type="number" name="widget-as_signup[][background_opacity]" min=0 max=100
                           value="<?=$data->background_opacity;?>">%
                </td>
            </tr>
            <tr id="fl-field-video_type" class="fl-field" style="box-shadow:0 2px #cfcfcf;" data-type="select">
                <td>
                    <label> Button color </label>
                </td>
                <td>
                    <input type="color" name="widget-as_signup[][button_color]"
                           value="<?=$data->button_color;?>">
                </td>
            </tr>
            <tr id="fl-field-video_type" class="fl-field" style="box-shadow:0 2px #cfcfcf;" data-type="select">
                <td>
                    <label> Button Font color </label>
                </td>
                <td>
                    <input type="color" name="widget-as_signup[][button_font_color]"
                           value="<?=$data->button_font_color;?>">
                </td>
            </tr>
            <tr id="fl-field-video_type" class="fl-field" style="box-shadow:0 2px #cfcfcf;" data-type="select">
                <td>
                    <label> Font color </label>
                </td>
                <td>
                    <input type="color" name="widget-as_signup[][font_color]"
                           value="<?=$data->font_color;?>">
                </td>
            </tr>
            <tr id="fl-field-video_type" class="fl-field" style="box-shadow:0 2px #cfcfcf;" data-type="select">
                <td>
                    <label> Button text </label>
                </td>
                <td>
                    <input type="text" name="widget-as_signup[][button_text]"
                           value="<?php if(isset($data->button_text)) echo $data->button_text;?>">
                </td>
            </tr>
            <tr id="fl-field-video_type" class="fl-field" style="box-shadow:0 2px #cfcfcf;" data-type="select">
                <td>
                    <label> Include Lightspeed </label>
                </td>
                <td>
                    <input type="checkbox" name="widget-as_signup[][lightspeed]" value="1" <?php if(isset($data->lightspeed) && $data->lightspeed == 1) echo 'checked';?>> Include Lightspeed & Google +<br>
                    <?php if(isset($data->lightspeed)) echo $data->lightspeed;?>
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
        <style>
            .dzmiany{
                background: <?=$data->background_color;?>;
                color: <?=$data->font_color;?>;
                padding: 20px;
            }
            .dzmiany label, .dzmiany .existinguser{
                color: <?=$data->font_color;?> !important;
            }
            .dzmiany .btn-cta{
                background: <?=$data->button_color;?>!important;
                color: <?=$data->button_font_color;?> !important;
            }
        </style>
        <link rel='stylesheet' id='jm-validation-css-css'  href='/wp-content/themes/jmango360/inc/js/jm-signup/validationEngine.jquery.css?ver=4.6.1' media='all' />
        <section class="page-item signup-form dzmiany">
            <div class="container-fluid">
                <div class="row">
                    <?php $tentimes = 12;
                    if($data->lightspeed) $tentimes = 6;?>
                    <div class="col-lg-<?=$tentimes;?> col-md-<?=$tentimes;?> col-sm-<?=$tentimes;?>">
                        <!-- form -->
                        <form id="jmango360-signup-form" siq_id="autopick_358">
                            <p>
                                <label for="">E-mail address <span>*</span></label>
                                <input type="email" name="" id="jmango360_account_email" value="" class="form-control validate[required, custom[email]]">
                            </p>
                            <p>
                                <label for="">Password <span>*</span></label>
                                <input type="password" name="" id="jmango360_account_password" value="" class="form-control validate[required, minSize[6]]">
                            </p>
                            <p>
                                <label for="">Confirm Password <span>*</span></label>
                                <input type="password" name="" id="" value="" class="form-control validate[required, equals[jmango360_account_password]]">
                            </p>
                            <p class="ajax-error"></p>
                            <p>
                                <input type="submit" class="btn-cta" value="<?=$data->button_text;?>">
                            </p>
                        </form>
                        <!-- /form -->
                    </div>
                    <?php if($data->lightspeed): ?>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <!-- sign in buttons -->
                        <div class="signup-options">
                            <p><strong>Are you using Lightspeed?</strong><br>Go to the Lightspeed App Store to make your
                                JMango360 connection</p>
                            <a href="https://www.lightspeedhq.nl/ecommerce/store/apps/mobile-app-jmango360/" id="lightspeed_btn">Go to Lightspeed App store</a>
                            <hr>
                            <p>Sign up with your Google+ account</p>
                            <!-- <a href="" id="linkedin_btn">Sign up with LinkedIn</a> -->
                            <a href="#" id="google_btn">Sign up with Google+</a>
                        </div>
                    </div>
                    <?php endif;?>

                </div>
            </div>

            <p class="existinguser">
                Already have an account? <a href="">Log in</a>.<br><br>
                By signing up, you agree to our Terms of Use and Privacy Policy.
            </p>
        </section>
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
                jQuery('.dzmiany').css('background', background);

            });
        </script>
        <?php
    }

}

add_action('widgets_init', create_function('', 'return register_widget("AS_Signup");'));
