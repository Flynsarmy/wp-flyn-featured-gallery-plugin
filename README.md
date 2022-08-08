# Flyn Featured Gallery for WordPress

[![Software License](https://img.shields.io/badge/license-GPLv2-brightgreen.svg?style=flat-square)](LICENSE.md)
![Build Status - PHP](https://github.com/Flynsarmy/wp-flyn-featured-gallery-plugin/workflows/CI%20-%20PHP/badge.svg)
![Build Status - JS](https://github.com/Flynsarmy/wp-flyn-featured-gallery-plugin/workflows/CI%20-%20JS/badge.svg)

> Flyn Featured Gallery provides featured gallery support to WordPress posts.

Want to contribute? Flyn Featured Gallery can be found [on Github](https://github.com/Flynsarmy/wp-flyn-featured-gallery-plugin). Fork and submit your pull requests today!

## Installation

1. `git clone https://github.com/Flynsarmy/wp-flyn-featured-gallery-plugin /path/to/wp-content/plugins/flyn-featured-gallery`
1. `composer install`
1. Activate the plugin through the 'Plugins' menu in WordPress.

## Usage

### Admin (Gutenberg)

Create a post/page and click *Set gallery images* on the right of any post type add/edit page in admin.

### Frontend

Display your posts gallery with `echo get_the_post_gallery();`


## Documentation

The following function has been defined for use on the frontend:

```php
get_the_post_gallery( int|WP_Post $post = null, string $size = 'post-thumbnail'  )
```

### Parameters
#### $post
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*(int|WP_Post) (Optional)* Post ID or WP_Post object. Default is global $post.

Default value: null

#### $size
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*(string|int[]) (Optional)* Image size. Accepts any registered image size name.

*Default value: 'post-thumbnail'*

### Return

*(string)* Gallery shortcode HTML.


## Changelog

**v1.0** *(2022-10-08)*

*  Initial release
