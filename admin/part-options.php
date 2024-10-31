<?php
?>


<!-- PHAN TABS SETTING - begin -->
<div class="rt03tabs-setting rt01 rt03flatbox"
    data-tabs='{
        "isAutoInit"  : true,
        "fx"          : "line",
        "speed"       : 300,
        "speedHeight" : 200,
        "idBegin"     : 0,
        "swipe"       : { "isBody": false },
        "load"        : { "isLazy": false }
    }'>


    <!-- PHAN LUA CHON OPTIONS - begin -->
    <div>
        <div class="rt01pagitem">Options</div>

        <div class="rt03tabs-options rt01 rt01underline"
            data-tabs='{
                "isAutoInit" : true,
                "fx"         : "none",
                "speed"      : 400,
                "idBegin"    : 0,
                "swipe"      : { "isBody": false },
                "load"       : { "isLazy": false }
            }'>
            
            <!-- OPTIONS HIEU UNG -->
            <?php require_once('part-options-effect.php'); ?>

            <!-- OPTIONS VI TRI -->
            <?php require_once('part-options-position.php'); ?>

            <!-- OPTIONS SKIN -->
            <?php require_once('part-options-skin.php'); ?>

            <!-- OPTIONS SWIPE -->
            <?php require_once('part-options-swipe.php'); ?>

            <!-- OPTIONS KHAC -->
            <?php require_once('part-options-other.php'); ?>

        </div>
    </div>
    <!-- PHAN LUA CHON OPTIONS - end -->



    <!-- PHAN STYLE CUSTOM - begin -->
    <div>
        <div class="rt01pagitem">Style Custom</div>
        <div class="rt03row">

        
            <!-- ADD ID -->
            <div class="rt03col6">
                <div class="rt03option-name">ID Attribute</div>
                
                <!-- Option input -->
                <input
                    type="text"
                    class="rt03tabs-dom-id rf01input"
                    name="rt03auto-css-domID" value="<?php echo $css['domID']; ?>"
                    placeholder="...">
            </div>


            <!-- ADD CLASSES -->
            <div class="rt03col6">
                <div class="rt03option-name">Classes Attribute</div>
                
                <!-- Option input -->
                <input
                    type="text"
                    class="rt03tabs-dom-class rf01input"
                    name="rt03auto-css-domClass" value="<?php echo $css['domClass']; ?>"
                    placeholder="...">
            </div>
        </div>


        <!-- CSS STYLE CUSTOM -->
        <div class="rt03option-styleCustom">
            <div class="rt03option-name">CSS Custom</div>
            
            <!-- Option textarea -->
            <textarea
                class="rf01input rt03auto-styleCustom"
                name="rt03auto-css-styleCustom"
                rows="10"
                ><?php echo html_entity_decode($css['styleCustom']); ?></textarea>
        </div>

    </div>
    <!-- PHAN STYLE CUSTOM - end -->
    
</div>
<!-- PHAN TABS SETTING - end -->