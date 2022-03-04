<?php

// Create admin menu for plugin options
if ( !is_admin() ) return;
require_once  __DIR__ . '/includes/cmb2/init.php';
function swiu_options_submenu() {

    $cmb_options = new_cmb2_box( array(
        'id'           => 'swiu_options_submenu',
        'title'        => esc_html__( 'Stop War In Ukraine', 'swiu' ),
        'object_types' => array( 'options-page' ),
        'option_key'      => 'swiu_options_page', // The option key and admin menu page slug.
        'parent_slug'     => 'options-general.php', // Make options page a submenu item of the themes menu.
    ) );

    // Block or dismiss option
    $cmb_options->add_field( array(
        'name' => 'Displays an overlay showing proxied news from the free world to Russian visitors about the war in Ukraine. Includes an optional donation link.<br/><br/>',
        'desc' => 'Allow dismissing overlay (uncheck to inhibit Russian visitors to website content).',
        'id'   => 'swiu_dismiss_checkbox',
        'default' => '0',
        'type' => 'checkbox',
    ) );

    // Display Ukraine bank dontation
    $cmb_options->add_field( array(
        'name' => '',
        'desc' => 'Omit Ukraine Red Cross donation banner.',
        'id'   => 'swiu_donate_checkbox',
        'default' => '0',
        'type' => 'checkbox',
    ) );

    // Display Ukraine bank dontation
    $cmb_options->add_field( array(
        'name' => '',
        'desc' => 'Test on my IP Address ' . $_SERVER['REMOTE_ADDR'],
        'id'   => 'swiu_test_checkbox',
        'default' => '0',
        'type' => 'checkbox',
    ) );

    $cmb_options->add_field( array(
        'id'   => 'swiu_test_hidden',
        'type' => 'hidden'
    ) );
}
add_action( 'cmb2_admin_init', 'swiu_options_submenu' );

function swiu_admin_js() {
    ?><script>
    (function($) {
        $(function() {
            $('#swiu_test_hidden').val("<?php echo $_SERVER['REMOTE_ADDR']; ?>");
        });
    })(jQuery);
    </script><?php
}
add_action('admin_footer', 'swiu_admin_js');