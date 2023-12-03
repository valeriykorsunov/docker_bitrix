<?

use Account\UserInfo;
use Bitrix\Main\Application;

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

$request = Application::getInstance()->getContext()->getRequest();

// проверка пароля
if($request["checkPassword"] == "Y" && $request["password"] && $request["GROUP_ID"])
{
	$policy = \CUser::GetGroupPolicy([$request["GROUP_ID"]]); //Получаем политику безопасности для группы пользователей
	$password = $request["password"];//Проверяем удовлетворяет ли правилам Битрикс новый пароль
	$user = new CUser; //CheckPasswordAgainstPolicy метод нестатический поэтому объявляем новый экземпляр класса CUser
	$errors = $user->CheckPasswordAgainstPolicy($password, $policy); //Если пароль подходит, то вернется пустой массив иначе в массиве будут перечислены все ошибки связанные с паролем
	$GLOBALS['APPLICATION']->RestartBuffer();
	echo json_encode($errors, JSON_UNESCAPED_UNICODE);
	exit;
}
