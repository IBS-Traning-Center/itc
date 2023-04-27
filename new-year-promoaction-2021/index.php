<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
/**
 * @var $APPLICATION ;
 */
$APPLICATION->SetPageProperty("DONT_SHOW_PAGE_TOP", "Y");
$APPLICATION->SetTitle("Новогодние мастерские`21"); ?>
<div class="banner">
    <div class="banner__view">
        <div class="banner__info">
            <div class="banner__title section-box__title"><b>Новогодние мастерские`21</b></div>
            <div class="banner__description">
                11 ключевых направлений - найди мастерскую для своей профессии и получи скидку 21% на программу из 3 курсов<br>
                Время работы мастерских – до 31.01.2021
            </div>
            <div class="banner__mobile-text">Нажимай на сооружения для выбора</div>
        </div>
        <img src="Artboard.jpg" class="banner__image">
        <img src="Artboard_mobile.jpg" class="banner__image _mobile">
        <?include ('svg_mobile.php')?>
        <?include ('svg.php')?>
        <div class="promo-modal" id="promo-modal-1">
            <div class="promo-modal__box">
                <div class="promo-modal__close"></div>
                <div class="promo-modal__title">Мастерская Java-разработчика</div>
                <div class="promo-modal__description">Освоишь разработку на Java c нуля и продвинешься в сторону Spring</div>
                <ol class="promo-modal__list">
                    <li class="promo-modal__item">
                        <a href="https://ibs-training.ru/kurs/razrabotka_na_platforme_java_se_bazovye_temy.html"
                        >Разработка на платформе Java SE. Базовые темы</a>
                    </li>
                    <li class="promo-modal__item">
                        <a href="https://ibs-training.ru/kurs/razrabotka_na_platforme_java_se_rasshirennye_temy.html"
                        >Разработка на платформе Java SE. Расширенные темы</a>
                    </li>
                    <li class="promo-modal__item">
                        <a href="https://ibs-training.ru/kurs/vladenie_karkasom_razrabotki_spring_framework_5.html"
                        >Владение каркасом разработки Spring Framework 5</a>
                    </li>
                </ol>
                <div class="promo-modal__promo"><b>NY2021JVA</b></div>
            </div>
        </div>
        <div class="promo-modal" id="promo-modal-2">
            <div class="promo-modal__box">
                <div class="promo-modal__close"></div>
                <div class="promo-modal__title">Мастерская Frontend-разработчика на Angular</div>
                <div class="promo-modal__description">Освоишь веб-фреймворк Angular и повысишь эффективность и качество кода</div>
                <ol class="promo-modal__list">
                    <li class="promo-modal__item">
                        <a href="https://ibs-training.ru/kurs/razrabotka_na_javascript.html"
                        >Разработка на JavaScript</a>
                    </li>
                    <li class="promo-modal__item">
                        <a href="https://ibs-training.ru/kurs/angular_9.html"
                        >Разработка на Angular 9</a>
                    </li>
                    <li class="promo-modal__item">
                        <a href="https://ibs-training.ru/kurs/razrabotka_na_angular_prodvinutyy_uroven.html"
                        >Angular. Продвинутый уровень</a>
                    </li>
                </ol>
                <div class="promo-modal__promo"><b>NY2021WEB1</b></div>
            </div>
        </div>
        <div class="promo-modal" id="promo-modal-3">
            <div class="promo-modal__box">
                <div class="promo-modal__close"></div>
                <div class="promo-modal__title">Мастерская Frontend-разработчика на React</div>
                <div class="promo-modal__description">Научишься использовать библиотеку и фреймворк React и начнешь быстро создавать приложения в декларативном стиле</div>
                <ol class="promo-modal__list">
                    <li class="promo-modal__item">
                        <a href="https://ibs-training.ru/kurs/razrabotka_na_javascript.html"
                        >Разработка на JavaScript</a>
                    </li>
                    <li class="promo-modal__item">
                        <a href="https://ibs-training.ru/kurs/razrabotka_na_reactjs.html"
                        >Разработка на React.js</a>
                    </li>
                    <li class="promo-modal__item">
                        <a href="https://ibs-training.ru/kurs/react_advanced_prodvinutye_temy.html"
                        >React Advanced: продвинутые темы</a>
                    </li>
                </ol>
                <div class="promo-modal__promo"><b>NY2021WEB2</b></div>
            </div>
        </div>
        <div class="promo-modal" id="promo-modal-4">
            <div class="promo-modal__box">
                <div class="promo-modal__close"></div>
                <div class="promo-modal__title">Мастерская архитектора ПО</div>
                <div class="promo-modal__description">Изучишь ключевые практики системной архитектуры, как их дополняют концепции Agile, а также научишься проектировать облачные приложения </div>
                <ol class="promo-modal__list">
                    <li class="promo-modal__item">
                        <a href="https://ibs-training.ru/kurs/klyuchevye_praktiki_arhitektora_po.html"
                        >Ключевые практики архитектора ПО</a>
                    </li>
                    <li class="promo-modal__item">
                        <a href="https://ibs-training.ru/kurs/arhitektura_v_agile-proektah.html"
                        >Архитектура в Agile-проектах</a>
                    </li>
                    <li class="promo-modal__item">
                        <a href="https://ibs-training.ru/kurs/arhitektura_oblachnyh_prilogeniy.html"
                        >Архитектура облачных приложений</a>
                    </li>
                </ol>
                <div class="promo-modal__promo"><b>NY2021ARC</b></div>
            </div>
        </div>
        <div class="promo-modal" id="promo-modal-5">
            <div class="promo-modal__box">
                <div class="promo-modal__close"></div>
                <div class="promo-modal__title">Мастерская автоматизатора тестирования ПО</div>
                <div class="promo-modal__description">Освоишь автоматизированное тестирование, на практике научишься разрабатывать программы на Java, проектировать на Selenium Web Driver и использовать Cucumber и Gherkin. </div>
                <ol class="promo-modal__list">
                    <li class="promo-modal__item">
                        <a href="https://ibs-training.ru/kurs/shkola_avtomatizirovannogo_testirovaniya_chast_1_vvedenie_v_java.html"
                        >Школа QA Automation. Часть 1. Введение в Java</a>
                    </li>
                    <li class="promo-modal__item">
                        <a href="https://ibs-training.ru/kurs/_shkola_avtomatizirovannogo_testirovaniya_chast_2_selenium_webdriver.html"
                        >Школа QA Automation. Часть 2. Selenium WebDriver</a>
                    </li>
                    <li class="promo-modal__item">
                        <a href="https://ibs-training.ru/kurs/shkola_avtomatizirovannogo_testirovaniya_chast_3_bdd-testirovanie_s_cucumber.html"
                        >Школа QA Automation. Часть 3. BDD-тестирование с Cucumber</a>
                    </li>
                </ol>
                <div class="promo-modal__promo"><b>NY2021SQA</b></div>
            </div>
        </div>
        <div class="promo-modal" id="promo-modal-6">
            <div class="promo-modal__box">
                <div class="promo-modal__close"></div>
                <div class="promo-modal__title">Мастерская Data Scientist</div>
                <div class="promo-modal__description">Разберешься в способах хранения и обработки данных, освоишь на практике методы машинного обучения, исследуешь возможности языка Python для работы с DWH и в результате создашь свой программный продукт! </div>
                <ol class="promo-modal__list">
                    <li class="promo-modal__item">
                        <a href="https://ibs-training.ru/kurs/sovremennye_podhody_k_upravleniyu_dannymi.html"
                        >Современные подходы к управлению данными</a>
                    </li>
                    <li class="promo-modal__item">
                        <a href="https://ibs-training.ru/kurs/mashinnoe_obuchenie_na_praktike.html"
                        >Машинное обучение на практике</a>
                    </li>
                    <li class="promo-modal__item">
                        <a href="https://ibs-training.ru/kurs/razrabotka_realnogo_proekta_na_yazyke_python_prodvinutyy_uroven.html"
                        >Разработка реального проекта на языке Python. Продвинутый уровень</a>
                    </li>
                </ol>
                <div class="promo-modal__promo"><b>NY2021EAS1</b></div>
            </div>
        </div>
        <div class="promo-modal" id="promo-modal-7">
            <div class="promo-modal__box">
                <div class="promo-modal__close"></div>
                <div class="promo-modal__title">Мастерская Big Data инженера</div>
                <div class="promo-modal__description">На практике изучишь подходы к управлению и хранению данных, освоишь Hadoop и Apache Spark и станешь современным Big Data инженером!</div>
                <ol class="promo-modal__list">
                    <li class="promo-modal__item">
                        <a href="https://ibs-training.ru/kurs/sovremennye_podhody_k_upravleniyu_dannymi.html"
                        >Современные подходы к управлению данными</a>
                    </li>
                    <li class="promo-modal__item">
                        <a href="https://ibs-training.ru/kurs/osnovy_hadoop.html"
                        >Основы Hadoop</a>
                    </li>
                    <li class="promo-modal__item">
                        <a href="https://ibs-training.ru/kurs/osnovy_apache_spark.html"
                        >Основы Apache Spark</a>
                    </li>
                </ol>
                <div class="promo-modal__promo"><b>NY2021EAS2</b></div>
            </div>
        </div>
        <div class="promo-modal" id="promo-modal-8">
            <div class="promo-modal__box">
                <div class="promo-modal__close"></div>
                <div class="promo-modal__title">Мастерская системного аналитика</div>
                <div class="promo-modal__description">Освоишь визуальное моделирование, работу с требованиями, а также сформируешь навыки объектно-ориентированного анализа и проектирования систем</div>
                <ol class="promo-modal__list">
                    <li class="promo-modal__item">
                        <a href="https://ibs-training.ru/kurs/vizualnoe_modelirovanie_s_primeneniem_uml.html"
                        >Визуальное моделирование с применением UML</a>
                    </li>
                    <li class="promo-modal__item">
                        <a href="https://ibs-training.ru/kurs/masterskaya_po_rabote_s_trebovaniyami_ot_klassiki_do_user_stories.html"
                        >Мастерская по работе с требованиями: от классики до user stories</a>
                    </li>
                    <li class="promo-modal__item">
                        <a href="https://ibs-training.ru/kurs/obektno-orientirovannyy_analiz_i_proektirovanie_na_uml.html"
                        >Объектно-ориентированный анализ и проектирование на UML</a>
                    </li>
                </ol>
                <div class="promo-modal__promo"><b>NY2021REQ1</b></div>
            </div>
        </div>
        <div class="promo-modal" id="promo-modal-9">
            <div class="promo-modal__box">
                <div class="promo-modal__close"></div>
                <div class="promo-modal__title">Мастерская аналитика по работе с требованиями</div>
                <div class="promo-modal__description">Здесь оттачивается навык работы с требованиями. Изучишь различные аспекты роли аналитика – не только технические, но и психологические и коммуникативные, а также тонкости работы с требованиями в Agile-проектах.</div>
                <ol class="promo-modal__list">
                    <li class="promo-modal__item">
                        <a href="https://ibs-training.ru/kurs/masterskaya_po_rabote_s_trebovaniyami_ot_klassiki_do_user_stories.html"
                        >Мастерская по работе с требованиями: от классики до user stories</a>
                    </li>
                    <li class="promo-modal__item">
                        <a href="https://ibs-training.ru/kurs/delovaya_igra_po_sboru_i_analizu_trebovaniy.html"
                        >Деловая игра по сбору и анализу требований</a>
                    </li>
                    <li class="promo-modal__item">
                        <a href="https://ibs-training.ru/kurs/upravlenie_trebovaniyami_v_agile.html"
                        >Управление требованиями в Agile</a>
                    </li>
                </ol>
                <div class="promo-modal__promo"><b>NY2021REQ2</b></div>
            </div>
        </div>
        <div class="promo-modal" id="promo-modal-10">
            <div class="promo-modal__box">
                <div class="promo-modal__close"></div>
                <div class="promo-modal__title">Мастерская аналитика по моделированию бизнес-процессов</div>
                <div class="promo-modal__description">С нуля на практике освоишь нотацию BMPN, научишься строить хорошо структурированные модели бизнес-процессов и существенно повысишь качество своей работы</div>
                <ol class="promo-modal__list">
                    <li class="promo-modal__item">
                        <a href="https://ibs-training.ru/kurs/bpmn_modelirovanie_biznes-protsessov_osnovy.html"
                        >BPMN: Моделирование бизнес-процессов. Основы</a>
                    </li>
                    <li class="promo-modal__item">
                        <a href="https://ibs-training.ru/kurs/bpmn_modelirovanie_biznes-protsessov_prodvinutyy_uroven.html"
                        >BPMN: Моделирование бизнес-процессов. Продвинутый уровень</a>
                    </li>
                    <li class="promo-modal__item">
                        <a href="https://ibs-training.ru/kurs/bpmn_ispolnyaemye_modeli_biznes-protsessov.html"
                        >BPMN: Исполняемые модели бизнес-процессов</a>
                    </li>
                </ol>
                <div class="promo-modal__promo"><b>NY2021REQ3</b></div>
            </div>
        </div>
        <div class="promo-modal" id="promo-modal-11">
            <div class="promo-modal__box">
                <div class="promo-modal__close"></div>
                <div class="promo-modal__title">Мастерская бизнес-аналитика BABOK</div>
                <div class="promo-modal__description">Здесь ты не просто отточишь навыки, необходимые бизнес-аналитику, но и наберешь PD hours для сертификации IIBA<br> Выбери любые 3 курса из <a href="https://ibs-training.ru/training/katalog_kursov/kompleksnye-programmy/kp-business-an/">Программы бизнес-аналитика</a>, в названии которых указано BABOK Guide 3.0</div>
                <div class="promo-modal__promo"><b>NY2021REQ4</b></div>
            </div>
        </div>
    </div>
</div>
<p class="banner__after">Знание – чудо. В наших новогодних мастерских ты можешь освоить новые навыки, чтобы потом с их помощью творить!</p>
<div class="person-background">
    <div class="person">
        <div class="image">
            <img src="rules.png" alt="">
        </div>
        <div class="holder">
            <ul class="promo-modal__list">
                <li class="promo-modal__item">Для участия в промоакции необходимо зарегистрироваться на любой курс из программы мастерской на сайте ibs-training.ru. В поле «Комментарий» укажите соответствующий промокод и получите скидку 21% на программу из 3 курсов.</li>
                <li class="promo-modal__item">Заявку можно подать не позднее чем за 2 недели до начала обучения. Учебный центр оставляет за собой право в одностороннем порядке изменить даты проведения курса.</li>
                <li class="promo-modal__item">Скидки не суммируются. Для юридических лиц скидка действует при условии участия в программе обучения одного человека. Уточнить детали можно по email: <a href="mailto:<?=EMAIL_ADDRESS?>"><?=EMAIL_ADDRESS?></a>.</li>
                <li class="promo-modal__item">Акция распространяется на курсы в расписании с 01.01.2021 до 30.06.2021. Срок действия промоакции истекает 31.01.2021.</li>
            </ul>
        </div>
    </div>
</div>
<style>
    #obj-1, [data-name='obj-1'],
    #obj-2, [data-name='obj-2'],
    #obj-3, [data-name='obj-3'],
    #obj-4, [data-name='obj-4'],
    #obj-5, [data-name='obj-5'],
    #obj-6, [data-name='obj-6'],
    #obj-7, [data-name='obj-7'],
    #obj-8, [data-name='obj-8'],
    #obj-9, [data-name='obj-9'],
    #obj-10, [data-name='obj-10'],
    #obj-11  [data-name='obj-11'] {
        cursor:pointer;
    }

    #obj-1,#obj-2,#obj-3,#obj-4,#obj-5,#obj-6,#obj-7,#obj-8,#obj-9,#obj-10,#obj-11,
    [data-name='obj-1'], [data-name='obj-2'], [data-name='obj-3'], [data-name='obj-4'], [data-name='obj-5'], [data-name='obj-6'], [data-name='obj-7'], [data-name='obj-8'], [data-name='obj-9'], [data-name='obj-10'], [data-name='obj-11'] {
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
        max-width: 640px;
        border-radius: 40px;
        border: 2px solid #ff8611;
        background: #fff;
        padding: 3% 6%;
        z-index: 999;
    }

    .promo-modal__title {
        font-size: 24px;
        margin-bottom: 16px;
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
        color: #ff8611;
        cursor: pointer;
        text-align: center;
    }
    .promo-modal__promo b {
        font-weight: 700;
        font-size: 26px;
    }

    #promo-modal-1 {
        top: 50%;
        left: 43%;
        width: 27%;
    }

    #promo-modal-2 {
        top: 50%;
        left: 26%;
        width: 24%;
    }

    #promo-modal-3 {
        top: 52%;
        left: 23.6%;
        width: 26%;
        padding-left: 0;
        padding-bottom: 3%;
    }

    #promo-modal-4 {
        top: 35%;
        left: 27%;
        width: 30%;
        padding-left: 0;
        padding-right: 3%;
    }

    #promo-modal-5 {
        top: 52%;
        left: 29.5%;
        width: 30%;
        padding-left: 0;
        padding-right: 3%;
    }

    #promo-modal-6 {
        top: 44%;
        left: 14.5%;
        width: 30%;
        padding-left: 0;
        padding-right: 3%;
    }

    #promo-modal-7 {
        top: 55%;
        left: 61%;
        width: 28%;
        padding-left: 0;
        padding-right: 3%;
    }

    #promo-modal-8 {
        top: 52%;
        left: 18%;
        width: 32%;
    }

    #promo-modal-9 {
        top: 52%;
        left: 51.5%;
        width: 30%;
        padding-left: 0;
        padding-right: 3%;
    }

    #promo-modal-10 {
        top: 50%;
        left: 42%;
        width: 27%;
        padding-right: 3%;
        padding-left: 0;
    }

    #promo-modal-11 {
        top: 56%;
        left: 20.5%;
        width: 32%;
        padding-left: 0;
        padding-right: 3%;
    }

    .banner {
        position: relative;
    }

    .banner__view > svg {
        position: absolute;
        top: 0;
        left: 0;
        transform: translateY(-36%);
        margin-bottom: -33.2%;
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

    .banner__view {
        overflow: hidden;
    }

    .banner__image {
        display: block;
        width: 100%;
        max-width: 100%;
        margin: 0 auto;
        transform: translateY(-36%);
        margin-bottom: -33.2%;
    }

    .banner__after {
        width: 85%;
        font-size: 40px;
        text-align: center;
        padding: 56px 0;
        color: #1c427a;
        margin: 0 auto;
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
        border-radius: 50%;
        margin: 0 70px 0 0;
    }

    .person .image img {
        width: auto;
        height: auto;
        max-width: 280px;
        max-height: 100%;
        display: block;
        padding-right: 30px;
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
            transform: translateY(-32%);
            margin-bottom: -33.2%;
        }
        .banner__view > svg {
            transform: translateY(-32%);
            margin-bottom: -33.2%;
        }
        #promo-modal-1 {
            top: 46%;
            left: 43%;
            width: 43%;
        }
        #promo-modal-2 {
            top: 46%;
            left: 26%;
            width: 38%;
        }
        #promo-modal-3 {
            top: 48%;
            left: 16%;
            width: 40%;
            padding-left: 0;
            padding-bottom: 3%;
        }
        #promo-modal-4 {
            top: 37%;
            left: 15%;
            width: 42%;
            padding-left: 0;
            padding-right: 3%;
        }
        #promo-modal-5 {
            top: 50%;
            left: 19.5%;
            width: 40%;
            padding-left: 0;
            padding-right: 3%;
        }
        #promo-modal-6 {
            top: 45%;
            left: 3.5%;
            width: 41%;
            padding-left: 0;
            padding-right: 3%;
        }
        #promo-modal-7 {
            top: 55%;
            left: 48%;
            width: 41%;
            padding-left: 0;
            padding-right: 3%;
        }
        #promo-modal-8 {
            top: 53%;
            left: 18%;
            width: 48%;
        }
        #promo-modal-9 {
            top: 52%;
            left: 34%;
            width: 48%;
            padding-left: 0;
            padding-right: 3%;
        }
        #promo-modal-10 {
            top: 47%;
            left: 20.5%;
            width: 48%;
            padding-right: 3%;
            padding-left: 0;
        }
        #promo-modal-11 {
            top: 56%;
            left: 4.5%;
            width: 48%;
            padding-left: 0;
            padding-right: 3%;
        }
    }
    @media (max-width: 1023px) {
        .banner__view > svg,
        .banner__image {
            display: none;
        }
        .banner__view > svg._mobile,
        .banner__image._mobile {
            display: block;
        }
        .banner__title {}
        .banner__description {}
        .banner__mobile-text {
            margin-top: 25%;
            font-size: 16px;
            display: block;
        }
    }
    @media (max-width: 767px) {
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
        .banner__image {
            margin-bottom: -55.2%;
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
        }
        .promo-modal__title {
            font-size: 20px;
            text-align: left;
        }
        .banner__after {
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
    }
</style>
<script>
    var $target = null
    $('#obj-1,#obj-2,#obj-3,#obj-4,#obj-5,#obj-6,#obj-7,#obj-8,#obj-9,#obj-10,#obj-11,#shadow').hover(
        function (e) {
            e.stopPropagation()

            if($target != null && $target.data('id') !== $(this).attr('id')) {
                var idModal = $target.data('id');
                $('#' + idModal).removeClass('visibility')
                $target.css('opacity', '0');
                $('#shadow').css('opacity', '0');
            }
            if($(this).attr('id') !== 'shadow') {
                $target = $(this);
                e.stopPropagation();
                var idModal = $(this).data('id');
                $('#' + idModal).addClass('visibility')
                $(this).css('opacity', '1');
                $('#shadow').css('opacity', '1');
            }
        },
        function (e) {
            e.stopPropagation();
            if($(this).data('id') !== $(e.toElement).attr('id')) {
                var idModal = $target.data('id');
                $('#' + idModal).removeClass('visibility')
                $target.css('opacity', '0');
                $('#shadow').css('opacity', '0');
            }
        }
    );
    $('[data-name="obj-1"],[data-name="obj-2"],[data-name="obj-3"],[data-name="obj-4"],[data-name="obj-5"],[data-name="obj-6"],[data-name="obj-7"],[data-name="obj-8"],[data-name="obj-9"],[data-name="obj-10"],[data-name="obj-11"]').on('click', function (e) {
        e.stopPropagation();
        var idModal = $(this).data('id');
        $('#' + idModal).addClass('visibility')
        $(this).css('opacity', '1');
    })
    $('.promo-modal__close').on('click', function () {
        var idModal = $(this).closest('.promo-modal').attr('id');
        $(this).closest('.promo-modal').removeClass('visibility');
        $('[data-id='+idModal+']').css('opacity', '0');
    })
</script>
<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
