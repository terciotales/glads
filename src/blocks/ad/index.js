import { registerBlockType } from '@wordpress/blocks';

import './style.scss';
import Edit from './edit';
import metadata from './block.json';

registerBlockType(metadata, {
	icon: {
		src: 'screenoptions',
		foreground: '#007cba',
	},
	edit: Edit,
	save: () => null,
});

