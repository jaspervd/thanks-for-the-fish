'use strict';

import React, {Component} from 'react';

import {Link} from 'react-router';

export default class NavOptions extends Component {

  constructor(props, context){

    super(props, context);

  }

  renderNavOptions(){

    let {navOptions} = this.props;
    //console.log('navOptions:', navOptions);

    return navOptions.map((navOption, i) => {

      console.log('NavOption', navOption);

      return <li><Link
        id={i} key={i}
        to={navOption.to}
      >{navOption.optionName}</Link></li>;

    });

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
