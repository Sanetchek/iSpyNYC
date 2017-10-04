<?php

/*
 * Remove link replytocom                                               -   ON
 * Remove link replytocom                                               -   ON
 * Removing WordPress Version from pages, RSS, scripts and styles       -   ON
 * Remove Admin bar                                                     -   ON
 * Remove WordPress Meta Generator                                      -   ON
 * REMOVE WP EMOJI                                                      -   ON
 *
 **/

/*
===================================================================
          Remove link replytocom
===================================================================
*/

add_filter('comment_reply_link', 'add_nofollow', 420, 4);

function add_nofollow($link, $args, $comment, $post){
    return preg_replace( '/href=\'(.*(\?|&)replytocom=(\d+)#respond)/', 'href', $link );
}

/*
===================================================================
          Remove link replytocom
===================================================================
*/

//Добавить комментарий ответ ссылки в nofollow
function add_nofollow_to_reply_link( $link ) {
    return str_replace( '")\'>', '")\' rel=\'nofollow\'>', $link );
}
add_filter( 'comment_reply_link', 'add_nofollow_to_reply_link' );

///////////////////////////////////////////////////////////////
add_filter('comment_form_field_url', '__return_false');

add_filter('duplicate_comment_id', '__return_false');

/*
===================================================================
          Removing WordPress Version from pages, RSS, scripts and styles
===================================================================
*/
add_filter('the_generator', '__return_empty_string');
function rem_wp_ver_css_js( $src ) {
    if ( strpos( $src, 'ver=' ) )
        $src = remove_query_arg( 'ver', $src );
    return $src;
}
add_filter( 'style_loader_src', 'rem_wp_ver_css_js', 9999 );
add_filter( 'script_loader_src', 'rem_wp_ver_css_js', 9999 );

/*
===================================================================
          Remove Admin bar
===================================================================
*/

add_filter('show_admin_bar', '__return_false');

/*
===================================================================
          Remove WordPress Meta Generator
===================================================================
*/

remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'feed_links_extra', 3);

/*
===================================================================
          REMOVE WP EMOJI
===================================================================
*/

remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('admin_print_styles', 'print_emoji_styles');

/*
===================================================================
          REMOVE REST API
===================================================================
*/

add_filter('rest_enabled', '__return_false');

// Отключаем фильтры REST API
remove_action( 'xmlrpc_rsd_apis', 'rest_output_rsd' );
remove_action( 'wp_head', 'rest_output_link_wp_head', 10, 0 );
remove_action( 'template_redirect', 'rest_output_link_header', 11, 0 );
remove_action( 'auth_cookie_malformed', 'rest_cookie_collect_status' );
remove_action( 'auth_cookie_expired', 'rest_cookie_collect_status' );
remove_action( 'auth_cookie_bad_username', 'rest_cookie_collect_status' );
remove_action( 'auth_cookie_bad_hash', 'rest_cookie_collect_status' );
remove_action( 'auth_cookie_valid', 'rest_cookie_collect_status' );
remove_filter( 'rest_authentication_errors', 'rest_cookie_check_errors', 100 );

// Отключаем события REST API
remove_action( 'init', 'rest_api_init' );
remove_action( 'rest_api_init', 'rest_api_default_filters', 10, 1 );
remove_action( 'parse_request', 'rest_api_loaded' );

// Отключаем Embeds связанные с REST API
remove_action( 'rest_api_init', 'wp_oembed_register_route');
remove_filter( 'rest_pre_serve_request', '_oembed_rest_pre_serve_request', 10, 4 );
remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );

