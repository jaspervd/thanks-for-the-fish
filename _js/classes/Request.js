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
    let request = new XMLHttpRequest();
    request.open('POST', url, true);
    request.onload = function() {
      return (request.status >= 200 && request.status < 300);
    };
    request.send(data);
  }
}
