<?php

/*
 * Ispy POPUP with Ajax -   ON
 *
 **/

/*
 * HINT

add_action('wp_ajax_(action)', 'my_action_callback');
add_action('wp_ajax_nopriv_(action)', 'my_action_callback');

(action) - from js file, action : 'ispy-popup', you need to replace by sunset_load_more = wp_ajax_ispy-popup

ispy_popup_callback - it's your function in ajax.php file, function ispy_popup_callback() {}
 */
add_action( 'wp_ajax_ispy-popup',        'ispy_popup_callback' ); // For logged in users
add_action( 'wp_ajax_nopriv_ispy-popup', 'ispy_popup_callback' ); // For anonymous users

function ispy_popup_callback(){
    $paged = $_POST["page"];

    $args = array(
        'p' => $paged,
        'post_type' => 'post',
    );

    $query = new WP_Query( $args );
    if ( $query->have_posts() ) :
        while ( $query->have_posts() ) : $query->the_post();

            get_template_part( 'template-parts/content/content-popup' );

        endwhile;
    endif;
    wp_reset_query();

    wp_die();
}