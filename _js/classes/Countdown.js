'use strict';

export default class Countdown {
	constructor(endDate) {
		this.endDate = endDate;
	}

	when() {
		console.log(this.endDate);
	}
}
