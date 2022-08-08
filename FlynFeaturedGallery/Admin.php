<?php

namespace Flyn\FeaturedGallery;

use Flyn\FeaturedGallery\Helpers;

class Admin
{
    use \Flyn\FeaturedGallery\Traits\Singleton;

    /**
     * Initialize the singleton free from constructor parameters.
     */
    protected function init(): void
    {
        if (defined('WP_ADMIN') && WP_ADMIN) {
            add_action('admin_init', function () {
                add_action('enqueue_block_editor_assets', [$this, 'enqueueBlockEditorAssets']);
            });
        }
    }

    /**
     * Enqueue Block Editor Assets.
     *
     * @return void
     */
    public function enqueueBlockEditorAssets(): void
    {
        if (!Helpers::isPageNow(['post-new.php', 'post.php'])) {
            return;
        }

        $asset = require __DIR__ . '/../assets/js/build/editor.min.asset.php';

        wp_register_script(
            'flyn_featured_gallery',
            plugins_url('../assets/js/build/editor.min.js', __FILE__),
            $asset['dependencies'],
            $asset['version'],
            true
        );

        wp_enqueue_style('flyn_featured_gallery');
        wp_enqueue_script('flyn_featured_gallery');
    }
}
