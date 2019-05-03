<?php

add_action('admin_init', 'pixith_settings_init');
add_action( 'admin_menu', 'pixith_options_page', 10);

function pixith_settings_init() {

    register_setting('Pixith', 'pixith_options');
    // register a new section in the "pixith" page
    add_settings_section(
    'pixith_section_developers',
    __( 'The Matrix has you.', 'pixith' ),
    'pixith_section_developers_cb',
    'pixith'
    );

    // register a new field in the "pixith_section_developers" section, inside the "pixith" page
    add_settings_field(
    'pixith_field_pill', // as of WP 4.6 this value is used only internally
    // use $args' label_for to populate the id inside the callback
    __( 'Pill', 'pixith' ),
    'pixith_field_pill_cb',
    'pixith',
    'pixith_section_developers',
    [
    'label_for' => 'pixith_field_pill',
    'class' => 'pixith_row',
    'pixith_custom_data' => 'custom',
    ]
    );
}

function pixith_section_developers_cb( $args ) {
 ?>
 <p id="<?php echo esc_attr( $args['id'] ); ?>"><?php esc_html_e( 'Follow the white rabbit.', 'pixith' ); ?></p>
 <?php
}

// pill field cb

// field callbacks can accept an $args parameter, which is an array.
// $args is defined at the add_settings_field() function.
// wordpress has magic interaction with the following keys: label_for, class.
// the "label_for" key value is used for the "for" attribute of the <label>.
// the "class" key value is used for the "class" attribute of the <tr> containing the field.
// you can add custom key value pairs to be used inside your callbacks.
function pixith_field_pill_cb( $args ) {
 // get the value of the setting we've registered with register_setting()
 $options = get_option( 'pixith_options' );
 // output the field
 ?>
 <select id="<?php echo esc_attr( $args['label_for'] ); ?>"
 data-custom="<?php echo esc_attr( $args['pixith_custom_data'] ); ?>"
 name="pixith_options[<?php echo esc_attr( $args['label_for'] ); ?>]"
 >
 <option value="red" <?php echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], 'red', false ) ) : ( '' ); ?>>
 <?php esc_html_e( 'red pill', 'pixith' ); ?>
 </option>
 <option value="blue" <?php echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], 'blue', false ) ) : ( '' ); ?>>
 <?php esc_html_e( 'blue pill', 'pixith' ); ?>
 </option>
 </select>
 <p class="description">
 <?php esc_html_e( 'You take the blue pill and the story ends. You wake in your bed and you believe whatever you want to believe.', 'pixith' ); ?>
 </p>
 <p class="description">
 <?php esc_html_e( 'You take the red pill and you stay in Wonderland and I show you how deep the rabbit-hole goes.', 'pixith' ); ?>
 </p>
 <?php
}

function pixith_options_page() {
    // add top level menu page
    add_submenu_page(
        'options-general.php',
        'Pixith',
        'Pixith Options',
        'manage_options',
        'pixith',
        'pixith_options_page_html'
    );
}

function pixith_options_page_html() {
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }
    // add error/update messages

 // check if the user have submitted the settings
 // wordpress will add the "settings-updated" $_GET parameter to the url
 if ( isset( $_GET['settings-updated'] ) ) {
 // add settings saved message with the class of "updated"
 add_settings_error( 'pixith_messages', 'pixith_message', __( 'Settings Saved', 'pixith' ), 'updated' );
 }

 // show error/update messages
 settings_errors( 'pixith_messages' );
 ?>
 <div class="wrap">
 <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
 <form action="options.php" method="post">
 <?php
 // output security fields for the registered setting "pixith"
 settings_fields( 'pixith' );
 // output setting sections and their fields
 // (sections are registered for "pixith", each field is registered to a specific section)
 do_settings_sections( 'pixith' );
 // output save settings button
 submit_button( 'Save Settings' );
 ?>
 </form>
 </div>
 <?php
}
