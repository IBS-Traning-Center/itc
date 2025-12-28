<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>
<?php
$client_id = 'VLEAK7BKIEFJ9FAEU9M3QQ5BTN2JUH4PT3CQM86VU2NOIHDHH5LAQ6UNJKI375IM';
$address = 'https://hh.ru/oauth/authorize?response_type=code&role=applicant&client_id=' . $client_id;
?>

<div class="container-lk lk-profile-wrapper">
    <main class="main-content">
        <div class="tabs">
            <a class="tab active">Профиль</a>
            <a class="tab" href="/personal/profile/subscription/">Подписка</a>
            <a class="tab" href="/personal/profile/password/">Пароль</a>
        </div>

        <div class="messages">
            <?if($arResult["strProfileError"]):?>
                <div class="error"><?=ShowError($arResult["strProfileError"])?></div>
            <?endif;?>

            <?if($arResult["DATA_SAVED"] == "Y"):?>
                <div class="success">Изменения успешно сохранены</div>
            <?endif;?>
        </div>

        <form method="post" action="<?=POST_FORM_ACTION_URI?>" enctype="multipart/form-data" name="form1">
            <?=bitrix_sessid_post()?>
            <input type="hidden" name="lang" value="<?=LANG?>">
            <input type="hidden" name="ID" value="<?=$arResult["ID"]?>">

            <div class="field-blue">
                <label>ФИО</label>
                <input type="text" name="NAME" value="<?=htmlspecialcharsbx($arResult["arUser"]["NAME"])?>" />
                <input type="hidden" name="LAST_NAME" value="<?=htmlspecialcharsbx($arResult["arUser"]["LAST_NAME"])?>" />
                <input type="hidden" name="SECOND_NAME" value="<?=htmlspecialcharsbx($arResult["arUser"]["SECOND_NAME"])?>" />
            </div>

            <div class="field-blue">
                <label>Телефон (не обязательно)</label>
                <input
                        type="text"
                        name="PERSONAL_PHONE"
                        id="phone_input"
                placeholder="+7 (___) ___-__-__"
                value="<?=htmlspecialcharsbx($arResult["arUser"]["PERSONAL_PHONE"])?>"
                autocomplete="off"
                />
            </div>

            <div class="field-blue">
                <label>Эл. почта</label>
                <input type="text" value="<?=htmlspecialcharsbx($arResult["arUser"]["EMAIL"])?>" disabled />
                <input type="hidden" name="EMAIL" value="<?=htmlspecialcharsbx($arResult["arUser"]["EMAIL"])?>" />
            </div>

            <div class="field-gray">
                <input type="text" name="PERSONAL_CITY" placeholder="Город" value="<?=htmlspecialcharsbx($arResult["arUser"]["PERSONAL_CITY"])?>" />
            </div>

            <div class="field-gray">
                <input type="text" name="WORK_COMPANY" placeholder="Компания" value="<?=htmlspecialcharsbx($arResult["arUser"]["WORK_COMPANY"])?>" />
            </div>

            <div class="field-gray">
                <input type="text" name="WORK_POSITION" placeholder="Должность" value="<?=htmlspecialcharsbx($arResult["arUser"]["WORK_POSITION"])?>" />
            </div>

            <div class="field-gray">
                <input type="text" name="UF_TELEGRAM" placeholder="@TelegramNickName" value="<?=htmlspecialcharsbx($arResult["arUser"]["UF_TELEGRAM"])?>" />
            </div>

            <div class="hh-section">
                <div class="hh-link">
                    <div class="hh-logo">hh</div>
                    <a href="<?=$address?>">Привязать профиль в hh.ru</a>
                </div>
                <div class="hh-desc">
                    После привязки профиля, данные о пройденных сертификациях будут передаваться на сайт hh.ru
                </div>
            </div>

            <div class="buttons">
                <button type="button" class="btn btn-cancel" onclick="history.back()">Отменить</button>
                <button type="submit" name="save" value="Y" class="btn btn-save">Сохранить</button>
            </div>

            <div class="delete-account" onclick="if(confirm('Вы уверены, что хотите удалить аккаунт? Это действие нельзя отменить.')) location.href='/personal/delete/'">
                <div class="delete-icon"></div>
                <div>Удалить аккаунт</div>
            </div>
        </form>
        <?php CJSCore::Init(['masked_input']); ?>

        <script>
            BX.ready(function() {
                var phoneInput = BX('phone_input');
                if (phoneInput) {
                    new BX.MaskedInput({
                        mask: '+7 (999) 999-99-99',
                        input: phoneInput,
                        placeholder: '_'
                    });
                }
            });
        </script>
    </main>
</div>

