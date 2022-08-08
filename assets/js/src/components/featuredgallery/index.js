/**
 * WordPress dependencies
 * https://wordpress.stackexchange.com/questions/370857/building-a-featured-gallery-component-for-gutenberg
 */

import { compose } from '@wordpress/compose';
import { MediaUpload, MediaUploadCheck } from '@wordpress/block-editor';
import { withSelect, withDispatch } from '@wordpress/data';
import { PluginDocumentSettingPanel } from '@wordpress/edit-post';
import { Button, PanelRow } from '@wordpress/components';

const DEFAULT_META = {
	flyn_featured_gallery: [],
};

const FeaturedGallery = ( { galleryImageIds, onUpdateGallery } ) => {
	const instructions = (
		<p>
			{
				'To edit the featured gallery, you need permission to upload media.'
			}
		</p>
	);

	return (
		<PluginDocumentSettingPanel
			name="FeaturedGallery"
			className="flyn-featured-gallery"
			title="Featured Gallery"
		>
			<PanelRow>
				<p>{ galleryImageIds.length } images selected.</p>
			</PanelRow>
			<PanelRow>
				<MediaUploadCheck fallback={ instructions }>
					<div className="editor-post-featured-gallery__container"></div>
					<MediaUpload
						title={ 'Featured gallery' }
						multiple
						gallery={ true }
						onSelect={ onUpdateGallery }
						allowedTypes={ [ 'image' ] }
						render={ ( { open } ) => (
							<Button
								onClick={ open }
								className="components-button editor-post-featured-image__toggle"
							>
								{ galleryImageIds.length
									? 'Change gallery images'
									: 'Set gallery images' }
							</Button>
						) }
						value={ galleryImageIds }
					/>
				</MediaUploadCheck>
			</PanelRow>
		</PluginDocumentSettingPanel>
	);
};

export default compose( [
	withSelect( ( select ) => {
		const { getEditedPostAttribute } = select( 'core/editor' );

		const meta = getEditedPostAttribute( 'meta' );

		let galleryImageIds = DEFAULT_META.flyn_featured_gallery;
		if ( typeof meta.flyn_featured_gallery === 'object' ) {
			galleryImageIds = meta.flyn_featured_gallery;
		}

		return {
			galleryImageIds,
		};
	} ),
	withDispatch( ( dispatch ) => {
		const { editPost } = dispatch( 'core/editor' );

		return {
			onUpdateGallery( newValue ) {
				// Convert image objects to IDs
				const ids = newValue.map( ( value ) => value.id );

				editPost( {
					meta: {
						flyn_featured_gallery: ids,
					},
				} );
			},
		};
	} ),
] )( FeaturedGallery );
