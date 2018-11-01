# Import RSS Feed

Probably the last Wordpress RSS importer. Import items from RSS feed to any post type.

## Dependencies
[ACF Pro](https://www.advancedcustomfields.com/pro/ "Advanced custom fields Pro") is required to run this plugin.

## Actions

### ImportRssFeed/ImportManager/start/beforeUpdatePost

Do action before import

- ```@param object $post``` - Post object (/ImportRssFeed/ImportManager/Post)
- ```@param object $feed``` - RSS feed object(/ImportRssFeed/ImportManager/RssFeed)

```php
do_action('ImportRssFeed/ImportManager/start/beforeUpdatePost', $post, $feed);
```
### ImportRssFeed/ImportManager/start/afterUpdatePost

Do action after import

- ```@param object $post``` - Post object (/ImportRssFeed/ImportManager/Post)
- ```@param object $feed``` - RSS feed object(/ImportRssFeed/ImportManager/RssFeed)

```php
do_action('ImportRssFeed/ImportManager/start/afterUpdatePost', $post, $feed);
```

### ImportRssFeed/Post

Do action when mapping post object from RSS item data, can be used to manipulate the post object before import.

- ```@param object $this``` - Post object (/ImportRssFeed/ImportManager/Post)
- ```@param object $item``` - RSS item (SimplePie_Item)

```php
do_action('ImportRssFeed/Post', $this, $item);
```

## Filters

### ImportRssFeed/OptionsPage/PostTypes

Filters avalible post types used when importing a RSS feed

- ```@param array $postTypes``` - Array containing post types (slug as key, label as value)

```php
apply_filters('ImportRssFeed/OptionsPage/PostTypes', $postTypes);
```

## To-Do's
- Fix Simple Pie date error
- Create and save log of import events from cron jobs
- Display log of import events during manual import
- Remove cron jobs when uninstalling plugin
