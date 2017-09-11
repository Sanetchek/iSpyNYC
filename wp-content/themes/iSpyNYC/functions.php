<?php

/*
===================================================================
          Require
===================================================================
*/

require_once('users/user_admin.php');

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
          Register Scripts and Css
===================================================================
*/

function ispynyc_scripts()
{
    wp_enqueue_style('font-awesome', get_template_directory_uri() . '/font-awesome/css/font-awesome.min.css');
    wp_enqueue_style('style', get_template_directory_uri() . '/style.css');

    wp_enqueue_script('bg', get_template_directory_uri() . '/js/bg.js', false, null, true);
    wp_enqueue_script('script', get_template_directory_uri() . '/js/script.js', false, null, true);
    wp_enqueue_script('comment', get_template_directory_uri() . '/js/comment.js', false, null, true);
    wp_enqueue_script('comment-reply', get_template_directory_uri() . '/js/comment-reply.js', false, null, true);
    wp_enqueue_script('content', get_template_directory_uri() . '/js/content.js', false, null, true);
    wp_enqueue_script('toggle-menu', get_template_directory_uri() . '/js/toggle-menu.js', false, null, true);
    wp_enqueue_script('re-captcha', 'https://www.google.com/recaptcha/api.js', false, null, false);

    wp_enqueue_script( 'jquery' );
    wp_enqueue_script('html5lightbox', get_template_directory_uri() . '/html5lightbox/html5lightbox.js');
}

add_action('wp_enqueue_scripts', 'ispynyc_scripts');

/*
===================================================================
          Register Nav Menu
===================================================================
*/

register_nav_menus(array(
    'primary' => 'Primary Menu',
    'feedback' => 'Feedback Menu',
    'footer-menu' => 'Footer Menu'
));

register_nav_menu('primary', 'Primary Menu');

/*
===================================================================
          Switch default core markup for search form, comment form,
          and comments to output valid HTML5.
===================================================================
*/

add_theme_support('html5', array(
    'search-form',
    'comment-form',
    'comment-list',
    'gallery',
    'caption',
));

/*
===================================================================
          Enable support for Post Formats.
===================================================================
*/

add_theme_support('post-formats', array(
    'aside',
    'image',
    'video',
    'quote',
    'link',
    'gallery',
    'status',
    'audio',
    'chat',
));

/*
===================================================================
          Register sidebar
===================================================================
*/

register_sidebar(array(
    'name' => 'Advertise',
    'id' => 'ads',
    'description' => 'Widgets in this area will be shown on all posts and pages.',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
));

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
           Pagination
===================================================================
*/

function wp_corenavi() {
    global $wp_query;
    $pages = '';
    $max = $wp_query->max_num_pages;
    if (!$current = get_query_var('paged')) $current = 1;
    $a['base'] = str_replace(999999999, '%#%', get_pagenum_link(999999999));
    $a['total'] = $max;
    $a['current'] = $current;

    $total = 1; //1 - выводить текст "Страница N из N", 0 - не выводить
    $a['mid_size'] = 3; //сколько ссылок показывать слева и справа от текущей
    $a['end_size'] = 1; //сколько ссылок показывать в начале и в конце
    $a['prev_text'] = '&laquo;'; //текст ссылки "Предыдущая страница"
    $a['next_text'] = '&raquo;'; //текст ссылки "Следующая страница"

    if ($max > 1) echo '<div class="navigation" style="display:none">';
    if ($total == 1 && $max > 1) $pages = '<span class="pages">Page ' . $current . ' of ' . $max . '</span>'."\r\n";
    echo $pages . paginate_links($a);
    if ($max > 1) echo '</div>';
}

////////////////////////////////////////////    Custom Admin     /////////////////////////////////////////////

/*
===================================================================
           Change Admin head color
===================================================================
*/

add_action('admin_head', 'custom_colors');
function custom_colors() {
    echo '<style type="text/css">
	#wpadminbar{background:#141f89}
	li#wp-admin-bar-comments {
    display: none;}
	</style>';
}

/*
===================================================================
           Remove WordPress widgets
===================================================================
*/

function clear_dash(){
    $side = &$GLOBALS['wp_meta_boxes']['dashboard']['side']['core'];
    $normal = &$GLOBALS['wp_meta_boxes']['dashboard']['normal']['core'];

    unset($side['dashboard_quick_press']); //Быстрая публикация
    unset($side['dashboard_primary']); //Блог WordPress
    unset($side['dashboard_secondary']); //Другие Новости WordPress
    unset($normal['dashboard_incoming_links']); //Входящие ссылки
    unset($normal['dashboard_plugins']); //Последние Плагины
}
add_action('wp_dashboard_setup', 'clear_dash' );

/*
===================================================================
           Remove WordPress Logo from the WordPress Admin Bar
===================================================================
*/

function remove_wp_logo() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('wp-logo');
}
add_action( 'wp_before_admin_bar_render', 'remove_wp_logo' );

/*
===================================================================
           Add Icons Instead of Text to the Main Admin Bar
===================================================================
*/

function custom_adminbar_menu( $meta = TRUE ) {
    global $wp_admin_bar;
    if ( !is_user_logged_in() ) { return; }
    if ( !is_super_admin() || !is_admin_bar_showing() ) { return; }
    $wp_admin_bar->add_menu( array(
            'id' => 'custom_menu',
            'title' => __( '<img src="'. get_bloginfo('template_directory') .'/images/iSpy.svg" style="height: 30px;" />' ),
            'href' => get_home_url() )
    );
}
add_action( 'admin_bar_menu', 'custom_adminbar_menu', 15 );

/*
===================================================================
           Custom menu css
===================================================================
*/

function custom_menu_css() {
    $custom_menu_css = '<style type="text/css">  
        #wp-admin-bar-custom_menu img { display: block; margin: 0 auto; } /** moves icon over */  
        #wp-admin-bar-custom_menu { width:50px; } /** sets width of custom menu */ 
         
        #dashboard_right_now .main p {
            display: none !important;
        }      
        #screen-options-link-wrap {
            display: none !important;
        }
    </style>';
    echo $custom_menu_css;
}
add_action( 'admin_head', 'custom_menu_css' );

/*
===================================================================
           Change Login Logo
===================================================================
*/

function my_login(){
    echo '
   <style type="text/css">
        #login h1 a { background: url('. get_bloginfo('template_directory') .'/images/iSpy.svg) no-repeat 0 0 !important;
   			background-size: contain !important;
   			width: 150px;
   			height: 150px;
         }
         body.login {
            background: #094fab !important;
        }
        .login #nav {
            margin: 24px 0 0;
            color: #fff;
        }
        .login #backtoblog a, .login #nav a {
            text-decoration: none;
            color: #fff;
        }
    </style>';
}
add_action('login_head', 'my_login');

/*
===================================================================
           Remove Pages if not Administrator
===================================================================
*/

if (!(current_user_can('administrator'))) {
    function remove_wpcf7() {
        remove_menu_page( 'wpcf7' );                      // Contact Form 7
        remove_menu_page( 'edit-comments.php' );          // Редактор комментариев
        remove_menu_page( 'index.php' );                  //Консоль
        remove_menu_page( 'upload.php' );                 //Медиафайлы
        remove_menu_page( 'edit.php?post_type=page' );    //Страницы
        remove_menu_page( 'edit-comments.php' );          //Комментарии
        remove_menu_page( 'themes.php' );                 //Внешний вид
        remove_menu_page( 'plugins.php' );                //Плагины
        remove_menu_page( 'tools.php' );                  //Инструменты
        remove_menu_page( 'options-general.php' );        //Параметры
    }

    add_action('admin_menu', 'remove_wpcf7');
}

/*
===================================================================
           Change logotype link to site (not to wordpress.org)
===================================================================
*/

add_filter( 'login_headerurl', create_function('', 'return get_home_url();') );

/*
===================================================================
           Remove title in logotype "сайт работает на wordpress"
===================================================================
*/

add_filter( 'login_headertitle', create_function('', 'return false;') );

/*
===================================================================
           Remove welcome panel
===================================================================
*/

remove_action('welcome_panel', 'wp_welcome_panel');

/*
===================================================================
           Custom WordPress Footer
===================================================================
*/

function remove_footer_admin () {
    echo '&copy; 2016 - iSpy NYC';
}
add_filter('admin_footer_text', 'remove_footer_admin');

/*
===================================================================
           Remove WordPress Version From The Admin Footer
===================================================================
*/

function remove_wordpress_version() {
    remove_filter( 'update_footer', 'core_update_footer' );
}
add_action( 'admin_menu', 'remove_wordpress_version' );

/*
===================================================================
           Hide Help tab
===================================================================
*/

function hide_help() {
    echo '<style type="text/css">
            #contextual-help-link-wrap { display: none !important; }
    </style>';
}
add_action('admin_head', 'hide_help');

/*
===================================================================
            Disable Updates
===================================================================
*/

add_filter('pre_site_transient_update_core',create_function('$a', "return null;"));
wp_clear_scheduled_hook('wp_version_check');

remove_action('load-update-core.php','wp_update_themes');
add_filter('pre_site_transient_update_themes',create_function('$a', "return null;"));
wp_clear_scheduled_hook('wp_update_themes');

remove_action( 'load-update-core.php', 'wp_update_plugins' );
add_filter( 'pre_site_transient_update_plugins', create_function( '$a', "return null;" ) );
wp_clear_scheduled_hook( 'wp_update_plugins' );

/*
 ===================================================================
             ACF oembed
 ===================================================================
*/

function get_video_thumbnail_uri( $video_uri ) {
    $thumbnail_uri = '';
    // determine the type of video and the video id
    $video = parse_video_uri( $video_uri );
    // get youtube thumbnail
    if ( $video['type'] == 'youtube' )
        $thumbnail_uri = 'http://img.youtube.com/vi/' . $video['id'] . '/mqdefault.jpg';
    // get vimeo thumbnail
    if( $video['type'] == 'vimeo' )
        $thumbnail_uri = get_vimeo_thumbnail_uri( $video['id'] );
    // get wistia thumbnail
    if( $video['type'] == 'wistia' )
        $thumbnail_uri = get_wistia_thumbnail_uri( $video_uri );
    // get default/placeholder thumbnail
    if( empty( $thumbnail_uri ) || is_wp_error( $thumbnail_uri ) )
        $thumbnail_uri = '';
    //return thumbnail uri
    return $thumbnail_uri;
}
// Parse the video uri/url to determine the video type/source and the video id
function parse_video_uri( $url ) {
    // Parse the url 
    $parse = parse_url( $url );
    // Set blank variables
    $video_type = '';
    $video_id = '';
    // Url is http://youtu.be/xxxx
    if ( $parse['host'] == 'youtu.be' ) {
        $video_type = 'youtube';
        $video_id = ltrim( $parse['path'],'/' );
    }
    // Url is http://www.youtube.com/watch?v=xxxx 
    // or http://www.youtube.com/watch?feature=player_embedded&v=xxx
    // or http://www.youtube.com/embed/xxxx
    if ( ( $parse['host'] == 'youtube.com' ) || ( $parse['host'] == 'www.youtube.com' ) ) {
        $video_type = 'youtube';
        parse_str( $parse['query'] );
        $video_id = $v;
        if ( !empty( $feature ) )
            $video_id = end( explode( 'v=', $parse['query'] ) );
        if ( strpos( $parse['path'], 'embed' ) == 1 )
            $video_id = end( explode( '/', $parse['path'] ) );
    }
    // Url is http://www.vimeo.com
    if ( ( $parse['host'] == 'vimeo.com' ) || ( $parse['host'] == 'www.vimeo.com' ) ) {
        $video_type = 'vimeo';
        $video_id = ltrim( $parse['path'],'/' );
    }
    $host_names = explode(".", $parse['host'] );
    $rebuild = ( ! empty( $host_names[1] ) ? $host_names[1] : '') . '.' . ( ! empty($host_names[2] ) ? $host_names[2] : '');
    // Url is an oembed url wistia.com
    if ( ( $rebuild == 'wistia.com' ) || ( $rebuild == 'wi.st.com' ) ) {
        $video_type = 'wistia';
        if ( strpos( $parse['path'], 'medias' ) == 1 )
            $video_id = end( explode( '/', $parse['path'] ) );
    }
    // If recognised type return video array
    if ( !empty( $video_type ) ) {
        $video_array = array(
            'type' => $video_type,
            'id' => $video_id
        );
        return $video_array;
    } else {
        return false;
    }

}
//Takes a Vimeo video/clip ID and calls the Vimeo API v2 to get the large thumbnail URL.
function get_vimeo_thumbnail_uri( $clip_id ) {
    $vimeo_api_uri = 'http://vimeo.com/api/v2/video/' . $clip_id . '.php';
    $vimeo_response = wp_remote_get( $vimeo_api_uri );
    if( is_wp_error( $vimeo_response ) ) {
        return $vimeo_response;
    } else {
        $vimeo_response = unserialize( $vimeo_response['body'] );
        return $vimeo_response[0]['thumbnail_large'];
    }
}
//Takes a wistia oembed url and gets the video thumbnail url.
function get_wistia_thumbnail_uri( $video_uri ) {
    if ( empty($video_uri) )
        return false;
    $wistia_api_uri = 'http://fast.wistia.com/oembed?url=' . $video_uri;
    $wistia_response = wp_remote_get( $wistia_api_uri );
    if( is_wp_error( $wistia_response ) ) {
        return $wistia_response;
    } else {
        $wistia_response = json_decode( $wistia_response['body'], true );
        return $wistia_response['thumbnail_url'];
    }
}

/*
 ===================================================================
             Remove Sub-menu page
 ===================================================================
*/

function remove_admin_submenu_items() {
    remove_submenu_page( 'index.php', 'update-core.php' );
}

add_action( 'admin_menu', 'remove_admin_submenu_items');

/*
 ===================================================================
             Hide other users' posts in admin panel
 ===================================================================
*/

function posts_for_current_author($query) {
    global $pagenow;

    if( 'edit.php' != $pagenow || !$query->is_admin )
        return $query;

    if( !current_user_can( 'edit_others_posts' ) ) {
        global $user_ID;
        $query->set('author', $user_ID );
    }
    return $query;
}
add_filter('pre_get_posts', 'posts_for_current_author');

/*
 ===================================================================
             ACF Plugin New post from frontend
 ===================================================================
*/

function my_pre_save_post( $post_id ) {

    // Check that post is new
    if( $post_id != 'new' ) {
        return $post_id;
    }

    // Create new post
    $post = array(
        'post_type'         => 'post', // Your post type ( post, page, custom post type )
        'post_status'       => 'publish', // (publish, draft, private, etc.)
        'post_title'        => wp_strip_all_tags($_POST['acf']['field_583d3417ecba4']), // Заголовок ACF field key
        'post_theme'        => $_POST['acf']['field_583d3461ecba5'],
        'post_location'     => $_POST['acf']['field_592d283cc8ad1'],
        'post_images'       => $_POST['acf']['field_581b8d93e5c86'],
        'post_oembed'       => $_POST['acf']['field_582b2adcce961'],
        'post_video'        => $_POST['acf']['field_58203b225b1b4'],
        'post_audio'        => $_POST['acf']['field_583d35db35801'],
        'post_content'      => $_POST['acf']['field_583d368531a46'],
        'post_email'        => $_POST['acf']['field_583d64b6fb06b'],
        'post_terms_of_use' => $_POST['acf']['field_583d36e0a791b'],
        'post_captcha'      => $_POST['acf']['field_583d390b1cbb6'],
    );

    // insert the post
    $post_id = wp_insert_post( $post );

    // update $_POST['return']
    $_POST['return'] = add_query_arg( array('post_id' => $post_id), $_POST['return'] );

    return $post_id;

}
add_filter('acf/pre_save_post' , 'my_pre_save_post', 10, 1 );

/*
 ===================================================================
             Login redirect if not administrator
 ===================================================================
*/

add_filter("login_redirect", "sp_login_redirect", 10, 3);

function sp_login_redirect($redirect_to, $request, $user){
    if(is_array($user->roles))
        if(in_array('administrator', $user->roles))
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
    if (!(current_user_can('administrator'))) {
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
               Simple ajax comment form mod
   ===================================================================
*/
/**
 * Adding processing message at comment form
 * Use inline style so we don't need to load more file
 */
function simple_ajax_comment_form_mod( $settings ){
    printf( '<div class="submitting-comment" style="padding: 15px 20px; text-align: center; display: none;">%s</div>', __( 'Submitting comment...' ) );
}
add_action( 'comment_form', 'simple_ajax_comment_form_mod' );



/*
   ===================================================================
               Disable comment js
   ===================================================================
*/

function disable_comment_js(){
    wp_deregister_script( 'comment-reply' );
}
add_action('init','disable_comment_js');

/*
   ===================================================================
               Password strength
   ===================================================================
*/

function wc_ninja_remove_password_strength() {
    if ( wp_script_is( 'wc-password-strength-meter', 'enqueued' ) ) {
        wp_dequeue_script( 'wc-password-strength-meter' );
    }
}
add_action( 'wp_print_scripts', 'wc_ninja_remove_password_strength', 100 );

/*
   ===================================================================
               Comment form
   ===================================================================
*/

function ispynyc_comment( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment;
    switch ( $comment->comment_type ) :
        case '' :
            ?>
            <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
            <div id="comment-<?php comment_ID(); ?>">
                <div class="comment-author vcard">
                    <?php printf( __( '%s <span class="says">says:</span>', 'ispynyc' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
                </div><!-- .comment-author .vcard -->
                <?php if ( $comment->comment_approved == '0' ) : ?>
                    <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'ispynyc' ); ?></em>
                    <br />
                <?php endif; ?>

                <div class="comment-meta commentmetadata"><a>
                        <?php
                        /* translators: 1: date, 2: time */
                        printf( __( '%1$s at %2$s', 'ispynyc' ), get_comment_date(),  get_comment_time() ); ?></a>
                    <?php edit_comment_link( __( '(Edit)', 'ispynyc' ), ' ' );
                    ?>
                </div><!-- .comment-meta .commentmetadata -->

                <div class="comment-body"><?php comment_text(); ?></div>

                <div class="reply">
                    <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
                </div><!-- .reply -->
            </div><!-- #comment-##  -->

            <?php
            break;
        case 'pingback'  :
        case 'trackback' :
            ?>
            <li class="post pingback">
            <p><?php _e( 'Pingback:', 'ispynyc' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'ispynyc' ), ' ' ); ?></p>
            <?php
            break;
    endswitch;
}

/*
   ===================================================================
               Reorder comment fields
   ===================================================================
*/

add_filter('comment_form_fields', 'kama_reorder_comment_fields' );
function kama_reorder_comment_fields( $fields ){
    // die(print_r( $fields )); // посмотрим какие поля есть

    $new_fields = array(); // сюда соберем поля в новом порядке

    $myorder = array('author','email','comment'); // нужный порядок

    foreach( $myorder as $key ){
        $new_fields[ $key ] = $fields[ $key ];
        unset( $fields[ $key ] );
    }

    // если остались еще какие-то поля добавим их в конец
    if( $fields )
        foreach( $fields as $key => $val )
            $new_fields[ $key ] = $val;

    return $new_fields;
}

/////////////////////////////////////////////////////////////////////////////

function change_name($name) {
    return 'ispynyc.org';
}

add_filter('wp_mail_from_name','change_name');

function change_email($email) {
    return 'admin@ispynyc.org';
}

add_filter('wp_mail_from','change_email');



?>