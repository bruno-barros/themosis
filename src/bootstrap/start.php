<?php
/*----------------------------------------------------*/
// Paths
/*----------------------------------------------------*/
define('APP_PATH', dirname(__DIR__));

$root_path = str_replace('\src', '', APP_PATH);

$webroot_path = $root_path;


/*----------------------------------------------------*/
// Include composer autoloading
/*----------------------------------------------------*/
if (file_exists($autoload = $root_path.DS.'vendor'.DS.'autoload.php'))
{
	require_once($autoload);
}



/*----------------------------------------------------*/
// Set environment
/*----------------------------------------------------*/
// Define path and the environment locations.
$env = new Framework\Config\Environment($root_path.DS);

/*----------------------------------------------------*/
// Load .env file
/*----------------------------------------------------*/
$location = $env->which();

if (empty($location)) printf('<h1>%s</h1>', 'Unable to define the environment. Make sure to define your hostname.');

$loaded = $env->load($location);

if (empty($loaded)) printf('<h1>%s</h1>', 'Unable to locate your environment file.');

/*----------------------------------------------------*/
// Check required vars.
/*----------------------------------------------------*/
$check = $env->check(array('DB_NAME', 'DB_USER', 'DB_PASSWORD', 'DB_HOST', 'INSTALLATION_FOLDER'), $loaded);

/*----------------------------------------------------*/
// Populate environment vars
/*----------------------------------------------------*/
if ($check)
{
	$env->populate($loaded);
}
else
{
	printf('<h2>%s</h2>', 'Missing environment variables.');
}

/*----------------------------------------------------*/
// Load environment config constants
/*----------------------------------------------------*/
if (file_exists($config = $root_path.DS.'src/config'.DS.'environments'.DS.$location.'.php'))
{
	require_once($config);
}

/*----------------------------------------------------*/
// Content directory
/*----------------------------------------------------*/
define('CONTENT_DIR', 'src');
define('WP_CONTENT_DIR', $webroot_path.DS.CONTENT_DIR);
define('WP_CONTENT_URL', WP_HOME.'/'.CONTENT_DIR);

/*----------------------------------------------------*/
// Include shared configuration
/*----------------------------------------------------*/
if (file_exists($shared = $root_path.DS.'src/config'.DS.'shared.php'))
{
	require_once($shared);
}

/*----------------------------------------------------*/
// Path to WordPress
/*----------------------------------------------------*/
if (!defined('ABSPATH'))
{
	define('ABSPATH', $webroot_path.DS.'cms'.DS);
}


