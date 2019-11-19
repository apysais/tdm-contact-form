<?php
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Add the custom columns to the post type:
add_filter( 'manage_tcf-contact-form_posts_columns', 'set_custom_edit_tcf_columns' );
function set_custom_edit_tcf_columns($columns) {
  $text_domain = tcf_get_text_domain();
  unset($columns['date']);
  $columns['shortcode'] = __( 'Shortcode', $text_domain );
  $columns['date'] = __( 'Date', $text_domain );

  return $columns;
}

// Add the data to the custom columns for the post type:
add_action( 'manage_tcf-contact-form_posts_custom_column' , 'custom_tcf_column', 10, 2 );
function custom_tcf_column( $column, $post_id ) {
    switch ( $column ) {
        case 'shortcode' :
          echo 'Shortcode';
        break;
        case 'date' :
        break;
    }
}
