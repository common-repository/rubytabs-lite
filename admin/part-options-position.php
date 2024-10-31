<?php
?>


<div>
    <div class="rt01pagitem">Position</div>
    <div class="rt03row">


        <!-- DIRECTION -->
        <div class="rt03option-item rt03col4 rt03col-s-6 rt03col-xs-12" data-rf01checkbox-more="options">
            <div class="rt03option-name">Direction</div>
            
            <!-- Option select -->
            <div class="rf01select-one" data-value-last="<?php echo $jsData['pag']['direction']; ?>">
                <input type="hidden" name="rt03auto-jsData-pag-direction">

                <div class="rt03select-item" data-value="hor">
                    <i class="rt03i48-pos-hor"></i>
                    <span>Horizontal</span>
                </div>

                <div class="rt03select-item" data-value="ver">
                    <i class="rt03i48-pos-ver"></i>
                    <span>Vertical</span>
                </div>
            </div>
        </div>


        <!-- POSITION -->
        <div class="rt03option-item rt03col4 rt03col-s-6 rt03col-xs-12">
            <div class="rt03option-name">Position</div>
            
            <!-- Option select -->
            <div class="rf01select-one" data-value-last="<?php echo $jsData['pag']['position']; ?>">
                <input type="hidden" name="rt03auto-jsData-pag-position">

                <div class="rt03select-item" data-value="begin">
                    <i class="rt03i48-pos-pos-begin"></i>
                    <span>Begin</span>
                </div>

                <div class="rt03select-item" data-value="end">
                    <i class="rt03i48-pos-pos-end"></i>
                    <span>End</span>
                </div>
            </div>
        </div>


        <!-- ALIGN -->
        <div class="rt03option-item rt03col4 rt03col-s-12">
            <div class="rt03option-name">Align</div>
            
            <!-- Option select -->
            <div class="rf01select-one" data-value-last="<?php echo $jsData['pag']['align']; ?>">
                <input type="hidden" name="rt03auto-jsData-pag-align">

                <div class="rt03select-item" data-value="begin">
                    <i class="rt03i48-pos-align-begin"></i>
                    <span>Begin</span>
                </div>

                <div class="rt03select-item" data-value="center">
                    <i class="rt03i48-pos-align-center"></i>
                    <span>Center</span>
                </div>

                <div class="rt03select-item" data-value="end">
                    <i class="rt03i48-pos-align-end"></i>
                    <span>End</span>
                </div>

                <div class="rt03select-item" data-value="justified">
                    <i class="rt03i48-pos-align-justify"></i>
                    <span>Justified</span>
                </div>
            </div>
        </div>

    </div>
</div>