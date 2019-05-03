<?php
/**
* @package Pixith-Embed
*/
/*
Plugin Name: Pixith Embed
Description: This plugin adds a shortcode for creating a button and modal adding embed DOM and tracking info for infographics.
Version: 1.0.0
Author: Seth Howell
Author URI: https://seth-howell.com
License: GPLv3 or later
*/

/*
This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <https://www.gnu.org/licenses/>.
*/

if (!defined('ABSPATH')) {
    die();
}

define( 'PIXITH_ROOT', dirname(__FILE__) );
define( 'PIXITH_ROOT_URI', plugins_url('', __FILE__) );
define( 'PIXITH_ASSET_URI', PIXITH_ROOT_URI . '/assets' );

class PixithEmbed {

    private static $_pixith;

    public function __construct() {
        $this->php_includes();
        $this->init_hooks();

    }

    public static function init() {
        if (! self::$_pixith) {
            self::$_pixith = new PixithEmbed();
        }
        return self::$_pixith;
    }

    public function php_includes() {
        //always includes
        require_once PIXITH_ROOT . '/inc/shortcode.php';

        // admin only includes
        if (is_admin()) {
            require_once PIXITH_ROOT . '/inc/admin/shortcode-button.php';
            require_once PIXITH_ROOT . '/inc/admin/settings-page.php';

        // frontend only includes
        } else {
        }
    }

    public function init_hooks() {
        add_action( 'wp_enqueue_scripts', array( $this, 'pixith_frontend_enqueue_scripts' ), 9999 );
        add_action( 'admin_enqueue_scripts', array( $this, 'pixith_admin_enqueue_scripts' ), 9999 );

    }

    function pixith_frontend_enqueue_scripts() {
        // front end enqueues
        wp_enqueue_script('pixith-modal', PIXITH_ASSET_URI.'/js/pixith-modal.js', array( 'jquery' ));
        wp_enqueue_script('fancybox-js', PIXITH_ASSET_URI.'/js/jquery.fancybox.min.js', array( 'jquery' ));

        wp_enqueue_style('pixith-css', PIXITH_ASSET_URI.'/css/pixith-embed-styles.css');
        wp_enqueue_style('fancybox-css', PIXITH_ASSET_URI.'/css/jquery.fancybox.min.css');
    }

    function pixith_admin_enqueue_scripts() {
        // admin side enqueues
        wp_enqueue_script('pixith-tinymce-button', PIXITH_ASSET_URI.'/js/admin/pixith-tinymce-button.js', array( 'jquery' ));
    }

    public static function con($text){
        return '<div>'.$text.'</div>';
    }

}

PixithEmbed::init();
