'use strict';

import Countdown from './classes/Countdown';

(() => {
	let orderForm = document.getElementsByClassName('order-form')[0];

	const init = () => {
		let countdown = new Countdown(new Date(2016, 4, 18, 20, 0, 0)); // 18 mei 2016 om 20u00
		countdown.start();

		countdown.on('tick', () => {
			document.getElementsByClassName('countdown-days')[0].innerHTML = countdown.days;
			document.getElementsByClassName('countdown-hours')[0].innerHTML = countdown.hours;
			document.getElementsByClassName('countdown-minutes')[0].innerHTML = countdown.minutes;
			document.getElementsByClassName('countdown-seconds')[0].innerHTML = countdown.seconds;
		});

		orderForm.addEventListener('submit', orderHandler);
	};

	const orderHandler = (e) => {
		e.preventDefault();

		let formData = new FormData(orderForm);

		let request = new XMLHttpRequest();
		request.open('POST', `${window.app.basename}/api/teachers`, true);
		request.onload = function() {
			if (request.status === 201) {
				console.log('Besteld!');
			} else {
				console.log('Fout');
			}
		};

		request.send(formData);
		return true;
	};

	init();
})();
