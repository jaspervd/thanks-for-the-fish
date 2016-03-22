'use strict';

import React, {Component} from 'react';
import {find} from 'lodash';

export default class EntryDetail extends Component {

  static contextTypes = {
    router: React.PropTypes.object.isRequired
  };

  constructor(props, context){
    props.params.id = parseInt(props.params.id);
    super(props, context);
    this.state = {
      id: 0,
      creator_id: 0,
      nickname: '',
      num_students: 0,
      photo: '',
      entry: '',
      avg_score: 0,
      num_votes: 0,
      key: 0
    };
  }

  componentDidMount(){
    //use entries from props, or do a fetch first?
    if(!this.props.entriesFetched) {
      return;
    }
    this.setEntryState(this.props);
  }

  componentWillReceiveProps(newProps) {
    this.setEntryState(newProps);
  }

  setEntryState(props) {
    let id = props.params.id;
    let entry = find(props.entries, e => {
      return e.id === id;
    });
    if(!entry) {
      this.context.router.push('/admin');
      return;
    }
    this.setState(entry);
  }

  renderEntryOptions(){



  }

  render() {

    let {nickname, entry, photo, num_students, avg_score, num_votes, school_name, firstname, lastname} = this.state;
    let photoPath = `/assets/img/klasfotos/${photo}`;

    return (
      <section className="admin-page">
        <header><h1 className="page-header">{nickname} | Gemiddelde Score: {avg_score}</h1></header>
        <div className="page-content entry-detail">
          <section className="page-section entry-text">
            <header className="hidden"><h1>Klassikale Boekbespreking van {nickname}</h1></header>
            <p>{entry}</p>
          </section>
          <section className="page-section entry-data">
            <img src={photoPath} alt={photo}/>
            <div className="class-data">
              <span className="class-nickname">Klasnaam: {nickname}</span>
              <span className="class-students">{num_students} studenten</span>
              <span className="class-school">School: {school_name}</span>
              <span className="class-teacher">Leerkracht: {firstname} {lastname}</span>
              <span className="class-average">Gemiddelde score van {avg_score} ({num_votes} stemmen)</span>
            </div>
          </section>
        </div>
      </section>
    );

  }

}
