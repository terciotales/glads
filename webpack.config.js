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
	entry: {
		...defaultConfig.entry,
		'glads-admin': glob.sync('./assets/admin/js/*.js'),
		'glads-public': glob.sync('./assets/public/js/*.js'),
		'glads-admin-style': glob.sync('./assets/admin/css/*.scss'),
		'glads-public-style': glob.sync('./assets/public/css/*.scss'),
		'glads-ad-block': glob.sync('./includes/blocks/ad/index.js'),
		'glads-ad-block-view': glob.sync('./includes/blocks/ad/view.js'),
		'glads-ad-block-view-style': glob.sync('./includes/blocks/ad/style.scss'),
	},
	output: {
		...defaultConfig.output,
		path: path.resolve(__dirname, 'dist'),
		publicPath: './',
	},
	module: {
		...defaultConfig.module,
		rules: customRules,
	},
};
