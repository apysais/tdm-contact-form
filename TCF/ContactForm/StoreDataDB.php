<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 * Store the data from user input.
 */
class TCF_ContactForm_StoreDataDB {

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
	* Store the data in database.
	* @param array $args {
	*		Array of arguments.
	*		@type array $post_data The data from input post form.
	*		@type int $post_id Post Id of the contact form, post type.
	* }
	**/
  public function store($args = [])
  {
    $post = null;
    if(isset($args['post_data'])){
      $post = $args['post_data'];
    }
    $post_id = null;
    if(isset($args['post_id'])){
      $post_id = $args['post_id'];
    }
    if(
      !is_null($post)
      && !is_null($post_id)
    ){
      unset($post['action']);
      unset($post['token']);
      $mail_data_args = [
        'post_id' => $post_id,
        'action'  => 'c',
        'value'   => $post
      ];
      TCF_ContactForm_MetaBox_PostMeta::get_instance()->mail_data($mail_data_args);
    }
  }

} // class TCF_ContactForm_StoreDataDB
