<?php

class PixithEmbedButton {
    public function __construct() {
        add_filter( 'mce_external_plugins',  array( $this, 'enqueue_plugin_scripts' ) );
        add_filter( 'mce_buttons',  array( $this, 'register_buttons_editor' ) );

        add_action( 'admin_enqueue_scripts', array( $this, 'localize_shortcodes' ) , 90  );
        add_action( 'admin_enqueue_scripts', array($this, 'enqueue_scripts'), 80 );

        add_action( 'media_buttons', array( $this, 'add_media_button' ), 20 );
        add_action( 'admin_footer', array( $this, 'media_thickbox_content' ) );
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
