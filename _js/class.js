'use strict';

import {validate} from './helpers/util';

(() => {
  let classForm = document.getElementsByClassName('class-form')[0];

  const init = () => {
    classForm.addEventListener('submit', classHandler);
  };

  const classHandler = (e) => {
    e.preventDefault();

    let nickname = document.getElementById('nickname');
    let photo = document.getElementById('photo');
    let entry = document.getElementById('entry');

    var errors = 0;

    if(!validate(nickname)) {
      console.log('Invalid nickname');
      errors++;
    } if(!validate(photo)) {
      console.log('Invalid photo');
      errors++;
    } if(!validate(entry)) {
      console.log('Invalid review');
      errors++;
    }

    if(errors === 0) {
      let formData = new FormData(classForm);
      let request = new Request();
      request.post(`${window.app.basename}/teachers/auth`, formData);
      request.on('loaded', (response) => {
        if(response) {
          console.log('Klas toegevoegd!');
        } else {
          console.log('Fout');
        }
      });
    }
    return true;
  };

  init();
})();
