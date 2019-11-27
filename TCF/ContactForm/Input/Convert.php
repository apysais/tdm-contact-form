<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
* Convert the parse string into input.
**/
class TCF_ContactForm_Input_Convert
{
  /**
	 * instance of this class
	 *
	 * @since 0.0.1
	 * @access protected
	 * @var	null
	 * */
	protected static $instance = null;

	/**
	 * Return an instance of this class.
	 *
	 * @since     0.0.1
	 *
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {

		/*
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

  public function convert($args){

    $type = $args['type'];
    $class_input = 'TCF_ContactForm_Input_' . ucwords($type);
    if (class_exists($class_input)){
      $obj = new $class_input;
      return $obj->get($args);
    }
  }

}//TCF_ContactForm_Input_Convert
