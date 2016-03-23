'use strict';

import React, {Component} from 'react';

export default class AdminItem extends Component {

  constructor(props, context){

    super(props, context);

  }

  deleteClicked(event){
    event.preventDefault();
    let confirmed = confirm('Verwijder admin?');
    if(confirmed){
      this.props.deleteAdmin(this.props.id);
    }
  }

  renderDeleteButton(){

    let {role_name} = this.props;

    if(role_name === 'jury'){
      return (
        <a href="#" className="delete-btn" onClick={ e => this.deleteClicked(e) }>X</a>
      );
    }

  }

  render(){

    let {username, email, role_name} = this.props;

    return (
      <li className="admin-item">
        <span className="admin-name">{username}</span>
        <span className="admin-email">{email}</span>
        <span className="admin-role">{role_name}</span>
        {this.renderDeleteButton()}
      </li>
    );

  }

}
