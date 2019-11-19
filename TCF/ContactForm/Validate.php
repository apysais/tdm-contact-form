<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
class TCF_ContactForm_Validate {
  /**
	 * instance of this class
	 *
	 * @since 0.0.1
	 * @access protected
	 * @var	null
	 * */
	protected static $instance = null;

  public $wp_error;

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


  /**
  * Get the label
  * @param $label string
  * @param $alt string alternative
  **/
  public function get_label($label, $alt = '')
  {
    if($label != ''){
      return $label;
    }else{
      return $alt;
    }
  }

  public function setWPError()
  {
    $this->wp_error = new WP_Error;
  }

  public function getWPError()
  {
    if ( is_wp_error( $this->wp_error ) ) {
      return $this->wp_error->get_error_messages();
    }
    return false;
  }

  public function validate($forms = [])
  {
    $this->setWPError();

    $validate_required = new TCF_ContactForm_Validate_Require;
    $validate_email = new TCF_ContactForm_Validate_Email;

    if($forms){
      foreach($forms as $k => $v){
        $label = isset($v['label']) ? $v['label'] : $k;
        $value = $v['value'];
        $require = $v['require'];
        $is_email = isset($v['is_email']) ? $v['is_email'] : 0;

        if($require){
          $get_require = $validate_required->validate([
            'require' => $require,
            'value'   => $value,
          ]);
          if(isset($get_require['msg']) && $get_require['msg'] != ''){
            $this->wp_error->add($label, $label.', '.$get_require['msg']);
          }
        }
        if($is_email){
          $get_email = $validate_email->validate([
            'is_email' => $is_email,
            'value'    => $value,
          ]);
          if(isset($get_email['msg']) && $get_email['msg'] != ''){
            $this->wp_error->add($label, $label.', '.$get_email['msg']);
          }
        }
      }
    }
  }

}//TCF_ContactForm_Validate
