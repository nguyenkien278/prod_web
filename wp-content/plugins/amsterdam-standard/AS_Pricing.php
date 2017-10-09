<?php

/*
Plugin Name: [AS] Pricing
Plugin URI: http://amsterdamstandard.com/
Description: AS Component - Pricing
Author: Amsterdam Standard
Version: 2.1
Author URI: http://amsterdamstandard.com/
*/

function ip_info($ip = NULL, $purpose = "location", $deep_detect = TRUE) {
    $output = NULL;
    if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
        $ip = $_SERVER["REMOTE_ADDR"];
        if ($deep_detect) {
            if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
                $ip = $_SERVER['HTTP_CLIENT_IP'];
        }
    }
    $purpose    = str_replace(array("name", "\n", "\t", " ", "-", "_"), NULL, strtolower(trim($purpose)));
    $support    = array("country", "countrycode", "state", "region", "city", "location", "address");
    $continents = array(
        "AF" => "Africa",
        "AN" => "Antarctica",
        "AS" => "Asia",
        "EU" => "Europe",
        "OC" => "Australia (Oceania)",
        "NA" => "North America",
        "SA" => "South America"
    );
    if (filter_var($ip, FILTER_VALIDATE_IP) && in_array($purpose, $support)) {
        $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
        if (@strlen(trim($ipdat->geoplugin_countryCode)) == 2) {
            switch ($purpose) {
                case "location":
                    $output = array(
                        "city"           => @$ipdat->geoplugin_city,
                        "state"          => @$ipdat->geoplugin_regionName,
                        "country"        => @$ipdat->geoplugin_countryName,
                        "country_code"   => @$ipdat->geoplugin_countryCode,
                        "continent"      => @$continents[strtoupper($ipdat->geoplugin_continentCode)],
                        "continent_code" => @$ipdat->geoplugin_continentCode
                    );
                    break;
                case "address":
                    $address = array($ipdat->geoplugin_countryName);
                    if (@strlen($ipdat->geoplugin_regionName) >= 1)
                        $address[] = $ipdat->geoplugin_regionName;
                    if (@strlen($ipdat->geoplugin_city) >= 1)
                        $address[] = $ipdat->geoplugin_city;
                    $output = implode(", ", array_reverse($address));
                    break;
                case "city":
                    $output = @$ipdat->geoplugin_city;
                    break;
                case "state":
                    $output = @$ipdat->geoplugin_regionName;
                    break;
                case "region":
                    $output = @$ipdat->geoplugin_regionName;
                    break;
                case "country":
                    $output = @$ipdat->geoplugin_countryName;
                    break;
                case "countrycode":
                    $output = @$ipdat->geoplugin_countryCode;
                    break;
            }
        }
    }
    return $output;
}

class AS_Pricing extends WP_Widget
{

    function AS_Pricing()
    {
        parent::__construct(false, $name = __('AS Pricing', 'wp_widget_plugin')); 
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
            .add-new-plat{
                padding: 0 10px;
                color: white !important;
                font-weight: bold;
                background: #585858;
                float: right !important;
                display: block;
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
                    <th></th>
                    <td>
                        <div class="removeit">Remove platform</div>
                    </td>
                </tr>
                <tr class="fl-field">
                    <th>
                        <label> Image </label>
                    </th>
                    <td>
                        <input class="widefat process_custom_images" name="widget-as_pricing[][<?=$k;?>][image]" type="text"
                               value="<?=$platform->image;?>"/>
                        <button class="set_custom_images fl-builder-button">Browse image</button>
                        <hr>
                        <img style="height: 30px;" src="<?=$platform->image;?>">

                    </td>
                </tr>
                <tr class="fl-field">
                    <th>
                        <label> Name </label>
                    </th>
                    <td>
                        <input class="widefat" name="widget-as_pricing[][<?=$k;?>][name]" type="text"
                               value="<?=$platform->name;?>"/>
                    </td>
                </tr>
                <tr class="fl-field">
                    <th>
                        <label> Heading1 </label>
                    </th>
                    <td>
                        <input class="widefat" name="widget-as_pricing[][<?=$k;?>][heading1]" type="text"
                               value="<?=$platform->heading1;?>"/>
                    </td>
                </tr>
                <tr class="fl-field">
                    <th>
                        <label> Content1 </label>
                    </th>
                    <td>
                        <textarea class="widefat" name="widget-as_pricing[][<?=$k;?>][content1]"><?= $platform->content1;?></textarea>
                    </td>
                </tr>
                <tr class="fl-field">
                    <th>
                        <label> Coming soon </label>
                    </th>
                    <td>
                        <input type="checkbox" class="soon" name="widget-as_pricing[][<?=$k;?>][soon]"
                        <?php if(isset($platform->soon) && $platform->soon == 'on') echo 'checked';?>/>
                    </td>
                </tr>
                <tr class="fl-field">
                    <th>
                        <label> Heading3 (Coming soon)</label>
                    </th>
                    <td>
                        <input class="widefat" name="widget-as_pricing[][<?=$k;?>][heading3]" type="text"
                               value="<?=$platform->heading3;?>"/>
                    </td>
                </tr>
                <tr class="fl-field">
                    <th>
                        <label> Content3 (Coming soon)</label>
                    </th>
                    <td>
                        <textarea class="widefat" name="widget-as_pricing[][<?=$k;?>][content3]"><?= $platform->content3;?></textarea>
                    </td>
                </tr>
                <tr class="fl-field">
                    <th>
                        <label> Monthly/Yearly </label>
                    </th>
                    <td>
                        <input class="widefat" name="widget-as_pricing[][<?=$k;?>][monthly]" type="number" value="<?=$platform->monthly;?>"/>
                        <input class="widefat" name="widget-as_pricing[][<?=$k;?>][yearly]" type="number" value="<?=$platform->yearly;?>"/>
                    </td>
                </tr>
                <tr class="fl-field">
                    <th>
                        <label> Content2 </label>
                    </th>
                    <td>
                        <textarea class="widefat" name="widget-as_pricing[][<?=$k;?>][content2]"><?= $platform->content2;?></textarea>
                    </td>
                </tr>

                </tbody>
            </table>
            <?php endforeach; endif; ?>

            <div class="copy" style="display: none" data-count="<?= (int)$count-1; ?>">
                <table class="fl-form-table platformers" id="platform_id_">
                <tbody>
                <tr class="fl-field">
                    <th></th>
                    <td>
                        <div class="removeit">Remove platform</div>
                    </td>
                </tr>
                <tr class="fl-field">
                    <th>
                        <label> Image </label>
                    </th>
                    <td>
                        <input class="widefat process_custom_images" name="widget-as_pricing[][_id_][image]" type="text"
                               value=""/>
                        <button class="set_custom_images fl-builder-button">Browse image</button>
                        <hr>
                        <img style="height: 30px" src="<?=$platform->image;?>">

                    </td>
                </tr>
                <tr class="fl-field">
                    <th>
                        <label> Name </label>
                    </th>
                    <td>
                        <input class="widefat" name="widget-as_pricing[][_id_][name]" type="text"
                               value=""/>
                    </td>
                </tr>
                <tr class="fl-field">
                    <th>
                        <label> Heading1 </label>
                    </th>
                    <td>
                        <input class="widefat" name="widget-as_pricing[][_id_][heading1]" type="text"
                               value=""/>
                    </td>
                </tr>
                <tr class="fl-field">
                    <th>
                        <label> Content1 </label>
                    </th>
                    <td>
                        <textarea class="widefat" name="widget-as_pricing[][_id_][content1]"></textarea>
                    </td>
                </tr>
                <tr class="fl-field">
                    <th>
                        <label> Coming soon </label>
                    </th>
                    <td>
                        <input type="checkbox" class="soon" name="widget-as_pricing[][_id_][soon]"/>
                    </td>
                </tr>
                <tr class="fl-field">
                    <th>
                        <label> Heading3 (Coming soon)</label>
                    </th>
                    <td>
                        <input class="widefat" name="widget-as_pricing[][_id_][heading3]" type="text"
                               value=""/>
                    </td>
                </tr>
                <tr class="fl-field">
                    <th>
                        <label> Content3 (Coming soon)</label>
                    </th>
                    <td>
                        <textarea class="widefat" name="widget-as_pricing[][_id_][content3]"></textarea>
                    </td>
                </tr>
                <tr class="fl-field">
                    <th>
                        <label> Monthly/Yearly </label>
                    </th>
                    <td>
                        <input class="widefat" name="widget-as_pricing[][_id_][monthly]" type="number" value=""/>
                        <input class="widefat" name="widget-as_pricing[][_id_][yearly]" type="number" value=""/>
                    </td>
                </tr>
                <tr class="fl-field">
                    <th>
                        <label> Content2 </label>
                    </th>
                    <td>
                        <textarea class="widefat" name="widget-as_pricing[][_id_][content2]"></textarea>
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
            </style>
            <section class="page-item option-list">
                <div class="wrapper">
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
                     foreach($platforms as $k => $platform): if ($k == '_id_') continue;?>
                        <li data-tag="<?=$platform->name;?>" style="<?php if($ilo !== 0)echo 'display: none;';?>">
                            <?php if (isset($platform->soon) && $platform->soon == 'on'): ?>
                            <article class="option option-standard EU comingsooner">
                                <header>
                                    <h3><?=$platform->heading1;?></h3>
                                    <?=$platform->content1;?>
                                </header>

                                <section class="price-description">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li role="presentation" class="active"><a href="#yearly-<?=$k;?>" aria-controls="yearly" role="tab" data-toggle="tab">Pay Yearly <span class="highlight">(Get 2 months for free)</span></a></li>
                                        <li role="presentation"><a href="#monthly-<?=$k;?>" aria-controls="monthly" role="tab" data-toggle="tab">Pay Monthly </a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div id="yearly-<?=$k;?>" role="tabpanel" class="tab-pane active">

                                            <div><span class="price"><span class="euro"><?=$currency;?></span><?=$platform->yearly;?><span class="small"> / monthly ex. VAT</span></span></div>

                                            <p><?=$platform->content2;?></p>

                                        </div>
                                        <div id="monthly-<?=$k;?>" role="tabpanel" class="tab-pane">

                                            <div><span class="price"><span class="euro"><?=$currency;?></span><?=$platform->monthly;?><span class="small"> / monthly ex. VAT</span></span></div>

                                            <p><?=$platform->content2;?></p>

                                        </div>
                                    </div>
                                </section>
                                <footer>
                                    <p><a class="btn btn-cta" href="/sign-up/">Build your App for free</a></p>
                                    <a href="" class="md-trigger" data-modal="modal-features-<?=$platform->name;?>">Compare features</a>                  <!-- <p><a href="" class="btn-cta">Create your app for free</a></p> -->
                                </footer>
                            </article>
                            <article class="option option-comingsoon comingsooner">
                                <header>
                                    <h3><?=$platform->heading3;?></h3>
                                    <p><?=$platform->content3;?></p>
                                </header>
                                <section class="form">
                                    <h3>Coming soon...</h3>
                                    <p>We can send you an email when it's ready to go.</p>
                                    <div id="crmWebToEntityForm">
                                        <meta http-equiv="content-type" content="text/html;charset=UTF-8">
                                        <form action="https://crm.zoho.com/crm/WebToLeadForm" name="WebToLeads1121447000007236025" id="shopify-form" method="POST" onsubmit="javascript:document.charset=&quot;UTF-8&quot;;" accept-charset="UTF-8" novalidate="novalidate" siq_id="autopick_5743">

                                            <!-- Do not remove this code. -->
                                            <input type="text" style="display:none;" name="xnQsjsdp" value="ee1a771653793e0a5a10c7fd58d8199b813cc08e0d93551e61e156267a979a30">
                                            <input type="hidden" name="zc_gad" id="zc_gad" value="">
                                            <input type="text" style="display:none;" name="xmIwtLD" value="d747c83263ac48ea52cbe1cf9fdae0b22985da615ada3595a850008895ae2102">
                                            <input type="text" style="display:none;" name="actionType" value="TGVhZHM=">

                                            <input type="text" style="display:none;" name="returnURL" value="http://www.jmango360.com/thank-you-notify/">
                                            <!-- Do not remove this code. -->
                                            <p>

                                                <input type="email" name="Email" required="" class="form-control" aria-required="true">
                                            </p>
                                            <p style="display:none;">
                                                <select style="width:250px;" name="LEADCF9">
                                                    <option value="-None-">-None-</option>
                                                    <option value="Newsletter Sign-up">Newsletter Sign-up</option>
                                                    <option value="Contact Us form">Contact Us form</option>
                                                    <option value="Partner Program">Partner Program</option>
                                                    <option value="Support">Support</option>
                                                    <option value="Other">Other</option>
                                                    <option value="Demo request">Demo request</option>
                                                    <option selected="" value="Notify me Shopify">Notify me Shopify</option>
                                                    <option value="Notify me Prestoshop">Notify me Prestoshop</option>
                                                    <option value="Notify me other">Notify me other</option>
                                                </select></p>

                                            <p style="display:none;">		<select style="width:250px;" name="Lead Source">
                                                    <option value="-None-">Geen</option>
                                                    <option value="Database MultiStore">Database MultiStore</option>
                                                    <option value="Database oud">Database oud</option>
                                                    <option value="Email">E-mail</option>
                                                    <option value="Event">Gebeurtenis</option>
                                                    <option value="Aexus">Aexus</option>
                                                    <option value="Google AdWords">Google AdWords</option>
                                                    <option value="JAM Sign-ups">JAM Sign-ups</option>
                                                    <option value="KiyOh">KiyOh</option>
                                                    <option value="Manual Entry">Manual Entry</option>
                                                    <option value="Marketing Partner">Marketing Partner</option>
                                                    <option value="MultiSafepay klant">MultiSafepay klant</option>
                                                    <option value="Phone">Telefoon</option>
                                                    <option value="Propulsion (callcenter)">Propulsion (callcenter)</option>
                                                    <option value="Propulsion AB test">Propulsion AB test</option>
                                                    <option value="Referral">Referral</option>
                                                    <option value="Reseller">Wederverkoper</option>
                                                    <option selected="" value="Webform">Webform</option>
                                                </select></p>


                                            <input class="btn" type="submit" value="Send">


                                        </form>
                                    </div>
                                </section>
                            </article>
                                <div class="md-modal" id="modal-features-<?=$platform->name;?>">
                                    <div class="md-content">
                                        <div>

                                            <div id="tablepress-1_wrapper" class="dataTables_wrapper no-footer"><table id="tablepress-1" class="tablepress tablepress-id-1 dataTable no-footer" role="grid">
                                                    <caption style="caption-side:bottom;text-align:left;border:none;background:none;margin:0;padding:0;"><a href="https://jmango360.com/wp-admin/admin.php?page=tablepress&amp;action=edit&amp;table_id=1">Edit</a></caption>
                                                    <thead>
                                                    <tr class="row-1" role="row"><th class="column-1 sorting_disabled" rowspan="1" colspan="1" style="width: 0px;"><a href="" class="md-close btn" data-dismiss="modal" data-target="#modal-features">Close this window</a></th><th class="column-2 sorting_disabled" rowspan="1" colspan="1" style="width: 0px;"><p><?=$platform->heading1;?></p><p></p></th></tr>
                                                    </thead>
                                                    <tbody>























                                                    <tr class="row-2" role="row">
                                                        <td class="column-1">Free Creation and Preview of the App <span class="fa fa-info" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" data-title="" data-content="You can build and design the app for free. Once you're satisfied with the app you can publish it. Only then your subscription starts" data-original-title="" title=""></span></td><td class="column-2"><span class="fa fa-check"></span></td>
                                                    </tr><tr class="row-3" role="row">
                                                        <td class="column-1">No Upfront Costs</td><td class="column-2"><span class="fa fa-check"></span></td>
                                                    </tr><tr class="row-4" role="row">
                                                        <td class="column-1">Flexible Terms and Subscription</td><td class="column-2"><span class="fa fa-check"></span></td>
                                                    </tr><tr class="row-5" role="row">
                                                        <td class="column-1">App suitable for iPhone &amp; Android</td><td class="column-2"><span class="fa fa-check"></span></td>
                                                    </tr><tr class="row-6" role="row">
                                                        <td class="column-1">Deep integration with your online store <span class="fa fa-info" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" data-title="" data-content="Your App is deeply connected to your online store via a plug-in. This means changing stock levels, new product's, user-ID’s and all other relevant data and content is synchronized real-time with your webshop. Resulting in just one backend and no administrative tasks to keep the App up-to-date." data-original-title="" title=""></span></td><td class="column-2"><span class="fa fa-check"></span></td>
                                                    </tr><tr class="row-7" role="row">
                                                        <td class="column-1">Customizable Design</td><td class="column-2"><span class="fa fa-check"></span></td>
                                                    </tr><tr class="row-8" role="row">
                                                        <td class="column-1">Ability to add Unlimited Products</td><td class="column-2"><span class="fa fa-check"></span></td>
                                                    </tr><tr class="row-9" role="row">
                                                        <td class="column-1">Unlimited use of Push Notifications </td><td class="column-2"><span class="fa fa-check"></span></td>
                                                    </tr><tr class="row-10" role="row">
                                                        <td class="column-1">Deep linking in Push Notifications <span class="fa fa-info" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" data-title="" data-content="Allows you to send users notifications that click through directly to a category page or product page within your app, thus boosting the buy through." data-original-title="" title=""></span></td><td class="column-2"><span class="fa fa-check"></span></td>
                                                    </tr><tr class="row-11" role="row">
                                                        <td class="column-1">Available for all Currencies </td><td class="column-2"><span class="fa fa-check"></span></td>
                                                    </tr><tr class="row-12" role="row">
                                                        <td class="column-1">Adjustable to all Languages Settings <br>
                                                        </td><td class="column-2"><span class="fa fa-check"></span></td>
                                                    </tr><tr class="row-13" role="row">
                                                        <td class="column-1">End-to-end native User Experience <span class="fa fa-info" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" data-title="" data-content="Native means that all the functionalities of the App are installed on the phone of the user once they download the App. Non-native Apps still rely on the mobile webstore for certain functionalities, like viewing products. Therefore native Apps are much quicker and deliver a superior user experience." data-original-title="" title=""></span></td><td class="column-2"><span class="fa fa-check"></span></td>
                                                    </tr><tr class="row-14" role="row">
                                                        <td class="column-1">Fast and easy Check-out </td><td class="column-2"><span class="fa fa-check"></span></td>
                                                    </tr><tr class="row-15" role="row">
                                                        <td class="column-1">Fast Load Time </td><td class="column-2"><span class="fa fa-check"></span></td>
                                                    </tr><tr class="row-16" role="row">
                                                        <td class="column-1">Fast Login with Stored User ID  </td><td class="column-2"><span class="fa fa-check"></span></td>
                                                    </tr><tr class="row-17" role="row">
                                                        <td class="column-1">Fast Product Browsing </td><td class="column-2"><span class="fa fa-check"></span></td>
                                                    </tr><tr class="row-18" role="row">
                                                        <td class="column-1">Native Payment Methods <span class="fa fa-info" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" data-title="" data-content="Native payment means that, once your customers are ready to buy, we support certain payment methods within the app itself. You don’t send users to external platforms, which removes friction in the buying process. " data-original-title="" title=""></span></td><td class="column-2"><span class="fa fa-check"></span></td>
                                                    </tr><tr class="row-19" role="row">
                                                        <td class="column-1">Payment Methods imported from backoffice</td><td class="column-2"><span class="fa fa-check"></span></td>
                                                    </tr><tr class="row-20" role="row">
                                                        <td class="column-1">Shipping Methods imported from backoffice</td><td class="column-2"><span class="fa fa-check"></span></td>
                                                    </tr><tr class="row-21" role="row">
                                                        <td class="column-1">Multistore capabilities </td><td class="column-2"><span class="fa fa-check"></span></td>
                                                    </tr><tr class="row-22" role="row">
                                                        <td class="column-1">Customer Wishlist <span class="fa fa-info" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" data-title="" data-content="Users can put products on their wishlist. Even if they close the app, the data of the wishlist is saved for their next visit. Customers have a better app experience and you get higher conversions in return." data-original-title="" title=""></span><br>
                                                        </td><td class="column-2"><span class="fa fa-check"></span></td>
                                                    </tr><tr class="row-23" role="row">
                                                        <td class="column-1">Synchronized Shopping Carts <span class="fa fa-info" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" data-title="" data-content="Items that have been added to a shopping cart on your website are also shown in the shopping cart of the app, and vice versa." data-original-title="" title=""></span></td><td class="column-2"><span class="fa fa-check"></span></td>
                                                    </tr><tr class="row-24" role="row">
                                                        <td class="column-1">App Analytics Dashboard</td><td class="column-2"><span class="fa fa-check"></span></td>
                                                    </tr></tbody>
                                                </table></div>
                                            <button class="md-close">Close me!</button>
                                            <a href="" class="btn md-close" data-dismiss="modal" data-target="#modal-features">Close this window</a>
                                        </div>
                                    </div>
                                </div>
                            <?php else: ?>
                            <article class="option option-standard EU">
                                <header>
                                    <h3><?=$platform->heading1;?></h3>
                                    <?=$platform->content1;?>
                                </header>
                                <section class="price-description">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li role="presentation" class="active"><a href="#yearly-<?=$k;?>" aria-controls="yearly" role="tab" data-toggle="tab" aria-expanded="true">Pay Yearly <span class="highlight">(Get 2 months for free)</span></a></li>
                                        <li role="presentation" class=""><a href="#monthly-<?=$k;?>" aria-controls="monthly" role="tab" data-toggle="tab" aria-expanded="false">Pay Monthly </a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div id="yearly-<?=$k;?>" role="tabpanel" class="tab-pane active">

                                            <div><span class="price"><span class="euro"><?=$currency;?></span><?=$platform->yearly;?><span class="small"> / monthly ex. VAT</span></span></div>

                                            <p><?=$platform->content2;?></p>

                                        </div>
                                        <div id="monthly-<?=$k;?>" role="tabpanel" class="tab-pane">

                                            <div><span class="price"><span class="euro"><?=$currency;?></span><?=$platform->monthly;?><span class="small"> / monthly ex. VAT</span></span></div>

                                            <p><?=$platform->content2;?></p>

                                        </div>
                                    </div>
                                </section>
                                <footer>
                                    <p><a class="btn btn-cta" href="/sign-up/">Build your App for free</a></p>
                                    <a href="" class="md-trigger" data-modal="modal-features-<?=$platform->name;?>">See all features</a>                  <!-- <p><a href="" class="btn-cta">Create your app for free</a></p> -->
                                </footer>
                            </article>
                            <div class="md-modal" id="modal-features-<?=$platform->name;?>">
                                    <div class="md-content">
                                        <div>

                                            <div id="tablepress-1-no-2_wrapper" class="dataTables_wrapper no-footer"><table id="tablepress-1-no-2" class="tablepress tablepress-id-1 dataTable no-footer" role="grid">
                                                    <caption style="caption-side:bottom;text-align:left;border:none;background:none;margin:0;padding:0;"><a href="https://jmango360.com/wp-admin/admin.php?page=tablepress&amp;action=edit&amp;table_id=1">Edit</a></caption>
                                                    <thead>
                                                    <tr class="row-1" role="row"><th class="column-1 sorting_disabled" rowspan="1" colspan="1" style="width: 469px;"><a href="" class="md-close btn" data-dismiss="modal" data-target="#modal-features">Close this window</a></th><th class="column-2 sorting_disabled" rowspan="1" colspan="1" style="width: 351px;"><p><?=$platform->heading1;?></p><p></p></th></tr>
                                                    </thead>
                                                    <tbody>























                                                    <tr class="row-2" role="row">
                                                        <td class="column-1">Free Creation and Preview of the App <span class="fa fa-info" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" data-title="" data-content="You can build and design the app for free. Once you're satisfied with the app you can publish it. Only then your subscription starts" data-original-title="" title=""></span></td><td class="column-2"><span class="fa fa-check"></span></td>
                                                    </tr><tr class="row-3" role="row">
                                                        <td class="column-1">No Upfront Costs</td><td class="column-2"><span class="fa fa-check"></span></td>
                                                    </tr><tr class="row-4" role="row">
                                                        <td class="column-1">Flexible Terms and Subscription</td><td class="column-2"><span class="fa fa-check"></span></td>
                                                    </tr><tr class="row-5" role="row">
                                                        <td class="column-1">App suitable for iPhone &amp; Android</td><td class="column-2"><span class="fa fa-check"></span></td>
                                                    </tr><tr class="row-6" role="row">
                                                        <td class="column-1">Deep integration with your online store <span class="fa fa-info" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" data-title="" data-content="Your App is deeply connected to your online store via a plug-in. This means changing stock levels, new product's, user-ID’s and all other relevant data and content is synchronized real-time with your webshop. Resulting in just one backend and no administrative tasks to keep the App up-to-date." data-original-title="" title=""></span></td><td class="column-2"><span class="fa fa-check"></span></td>
                                                    </tr><tr class="row-7" role="row">
                                                        <td class="column-1">Customizable Design</td><td class="column-2"><span class="fa fa-check"></span></td>
                                                    </tr><tr class="row-8" role="row">
                                                        <td class="column-1">Ability to add Unlimited Products</td><td class="column-2"><span class="fa fa-check"></span></td>
                                                    </tr><tr class="row-9" role="row">
                                                        <td class="column-1">Unlimited use of Push Notifications </td><td class="column-2"><span class="fa fa-check"></span></td>
                                                    </tr><tr class="row-10" role="row">
                                                        <td class="column-1">Deep linking in Push Notifications <span class="fa fa-info" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" data-title="" data-content="Allows you to send users notifications that click through directly to a category page or product page within your app, thus boosting the buy through." data-original-title="" title=""></span></td><td class="column-2"><span class="fa fa-check"></span></td>
                                                    </tr><tr class="row-11" role="row">
                                                        <td class="column-1">Available for all Currencies </td><td class="column-2"><span class="fa fa-check"></span></td>
                                                    </tr><tr class="row-12" role="row">
                                                        <td class="column-1">Adjustable to all Languages Settings <br>
                                                        </td><td class="column-2"><span class="fa fa-check"></span></td>
                                                    </tr><tr class="row-13" role="row">
                                                        <td class="column-1">End-to-end native User Experience <span class="fa fa-info" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" data-title="" data-content="Native means that all the functionalities of the App are installed on the phone of the user once they download the App. Non-native Apps still rely on the mobile webstore for certain functionalities, like viewing products. Therefore native Apps are much quicker and deliver a superior user experience." data-original-title="" title=""></span></td><td class="column-2"><span class="fa fa-check"></span></td>
                                                    </tr><tr class="row-14" role="row">
                                                        <td class="column-1">Fast and easy Check-out </td><td class="column-2"><span class="fa fa-check"></span></td>
                                                    </tr><tr class="row-15" role="row">
                                                        <td class="column-1">Fast Load Time </td><td class="column-2"><span class="fa fa-check"></span></td>
                                                    </tr><tr class="row-16" role="row">
                                                        <td class="column-1">Fast Login with Stored User ID  </td><td class="column-2"><span class="fa fa-check"></span></td>
                                                    </tr><tr class="row-17" role="row">
                                                        <td class="column-1">Fast Product Browsing </td><td class="column-2"><span class="fa fa-check"></span></td>
                                                    </tr><tr class="row-18" role="row">
                                                        <td class="column-1">Native Payment Methods <span class="fa fa-info" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" data-title="" data-content="Native payment means that, once your customers are ready to buy, we support certain payment methods within the app itself. You don’t send users to external platforms, which removes friction in the buying process. " data-original-title="" title=""></span></td><td class="column-2"><span class="fa fa-check"></span></td>
                                                    </tr><tr class="row-19" role="row">
                                                        <td class="column-1">Payment Methods imported from backoffice</td><td class="column-2"><span class="fa fa-check"></span></td>
                                                    </tr><tr class="row-20" role="row">
                                                        <td class="column-1">Shipping Methods imported from backoffice</td><td class="column-2"><span class="fa fa-check"></span></td>
                                                    </tr><tr class="row-21" role="row">
                                                        <td class="column-1">Multistore capabilities </td><td class="column-2"><span class="fa fa-check"></span></td>
                                                    </tr><tr class="row-22" role="row">
                                                        <td class="column-1">Customer Wishlist <span class="fa fa-info" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" data-title="" data-content="Users can put products on their wishlist. Even if they close the app, the data of the wishlist is saved for their next visit. Customers have a better app experience and you get higher conversions in return." data-original-title="" title=""></span><br>
                                                        </td><td class="column-2"><span class="fa fa-check"></span></td>
                                                    </tr><tr class="row-23" role="row">
                                                        <td class="column-1">Synchronized Shopping Carts <span class="fa fa-info" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" data-title="" data-content="Items that have been added to a shopping cart on your website are also shown in the shopping cart of the app, and vice versa." data-original-title="" title=""></span></td><td class="column-2"><span class="fa fa-check"></span></td>
                                                    </tr><tr class="row-24" role="row">
                                                        <td class="column-1">App Analytics Dashboard</td><td class="column-2"><span class="fa fa-check"></span></td>
                                                    </tr></tbody>
                                                </table></div>
                                            <button class="md-close">Close me!</button>
                                            <a href="" class="btn md-close" data-dismiss="modal" data-target="#modal-features">Close this window</a>
                                        </div>
                                    </div>
                                </div>
                            <?php endif;?>
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
add_action('widgets_init', create_function('', 'return register_widget("AS_Pricing");'));
