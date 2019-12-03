<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 * Controller for the settings page.
 * @since 0.0.1
 * */
class TCF_Data_Controller extends TCF_Base {
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

	/**
	* Index / Dashboard of the data page.
	**/
  public function tcf_data()
  {
    $data = [];
		tcf_redirect_to('admin.php?page=tcf-settings');
  }

	public function get_data()
	{
		$data = [];
		$post_id = 0;
		$store_db = false;
		if(isset($_GET['post_id'])){
			$post_id = $_GET['post_id'];
			$store_db = tcf_get_complete_meta($post_id, 'tcf_mail_data');
		}
		$data['store_db'] = $store_db;
		TCF_View::get_instance()->admin_partials('data/index.php', $data);
	}

	public function delete_data()
	{
		$meta_id = null;
		$post_id = null;
		if(isset($_GET['meta_id']) && isset($_GET['post_id'])){
			$meta_id = $_GET['meta_id'];
			$post_id = $_GET['post_id'];
			delete_metadata_by_mid( 'post', $meta_id);
			tcf_redirect_to('admin.php?page=tcf-data&_method=get-data&post_id='.$post_id);
		}
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

}//TCF_Data_Controller
