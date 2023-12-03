<?

/* Пользователи и авторизация */
	//в методе CUser::Login до проверки имени входа arParams['LOGIN'] и пароля arParams['PASSWORD'] и попытки авторизовать пользователя
	AddEventHandler("main", "OnBeforeUserLogin", array("\Account\UserLogin", "DoBeforeUserLoginHandler"));

	//до попытки регистрации нового пользователя методом CUser::Register
	AddEventHandler("main", "OnBeforeUserRegister",  array("\Account\UserLogin", "OnBeforeUserRegisterHandler"));

	// вызывается после попытки добавления нового пользователя методом CUser::Add. 
	AddEventHandler("main", "OnAfterUserAdd",  array("\Account\UserLogin", "OnAfterUserAddHandler"));

	// OnAfterUserUpdate Событие OnAfterUserUpdate вызывается после попытки изменения свойств пользователя методом CUser::Update
	AddEventHandler("main", "OnAfterUserUpdate",  array("\Account\UserInfo", "OnAfterUserUpdateHandler"));

	// вызывается в момент удаления пользователя.
	RegisterModuleDependences("main", "OnUserDelete", "", "\Account\UserInfo", "OnUserDeleteHandler");

	// вызван из метода CUser::Authorize после авторизации пользователя
	AddEventHandler("main", "OnAfterUserAuthorize",  array("\Account\UserLogin", "OnAfterUserAuthorizeHandler"));
/* Конец для Пользователи и авторизация */

//вызывается в выполняемой части пролога сайта, после определения $USER, SITE_TEMPLATE_ID
AddEventHandler("main", "OnBeforeProlog",  array("\Account\AccountAccess", "startOnBeforeProlog"));



//Событие "OnAfterIBlockElementAdd" вызывается после попытки добавления нового элемента информационного блока методом CIBlockElement::Add.
AddEventHandler("iblock", "OnAfterIBlockElementAdd",  array("BulldogUtils", "OnAfterIBlockElementAddHandler"));

//Событие "OnAfterIBlockSectionAdd" вызывается после попытки добавления нового раздела информационного блока методом CIBlockSection::Add
AddEventHandler("iblock", "OnAfterIBlockSectionAdd",  array("BulldogUtils", "OnAfterIBlockSectionAddHandler"));




// DOC: http://dev.1c-bitrix.ru/api_help/main/events/onbuildglobalmenu.php
AddEventHandler("main", "OnBuildGlobalMenu", "DoBuildGlobalMenu");