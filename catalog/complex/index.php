<?php
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');

global $APPLICATION;

$APPLICATION->SetPageProperty('title', 'Каталог курсов');
$APPLICATION->SetPageProperty('keywords', 'тренинги,  процессы разработки, управление требованиями, разработка ПО, тестирование ПО, java, архитектура ПО, oracle, BEA, курсы, обучение в области разработки ПО');
$APPLICATION->SetPageProperty('description', 'Курсы программирования от экспертов-практиков в Luxoft Training. Примеры разработки реальных проектов. Обучение программистов, тестировщиков, аналитиков, менеджеров проектов. Повышение квалификации для ИТ-специалистов.');
$APPLICATION->SetTitle('Каталог курсов'); ?>

<?php
$APPLICATION->IncludeComponent(
    'addamant:ibs.catalog',
    '',
    [
        'SEF_FOLDER' => '/catalog/complex/',
        'SEF_MODE' => 'Y',
        'SECTION_IBLOCK_ID' => ['49'],
        'CACHE_TIME' => '36000000',
        'CACHE_TYPE' => 'A'
    ]
);
?>

<?php require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php'); ?>
