<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://elivate.net
 * @since      1.0.0
 *
 * @package    Afc_Repeater_Elementor
 * @subpackage Afc_Repeater_Elementor/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Afc_Repeater_Elementor
 * @subpackage Afc_Repeater_Elementor/includes
 * @author     Alex Trusler <alex.t@elivate.net>
 */
class Afc_Repeater_Elementor_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'afc-repeater-elementor',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
