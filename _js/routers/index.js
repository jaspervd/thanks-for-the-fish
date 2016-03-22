'use strict';

import React from 'react';
import {Router, Route, IndexRoute, useRouterHistory} from 'react-router';
import {createHistory} from 'history';

import {App, EntriesOverview, EntryDetail} from '../pages';
import {basename} from '../globals';

export default () => (

  <Router history={useRouterHistory(createHistory)({basename})}>

    <Route path="/admin" component={App}>
      <IndexRoute component={EntriesOverview} />
      <Route path="/admin/entries" component={EntriesOverview} />
      <Route path="/admin/entries/:id" component={EntryDetail} />
    </Route>

  </Router>

);

