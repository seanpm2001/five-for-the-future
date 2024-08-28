/**
 * WordPress dependencies
 */
import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps } from '@wordpress/block-editor';

/**
 * Internal dependencies
 */
import metadata from './block.json';
import './style.scss';

const Edit = ( { attributes, name } ) => {
	const blockProps = useBlockProps();
	return (
		<div { ...blockProps }>
			<ServerSideRender block={ name } attributes={ attributes } skipBlockSupportAttributes />
		</div>
	);
};

registerBlockType( metadata.name, {
	edit: Edit,
	save: () => null,
} );
