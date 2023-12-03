<?

class Pet
{
	const IBLOCK_ID = 15;

	static function isUserHas($userID)
	{
		$res = CIBlockElement::GetList(
			array(),
			array(
				"IBLOCK_ID"=> self::IBLOCK_ID,
				"ACTIVE" => "Y",
				"PROPERTY_USER_ID" => $userID
			)
		)->Fetch();
		
		if($res) return 'Y';
		return 'N';
	}

	/**
	 * Вызывается каждый раз после добавления, обновления, удаления питомца. 
	 */
	static function afterChangeStateForPet()
	{
		global $CACHE_MANAGER, $USER;
		$CACHE_MANAGER->ClearByTag("pets_id_" . $USER->GetID());

		Executor\Service::udatePropAllElementsUser($USER->GetID(), "THERE_ARE_PETS");
	}

	static function getNameTypePet($id)
	{
		$highloadID = 4;
		$hlblock = Bitrix\Highloadblock\HighloadBlockTable::getById($highloadID)->fetch();
		$entity = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hlblock);
		$entity_data_class = $entity->getDataClass();
		$result = $entity_data_class::getList(array(
			"select" => array("ID", "UF_NAME"),
			"filter" => array("ID" => $id)
		));

		return $result->fetch();
	}
}