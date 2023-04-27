<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetPageProperty("SHOW_BOTTOM_MAP", "N");
$APPLICATION->SetPageProperty("blue_title", "Корпоративные курсы: аналитики, разработчики, менеджеры проектов, тестировщики");
$APPLICATION->SetPageProperty("title", "Корпоративное обучение");
$APPLICATION->SetPageProperty("keywords", "корпоративное обучение, корпоративный тренинг, обучение программированию, обучение тестированию, обучение проектированию");
$APPLICATION->SetPageProperty("description", "Корпоративное обучение в сфере разработки программного обеспечения. Тренинги, которые учитывают специфику Вашей компании.");
$APPLICATION->SetTitle("Корпоративное обучение: аналитики, разработчики, менеджеры проектов, тестировщики");
?>
<section class="bg-main-wrap"
         style="background: url('/static/images/corp-main-bg.jpg') center; background-size: cover;">

    <div class="frame">
        <div class="breadcrumbs clearfix">
            <a class="breadcrumb-item" href="/">Главная</a> <a class="breadcrumb-item" href="#">Корпоративным
                клиентам</a>
        </div>
        <div class="clearfix heading-white">
            <h1>Корпоративное обучение</h1>
        </div>
        <div class="heading-text">
            Учебный центр на протяжении нескольких лет является лучшим провайдером в номинации "Корпоративное обучение
            информационным технологиям" по версии Всероссийского потребительского рейтинга провайдеров корпоративного
            обучения. Программа курса «затачивается» под вашу команду с учетом потребностей, опыта и квалификации ваших
            сотрудников. Обучение может быть организовано в удобном для вас формате, на вашей территории или в классах
            IBS Training Center.
        </div>
    </div>
</section>
<? if (false) { ?>
    <div class="not-main-page height-inner">
        <div class="scroll-menu-shadow sticky-nav">
            <div class="frame scroll-menu no-top-padding clearfix">
                <? /*
			<ul class="menu-third mobile-hidden">
				<li><a class="scroll" href="#corporate">Корпоративное обучение</a></li>
				<li><a class="scroll" href="#express">Экспресс-аудит</a></li>
				<li><a class="scroll" href="#consalting">Консалтинг</a></li>
				<li><a class="scroll" href="#best">Лучший по профессии</a></li>
			</ul>
			*/ ?>
                <div class="dropdown-flex">
                    <div class="simple-select">
                        <? /*
					<a class="title dropdown-link" href="#">Корпоративное обучение <i class="fa fa-caret-down" aria-hidden="true"></i></a>
					<ul class="dropdown">
						<li><a href="#corporate">Корпоративное обучение</a></li>
						<li><a href="#express">Экспресс - аудит</a></li>
						<li><a href="#consalting">Консалтинг</a></li>
						<li><a href="#best">Лучший по профессии</a></li>
					</ul>
					*/ ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
<? } ?>
<section class="bg not-main-page gray overflow-hidden ">
    <div id="corporate" class="frame course-main-info no-y-padding">
        <div class="row clearfix">
            <div class="medium-2 padding-right bg-corp-1 bg-corp-1__corporate">
                <div class="content-relative">
                    <div class="corporate-heading corporate-heading__corporate">
                        Почему корпоративное обучение
                    </div>
                    <ul class="padding-right-100 corp-icons">
                        <li class="corporate-icons__one"><b>Решение проблем</b> - Если вам нужно решить конкретные
                            задачи, используем в обучении элементы коучинга/консалтинга
                        </li>
                        <li class="corporate-icons__two"><b>Глубокая кастомизация</b> - Предложим тренинг, релевантный
                            отрасли и специфике вашего бизнеса: учтём ваши производственную культуру, технологический
                            стек, реальные кейсы
                        </li>
                        <li class="corporate-icons__three"><b>Сокращение затрат</b> - Составим программу из фрагментов
                            разных тренингов, сократим длительность и стоимость обучения
                        </li>
                        <li class="corporate-icons__four"><b>Оперативность</b> - Если вам нужно “вчера”, разработаем
                            кастомный тренинг в короткие сроки
                        </li>
                    </ul>
                    <? /*
				<p class="padding-right-100">
                    Предложим тренинг, релевантный отрасли и специфике вашего бизнеса
				</p>

				<div class="font-s-22">
					Почему Luxoft Training?
				</div>

				<div class="big-nubmers-cp">
					17
				</div>
				<p class="padding-right-100">
					лет мы занимаемся обучением высококвалифицированных специалистов компании Luxoft. Накоплены огромный опыт преподавания, теоретическая и практическая база.
				</p>
				<div class="big-nubmers-cp">
					200
				</div>
				<p class="padding-right-100">
					курсов в каталоге Luxoft Training. Основная часть&nbsp;тренингов разработана экспертами компании Luxoft. На курсах&nbsp;используется опыт работы в&nbsp;масштабных проектах.
				</p>
				<div class="big-nubmers-cp">
					<i class="fa fa-star-o" aria-hidden="true"></i>
				</div>
				<p class="padding-right-100">
					Обучение и консалтинг в Luxoft Training проводят лучшие эксперты Luxoft в области Software Engineering. Мы знаем, как решать проблемы в проектах.
				</p>
                 */ ?>
                </div>
                <div class="form-reg-corp form-reg-corp__corporate">
                    <div class="font-s-22">
                        Оставить заявку на корпоративное обучение
                    </div>
                    <?php
                    $APPLICATION->IncludeComponent(
                        "luxoft:form.result.new.nospam",
                        "corp",
                        array(
                            "WEB_FORM_ID" => "14",
                            "IGNORE_CUSTOM_TEMPLATE" => "Y",
                            "USE_EXTENDED_ERRORS" => "Y",
                            "SEF_MODE" => "N",
                            "CACHE_TYPE" => "A",
                            "CACHE_TIME" => "3600",
                            "LIST_URL" => "",
                            "EDIT_URL" => "",
                            "SUCCESS_URL" => "",
                            "CHAIN_ITEM_TEXT" => "",
                            "CHAIN_ITEM_LINK" => "",
                            "VARIABLE_ALIASES" => array("WEB_FORM_ID" => "WEB_FORM_ID", "RESULT_ID" => "RESULT_ID",)
                        )
                    ); ?>
                </div>
            </div>
            <div class="medium-2 padding-left corp-text">
                <div class="content-relative">
                    <div class="mb-30">
                        <h3>Когда эффективно корпоративное обучение</h3>
                        <ul>
                            <li>Обучение команды от 5-ти человек.</li>
                            <li>Команда должна «говорить на одном языке».</li>
                            <li>Необходим переход на новую технологию, выход на качественно новый уровень работы
                                команды.
                            </li>
                            <li>Необходимость «выровнять» знания сотрудников до требуемого уровня (минимизируя
                                зависимость от сотрудников, обладающих уникальными знаниями).
                            </li>
                            <li>Быстро и эффективно освоить новую предметную область (пример: набран отдел тестирования
                                – нужно наладить работу отдела).&nbsp;
                            </li>
                        </ul>
                    </div>
                    <? /*
				<div class="mb-30">
					<h3>Преимущества корпоративного тренинга</h3>
					<ul>
						<li>Разрабатывается программа обучения, максимально отвечающая потребностям заказчика. Тренер, кастомизируя обучение, акцентирует внимание на наиболее актуальных для заказчика темах и пропускает те области, которые заказчик в работе не использует. В результате слушатели получают только полезную для работы информацию в сжатые сроки. </li>
						<li>На тренинге могут использоваться примеры из реальных проектов заказчика. </li>
						<li>В отличие от курсов из открытого расписания, корпоративные тренинги не привязывают вас к конкретной дате и месту. Тренеры Luxoft Training могут провести обучение на территории заказчика, в любом городе, в удобное для заказчика время. Корпоративные тренинги дают отличную возможность повысить квалификацию сотрудников практически без отрыва от производства.</li>
						<li>Слушатели тренинга – только команда заказчика, нет посторонних людей, есть возможность обсудить нюансы конкретного проекта.&nbsp;&nbsp; </li>
					</ul>
				</div>
                */ ?>
                    <? /*
				<div class="mb-30">
					<h3>Кому будет полезно обучение</h3>
					<ul>
						<li>Менеджеры проектов. </li>
						<li>Системные и бизнес-аналитики. </li>
						<li>Тест-менеджеры, Тест-дизайнеры, Тестировщики. </li>
						<li>Инженеры по нагрузочному и автоматизированному тестированию. </li>
						<li>Архитекторы, Проектировщики приложений и БД. </li>
						<li>Разработчики (.Net, Java, Web, Oracle). </li>
					</ul>
				</div>
                */ ?>
                    <div class="mb-30">
                        <h3>Схема организации проекта корпоративного обучения</h3>
                        <ul>
                            <li>Определим ваши явные и неявные потребности и «боли».</li>
                            <li>На основании полученной информации и нашего опыта предложим оптимальный план и описание
                                курса, согласуем с Вами.
                            </li>
                            <li>Скомпонуем программу обучения из готовых частей, а чего не хватает, быстро разработаем.
                                Подберем примеры и упражнения из вашей бизнес-области или проектов.
                            </li>
                            <li>Проведем очно на вашей территории или в Учебном центре, либо в онлайн-формате.</li>
                            <li>По результатам обучения можно получить обратную связь от тренера об уровне подготовки
                                участников группы.
                            </li>
                        </ul>
                    </div>

                    <div class="mb-30">
                        <h3>Часто задаваемые вопросы</h3>
                        <p>
                        </p>
                        <div class="quest">
                            <b>Может ли тренер приехать к нам в компанию? </b>
                        </div>
                        Да, мы можем провести тренинг на вашей территории в любом городе России и ближнего зарубежья в
                        удобное для вас время.
                        <p>
                        </p>
                        <p>
                        </p>
                        <div class="quest">
                            <b>Можно ли разработать учебную программу индивидуально для нашей компании?</b>
                        </div>
                        В рамках корпоративного формата программа курса разрабатывается специально под потребности
                        Заказчика. Таким образом, акцент делается на темах, наиболее актуальных для заказчика и
                        пропускаются те области, которые Заказчик не использует.
                        <p>
                        </p>
                        <p>
                        </p>
                        <div class="quest">
                            <b>Сколько человек может быть в группе? </b>
                        </div>
                        Все зависит от курса – по каждому курсу размер группы определяется индивидуально. Как правило,
                        размер группы – до 15 человек.
                        <p>
                        </p>
                        <p>
                        </p>
                        <div class="quest">
                            <b>Мы никогда не работали с этим тренером. Можно ли предварительно увидеть, как он проводит
                                тренинги?</b>
                        </div>
                        Да, такая возможность есть. Во-первых, мы даем возможность пообщаться с тренером (по телефону
                        или онлайн), обсудить программу, задать вопросы по обучению. Во-вторых, есть возможность прийти
                        на занятие из открытого расписания и оценить работу тренера. Этот курс будет платным, но по
                        стоимости существенно ниже, чем обучение в корпоративном формате. В-третьих, мы можем
                        предоставить видеозапись тренинга или конференции с выступлением данного преподавателя.
                        <p>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <a style="display: block;margin-top: 90px" href="/files/programma_subsidirovaniya_2022.pdf" target="_blank">
            <img src="/images/banner_corp.jpg" style="display: block;max-width: 100%; margin: 0 auto">
        </a>
        <div class="success-stories-wrapper success-stories-wrapper__corporate">
            <div class="success-story-header">
                Истории успеха
            </div>
            <?
            $GLOBALS["arrFilter"] = array("ACTIVE" => "Y");
            ?> <? $APPLICATION->IncludeComponent(
                "bitrix:news.list",
                "clients.list",
                array(
                    "IBLOCK_TYPE" => "edu",
                    "IBLOCK_ID" => "82",
                    "NEWS_COUNT" => "40",
                    "SORT_BY1" => "SORT",
                    "SORT_ORDER1" => "ASC",
                    "SORT_BY2" => "SORT",
                    "SORT_ORDER2" => "ASC",
                    "FILTER_NAME" => "arrFilter",
                    "FIELD_CODE" => array(0 => "", 1 => "",),
                    "PROPERTY_CODE" => array(0 => "SHORT_DESC", 1 => "",),
                    "CHECK_DATES" => "Y",
                    "DETAIL_URL" => "/about/clients/corp_detail.html?ID=#ELEMENT_ID#",
                    "AJAX_MODE" => "N",
                    "AJAX_OPTION_SHADOW" => "Y",
                    "AJAX_OPTION_JUMP" => "N",
                    "AJAX_OPTION_STYLE" => "Y",
                    "AJAX_OPTION_HISTORY" => "N",
                    "CACHE_TYPE" => "A",
                    "CACHE_TIME" => "3600",
                    "CACHE_FILTER" => "N",
                    "CACHE_GROUPS" => "N",
                    "PREVIEW_TRUNCATE_LEN" => "",
                    "ACTIVE_DATE_FORMAT" => "d.m.Y",
                    "SET_TITLE" => "N",
                    "SET_STATUS_404" => "N",
                    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                    "ADD_SECTIONS_CHAIN" => "N",
                    "HIDE_LINK_WHEN_NO_DETAIL" => "Y",
                    "PARENT_SECTION" => "",
                    "PARENT_SECTION_CODE" => "",
                    "DISPLAY_TOP_PAGER" => "N",
                    "DISPLAY_BOTTOM_PAGER" => "N",
                    "PAGER_TITLE" => "Клиенты",
                    "PAGER_SHOW_ALWAYS" => "N",
                    "PAGER_TEMPLATE" => "",
                    "PAGER_DESC_NUMBERING" => "N",
                    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                    "PAGER_SHOW_ALL" => "N",
                    "DISPLAY_DATE" => "N",
                    "DISPLAY_NAME" => "Y",
                    "DISPLAY_PICTURE" => "Y",
                    "DISPLAY_PREVIEW_TEXT" => "Y",
                    "AJAX_OPTION_ADDITIONAL" => ""
                )
            ); ?>
        </div>
</section>
<? if (!empty($_GET['RESULT_ID'])) { ?>
    <script>
        window.onload = function () {
            window.targetEvents.orderCorp();
        }
    </script><? } ?>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
