<?php
/**
 * Main HTML page of rubytabs plugins
 * Page : Tools
 */

?>


<!-- RUBYTABS wrap content -->
<div class="rt03page rt03page-options">

<!-- RUBYTABS wrap content -->
<!-- <div class="rubytabs-home wrap"> -->
    
    <!-- HEADER SECTION - begin
    ////////////////////////////////////////////////////////////////////////// -->
    <div class="rt03part-header rt03clear">

        <!-- RUBYTABS LOGO -->
        <a class="rt03logo" href="admin.php?page=rubytabs" title="Home">RUBYTABS</a>
        <span style="display: inline-block; padding: 4px 0 0 6px; color: #0099dd;"> - beta</span>

    </div>
    <!-- HEADER SECTION - end
    ////////////////////////////////////////////////////////////////////////// -->
    




    <!-- Phan IMPORT - EXPORT -->
    <h4 style="margin-top: 50px;">Import - Export</h4>
    <hr>

    <table class="form-table">
        <tr>
            <th>Import database</th>
            <td>
                <textarea
                    id="rt03import-field"
                    style="width: 100%;"
                    name="rt03import-field"
                    cols="30" rows="8"
                    spellcheck="false" autocomplete="off" autocorrect="off" autocapitalize="off"
                    placeholder="Past your rubytabs database"
                ></textarea>

                <a id="rt03import-update" class="button">Update Database</a>
                <a class="button rt03-form-clear" data-textarea="#rt03import-field">Clear</a>
                <br><br>
            </td>
        </tr>

        <tr>
            <th>Export database</th>
            <td>
                <textarea id="rt03export-field" style="width: 100%;" name="rt03export-field" cols="30" rows="15" readonly></textarea>
                <a id="rt03export-get" class="button">Get Database</a>
                <a id="rt03export-select" class="button">Select All</a>
                <a class="button rt03-form-clear" data-textarea="#rt03export-field">Clear</a>
                
                <!-- <a id="rt03-save-file" class="button" href="#">Save As File</a> -->
                <form action="" method="POST" style="margin-top: 10px;">
                    <input type="hidden" name="action" value="rt03export-download">
                    <input class="button" type="submit" value="Save As File">
                </form>
            </td>
        </tr>
    </table>

    <div class="output"></div>
</div>