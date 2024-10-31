<?php
/**
 * Part code of RubyTabs plugins
 * @name Ajax
 */


/**
 * XU LY YEU CAU EXPORT DU LIEU
 * FUNCTION xuat du lieu
 * Gui du lieu databse cho ajax
 */
function rt03ajax_export_data($is_return = false, $array_id_custom = false) {

    // Options main lay' tu he thong
    // Loai bo nhung~ ma?ng khong can thiet ['css', 'jsData', 'setting']
    // Tao data main bao go`m toan` noi dung can` export
    $opts_main = get_option('rt03');
    unset($opts_main['setting'], $opts_main['jsData'], $opts_main['css'], $opts_main['setting']);
    $opts_main_id = $opts_main['id'];
    $db_main      = array();


    // Mang id bao gom` nhung tabs can` export
    // Neu khong co' ma?ng id custom thi` lay' toan` bo. tabs de? export
    if( is_array($array_id_custom) ) {

        // Trong ma?ng info custom chi bao go`m id va` nonce
        // Tao thanh ma?ng id chua thong tin da`y du? tabs duoc chon.
        // Kiem tra ma~ nonce cua tua`n id tabs
        $array_id_search = array();
        foreach( $array_id_custom as $id_cur => $info_cur ) {
            $id_cur = (int) $id_cur;

            if( $info_cur['nonce'] == $opts_main_id[$id_cur]['nonce'] ) {
                $array_id_search[$id_cur] = $opts_main_id[$id_cur];
            }
        }
        // Chuyen sang ma?ng id can` export neu ma?ng tim` kiem khac' empty
        if( !empty($array_id_search) ) $opts_main['id'] = $array_id_search;
    }
    

    /**
     * Lay tat ca option rubytabs va` option main hien tai
     * + Loai bo html da~ luu --> giam nhe kich thuoc xuat database
     */
    foreach( $opts_main['id'] as $tabs_id => $tabs_info ) {
        $db_main['rt03id_'. $tabs_id] = get_option('rt03id_'. $tabs_id);
        $db_main['rt03id_'. $tabs_id]['html'] = null;
    }
    $db_main['rubytabs'] = $opts_main;

    // RubyTabs database bao gom nhung thong tin can` xuat
    $export = array(
        'rt03database' => array(
            'data-main' => $db_main,
            'info'      => array(
                'time-created'  => time(),
                'version'       => '0.1beta'
            )
        )
    );

    // Chuyen du~ lieu sang chuoi string
    $export = json_encode($export);

    /**
     * CONVERT 1 LAN NUA :
     * Khac phuc loi string trong styleCustom khong hieu \n
     * Convert cac' ki tu dac biet nhu line-break, horizontal-tab sang ki tu Unicdoe
     * 
     * KI TU RIENG PLUGIN :
     * Convert them dau' phay? (quot) --> data hoa`n toan khong co' dau quot
     */
    $pattern = array('/\\\n/', '/\\\t/', '/\"/', '!\\\/!');
    $replace = array('&#10;', '&#9;', '&#q;', '&#bs;');
    $export  = preg_replace($pattern, $replace, $export);

    // Xuat du~ lieu qua ajax
    if( $is_return ) return $export;
    else echo $export;
    wp_die();
}

add_action('wp_ajax_rt03ajax_export_get', 'rt03ajax_export_data');







/**
 * SAVE THANH DU LIEU RUBYTABS
 */
function rt03export_download_database() {

    // KIEM TRA DU LIEU POST CO' CHUA ACTION SAVE FILE
    if( isset($_POST['action']) && $_POST['action'] == 'rt03export-download' ) {

        // Setup mang? id custom can` export
        // Neu khong co' thi` export toa`n bo. tabs
        if( isset($_POST['rt03info']) ) {

            /**
             * Lay du~ lieu cua POST info
             *  + Convert ki' tu dac biet sang dau' phay" + dau' '/'
             *  + Chuyen ki' tu '&#q;' thanh '"' :
             *      - Boi vi trong trang select tabs, js da~ chuyen '"' thanh '&#q;'
             *      - Dam bao khong bi. loi~ khi chuyen dau' quot
             */
            $post_info       = $_POST['rt03info'];
            $post_info       = preg_replace('/\&#q;/', '"', $post_info);
            $array_id_custom = json_decode($post_info, true);
        }
        else $array_id_custom = false;
        

        // Lay database tu options
        $database = rt03ajax_export_data(true, $array_id_custom);
        // Gzip lai database --> chuyen du~ lieu thanh base64 --> khong bi phat sinh loi hex
        // $database = gzdeflate($database, 9);
        // $database = base64_encode($database);


        // Luu file tren browser --> su? du.ng header() php
        // Thong tin co ban cua file can xuat
        $filename = 'rubytabsDB.txt';
        header('Content-Description: File Transfer');
        header('Content-Disposition: attachment; filename='. $filename);
        header("Content-Type: text/html");      // Mine type: text/html
        header("Content-Transfer-Encoding: binary");
        header('Cache-Control: no-cache, no-store, must-revalidate');
        header("Pragma: no-cache");
        header('Expires: 0');
        echo $database;                         // Noi dung cua file
        exit;
    }
}

add_action('init', 'rt03export_download_database');







/**
 * XU LY YEU CAU IMPORT DU LIEU
 */

/**
 * KIEM TRA TRONG POST CO RUBYTABS DATA BASE HAY KHONG
 *  + Tra lai gia tri 'false' neu data khong hop le
 *  + Tra lai database rubytabs neu data hop le
 */
function rt03ajax_import_check() {

    // Lay database rubytabs tu POST
    if( !(isset($_POST) && isset($_POST['rt03database'])) ) return false;
    $import = $_POST['rt03database'];

    // Kiem tra co phai ma~ hoa thanh base64 hay khong
    // if( base64_decode($import, true) == false ) return false;
    // $import = base64_decode($import);

    // Kiem tra co phai ne'n du~ lieu hay khong
    // if( gzinflate($import) == false ) return false;
    // $import = gzinflate($import);

    // Boi vi import data thong qua POST, du lieu duoc chuyen doi thanh string --> loai bo dau \" trong data import
    // Giai ma~ json
    $import = preg_replace(array('/\&#q;/', '/\&#bs;/'), array('"', '/'), $import);
    $import = json_decode($import, true);

    // Kiem tra du lieu Import co' phai la json hay khong
    // + kiem tra ma?ng 'rt03database'
    if( !(json_last_error() == JSON_ERROR_NONE && isset($import['rt03database'])) ) return false;
    return $import;
}

function rt03ajax_import_data() {
    $message = 'import-error';
    $import  = rt03ajax_import_check();
    

    // Kiem tra database import --> Neu khong hop le thi loai bo
    if( $import != false ) {
        
        // Bien khoi tao va shortcut ban dau
        $database         = $import['rt03database'];
        $opts_main_import = $database['data-main']['rubytabs'];
        $opts_main_cur    = get_option('rt03');
        $arr_tabs_cur       = & $opts_main_cur['id'];
        $tabs_id_cur      = null;


        // Setup tat ca nhu~ng tabs trong opts-main import
        foreach( $opts_main_import['id'] as $tabs_id_import => $tabs_info_import ) {

            // CHON LUA VA LAY ID CUA TABS THEM VAO
            // Kiem tra tabs_id co' trun`g trong opts-main hien tai --> thay doi tabs_id neu trung` lap
            if( array_key_exists($tabs_id_import, $arr_tabs_cur) ) {

                // Tim kiem ID va options khac cua rubytabs
                // Lay so' thu tu tiep theo trong mang 'id'
                // Dong thoi thay doi 'id' trong tabs info import voi 'id' moi lay' duoc
                for( $i = 1, $tabs_count = count($arr_tabs_cur) + 2; $i < $tabs_count ; $i++ ) {
                    if( !isset($arr_tabs_cur[$i]) ) {
                        $tabs_info_import['id'] = $tabs_id_cur = $i;
                        break;
                    }
                }
            }

            // Neu khong co tabs_id trun`g
            // --> Tao. truoc tiep options moi cua tabs import voi tabs_id co' san~
            else $tabs_id_cur = $tabs_id_import;


            // Chen` them id moi trong mang? 'id' hien tai voi info tabs import
            // Tao database cua tabs import moi
            $arr_tabs_cur[$tabs_id_cur] = $tabs_info_import;
            $tabs_data_cur = $database['data-main']['rt03id_'. $tabs_id_import];
            add_option('rt03id_'. $tabs_id_cur, $tabs_data_cur);
        }


        // Cap nhat option main
        update_option('rt03', $opts_main_cur);
        // Thong bao da~ cap nhat dabase thanh cong
        $message = 'import-success';
    }

    // End ajax request
    echo $message;
    wp_die();
}

add_action('wp_ajax_rt03ajax_import_update', 'rt03ajax_import_data');





























































/**
 * TRANG EDITOR : TAO + CAT NHAT TABS BANG AJAX
 */

/**
 * KIEM TRA DU LIEU LA JSON
 */
function rt03fn_is_json($json) {

    // Truoc tien phai co dau '{' - '['
    if( !preg_match('#^(\{|\[)#', $json) ) return false;

    // Tiep tuc kiem tra
    json_decode($json);
    return (json_last_error() == JSON_ERROR_NONE);
}






/**
 * LAY THONG TIN CUA TABS
 */
add_action('wp_ajax_rt03ajax_tabs_getdata', 'rt03ajax_tabs_getdata');

function rt03ajax_tabs_getdata() {

    $opts_main      = get_option('rt03');
    $capability_cur = $opts_main['setting']['capability'];
    $tabs_id        = $_POST['id'];
    $tabs_nonce     = $_POST['nonce'];


    /**
     * KIEM TRA
     * Kiem tra quyen han cua user
     * Kiem tra ID cua tabs co ton tai tren he thong hay khong
     */
    if( !current_user_can($capability_cur) ) wp_die();
    if( !(array_key_exists($tabs_id, $opts_main['id']) && ($tabs_nonce == $opts_main['id'][$tabs_id]['nonce'])) ) wp_die();




    /**
     * CHUYEN DU LIEU TABS DATA SANG STRING
     */
    $tabs_data = get_option('rt03id_'. $tabs_id);
    $tabs_data['message'] = 'rt03get-success';
    $tabs_data_tostring = json_encode($tabs_data);
    echo $tabs_data_tostring;
    wp_die();
}







/**
 * CAT NHAT TABS
 */
add_action('wp_ajax_rt03ajax_tabs_update', 'rt03ajax_tabs_update');

function rt03ajax_tabs_update() {

    $db             = new RT03_DB();
    $opts_main      = $db->opts_main();
    $capability_cur = $opts_main['setting']['capability'];


    /**
     * TRUOC TIEN KIEM TRA QUYEN HAN CUA USER
     */
    if( !current_user_can($capability_cur) ) wp_die();



    /**
     * CHUYEN DOI TAT CA GIA TRI TRONG $_POST THANH NUMBER (NEU CO)
     */
    $post = $_POST;
    $db->correct_value_in_array($post);



    /**
     * TIEP TUC SETUP
     */
    $page_type   = $post['page'];
    $date_update = date("d-m-Y H:i");
    $time_update = time();
    $tabs_info   = array(
        'date-update'   => $date_update,
        'time-update'   => $time_update
    );



    /**
     * SUMMIT TAO TABS MOI - TAO DATABASE MOI
     */
    if( $page_type == 'create' ) {

        /**
         * TIM KIEM ID
         * Tao tabs theo so' thu' tu. tiep theo trong mang 'id'
         */
        for( $i = 1, $tabs_count = count($opts_main['id']) + 2; $i < $tabs_count ; $i++ ) {
            if( !isset($opts_main['id'][$i]) ) {

                $tabs_id = $i;
                break;
            }
        }


        /**
         * SETUP OPTIONS TU POST
         */
        $opts_auto = $post['optsAuto'];
        $tabs_name = $opts_auto['info']['name'];


        /**
         * THEM DU LIEU MOI VAO OPTIONS MAIN
         */
        $opts_main['id'][$tabs_id] = $tabs_info = array_replace_recursive($tabs_info, array(
            'id'    => $tabs_id,
            'name'  => ($tabs_name == $opts_main['setting']['title_default']) ? ($tabs_name .' '. $tabs_id) : $tabs_name,
            'slug'  => 'tabs-'. $tabs_id,
            'nonce' => wp_create_nonce('rt03id_'. $tabs_id),
            'date-create' => $date_update,
            'time-create' => $time_update
        ));


        /**
         * SETUP KHAC
         */
        // Setup nhung option khac cua tabs truoc khi luu tru
        $opts_auto['jsData']['name'] = 'tabs-'. $tabs_id;
        $opts_auto['info']['id'] = $tabs_id;

        // Func add option moi vao database
        add_option('rt03id_'. $tabs_id, $opts_auto);
        
        // Tra lai du lieu bao gom tat ca thong tin cua tabs
        $tabs_info['message'] = 'rt03create-success';
        echo json_encode($tabs_info);
    }




    /**
     * SUBMIT CAT NHAT TABS - CAT NHAT DATABASE
     */
    else if( $page_type == 'edit' ) {

        $opts_auto = $post['optsAuto'];
        $tabs_id   = $opts_auto['info']['id'];
        

        /**
         * KIEM TRA ID CUA TABS CO TON TAI TREN HE THONG
         */
        if( !(array_key_exists( (string) $tabs_id, $opts_main['id']) ) ) wp_die();


        /**
         * CAP NHAT OPTION HIEN TAI
         */
        update_option( 'rt03id_'. $tabs_id, $opts_auto );

        // Cap nhat du lieu tren option Main
        $opts_main['id'][$tabs_id] = array_replace_recursive($opts_main['id'][$tabs_id], $tabs_info, array(
            'name' => $opts_auto['info']['name'],
            'slug' => $opts_auto['info']['slug']
        ));

        // Thong bao update thanh cong
        echo 'rt03update-success';
    }



    /**
     * CAP NHAT OPTION MAIN SAU KHI SETUP
     */
    update_option('rt03', $opts_main);
    wp_die();
}







/**
 * XOA TABS
 */
add_action('wp_ajax_rt03ajax_tabs_delete', 'rt03ajax_tabs_delete');

function rt03ajax_tabs_delete() {
    // Bien khoi tao va shortcut ban dau
    $opts_main = get_option('rt03');
    $html      = 'delete-success';
    $is_delete_status = false;

    // Kiem tra du lieu trong $_POST truoc tien
    if( isset($_POST['info']) && count($_POST['info']) >= 1 ) {

        // So lung cua tabs can delete
        $info     = $_POST['info'];
        $info_num = count($info);
        $opts_id  = $opts_main['id'];
        $count    = 0;
        foreach ($info as $key => $value) {
            // ID cua tabs hien tai
            $tabs_id = (int) $value['id'];

            // Kiem tra 1 lan nua~ de xac dinh Tabs ton tai tren database va` dc quyen xoa tabs
            if( array_key_exists($tabs_id, $opts_id) && ($value['nonce'] == $opts_id[$tabs_id]['nonce']) ) {

                // Loai bo id tren option Main
                unset($opts_main['id'][$tabs_id]);
                // Loai bo database cua tabs hien tai
                delete_option('rt03id_'. $tabs_id);
                // Cap nhat so luong tabs da~ delete
                $count++;
            }    
        }

        // Kiem tra so' luong tabs da~ delete so voi' so luong ban dau
        // Thong bao thanh cong
        if( $count == $info_num ) {
            $is_message = 'success_delete';
            $is_delete_status = true;
        }

        // Cap nhat options main sau cung`
        update_option('rt03', $opts_main);
    }

    if( $is_delete_status ) echo $html;
    wp_die();
}