<?php
?>


<div>
    <div class="rt01pagitem">Swipe</div>
    <div class="rt03row">
    

        <!-- IS SWIPE -->
        <div class="test rt03option-item rt03col4 rt03col-s-6 rt03col-xs-12">
            <div class="rt03option-name">Touch swipe gestures</div>
            
            <!-- Option checkbox -->
            <div class="rf01checkbox" data-value-last="<?php echo $jsData['isSwipe']; ?>">
                <input type="hidden" name="rt03auto-jsData-isSwipe">
            </div>
        </div>


        <!-- SWIPE ON BODY -->
        <div class="rt03option-item rt03col4 rt03col-s-6 rt03col-xs-12">
            <div class="rt03option-name">Swipe on body</div>
            
            <!-- Option checkbox -->
            <div class="rf01checkbox" data-value-last="<?php echo $jsData['swipe']['isBody']; ?>">
                <input type="hidden" name="rt03auto-jsData-swipe-isBody">
            </div>
        </div>


        <!-- AUTO ON PAGINATION -->
        <div class="rt03option-item rt03col4 rt03col-s-6 rt03col-xs-12">
            <div class="rt03option-name">Auto on pagination</div>
            
            <!-- Option checkbox -->
            <div class="rf01checkbox" data-value-last="<?php echo $jsData['swipe']['isAutoOnPag']; ?>">
                <input type="hidden" name="rt03auto-jsData-swipe-isAutoOnPag">
            </div>
        </div>

    </div>
</div>