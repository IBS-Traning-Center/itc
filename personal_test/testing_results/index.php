<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>
<?$APPLICATION->IncludeComponent("bitrix:learning.student.gradebook", "gradebook", array(
	"TEST_DETAIL_TEMPLATE" => "/training/testing/?COURSE_ID=#COURSE_ID#&TEST_ID=#TEST_ID#",
	"COURSE_DETAIL_TEMPLATE" => "/training/testing/?COURSE_ID=#COURSE_ID#&INDEX=Y",
	"TEST_ID_VARIABLE" => "TEST_ID",
	"SET_TITLE" => "Y"
	),
	false
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>