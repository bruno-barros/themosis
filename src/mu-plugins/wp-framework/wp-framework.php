<?php namespace WpFramework;

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * Dashboard. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://example.com
 * @since             1.0.0
 * @package           framework
 *
 * @wordpress-plugin
 * Plugin Name: wp-framework
 * Plugin URI: http://brunobarros.com/
 * Description: A framework for WordPress developers.
 * Version: 1.0.0
 * Author: Bruno Barros
 * Author URI: http://www.brunobarros.com/
 * License: GPLv2
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wp-framework
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
use WpFramework\Includes\WpFramework;
use WpFramework\Includes\WpFrameworkActivator;
use WpFramework\Includes\WpFrameworkDeactivator;

if (!defined('WPINC'))
{
	die;
}
/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wp-framework-activator.php
 */
function activate_plugin_name()
{
	WpFrameworkActivator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wp-framework-deactivator.php
 */
function deactivate_plugin_name()
{
	WpFrameworkDeactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_plugin_name');
register_deactivation_hook(__FILE__, 'deactivate_plugin_name');



/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 */
function run_wp_framework()
{
	/**
	 * The core plugin class that is used to define internationalization,
	 * dashboard-specific hooks, and public-facing site hooks.
	 */
	$plugin = new WpFramework();
	$plugin->run();

}

run_wp_framework();
