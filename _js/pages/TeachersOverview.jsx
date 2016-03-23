'use strict';

import React, {Component} from 'react';
import {TeacherItem} from '../components';

export default class TeachersOverview extends Component {

  static contextTypes = {
    router: React.PropTypes.object.isRequired
  };

  constructor(props, context){
    super(props, context);
    this.state = {};
  }

  renderTeachers(){
    if(this.props.teachersFetched){
      return this.props.teachers.map(teacher => {
        return <TeacherItem {...teacher} deleteTeacher={ id => this.props.deleteTeacher(id) } approveTeacher={ id => this.props.approveTeacher(id) } />;
      });
    }
  }

  render() {

    return (
      <section className="admin-page">
        <header><h1 className="page-header">Beheer Docenten:</h1></header>
        <div className="page-content">
          <section className="page-section teachers">
            <header className="hidden"><h1>Leerkrachten</h1></header>
            <div className="table-header">
              <span className="teacher-name">Docent</span>
              <span className="teacher-school">School</span>
              <span className="school-website">Schoolsite</span>
              <span className="delete-btn">Opties</span>
            </div>
            <ul>
              {this.renderTeachers()}
            </ul>
          </section>
        </div>
      </section>
    );

  }

}
