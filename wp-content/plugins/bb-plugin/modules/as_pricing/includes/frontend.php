<?php
if (!function_exists('ip_info')){
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
}

$pricings = $settings->pricings;
?>
<section class="page-item option-list">
    <div class="wrapper" style="max-width: 84% !important;">
        <strong>Select your ecommerce platform</strong>
        <nav class="nav-pills">
            <?php
            foreach($pricings as $k => $platform):?>
                <button type="button" class="btn-filter <?php if($k == 0) echo 'active'; ?>"
                        data-toggle="portfilter"
                        data-target="<?=$platform->name;?>"
                        data-order="DESC">
                    <img src="<?=wp_get_attachment_url($platform->bg_photo);?>">
                </button>
            <?php endforeach; ?>
        </nav>
        <ul class="list-inline">
            <?php
            $visitor_ip = ip_info();
            $currency = '$';
            $continent = $visitor_ip['continent_code'];
            if ($continent == 'EU') $currency = '€';
            foreach($pricings as $k => $platform):

                ?>
                <li data-tag="<?=$platform->name;?>" style="<?php if($k !== 0)echo 'display: none;';?>">
                    <div class="fl-col-content fl-node-content">
                        <div class="fl-module fl-module-pricing-table fl-node-58aef0ea2cdc7">
                            <div class="fl-module-content fl-node-content">

                                <div class="fl-pricing-table fl-pricing-table-spacing-large fl-pricing-table-border-large fl-pricing-table-rounded">
                                    <?php $col = 4;
                                    if(isset($platform->monthly_button_text) && $platform->monthly_button_text == ''){
                                        $col--;
                                    } if(isset($platform->yearly_button_text) && $platform->yearly_button_text == ''){
                                        $col--;
                                    }if(isset($platform->total_button_text) && $platform->total_button_text == ''){
                                        $col--;
                                    }if(isset($platform->build_button_text) && $platform->build_button_text == ''){
                                        $col--;
                                    }
                                    ?>

                                    <?php if(isset($platform->monthly_button_text) && $platform->monthly_button_text !== ''):?>
                                    <div class="fl-pricing-table-col-<?=$col;?>">
                                        <div class="fl-pricing-table-column fl-pricing-table-column-0">
                                            <div class="fl-pricing-table-inner-wrap">
                                                <h2 class="fl-pricing-table-title"><?=$platform->monthly_heading;?></h2>
                                                <div class="fl-pricing-table-price" style="background: #<?=$platform->monthly_table_background;?>!important">
                                                    <?=$currency;?><?=$platform->monthly_price;?> monthly <br>
                                                    <span class="fl-pricing-table-duration"><?=$platform->monthly_subtext;?></span>
                                                </div>
                                                <ul class="fl-pricing-table-features">
                                                    <?php for($d=0;$d<=9;$d++):
                                                        $platformn = 'monthly_feature'.$d;
                                                        if (isset($platform->{$platformn}) && $platform->{$platformn} !== ""):?>
                                                            <li><p style="text-align: center;"><?=$platform->{$platformn};?></p></li>
                                                        <?php endif;
                                                    endfor;?>
                                                </ul>

                                                <div class="fl-button-wrap fl-button-width-full fl-button-center">
                                                    <a href="<?=$platform->monthly_button_url;?>" style="background: #<?=$platform->monthly_button_background;?>!important;color: white!important; border:none" target="_self" class="fl-button" role="button">
                                                        <span class="fl-button-text"><?=$platform->monthly_button_text;?></span>
                                                    </a>
                                                </div>
                                                <br>

                                            </div>
                                        </div>
                                    </div>
                                    <?php endif;?>
                                    <?php if(isset($platform->yearly_button_text) && $platform->yearly_button_text !== ''):?>
                                    <div class="fl-pricing-table-col-<?=$col;?>">
                                        <div class="fl-pricing-table-column fl-pricing-table-column-0">
                                            <div class="fl-pricing-table-inner-wrap">
                                                <h2 class="fl-pricing-table-title"><?=$platform->yearly_heading;?></h2>
                                                <div class="fl-pricing-table-price" style="background: #<?=$platform->yearly_table_background;?>!important">
                                                    <?=$currency;?><?=$platform->yearly_price;?> monthly <bR>
                                                    <span class="fl-pricing-table-duration"><?=$platform->yearly_subtext;?></span>
                                                </div>
                                                <ul class="fl-pricing-table-features">
                                                    <?php for($d=0;$d<=9;$d++):
                                                        $platformn = 'yearly_feature'.$d;
                                                        if (isset($platform->{$platformn}) && $platform->{$platformn} !== ""):?>
                                                            <li><p style="text-align: center;"><?=$platform->{$platformn};?></p></li>
                                                        <?php endif;
                                                    endfor;?>
                                                </ul>

                                                <div class="fl-button-wrap fl-button-width-full fl-button-center">
                                                    <a href="<?=$platform->yearly_button_url;?>" style="background: #<?=$platform->yearly_button_background; ?>!important;border:none;color: white!important;" target="_self" class="fl-button" role="button">
                                                        <span class="fl-button-text"><?=$platform->yearly_button_text;?></span>
                                                    </a>
                                                </div>
                                                <br>

                                            </div>
                                        </div>
                                    </div>
                                    <?php endif;?>
                                    <?php if(isset($platform->total_button_text) && $platform->total_button_text !== ''):?>
                                    <div class="fl-pricing-table-col-<?=$col;?>">
                                        <div class="fl-pricing-table-column fl-pricing-table-column-0">
                                            <div class="fl-pricing-table-inner-wrap">
                                                <h2 class="fl-pricing-table-title"><?=$platform->total_heading;?></h2>
                                                <div class="fl-pricing-table-price" style="background: #<?=$platform->total_table_background;?>!important">
                                                    <?=$currency;?><?=$platform->total_price;?> monthly <br>
                                                    <span class="fl-pricing-table-duration"><?=$platform->total_subtext;?></span>
                                                </div>
                                                <ul class="fl-pricing-table-features">
                                                    <?php for($d=0;$d<=9;$d++):
                                                        $platformn = 'total_feature'.$d;
                                                        if (isset($platform->{$platformn}) && $platform->{$platformn} !== ""):?>
                                                            <li><p style="text-align: center;"><?=$platform->{$platformn};?></p></li>
                                                        <?php endif;
                                                    endfor;?>
                                                </ul>

                                                <div class="fl-button-wrap fl-button-width-full fl-button-center">
                                                    <a href="<?=$platform->total_button_url;?>" style="background: #<?=$platform->total_button_background;?>!important;color: white!important;border: none;" target="_self" class="fl-button" role="button">
                                                        <span class="fl-button-text"><?=$platform->total_button_text;?></span>
                                                    </a>
                                                </div>
                                                <br>

                                            </div>
                                        </div>
                                    </div>
                                    <?php endif;?>
                                    <?php if(isset($platform->build_button_text) && $platform->build_button_text !== ''):?>
                                    <div class="fl-pricing-table-col-<?=$col;?>">
                                        <div class="fl-pricing-table-column fl-pricing-table-column-0">
                                            <div class="fl-pricing-table-inner-wrap">
                                                <h2 class="fl-pricing-table-title"><?=$platform->build_heading;?></h2>
                                                <div class="fl-pricing-table-price" style="background: #<?=$platform->build_table_background;?>!important">
                                                    <?=$currency;?><?=$platform->build_price;?> monthly <bR>
                                                    <span class="fl-pricing-table-duration"><?=$platform->build_subtext;?></span>
                                                </div>
                                                <ul class="fl-pricing-table-features">
                                                    <?php for($d=0;$d<=9;$d++):
                                                        $platformn = 'build_feature'.$d;
                                                        if (isset($platform->{$platformn}) && $platform->{$platformn} !== ""):?>
                                                            <li><p style="text-align: center;"><?=$platform->{$platformn};?></p></li>
                                                        <?php endif;
                                                    endfor;?>
                                                </ul>

                                                <div class="fl-button-wrap fl-button-width-full fl-button-center">
                                                    <a href="<?=$platform->build_button_url;?>" style="background: #<?=$platform->build_button_background;?>!important;color: white!important;border: none;" target="_self" class="fl-button" role="button">
                                                        <span class="fl-button-text"><?=$platform->build_button_text;?></span>
                                                    </a>
                                                </div>
                                                <br>

                                            </div>
                                        </div>
                                    </div>
                                    <?php endif;?>
                                </div>
                            </div>
                        </div>	
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</section>
