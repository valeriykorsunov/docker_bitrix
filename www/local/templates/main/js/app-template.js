console.info("tamplate - active");
// global utils --------------------------------------------------------------------------------------------------------
const KUtil = {
	validateEmail: (email) => {
		const re = /^(([^<>()[\].,;:\s@"]+(\.[^<>()[\].,;:\s@"]+)*)|(".+"))@(([^<>()[\].,;:\s@"]+\.)+[^<>()[\].,;:\s@"]{2,})$/iu;
		return re.test(String(email).toLowerCase());
	},
	validatePass: async function (password, groupId) {
		let formData = new FormData();
		formData.append("checkPassword", "Y");
		formData.append("password", password);
		formData.append("GROUP_ID", groupId);
		let response = await fetch('/local/php_interface/ajax/main.register.php', {
			method: 'POST',
			body: formData
		});

		let result = await response.json();
		if (result.length == 0) {
			return true;
		}
		else {
			result.forEach((item) => {
				console.log(item);
			});
			return false;
		}
	}
}
// ---------------------------------------------------------------------------------------------------------------------
function successPost(data) {
	// для: /account/my-services/	
	if (document.querySelector(".js-add-service")) {
		let html = $(data).find(".js-personal-service.b-personal-service").get(0).outerHTML;
		document.querySelector(".personal-area__left .personal-area__list").insertAdjacentHTML('afterbegin', `${html}`);
		APP.init();
	}
}
// for: /account/my-services/
// ---------------------------------------------------------------------------------------------------------------------
const forms = document.querySelectorAll('.js-edit-service');
for (let i = 0; i < forms.length; i++) {
	forms[i].addEventListener('submit', async function (event) {
		event.preventDefault();
		let formData = new FormData(event.currentTarget);
		$.ajax({
			data: formData,
			processData: false,
			contentType: false,
			type: 'POST',
			success: function success(data) {
				html = $(data).find(".b-personal-service")[0];

				document.getElementById("personal-service-" + formData.get("id")).remove();

				document.querySelector(".personal-area__left .personal-area__list").prepend(html);
				APP.init();
				$.magnificPopup.close();
			}
		});
	});
}
function changeServiceAvailable(elem) {
	let data = {
		id: elem.dataset.id,
		updadeServiceAvailable: "y",
	};
	if (elem.checked == true) {
		data.updadeValue = 27;
		updadeServiceAvailable(data);
	}
	if (elem.checked == false) {
		data.updadeValue = 0;
		updadeServiceAvailable(data);
	}
}
function updadeServiceAvailable(data) {
	$.ajax({
		data: data,
		dataType: 'html',
		type: 'POST',
	});
}

// for executor.list (/executors/index.php) ----------------------------------------------------------------------------
function applyFilter(element) {
	document.location.href = element.value;
	//document.location.assign(element.value);
}

function applyTop(element) {
	if (element.checked) {
		document.location.href = element.dataset.true;
	}
	else {
		document.location.href = element.dataset.false;
	}
}

// for registration form -----------------------------------------------------------------------------------------------
class RegistrationForm {
	form = Object();
	constructor(form) {
		this.form = form;

		this.regEvents();
	}
	regEvents() {
		let registerSubmitButton = this.form.querySelector('[name="register_button"]');
		registerSubmitButton.addEventListener("click", async (elem) => {
			elem.preventDefault();
			let checkedClick = await this.sendClick(elem);
			console.log(checkedClick);
			if (checkedClick) this.form.submit();
		});
		this.form.querySelector('[name="personal-data-agreements"]').addEventListener("change", (event) => {
			if (event.target.checked) {
				registerSubmitButton.disabled = false;
			}
			else {
				registerSubmitButton.disabled = true;
			}
		});
	}
	async sendClick(elem) {
		// проверить согласие на обработку персональных данных
		if (this.form.querySelector('[name="personal-data-agreements"]').checked === false) {
			//elem.preventDefault();
			return false;
		}

		let error = 0;
		let inputMail = this.form.querySelector('[name="REGISTER[EMAIL]"]');
		if (!KUtil.validateEmail(inputMail.value)) {
			error++;
			inputMail.style.borderColor = "red";
		}
		else {
			inputMail.style.borderColor = "green";
		}
		// проверка пароля
		let pass = this.form.querySelector('[name="REGISTER[PASSWORD]"]');
		let confPass = this.form.querySelector('[name="REGISTER[CONFIRM_PASSWORD]"]');
		let groupId = this.form.querySelector('[name="GROUP_ID"]');
		let validatePass = false;
		if (pass.value != "" && groupId.value != "") {
			validatePass = await KUtil.validatePass(pass.value, groupId.value);
		}
		//console.log(validatePass);
		if (pass.value != confPass.value || pass.value == "") {
			error++;
			pass.style.borderColor = "red";
			confPass.style.borderColor = "red";
		}
		else {
			if (validatePass === false) {
				error++;
				confPass.style.borderColor = "red";
				pass.style.borderColor = "red";
			}
		}

		if (error == 0) {
			pass.style.borderColor = "green";
			confPass.style.borderColor = "green";
			return true;
		}
		else {
			return false;
		}
	}

}

// for my pets ---------------------------------------------------------------------------------------------------------
class PetBlockUtils {

	EDIT_PET = "N";
	EDIT_PET_ID = "";

	constructor() {
		this.regEvents();
	}
	appInit() {
		APP.initBirthdayCalendar();
		APP.initSelect();
		APP.initAvatarInput();
		APP.addFormValidate();
		APP.initAddPetBlock();
	}
	regEvents() {
		let editButton = document.querySelectorAll('.js-click-edit-pet');
		editButton.forEach((button) => {
			button.addEventListener("click", (elem) => {
				this.clickButtonEdit(elem);
			});
		});
	}
	// запросить форму изменения
	async clickButtonEdit(elem) {
		this.EDIT_PET = "Y";
		await this.updateForm("Y", elem.currentTarget.dataset.idpet);
		this.EDIT_PET_ID = document.querySelector('[name="PET_ID"]').value;

		// открыть форму
		APP.initAddPetBlock(true).toggleAddPetBlock();

		var addPetBlock = document.querySelector('.js-add-pet');
		if (addPetBlock.classList.contains('active')) {
			var toggleButton = document.querySelector('.js-add-pet-toggle');
			toggleButton.addEventListener('click', () => {
				this.clickCloseForm();
			});
		}
	}
	// запросить форму добавления
	async clickCloseForm() {
		this.EDIT_PET = "N";
		this.EDIT_PET_ID = "";
		if (document.querySelector('[name="EDIT_PET"]').value == "N") {
			return true;
		}
		else {
			await this.updateForm("N", 0);
		}
	}
	/**
	 * Обновить форму
	 * @param {*} FORM_EDIT_PET 
	 * Возможны значения "Y" или "N"
	 * @param {*} PET_ID Если FORM_EDIT_PET = N то PET_ID можно указать 0
	 */
	async updateForm(FORM_EDIT_PET, PET_ID) {
		let formData = new FormData();
		formData.append("FORM_EDIT_PET", FORM_EDIT_PET);
		if (FORM_EDIT_PET == "Y") {
			formData.append("PET_ID", PET_ID);
		}
		else {
			formData.append("CLEAR_FORM", "Y");
		}

		let response = await fetch('', {
			method: 'POST',
			body: formData
		});

		let result = await response.text();
		document.querySelector('.personal-area__right').innerHTML = result;
		//APP.init();
		this.appInit();
	}

	async updatePetCard() {
		// получить данные по питомцу
		let edit_pet_id = this.EDIT_PET_ID;
		if (this.EDIT_PET_ID == "") return false;
		let formData = new FormData();
		formData.append("UPDATE_PET_CARD", "Y");
		formData.append("PET_ID", this.EDIT_PET_ID);
		let response = await fetch('', {
			method: 'POST',
			body: formData
		});
		let result = await response.json();
		// найти объект и обновить данные
		let petCard = document.querySelector(`[data-cadr-idpet="${edit_pet_id}"]`);

		console.log(petCard);
		if (petCard) {
			petCard.querySelector('[data-pet-name]').innerText = result.NAME; // кличка питомца
			petCard.querySelector('[data-pet-photo]').src = result.PREVIEW_PICTURE.SRC; // фото питомца
			petCard.querySelector('[data-pet-type]').innerText = result.TYPE_PET_NAME; // тип питомца
			petCard.querySelector('[data-pet-breed]').innerText = result.PET_BREED;	// порода питомца
			petCard.querySelector('[data-pet-size]').innerText = result.SIZE_NAME;	// размер
			petCard.querySelector('[data-pet-gender]').innerText = result.GENDER_NAME;	// пол
			petCard.querySelector('[data-pet-animals-neardy]').innerText = result.ANIMALS_NEARDY;	// Животные, которые могут находиться вместе с ним.
			petCard.querySelector('[data-pet-features]').innerText = result.PET_FEATURES;	// Особенности питомца
			if (result.SPAY_NEUT) // Стерилизован/кастрирован
				petCard.querySelector('[data-pet-spay-neut]').checked = true;
			else
				petCard.querySelector('[data-pet-spay-neut]').checked = false;
			if (result.STAY_HOME_ALONE) // Остается ли питомец один дома
				petCard.querySelector('[data-pet-stay-home-alone]').checked = true;
			else
				petCard.querySelector('[data-pet-stay-home-alone]').checked = false;
			if (result.FREND_ANIMALS) // Дружелюбен к другим животным
				petCard.querySelector('[data-pet-friend-animals]').checked = true;
			else
				petCard.querySelector('[data-pet-friend-animals]').checked = false;
			if (result.VACCINATED) // Имеет необходимые вакцинации
				petCard.querySelector('[data-pet-vaccinated]').checked = true;
			else
				petCard.querySelector('[data-pet-vaccinated]').checked = false;
			if (result.FRIEND_CHILDREN_10) // Дружелюбен к детям до 10 лет
				petCard.querySelector('[data-pet-friend-children_10]').checked = true;
			else
				petCard.querySelector('[data-pet-friend-children_10]').checked = false;
		}

		// document.querySelector(".personal-area__left .personal-area__list").prepend(html);
	}
}

// /account/my-requests/
// For /account/my-requests/ -------------------------------------------------------------------------------------------
class ServicesRequest {
	constructor() {
		this.regEvents();
	}

	regEvents() {
		let requestStart = document.querySelectorAll('.js-requestStart');
		if (requestStart) {
			requestStart.forEach((button) => {
				button.addEventListener("click", (elem) => {
					this.requestStart(elem);
				});
			});
		}

		let requestConfirm = document.querySelectorAll('.js-requestConfirm');
		if (requestConfirm) {
			requestConfirm.forEach((button) => {
				button.addEventListener("click", (elem) => {
					this.requestConfirm(elem);
				});
			});
		}

		let requestEnd = document.querySelectorAll('.js-requestEnd');
		if (requestEnd) {
			requestEnd.forEach((button) => {
				this.addEventButtonEnd(button);
			});
		}

		let requestDelete = document.querySelectorAll('.js-requestDelete');
		if (requestDelete) {
			requestDelete.forEach((button) => {
				button.addEventListener("click", (elem) => {
					this.requestDelete(elem);
				});
			});
		}

		let refuse = document.querySelectorAll('.js-refuse');
		if (refuse) {
			refuse.forEach((button) => {
				button.addEventListener("click", (elem) => {
					this.refuse(elem);
				});
			});
		}
	}

	async requestDelete(button) {
		let parentBlock = button.target.closest(".b-personal-orders__item");
		let parent = button.target.closest(".b-personal-order--button");
		let parentData = parent.dataset;
		let formData = new FormData();
		formData.append("requestDelete", 'Y');
		formData.append("requestID", parentData.requestId);

		let response = await fetch('/local/php_interface/ajax/ajaxServiceRequest.php', {
			method: 'POST',
			body: formData
		});
		let result = await response.text();
		// console.log(result);
		parentBlock.remove();
	}

	addEventButtonEnd(button) {
		button.addEventListener("click", (elem) => {
			this.requestEnd(elem);
		});
	}

	async refuse(button) {
		let parentBlock = button.target.closest(".b-personal-orders__item");
		let parent = button.target.closest(".account-personal__controls");
		let parentData = parent.dataset;

		let formData = new FormData();
		formData.append("requestDelete", 'Y');
		formData.append("requestID", parentData.requestId);

		let response = await fetch('/local/php_interface/ajax/ajaxServiceRequest.php', {
			method: 'POST',
			body: formData
		});
		let result = await response.text();
		// console.log(result);
		parentBlock.remove();
	}

	getHtmlButtonEnd() {

		return '<div class="button--pg">'
			+ '<button class="btn btn--dimmed btn--circle-small js-requestEnd">'
			+ '<svg role="img" width="1em" height="1em">'
			+ '<use xlink:href="#si-ic-test" />'
			+ '</svg>'
			+ '</button>'
			+ '</div>';
	}

	getHtmlButtonFinish() {
		return `<button class="btn js-requestEnd">Finish</button>`;
	}

	/**
	 * Для кнопок в правом верхнем углу карточки
	 * 
	 * @param {HTMLElement} button 
	 */
	async requestStart(button) {
		let parent = button.target.closest(".b-personal-order--button");
		let parentData = parent.dataset;
		let formData = new FormData();
		formData.append("requestStart", 'Y');
		formData.append("requestID", parentData.requestId);

		button.target.closest(".b-personal-order").classList.remove("new-order");

		let response = await fetch('/local/php_interface/ajax/ajaxServiceRequest.php', {
			method: 'POST',
			body: formData
		});

		let result = await response.text();
		console.log(result);
		parent.innerHTML = this.getHtmlButtonEnd();
		let newButton = parent.querySelector(".js-requestEnd");
		this.addEventButtonEnd(newButton);

	}

	async requestConfirm(button) {
		let parent = button.target.closest(".account-personal__controls");
		let parentData = parent.dataset;
		let formData = new FormData();
		formData.append("requestStart", 'Y');
		formData.append("requestID", parentData.requestId);

		button.target.closest(".b-personal-order").classList.remove("new-order");

		let response = await fetch('/local/php_interface/ajax/ajaxServiceRequest.php', {
			method: 'POST',
			body: formData
		});

		let result = await response.text();
		console.log(result);
		parent.innerHTML = this.getHtmlButtonFinish();
		let newButton = parent.querySelector(".js-requestEnd");
		this.addEventButtonEnd(newButton);

	}



	async requestEnd(button) {
		let parent = button.target.closest(".account-personal__controls");
		let parentData = parent.dataset;
		let formData = new FormData();
		formData.append("requestEnd", 'Y');
		formData.append("requestID", parentData.requestId);
		let response = await fetch('/local/php_interface/ajax/ajaxServiceRequest.php', {
			method: 'POST',
			body: formData
		});
		let result = await response.text();
		console.log(result);
		parent.innerHTML = "";
		// window.location.reload();
		/*
		let parent = button.target.closest(".b-personal-order--button");
		let parentData = parent.dataset;
		let formData = new FormData();
		formData.append("requestEnd", 'Y');
		formData.append("requestID", parentData.requestId);
		let response = await fetch('/local/php_interface/ajax/ajaxServiceRequest.php', {
			method: 'POST',
			body: formData
		});
		let result = await response.text();
		console.log(result);
		parent.innerHTML = "";
		*/
		// let newButton = parent.querySelector(".js-requestEnd");
		//this.addEventButtonEnd(newButton);
	}
}

// For /account/subscription/ -------------------------------------------------------------------------------------------
class Subscription {
	/**
	 * Singleton 
	 * @returns Singleton class
	 */
	constructor() {
		if (typeof Subscription.class === 'object') {
			return Subscription.class;
		}
		this.init();
		Subscription.class = this;
		return Subscription.class;
	}

	/**
	 * инициализация
	 */
	init() {
		this.isStartBay = false;
		this.BayButton = document.querySelectorAll(".js-bay-tariffs");
		if (this.BayButton) {
			this.BayButton.forEach(item => {
				item.addEventListener('click', (elem) => {
					elem.preventDefault();
					item.disabled = true;
					this.Bay(item, elem);
				})
			});
		}
	}

	Bay(item, elem) {
		if (this.isStartBay) return;

		this.isStartBay = true;
		let data = {
			ID: item.getAttribute("data-idTariffs")
		};
		fetch('/local/php_interface/ajax/tariffs/bay/', {
			method: 'POST',
			headers: {
				'Content-Type': 'application/json;charset=utf-8'
			},
			body: JSON.stringify(data)
		})
			.then(response => response.json())
			.then(response => {
				if (response.successfully == "Y") {
					this.isStartBay = false;
					//this.Pay(response.idPay, response.sum);
					// обновить данные формы
					let form = item.closest("form");
					form.amount.value = response.sum;
					form.cartId.value = response.idPay;

					form.submit();
				}	
				else{
					console.error("error PAY");
				}
			});
	}
}

// window.onload -------------------------------------------------------------------------------------------------------
var petBlockUtils;
window.onload = () => {
	// for pages with registration form
	if (document.querySelector('[name="regform"]')) {
		var regForm = new RegistrationForm(document.querySelector('[name="regform"]'));
	}
	if (document.querySelector('.js-add-pet')) {
		petBlockUtils = new PetBlockUtils();
	}
	if (document.getElementById('js-applications-page')) {
		let servicesRequest = new ServicesRequest();
	}

	new Subscription;

	let jsNextTab = document.querySelector(".js-next-tab");
	if(jsNextTab){
		jsNextTab.addEventListener('click', (elem) => {
			elem.preventDefault();
			let next = jsNextTab.closest('.js-tabs').querySelector('li:nth-child(2)');
			// next.click();
		});
	}
};