<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");



if (CModule::IncludeModule("learning"))
{
    $LESSON_ID = 426;

    $res = CLQuestion::GetList(
        Array("TIMESTAMP_X" => "ASC", "SORT"=>"ASC"), 
        Array("COURSE_ID" => 38)
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
<table class="table bordered">
<tr><td>№</td><td>Вопрос/Ответ</td><td>Правильный ответ</td><td>Ответили</td></tr>
<?foreach ($arQuestions as $key=>$arQuest) {?>
	<?$file=array();?>
	<?if (intval($arQuest["FILE_ID"])>0) {?>
		<?$file=CFile::GetFileArray($arQuest["FILE_ID"]);?>
	<?}?>
	<tr><td rowspan="<?=count($arQest["ANSWERS"])+1?>"><?=$key+1?></td><td><b><?=$arQuest["NAME"]?></b>
	<?if (intval($arQuest["FILE_ID"])>0) {?><br/><img src="<?=$file["SRC"]?>" /><?}?>
	</td><td></td><td style="text-align: center;"><b><?=intval($arQuest["CORRECT"])?>/<?=$arQuest["ALL"]?></b></td></tr>
	<?foreach ($arQuest["ANSWERS"] as $key1=>$arAns) {?>
		<tr><td><?=$arAns["ANSWER"]?></td><td style="text-align: center;"><?if ($arAns["CORRECT"]=="Y") {?>Y<?}?></td><td style="text-align: center;"><?=intval($arAns["CHOSEN"])?></td></tr>	
	<?}?>
<?}?>
</table>

