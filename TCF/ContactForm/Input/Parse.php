<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
* parse the input fields from string.
**/
class TCF_ContactForm_Input_Parse
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

  public function get($arr_inputs) {
    $data = [];
    $inputObj = new TCF_ContactForm_Input_Input;
    $convertObj = new TCF_ContactForm_Input_Convert;
    if(is_array($arr_inputs)){
      foreach($arr_inputs as $k => $v){
        $white_space_v = ' '.$v.' ';
        $check_valid_input = $inputObj->getInputType($white_space_v);
        if($check_valid_input){
          $str = '['.$v.']';
          $white_space_v = ' '.$v.' ';
          $data[] = [
            'input' => $check_valid_input,
            'is_require' => $inputObj->checkIfRequired($white_space_v),
            'is_email' => $inputObj->checkIfEmail($white_space_v),
            'label' => $inputObj->getLabel($white_space_v),
            'name' => $inputObj->getName($white_space_v),
            'class' => $inputObj->getClass($white_space_v),
            'id' => $inputObj->getInputId($white_space_v),
            'fields_str' => $str,
            'convert_field' => $convertObj->convert([
              'type' => $check_valid_input,
              'is_require' => $inputObj->checkIfRequired($white_space_v),
              'is_email' => $inputObj->checkIfEmail($white_space_v),
              'label' => $inputObj->getLabel($white_space_v),
              'name' => $inputObj->getName($white_space_v),
              'class' => $inputObj->getClass($white_space_v),
              'id' => $inputObj->getInputId($white_space_v),
            ])
          ];
        }
      }//foreach loop
    }//if

    return $data;
  }

}//TCF_ContactForm_Input_Parse
