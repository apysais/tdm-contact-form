<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 * Post Meta Mail Settings.
 */
class TCF_ContactForm_MetaBox_PostMeta {

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

  /**
   * Constructor.
   */
  public function __construct() {
  }

  /**
  * Mail To.
  * @param array $args {
  *		Array of arguments.
  *		@type int $post_id the article id, required.
  *		@type bool $single this will return string if true else array if false. default is false.
  *		@type string $action CRUD action, default is read.
  *			accepted values: r (read), u (update), d (delete)
  *		@type string $prefix the prefix meta key.
  * }
  * @return  $action, r = get_post_meta(), u = update_post_meta(), d = delete_post_meta
  **/
  public function mail_to($args = []){
    $prefix = 'tcf_mail_to';
    if(isset($args['post_id'])) {
      $defaults = array(
        'single'  => false,
        'action'  => 'r',
        'value'   => '',
        'prefix'  => $prefix
      );
      $args = wp_parse_args( $args, $defaults );
      switch($args['action']){
        case 'd':
          delete_post_meta($args['post_id'], $args['prefix'], $args['value']);
        break;
        case 'u':
          update_post_meta($args['post_id'], $args['prefix'], $args['value']);
        break;
        case 'r':
          return get_post_meta($args['post_id'], $args['prefix'], $args['single']);
        break;
      }
    }
  }

  /**
  * Email From.
  * @param array $args {
  *		Array of arguments.
  *		@type int $post_id the article id, required.
  *		@type bool $single this will return string if true else array if false. default is false.
  *		@type string $action CRUD action, default is read.
  *			accepted values: r (read), u (update), d (delete)
  *		@type string $prefix the prefix meta key.
  * }
  * @return  $action, r = get_post_meta(), u = update_post_meta(), d = delete_post_meta
  **/
  public function mail_from($args = []){
    $prefix = 'tcf_mail_from';
    if(isset($args['post_id'])) {
      $defaults = array(
        'single'  => false,
        'action'  => 'r',
        'value'   => '',
        'prefix'  => $prefix
      );
      $args = wp_parse_args( $args, $defaults );
      switch($args['action']){
        case 'd':
          delete_post_meta($args['post_id'], $args['prefix'], $args['value']);
        break;
        case 'u':
          update_post_meta($args['post_id'], $args['prefix'], $args['value']);
        break;
        case 'r':
          return get_post_meta($args['post_id'], $args['prefix'], $args['single']);
        break;
      }
    }
  }

  /**
  * Mail Subject.
  * @param array $args {
  *		Array of arguments.
  *		@type int $post_id the article id, required.
  *		@type bool $single this will return string if true else array if false. default is false.
  *		@type string $action CRUD action, default is read.
  *			accepted values: r (read), u (update), d (delete)
  *		@type string $prefix the prefix meta key.
  * }
  * @return  $action, r = get_post_meta(), u = update_post_meta(), d = delete_post_meta
  **/
  public function mail_subject($args = []){
    $prefix = 'tcf_mail_subject';
    if(isset($args['post_id'])) {
      $defaults = array(
        'single'  => false,
        'action'  => 'r',
        'value'   => '',
        'prefix'  => $prefix
      );
      $args = wp_parse_args( $args, $defaults );
      switch($args['action']){
        case 'd':
          delete_post_meta($args['post_id'], $args['prefix'], $args['value']);
        break;
        case 'u':
          update_post_meta($args['post_id'], $args['prefix'], $args['value']);
        break;
        case 'r':
          return get_post_meta($args['post_id'], $args['prefix'], $args['single']);
        break;
      }
    }
  }

  /**
  * Mail Additional Headers.
  * @param array $args {
  *		Array of arguments.
  *		@type int $post_id the article id, required.
  *		@type bool $single this will return string if true else array if false. default is false.
  *		@type string $action CRUD action, default is read.
  *			accepted values: r (read), u (update), d (delete)
  *		@type string $prefix the prefix meta key.
  * }
  * @return  $action, r = get_post_meta(), u = update_post_meta(), d = delete_post_meta
  **/
  public function mail_additional_headers($args = []){
    $prefix = 'tcf_additional_headers';
    if(isset($args['post_id'])) {
      $defaults = array(
        'single'  => false,
        'action'  => 'r',
        'value'   => '',
        'prefix'  => $prefix
      );
      $args = wp_parse_args( $args, $defaults );
      switch($args['action']){
        case 'd':
          delete_post_meta($args['post_id'], $args['prefix'], $args['value']);
        break;
        case 'u':
          update_post_meta($args['post_id'], $args['prefix'], $args['value']);
        break;
        case 'r':
          return get_post_meta($args['post_id'], $args['prefix'], $args['single']);
        break;
      }
    }
  }


  /**
  * Mail Message Body.
  * @param array $args {
  *		Array of arguments.
  *		@type int $post_id the article id, required.
  *		@type bool $single this will return string if true else array if false. default is false.
  *		@type string $action CRUD action, default is read.
  *			accepted values: r (read), u (update), d (delete)
  *		@type string $prefix the prefix meta key.
  * }
  * @return  $action, r = get_post_meta(), u = update_post_meta(), d = delete_post_meta
  **/
  public function mail_message_body($args = []){
    $prefix = 'tcf_message_body';
    if(isset($args['post_id'])) {
      $defaults = array(
        'single'  => false,
        'action'  => 'r',
        'value'   => '',
        'prefix'  => $prefix
      );
      $args = wp_parse_args( $args, $defaults );
      switch($args['action']){
        case 'd':
          delete_post_meta($args['post_id'], $args['prefix'], $args['value']);
        break;
        case 'u':
          update_post_meta($args['post_id'], $args['prefix'], $args['value']);
        break;
        case 'r':
          return get_post_meta($args['post_id'], $args['prefix'], $args['single']);
        break;
      }
    }
  }


  /**
  * Mail Data save to database.
  * @param array $args {
  *		Array of arguments.
  *		@type int $post_id the article id, required.
  *		@type bool $single this will return string if true else array if false. default is false.
  *		@type string $action CRUD action, default is read.
  *			accepted values: r (read), u (update), d (delete)
  *		@type string $prefix the prefix meta key.
  * }
  * @return  $action, r = get_post_meta(), u = update_post_meta(), d = delete_post_meta
  **/
  public function mail_data($args = []){
    $prefix = 'tcf_mail_data';
    if(isset($args['post_id'])) {
      $defaults = array(
        'single'  => false,
        'action'  => 'r',
        'value'   => '',
        'prefix'  => $prefix
      );
      $args = wp_parse_args( $args, $defaults );
      switch($args['action']){
        case 'd':
          delete_post_meta($args['post_id'], $args['prefix'], $args['value']);
        break;
        case 'u':
          update_post_meta($args['post_id'], $args['prefix'], $args['value']);
        break;
        case 'c':
          add_post_meta($args['post_id'], $args['prefix'], $args['value']);
        break;
        case 'r':
          return get_post_meta($args['post_id'], $args['prefix'], $args['single']);
        break;
      }
    }
  }

  /**
  * Input Forms.
  * @param array $args {
  *		Array of arguments.
  *		@type int $post_id the article id, required.
  *		@type bool $single this will return string if true else array if false. default is false.
  *		@type string $action CRUD action, default is read.
  *			accepted values: r (read), u (update), d (delete)
  *		@type string $prefix the prefix meta key.
  * }
  * @return  $action, r = get_post_meta(), u = update_post_meta(), d = delete_post_meta
  **/
  public function form_input($args = []){
    $prefix = 'tcf_form_input';
    if(isset($args['post_id'])) {
      $defaults = array(
        'single'  => false,
        'action'  => 'r',
        'value'   => '',
        'prefix'  => $prefix
      );
      $args = wp_parse_args( $args, $defaults );
      switch($args['action']){
        case 'd':
          delete_post_meta($args['post_id'], $args['prefix'], $args['value']);
        break;
        case 'u':
          update_post_meta($args['post_id'], $args['prefix'], $args['value']);
        break;
        case 'c':
          add_post_meta($args['post_id'], $args['prefix'], $args['value']);
        break;
        case 'r':
          return get_post_meta($args['post_id'], $args['prefix'], $args['single']);
        break;
      }
    }
  }

} // class TCF_ContactForm_MetaBox_PostMeta
