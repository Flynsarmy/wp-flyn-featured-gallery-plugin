<?php

namespace Flyn\FeaturedGallery;

class Setup
{
    use \Flyn\FeaturedGallery\Traits\Singleton;

    /**
     * Initialize the singleton free from constructor parameters.
     */
    protected function init(): void
    {
        add_action('init', [$this, 'registerPostMetas']);
    }

    /**
     * Fires when preparing to serve an API request.
     */
    public function registerPostMetas(): void
    {
        // https://stackoverflow.com/a/64516011
        register_post_meta(
            '',
            'flyn_featured_gallery',
            [
                'single'       => true,
                'type'         => 'array',
                'show_in_rest' => [
                    'schema' => [
                        'type' => 'array',
                        'items' => [
                            'type' => 'number',
                        ]
                    ]
                ],
                'auth_callback' => function () {
                    return current_user_can('edit_posts');
                }
            ]
        );
    }
}
