<?GLOBAL $arCourseInfoID?>
<?if (strlen($arCourseInfoID["SECTION_INFO"]["NAME"])>0) {?>
	<?//print_r($arCourseInfoID);?>
	<?$seo="Luxoft Training предлагает Вам пройти обучение по курсу «".$arCourseInfoID["TIMETABLE_INFO"][0]["COURSE_NAME"]."». Другие курсы по теме «".$arCourseInfoID["SECTION_INFO"]["NAME"]."» Вы можете найти в нашем <a href='/training/katalog_kursov/'>каталоге курсов</a>."?>
<?}?>
<?if (strlen($seo)>0) {?>
	<div class="seo-wrap"><?=$seo?></div>
<?}?>
<?
//$APPLICATION->AddChainItem("Открытое обучение", "/training/");
$APPLICATION->AddChainItem("Каталог курсов", "/training/katalog_kursov/");
if (strlen($arCourseInfoID["SECTION_INFO"]["NAME"])>0) {
	$APPLICATION->AddChainItem($arCourseInfoID["SECTION_INFO"]["NAME"], "/training/katalog_kursov/".$arCourseInfoID["SECTION_INFO"]["CODE"]."/");
}
$APPLICATION->AddChainItem($arCourseInfoID["TIMETABLE_INFO"][0]["COURSE_NAME"], "");
?>