<?php
/*
Plugin Name: Location
Description: Declares a plugin that will create a custom post type.
Version: 1.0
Author: Aleksandr Gryshko
License: GPLv2
*/

add_action( 'add_meta_boxes', 'location_add_meta_box' );
add_action( 'save_post', 'location_save_data' );

/* CONTACT META BOXES */
function location_add_meta_box() {
	add_meta_box( 'location', 'Location', 'location_callback', 'post', 'side' );
}
function location_callback( $post ) {
	wp_nonce_field( 'location_save_data', 'location_meta_box_nonce' );
	
	$value = get_post_meta( $post->ID, '_location_value_key', true );
	
	echo '<label for="location_field">Write a location: </lable>';
	echo '<input type="text" id="location_field" name="location_field" value="' . esc_attr( $value ) . '" width="80%" />';
}
function location_save_data( $post_id ) {
	
	if( ! isset( $_POST['location_meta_box_nonce'] ) ){
		return;
	}
	
	if( ! wp_verify_nonce( $_POST['location_meta_box_nonce'], 'location_save_data') ) {
		return;
	}
	
	if( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ){
		return;
	}
	
	if( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	
	if( ! isset( $_POST['location_field'] ) ) {
		return;
	}
	
	$my_data = sanitize_text_field( $_POST['location_field'] );
	
	update_post_meta( $post_id, '_location_value_key', $my_data );
	
}