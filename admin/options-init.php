<?php
/**
 * Part code of RubyTabs plugins
 * @name Options activation/deactivation
 */


/* FUNCTION ACTIVATION */
function rt03_activation() {

    /**
     * LAY OPTIONS TU FILE JSON
     */
    // Phuong thuc cu
    // $opts_json = file_get_contents( plugins_url('options.json', __FILE__) );
    // $opts_json = json_decode($opts_json, true);

    WP_Filesystem();
    global $wp_filesystem;
    $file_path = $wp_filesystem->wp_plugins_dir() . '/rubytabs-lite/admin/options.json';
    $file_data = $wp_filesystem->get_contents( $file_path );

    if( $file_data == false ) return false;
    $opts_json = json_decode($file_data, true);



    /**
     * OPTIONS CHINH CUA RUBYTABS
     */
    $opts_main = array(
        'name'          => 'rubytabs-lite',
        'name_var'      => 'rubytabs_lite',
        'prefix'        => 'rt03',

        'info'          => array(
                            'version'       => '1.031',
                            'author'        => 'HaiBach',
                            'description'   => 'RubyTabs for wordpress'
                        ),
        
        'jsData'        => $opts_json['optsDefault'],
        'optsPlus'      => $opts_json['optsPlus'],
        'css'           => array(
                            'skin'          => 'rt01outline',
                            // Mau sac' mac dinh --> + thay doi ma`u sac cua timer arc
                            'colorDefault'  => '#cc0055',
                            'colorCur'      => '#cc0055',
                            'size'          => '',
                            'domID'         => '',
                            'domClass'      => '',
                            'styleCustom'   => '',
                            'classInit'     => 'rt01init',
                            'inline'        => '',
                            'inlineColor'   => $opts_json['skinColor']
                        ),
        'id'            => array(),
        'setting'       => array(
                            'capability'    => 'manage_options',
                            'title_default' => 'Untitled Tabs',
                            'slug_default'  => 'tabs-undefined'
                        )
    );

    // KET HOP OPTIONS RUBYTABS CO SAN
    $opts_last = get_option('rt03');
    if( $opts_last !== false ) {

        // Copy danh sach cac tabs trong options co' san sang options moi'
        $opts_main['id'] = $opts_last['id'];

        // Cap nhat ca'c thuoc tinh khac tren rubytabs moi
        $opts_main = array_replace_recursive($opts_last, $opts_main);
    }




    /**
     * DANG KI OPTIONS CHINH
     */
    update_option('rt03', $opts_main, true);

    // DANG KI OPTIONS GLOBAL
    $opts_global = get_option('ruby01VA');
    $plugin_name = $opts_main['name_var'];

    if( $opts_global == false ) {
        add_option('ruby01VA', array(
            'plugins_num'   => 1,
            'plugins'       => array( $plugin_name )
        ), '', true);
    }

    else {
        $opts_global['plugins_num'] += 1;
        array_push($opts_global, $plugin_name);
    }

    // DANG KI CAPABILITY RUBYTABS CHO USER
    rt03capability(true);
}







/* FUNCTION DEACTIVATION */
function rt03_deactivation() {

    // XOA OPTIONS GLOBAL
    $opts_global = get_option('ruby01VA');
    $plugin_name = get_option('rt03')['name_var'];

    if( $opts_global['plugins_num'] == 1 ) {
        delete_option('ruby01VA');
    }
    else {
        $opts_global['plugins_num'] -= 1;
        unset($opts_global[$plugin_name]);
    }

    // LOAI BO CAPABILITY RUBYTABS CHO USER
    rt03capability(false);
}







/** 
 * DANG KI VA LOAI BO CAPABILITY RUBYTABS CHO USER
 */
function rt03capability( $is_register = true ) {
    global $wp_roles;


    /**
     * THEM CAPABILITY RUBYTABS
     */
    $roles         = $wp_roles->get_names();
    $caps_rubytabs = array('access_rubytabs');

    foreach( $roles as $role => $role_name ) {
        foreach( $caps_rubytabs as $cap ) {
            if( $is_register ) $wp_roles->add_cap($role, $cap);
            else               $wp_roles->remove_cap($role, $cap);
        }
    }
}