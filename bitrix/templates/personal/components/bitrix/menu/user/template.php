<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (!empty($arResult)):?>
<?
//print_r($arResult);
    ?>
    <?
    $k = 0;
    foreach($arResult as $key=>$arItem):
        $k++;
        //$li_class = ($k==count($arResult)) ? 'footermenu_links_last' : 'footermenu_links';
        if  ($arItem["LINK"] == "/auth/index.html"){

            $arParams["REGISTER_URL"] = $arItem["LINK"];
            $arParamsToDelete = array(
                "login",
                "logout",
                "register",
                "forgot_password",
                "change_password",
                "confirm_registration",
                "confirm_code",
                "confirm_user_id",
            );

            $arParams["REGISTER_URL"] = strlen($arParams["REGISTER_URL"]) > 0 ? $arParams["REGISTER_URL"] : $APPLICATION->GetCurPageParam("", array_merge($arParamsToDelete, array("logout_butt")));

            $arItem["LINK"] = $arParams["REGISTER_URL"] . "?backurl=" .
                urlencode($APPLICATION->GetCurPageParam("", array_merge($arParamsToDelete, array("logout_butt", "backurl")), $get_index_page=false));
        }

        if  ($arItem["LINK"] == "/auth/registration.html"){

            $arParams["REGISTER_URL"] = $arItem["LINK"];
            $arParamsToDelete = array(
                "login",
                "logout",
                "register",
                "forgot_password",
                "change_password",
                "confirm_registration",
                "confirm_code",
                "confirm_user_id",
            );

            $arParams["REGISTER_URL"] = strlen($arParams["REGISTER_URL"]) > 0 ? $arParams["REGISTER_URL"] : $APPLICATION->GetCurPageParam("", array_merge($arParamsToDelete, array("logout_butt")));
            $bRegisterURLque = strpos($arParams["REGISTER_URL"], "?") !== false;
            $arItem["LINK"] = $arParams["REGISTER_URL"] . ($bRegisterURLque ? "&" : "?") . "register=yes&backurl=" .
                urlencode($APPLICATION->GetCurPageParam("", array_merge($arParamsToDelete, array("logout_butt", "backurl")), $get_index_page=false));
        }
        ?>

        <?if($arItem["SELECTED"]):?>
        <span><?=$arItem["TEXT"]?></span><?if ($k<count($arResult)) {?>&nbsp;|&nbsp;<?}?>
    <?else:?>
        <a href="<?=$arItem["LINK"]?>"><?if ($key!=0) {?><?=$arItem["TEXT"]?><?} else {?><b><?=$arItem["TEXT"]?></b><?}?></a><?if ($k<count($arResult)) {?><span> | </span><?}?>
    <?endif?>
    <?endforeach?>

<?endif?>