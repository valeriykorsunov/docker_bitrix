<?
namespace Account;

use CIBlock;
use CIBlockElement;
use JetBrains\PhpStorm\NoReturn;

class ServiceRequest
{
	const IBLOCK_ID = 20;

	static function isValid($requestID)
	{
		global $USER;
		if($USER->IsAdmin()) return true;

		$result = CIBlockElement::GetList(
			arFilter:array(
				"ID"=>$requestID,
				"PROPERTY_EXECUTOR_ID"=>$USER->GetID(),
			),
			arSelectFields:array(
				"ID",
				"NAME",
				"PROPERTY_CURRENT_STATE"
			)
		)->Fetch();

		// статус пустой или выходной исполнителя && (empty($result["PROPERTY_CURRENT_STATE_VALUE"]) || $result["PROPERTY_CURRENT_STATE_ENUM_ID"] == "47")
		if($result) return true;
		return false;
	}

	static function start($requestID)
	{
		if(!self::isValid($requestID)) return false;

		CIBlockElement::SetPropertyValues(
			$requestID, 
			self::IBLOCK_ID, 
			"43", 
			"CURRENT_STATE"
		);

		return \true;
	}

	static function end($requestID)
	{
		if(!self::isValid($requestID)) return false;

		CIBlockElement::SetPropertyValues(
			$requestID, 
			self::IBLOCK_ID, 
			"44", 
			"CURRENT_STATE"
		);

		return \true;
	}

	static function delete($requestID)
	{
		if(!self::isValid($requestID)) return false;

		CIBlockElement::Delete($requestID);

		return \true;
	}

}