<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();


if (!CModule::IncludeModule("sale"))
{
	ShowError(GetMessage("SALE_MODULE_NOT_INSTALL"));
	return;
}
if (!CModule::IncludeModule("catalog"))
{
	ShowError(GetMessage("CURRENCY_MODULE_NOT_INSTALL"));
	return;
}
function GetBasketListCustom($bSkipFUserInit = false)
{
	$fUserID = CSaleBasket::GetBasketUserID($bSkipFUserInit);
	$arRes = array();
	if ($fUserID > 0)
	{
		$db_res = CSaleBasket::GetList(
			array("NAME" => "ASC"),
			array("FUSER_ID" => $fUserID, "LID" => SITE_ID, "ORDER_ID" => "NULL")
		);
		while ($res = $db_res->GetNext())
		{
			if (strlen($res["CALLBACK_FUNC"]) > 0)
			{
				//CSaleBasket::UpdatePrice($res["ID"], $res["CALLBACK_FUNC"], $res["MODULE"], $res["PRODUCT_ID"], $res["QUANTITY"]);
				$res = CSaleBasket::GetByID($res["ID"]);
			}
			$arRes[] = $res;
		}
	}
	return $arRes;
}


$arParams["PATH_TO_BASKET"] = Trim($arParams["PATH_TO_BASKET"]);
$arParams["PATH_TO_ORDER"] = Trim($arParams["PATH_TO_ORDER"]);

$arItems = GetBasketListCustom();
$bReady = False;
$bDelay = False;
$bNotAvail = False;
$sArticleID = '';
$arProducts = [];
for ($i = 0; $i<count($arItems); $i++)
{
	if ($arItems[$i]["DELAY"]=="N" && $arItems[$i]["CAN_BUY"]=="Y")
		$bReady = True;
	elseif ($arItems[$i]["DELAY"]=="Y" && $arItems[$i]["CAN_BUY"]=="Y")
		$bDelay = True;
	elseif ($arItems[$i]["CAN_BUY"]=="N")
		$bNotAvail = True;
	$arItems[$i]["PRICE_FORMATED"] = SaleFormatCurrency($arItems[$i]["PRICE"], $arItems[$i]["CURRENCY"]);
	$sArticleID .= $arItems[$i]['ID'].$arItems[$i]['PRODUCT_ID'];

	$arProducts[] = $arItems[$i]['ID'];


}
//iwrite($arProducts);


if (count($arProducts)) {
		// Получим свойства элементов корзины для находящихся в них товаров.
		$db_res = CSaleBasket::GetPropsList(array(),array("BASKET_ID" => $arProducts, "CODE" =>array("STARTDATE", "TYPE", "COURSE_CODE", "TEACHER_NAME", "CITY_NAME", "ID_COURSE", "ID_TIME")));

		while ($ar_res = $db_res->Fetch()) {
			//iwrite($ar_res);
			switch ($ar_res["CODE"]) {
				case "STARTDATE":
		   		$arResult["STARTDATE"][$ar_res["BASKET_ID"]] = $ar_res["VALUE"];
		   		break;

				case "TEACHER_NAME":
				$arResult["TEACHER_NAME"][$ar_res["BASKET_ID"]] = $ar_res["VALUE"];
				break;

				case "CITY_NAME":
				$arResult["CITY_NAME"][$ar_res["BASKET_ID"]] = $ar_res["VALUE"];
				break;

				case "ID_COURSE":
				$arResult["ID_COURSE"][$ar_res["BASKET_ID"]] = $ar_res["VALUE"];
				break;

				case "ID_TIME":
				$arResult["ID_TIME"][$ar_res["BASKET_ID"]] = $ar_res["VALUE"];
				break;

				case "COURSE_CODE":
				$arResult["COURSE_CODE"][$ar_res["BASKET_ID"]] = $ar_res["VALUE"];
				break;

				case "TYPE":
				$arResult["TYPE"][$ar_res["BASKET_ID"]] = $ar_res["VALUE"];
				break;
			}
		}

}

if (strlen($sArticleID) > 0)
	$GLOBALS['LINK_TO_FRIEND'] = md5($sArticleID);

$arResult["READY"] = (($bReady)?"Y":"N");
$arResult["DELAY"] = (($bDelay)?"Y":"N");
$arResult["NOTAVAIL"] = (($bNotAvail)?"Y":"N");
$arResult["ITEMS"] = $arItems;

if ($_REQUEST["DELETE_ALL"] == "Y"){
	foreach($arResult["ITEMS"]as $arBasketItems)
	{
		CSaleBasket::Delete($arBasketItems["ID"]);
	}
	$arResult["ITEMS"] = "";
}



$this->IncludeComponentTemplate();

?>