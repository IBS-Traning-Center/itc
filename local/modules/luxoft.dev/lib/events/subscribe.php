<?php
namespace Luxoft\Dev\Events;


class Subscribe {
    public static function BeforePostingSendMail($arFields)
    {
        $rsSub = CSubscription::GetByEmail($arFields["EMAIL"]);
        $arSub = $rsSub->Fetch();
        //$arFields["BODY"] = str_replace("#MAIL_ID_SUBSCRIBER#", $arSub["ID"], $arFields["BODY"]);
        $arFields["BODY"] = str_replace("#MAIL_ID#", $arSub["ID"], $arFields["BODY"]);
        $arFields["BODY"] = str_replace("#MAIL_MD5#", MyClass::GetMailHash($arFields["EMAIL"]), $arFields["BODY"]);
        /*
        $USER_NAME = "";$index = 0;
        $filter = Array("=EMAIL" => $arFields["EMAIL"]);
        $rsUsers = CUser::GetList(($by="personal_country"), ($order="desc"), $filter);
        while($arUsers = $rsUsers->Fetch()) {
            if ($index == 0){
                $USER_NAME = rucfirst(strtolower_utf8(strtolower($arUsers['NAME'])));
                $USER_NAME = ", ". $USER_NAME;
                $USER_ID   = $arUsers["ID"];
            }
            $index =$index + 1;
        }
        $arFields["BODY"] = str_replace("#MAIL_ID#", $USER_ID, $arFields["BODY"]);
        $arFields["BODY"] = str_replace("#NAME#", $USER_NAME, $arFields["BODY"]);
        */
        return $arFields;
    }
}