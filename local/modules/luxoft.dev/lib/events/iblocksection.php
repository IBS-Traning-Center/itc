<?php
namespace Luxoft\Dev\Events;

class IBlockSection
{
    public static function OnBeforeIBlockSectionAdd (&$arFields)
    {
        if ($arFields["IBLOCK_ID"] == 94) {
            $arFields["CODE"] = strtolower(codeTranslite($arFields["NAME"]));
        }
    }
    public static function OnAfterIBlockSectionAdd (&$arFields)
    {}

    public static function OnBeforeIBlockSectionUpdate (&$arFields)
    {}
    public static function OnAfterIBlockSectionUpdate (&$arFields)
    {}

    public static function OnBeforeIBlockSectionDelete (&$arFields)
    {}
    public static function OnAfterIBlockSectionDelete (&$arFields)
    {}
}