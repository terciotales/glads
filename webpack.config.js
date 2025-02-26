const path = require('path');
const glob = require('glob');
const defaultConfig = require('@wordpress/scripts/config/webpack.config');

// Adiciona um novo loader nas regras do scss para fazer includes em massa usando "*"
const customRules = defaultConfig.module.rules.map((item) => {
	if (item.test && item.test.test('.scss')) {
		item.use = [...item.use, {loader: 'import-glob-loader'}];
	}

	return item;
});

module.exports = {
	...defaultConfig,
	entry: Object.assign(
		{
			admin: path.resolve(__dirname, 'src/admin/index.js'),
			'editor': path.resolve(__dirname, 'src/editor/index.js'),
			public: path.resolve(__dirname, 'src/public/index.js'),
		},
	),
	output: {
		...defaultConfig.output,
		path: path.resolve(__dirname, 'bundle'),
		publicPath: './',
	},
	module: {
		...defaultConfig.module,
		rules: customRules,
	},
};
