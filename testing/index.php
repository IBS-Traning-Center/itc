<?php

use Bitrix\Main\Page\Asset;

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

global $APPLICATION;

Asset::getInstance()->addCss(SITE_DIR . 'local/assets/css/testing/testing.css');

$APPLICATION->SetPageProperty('BANNER_TITLE', 'Разработка тестов для IT-специалистов по ключевым компетенциям');
$APPLICATION->SetPageProperty('BACKGROUND_COLOR_BANNER', '#F8F7F7');
$APPLICATION->SetTitle('Тестирование сотрудников IT-подразделения');
?>

<div class="top-page-banner" style="background-color: <?= $APPLICATION->GetPageProperty('BACKGROUND_COLOR_BANNER') ?>">
    <div class="container">
        <div class="banner-content">
            <?php $APPLICATION->IncludeComponent(
                'bitrix:breadcrumb',
                'bread',
                [
                    'START_FROM' => '0',
                    'PATH' => '',
                    'SITE_ID' => 's1',
                ],
                false
            ); ?>
            <h1><?= $APPLICATION->GetPageProperty('BANNER_TITLE') ?></h1>
            <p class="f-32"><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/testing/heading_text.php', [], ['MODE' => 'html', 'NAME' => 'Текст под заголовком']); ?></p>
        </div>
        <div class="buttons-block-banner">
            <a class="btn-main size-l" data-scroll="mainFeedbackFormBlock">
                <span class="f-24">Получить консультацию</span>
            </a>
        </div>
    </div>
</div>

<div class="testing-content">
    <div class="container">
        <div class="testing-flex testing-content-block">
            <h2><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/testing/h2_text.php', [], ['MODE' => 'html', 'NAME' => 'h2 текст']); ?></h2>
            <div>
                <p class="f-20 margin-bottom24"><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/testing/description_1.php', [], ['MODE' => 'html', 'NAME' => 'Описание 1']); ?></p>
                <p class="f-20"><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/testing/description_2.php', [], ['MODE' => 'html', 'NAME' => 'Описание 2']); ?></p>
            </div>
        </div>
        <div class="need-test-block">
            <div class="text-content">
                <h2><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/testing/h2_test.php', [], ['MODE' => 'html', 'NAME' => 'Заголовок когда нужна оценка']); ?></h2>
                <div class="ul-content">
                    <?php $APPLICATION->IncludeFile(SITE_DIR . 'include/testing/ul_test.php', [], ['MODE' => 'html', 'NAME' => 'Таблица когда нужна оценка']); ?>
                </div>
            </div>
            <div class="image-block">
                <img src="<?= SITE_DIR ?>images/testing/need_test.png" alt="">
            </div>
        </div>
    </div>
    <div class="blue-back">
        <div class="container">
            <div class="testing-flex testing-content-block">
                <h2><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/testing/h2_blue_text.php', [], ['MODE' => 'html', 'NAME' => 'h2 текст']); ?></h2>
                <div>
                    <p class="f-32 margin-bottom32">
                        <svg width="72" height="72" viewBox="0 0 72 72" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect opacity="0.1" width="72" height="72" fill="#0827C4" />
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M44.002 6H19.5938C15.7167 6 12.5625 9.15422 12.5625 13.0312V58.9688C12.5625 62.8458 15.7167 66 19.5938 66H52.4062C56.2833 66 59.4375 62.8458 59.4375 58.9688V21.4355L44.002 6ZM45.375 14.002L51.4355 20.0625H47.7188C46.4264 20.0625 45.375 19.0111 45.375 17.7188V14.002ZM52.4062 61.3125H19.5938C18.3014 61.3125 17.25 60.2611 17.25 58.9688V13.0312C17.25 11.7389 18.3014 10.6875 19.5938 10.6875H40.6875V17.7188C40.6875 21.5958 43.8417 24.75 47.7188 24.75H54.75V58.9688C54.75 60.2611 53.6986 61.3125 52.4062 61.3125ZM50.0625 33.6562V38.3438H40.6875V33.6562H50.0625ZM50.0625 52.4062V47.7188H40.6875V52.4062H50.0625ZM31.999 43.7177L28.9688 46.7479L25.9386 43.7177L22.624 47.0322L25.6543 50.0625L22.624 53.0927L25.9386 56.4072L28.9688 53.377L31.999 56.4072L35.3136 53.0927L32.2833 50.0625L35.3136 47.0322L31.999 43.7177ZM25.9386 29.6552L28.9688 32.6854L36.6865 24.9677L40.0011 28.2822L28.9688 39.3145L22.624 32.9697L25.9386 29.6552Z" fill="white" />
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M55.0568 21.5625H47.7188C45.598 21.5625 43.875 19.8395 43.875 17.7188V10.3807L55.0568 21.5625ZM42.1875 9.1875V17.7188C42.1875 20.7674 44.6701 23.25 47.7188 23.25H56.25V58.9688C56.25 61.0895 54.527 62.8125 52.4062 62.8125H19.5938C17.473 62.8125 15.75 61.0895 15.75 58.9688V13.0312C15.75 10.9105 17.473 9.1875 19.5938 9.1875H42.1875ZM28.9688 48.8693L25.9386 45.839L24.7453 47.0322L27.7756 50.0625L24.7453 53.0927L25.9386 54.2859L28.9688 51.2557L31.999 54.2859L33.1922 53.0927L30.162 50.0625L33.1922 47.0322L31.999 45.839L28.9688 48.8693ZM31.999 43.7177L35.3136 47.0322L32.2833 50.0625L35.3136 53.0927L31.999 56.4072L28.9688 53.377L25.9386 56.4072L22.624 53.0927L25.6543 50.0625L22.624 47.0322L25.9386 43.7177L28.9688 46.7479L31.999 43.7177ZM28.9688 34.8068L25.9386 31.7765L24.7453 32.9697L28.9688 37.1932L37.8797 28.2822L36.6865 27.089L28.9688 34.8068ZM36.6865 24.9677L40.0011 28.2822L28.9688 39.3145L22.624 32.9697L25.9386 29.6552L28.9688 32.6854L36.6865 24.9677ZM43.3807 7.5H19.5938C16.5451 7.5 14.0625 9.98265 14.0625 13.0312V58.9688C14.0625 62.0174 16.5451 64.5 19.5938 64.5H52.4062C55.4549 64.5 57.9375 62.0174 57.9375 58.9688V22.0568L43.3807 7.5ZM44.002 6H19.5938C15.7167 6 12.5625 9.15422 12.5625 13.0312V58.9688C12.5625 62.8458 15.7167 66 19.5938 66H52.4062C56.2833 66 59.4375 62.8458 59.4375 58.9688V21.4355L44.002 6ZM45.375 14.002V17.7188C45.375 19.0111 46.4264 20.0625 47.7188 20.0625H51.4355L45.375 14.002ZM19.5938 10.6875C18.3014 10.6875 17.25 11.7389 17.25 13.0312V58.9688C17.25 60.2611 18.3014 61.3125 19.5938 61.3125H52.4062C53.6986 61.3125 54.75 60.2611 54.75 58.9688V24.75H47.7188C43.8417 24.75 40.6875 21.5958 40.6875 17.7188V10.6875H19.5938ZM50.0625 33.6562V38.3438H40.6875V33.6562H50.0625ZM42.1875 35.1562V36.8438H48.5625V35.1562H42.1875ZM48.5625 50.9062V49.2188H42.1875V50.9062H48.5625ZM50.0625 52.4062H40.6875V47.7188H50.0625V52.4062Z" fill="#0827C4" />
                        </svg>
                        <span><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/testing/expert_1.php', [], ['MODE' => 'html', 'NAME' => 'Экспертиза 1']); ?></span>
                    </p>
                    <p class="f-32 margin-bottom32">
                        <svg width="72" height="72" viewBox="0 0 72 72" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect opacity="0.1" width="72" height="72" fill="#0827C4" />
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M38.3435 6H33.6558V15.3755H38.3435V6ZM49.3991 26.7453L51.0339 28.38L66.0014 28.3799V56.5065H48.1847L40.7474 63.9437C39.3766 65.3146 37.576 66 35.7753 66C33.9746 66 32.1739 65.3146 30.8031 63.9437L23.3659 56.5065H5.99805V28.3799H18.6755L23.7493 23.6921L42.0097 23.6844C44.801 23.6844 47.4254 24.7715 49.3991 26.7453ZM37.4327 60.6291L47.377 50.6849C48.2932 49.7688 48.2929 48.2861 47.377 47.37L40.6304 40.6235L37.3415 43.9124C32.761 48.493 25.3431 48.4878 20.7678 43.9124L19.1104 42.2551L32.9856 28.38H25.5834L20.5096 33.0678H10.6858V51.8188H25.3075L34.1178 60.6291C35.0317 61.5429 36.5188 61.543 37.4327 60.6291ZM52.1776 51.8188H61.3137V33.0677H49.0921L46.0843 30.06C44.9959 28.9716 43.5488 28.3722 42.0096 28.3722C40.4704 28.3722 39.0232 28.9716 37.9349 30.06L26.0214 41.9735C28.5826 43.1997 31.8234 42.801 34.0267 40.5977L40.6303 33.9941L50.6917 44.0554C52.8226 46.1864 53.2696 49.2939 52.1776 51.8188ZM12.7949 16.1133L16.1092 12.7991L22.7376 19.4275L19.4233 22.7418L12.7949 16.1133ZM55.8813 12.8033L49.2529 19.4317L52.5672 22.746L59.1956 16.1175L55.8813 12.8033Z" fill="white" />
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M50.4126 29.88L48.3385 27.8059C46.6461 26.1136 44.4036 25.1846 42.0103 25.1844C42.0101 25.1844 42.0106 25.1844 42.0103 25.1844L24.3365 25.1919L19.2624 29.8799H7.49805V55.0065H23.9872L31.8638 62.8831C32.9411 63.9604 34.3549 64.5 35.7753 64.5C37.1958 64.5 38.6094 63.9604 39.6867 62.8831L47.5633 55.0065H64.5014V29.8799L50.4126 29.88ZM66.0014 28.3799V56.5065H48.1847L40.7474 63.9437C39.3766 65.3146 37.576 66 35.7753 66C33.9746 66 32.1739 65.3146 30.8031 63.9437L23.3659 56.5065H5.99805V28.3799H18.6755L23.7493 23.6921L42.0097 23.6844C44.801 23.6844 47.4254 24.7715 49.3991 26.7453L51.0339 28.38L66.0014 28.3799ZM48.4377 46.3094C49.9392 47.8111 49.9398 50.2434 48.4376 51.7455C48.4376 51.7455 48.4376 51.7455 48.4376 51.7455L38.4933 61.6898C36.9936 63.1896 34.5568 63.1892 33.0573 61.6899L24.6862 53.3188H9.18581V31.5678H19.9227L24.9965 26.88H36.607L21.2318 42.2551L21.8285 42.8518L20.7678 43.9124L19.1104 42.2551L32.9856 28.38H25.5834L20.5096 33.0678H10.6858V51.8188H25.3075L34.1178 60.6291C35.0317 61.5429 36.5188 61.543 37.4327 60.6291L47.377 50.6849C48.2932 49.7688 48.2929 48.2861 47.377 47.37L40.6304 40.6235L37.3415 43.9124C32.761 48.493 25.3431 48.4878 20.7678 43.9124L21.8285 42.8518C25.8183 46.8418 32.2865 46.8461 36.2808 42.8518L40.6304 38.5022L48.4377 46.3094ZM62.8137 53.3188H49.8946L50.8008 51.2234C51.6609 49.2348 51.3056 46.7906 49.631 45.1161L40.6303 36.1154L35.0873 41.6584C32.412 44.3337 28.4799 44.8135 25.3737 43.3264L23.4622 42.4113L36.8742 28.9993C38.2439 27.6297 40.0725 26.8722 42.0096 26.8722C43.9467 26.8722 45.7753 27.6297 47.145 28.9993L49.7134 31.5677H62.8137V53.3188ZM49.0921 33.0677L46.0843 30.06C44.9959 28.9716 43.5488 28.3722 42.0096 28.3722C40.4704 28.3722 39.0232 28.9716 37.9349 30.06L26.0214 41.9735C26.5279 42.216 27.0609 42.3949 27.6073 42.5089C29.8238 42.9714 32.2591 42.3653 34.0267 40.5977L40.6303 33.9941L50.6917 44.0554C52.4155 45.7793 53.0374 48.1422 52.6339 50.3188C52.5386 50.8329 52.3862 51.3365 52.1776 51.8188H61.3137V33.0677H49.0921ZM36.8435 7.5H35.1558V13.8755H36.8435V7.5ZM12.7949 16.1133L16.1092 12.7991L22.7376 19.4275L19.4233 22.7418L12.7949 16.1133ZM14.9162 16.1133L19.4233 20.6204L20.6163 19.4275L16.1092 14.9204L14.9162 16.1133ZM49.2529 19.4317L55.8813 12.8033L59.1956 16.1175L52.5672 22.746L49.2529 19.4317ZM52.5672 20.6246L57.0743 16.1175L55.8813 14.9246L51.3743 19.4317L52.5672 20.6246ZM38.3435 6V15.3755H33.6558V6H38.3435Z" fill="#0827C4" />
                        </svg>
                        <span><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/testing/expert_2.php', [], ['MODE' => 'html', 'NAME' => 'Экспертиза 2']); ?></span>
                    </p>
                    <p class="f-32 margin-bottom56">
                        <svg width="72" height="72" viewBox="0 0 72 72" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect opacity="0.1" width="72" height="72" fill="#0827C4" />
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M39.9391 53.8193H32.0596V61.6989H39.9391V53.8193ZM30.5596 52.3193V63.1989H41.4391V52.3193H30.5596Z" fill="white" />
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M18.1803 18.1808H53.8189V32.0604H32.0599V39.9399H51.6976L61.6985 29.939V20.3021L51.6976 10.3013H20.3016L10.3008 20.3021V29.0604H18.1803V18.1808ZM19.6803 30.5604H8.80078V19.6808L19.6803 8.80127H52.3189L63.1985 19.6808V30.5604L52.3189 41.4399H30.5599V30.5604H52.3189V19.6808H19.6803V30.5604Z" fill="white" />
                        </svg>
                        <span><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/testing/expert_3.php', [], ['MODE' => 'html', 'NAME' => 'Экспертиза 3']); ?></span>
                    </p>
                    <div class="grid-2-testing">
                        <div>
                            <h2><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/testing/count_people.php', [], ['MODE' => 'html', 'NAME' => 'Количество сотрудников']); ?></h2>
                            <p class="f-20"><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/testing/count_people_text.php', [], ['MODE' => 'html', 'NAME' => 'Количество сотрудников текст']); ?></p>
                        </div>
                        <div>
                            <h2><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/testing/count_test.php', [], ['MODE' => 'html', 'NAME' => 'Количество тестов']); ?></h2>
                            <p class="f-20"><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/testing/count_test_text.php', [], ['MODE' => 'html', 'NAME' => 'Количество тестов текст']); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container testing-content-block">
        <h2 class="margin-bottom56"><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/testing/schema_heading.php', [], ['MODE' => 'html', 'NAME' => 'Заголовок схема процесса']); ?></h2>
        <?php $APPLICATION->IncludeComponent(
            'addamant:testing.scheme',
            '.default',
            [
                'CACHE_TIME' => '36000000',
                'CACHE_TYPE' => 'A',
            ]
        ); ?>
    </div>
    <div class="container testing-content-block testing-flex process-block">
        <div>
            <h2 class="margin-bottom56"><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/testing/process_heading.php', [], ['MODE' => 'html', 'NAME' => 'Заголовок процесс разработки']); ?></h2>
            <div class="grid-2-testing margin-bottom56">
                <div>
                    <h2><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/testing/process_spec.php', [], ['MODE' => 'html', 'NAME' => 'Количество протестированных специалистов']); ?></h2>
                    <p class="f-20"><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/testing/process_spec_text.php', [], ['MODE' => 'html', 'NAME' => 'Количество протестированных специалистов текст']); ?></p>
                </div>
                <div>
                    <h2><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/testing/process_experts.php', [], ['MODE' => 'html', 'NAME' => 'Количество экспертов']); ?></h2>
                    <p class="f-20"><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/testing/process_experts_text.php', [], ['MODE' => 'html', 'NAME' => 'Количество экспертов текст']); ?></p>
                </div>
            </div>
            <a class="btn-main size-l" data-scroll="mainFeedbackFormBlock">
                <span class="f-24">Получить консультацию</span>
            </a>
        </div>
        <?php $APPLICATION->IncludeComponent(
            'addamant:testing.video',
            '.default',
            [
                'CACHE_TIME' => '36000000',
                'CACHE_TYPE' => 'A',
            ]
        ); ?>
    </div>
    <div class="testing-content-block roles-container">
        <div class="container">
            <h2 class="margin-bottom24"><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/testing/roles_heading.php', [], ['MODE' => 'html', 'NAME' => 'Роли заголовок']); ?></h2>
            <p class="f-32 margin48"><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/testing/roles_text.php', [], ['MODE' => 'html', 'NAME' => 'Роли текст']); ?></p>
            <?php $APPLICATION->IncludeComponent(
                'addamant:testing.roles',
                '.default',
                [
                    'CACHE_TIME' => '36000000',
                    'CACHE_TYPE' => 'A',
                ]
            ); ?>
        </div>
    </div>
    <div class="testing-content-block container telegram">
        <?php $APPLICATION->IncludeComponent(
            "addamant:telegram.subscribe",
            ".default",
            array(
                "CACHE_TIME" => "3600",
                "CACHE_TYPE" => "A",
                "SUBSCRIBE_TITLE" => "",
                "SUBSCRIBE_LINK" => "https://t.me/IBS_Training_Center",
                "COMPONENT_TEMPLATE" => ".default"
            ),
            false
        ); ?>
    </div>
</div>

<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>