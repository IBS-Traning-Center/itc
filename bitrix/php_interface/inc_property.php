<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) {
    die();
}

class CIBlockPropertEducationAjax
{
    /**
     * Путь к javascript скрипту, который будет выводить
     * в выпадающем списке найденные варианты
     */
   /**
     * Описание св-ва
     */
    public static function GetUserTypeDescription()
    {
        return array(
            "PROPERTY_TYPE"         => "E",
            "USER_TYPE"             => "EListAjaxNew",
            "DESCRIPTION"           => "Привязка к курсу в обучении",
            "GetPropertyFieldHtml"  => array("CIBlockPropertEducationAjax","GetPropertyFieldHtml"),
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
        $res = '';
        $ar_res = false;
        if (CModule::IncludeModule("learning"))
        {
            $ar_res = CCourse::GetList(
                Array("NAME"=>"ASC"),
                Array("ACTIVE" => "Y"),
                $bIncCnt = true
            );
			$course="";
            while ($arCourse = $ar_res->GetNext())
            {
                $selected="";
                if ($value["VALUE"]==$arCourse["ID"]) {
                    $selected="selected";
                }
                $course.= "<option value='".$arCourse["ID"]."' $selected> ".$arCourse["NAME"]."</option>";

            }
        }

          $res .= '<div style="margin-bottom:10px; overflow:auto;"><select name="'.htmlspecialchars($strHTMLControlName["VALUE"]).'" id="'.md5($strHTMLControlName["VALUE"]).'" ><option value="">Не выбран</option>';
          $res .= $course;
           $res .='</select></div>';
        return $res;
    }
}
class CIBlockPropertyCourses
{
    /**
     * Путь к javascript скрипту, который будет выводить
     * в выпадающем списке найденные варианты
     */
   /**
     * Описание св-ва
     */
    public static function GetUserTypeDescription()
    {
        return array(
            "PROPERTY_TYPE"         => "E",
            "USER_TYPE"             => "EListAjaxNewOne",
            "DESCRIPTION"           => "Выберите тему курса системного аналитика",
            "GetPropertyFieldHtml"  => array("CIBlockPropertyCourses","GetPropertyFieldHtml"),
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
    public static function GetPropertyFieldHtml($arProperty, $value, $strHTMLControlName, $res)
    {
        $ar_res = false;
        if (CModule::IncludeModule("learning"))
        {
            $COURSE_ID = 38;
			$ar_res = CLearnLesson::GetListOfImmediateChilds(148);
			$course="";
            while ($arCourse = $ar_res->GetNext())
            {
                $selected="";
                if ($value["VALUE"]==$arCourse["LESSON_ID"]) {
                    $selected="selected";
                }
                $course.= "<option value='".$arCourse["LESSON_ID"]."' $selected> ".$arCourse["NAME"]."</option>";

            }
        }

          $res .= '<div style="margin-bottom:10px; overflow:auto;"><select name="'.htmlspecialchars($strHTMLControlName["VALUE"]).'" id="'.md5($strHTMLControlName["VALUE"]).'" ><option value="">Не выбран</option>';
          $res .= $course;
           $res .='</select></div>';
        return $res;
    }
}
AddEventHandler("iblock", "OnIBlockPropertyBuildList", Array("CIBlockPropertyCourses", "GetUserTypeDescription"));
AddEventHandler("iblock", "OnIBlockPropertyBuildList", Array("CIBlockPropertEducationAjax", "GetUserTypeDescription"));
?>