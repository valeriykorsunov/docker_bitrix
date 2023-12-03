$(document).ready(function () {

	$(document).on('click', '.load_more', function () {
		event.preventDefault();
		var targetContainer = $('.b-profile-reviews__list'),          //  Контейнер, в котором хранятся элементы
			url = $('.load_more').attr('data-url');    //  URL, из которого будем брать элементы

		if (url !== undefined) {
			$.ajax({
				//type: 'GET',
				type: 'POST',
				url: url,
				data: {IS_AJAX: 'Y'},
				success: function (data) {
					
					//  Удаляем старую навигацию
					$('.load_more_block').remove();
					
					var elements = $(data).find('.b-profile-reviews__item');  //  Ищем элементы
					
					let	pagination = $(data).find('.load_more_block');//  Ищем навигацию

					//console.log(pagination);
					
					targetContainer.append(elements);   //  Добавляем посты в конец контейнера
					targetContainer.after(pagination); //  добавляем навигацию следом

				}
			})
		}

	});

});