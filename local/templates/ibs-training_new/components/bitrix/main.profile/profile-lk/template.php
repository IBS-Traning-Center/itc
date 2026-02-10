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
                    <a href="<?=$address?>" class="hh-profile-link">Привязать профиль в hh.ru</a>
                </div>
                <div class="hh-desc">
                    После привязки профиля, данные о пройденных сертификациях будут передаваться на сайт hh.ru
                </div>
            </div>
            <div class="profile-link-block">
                <div class="inner-row">
                    <div class="hh-logo">hh</div>

                    <div class="text">
                        Ваш профиль привязан к hh.ru
                    </div>
                    <div class="unlink">Отвязать</div>

                </div>

            </div>
            <div class="buttons">
                <button type="button" class="btn btn-cancel" onclick="history.back()">Отменить</button>
                <button type="submit" name="save" value="Y" class="btn btn-save">Сохранить</button>
            </div>

            <div class="delete-account" onclick="if(confirm('Вы уверены, что хотите удалить аккаунт? Это действие нельзя отменить.')) location.href='/personal/delete/'">
                <svg width="20" height="22" viewBox="0 0 20 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M18.4346 6.40918L16.082 21.5762L16.0166 22H3.68945L3.62305 21.5762L1.27051 6.40918L2.25879 6.25684L4.5459 21H15.1592L17.4463 6.25684L18.4346 6.40918ZM13.1172 0.330078L14.291 3.58301H20V4.58301H0V3.58301H5.77832L5.71777 3.55566L7.19141 0.293945L7.32422 0H12.998L13.1172 0.330078ZM6.80371 3.58301H13.2275L12.2959 1H7.96973L6.80371 3.58301Z" fill="#BF031B"/>
                </svg>

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

