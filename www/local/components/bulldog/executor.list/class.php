<?

use Account\UserInfo;
use Account\UserLogin;
use Bitrix\Main\Diag\Debug;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();



class CExecutorList extends CBitrixComponent
{
	const IBLOCK_ID_SERVICE = 21;
	private
		$usersFilter = array(),
		$usersSort = array();

	function executeComponent()
	{
		$this->setFilter();
		$this->setSort();
		$this->arResult["ACTIVE_FILTER"] = $this->usersFilter;
		$this->arResult["ACTIVE_SORT"] = $this->usersSort;

		$this->arResult["USERS"] = $this->getUserList();

		$this->arResult["FILTER_PARAM"] = $this->getFilterParam();

		$this->includeComponentTemplate();
	}

	function setFilter()
	{
		$this->usersFilter["IBLOCK_ID"] = self::IBLOCK_ID_SERVICE;
		$this->usersFilter["PROPERTY_USER_ACTIVE"] = "Y";
		$this->usersFilter["!PROPERTY_SERVICE_AVAILABLE"] = false;

		if ($this->request["country"])
		{
			$this->usersFilter["PROPERTY_USER_COUNTRY"] = $this->request["country"];
		}
		if ($this->request["city"])
		{
			$this->usersFilter["PROPERTY_USER_CITY"] = $this->request["city"];
		}

		if($this->request->getQuery("top") == "y")
		{
			$this->usersFilter["PROPERTY_USER_TOP_100"] = "1";
		}

		if($this->request->getQuery("serviceType"))
		{
			$this->usersFilter["PROPERTY_TYPE_SERVICES"] = $this->request->getQuery("serviceType");
		}		
		if($this->request->getQuery("price-type") != "")
		{
			$this->usersFilter["PROPERTY_CALCULATION_PERIOD"] = $this->request->getQuery("price-type");
		}
		// else
		// {
		// 	$this->usersFilter["PROPERTY_CALCULATION_PERIOD"] = "36"; // HOUR
		// }
		if($this->request->getQuery("price-min"))
		{
			$this->usersFilter[">=PROPERTY_PRICE"] = $this->request->getQuery("price-min");
		}
		if($this->request->getQuery("price-max"))
		{
			$this->usersFilter["<=PROPERTY_PRICE"] = $this->request->getQuery("price-max");
		}

		if($this->request->getQuery("pet-type"))
		{
			$this->usersFilter["PROPERTY_USER_TYPE_PETS"] = $this->request->getQuery("pet-type");
		}
		if($this->request->getQuery("house-type"))
		{
			$this->usersFilter["PROPERTY_USER_TYPE_HOUSING"] = $this->request->getQuery("house-type");
		}
		if($this->request->getQuery("non-smokers") == "on")
		{
			$this->usersFilter["PROPERTY_USER_NON_SMOKERS"] = "1";
		}
		if($this->request->getQuery("no-children") == "on")
		{
			$this->usersFilter["!PROPERTY_USER_CHILD_10"] = "1";
		}
		if($this->request->getQuery("have-pet") == "on")
		{
			$this->usersFilter["PROPERTY_THERE_ARE_PETS"] = "Y";
		}

	}

	function getUserList()
	{		global $APPLICATION;

		$arNavStartParams["nPageSize"] = 12;
		if ($this->request->getQuery("PAGEN"))
		{
			$arNavStartParams["iNumPage"] = $this->request->getQuery("PAGEN");
		}

		$arSelectFields = array(
			"ID",
			"NAME",
			"PROPERTY_USER_ID",
			"PROPERTY_PRICE",
			"PROPERTY_USER_TOP_100",
			"PROPERTY_USER_COUNTRY",
			"PROPERTY_CALCULATION_PERIOD"
		);

		$resServices = CIBlockElement::GetList(
			$this->usersSort,
			$this->usersFilter,
			array("PROPERTY_USER_ID"),
			$arNavStartParams
		);
		while ($user = $resServices->GetNext())
		{
			$userID = $user["PROPERTY_USER_ID_VALUE"];
			$arFilter = $this->usersFilter;
			$arFilter["PROPERTY_USER_ID"] = $userID;

			$service = CIBlockElement::GetList(
				array("PROPERTY_PRICE" => "ASC"),
				$arFilter,
				false,
				false,
				$arSelectFields
			)->Fetch();

			$result[$userID]["PUBLIC_PAGE"] = "/executors/" . $userID . "/";
			$userInf = Account\UserInfo::getForSevice($userID);
			if ($userInf["PERSONAL_PHOTO"])
			{
				$resizeImg = CFile::ResizeImageGet(
					$userInf["PERSONAL_PHOTO"],
					array(
						"width" => 150,
						"height" => 150
					)
				);
				$result[$userID]["PERSONAL_PHOTO"] = $resizeImg["src"];
			}
			
			$result[$userID]["NAME"] = $userInf["NAME"];
			$result[$userID]["LAST_NAME"] = $userInf["LAST_NAME"];
			$result[$userID]["UF_TOP_100"] = $service['PROPERTY_USER_TOP_100_VALUE'];
			$result[$userID]["PERSONAL_COUNTRY"] = $service["PROPERTY_USER_COUNTRY_VALUE"];
			$result[$userID]["STARS"] = UserInfo::recountStarsUser($userID);
			$result[$userID]["UF_HEADLINE"] = $userInf["UF_HEADLINE"];
			$result[$userID]["PRICE_PER"]["PRICE"] = $service["PROPERTY_PRICE_VALUE"];
			$result[$userID]["PRICE_PER"]["CALCULATION_PERIOD"] = $service['PROPERTY_CALCULATION_PERIOD_VALUE'];
			$result[$userID]["SERVICE_ID"] = $service['ID'];
		}

		$this->arResult["rowsCount"] = $resServices->SelectedRowsCount();
		$url = false;
		if ($resServices->NavRecordCount > 0)
		{
			if ($resServices->NavPageNomer + 1 <= $resServices->NavPageCount)
			{
				$plus = $resServices->NavPageNomer + 1;
				$url = $APPLICATION->GetCurPageParam("PAGEN=" . $plus, array("PAGEN"));
			}
		}
		$this->arResult["NextPage"] = $url;

		return $result;
	}

	function getPricePerHour($idUser)
	{
		$IBLOCK_ID_EXECUTOR_SERVICE = 21;
		$arFilter = array(
			"IBLOCK_ID" => $IBLOCK_ID_EXECUTOR_SERVICE,
			"ACTIVE" => "Y",
			"!PROPERTY_SERVICE_AVAILABLE" => false,
			"=PROPERTY_USER_ID" => $idUser,
		);
		// тип цены
		if ($this->request["price-type"] != "")
		{
			$arFilter['PROPERTY_CALCULATION_PERIOD'] = $this->request["price-type"];
		}

		// тип услуги
		if ($this->request["serviceType"] != "")
		{
			$arFilter['PROPERTY_CALCULATION_PERIOD'] = $this->request["price-type"];
		}

		$result = CIBlockElement::GetList(
			array('PROPERTY_PRICE' => "ASC"),
			$arFilter,
			false,
			false,
			array(
				"IBLOCK_ID",
				"NAME",
				"ACTIVE",
				"PROPERTY_SERVICE_AVAILABLE",
				"PROPERTY_CALCULATION_PERIOD",
				"PROPERTY_PRICE",
				"DOGSITTING"
			)
		)->Fetch();

		//$result = $res->Fetch();
		// $result = array();
		// $nameService = \Bitrix\Main\Config\Option::get("askaron.settings", "UF_OBLIGATORILY_SER")[0];
		// while ($arResult = $res->GetNext())
		// {
		// 	if ($arResult["NAME"] == $nameService)
		// 	{
		// 		$result = $arResult;
		// 		break;
		// 	}
		// }

		// if (!$result)
		// {
		// 	// добавить услугу исполнителю - догситинг
		// 	UserLogin::addServiceDogsitting($idUser);
		// 	return 0;
		// }

		return array("PRICE" => $result["PROPERTY_PRICE_VALUE"], "CALCULATION_PERIOD" => $result["PROPERTY_CALCULATION_PERIOD_VALUE"]);
	}

	// параметры формы фильтра
	function getFilterParam()
	{
		$request = \Bitrix\Main\Context::getCurrent()->getRequest();
		$data = CUser::GetList(
			($by = "ID"),
			($order = "ASC"),
			array('GROUPS_ID' => array(5), 'ACTIVE' => 'Y'),
			array(
				'SELECT' => array(
					//''
				),
				'FIELDS' => array(
					'ID',
					'PERSONAL_COUNTRY',
					'PERSONAL_CITY'
				)
			)
		);
		while ($user = $data->GetNext(false, false))
		{
			// PERSONAL_COUNTRY
			if ($user["PERSONAL_COUNTRY"])
			{
				$result["COUNTRY"][$user["PERSONAL_COUNTRY"]] = array(
					"COUNTRY" => $user["PERSONAL_COUNTRY"],
					"COUNTRY_NAME" => GetCountryByID($user["PERSONAL_COUNTRY"])
				);
			}
			// uasort($result["COUNTRY"], [$this, 'order_new']);
			// PERSONAL_CITY
			if ($user["PERSONAL_CITY"])
			{
				$result["CITY"][] = $user["PERSONAL_CITY"];
			}
			$result["CITY"] = array_unique($result["CITY"]);
			asort($result["CITY"]);
		}

		$result["PRICE"]["minPrice"] = $this->getMinMaxMinPriceService("asc");
		$startMinPrice = $result["PRICE"]["minPrice"];
		if ($request->getQuery("price-min"))
		{
			$startMinPrice = $request->getQuery("price-min");
		}
		$result["PRICE"]["startMinPrice"] = $startMinPrice;
		$result["PRICE"]["maxPrice"] = $this->getMinMaxMinPriceService("desc");
		$startMaxPrice = $result["PRICE"]["maxPrice"];
		if ($request->getQuery("price-max"))
		{
			$startMaxPrice = $request->getQuery("price-max");
		}
		$result["PRICE"]["startMaxPrice"] = $startMaxPrice;
		$result["PRICE"]["typePrice"] = $this->getPropertyTypeList(60, 21);

		// Тип питомца
		$result["typePets"] = UserInfo::getUserFieldAllValue(55);

		$result["houseType"] = UserInfo::getUserFieldAllValue(54);

		// тип Услуг
		$result["serviceType"] = $this->getPropertyTypeElementLink(24);

		return $result;
	}

	function getPropertyTypeElementLink($IB_ID)
	{
		$arProp = array();
		$property_enums = CIBlockElement::GetList(
			array("SORT" => "ASC", "ID" => "ASC"),
			array(
				"IBLOCK_ID" =>  $IB_ID,
				"ACTIVE" => "Y"
			),
			false,
			false,
			array(
				"ID",
				"NAME"
			)
		);

		while ($enum_fields = $property_enums->GetNext())
		{
			$arProp[$enum_fields["ID"]] = $enum_fields["NAME"];
		}
		return $arProp;
	}

	function getPropertyTypeList($id, $IB_ID)
	{
		$arProp = array();
		$property_enums = CIBlockPropertyEnum::GetList(
			array("DEF" => "ASC", "SORT" => "ASC"),
			array(
				"IBLOCK_ID" =>  $IB_ID,
				"PROPERTY_ID" => $id
			)
		);
		while ($enum_fields = $property_enums->GetNext())
		{
			$arProp[$enum_fields["ID"]] = $enum_fields["VALUE"];
		}
		return $arProp;
	}

	/**
	 * принимает значение "asc" - для получение минимальной цены
	 * принимает значение "desc" - для получение максимальной цены
	 */
	function getMinMaxMinPriceService($arOrder)
	{
		$data = CUser::GetList(
			($by = "UF_FIX_PRICE"),
			($order = $arOrder),
			array('GROUPS_ID' => array(5), 'ACTIVE' => 'Y', "!UF_FIX_PRICE" => null),
			array(
				'SELECT' => array('UF_FIX_PRICE'),
				'FIELDS' => array('ID')
			)
		)->Fetch();
		return $data["UF_FIX_PRICE"];
	}

	function uaSortContry($a, $b)
	{
		return ($a['COUNTRY_NAME'] > $b['COUNTRY_NAME']);
	}

	function setSort()
	{
		switch ($this->request["sort"])
		{
			case 'pr_asc':
				$this->usersSort = array("PROPERTY_PRICE"=>"ASC");
				break;

			case 'pr_desc':
				$this->usersSort = array("PROPERTY_PRICE"=>"DESC");
				break;

			default:
				$this->usersSort = array("PROPERTY_USER_POPULARITY" => "desc, nulls");
				break;
		}
	}
}
