'use strict';

import React, {Component} from 'react';

import {Link} from 'react-router';

export default class NavOptions extends Component {

  constructor(props, context){

    super(props, context);

  }

  renderNavOptions(){

    let {navOptions} = this.props;

    if(navOptions){
      return navOptions.map((navOption, i) => {
        return <li id={i} key={i}><Link
          to={navOption.to}
        >{navOption.optionName}</Link></li>;
      });
    }

  }

  render(){

    return (
      <nav className='admin-nav'>
        <ul className="nav-options">
          {this.renderNavOptions()}
        </ul>
      </nav>
    );

  }

}
