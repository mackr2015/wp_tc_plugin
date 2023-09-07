## Tech Crunch API Recent Posts

- simple WP API plugin to retrieve recent posts from Tech Crunch website
- default number of posts is set to 3


### Tests ran 

- tested with WP theme 2022 and PHP 8.0
- currently supports Classic Editor in WP
- make sure that Gutenberg is disabled by using Classic Editor plugin or custom functionality in your functions.php
- example of filter hook to disable Gutenberg Editor
```
// Disable Gutenberg (Block) Editor and force Classic Editor for a specific post type
function disable_gutenberg_for_post_type($use_block_editor, $post_type) {
    if ($post_type === 'posts' || $post_type === 'page') {
        return false; // Disable Gutenberg for the specified post type
    }
    return $use_block_editor; // Use the default setting for other post types
}
add_filter('use_block_editor_for_post_type', 'disable_gutenberg_for_post_type', 10, 2);
```

### Install
- use zip directory and add it as a plugin upload
- or clone this repo and manually add to your wp-content/plugins directory

### Contact dev support

- [Mack Raicevic](https://mackraicevic.com)