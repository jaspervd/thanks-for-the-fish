'use strict';

import React from 'react';
import {Link} from 'react-router';
//import fetch from 'isomorphic-fetch';
//import {basename} from '../globals';
//import {find, filter} from 'lodash';
//import {checkStatus} from '../helpers/util';

import {NavOptions} from '../components/';

export default class App extends React.Component {

  constructor(props, context) {
    super(props, context);
    this.state = {
      admin: [],
      navOptions: [],
      adminFetched: false
    };
    this.logoutLink = `${window.app.basename}/api/admin/auth/logout`;
  }

  componentDidMount(){
    let request = new XMLHttpRequest();
    request.open('GET', `${window.app.basename}/api/admin`, true);
    request.onload = ($data) => {
      if (request.status === 200) {
        let adminData = JSON.parse($data.target.response);
        let navOptions = this.getNavOptions(adminData);
        this.setState({admin: adminData, navOptions: navOptions, adminFetched: true});
        console.log(`[App] Logged in as \"${this.state.admin.username}\"`);
      } else {
        window.location = `${window.app.basename}/admin-login`;
      }
    };
    request.send();
  }

  getNavOptions(admin){
    let navOptions = [];
    if(admin.can_create_admins === 1){
      navOptions.push({'id': 1, 'to': '/admin/admins', 'optionName': 'Admins'});
    }
    if(admin.can_authorize_teachers === 1){
      navOptions.push({'id': 2, 'to': '/admin/teachers', 'optionName': 'Gebruikers'});
    }
    if(admin.can_vote_winner === 1 || admin.can_approve_entry === 1){
      navOptions.push({'id': 3, 'to': '/admin/entries', 'optionName': 'Inzendingen'});
    }
    return navOptions;
  }

  render() {

    let {admin, adminFetched, navOptions} = this.state;

    return (
      <div className='admin-workspace'>
        <header className='admin-header'>
          <h1><Link to='admin' >Welkom, {this.state.admin.username}</Link></h1>
          <NavOptions navOptions={navOptions} />
          <a className='logout-btn' href={this.logoutLink}>Uitloggen</a>
        </header>
        {this.props.children && React.cloneElement(this.props.children, {
          admin: admin,
          adminFetched: adminFetched
        })}
      </div>
    );

  }
}
