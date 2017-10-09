<?php

/*
Plugin Name: [AS] StyleForm
Plugin URI: http://amsterdamstandard.com/
Description: AS Component - Styles for Form
Author: Amsterdam Standard
Version: 1
Author URI: http://amsterdamstandard.com/
*/

class AS_StyleForm extends WP_Widget
{

    function AS_StyleForm()
    {
        parent::__construct(false, $name = __('AS StyleForm', 'wp_widget_plugin')); 
    }

    function form($instance)
    {
        if ($instance) {
            $data = ($instance['data']);
            $placeholders = $instance['data']['placeholders'];
        } else {
            $instance['data'] = [];
            $placeholders = [];
        }
        ?>

        <table class="fl-form-table biczo">
            <tbody>
            <tr id="fl-field-video_type" class="fl-field" data-type="select">
                <td>
                    <label> Submit button color </label>
                </td>
                <td>
                    <input type="color" name="widget-as_styleform[][submit_button]"
                           value="<?= $data['submit_button']; ?>">
                </td>
            </tr>
            <tr id="fl-field-video_type" class="fl-field" data-type="select">
                <td>
                    <label> Align button</label>
                </td>
                <td>
                    <select name="widget-as_styleform[][align_button]">
                        <option <?php if ($data['align_button'] == 'center') echo 'selected'; ?> value="center">center
                        </option>
                        <option <?php if ($data['align_button'] == 'left') echo 'selected'; ?> value="left">left
                        </option>
                        <option <?php if ($data['align_button'] == 'right') echo 'selected'; ?> value="right">right
                        </option>
                    </select>
                </td>
            </tr>
            <tr id="fl-field-video_type" class="fl-field" data-type="select">
                <td>
                    <label> Form background color </label>
                </td>
                <td>
                    <input type="color" name="widget-as_styleform[][background_color]"
                           value="<?= $data['background_color']; ?>">
                </td>
            </tr>
            <tr id="fl-field-video_type" class="fl-field" style="box-shadow:0 2px #cfcfcf;" data-type="select">
                <td>
                    <label> Form background opacity </label>
                </td>
                <td>
                    <input type="number" name="widget-as_styleform[][background_opacity]" min=0 max=100
                           value="<?= $data['background_opacity']; ?>">%
                </td>
            </tr>
            <tr class="fl-field" data-type="select" id="clone" style="display: none;">
                <td>
                    <label> Placeholder <b>_name_</b> </label>
                </td>
                <td>
                    <input type="text" name="widget-as_styleform[][placeholders][_name_]" value="_value_">
                </td>
            </tr>
            <script>
                jQuery(document).ready(function () {
                    var inputs = jQuery(document).find('#crmWebToEntityForm table input:visible');
                    var inputValues = [];
                    var placeholders = <?=$placeholders;?>;
                    inputs.each(function (index) {
                        if (jQuery(this).attr('name')) {
                            var newInputHtml = jQuery("<tr></tr>").html(jQuery('#clone').clone().html()).html();
                            var htmlReady = newInputHtml.replace(/_name_/gi, jQuery(this).attr('name'));
                            htmlReady = htmlReady.replace(/_value_/gi, placeholders[jQuery(this).attr('name')]);

                            jQuery('<tr/>', {
                                html: htmlReady
                            }).appendTo('.biczo tbody');
                        }
                    });
                });
            </script>
            </tbody>
        </table>

        <?php
    }


    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;

        $instance['data']['submit_button'] = strip_tags($new_instance['submit_button']);
        $instance['data']['align_button'] = strip_tags($new_instance['align_button']);
        $instance['data']['background_color'] = strip_tags($new_instance['background_color']);
        $instance['data']['background_opacity'] = strip_tags($new_instance['background_opacity']);
        $instance['data']['placeholders'] = json_encode($new_instance['placeholders']);

        return $instance;
    }


    function widget($args, $instance)
    {
        extract($args);
        ?>
        <script>
            jQuery(document).ready(function () {
                var disos = <?= $instance['data']['placeholders'];?>;

                for (var diso in disos) {
                    jQuery('#crmWebToEntityForm').find('input[name="' + diso + '"]').attr('placeholder', disos[diso]);
                }
            });
        </script>
        <style>
            #crmWebToEntityForm strong {
                display: none
            }

            #crmWebToEntityForm table,
            #crmWebToEntityForm {
                width: 100% !important;
            }

            #crmWebToEntityForm table td input[type='reset'] {
                display: none;
            }

            #crmWebToEntityForm table td input[type='submit']:hover {
                box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
            }

            #crmWebToEntityForm table td input[type='submit'] {
                color: #fff !important;
                background-color: <?=$instance['data']['submit_button'];?>;
                border-color: transparent;
                padding: 17.4px 30px;
                line-height: 1.42857143;
                border-radius: 4px;
                border: 0;
                border-radius: 8px;
                transition: 0.3s ease;
                box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
                font-family: Lato, Lato, "Helvetica Neue", Helvetica, Arial, sans-serif;
                font-weight: 700;
                font-size: 14px;
                text-transform: uppercase;
                color: #FFF;
                letter-spacing: 0;
            }

            @media screen and (max-width: 720px) {
                #crmWebToEntityForm table tr {
                    width: 100% !important;
                }
            }

            #crmWebToEntityForm table td input[type='text']:focus {
                border-color: rgba(74, 74, 74, .5);
                outline: 0;
                -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075), 0 0 4px rgba(74, 74, 74, .6);
                box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075), 0 0 4px rgba(74, 74, 74, .6);
            }

            #crmWebToEntityForm table tr:first-child, #crmWebToEntityForm table tr:last-child {
                width: 100%;
            }

            #crmWebToEntityForm table tr {
                float: left;
                width: 50%;
            }

            #crmWebToEntityForm table tr:last-child td {
                text-align: <?=$instance['data']['align_button'];?> !important;
            }

            #crmWebToEntityForm table td input[type='text'] {
                display: block;
                outline: none;
                width: 100% !important;
                height: 46px;
                padding: 6px 12px;
                font-size: 14px;
                line-height: 1.42857143;
                color: #9f9f9f;
                background-color: #fff;
                background-image: none;
                border: 1px solid rgba(74, 74, 74, .3);
                border-radius: 4px;
                -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
                box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
                -webkit-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
                -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
                transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
            }

            #crmWebToEntityForm table td {
                background: none !important;
                display: block;
                width: 100% !important;
                padding: 0;
                color: #545454;
            }

            #crmWebToEntityForm {
                padding: 10px;
            }

            #crmWebToEntityForm table {
                display: block !important;
                padding: 20px;
            }
        </style>
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

                var color = hexToRgb("<?=$instance['data']['background_color']?>");
                var alpha = parseInt(<?=$instance['data']['background_opacity'];?>) / 100;
                background = "rgba({r},{g},{b},{a})".replace("{r}", color.r).replace("{g}", color.g).replace("{b}", color.b).replace("{a}", alpha);
                jQuery('#crmWebToEntityForm table').css('background', background);

            });
        </script>
        <?php
    }

}

add_action('widgets_init', create_function('', 'return register_widget("AS_StyleForm");'));
