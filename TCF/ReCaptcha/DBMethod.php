<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 * For Database purposes method.
 */
class TCF_ReCaptcha_DBMethod {

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
	* Update the settings page.
	* @param array $post the post input from the settings.
	**/
  public function update($post)
  {
    $options = new TCF_ReCaptcha_Options;

    if(isset($post['tcf_recaptcha_v3_site_key'])){
      $options->site_key([
        'action'  => 'u',
        'value'   => $post['tcf_recaptcha_v3_site_key']
      ]);
    }

    if(isset($post['tcf_recaptcha_v3_secret_key'])){
      $options->secret_key([
        'action'  => 'u',
        'value'   => $post['tcf_recaptcha_v3_secret_key']
      ]);
    }

    if(isset($post['tcf_recaptcha_v3_score'])){
      $options->score([
        'action'  => 'u',
        'value'   => $post['tcf_recaptcha_v3_score']
      ]);
    }
  }

	/**
	* get the data from option table.
	* @return array
	**/
  public function get()
  {
    $data = [];
    $options = new TCF_ReCaptcha_Options;

    $data['site_key'] = $options->site_key([
      'action'  => 'r',
    ]);

    $data['secret_key'] = $options->secret_key([
      'action'  => 'r'
    ]);

    $data['score'] = $options->score([
      'action'          => 'r',
      'default_value'   => '0.5'
    ]);

    return $data;
  }

} // class TCF_ReCaptcha_DBMethod
