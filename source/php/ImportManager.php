<?php

namespace ImportRssFeed;

class ImportManager
{
    public $rssFeeds = array();

    public $foundPosts = 0;

    public $createdPosts = 0;

    public $updatedPosts = 0;

    /**
     * start()
     *
     * Initates the import
     * @return void
     */
    public function start()
    {
        if (!get_field('import_rss_feed', 'options') || empty(get_field('import_rss_feed', 'options'))) {
            return;
        }

        foreach (get_field('import_rss_feed', 'options') as $args) {
            $feed = new \ImportRssFeed\RssFeed($args);

            if (!empty($feed->posts)) {
                $this->foundPosts = $this->foundPosts + count($feed->posts);

                foreach ($feed->posts as $post) {

                    do_action('ImportRssFeed/ImportManager/start/beforeUpdatePost', $post, $feed);

                    $this->updatePost($post);

                    do_action('ImportRssFeed/ImportManager/start/afterUpdatePost', $post, $feed);
                }
            }

            $this->rssFeeds[] = $feed;
        }
    }

    /**
     * updatePost($post, $force)
     *
     * Update post if RSS date is later, create new post if it doesn't exists within the post type
     * @param object $post RSS post object (\ImportRssFeed\Post)
     * @param boolean $force Wheter or not to force update
     * @return boolean
     */
    public function updatePost(\ImportRssFeed\Post $post, $force = false)
    {
        $force = apply_filters('ImportRssFeed/ImportManager/updatePost/force', $force, $post);
        $args = get_object_vars($post);

        if ($post->postExists()) {
            $postId = $post->getPostId();
            $newRssDate = strtotime($post->post_date);
            $oldRssDate = get_post_meta($postId, 'rss_date');

            if ($oldRssDate && $newRssDate > $oldRssDate || $force) {
                $args['ID'] = $postId;
            } else {
                return false;
            }
        }

        if ($args['ID'] == 0) {
            $this->createdPosts++;
        } else {
            $this->updatedPosts++;
        }

        return wp_insert_post(apply_filters('ImportRssFeed/ImportManager/updatePost/args', $args, $post, $force));
    }
}
