<?php

/**
 * CLASS SHORTCODE
 */
class RT03_SHORTCODE {
    private $tabs_id;
    private $tabs_slug;
    private $opts_main;
    private $opts_cur;


    /**
     * SETUP LUC KHOI TAO CLASS
     */
    public function __construct() {}


    /**
     * DANG KI SHORTCODE
     */
    public function register() {

        // Dang ki Shortcode chinh cho plugin
        add_shortcode(RT03_NAMEVAR, array( $this, 'get_html'));
    }


    /**
     * LAY NOI DUNG CUA SHORTCODE
     */
    public function get_html($atts) {
        
        $html = '';
        $this->tabs_id   = isset($atts['id']) ? $atts['id'] : null;
        $this->tabs_slug = isset($atts['slug']) ? $atts['slug'] : null;


        // Lay noi dung cua Tabs tu ID hoac Slug
        if( $this->tabs_id != null || $this->tabs_slug != null ) {
            $html = $this->render_tabs();
        }

        // Tra ve noi dung cua Shortcode
        return $html;
    }


    /**
     * RENDER NOI DUNG CUA TABS
     */
    private function render_tabs() {
        
        $html      = '';
        $db        = new RT03_DB();
        $opts_main = $this->opts_main = $db->opts_main();
        $opts_cur  = null;
        


        /**
         * KIEM TRA ID CUA TABS CO TON TAI TRONG HE THONG
         */
        $is_ID_exists = $db->check_id_exists($this->tabs_id, $this->tabs_slug);
        
        if( $is_ID_exists != false ) {

            // Cap nhat option cua Tabs hien tai
            $opts_cur = $this->opts_cur = $db->get_option($this->tabs_id);
        }
        else return $html;



        /**
         * RENDER NOI DUNG CUA TAT CA CAC SLIDE
         */
        $slide_html = $this->render_slide();
        // echo '<pre>' . var_dump($slide_html) . '</pre>';


        /**
         * RENDER STYLE INLINE CUA TABS
         */
        $css_html = $this->render_style_inline();
        // echo '<pre>' . var_dump($css_html) . '</pre>';



        /**
         * SETUP CAC THANH PHAN KHAC
         */
        $css    = $opts_cur['css'];
        $cssID  = 'rt01id-'. $this->tabs_id;
        
        // Ket hop ten cua tat ca class tren Tabs
        $cssClass = implode(' ', $opts_cur['cssClass']);

        // Setup ID DOM cua Tabs
        $domID = (isset($css['domID']) && $css['domID'] != '') ? ('id="'. $css['domID'] .'" ') : '';

        // Setup jsData cua Tabs
        $jsData = isset($opts_cur['jsData']) ? $opts_cur['jsData'] : array();

        // Chen 'isAutoInit' vao jsData
        if( !isset($jsData['isAutoInit']) ) $jsData['isAutoInit'] = true;

        // Chuyen doi option JS thanh string
        $jsData = json_encode($jsData);



        /**
         * SETUP HTML TOAN BO
         */
        $html = $css_html .
        '<div ' .
            $domID .
            'class="rt01 ' . $cssID .' '. $cssClass .'" '.
            "data-tabs='" . $jsData . "' " .
            '>' .

            $slide_html .
        '</div>';

        // Chuyen doi nhung ki tu dac biet trong html
        $html = $this->string_decode($html);

        // Render nhung Shortcode ben trong html
        $html = do_shortcode($html);

        // Tra lai html cua Tabs
        return $html;
    }




    /**
     * RENDER NOI DUNG CUA CAC SLIDE
     */
    private function render_slide() {

        $opts_cur   = $this->opts_cur;
        $contents   = $opts_cur['contents'];
        $slide_num  = $opts_cur['info']['slideNum'];
        $slide_html = '';


        /**
         * TAO VONG LAP DE RENDER NOI DUNG CUA TAT CA SLIDE
         */
        for( $i = 0; $i < $slide_num; $i++ ) {
            $slide_id = $opts_cur['info']['slideOrder'][$i];
            // echo '<pre>' . var_dump($slide_id) . '</pre>';

            $slide_html .=
            '<div>' .
                '<div class="rt01pagitem">'. $contents[$slide_id]['title'] .'</div>' .
                $contents[$slide_id]['content'] .
            '</div>';
        }
        return $slide_html;
    }



    /**
     * RENDER STYLE INLINE CUA TABS
     */
    private function render_style_inline() {

        $opts_main = $this->opts_main;
        $opts_cur  = $this->opts_cur;

        $css_default = $opts_main['css'];
        $css         = $opts_cur['css'];
        $skin_name   = $css['skin'];
        $css_html    = '';



        /**
         * SETUP COLOR CUSTOM CUA SKIN
         */
        if( $skin_name != '' ) {
            $color_cur = $css['colorCur'];

            // Neu khac voi color default
            if( $color_cur != $opts_main['css']['colorDefault'] ) {

                // Lay Inline color options
                $inline_color = $css_default['inlineColor'][$skin_name];

                // Thay the 'color' va` 'idTabs' trong style inline
                $pattern = array('/\s+/', '/\$color/', '/\$idTabs/');
                $replace = array(" ", $color_cur, ".rt01id-". $this->tabs_id .".". $skin_name);
                $css_html .= preg_replace($pattern, $replace, $inline_color);
            }
        }



        /**
         * KET HOP VOI INLINE CUSTOM
         */
        $inline_custom = $css['styleCustom'];
        if( $inline_custom != '' ) {

            $css_html .= $inline_custom;
        }



        /**
         * MINIFY CSS INLINE DON GIAN
         */
        if( $css_html != "" ) {

            // Loai bo ghi chu
            $css_html = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css_html);
            
            // Loai bo nhieu khoang trang bang 1 khoang trang
            $css_html = preg_replace('!\s+!', " ", $css_html);
            
            // Loai bo nhieu khoang trang phan dau va` phan cuoi + xuo'ng don`g
            $css_html = preg_replace(array('!(^\s+|\s+$)!'), "", $css_html);
            
            // Loai bo cac khoang tra'ng khac
            $pattern = array('!\s*\{\s*!', '!\s*\}\s*!', '!\s*\;\s*!', '!\s*\:\s*!', '!\s*\>\s*!');
            $replace = array("{", "}", ";", ":", ">");
            $css_html = preg_replace($pattern, $replace, $css_html);

            // Chen vao tag style html
            $css_html = '<style type="text/css">' . $css_html . '</style>';
        }
        return $css_html;
    }



    /**
     * GIAI MA NHUNG KI TU DAC BIET TRONG STRING
     */
    private function string_decode($str) {
        $pattern    = array() ;
        $pattern[0] = '/&#34;/';
        $pattern[1] = '/&#39;/';
        $pattern[2] = '/&#47;/';

        $replace    = array();
        $replace[0] = '"';
        $replace[1] = "'";
        $replace[2] = '/';

        return preg_replace($pattern, $replace, $str);
    }
}
























/**
 * GET HTML RUBYTABS BY PHP FUNCTION
 */
function rubytabs_lite($opts = null) {

    // Dieu kien thuc hien
    if( $opts == null ) return; 

    // Class shortcode cua Tabs
    $shortcode = new RT03_SHORTCODE();




    /**
     * TRUONG HOP OPTION LA ID CUA TABS
     */
    if( is_numeric($opts) ) {

        // Setup ID cua Tabs
        $atts = array( 'id' => $opts );

        // Render noi dung cua Tabs
        echo $shortcode->get_html($atts);
    }


    /**
     * TRUONG HOP OPTION LA ARRAY NHIEU THONG SO
     */
    else if( is_array($opts) ) {

        /**
         * THUOC TINH MAC DINH
         */
        $opts_default = array(
            'id'        => null,
            'slug'      => null,
            'markup'    => 'main',

            // Only cho markup outside
            'outside_id'    => '',
            'outside_class' => ''
        );
        $atts   = array_replace_recursive($opts_default, $opts);
        $markup = $opts['markup'];

        

        /**
         * RENDER TOAN BO TABS
         */
        if( $markup == 'main' || $markup == null ) {
            echo $shortcode->get_html($atts);
        }


        /**
         * RENDER THANH PHAN KHAC CUA TABS : THANH PHAN OUTSIDE
         */
        else if( in_array($markup, array('pag', 'nav', 'timer')) ) {

            // Kiem tra ID cua Tabs ton tai
            $db      = new RT03_DB();
            $tabs_id = $db->check_id_exists( $atts['id'], $atts['slug'] );


            // Truong hop ID cua Tabs ton tai
            if( $tabs_id != false ) {

                $outside_id     = $atts['outside_id'];
                $outside_class  = $atts['outside_class'];
                $domID          = $outside_id != '' ? "id='$outside_id'" : '';
                $data_tabs      = '{ "name" : "tabs-'. $tabs_id .'" }';

                // Render markup outside
                $html = "<div $domId class='rt01$markup $outside_class' data-tabs='". $data_tabs ."'></div>";
                echo $html;
            }
        }
    }
}