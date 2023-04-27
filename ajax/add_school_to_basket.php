<?php
define("NO_KEEP_STATISTIC", true); // Не собираем стату по действиям AJAX
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
	if (CModule::IncludeModule("sale") && CModule::IncludeModule("catalog"))
	{
	   if (($action == "ADD2BASKET" || $action == "BUY") && IntVal($_GET['id'])>0 && IntVal($_GET['quantity']>0))
	    {
				$idTemp = intval($_REQUEST["id"]);
				$arPropsTemp =  GetFullInfoAboutClass($idTemp);
	            foreach ($arPropsTemp as $key => $value )
	            {
			         $arProps[] = array(
					    "NAME" => $key,
					    "VALUE" => $value,
					    "CODE" => $key,
					 );
	            }
				Add2BasketByProductID($idTemp, $_GET['quantity'], $arProps);
		}

	}

}
/*$arItems = GetBasketList();
$allCurrency = CSaleLang::GetLangCurrency(SITE_ID);
$num_prodcts = 0;
$allSum= 0;
for ($i = 0; $i<count($arItems); $i++)
{
   $num_prodcts++;
   $allSum += ($arItems[$i]["PRICE"] * $arItems[$i]["QUANTITY"]);
}
$summa = SaleFormatCurrency($allSum, $allCurrency);
echo '{"result":';
echo $num_prodcts;
echo ',"summ":"';
echo $summa;
echo '"}';*/

//require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php"); // можно не выполнять
?>