'use strict';

export const validate = (input) => {
  let type = input.type;
  let value = input.value;

  console.log(type, value);

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

export const scrollTo = (yPos) => {
  var i = 0;
  function scroll() {
    window.scroll(0, i);
    if(i < yPos) {
      window.requestAnimationFrame(scroll);
    }
    i += 20;
  }

  window.requestAnimationFrame(scroll);
};
