'use strict';

export default class Countdown {
	constructor(endDate) {
		this.startDate = new Date();
		this.endDate = endDate;
	}

	start() {
		this.started = true;
		setInterval(this.tick, 1000);
	}

	tick() {

	}

	when() {
		console.log(this.endDate);
	}
}
