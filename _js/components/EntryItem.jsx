'use strict';

import React, {Component} from 'react';

import {Link} from 'react-router';

export default class EntryItem extends Component {

  constructor(props, context){

    super(props, context);

  }

  render(){

    let {id, nickname, avg_score} = this.props;

    return (
      <li className="entry-item">
        <Link to={`/admin/entries/${id}`}>
          <span className="class-avg-score">(Score: {avg_score})</span>
          <span className="class-nickname">{nickname}</span>
        </Link>
      </li>
    );

  }

}
