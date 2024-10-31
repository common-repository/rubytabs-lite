<?php
/**
 * EDITOR TABS
 */


/**
 * SETUP BIEN TAO TABS MOI
 */
$css            = $opts_main['css'];
$jsData         = $opts_main['jsData'];
$tabs_id        = null;

$page_type      = 'create';
$info_slug      = $opts_main['setting']['slug_default'];
$nonce          = 'rt03nonce';

$contents       = array( "0" => array('title' => '', 'content' => 'Content of slide - write something...'));
$title_init     = 'Title of slide';
$slide_num      = count($contents);
$slide_order    = array(0);
$info_name      = $opts_main['setting']['title_default'];
$shortcode_name = $opts_main['name_var'];








/**
 * SETUP KHAC
 */
// Thong tin ve nut delete bang ajax
$btn_ajax_delete_info = json_encode( array('id' => $tabs_id, 'nonce' => $nonce) );

// Chen colorPicker vao trang
wp_enqueue_style('wp-color-picker');
wp_enqueue_script('wp-color-picker');

?>


<div id="rt03editor-tabs">

    <a class="rt03goto-tabs rt03btn-header rt01pagitem"><i class="rt03icon"></i>Tabs Editor</a>
    <form class="rt03form-ajax" spellcheck="false" autocomplete="off" autocorrect="off" autocapitalize="off">

        <!-- THONG TIN AN KHI SUBMIT -->
        <input type="hidden" name="rt03page" value="create">
        <input type="hidden" name="rt03auto-info-id" value="<?php echo $tabs_id; ?>">


        <!-- NAME - ID - SLUG -->
        <div class="rt03tabs-info">
            <input 
                class="rt03tabs-name rf01input" type="text"
                name="rt03auto-info-name" value="<?php echo $info_name; ?>"
                placeholder="Name of tabs">

            <input
                type="hidden"
                class="rt03tabs-slug"
                name="rt03auto-info-slug" value="<?php echo $info_slug; ?>">

            <div class="rt03tabs-shortcode"><span>Shortcode: </span><?php echo "[$shortcode_name id=\"$tabs_id\"]"; ?></div>
        </div>









        
        <!-- PHAN OPTIONS -->
        <?php require_once('part-options.php'); ?>

        <!-- PHAN CONTENT INLINE -->
        <?php require_once('part-inline.php'); ?>

        <!-- PHAN FOOTER -->
        <?php require('nav-footer.php'); ?>

    </form>
</div>