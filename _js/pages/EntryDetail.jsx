'use strict';

import React, {Component} from 'react';
//import fetch from 'isomorphic-fetch';
import {basename} from '../globals';
import {EntryItem} from '../components';

export default class EntryDetail extends Component {

  static contextTypes = {
    router: React.PropTypes.object.isRequired
  };

  constructor(props, context){
    super(props, context);
    this.state = {};
    console.log('Test');
  }

  componentDidMount(){
    //use entry from props, or do we need to fetch first?
    if(!this.props.entriesFetched) {
      console.log('No Entry');
      return;
    }
    this.setEntryState(this.props);
  }

  setEntryState(props) {
    let id = props.params.id;
    let entry = find(props.entries, e => {
      console.log('Entry?', e);
      return e.id === id;
    });
    if(!entry) {
      console.log('No Entry 2');
      this.context.router.push('/');
      return;
    }
    this.setState({entry});
    if(!entry.votesFetched) {
      this.props.fetchVotesForEntry(entry.id);
    }
  }

  render() {

    let {nickname} = this.state;

    return (
      <section className="admin-page">
        <header><h1 className="page-header">Boekbespreking Klas: nickname</h1></header>
        <div className="page-content">

        </div>
      </section>
    );

  }

}
