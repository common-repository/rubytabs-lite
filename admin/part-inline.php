<?php
?>


<div class="rt03none">

    <!-- INLINE DELETE - begin -->
    <div id="rt03warn-delete">
        <h1 class="rt03box-title">Confirm&nbsp;&hairsp;Delete</h1>
        
        <div class="rt03btn-ajax-tabs">

            <a  class="rt03confirm-delete rt03btn-confirm rt03btn-ajax-first"
                data-rt03info='<?php echo $btn_ajax_delete_info; ?>'
                data-options='{ "parent": ".rt03btn-ajax-tabs" }'>
                <i class="rt03i48-other-yes"></i>Delete</a>

            <a  class="rt03confirm-cancel rt03btn-confirm rt03btn-ajax-first">
                <i class="rt03i48-other-no"></i>Cancel</a>

            <span
                class="rt03btn-ajax-last"
                data-rt03svg='{"name": "loader-puff", "width": 55, "height": 55, "strokeWidth": 2, "color": "#dd0000" }'
            ></span>
        </div>
    </div>
    <!-- INLINE DELETE - end -->










    <!-- INLINE PREVIEW - begin -->
    <div id="rt03id-preview">
        <h1 class="rt03box-title">Preview</h1>
        <div class="rt03preview"></div>
    </div>
    <!-- INLINE PREVIEW - end -->










    <!-- INLINE DONATE - begin -->
    <div id="rt03id-donate">
        <h1 class="rt03box-title">Donate</h1>

        <div class="rt03donate rt03clear">
            
            <!-- BUY JS VERSION -->
            <div class="rt03donate-js">
                <img class="rt03donate-thumb" src="<?php echo $url_imgs; ?>/plugin-preview.png" alt="Plugin preview">
                
                <!-- <h1 class="rt03donate-title">Buy RubyTabs premium jquery plugin</h1> -->
                <h1 class="rt03donate-title">Buy RubyTabs jquery plugin version</h1>
                
                <a  class="rt03btn"
                    href="http://codecanyon.net/item/rubytabs-premium-tabs-slider/14156443?ref=haibach"
                    target="_blank"
                    >Buy on Codecanyon</a>
            </div>


            <!-- DONATE BY PAYPAL -->
            <div class="rt03donate-paypal">
                <img class="rt03donate-thumb" src="<?php echo $url_imgs; ?>/logo-paypal.svg" alt="Paypal preview">

                <h1 class="rt03donate-title">Donate by Paypal</h1>
                
                <!-- Button Paypal -->
                <a class="rt03btn-paypal rt03btn">Donate</a>
                
            </div>


            <!-- Footer -->
            <div class="rt03donate-footer">Thank you very much!</div>

        </div>
    </div>
    <!-- INLINE DONATE - begin -->

</div>