<?php

namespace ImportRssFeed;

class App
{
    public function __construct()
    {
        new \ImportRssFeed\Taxonomy();
        new \ImportRssFeed\OptionsPage();

        add_action('import_rss_feeds', array($this, 'runImport'));
        add_action('acf/save_post', array($this, 'toggleCronImport'), 12, 0);
        add_action('wp_ajax_importRssFeed', array($this, 'rssImportAjaxHandler'));
        add_action('admin_enqueue_scripts', array($this, 'registerAssets'), 6);
        add_filter('post_type_link', array($this, 'replacePermalinksWithRssSource'), 10, 2);

        //Additional actions during import
        add_action('ImportRssFeed/ImportManager/start/afterUpdatePost', array($this, 'fetchSourceTerm'), 6, 2);
        add_action('ImportRssFeed/ImportManager/start/afterUpdatePost', array($this, 'fetchThumbnail'), 6, 2);
    }

    /**
     * runImport()
     *
     * Initiates a new import
     * @return object
     */
    public function runImport()
    {
        $import = new \ImportRssFeed\ImportManager();
        $import->start();

        return $import;
    }

    /**
     * rssImportAjaxHandler()
     *
     * Ajax method for initiating a rss import
     * @return object
     */
    public function rssImportAjaxHandler()
    {
        if (!defined('DOING_AJAX') || !DOING_AJAX) {
            return;
        }

        if (!wp_verify_nonce($_POST['nonce'], 'importRssFeed')) {
            die('Busted!');
        }

        $import = $this->runImport();

        echo json_encode(array(
            'feedsTotal' => count($import->rssFeeds),
            'foundPosts' => $import->foundPosts,
            'updatedPosts' => $import->updatedPosts,
            'createdPosts' => $import->createdPosts
        ));

        wp_die();
    }

    /**
     * toggleCronImport()
     *
     * Add or remove cron job, depending on settings.
     * @return void
     */
    public function toggleCronImport()
    {
        if (!\ImportRssFeed\OptionsPage::isOptionPage()) {
            return;
        }

        if (wp_next_scheduled('import_rss_feeds')) {
            wp_clear_scheduled_hook('import_rss_feeds');
        }

        if (!get_field('import_rss_feed_recurring_imports', 'options')) {
            return;
        }

        $frequency = get_field('import_rss_feed_recurring_imports_frequency', 'options');

        wp_schedule_event(time(), $frequency, 'import_rss_feeds');
    }

    /**
     * replacePermalinksWithRssSource($url, $post)
     *
     * Returns RSS source URL instead of the post's URL when using get_permalink()
     * @param string $url Permalink URL
     * @param object $post WP Post object
     * @return string
     */
    public function replacePermalinksWithRssSource($url, $post)
    {
        if (!is_admin()) {
            $url = get_post_meta($post->ID, 'rss_link', true) ? get_post_meta($post->ID, 'rss_link', true) : $url;
        }

        return $url;
    }

    /**
     * fetchThumbnail($post, $feed)
     *
     * Adds RSS (or OpenGraph) thumbnail as featured image
     * @param object $post RSS item converted to post object (\ImportRssFeed\Post)
     * @param object $feed Parent object of RSS items  (\ImportRssFeed\RssFeed)
     * @return void
     */
    public function fetchThumbnail(\ImportRssFeed\Post $post, \ImportRssFeed\RssFeed $feed)
    {
        //Make sure feed has enabled thumbnail import & post ID exists
        if (!$feed->rss_thumbnail || $post->ID == 0) {
            return;
        }

        if (!empty(get_post_thumbnail_id($post->ID))) {
            return;
        }

        //RSS Thumbnail
        $thumbnailSource = $post->simplePieItem()->get_enclosure()->get_thumbnail();

        //OpenGraph falback
        $thumbnailSource = (!$thumbnailSource) ? \ImportRssFeed\Helper\OpenGraph::fetch($post->simplePieItem()->get_permalink())->image : $thumbnailSource;

        if (!$thumbnailSource) {
            return;
        }

        $attachmentId = \ImportRssFeed\Helper\Attachment::insertFromUrl($thumbnailSource, $post->ID);

        if ($attachmentId) {
            set_post_thumbnail($post->ID, $attachmentId);
        }
    }

    /**
     * fetchSourceTerm($post, $feed)
     *
     * Adds RSS source as a term when importing post
     * @param object $post RSS item converted to post object (\ImportRssFeed\Post)
     * @param object $feed Parent object of RSS items  (\ImportRssFeed\RssFeed)
     * @return void
     */
    public function fetchSourceTerm(\ImportRssFeed\Post $post,\ImportRssFeed\RssFeed $feed)
    {
        $taxonomy = \ImportRssFeed\Taxonomy::$taxonomySlug;
        $postId = $post->getPostId();

        if (!get_the_terms($postId, $taxonomy) || get_the_terms($postId, $taxonomy)[0]->term_id != $feed->termId) {
            wp_set_post_terms($postId, [$feed->termId], $taxonomy);
        }
    }

    /**
     * registerAssets()
     *
     * Reigster plugin script & styles
     * @return void
     */
    public function registerAssets()
    {
        wp_register_style('import-rss-feed-css', IMPORTRSSFEED_URL . '/dist/' . \ImportRssFeed\Helper\CacheBust::name('css/import-rss-feed.css'));
        wp_register_script('import-rss-feed-js', IMPORTRSSFEED_URL . '/dist/' . \ImportRssFeed\Helper\CacheBust::name('js/import-rss-feed.js'), ['jquery'], false, true);
    }
}
