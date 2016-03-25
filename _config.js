'use strict';

module.exports = {
  js: {
    src: {
      file: 'script.js',
      path: './_js/'
    },
    dest: {
      file: 'script.js',
      path: './js/'
    }
  },

  css: {
    src: {
      file: 'style.scss',
      path: './_scss/'
    },
    dest: {
      file: 'style.css',
      path: '../css/' //relative from js dest folder
    }
  },

  admincss: {
    src: {
      file: 'admin.scss',
      path: './_scss/'
    },
    dest: {
      file: 'admin.css',
      path: '../css/' //relative from js dest folder
    }
  },

  build: function(type, target){
    return this[type][target].path + this[type][target].file;
  }
};
