'use strict';

import React from 'react';
import {Link} from 'react-router';
import {basename} from '../globals';
//import {find, filter} from 'lodash';

import {NavOptions} from '../components/';

export default class App extends React.Component {

  constructor(props, context) {
    super(props, context);
    this.state = {
      admin: [],
      navOptions: [],
      adminFetched: false,
      entries: [],
      entriesFetched: false,
      teachers: [],
      teachersFetched: false,
      admins: [],
      adminsFetched: false
    };
    this.logoutLink = `${window.app.basename}/api/admin/auth/logout`;
  }

  componentDidMount(){
    let request = new XMLHttpRequest();
    request.open('GET', `${basename}/api/admin`, true);
    request.onload = ($data) => {
      if (request.status === 200) {
        let adminData = JSON.parse($data.target.response);
        let navOptions = this.resolveAdminOptions(adminData);
        this.setState({
          admin: adminData, navOptions: navOptions, adminFetched: true,
          entries: [], entriesFetched: false,
          teachers: [], teachersFetched: false,
          admins: [], adminsFetched: false
        });
        console.log(`[App] Logged in as \"${this.state.admin.username}\"`);
      } else {
        window.location = `${window.app.basename}/admin-login`;
      }
    };
    request.send();
  }

  resolveAdminOptions(admin){
    let navOptions = [];
    if(admin.can_create_admins === 1){
      navOptions.push({'id': 1, 'to': '/admin/admins', 'optionName': 'Admins'});
      this.fetchAdmins();
    }
    if(admin.can_authorize_teachers === 1){
      navOptions.push({'id': 2, 'to': '/admin/teachers', 'optionName': 'Gebruikers'});
      this.fetchTeachers();
    }
    if(admin.can_vote_winner === 1 || admin.can_approve_entry === 1){
      navOptions.push({'id': 3, 'to': '/admin/entries', 'optionName': 'Inzendingen'});
      this.fetchEntries();
    }
    return navOptions;
  }

  fetchAdmins(){
    let request = new XMLHttpRequest();
    request.open('GET', `${basename}/api/admins`, true);
    request.onload = ($data) => {
      if (request.status === 200) {
        let admins = JSON.parse($data.target.response);
        admins.forEach(a => a.key = a.id);
        let {admin, navOptions, adminFetched, entries, entriesFetched, teachers, teachersFetched} = this.state;
        this.setState({
          admin: admin, navOptions: navOptions, adminFetched: adminFetched,
          entries: entries, entriesFetched: entriesFetched,
          teachers: teachers, teachersFetched: teachersFetched,
          admins: admins, adminsFetched: true
        });
        console.log(`[App] Succesfully fetched admins`);
      } else {
        console.log(`[App] Could not retrieve admins`);
        //window.location = `${window.app.basename}/admin-login`;
      }
    };
    request.send();
  }

  fetchTeachers(){
    let request = new XMLHttpRequest();
    request.open('GET', `${basename}/api/teachers`, true);
    request.onload = ($data) => {
      if (request.status === 200) {
        let teachers = JSON.parse($data.target.response);
        teachers.forEach(t => t.key = t.id);
        let {admin, navOptions, adminFetched, entries, entriesFetched, admins, adminsFetched} = this.state;
        this.setState({
          admin: admin, navOptions: navOptions, adminFetched: adminFetched,
          entries: entries, entriesFetched: entriesFetched,
          teachers: teachers, teachersFetched: true,
          admins: admins, adminsFetched: adminsFetched
        });
        console.log(`[App] Succesfully fetched teachers`);
      } else {
        console.log(`[App] Could not retrieve teachers`);
        //window.location = `${window.app.basename}/admin-login`;
      }
    };
    request.send();
  }

  fetchEntries(){
    let request = new XMLHttpRequest();
    request.open('GET', `${basename}/api/classes`, true);
    request.onload = ($data) => {
      if (request.status === 200) {
        let entries = JSON.parse($data.target.response);
        entries.forEach(e => e.key = e.id);
        let {admin, navOptions, adminFetched, teachers, teachersFetched, admins, adminsFetched} = this.state;
        this.setState({
          admin: admin, navOptions: navOptions, adminFetched: adminFetched,
          entries: entries, entriesFetched: true,
          teachers: teachers, teachersFetched: teachersFetched,
          admins: admins, adminsFetched: adminsFetched
        });
        console.log(`[App] Succesfully fetched entries`);
      } else {
        console.log(`[App] Could not retrieve entries`);
        //window.location = `${window.app.basename}/admin-login`;
      }
    };
    request.send();
  }

  render() {

    let {admin, adminFetched, navOptions, entries, entriesFetched, teachers, teachersFetched, admins, adminsFetched} = this.state;

    return (
      <div className='admin-workspace'>
        <header className='admin-header'>
          <h1><Link to='admin' >Welkom, {this.state.admin.username}</Link></h1>
          <NavOptions navOptions={navOptions} />
          <a className='logout-btn' href={this.logoutLink}>Uitloggen</a>
        </header>
        {this.props.children && React.cloneElement(this.props.children, {
          admin: admin,
          adminFetched: adminFetched,
          entries: entries,
          entriesFetched: entriesFetched,
          teachers: teachers,
          teachersFetched: teachersFetched,
          admins: admins,
          adminsFetched: adminsFetched
        })}
      </div>
    );

  }
}
