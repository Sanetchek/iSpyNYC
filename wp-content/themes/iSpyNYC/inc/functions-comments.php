<?php

/*
 * Simple ajax comment form mod        -   ON
 * Disable comment js                  -   ON
 * Comment form                        -   ON
 * Reorder comment fields              -   ON
 *
 **/

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