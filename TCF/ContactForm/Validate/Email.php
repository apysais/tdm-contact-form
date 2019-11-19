<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
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

	public function __construct()
	{

	}

  public function is_email($is_email, $email){
    if($is_email && !is_email( $email )){
        return false;
    }

    return true;
  }

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
