'use strict';

import {validate} from './helpers/util';
import fetch from 'isomorphic-fetch';
//import {checkStatus} from './helpers/util';

(() => {
	let loginForm = document.getElementsByClassName('login-form')[0];

	const init = () => {

    loginForm.addEventListener('submit', loginHandler);

	};

  //fetch does not work, even with credentials, using XMLHttpRequest() instead
  /*const loginHandler = (e) => {
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
      fetch(`${window.app.basename}/api/admin/auth`, {
        method: 'POST',
        body: formData,
        headers: new Headers({'Content-Type': 'application/json'}),
        credentials: 'include'
      })
      .then(response => {
        if (response.status >= 200 && response.status < 300) {
          window.location = `${window.app.basename}/admin`;
        }
        let error = new Error(response.statusText);
        error.response = response;
        throw error;
      })
      .catch(() => {
        console.error('failed to login admin');
      });
    }
    return true;
  };/**/

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
      request.withCredentials = true;
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
	};/**/

	init();
})();
