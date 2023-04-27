<?
include($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$APPLICATION->SetPageProperty("DONT_SHOW_H1", "Y");
$APPLICATION->SetTitle("Title");
include($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_after.php");
/*?>
<div class="shadow-wrap">
<?$APPLICATION->IncludeComponent("luxoft:learning.test", "", Array(
	"COURSE_ID" => "2",	
	"TEST_ID" => "3",	
	"GRADEBOOK_TEMPLATE" => "../gradebook.php?TEST_ID=#TEST_ID#",	// URL, ведущий на страницу с результатами тестирования
	"PAGE_NUMBER_VARIABLE" => "PAGE",	// Идентификатор вопроса
	"PAGE_WINDOW" => "10",	// Количество вопросов в навигационной цепочке
	"SHOW_TIME_LIMIT" => "N",	// Показывать счетчик ограничения времени
	"SET_TITLE" => "Y",	// Устанавливать заголовок страницы
	),
	false
);?>
</div>
*/?>
<?
if (CModule::IncludeModule("learning"))
{
    $ATTEMPT_ID = 590;
    $res = CTestResult::GetList(
        Array("ID" => "ASC"), 
        Array("ATTEMPT_ID" => 	2149)
    );
	echo "<pre>";
    while ($arQuestionPlan = $res->GetNext())
    {
	  
	   $res1 = CLQuestion::GetByID($arQuestionPlan["QUESTION_ID"]);

			if ($arQuestion = $res1->GetNext())
			{
				$t=intval($arThemes[$arQuestion["LESSON_ID"]]["CORRECT"]);
				
				if ($arQuestionPlan["CORRECT"]=="Y") {
					$arThemes[$arQuestion["LESSON_ID"]]["CORRECT"]=$t+1;
				}
				$arThemes[$arQuestion["LESSON_ID"]]["ALL"]=$arThemes[$arQuestion["LESSON_ID"]]["ALL"]+1;
			}
			
	  
    }
	foreach ($arThemes as $key=>$theme) {
		$res1 = CLesson::GetList(
        Array("SORT"=>"ASC"), 
        Array("ACTIVE" => "Y", "LESSON_ID" => $key)
		);

		if ($arLesson = $res1->GetNext())
		{
		
			$arThemes[$key]["NAME"]=$arLesson["NAME"];
		}
	}?>
	<div class="courses">
	 <ul class="list">
	<?foreach ($arThemes as $theme) {?>
		
			<li>
				<div class="test-name"><?=$theme["NAME"]?></div>
			</li>
		
	<?}?>
	</ul>
	</div>
<?}

?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>