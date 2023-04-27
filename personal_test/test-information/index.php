<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Информация о тесте");
?>


<div class="courses">
	<div class="heading">
		<?if ($_REQUEST["test_param"]!="testing") {?>
			<h2>Статистика по тесту: Системный аналитик</h2>
		<?} else {?>
			<h2>Статистика по тесту: Тестировщик</h2>
		<?}?>
	</div>
<?if (CModule::IncludeModule("learning"))
{
    $LESSON_ID = 426;
	$courseID=38;
	if ($_REQUEST["test_param"]=="testing") {
		$courseID=39;
	}
    $res = CLQuestion::GetList(
        Array("TIMESTAMP_X" => "ASC", "SORT"=>"ASC"), 
        Array("COURSE_ID" => $courseID)
    );

    while ($arQuestion = $res->GetNext())
    {
		
       $arQest=$arQuestion;
	   
	   
	   
	   $res1 = CLAnswer::GetList(
			Array("SORT"=>"DESC"), 
			Array("QUESTION_ID" => $arQest["ID"])
		);
		$arAnswers=array();
		while ($arAnswer = $res1->GetNext())
		{
			$arAnswers[$arAnswer["ID"]]=$arAnswer;
		}
		
		$arQest["ANSWERS"]=$arAnswers;
		
		$res2 = CTestResult::GetList(
        Array("ID" => "ASC"), 
        Array("QUESTION_ID" => $arQest["ID"])
		);

		while ($arQuestionPlan = $res2->GetNext())
		{
			//print_r($arQuestionPlan);
			if (stristr($arQuestionPlan["RESPONSE"], ",")) {
				$arSelected=explode(",", $arQuestionPlan["RESPONSE"]);
				foreach ($arSelected as $value) {
					if (strlen($value)>0) {
						$arQest["ANSWERS"][$value]["CHOSEN"]=intval($arQest["ANSWERS"][$value]["CHOSEN"]+1);
					}
				}
			} else {
				
				if (strlen($arQuestionPlan["RESPONSE"])>0) {
					$arQest["ANSWERS"][$arQuestionPlan["RESPONSE"]]["CHOSEN"]=intval($arQest["ANSWERS"][$arQuestionPlan["RESPONSE"]]["CHOSEN"]+1);
				}
			}
			if ($arQuestionPlan["CORRECT"]=="Y") {
				$arQest["CORRECT"]++;
			}
			$arQest["ALL"]++;
		}
		
		$arQuestions[]=$arQest;
    }


}?>
<?=CTest::GetRandFunction()?>
<div class="white-brd">
<table class="table bordered">
<tr><td>№</td><td>Вопрос/Ответ</td><td>Правильный ответ</td><td>Ответили</td><td>% верных ответов</td></tr>
<?foreach ($arQuestions as $key=>$arQuest) {?>
	<?$file=array();?>
	<?if (intval($arQuest["FILE_ID"])>0) {?>
		<?$file=CFile::GetFileArray($arQuest["FILE_ID"]);?>
	<?}?>
	<?/*echo "<pre>";?>
	<?print_r($arQuest["ANSWERS"]);*/?>
	<tr><td rowspan="<?=count($arQuest["ANSWERS"])+1?>"><?=$key+1?></td><td style="width: 200px !important;"><b><?=$arQuest["NAME"]?></b>
	<?if (intval($arQuest["FILE_ID"])>0) {?><br/><img style="max-width: 460px;" src="<?=$file["SRC"]?>" /><?}?>
	</td><td></td><td style="text-align: center;"><b><?=intval($arQuest["CORRECT"])?> из <?=intval($arQuest["ALL"])?></b></td><td style="text-align: center;"><?=round($arQuest["CORRECT"]/$arQuest["ALL"]*100, "2")?>%</td></tr>
	<?foreach ($arQuest["ANSWERS"] as $key1=>$arAns) {?>
		<tr><td><?=$arAns["ANSWER"]?></td><td style="text-align: center;"><?if ($arAns["CORRECT"]=="Y") {?>Y<?}?></td><td style="text-align: center;"><?=intval($arAns["CHOSEN"])?></td><td></td></tr>	
	<?}?>
<?}?>
</table>
</div>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>