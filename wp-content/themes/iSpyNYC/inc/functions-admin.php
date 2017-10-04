<?php

/*
 * Custom login logo                                            -   ON
 * Change Admin head color                                      -   ON 
 * Remove WordPress widgets                                     -   ON
 * Remove WordPress Logo from the WordPress Admin Bar           -   ON
 * Add Icons Instead of Text to the Main Admin Bar              -   ON
 * Custom menu css                                              -   ON
 * Change Login Logo                                            -   ON
 * Remove wpcf7                                                 -   ON
 * Remove Pages if not Administrator                            -   ON  
 * Remove Post Metaboxes                                        -   ON
 * Change logotype link to site (not to wordpress.org)          -   ON
 * Remove title in logotype "сайт работает на wordpress"        -   ON
 * Remove welcome panel                                         -   ON
 * Custom WordPress Footer                                      -   ON
 * Remove WordPress Version From The Admin Footer               -   ON
 * Hide Help tab                                                -   ON
 * Disable Updates                                              -   ON
 * Remove Sub-menu page                                         -   ON
 * Hide other users' posts in admin panel                       -   ON
 * Password strength                                            -   ON
 * Mail                                                         -   ON
 * Replace welcome admintext                                    -   ON
 *
 **/

/*
===================================================================
           Custom login logo
===================================================================
*/

function custom_login_logo() {
    // Scripts
    wp_enqueue_script('bg', get_template_directory_uri() . '/js/admin-bg.js', false, null, true);
}
add_action( 'login_enqueue_scripts', 'custom_login_logo' );

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
          Remove wpcf7
===================================================================
*/

if ((current_user_can('editor'))) {
    function remove_wpcf7() {
        remove_menu_page( 'wpcf7' );
        remove_menu_page( 'edit.php?post_type=page' );    //Страницы
        remove_menu_page( 'tools.php' );                  //Инструменты
    }

    add_action('admin_menu', 'remove_wpcf7');
}

/*
===================================================================
           Remove Pages if not Administrator
===================================================================
*/

if (!(current_user_can('administrator')) && !(current_user_can('editor'))) {
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
           Remove Post Metaboxes
===================================================================
*/

function remove_my_post_metaboxes() {
    remove_meta_box( 'authordiv','post','normal' ); // Автор
    remove_meta_box( 'postcustom','post','normal' ); // Произвольные поля
    remove_meta_box( 'postexcerpt','post','normal' ); // Цитата
    remove_meta_box( 'revisionsdiv','post','normal' ); // Редакции
    remove_meta_box( 'slugdiv','post','normal' ); // Ярлык
    remove_meta_box( 'trackbacksdiv','post','normal' ); // Обратные ссылки
    remove_meta_box( 'formatdiv','post','normal' );
    remove_meta_box( 'tagsdiv-post_tag','post','normal' );
    remove_meta_box( 'postimagediv','post','normal' );
}
add_action('admin_menu','remove_my_post_metaboxes');

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
               Mail
   ===================================================================
*/

function change_name($name) {
    return 'ispynyc.org';
}

add_filter('wp_mail_from_name','change_name');

function change_email($email) {
    return 'admin@ispynyc.org';
}

add_filter('wp_mail_from','change_email');

/*
   ===================================================================
               Replace welcome admintext
   ===================================================================
*/

function replace_admintext( $wp_admin_bar ) {
    $my_account=$wp_admin_bar->get_node('my-account');
    $newtitle = str_replace( 'Howdy', 'Hello', $my_account->title );
    $wp_admin_bar->add_node( array(
        'id' => 'my-account',
        'title' => $newtitle,
    ) );
}
add_filter( 'admin_bar_menu', 'replace_admintext',25 );