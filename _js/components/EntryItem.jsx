'use strict';

import React, {Component} from 'react';

import {Link} from 'react-router';

export default class EntryItem extends Component {

  constructor(props, context){

    super(props, context);

  }

  render(){

    let {id, nickname, num_students} = this.props;

    return (
      <li className="entry-item">
        <Link to={`/admin/entries/${id}`}>
          <span className="class-nickname">{nickname} ({num_students})</span>
        </Link>
      </li>
    );

  }

}
