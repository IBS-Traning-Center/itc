<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>
<?
if (CModule::IncludeModule("learning"))
{
    $res = CCourse::GetList(
        Array("ID"=>"DESC"), 
        Array("ACTIVE" => "Y"), 
        $bIncCnt = true
    );

    while ($arCourse = $res->GetNext())
    {?>
		<?//echo	"<h2>".$arCourse["NAME"]."</h2>"?>
	   <?$APPLICATION->IncludeComponent("bitrix:learning.test.list", "new", Array(
	"COURSE_ID" => $arCourse["ID"],	// Идентификатор курса
	"TEST_DETAIL_TEMPLATE" => "/training/testing/#COURSE_ID#/#TEST_ID#/",	// URL, ведущий на страницу прохождения теста
	"CHECK_PERMISSIONS" => "Y",	// Проверять право доступа
	"TESTS_PER_PAGE" => "20",	// Количество тестов на странице
	"SET_TITLE" => "Y",	// Устанавливать заголовок страницы
	),
	false
);
?>
   <? }
}
?>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>