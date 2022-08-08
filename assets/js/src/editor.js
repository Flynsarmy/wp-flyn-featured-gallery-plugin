/**
 * Local dependencies
 */

import { default as FeaturedGallery } from './components/featuredgallery';

const { registerPlugin } = wp.plugins;

registerPlugin( 'flyn-featured-gallery', {
	icon: 'none',
	render: FeaturedGallery,
} );
