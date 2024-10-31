<?php
/**
 * EDITOR ALLTABS
 */


/**
 * THOI GIAN CAP NHAT : SETUP DE DOC DE DANG
 */
function rt03time_human_timing($arr_tabs) {
        
    // Bien khoi tao
    $time_human = array();
    $time_cur   = time();
    $tokens     = array(
        31536000  => 'y',
        2592000   => 'm',
        86400     => 'd',
        3600      => 'h',
        60        => 'm',
        1         => 's'
    );

    // Vong lap : setup tat ca ca'c tabs
    foreach( $arr_tabs as $key => $value ) {
        $time_update = $arr_tabs[$key]['time-update'];
        $duration    = $time_cur - $time_update;

        foreach( $tokens as $unit => $text ) {
            if( $duration >= $unit ) {
                $list_count = floor($duration / $unit);
                // $time_human[$key] = $list_count .' '. ($list_count > 1 ? $text .'s' : $text);
                $time_human[$key] = $list_count . $text;
                break;
            }
        }
    }
    return $time_human;
}
// Tao ma?ng danh sach chua' thoi gian moi vua cap nhat
$time_human = rt03time_human_timing($arr_tabs);







/**
 * PHAN CHIA TABS THANH NHUNG PHAN NHO
 */
$count_tabs_of_group = 12;  // SO TABS TRONG 1 SLIDE
$count_tabs = count($arr_tabs);
$group_tabs = array( 0 => array() );

// Vong lap copy tat ca tabs sang 'group_tabs'
$num_loop = $num_group = 0;
foreach ($arr_tabs as $tabs_id => $tabs_info) {
    
    // Neu so luong cua tabs toi so' luo.ng cho phep --> reset lai bo diem
    if( $num_loop == $count_tabs_of_group ) {
        $num_loop = 0;
        $num_group++;
        $group_tabs[$num_group] = array();
    }

    // Gian thong tin cua tabs hien tai vao` ma?ng
    $group_tabs[$num_group][$num_loop] = $tabs_info;
    // Tang so luong bo. diem tabs
    $num_loop++;
}








/**
 * SETUP KHAC
 */
$count_group_tabs = count($group_tabs);
$is_onegroup      = $count_group_tabs == 1;

?>


<div id="rt03page-alltabs">
    <a class="rt03goto-alltabs rt03btn-header rt01pagitem"><i class="rt03icon"></i>All Tabs</a>
    <input type="hidden" name="rt03count-tabsitem-each-slide" value="<?php echo $count_tabs_of_group; ?>">


    <!-- NAVIGATION ALLTABS -->
    <?php require_once('nav-alltabs.php'); ?>

    <!-- PHAN IMPORT-EXPORT DATA -->
    <?php require_once('part-import-export.php'); ?>











    <!-- TABS LIST - begin -->
    <div class="rt03tabs-list rt01"
        data-tabs='{
            "isAutoInit" : true,
            "idBegin"    : "end",
            "speed"      : 400,
            "margin"     : 100,
            
            "isSwipe"    : true,
            "isLoop"     : false,
            "load"       : { "isLazy": false },
            "pag"        : { "position": "bottom", "align": "end" }
        }'>

    <?php
    // Setup tren moi group-tabs
    for( $num_group = 0; $num_group < $count_group_tabs; $num_group++ ) : ?>

    <div class="rt01slide">
        <div class="rt01pagitem"><?php echo $num_group + 1; ?></div>
        <div class="rt03row">
        
        <?php
        // Setup tren moi tabs
        $count_group_cur = count($group_tabs[$num_group]);
        for( $num_tabs = 0; $num_tabs < $count_group_cur; $num_tabs++ ) :

            $info_cur = $group_tabs[$num_group][$num_tabs];
            $id_cur   = $info_cur['id'];
            $nonce    = $info_cur['nonce'];
            $info_delete_cur = json_encode( array('id' => $id_cur, 'nonce' => $nonce) );
        ?>

        <div
            class="rt03tl-item rt03col3 rt03col-l-2 rt03col-s-4 rt03col-xs-6 rt01swipe-prevent"
            data-rt03info='<?php echo $info_delete_cur; ?>'
            >
            <div class="rt03tl-front">
                <a class="rt03tl-name"><?php echo $info_cur['name']; ?></a>

                <div class="rt03tl-info">
                    <span class="rt03tl-id" title="Tabs id"># <?php echo $id_cur; ?></span>
                    <span class="rt03tl-updated" title="Last updated"><?php echo $time_human[$id_cur]; ?> ago</span>
                    <a class="rt03tl-duplicate" title="Duplicate tabs"><i class="rt03i16-duplicate2"></i></a>
                </div>
            </div>
            
            <!-- Button item select -->
            <div class="rt03tl-select rt03tabs-btn-select"></div>
        </div>
        <?php endfor; ?>
        
        </div> <!-- Row - end -->
    </div> <!-- Slide tabs - end -->
    <?php endfor; ?>
    
    </div>
    <!-- TABS LIST - end -->

</div>