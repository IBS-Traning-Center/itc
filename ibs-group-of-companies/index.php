<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Группа компаний IBS");
?>

<div class="text-page-block">
    <div class="main-text-content">
        <h2><?= $APPLICATION->GetTitle() ?></h2>
        <?php $APPLICATION->IncludeFile(SITE_DIR . 'ibs-group-of-companies/table.php', [], ['MODE' => 'html', 'NAME' => 'Группа компаний IBS. Таблица']); ?>
        <?php $APPLICATION->IncludeFile(SITE_DIR . 'ibs-group-of-companies/table_mobile.php', [], ['MODE' => 'html', 'NAME' => 'Группа компаний IBS. Таблица мобильная']); ?>
    </div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>