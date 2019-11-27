<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 * Parse the bracket name from input to to put in the email body or subject.
 */
class TCF_Mail_ParseMailInput {

  /**
	 * instance of this class
	 *
	 * @since 3.12
	 * @access protected
	 * @var	null
	 * */
	protected static $instance = null;

    /**
     * use for magic setters and getter
     * we can use this when we instantiate the class
     * it holds the variable from __set
     *
     * @see function __get, function __set
     * @access protected
     * @var array
     * */
    protected $vars = array();

    /**
	 * Return an instance of this class.
	 *
	 * @since     1.0.0
	 *
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {

		/*
		 * @TODO :
		 *
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
   * Constructor.
   */
  public function __construct() {
  }

  /**
  * Extract the bracket from string, this is from the mail settings.
  * @param string $string from the database where the bracket are.
  * @param array $arr_val this is use to replace, this is from POST form input in the form.
  **/
  public function extractBracket($string, $arr_val)
  {
    $data = [];

    preg_match_all('~\[(.+?)\]~', $string, $matches);

    if(isset($matches[1])){
      foreach($matches[1] as $k => $v){
        $search_arr[]   = '['.$v.']';
        $replace_arr[]  = $arr_val[$v]['value'];
      }
      $data = [
        'search' => $search_arr,
        'replace' => $replace_arr,
      ];
    }
    return $data;
  }

  /**
  * Uses str_replace function.
  * @param array $arr_search is to search array for replace.
  * @param array $arr_replace is to replace array for replace.
  * @param string $string string for replace.
  **/
  public function replace($arr_search, $arr_replace, $string)
  {
    return str_replace($arr_search, $arr_replace, $string);
  }

} // class TCF_ContactForm_Mail_ParseMailInput
