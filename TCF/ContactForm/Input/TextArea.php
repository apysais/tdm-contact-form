<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
* Convert parse string to Input TextArea.
**/
class TCF_ContactForm_Input_Textarea
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

  public function get($args = [])
  {
    $type = $args['type'];

    $str_name = $args['name'];

    $is_require = '';
    if(isset($args['is_require']) && $args['is_require']){
      $is_require = 'require';
    }

    $input = htmlentities('<textarea name="tcf_input['.$str_name.'][value][]" id="'.$args['id'].'" class="'.$args['class'].'" '.$is_require.'></textarea>');
    if($args['is_require']){
      $input .= htmlentities('<input type="hidden" name="tcf_input['.$str_name.'][require]" value="1">');
    }
    if($args['is_email']){
      $input .= htmlentities('<input type="hidden" name="tcf_input['.$str_name.'][is_email]" value="1">');
    }

		$label = $str_name;

    if(isset($args['label']) && $args['label'] != ''){
      $input .= htmlentities('<input type="hidden" name="tcf_input['.$str_name.'][label]" value="'.$args['label'].'">');
    }else{
			$input .= htmlentities('<input type="hidden" name="tcf_input['.$str_name.'][label]" value="'.$label.'">');
		}
    return $input;
  }
}//TCF_ContactForm_Input_TextArea
