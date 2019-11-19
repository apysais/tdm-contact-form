<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://thedigitalmarketers.com.au
 * @since             1.0.0
 * @package           Tdm_Contact_Form
 *
 * @wordpress-plugin
 * Plugin Name:       TDM Contact Form
 * Plugin URI:        https://thedigitalmarketers.com.au/
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            The Digital Marketers
 * Author URI:        https://thedigitalmarketers.com.au
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       tdm-contact-form
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'TDM_CONTACT_FORM_VERSION', '1.0.0' );
define('TCF_POST_TYPE', 'tcf-contact-form');
//move this to settings
define('TCF_RECAPTCHA_V3_SITE_KEY', '6LcJpMIUAAAAAMt9psfGdCOWrTg7ikf-9cGhmmdR');
define('TCF_RECAPTCHA_V3_SECRET_KEY', '6LcJpMIUAAAAAOhcRoG2m1xKrgVfe3Krup0V-0zD');
define('TCF_RECAPTCHA_V3_SCORE', '0.5');
//move this to settings
/**
 * For autoloading classes
 * */
spl_autoload_register('tcf_directory_autoload_class');
function tcf_directory_autoload_class($class_name){
		if ( false !== strpos( $class_name, 'TCF' ) ) {
	 $include_classes_dir = realpath( get_template_directory( __FILE__ ) ) . DIRECTORY_SEPARATOR;
	 $admin_classes_dir = realpath( plugin_dir_path( __FILE__ ) ) . DIRECTORY_SEPARATOR;
	 $class_file = str_replace( '_', DIRECTORY_SEPARATOR, $class_name ) . '.php';
	 if( file_exists($include_classes_dir . $class_file) ){
		 require_once $include_classes_dir . $class_file;
	 }
	 if( file_exists($admin_classes_dir . $class_file) ){
		 require_once $admin_classes_dir . $class_file;
	 }
 }
}
function tcf_get_plugin_details(){
 // Check if get_plugins() function exists. This is required on the front end of the
 // site, since it is in a file that is normally only loaded in the admin.
 if ( ! function_exists( 'get_plugins' ) ) {
	 require_once ABSPATH . 'wp-admin/includes/plugin.php';
 }
 $ret = get_plugins();
 return $ret['tdm-contact-form/tdm-contact-form.php'];
}
function tcf_get_text_domain(){
 $ret = tcf_get_plugin_details();
 return $ret['TextDomain'];
}
function tcf_get_plugin_dir(){
 return plugin_dir_path( __FILE__ );
}
function tcf_get_plugin_dir_url(){
 return plugin_dir_url( __FILE__ );
}
/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-tdm-contact-form-activator.php
 */
function activate_tdm_contact_form() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-tdm-contact-form-activator.php';
	Tdm_Contact_Form_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-tdm-contact-form-deactivator.php
 */
function deactivate_tdm_contact_form() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-tdm-contact-form-deactivator.php';
	Tdm_Contact_Form_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_tdm_contact_form' );
register_deactivation_hook( __FILE__, 'deactivate_tdm_contact_form' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-tdm-contact-form.php';

/**
* Include functions
**/
require plugin_dir_path( __FILE__ ) . 'functions/helper.php';
require plugin_dir_path( __FILE__ ) . 'functions/column.php';
require plugin_dir_path( __FILE__ ) . 'functions/settings.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_tdm_contact_form() {

	$plugin = new Tdm_Contact_Form();
	$plugin->run();

	TCF_ContactForm_MetaBox_Mail::get_instance();
	TCF_ReCaptcha_V3::get_instance()->init();
	TCF_Shortcode_ContactForm::get_instance();
	TCF_Settings_WP::get_instance()->addSubMenu();
}
//run_tdm_contact_form();
add_action('plugins_loaded', 'run_tdm_contact_form');

function tdm_init()
{
	TCF_ContactForm_PostType::get_instance()->init();
	TCF_ContactForm_Submit::get_instance()->init();
}
add_action( 'init', 'tdm_init' );
