<?php
define("NO_KEEP_STATISTIC", true); // Не собираем стату по действиям AJAX
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$action=$_REQUEST["action"];
if (CModule::IncludeModule("sale") && CModule::IncludeModule("catalog"))
	{
		
	   if (($action == "ADD2BASKET" || $action == "BUY") && IntVal($_GET['id'])>0 && IntVal($_GET['quantity']>0) && strlen(trim($_GET["dis"]))==0)
	    {
            $idTemp = intval($_REQUEST["id"]);
            $arPropsTemp = GetFullInfoAboutCourse($idTemp);
            foreach ($arPropsTemp as $key => $value) {
                $arProps[] = array(
                    "NAME" => $key,
                    "VALUE" => $value,
                    "CODE" => $key,
                );
            }

            if (IntVal($_GET['dprice']) > 0) {

                $arTempCurrency = 'RUB';

                $db_res = CPrice::GetList(array(), array("PRODUCT_ID" => $idTemp, "CATALOG_GROUP_ID" => 1));
                if ($ar_res = $db_res->Fetch()) {
                    $arTempCurrency=$ar_res["CURRENCY"];
                }


                $ar_res = CIBlockElement::GetByID($idTemp)->Fetch();
                $result = array(
                    'PRODUCT_ID' => $ar_res['ID'],
                    'PREVIEW_PICTURE' => $ar_res['PREVIEW_PICTURE'],
                    'PRODUCT_XML_ID' => $ar_res['XML_ID'],
                    'CATALOG_GROUP_ID' => '1',
                    'PRICE' => floatval($_REQUEST['dprice']),
                    'CUSTOM_PRICE' => 'Y',
                    'CURRENCY' => $arTempCurrency,
                    'QUANTITY' => 1,
                    'LID' => SITE_ID,
                    'DELAY' => 'N',
                    'CAN_BUY' => 'Y',
                    'NAME' => htmlspecialchars_decode($ar_res['NAME']),
                    'MODULE' => 'catalog',
                    'NOTES' => '',
                    'DETAIL_PAGE_URL' => $ar_res['DETAIL_PAGE_URL']
                );

                $result["PROPS"] = $arProps;
                CSaleBasket::Add($result);
            } else {

                $db_res = CPrice::GetList(array(), array("PRODUCT_ID" => $idTemp, "CATALOG_GROUP_ID" => 1));
                if ($ar_res = $db_res->Fetch()) {
                    Add2Basket(
                        $ar_res['ID'],
                        $_GET['quantity'],
                        array(
                            "IGNORE_CALLBACK_FUNC"  => "Y",
                            "PRODUCT_PROVIDER_CLASS" => "",
                            "CUSTOM_PRICE" => "Y",
                            "PRICE" => $ar_res['PRICE']),
                        $arProps
                    );
                } else {
                    Add2BasketByProductID($idTemp, $_GET['quantity'], $arProps);
                }
            }
		} elseif (($action == "ADD2BASKET" || $action == "BUY") && IntVal($_GET['id'])>0 && IntVal($_GET['quantity']>0) && strlen($_GET["dis"])>0) {
			
           $idTemp = intval($_REQUEST["id"]);
           $arPropsTemp =  GetFullInfoAboutCourse($idTemp);
           $db_res = CPrice::GetList(
               array(),
               array(
                   "PRODUCT_ID" => $idTemp,
                   "CATALOG_GROUP_ID" => 1
               )
           );

           if ($ar_res = $db_res->Fetch())
           {

              $arTempPrice=fn_GetCourseDis($idTemp, $ar_res["PRICE"]);
              $arTempCurrency=$ar_res["CURRENCY"];
               foreach ($arPropsTemp as $key => $value )
               {
                   $arProps[] = array(
                       "NAME" => $key,
                       "VALUE" => $value,
                       "CODE" => $key,
                   );
               }
               $arFields = array(
                   "PRODUCT_ID" => $idTemp,
                   "CURRENCY" => $arTempCurrency,
                   "NAME" => $arPropsTemp["COURSE_NAME"],
                   "PRICE" => $arTempPrice,
                   "QUANTITY" => $_GET['quantity'],
                   "LID" => LANG,
                   "DELAY" => "N",
				   "DETAIL_PAGE_URL"=>$arPropsTemp["DETAIL_PAGE_URL"],
                   "CAN_BUY" => "Y",
				   "PRODUCT_PROVIDER_CLASS"=> 'CCatalogProductProvider'
                   );
               $arFields["PROPS"] = $arProps;
               CSaleBasket::Add($arFields);
           }
		}

	}
	if ($action == "BUY") {
		LocalRedirect("/personal/cart/");
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