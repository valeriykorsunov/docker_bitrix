// выбрано изображение - добавить в БД и отобразить на экране.. 
async function addDoc(clssNameElID)
{
	let addDoc = document.querySelector(".addDoc-"+clssNameElID);
	// addDoc.classList.add("visually-hidden");
	// document.querySelector(".editDoc-"+clssNameElID).classList.remove("visually-hidden");

	// записать в битрикс
	let form = addDoc.querySelector("form");
	let formData = new FormData(form);
	formData.append("PROPERTY_NAME", form.querySelector('[name="DOCUMENT"]').getAttribute("data-propertyName"));
	formData.append("ADD_DOC", "Y");

	let response = await fetch('', {
		method: 'POST',
		body: formData
	});

	let result = await response.text();
	
	showDocuments(); // вывести список документов
	// получить вывести: url на изображение и id для удаления

	// отправить файл, имя инпута (название поля в БД)

}

function deleteDoc(elem) {
//	e.preventDefault();
	let url = elem.dataset.url;
	let idBlock = elem.dataset.idBlock;
	// var deleteButton = e.currentTarget;
	// var _deleteButton$dataset = deleteButton.dataset,
	// 	url = _deleteButton$dataset.url;

	$.get(url).done(function () {
		let addDoc = document.querySelector(".addDoc-"+idBlock);
		addDoc.classList.remove("visually-hidden");
		document.querySelector(".editDoc-"+idBlock).classList.add("visually-hidden");
	});
}


// показать документы
function showDocuments()
{
	// b-personal-safety__files-grid
	$.ajax({
		url: '',
		method: 'post',
		dataType: 'html',
		data: {upData: 'Y'},
		success: function(data){
			let html = $(data).find(".b-personal-safety__files-grid").html();
			
			document.querySelector(".b-personal-safety__files-grid").innerHTML = html;
			APP.init();
		}
	
	});
}