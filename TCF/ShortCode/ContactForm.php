<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
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
		add_shortcode( 'tcf_contact_form', [$this, 'init'] );
	}

	public function init($atts)
	{
		$a = shortcode_atts( array(
      'id' => 0
		), $atts );

		$data = [];

    $data['contact_post_id'] = $a['id'];

		ob_start();
		TCF_View::get_instance()->public_partials('shortcode/contact-form.php', $data);
		return ob_get_clean();
	}

}//TCF_Shortcode_ShortCode
