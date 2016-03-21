'use strict';

import React, {Component} from 'react';
//import fetch from 'isomorphic-fetch';
import {basename} from '../globals';
import {EntryItem} from '../components';

export default class Entries extends Component {

  static contextTypes = {
    router: React.PropTypes.object.isRequired
  };

  constructor(props, context){
    super(props, context);
    this.state = {
      entries: [],
      entriesFetched: false
    };
  }

  componentDidMount(){
    let request = new XMLHttpRequest();
    request.open('GET', `${basename}/api/classes`, true);
    request.onload = ($data) => {
      if (request.status === 200) {
        let entries = JSON.parse($data.target.response);
        entries.forEach(e => e.key = e.id);
        this.setState({entries: entries, entriesFetched: true});
        console.log('[Entries] Succesfully retrieved entries');
      } else {
        console.log('[Entries] Failed to retrieve entries');
      }
    };
    request.send();
  }

  renderEntries(){
    if(this.state.entriesFetched){
      return this.state.entries.map(entry => {
        return <EntryItem {...entry} deleteEntry={id => this.props.deleteEntry(id)} voteEntry={id => this.props.voteEntry(id)} />;
      });
    }
  }

  render() {

    return (
      <section className="admin-page">
        <header><h1 className="page-header">Overzicht Inzendingen:</h1></header>
        <div className="page-content">
          <section className="page-section entries">
            <header className="hidden"><h1>Inzendingen</h1></header>
            <ol>
              {this.renderEntries()}
            </ol>
          </section>
        </div>
      </section>
    );

  }

}
