<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("DONT_SHOW_PAGE_TOP", "Y");
$APPLICATION->SetPageProperty("title", "Анкета для ФИС ФРДО");
$APPLICATION->SetPageProperty("keywords", "");
$APPLICATION->SetPageProperty("description", "");
$APPLICATION->SetTitle("Контакты Luxoft Training  ");
?>
<div class="section-box" style="background-color: #f2f2f2">
    <div class="section-box__container container">
        <div class="section-box__header">
            <div class="section-box__title"><b>Анкета для передачи данных в ФИС ФРДО</b></div>
            <div class="section-box__subtitle">Уважаемые участники! Заполните, пожалуйста, анкету. Мы собираем
                Персональные данные в целях формирования и ведения ФИС ФРДО. Передача указанных Персональных данных
                осуществляется на основании требований ч. 9, 10 ст. 98, п. 2 ч. 15 ст. 107 Федерального закона от
                29.12.2012 № 273-ФЗ «Об образовании в Российской Федерации» и Постановления Правительства РФ от
                26.08.2013 № 729 «О федеральной информационной системе «Федеральный реестр сведений о документах об
                образовании и (или) о квалификации, документах об обучении».
            </div>
        </div>
        <div class="section-box__content">
            <form class="form callback-mini" name="frdo" data-form-type="webform">
                <div class="form__success">
                    <div class="form__success">
                        <div class="form__success-message" style="padding: 15px"><b>Спасибо!</b><br>
                            Ваша анкета отправлена.<br>
                            <br>
                        </div>
                    </div>
                </div>
                <div class="form__content">
                    <div class="fields">
                        <?=bitrix_sessid_post()?>
                        <input type="hidden" name="addField" value="">
                        <input type="hidden" name="COURSE" value="">
                        <label class="field-box">
                            <input class="field" type="text" name="COURSE-NAME" placeholder="Название курса" value="">
                            <br>
                            <br>
                            <p>*Введите код или название курса и выберите дату начала</p>
                        </label>
                        <label class="field-box">
                            <input class="field" type="text" name="FIO" data-inputmask-regex="[а-яА-Я\s]*" placeholder="Фамилия, Имя, Отчество" value="">
                        </label>
                        <label class="field-box">
                            <input class="field" type="tel" name="PHONE" placeholder="Телефон" value="">
                        </label>
                        <label class="field-box">
                            <select name="POSITION" class="field-select" id="" data-placeholder="Выберите должность\роль" placeholder="Выберите должность\роль">
                                <option></option>
                                <option value="Системный аналитик">Системный аналитик</option>
                                <option value="Дизайнер интерфейсов UI/UX">Дизайнер интерфейсов UI/UX</option>
                                <option value="Инженер больших данных">Инженер больших данных</option>
                                <option value="Аналитик данных">Аналитик данных</option>
                                <option value="Архитектор ПО">Архитектор ПО</option>
                                <option value="Архитектор ИТ решений">Архитектор ИТ решений</option>
                                <option value="Java разработчик">Java разработчик</option>
                                <option value=".NET разработчик">.NET разработчик</option>
                                <option value="Web разработчик">Web разработчик</option>
                                <option value="Разработчик мобильных приложений">Разработчик мобильных приложений</option>
                                <option value="Python разработчик">Python разработчик</option>
                                <option value="Менеджер проектов">Менеджер проектов</option>
                                <option value="Тимлид">Тимлид</option>
                                <option value="Инженер по автоматизации тестирования">Инженер по автоматизации тестирования</option>
                                <option value="Тестировщик ПО">Тестировщик ПО</option>
                                <option value="Инженер DevOps">Инженер DevOps</option>
                                <option value="Инженер по безопасности ПО">Инженер по безопасности ПО</option>
                                <option value="Руководитель ИТ отдела/департамента">Руководитель ИТ отдела/департамента</option>
                                <option value="other">Другое (укажите)</option>
                            </select>
                        </label>
                        <label class="field-box" style="display: none">
                            <input class="field ignore" type="text" name="POSITION_CUSTOM" placeholder="Укажите должность\роль" value="">
                        </label>
                        <label class="field-box">
                            <input class="field" type="text" name="COMPANY" placeholder="Компания" value="">
                        </label>
                        <label class="field-box">
                            <input class="field" type="text" name="BIRTHDAY" placeholder="Дата рождения" value="">
                        </label>
                        <label class="field-box">
                            <input class="field" type="text" name="SNILS" placeholder="СНИЛС" value="">
                        </label>
                        <label class="field-box">
                            <input class="field" type="text" name="ADDRESS" placeholder="Адрес регистрации/проживания" value="">
                            <br>
                            <br>
                            <p>*По требованию Федерального закона "Об образовании в Российской Федерации" от 29.12.2012 N 273-ФЗ адрес прописывается в договоре</p>
                        </label>
                        <label class="field-box">
                            <input class="field" type="text" name="EMAIL" placeholder="Email" value="">
                        </label>
                        <label class="agree-text" style="color: #003979;line-height: 1.4">
                            <input name="agree" value="Y" type="checkbox">Настоящим  я подтверждаю, что уведомлен и согласен на передачу моих <a style="text-decoration: underline;" target="_blank" href="/privacy-policy/">Персональных данных</a> в целях формирования и ведения ФИС ФРДО</label>
                    </div>
                    <button type="submit" class="button _submit _w-full _size-l"><span>Отправить анкету</span></button>
                </div>
            </form>
        </div>
    </div>
</div>
<style>
    .jq-selectbox.error {
        border: 1px solid #cd0505;
    }
    .form__content .jq-selectbox__select {
        background: #fff;
        height: 58px;
        border-radius: 4px;
        border-bottom: none;
    }
    .form__content .jq-selectbox__select-text {
        line-height: 58px;
        padding-top: 0;
    }
    .form__content .jq-selectbox__trigger-arrow {
        top: 50%;
        margin-top: -2px;
    }
    .form__content .jq-selectbox__dropdown {
        top: 100% !important;
        margin: 0;
        box-shadow: none;
    }
    .jq-selectbox__dropdown ul {
         background: #ffffff;
    }
</style>
<script>
    $(function() {
        var lastValue = '';
        $('select').styler();
        $(document)
            .on('change', '[name="COURSE-NAME"]', function () {
                if(lastValue !== $(this).val()) {
                    lastValue = ''
                    $(this).val('')
                    $('[name="COURSE"]').val('');
                }
            })
            .on('change', '[name="POSITION"]', function () {
                if($(this).val() === 'other') {
                    $('[name="POSITION_CUSTOM"]').removeClass('ignore');
                    $('[name="POSITION_CUSTOM"]').parent().css('display', 'block');
                } else {
                    $('[name="POSITION_CUSTOM"]').addClass('ignore');
                    $('[name="POSITION_CUSTOM"]').parent().css('display', 'none');
                }
                setTimeout(function() {
                    $('input, select').trigger('refresh');
                }, 1);
            })
        $('[name="FIO"]').inputmask()
        $('[name="BIRTHDAY"]').inputmask("99.99.9999",{ "placeholder": "дд.мм.гггг" })
        $('[name="SNILS"]').inputmask("999-999-999 99",{ "placeholder": "XXX-XXX-XXX YY" })
        $('[name="COURSE-NAME"]').autocomplete({
            source: function (request, response) {
                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: 'search.php?type=s',
                    data: {
                        maxRows: 12, // показать первые 12 результатов
                        nameStartsWith: request.term // поисковая фраза
                    },
                    success: function (data) {
                        response($.map(data, function (item) {
                            return {
                                id: item.id, // ссылка на страницу товара
                                label: item.title_ru // наименование товара
                            }
                        }));
                    }
                });
            },
            select: function (event, ui) {

                // по выбору - перейти на страницу товара
                // Вы можете делать вывод результата на экран
                $('[name="COURSE"]').val(ui.item.id)
                lastValue = ui.item.value;
            },
            minLength: 3 // начинать поиск с трех символов
        });
    })
</script>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
