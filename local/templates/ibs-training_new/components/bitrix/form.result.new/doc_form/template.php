<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/** @var array $arResult */
?>

<div class="doc-modal education-doc-modal success-modal" id="successDocModal" style="display:none;">
    <div class="modal-content">
        <button class="modal-close" type="button"
                onclick="document.getElementById('successDocModal').style.display='none'; document.body.style.overflow=''; location.href='/personal/docs/';">
            <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                <line x1="34.5626" y1="13.7896" x2="12.2887" y2="36.0635" stroke="black" stroke-width="2"/>
                <line x1="34.2109" y1="36.0636" x2="11.937" y2="13.7897" stroke="black" stroke-width="2"/>
            </svg>

        </button>
        <h2>Запрос отправлен</h2>
        <p>Документ будет загружен в Личный кабинет в течение<br>7 календарных дней</p>
        <div class="button-wrapper">
            <a href="/personal/docs/" class="btn-primary">Закрыть</a>
        </div>
    </div>
</div>
<div class="doc-modal education-doc-modal" id="formDocModal" style="display:none;">
    <div class="modal-content">
        <button class="modal-close" type="button"
                onclick="document.getElementById('formDocModal').style.display='none'; document.body.style.overflow='';">
            <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                <line x1="34.5626" y1="13.7896" x2="12.2887" y2="36.0635" stroke="black" stroke-width="2"/>
                <line x1="34.2109" y1="36.0636" x2="11.937" y2="13.7897" stroke="black" stroke-width="2"/>
            </svg>
        </button>

        <h1 class="form-title"><?= htmlspecialcharsbx($arResult["FORM_TITLE"]) ?></h1>

        <?php if ($arResult["isFormDescription"] == "Y"): ?>
            <div class="form-description"><?= $arResult["FORM_DESCRIPTION"] ?></div>
        <?php endif; ?>

        <?= $arResult["FORM_HEADER"] ?>

        <form name="form_<?= $arResult["arForm"]["ID"] ?>"
              action="<?= POST_FORM_ACTION_URI ?>"
              method="POST"
              enctype="multipart/form-data">

            <?= bitrix_sessid_post() ?>
            <input type="hidden" name="WEB_FORM_ID" value="<?= $arResult["arForm"]["ID"] ?>">
            <input type="hidden" name="web_form_submit" value="Y">

            <div class="form-fields">

                <?php foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion): ?>

                    <?php if ($arQuestion["STRUCTURE"][0]["FIELD_TYPE"] === "hidden"): ?>
                        <?= $arQuestion["HTML_CODE"] ?>
                        <?php continue; ?>
                    <?php endif; ?>

                    <?php
                    $required = $arQuestion["REQUIRED"] === "Y";
                    $error = !empty($arResult["FORM_ERRORS"][$FIELD_SID]);
                    $caption = htmlspecialcharsbx($arQuestion["CAPTION"]);
                    $nameLow = mb_strtolower($caption);
                    $type = 'text';

                    if (strpos($nameLow, 'телефон') !== false || strpos($nameLow, 'phone') !== false) {
                        $type = 'tel';
                    } elseif (strpos($nameLow, 'email') !== false || strpos($nameLow, 'почт') !== false) {
                        $type = 'email';
                    }
                    ?>

                    <div class="form-group <?= $error ? 'error' : '' ?>">
                        <label>
                            <?= $caption ?>
                            <?php if ($required): ?> <span class="required">*</span><?php endif; ?>
                        </label>

                        <?php if ($arQuestion["STRUCTURE"][0]["FIELD_TYPE"] === "textarea"): ?>
                            <?= str_replace(
                                '<textarea',
                                '<textarea class="form-control textarea" placeholder="' . $caption . '"',
                                $arQuestion["HTML_CODE"]
                            ) ?>

                        <?php elseif ($arQuestion["STRUCTURE"][0]["FIELD_TYPE"] === "dropdown"): ?>
                            <?= str_replace(
                                '<select',
                                '<select class="form-control select"',
                                $arQuestion["HTML_CODE"]
                            ) ?>

                        <?php else: ?>
                            <?php
                            $html = $arQuestion["HTML_CODE"];
                            $html = preg_replace('/type="[^"]*"/', 'type="' . $type . '"', $html);
                            $html = preg_replace('/<input/', '<input class="form-control" placeholder="' . $caption . '"', $html);
                            if ($required) $html = str_replace('<input', '<input required', $html);
                            echo $html;
                            ?>
                        <?php endif; ?>

                        <?php if ($error): ?>
                            <div class="field-error"><?= $arResult["FORM_ERRORS"][$FIELD_SID] ?></div>
                        <?php endif; ?>
                    </div>

                <?php endforeach; ?>

                <?php if ($arResult["isUseCaptcha"] == "Y"): ?>
                    <div class="form-group captcha">
                        <label>Защитный код <span class="required">*</span></label>
                        <input type="hidden" name="captcha_sid"
                               value="<?= htmlspecialcharsbx($arResult["CAPTCHACode"]) ?>">
                        <img src="/bitrix/tools/captcha.php?captcha_sid=<?= htmlspecialcharsbx($arResult["CAPTCHACode"]) ?>"
                             alt="Капча">
                        <input type="text" name="captcha_word" class="form-control" required placeholder="Введите код">
                        <?php if (!empty($arResult["FORM_ERRORS"]["captcha_word"])): ?>
                            <div class="field-error"><?= $arResult["FORM_ERRORS"]["captcha_word"] ?></div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <button type="submit" class="btn btn-primary btn-large">
                    <?= htmlspecialcharsbx($arResult["arForm"]["BUTTON"] ?: 'Отправить запрос') ?>
                </button>

            </div>
        </form>

        <?= $arResult["FORM_FOOTER"] ?>
        <?php if (isset($_GET['formresult']) && $_GET['formresult'] === 'addok'): ?>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    document.getElementById('formDocModal').style.display = 'none';
                    document.getElementById('successDocModal').style.display = 'grid';
                    document.body.style.overflow = 'hidden';
                    if (history.replaceState) {
                        history.replaceState(null, null, window.location.pathname);
                    }
                });
            </script>
        <?php endif; ?>

    </div>
</div>
