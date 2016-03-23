'use strict';

import React, {Component} from 'react';
import {validate} from '../helpers/util';

export default class AdminForm extends Component {

  constructor(props, context){

    super(props, context);

  }

  submitHandler(event){
    event.preventDefault();
    let {adminUsername, adminEmail, adminRoleId, adminForm} = this.refs;
    if(validate(adminUsername) && validate(adminEmail)){
      let adminData = new FormData(adminForm);
      let admin = {
        username: adminUsername.value,
        key: Date.now(),
        email: adminEmail.value,
        role_id: adminRoleId.value
      };
      this.props.addAdmin(admin, adminData);
      console.log('Adding new Admin', admin);
    }
  }

  render(){

    return (
      <section className="page-section add-admin">
        <header className="hidden"><h1>Admin Form</h1></header>
        <form className="admin-form" onSubmit={ e => this.submitHandler(e) } ref="adminForm">
          <input type="text" name="username" id="admin-username" ref="adminUsername" placeholder="username" required />
          <input type="email" name="email" id="admin-email" ref="adminEmail" placeholder="email adress" required />
          <select name="role_id" ref="adminRoleId">
            <option value="2">Jury</option>
            <option value="1">Admin</option>
          </select>
          <input type="submit" name="submit" value="Voeg Toe"/>
        </form>
      </section>
    );

  }

}
