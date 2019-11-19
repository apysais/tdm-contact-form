<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 * Contact Form Post type.
 */
class TCF_ContactForm_PostType {

  /**
	 * instance of this class
	 *
	 * @since 3.12
	 * @access protected
	 * @var	null
	 * */
	protected static $instance = null;

    /**
     * use for magic setters and getter
     * we can use this when we instantiate the class
     * it holds the variable from __set
     *
     * @see function __get, function __set
     * @access protected
     * @var array
     * */
    protected $vars = array();

    /**
	 * Return an instance of this class.
	 *
	 * @since     1.0.0
	 *
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {

		/*
		 * @TODO :
		 *
		 * - Uncomment following lines if the admin class should only be available for super admins
		 */
		/* if( ! is_super_admin() ) {
			return;
		} */

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	public function __construct() {

	}

  public function init()
  {
    $text_domain = tcf_get_text_domain();
    $labels = array(
        'name'                  => _x( 'Contact Form', 'Post type general name', $text_domain ),
        'singular_name'         => _x( 'Contact Form', 'Post type singular name', $text_domain ),
        'menu_name'             => _x( 'TDM Contact Form', 'Admin Menu text', $text_domain ),
        'name_admin_bar'        => _x( 'TDM Contact Form', 'Add New on Toolbar', $text_domain ),
        'add_new'               => __( 'Add New', $text_domain ),
        'add_new_item'          => __( 'Add New Contact Form', $text_domain ),
        'new_item'              => __( 'New Contact Form', $text_domain ),
        'edit_item'             => __( 'Edit Contact Form', $text_domain ),
        'view_item'             => __( 'View Contact Form', $text_domain ),
        'all_items'             => __( 'All Contact Forms', $text_domain ),
        'search_items'          => __( 'Search Contact Forms', $text_domain ),
        'parent_item_colon'     => __( 'Parent Contact Forms:', $text_domain ),
        'not_found'             => __( 'No Contact Form found.', $text_domain ),
        'not_found_in_trash'    => __( 'No Contact Form found in Trash.', $text_domain ),
        'featured_image'        => _x( 'Contact Form Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', $text_domain ),
        'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', $text_domain ),
        'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', $text_domain ),
        'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', $text_domain ),
        'archives'              => _x( 'Contact Form archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', $text_domain ),
        'insert_into_item'      => _x( 'Insert into Contact Form', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', $text_domain ),
        'uploaded_to_this_item' => _x( 'Uploaded to this Contact Form', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', $text_domain ),
        'filter_items_list'     => _x( 'Filter Contact Forms list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', $text_domain ),
        'items_list_navigation' => _x( 'Contact Forms list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', $text_domain ),
        'items_list'            => _x( 'Contact Forms list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', $text_domain ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => false,
        'publicly_queryable' => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'tcf-contact-form' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title' ),
    );

    register_post_type( TCF_POST_TYPE, $args );
  }

} // class TCF_ContactFormPostType
