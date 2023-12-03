function successPost(data) {

	if(petBlockUtils.EDIT_PET == "N"){
		let html = $(data).find(".b-personal-pet-card")[0];
		document.querySelector(".personal-area__left .personal-area__list").prepend(html);
		APP.init();
	}
	if(petBlockUtils.EDIT_PET == "Y"){
		petBlockUtils.updatePetCard();
		petBlockUtils.clickCloseForm();
	}	
}
