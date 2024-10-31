<?php
/**
 * EDITOR SLIDE
 */

?>


<div id="rt03page-slide">
    
    <a class="rt03goto-slide rt03btn-header rt01pagitem"><i class="rt03icon"></i>Slide Editor</a>
    <form class="rt03form-ajax" spellcheck="false" autocomplete="off" autocorrect="off" autocapitalize="off">

        <!-- THONG TIN EDITOR SLIDE -->
        <input type="hidden" name="rt03auto-info-slideNum" value="<?php echo $slide_num; ?>">
        <input type="hidden" name="rt03auto-info-slideOrder" value='<?php echo json_encode($slide_order); ?>'>

        
        <!-- NOI DUNG CUA CAC SLIDE - begin -->
        <div class="rt03slide-content">

            <?php for( $i = 0; $i < $slide_num; $i++ ) :
                $slide_id = $slide_order[$i];
            ?>
            <textarea
                class="rt03auto-title"
                name="rt03auto-contents-<?php echo $slide_id; ?>-title"
                data-rt03id="<?php echo $slide_id; ?>"
            ><?php echo html_entity_decode( $contents[$slide_id]['title'] ); ?></textarea>
            
            <textarea
                class="rt03auto-content"
                name="rt03auto-contents-<?php echo $slide_id; ?>-content"
                data-rt03id="<?php echo $slide_id; ?>"
            ><?php echo html_entity_decode( $contents[$slide_id]['content'] ); ?></textarea>
            <?php endfor; ?>

        </div>
        <!-- NOI DUNG CUA CAC SLIDE - begin -->







        <!-- SLIDE LIST - begin -->
        <div class="rt03slide-list">

            <?php
            for( $i = 0; $i < $slide_num; $i++ ) :
            
                // Setup slide title luc ban dau
                $slide_title = html_entity_decode( $contents[$i]['title'] );
                if( $i == 0 && $slide_title == '' ) $slide_title = $title_init;

            ?>

            <div class="rt03sl-item rs20item" data-rt03id="<?php echo $slide_order[$i]; ?>">
                
                <div class="rt03sl-front">
                    <div class="rt03sl-name"><?php echo $slide_title; ?></div>
                    <div class="rt03sl-info">
                        <span class="rt03sl-id"># <?php echo $i + 1; ?></span>
                        <a class="rt03sl-more"><i class="rt03i16-more"></i></a>
                        <a class="rt03sl-drag"><i class="rt03i16-drag"></i></a>
                    </div>
                </div>

                <div class="rt03sl-back">
                    <a class="rt03sl-duplicate">Duplicate</a>
                    <a class="rt03sl-delete">Delete</a>
                </div>

            </div>
            <?php endfor; ?>


            <!-- TAO SLIDE MOI -->
            <div class="rt03sl-new">
                <div class="rt03sl-new-content">
                    <i class="rt03sl-plus"></i>
                    New Slide
                </div>
            </div>
        </div>
        <!-- SLIDE LIST - end -->






        <!-- TABS MAIN - begin
        ////////////////////////////////////////////////////////////////////////// -->
        <div class="rt03tabs-wrap rt03none">
            
            <!-- ADD / REMOVE SLIDE -->
            <div class="rt03tabs-control">
                <a class="rt03tabs-btn rt03slide-add" title="Add New Slide">
                    <i class="rt03i16-plus"></i>
                </a>

                <a class="rt03tabs-btn rt03slide-del" title="Remove Slide">
                    <i class="rt03i16-delete"></i>
                </a>
            </div>
        </div>
        <!-- TABS MAIN - end
        ////////////////////////////////////////////////////////////////////////// -->







        
        <!-- PHAN SLIDE SETTING - begin -->
        <div class="rt03slide-setting rt01 rt03flatbox"
            data-tabs='{
                "isAutoInit" : true,
                "fx"         : "line",
                "speed"      : 600,
                "swipe"      : { "isBody": false },
                "load"       : { "isLazy": false }
            }'>
            

            <!-- PHAN EDIT NOI DUNG CUA SLIDE - begin -->
            <div class="rt03slide-edit">
                <div class="rt01pagitem">Edit</div>

                <div class="rt03se-pagitem">
                    <textarea
                        class="rt03se-editor-title"
                        name="rt03se-editor-title"
                        rows="2"
                        placeholder="Title of Slide"
                    ></textarea>
                </div>


                <div class="rt03se-rowspace"></div>


                <div class="rt03se-content">
                <?php
                    // Cac bien setup
                    $content_id   = 'rt03se-editor-content';
                    $content_html = $contents[0]['content'];
                    $content_html = html_entity_decode($content_html);

                    // Render Editor
                    $editor_settings = array(
                        'wpautop'       => true,
                        'editor_class'  => 'rt03se-editor-content',
                        'editor_height' => 300,
                        'dfw'           => true,
                        'tinymce'       => array(
                            'wp_autoresize_on'  => true
                        )
                    );

                    // Mac dinh editor la html mode: ['tinymce', 'html']
                    // Chen` editor vao` trang
                    // add_filter('wp_default_editor', function() { return 'html'; });
                    wp_editor($content_html, $content_id, $editor_settings);
                ?>
                </div>
            </div>
            <!-- PHAN EDIT NOI DUNG CUA SLIDE - end -->

        </div>
        <!-- PHAN SLIDE SETTING - end -->







        <!-- PHAN FOOTER -->
        <?php require('nav-footer.php'); ?>
        
    </form>
</div>