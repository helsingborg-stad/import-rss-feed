<?php

namespace ImportRssFeed;

class Post
{
    public $ID = 0;

    public $post_author = 0;

    public $post_date = '';

    public $post_content = '';

    public $post_title = '';

    public $post_excerpt = '';

    public $post_status = 'publish';

    public $post_type = 'post';

    public $meta_input = [];

    public function __construct(\SimplePie_Item $item)
    {
        $this->post_title = $item->get_title();
        $this->post_excerpt = strip_tags($item->get_description());
        $this->post_content = strip_tags($item->get_content());
        $this->post_date = $item->get_date('Y-m-d H:i:s');
        $this->meta_input = array(
            'rss_id' => base_convert(md5($item->get_id()), 10, 36),
            'rss_link' => $item->get_permalink(),
            'rss_author' => is_object($item->get_author()) ? get_object_vars($item->get_author()) : $item->get_author(),
            'rss_date' => strtotime($item->get_date('Y-m-d H:i:s'))
        );
    }

    /**
     * postExists()
     *
     * Check wheter or not post already exists (within the post type)
     * @return boolean
     */
    public function postExists()
    {
        if ($this->getPostId()) {
            return true;
        }

        return false;
    }

    /**
     * getPostId()
     *
     * Returns post id if it exists (based on post type & rss_id)
     * @return boolean/int
     */
    public function getPostId()
    {
        $itemId = $this->meta_input['rss_id'];
        $postType = $this->post_type;

        global $wpdb;
        $tablePrefix = $wpdb->prefix;
        $sql = "
            SELECT {$tablePrefix}posts.ID
            FROM {$tablePrefix}posts
            LEFT JOIN {$tablePrefix}postmeta ON {$tablePrefix}postmeta.post_id = {$tablePrefix}posts.ID
            WHERE {$tablePrefix}postmeta.meta_value = '{$itemId}' AND {$tablePrefix}posts.post_type = '{$postType}'
        ";
        $results = $wpdb->get_results($sql, ARRAY_A);

        if (empty($results)) {
            return false;
        }

        return $results[0]['ID'];
    }
}
