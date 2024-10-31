<?php
define( 'SEO_IMAGES_VERSION', '1.2.2' );
/**
 * Plugin Name: Seo Quick Images
 * Plugin URI: https://wpseoplugins.org/seo-quick-images/
 * Author: WP SEO Plugins
 * Description: SEO Images is a powerful plugin that helps you add images in your wordpress posts, based on titles. Enhance your content with a lot of images!
 * Version: 1.2.2
 */

# Exit if accessed directly
if (!defined('ABSPATH')) {
	exit;
}

# Absolute path to the plugin directory.
# eg - /var/www/html/wp-content/plugins/st-import-media/
if (!defined('SEO_IMAGES_PATH_ABS')) {
	define('SEO_IMAGES_PATH_ABS', plugin_dir_path(__FILE__));
}

if (!defined('SEO_IMAGES_PATH_SRC')) {
	define('SEO_IMAGES_PATH_SRC', plugin_dir_url(__FILE__));
}

if( !defined( 'WP_SEO_PLUGINS_BACKEND_URL' ) ) {
    define( 'WP_SEO_PLUGINS_BACKEND_URL', 'https://api.wpseoplugins.org/');
}
define( 'SEO_IMAGES_SERVER_NAME', sanitize_text_field( $_SERVER['SERVER_NAME']) );
define( 'SEO_IMAGES_SERVER_PORT', sanitize_text_field( $_SERVER['SERVER_PORT']) );
define( 'SEO_IMAGES_SERVER_REQUEST_URI', sanitize_text_field( $_SERVER['REQUEST_URI']) );
define( 'SEO_IMAGES_PLUGIN_FOLDER', dirname(__FILE__) );
define( 'SEO_IMAGES_CORE_FOLDER', SEO_IMAGES_PLUGIN_FOLDER.'/seo-images');

# Load necessary assets & files
require_once SEO_IMAGES_PATH_ABS . 'loader.php';

require_once SEO_IMAGES_PATH_ABS . 'lib/draw-db-tables.php';
require_once SEO_IMAGES_PATH_ABS . 'wp_seo_plugins.php';

register_activation_hook(__FILE__, array('PluginActivationSEO_IMAGES', 'setupDataOptionSEO_IMAGES'));
