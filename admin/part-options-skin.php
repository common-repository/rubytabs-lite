<?php
?>


<div>
    <div class="rt01pagitem">Skin</div>
    <div class="rt03row">
    

        <!-- SKINS -->
        <div class="rt03option-item rt03col6">
            <div class="rt03option-name">Skin</div>
            
            <!-- Option select -->
            <div class="rf01select-one" data-value-last="<?php echo $css['skin']; ?>">
                <input type="hidden" name="rt03auto-css-skin">
                
                <div class="rt03select-item" data-value="">
                    <i class="rt03i48-other-none"></i>
                    <span>Basic</span>
                </div>

                <div class="rt03select-item" data-value="rt01flat">
                    <i class="rt03i48-other-flat"></i>
                    <span>Flat</span>
                </div>

                <div class="rt03select-item" data-value="rt01outline">
                    <i class="rt03i48-other-outline"></i>
                    <span>Outline</span>
                </div>

                <div class="rt03select-item" data-value="rt01round">
                    <i class="rt03i48-other-round"></i>
                    <span>Round</span>
                </div>

                <div class="rt03select-item" data-value="rt01underline">
                    <i class="rt03i48-other-underline"></i>
                    <span>Underline</span>
                </div>
            </div>
        </div>


        <!-- SIZE -->
        <div class="rt03option-item rt03col6 rt03col-l-4" style="display: block;">
            <div class="rt03option-name rt03option-name-narrow">Size of title</div>
            
            <!-- Option select -->
            <div class="rf01select-one" data-value-last="<?php echo $css['size']; ?>">
                <input type="hidden" name="rt03auto-css-size">

                <div class="rt03select-item" data-value="rt01size-s">
                    <i class="rt03i48-other-small"></i>
                    <span>Small</span>
                </div>

                <div class="rt03select-item" data-value="">
                    <i class="rt03i48-other-normal"></i>
                    <span>Normal</span>
                </div>

                <div class="rt03select-item" data-value="rt01size-l">
                    <i class="rt03i48-other-large"></i>
                    <span>Large</span>
                </div>
            </div>
        </div>


        <!-- COLOR -->
        <div class="rt03option-item rt03col6 rt03col-l-2">
            <div class="rt03option-name">Main color</div>
            
            <!-- Option colorpicker -->
            <div class="rt03picker">
                <input type="text" class="rt03picker-item" name="rt03auto-css-colorCur" value="<?php echo $css['colorCur']; ?>" data-default-color="<?php echo $css['colorDefault']; ?>">
            </div>
        </div>

    </div>
</div>