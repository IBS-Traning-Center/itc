<?
function custom_mail_false ($to, $subject, $message, $additional_headers = "", $additional_parameters = "")
{
	$arFieldsMail["TO"]  =  $to;
	$arFieldsMail["SUBJECT"]  =  $subject;
	$arFieldsMail["ADDITIONAL_HEADERS"]  =  $additional_headers;
	$arFieldsMail["ADDITIONAL_PARAMETERS"]  =  $additional_parameters;
	$arFieldsMail["MESSAGE"]  =  $message;
	AddMessage2Log(print_r($arFieldsMail,1), "my_module_id");

   if ($additional_headers)
   {
      $arHeaders = explode (CEvent::GetMailEOL(), $additional_headers);
      $arNewHeaders = Array ();
      for ($key = 0; $key < count ($arHeaders); $key++)
      {
         $raw_header = $arHeaders[$key];
         if (preg_match ("~^(.*): (.*)$~", $raw_header, $header_matches))
         {
            if ($header_matches[1] == "From" || $header_matches[1] == "Reply-To")
            {
               $From = $header_matches[2];

               if (preg_match ("~^=\?(.*)\?B\?(.*)\?=$~", $From, $matches))
               {
                  $address_encoded = $matches[2];
                  $address_decoded = base64_decode ($address_encoded);
                  for ($line_num = $key + 1; substr ($arHeaders[$line_num], 0, 1) == "\t"; $line_num++)
                  {
                     $next_line = substr ($arHeaders[$line_num], 1);
                     preg_match ("~^=\?(.*)\?B\?(.*)\?=$~", $next_line, $chunk_matches);
                     $address_decoded .= base64_decode ($chunk_matches[2]);
                  }

                  if (preg_match ("~^(.*) <(.*)>$~", $address_decoded, $matches2))
                  {
                     $name_encoded = CEvent::EncodeMimeString ($matches2[1], $matches[1]);
                     $From = $name_encoded." <".$matches2[2].">";
                     $arNewHeaders[] = $header_matches[1].": ".$From;
                     $key = $line_num - 1;
                     continue;
                  }
               }
            }
         }
         $arNewHeaders[] = $arHeaders[$key];
      }
   }

   $additional_headers = join (CEvent::GetMailEOL(), $arNewHeaders);

   mail ($to, $subject, $message, $additional_headers, $additional_parameters);
}
function is_email($email){
  if (function_exists("filter_var")){
    $s=filter_var($email, FILTER_VALIDATE_EMAIL);
    return !empty($s);
  }
  $p = '/^[a-z0-9!#$%&*+-=?^_`{|}~]+(\.[a-z0-9!#$%&*+-=?^_`{|}~]+)*';
  $p.= '@([-a-z0-9]+\.)+([a-z]{2,3}';
  $p.= '|info|arpa|aero|coop|name|museum|mobi)$/ix';
  return preg_match($p, $email);
}
function ShowCustomTitle($PagePropCode=false)
{
        $GLOBALS['APPLICATION']->AddBufferContent('GetCustomTitle', $PagePropCode);
}
function iwrite($str)
{
    global $USER;
    if ($USER->GetID() == 1)
    {
        if (is_array($str))
        {
            echo "<pre>";
            print_r($str);
            echo "</pre>";
        }
        else
        {
            echo $str;
        }
    }
}
function GetCustomTitle($PagePropCode=false)
{
        $result = $GLOBALS['APPLICATION']->GetTitle('title', true);
        $PagePropValue = '';
        if(!empty($PagePropCode))
        {
                $PagePropValue = $GLOBALS['APPLICATION']->GetProperty($PagePropCode);
        }
        if(!empty($PagePropValue) && is_string($PagePropValue))
        {
                $result = $PagePropValue;
        }
        return $result;
}

function Add2BasketByProductIDCustom($PRODUCT_ID, $QUANTITY = 1, $arProductParams = array())
{
	$PRODUCT_ID = IntVal($PRODUCT_ID);
	if ($PRODUCT_ID <= 0)
	{
		$GLOBALS["APPLICATION"]->ThrowException("Empty product field", "EMPTY_PRODUCT_ID");
		return false;
	}

	$QUANTITY = DoubleVal($QUANTITY);
	if ($QUANTITY <= 0)
		$QUANTITY = 1;

	if (!CModule::IncludeModule("sale"))
	{
		$GLOBALS["APPLICATION"]->ThrowException("Sale module is not installed", "NO_SALE_MODULE");
		return false;
	}

	if (CModule::IncludeModule("statistic") && IntVal($_SESSION["SESS_SEARCHER_ID"])>0)
	{
		$GLOBALS["APPLICATION"]->ThrowException("Searcher can not buy anything", "SESS_SEARCHER");
		return false;
	}

	$arProduct = CCatalogProduct::GetByID($PRODUCT_ID);
	if ($arProduct === false)
	{
		$GLOBALS["APPLICATION"]->ThrowException("Product is not found", "NO_PRODUCT");
		return false;
	}

	if ($arProduct["QUANTITY_TRACE"]=="Y" && DoubleVal($arProduct["QUANTITY"])<=0)
	{
		$GLOBALS["APPLICATION"]->ThrowException("Product is run out", "PRODUCT_RUN_OUT");
		return false;
	}

	$CALLBACK_FUNC = "CatalogBasketCallback";
	$arCallbackPrice = CSaleBasket::ReReadPrice($CALLBACK_FUNC, "catalog", $PRODUCT_ID, $QUANTITY);
	if (!is_array($arCallbackPrice) || count($arCallbackPrice) <= 0)
	{
		$GLOBALS["APPLICATION"]->ThrowException("Product price is not found", "NO_PRODUCT_PRICE");
		return false;
	}

//	$arIBlockElement = GetIBlockElement($PRODUCT_ID);
	$dbIBlockElement = CIBlockElement::GetList(array(), array(
					"ID" => $PRODUCT_ID,
					//"ACTIVE_DATE" => "Y",     //single change
					"ACTIVE" => "Y",
					"CHECK_PERMISSIONS" => "Y",
				), false, false, array(
					"ID",
					"IBLOCK_ID",
					"XML_ID",
					"NAME",
					"DETAIL_PAGE_URL",
	));
	$arIBlockElement = $dbIBlockElement->GetNext();

	if ($arIBlockElement == false)
	{
		$GLOBALS["APPLICATION"]->ThrowException("Infoblock element is not found", "NO_IBLOCK_ELEMENT");
		return false;
	}

	$arProps = array();

	$dbIBlock = CIBlock::GetList(
			array(),
			array("ID" => $arIBlockElement["IBLOCK_ID"])
		);
	if ($arIBlock = $dbIBlock->Fetch())
	{
		$arProps[] = array(
				"NAME" => "Catalog XML_ID",
				"CODE" => "CATALOG.XML_ID",
				"VALUE" => $arIBlock["XML_ID"]
			);
	}

	$arProps[] = array(
			"NAME" => "Product XML_ID",
			"CODE" => "PRODUCT.XML_ID",
			"VALUE" => $arIBlockElement["XML_ID"]
		);

	$arPrice = CPrice::GetByID($arCallbackPrice["PRODUCT_PRICE_ID"]);

	$arFields = array(
			"PRODUCT_ID" => $PRODUCT_ID,
			"PRODUCT_PRICE_ID" => $arCallbackPrice["PRODUCT_PRICE_ID"],
			"PRICE" => $arCallbackPrice["PRICE"],
			"CURRENCY" => $arCallbackPrice["CURRENCY"],
			"WEIGHT" => $arProduct["WEIGHT"],
			"QUANTITY" => $QUANTITY,
			"LID" => SITE_ID,
			"DELAY" => "N",
			"CAN_BUY" => "Y",
			"NAME" => $arIBlockElement["~NAME"],
			"CALLBACK_FUNC" => $CALLBACK_FUNC,
			"MODULE" => "catalog",
			//"NOTES" => $arProduct["CATALOG_GROUP_NAME"],
			"NOTES" => $arPrice["CATALOG_GROUP_NAME"],
			"ORDER_CALLBACK_FUNC" => "CatalogBasketOrderCallback",
			"CANCEL_CALLBACK_FUNC" => "CatalogBasketCancelCallback",
			"PAY_CALLBACK_FUNC" => "CatalogPayOrderCallback",
			"DETAIL_PAGE_URL" => $arIBlockElement["DETAIL_PAGE_URL"],
			"CATALOG_XML_ID" => $arIBlock["XML_ID"],
			"PRODUCT_XML_ID" => $arIBlockElement["XML_ID"],
			"VAT_RATE" => $arCallbackPrice['VAT_RATE'],
		);

	if ($arProduct["QUANTITY_TRACE"]=="Y")
	{
		if (IntVal($arProduct["QUANTITY"])-$QUANTITY < 0)
			$arFields["QUANTITY"] = DoubleVal($arProduct["QUANTITY"]);
	}

	if (is_array($arProductParams) && count($arProductParams) > 0)
	{
		for ($i = 0; $i < count($arProductParams); $i++)
		{
			$arProps[] = array(
					"NAME" => $arProductParams[$i]["NAME"],
					"CODE" => $arProductParams[$i]["CODE"],
					"VALUE" => $arProductParams[$i]["VALUE"],
					"SORT" => $arProductParams[$i]["SORT"]
				);
		}
	}
	$arFields["PROPS"] = $arProps;

	$addres = CSaleBasket::Add($arFields);
	if ($addres)
	{
		if (CModule::IncludeModule("statistic"))
			CStatistic::Set_Event("sale2basket", "catalog", $arFields["DETAIL_PAGE_URL"]);
	}

	return $addres;
}

/*
KODIX
Функция для склонения по падежам к числительным.
параметры:
value - число, к которому надо получить склонение - int.
text - массив с падежами, например (товар,товары,товаров)
*/
function getCountVal($value,$text)
{
	if($value>10 && $value<20)
	{
		$res = $text[2];
	}
	else
	{
		switch(substr($value, -1))
		{
			case "1":
				$res =  $text[0];
				break;
			case "2":
				$res =  $text[1];
				break;
			case "3":
				$res =  $text[1];
				break;
			case "4":
				$res =  $text[1];
				break;
			default:
				$res =  $text[2];
				break;
		}
	}
	return $res;
}

function checkHtmlN($str){
	$mystring = 'ul';
	$pos = strpos($str, $mystring);
	if ($pos === false) {
		$str = nl2br($str);
	}
	return $str;
}

?>