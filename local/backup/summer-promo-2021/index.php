<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
/**
 * @var $APPLICATION ;
 */
$APPLICATION->SetPageProperty("DONT_SHOW_PAGE_TOP", "Y");
$APPLICATION->SetTitle("Летние школы ‘21");
$APPLICATION->SetPageProperty("description","7 ключевых направлений – найди школу своей профессии и получи скидку 20% на набор из трех курсов!<br>Время работы Летних школ – до 31 августа!"); ?>
<div class="banner">
    <div class="banner__view">
        <div class="banner__info">
            <div class="banner__title section-box__title"><b>Летние школы ‘21</b></div>
            <div class="banner__description">
                7 ключевых направлений – найдите школу своей профессии и получите скидку 20% на набор из трех курсов!<br>
                <span class="banner__sale">Срок действия акции – до 31 августа</span>
            </div>
            <div class="banner__mobile-text">Нажимайте на фигуры для выбора</div>
        </div>
        <img src="Artboard.png" class="banner__image">
        <img src="Artboard_mobile.png" class="banner__image _mobile">
        <?include ('svg_mobile.php')?>
        <?include ('svg.php')?>
        <div class="promo-modal" id="promo-modal-1">
            <div class="promo-modal__box">
                <div class="promo-modal__close"></div>
                <span class="promo-modal__title">Системный аналитик</span>
                <a href="/summer-school/systems-analyst/"
                   class="promo-modal__promo"><b>Выбрать</b></a>
            </div>
        </div>
        <div class="promo-modal" id="promo-modal-2">
            <div class="promo-modal__box">
                <div class="promo-modal__close"></div>
                <span class="promo-modal__title">BABOK</span>
                <a href="/summer-school/babok/"
                   class="promo-modal__promo"><b>Выбрать</b></a>
            </div>
        </div>
        <div class="promo-modal" id="promo-modal-3">
            <div class="promo-modal__box">
                <div class="promo-modal__close"></div>
                <span class="promo-modal__title">Java-разработчик</span>
                <a href="/summer-school/java-developer/"
                   class="promo-modal__promo"><b>Выбрать</b></a>
            </div>
        </div>
        <div class="promo-modal" id="promo-modal-4">
            <div class="promo-modal__box">
                <div class="promo-modal__close"></div>
                <span class="promo-modal__title">Data Scientist на Python</span>
                <a href="/summer-school/python-data-scientist/"
                   class="promo-modal__promo"><b>Выбрать</b></a>
            </div>
        </div>
        <div class="promo-modal" id="promo-modal-5">
            <div class="promo-modal__box">
                <div class="promo-modal__close"></div>
                <span class="promo-modal__title">Архитектор ПО</span>
                <a href="/summer-school/software-architect/"
                   class="promo-modal__promo"><b>Выбрать</b></a>
            </div>
        </div>
        <div class="promo-modal" id="promo-modal-7">
            <div class="promo-modal__box">
                <div class="promo-modal__close"></div>
                <span class="promo-modal__title">Senior Java-разработчик</span>
                <a href="/summer-school/java-senior/"
                   class="promo-modal__promo"><b>Выбрать</b></a>
            </div>
        </div>
        <div class="promo-modal" id="promo-modal-8">
            <div class="promo-modal__box">
                <div class="promo-modal__close"></div>
                <span class="promo-modal__title">Frontend-разработчик React</span>
                <a href="/summer-school/react/"
                   class="promo-modal__promo"><b>Выбрать</b></a>
            </div>
        </div>
    </div>
</div>
<p class="banner__after">Начните лето с развития! В наших Летних школах вы освоите новые навыки или прокачаете свой текущий уровень!</p>
<div class="person-background">
    <div class="person">
        <div class="image">
            <img src="rules.svg" alt="">
        </div>
        <div class="holder">
            <ul class="promo-modal__list">
                <li class="promo-modal__item">Для участия в промоакции необходимо зарегистрироваться на школу на сайте ibs-training.ru.</li>
                <li class="promo-modal__item">Заявку можно подать не позднее чем за 2 недели до начала обучения. Учебный центр оставляет за собой право в одностороннем порядке изменить даты проведения курсов.</li>
                <li class="promo-modal__item">Скидки не суммируются. Для юридических лиц скидка действует при условии участия в программе обучения одного человека. Уточнить детали можно по email: <a href="mailto:<?=EMAIL_ADDRESS?>"><?=EMAIL_ADDRESS?></a>.</li>
                <li class="promo-modal__item">Акция распространяется на курсы в расписании с 10.06.2021 до 31.12.2021. Срок действия промоакции - до 31.08.2021</li>
            </ul>
        </div>
    </div>
</div>
<section class="section-box _callback-contacts">
    <div class="section-box__container container">
        <div class="section-box__header">
            <div class="section-box__title"><b>Остались вопросы?</b><br>
                Получите консультацию менеджера
            </div>
        </div>
        <div class="section-box__content">
            <form class="form callback-mini" name="callback-contacts" data-form-type="webform" data-form-id="37">
                <div class="form__success">
                    <div class="form__success-message"><b>Спасибо.</b><br> Ваш запрос был получен.</div>
                </div>
                <div class="form__content">
                    <div class="fields">
                        <?=bitrix_sessid_post()?>
                        <input type="hidden" name="addField" value="">
                        <input type="hidden" name="school" value="Промостраница">
                        <div class="form-row">
                            <label class="field-box">
                                <input class="field" type="text" name="name" placeholder="Имя" value="">
                            </label>
                            <label class="field-box">
                                <input class="field" type="text" name="company" placeholder="Компания" value="">
                            </label>
                        </div>
                        <div class="form-row">
                            <label class="field-box">
                                <input class="field" type="text" name="email" placeholder="E-mail" value="">
                            </label>
                            <label class="field-box">
                                <input class="field" type="tel" name="phone" placeholder="Телефон" value="">
                            </label>
                        </div>
                        <div class="form-row">
                            <label class="field-box _wide">
                                <textarea class="field" name="message" placeholder="Сообщение"></textarea>
                            </label>
                        </div>
                        <br>
                        <label class="agree-text" style="color: #003979"><input checked="checked" name="agree" value="Y" type="checkbox">Настоящим я подтверждаю, что я ознакомлен с <a style="text-decoration: underline;" target="_blank" href="/terms-of-use/">Terms of use</a>, условия мне понятны и я согласен соблюдать их.</label>
                        <label class="agree-text" style="color: #003979"><input checked="checked" name="agree-2" value="Y" type="checkbox">Я ознакомлен с порядком обработки моих персональных данных согласно <a style="text-decoration: underline; color: #fb9024" target="_blank" href="/privacy-policy/">Privacy Policy</a>.</label>
                    </div>
                    <button type="submit" class="button _submit _w-full _size-l"><span>Отправить</span></button>
                </div>
            </form>
        </div>
    </div>
</section>
<style>
    #shadow {
        display: block;
        opacity: 0;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.35);
        z-index: 1;
        transition: 0.3s;
    }

    #obj-1, [data-name='obj-1'],
    #obj-2, [data-name='obj-2'],
    #obj-3, [data-name='obj-3'],
    #obj-4, [data-name='obj-4'],
    #obj-5, [data-name='obj-5'],
    #obj-6, [data-name='obj-6'],
    #obj-7, [data-name='obj-7'],
    #obj-8, [data-name='obj-8'] {
        cursor:pointer;
    }

    #obj-1,#obj-2,#obj-3,#obj-4,#obj-5,#obj-6,#obj-7,#obj-8,
    [data-name='obj-1'], [data-name='obj-2'], [data-name='obj-3'], [data-name='obj-4'], [data-name='obj-5'], [data-name='obj-6'], [data-name='obj-7'], [data-name='obj-8'] {
        transition: 0.3s;
        opacity: 0;
    }
    #shadow {
        transition: 0.3s;
        opacity: 0;
    }


    .promo-modal {
        position: absolute;
        opacity: 0;
        visibility: hidden;
        transition: 0.3s;
        padding: 3%;
        padding-right: 0;
        box-sizing: content-box;
        z-index: 9;
    }
    .promo-modal.visibility {
        opacity: 1;
        visibility: visible;
        transition: 0.3s;
    }

    .promo-modal__box {
        display: block;
        max-width: 640px;
        border-radius: 40px;
        border: 2px solid #ff8611;
        background: #fff;
        padding: 8% 8%;
        z-index: 999;
    }

    .promo-modal__promo:hover {
        text-decoration: underline;
        border-color: #ff8611;
        background: #fff;
        color: #ff8611;
    }

    .promo-modal__title {
        display: block;
        margin-bottom: 10px;
        width: 100%;
        font-size: 28px;
        font-weight: 700;
        opacity: 0.85;
        text-align: center;
        color: #f26f21;
    }
    .promo-modal__description {
        font-size: 14px;
        color: #1c427a;
        margin-bottom: 16px;
        line-height: 1.2;
    }
    .promo-modal__item {
        position: relative;
        padding-left: 8px;
        margin-bottom: 8px;
        font-size: 16px;
    }
    .promo-modal__item:before {
        content: '';
        display: block;
        width: 4px;
        height: 4px;
        border-radius: 50%;
        background: #f26f21;
        position: absolute;
        left: 0;
        top: 50%;
        margin-top: -2px;
    }

    .promo-modal__item:last-of-type {
        margin-bottom: 16px;
    }

    .promo-modal__promo {
        display: block;
        color: #fff;
        cursor: pointer;
        text-align: center;
        line-height: 48px;
        background: #ff8611;
        border-radius: 4px;
        border: 2px solid #ff8611;
    }
    .promo-modal__promo b {
        font-weight: 700;
        font-size: 20px;
    }

    #promo-modal-1 {
        top: 72%;
        left: 6%;
        width: 20%;
    }

    #promo-modal-2 {
        top: 73%;
        left: 10%;
        width: 20%;
    }

    #promo-modal-3 {
        top: 81.4%;
        left: 27%;
        width: 20%;
        padding-left: 0;
        padding-bottom: 3%;
    }

    #promo-modal-4 {
        top: 50%;
        left: 44%;
        width: 20%;
        padding-left: 0;
        padding-right: 3%;
    }

    #promo-modal-5 {
        top: 80%;
        left: 48%;
        width: 20%;
        padding-left: 0;
        padding-right: 3%;
    }

    #promo-modal-6 {
        top: 46%;
        left: 64%;
        width: 20%;
        padding-left: 0;
        padding-right: 3%;
    }

    #promo-modal-7 {
        top: 55%;
        left: 61%;
        width: 20%;
        padding-left: 0;
        padding-right: 3%;
    }

    #promo-modal-8 {
        top: 78%;
        left: 76%;
        width: 20%;
    }

    .banner {
        position: relative;
        background: #6f9b99;
    }

    .banner__view > svg {
        position: absolute;
        top: 0;
        left: 0;

        z-index: 9;
    }

    .banner__info {
        width: 100%;
        position: absolute;
        height: 100%;
        top: 0;
        left: 0;
        text-align: center;
        color: #fff;
        z-index: 9;
    }

    .banner__title {
        font-size: 56px;
        color: #fff;
        padding: 42px 0;
    }
    .banner__description {
        font-size: 40px;
        line-height: 1.4;
        max-width: 1220px;
        margin: 0 auto 32px;
    }
    .banner__sale {
        font-size: 28px;
    }

    .banner__view {
        overflow: hidden;
    }

    .banner__image {
        display: block;
        width: 100%;
        max-width: 100%;
        margin: 0 auto;
        z-index: 0;
    }

    .banner__after {
        width: 85%;
        font-size: 40px;
        text-align: center;
        padding: 56px 0;
        color: #6f9b99;
        margin: 0 auto;
    }
    .section-box__title {
        font-size: 40px;
    }
    .banner__mobile-text {
        display: none;
    }

    .person-background {
        padding: 0 0 56px 0;
        width: 100%;
        background: url(bg-b.png) no-repeat 0 100%;
    }

    .person {
        margin: 0 auto;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 85%;
        flex-direction: row;
    }

    .holder {
        line-height: 1.6;
        font-size: 20px;
    }

    .person {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .person .image {
        min-width: 30%;
        margin: 0 70px 0 0;
    }

    .person .image img {
        max-width: 360px;
        max-height: 100%;
        display: block;
    }

    .person p {
        margin: 0 0 10px;
        display: block;
    }

    ._mobile {
        display: none;
    }
    .promo-modal__close {
        display: none;
    }

    .holder .promo-modal__item:before {
        top: 10px;
        margin-top: 0;
        left: -5px;
    }

    @media (max-width: 1679px) {
        .banner__title {
            font-size: 48px;
        }
        .banner__description {
            font-size: 32px;
        }
        .banner__image {

        }
        .banner__view > svg {

        }
        #promo-modal-1 {
            top: 72%;
            left: 6%;
            width: 20%;
        }
        #promo-modal-2 {
            top: 73%;
            left: 10%;
            width: 20%;
        }
        #promo-modal-3 {
            top: 81.4%;
            left: 27%;
            width: 20%;
            padding-left: 0;
            padding-bottom: 3%;
        }
        #promo-modal-4 {
            top: 50%;
            left: 44%;
            width: 20%;
            padding-left: 0;
            padding-right: 3%;
        }
        #promo-modal-5 {
            top: 80%;
            left: 48%;
            width: 20%;
            padding-left: 0;
            padding-right: 3%;
        }
        #promo-modal-6 {
            top: 46%;
            left: 64%;
            width: 20%;
            padding-left: 0;
            padding-right: 3%;
        }
        #promo-modal-7 {
            top: 55%;
            left: 61%;
            width: 20%;
            padding-left: 0;
            padding-right: 3%;
        }
        #promo-modal-8 {
            top: 78%;
            left: 76%;
            width: 20%;
        }
    }
    @media (max-width: 1023px) {
        .banner__info {
            position: static;
        }
        .banner__view > svg,
        .banner__image {
            display: none;
        }
        .banner__image._mobile {
            margin-top: -25%;
            display: block;
        }
        .banner__view > svg._mobile {
            display: block;
            top: auto;
            bottom: 2px;
        }
        .banner__title {}
        .banner__description {}
        .banner__mobile-text {
            position: absolute;
            bottom: 7px;
            left: 0;
            right: 0;
            margin: auto;
            font-size: 16px;
            display: block;
        }
        .promo-modal__title {
            font-size: 20px;
        }
        .promo-modal__promo {
            line-height: 38px;
        }
        .promo-modal__promo b {
            font-weight: 700;
            font-size: 16px;
        }
    }
    @media (max-width: 767px) {
        .banner__sale {
            font-size: 20px;
            padding-top: 10px;
            display: inline-block;
        }
        .page._content {
            padding-top: 156px;
        }
        .search {
            height: 156px;
        }
        .person {
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .banner__title {
            font-size: 26px;
            padding: 16px 0;
        }
        .banner__description {
            font-size: 20px;
        }

        .person .image {
            margin-right: 0;
        }
        .person .image img {
            max-width: ;
            padding-right: 0;
        }

        .promo-modal {
            top: 34%!important;
            left: 3%!important;
            right: 3%!important;
            width: 94%!important;
            padding-left: 0!important;
            padding-right: 0!important;
        }
        .promo-modal__close {
            display: block;
            position: absolute;
            top: 0;
            right: 0;
            width: 46px;
            height: 40px;
            background: #f26f21 url(close.svg) 52% 46% / auto 36% no-repeat;
            z-index: 9;
            border-radius: 0 0 0 26px;
        }
        .promo-modal__box {
            overflow: hidden;
            position: relative;
            border-radius: 26px;
            padding: 3% 9% 3% 3%;
            text-align: center;
        }
        .promo-modal__title {
            font-size: 20px;
        }
        .banner__after {
            font-size: 22px;
        }
        .section-box__title {
            font-size: 22px;
        }
        .person .image {
            margin-bottom: 24px;
            padding: 24px 0;
        }
        .person .image img {
            width: 100%;
            max-width: 160px;
        }
        .holder {
            font-size: 14px;
        }
        .promo-modal__promo {
            display: inline-block;
            padding: 0 10px;
        }
    }
</style>
<script>
    $(document).on('click','.promo-modal__promo',function (e) {
        e.preventDefault();
        var link = $(this).attr('href'),
            schoolName = $(this).closest('.promo-modal__box').find('.promo-modal__title').text()
        ym(23056159,'reachGoal','summer-action-click-more', {'name': schoolName}, function () {
            window.location.href = link
        })
    })

    var $target = null
    $('#obj-1,#obj-2,#obj-3,#obj-4,#obj-5,#obj-6,#obj-7,#obj-8,#shadow').hover(
        function (e) {
            e.stopPropagation()
            if($target != null && $target.data('id') &&$target.data('id') !== $(this).closest('.promo-modal').attr('id')) {
                var idModal = $target.data('id');
                $('#' + idModal).removeClass('visibility')
                $target.css('opacity', '0');
                $('#shadow').css('opacity', '0');
            }
            if($(this).attr('id') && $(this).attr('id') !== 'shadow') {
                $target = $(this);
                var idModal = $(this).data('id');
                $('#' + idModal).addClass('visibility')
                $(this).css('opacity', '1');
                $('#shadow').css('opacity', '0.5');
            }
        },
        function (e) {
            e.stopPropagation();
            if($(this).data('id') !== $(e.toElement).closest('.promo-modal').attr('id')) {
                var idModal = $target.data('id');
                $('#' + idModal).removeClass('visibility')
                $target.css('opacity', '0');
                $('#shadow').css('opacity', '0');
            }
        }
    );
    $('[data-name="obj-1"],[data-name="obj-2"],[data-name="obj-3"],[data-name="obj-4"],[data-name="obj-5"],[data-name="obj-6"],[data-name="obj-7"],[data-name="obj-8"]')
        .on('click', function (e) {
        e.stopPropagation();
        var idModal = $(this).data('id');
        $('#' + idModal).addClass('visibility')
        $(this).css('opacity', '1');
    })
    $('.promo-modal__close')
        .on('click', function (e) {
            e.stopPropagation();
            var idModal = $(this).closest('.promo-modal').attr('id');
            $(this).closest('.promo-modal').removeClass('visibility');
            $('[data-id='+idModal+']').css('opacity', '0');
        })
</script>
<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
