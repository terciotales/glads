const path = require('path');
const defaultConfig = require('@wordpress/scripts/config/webpack.config');

// Adiciona um novo loader nas regras do scss para fazer includes em massa usando "*"
const customRules = defaultConfig.module.rules.map( ( item ) => {
	if ( item.test && item.test.test( '.scss' ) ) {
		item.use = [ ...item.use, { loader: 'import-glob-loader' } ];
	}

	return item;
} );

module.exports = {
	...defaultConfig,
	entry: {
		...defaultConfig.entry,
		admin: path.resolve( __dirname, 'src/admin/index.js' ),
		public: path.resolve( __dirname, 'src/public/index.js' ),
		['blocks/ad/index']: path.resolve( __dirname, 'src/blocks/ad/index.js' ),
		['blocks/ad/view']: path.resolve( __dirname, 'src/blocks/ad/view.js' ),
	},
	output: {
		...defaultConfig.output,
		path: path.resolve(process.cwd(), 'dist'),
	},
	module: {
		...defaultConfig.module,
		rules: customRules,
	},
};
