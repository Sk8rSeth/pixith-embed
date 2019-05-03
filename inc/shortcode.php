<?php
function pixith_embed_shortcodes_init() {
    function pixith_embed_shortcode($atts = []) {
        // normalize attribute keys, lowercase
        $atts = array_change_key_case((array)$atts, CASE_LOWER);
        $pixith_atts = shortcode_atts([
            'url' => 'vuria.com',
            'utm_medium' => 'external_embed',
        ], $atts);
        // do something to $content
        $html = '<div>'. $pixith_atts['url'] .'</div>';
        $html .= '<div>'. $pixith_atts['utm_medium'] .'</div>';

        // always return
        return $html;
    }
    add_shortcode('pixith', 'pixith_embed_shortcode');
}
add_action('init', 'pixith_embed_shortcodes_init');
