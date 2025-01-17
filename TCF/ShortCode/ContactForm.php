<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
* Contact Form Shortcode.
**/
class TCF_Shortcode_ContactForm {
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
		//add the shortcode to WP.
		add_shortcode( 'tcf_contact_form', [$this, 'init'] );
	}

	/**
	* This is the callback of the add_shortcode.
	**/
	public function init($atts)
	{
		$a = shortcode_atts( array(
      'id' => 0
		), $atts );

		$data = [];
		$post_id = $a['id'];

    $data['contact_post_id'] = $post_id;
		$form_input = tcf_get_form_inputs($post_id);
		$data['form_inputs'] = tcf_get_contact_form_inputs($form_input);

		ob_start();
		TCF_View::get_instance()->public_partials('shortcode/contact-form.php', $data);
		return ob_get_clean();
	}

}//TCF_Shortcode_ContactForm
