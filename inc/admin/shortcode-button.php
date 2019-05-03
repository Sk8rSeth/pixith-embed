<?php
class PixithEmbedButton {
    private static $instance;

    public function __construct() {
        // add_filter( 'mce_external_plugins',  array( $this, 'enqueue_plugin_scripts' ) );
        // add_filter( 'mce_buttons',  array( $this, 'register_buttons_editor' ) );
        // add_action( 'admin_enqueue_scripts', array($this, 'enqueue_scripts'), 80 );
    }

    public static function init() {
        static $instance = false;

        if ( !$instance ) {
            $instance = new PixithEmbed();
        }

        return $instance;
    }

}

PixithEmbedButton::init();
