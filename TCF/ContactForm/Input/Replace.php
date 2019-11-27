<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
* Use to replace input from string.
**/
class TCF_ContactForm_Input_Replace
{
  /**
	 * instance of this class
	 *
	 * @since 0.0.1
	 * @access protected
	 * @var	null
	 * */
	protected static $instance = null;

  private $string_input_arr;

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

  public function replace($arr) {
    $search_arr = [];
    $replace_arr = [];
    foreach($arr as $k => $v){
      $search_arr[] = $v['fields_str'];
      $replace_arr[] = $v['convert_field'];
    }
    return $replace = [
      'search' => $search_arr,
      'replace' => $replace_arr,
    ];
  }
}//TCF_ContactForm_Input_Replace
