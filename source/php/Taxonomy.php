<?php

namespace ImportRssFeed;

class Taxonomy
{
    public static $taxonomySlug = 'rss-source';

    public function __construct()
    {
        add_action('wp_loaded', array($this, 'registerTaxonomy'));
    }

    /**
     * registerTaxonomy()
     *
     * Registers "hidden" taxonomy on all post types that will be avalible for import
     * @return void
     */
    public function registerTaxonomy()
    {
        $labels = array(
            'name'              => _x('RSS Sources', 'taxonomy general name', 'import-rss-feed'),
            'singular_name'     => _x('RSS Source', 'taxonomy singular name', 'import-rss-feed'),
            'search_items'      => __('Search RSS Sources', 'import-rss-feed'),
            'all_items'         => __('All RSS Sources', 'import-rss-feed'),
            'parent_item'       => __('Parent RSS Source', 'import-rss-feed'),
            'parent_item_colon' => __('Parent RSS Source:', 'import-rss-feed'),
            'edit_item'         => __('Edit RSS Source', 'import-rss-feed'),
            'update_item'       => __('Update RSS Source', 'import-rss-feed'),
            'add_new_item'      => __('Add New RSS Source', 'import-rss-feed'),
            'new_item_name'     => __('New RSS Source Name', 'import-rss-feed'),
            'menu_name'         => __('RSS Source', 'import-rss-feed')
        );

        $args = array(
            'hierarchical'      => true,
            'labels'            => $labels,
            'show_ui'           => false,
            'show_admin_column' => false,
            'query_var'         => true
        );

        register_taxonomy(self::$taxonomySlug, array_keys(\ImportRssFeed\OptionsPage::getPostTypes()), $args);
    }
}
