'use strict';

import Request from './classes/Request';
import Photo from './classes/Photo';
import ErrorMessage from './classes/ErrorMessage';
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
      if(json.length > 0) {
        photosContainer.innerHTML = '';

        for(let photoData of json) {
          let photo = new Photo(photoData);
          photosContainer.appendChild(photo);
        }
      }
    });
  };

  const classHandler = (e) => {
    e.preventDefault();

    let nickname = document.getElementById('nickname');
    let photo = document.getElementById('photo');
    let entry = document.getElementById('entry');
    let numStudents = document.getElementById('num_students');
    let errorMessages = document.getElementsByClassName('error');
    let valid = document.getElementsByClassName('valid')[0];
    for(let i = 0; i < errorMessages.length; i++) {
      errorMessages[i].remove();
    }

    var errors = 0;

    if(!validate(nickname)) {
      nickname.parentNode.appendChild(new ErrorMessage('Gelieve een nickname in te vullen'));
      errors++;
    } if(!validate(photo)) {
      photo.parentNode.appendChild(new ErrorMessage('Gelieve een klasfoto up te loaden'));
      errors++;
    } if(!validate(entry)) {
      entry.parentNode.appendChild(new ErrorMessage('Gelieve je boekbespreking in te vullen'));
      errors++;
    } if(!validate(numStudents)) {
      numStudents.parentNode.appendChild(new ErrorMessage('Gelieve een geldig getal in te vullen'));
      errors++;
    }

    if(errors === 0) {
      let formData = new FormData(classForm);
      let request = new Request();
      request.post(`${api}/classes`, formData);
      request.on('loaded', (response) => {
        if(response) {
          nickname.value = '';
          photo.value = '';
          entry.value = '';
          numStudents.value = '';
          valid.className = 'text valid';
        } else {
          valid.className = 'text valid hide';
          classForm.appendChild(new ErrorMessage('Er is iets mis gegaan tijdens je aanvraag, probeer later opnieuw.'));
        }
      });
    }
    return true;
  };

  init();
})();
