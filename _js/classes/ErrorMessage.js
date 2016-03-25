'use strict';

export default class ErrorMessage {
  constructor(content) {
    let span = document.createElement('span');
    span.className = 'error';
    span.innerHTML = content;

    return span;
  }
}
