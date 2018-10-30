<?php

namespace ImportRssFeed;

class OptionsPage
{
    public static $pageName = 'RSS Importer';
    public static $parentSlug = 'tools.php';

    public function __construct()
    {
        add_action('acf/init', array($this, 'setupAdminPage'));
        add_filter('acf/load_field/key=field_5bd2cd1c2a6e6', array($this, 'populateThePostTypeField'));
        add_action('acf/render_field', array($this, 'renderManualImportUi'), 10, 1 );
        add_action('admin_enqueue_scripts', array($this, 'enqueueAssets'), 8);
    }

    /**
     * renderManualImportUi($field)
     *
     * Renders manual import UI within a ACF field
     * @param array $field The ACF field array
     * @return void
     */
    public function renderManualImportUi($field)
    {
        if (!isset($field['key']) || $field['key'] != 'field_5bd705165ec05') {
            return;
        }

        $output = array();
        $output[] = '<div class="rss-import">';
        $output[] = '<div>';
        $output[] = '<button class="button button-primary js-run-rss-import">Run import</button>';
        $output[] = '<div class="spinner js-spinner"></div>';
        $output[] = '</div>';
        $output[] = '<div class="js-rss-import-status"></div>';
        $output[] = '</div>';
        echo implode('', $output);
    }

    /**
     * enqueueAssets()
     *
     * Enqueues script and styles
     * @param array $field The ACF field array
     * @return void
     */
    public function enqueueAssets()
    {
        if (!self::isOptionPage()) {
            return;
        }

        wp_enqueue_style('import-rss-feed-css');
        wp_enqueue_script('import-rss-feed-js');
        wp_localize_script('import-rss-feed-js', 'importRssFeedAjaxObject', array(
            'nonce' => wp_create_nonce('importRssFeed'),
            'adminUrl' => admin_url('admin-ajax.php')
        ));
    }

    /**
     * populateThePostTypeField($field)
     *
     * Populates ACF field with post types
     * @param array $field The ACF field array
     * @return void
     */
    public function populateThePostTypeField($field)
    {
        $field['choices'] = self::getPostTypes();
        return $field;
    }

    /**
     * getPostTypes()
     *
     * Returns all post types that will be avaible for import
     * @return void
     */
    public static function getPostTypes()
    {
        $ignoreThesePostTypes = array('attachment');
        $postTypes = [];

        $args = apply_filters('ImportRssFeed/optionsPage/getPostTypes/Args', array('public' => true));

        if (!empty(get_post_types($args, 'objects'))) {
            foreach (get_post_types($args, 'objects') as $postType) {
                if (in_array($postType->name, $ignoreThesePostTypes)) {
                    continue;
                }
                $postTypes[$postType->name] = $postType->label;
            }
        }

        return apply_filters('ImportRssFeed/OptionsPage/PostTypes', $postTypes);
    }

    /**
     * setupAdminPage()
     *
     * Registers options page with ACF function (acf_add_options_page)
     * @return void
     */
    public function setupAdminPage()
    {
        if (function_exists('acf_add_options_page')) {
            $option_page = acf_add_options_page(array(
                'page_title'    => self::$pageName,
                'menu_title'    => self::$pageName,
                'menu_slug'     => sanitize_title(self::$pageName),
                'parent_slug'   => self::$parentSlug,
                'capability'    => 'edit_posts',
                'redirect'  => false
            ));
        }
    }

    public static function isOptionPage()
    {
        if (is_admin() && pathinfo($_SERVER['REQUEST_URI'])['basename'] == self::$parentSlug . '?page=' . sanitize_title(self::$pageName)) {
            return true;
        }

        return false;
    }
}
