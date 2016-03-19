'use strict';

import Countdown from './classes/Countdown';
import {validate} from './helpers/util';

(() => {
	let container = document.getElementsByClassName('container')[0];
	let orderForm = document.getElementsByClassName('order-form')[0];
	let navLeft = document.getElementsByClassName('nav-left')[0];
	let navRight = document.getElementsByClassName('nav-right')[0];
	let pages = document.getElementsByClassName('page');
	let currentPage = 0;

	const init = () => {
		let countdown = new Countdown(new Date(2016, 4, 18, 20, 42)); // 18 mei 2016 om 20u42
		countdown.start();

		countdown.on('tick', () => {
			document.getElementsByClassName('countdown-days')[0].innerHTML = countdown.days;
			document.getElementsByClassName('countdown-hours')[0].innerHTML = countdown.hours;
			document.getElementsByClassName('countdown-minutes')[0].innerHTML = countdown.minutes;
			document.getElementsByClassName('countdown-seconds')[0].innerHTML = countdown.seconds;
		});

		navLeft.addEventListener('click', navLeftHandler);
		navRight.addEventListener('click', navRightHandler);
		document.addEventListener('keydown', keyPressHandler);
		orderForm.addEventListener('submit', orderHandler);
	};

	const navLeftHandler = (e) => {
		e.preventDefault();
		currentPage--;
		changeToCurrentPage();
	};

	const navRightHandler = (e) => {
		e.preventDefault();
		currentPage++;
		changeToCurrentPage();
	};

	const keyPressHandler = (e) => {
		var key = e.which || e.keyCode;
		if(e.target.tagName !== 'FORM' && typeof e.target.form === 'undefined') { // ignore events bubbling from forms
			switch(key) {
				case 80:
				case 37:
					navLeftHandler(e);
					break;
				case 78:
				case 39:
					navRightHandler(e);
					break;
			}
		}
	};

	const changeToCurrentPage = () => {
		window.scroll(0, 0); // reset user's scroll position
		if(currentPage < 0) {
			currentPage = 0;
		} else if(currentPage > (pages.length - 1)) {
			currentPage = pages.length - 1;
		}

		container.className = `container page-${currentPage}`;
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
