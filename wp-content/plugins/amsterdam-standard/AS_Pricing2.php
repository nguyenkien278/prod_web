<?php

/*
Plugin Name: [AS] Pricing 2.0
Plugin URI: http://amsterdamstandard.com/
Description: AS Component - Pricing v2.4
Author: Amsterdam Standard
Version: 2.4
Author URI: http://amsterdamstandard.com/
*/

class AS_Pricing2 extends WP_Widget
{

    function AS_Pricing2()
    {
        parent::__construct(false, $name = __('AS Pricing 2.0', 'wp_widget_plugin'));
    } 

    function form($instance)
    {
        ?>
        <style>
            .pisofmi{
                display: inline-block;
                height: 30px;
                line-height: 30px !important;
                margin-right: 10px;
                cursor: pointer;
            }
            .liwfor{
                background: gray;
                width: calc(100% - 10px );
                height: 30px;
                vertical-align: top;
                padding: 5px;
                display: flex;
                border-radius: 4px;
            }
            .newone{
                padding: 0 10px;
                color: white !important;
                font-weight: bold;
                background: #909090;
                float: right !important;
                display: block;
            }
            .platformers input{
                margin: 0 0 5px 0!important;
            }
            .add-new-plat{
                padding: 0 10px;
                color: white !important;
                font-weight: bold;
                background: #585858;
                float: right !important;
                display: block;
            }
            .boldero td{
                font-weight: bold !important;
                color: #353535;
                background: #e4e4e4 !important;
            }
            .removeit{
                padding: 5px 10px;
                color: white !important;
                font-weight: bold;
                background: maroon;
                float: right !important;
                border-radius: 30px;
                display: block;
                margin: -22px 0 -40px;
                cursor: pointer;
            }
        </style>
        <div class="liwfor">
            <div class="platsy">
                <?php if (isset($instance['data'])? true: false): foreach(json_decode($instance['data']) as $k => $platform):
                    if ($k == '_id_') continue;?>
                    <div class="pisofmi" data-target="#platform<?=$k;?>"> <img style="height:30px" src="<?=$platform->image;?>"></div>
                <?php endforeach; endif; ?>
            </div>
            <div class="pisofmi add-new-plat">Add new</div>
        </div>

        <hr>
        <div class="bigg">
            <?php
            if (isset($instance['data'])? true: false):
                $count = $beka = count((array)json_decode($instance['data']));
            foreach(json_decode($instance['data']) as $k => $platform):?>
            <table class="fl-form-table platformers" id="platform<?=$k;?>" style="display: none">
                <tbody>
                <tr class="fl-field">
                    <td></td>
                    <td></td>
                    <td>
                        <div class="removeit">Remove platform</div>
                    </td>
                </tr>
                <tr class="fl-field">
                    <td>
                        <b>Image:</b> <bR>
                        <input class="widefat process_custom_images" name="widget-as_pricing2[][<?=$k;?>][image]" type="text"
                               value="<?=$platform->image?>"/>
                        <button class="set_custom_images fl-builder-button">Browse image</button>
                    </td>
                    <td>
                        <b>Name:</b><bR>
                        <input class="widefat" name="widget-as_pricing2[][<?=$k;?>][name]" type="text"
                               value="<?=$platform->name?>"/>
                    </td>
                    <td>
                        <b>Price (Build Package):</b><bR>
                        <input class="widefat" name="widget-as_pricing2[][<?=$k;?>][build_price]" type="number" value="<?=$platform->build_price?>"/>
                    </td>
                </tr>

                <tr class="fl-field boldero">
                    <td>
                        Build APP Monthly
                    </td>
                    <td>
                        Build APP Yearly
                    </td>
                    <td>
                        Total Package
                    </td>
                </tr>

                <tr class="fl-field">
                    <td>
                        <b>Price:</b> (monthly) <br>
                        <input class="widefat" name="widget-as_pricing2[][<?=$k;?>][monthly_price]" type="number" value="<?=$platform->monthly_price;?>"/>
                    </td>
                    <td>   <b>Price:</b> (monthly) <br>
                        <input class="widefat" name="widget-as_pricing2[][<?=$k;?>][yearly_price]" type="number" value="<?=$platform->yearly_price;?>"/>
                    </td>
                    <td>    <b>Price:</b> (monthly) <br>
                        <input class="widefat" name="widget-as_pricing2[][<?=$k;?>][total_price]" type="number" value="<?=$platform->total_price;?>"/>
                    </td>
                </tr>

                <tr class="fl-field">
                    <td>
                        <b>Sub-text:</b><br>
                        <input class="widefat" name="widget-as_pricing2[][<?=$k;?>][monthly_text]" value="<?=$platform->monthly_text;?>" type="text"/>
                    </td>
                    <td>   <b>Sub-text:</b><br>
                        <input class="widefat" name="widget-as_pricing2[][<?=$k;?>][yearly_text]" value="<?=$platform->yearly_text;?>"  type="text"/>
                    </td>
                    <td>    <b>Sub-text:</b><br>
                        <input class="widefat" name="widget-as_pricing2[][<?=$k;?>][total_text]" value="<?=$platform->total_text;?>"  type="text"/>
                    </td>
                </tr>
                <?php for($d =0; $d <=9; $d++): ?>
                    <tr class="fl-field">
                        <td>
                            <b>Feature <?=$d+1;?>:</b><br>
                            <input class="widefat" name="widget-as_pricing2[][<?=$k;?>][monthly_feature_<?=$d;?>]"  value="<?php $feature = 'monthly_feature_'.$d; echo $platform->{$feature};?>" type="text"/>
                        </td>
                        <td>  <b>Feature <?=$d+1;?>:</b><br>
                            <input class="widefat" name="widget-as_pricing2[][<?=$k;?>][yearly_feature_<?=$d;?>]" value="<?php $feature = 'yearly_feature_'.$d; echo  $platform->{$feature};?>" type="text"/>
                        </td>
                        <td>   <b>Feature <?=$d+1;?>:</b><br>
                            <input class="widefat" name="widget-as_pricing2[][<?=$k;?>][total_feature_<?=$d;?>]" value="<?php $feature = 'total_feature_'.$d; echo  $platform->{$feature};?>" type="text"/>
                        </td>
                    </tr>
                <?php endfor;?>
                <tr class="fl-field">
                    <td>
                        <b>Button url:</b><br>
                        <input class="widefat" name="widget-as_pricing2[][<?=$k;?>][monthly_burl]" type="text" value="<?php if(isset($platform->monthly_burl)) echo $platform->monthly_burl; ?>"/>
                    </td>
                    <td>   <b>Button url:</b><br>
                        <input class="widefat" name="widget-as_pricing2[][<?=$k;?>][yearly_burl]" type="text" value="<?php if(isset($platform->yearly_burl)) echo $platform->yearly_burl; ?>"/>
                    </td>
                    <td>    <b>Button url:</b><br>
                        <input class="widefat" name="widget-as_pricing2[][<?=$k;?>][total_burl]" type="text" value="<?php if(isset($platform->total_burl))  echo $platform->total_burl; ?>"/>
                    </td>
                </tr>
                <tr class="fl-field">
                    <td>
                        <b>Button color:</b><br>
                        <input class="widefat" name="widget-as_pricing2[][<?=$k;?>][monthly_bcolor]" type="color" value="<?php echo $platform->monthly_bcolor; ?>"/>
                    </td>
                    <td>   <b>Button color:</b><br>
                        <input class="widefat" name="widget-as_pricing2[][<?=$k;?>][yearly_bcolor]" type="color" value="<?php echo $platform->yearly_bcolor; ?>"/>
                    </td>
                    <td>    <b>Button color:</b><br>
                        <input class="widefat" name="widget-as_pricing2[][<?=$k;?>][total_bcolor]" type="color" value="<?php echo $platform->total_bcolor; ?>"/>
                    </td>
                </tr>
                <tr class="fl-field">
                    <td>
                        <b>Table color:</b><br>
                        <input class="widefat" name="widget-as_pricing2[][<?=$k;?>][monthly_tcolor]" type="color" value="<?php echo $platform->monthly_tcolor; ?>"/>
                    </td>
                    <td>   <b>Table color:</b><br>
                        <input class="widefat" name="widget-as_pricing2[][<?=$k;?>][yearly_tcolor]" type="color" value="<?php echo $platform->yearly_tcolor; ?>"/>
                    </td>
                    <td>    <b>Table color:</b><br>
                        <input class="widefat" name="widget-as_pricing2[][<?=$k;?>][total_tcolor]" type="color" value="<?php echo $platform->total_tcolor; ?>"/>
                    </td>
                </tr>
                </tbody>
            </table>
            <?php endforeach; endif; ?>

            <div class="copy" style="display: none" data-count="<?= (int)$count-1; ?>">
                <table class="fl-form-table platformers" id="platform_id_">
                <tbody>
                <tr class="fl-field">
                    <td></td>
                    <td></td>
                    <td>
                        <div class="removeit">Remove platform</div>
                    </td>
                </tr>
                <tr class="fl-field">
                    <td>
                        <b>Image:</b><br>
                        <input class="widefat process_custom_images" name="widget-as_pricing2[][_id_][image]" type="text"
                               value=""/>
                        <button class="set_custom_images fl-builder-button">Browse image</button>
                    </td>
                    <td>
                        <b>Name:</b><br>
                        <input class="widefat" name="widget-as_pricing2[][_id_][name]" type="text"
                               value=""/>
                    </td>
                    <td>
                        <b>Price (Build Package):</b> <br>
                        <input class="widefat" name="widget-as_pricing2[][_id_][build_price]" type="number"/>
                    </td>
                </tr>

                <tr class="fl-field boldero">
                    <td>
                        Build APP Monthly
                    </td>
                    <td>
                        Build APP Yearly
                    </td>
                    <td>
                        Total Package
                    </td>
                </tr>

                <tr class="fl-field">
                    <td>
                        <b>Price:</b>
                        <input class="widefat" name="widget-as_pricing2[][_id_][monthly_price]" type="number"/> monthly
                    </td>
                    <td>   <b>Price:</b>
                        <input class="widefat" name="widget-as_pricing2[][_id_][yearly_price]" type="number"/> monthly
                    </td>
                    <td>    <b>Price:</b>
                        <input class="widefat" name="widget-as_pricing2[][_id_][total_price]" type="number"/> monthly
                    </td>
                </tr>

                <tr class="fl-field">
                    <td>
                        <b>Sub-text:</b><br>
                        <input class="widefat" name="widget-as_pricing2[][_id_][monthly_text]" type="text"/>
                    </td>
                    <td>   <b>Sub-text:</b><br>
                        <input class="widefat" name="widget-as_pricing2[][_id_][yearly_text]" type="text"/>
                    </td>
                    <td>    <b>Sub-text:</b><br>
                        <input class="widefat" name="widget-as_pricing2[][_id_][total_text]" type="text"/>
                    </td>
                </tr>
                <?php for($d =0; $d <=9; $d++): ?>
                <tr class="fl-field">
                    <td>
                        <b>Feature <?=$d+1;?>:</b><br>
                        <input class="widefat" name="widget-as_pricing2[][_id_][monthly_feature_<?=$d;?>]" type="text"/>
                    </td>
                    <td>  <b>Feature <?=$d+1;?>:</b><br>
                        <input class="widefat" name="widget-as_pricing2[][_id_][yearly_feature_<?=$d;?>]" type="text"/>
                    </td>
                    <td>   <b>Feature <?=$d+1;?>:</b><br>
                        <input class="widefat" name="widget-as_pricing2[][_id_][total_feature_<?=$d;?>]" type="text"/>
                    </td>
                </tr>
                <?php endfor;?>
                <tr class="fl-field">
                    <td>
                        <b>Button url:</b><br>
                        <input class="widefat" name="widget-as_pricing2[][_id_][monthly_burl]" type="text"/>
                    </td>
                    <td>   <b>Button url:</b><br>
                        <input class="widefat" name="widget-as_pricing2[][_id_][yearly_burl]" type="text"/>
                    </td>
                    <td>    <b>Button url:</b><br>
                        <input class="widefat" name="widget-as_pricing2[][_id_][total_burl]" type="text"/>
                    </td>
                </tr>
                <tr class="fl-field">
                    <td>
                        <b>Button color:</b><br>
                        <input class="widefat" name="widget-as_pricing2[][_id_][monthly_bcolor]" type="color"/>
                    </td>
                    <td>   <b>Button color:</b><br>
                        <input class="widefat" name="widget-as_pricing2[][_id_][yearly_bcolor]" type="color"/>
                    </td>
                    <td>    <b>Button color:</b><br>
                        <input class="widefat" name="widget-as_pricing2[][_id_][total_bcolor]" type="color"/>
                    </td>
                </tr>
                <tr class="fl-field">
                    <td>
                        <b>Table color:</b><br>
                        <input class="widefat" name="widget-as_pricing2[][_id_][monthly_tcolor]" type="color"/>
                    </td>
                    <td>   <b>Table color:</b><br>
                        <input class="widefat" name="widget-as_pricing2[][_id_][yearly_tcolor]" type="color"/>
                    </td>
                    <td>    <b>Table color:</b><br>
                        <input class="widefat" name="widget-as_pricing2[][_id_][total_tcolor]" type="color"/>
                    </td>
                </tr>
                </tbody>
            </table>
            </div>
        </div>

        <script>
            jQuery(document).ready(function() {
                var $ = jQuery;
                if ($('.set_custom_images').length > 0) {
                    if ( typeof wp !== 'undefined' && wp.media && wp.media.editor) {
                        $(document).on('click', '.set_custom_images', function(e) {
                            e.preventDefault();
                            var button = $(this);
                            var id = button.prev();
                            wp.media.editor.send.attachment = function(props, attachment) {
                                id.val(attachment.url);
                            };
                            wp.media.editor.open(button);
                            return false;
                        });
                    }
                }
            });


            jQuery(document).ready(function () {
                jQuery(document).on("click" , ".pisofmi", function(){
                    jQuery(".platformers").hide();
                    jQuery(".pisofmi").css("box-shadow", '');
                    var id = jQuery(this).attr('data-target');
                    jQuery(this).css('box-shadow', "#0089ff 0px 0px 40px, #0089ff 0px 0px 0px 2px");
                    jQuery(id).fadeIn();
                });

                jQuery(".add-new-plat").off().on("click", function(){
                    var $copy = jQuery(".copy");
                    var i = $copy.attr("data-count");
                    i++;
                    $copy.attr("data-count", i);
                    jQuery(".platsy").prepend("<div class='pisofmi newone' data-target='#platform"+i+"'>New platform "+i+"</div>");
                    var html = $copy.html();
                    html = html.replace(/_id_/gi, i);
                    jQuery(".bigg").append(html);
                    return false;
                });
                jQuery(document).on("click",".removeit", function(){
                   var platform = jQuery(this).parents(".platformers").attr('id');
                    var $copy = jQuery(".copy");
                    var i = $copy.attr("data-count"); i--;
                    $copy.attr("data-count", i);
                    jQuery("#"+platform).remove();
                    jQuery(".pisofmi[data-target='#"+platform+"']").remove();
                });
            });
        </script>
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

        $visitor_ip = ip_info();
        $currency = '$';
        $continent = $visitor_ip['continent_code'];
        if ($continent == 'EU') $currency = '€';
        if (isset($instance['data']) ? true: false):
            $platforms = (json_decode($instance['data']));
            ?>
            <style>
                .option-list .option{
                    width :100% !important;
                }
                .comingsooner:nth-child(1){
                    width: calc(50% - 10px) !important;
                    float: left;
                    margin-right: 10px !important;
                }
                .comingsooner:nth-child(2){
                    width: calc(50% - 10px) !important;
                    float: left;
                    margin-right: 0 !important;
                    max-height: 200px;
                    overflow: hidden;
                }
                @media (min-width: 992px){
                    .md-modal {
                        top: 40% !important;
                    }
                }
                .option-list nav button {
                    order: initial !important;
                }
                .fl-builder-content *,.fl-builder-content *:before,.fl-builder-content *:after {-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;}.fl-row:before,.fl-row:after,.fl-row-content:before,.fl-row-content:after,.fl-col-group:before,.fl-col-group:after,.fl-col:before,.fl-col:after,.fl-module:before,.fl-module:after,.fl-module-content:before,.fl-module-content:after {display: table;content: " ";}.fl-row:after,.fl-row-content:after,.fl-col-group:after,.fl-col:after,.fl-module:after,.fl-module-content:after {clear: both;}.fl-row,.fl-row-content,.fl-col-group,.fl-col,.fl-module,.fl-module-content {zoom:1;}.fl-clear {clear: both;}.fl-clearfix:before,.fl-clearfix:after {display: table;content: " ";}.fl-clearfix:after {clear: both;}.fl-clearfix {zoom:1;}.fl-visible-medium,.fl-visible-medium-mobile,.fl-visible-mobile,.fl-col-group .fl-visible-medium.fl-col,.fl-col-group .fl-visible-medium-mobile.fl-col,.fl-col-group .fl-visible-mobile.fl-col {display: none;}.fl-row,.fl-row-content {margin-left: auto;margin-right: auto;}.fl-row-content-wrap {position: relative;}.fl-builder-mobile .fl-row-bg-photo .fl-row-content-wrap {background-attachment: scroll;}.fl-row-bg-video,.fl-row-bg-video .fl-row-content {position: relative;}.fl-row-bg-video .fl-bg-video {bottom: 0;left: 0;overflow: hidden;position: absolute;right: 0;top: 0;}.fl-row-bg-video .fl-bg-video video {bottom: 0;left: 0px;position: absolute;right: 0;top: 0px;}.fl-row-bg-video .fl-bg-video iframe {pointer-events: none;width: 100vw;height: 56.25vw; min-height: 100vh;min-width: 177.77vh; position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);}.fl-bg-video-fallback {background-position: 50% 50%;background-repeat: no-repeat;background-size: cover;bottom: 0px;left: 0px;position: absolute;right: 0px;top: 0px;}.fl-row-bg-slideshow,.fl-row-bg-slideshow .fl-row-content {position: relative;}.fl-row .fl-bg-slideshow {bottom: 0;left: 0;overflow: hidden;position: absolute;right: 0;top: 0;z-index: 0;}.fl-builder-edit .fl-row .fl-bg-slideshow * {bottom: 0;height: auto !important;left: 0;position: absolute !important;right: 0;top: 0;}.fl-row-bg-overlay .fl-row-content-wrap:after {content: '';display: block;position: absolute;top: 0;right: 0;bottom: 0;left: 0;z-index: 0;}.fl-row-bg-overlay .fl-row-content {position: relative;z-index: 1;}.fl-row-full-height .fl-row-content-wrap {display: -webkit-box;display: -webkit-flex;display: -ms-flexbox;display: flex;min-height: 100vh;}.fl-row-full-height .fl-row-content {-webkit-box-flex: 1 1 auto; -moz-box-flex: 1 1 auto;-webkit-flex: 1 1 auto;-ms-flex: 1 1 auto;flex: 1 1 auto;}.fl-row-full-height .fl-row-full-width.fl-row-content {max-width: 100%;width: 100%;}.fl-builder-ie-11 .fl-row-full-height .fl-row-content-wrap {height: 1px;}.fl-builder-ie-11 .fl-row-full-height .fl-row-content {flex: 0 0 auto;flex-basis: 100%;margin: 0;}.fl-row-full-height.fl-row-align-center .fl-row-content-wrap {align-items: center;justify-content: center;-webkit-align-items: center;-webkit-box-align: center;-webkit-box-pack: center;-webkit-justify-content: center;-ms-flex-align: center;-ms-flex-pack: center;}@media all and (device-width: 768px) and (device-height: 1024px) and (orientation:portrait){.fl-row-full-height .fl-row-content-wrap{min-height: 1024px;}}@media all and (device-width: 1024px) and (device-height: 768px) and (orientation:landscape){.fl-row-full-height .fl-row-content-wrap{min-height: 768px;}}@media screen and (device-aspect-ratio: 40/71) {.fl-row-full-height .fl-row-content-wrap {min-height: 500px;}}.fl-col-group-equal-height,.fl-col-group-equal-height .fl-col,.fl-col-group-equal-height .fl-col-content{display: -webkit-box;display: -webkit-flex;display: -ms-flexbox;display: flex;}.fl-col-group-equal-height{-webkit-flex-wrap: wrap;-ms-flex-wrap: wrap;flex-wrap: wrap;}.fl-col-group-equal-height .fl-col,.fl-col-group-equal-height .fl-col-content{-webkit-box-flex: 1 1 auto; -moz-box-flex: 1 1 auto;-webkit-flex: 1 1 auto;-ms-flex: 1 1 auto;flex: 1 1 auto;}.fl-col-group-equal-height .fl-col-content{-webkit-box-orient: vertical; -webkit-box-direction: normal;-webkit-flex-direction: column;-ms-flex-direction: column;flex-direction: column; flex-shrink: 1; min-width: 1px; max-width: 100%;width: 100%;}.fl-col-group-equal-height:before,.fl-col-group-equal-height .fl-col:before,.fl-col-group-equal-height .fl-col-content:before,.fl-col-group-equal-height:after,.fl-col-group-equal-height .fl-col:after,.fl-col-group-equal-height .fl-col-content:after{content: none;}.fl-col-group-equal-height.fl-col-group-align-center .fl-col-content {align-items: center;justify-content: center;-webkit-align-items: center;-webkit-box-align: center;-webkit-box-pack: center;-webkit-justify-content: center;-ms-flex-align: center;-ms-flex-pack: center;}.fl-col-group-equal-height.fl-col-group-align-bottom .fl-col-content {justify-content: flex-end;-webkit-justify-content: flex-end;-webkit-box-align: end;-webkit-box-pack: end;-ms-flex-pack: end;}.fl-col-group-equal-height.fl-col-group-align-center .fl-module {width: 100%;}.fl-builder-ie-11 .fl-col-group-equal-height .fl-module {min-height: 1px;}.fl-col {float: left;min-height: 1px;}.fl-col-bg-overlay .fl-col-content {position: relative;}.fl-col-bg-overlay .fl-col-content:after {content: '';display: block;position: absolute;top: 0;right: 0;bottom: 0;left: 0;z-index: 0;}.fl-col-bg-overlay .fl-module {position: relative;z-index: 1;}.fl-module img {max-width: 100%;} .fl-builder-module-template {margin: 0 auto;max-width: 1100px;padding: 20px;}.fl-builder-content a.fl-button,.fl-builder-content a.fl-button:visited {border-radius: 4px;-moz-border-radius: 4px;-webkit-border-radius: 4px;display: inline-block;font-size: 16px;font-weight: normal;line-height: 18px;padding: 12px 24px;text-decoration: none;text-shadow: none;}.fl-builder-content .fl-button:hover {text-decoration: none;}.fl-builder-content .fl-button:active {position: relative;top: 1px;}.fl-builder-content .fl-button-width-full .fl-button {display: block;text-align: center;}.fl-builder-content .fl-button-width-custom .fl-button {display: inline-block;text-align: center;max-width: 100%;}.fl-builder-content .fl-button-left {text-align: left;}.fl-builder-content .fl-button-center {text-align: center;}.fl-builder-content .fl-button-right {text-align: right;}.fl-builder-content .fl-button i {font-size: 1.3em;height: auto;margin-right:8px;vertical-align: middle;width: auto;}.fl-builder-content .fl-button i.fl-button-icon-after {margin-left: 8px;margin-right: 0;}.fl-builder-content .fl-button-has-icon .fl-button-text {vertical-align: middle;}.fl-icon-wrap {display: inline-block;}.fl-icon {display: table-cell;vertical-align: middle;}.fl-icon a {text-decoration: none;}.fl-icon i {float: left;}.fl-icon i:before {border: none !important;}.fl-icon-text {display: table-cell;text-align: left;padding-left: 15px;vertical-align: middle;}.fl-icon-text *:last-child {margin: 0 !important;padding: 0 !important;}.fl-icon-text a {text-decoration: none;}.fl-photo {line-height: 0;position: relative;}.fl-photo-align-left {text-align: left;}.fl-photo-align-center {text-align: center;}.fl-photo-align-right {text-align: right;}.fl-photo-content {display: inline-block;line-height: 0;position: relative;max-width: 100%;}.fl-photo-img-svg {width: 100%;}.fl-photo-content img {display: inline;height: auto !important;max-width: 100%;width: auto !important;}.fl-photo-crop-circle img {-webkit-border-radius: 100%;-moz-border-radius: 100%;border-radius: 100%;}.fl-photo-caption {font-size: 13px;line-height: 18px;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;}.fl-photo-caption-below {padding-bottom: 20px;padding-top: 10px;}.fl-photo-caption-hover {background: rgba(0,0,0,0.7);bottom: 0;color: #fff;left: 0;opacity: 0;filter: alpha(opacity = 0);padding: 10px 15px;position: absolute;right: 0;-webkit-transition:opacity 0.3s ease-in;-moz-transition:opacity 0.3s ease-in;transition:opacity 0.3s ease-in;}.fl-photo-content:hover .fl-photo-caption-hover {opacity: 100;filter: alpha(opacity = 100);}.fl-builder-pagination {padding: 40px 0;}.fl-builder-pagination ul.page-numbers {list-style: none;margin: 0;padding: 0;text-align: center;}.fl-builder-pagination li {display: inline-block;list-style: none;margin: 0;padding: 0;}.fl-builder-pagination li a.page-numbers,.fl-builder-pagination li span.page-numbers {border: 1px solid #e6e6e6;display: inline-block;padding: 5px 10px;margin: 0 0 5px;}.fl-builder-pagination li a.page-numbers:hover,.fl-builder-pagination li span.current {background: #f5f5f5;text-decoration: none;}.fl-slideshow,.fl-slideshow * {-webkit-box-sizing: content-box;-moz-box-sizing: content-box;box-sizing: content-box;}.fl-slideshow .fl-slideshow-image img {max-width: none !important;}.fl-slideshow-social {line-height: 0 !important;}.fl-slideshow-social * {margin: 0 !important;}.fl-builder-content .bx-wrapper .bx-viewport {background: transparent;border: none;box-shadow: none;-moz-box-shadow: none;-webkit-box-shadow: none;left: 0;}.mfp-wrap button.mfp-arrow,.mfp-wrap button.mfp-arrow:active, .mfp-wrap button.mfp-arrow:hover, .mfp-wrap button.mfp-arrow:focus {background: transparent !important;border: none !important;outline: none;position: absolute;top: 50%;box-shadow: none !important;-moz-box-shadow: none !important;-webkit-box-shadow: none !important;}.mfp-wrap .mfp-close,.mfp-wrap .mfp-close:active,.mfp-wrap .mfp-close:hover,.mfp-wrap .mfp-close:focus {background: transparent !important;border: none !important;outline: none;position: absolute;top: 0;box-shadow: none !important;-moz-box-shadow: none !important;-webkit-box-shadow: none !important;}.admin-bar .mfp-wrap .mfp-close,.admin-bar .mfp-wrap .mfp-close:active,.admin-bar .mfp-wrap .mfp-close:hover,.admin-bar .mfp-wrap .mfp-close:focus {top: 32px!important;}img.mfp-img {padding: 0;}.mfp-counter {display: none;}.mfp-wrap .mfp-preloader.fa {font-size: 30px;}.fl-form-field {margin-bottom: 15px;}.fl-form-field input.fl-form-error {border-color: #DD6420;}.fl-form-error-message {clear: both;color: #DD6420;display: none;padding-top: 8px;font-size: 12px;font-weight: lighter;}.fl-form-button-disabled {opacity: 0.5;}.fl-animation {opacity: 0;}.fl-builder-mobile .fl-animation,.fl-builder-edit .fl-animation,.fl-animated {opacity: 1;}.fl-animated.fl-fade-in {animation: fl-fade-in 1s ease-out;-webkit-animation: fl-fade-in 1s ease-out;-moz-animation: fl-fade-in 1s ease-out;}@keyframes fl-fade-in {0% { opacity: 0; }100% { opacity: 1; }}@-webkit-keyframes fl-fade-in {0% { opacity: 0; }100% { opacity: 1; }}@-moz-keyframes fl-fade-in {0% { opacity: 0; }100% { opacity: 1; }}.fl-animated.fl-slide-left {animation: fl-slide-left 1s ease-out;-webkit-animation: fl-slide-left 1s ease-out;-moz-animation: fl-slide-left 1s ease-out;}@keyframes fl-slide-left {0% { opacity: 0; transform: translateX(10%); }100% { opacity: 1; transform: translateX(0%); }}@-webkit-keyframes fl-slide-left {0% { opacity: 0; -webkit-transform: translateX(10%); }100% { opacity: 1; -webkit-transform: translateX(0%); }}@-moz-keyframes fl-slide-left {0% { opacity: 0; -moz-transform: translateX(10%); } 100% { opacity: 1; -moz-transform: translateX(0%); }}.fl-animated.fl-slide-right {animation: fl-slide-right 1s ease-out;-webkit-animation: fl-slide-right 1s ease-out;-moz-animation: fl-slide-right 1s ease-out;}@keyframes fl-slide-right {0% { opacity: 0; transform: translateX(-10%); } 100% { opacity: 1; transform: translateX(0%); }}@-webkit-keyframes fl-slide-right {0% { opacity: 0; -webkit-transform: translateX(-10%); } 100% { opacity: 1; -webkit-transform: translateX(0%); }}@-moz-keyframes fl-slide-right {0% { opacity: 0; -moz-transform: translateX(-10%); }100% { opacity: 1; -moz-transform: translateX(0%); }}.fl-animated.fl-slide-up {animation: fl-slide-up 1s ease-out;-webkit-animation: fl-slide-up 1s ease-out;-moz-animation: fl-slide-up 1s ease-out;}@keyframes fl-slide-up {0% { opacity: 0; transform: translateY(10%); }100% { opacity: 1; transform: translateY(0%); }}@-webkit-keyframes fl-slide-up {0% { opacity: 0; -webkit-transform: translateY(10%); }100% { opacity: 1; -webkit-transform: translateY(0%); }}@-moz-keyframes fl-slide-up {0% { opacity: 0; -moz-transform: translateY(10%); } 100% { opacity: 1; -moz-transform: translateY(0%); }}.fl-animated.fl-slide-down {animation: fl-slide-down 1s ease-out;-webkit-animation: fl-slide-down 1s ease-out;-moz-animation: fl-slide-down 1s ease-out;}@keyframes fl-slide-down {0% { opacity: 0; transform: translateY(-10%); } 100% { opacity: 1; transform: translateY(0%); }}@-webkit-keyframes fl-slide-down {0% { opacity: 0; -webkit-transform: translateY(-10%); } 100% { opacity: 1; -webkit-transform: translateY(0%); }}@-moz-keyframes fl-slide-down {0% { opacity: 0; -moz-transform: translateY(-10%); }100% { opacity: 1; -moz-transform: translateY(0%); }}.fl-button.fl-button-icon-animation i {width: 0 !important;opacity: 0;-ms-filter: "alpha(opacity=0)";transition: all 0.2s ease-out;-webkit-transition: all 0.2s ease-out;}.fl-button.fl-button-icon-animation:hover i {opacity: 1! important;-ms-filter: "alpha(opacity=100)";}.fl-button.fl-button-icon-animation i.fl-button-icon-after {margin-left: 0px !important;}.fl-button.fl-button-icon-animation:hover i.fl-button-icon-after {margin-left: 10px !important;}.fl-button.fl-button-icon-animation i.fl-button-icon-before {margin-right: 0 !important;}.fl-button.fl-button-icon-animation:hover i.fl-button-icon-before {margin-right: 20px !important;margin-left: -10px;}.fl-builder-content a.fl-button,.fl-builder-content a.fl-button:visited {background: #fafafa;border: 1px solid #ccc;color: #333;}.fl-builder-content a.fl-button *,.fl-builder-content a.fl-button:visited * {color: #333;}@media (max-width: 992px) { .fl-visible-desktop,.fl-visible-mobile,.fl-col-group .fl-visible-desktop.fl-col,.fl-col-group .fl-visible-mobile.fl-col {display: none;}.fl-visible-desktop-medium,.fl-visible-medium,.fl-visible-medium-mobile,.fl-col-group .fl-visible-desktop-medium.fl-col,.fl-col-group .fl-visible-medium.fl-col,.fl-col-group .fl-visible-medium-mobile.fl-col {display: block;} }@media (max-width: 768px) { .fl-visible-desktop,.fl-visible-desktop-medium,.fl-visible-medium,.fl-col-group .fl-visible-desktop.fl-col,.fl-col-group .fl-visible-desktop-medium.fl-col,.fl-col-group .fl-visible-medium.fl-col {display: none;}.fl-visible-medium-mobile,.fl-visible-mobile,.fl-col-group .fl-visible-medium-mobile.fl-col,.fl-col-group .fl-visible-mobile.fl-col {display: block;}.fl-row-content-wrap {background-attachment: scroll !important;}.fl-row-bg-parallax .fl-row-content-wrap {background-attachment: scroll !important;background-position: center center !important;}.fl-col-group.fl-col-group-equal-height {display: block;}.fl-col-group.fl-col-group-equal-height.fl-col-group-custom-width {display: -webkit-box;display: -webkit-flex;display: -ms-flexbox;display: flex;}.fl-col-group.fl-col-group-responsive-reversed {display: -webkit-box;display: -moz-box;display: -ms-flexbox;display: -moz-flex;display: -webkit-flex;display: flex;flex-flow: row wrap;-ms-box-orient: horizontal;-webkit-flex-flow: row wrap;}.fl-col-group-responsive-reversed .fl-col:nth-of-type(1) { -webkit-box-ordinal-group: 12; -moz-box-ordinal-group: 12;-ms-flex-order: 12;-webkit-order: 12; order: 12; }.fl-col-group-responsive-reversed .fl-col:nth-of-type(2) { -webkit-box-ordinal-group: 11;-moz-box-ordinal-group: 11;-ms-flex-order: 11;-webkit-order: 11;order: 11;}.fl-col-group-responsive-reversed .fl-col:nth-of-type(3) { -webkit-box-ordinal-group: 10;-moz-box-ordinal-group: 10;-ms-flex-order: 10;-webkit-order: 10;order: 10; }.fl-col-group-responsive-reversed .fl-col:nth-of-type(4) { -webkit-box-ordinal-group: 9;-moz-box-ordinal-group: 9;-ms-flex-order: 9;-webkit-order: 9;order: 9; }.fl-col-group-responsive-reversed .fl-col:nth-of-type(5) { -webkit-box-ordinal-group: 8;-moz-box-ordinal-group: 8;-ms-flex-order: 8;-webkit-order: 8;order: 8; }.fl-col-group-responsive-reversed .fl-col:nth-of-type(6) { -webkit-box-ordinal-group: 7;-moz-box-ordinal-group: 7;-ms-flex-order: 7;-webkit-order: 7;order: 7; }.fl-col-group-responsive-reversed .fl-col:nth-of-type(7) { -webkit-box-ordinal-group: 6;-moz-box-ordinal-group: 6;-ms-flex-order: 6;-webkit-order: 6;order: 6; }.fl-col-group-responsive-reversed .fl-col:nth-of-type(8) { -webkit-box-ordinal-group: 5;-moz-box-ordinal-group: 5;-ms-flex-order: 5;-webkit-order: 5;order: 5; }.fl-col-group-responsive-reversed .fl-col:nth-of-type(9) { -webkit-box-ordinal-group: 4;-moz-box-ordinal-group: 4;-ms-flex-order: 4;-webkit-order: 4;order: 4; }.fl-col-group-responsive-reversed .fl-col:nth-of-type(10) { -webkit-box-ordinal-group: 3;-moz-box-ordinal-group: 3;-ms-flex-order: 3;-webkit-order: 3;order: 3; }.fl-col-group-responsive-reversed .fl-col:nth-of-type(11) { -webkit-box-ordinal-group: 2;-moz-box-ordinal-group: 2;-ms-flex-order: 2;-webkit-order: 2;order: 2; }.fl-col-group-responsive-reversed .fl-col:nth-of-type(12) {-webkit-box-ordinal-group: 1;-moz-box-ordinal-group: 1;-ms-flex-order: 1;-webkit-order: 1;order: 1;}.fl-col {clear: both;float: none;margin-left: auto;margin-right: auto;width: auto !important;}.fl-col-small {max-width: 400px;}.fl-block-col-resize {display:none;}.fl-row-content-wrap {border-left: none !important;border-right: none !important;margin: 0 !important;padding-left: 0 !important;padding-right: 0 !important;}.fl-row .fl-bg-video,.fl-row .fl-bg-slideshow {left: 0 !important;right: 0 !important;}.fl-col-content {border-left: none !important;border-right: none !important;margin: 0 !important;padding-left: 0 !important;padding-right: 0 !important;} }.fl-row-content-wrap { margin: 0px; }.fl-row-content-wrap { padding: 20px; }.fl-row-fixed-width { max-width: 1100px; }.fl-module-content { margin: 20px; }.page .fl-post-header, .single-fl-builder-template .fl-post-header { display:none; }.fl-node-58aef0ca16728 {width: 100%;}.fl-pricing-table:before,.fl-pricing-table:after {display: table;content: " ";}.fl-pricing-table:after {clear: both;}.fl-pricing-table {margin-left: auto;margin-right: auto;zoom:1;}.fl-pricing-table [class^='fl-pricing-table-col-'] {float: left;position: relative;min-height: 1px;}.fl-pricing-table .fl-pricing-table-col-8 { width: 12.5%; }.fl-pricing-table .fl-pricing-table-col-7 { width: 14.28%; }.fl-pricing-table .fl-pricing-table-col-6 { width: 16.66%; }.fl-pricing-table .fl-pricing-table-col-5 { width: 20%; }.fl-pricing-table .fl-pricing-table-col-4 { width: 25%; }.fl-pricing-table .fl-pricing-table-col-3 { width: 33.33%; }.fl-pricing-table .fl-pricing-table-col-2 { width: 50%; }.fl-pricing-table .fl-pricing-table-col-1 { width: 100%; }.fl-pricing-table.fl-pricing-table-spacing-tight,.fl-pricing-table.fl-pricing-table-spacing-medium {margin-left: -6px;margin-right: -6px;}.fl-pricing-table.fl-pricing-table-spacing-tight [class^='fl-pricing-table-col-'],.fl-pricing-table.fl-pricing-table-spacing-medium [class^='fl-pricing-table-col-'] {padding-right: 6px;padding-left: 6px;}.fl-pricing-table.fl-pricing-table-spacing-wide,.fl-pricing-table.fl-pricing-table-spacing-large {margin-left: -12px;margin-right: -12px;}.fl-pricing-table.fl-pricing-table-spacing-wide [class^='fl-pricing-table-col-'],.fl-pricing-table.fl-pricing-table-spacing-large [class^='fl-pricing-table-col-'] {padding-right: 12px;padding-left: 12px;}.fl-pricing-table.fl-pricing-table-spacing-none {margin-left: 0;margin-right: 0;}.fl-pricing-table.fl-pricing-table-spacing-none [class^='fl-pricing-table-col-'] {padding-right: 0;padding-left: 0;}.fl-pricing-table.fl-pricing-table-spacing-none.fl-pricing-table-border-large [class^='fl-pricing-table-col-'] .fl-pricing-table-column,.fl-pricing-table.fl-pricing-table-spacing-none.fl-pricing-table-border-medium [class^='fl-pricing-table-col-'] .fl-pricing-table-column {border-right-width: 0 !important;}.fl-pricing-table.fl-pricing-table-spacing-none.fl-pricing-table-border-large [class^='fl-pricing-table-col-']:last-child .fl-pricing-table-column,.fl-pricing-table.fl-pricing-table-spacing-none.fl-pricing-table-border-medium [class^='fl-pricing-table-col-']:last-child .fl-pricing-table-column {border-right-width: 1px !important;}.fl-pricing-table.fl-pricing-table-spacing-none.fl-pricing-table-border-small [class^='fl-pricing-table-col-'] .fl-pricing-table-inner-wrap {margin-right: -1px !important;}.fl-pricing-table.fl-pricing-table-spacing-none.fl-pricing-table-border-small [class^='fl-pricing-table-col-']:last-child .fl-pricing-table-inner-wrap {margin-right: 0 !important;}.fl-pricing-table .fl-pricing-table-column {text-align: center;}.fl-pricing-table .fl-pricing-table-inner-wrap {margin: 12px;}.fl-pricing-table .fl-pricing-table-column .fl-pricing-table-price {padding: 13px 0;position: relative;z-index: 2;letter-spacing: -2px;}.fl-pricing-table .fl-pricing-table-column h2 {margin: 0;padding: 20px;}.fl-pricing-table .fl-pricing-table-column .fl-pricing-table-duration {font-size: .44em;display: inline-block;position: relative;bottom: 4px;letter-spacing: 0px;opacity: 0.85;}.fl-pricing-table .fl-pricing-table-features {margin: 20px 15px;list-style-type: none;padding: 0;}.fl-pricing-table .fl-pricing-table-features li {border-bottom: 1px solid rgba(0,0,0,0.15);text-align: left;padding: 13px 4px;}.fl-pricing-table .fl-pricing-table-features li:last-child {border-bottom: 0;}.fl-pricing-table a.fl-button {margin: 0 15px;}.fl-pricing-table a.fl-button .fl-button-text {line-height: 18px;}.fl-pricing-table.fl-pricing-table-rounded .fl-pricing-table-column {border-radius: 6px;}.fl-pricing-table.fl-pricing-table-rounded .fl-pricing-table-inner-wrap {border-radius: 3px;}.fl-pricing-table.fl-pricing-table-border-large .fl-pricing-table-inner-wrap {margin: 12px;}.fl-pricing-table.fl-pricing-table-border-large .fl-pricing-table-column .fl-pricing-table-price {margin: 0 -15px;}.fl-pricing-table.fl-pricing-table-border-large.fl-pricing-table-spacing-none .fl-pricing-table-column .fl-pricing-table-price {margin: 0 -14px;}.fl-pricing-table.fl-pricing-table-border-medium .fl-pricing-table-inner-wrap {margin: 6px;}.fl-pricing-table.fl-pricing-table-border-medium .fl-pricing-table-column .fl-pricing-table-price {margin: 0 -10px;}.fl-pricing-table.fl-pricing-table-border-small .fl-pricing-table-column {border: 0 !important;}.fl-pricing-table.fl-pricing-table-border-small .fl-pricing-table-inner-wrap {margin: 0px;}.fl-pricing-table.fl-pricing-table-border-small .fl-pricing-table-column .fl-pricing-table-price {margin: 0 -1px;}@media (max-width: 768px) { .fl-pricing-table .fl-pricing-table-col-8,.fl-pricing-table .fl-pricing-table-col-7,.fl-pricing-table .fl-pricing-table-col-6,.fl-pricing-table .fl-pricing-table-col-5,.fl-pricing-table .fl-pricing-table-col-4,.fl-pricing-table .fl-pricing-table-col-3,.fl-pricing-table .fl-pricing-table-col-2,.fl-pricing-table .fl-pricing-table-col-1 {width: 90%;float: none;margin: 35px auto;} }.fl-builder-content .fl-node-58aef0ea2cdc7 .fl-pricing-table-features{min-height: 0px;}.fl-builder-content .fl-node-58aef0ea2cdc7 .fl-pricing-table-column-0 {border: 1px solid #d4d4d4;background: #F2F2F2;margin-top: 0px;}.fl-builder-content .fl-node-58aef0ea2cdc7 .fl-pricing-table-column-0 .fl-pricing-table-inner-wrap {background: #ffffff;border: 1px solid #d4d4d4;}.fl-builder-content .fl-node-58aef0ea2cdc7 .fl-pricing-table-column-0 h2 {font-size: 24px;}.fl-builder-content .fl-node-58aef0ea2cdc7 .fl-pricing-table-column-0 .fl-pricing-table-price {font-size: 31px;}.fl-builder-content .fl-node-58aef0ea2cdc7 .fl-pricing-table-column-0 .fl-pricing-table-price {background: #f16521;color: #ffffff;}.fl-builder-content .fl-node-58aef0ea2cdc7 .fl-pricing-table-column-0 a.fl-button {}.fl-builder-content .fl-node-58aef0ea2cdc7 .fl-pricing-table-column-0 a.fl-button,.fl-builder-content .fl-node-58aef0ea2cdc7 .fl-pricing-table-column-0 a.fl-button:visited {font-size: 16px;line-height: 18px;padding: 12px 24px;border-radius: 4px;-moz-border-radius: 4px;-webkit-border-radius: 4px;background: #f16521;border: 1px solid #e55915;}.fl-builder-content .fl-node-58aef0ea2cdc7 .fl-pricing-table-column-0 a.fl-button,.fl-builder-content .fl-node-58aef0ea2cdc7 .fl-pricing-table-column-0 a.fl-button:visited,.fl-builder-content .fl-node-58aef0ea2cdc7 .fl-pricing-table-column-0 a.fl-button *,.fl-builder-content .fl-node-58aef0ea2cdc7 .fl-pricing-table-column-0 a.fl-button:visited * {color: #ffffff;}.fl-builder-content .fl-node-58aef0ea2cdc7 .fl-pricing-table-column-0 a.fl-button:hover,.fl-builder-content .fl-node-58aef0ea2cdc7 .fl-pricing-table-column-0 a.fl-button:focus {background: #ffffff;border: 1px solid #f3f3f3;}.fl-builder-content .fl-node-58aef0ea2cdc7 .fl-pricing-table-column-0 a.fl-button:hover,.fl-builder-content .fl-node-58aef0ea2cdc7 .fl-pricing-table-column-0 a.fl-button:focus,.fl-builder-content .fl-node-58aef0ea2cdc7 .fl-pricing-table-column-0 a.fl-button:hover *,.fl-builder-content .fl-node-58aef0ea2cdc7 .fl-pricing-table-column-0 a.fl-button:focus * {color: #f16521;}.fl-builder-content .fl-node-58aef0ea2cdc7 .fl-pricing-table-column-1 {border: 1px solid #d4d4d4;background: #F2F2F2;margin-top: 0px;}.fl-builder-content .fl-node-58aef0ea2cdc7 .fl-pricing-table-column-1 .fl-pricing-table-inner-wrap {background: #ffffff;border: 1px solid #d4d4d4;}.fl-builder-content .fl-node-58aef0ea2cdc7 .fl-pricing-table-column-1 h2 {font-size: 24px;}.fl-builder-content .fl-node-58aef0ea2cdc7 .fl-pricing-table-column-1 .fl-pricing-table-price {font-size: 31px;}.fl-builder-content .fl-node-58aef0ea2cdc7 .fl-pricing-table-column-1 .fl-pricing-table-price {background: #f16521;color: #ffffff;}.fl-builder-content .fl-node-58aef0ea2cdc7 .fl-pricing-table-column-1 a.fl-button {}.fl-builder-content .fl-node-58aef0ea2cdc7 .fl-pricing-table-column-1 a.fl-button,.fl-builder-content .fl-node-58aef0ea2cdc7 .fl-pricing-table-column-1 a.fl-button:visited {font-size: 16px;line-height: 18px;padding: 12px 24px;border-radius: 4px;-moz-border-radius: 4px;-webkit-border-radius: 4px;background: #f16521;border: 1px solid #e55915;}.fl-builder-content .fl-node-58aef0ea2cdc7 .fl-pricing-table-column-1 a.fl-button,.fl-builder-content .fl-node-58aef0ea2cdc7 .fl-pricing-table-column-1 a.fl-button:visited,.fl-builder-content .fl-node-58aef0ea2cdc7 .fl-pricing-table-column-1 a.fl-button *,.fl-builder-content .fl-node-58aef0ea2cdc7 .fl-pricing-table-column-1 a.fl-button:visited * {color: #ffffff;}.fl-builder-content .fl-node-58aef0ea2cdc7 .fl-pricing-table-column-1 a.fl-button:hover,.fl-builder-content .fl-node-58aef0ea2cdc7 .fl-pricing-table-column-1 a.fl-button:focus {background: #ffffff;border: 1px solid #f3f3f3;}.fl-builder-content .fl-node-58aef0ea2cdc7 .fl-pricing-table-column-1 a.fl-button:hover,.fl-builder-content .fl-node-58aef0ea2cdc7 .fl-pricing-table-column-1 a.fl-button:focus,.fl-builder-content .fl-node-58aef0ea2cdc7 .fl-pricing-table-column-1 a.fl-button:hover *,.fl-builder-content .fl-node-58aef0ea2cdc7 .fl-pricing-table-column-1 a.fl-button:focus * {color: #f16521;}.fl-builder-content .fl-node-58aef0ea2cdc7 .fl-pricing-table-column-2 {border: 1px solid #d4d4d4;background: #F2F2F2;margin-top: 0px;}.fl-builder-content .fl-node-58aef0ea2cdc7 .fl-pricing-table-column-2 .fl-pricing-table-inner-wrap {background: #ffffff;border: 1px solid #d4d4d4;}.fl-builder-content .fl-node-58aef0ea2cdc7 .fl-pricing-table-column-2 h2 {font-size: 24px;}.fl-builder-content .fl-node-58aef0ea2cdc7 .fl-pricing-table-column-2 .fl-pricing-table-price {font-size: 31px;}.fl-builder-content .fl-node-58aef0ea2cdc7 .fl-pricing-table-column-2 .fl-pricing-table-price {background: #696b5d;color: #ffffff;}.fl-builder-content .fl-node-58aef0ea2cdc7 .fl-pricing-table-column-2 a.fl-button {}.fl-builder-content .fl-node-58aef0ea2cdc7 .fl-pricing-table-column-2 a.fl-button,.fl-builder-content .fl-node-58aef0ea2cdc7 .fl-pricing-table-column-2 a.fl-button:visited {font-size: 16px;line-height: 18px;padding: 12px 24px;border-radius: 4px;-moz-border-radius: 4px;-webkit-border-radius: 4px;background: #f16521;border: 1px solid #e55915;}.fl-builder-content .fl-node-58aef0ea2cdc7 .fl-pricing-table-column-2 a.fl-button,.fl-builder-content .fl-node-58aef0ea2cdc7 .fl-pricing-table-column-2 a.fl-button:visited,.fl-builder-content .fl-node-58aef0ea2cdc7 .fl-pricing-table-column-2 a.fl-button *,.fl-builder-content .fl-node-58aef0ea2cdc7 .fl-pricing-table-column-2 a.fl-button:visited * {color: #ffffff;}.fl-builder-content .fl-node-58aef0ea2cdc7 .fl-pricing-table-column-2 a.fl-button:hover,.fl-builder-content .fl-node-58aef0ea2cdc7 .fl-pricing-table-column-2 a.fl-button:focus {background: #ffffff;border: 1px solid #f3f3f3;}.fl-builder-content .fl-node-58aef0ea2cdc7 .fl-pricing-table-column-2 a.fl-button:hover,.fl-builder-content .fl-node-58aef0ea2cdc7 .fl-pricing-table-column-2 a.fl-button:focus,.fl-builder-content .fl-node-58aef0ea2cdc7 .fl-pricing-table-column-2 a.fl-button:hover *,.fl-builder-content .fl-node-58aef0ea2cdc7 .fl-pricing-table-column-2 a.fl-button:focus * {color: #f16521;}.fl-builder-content .fl-node-58aef0ea2cdc7 .fl-pricing-table-column-3 {border: 1px solid #d4d4d4;background: #F2F2F2;margin-top: 0px;}.fl-builder-content .fl-node-58aef0ea2cdc7 .fl-pricing-table-column-3 .fl-pricing-table-inner-wrap {background: #ffffff;border: 1px solid #d4d4d4;}.fl-builder-content .fl-node-58aef0ea2cdc7 .fl-pricing-table-column-3 h2 {font-size: 24px;}.fl-builder-content .fl-node-58aef0ea2cdc7 .fl-pricing-table-column-3 .fl-pricing-table-price {font-size: 31px;}.fl-builder-content .fl-node-58aef0ea2cdc7 .fl-pricing-table-column-3 .fl-pricing-table-price {background: #696b5d;color: #ffffff;}.fl-builder-content .fl-node-58aef0ea2cdc7 .fl-pricing-table-column-3 a.fl-button {background-color: #696b5d !important;border: 1px solid #696b5d !important;}.fl-builder-content .fl-node-58aef0ea2cdc7 .fl-pricing-table-column-3 a.fl-button,.fl-builder-content .fl-node-58aef0ea2cdc7 .fl-pricing-table-column-3 a.fl-button:visited {font-size: 16px;line-height: 18px;padding: 12px 24px;border-radius: 4px;-moz-border-radius: 4px;-webkit-border-radius: 4px;}
                .fl-button-text{
                    color: #fff !important;
                }
            </style>
            <section class="page-item option-list">
                <div class="wrapper" style="max-width: 84% !important;">
                    <strong>Select your ecommerce platform</strong>
                    <nav class="nav-pills">
                        <?php
                        $ilo = 0;
                        foreach($platforms as $k => $platform): if ($k == '_id_') continue;?>
                            <button type="button" class="btn-filter <?php if($ilo == 0) echo 'active'; ?>" data-toggle="portfilter" data-target="<?=$platform->name;?>" data-order="DESC"><img src="<?=$platform->image;?>"></button>
                        <?php $ilo++;
                        endforeach; ?>
                    </nav>
                    <ul class="list-inline">
                     <?php $ilo = 0;
                     $visitor_ip = ip_info();
                     $currency = '$';
                     $continent = $visitor_ip['continent_code'];
                     if ($continent == 'EU') $currency = '€';
                     foreach($platforms as $k => $platform): if ($k == '_id_') continue;?>
                        <li data-tag="<?=$platform->name;?>" style="<?php if($ilo !== 0)echo 'display: none;';?>">
                            <div class="fl-col-content fl-node-content">
                                <div class="fl-module fl-module-pricing-table fl-node-58aef0ea2cdc7" data-node="58aef0ea2cdc7" data-animation-delay="0.0">
                                    <div class="fl-module-content fl-node-content">

                                        <div class="fl-pricing-table fl-pricing-table-spacing-large fl-pricing-table-border-large fl-pricing-table-rounded">
                                            <div class="fl-pricing-table-col-4">
                                                <div class="fl-pricing-table-column fl-pricing-table-column-0">
                                                    <div class="fl-pricing-table-inner-wrap">
                                                        <h2 class="fl-pricing-table-title">Build your own App<br>Pay Monthly</h2>
                                                        <div class="fl-pricing-table-price" style="background: <?=$platform->monthly_tcolor;?>!important">
                                                            <?=$currency;?><?=$platform->monthly_price;?> Monthly
                                                            <span class="fl-pricing-table-duration"><?=$platform->monthly_text;?></span>
                                                        </div>
                                                        <ul class="fl-pricing-table-features">
                                                            <?php for($d=0;$d<=9;$d++):
                                                                $platformn = 'monthly_feature_'.$d;
                                                                if (isset($platform->{$platformn}) && $platform->{$platformn} !== ""):?>
                                                                    <li><p style="text-align: center;"><?=$platform->{$platformn};?></p></li>
                                                                <?php endif;
                                                                endfor;?>
                                                        </ul>

                                                        <div class="fl-button-wrap fl-button-width-full fl-button-center">
                                                            <a href="<?=$platform->monthly_burl;?>" style="background: <?=$platform->monthly_bcolor;?>!important;color: white!important;" target="_self" class="fl-button" role="button">
                                                                <span class="fl-button-text">Get Started</span>
                                                            </a>
                                                        </div>
                                                        <br>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="fl-pricing-table-col-4">
                                                <div class="fl-pricing-table-column fl-pricing-table-column-1">
                                                    <div class="fl-pricing-table-inner-wrap">
                                                        <h2 class="fl-pricing-table-title">Build your own App<br>Pay yearly</h2>
                                                        <div class="fl-pricing-table-price" style="background: <?=$platform->yearly_tcolor;?>!important">
                                                            <?=$currency;?><?=$platform->yearly_price;?> Monthly
                                                            <span class="fl-pricing-table-duration"><?=$platform->yearly_text;?></span>
                                                        </div>
                                                        <ul class="fl-pricing-table-features">
                                                            <?php for($d=0;$d<=9;$d++):
                                                                $platformn = 'yearly_feature_'.$d;
                                                                if (isset($platform->{$platformn}) && $platform->{$platformn} !== ""):?>
                                                                    <li><p style="text-align: center;"><?=$platform->{$platformn};?></p></li>
                                                                <?php endif;
                                                            endfor;?>
                                                        </ul>

                                                        <div class="fl-button-wrap fl-button-width-full fl-button-center">
                                                            <a href="<?=$platform->yearly_burl;?>" style="background: <?=$platform->yearly_bcolor;?>!important; color: white !important;" target="_self" class="fl-button" role="button">
                                                                <span class="fl-button-text">Get Started</span>
                                                            </a>
                                                        </div>
                                                        <br>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="fl-pricing-table-col-4">
                                                <div class="fl-pricing-table-column fl-pricing-table-column-2">
                                                    <div class="fl-pricing-table-inner-wrap">
                                                        <h2 class="fl-pricing-table-title">We build your App<br>Total Package</h2>
                                                        <div class="fl-pricing-table-price" style="background: <?=$platform->total_tcolor;?>!important">
                                                            <?=$currency;?><?=$platform->total_price;?> Monthly
                                                            <span class="fl-pricing-table-duration"><?=$platform->total_text;?></span>
                                                        </div>
                                                        <ul class="fl-pricing-table-features">
                                                            <?php for($d=0;$d<=9;$d++):
                                                                $platformn = 'total_feature_'.$d;
                                                                if (isset($platform->{$platformn}) && $platform->{$platformn} !== ""):?>
                                                                    <li><p style="text-align: center;"><?=$platform->{$platformn};?></p></li>
                                                                <?php endif;
                                                            endfor;?>
                                                        </ul>

                                                        <div class="fl-button-wrap fl-button-width-full fl-button-center">
                                                            <a href="<?=$platform->total_burl;?>" target="_self" class="fl-button" role="button" style="background: <?=$platform->total_bcolor;?>!important; color: white !important">
                                                                <span class="fl-button-text" >Get Started</span>
                                                            </a>
                                                        </div>
                                                        <br>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="fl-pricing-table-col-4">
                                                <div class="fl-pricing-table-column fl-pricing-table-column-3">
                                                    <div class="fl-pricing-table-inner-wrap">
                                                        <h2 class="fl-pricing-table-title">Build Package<br></h2>
                                                        <div class="fl-pricing-table-price">
                                                            <?=$currency;?><?=$platform->build_price;?>
                                                            <span class="fl-pricing-table-duration">One-off</span>
                                                        </div>
                                                        <ul class="fl-pricing-table-features">
                                                            <li>One-off payment</li>
                                                            <li></li>
                                                        </ul>

                                                        <div class="fl-button-wrap fl-button-width-full fl-button-center">
                                                            <a href="" target="_self" class="fl-button" role="button">
                                                                <span class="fl-button-text">Get Started</span>
                                                            </a>
                                                        </div>
                                                        <br>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>	</div>

                        </li>

                        <?php $ilo++;
                     endforeach; ?>
                    </ul>
                </div>
            </section>
            <?php
        endif;

    }

}

add_action ( 'admin_enqueue_scripts', function () {
    if (is_admin ())
        wp_enqueue_media ();
} );
add_action('widgets_init', create_function('', 'return register_widget("AS_Pricing2");'));
