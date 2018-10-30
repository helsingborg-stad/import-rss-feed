# Import RSS Feed

Probably the last Wordpress RSS importer. Import items from RSS feed to any post type.

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
## Filters

### ImportRssFeed/OptionsPage/PostTypes

Filters avalible post types used when importing a RSS feed

- ```@param array $postTypes``` - Array containing post types (slug as key, label as value)

```php
apply_filters('ImportRssFeed/OptionsPage/PostTypes', $postTypes);
```
