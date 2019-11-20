<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
* Mail using wp_mail function.
**/
class TCF_Mail_WPMail {
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
		$to = '';
		if(isset($args['to'])){
			$to = $args['to'];
		}

		$subject = '';
		if(isset($args['subject'])){
			$subject = $args['subject'];
		}

		$body = '';
		if(isset($args['body'])){
			$body = $args['body'];
		}

		$headers[] = 'Content-Type: text/html; charset=UTF-8';
		if(isset($args['headers'])){
			if(is_array($args['headers'])){
				foreach($args['headers'] as $k => $v){
					$headers[] = $v;
				}
			}
		}

		$attachments = [];
		if(isset($args['attachments'])){
			$attachments = $args['attachments'];
		}

		wp_mail( $to, $subject, $body, $headers, $attachments );
	}

}//TCF_Mail_WPMail
