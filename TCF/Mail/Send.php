<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
class TCF_Mail_Send {
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

	public function send($args = [])
	{
		$post_id = null;
		if(isset($args['post_id'])){
			$post_id = $args['post_id'];
		}

		$form_user_submitted = false;
		if(isset($args['form_user_submitted'])){
			$form_user_submitted = TCF_ContactForm_GetUserFillup::get_instance()->get($args['form_user_submitted']);
		}

		if(!is_null($post_id)){
			$post = get_post( $post_id );
			if($post){
				$get_meta_mail = TCF_ContactForm_MetaBox_GetMeta::get_instance()->get($post_id);
				TCF_ContactForm_StoreDataDB::get_instance()->store($form_user_submitted);

				$body = $get_meta_mail['message_body'];
				$body .= $form_user_submitted['post_data']['your-message'];

				$this->mail([
					'to' 			=> $get_meta_mail['to'],
					'subject' => $get_meta_mail['subject'],
					'body' 		=> $body,
				]);

			}
		}
	}

	public function mail($args = [])
	{
		TCF_Mail_WPMail::get_instance()->mail($args);
	}

}//TCF_Mail_Send
