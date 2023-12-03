<?

use Bitrix\Main\Loader;

Loader::includeModule("highloadblock");

use Bitrix\Highloadblock as HL;
use Bitrix\Main\Diag\Debug;
use Bitrix\Main\Entity;
use Bitrix\Main\SystemException;

class Mailing
{
	const MAILING_QUEUE_HL = 2,
		CHAT_HL = 1;

	static function addItemToQueue($idElrm, $type, $proc = 0)
	{
		$hlblock = HL\HighloadBlockTable::getById(self::MAILING_QUEUE_HL)->fetch();

		$entity = HL\HighloadBlockTable::compileEntity($hlblock);
		$entity_data_class = $entity->getDataClass();

		// Массив полей для добавления
		$data = array(
			"UF_ID_ELEM" => $idElrm,
			"UF_TAPE_SUBSCRIBTION" => $type,
			"UF_PROCESSED" => $proc,
			//"UF_DATA" => date("d.m.Y")
		);

		$result = $entity_data_class::add($data);
		return $result;
	}

	static function agentSend(string $typeMailing)
	{
		$mailing = new Mailing;
		$mailing->sendingAgent($typeMailing);

		return "Mailing::agentSend(".$typeMailing.");";
	}

	static function agentMissedMessChat()
	{
		// получить список статей на 
		$hlblock = HL\HighloadBlockTable::getById(self::CHAT_HL)->fetch();
		$entity = HL\HighloadBlockTable::compileEntity($hlblock);
		$entity_data_class = $entity->getDataClass();

		$rsData = $entity_data_class::getList(array(
			"select" => array("*"),
			"order" => array("ID" => "ASC"),
			"filter" => array("UF_READ_MESSAGE" => "0", "UF_RECIPIENT_NOTIFIED" => "0")  // Задаем параметры фильтра выборки
		));
		$countUserMess = array();
		while ($arData = $rsData->Fetch())
		{
			$idMessageList[] = $arData["ID"];
			$usersID[$arData["UF_ID_RECIPIENT"]] = $arData["UF_ID_RECIPIENT"];
			$countUserMess[$arData["UF_ID_RECIPIENT"]] = $countUserMess[$arData["UF_ID_RECIPIENT"]]+1;
		}
		if (!$usersID) return false;

		$data = CUser::GetList(($by = "ID"), ($order = "ASC"),
			array(
				"ID" => implode('|', $usersID),
				'ACTIVE' => 'Y',
				"UF_NEW_MES_ONLINE_EMAIL" => 1
			)
		);
		$succesSend = false;
		while ($arUser = $data->Fetch())
		{
			$arFields["EMAIL_TO"] = $arUser["EMAIL"];
			$arFields["COUNT_MS"] = $countUserMess[$arUser["ID"]];

			//$arFields = array_merge($arFields, $Fields);
			if (CEvent::Send('BULLDOG_NEWS', "s1", $arFields, "Y", "36"))
			{
				$succesSend = true;
			}
		}
		if(!$succesSend) return false;

		$data = array("UF_RECIPIENT_NOTIFIED" => 1);
		foreach ($idMessageList as $id)
		{
			$entity_data_class::update($id, $data); // где 77 -  id обновляемой записи 
		}

		return "Mailing::agentMissedMessChat();";
	}

	/**
	 * Articles, Tests, materials
	 */
	public function sendingAgent(string $typeMailing)
	{
		if ($typeMailing == "") return false;

		if (!$arrayMailing = $this->getArrayMailing($typeMailing)) return false; // если не задач на отправку

		if ($typeMailing == "Articles")
		{
			if (!$linkList = $this->getLinkList($arrayMailing)) return false;
			// получить список емаил адресов и выполнить отправку
			$Fields["LINK_LIST"] =  $linkList;
			$succesSend = $this->sendMailSubscribers('UF_NEWS_ARTICL_EMAIL', "35", $Fields);
		}

		if ($typeMailing == "Tests")
		{
			if (!$linkList = $this->getLinkListSection($arrayMailing)) return false;
			// получить список емаил адресов и выполнить отправку
			$Fields["LINK_LIST"] =  $linkList;
			$succesSend = $this->sendMailSubscribers('UF_NEW_MATERIAL_TEST_EMAIL', "35", $Fields);
		}

		if ($typeMailing == "materials")
		{
			if (!$linkList = $this->getLinkList($arrayMailing)) return false;
			// получить список емаил адресов и выполнить отправку
			$Fields["LINK_LIST"] =  $linkList;
			$succesSend = $this->sendMailSubscribers('UF_NEW_MATERIAL_TEST_EMAIL', "35", $Fields);
		}

		if ($succesSend) $this->deleteHL($arrayMailing);
	}

	/**
	 * $arrayMailing - !!! для удаление используется значние ключа. 
	 * @param array $arrayMailing 
	 * @return void 
	 * @throws SystemException 
	 */
	function deleteHL(array $arrayMailing)
	{
		$hlblock = HL\HighloadBlockTable::getById(self::MAILING_QUEUE_HL)->fetch();

		$entity = HL\HighloadBlockTable::compileEntity($hlblock);
		$entity_data_class = $entity->getDataClass();
		foreach ($arrayMailing as $key => $val)
		{
			$entity_data_class::Delete($key);  // -  id удаляемой записи 
		}
	}

	function sendMailSubscribers(string $codeSubscriber, $emailTemplateId = "7", $Fields = array())
	{
		$this->sendMailSubscribers('UF_NEWS_ARTICL_EMAIL');
		$data = CUser::GetList(($by = "ID"),
			($order = "ASC"),
			array(
				$codeSubscriber => 1,
				'ACTIVE' => 'Y'
			)
		);
		$succesSend = false;
		while ($arUser = $data->Fetch())
		{
			$event = 'BULLDOG_NEWS';
			$site_id = "s1";
			$arFields["EMAIL_TO"] = $arUser["EMAIL"];
			$arFields = array_merge($arFields, $Fields);
			if (CEvent::Send($event, $site_id, $arFields, $emailTemplateId, ""))
			{
				$succesSend = true;
			}
		}
		return $succesSend;
	}

	function getLinkList(&$arrayMailing)
	{
		// получить список элементов (ссылка на элемент, название)
		CModule::IncludeModule("iblock");
		$ob = CIBlockElement::GetList(
			array(),
			array("ID" => implode('|', $arrayMailing)) // IBLOCK_ID" => 5) //,
		);
		$noActiveElem = true; 
		$linkList = "<ul>";
		while ($arElem = $ob->GetNext())
		{
			if ($arElem["ACTIVE"] == "Y")
			{
				$noActiveElem = false;
				$elements[] = array(
					$arElem["DETAIL_PAGE_URL"],
					$arElem["NAME"]
				);
				$linkList .= '<li><a href="' . $arElem["DETAIL_PAGE_URL"] . '">' . $arElem["NAME"] . '</a></li>';
			}
			else
			{
				if (($key = array_search($arElem["ID"], $arrayMailing)) !== FALSE)
				{
					unset($arrayMailing[$key]);
				}
			}
		}
		$linkList .= "</ul>";
		if ($noActiveElem) return false; // если нет активных элементов на отправку
		return $linkList;
	}
	function getLinkListSection(&$arrayMailing)
	{
		// получить список элементов (ссылка на элемент, название)
		CModule::IncludeModule("iblock");
		$ob = CIBlockSection::GetList(
			array(),
			array("ID" => $arrayMailing)
		);

		$noActiveElem = true;
		$linkList = "<ul>";
		while ($arElem = $ob->GetNext())
		{
			if ($arElem["ACTIVE"] == "Y")
			{
				$noActiveElem = false;
				$elements[] = array(
					$arElem["SECTION_PAGE_URL"],
					$arElem["NAME"]
				);
				$linkList .= '<li><a href="' . $arElem["SECTION_PAGE_URL"] . '">' . $arElem["NAME"] . '</a></li>';
			}
			else
			{
				if (($key = array_search($arElem["ID"], $arrayMailing)) !== FALSE)
				{
					unset($arrayMailing[$key]);
				}
			}
		}
		$linkList .= "</ul>";
		if ($noActiveElem) return false; // если нет активных элементов на отправку
		return $linkList;
	}

	function getArrayMailing(string $typeMailing)
	{
		// получить список статей на 
		$hlblock = HL\HighloadBlockTable::getById(self::MAILING_QUEUE_HL)->fetch();
		$entity = HL\HighloadBlockTable::compileEntity($hlblock);
		$entity_data_class = $entity->getDataClass();
		$rsData = $entity_data_class::getList(array(
			"select" => array("*"),
			"order" => array("ID" => "ASC"),
			"filter" => array("!UF_PROCESSED" => "1", "UF_TAPE_SUBSCRIBTION" => $typeMailing)  // Задаем параметры фильтра выборки
		));
		while ($arData = $rsData->Fetch())
		{
			$result[$arData["ID"]] = $arData["UF_ID_ELEM"];
		}
		if (!$result) $result = false;
		return $result;
	}

	/**
	 * Обновить статус заявки на рассылку
	 * @param array $arrayID 
	 * @return void 
	 * @throws SystemException 
	 */
	function updateHL(array $arrayID)
	{
		$hlblock = HL\HighloadBlockTable::getById(self::MAILING_QUEUE_HL)->fetch();

		$entity = HL\HighloadBlockTable::compileEntity($hlblock);
		$entity_data_class = $entity->getDataClass();
		$data = array(
			"UF_PROCESSED" => 1
		);
		foreach ($arrayID as $id)
		{
			$result = $entity_data_class::update($id, $data); // где 77 -  id обновляемой записи 
		}
	}
}
