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
  }
  return false;
};
