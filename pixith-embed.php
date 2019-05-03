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
        $this->includes();
        add_action( 'wp_enqueue_scripts', array( $this, 'pixith_enqueue_scripts' ), 9999 );
    }

    public static function init() {
        if (! self::$_pixith) {
            self::$_pixith = new PixithEmbed();
        }
        return self::$_pixith;
    }

    public function includes() {
        //always includes
        require_once PIXITH_ROOT . '/inc/shortcode.php';

        // admin only includes
        if (is_admin()) {
            require_once PIXITH_ROOT . '/inc/admin/shortcode-button.php';

        // frontend only includes
        } else {
        }
    }

    function pixith_enqueue_scripts() {
        wp_register_script('pixith-tinymce-button', PIXITH_ASSET_URI.'/js/pixith-tinymce-button.js');
    }
}

PixithEmbed::init();
