<?
use Bitrix\Main\Loader;

Loader::registerAutoLoadClasses(
	null,
	[
		/**DogSitter */
		'\DogSitter\Settings' => "/local/php_interface/lib/DogSitter/Settings.php",
		/**lib */
		'BulldogUtils' 	=> '/local/php_interface/lib/bulldog_utils.php',
		'NotificationAndChat' 	=> '/local/php_interface/lib/NotificationAndChat.php',
		'Mailing' 	=> '/local/php_interface/lib/mailing.php',
		'BulldogInstagram' 	=> '/local/php_interface/lib/BulldogInstagram.php',
		'DogsitterOrder' 	=> '/local/php_interface/lib/DogsitterOrder.php',
		'Pet' 	=> '/local/php_interface/lib/Pet.php',
		/**account */
		'\Account\UserLogin' 	=> '/local/php_interface/lib/account/UserLogin.php',
		'\Account\AccountAccess' 	=> '/local/php_interface/lib/account/AccountAccess.php',
		'\Account\UserInfo' 	=> '/local/php_interface/lib/account/UserInfo.php',
		'\Account\ServiceRequest' 	=> '/local/php_interface/lib/account/ServiceRequest.php',
		/**Executor */
		'\Executor\Service' 	=> '/local/php_interface/lib/Executor/Service.php',
	]
);