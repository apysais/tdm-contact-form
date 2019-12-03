<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
* Submit the data.
**/
class TCF_ContactForm_Submit {
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

	public function __construct(){}

	/**
	* Initialize the submit form.
	* We get the event when user submit the form.
	**/
  public function init()
  {
		//tcf_dd($_POST);exit();
    if(isset($_POST['tcf-form-submit']) && $_POST['tcf-form-submit']){
      $post_id = 0;
      if(isset($_POST['tcf-form-post-id'])){
        $post_id = $_POST['tcf-form-post-id'];
      }
      if (
        ! isset( $_POST['tcf_submit_nonce_field'] )
        || ! wp_verify_nonce( $_POST['tcf_submit_nonce_field'], 'tcf_submit_form_action_' . $post_id )
      ) {
         //error nonce not verified
				 TCF_ContactForm_Notification::get_instance()->setNotify([
					 'Something is Wrong with the submission of contact form.'
				 ]);
      } else {
        //check for filled honey pot
        $honey_pot = false;
        if(isset($_POST['_your-name']) && trim($_POST['_your-name']) != '' ){
          $honey_pot = true;
        }
        if(isset($_POST['_your-email']) && trim($_POST['_your-email']) != '' ){
          $honey_pot = true;
        }

        $action_captcha = '';
        if(isset($_POST['action'])){
          $action_captcha = $_POST['action'];
        }

        $token_captcha = '';
        if(isset($_POST['token'])){
          $token_captcha = $_POST['token'];
        }

        $validate = new TCF_ContactForm_Validate;
				$validate_args = $validate->parseInput($_POST);
				if($validate_args){
					$validate->validate($validate_args);
				}
        $return_notify = $validate->getWPError();
        if($return_notify){
          $error_notify = $return_notify;
          TCF_ContactForm_Notification::get_instance()->setNotify([
						'type' 	=> 'error',
						'msg' 	=> $error_notify
					]);
        }else{
          //pass it first to recaptcha
          //$captchaObj = new TCF_ReCaptcha_V3;
          //$check = $captchaObj->check($token_captcha, $action_captcha);
          $check = true;
          if($check){
              //send email;
							if($post_id != 0){
								TCF_Mail_Send::get_instance()->send([
									'post_id' => $post_id,
									'form_user_submitted' => [
										'post_data'	=> $validate_args,
										'post_id' 	=> $post_id
									],
								]);

								TCF_ContactForm_Notification::get_instance()->setNotify([
									'type' 	=> 'info',
									'msg' => ['Thank you for enquiring.']
								]);
							}
          }else{
						TCF_ContactForm_Notification::get_instance()->setNotify([
							'type' 	=> 'error',
							'msg' => ['Captcha Error.']
						]);
					}
        }

      }
    }

  }

}//TCF_ContactForm_Submit
