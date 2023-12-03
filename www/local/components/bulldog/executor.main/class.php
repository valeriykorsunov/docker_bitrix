<?

use Account\UserInfo;
use Bitrix\Main\Application;
use Bitrix\Main\Diag\Debug;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

class CExecutorMain extends CBitrixComponent
{
	const IBLOCK_ID_EXECUTOR_SERVICE = 21;
	const IBLOCK_ID_USER_RESPONSES = 19;
	const IBLOCK_ID_PETS = 15;

	private $cache_id,
		$userID,
		$cache_dir = "/executor_main_cache";

	function registerTagsCache()
	{
		global $CACHE_MANAGER;
		$CACHE_MANAGER->StartTagCache($this->cache_dir);
		$CACHE_MANAGER->RegisterTag("executor_id_" . $this->userID);
		$CACHE_MANAGER->RegisterTag("services_id_" . $this->userID);
		$CACHE_MANAGER->RegisterTag("test_id_" . $this->userID);
		$CACHE_MANAGER->RegisterTag("pets_id_" . $this->userID);
		$CACHE_MANAGER->EndTagCache();
	}

	function executeComponent()
	{
		global $USER;

		$request = Application::getInstance()->getContext()->getRequest();
		$this->userID = $request->getQuery("ID_EXECUTOR");
		$this->cache_id =  md5(serialize("executor." . $this->userID));
		$obCache = new CPHPCache;
		if ($obCache->InitCache(31536000, $this->cache_id, $this->cache_dir)) // 31 536 000 = год
		{
			$this->arResult = $obCache->GetVars();
		}
		elseif ($obCache->StartDataCache())
		{
			$this->registerTagsCache();
			$this->arResult = $this->getUserInfo($this->userID);
			$this->arResult["dogsiService"] = $this->getDogsiService($this->userID);
			$this->arResult["passedTests"] = $this->getPassedTests($this->userID);
			$this->arResult["numberPets"] = $this->getNumberPets();
			$this->arResult["priceList"] = $this->getPriceList();
			$this->arResult["fullPriceList"] = array_merge($this->arResult["priceList"], $this->arResult["dogsiService"]) ;

			$obCache->EndDataCache($this->arResult);
		}

		$this->arResult["ACTIVE_USER_PETS"] = $this->getUserPets($USER->GetID());
		$this->includeComponentTemplate();
	}

	// полчить список животных текущего юзера
	function getUserPets($ID_USER)
	{
		$res = CIBlockElement::GetList(
			array("id" => "asc"),
			array(
				"IBLOCK_ID" => self::IBLOCK_ID_PETS,
				"ACTIVE" => "Y",
				"PROPERTY_USER_ID" => $ID_USER
			),
			false,
			false,
			array(
				"ID",
				"IBLOCK_ID",
				"NAME",
				"PROPERTY_PET_BREED"
			)
		);
		$result = array();
		while ($service = $res->GetNext())
		{
			$result[] = array(
				"ID" => $service["ID"],
				"NAME" => $service["NAME"],
				"PET_BREED" => $service["PROPERTY_PET_BREED_VALUE"]
			);
		}
		return $result;
	}

	function getUserInfo($userID)
	{
		$data = CUser::GetList(
			($by = "ID"),
			($order = "ASC"),
			array(
				'GROUPS_ID' => array(5), // исполнитель
				'ID' => $userID,
				'ACTIVE' => 'Y'
			),
			array(
				'SELECT' => array(
					'UF_HEADLINE',
					'UF_TOP_100',
					'UF_VERIFICATION_COMPLETED',
					'UF_PHOTOS',
					'UF_ANNOUNCEMENT_TEXT',
					'UF_DOGSIT_EXPERIENCE',
					'UF_HOUSING_AREA',

					'UF_UF_TYPE_HOUSING',
					'UF_CHILD_10',
					'UF_TYPE_PETS',
					'UF_PERMANENT_NOTE',
					'UF_LIST_BREEDS',
					'UF_PERSONAL_TRANSPORT'
				),
				'FIELDS' => array(
					'ID',
					'ACTIVE',
					'IS_ONLINE',
					'NAME',
					'LAST_NAME',
					'PERSONAL_PHOTO',
					'PERSONAL_COUNTRY',
					'PERSONAL_CITY',
					'PERSONAL_BIRTHDAY'
				),
				'ONLINE_INTERVAL' => 180
			)
		);

		$arUser = $data->Fetch();
		if ($arUser["PERSONAL_PHOTO"])
		{
			$resizeImg = CFile::ResizeImageGet(
				$arUser["PERSONAL_PHOTO"],
				array(
					"width" => 150,
					"height" => 150
				)
			);
			$arUser["PERSONAL_PHOTO_PATH"] = CFile::GetPath($arUser["PERSONAL_PHOTO"]);
			$arUser["PERSONAL_PHOTO"] = $resizeImg["src"];
		}

		$arUser["PERSONAL_AGE"] = UserInfo::getAge($arUser["PERSONAL_BIRTHDAY"]);

		$arUser["UF_DOGSIT_EXPERIENCE_AGE"] = UserInfo::getAge($arUser["UF_DOGSIT_EXPERIENCE"]);

		$arUser["STARS"] = UserInfo::recountStarsUser($userID);

		//$arUser["USER_GALLERY"] = $this->getPhotoPath($arUser["UF_PHOTOS"]);
		$arUser["USER_GALLERY"] = $this->getPhotos();

		$arUser["UF_TYPE_HOUSING_VALUE"] = UserInfo::getUserFieldValue($arUser["UF_UF_TYPE_HOUSING"]);

		foreach ($arUser["UF_TYPE_PETS"] as $val)
		{
			$arUser["UF_TYPE_PETS_VALUE_LIST"][] = UserInfo::getUserFieldValue($val);
		}
		$arUser["UF_TYPE_PETS_VALUE"] = empty($arUser["UF_TYPE_PETS_VALUE_LIST"]) ? "" : implode(", ", $arUser["UF_TYPE_PETS_VALUE_LIST"]);

		return $arUser;
	}

	function getDogsiService($idUser, $cache = true)
	{
		$nTopCount = 3;
		$res = CIBlockElement::GetList(
			array("PROPERTY_PRICE" => "asc"),
			array(
				"IBLOCK_ID" => self::IBLOCK_ID_EXECUTOR_SERVICE,
				"ACTIVE" => "Y",
				"=PROPERTY_USER_ID" => $idUser,
				"!PROPERTY_SERVICE_AVAILABLE" => false
			),
			false,
			array("nTopCount" => $nTopCount),
			array(
				"IBLOCK_ID",
				"NAME",
				"PROPERTY_SERVICE_AVAILABLE",
				"PROPERTY_CALCULATION_PERIOD",
				"PROPERTY_PRICE",
				"DOGSITTING"
			)
		);
		$arServ = array();
		while ($service = $res->GetNext())
		{
			$arServ[] = array(
				"ID" => $service["ID"],
				"NAME" => $service["NAME"],
				"CALCULATION_PERIOD" => $service["PROPERTY_CALCULATION_PERIOD_VALUE"],
				"PRICE" => $service["PROPERTY_PRICE_VALUE"]
			);
		}
		$result = $arServ;
		return $result;
	}

	function getPassedTests($userID)
	{
		$result = false;
		$arSelect = array("ID", "NAME");
		$arFilter = array(
			"IBLOCK_ID" => self::IBLOCK_ID_USER_RESPONSES,
			"ACTIVE" => "Y",
			"PROPERTY_USER_ID" => $userID,
			"!PROPERTY_RES_TEST_TRUE" => false
		);
		$obRes = CIBlockElement::GetList(array("id" => "desk"), $arFilter, false, false, $arSelect, array("PROPERTY_TEST_ID"));
		while ($res = $obRes->GetNext())
		{
			$result[] = $res["NAME"];
		}
		return $result;
	}

	function getPhotos()
	{
		global $USER;
		$res = CIBlockElement::GetList(
			array(),
			array("IBLOCK_ID" => 23, "PROPERTY_USER_ID"=> $this->userID),
			false,
			false,
			array("IBLOCK_ID", "ID", "PREVIEW_PICTURE", "PROPERTY_USER_ID")
		);

		$img = array();
		while ($resImg = $res->Fetch())
		{
			if ($resImg["PREVIEW_PICTURE"])
			{
				$resizeImg = CFile::ResizeImageGet(
					$resImg["PREVIEW_PICTURE"],
					array(
						"width" => 300,
						"height" => 300
					)
				);
				$resImg["PHOTO"] = $resizeImg["src"];
			}
			$resImg["PHOTO_PATH"] = CFile::GetPath($resImg["PREVIEW_PICTURE"]);
			$img[] = $resImg;
		}
		return $img;
	}

	function getPhotoPath($arPhoto)
	{
		$result = array();
		foreach ($arPhoto as $photo)
		{
			$resizeImg = CFile::ResizeImageGet(
				$photo,
				array(
					"width" => 300,
					"height" => 300
				)
			);
			$result[] = array(
				"PHOTO_PATH" => CFile::GetPath($photo),
				"PHOTO" => $resizeImg["src"]
			);
		}
		return $result;
	}

	function getNumberPets()
	{
		$res = CIBlockElement::GetList(
			array(),
			array("IBLOCK_ID" => self::IBLOCK_ID_PETS, "ACTIVE" => "Y", "=PROPERTY_USER_ID" => $this->userID),
			false,
			false,
			array("IBLOCK_ID", "NAME")
		);
		return $res->SelectedRowsCount();
	}

	function getPriceList()
	{
		$res = CIBlockElement::GetList(
			array("id" => "asc"),
			array(
				"IBLOCK_ID" => self::IBLOCK_ID_EXECUTOR_SERVICE,
				"ACTIVE" => "Y",
				"PROPERTY_USER_ID" => $this->userID,
				"PROPERTY_DOGSITTING" => false,
				"!PROPERTY_SERVICE_AVAILABLE" => false
			),
			false,
			false,
			array(
				"ID",
				"IBLOCK_ID",
				"NAME",
				"PROPERTY_SERVICE_AVAILABLE",
				"PROPERTY_CALCULATION_PERIOD",
				"PROPERTY_PRICE",
				"DOGSITTING"
			)
		);
		$arServ = array();
		while ($service = $res->GetNext())
		{
			$arServ[] = array(
				"ID" => $service["ID"],
				"NAME" => $service["NAME"],
				"CALCULATION_PERIOD" => $service["PROPERTY_CALCULATION_PERIOD_VALUE"],
				"PRICE" => $service["PROPERTY_PRICE_VALUE"],
			);
		}
		return $arServ;
	}
}
