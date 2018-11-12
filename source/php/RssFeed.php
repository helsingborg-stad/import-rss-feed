<?php

namespace ImportRssFeed;

class RssFeed
{
    private $itemQuantityLimit = 20;

    public $name = '';

    public $url = '';

    public $post_type = '';

    public $post_status = '';

    public $post_author = 0;

    public $termId;

    public $rss_thumbnail = 0;

    public $opengraph_thumbnail = 0;

    public $posts = array();

    public function __construct($args, int $quantityLimit = 20)
    {
        $this->itemQuantityLimit = $quantityLimit;

        foreach ($args as $key => $value) {
            if (isset($this->$key)) {
                $this->$key = $value;
            }
        }

        $rss = fetch_feed($this->url);

        //Error? Bail out
        if (is_wp_error($rss)) {
            $this->registerError("Plugin name: Import Rss Feed, Class: ImportRssFeed\RssFeed (on fetch_feed url: ". $this->url ."):" . $rss->get_error_message());
            return;
        }

        //Common term for this feed
        $this->termId = $this->getTermForThisFeed($this->name);

        //Posts
        $this->posts = $this->mapPosts($rss);
    }

    /**
     * getTermForThisFeed($termName)
     *
     * Returns term id based on name, creates term if id does not exists
     * @param string $termName Name of the term
     * @return int
     */
    public function getTermForThisFeed($termName)
    {
        //Get term
        $term = get_term_by('name', $termName, \ImportRssFeed\Taxonomy::$taxonomySlug, 'OBJECT');

        //Create term if it does not exist
        $term = !$term ? wp_insert_term($termName, \ImportRssFeed\Taxonomy::$taxonomySlug) : $term;

        return is_object($term) ? $term->term_id : $term['term_id'];
    }

    /**
     * mapPosts(rss)
     *
     * Creates post object for each rss item
     * @param class $rss SimplePie object.
     * @return array
     */
    public function mapPosts(\SimplePie $rss)
    {
        $posts = array();
        $items = $rss->get_items(0, $rss->get_item_quantity($this->itemQuantityLimit));

        if (!empty($items)) {
            foreach ($items as $item) {
                $post = new \ImportRssFeed\Post($item);

                // Append/Override common values from RSS feed
                $post->meta_input['rss_name'] = $this->name;
                $post->meta_input['rss_url'] = $this->url;
                $post->post_type = $this->post_type;
                $post->post_status = $this->post_status;
                $post->post_author = $this->post_author ? $this->post_author : 0;

                // Add post ID if post already exists
                $post->ID = $post->getPostId();

                $posts[] = apply_filters('ImportRssFeed/RssFeed/mapPost', $post, $this);
            }
        }

        return $posts;
    }

    /**
     * Register error in log
     * @param string $errorMessage A written error.
     * @return void
     */
    public function registerError($errorMessage)
    {
        $trace = debug_backtrace();
        if (isset($trace[1])) {
            $errorInClass = $trace[1]['class'];
            $errorInFunction = $trace[1]['function'];
        } else {
            $errorInClass = "";
            $errorInFunction = "";
        }

        error_log($errorMessage . 'in' . $errorInClass . '->' . $errorInFunction);
    }
}
