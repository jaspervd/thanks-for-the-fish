'use strict';

import 'lodash';

import Countdown from './classes/Countdown';
import Photo from './classes/Photo';
import Request from './classes/Request';
import {validate, scrollTo, inString, getNumber} from './helpers/util';
import {api} from './helpers/globals';

(() => {
  let wrapper = document.getElementsByClassName('wrapper')[0]; // getElementsByClassName is faster than querySelectorAll
  let container = document.getElementsByClassName('container')[0];
  let logo = document.getElementsByClassName('logo')[0];
  let campaignWrapper = document.getElementsByClassName('campaign-wrapper')[0];
  let toggleOrder = document.getElementsByClassName('toggle-order');
  let orderForm = document.getElementsByClassName('order-form')[0];
  let navLeft = document.getElementsByClassName('nav-left')[0];
  let navRight = document.getElementsByClassName('nav-right')[0];
  let navDown = document.getElementsByClassName('nav-down');
  let navMenu = document.getElementsByClassName('nav-menu');
  let menu = document.getElementsByClassName('menu')[0];
  let menuToggle = document.getElementsByClassName('menu-toggle')[0];
  let pages = document.getElementsByClassName('page');
  let pageContents = document.getElementsByClassName('page-content');
  let photosContainer = document.getElementsByClassName('photos-container')[0];
  let photosSearch = document.getElementsByClassName('photos-search')[0];
  let noPhotosFound = document.getElementsByClassName('no-photos-found')[0];
  let addClass = document.getElementsByClassName('add-class')[0];
  let moveLayers = document.getElementsByClassName('move-layer');
  let photosArray;
  let currentPage = 0;
  let menuState = false; // false = closed, true = open
  let snapState = false; // false = not snapped, true = snapped
  let orderState = false; // false = not in view, true = in view

  const init = () => {
    let countdown = new Countdown(new Date(2016, 4, 18, 20, 42)); // 18 mei 2016 om 20u42
    countdown.start();

    countdown.on('tick', () => {
      document.querySelector('.countdown-days span').innerHTML = countdown.days;
      document.querySelector('.countdown-hours span').innerHTML = countdown.hours;
      document.querySelector('.countdown-minutes span').innerHTML = countdown.minutes;
      document.querySelector('.countdown-seconds span').innerHTML = countdown.seconds;
    });

    navLeft.addEventListener('click', navLeftHandler);
    navRight.addEventListener('click', navRightHandler);
    document.addEventListener('keydown', keyPressHandler);
    orderForm.addEventListener('submit', orderHandler);
    menuToggle.addEventListener('click', menuToggleHandler);
    photosSearch.addEventListener('keydown', photosSearchHandler);
    photosSearch.addEventListener('blur', photosSearchHandler);
    wrapper.addEventListener('scroll', scrollHandler);
    addClass.addEventListener('click', addClassHandler);
    window.addEventListener('mousemove', mouseMoveHandler);

    for(let i = 0; i < toggleOrder.length; i++) {
      toggleOrder[i].addEventListener('click', toggleOrderHandler);
    }

    for(let i = 0; i < navDown.length; i++) {
      navDown[i].addEventListener('click', navDownHandler);
    }

    for(let i = 0; i < navMenu.length; i++) {
      navMenu[i].addEventListener('click', navMenuHandler);
    }

    loadPhotos();
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

  const navDownHandler = (e) => {
    e.preventDefault();
    if(e.target.parentNode.className !== 'nav-down participate') {
      e.target.parentNode.className = 'nav-down button clicked';
      setTimeout(() => {
        e.target.parentNode.className = 'nav-down button hide';
      }, 1000);
      setTimeout(() => {
        e.target.parentNode.className = 'nav-down button';
      }, 2000);
    }
    scrollTo(wrapper, wrapper.scrollTop, window.innerHeight, 1000, 600);
  };

  const navMenuHandler = (e) => {
    e.preventDefault();
    currentPage = getNumber(e.target.hash); // gets the number from a hash like #page-0
    changeToCurrentPage();
  };

  const addClassHandler = (e) => {
    e.preventDefault();
    currentPage = getNumber(e.target.hash);
    changeToCurrentPage();
    setTimeout(() => {
      scrollTo(wrapper, 0, window.innerHeight, 1000);
    }, 1500);
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
    if(currentPage < 0) {
      currentPage = 0;
    } else if(currentPage > (pages.length - 1)) {
      currentPage = pages.length - 1;
    }

    for(let i = 0; i < pageContents.length; i++) {
      pageContents[i].className = 'page-content';
    }
    pageContents[currentPage].className = 'page-content active';

    for(let i = 0; i < navMenu.length; i++) {
      navMenu[i].className = 'nav-menu button';
    }
    navMenu[currentPage].className += ' active';

    if(wrapper.scrollTop > 0) {
      scrollTo(wrapper, wrapper.scrollTop, 0, 500);
      container.className = `container delay page-${currentPage}`;
    } else {
      container.className = `container animate page-${currentPage}`;
    }
  };

  const menuToggleHandler = (e) => {
    e.preventDefault();
    menuState = !menuState;
    menu.className = (menuState? 'menu open' : 'menu closed');
    menu.className += (snapState? ' snap' : '');
  };

  const toggleOrderHandler = (e) => {
    e.preventDefault();
    orderState = !orderState;
    console.log(orderState);

    campaignWrapper.className = 'campaign-wrapper ';
    campaignWrapper.className += (orderState? 'hide' : 'show');

    orderForm.parentNode.className = 'order ';
    orderForm.parentNode.className += (orderState? 'show' : 'hide');
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

  const photosSearchHandler = () => {
    if(photosSearch.value.length > 3) {
      photosContainer.innerHTML = '';
      let filteredArray = photosArray.filter(photo => inString(photo.nickname, photosSearch.value));
      if(filteredArray.length === 0) {
        noPhotosFound.className = 'text';
      } else {
        noPhotosFound.className = 'text hide';
        for(let photoData of filteredArray) {
          let photo = new Photo(photoData);
          photosContainer.appendChild(photo);
        }
      }
    }
  };

  const scrollHandler = () => {
    let prevState = snapState;
    if(wrapper.scrollTop > window.innerHeight) {
      if(!snapState) {
        logo.className = 'logo snap';
        menu.className = 'menu snap';
      }
      snapState = true;
    } else {
      if(snapState) {
        logo.className = 'logo';
        menu.className = 'menu';
      }
      snapState = false;
    }

    if(prevState !== snapState) {
      menu.className += (menuState? ' open' : ' closed');
    }
  };

  const loadPhotos = () => {
    let request = new Request();
    request.get(`${api}/classes`);
    request.on('loaded', (json) => {
      photosArray = json;
      for(let photoData of photosArray) {
        let photo = new Photo(photoData);
        photosContainer.appendChild(photo);
      }
    });
  };

  const mouseMoveHandler = (e) => {
    if(wrapper.scrollTop < window.innerHeight) {
      var pageX = e.pageX - (window.innerWidth / 2);
      var pageY = e.pageY - (window.innerHeight / 2);
      var strength = 20;
      var previous = moveLayers[0];

      for(let i = 0; i < moveLayers.length; i++) {
        if(previous.parentNode === moveLayers[i].parentNode) { // reset strength on each screen
          strength *= 1.25;
        } else {
          strength = 20;
        }
        moveLayers[i].style.marginLeft = `${(strength / window.innerWidth * pageX * -1)}px`;
        moveLayers[i].style.marginTop = `${(strength / window.innerHeight * pageY * -1)}px`;
        previous = moveLayers[i];
      }
    }
  };

  init();
})();
