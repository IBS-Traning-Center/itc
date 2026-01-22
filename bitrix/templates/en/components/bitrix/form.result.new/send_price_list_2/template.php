<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$fileName = '';
switch ($_SESSION["cityID"]) {
    case CITY_ID_SPB:
        $fileName = "luxoft_training_price_spb.xls";
        break;
    case CITY_ID_OMSK:
        $fileName = "luxoft_training_price_omsk.xls";
        break;
    case CITY_ID_KIEV:
        $fileName = "luxoft_training_price_kiev.xls";
        break;
    case CITY_ID_ODESSA:
        $fileName = "luxoft_training_price_odessa.xls";
        break;
    case CITY_ID_DNEPR:
        $fileName = "luxoft_training_price_dnepropetrovsk.xls";
        break;
    default:
        $fileName = "luxoft_training_price_moscow.xls";
}
$randomString = \Bitrix\Main\Security\Random::getString(10);
$fileName = "ibs-training-price.xls?{$randomString}";

$arResult["QUESTIONS"]["file"]['STRUCTURE'][0]['VALUE'] = "https://ibs-training.ru/files/" . $fileName;

if ($USER->IsAuthorized()) {
    $email = $USER->GetEmail();
    $name = $USER->GetFullName();
    $arResult["QUESTIONS"]["name"]["HTML_CODE"] = "<input type='text' class='inputtext' name='form_text_759' value='$name' size='60'>";
    $arResult["QUESTIONS"]["name"]['STRUCTURE'][0]['VALUE'] = $name;
    $arResult["QUESTIONS"]["email"]["HTML_CODE"] = "<input type='text' class='inputtext' name='form_email_761' value='$email' size='60'>";
    $arResult["QUESTIONS"]["email"]['STRUCTURE'][0]['VALUE'] = $email;
}
?>
<div class="send-price-form-area">
    <a style="position: absolute;top: 0;right: 10px;font-size: 35px;transform: rotate(45deg);cursor: pointer;"
       onclick="$('.send-price-form-area').hide(); return;">+</a>
    <? if ($arResult["isFormErrors"] == "Y"): ?>
        <?= $arResult["FORM_ERRORS_TEXT"]; ?>
    <? endif; ?>

    <?= $arResult["FORM_NOTE"] ?>
    <div class="form-reg">
        <? if ($arResult["isFormTitle"]) { ?>
            <h4><?= $arResult["FORM_TITLE"] ?></h4>
        <? } ?>
        <p><?= $arResult["FORM_DESCRIPTION"] ?></p>
        <form name="send_price_list" data-form-type="webform" data-form-id="24" method="POST"
              enctype="multipart/form-data">
            <input type="hidden" name="addField" value="">
            <?= bitrix_sessid_post() ?>
            <? foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion) {
                if ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] === 'hidden' || $arQuestion['STRUCTURE'][0]['FIELD_TYPE'] === 'textarea') { ?>
                    <input type="<?= $arQuestion['STRUCTURE'][0]['FIELD_TYPE'] ?>" name="<?= $FIELD_SID ?>"
                           value="<?= $arQuestion['STRUCTURE'][0]['VALUE'] ?>"
                           <? if ($arQuestion["REQUIRED"] == "Y"){ ?>required<? } ?>>
                <? } else { ?>
                    <div class="form-section">
                        <div class="label req">
                            <? if (is_array($arResult["FORM_ERRORS"]) && array_key_exists($FIELD_SID, $arResult['FORM_ERRORS'])) { ?>
                                <span class="error-fld" title="<?= $arResult["FORM_ERRORS"][$FIELD_SID] ?>"></span>
                            <?
                            } ?>
                            <?= $arQuestion["CAPTION"] ?><? if ($arQuestion["REQUIRED"] == "Y") { ?><?= $arResult["REQUIRED_SIGN"]; ?><?
                            } ?>
                            <?= $arQuestion["IS_INPUT_CAPTION_IMAGE"] == "Y" ? "<br />" . $arQuestion["IMAGE"]["HTML_CODE"] : "" ?>
                        </div>
                        <input type="text" name="<?= $FIELD_SID ?>" value="<?= $arQuestion['STRUCTURE'][0]['VALUE'] ?>"
                               <? if ($arQuestion["REQUIRED"] == "Y"){ ?>required<?
                        } ?>>
                    </div>
                <?
                }
            } ?>
            <div style="margin-top: 20px;">
                <label class="agree-text"><input checked="checked" name="agree" value="Y" type="checkbox">Настоящим я
                    подтверждаю, что я ознакомлен с <a style="color: #535353; text-decoration: underline;" target="_blank" href="/terms-of-use/">Условиями использования</a>, условия
                    мне понятны и я согласен соблюдать их.</label>
                <label class="agree-text"><input checked="checked" name="agree-2" value="Y" type="checkbox">Я ознакомлен
                    с порядком обработки моих персональных данных согласно <a
                            style="color: #535353; text-decoration: underline;" target="_blank" href="/privacy-policy/">Политике в сфере персональных данных</a>.</label>
            </div>
            <? if ($arResult["isUseCaptcha"] == "Y") { ?>
                <input type="hidden" name="captcha_sid" value="<?= htmlspecialchars($arResult["CAPTCHACode"]); ?>"/>
                <img src="/bitrix/tools/captcha.php?captcha_sid=<?= htmlspecialchars($arResult["CAPTCHACode"]); ?>"
                     width="180" height="40"/>
                <input type="text" name="captcha_word" size="30" maxlength="50" value="" class="inputtext"/>
            <? } ?>
            <input class="main-test-button sign-in" type="submit" name="web_form_submit" value="Отправить">
        </form>
    </div>
</div>
