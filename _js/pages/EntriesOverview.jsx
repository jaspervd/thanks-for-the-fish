'use strict';

import React, {Component} from 'react';
import {EntryItem} from '../components';

export default class EntriesOverview extends Component {

  static contextTypes = {
    router: React.PropTypes.object.isRequired
  };

  constructor(props, context){
    super(props, context);
    this.state = {};
  }

  renderEntries(){
    if(this.props.entriesFetched){
      return this.props.entries.map(entry => {
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
            <div className="table-header">
              <span className="class-avg-score">Gemiddelde Score</span>
              <span className="class-students">Aantal Studenten</span>
              <span className="class-nickname">Klasnaam</span>
            </div>
            <ul>
              {this.renderEntries()}
            </ul>
          </section>
        </div>
      </section>
    );

  }

}
