'use strict';

import React from 'react';
import {Link} from 'react-router';
import fetch from 'isomorphic-fetch';
import {basename} from '../globals';
import {checkStatus} from '../helpers/util';

import {find, filter} from 'lodash';

export default class App extends React.Component {

  constructor(props, context) {
    super(props, context);
    this.state = {
      admin: [],
      adminDataFetched: false
    };
    console.log('Test');
  }

  componentDidMount(){
    fetch(`${basename}/api/admin`)
      .then(checkStatus)
      .then(r => r.json())
      .then(data => {
        //add key properties
        data.forEach(a => a.key = a.id);
        this.setState({admin: data, adminDataFetched: true});
        console.log(data);
      })
      .catch(() => {
        console.error('failed to get admin data');
      });
  }

  render() {
    console.log('Test');
    return (
      <div className='site-container'>

      </div>
    );
  }
}
