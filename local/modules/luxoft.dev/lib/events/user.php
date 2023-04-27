<?php

class User {
    public static function OnBeforeUserUpdate(&$arFields) {
        $arFields["LOGIN"] = $arFields["EMAIL"];
    }
    public static function OnBeforeUserRegister(&$arFields) {
        $arFields["LOGIN"] = $arFields["EMAIL"];
        if ($arFields["NAME"] == $arFields["LAST_NAME"]) {
            global $APPLICATION;
            $APPLICATION->ThrowException('Имя совпадает с фамилией. Такого быть не должно.');
            return false;
        }
        global $APPLICATION;
        if ($APPLICATION->GetCurDir() == '/system-test-registration/') {
            $arFields["GROUP_ID"][] = 89;
            $arFields["GROUP_ID"][] = 94;

        }
    }

    public static function OnAfterUserAddRegister(&$arFields) {
        if (intval($arFields["ID"]) > 0) {
            $toSend = array();
            $toSend["PASSWORD"] = $arFields["PASSWORD"];
            $toSend["EMAIL"] = $arFields["EMAIL"];
            $toSend["USER_ID"] = $arFields["ID"];
            $toSend["USER_IP"] = $arFields["USER_IP"];
            $toSend["USER_HOST"] = $arFields["USER_HOST"];
            $toSend["LOGIN"] = $arFields["LOGIN"];
            $toSend["NAME"] = (trim($arFields["NAME"]) == "") ? $toSend["NAME"] = htmlspecialchars('<Не указано>') : $arFields["NAME"];
            $toSend["LAST_NAME"] = (trim($arFields["LAST_NAME"]) == "") ? $toSend["LAST_NAME"] = htmlspecialchars('<Не указано>') : $arFields["LAST_NAME"];
            //CEvent::SendImmediate ("NEW_USER_WITH_PASSWORD", SITE_ID, $toSend);
        }
        return $arFields;
    }
}