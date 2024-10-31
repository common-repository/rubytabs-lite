<?php
?>


<div class="rt03part-imex">

    <!-- IMPORT NAME -->
    <h2 class="rt03part-name">IMPORT</h2>

    <!-- IMPORT SECTION - begin -->
    <div class="rt03import">
    <div class="rt03import-inner">
            
            <!-- Button select file -->
            <input type="file" class="rt03import-input-file">
            <a class="rt03import-select rf01btn-large rf01btn-blue ">Choose file</a>

            <!-- Button upload data -->
            <a class="rt03import-upload rt03deactived rt03btn-ajax-tabs">
                <span class="rf01btn-large rf01btn-red rt03btn2-first">Import data</span>
                <span
                    class="rt03btn2-last"
                    data-rt03svg='{"name": "loader-puff", "width": 55, "height": 55, "strokeWidth": 2, "color": "#dd0000" }'
                ></span>
            </a>

            <!-- Message output -->
            <div class="rt03import-output"></div>
    </div>
    </div>
    <!-- IMPORT SECTION - begin -->
    


    <!-- EXPORT SECTION - begin -->
    <div class="rt03export">

        <!-- Export name -->
        <h2 class="rt03part-name">EXPORT</h2>

        <div class="rt03export-control">
            <!-- Button select all -->
            <a class="rf01btn rt03export-select-all">Select all</a>

            <!-- Button save as file -->
            <form class="rt03export-download" method="POST">
                <input type="hidden" name="action" value="rt03export-download">
                <input class="rt03export-info" type="hidden" name="rt03info" value="">

                <input type="submit" class="rt03export-submit" name="submit" value="Download">
                <a class="rf01btn rt03export-download-btn rt03deactived">Download</a>
            </form>
        </div>
    </div>
    <!-- EXPORT SECTION - end -->
</div>