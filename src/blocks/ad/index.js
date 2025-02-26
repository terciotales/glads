import { registerBlockType } from '@wordpress/blocks';
import {InnerBlocks} from "@wordpress/block-editor";

import './style.scss';
import Edit from './edit';
import metadata from './block.json';

registerBlockType(metadata, {
	icon: {
		src: 'screenoptions',
		foreground: '#007cba',
	},
	edit: Edit,
	save: () => {
		return (
			<InnerBlocks.Content/>
		);
	}
});

