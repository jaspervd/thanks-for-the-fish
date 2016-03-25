'use strict';

var webpack = require('webpack');
var ExtractTextPlugin = require('extract-text-webpack-plugin');
var path = require('path');

var config = require('./_config'); //paths config..

var NODE_ENV = '\'development\'';

process.argv.forEach(arg => {
  if(arg === '-p' || arg === '-d'){
    NODE_ENV = '\'production\'';
  }
});

module.exports = {

  /*entry: [
    config.build('js', 'src'), //JavaScript entry point
    config.build('css', 'src') //CSS entry point
    ],*/

    entry: {
      script: './_js/script.js',
      class: './_js/class.js',
      login: './_js/login.js',
      admin: './_js/admin.js',
      adminLogin: './_js/adminLogin.js',
      style: config.css.src.path + config.css.src.file,
      style_admin: config.admincss.src.path + config.admincss.src.file
    },

    output: {
      path: config.js.dest.path,
    filename: '[name].js', // Template based on keys in entry above
     publicPath: '../images/'
  },

  //quickest, webpack -d -p for production
  devtool: 'eval',

  module: {

    //test: which filetype?,
    //exclude: which folders to exclude

    loaders: [

    {
      test: /\.(eot|woff|woff2|ttf|svg|png|jpg)$/,
      loader: 'url-loader?limit=30000&name=[name].[ext]' // [name]-[hash].[ext]
    },

    {
      test: /\.(js|jsx)$/,
      exclude: [/node_modules/, /assets/],
      loader: 'babel',
      query: {
        babelrc: path.join(__dirname, '.babelrc')
      }
    },

    {
      test: /\.(js|jsx)$/,
      exclude: [/node_modules/, /assets/, /images/],
      loader: 'eslint'
    },

    {
      test: /\.csv?$/,
      loader: 'dsv',
      query: {
        delimiter: ';'
      }
    },

    {
      test: /\.scss$/,
      exclude: /assets/,
      loader: ExtractTextPlugin.extract('css!postcss!sass?outputStyle=expanded', {allChunks: false})
    }

    ]

  },

  postcss: function(){

    return [

    require('postcss-will-change'),
    require('postcss-cssnext')({
      browsers: ['IE >= 10', 'last 2 version'],
      features: {
        autoprefixer: {
          cascase: false
        }
      }
    })

    ];

  },

  //webpack plugins
  plugins: [
  //new webpack.optimize.CommonsChunkPlugin('class', 'class.js'),
  new webpack.optimize.DedupePlugin(),

    //extract CSS into seperate file
    /*new ExtractTextPlugin(
      config.build('css', 'dest')
    ),*/

    new ExtractTextPlugin(config.css.dest.path + "[name].css"),

    //react smaller build
    new webpack.DefinePlugin({
      'process.env': {NODE_ENV: NODE_ENV}
    })

    ],

    resolve: {
      extensions: ['', '.json', '.js', '.css', '.jsx', '.csv'],
      fallback: path.join(__dirname, 'node_modules')
    },

    resolveLoader: {
      fallback: path.join(__dirname, 'node_modules')
    }

  };
