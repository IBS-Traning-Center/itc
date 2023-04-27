<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("");

?>
<?$arOLD=GetFullInfoAboutCourse(62615);?>
<?print_r($arOLD);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>