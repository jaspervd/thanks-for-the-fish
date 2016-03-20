'use strict';

import EventEmitter2 from '../../dependencies/eventemitter2/lib/eventemitter2';

export default class Countdown extends EventEmitter2 {
  constructor(endDate) {
    super({});
    this.now = new Date();
    this.endDate = endDate;
    this.days = 0;
    this.hours = 0;
    this.minutes = 0;
    this.seconds = 0;
  }

  start() {
    this.started = true;
    this.interval = setInterval(this.tick.bind(this), 1000);
  }

  stop() {
    this.started = false;
    clearInterval(this.interval);

    this.days = 0;
    this.hours = 0;
    this.minutes = 0;
    this.seconds = 0;
  }

  tick() {
    if(this.started) {
      this.now = new Date();
      this.difference = this.endDate - this.now;
      var remaining = this.difference;

      if(Math.floor(this.difference / 1000) === 0) {
        this.stop();
      } else {
        this.days = Math.floor(this.difference / (1000 * 60 * 60 * 24));
        remaining -= this.days * 1000 * 60 * 60 * 24;

        this.hours = Math.floor(remaining / (1000 * 60 * 60));
        remaining -= this.hours * 1000 * 60 * 60;

        this.minutes = Math.floor(remaining / (1000 * 60));
        remaining -= this.minutes * 1000 * 60;

        this.seconds = Math.floor(remaining / 1000);

        this.emit('tick');
      }
    }
  }
}
