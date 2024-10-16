<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!CModule::IncludeModule("iblock"))
{
	return;
}

/*************************************************************************
	Processing of received parameters
*************************************************************************/
if(!isset($arParams["CACHE_TIME"]))
	$arParams["CACHE_TIME"] = 3600;

unset($arParams["IBLOCK_TYPE"]); //was used only for IBLOCK_ID setup with Editor

/*************************************************************************
	my fixed
*************************************************************************/
if (is_array($arParams["IBLOCK_ID"]))
   foreach($arParams["IBLOCK_ID"] as $key=>$val)
        $arParams["IBLOCK_ID"][$key] = intval($arParams["IBLOCK_ID"][$key]);
else
   $arParams["IBLOCK_ID"] = intval($arParams["IBLOCK_ID"]);
/*************************************************************************
	my fixed end
*************************************************************************/

$arParams["SECTION_ID"] = intval($arParams["SECTION_ID"]);
$arParams["NUM_DAYS"] = intval($arParams["NUM_DAYS"]);
$arParams["NUM_NEWS"] = intval($arParams["NUM_NEWS"]);

if(!array_key_exists("RSS_TTL", $arParams))
	$arParams["RSS_TTL"] = 60;
$arParams["RSS_TTL"] = intval($arParams["RSS_TTL"]);

$arParams["YANDEX"] = $arParams["YANDEX"]=="Y";

$arParams["SORT_BY1"] = trim($arParams["SORT_BY1"]);
if(strlen($arParams["SORT_BY1"])<=0)
	$arParams["SORT_BY1"] = "ACTIVE_FROM";
if($arParams["SORT_ORDER1"]!="ASC")
	 $arParams["SORT_ORDER1"]="DESC";
if(strlen($arParams["SORT_BY2"])<=0)
	$arParams["SORT_BY2"] = "SORT";
if($arParams["SORT_ORDER2"]!="DESC")
	 $arParams["SORT_ORDER2"]="ASC";

$bDesignMode = $GLOBALS["APPLICATION"]->GetShowIncludeAreas() && is_object($GLOBALS["USER"]) && $GLOBALS["USER"]->IsAdmin();

if(!$bDesignMode)
{
	$APPLICATION->RestartBuffer();
	header("Content-Type: text/xml");
	header("Pragma: no-cache");
}
/*************************************************************************
	Start caching
*************************************************************************/
if($this->StartResultCache(false, array($USER->GetGroups(),$bDesignMode)))
{
	$rsResult = CIBlock::GetList(array(), array(
		"ACTIVE" => "Y",
		"SITE_ID" => SITE_ID,
		"ID" => $arParams["IBLOCK_ID"],
	));
	$arResult = $rsResult->GetNext();
	if(!$arResult)
	{
		$this->AbortResultCache();
		if($bDesignMode)
		{
			ShowError(GetMessage("CT_RO_IBLOCK_NOT_FOUND"));
			return;
		}
		else
			die();
	}

	$arResult["RSS_TTL"] = $arParams["RSS_TTL"];

	if ( $arParams["RSS_NAME"] )
	$arResult["NAME"] = htmlspecialchars($arParams["RSS_NAME"]);

	if($arParams["SECTION_ID"] > 0)
	{
		$rsResult = CIBlockSection::GetList(array(), array(
			"ID" => $arParams["SECTION_ID"],
			"ACTIVE" => "Y",
			"GLOBAL_ACTIVE" => "Y",
			"IBLOCK_ID" => $arParams["IBLOCK_ID"],
			"IBLOCK_ACTIVE" => "Y",
		));
		$arResult["SECTION"] = $rsResult->GetNext();
		if(!$arResult["SECTION"])
		{
			$this->AbortResultCache();
			if($bDesignMode)
			{
				ShowError(GetMessage("CT_RO_SECTION_NOT_FOUND"));
				return;
			}
			else
				die();
		}
	}

	if(!isset($arResult["SERVER_NAME"]) || strlen($arResult["SERVER_NAME"]) <= 0)
	{
		$arResult["SERVER_NAME"] = "";
		$rsSite = CSite::GetList(($b="sort"), ($o="asc"), array("LID" => $arResult["LID"]));
		if($arSite = $rsSite->Fetch())
			$arResult["SERVER_NAME"] = $arSite["SERVER_NAME"];
		if(strlen($arResult["SERVER_NAME"])<=0 && defined("SITE_SERVER_NAME"))
			$arResult["SERVER_NAME"] = SITE_SERVER_NAME;
		if(strlen($arResult["SERVER_NAME"])<=0)
			$arResult["SERVER_NAME"] = COption::GetOptionString("main", "server_name", "www.bitrixsoft.com");
	}

	$arResult["PICTURE"] = CFile::GetFileArray($arResult["PICTURE"]);

	$arResult["NODES"] = CIBlockRSS::GetNodeList($arResult["ID"]);

	$arSelect = array(
		"ID",
		"CODE",
		"XML_ID",
		"IBLOCK_ID",
		"NAME",
		"SORT",
		"DETAIL_PAGE_URL",
		"PREVIEW_TEXT",
		"PREVIEW_TEXT_TYPE",
		"DETAIL_TEXT",
		"DETAIL_TEXT_TYPE",
		"PREVIEW_PICTURE",
		"DETAIL_PICTURE",
		"IBLOCK_SECTION_ID",
		"DATE_ACTIVE_FROM",
		"ACTIVE_FROM",
		"DATE_ACTIVE_TO",
		"ACTIVE_TO",
		"SHOW_COUNTER",
		"SHOW_COUNTER_START",
		"IBLOCK_TYPE_ID",
		"IBLOCK_CODE",
		"IBLOCK_EXTERNAL_ID",
		"DATE_CREATE",
		"CREATED_BY",
		"TIMESTAMP_X",
		"MODIFIED_BY",
		"PROPERTY_*",
	);
	$arFilter = array (
		"ACTIVE_DATE" => "Y",
		"ACTIVE" => "Y",
		"CHECK_PERMISSIONS" => "Y",
	);
	if($arParams["SECTION_ID"]>0)
	{
		$arFilter["SECTION_ID"] = $arParams["SECTION_ID"];
		if($arParams["INCLUDE_SUBSECTIONS"])
			$arFilter["INCLUDE_SUBSECTIONS"] = "Y";
	}
	else
	{
		$arFilter["IBLOCK_ID"] = $arParams["IBLOCK_ID"];
	}
	if($arParams["NUM_DAYS"]>0)
		$arFilter["ACTIVE_FROM"] = date($DB->DateFormatToPHP(CLang::GetDateFormat("FULL")), mktime(date("H"), date("i"), date("s"), date("m"), date("d")-IntVal($arParams["NUM_DAYS"]), date("Y")));

	$arSort = array(
		$arParams["SORT_BY1"] => $arParams["SORT_ORDER1"],
		$arParams["SORT_BY2"] => $arParams["SORT_ORDER2"],
	);
	if(!array_key_exists("ID", $arSort))
		$arSort["ID"] = "DESC";

	if($arParams["NUM_NEWS"]>0)
		$limit = array("nTopCount"=>$arParams["NUM_NEWS"]);
	else
		$limit = false;

	$arResult["ITEMS"]=array();
	$rsElements = CIBlockElement::GetList($arSort, $arFilter, false, $limit, $arSelect);
	while($obElement = $rsElements->GetNextElement())
	{
		$arElement = $obElement->GetFields();

		if(strlen($arParams["DETAIL_URL"])>0)
		{
			$arElement["DETAIL_PAGE_URL"] = htmlspecialchars(str_replace(
				array("#SERVER_NAME#", "#SITE_DIR#", "#IBLOCK_ID#", "#SECTION_ID#", "#ELEMENT_ID#"),
				array(SITE_SERVER_NAME, SITE_DIR, $arElement["IBLOCK_ID"], $arElement["IBLOCK_SECTION_ID"], $arElement["ID"]),
				$arParams["DETAIL_URL"]
			));
		}

		$arElement["arr_PREVIEW_PICTURE"] = $arElement["PREVIEW_PICTURE"] = CFile::GetFileArray($arElement["PREVIEW_PICTURE"]);
		if(is_array($arElement["arr_PREVIEW_PICTURE"]))
			$arElement["PREVIEW_PICTURE"] = "http://".$arResult["SERVER_NAME"].$arElement["arr_PREVIEW_PICTURE"]["SRC"];
		$arElement["arr_DETAIL_PICTURE"] = $arElement["DETAIL_PICTURE"] = CFile::GetFileArray($arElement["DETAIL_PICTURE"]);
		if(is_array($arElement["arr_DETAIL_PICTURE"]))
			$arElement["DETAIL_PICTURE"] = "http://".$arResult["SERVER_NAME"].$arElement["arr_DETAIL_PICTURE"]["SRC"];

		$arProperties = $obElement->GetProperties();
		if(strlen($arResult["NODES"]["title"])>0)
		{
			$arItem["title"] = $arResult["NODES"]["title"];
			foreach($arProperties as $code=>$arProperty)
				$arItem["title"] = str_replace("#".$code."#",$arProperty["VALUE"],$arItem["title"]);
			foreach($arElement as $code=>$value)
				$arItem["title"] = str_replace("#".$code."#",$value,$arItem["title"]);
		}
		else
		{
			$arItem["title"] = $arElement["NAME"];
		}
		$arItem["title"] = htmlspecialchars($arItem["title"]);

		if(strlen($arResult["NODES"]["link"])>0)
		{
			$arItem["link"] = $arResult["NODES"]["link"];
			foreach($arProperties as $code=>$arProperty)
				$arItem["link"] = str_replace("#".$code."#",$arProperty["VALUE"],$arItem["link"]);
			foreach($arElement as $code=>$value)
				$arItem["link"] = str_replace("#".$code."#",$value,$arItem["link"]);
		}
		elseif($arProperties["DOC_LINK"]["VALUE"])
		{
			$arItem["link"]="http://".$arResult["SERVER_NAME"].$arProperties["DOC_LINK"]["VALUE"];
		}
		else
		{
			$arItem["link"]="http://".$arResult["SERVER_NAME"].htmlspecialchars($arElement["DETAIL_PAGE_URL"]);
		}

		if(strlen($arResult["NODES"]["description"])>0)
		{
			$arItem["description"] = $arResult["NODES"]["description"];
			foreach($arProperties as $code=>$arProperty)
				$arItem["description"] = str_replace("#".$code."#",$arProperty["VALUE"],$arItem["description"]);
			foreach($arElement as $code=>$value)
				$arItem["description"] = str_replace("#".$code."#",$value,$arItem["description"]);
		}
		else
		{
			$arItem["description"]=htmlspecialchars(($arElement["PREVIEW_TEXT"] || $arParams["YANDEX"]) ? $arElement["PREVIEW_TEXT"] : $arElement["DETAIL_TEXT"]);
		}
		if(strlen($arResult["NODES"]["enclosure"])>0)
		{
			$arItem["enclosure"]=array();
			$arItem["enclosure"]["url"]=$arResult["NODES"]["enclosure"];
			foreach($arProperties as $code=>$arProperty)
				$arItem["enclosure"]["url"] = str_replace("#".$code."#",$arProperty["VALUE"],$arItem["enclosure"]["url"]);
			foreach($arElement as $code=>$value)
				$arItem["enclosure"]["url"] = str_replace("#".$code."#",$value,$arItem["enclosure"]["url"]);
			$arItem["enclosure"]["length"]=$arResult["NODES"]["enclosure_length"];
			foreach($arProperties as $code=>$arProperty)
				$arItem["enclosure"]["length"] = str_replace("#".$code."#",$arProperty["VALUE"],$arItem["enclosure"]["length"]);
			foreach($arElement as $code=>$value)
				$arItem["enclosure"]["length"] = str_replace("#".$code."#",$value,$arItem["enclosure"]["length"]);
			$arItem["enclosure"]["type"]=$arResult["NODES"]["enclosure_type"];
			foreach($arProperties as $code=>$arProperty)
				$arItem["enclosure"]["type"] = str_replace("#".$code."#",$arProperty["VALUE"],$arItem["enclosure"]["type"]);
			foreach($arElement as $code=>$value)
				$arItem["enclosure"]["type"] = str_replace("#".$code."#",$value,$arItem["enclosure"]["type"]);
		}
		elseif(is_array($arElement["arr_PREVIEW_PICTURE"]))
		{
			$arItem["enclosure"]=array();
			$arItem["enclosure"]["url"]="http://".$arResult["SERVER_NAME"].$arElement["arr_PREVIEW_PICTURE"]["SRC"];
			$arItem["enclosure"]["length"]=$arElement["arr_PREVIEW_PICTURE"]["FILE_SIZE"];
			$arItem["enclosure"]["type"]=$arElement["arr_PREVIEW_PICTURE"]["CONTENT_TYPE"];
		}
		else
		{
			$arItem["enclosure"]=false;
		}
		if(strlen($arResult["NODES"]["category"])>0)
		{
			$arItem["category"] = $arResult["NODES"]["category"];
			foreach($arProperties as $code=>$arProperty)
				$arItem["category"] = str_replace("#".$code."#",$arProperty["VALUE"],$arItem["category"]);
			foreach($arElement as $code=>$value)
				$arItem["category"] = str_replace("#".$code."#",$value,$arItem["category"]);
		}
		else
		{
			$arItem["category"] = "";
			$rsNavChain = CIBlockSection::GetNavChain($arResult["ID"], $arElement["IBLOCK_SECTION_ID"]);
			while($arNavChain = $rsNavChain->GetNext())
			{
				$arItem["category"] .= $arNavChain["NAME"]."/";
			}
		}
		if($arParams["YANDEX"])
		{
			$arItem["full-text"] = htmlspecialchars($arElement["DETAIL_TEXT"]);
		}
		if(strlen($arResult["NODES"]["pubDate"])>0)
		{
			$arItem["pubDate"] = $arResult["NODES"]["pubDate"];
			foreach($arProperties as $code=>$arProperty)
				$arItem["pubDate"] = str_replace("#".$code."#",$arProperty["VALUE"],$arItem["pubDate"]);
			foreach($arElement as $code=>$value)
				$arItem["pubDate"] = str_replace("#".$code."#",$value,$arItem["pubDate"]);
		}
		elseif(strlen($arElement["ACTIVE_FROM"])>0)
		{
			$arItem["pubDate"]=date("r", MkDateTime($DB->FormatDate($arElement["ACTIVE_FROM"], Clang::GetDateFormat("FULL"), "DD.MM.YYYY H:I:S"), "d.m.Y H:i:s"));
		}
		else
		{
			$arItem["pubDate"]=date("r");
		}
		$arItem["ELEMENT"] = $arElement;
		$arItem["PROPERTIES"] = $arProperties;
		$arResult["ITEMS"][]=$arItem;
	}
	if($bDesignMode)
	{
		ob_start();
		$this->IncludeComponentTemplate();
		$contents = ob_get_contents();
		ob_end_clean();
		echo "<pre>",htmlspecialchars($contents),"</pre>";
	}
	else
		$this->IncludeComponentTemplate();
}
if(!$bDesignMode)
	die();
?>
