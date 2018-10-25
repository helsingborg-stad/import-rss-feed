<?php

/**
 * Plugin Name:       Import RSS Feed
 * Plugin URI:        (#plugin_url#)
 * Description:       Import content from RSS feeds to any post type.
 * Version:           1.0.0
 * Author:            Nikolas Ramstedt
 * Author URI:        (#plugin_author_url#)
 * License:           MIT
 * License URI:       https://opensource.org/licenses/MIT
 * Text Domain:       import-rss-feed
 * Domain Path:       /languages
 */

 // Protect agains direct file access
if (! defined('WPINC')) {
    die;
}

define('IMPORTRSSFEED_PATH', plugin_dir_path(__FILE__));
define('IMPORTRSSFEED_URL', plugins_url('', __FILE__));
define('IMPORTRSSFEED_TEMPLATE_PATH', IMPORTRSSFEED_PATH . 'templates/');

load_plugin_textdomain('import-rss-feed', false, plugin_basename(dirname(__FILE__)) . '/languages');

require_once IMPORTRSSFEED_PATH . 'source/php/Vendor/Psr4ClassLoader.php';
require_once IMPORTRSSFEED_PATH . 'Public.php';

// Instantiate and register the autoloader
$loader = new ImportRssFeed\Vendor\Psr4ClassLoader();
$loader->addPrefix('ImportRssFeed', IMPORTRSSFEED_PATH);
$loader->addPrefix('ImportRssFeed', IMPORTRSSFEED_PATH . 'source/php/');
$loader->register();

// Start application
new ImportRssFeed\App();
