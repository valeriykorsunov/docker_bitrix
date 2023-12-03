<?

use Bitrix\Main\Application;
use Bitrix\Main\Diag\Debug;
use Bitrix\Main\Page\Asset;

require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_admin_before.php");

//define("ADMIN_MODULE_NAME", "Magwai");

// сформируем список закладок
$aTabs = array(
	array("DIV" => "edit11", "TAB" => "edit12", "ICON" => "main_user_edit", "TITLE" => "Уведомления пользователям"),
);
$tabControl = new CAdminTabControl("tabControl", $aTabs);


$request = Application::getInstance()->getContext()->getRequest();
if ($request->isPost() & $request->getPost("MESSAGE") != "")
{
	$recipientCount = 0;
	// получить список пользоваетелей и сделать рассылку
	$filter = array(
		"ACTIVE" => "Y"
	);
	if ($request->getPost("GROUP_ID") != "0")
	{
		$filter["GROUPS_ID"] = array($request->getPost("GROUP_ID"));
	}
	$arParameters = array(
		"FIELDS" => array("ID")
	);
	$rsUsers = CUser::GetList(($by = "id"), ($order = "asc"), $filter, $arParameters); // выбираем пользователей
	while ($user = $rsUsers->Fetch())
	{
		$notif = new NotificationAndChat();
		$notif->sentNotification($request->getPost("MESSAGE"), $user["ID"]);
		$recipientCount++;
	}

	$result = 'Уведомление отправлено для ' . $recipientCount . ' пользователей';
	if ($request->getPost("GROUP_ID") == "5")
	{
		$result .= ' из грппы "Исполнитель"';
	}
	if ($request->getPost("GROUP_ID") == "6")
	{
		$result .= ' из грппы "Заказчик"';
	}
}
elseif ($request->isPost())
{
	$result = "Не заполнен текст сообщения!";
}
// установим заголовок страницы
$APPLICATION->SetTitle("Уведомления пользователям");

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_admin_after.php");

$tabControl->BeginNextTab();
?>

<form method="post" action="" name="regform" enctype="multipart/form-data">
	<tr>
		<td width="20%">Message: </td>
		<td width="80%"><textarea rows="7" name="MESSAGE" placeholder="Message"><?= $request->getPost("MESSAGE") ?></textarea></td>
	</tr>
	<tr>
		<td width="20%">Message: </td>
		<td width="80%">
		<select class="js-select" name="GROUP_ID" data-placeholder="Recipients">
			<option value="0" <? if ($request->getPost("GROUP_ID") == "0") : ?>selected<? endif ?>>ALL</option>
			<option value="5" <? if ($request->getPost("GROUP_ID") == "5") : ?>selected<? endif ?>>Dogsitter / Executor </option>
			<option value="6" <? if ($request->getPost("GROUP_ID") == "6") : ?>selected<? endif ?>>Customer</option>
		</select>
		</td>
	</tr>
	<tr>
		<td width="20%"></td>
		<td width="80%">
			<input type="submit" name="register_submit_button" value="Send" />
		</td>
	</tr>
</form>

<?
// завершаем интерфейс закладок
$tabControl->End();
?>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_admin.php"); ?>