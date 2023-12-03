<?

namespace Account;

use Account\AccountAccess as AccountAccountAccess;
use CUser;

class AccountAccess
{
	// ИД Группы пользователей
	const
		CUSTOMER = 6,
		EXECUTOR = 5;

	// Группа пользователя аккаунта
	static $typeUser;

	/**
	 * Возвращает true если текущий пользователь исполнитель(догситтер)
	 */
	static function isExecutor($idUser)
	{
		$arGroups = UserInfo::getUserGroupArrayID($idUser);
		
		if (in_array(self::EXECUTOR, $arGroups) !== false)
		{
			self::$typeUser = "EXECUTOR";
			return true;
		}
		return false;
	}

	function getCustomerPageList()
	{
		$list = array(
			"notification",
			"documents",
			"my-pets",
			"my-orders",
			"subscription"
		);
		return $list;
	}

	function getExecutorPageList()
	{
		$list = array(
			"my-services",
			"my-requests",
			"calendar",
			"my-pets",
			"documents",
			"materials",
			"tests",
			"notification",
			"safety",
			"subscription"
		);
		return $list;
	}

	function checking()
	{
		$account = new AccountAccountAccess;
		global $APPLICATION;
		$strUrl = $APPLICATION->GetCurPage();
		global $USER;
		$arGroups = $USER->GetUserGroupArray();
		if (in_array(self::CUSTOMER, $arGroups) !== false)
		{
			self::$typeUser = "CUSTOMER";
		}
		if (in_array(self::EXECUTOR, $arGroups) !== false)
		{
			self::$typeUser = "EXECUTOR";
		}

		if (strpos($APPLICATION->GetCurPage(), "account") !== false)
		{
			if (self::$typeUser == "CUSTOMER")
			{
				if ($APPLICATION->GetCurPage() == "/account/")
				{
					return true;
				}
				$arrCustomerPage = $this->getCustomerPageList();
				foreach ($arrCustomerPage as $str)
				{
					if (strpos($APPLICATION->GetCurPage(), $str) !== false)
					{
						return true;
					}
				}
				LocalRedirect('/account/');
			}
			if (self::$typeUser == "EXECUTOR")
			{
				if ($APPLICATION->GetCurPage() == "/account/")
				{
					return true;
				}
				$arrExecutorPage = $this->getExecutorPageList();
				foreach ($arrExecutorPage as $str)
				{
					if (strpos($APPLICATION->GetCurPage(), $str) !== false)
					{
						return true;
					}
				}
				LocalRedirect('/account/');
			}

			//self::$typeUser = "USER";
			LocalRedirect('/login/');
		}
		else
		{
			return true;
		}
	}

	static function startOnBeforeProlog()
	{
		$accountAccess = new AccountAccess;
		$accountAccess->checking();
		$accountAccess->UserOnline();
	}

	function UserOnline()
	{
		global $USER;
		if ($USER->IsAuthorized())
		{
			// устанавливаем, что пользователь сейчас в сети
			$USER->SetLastActivityDate($USER->GetID());
		}
	}
}
