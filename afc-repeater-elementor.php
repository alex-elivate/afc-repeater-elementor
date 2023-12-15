<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://elivate.net
 * @since             1.0.0
 * @package           Afc_Repeater_Elementor
 *
 * @wordpress-plugin
 * Plugin Name:       AFC Repeater for Elementor
 * Plugin URI:        https://elivate.net
 * Description:       Show AFC repeater fields in Elementor with shortcode.
 * Version:           1.0.0
 * Author:            Alex Trusler
 * Author URI:        https://elivate.net/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       afc-repeater-elementor
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
define( 'AFC_REPEATER_ELEMENTOR_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-afc-repeater-elementor-activator.php
 */
function activate_afc_repeater_elementor() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-afc-repeater-elementor-activator.php';
	Afc_Repeater_Elementor_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-afc-repeater-elementor-deactivator.php
 */
function deactivate_afc_repeater_elementor() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-afc-repeater-elementor-deactivator.php';
	Afc_Repeater_Elementor_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_afc_repeater_elementor' );
register_deactivation_hook( __FILE__, 'deactivate_afc_repeater_elementor' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-afc-repeater-elementor.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_afc_repeater_elementor() {

	$plugin = new Afc_Repeater_Elementor();
	$plugin->run();

}
run_afc_repeater_elementor();
