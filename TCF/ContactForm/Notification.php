<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
* Nofication Class.
* Use to send generic notification for user UI.
**/
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

	public function __construct(){}

	/**
	* Set the notification
	* @param string @notify the notification message to send.
	**/
  public function setNotify($notify)
  {
    $this->notify = $notify;
  }

	/**
	* Get the notification.
	* @return $notify variable.
	**/
  public function getNotify()
  {
    return $this->notify;
  }

	/**
	* This is to get the notification error.
	* @return template
	**/
  public function getNotifyError()
  {
    $notify = $this->getNotify();
    if($notify['type'] == 'error'){
			$data['notify'] = $notify['msg'];
			TCF_View::get_instance()->public_partials('notify/error.php', $data);
    }
  }

	/**
	* This is to get the notification information.
	* @return template
	**/
  public function getNotifyInfo()
  {
    $notify = $this->getNotify();
    if($notify['type'] == 'info'){
			$data['notify'] = $notify['msg'];
			TCF_View::get_instance()->public_partials('notify/info.php', $data);
    }
  }

}//TCF_ContactForm_Notification
