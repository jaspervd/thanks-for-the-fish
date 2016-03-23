'use strict';

import React, {Component} from 'react';

import {Link} from 'react-router';

export default class EntryItem extends Component {

  constructor(props, context){

    super(props, context);

  }

  render(){

    let {id, nickname, num_students, avg_score, num_votes} = this.props;

    return (
      <li className="entry-item">
        <Link to={`/admin/entries/${id}`}>
          <span className="class-nickname">{nickname}</span>
          <span className="class-students">{num_students} studenten</span>
          <span className="class-avg-score">{avg_score} ({num_votes} stemmen)</span>
        </Link>
      </li>
    );

  }

}
