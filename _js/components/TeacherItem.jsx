'use strict';

import React, {Component} from 'react';

export default class TeacherItem extends Component {

  constructor(props, context){

    super(props, context);

  }

  approveClicked(event){
    event.preventDefault();
    this.props.approveTeacher(this.props.id);
  }

  deleteClicked(event){
    event.preventDefault();
    let confirmed = confirm('Bevestig verwijderen?');
    if(confirmed){
      this.props.deleteTeacher(this.props.id);
    }
  }

  renderApproveOption(){
    let {authorized} = this.props;
    authorized = parseInt(authorized);
    if(authorized === 0){
      return (
        <a href="#" className="approve-btn" ref="btnApprove" onClick={ e => this.approveClicked(e) }>Goedkeuren</a>
      );
    }
  }

  render(){

    let {firstname, lastname, school_name, school_website} = this.props;
    let school_href = `http://${school_website}`;

    return (
      <li className="teacher-item">
        <span className="teacher-name">{firstname} {lastname}</span>
        <span className="teacher-school">{school_name}</span>
        <a href={school_href} target="_blank" className="school-website">{school_website}</a>
        <a href="#" className="delete-btn" onClick={ e => this.deleteClicked(e) }>X</a>
        {this.renderApproveOption()}
      </li>
    );

  }

}
