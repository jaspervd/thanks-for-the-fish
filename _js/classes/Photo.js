'use strict';

export default class Photo {
  constructor(data) {
    let listItem = document.createElement('li');
    let figure = document.createElement('figure');
    let image = document.createElement('img');
    let caption = document.createElement('caption');
    image.setAttribute('alt', `${data.nickname}`);
    image.setAttribute('title', `${data.nickname}`);
    image.setAttribute('src', `${window.app.basename}/${data.photo}`);
    caption.innerHTML = `${data.nickname}`;

    figure.appendChild(image);
    figure.appendChild(caption);
    listItem.appendChild(figure);
    return listItem;
  }
}
