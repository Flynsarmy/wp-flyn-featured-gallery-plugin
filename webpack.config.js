/**
 * WordPress dependencies
 */
const defaultConfig = require( '@wordpress/scripts/config/webpack.config' );

/**
 * External dependencies
 */
const ESLintPlugin = require( 'eslint-webpack-plugin' );

const isProduction = process.env.NODE_ENV === 'production';

const config = {
	...defaultConfig,
	entry: {
		editor: './assets/js/src/editor.js',
	},
	output: {
		path: __dirname + '/assets/js/build/',
		filename: '[name].min.js',
	},
	module: {
		...defaultConfig.module,
	},
	plugins: [ ...defaultConfig.plugins ],
};

if ( ! isProduction ) {
	config.plugins = [
		new ESLintPlugin( {
			emitWarning: true,
			overrideConfigFile: './.eslintrc.js',
		} ),
		...config.plugins,
	];
}

module.exports = config;
