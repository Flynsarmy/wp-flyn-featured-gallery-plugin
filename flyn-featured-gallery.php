<?php

/*
Plugin Name: Flyn Featured Gallery
Plugin URI: https://www.flynsarmy.com
Description: Adds featured gallery support to posts
Version: 1.0
Author: Flyn San
Author URI: https://www.flynsarmy.com
License: GPLv2

Copyright 2022  Flyn San  (email : flynsarmy@gmail.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

require_once __DIR__ . "/vendor/autoload.php";

/**
 * Start the plugin.
 */
// Flyn\FeaturedGallery\Rest::instance();
Flyn\FeaturedGallery\Setup::instance();
Flyn\FeaturedGallery\Admin::instance();

/**
 * Returns gallery HTML for the given post's featured gallery or an empty string if it doesn't have one.
 *
 * @param integer|WP_Post|null $post
 * @param string $size
 * @return string
 */
function get_the_post_gallery(int|WP_Post $post = null, string $size = 'post-thumbnail'): string
{
    $post = get_post($post);

    if (!$post) {
        return '';
    }

    /**
     * Filters the post thumbnail size.
     *
     * @since 2.9.0
     * @since 4.9.0 Added the `$post_id` parameter.
     *
     * @param string|int[] $size    Requested image size. Can be any registered image size name, or
     *                              an array of width and height values in pixels (in that order).
     * @param int          $post_id The post ID.
     */
    $size = apply_filters('post_thumbnail_size', $size, $post->ID);

    $gallery_ids = array_map('intval', get_post_meta($post->ID, 'flyn_featured_gallery', true));

    $html = do_shortcode(sprintf(
        '[gallery ids="%s" size="%s"]',
        implode(',', $gallery_ids),
        esc_attr($size)
    ));

    /**
     * Filters the post thumbnail HTML.
     *
     * @since 2.9.0
     *
     * @param string       $html              The post thumbnail HTML.
     * @param int          $post_id           The post ID.
     * @param int[]        $gallery_ids       The gallery image IDs.
     * @param string|int[] $size              Requested image size. Can be any registered image size name, or
     *                                        an array of width and height values in pixels (in that order).
     */
    return apply_filters('post_gallery_html', $html, $post->ID, $gallery_ids, $size);
}
