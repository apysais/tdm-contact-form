<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
* Validate an input is required.
**/
class TCF_ContactForm_Validate_Require {
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

	public function __construct(){}

	/**
	* Check if input is required, must not be blank.
	* @param bool $require check if the input need to validate whether required or not.
	* @param int | string $val the value.
	* @return boolean
	**/
  public function is_required($require, $val){
    if($require && empty($val)){
      return false;
    }
    return true;
  }

	/**
	* validate the input if required.
	* will check if the input is blank or no.
	* value must not be blank.
	* @param array $args {
	*		Array of arguments.
	*		@type string | int $value Input value.
	*		@type bool $require Set the input to boolean, if its required or not.
	*		@type string $msg The return message if any of the test is false
	* }
	* @return array
	**/
  public function validate($args = [])
  {

		$ret_array = [
      'msg' => '',
    ];

    $require = false;
    if(isset($args['require'])){
      $require = $args['require'];
    }

    $val = '';
    if(isset($args['value'])){
      $val = $args['value'];
    }

    $require = $this->is_required($require, $val);

    if(!$require){
      $ret_array = [
        'msg' => 'Required form is missing',
      ];
    }
    return $ret_array;
  }

}//TCF_ContactForm_Validate_Require
