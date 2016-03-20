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
		let review = document.getElementById('review');

		var errors = 0;

		if(!validate(nickname)) {
			console.log('Invalid nickname');
			errors++;
		} if(!validate(photo)) {
			console.log('Invalid photo');
			errors++;
		} if(!validate(review)) {
			console.log('Invalid review');
			errors++;
		}

		if(errors === 0) {
			let formData = new FormData(classForm);
			let request = new XMLHttpRequest();
			request.open('POST', `${window.app.basename}/api/class`, true);
			request.onload = function() {
				if (request.status === 201) {
					console.log('Klas toegevoegd!');
				} else {
					console.log('Fout');
				}
			};

			request.send(formData);
		}
		return true;
	};

	init();
})();