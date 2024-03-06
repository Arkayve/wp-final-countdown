<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://aurelien.net
 * @since             1.0.0
 * @package           Final_Countdown
 *
 * @wordpress-plugin
 * Plugin Name:       Final Countdown
 * Plugin URI:        https://final-countdown.net
 * Description:       Make your own promotional headbands.
 * Version:           1.0.0
 * Author:            Aurélien
 * Author URI:        https://aurelien.net/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       final-countdown
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
define( 'FINAL_COUNTDOWN_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-final-countdown-activator.php
 */
function activate_final_countdown() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-final-countdown-activator.php';
	Final_Countdown_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-final-countdown-deactivator.php
 */
function deactivate_final_countdown() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-final-countdown-deactivator.php';
	Final_Countdown_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_final_countdown' );
register_deactivation_hook( __FILE__, 'deactivate_final_countdown' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-final-countdown.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_final_countdown() {

	$plugin = new Final_Countdown();
	$plugin->run();

}
run_final_countdown();
