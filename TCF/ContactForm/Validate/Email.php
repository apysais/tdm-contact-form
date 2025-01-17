<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
* Validate an input if its email.
**/
class TCF_ContactForm_Validate_Email {
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
	* Check if its email format.
	* @param bool $is_email check if the input need to validate the email.
	* @param email | string $email the email address.
	* @return boolean
	**/
  public function is_email($is_email, $email){
    if($is_email && !is_email( $email )){
        return false;
    }

    return true;
  }

	/**
	* validate the email address.
	* @param array $args {
	*		Array of arguments.
	*		@type string | int $value Input value.
	*		@type bool $is_email Set the input to boolean, if is email or not.
	*		@type string $msg The return message if any of the test is false
	* }
	* @return array
	**/
  public function validate($args = [])
  {
    $ret_array = [
      'msg' => '',
    ];

    $is_email = '';
    if(isset($args['is_email'])){
      $is_email = $args['is_email'];
    }

    $val = '';
    if(isset($args['value'])){
      $val = $args['value'];
    }

    $is_email = $this->is_email($is_email, $val);

    if(!$is_email){
      $ret_array = [
        'msg'     => 'Email is not valid.',
      ];
    }
    return $ret_array;
  }

}//TCF_ContactForm_Validate_Email
