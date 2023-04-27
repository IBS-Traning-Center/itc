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
	"GRADEBOOK_TEMPLATE" => "../gradebook.php?TEST_ID=#TEST_ID#",	// URL, ??? ????????????????
	"PAGE_NUMBER_VARIABLE" => "PAGE",	// ????????
	"PAGE_WINDOW" => "10",	// ???????? ????? ????
	"SHOW_TIME_LIMIT" => "N",	// Ю???????????????
	"SET_TITLE" => "Y",	// ?????????????
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
	}
	//print_r($arThemes);
	 
}
?>

<div class="courses">
<div class="heading">
		<h2>Результаты прохождения теста "Системный аналитик"</h2>
</div>
 <ul class="list">
	<li>
				<div style="width: 406px; float: left;" class="test-name head"><h3 style="color: #444">Разбираемые темы</h3></div>
				<div style="width: 150px; float: left; text-align: center;" class="quest-test head"><h3 style="color: #444">Количество правильных ответов</h3></div>
				<div style="width: 150px; float: left; text-align: center;" class="quest-test head"><h3 style="color: #444">Всего вопросов</h3></div>
	</li>
	<?foreach ($arThemes as $theme) {?>
		
			<li>
				<div style="width: 406px; float: left;" class="test-name"><h3 style="color: #444"><?=$theme["NAME"]?></h3></div>
				<div style="width: 150px; float: left; text-align: center;" class="quest-test head"><?=$theme["CORRECT"]?></div>
				<div style="width: 150px; float: left; text-align: center;" class="quest-test head"><?=$theme["ALL"]?></div>
			</li>
		
	<?}?>
	</ul>
	</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>