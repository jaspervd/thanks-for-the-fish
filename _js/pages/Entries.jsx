'use strict';

import React, {Component} from 'react';
import fetch from 'isomorphic-fetch';

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
    fetch(`${basename}/api/classes`)
      .then(checkStatus)
      .then(r => r.json())
      .then(data => {
        //add key properties
        data.forEach(o => o.key = o.id);
        this.setState({oneliners: data, onelinersFetched: true});
      })
      .catch(() => {
        console.error('failed to get oneliners');
      });
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
