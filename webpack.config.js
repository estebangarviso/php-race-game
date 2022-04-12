var resolve = require('path').resolve;
var webpack = require('webpack');

const config = (env, argv) => {
  const isProduction = argv.mode === 'production';

  return {
    context: resolve(__dirname, 'app', 'assets'),
    resolve: {
      extensions: ['.js', '.ts', '.json'],
    },
    devtool: 'source-map', // more info:https://webpack.js.org/guides/production/#source-mapping and https://webpack.js.org/configuration/devtool/
    entry: ['./app.ts', './app.scss'],
    output: {
      filename: 'bundle.js',
      path: resolve(__dirname, 'public', 'assets'),
      assetModuleFilename: 'img/[hash][ext][query]',
      clean: true,
    },
    watch: !isProduction,
    watchOptions: {
      ignored: /node_modules/,
    },
    module: {
      rules: [
        {
          test: /\.(ts|js)x?$/i,
          exclude: resolve(__dirname, 'node_modules'),
          use: 'ts-loader',
        },
        {
          test: /\.s[ac]ss$/,
          use: [
            {
              loader: 'style-loader', // creates style nodes from JS strings
            },
            {
              loader: 'css-loader', // translates CSS into CommonJS
              options: {
                sourceMap: true,
              },
            },
            {
              loader: 'postcss-loader', // Run postcss actions
              options: {
                sourceMap: true,
                postcssOptions: {
                  plugins: ['autoprefixer'],
                },
              },
            },
            {
              loader: 'sass-loader', // compiles Sass to CSS
              options: {
                sourceMap: true,
              },
            },
          ],
        },
        {
          test: /\.(?:ico|gif|png|jpg|jpeg)$/i,
          type: 'asset/resource',
        },
      ],
    },
    plugins: [
      new webpack.ProvidePlugin({
        $: 'jquery',
        jQuery: 'jquery',
      }),
    ],
  };
};

module.exports = config;
