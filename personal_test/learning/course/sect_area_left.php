<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?> 
<?$APPLICATION->IncludeComponent("bitrix:learning.course.tree", "no-tree", array(
	"COURSE_ID" => $_REQUEST["COURSE_ID"],
	"COURSE_DETAIL_TEMPLATE" => "/personal_test/learning/course/?COURSE_ID=#COURSE_ID#",
	"CHAPTER_DETAIL_TEMPLATE" => "chapter.php?CHAPTER_ID=#CHAPTER_ID#",
	"LESSON_DETAIL_TEMPLATE" => "/personal_test/learning/course/lesson/?LESSON_ID=#LESSON_ID#&COURSE_ID=#COURSE_ID#",
	"SELF_TEST_TEMPLATE" => "self.php?LESSON_ID=#LESSON_ID#",
	"TESTS_LIST_TEMPLATE" => "/personal_test/learning/course/test/?COURSE_ID=#COURSE_ID#",
	"TEST_DETAIL_TEMPLATE" => "/personal_test/learning/course/test.php?COURSE_ID=#COURSE_ID#&TEST_ID=#TEST_ID",
	"CHECK_PERMISSIONS" => "Y",
	"SET_TITLE" => "Y"
	),
	false
);?>