'use strict';

import Countdown from './classes/Countdown';
import {validate} from './helpers/util';

(() => {
	let orderForm = document.getElementsByClassName('order-form')[0];

	const init = () => {
		let countdown = new Countdown(new Date(2016, 4, 18, 20, 42)); // 18 mei 2016 om 20u42
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

		let firstName = document.getElementById('firstname');
		let lastName = document.getElementById('lastname');
		let email = document.getElementById('email');
		let phone = document.getElementById('phone');
		let password = document.getElementById('password');
		let passwordRepeat = document.getElementById('password_repeat');
		let schoolName = document.getElementById('school_name');
		let schoolEmail = document.getElementById('school_email');
		let schoolAddress = document.getElementById('school_address');
		let schoolWebsite = document.getElementById('school_website');

		var errors = 0;

		if(!validate(firstName)) {
			console.log('Invalid name');
			errors++;
		} if(!validate(lastName)) {
			console.log('Invalid lastname');
			errors++;
		} if(!validate(email)) {
			console.log('Invalid email');
			errors++;
		} if(!validate(phone)) {
			console.log('Invalid phone');
			errors++;
		} if(!validate(password)) {
			console.log('Invalid password');
			errors++;
		} else {
			if(password.value !== passwordRepeat.value) {
				console.log('Passwords don\'t match');
				errors++;
			}
		} if(!validate(schoolName)) {
			console.log('Invalid school name');
			errors++;
		} if(!validate(schoolEmail)) {
			console.log('Invalid school e-mail');
			errors++;
		} if(!validate(schoolAddress)) {
			console.log('Invalid school address');
			errors++;
		} if(!validate(schoolWebsite)) {
			console.log('Invalid website');
			errors++;
		}

		if(errors === 0) {
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
		}
		return true;
	};

	init();
})();
