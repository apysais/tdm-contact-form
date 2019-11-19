<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 * Controller for the settings page.
 * @since 0.0.1
 * */
class TCF_Settings_Controller extends TCF_Base {
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

  public function tcf_settings()
  {
    $data = [];
		$data['recaptcha'] = TCF_ReCaptcha_DBMethod::get_instance()->get();
		TCF_View::get_instance()->admin_partials('settings/index.php', $data);
  }

	public function update_settings()
	{
		TCF_ReCaptcha_DBMethod::get_instance()->update($_POST);
		tcf_redirect_to('admin.php?page=tcf-settings');
	}

	/**
	 * Controller
	 *
	 * @param	$action		string | empty
	 * @parem	$arg		array
	 * 						optional, pass data for controller
	 * @return mix
	 * */
	public function controller($action = '', $arg = array()){
		$this->call_method($this, $action);
	}

	public function __construct(){}

}//TCF_Settings_Controller
