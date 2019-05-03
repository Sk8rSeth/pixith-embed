jQuery(document).ready(function($) {

    tinymce.create('tinymce.plugins.pixith_button', {
        init : function(editor, url) {
                var menuItem = [];
                var ds_img = pixith_assets_url +'/images/pixith-logo.png';
                $.each( pixith_shortcodes, function( i, val ){
                    var tempObj = {
                            text : val.title,
                            onclick: function() {
                                editor.insertContent(val.content)
                            }
                        };

                    menuItem.push( tempObj );
                } );
                // Register buttons - trigger above command when clickeditor
                editor.addButton('pixith_button', {
                    title : 'Pixith Shortcode',
                    classes : 'pixith-short-button',
                    type  : 'menubutton',
                    menu  : menuItem,
                    style : ' background-size : 22px; background-repeat : no-repeat; background-image: url( '+ ds_img +' );'
                });
        },
    });

    // Register our TinyMCE plugin
    tinymce.PluginManager.add('pixith_button', tinymce.plugins.pixith_button);
});
