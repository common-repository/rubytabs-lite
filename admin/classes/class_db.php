<?php

/**
 * CLASS DATABASE CUA PLUGIN
 */
class RT03_DB {


    /**
     * LAY OPTION MAIN CUA PLUGIN
     */
    public function opts_main() {
        return get_option('rt03');
    }


    /**
     * LAY OPTION CUA TABS
     */
    public function get_option($id) {
        return get_option( 'rt03id_' . $id );
    }


    /**
     * THEM OPTION CUA TABS
     */
    public function add_option($id, $opts) {
        add_option( 'rt03id_' . $id, $opts );
    }


    /**
     * CAP NHAT OPTION CUA TABS
     */
    public function update_option($id, $opts) {
        udpate_option( 'rt03id_' . $id, $opts );
    }


    /**
     * LOAI BO OPTION CUA TABS
     */
    public function delete_option($id) {
        delete_option( 'rt03id_' . $id );
    }


    /**
     * KIEM TRA ID CUA TABS TON TAI TRONG HE THONG
     */
    public function check_id_exists($id, $slug) {

        $opts_main    = $this->opts_main();
        $opts_id      = $opts_main['id'];
        $is_ID_exists = false;


        /**
         * KIEM TRA SLUG CUA TABS
         */
        if( $slug != null ) {
            foreach( $opts_id as $i => $info_cur ) {
                if( $slug == $info_cur['slug'] ) {
                    $id = $i;
                    $is_ID_exists = true;
                    break;
                }
            }
        }


        /**
         * KIEM TRA ID CUA TABS
         */
        else if( array_key_exists($id, $opts_id) ) {
            $is_ID_exists = true;
        }


        // Tra ve ket qua? tim kiem
        return $is_ID_exists ? $id : false;
    }


    /**
     * CHUYEN DOI DUNG GIA TRI CUA CAC THANH PHAN TRONG ARRAY
     */
    public function correct_value_in_array( &$arr ) {
        foreach( $arr as $key => $value ) {

            // Truong hop Value la Array: tiep tuc chuyen doi
            if( is_array($value) ) {
                $this->correct_value_in_array( $arr[$key] );
            }


            // Truong hop Value khong phai Array
            else {

                // Truong hop la chuoi rong~ : khong lam gi ca
                if( $value == '' ) {}

                // Chuyen doi Value thanh number (neu co)
                else if( preg_match('/^-?\d+/', $value) ) {
                    $arr[$key] = (int) $value;
                }
            }
        }
    }
}