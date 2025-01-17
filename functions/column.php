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
  $columns['data'] = __( 'Data', $text_domain );
  $columns['date'] = __( 'Date', $text_domain );

  return $columns;
}

// Add the data to the custom columns for the post type:
add_action( 'manage_tcf-contact-form_posts_custom_column' , 'custom_tcf_column', 10, 2 );
function custom_tcf_column( $column, $post_id ) {
    switch ( $column ) {
        case 'shortcode' :
          echo '[tcf_contact_form id="'.$post_id.'"]';
        break;
				case 'data':
					$store_db = TCF_ContactForm_MetaBox_PostMeta::get_instance()->mail_data([
						'action' => 'r',
						'post_id' => $post_id
					]);
					echo '<a href="admin.php?page=tcf-data&_method=get-data&post_id='.$post_id.'">';
						echo count($store_db) . ' Stored Data';
					echo '</a>';
				break;
        case 'date' :
        break;
    }
}
