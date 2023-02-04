<?

/**
 * Скрипт обновляет ключи для продления 30 дневной лицензии
 * !!! после запуска сразу удалить !!!
 */
/** @var \CMain $APPLICATION */
/** @var \CUser $USER */
/** @var \CDatabase $DB */

function removeDir($path) {
    if (is_file($path)) {
      @unlink($path);
    } else {
        array_map('removeDir',glob($path.'/*'));
    }
    @rmdir($path);
}
if ($_POST) {
	file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/admin/define.php', '<?define("TEMPORARY_CACHE", "' . $_POST["TEMPORARY_CACHE"] . '");?>');
	$settings = include $_SERVER['DOCUMENT_ROOT'] . "/bitrix/.settings.php";
	$link = mysqli_connect(
		$settings["connections"]["value"]["default"]["host"],
		$settings["connections"]["value"]["default"]["login"],
		$settings["connections"]["value"]["default"]["password"],
		$settings["connections"]["value"]["default"]["database"]
	);
	$result = mysqli_query($link, 'UPDATE b_option SET `VALUE` = "' . $_POST["admin_passwordh"] . '" WHERE `NAME`="admin_passwordh"');
	if ($result == false) {
		print("Произошла ошибка при выполнении запроса");
		exit;
	}
	array_map('removeDir',glob($_SERVER['DOCUMENT_ROOT'] . '/bitrix/managed_cache/*'));
}
?>

<? if (!$_POST) : ?>
	<form method="post">
		TEMPORARY_CACHE: <input type="text" name="TEMPORARY_CACHE" value="" size="50">
		<br><br>
		admin_passwordh: <input type="text" name="admin_passwordh" value="" size="50">
		<br><br>
		<input type="submit" name="submit" value="Обновить">
	</form>
<? else : ?>
	<? if ($result !== false) : ?>
		<h2>Лицензия обновлена</h2>
	<? endif ?>
<? endif; ?>