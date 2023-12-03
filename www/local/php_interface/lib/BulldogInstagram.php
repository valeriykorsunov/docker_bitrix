<?

use Bitrix\Main\Diag\Debug;



class BulldogInstagram
{
	private	$TOKEN, 
			$IBLOCK_ID = 6, // ИД инфоблока для записи 
			$instaCount = 6; // ограничение по кол-ву записей из инстаграмма

	static function startBulldogInstagram()
	{
		$instagram = new BulldogInstagram();

		$instagram->instagramPars();
	}

	function __construct()
	{
		$this->TOKEN = "IGQVJXUEpxNTdlSjFIR0ZAmX2gxVkZAhSG5NbXF3ZA1p6QVRxeFNpU2s4SlhhazI4NEJFd3NrNXlWLXhVNVVXdTRDNVBWUzZADVEI1MFNtclFQOHoxcXBkRFhXcFBuLUttQXFDSjJqZA0tWYU1weVFiaDZAkTwZDZD";
	}

	// проверить обновление и записать в битрикс
	function instagramPars()
	{
		$insta = $this->getInstagramData();
		$insta["data"] = array_slice($insta["data"] , 0, $this->instaCount);
		$this->checkNewPhoto($insta["data"]);

		Debug::dumpToFile("---".date("d/m/Y : H.i.s")."---", "BulldogInstagram -> instagramPars()");
	}

	/**
	 * Запрос к инстаграмму по токену
	 * @return mixed // результат запроса - масив 
	 */
	function getInstagramData()
	{

		$url = "https://graph.instagram.com/me/media?fields=id,caption,media_type,media_url,username,timestamp,thumbnail_url&access_token=" . $this->TOKEN;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 20);
		$result = curl_exec($ch);
		curl_close($ch);

		return json_decode($result, true);
	}

	/**
	 * Добавляет полученные данные по id фильтру
	 * @param mixed $arInstaPhoto // масив данных из инстограмма
	 * @param mixed $arrFiltAdd // массив новых публикация инсторгама (только xml_id)
	 * @return mixed // массив с id добавленных элементов
	 */
	private function addInstagramDataToIB($arInstaPhoto, $arrFiltAdd)
	{
		krsort($arInstaPhoto);
		foreach($arInstaPhoto as $arInstaElem)
		{
			if(in_array($arInstaElem["id"], $arrFiltAdd))
			{
				$str = $arInstaElem["timestamp"];
				$timestamp = strtotime($str);
				$date = strftime("%d.%m.%Y", $timestamp);
				$time = strftime("%H:%M:%S", $timestamp);
		
				$el = new CIBlockElement;
				$arLoadProductArray = array(
					"IBLOCK_SECTION_ID" => false,	// элемент лежит в корне раздела
					"IBLOCK_ID" => 6,
					"XML_ID" => $arInstaElem["id"],
					//"PROPERTY_VALUES" => $PROP,
					"NAME"           => 'Пост  ' . $date . " - " . $time,
					"ACTIVE"         => "Y",	// активен
					"PREVIEW_TEXT"   => $arInstaElem['caption'],
					"PREVIEW_PICTURE" => CFile::MakeFileArray($arInstaElem['media_url'])
				);
				$PRODUCT_ID[] = $el->Add($arLoadProductArray);
			}
		}
		return $PRODUCT_ID;
	}

	/**
	 * 
	 * @param mixed $arrPhotoInst // массив элементов из инстаграм
	 * @return void 
	 */
	private function checkNewPhoto($arrPhotoInst)
	{
		// получить список элементов инфоблока
		$arIbElem = array();
		$arSelect = array("IBLOCK_ID", "ID", "NAME", "XML_ID");
		$arFilter = array("IBLOCK_ID" => $this->IBLOCK_ID);
		if(!CModule::IncludeModule("iblock")) return false;
		$res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
		while ($elem= $res->GetNext())
		{
			$arIbElem[$elem["ID"]]=$elem["XML_ID"];
		}
		
		$arIdInst = array_column($arrPhotoInst, "id");

		$n1 = array_diff($arIbElem, $arIdInst); // список удалить
		
		if(count($n1) > 0)
		{
			// удалить элементы
			foreach($n1 as $key=>$val)
			{
				CIBlockElement::Delete($key);
			}
		}
		$n2 = array_diff($arIdInst, $arIbElem); // список добавить
		
		if(count($n2) > 0)
		{
			// добавить только эти элементы
			$this->addInstagramDataToIB($arrPhotoInst, $n2);
		}
		
	}
}
