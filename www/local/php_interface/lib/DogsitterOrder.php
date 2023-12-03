<?

class DogsitterOrder 
{
	// private const IBLOCK_ID_SERVICE = 20;
	
	// добавить заявку 
	static function addOrder($PARAM, $CUSTOMER = "")
	{
		CModule::IncludeModule("iblock");
		global $USER, $DB;
		$el = new CIBlockElement;

		$PROP["CUSTOMER_ID"] = $USER->GetID();
		$PROP["EXECUTOR_ID"] =$PARAM["ID_EXECUTOR"];
		$PROP["SERVICE"] =$PARAM["SERVICE"];
		$PROP["PET"] =$PARAM["PET"];
		if($PARAM["CURRENT_STATE"]){
			$PROP["CURRENT_STATE"] = $PARAM["CURRENT_STATE"];
		}

		$PRODUCT_ID = $el->Add(
			array(
				"IBLOCK_ID" => \DogSitter\Settings::ID_IB_Applications,
				"NAME" => $USER->GetFullName(),
				"DATE_ACTIVE_FROM" => date($DB->DateFormatToPHP(FORMAT_DATETIME), strtotime($PARAM["DATE_FROM"])),
				"DATE_ACTIVE_TO" => date($DB->DateFormatToPHP(FORMAT_DATETIME), strtotime($PARAM["DATE_TO"])),
				"ACTIVE" => "Y",
				"PREVIEW_TEXT" => $PARAM["MESSAGE"],
				'PROPERTY_VALUES' => $PROP
			),
			false,
			false,
			false
		);
		if($PRODUCT_ID && $PARAM["ID_EXECUTOR"] != $USER->GetID())
		{
			$notif = new NotificationAndChat();
			$message = 'Вы получили новую звявку от пользователя <a href="/account/my-requests/?active='.$USER->GetID().'">'.$USER->GetFullName().'</a>';
			$notif->sentNotification($message, $PARAM["ID_EXECUTOR"]);
		}
		return $PRODUCT_ID;
	}
}