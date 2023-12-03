<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

class Tests extends CBitrixComponent
{
	function executeComponent()
	{
		if ($this->startResultCache())
		{
			global $USER;
			// $this->arResult["MY_ID"] = $USER->GetID();
			// $this->arResult["MY_TOKEN"] = md5($USER->GetID() . '-bulldog52');
			$this->arResult["MY_TYPE"] = ""; // заказчик или исполнитель
			
			$this->includeComponentTemplate();
		}
	}
}
