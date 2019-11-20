<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 * OPtions for recaptcha.
 */
class TCF_ReCaptcha_Options {

  /**
	 * instance of this class
	 *
	 * @since 3.12
	 * @access protected
	 * @var	null
	 * */
	protected static $instance = null;

    /**
     * use for magic setters and getter
     * we can use this when we instantiate the class
     * it holds the variable from __set
     *
     * @see function __get, function __set
     * @access protected
     * @var array
     * */
    protected $vars = array();

    /**
	 * Return an instance of this class.
	 *
	 * @since     1.0.0
	 *
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {

		/*
		 * @TODO :
		 *
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
     */
    public function __construct() {}

    /**
    * Site Key
    * @param array $args {
    *		Array of arguments.
    *		@type string $action CRUD action, default is read.
    *			accepted values: r (read), u (update), d (delete)
    *		@type string $prefix the prefix meta key.
		*		@type mix | optional $default_value Default value to return if the option does not exist.
    * }
    * @return  $action, r = get_option(), u = update_option(), d = delete_option
    **/
    public function site_key($args = []) {
      $prefix = 'tcf_recaptcha_v3_site_key';
      $defaults = array(
        'action'          => 'r',
        'value'           => '',
        'default_value'   => '',
        'prefix'          => $prefix
      );
      $args = wp_parse_args( $args, $defaults );
      switch($args['action']){
        case 'd':
          delete_option($args['prefix']);
        break;
        case 'u':
          update_option($args['prefix'], $args['value']);
        break;
        case 'r':
          return get_option($args['prefix'], $args['default_value']);
        break;
      }
    }

    /**
    * Secret Key.
    * @param array $args {
    *		Array of arguments.
    *		@type string $action CRUD action, default is read.
    *			accepted values: r (read), u (update), d (delete)
    *		@type string $prefix the prefix meta key.
    *		@type mix | optional $default_value Default value to return if the option does not exist.
    * }
    * @return  $action, r = get_option(), u = update_option(), d = delete_option
    **/
    public function secret_key($args = []) {
      $prefix = 'tcf_recaptcha_v3_secret_key';
      $defaults = array(
        'action'          => 'r',
        'value'           => '',
        'default_value'   => '',
        'prefix'          => $prefix
      );
      $args = wp_parse_args( $args, $defaults );
      switch($args['action']){
        case 'd':
          delete_option($args['prefix']);
        break;
        case 'u':
          update_option($args['prefix'], $args['value']);
        break;
        case 'r':
          return get_option($args['prefix'], $args['default_value']);
        break;
      }
    }

    /**
    * score.
    * @param array $args {
    *		Array of arguments.
    *		@type string $action CRUD action, default is read.
    *			accepted values: r (read), u (update), d (delete)
    *		@type string $prefix the prefix meta key.
		*		@type mix | optional $default_value Default value to return if the option does not exist.
    * }
    * @return  $action, r = get_option(), u = update_option(), d = delete_option
    **/
    public function score($args = []) {
      $prefix = 'tcf_recaptcha_v3_score';
      $defaults = array(
        'action'          => 'r',
        'value'           => '',
        'default_value'   => '',
        'prefix'          => $prefix
      );
      $args = wp_parse_args( $args, $defaults );
      switch($args['action']){
        case 'd':
          delete_option($args['prefix']);
        break;
        case 'u':
          update_option($args['prefix'], $args['value']);
        break;
        case 'r':
          return get_option($args['prefix'], $args['default_value']);
        break;
      }
    }


} // class TCF_ReCaptcha_Options
