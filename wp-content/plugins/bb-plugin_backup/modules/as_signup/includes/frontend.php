<style>
    .dzmiany{
        color: #<?=$settings->font_cform;?>;
        padding: 20px;
    }
    .dzmiany label, .dzmiany .existinguser{
        color: #<?=$settings->font_cform;?> !important;
    }
    .dzmiany .btn-cta{
        background: #<?=$settings->bt_color;?>!important;
        color: #<?=$settings->bt_fcolor;?> !important;
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

        var color = hexToRgb("<?=$settings->bg_form?>");
        var alpha = parseInt(<?=$settings->bg_opacity_form;?>) / 100;
        background = "rgba({r},{g},{b},{a})".replace("{r}", color.r).replace("{g}", color.g).replace("{b}", color.b).replace("{a}", alpha);
        background2 = "rgba({r},{g},{b},{a})".replace("{r}", color.r).replace("{g}", color.g).replace("{b}", color.b).replace("{a}", 0.5);
        jQuery('.fulcolor').css('background', background);
        jQuery('.opacolor').css('background', background2);

    });
</script>
<link rel='stylesheet' id='jm-validation-css-css'  href='/wp-content/themes/jmango360/inc/js/jm-signup/validationEngine.jquery.css?ver=4.6.1' media='all' />
<section class="page-item signup-form dzmiany">
    <div class="container-fluid">
        <div class="row" style="display: flex; overflow:hidden; border-radius:<?php echo $settings->bg_radius;?>px">
            <?php $tentimes = 12;
            if($settings->include !== "no") $tentimes = 6;?>
            <div class="fulcolor col-lg-<?=$tentimes;?> col-md-<?=$tentimes;?> col-sm-<?=$tentimes;?>">
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
                        <input type="submit" class="btn-cta" value="<?=$settings->bt_text;?>">
                    </p>
                </form>
                <!-- /form -->
            </div>
            <?php if($settings->include !== "no"): ?>
                <div class="opacolor col-lg-6 col-md-6 col-sm-6">
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

