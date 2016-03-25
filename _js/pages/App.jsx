'use strict';

import React from 'react';
import {Link} from 'react-router';
import {find, filter} from 'lodash';
import {NavOptions} from '../components/';
import {api} from '../helpers/globals';

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
    request.open('GET', `${window.app.basename}/api/admin`, true);
    request.withCredentials = true;
    request.onload = ($data) => {
      if (request.status === 200) {
        let adminData = JSON.parse($data.target.response);
        adminData.can_create_admins = parseInt(adminData.can_create_admins);
        adminData.can_authorize_teachers = parseInt(adminData.can_authorize_teachers);
        adminData.can_vote_winner = parseInt(adminData.can_vote_winner);
        adminData.can_approve_entry = parseInt(adminData.can_approve_entry);
        let navOptions = this.resolveAdminOptions(adminData);
        this.setState({admin: adminData, navOptions: navOptions, adminFetched: true});
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
      navOptions.push({'id': 2, 'to': '/admin/teachers', 'optionName': 'Docenten'});
      this.fetchTeachers();
    }
    if(admin.can_vote_winner === 1 || admin.can_approve_entry === 1){
      navOptions.push({'id': 3, 'to': '/admin/entries', 'optionName': 'Inzendingen'});
      this.fetchEntries();
    }
    console.log('navOptions', navOptions, admin);
    return navOptions;
  }

  fetchAdmins(){
    let request = new XMLHttpRequest();
    request.open('GET', `${api}/admins`, true);
    request.withCredentials = true;
    request.onload = ($data) => {
      if (request.status === 200) {
        let admins = JSON.parse($data.target.response);
        admins.forEach(a => a.key = a.id);
        this.setState({
          admins: admins, adminsFetched: true
        });
        console.log(`[App] Succesfully fetched admins`);
      } else {
        console.log(`[App] Could not retrieve admins`);
      }
    };
    request.send();
  }

  fetchTeachers(){
    let request = new XMLHttpRequest();
    request.open('GET', `${api}/teachers`, true);
    request.withCredentials = true;
    request.onload = ($data) => {
      if (request.status === 200) {
        let teachers = JSON.parse($data.target.response);
        teachers.forEach(t => t.key = t.id);
        this.setState({
          teachers: teachers, teachersFetched: true
        });
        console.log(`[App] Succesfully fetched teachers`);
      } else {
        console.log(`[App] Could not retrieve teachers`);
      }
    };
    request.send();
  }

  fetchEntries(){
    let request = new XMLHttpRequest();
    request.open('GET', `${api}/classes`, true);
    request.withCredentials = true;
    request.onload = ($data) => {
      if (request.status === 200) {
        let entries = JSON.parse($data.target.response);
        entries.forEach(e => e.key = e.id);
        this.setState({
          entries: entries, entriesFetched: true
        });
        console.log(`[App] Succesfully fetched entries`);
      } else {
        console.log(`[App] Could not retrieve entries`);
      }
    };
    request.send();
  }

  approveTeacher(teacher_id) {
    let teachers = this.state.teachers.concat();
    let existingTeacher = find(teachers, o => o.id === teacher_id);
    if(!existingTeacher) {
      return;
    }
    existingTeacher.authorized = 1;
    this.setState({teachers});
    let request = new XMLHttpRequest();
    request.open('PUT', `${api}/teachers/${teacher_id}/approve`, true);
    request.withCredentials = true;
    request.onload = ($data) => {
      if (request.status === 200) {
        console.log(`[App] Succesfully approved teacher`, $data.respone);
      } else {
        console.log(`[App] Could not approve teacher`);
      }
    };
    request.send();
  }

  deleteTeacher(teacher_id) {
    let teachers = filter(this.state.teachers, o => o.id !== teacher_id);
    this.setState({teachers});
    let request = new XMLHttpRequest();
    request.open('DELETE', `${api}/teachers/${teacher_id}`, true);
    request.withCredentials = true;
    request.onload = ($data) => {
      if (request.status === 200) {
        console.log(`[App] Succesfully deleted teacher`, $data.respone);
      } else {
        console.log(`[App] Could not delete teacher`);
      }
    };
    request.send();
  }

  deleteAdmin(admin_id) {
    let admins = filter(this.state.admins, a => a.id !== admin_id);
    this.setState({admins});
    let request = new XMLHttpRequest();
    request.open('DELETE', `${api}/admins/${admin_id}`, true);
    request.withCredentials = true;
    request.onload = ($data) => {
      if (request.status === 200) {
        console.log(`[App] Succesfully deleted jury member`, $data.respone);
      } else {
        console.log(`[App] Could not delete jury member`);
      }
    };
    request.send();
  }

  addAdmin(admin, postData){
    let admins = this.state.admins.concat();
    admins.push(admin);
    this.setState({admins});
    let request = new XMLHttpRequest();
    request.open('POST', `${api}/admins`, true);
    request.onload = ($data) => {
      if (request.status === 200) {
        let newAdmin = JSON.parse($data.respone);
        let existingAdmin = find(this.state.admins, a => {
          return a.id === newAdmin.id;
        });
        if(existingAdmin) {
          existingAdmin.id = newAdmin.id;
          this.setState({admins: this.state.admins.concat()});
        }
        console.log(`[App] Succesfully added admin`);
      } else {
        console.log(`[App] Could not add admin`);
      }
    };
    request.send(postData);
  }

  render() {

    let {admin, adminFetched, navOptions, entries, entriesFetched, teachers, teachersFetched, admins, adminsFetched} = this.state;

    return (
      <div className='admin-workspace'>
        <header className='admin-header'>
          <h1><Link to='admin' >Welkom, {admin.username}</Link></h1>
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
          adminsFetched: adminsFetched,
          addAdminScoreForEntry: e => this.addAdminScoreForEntry(e),
          deleteTeacher: t => this.deleteTeacher(t),
          approveTeacher: t => this.approveTeacher(t),
          deleteAdmin: a => this.deleteAdmin(a),
          addAdmin: (a, pd) => this.addAdmin(a, pd)
        })}
      </div>
    );

  }
}
