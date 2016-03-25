'use strict';

import Request from './classes/Request';
import ErrorMessage from './classes/ErrorMessage';
import {validate} from './helpers/util';
import {api} from './helpers/globals';

(() => {
	let loginForm = document.getElementsByClassName('login-form')[0];

	const init = () => {
    loginForm.addEventListener('submit', loginHandler);
  };

  const loginHandler = (e) => {
    e.preventDefault();

    let login = document.getElementById('admin-login');
    let password = document.getElementById('admin-password');
    let errorMessages = document.getElementsByClassName('error');
    for(let i = 0; i < errorMessages.length; i++) {
      errorMessages[i].remove();
    }

    var errors = 0;

		// avoid unnecessary calls to api sending invalid data
		if(!validate(login)) {
			login.parentNode.appendChild(new ErrorMessage('Gelieve een geldige gebruikersnaam of e-mailadres in te vullen'));
			errors++;
		} if(!validate(password)) {
			password.parentNode.appendChild(new ErrorMessage('Gelieve een wachtwoord in te vullen van minstens 5 tekens'));
			errors++;
		}

		if(errors === 0) {
			let formData = new FormData(loginForm);
			let request = new Request();
			request.post(`${api}/admin/auth`, formData);
      request.on('loaded', (response) => {
        if (response) {
         window.location = `${window.app.basename}/admin`;
       } else {
         loginForm.appendChild(new ErrorMessage('Dit account is geen beheerder of jurylid.'));
       }
     });
   }
   return true;
 };

 init();
})();
