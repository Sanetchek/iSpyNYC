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


//////////////////////////////////////////////////////////////////////////////////////////
Если есть ограничения для входа в /wp-admin, нужно дописать еще одно исключение в файл функций:
 && ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX )

function sp_login_redirect($redirect_to, $request, $user){
    if(is_array($user->roles))
        if(in_array('administrator', $user->roles) && in_array('editor', $user->roles) && ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) )
            return home_url('/wp-admin/');
    return home_url();
}
 */

add_action( 'wp_ajax_nopriv_ispy_popup', 'ispy_popup_callback' );
add_action( 'wp_ajax_ispy_popup', 'ispy_popup_callback' );

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