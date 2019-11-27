<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
* Get the contact form meta.
**/
class TCF_ContactForm_MetaBox_GetMeta {
  /**
	 * instance of this class
	 *
	 * @since 0.0.1
	 * @access protected
	 * @var	null
	 * */
	protected static $instance = null;

  public $wp_error;

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
	* Get the meta data of post.
	* @param int $post_id the post id.
	* @see TCF_ContactForm_MetaBox_PostMeta class.
	* @return array
	**/
  public function get($post_id)
  {
    $data = [];
    $data['to'] = TCF_ContactForm_MetaBox_PostMeta::get_instance()->mail_to([
      'post_id' => $post_id,
      'action' => 'r',
      'single' => 1,
    ]);

		$data['from'] = TCF_ContactForm_MetaBox_PostMeta::get_instance()->mail_from([
      'post_id' => $post_id,
      'action' => 'r',
      'single' => 1,
    ]);

		$data['subject'] = TCF_ContactForm_MetaBox_PostMeta::get_instance()->mail_subject([
      'post_id' => $post_id,
      'action' => 'r',
      'single' => 1,
    ]);

		$data['additional_headers'] = TCF_ContactForm_MetaBox_PostMeta::get_instance()->mail_additional_headers([
      'post_id' => $post_id,
      'action' => 'r',
      'single' => 1,
    ]);
		if($data['additional_headers']){
			$data['additional_headers'] = tcf_split_by_newline($data['additional_headers']);
		}

    $data['message_body'] = TCF_ContactForm_MetaBox_PostMeta::get_instance()->mail_message_body([
      'post_id' => $post_id,
      'action' => 'r',
      'single' => 1,
    ]);

		$data['form_inputs'] = tcf_get_form_inputs($post_id);

    return $data;
  }

}//TCF_ContactForm_MetaBox_GetMeta
