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

const Edit = () => {
	const blockProps = useBlockProps();
	return (
		<div { ...blockProps }>
			<button>
				Edit Pledge
			</button>
		</div>
	);
};

registerBlockType( metadata.name, {
	edit: Edit,
	save: () => null,
} );
