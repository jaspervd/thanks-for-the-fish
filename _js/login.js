'use strict';

import {validate} from './helpers/util';

(() => {
	let loginForm = document.getElementsByClassName('login-form')[0];

	const init = () => {
		loginForm.addEventListener('submit', loginHandler);
	};

	const loginHandler = (e) => {
		e.preventDefault();

		let email = document.getElementById('login-email');
		let password = document.getElementById('login-password');

		var errors = 0;

		// avoid unnecessary calls to api sending invalid data
		if(!validate(email)) {
			console.log('Invalid email');
			errors++;
		} if(!validate(password)) {
			console.log('Invalid password');
			errors++;
		}

		if(errors === 0) {
			let formData = new FormData(loginForm);
			let request = new XMLHttpRequest();
			request.open('POST', `${window.app.basename}/api/teachers/auth`, true);
			request.onload = function() {
				if (request.status === 200) {
					window.location = `${window.app.basename}/klas`;
				} else {
					console.log('Fout (+ melding: het is mogelijk dat je account nog niet geactiveerd is)');
				}
			};

			request.send(formData);
		}
		return true;
	};

	init();
})();
