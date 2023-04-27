<?php
namespace Luxoft\Dev\Events;

use Bitrix\Main\Loader;

class Search {
    public static function BeforeIndex (&$arFields): array
    {
        if (!Loader::includeModule('iblock')) // подключаем модуль
        {
            return $arFields;
        }

        if ($arFields["MODULE_ID"] == "iblock" && $arFields["PARAM2"] == D_EN_EXPERT_ID_IBLOCK) {
            $db_props = \CIBlockElement::GetProperty(                        // Запросим свойства индексируемого элемента
                $arFields["PARAM2"],         // BLOCK_ID индексируемого свойства
                $arFields["ITEM_ID"],          // ID индексируемого свойства
                array("sort" => "asc"),       // Сортировка (можно упустить)
                array("CODE" => "SHORT_NAME")
            ); // CODE свойства
            if ($ar_props = $db_props->Fetch()) {
                $arFields["TITLE"] .= " " . $ar_props["VALUE"];
            }   // Добавим свойство в конец заголовка индексируемого элемента
        }

        if ($arFields["MODULE_ID"] == "iblock" && $arFields["PARAM2"] == D_EN_COURSE_ID_IBLOCK) {
            $res = \CIBlockElement::GetByID($arFields["ITEM_ID"]);
            if ($ar_res = $res->GetNext()) {
                $arFields["TITLE"] = $ar_res["CODE"] . " " . $arFields["TITLE"];
            }
        }

        return $arFields;
    }
}