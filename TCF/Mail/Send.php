<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
* Send Mail.
**/
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

	/**
	* Constructor.
	**/
	public function __construct(){}

	/**
	* Send the contact form.
	* @param array $args {
	*		Array of arguments.
	*		@type int $post_id The post id of the contact form post type.
	*		@type array $form_user_submitted the input values of the user input in the contact form.
	* }
	* @return mail object.
	**/
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

				$headers = [];

				$from = $get_meta_mail['from'] ? $get_meta_mail['from'] : false;
				if($from){
					$headers[] = 'From: ' . $from;
				}

				$additional_headers = $get_meta_mail['additional_headers'] ? $get_meta_mail['additional_headers'] : false;
				if($additional_headers){
					$headers = array_merge($headers, $additional_headers);
				}

				$subject = tcf_search_replace_subject($get_meta_mail['subject'], $args['form_user_submitted']['post_data']);
				$body_message = tcf_search_replace_message($body, $args['form_user_submitted']['post_data']);

				$this->mail([
					'to' 			=> $get_meta_mail['to'],
					'subject' => $subject,
					'body' 		=> wpautop($body_message),
					'headers' => $headers
				]);

			}
		}
	}

	/**
	* Mail it.
	* @param array $args {
	*		Array of arguments.
	*		@type string $to Mail To.
	*		@type string $subject Mail subject.
	*		@type string $body Mail body message.
	*		@type array  $headers Extra headers.
	*		@type array | string  $attachments Files to attach.
	* }
	* @see https://developer.wordpress.org/reference/functions/wp_mail/
	* @return mail object.
	**/
	public function mail($args = [])
	{
		TCF_Mail_WPMail::get_instance()->mail($args);
	}

}//TCF_Mail_Send
