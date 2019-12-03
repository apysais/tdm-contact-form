<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
* Data Page of the Contact Form.
**/
class TCF_Data_WP{
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

		public $carbon;

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

  public function __construct(){

	}

	/**
	* Add submenu setting name.
	**/
  public function addSubMenu()
  {
    $text_domain = tcf_get_text_domain();
    add_submenu_page(
        null,
        __( 'Settings', $text_domain ),
        __( 'Settings', $text_domain ),
        'manage_options',
        'tcf-data',
        [TCF_Data_Controller::get_instance(), 'controller']
    );
  }

}//TCF_Data_WP
