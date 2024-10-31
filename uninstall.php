<?php
/**
 * Part code of RubyTabs plugins
 * @name Uninstall Plugins
 */


/**
 * UNINSTALL RUBYTABS SETUP
 * Phan bat buoc --> Kiem ra 'WP_UNINSTALL_PLUGIN'
 */
if ( !defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    exit();
}

// Bien khoi tao
$opts_main = get_option('rt03');
$arr_id    = $opts_main['id'];

// Tao vong lap -> de xoa option Tabs used da~ tao.
foreach( $arr_id as $key => $value ) {
    delete_option('rt03id_'. $key);
}

// XOA OPTONS CHINH RUBYTABS
delete_option('rt03');