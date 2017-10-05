<?php

/*
 * Login redirect if not administrator                  -   ON
 * Users redirect to main page                          -   ON
 * Limit/Restrict media library for users               -   ON
 * Delete original size of image                        -   ON
 * Delete thumbnail image                               -   ON
 *
 **/

/*
 ===================================================================
             Login redirect if not administrator
 ===================================================================
*/

add_filter("login_redirect", "sp_login_redirect", 10, 3);

function sp_login_redirect($redirect_to, $request, $user){
    if(is_array($user->roles))
        if(in_array('administrator', $user->roles) && in_array('editor', $user->roles) && ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) )
            return home_url('/wp-admin/');
    return home_url();
}

/*
   ===================================================================
               Users redirect to main page
   ===================================================================
*/

add_action('admin_init','users_redirect');

function users_redirect(){
    if (!(current_user_can('administrator')) && !(current_user_can('editor')) && ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) ) {
        wp_redirect(site_url());
        die();
    }
}

/*
   ===================================================================
               Limit/Restrict media library for users
   ===================================================================
*/

add_action('pre_get_posts','ml_restrict_media_library');

function ml_restrict_media_library( $wp_query_obj ) {
    global $current_user, $pagenow;
    if( !is_a( $current_user, 'WP_User') )
        return;
    if( 'admin-ajax.php' != $pagenow || $_REQUEST['action'] != 'query-attachments' )
        return;
    if( !current_user_can('manage_media_library') )
        $wp_query_obj->set('author', $current_user->ID );
    return;
}

/*
   ===================================================================
               Delete original size of image
   ===================================================================
*/

function delete_fullsize_image( $metadata )
{
    $upload_dir = wp_upload_dir();
    $full_image_path = trailingslashit( $upload_dir['basedir'] ) . $metadata['file'];
    $deleted = unlink( $full_image_path );

    return $metadata;
}

add_filter( 'wp_generate_attachment_metadata', 'delete_fullsize_image' );

/*
   ===================================================================
               Delete thumbnail image
   ===================================================================
*/

function delete_intermediate_image_sizes( $sizes ){
    return array_diff( $sizes, array(
        'medium',       // 'thumbnail', 'medium', 'medium_large', 'large',
        'medium_large', // 'thumbnail', 'medium', 'medium_large', 'large',
    ) );
}

add_filter( 'intermediate_image_sizes', 'delete_intermediate_image_sizes' );

