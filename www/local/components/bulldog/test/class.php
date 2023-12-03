<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
if (!CModule::IncludeModule("iblock"))
	return;

use Bitrix\Main\Application;
use Bitrix\Main\Config\Option;
use Bitrix\Main\Diag\Debug;

use function PHPSTORM_META\elementType;

class Tests extends CBitrixComponent
{

	function executeComponent()
	{
		$request = Application::getInstance()->getContext()->getRequest();

		$arFilter = array(
			"IBLOCK_ID" => $this->arParams["IBLOCK_ID"],
			"ID" =>  $request->getQuery("testID")
		);
		$test = CIBlockSection::GetList(array(), $arFilter, true)->GetNext(false);
		if ($test === false)
		{
			if ($this->arParams["LocalRedirect"] == "") return false;
			LocalRedirect($this->arParams["LocalRedirect"]);
		}

		$this->arResult["TEST_NAME"] = $test["NAME"];
		$this->arResult['Count'] =  $test["ELEMENT_CNT"];

		$questionIDnew = false;
		if ($request->isPost() && $request->getPost("questionIDnew"))
		{
			$questionIDnew =  $request->getPost("questionIDnew");
		}

		if ($request->isPost() && !$request->getPost("prev"))
		{
			$answer = array(
				"ID" => $request->getPost("questionID"),
				"NAME" =>  $request->getPost("question"),
				"ID_ANSWER" => $request->getPost("answerID"),
				"ANSWER" => $request->getPost("answer")
			);
			$this->rememberAnswer($test["ID"], $answer);
		}

		// последний ответ
		if ($request->isPost() && $request->getPost("questionEnd"))
		{
			// записать результат в БД и сделать редирект
			if($this->addToIB())
			{
				// удалить данные сессии
				$this->deleteSession($request->getQuery("testID"));
			}
			die();
		}

		$this->arResult['PREV'] = $this->arResult['CURRENT'] = $this->arResult['NEXT'] = array();
		$arNavStartParams["nPageSize"] = 2;
		if ($questionIDnew)
		{
			$arNavStartParams["nElementID"] = $questionIDnew;
			$arNavStartParams["nPageSize"] = 1;
		}
		$arSelect = array("ID", "IBLOCK_ID", "NAME", "DETAIL_PAGE_URL");
		$arFilter = array(
			"IBLOCK_ID" => $this->arParams["IBLOCK_ID"],
			"SECTION_ID" => $request->getQuery("testID"),
			"ACTIVE" => "Y"
		);
		$res = CIBlockElement::GetList(array("sort" => "asc", "id" => "asc"), $arFilter, false, $arNavStartParams, $arSelect);
		if ($questionIDnew)
		{
			while ($rowOb = $res->GetNextElement())
			{
				$row = $rowOb->GetFields();
				if ($questionIDnew == $row['ID'])
				{
					$this->arResult['CURRENT'] = $row;
					$this->arResult['CURRENT']["PROP"] = $rowOb->GetProperty("ANSWER_OPTIONS");
					$this->arResult['CURRENT']["Nomer"] = $row['RANK'];
				}
				$arRows[$row['RANK']] = $row;
			}
			if (isset($arRows[$this->arResult['CURRENT']['RANK'] - 1]))
			{
				$this->arResult['PREV'] = $arRows[$this->arResult['CURRENT']['RANK'] - 1];
			}
			if (isset($arRows[$this->arResult['CURRENT']['RANK'] + 1]))
			{
				$this->arResult['NEXT'] = $arRows[$this->arResult['CURRENT']['RANK'] + 1];
			}
		}
		else
		{
			$row = $res->GetNextElement();
			$this->arResult['CURRENT'] = $row->GetFields();
			$this->arResult['CURRENT']["PROP"] = $row->GetProperty("ANSWER_OPTIONS");
			$row = $res->GetNextElement();
			$this->arResult['NEXT'] = $row->GetFields();
		}

		if (!$this->arResult['CURRENT']["Nomer"]) $this->arResult['CURRENT']["Nomer"] = $res->NavPageNomer;

		// получить ответ из сессии
		if ($request->getPost("questionIDnew"))
			$this->arResult["idSelectAnsver"] = $this->getAnsverInSess($test["ID"], $request->getPost("questionIDnew"));

		if ($request->isPost() && $request->getPost("questionIDnew"))
		{
			$GLOBALS['APPLICATION']->RestartBuffer();
			$this->includeComponentTemplate();
			die();
		}

		$this->includeComponentTemplate();
	}

	function getResultTest($testID)
	{
		$numberCorrectAnswers = 0;
		$count = 0;
		$arSelect = array("ID", "IBLOCK_ID", "NAME");
		$arFilter = array(
			"IBLOCK_ID" => $this->arParams["IBLOCK_ID"],
			"SECTION_ID" => $testID,
			"ACTIVE" => "Y"
		);
		$res = CIBlockElement::GetList(array("sort" => "asc", "id" => "asc"), $arFilter, false, false, $arSelect);
		while ($rowOb = $res->GetNextElement())
		{
			$count++;
			$row = $rowOb->GetFields();
			$row["PROP"] = $rowOb->GetProperty("ANSWER_OPTIONS");

			$ans = $this->getAnsverInSess($testID, $row["ID"]);

			foreach ($row["PROP"]["PROPERTY_VALUE_ID"] as $key => $value)
			{
				if ($value == $ans["ID_ANSWER"] && $row["PROP"]["DESCRIPTION"][$key] != "")
				{
					$numberCorrectAnswers++;
				}
			}
		}

		return array("numberCorrectAnswers" => $numberCorrectAnswers, "count" => $count);
	}

	function rememberAnswer($idTest, array $answer)
	{
		global $USER;
		$name = "user_" . $USER->GetID() . "_" . $idTest;

		$session = Application::getInstance()->getSession();

		$session->start();
		if ($session->has($name))
		{
			$value = $session->get($name);
		}
		$value[$answer["ID"]] = $answer;

		$session->set($name, $value);

		$session->save();
	}

	function deleteSession($idTest)
	{
		global $USER;
		$name = "user_" . $USER->GetID() . "_" . $idTest;

		$session = Application::getInstance()->getSession();
		$session->start();
		$session->remove($name);
		$session->save();
	}

	function getAnsverInSess($idTest, $idQuestion)
	{
		global $USER;
		$name = "user_" . $USER->GetID() . "_" . $idTest;

		$session = Application::getInstance()->getSession();

		$session->start();
		if ($session->has($name))
		{
			return $session->get($name)[$idQuestion];
		}
		return false;
	}

	private function addToIB()
	{
		global $USER, $DB;
		$request = Application::getInstance()->getContext()->getRequest();
		$name = $this->arResult["TEST_NAME"];
		$numberAnswers = $this->getResultTest($request->getQuery("testID"));
		$el = new CIBlockElement;
		$propValues = array();
		$propValues["USER_ID"] = $USER->GetID();

		$propValues["ANSWER_QUESTION"] = $this->getArrayAQ($request->getQuery("testID"));
		$propValues["TEST_ID"] = $request->getQuery("testID");
		$propValues["NUMBER_CORRECT_ANSWERS"] = $numberAnswers["numberCorrectAnswers"];
		$propValues["NUMBER_QUESTIONS"] = $numberAnswers["count"];

		$x1=ceil(($numberAnswers["numberCorrectAnswers"]/$numberAnswers["count"])*100);
		$x2 =(float)Option::get("askaron.settings", "UF_PERCENT_TEST");
		$test_true = ($x1>=$x2);
		if($test_true)
		{
			$propValues["RES_TEST_TRUE"] = 37;
		}

		$PRODUCT_ID = $el->Add(
			array(
				"IBLOCK_ID" => $this->arParams["IBLOCK_ID_RESULT"],
				"NAME" => $name,
				"DATE_ACTIVE_FROM" => date($DB->DateFormatToPHP(FORMAT_DATETIME)),
				"ACTIVE" => "Y",
				"PREVIEW_TEXT" => "",
				"PROPERTY_VALUES" => $propValues
			),
			false,
			false,
			false
		);
		if($PRODUCT_ID && $test_true)
		{	
			global $CACHE_MANAGER;
			$CACHE_MANAGER->ClearByTag("iblock_id_7");
		}
		return $PRODUCT_ID;
	}

	function getArrayAQ($idTest)
	{
		$a_q = array();
		global $USER;
		$name = "user_" . $USER->GetID() . "_" . $idTest;

		$session = Application::getInstance()->getSession();

		$session->start();
		if ($session->has($name))
		{
			$value = $session->get($name);
		}

		if ($value)
		{
			foreach ($value as $ans)
			{
				$a_q[] = array(
					"VALUE" => $ans["NAME"],
					"DESCRIPTION" => $ans["ANSWER"]
				);
			}
		}

		$session->save();

		return $a_q;
	}

	function deleteElem($id)
	{
		global $USER;
		$elem = CIBlockElement::GetList(array(), array("IBLOCK_ID" => $this->arParams["IBLOCK_ID"], "ID" => $id), false, false, array("IBLOCK_ID", "ID", "PROPERTY_USER_ID"))->Fetch();

		if ($elem["PROPERTY_USER_ID_VALUE"] == $USER->GetID())
		{
			CIBlockElement::Delete($id);
		}
	}
}
