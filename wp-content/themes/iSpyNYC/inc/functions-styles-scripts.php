<?php

/*
 * Register Scripts and Css        -   ON
 *
 **/

/*
===================================================================
          Register Scripts and Css
===================================================================
*/

function ispynyc_scripts()
{
    // jquery
    wp_enqueue_script('jquery');

    // style
    wp_enqueue_style('style', get_template_directory_uri() . '/style.min.css');
    wp_enqueue_style('font-awesome', get_template_directory_uri() . '/font-awesome/css/font-awesome.min.css');
    wp_enqueue_style('alslider-style', get_template_directory_uri() . '/alslider/css/jquery.alslider.min.css');

    // scripts
    wp_enqueue_script('bg', get_template_directory_uri() . '/js/bg.min.js', array( 'jquery' ), null, true);
    wp_enqueue_script('script', get_template_directory_uri() . '/js/script.min.js', array( 'jquery' ), null, true);
    wp_enqueue_script('comment', get_template_directory_uri() . '/js/comment.min.js', array( 'jquery' ), null, true);
    wp_enqueue_script('comment-reply', get_template_directory_uri() . '/js/comment-reply.min.js', array( 'jquery' ), null, true);
    wp_enqueue_script('content', get_template_directory_uri() . '/js/content.min.js', array( 'jquery' ), null, true);
    wp_enqueue_script('toggle-menu', get_template_directory_uri() . '/js/toggle-menu.min.js', array( 'jquery' ), null, true);
    wp_enqueue_script('date', get_template_directory_uri() . '/js/date.min.js', array( 'jquery' ), null, true);

    wp_enqueue_script('html5lightbox', get_template_directory_uri() . '/html5lightbox/html5lightbox.js', array( 'jquery' ), null, true);
    wp_enqueue_script('alslider', get_template_directory_uri() . '/alslider/jquery.alslider.min.js', array( 'jquery' ), null, true);
}

add_action('wp_enqueue_scripts', 'ispynyc_scripts');