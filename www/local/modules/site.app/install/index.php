<?

use Bitrix\Main\EventManager;
use Bitrix\Main\ModuleManager;

class site_app extends CModule
{
	/**
	 * site_application constructor.
	 * @throws \Bitrix\Main\IO\InvalidPathException
	 */
	public function __construct() {
		$this->MODULE_VERSION = "1.0.0";
		$this->MODULE_VERSION_DATE = "2022-11-25 00:00:00";

		$this->MODULE_ID = 'site.app';
		$this->MODULE_NAME = "SiteApp";
		$this->MODULE_DESCRIPTION = "SiteApp";
		$this->PARTNER_NAME = "SiteApp";
		$this->PARTNER_URI = '';		
	}

	/**
	 * @return mixed|void
	 * @throws \Bitrix\Main\LoaderException
	 */
	public function doInstall() {
		ModuleManager::registerModule($this->MODULE_ID);
		$this->editHandler("install");
	}
	/**
	 * @return mixed|void
	 * @throws \Bitrix\Main\LoaderException
	 */
	public function doUninstall() {
		$this->editHandler("uninstall");
		ModuleManager::unRegisterModule($this->MODULE_ID);
	}

		/**
	 * Обработчик событий
	 *
	 * @param [string] $typeAction
	 * @return bool
	 */
	protected function editHandler(string $typeAction)
	{
		$listHandler = array(
			["ModuleId" => "main", "Event" => "onPageStart", "Sort" => "100"],
			["ModuleId" => "main", "Event" => "OnEpilog", "Sort" => "100"],
		);
		foreach ($listHandler as $params)
		{
			if ($typeAction == "install")
			{
				$this->registerHandler($params);
			}
			if ($typeAction == "uninstall")
			{
				$this->unregisterHandler($params);
			}
		}

		return	true;
	}
	protected function registerHandler(array $params)
	{
		if (!isset($params["ModuleId"], $params["Event"], $params["Sort"])) return false; // TODO зафиксировать как ошибку.

		\Bitrix\Main\EventManager::getInstance()->registerEventHandler(
			$params["ModuleId"],
			$params["Event"],
			$this->MODULE_ID,
			'Site\App\EventHandler',
			$params["Event"],
			$params["Sort"]
		);
		return true;
	}
	protected function unregisterHandler(array $params)
	{
		if (!isset($params["ModuleId"], $params["Event"], $params["Sort"])) return false; // TODO зафиксировать как ошибку.

		\Bitrix\Main\EventManager::getInstance()->unregisterEventHandler(
			$params["ModuleId"],
			$params["Event"],
			$this->MODULE_ID,
			'Site\App\EventHandler',
			$params["Event"]
		);
		return true;
	}

}