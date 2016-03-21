'use strict';

import React from 'react';
import {Link} from 'react-router';
import fetch from 'isomorphic-fetch';
import {basename} from '../globals';

import {find, filter} from 'lodash';

export default class App extends React.Component {

  constructor(props, context) {
    super(props, context);
    this.state = {};
  }

  componentDidMount(){

  }

  render() {
    return (
      <div className='site-container'>

      </div>
    );
  }
}
