'use strict';

import React, {Component} from 'react';
import {AdminItem, AdminForm} from '../components';

export default class TeachersOverview extends Component {

  static contextTypes = {
    router: React.PropTypes.object.isRequired
  };

  constructor(props, context){
    super(props, context);
    this.state = {};
  }

  renderAdmins(){
    if(this.props.adminsFetched){
      return this.props.admins.map(admin => {
        if(admin.id !== this.props.admin.id){
          return <AdminItem {...admin} deleteAdmin={ id => this.props.deleteAdmin(id) } />;
        }
      });
    }
  }

  render() {

    return (
      <section className="admin-page">
        <header><h1 className="page-header">Beheer Admins:</h1></header>
        <div className="page-content">
          <AdminForm addAdmin={ (admin, postData) => this.props.addAdmin(admin, postData) } />
          <section className="page-section admins">
            <header className="hidden"><h1>Admins</h1></header>
            <div className="table-header">
              <span className="admin-name">Admin</span>
              <span className="admin-email">Email</span>
              <span className="admin-role">Rol</span>
            </div>
            <ul>
              {this.renderAdmins()}
            </ul>
          </section>
        </div>
      </section>
    );

  }

}
