<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
class TCF_ContactForm_Notification {
  /**
	 * instance of this class
	 *
	 * @since 0.0.1
	 * @access protected
	 * @var	null
	 * */
	protected static $instance = null;

  private $error_notify = false;
  private $notify = false;

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

  public function setNotify($notify)
  {
    $this->notify = $notify;
  }

  public function getNotify()
  {
    return $this->notify;
  }

  public function getNotifyError()
  {
    $notify = $this->getNotify();
    if($notify['type'] == 'error'){
			$data['notify'] = $notify['msg'];
			TCF_View::get_instance()->public_partials('notify/error.php', $data);
    }
  }

  public function getNotifyInfo()
  {
    $notify = $this->getNotify();
    if($notify['type'] == 'info'){
			$data['notify'] = $notify['msg'];
			TCF_View::get_instance()->public_partials('notify/info.php', $data);
    }
  }

}//TCF_ContactForm_Notification
