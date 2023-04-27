<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) {
    die();
}

/**
 * Языковой файл.
 * По умолчанию должен располагаться в по следующему пути
 * относительно данного файла
 * lang/ru/prop_elist_ajax.php
 */
include_once(GetLangFileName(dirname(__FILE__)."/lang/", "/prop_elist_ajax.php"));

/**
 * Для корректной работы нужно изменить 2 параметра
 * 1) установаить путь к JavaScript скрипте
 * для этого нужно прописать путь относительно корня сайта
 * в свойстве
 * CIBlockPropertyElementListAjax::$pathToJS
 *
 * 2) в JavaScript скрипте прописать путь к файлу (скрипту)
 * поиска элементов. Для этого в файле ikso.elist_ajax.js
 * нужно прописать путь к файлу
 * EATool -> t.pathToSearch (строка 18 в функцие EATool)
 *
 * 3) Если Вы разместите скрипт в папке /bitrix/php_interface
 * то он может не работать, т.к. в этой папке по-умолчанию
 * находится .htaccess который запрещает доступ к этой папке.
 * По этому или отредактируйте .htaccess убрав строку
 * Deny from All
 * или разместите файлы:
 * ikso.elist_ajax.js
 * search_elist_ajax.php
 * в другом месте.
 */
class CIBlockPropertyElementListAjax
{
    /**
     * Путь к javascript скрипту, который будет выводить
     * в выпадающем списке найденные варианты
     */
    public static $pathToJS = '/bitrix/php_interface/ikso/js/ikso.elist_ajax.js';

    /**
     * Описание св-ва
     */
    public static function GetUserTypeDescription()
    {
        return array(
            "PROPERTY_TYPE"         => "E",
            "USER_TYPE"             => "EListAjax",
            "DESCRIPTION"           => GetMessage("IBLOCK_PROP_ELISTAJAX_DESC"),
            "GetPropertyFieldHtml"  => array("CIBlockPropertyElementListAjax","GetPropertyFieldHtml"),
        );
    }

    /**
     * Получаем значение св-ва для публичной части
     */
	public static function GetPublicViewHTML($arProperty, $value, $strHTMLControlName)
	{
		static $cache = array();

		if ($strHTMLControlName["MODE"] == "CSV_EXPORT")
		{
			return $value["VALUE"];
		}
		elseif (strlen($value["VALUE"]) > 0)
		{
			if (!array_key_exists($value["VALUE"], $cache))
			{
				$db_res = CIBlockElement::GetList(
					array(),
					array("ID" => $value["VALUE"], "SHOW_HISTORY" => "Y"),
					false,
					false,
					array("ID", "IBLOCK_TYPE_ID", "IBLOCK_ID", "NAME", "DETAIL_PAGE_URL")
				);
				$ar_res = $db_res->GetNext();
				if ($ar_res)
                {
                    $cache[$value["VALUE"]] = '<a href="'.$ar_res["DETAIL_PAGE_URL"].'">'.$ar_res["NAME"].'</a>';
                }
				else
                {
                    $cache[$value["VALUE"]] = htmlspecialchars($value["VALUE"]);
                }
			}
			return $cache[$value["VALUE"]];
		}
		else
		{
			return '';
		}
	}

    /**
     * Получаем значение св-ва для отображения в списке (адми. часть)
     */
	public static function GetAdminListViewHTML($arProperty, $value, $strHTMLControlName)
	{
		static $cache = array();
		if (strlen($value["VALUE"]) > 0)
		{
			if (!array_key_exists($value["VALUE"], $cache))
			{
				$db_res = CIBlockElement::GetList(
					array(),
					array("ID" => $value["VALUE"], "SHOW_HISTORY" => "Y"),
					false,
					false,
					array("ID", "IBLOCK_TYPE_ID", "IBLOCK_ID", "NAME")
				);
				$ar_res = $db_res->GetNext();
				if ($ar_res)
                {
					$cache[$value["VALUE"]] = htmlspecialchars($ar_res['NAME']).
					' [<a href="'.
					'/bitrix/admin/iblock_element_edit.php?'.
					'type='.urlencode($ar_res['IBLOCK_TYPE_ID']).
					'&amp;IBLOCK_ID='.$ar_res['IBLOCK_ID'].
					'&amp;ID='.$ar_res['ID'].
					'&amp;lang='.LANGUAGE_ID.
					'" title="'.GetMessage("IBLOCK_PROP_EL_EDIT").'">'.$ar_res['ID'].'</a>]';
                }
				else
                {
					$cache[$value["VALUE"]] = htmlspecialchars($value["VALUE"]);
                }
			}
			return $cache[$value["VALUE"]];
		}
		else
		{
			return '&nbsp;';
		}
	}

    /**
     * Получаем форму для редактирования св-ва
     */
	public static function GetPropertyFieldHtml($arProperty, $value, $strHTMLControlName)
	{
		$ar_res = false;
		if (strlen($value["VALUE"]))
		{
			$db_res = CIBlockElement::GetList(
				array(),
				array("ID" => $value["VALUE"], "SHOW_HISTORY" => "Y"),
				false,
				false,
				array("ID", "IBLOCK_ID", "NAME", "CODE")
			);
			$ar_res = $db_res->GetNext();
		}

		if (!$ar_res)
        {
			$ar_res = array("NAME" => "");
        }

        $res = '';

        if (!isset($GLOBALS['IKSO_ELIST_AJAX_JS_INLCUDED']))
        {
            $res .= '<script type="text/javascript" src="' . self::$pathToJS . '"></script>';
            $GLOBALS['IKSO_ELIST_AJAX_JS_INLCUDED'] = true;
        }
        if (($_REQUEST['IBLOCK_ID'] == 7) and ($ar_res["ID"]>0)){
        		$indexTimetable = false;
				$arFilterTimetable = Array("IBLOCK_ID"=>9, "PROPERTY_SCHEDULE_COURSE"=>$ar_res["ID"],
					 "ACTIVE" => "Y", ">=PROPERTY_STARTDATE" => date("Y-m-d"));
				$arGroupByTimetable = false;
				$arNavStartParamsTimetable = array("nTopCount" => 5);
				$arOrderTimetable = array("PROPERTY_STARTDATE" => "ASC");
				$arSelectFieldsTimetable = Array(
					"ID",
					"NAME",
					"PROPERTY_STARTDATE",
					"PROPERTY_REGISTRATION_LINK",
					"PROPERTY_COURSE_CODE",
					"PROPERTY_SCHEDULE_DURATION",
					"PROPERTY_STARTDATE",
					"PROPERTY_ENDDATE",
					"PROPERTY_CITY.NAME",
					"PROPERTY_CITY",
				);
				$resTimetable = CIBlockElement::GetList($arOrderTimetable, $arFilterTimetable, $arGroupByTimetable,
					$arNavStartParamsTimetable, $arSelectFieldsTimetable);
				while($obTimetable = $resTimetable->GetNextElement())
				{
					$arFieldsTimetable = $obTimetable->GetFields();
					$indexTimetable = true;
					if ($number !== 0){
						$dateSomeCourses .= ", ";
					}
					//iwrite($arFieldsTimetable);
					$dateSomeCourses .= $arFieldsTimetable['PROPERTY_STARTDATE_VALUE'];
            		if (strlen($arFieldsTimetable['PROPERTY_ENDDATE_VALUE'])>0){
            			$dateSomeCourses .= "-". $arFieldsTimetable['PROPERTY_ENDDATE_VALUE'];
            		}
	            	if ($arFieldsTimetable['PROPERTY_CITY_VALUE'] <> 14909){
            			$dateSomeCourses .= " (". $arFieldsTimetable['PROPERTY_CITY_NAME']. ")";
            		}
            		$number = $number + 1;
				}
        }
		$res .= '<div style="margin-bottom:10px; overflow:auto;"><div style="float: left;"><input name="'.htmlspecialchars($strHTMLControlName["VALUE"]).'" id="'.md5($strHTMLControlName["VALUE"]).'" value="'.htmlspecialcharsex($value["VALUE"]).'" size="5" type="text" />'.
                '&nbsp;Search:&nbsp;<input name="ajax" id="ajax_'.md5($strHTMLControlName["VALUE"]).'" value="'.$ar_res['NAME'].'" size="20" type="text" autocomplete="off" onfocus="window.oObject[this.id] = new EATool(this, '.$arProperty["LINK_IBLOCK_ID"].');" />'.
			    '<input type="button" value="..." onClick="jsUtils.OpenWindow(\'/bitrix/admin/iblock_element_search.php?lang='.LANG.'&amp;IBLOCK_ID='.$arProperty["LINK_IBLOCK_ID"].'&amp;n='.md5($strHTMLControlName["VALUE"]).'&amp;\', 600, 500);" />'.
			    '&nbsp;</div><div style="float: left; width: 60%;"><span id="sp_'.md5($strHTMLControlName["VALUE"]).'" ><strong>'.$ar_res['CODE'].'</strong> '.$ar_res['NAME'].' ';
        $res .= $dateSomeCourses;
         $res .='</span></div></div>';
        return $res;
	}
}

AddEventHandler("iblock", "OnIBlockPropertyBuildList", Array("CIBlockPropertyElementListAjax", "GetUserTypeDescription"));