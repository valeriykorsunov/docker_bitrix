// function successPost(data) {

// 	let html = $(data).find(".js-personal-service.b-personal-service").get(0).outerHTML;

// 	document.querySelector(".personal-area__left .personal-area__list").insertAdjacentHTML('afterbegin', `${html}`);
// 	APP.init();
// }


// function changeServiceAvailable(elem) {
// 	let data = {
// 		id: elem.dataset.id,
// 		updadeServiceAvailable: "y",
// 	};

// 	if (elem.checked == true) {
// 		data.updadeValue = 27;
// 		updadeServiceAvailable(data);
// 	}

// 	if (elem.checked == false) {
// 		data.updadeValue = 0;
// 		updadeServiceAvailable(data);
// 	}
// }

// function updadeServiceAvailable(data) {
// 	$.ajax({
// 		data: data,
// 		dataType: 'html',
// 		type: 'POST',
// 	});
// }



