<?php
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');

global $APPLICATION;

$APPLICATION->SetPageProperty('title', 'Каталог курсов');
$APPLICATION->SetPageProperty('keywords', 'тренинги,  процессы разработки, управление требованиями, разработка ПО, тестирование ПО, java, архитектура ПО, oracle, BEA, курсы, обучение в области разработки ПО');
$APPLICATION->SetPageProperty('description', 'Курсы программирования от экспертов-практиков в Luxoft Training. Примеры разработки реальных проектов. Обучение программистов, тестировщиков, аналитиков, менеджеров проектов. Повышение квалификации для ИТ-специалистов.');
$APPLICATION->SetTitle('Каталог курсов'); ?>

<?php $APPLICATION->IncludeComponent(
    'addamant:courses.sections.list',
    '.default',
    Array(
        'ADDITIONAL_COUNT_ELEMENTS_FILTER' => 'additionalCountFilter',
        'ADD_SECTIONS_CHAIN' => 'Y',
        'CACHE_FILTER' => 'N',
        'CACHE_GROUPS' => 'Y',
        'CACHE_TIME' => '36000000',
        'CACHE_TYPE' => 'A',
        'COUNT_ELEMENTS' => 'Y',
        'COUNT_ELEMENTS_FILTER' => 'CNT_ACTIVE',
        'FILTER_NAME' => 'sectionsFilter',
        'HIDE_SECTIONS_WITH_ZERO_COUNT_ELEMENTS' => 'N',
        'IBLOCK_ID' => ['94', '49'],
        'IBLOCK_TYPE' => '',
        'SECTION_CODE' => '',
        'SECTION_FIELDS' => [],
        'SECTION_ID' => '',
        'SECTION_URL' => '',
        'SECTION_USER_FIELDS' => [],
        'SHOW_PARENT_NAME' => 'Y',
        'TOP_DEPTH' => '2',
        'VIEW_MODE' => 'LINE'
    )
); ?>

<?php require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php'); ?>
