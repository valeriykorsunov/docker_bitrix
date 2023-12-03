console.log("js connected filter review");

function reloadReviews(elem)
{
	console.log(elem.value);

	var targetContainer = $('.reviews__list');          //  Контейнер, в котором хранятся элементы

	// //let	url = location.pathname + "?SECTION_ID="+elem.value; //  URL, из которого будем брать элементы

	// let	url = "/articles/"+elem.value+"/"; //  URL, из которого будем брать элементы

	// if(elem.value=="0")
	// {
	// 	url = "/articles/";
	// 	//window.history.pushState({url: location.pathname},"", location.pathname);
	// 	window.history.pushState({url: url},"", url);
	// }
	// else
	// {
	// 	window.history.pushState({url: url},"", url);
	// }
	let url = elem.value;
	window.history.pushState({url: url},"", url);
	//console.log(location.origin + location.pathname);
	if (url !== undefined) {
		$.ajax({
			//type: 'GET',
			type: 'POST',
			url: url,
			data: {IS_AJAX: 'Y'},
			//dataType: 'html',
			success: function (data) {
				
				//  Удаляем старую навигацию
				$('.load_more_block').remove();
				$('form .form-row').remove();

				$('form.reviews__filter').html($(data).find('form .form-row'));
				
				var elements = $(data).find('.reviews__item');  //  Ищем элементы
				
				let	pagination = $(data).find('.load_more_block');//  Ищем навигацию
				
				
				targetContainer.html(elements);

				targetContainer.after(pagination); //  добавляем навигацию следом

				APP.initStarsSelect();
				APP.initSelect();
			}
		})
	}
}
