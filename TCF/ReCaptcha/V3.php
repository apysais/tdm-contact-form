<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
class TCF_ReCaptcha_V3 {
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

  public function init()
  {
    add_action('wp_enqueue_scripts', [$this, 'enqueueScript'] );
  }

  public function enqueueScript()
  {
    wp_enqueue_script( 'google-recaptcha-v3', 'https://www.google.com/recaptcha/api.js?render='.tcf_get_recaptcha_site_key().'', array( 'jquery' ), 3 );
    wp_enqueue_script( 'google-recaptcha-v3-init', tcf_get_plugin_dir_url() . 'public/js/google-recaptcha-v3-init.js', array( 'jquery' ), 1, false );
    $localize_arr = [
      'google_recaptcha_v3_site_key' => tcf_get_recaptcha_site_key()
    ];
    wp_localize_script( 'google-recaptcha-v3', 'tcf', $localize_arr );
  }

  /**
  * This is to check recaptcha.
  **/
  public function check($token, $action)
  {
    // call curl to POST request
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,"https://www.google.com/recaptcha/api/siteverify");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('secret' => tcf_get_recaptcha_secret_key(), 'response' => $token)));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    $arrResponse = json_decode($response, true);

    // verify the response
    if($arrResponse["success"] == '1' && $arrResponse["action"] == $action && $arrResponse["score"] >= tcf_get_recaptcha_score()) {
        return true;
    }
    return false;
  }

}//TCF_ReCaptcha_V3
