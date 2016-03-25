'use strict';

import Request from './classes/Request';
import ErrorMessage from './classes/ErrorMessage';
import {api} from './helpers/globals';
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
    let errorMessages = document.getElementsByClassName('error');
    for(let i = 0; i < errorMessages.length; i++) {
      errorMessages[i].remove();
    }

    var errors = 0;

    // avoid unnecessary calls to api sending invalid data
    if(!validate(email)) {
      email.parentNode.appendChild(new ErrorMessage('Gelieve een geldig e-mailadres in te vullen'));
      errors++;
    } if(!validate(password)) {
      password.parentNode.appendChild(new ErrorMessage('Gelieve een wachtwoord in te vullen van minstens 5 tekens'));
      errors++;
    }

    if(errors === 0) {
      let formData = new FormData(loginForm);
      let request = new Request();
      request.post(`${api}/teachers/auth`, formData);
      request.on('loaded', (response) => {
        if(response) {
          window.location = `${window.app.basename}/klas`;
        } else {
          loginForm.appendChild(new ErrorMessage('Er is iets mis gegaan tijdens je aanvraag, probeer later opnieuw. Het is mogelijk dat je account nog niet geactiveerd is.'));
        }
      });
    }
    return true;
  };

  init();
})();
