<?php

/**
 * Plugin Name:       Import RSS Feed
 * Plugin URI:        https://github.com/helsingborg-stad/import-rss-feed
 * Description:       Probably the last Wordpress RSS importer. Import items from RSS feed to any post type.
 * Version:           1.0.0
 * Author:            Nikolas Ramstedt
 * Author URI:        https://github.com/helsingborg-stad
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

// Acf auto import and export
add_action('plugins_loaded', function () {
    $acfExportManager = new \AcfExportManager\AcfExportManager();
    $acfExportManager->setTextdomain('import-rss-feed');
    $acfExportManager->setExportFolder(IMPORTRSSFEED_PATH . 'acf-fields/');
    $acfExportManager->autoExport(array(
        'import-rss-feed-settings' => 'group_5bd2c7df04f83',
    ));
    $acfExportManager->import();
});

// Start application
new ImportRssFeed\App();

