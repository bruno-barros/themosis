<?php namespace Framework\Plugins\AppIntegration;

	/**
	 * The plugin bootstrap file
	 *
	 * This file is read by WordPress to generate the plugin information in the plugin
	 * Dashboard. This file also includes all of the dependencies used by the plugin,
	 * registers the activation and deactivation functions, and defines a function
	 * that starts the plugin.
	 *
	 *
	 * @wordpress-plugin
	 * Plugin Name: AppIntegration
	 * Plugin URI: http://brunobarros.com/
	 * Description: A framework for WordPress developers.
	 * Version: 1.0.0
	 * Author: Bruno Barros
	 * Author URI: http://www.brunobarros.com/
	 * License: GPLv2
	 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
	 * Text Domain:       app-integration
	 * Domain Path:       /languages
	 */

// If this file is called directly, abort.
use Framework\Plugins\AppIntegration\Includes\AppIntegration;
use Framework\Plugins\AppIntegration\Includes\AppIntegrationActivator;
use Framework\Plugins\AppIntegration\Includes\AppIntegrationDeactivator;

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
	AppIntegrationActivator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wp-framework-deactivator.php
 */
function deactivate_plugin_name()
{
	AppIntegrationDeactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_plugin_name');
register_deactivation_hook(__FILE__, 'deactivate_plugin_name');


/**
 * Helper function to retrieve the path.
 *
 * @param string
 * @return string
 */
if (!function_exists('app_integration_path'))
{
	function app_integration_path($name)
	{
		return $GLOBALS['app_integration_path'][$name];
	}
}


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
	$plugin = new AppIntegration();
	$plugin->run();

}

run_wp_framework();
