console.log("фильтр статей");

function reloadSection(elem)
{
	var targetContainer = $('.articles__grid');          //  Контейнер, в котором хранятся элементы

	//let	url = location.pathname + "?SECTION_ID="+elem.value; //  URL, из которого будем брать элементы

	let	url = "/articles/"+elem.value+"/"; //  URL, из которого будем брать элементы

	if(elem.value=="0")
	{
		url = "/articles/";
		//window.history.pushState({url: location.pathname},"", location.pathname);
		window.history.pushState({url: url},"", url);
	}
	else
	{
		window.history.pushState({url: url},"", url);
	}

	console.log(location.origin + location.pathname);

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
				
				var elements = $(data).find('.articles__item');  //  Ищем элементы
				
				let	pagination = $(data).find('.load_more_block');//  Ищем навигацию
				
				
				targetContainer.html(elements);

				targetContainer.after(pagination); //  добавляем навигацию следом

			}
		})
	}
}
