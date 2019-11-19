<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
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

	public function __construct()
	{

	}

  public function is_required($require, $val){

    if($require && empty($val)){
      return false;
    }
    return true;
  }

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
