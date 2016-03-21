'use strict';

import {validate} from './helpers/util';

(() => {
	let loginForm = document.getElementsByClassName('login-form')[0];

	const init = () => {

    loginForm.addEventListener('submit', loginHandler);

	};

	const loginHandler = (e) => {
		e.preventDefault();

		let login = document.getElementById('admin-login');
		let password = document.getElementById('admin-password');

		var errors = 0;

		// avoid unnecessary calls to api sending invalid data
		if(!validate(login)) {
			console.log('Admin not recognized');
			errors++;
		} if(!validate(password)) {
			console.log('Invalid password');
			errors++;
		}

		if(errors === 0) {
			let formData = new FormData(loginForm);
			let request = new XMLHttpRequest();
			request.open('POST', `${window.app.basename}/api/admin/auth`, true);
			request.onload = function() {
				if (request.status === 200) {
					window.location = `${window.app.basename}/admin`;
				} else {
					console.log('Admin account niet herkend, gelieve opnieuw te proberen.');
				}
			};
			request.send(formData);
		}
		return true;
	};

	init();
})();
