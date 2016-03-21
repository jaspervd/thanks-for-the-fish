'use strict';

import ReactDOM from 'react-dom';
import React from 'react';

import Router from './routers/';

const init = () => {

  ReactDOM.render(
    <Router />,
    document.querySelector('.container')
  );

};

init();
