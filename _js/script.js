'use strict';

import Countdown from './classes/Countdown';

const init = () => {
	let countdown = new Countdown(new Date(2016, 4, 18, 20, 0, 0)); // 18 mei 2016 om 20u00
	countdown.when();
};

init();
