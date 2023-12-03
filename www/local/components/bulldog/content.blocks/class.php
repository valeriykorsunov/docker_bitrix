<?php

class ContentBlocks extends CBitrixComponent
{
	public function executeComponent()
	{
		if($this->startResultCache())
        {
			$this->arResult = $this->getElement();
			if($this->arResult)
			{
				$this->arResult["SRC"]["PREVIEW_PICTURE"] = $this->getUrlFile($this->arResult["fields"]["PREVIEW_PICTURE"]);
				$this->arResult["SRC"]["DETAIL_PICTURE"] = $this->getUrlFile($this->arResult["fields"]["DETAIL_PICTURE"]);
				$this->arResult["SRC"]["LIST_IMG"] = $this->getUrlFile($this->arResult["props"]["LIST_IMG"]["VALUE"]);
				$this->includeComponentTemplate(); 
			}
		}
		//return $this->arResult["BLOCK"];
	}

	public function getElement()
	{
		$result = array();
		if(!CModule::IncludeModule("iblock")) return false;
		
		$res = CIBlockElement::GetList(
			array(),
			array("IBLOCK_ID" => $this->arParams["IBLOCK_ID"], "ID"=>$this->arParams["ID_ELEM"], "ACTIVE"=>"Y")
		);
		if ($ob = $res->GetNextElement())
		{
			$result["fields"] = $ob->GetFields();  
			$result["props"] = $ob->GetProperties();

			return $result;
		}
		return "";
	}

	// получить путь к файлу
	function getUrlFile($file)
	{
		if(is_array($file))
		{
			$arFile = array();
			foreach($file as $value)
			{
				$arFile[] = CFile::GetPath($value);
			}
			return $arFile;
		}
		else
		{
			return CFile::GetPath($file);
		}
	}
}