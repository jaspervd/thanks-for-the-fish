'use strict';

import Request from './classes/Request';
import Photo from './classes/Photo';
import {validate} from './helpers/util';
import {api} from './helpers/globals';

(() => {
  let classForm = document.getElementsByClassName('class-form')[0];
  let photosContainer = document.getElementsByClassName('photos-container')[0];

  const init = () => {
    classForm.addEventListener('submit', classHandler);
    getUserId();
  };

  const getUserId = () => {
    let request = new Request();
    request.get(`${api}/user/id`);
    request.on('loaded', (json) => {
      loadPhotos(json);
    });
  };

  const loadPhotos = (id) => {
    let request = new Request();
    request.get(`${api}/teachers/${id}/classes`);
    request.on('loaded', (json) => {
      for(let photoData of json) {
        let photo = new Photo(photoData);
        photosContainer.appendChild(photo);
      }
    });
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
