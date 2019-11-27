<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
* Validate the input form.
**/
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

	public function __construct(){}


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

	/**
	* Set the WP Error.
	**/
  public function setWPError()
  {
    $this->wp_error = new WP_Error;
  }

	/**
	* Get the Wp Error from wp_error variable.
	**/
  public function getWPError()
  {
    if ( is_wp_error( $this->wp_error ) ) {
      return $this->wp_error->get_error_messages();
    }
    return false;
  }

	/**
	* Parse Input form.
	**/
	public function parseInput($post_input_arr = [])
	{
		$data = false;
		if(isset($post_input_arr['tcf_input'])){
			foreach($post_input_arr['tcf_input'] as $k => $v){
				$v['value'] = $v['value'][0];
				$data[$k] = $v;
			}
		}
		return $data;
	}

	/**
	* Validate the input form base on the array arguments.
	* @param array $forms {
	*		Array of arguments.
	*		@type string $label Input label or name.
	*		@type string | int $value Input value.
	*		@type bool $require Set the input to boolean, if its required or not.
	*		@type bool $is_email Set the input to boolean, if is email or not.
	*		@type string $msg The return message if any of the test is false
	*			See folder TCF/Validate for the list of Validate object to use.
	* }
	**/
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
