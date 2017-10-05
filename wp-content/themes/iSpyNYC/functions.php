<?php

/*
===================================================================
          Require
===================================================================
*/

/*
 * User profile frontend                                        -   ON
 *

require_once('users/user_admin.php');
**/
/*
 * Ispy POPUP with Ajax                                          -   ON
 *
 **/
require_once('inc/ajax.php');

/*
 * ACF oembed                               -   ON
 * ACF Plugin New post from frontend        -   ON
 *
 **/
require_once('inc/functions-acf.php');

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
require_once('inc/functions-admin.php');

/*
 * Simple ajax comment form mod        -   ON
 * Disable comment js                  -   ON
 * Comment form                        -   ON
 * Reorder comment fields              -   ON
 *
 **/
require_once('inc/functions-comments.php');

/*
 * Login redirect if not administrator                  -   ON
 * Users redirect to main page                          -   ON
 * Limit/Restrict media library for users               -   ON
 * Delete original size of image                        -   ON
 * Delete thumbnail image                               -   ON
 *
 **/
require_once('inc/functions-limit.php');

/*
 * Remove link replytocom                                               -   ON
 * Remove link replytocom                                               -   ON
 * Removing WordPress Version from pages, RSS, scripts and styles       -   ON
 * Remove Admin bar                                                     -   ON
 * Remove WordPress Meta Generator                                      -   ON
 * REMOVE WP EMOJI                                                      -   ON
 *
 **/
require_once('inc/functions-remove.php');

/*
 * Register Scripts and Css        -   ON
 *
 **/
require_once('inc/functions-styles-scripts.php');

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

?>