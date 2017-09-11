<?php
//extra user info in wp-admin
add_action( 'show_user_profile', 'yoursite_extra_user_profile_fields' );
add_action( 'edit_user_profile', 'yoursite_extra_user_profile_fields' );
function yoursite_extra_user_profile_fields( $user ) {
?>
<h3><?php _e("Extra profile information", "blank"); ?></h3>
<table class="form-table">
    <tr>
        <th><label for="company"><?php _e("Company"); ?></label></th>
        <td>
            <input type="text" name="company" id="company" class="regular-text"
                   value="<?php echo esc_attr( get_the_author_meta( 'company', $user->ID ) ); ?>" /><br />
        </td>
    </tr>
    <tr>
        <th><label for="job"><?php _e("Job"); ?></label></th>
        <td>
            <input type="text" name="job" id="job" class="regular-text"
                   value="<?php echo esc_attr( get_the_author_meta( 'job', $user->ID ) ); ?>" /><br />
        </td>
    </tr>
    <tr>
        <th><label for="country"><?php _e("Country"); ?></label></th>
        <td>
            <input type="text" name="country" id="country" class="regular-text"
                   value="<?php echo esc_attr( get_the_author_meta( 'country', $user->ID ) ); ?>" /><br />
        </td>
    </tr>
    <tr>
        <th><label for="city"><?php _e("City"); ?></label></th>
        <td>
            <input type="text" name="city" id="city" class="regular-text"
                   value="<?php echo esc_attr( get_the_author_meta( 'city', $user->ID ) ); ?>" /><br />
        </td>
    </tr>
    <tr>
        <th><label for="phone"><?php _e("Phone"); ?></label></th>
        <td>
            <input type="text" name="phone" id="phone" class="regular-text"
                   value="<?php echo esc_attr( get_the_author_meta( 'phone', $user->ID ) ); ?>" /><br />
        </td>
    </tr>

</table>
<?php
}

//Save our extra registration user meta.
add_action('user_register', 'myplugin_user_register');
function myplugin_user_register ($user_id) {
    if ( isset( $_POST['phone'] ) )
        update_user_meta($user_id, 'phone', $_POST['phone']);

    if ( isset( $_POST['company'] ) )
        update_user_meta($user_id, 'company', $_POST['company']);

    if ( isset( $_POST['job'] ) )
        update_user_meta($user_id, 'job', $_POST['job']);

    if ( isset( $_POST['country'] ) )
        update_user_meta($user_id, 'country', $_POST['country']);

    if ( isset( $_POST['city'] ) )
        update_user_meta($user_id, 'city', $_POST['city']);

    if ( isset( $_POST['user_interest'] ) )
        update_user_meta($user_id, 'user_interest', $_POST['user_interest']);

}