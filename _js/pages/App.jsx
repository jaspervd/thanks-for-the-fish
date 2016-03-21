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
  }

  componentDidMount(){
    let request = new XMLHttpRequest();
    request.open('GET', `${window.app.basename}/api/admin`, true);
    request.onload = ($data) => {
      if (request.status === 200) {
        let adminData = JSON.parse($data.target.response);
        this.setState({admin: adminData, adminDataFetched: true});
        console.log(`[App] Logged in as \"${this.state.admin.username}\"`);
      } else {
        window.location = `${window.app.basename}/admin-login`;
      }
    };
    request.send();
  }

  render() {
    return (
      <div className='site-container'>

      </div>
    );
  }
}
