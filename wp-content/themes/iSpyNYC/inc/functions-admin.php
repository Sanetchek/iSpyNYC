<?php

function custom_login_logo() {
    // Scripts
    wp_enqueue_script('bg', get_template_directory_uri() . '/js/admin-bg.js', false, null, true);
}
add_action( 'login_enqueue_scripts', 'custom_login_logo' );