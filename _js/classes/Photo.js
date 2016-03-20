'use strict';

export default class Photo {
	constructor(data) {
		let listItem = document.createElement('li');
        let image = document.createElement('img');
        image.setAttribute('alt', `${data.nickname}`);
        image.setAttribute('title', `${data.nickname}`);
        image.setAttribute('src', `${window.app.basename}/${data.photo}`);
        listItem.appendChild(image);
        return listItem;
	}
}
