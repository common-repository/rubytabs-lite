<?php
?>


<div>
    <div class="rt01pagitem">Others</div>
    <div class="rt03">


        <!-- SLIDE BEGIN SHOW -->
        <div class="rt03option-item rt03col6 rt03col-l-4">
            <div class="rt03option-name">Slide start at
                <div class="rt03cell-desc">Value 0 for last slide.</div>
            </div>
            
            <!-- Option value -->
            <div class="rf01input-updown" data-value-last="<?php echo $jsData['idBegin']; ?>" data-options='{ "offset": 1, "min": -1 }'>
                <input class="rf01input rf01input-updown-value" type="text" name="rt03auto-jsData-idBegin">
            </div>
        </div>


        <!-- MARGIN -->
        <div class="rt03option-item rt03col6 rt03col-l-4" data-rf01checkbox-more="options">
            <div class="rt03option-name">Margin between of two slides</div>
            
            <!-- Option input -->
            <div class="rf01input-updown" data-value-last="<?php echo $jsData['margin']; ?>" data-options='{ "plus": 5, "unit": "px" }'>
                <input class="rf01input rf01input-updown-value" type="text" name="rt03auto-jsData-margin">
            </div>
        </div>

    </div>
</div>