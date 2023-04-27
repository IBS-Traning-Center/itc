<?
//<title>Yandex simple</title>
__IncludeLang(GetLangFileName($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/catalog/lang/", "/export_setup_templ.php"));
set_time_limit(0);

global $APPLICATION;

global $USER;
$bTmpUserCreated = false;
if (!isset($USER) || !(($USER instanceof CUser) && ('CUser' == get_class($USER))))
{
    $bTmpUserCreated = true;
    if (isset($USER))
    {
        $USER_TMP = $USER;
        unset($USER);
    }

    $USER = new CUser();
}

CCatalogDiscountSave::Disable();

function yandex_replace_special($arg)
{
    if (in_array($arg[0], array("&quot;", "&amp;", "&lt;", "&gt;")))
        return $arg[0];
    else
        return " ";
}

function yandex_text2xml($text, $bHSC = false, $bDblQuote = false)
{
    global $APPLICATION;

    $bHSC = (true == $bHSC ? true : false);
    $bDblQuote = (true == $bDblQuote ? true: false);

    if ($bHSC)
    {
        $text = htmlspecialcharsbx($text);
        if ($bDblQuote)
            $text = str_replace('&quot;', '"', $text);
    }
    $text = preg_replace('/[\x01-\x08\x0B-\x0C\x0E-\x1F]/', "", $text);
    $text = str_replace("'", "&apos;", $text);
    $text = $APPLICATION->ConvertCharset($text, LANG_CHARSET, 'windows-1251');
    return $text;
}

$strExportErrorMessage = "";

$SETUP_SERVER_NAME = trim($SETUP_SERVER_NAME);
if (strlen($SETUP_FILE_NAME)<=0)
{
    $strExportErrorMessage .= GetMessage("CET_ERROR_NO_FILENAME")."<br>";
}
elseif (preg_match(BX_CATALOG_FILENAME_REG,$SETUP_FILE_NAME))
{
    $strExportErrorMessage .= GetMessage("CES_ERROR_BAD_EXPORT_FILENAME")."<br>";
}

if (strlen($strExportErrorMessage) <= 0)
{
    $SETUP_FILE_NAME = Rel2Abs("/", $SETUP_FILE_NAME);

    /*	if ($APPLICATION->GetFileAccessPermission($SETUP_FILE_NAME) < "W")
        {
            $strExportErrorMessage .= str_replace("#FILE#", $SETUP_FILE_NAME, GetMessage('CET_YAND_RUN_ERR_SETUP_FILE_ACCESS_DENIED'))."\n";
        } */
}

if (strlen($strExportErrorMessage)<=0)
{
    if (!$fp = @fopen($_SERVER["DOCUMENT_ROOT"].$SETUP_FILE_NAME, "wb"))
    {
        $strExportErrorMessage .= str_replace('#FILE#',$_SERVER["DOCUMENT_ROOT"].$SETUP_FILE_NAME, GetMessage('CET_YAND_RUN_ERR_SETUP_FILE_OPEN_WRITING'))."\n";
    }
    else
    {
        if (!@fwrite($fp, '<?if (!isset($_GET["referer1"]) || strlen($_GET["referer1"])<=0) $_GET["referer1"] = "yandext"?>'))
        {
            $strExportErrorMessage .= str_replace('#FILE#',$_SERVER["DOCUMENT_ROOT"].$SETUP_FILE_NAME, GetMessage('CET_YAND_RUN_ERR_SETUP_FILE_WRITE'))."\n";
            @fclose($fp);
        }
        else
        {
            /*
           fwrite($fp, '<? $strReferer1 = htmlspecialchars($_GET["referer1"]); ?>');
           fwrite($fp, '<?if (!isset($_GET["referer2"]) || strlen($_GET["referer2"]) <= 0) $_GET["referer2"] = "";?>');
           fwrite($fp, '<? $strReferer2 = htmlspecialchars($_GET["referer2"]); ?>');
            */
        }
    }
}

if (strlen($strExportErrorMessage)<=0)
{
    @fwrite($fp, '<? header("Content-Type: text/xml; charset=windows-1251");?>');
    @fwrite($fp, '<? echo "<"."?xml version=\"1.0\" encoding=\"windows-1251\"?".">"?>');
    @fwrite($fp, "\n<!DOCTYPE yml_catalog SYSTEM \"shops.dtd\">\n");
    @fwrite($fp, "<yml_catalog date=\"".Date("Y-m-d H:i")."\">\n");
    @fwrite($fp, "<shop>\n");
    @fwrite($fp, "<name>".$APPLICATION->ConvertCharset(htmlspecialcharsbx(COption::GetOptionString("main", "site_name", "")), LANG_CHARSET, 'windows-1251')."</name>\n");
    @fwrite($fp, "<company>".$APPLICATION->ConvertCharset(htmlspecialcharsbx(COption::GetOptionString("main", "site_name", "")), LANG_CHARSET, 'windows-1251')."</company>\n");
    @fwrite($fp, "<url>http://".htmlspecialcharsbx(strlen($SETUP_SERVER_NAME) > 0 ? $SETUP_SERVER_NAME : COption::GetOptionString("main", "server_name", ""))."</url>\n");

    $db_acc = CCurrency::GetList(($by="sort"), ($order="asc"));
    $strTmp = "<currencies>\n";
    $arCurrencyAllowed = array('RUR', 'RUB', 'USD', 'EUR', 'UAH', 'BYR', 'KZT');
    while ($arAcc = $db_acc->Fetch())
    {
        if (in_array($arAcc['CURRENCY'], $arCurrencyAllowed))
            $strTmp.= "<currency id=\"".$arAcc["CURRENCY"]."\" rate=\"".(CCurrencyRates::ConvertCurrency(1, $arAcc["CURRENCY"], "RUR"))."\"/>\n";
    }
    $strTmp.= "</currencies>\n";

    @fwrite($fp, $strTmp);

    //*****************************************//

    $arSelect = array("ID", "LID", "IBLOCK_ID", "IBLOCK_SECTION_ID", "ACTIVE", "ACTIVE_FROM", "ACTIVE_TO", "NAME", "PREVIEW_PICTURE", "PREVIEW_TEXT", "PREVIEW_TEXT_TYPE", "DETAIL_PICTURE", "LANG_DIR", "DETAIL_PAGE_URL", "PROPERTY_*");
    $db_res = CCatalogGroup::GetGroupsList(array("GROUP_ID"=>2));
    $arPTypes = array();
    while ($ar_res = $db_res->Fetch())
    {
        if (!in_array($ar_res["CATALOG_GROUP_ID"], $arPTypes))
        {
            $arPTypes[] = $ar_res["CATALOG_GROUP_ID"];
            $arSelect[] = "CATALOG_GROUP_".$ar_res["CATALOG_GROUP_ID"];
        }
    }

    $strTmpCat = "";
    $strTmpOff = "";

    if (is_array($YANDEX_EXPORT))
    {
        $arSiteServers = array();

        foreach ($YANDEX_EXPORT as $ykey => $yvalue)
        {
            $filter = Array("IBLOCK_ID"=>50, "ACTIVE"=>"Y");
            $db_acc = CIBlockElement::GetList(Array(), $filter, false, false, array("ID", "NAME"));

            $arAvailGroups = array();
            while ($arAcc = $db_acc->GetNext())
            {
                $strTmpCat.= "<category parentId='1' id=\"".$arAcc["ID"]."\"".(intval($arAcc["IBLOCK_SECTION_ID"])>0?" parentId=\"".$arAcc["IBLOCK_SECTION_ID"]."\"":"").">".yandex_text2xml($arAcc["NAME"], true)."</category>\n";
                $arAvailGroups[] = intval($arAcc["ID"]);
            }

            //*****************************************//

            $filter = Array("IBLOCK_ID"=>intval($yvalue), "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", "!PROPERTY_short_descr"=>false);
            $res = CIBlockElement::GetList(array(), $filter, false, false, $arSelect);

            $total_sum=0;
            $is_exists=false;
            $cnt=0;

            while ($arAcc = $res->GetNext())
            {
                if (strlen($SETUP_SERVER_NAME) <= 0)
                {
                    if (!array_key_exists($arAcc['LID'], $arSiteServers))
                    {
                        $rsSite = CSite::GetList(($b="sort"), ($o="asc"), array("LID" => $arAcc["LID"]));
                        if($arSite = $rsSite->Fetch())
                            $arAcc["SERVER_NAME"] = $arSite["SERVER_NAME"];
                        if(strlen($arAcc["SERVER_NAME"])<=0 && defined("SITE_SERVER_NAME"))
                            $arAcc["SERVER_NAME"] = SITE_SERVER_NAME;
                        if(strlen($arAcc["SERVER_NAME"])<=0)
                            $arAcc["SERVER_NAME"] = COption::GetOptionString("main", "server_name", "");

                        $arSiteServers[$arAcc['LID']] = $arAcc['SERVER_NAME'];
                    }
                    else
                    {
                        $arAcc['SERVER_NAME'] = $arSiteServers[$arAcc['LID']];
                    }
                }
                else
                {
                    $arAcc['SERVER_NAME'] = $SETUP_SERVER_NAME;
                }

                $str_QUANTITY = doubleval($arAcc["CATALOG_QUANTITY"]);
                $str_AVAILABLE = ' available="false"';
                $minPrice = 0;
                $minPriceRUR = 0;
                $minPriceGroup = 0;
                $minPriceCurrency = "";
                $tmpPrice = $arAcc["PROPERTY_32"];
                if ($minPriceRUR<=0 || $minPriceRUR>$tmpPrice)
                    {
                       $minPriceCurrency = "RUR";
                       $minPrice = $tmpPrice;
                    }


                if ($minPrice <= 0) continue;

                $bNoActiveGroup = true;
                $strTmpOff_tmp = "";
                $strTmpOff_tmp.= "<categoryId>".$arAcc["PROPERTY_46"]."</categoryId>\n";
                $bNoActiveGroup= false;
                if ($bNoActiveGroup) continue;

                if (strlen($arAcc['DETAIL_PAGE_URL']) <= 0) $arAcc['DETAIL_PAGE_URL'] = '/';
                else $arAcc['DETAIL_PAGE_URL'] = str_replace(' ', '%20', $arAcc['DETAIL_PAGE_URL']);
				if ((preg_match('#JVA#', $arAcc["PROPERTY_31"])) || (preg_match('#ARC#', $arAcc["PROPERTY_31"]))) {
					$bid=100;
				} else {
					$bid=50;
				}
                $strTmpOff.= "<offer id=\"".$arAcc["ID"]."\"".$str_AVAILABLE." bid='".$bid."'>\n";
                $strTmpOff.= "<url>http://".$arAcc['SERVER_NAME'].htmlspecialcharsbx($arAcc["~DETAIL_PAGE_URL"]).(strstr($arAcc['DETAIL_PAGE_URL'], '?') === false ? '?' : '&amp;')."r1=ya&amp;r2=market</url>\n";
			
                $strTmpOff.= "<price>".$minPrice."</price>\n";
                $strTmpOff.= "<currencyId>".$minPriceCurrency."</currencyId>\n";
				$strTmpOff.= $strTmpOff_tmp;
				
                if (intval($arAcc["DETAIL_PICTURE"])>0 || intval($arAcc["PREVIEW_PICTURE"])>0)
                {
                    $pictNo = intval($arAcc["DETAIL_PICTURE"]);
                    if ($pictNo<=0) $pictNo = intval($arAcc["PREVIEW_PICTURE"]);

                    $arPictInfo = CFile::GetFileArray($pictNo);
                    if (is_array($arPictInfo))
                    {
                        if(substr($arPictInfo["SRC"], 0, 1) == "/")
                            $strFile = "http://".$arAcc['SERVER_NAME'].implode("/", array_map("rawurlencode", explode("/", $arPictInfo["SRC"])));
                        elseif(preg_match("/^(http|https):\\/\\/(.*?)\\/(.*)\$/", $arPictInfo["SRC"], $match))
                            $strFile = "http://".$match[2].'/'.implode("/", array_map("rawurlencode", explode("/", $match[3])));
                        else
                            $strFile = $arPictInfo["SRC"];
                        $strTmpOff.="<picture>".$strFile."</picture>\n";
                    }
                }
				
				$arAcc["NAME"]='Курс "'.$arAcc["NAME"].'"';
				$strTmpOff.= "<name>".yandex_text2xml($arAcc["NAME"], true)."</name>\n";
                $strTmpOff.=
                    "<description>".
                        htmlspecialchars($arAcc["~PROPERTY_561"]).
                    "</description>\n";
				$strTmpOff.="<sales_notes>Необходима предоплата.</sales_notes>\n";
                $strTmpOff.= "</offer>\n";
            }
        }
    }

    @fwrite($fp, "<categories>\n");
	@fwrite($fp, "<category id='1'>Обучение, семинары и тренинги</category>\n");
    @fwrite($fp, $strTmpCat);
    @fwrite($fp, "</categories>\n");

    @fwrite($fp, "<offers>\n");
    @fwrite($fp, $strTmpOff);
    @fwrite($fp, "</offers>\n");

    @fwrite($fp, "</shop>\n");
    @fwrite($fp, "</yml_catalog>\n");

    @fclose($fp);
}

CCatalogDiscountSave::Enable();

if ($bTmpUserCreated)
{
    unset($USER);
    if (isset($USER_TMP))
    {
        $USER = $USER_TMP;
        unset($USER_TMP);
    }
}
?>