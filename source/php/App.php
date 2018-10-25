<?php

namespace ImportRssFeed;

class App
{
    public function __construct()
    {
        add_action('admin_enqueue_scripts', array($this, 'enqueueStyles'));
        add_action('admin_enqueue_scripts', array($this, 'enqueueScripts'));
    }

    /**
     * Enqueue required style
     * @return void
     */
    public function enqueueStyles()
    {
        wp_register_style('import-rss-feed-css', IMPORTRSSFEED_URL . '/dist/' . \ImportRssFeed\Helper\CacheBust::name('css/import-rss-feed.css'));
    }

    /**
     * Enqueue required scripts
     * @return void
     */
    public function enqueueScripts()
    {
        wp_register_script('import-rss-feed-js', IMPORTRSSFEED_URL . '/dist/' . \ImportRssFeed\Helper\CacheBust::name('js/import-rss-feed.js'));
    }
}
