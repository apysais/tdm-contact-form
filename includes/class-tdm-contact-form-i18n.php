<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://thedigitalmarketers.com.au
 * @since      1.0.0
 *
 * @package    Tdm_Contact_Form
 * @subpackage Tdm_Contact_Form/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Tdm_Contact_Form
 * @subpackage Tdm_Contact_Form/includes
 * @author     The Digital Marketers <info@thedigitalmarketers.com.au>
 */
class Tdm_Contact_Form_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'tdm-contact-form',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
