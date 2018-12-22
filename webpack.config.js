'use strict';

const autoprefixer = require( 'autoprefixer' );
const fs = require( 'fs' );
const globImporter = require( 'node-sass-glob-importer' );
const browsers = require( '@wordpress/browserslist-config' );
const MiniCssExtractPlugin = require( 'mini-css-extract-plugin' );
const path = require( 'path' );
const webpack = require( 'webpack' );
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');

const URL = 'http://cares.test';

module.exports = function() {

    const mode = process.env.NODE_ENV || 'development';
    const extensionPrefix = mode === 'production' ? '.min' : '';

    // This is the URL path relative to the root domain.
    const publicPath = '/wp-content/mu-plugins/blocks/';

    // These are the paths where different types of resources should end up.
    const paths = {
        css: 'assets/css/',
        img: 'assets/img/',
        font: 'assets/fonts/',
        js: 'assets/js/',
        lang: 'languages/',
    };

    // The property names will be the file names, the values are the files that should be included.
    const entry = {
        main: [
            './src/scss/main.scss',
			'./src/js/main.js',
        ],
        blocks: [
            './src/scss/blocks.scss',
			'./src/js/blocks.js',
        ],
		editor: [
			'./src/scss/editor.scss',
			'./src/js/editor.js'
		],
		customizer: [
			'./src/js/customizer.js'
		]
    };

    const loaders = {
        css: {
            loader: 'css-loader',
            options: {
                sourceMap: true,
            },
        },
        postCss: {
            loader: 'postcss-loader',
            options: {
                plugins: [
                    autoprefixer( {
                        browsers,
                        flexbox: 'no-2009',
                    } ),
                ],
                sourceMap: true,
            },
        },
        sass: {
            loader: 'sass-loader',
            options: {
                importer: globImporter(),
                sourceMap: true,
            },
        },
    };

    const config = {
        mode,
        entry,
        output: {
            path: path.join( __dirname, '/' ),
            publicPath,
            filename: `${ paths.js }[name]${ extensionPrefix }.js`,
        },
        externals: {
            '@wordpress/a11y': 'wp.a11y',
            '@wordpress/components': 'wp.components', // Not really a package.
            '@wordpress/blocks': 'wp.blocks', // Not really a package.
            '@wordpress/data': 'wp.data', // Not really a package.
            '@wordpress/date': 'wp.date', // Not really a package.
            '@wordpress/element': 'wp.element', // Not really a package.
            '@wordpress/hooks': 'wp.hooks',
            '@wordpress/i18n': 'wp.i18n',
            '@wordpress/utils': 'wp.utils', // Not really a package
            backbone: 'Backbone',
            jquery: 'jQuery',
            lodash: 'lodash',
            moment: 'moment',
            react: 'React',
            'react-dom': 'ReactDOM',
            tinymce: 'tinymce',
        },
        module: {
            rules: [
                {
                    enforce: 'pre',
                    test: /\.js|.jsx/,
                    loader: 'import-glob',
                    exclude: /(node_modules)/,
                },
                {
                    test: /\.js|.jsx/,
                    loader: 'babel-loader',
                    query: {
                        presets: [
                            '@wordpress/default',
                        ],
                        plugins: [
                            [
                                '@wordpress/babel-plugin-makepot',
                                {
                                    'output': `${ paths.lang }translation.pot`,
                                }
                            ],
                            'transform-class-properties',
                        ],
                    },
                    exclude: /(node_modules|bower_components)/,
                },
                {
                    test: /\.html$/,
                    loader: 'raw-loader',
                    exclude: /node_modules/,
                },
                {
                    test: /\.css$/,
                    use: [
                        MiniCssExtractPlugin.loader,
                        loaders.css,
                        loaders.postCss,
                    ],
                    exclude: /node_modules/,
                },
                {
                    test: /\.scss$/,
                    use: [
                        MiniCssExtractPlugin.loader,
                        loaders.css,
                        loaders.postCss,
                        loaders.sass,
                    ],
                    exclude: /node_modules/,
                },
                {
                    test: /\.(ttf|eot|svg|woff2?)(\?v=[0-9]\.[0-9]\.[0-9])?$/,
                    use: [
                        {
                            loader: 'file-loader',
                            options: {
                                name: '[name].[ext]',
                                outputPath: paths.font,
                            },
                        },
                    ],
                    exclude: /(assets)/,
                },
            ],
        },
        plugins: [
            new MiniCssExtractPlugin( {
                filename: `${ paths.css }[name]${ extensionPrefix }.css`,
            } ),
            new webpack.DefinePlugin( {
                'process.env.NODE_ENV': JSON.stringify( mode ),
            } ),
			new BrowserSyncPlugin({
				host: 'localhost',
				port: 3000,
				proxy: URL
			}),
            function() {
                // Custom webpack plugin - remove generated JS files that aren't needed
                this.hooks.done.tap( 'webpack', function( stats ) {
                    stats.compilation.chunks.forEach( chunk => {
                        if ( ! chunk.entryModule._identifier.includes( '.js' ) ) {
                            chunk.files.forEach( file => {
                                if ( file.includes( '.js' ) ) {
                                    fs.unlinkSync( path.join( __dirname, `/${ file }` ) );
                                }
                            } );
                        }
                    } );
                } );
            },
        ],
    };

    if ( mode !== 'production' ) {
        config.devtool = 'source-map';
    }

    return config;
};
