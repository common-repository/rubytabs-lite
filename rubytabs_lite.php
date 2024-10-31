<?php
/**
 * RUBYTABS WORDPRESS PLUGIN
 * @package         RubyTabs
 * @author          HaiBach
 * @link            http://haibach.net/rubytabs
 *
 *
 * Plugin Name:     RubyTabs Lite
 * Plugin URI:      http://haibach.netrubytabs
 * Description:     RubyTabs is a great plug-in tabs when integrated gestrue swipe, move between slides really easy on desktop and mobile.
 * Version:         1.031
 * Author:          HaiBach
 * Author URI:      haibach.com
 * Tested up to:    4.4.1
 */


/**
 * CHECK FIRST!
 *  + Kiem tra plugin co chay trong wordpress -> kiem tra bien wpinc
 *  + Kiem tra wordpress co upgrading hay khong -> loai bo rubytabs loading
 */
if( !defined('WPINC') ) die();
if( defined('WP_INSTALLING') && WP_INSTALLING ) return;










/**
 * DANG KI VA LOAI BO PLUGIN
 */



require_once('admin/options-init.php');
register_activation_hook(__FILE__, 'rt03_activation');
register_deactivation_hook(__FILE__, 'rt03_deactivation');

define('RT03_NAME', 'rubytabs-lite');
define('RT03_NAMEVAR', 'rubytabs_lite');
define('RT03_NS', 'rt03');
define('RT03_URL', plugins_url('', __FILE__));

/* Main class trong plugin */
require_once('admin/classes/class_db.php');
require_once('admin/classes/class_shortcode.php');
require_once('admin/classes/class_widget.php');












/**
 * ADD ADMIN MENU
 */
function rt03register_menu() {

    $icon_url   = plugins_url('admin/imgs/icon-ruby-light.svg', __FILE__);
    $opts_main  = get_option('rt03');
    $menu_name  = $opts_main['name'];
    $is_access  = current_user_can('access_rubytabs');
    $capability = $is_access ? 'access_rubytabs' : NULL;


    // Menu Main
    add_menu_page( 'RubyTabs', 'RubyTabs', $capability, $menu_name, 'rt03page_main', $icon_url );

    // Menu Hidden
    // add_submenu_page( $menu_name, 'RubyTabs Hidden', 'Options', $capability, $menu_name .'-hidden', 'rt03page_hidden' );
}

function rt03page_main()    { require_once('admin/page-manage.php'); }
function rt03page_hidden()  { require_once('admin/page-hidden.php'); }

add_action('admin_menu', 'rt03register_menu');










/**
 * INSERT SCRIPTS & STYLES
 * Neu khong hien thi phien ban version thi verion bang NULL
 */
function rt03register_scripts() {

    $opts_main = get_option('rt03');    
    $version   = $opts_main['info']['version'];
    $NAME      = $opts_main['name'];


    /**
     * DANG KI STYLE + SCRIPT
     */
    wp_register_style('rt03css-rubytabs', plugins_url('/ruby/rubytabs.css', __FILE__), array(), $version);
    wp_register_style('rt03css-ruby-animate', plugins_url('/ruby/ruby.animate.css', __FILE__), array(), $version);
    wp_register_style('rt03css-rubybox', plugins_url('/admin/css/rubybox.css', __FILE__), array(), $version);
    wp_register_style('rt03css-rubyform', plugins_url('/admin/css/rubyform.css', __FILE__), array(), $version);
    wp_register_style('rt03css-rubysortable', plugins_url('/admin/css/rubysortable.css', __FILE__), array(), $version);
    wp_register_style('rt03css-codemirror', plugins_url('/admin/css/codemirror.css', __FILE__), array(), $version);
    wp_register_style('rt03css-admin', plugins_url('/admin/css/admin-styles.css', __FILE__), array(), $version);
    wp_register_style('rt03css-globals', plugins_url('/admin/css/globals.css', __FILE__), array(), $version);

    wp_register_script('rt03js-rubytabs-header', plugins_url('/ruby/rubytabs.js', __FILE__), array(), $version);
    wp_register_script('rt03js-rubytabs-footer', plugins_url('/ruby/rubytabs.js', __FILE__), array(), $version, true);
    wp_register_script('rt03js-rubybox', plugins_url('/admin/scripts/rubybox.js', __FILE__), array(), $version, true);
    wp_register_script('rt03js-rubyform', plugins_url('/admin/scripts/rubyform.js', __FILE__),array(), $version, true);
    wp_register_script('rt03js-rubysortable', plugins_url('/admin/scripts/rubysortable.js', __FILE__),array(), $version, true);
    wp_register_script('rt03js-admin-setup', plugins_url('/admin/scripts/admin-setup.js', __FILE__), array(), $version, true);



    /**
     * CHEN SCRIPTS CU THE VAO TUNG TRANG
     */
    add_action('admin_enqueue_scripts', 'rt03scripts_page_wordpress');
    add_action('wp_enqueue_scripts', 'rt03scripts_page_front', 11);
    add_action("load-toplevel_page_$NAME", 'rt03scripts_page_admin', 11);
    add_action("load-$NAME" . "_page_$NAME-create", 'rt03scripts_page_admin', 11);
    add_action("load-$NAME" . "_page_$NAME-edit", 'rt03scripts_page_admin', 11);
    add_action("load-$NAME" . "_page_$NAME-hidden", 'rt03scripts_page_admin', 11);
}


/**
 * CHEN STYLE + SCRIPT VAO TRANG ADMIN WORDPRESS
 */
function rt03scripts_page_wordpress() {
    wp_enqueue_style('rt03css-globals');
}


/**
 * CHEN STYLE + SCRIPT VAO TRANG FRONTS CUA THEME
 */
function rt03scripts_page_front() {
    global $post;

    // Kiem tra doi tuong dc ke thua` cua class WP_Post
    // Kiem tra noi dung trong Post co chua shortcode hay khong
    // Kiem tra trong trang co' ton` tai. function 'rubytabs' hay khong
    if( !(is_a($post, 'WP_Post') && (has_shortcode($post->post_content, RT03_NAMEVAR) || function_exists(RT03_NAMEVAR))) ) return;

    // Chen jQuery neu chua loaded
    if( !wp_script_is('jquery') ) wp_enqueue_script('jquery');

    // Script se~ chen` vao trong trang neu co' rubytabs
    wp_enqueue_style('rt03css-rubytabs');
    wp_enqueue_style('rt03css-ruby-animate');   // Kiem tra co' chen` hay khong
    wp_enqueue_script('rt03js-rubytabs-header');
}


/**
 * CHEN STYLE + SCRIPT VAO TRANG RUBYTABS SETUP
 */
function rt03scripts_page_admin() {

    // Kiem tra rubytabs co' chen` vao chua !!! quan trong --> tranh xung dot
    wp_enqueue_style('rt03css-rubytabs');
    wp_enqueue_style('rt03css-ruby-animate');
    wp_enqueue_style('rt03css-rubybox');
    wp_enqueue_style('rt03css-rubyform');
    wp_enqueue_style('rt03css-rubysortable');
    wp_enqueue_style('rt03css-codemirror');
    wp_enqueue_style('rt03css-admin');

    wp_enqueue_script('rt03js-rubytabs-footer');
    wp_enqueue_script('rt03js-rubybox');
    wp_enqueue_script('rt03js-rubyform');
    wp_enqueue_script('rt03js-rubysortable');
    wp_enqueue_script('rt03js-admin-setup');
}

add_action('init', 'rt03register_scripts');










/**
 * DANG KI SHORTCODE CHO PLUGIN
 */
$rt03_shortcode = new RT03_SHORTCODE();
$rt03_shortcode->register();


/**
 * DANG KI WIDGET CHO PLUGIN
 */
add_action('widgets_init', function() { register_widget('RT03_WIDGET'); });


/**
 * AJAX REQUEST SETUP
 */
require_once('admin/ajax.php');










/**
 * EDITOR TINYMCE CUSTOM
 */
function rt03mce_setup_custom() {

    // Kiem tra quye`n han toi thieu la` 'Editor'
    if( !current_user_can('edit_posts') && !current_user_can('edit_pages') ) return;

    // Kiem tra edit WYSIWYG duoc bat (so voi 'true')
    if( get_user_option('rich_editing') == 'true' ) {

        // Chen button shortcode vao` editor tinymce
        add_filter('mce_external_plugins', 'rt03mce_add_plugin');
        add_filter('mce_buttons', 'rt03mce_add_button');

        // Setup custum chi tren trang rubytabs
        if( isset($GLOBALS['plugin_page']) && !!preg_match('/(^rubytabs)/', $GLOBALS['plugin_page']) ) {
            // Tat chuc nang spellcheck tren textarea
            add_filter('the_editor', 'rt03mce_filter_the_editor');
        }
    }
}


// Dang ki thuoc tinh button rubytabs bang Javascript
function rt03mce_add_plugin($plugin_array) {
    $plugin_array['rubytabs_lite'] = plugins_url('/admin/scripts/rubytabs-button.js', __FILE__);
    return $plugin_array;
}


// Chen` ten button rubytabs vao` he tho'ng button cua editor
function rt03mce_add_button($buttons) {
    array_push($buttons, 'rubytabs_lite');
    return $buttons;
}


// Tat chuc nang spellcheck tren textarea
function rt03mce_filter_the_editor($editor_wrap) {

    $re = '/autocomplete="off"/';
    $replace = 'spellcheck="false" autocomplete="off" autocorrect="off" autocapitalize="off"';
    return preg_replace($re, $replace, $editor_wrap);
}


/* CHEN BIEN JAVASCRIPT CUSTOM TRUOC TINYMCE INIT */
function rt03mce_add_custom_script($hook) {
    $opts_main   = get_option('rt03');
    $plugin_name = $opts_main['name'];

    // Chi chen tren trang 'post.php' va 'post-new.php' (bao gom 'posts' va 'pages') + ca'c trang rubytabs
    if( !!preg_match("/(^post|$plugin_name)/", $hook) ) {
        $opts_main = get_option('rt03'); ?>

        
        <script type="text/javascript" class="rt03script-value">
            // Chen` tat ca tabs_id vao` bien globals rt03VA
            if( !window.rt03VA ) window.rt03VA = {};
            window.rt03VA['nameVar'] = "<?php echo RT03_NAMEVAR; ?>";
            window.rt03VA['tabsID']  = <?php echo json_encode( $opts_main['id'] ); ?>;
            window.rt03VA['url']     = "<?php echo RT03_URL; ?>";
        </script>

    <?php }
}

add_action('admin_head', 'rt03mce_setup_custom');
add_action('admin_enqueue_scripts', 'rt03mce_add_custom_script');










/**
 * FUNCTION OTHERS
 */

/**
 * CHUYEN VE TRANG CHU
 */
function rt03redirect_home() {

    // Kiem tra co phai trang rubytabs-edit
    if( isset($_GET['page']) && $_GET['page'] == 'rubytabs-edit' ) {

        // Function redirect toi trang chu
        $fnRedirect = function() {
            $url = admin_url('admin.php?page=' . RT03_NAME);
            header("Location: $url");
            exit();
        };

        // Tiep tuc kiem tra cac truong hop
        // Truong hop co' id va` khong co' id
        if( isset($_GET['id']) ) {
            $get_id    = $_GET['id'];
            $opts_main = get_option('rt03');

            // Kiem tra ID trong url co' to`n tai trong database hay khong
            if( !array_key_exists($get_id, $opts_main['id']) ) $fnRedirect();
        }
        else $fnRedirect();
    }
}
add_action('init', 'rt03redirect_home');