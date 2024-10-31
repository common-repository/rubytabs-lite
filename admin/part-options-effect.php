<?php
?>


<div>
    <div class="rt01pagitem">Effect</div>
    <div class="rt03row">


        <!-- LOAI HIEU UNG -->
        <div class="rt03option-item rt03col6 rt03col-x-12">
            <div class="rt03option-name">Type</div>
            
            <!-- Option select -->
            <div class="rf01select-one" data-value-last="<?php echo $jsData['fx']; ?>">
                <input type="hidden" name="rt03auto-jsData-fx">
                
                <div class="rt03select-item" data-value="none">
                    <i class="rt03i48-fx-none"></i>
                    <span>None</span>
                </div>

                <div class="rt03select-item" data-value="line">
                    <i class="rt03i48-fx-line"></i>
                    <span>Line</span>
                </div>

                <div class="rt03select-item" data-value="fade">
                    <i class="rt03i48-fx-fade"></i>
                    <span>Fade</span>
                </div>
            </div>
        </div>


        <!-- SPEED -->
        <div class="rt03option-item rt03col6 rt03col-s-12">
            <div class="rt03option-name">Speed</div>
            
            <!-- Option ranger -->
            <div
                class="rr01"
                data-ranger='{ "valueBegin": <?php echo $jsData['speed']; ?>, "range": [200, 2000], "round": 100 }'
                >
                <input class="rr01value" type="text" name="rt03auto-jsData-speed" value="<?php echo $jsData['speed']; ?>">
            </div>
        </div>

    </div>
</div>