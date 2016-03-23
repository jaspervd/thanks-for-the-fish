'use strict';

export const validate = (input) => {
  let type = input.type;
  let value = input.value;

  if(type === 'text') {
    return (value.length > 0);
  } else if(type === 'password') {
    return (value.length > 6);
  } else if(type === 'email') {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(value);
  } else if(type === 'tel') {
    return (value.length > 8);
  } else if(type === 'url') {
    var parser = document.createElement('a');
    try {
      parser.href = value;
      return !!parser.hostname;
    } catch (e) {
      return false;
    }
  } else if(type === 'file') {
    return (value.length > 3);
  } else if(type === 'textarea') {
    return (value.length > 25);
  } else if(type === 'number') {
    return (!isNaN(value) && isFinite(value) && value > 0);
  }
  return false;
};

export const inString = (string, search) => {
  string = string.toLowerCase();
  search = search.toLowerCase();
  return (string.indexOf(search) !== -1);
};

export const scrollTo = (el, startPos, endPos, duration) => {
  var endTime = new Date(Date.now() + duration);
  var remaining = duration;
  function scroll() {
    let currentTime = new Date();
    let rate = remaining / duration;
    rate = 1 - Math.pow(rate, 3);
    el.scrollTop = (rate * (endPos - startPos) + startPos);
    if(currentTime < endTime) {
      window.requestAnimationFrame(scroll);
    }
    remaining = endTime - currentTime;
    console.log(el.scrollTop);
  }

  window.requestAnimationFrame(scroll);
};

export const checkStatus = (response) => {
  if (response.status >= 200 && response.status < 300) {
    return response;
  }
  let error = new Error(response.statusText);
  error.response = response;
  throw error;
};
