<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
class TCF_ContactForm_Input_Input
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

  /**
  * Get the string input of the fields.
  * @param $string string the string input.
  **/
  public function setFieldInput($string)
  {
    preg_match_all('~\[(.+?)\]~', $string, $matches);
    $this->string_input_arr = $matches;
  }

  public function getFieldInput()
  {
    return $this->string_input_arr;
  }

  /**
  * Get and check the input types.
  * @param $str the string of form field input.
  **/
  public function getInputType($str)
  {
    $accepted_inputs = ['text', 'submit', 'textarea'];
    $type = false;

    preg_match('~input:(.*?)\s~', $str, $output);

    if(isset($output[1]) && $output[1] != '' ){
      $type = $output[1];
    }

    if($type && in_array($type, $accepted_inputs)){
      return $type;
    }

    return false;
  }

  /**
  * Will check the input if required.
  * @param string $string the string of input.
  * @return bool
  **/
  public function checkIfRequired($string)
  {
    $is_required = false;
    if(preg_match("~\brequire\b~", $string, $matches)){
      $is_required = true;
    }
    return $is_required;
  }

  /**
  * Check if the input is an email.
  * @param string $string the string with email input.
  * @return bool
  **/
  public function checkIfEmail($string)
  {
    $is_email = false;
    if(preg_match("~\bemail-format\b~", $string, $matches)){
      $is_email = true;
    }
    return $is_email;
  }

  /**
  * Get the class attribute of the input.
  * @param string $string the string with class attribute.
  * @return string
  **/
  public function getClass($string) {
    $class = false;
    preg_match_all("/class:'(.*?)'/", $string, $output);
    if(isset($output[1][0]) && $output[1][0] != '' ){
      $class = $output[1][0];
    }
    return $class;
  }

  /**
  * Get the input Id attribute.
  * @param string $string the string with id attribute.
  * @return string
  **/
  public function getInputId($string) {
    $id = false;
    preg_match('~id:(.*?)\s~', $string, $output);
    if(isset($output[1]) && $output[1] != '' ){
      $id = $output[1];
    }
    return $id;
  }

  /**
  * Get the name attribute.
  * @param string $string the string with name attribute.
  * @return string
  **/
  public function getName($string) {
    $name = false;
    preg_match('~name:(.*?)\s~', $string, $output);
    if(isset($output[1]) && $output[1] != '' ){
      $name = $output[1];
    }
    return $name;
  }

  /**
  * Get the name attribute of the input and pass it as Value.
  * @param string $string the string with label attribute.
  * @return string
  **/
  public function getLabel($string) {
    $label = false;
    preg_match_all("/label:'(.*?)'/", $string, $output);
    if(isset($output[1][0]) && $output[1][0] != '' ){
      $label = $output[1][0];
    }
    return $label;
  }


}//TCF_ContactForm_Input_Input
