import {useBlockProps} from '@wordpress/block-editor';

const Edit = (props) => {
	const blockProps = useBlockProps();

	const categories = useEntityRecords


		useSelect(
		(select) => {
			return select('core').getEntityRecords(
				'taxonomy',
				attributes.taxonomy,
				{per_page: -1}
			);
		},
		[attributes.taxonomy]
	);

	return (
		<div { ...blockProps }>
			<h2>Ad Block</h2>
		</div>
	)
};

export default Edit;
