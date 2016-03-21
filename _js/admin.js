'use strict';

import ReactDOM from 'react-dom';
import React from 'react';

import Router from './routers/';

const init = () => {

  console.log('[admin] Initialising React');

  ReactDOM.render(
    <Router />,
    document.querySelector('.react-container')
  );

};

init();
