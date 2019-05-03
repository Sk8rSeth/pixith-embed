<?php
function pixith_embed_shortcodes_init() {
    function pixith_embed_shortcode($atts = []) {
        // normalize attribute keys, lowercase
        $atts = array_change_key_case((array)$atts, CASE_LOWER);
        $pixith_atts = shortcode_atts([
            'url' => 'vuria.com',
            'utm_medium' => 'external_embed',
        ], $atts);
        $html = '<div class="container">'; //open container element
        $html .= build_modal_button(); // build and display modal button element
        $html .= build_modal_html($pixith_atts['url'], $pixith_atts['utm_medium']); // build initially hidden modal popup
        $html .= '<div>'; //close container element

        // always return
        return $html;
    }
    add_shortcode('pixith', 'pixith_embed_shortcode');
}
add_action('init', 'pixith_embed_shortcodes_init');

function build_copy_code($asset_url = '', $utm_medium = '') {
    if (!empty($asset_url)) {
        // get website domain name
        $domain = get_site_url();
        // get website title
        $name = get_bloginfo('name');
        $code = '<div class="'.sanitize_title($name).'-embed">'; // create container with site name embed class
        $code .= '<img class="'.sanitize_title($name).'-infographic" src="'.$asset_url.'"/>'; //actually input the image linked
        $code .= '<a href="">From '.$domain.'</a>';
        $code .= '</div>';
        return htmlentities($code);
    }
}

function build_modal_html($asset_url = '', $utm_medium = '') {
    $modal = '<div class="pixith-embed-modal" id="embedModal" style="min-width:600px; max-width:800px; display: none;">';
    $modal .= '<h3 class="embed-header">Embed Code:</h3>';
    $modal .= '<p class="embed-subheader">click to copy</p>';
    $modal .= '<div class="code">'; // start code output, THIS IS WHERE THE CODE TO COPY IS VV
    $modal .= build_copy_code($asset_url, $utm_medium);
    $modal .= '</div>'; // end code copy section ^^
    $modal .= '</div>';
    return $modal;
}

function build_modal_button() {
    $html = '<a data-fancybox data-src="#embedModal" data-touch="false" class="button pixith-modal-button">';
    $html .= 'Embed This';
    // $html .= get_option('pixith_modal_button_text');
    $html .= '</a>';
    return $html;
}
