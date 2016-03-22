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

    let {nickname, entry, photo, num_students, avg_score, num_votes} = this.state;

    return (
      <section className="admin-page">
        <header><h1 className="page-header">{nickname} | {num_students} leerlingen | Gem. Score: {avg_score}</h1></header>
        <div className="page-content entry-detail">
          <section className="page-section entry-text">
            <header className="hidden"><h1>Klassikale Boekbespreking van {nickname}</h1></header>
            <p>{entry}</p>
          </section>
        </div>
      </section>
    );

  }

}
