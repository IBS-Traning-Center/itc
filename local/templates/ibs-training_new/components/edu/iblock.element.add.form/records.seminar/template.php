<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
    die();
}
use Local\Util\Functions;
 
global $USER, $arEventInfo, $arCoursesInfo, $gCourseFormat;
//iwrite($arParams);
if (strlen($arEventInfo["TYPE_ID"]) == 0) {
    $arEventInfo["TYPE_ID"] = $arParams["PROPERTY_TYPE_EVENT"];
}
if (strlen($arEventInfo["NAME"]) == 0) {
    $arEventInfo["NAME"] = $arParams["PROPERTY_EVENT_NAME"];
}
if (strlen($arEventInfo["DATE"]) == 0) {
    $arEventInfo["DATE"] = $arParams["PROPERTY_EVENT_DATE_IN"];
}
if (strlen($arEventInfo["EVENT_CITY"]) == 0) {
    $arEventInfo["EVENT_CITY"] = $arParams["PROPERTY_EVENT_CITY_IN"];
}

$rsUser = CUser::GetByID($USER->GetID());
$arUser = $rsUser->Fetch();
$arUserInfo["LOGIN"] = $USER->GetLogin();
$arUserInfo["EMAIL"] = $USER->GetParam("EMAIL");
$arUserInfo["FirstName"] = $USER->GetFirstName();
$arUserInfo["LastName"] = $USER->GetLastName();
$arUserInfo["PERSONAL_CITY"] = $arUser["PERSONAL_CITY"];
$arUserInfo["WORK_COMPANY"] = $arUser["WORK_COMPANY"];
$arUserInfo["PERSONAL_PHONE"] = $arUser["PERSONAL_PHONE"];
$arUserInfo["WORK_POSITION"] = $arUser["WORK_POSITION"];

?>
<div id="register" class="bg-main-wrap">
    <div class="register-form-wrap">
        <div class="form-reg">
            <script>
                $(document).ready(function () {
                    $("#submit_form").validate();
                });
            </script>
            <?php if (count($arResult["ERRORS"])) { ?><?= ShowError(implode("<br />", $arResult["ERRORS"])) ?><?php } ?>
            <?php if (strlen($arResult["MESSAGE"]) > 0): ?>
                <br/>
                <h2 class="slogan"><?= $arResult["MESSAGE"] ?></h2>
                <h2>В ближайшее время на указанный Вами email будет выслано письмо с дальнейшими инструкциями.</h2>
            <?php
            //курс
            if ($arParams['PROPERTY_TYPE_EVENT'] == 78) { ?>
                <h2 class="slogan"><?= $arResult["MESSAGE"] ?></h2>
                <h2>Сотрудник Учебного Центра свяжется с Вами в ближайшее время.</h2>
            <?php if (isset($_REQUEST["FORM_RESULT_ID"]) and (is_numeric($_REQUEST["FORM_RESULT_ID"]))) { ?>
            <?php $arIDMethodPayment = GetIDMethodPayment($_REQUEST["FORM_RESULT_ID"]);
            //если метод оплаты  - онлайн 125  деаме перенапрвление на корзину
            if ($arIDMethodPayment["PAYMENT_ID"] == 125) { ?>
                <p class="label">Вы сейчас будете перенаправлены на страницу для оплаты курса online / по квитанции
                    через банк. (при оформлении заказа укажите тип плательщика: Физическое лицо)<br/></p>
                Проблемы с перенаправлением? Пожалуйста, используйте <a
                        href='/services/buy_course.html?action=BUY&id=<?= $arIDMethodPayment["TIMETABLE_ID"] ?>&ID_RECORD=<?= $_REQUEST["FORM_RESULT_ID"] ?>'>прямую
                    ссылку.</a>
                <script type="text/javascript">
                    setTimeout('Redirect()', 5000);

                    function Redirect() {
                        location.href = '/services/buy_course.html?action=BUY&id=<?=$arIDMethodPayment["TIMETABLE_ID"]?>&ID_RECORD=<?=$_REQUEST["FORM_RESULT_ID"]?>';
                    }
                </script>
            <?php } ?>
            <?php if ($arIDMethodPayment["PAYMENT_ID"] == 126) { ?>
                <p class="label">На ваш email отправлено письмо с приглашением посетить данный курс. Вышлите,
                    пожалуйста, все необходимые
                    реквизиты для составления договора в ответе на данное письмо.<br/>Либо вы можете перейти по
                    следующей <a
                            href='/services/buy_course.html?action=BUY&id=<?= $arIDMethodPayment["TIMETABLE_ID"] ?>&ID_RECORD=<?= $_REQUEST["FORM_RESULT_ID"] ?>'>ссылке</a>
                    для получения всех необходимых документов автоматически. (при оформлении заказа укажите тип
                    плательщика:
                    Юридическое лицо)</p>
            <?php } ?>
            <?php } ?>
                <!--<span class="links"><a href="/mail/form.html">Задать вопрос по тренингу / семинару</a></span>-->
            <?php } ?>
            <?php
            //конференция
            if ($arParams['PROPERTY_TYPE_EVENT'] == 82){
            ?>
                <h2 class="slogan"><?= $arResult["MESSAGE"] ?></h2>
                <h2>Сотрудник Учебного Центра свяжется с Вами в ближайшее время.</h2>
                <!--<span class="links"><a href="/mail/form.html">Задать вопрос по тренингу / семинару</a></span>-->
            <?php } ?>
            <?php
            //школы  классы
            if ($arParams['PROPERTY_TYPE_EVENT'] == 79){
            ?>
                <h2 class="slogan"><?= $arResult["MESSAGE"] ?></h2>
                <h2>Сотрудник Учебного Центра свяжется с Вами в ближайшее время.</h2>
                <!--<span class="links"><a href="/mail/form.html">Задать вопрос по тренингу / семинару</a></span>-->
            <?php } ?>
            <?php
            //круглые столы
            if ($arParams['PROPERTY_TYPE_EVENT'] == 81){
            ?>
                <h2 class="slogan"><?= $arResult["MESSAGE"] ?></h2>
                <h2>Сотрудник Учебного Центра свяжется с Вами в ближайшее время.</h2>
                <!--<span class="links"><a href="/mail/form.html">Задать вопрос по тренингу / семинару</a></span>-->
            <?php } ?>
                <br/>
            <?php endif ?>
            <?php if (strlen($arResult["MESSAGE"]) > 0) {
            } else { ?>
                <div id="stylized" class="myform">
                    <form name="iblock_add" action="<?= POST_FORM_ACTION_URI ?>#register" method="post"
                          onsubmit="document.getElementById('submit_button_register').style.display='none'; document.getElementById('message_sending').style.display='block';"
                          enctype="multipart/form-data" id="submit_form">
                        <div class="form-title">
                            <?php if (($arParams['PROPERTY_TYPE_EVENT'] == 78) and (strlen($arEventInfo['TIMETABLE_ID']) > 0) or ($arResult['COUNT_RECORDS'] > 0)) { ?>
                                <?php if ($gCourseFormat) { ?>
                                    <h2>Регистрация для частных лиц</h2>
                                <?php } else { ?>
                                    <?php if (strlen($arResult['OWN_TITLE']) > 0) { ?>
                                        <h2><?= $arResult['OWN_TITLE'] ?></h2>
                                    <?php } else { ?>
                                        <h2>Регистрация</h2>
                                    <?php } ?>
                                <?php } ?>
                            <?php } else { ?>
                                <?php if (strlen($arResult['OWN_TITLE']) > 0) { ?>
                                    <h2><?= $arResult['OWN_TITLE'] ?></h2>
                                <?php } else { ?>
                                    <h2>Регистрация</h2>
                                <?php } ?>
                            <?php } ?>
                            <div class="register-close"><?=Functions::buildSVG('icon-close', SITE_TEMPLATE_PATH. '/assets/images/icons')?></div>
                        </div>
                        <h3 id="event_n" style="display: none;"><?= $arEventInfo['CODE'] ?> <?= $arEventInfo['NAME'] ?></h3>
                        <?= bitrix_sessid_post() ?>
<<<<<<< HEAD
                        <? if ($arParams["MAX_FILE_SIZE"] > 0): ?><input type="hidden" name="MAX_FILE_SIZE" value="<?= $arParams["MAX_FILE_SIZE"] ?>" /><? endif ?>

                        <? if (is_array($arResult["PROPERTY_LIST"]) && count($arResult["PROPERTY_LIST"]) > 0): ?>
=======
                        <?php if ($arParams["MAX_FILE_SIZE"] > 0): ?><input type="hidden" name="MAX_FILE_SIZE" value="<?= $arParams["MAX_FILE_SIZE"] ?>" /><?php endif ?>
                        <?php if (is_array($arResult["PROPERTY_LIST"])): ?>
>>>>>>> dev

                            <?php foreach ($arResult["PROPERTY_LIST"] as $propertyID): ?>
                                <div class="form-section"
                                    <?php if (intval($propertyID) == 0) { ?>style="display:none" <?php } ?>
                                    <?php if (in_array($propertyID, $arResult["PROPERTY_HIDDEN"])): ?>style="display:none" <?php endif ?>>

                                    <?php
                                    if (intval($propertyID) > 0) {
                                        if (
                                            $arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] == "T"
                                            &&
                                            $arResult["PROPERTY_LIST_FULL"][$propertyID]["ROW_COUNT"] == "1"
                                        )
                                            $arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] = "S";
                                        elseif (
                                            (
                                                $arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] == "S"
                                                ||
                                                $arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] == "N"
                                            )
                                            &&
                                            $arResult["PROPERTY_LIST_FULL"][$propertyID]["ROW_COUNT"] > "1"
                                        )
                                            $arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] = "T";
                                    } elseif (($propertyID == "TAGS") && CModule::IncludeModule('search'))
                                        $arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] = "TAGS";

                                    if ($arResult["PROPERTY_LIST_FULL"][$propertyID]["MULTIPLE"] == "Y") {
                                        $inputNum = ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0) ? count($arResult["ELEMENT_PROPERTIES"][$propertyID]) : 0;
                                        $inputNum += $arResult["PROPERTY_LIST_FULL"][$propertyID]["MULTIPLE_CNT"];
                                    } else {
                                        $inputNum = 1;
                                    }

                                    switch ($arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"]):
                                        case "TAGS":
                                            $APPLICATION->IncludeComponent(
                                                "bitrix:search.tags.input",
                                                "",
                                                array(
                                                    "VALUE" => $arResult["ELEMENT"][$propertyID],
                                                    "NAME" => "PROPERTY[" . $propertyID . "][0]",
                                                    "TEXT" => 'size="' . $arResult["PROPERTY_LIST_FULL"][$propertyID]["COL_COUNT"] . '"',
                                                ), null, array("HIDE_ICONS" => "Y")
                                            );
                                            break;
                                        case "T":
                                            for ($i = 0; $i < $inputNum; $i++) {

                                                if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0) {
                                                    $value = intval($propertyID) > 0 ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE"] : $arResult["ELEMENT"][$propertyID];
                                                } elseif ($i == 0) {
                                                    $value = intval($propertyID) > 0 ? "" : $arResult["PROPERTY_LIST_FULL"][$propertyID]["DEFAULT_VALUE"];
                                                } else {
                                                    $value = "";
                                                }
                                                ?>
                                                <textarea placeholder="<?= $arResult["PROPERTY_LIST_FULL"][$propertyID]["NAME"] ?>"
                                                        cols="<?= $arResult["PROPERTY_LIST_FULL"][$propertyID]["COL_COUNT"] ?>"
                                                        rows="1"
                                                        name="PROPERTY[<?= $propertyID ?>][<?= $i ?>]"><?= $value ?></textarea>
                                                <?php
                                            }
                                            break;
                                        case "E":
                                        case "S":
                                        case "N":
                                            for ($i = 0; $i < $inputNum; $i++) {
                                                if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0) {
                                                    $value = intval($propertyID) > 0 ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE"] : $arResult["ELEMENT"][$propertyID];
                                                } elseif ($i == 0) {
                                                    $value = intval($propertyID) <= 0 ? "" : $arResult["PROPERTY_LIST_FULL"][$propertyID]["DEFAULT_VALUE"];

                                                } else {
                                                    $value = "";
                                                }
                                                ?>
                                                <?php //проверка на hidden поля
                                                ?>
                                                <input type="text" placeholder="<?= $arResult["PROPERTY_LIST_FULL"][$propertyID]["NAME"] ?>"
                                                    <?php if (in_array($propertyID, $arResult["PROPERTY_HIDDEN"])): ?>style="display:none;" <?php endif ?>  <?php if ($propertyID == "NAME") {
                                                    ?>  id="event_name"  value="<?= $arEventInfo['CODE'] ?> <?= $arEventInfo['NAME'] ?>" style="display:none;" <?php } ?>
                                                    <?php if ($propertyID == 243) {
                                                        ?>  id="event_date" value="<?php if (isset($_REQUEST['IN_CITY']) === false) {
                                                            ?><?= $arEventInfo['DATE'] ?><?php } ?>" <?php } ?>
                                                    <?php if (($propertyID == 244) or ($propertyID == 247) or ($propertyID == 249) or ($propertyID == 245) or ($propertyID == 265)) { ?>  class="required" <?php } ?>
                                                    <?php if ($propertyID == 244) {
                                                        ?>  value="<?= $arUserInfo['LastName'] ?> <?= $arUserInfo['FirstName'] ?>"<?php } ?>
                                                    <?php if ($propertyID == 245) {
                                                        ?>  value="<?= $arUserInfo['WORK_COMPANY'] ?>"<?php } ?>
                                                    <?php if ($propertyID == 246) {
                                                        ?>  value="<?= $arUserInfo['EMAIL'] ?>" class="required email"<?php } ?>
                                                    <?php if ($propertyID == 247) {
                                                        ?>  value="<?= $arUserInfo['PERSONAL_PHONE'] ?>"<?php } ?>
                                                    <?php if ($propertyID == 265) {
                                                        ?>  value="<?= $arUserInfo['WORK_POSITION'] ?>"<?php } ?>
                                                    <?php if ($propertyID == 249) {
                                                        ?>  value="<?= $arUserInfo['PERSONAL_CITY'] ?>"<?php } ?>
                                                    <?php if (($propertyID == 313) and (isset($_REQUEST['IN_CITY']) !== true)) { ?>  value="<?= $arEventInfo['TIMETABLE_ID'] ?>"<?php } ?>
                                                    <?php if ($propertyID == 407) {
                                                        ?>  value="<?= $_REQUEST['IN_CITY'] ?>"<?php } ?>
                                                    <?php if ($propertyID == 271) {
                                                        ?>  id="event_city_text" <?php
                                                        if (strlen($arParams["PROPERTY_EVENT_CITY_IN"]) > 0) {
                                                            $value = $arParams["PROPERTY_EVENT_CITY_IN"];
                                                        } else {
                                                            $value = $arEventInfo["EVENT_CITY"];
                                                        }
                                                        if (isset($_REQUEST['IN_CITY']) === true) {
                                                            $value = "";
                                                        }
                                                    }
                                                    ?>
                                                       name="PROPERTY[<?= $propertyID ?>][<?= $i ?>]" size="25"
                                                       value="<?= $value ?>"/>

                                                <?php if (in_array($propertyID, $arResult["PROPERTY_HIDDEN"])) {
                                                } else { ?>
                                                    <?php if ($arResult["PROPERTY_LIST_FULL"][$propertyID]["USER_TYPE"] == "DateTime"): ?><?php
                                                        $APPLICATION->IncludeComponent(
                                                            'bitrix:main.calendar',
                                                            '',
                                                            array(
                                                                'FORM_NAME' => 'iblock_add',
                                                                'INPUT_NAME' => "PROPERTY[" . $propertyID . "][" . $i . "]",
                                                                'INPUT_VALUE' => $value,
                                                            ),
                                                            null,
                                                            array('HIDE_ICONS' => 'Y')
                                                        );
                                                        ?><!--<br /><small><?= GetMessage("IBLOCK_FORM_DATE_FORMAT") ?><?= FORMAT_DATETIME ?></small>--><?php
                                                    endif
                                                    ?><br/><?php } ?><?php
                                            }
                                            break;

                                        case "F":
                                            for ($i = 0; $i < $inputNum; $i++) {
                                                $value = intval($propertyID) > 0 ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE"] : $arResult["ELEMENT"][$propertyID];
                                                ?>
                                                <input type="hidden"
                                                       name="PROPERTY[<?= $propertyID ?>][<?= $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] : $i ?>]"
                                                       value="<?= $value ?>"/>
                                                <input type="file"
                                                       size="<?= $arResult["PROPERTY_LIST_FULL"][$propertyID]["COL_COUNT"] ?>"
                                                       name="PROPERTY_FILE_<?= $propertyID ?>_<?= $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] : $i ?>"/>
                                                <br/>
                                                <?php

                                                if (!empty($value) && is_array($arResult["ELEMENT_FILES"][$value])) {
                                                    ?>
                                                    <input type="checkbox"
                                                           name="DELETE_FILE[<?= $propertyID ?>][<?= $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] : $i ?>]"
                                                           id="file_delete_<?= $propertyID ?>_<?= $i ?>" value="Y"/>
                                                    <label
                                                            for="file_delete_<?= $propertyID ?>_<?= $i ?>"><?= GetMessage("IBLOCK_FORM_FILE_DELETE") ?></label>
                                                    <br/>
                                                    <?php

                                                    if ($arResult["ELEMENT_FILES"][$value]["IS_IMAGE"]) {
                                                        ?>
                                                        <img src="<?= $arResult["ELEMENT_FILES"][$value]["SRC"] ?>"
                                                             height="<?= $arResult["ELEMENT_FILES"][$value]["HEIGHT"] ?>"
                                                             width="<?= $arResult["ELEMENT_FILES"][$value]["WIDTH"] ?>"
                                                             border="0"/><br/>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <?= GetMessage("IBLOCK_FORM_FILE_NAME") ?>: <?= $arResult["ELEMENT_FILES"][$value]["ORIGINAL_NAME"] ?>
                                                        <br/>
                                                        <?= GetMessage("IBLOCK_FORM_FILE_SIZE") ?>: <?= $arResult["ELEMENT_FILES"][$value]["FILE_SIZE"] ?> b
                                                        <br/>
                                                        [
                                                        <a href="<?= $arResult["ELEMENT_FILES"][$value]["SRC"] ?>"><?= GetMessage("IBLOCK_FORM_FILE_DOWNLOAD") ?></a>]
                                                        <br/>
                                                        <?php
                                                    }
                                                }
                                            }
                                            break;
                                        case "L":
                                            if ($arResult["PROPERTY_LIST_FULL"][$propertyID]["LIST_TYPE"] == "C")
                                                $type = $arResult["PROPERTY_LIST_FULL"][$propertyID]["MULTIPLE"] == "Y" ? "checkbox" : "radio";
                                            else
                                                $type = $arResult["PROPERTY_LIST_FULL"][$propertyID]["MULTIPLE"] == "Y" ? "multiselect" : "dropdown";
                                            switch ($type):
                                                case "checkbox":
                                                case "radio":
                                                    //echo "<pre>"; print_r($arResult["PROPERTY_LIST_FULL"][$propertyID]); echo "</pre>";

                                                    foreach ($arResult["PROPERTY_LIST_FULL"][$propertyID]["ENUM"] as $key => $arEnum) {
                                                        $checked = false;
                                                        if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0) {
                                                            if (is_array($arResult["ELEMENT_PROPERTIES"][$propertyID])) {
                                                                foreach ($arResult["ELEMENT_PROPERTIES"][$propertyID] as $arElEnum) {
                                                                    if ($arElEnum["VALUE"] == $key) {
                                                                        $checked = true;
                                                                        break;
                                                                    }
                                                                }
                                                            }
                                                        } else {
                                                            if ($arEnum["DEF"] == "Y") $checked = true;
                                                        }

                                                        ?>
                                                        <input
                                                            <?php if (in_array($propertyID, $arResult["PROPERTY_HIDDEN"])): ?>style="display:none" <?php endif ?>
                                                            type="<?= $type ?>"
                                                            name="PROPERTY[<?= $propertyID ?>]<?= $type == "checkbox" ? "[" . $key . "]" : "" ?>"
                                                            value="<?= $key ?>"
                                                            id="property_<?= $key ?>"<?= $checked ? " checked=\"checked\"" : "" ?> />
                                                        <label for="property_<?= $key ?>"><?= $arEnum["VALUE"] ?></label>
                                                        <br/>
                                                        <?php
                                                    }
                                                    break;
                                                case "dropdown":
                                                case "multiselect":
                                                    ?>
                                                    <?php //iwrite($arParams['PROPERTY_CODES_HIDDEN']);
                                                    ?>
                                                    <select <?php if (in_array($propertyID, $arResult["PROPERTY_HIDDEN"])): ?> class="no_redraw" style="display:none;" <?php endif ?>
                                                        <?php if ($propertyID == 248) { ?>id="event_type_id"<?php } ?>
                                                        <?php if (($propertyID == 313) or ($propertyID == 407)) { ?>
                                                        name="PROPERTY[<?= $propertyID ?>][0]" class="date_select">
                                                        <?php } else { ?>
                                                            name="PROPERTY[<?= $propertyID ?>]<?= $type == "multiselect" ? "[]\" size=\"" . $arResult["PROPERTY_LIST_FULL"][$propertyID]["ROW_COUNT"] . "\" multiple=\"multiple" : "" ?>">
                                                        <?php } ?>
                                                        <?php
                                                        if (intval($propertyID) > 0) $sKey = "ELEMENT_PROPERTIES";
                                                        else $sKey = "ELEMENT";

                                                        foreach ($arResult["PROPERTY_LIST_FULL"][$propertyID]["ENUM"] as $key => $arEnum) {
                                                            $checked = false;
                                                            //echo "pipec";
                                                            if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0) {

                                                                foreach ($arResult[$sKey][$propertyID] as $elKey => $arElEnum) {
                                                                    //echo "key = $key <br />";
                                                                    //echo "arElEnum['VALUE'] = ".$arElEnum['VALUE']." <br />";

                                                                    if ($key == $arElEnum["VALUE"]) {
                                                                        $checked = true;
                                                                        break;
                                                                    }
                                                                }
                                                            } else {
                                                                if ($arEnum["DEF"] == "Y") $checked = true;
                                                            }
                                                            if ($key == $arEventInfo["TYPE_ID"]) {
                                                                $checked = true;
                                                            }
                                                            if (strlen($arResult["TYPE_ID"]) > 0) {
                                                                if ($key == $arResult["TYPE_ID"]) {
                                                                    $checked = true;
                                                                }
                                                            }
                                                            ?>

                                                            <option value="<?= $key ?>" <?= $checked ? " selected=\"selected\"" : "" ?>><?= $arEnum["VALUE"] ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                    <div class="clear"></div>
                                                    <?php
                                                    break;

                                            endswitch;
                                            break;
                                    endswitch; ?>
                                </div>
                            <?php endforeach; ?>
                        <?php endif ?>
                        <label class="agree-text">
                            <input class='agree' id="form-reg-agree" checked="checked" name="agree" value="Y"
                                   type="checkbox"/>
                            Настоящим я подтверждаю, что я ознакомлен с <a target="_blank"
                                    href="/terms-of-use/">Условиями использования</a>,
                            условия мне понятны и я согласен соблюдать их.
                        </label>
                        <label class="agree-text">
                            <input class='agree' id="form-reg-two" checked="checked" name="agree-2" value="Y"
                                   type="checkbox"/>
                            Я ознакомлен с порядком обработки моих персональных данных согласно
                            <a target="_blank"
                               href="/privacy-policy/">Политике в сфере персональных данных</a>.
                        </label>

                        <input class="btn-main" id="submit_button_register"
                               onclick="javascript: pageTracker._trackEvent('FILL_FORM','COURSE','<?= $_REQUEST['ID'] ?>');"
                               type="submit" class="but" name="iblock_submit" value="Зарегистрироваться"/>
                        <label class="btn-main" id="message_sending"
                               style="display:none; text-align:center;background: #F3F3F3;color:black!important;">Данные
                            отправляются...</label>

                        <?php if (strlen($arParams["LIST_URL"]) > 0 && $arParams["ID"] > 0) { ?>
                            <input type="submit" name="iblock_apply" value="<?= GetMessage("IBLOCK_FORM_APPLY") ?>"/>
                        <?php } ?>
                    </form>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('.agree').change(function () {
            $state = ($('#form-reg-agree').prop('checked') && $('#form-reg-two').prop('checked'));
            $state == false ? $('.main-reg-button').prop('disabled', 'disabled') : $('.main-reg-button').removeAttr('disabled');
        });
    });
</script>
<div class="background-modal"></div>