'use strict';

import EventEmitter2 from '../../dependencies/eventemitter2/lib/eventemitter2';

export default class Request extends EventEmitter2 {
  constructor() {
    super({});
  }

  get(url) {
    let req = new XMLHttpRequest();
    req.open('GET', url, true);
    req.onload = () => {
      this.emit('loaded', JSON.parse(req.response));
    };
    req.send();
  }

  post(url, data) {
    let req = new XMLHttpRequest();
    req.open('POST', url, true);
    req.withCredentials = true;
    req.onload = () => {
      this.emit('loaded', (req.status >= 200 && req.status < 300));
    };
    req.send(data);
  }
}
