/**
 * RUBYTABS BUTTON TRONG WP EDITOR
 */
(function($) {

/**
 * LOAI BO SCRIPT INLINE
 */
var $script = $('.rt03script-value');
$script.length && $script.remove();











/**
 * SETUP BUTTON TRONG WP EDITOR
 */
var VA  = window.rt03VA,
    aID = !!VA && !!VA.tabsID ? VA.tabsID : null;

// Kiem tra trang hien tai la Trang Ruby editor
var isPageRubyEdit = !!$('body.toplevel_page_rubytabs-lite').length;




/**
 * SETUP TAO BUTTON CHO TINYMCE VERSION 4.x
 */
var fnAddButtonFor4x = function() {

    // THEM BUTTON RUBYTABS VAO TINYMCE
    tinymce.PluginManager.add('rubytabs_lite', function( editor ) {
        var subMenu = [];


        /**
         * SETUP DANH SACH TRONG SUBMENU
         */
        for( var id in aID ) {
            subMenu.push({
                text    : aID[id]['name'] +' [#'+ id +']',
                value   : '[' + VA.nameVar +' id="'+ id + '"]',
                onclick : function() {
                    editor.insertContent(this.value());
                }
            });
        }


        /**
         * CHEN BUTTON RUBY VAO WP EDITOR
         */
        editor.addButton( 'rubytabs_lite', {
            title : 'RubyTabs Lite',
            icon  : 'icon rt03icon-rubytabs-lite',
            type  : 'menubutton',
            menu  : subMenu
        });
    });
},







/**
 * SETUP ADD BUTTON CHO TINYMCE VERSION 3.x
 */
fnAddButtonFor3x = function() {

    /**
     * KHOI TAO BUTTON
     */
    tinymce.create('tinymce.plugins.rubytabs_lite', {
        createControl: function(name, cm) {

            if( name == 'rubytabs_lite' ) {

                /**
                 * TAO BUTTON CHINH
                 */
                var createMenu = cm.createMenuButton('rubytabs_lite', {
                        title : 'RubyTabs Lite',
                        image : VA.url + '/admin/imgs/icon-ruby-dark.svg',
                        icons : false
                });


                /**
                 * TAO DANH SACH SHORTCODE
                 */
                createMenu.onRenderMenu.add(function(c, menu) {
                    for( var id in aID ) {

                        menu.add({
                            title   : aID[id]['name'] +' [#'+ id +']',
                            value   : '[' + VA.nameVar +' id="'+ id + '"]',
                            onclick : function() {
                                tinymce.activeEditor.execCommand('mceInsertContent', false, this.value);
                            }
                        });
                    }
                });

                // Return the new menu button instance
                return createMenu;
            }
            
            return null;
        }
    });
    
    // Chen Button RubyTabs lite vao he thong WP editor
    tinymce.PluginManager.add( 'rubytabs_lite', tinymce.plugins.rubytabs_lite );
};





/**
 * DIEU KIEN CHEN BUTTON VAO WP EDITOR
 */
if( !isPageRubyEdit && aID != null && $.isPlainObject(aID) ) {

    // Setup chen` button vao WP editor
    tinymce.majorVersion == '3' ? fnAddButtonFor3x() : fnAddButtonFor4x();
}

})(jQuery);