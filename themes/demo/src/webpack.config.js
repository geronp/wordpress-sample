const path = require("path");
const ESLintPlugin = require("eslint-webpack-plugin");

module.exports = {
	plugins: [
		new ESLintPlugin()
	],
	entry: "./js/main.js",
	output: {
		path: path.resolve(__dirname, "../assets/js/"),
		filename: "bundle.js"
	},
	module: {
		rules: [
			{
				test: /\.m?js$/,
				exclude: /node_modules/,
				use: {
					loader: 'babel-loader',
					options: {
						presets: [
							['@babel/preset-env', { targets: "defaults" }]
						]
					}
				}
			}
		]
	},
};