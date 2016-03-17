'use strict';

import Countdown from './classes/Countdown';

const init = () => {
	let countdown = new Countdown(new Date(2016, 4, 18, 20, 0, 0)); // 18 mei 2016 om 20u00
	countdown.start();

	countdown.on('tick', () => {
		document.getElementsByClassName('countdown-days')[0].innerHTML = countdown.days;
		document.getElementsByClassName('countdown-hours')[0].innerHTML = countdown.hours;
		document.getElementsByClassName('countdown-minutes')[0].innerHTML = countdown.minutes;
		document.getElementsByClassName('countdown-seconds')[0].innerHTML = countdown.seconds;
	});
};

init();
