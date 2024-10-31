<?php
/**
 * Main HTML page of rubytabs plugins
 * Page : Home
 */


/**
 * BIEN KHOI TAO VA SHORTCUT BAN DAU
 */
$opts_main = get_option('rt03');
$arr_tabs  = isset($opts_main['id']) ? $opts_main['id'] : null;
$url_imgs  = plugins_url('imgs', __FILE__);


/**
 * FALLBACK GIAO DIEN CHO WP CO VERSION < 3.8
 */
$is_ui_fallback = 'false';

if( version_compare( $GLOBALS['wp_version'], '3.8', '<' ) ) {
    $is_ui_fallback = 'true';
}
?>


<!-- RUBYTABS WRAP - begin -->
<div class="rt03page rt03page-manage rt03page-create">
    <input type="hidden" name="rt03name" value="<?php echo $opts_main['name']; ?>">
    <input type="hidden" name="rt03name-var" value="<?php echo $opts_main['name_var']; ?>">
    <input type="hidden" name="rt03url-js" value="<?php echo plugins_url('scripts', __FILE__); ?>">
    <input type="hidden" name="rt03ui-fallback" value="<?php echo $is_ui_fallback; ?>">
    

    <!-- DONATE PAYPAL INFO -->
    <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top" style="display: none;">
        <input type="hidden" name="cmd" value="_s-xclick">
        <input type="hidden" name="hosted_button_id" value="RCAJGHT7YHQV6">
        <input class="rt03paypal-submit" type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
        <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
    </form>










    <!-- HEADER SECTION - begin -->
    <div class="rt03part-header rt03clear">

        <!-- Logo -->
        <a class="rt03logo" title="Home">RUBYTABS</a>

        <!-- Navigation page editor -->
        <div class="rt03nav-header rt01pag" data-tabs='{ "name": "pageEditor" }'></div>

        <!-- Donate -->
        <a
            class="rt03btn-donate"
            title="Donate"
            href="#rt03id-donate"
            data-options='{}'
            >

            <i class="rt03icon"></i>
            Donate
        </a>

    </div>
    <!-- HEADER SECTION - end -->










    <!-- PAGE - begin -->
    <div id="rt03page-editor" class="rt01 rt01init"
        data-tabs='{
            "isAutoInit"  : true,
            "name"        : "pageEditor",
            "fx"          : "line",
            "speed"       : 800,
            "delayUpdate" : 400,
            "idBegin"     : 0,
            
            "isPag"       : true,
            "isSwipe"     : false,
            "load"        : { "isLazy": false },
            "pag"         : { "type": "list", "sizeAuto": null }
        }'>

        <!-- PAGE ALLTABS -->
        <?php require_once('page-alltabs.php'); ?>

        <!-- PAGE TABS -->
        <?php require_once('page-tabs.php'); ?>

        <!-- PAGE SLIDE -->
        <?php require_once('page-slide.php'); ?>

    </div>
    <!-- PAGE - end -->

</div>
<!-- RUBYTABS WRAP - end -->