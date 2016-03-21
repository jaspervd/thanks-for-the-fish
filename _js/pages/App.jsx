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
      adminFetched: false
    };
    this.navItems = [];
    this.logoutLink = `${window.app.basename}/api/admin/auth/logout`;
  }

  componentDidMount(){
    let request = new XMLHttpRequest();
    request.open('GET', `${window.app.basename}/api/admin`, true);
    request.onload = ($data) => {
      if (request.status === 200) {
        let adminData = JSON.parse($data.target.response);
        this.setState({admin: adminData, adminFetched: true});
        console.log(`[App] Logged in as \"${this.state.admin.username}\"`);
        this.setNavItems();
      } else {
        window.location = `${window.app.basename}/admin-login`;
      }
    };
    request.send();
  }

  setNavItems(){
    if(this.state.admin.can_create_admins === 1){
      this.navItems.push(<Link to={'/admin/admins'} key="admins">Admins</Link>);
    }
    if(this.state.admin.can_authorize_teachers === 1){
      this.navItems.push(<Link to={'/admin/teachers'} key="teachers">Teachers</Link>);
    }
    if(this.state.admin.can_vote_winner === 1 || this.state.admin.can_approve_entry === 1){
      this.navItems.push(<Link to={'/admin/entries'} key="entries">Entries</Link>);
    }
  }

  renderNavItems(){
    console.log('NavItems:', this.navItems);
    return this.navItems.map(navItem => {
      return navItem;
    });
  }

  render() {
    return (
      <div className='cms-container'>
        <header>
          <h1 className='cms-header'>Welkom, {this.state.admin.username}</h1>
          <nav>
            {this.renderNavItems()}
            <a href={this.logoutLink}>Logout</a>
          </nav>
        </header>
      </div>
    );
  }
}
