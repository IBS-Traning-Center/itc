<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="courses">
	<div class="heading">
		<h2>Результаты тестирования</h2>
	</div>
	<ul class="list">
		<li>
		<div class="test-name head"><h3><?=GetMessage("LEARNING_PROFILE_TEST")?></h3></div>
<?php
/*
temporary commented due to http://jabber.bx/view.php?id=30693
		<th><?=GetMessage("LEARNING_PROFILE_LAST_SCORE")?></th>
		<th><?=GetMessage("LEARNING_PROFILE_LAST_RESULT")?></th>
*/
?>
		<div class="best-score head"><h3><?=GetMessage("LEARNING_PROFILE_BEST_SCORE")?></h3></div>
		<div class="learn-result head"><h3><?=GetMessage("LEARNING_PROFILE_RESULT")?></h3></div>
		<div class="attempts head"><h3><?=GetMessage("LEARNING_PROFILE_ATTEMPTS")?></h3></div>
		<div class="action head"><h3><?=GetMessage("LEARNING_PROFILE_ACTION")?></h3></div>
	</li>

<?if (!empty($arResult["RECORDS"])):?>

<?php
$strQuickInfoPrefix = $strQuickInfoPrefix = '';
foreach($arResult["RECORDS"] as $arGradebook):
	if (($arGradebook['APPROVED'] === 'N') && ($arGradebook["COMPLETED"]!="Y"))
	{
		$strQuickInfoPrefix = ' <span href="javascript:void(0);" 
			style="text-decoration:none; border-bottom:1px dashed blue;"
			title="' 
			. GetMessage('LEARNING_TEST_CHECKED_MANUALLY_SO_NOT_ALL_RESULTS_CAN_BE_ACTUAL') 
			. '">';

		$strQuickInfoPostfix = '</span>';
	}
	?>
	<?//if ($USER->IsAdmin()) {?>
		
		<?
		//print_r($arGradebook["COMPLETED"]." ".$arGradebook["TEST_ID"]);
		if (($arGradebook["TEST_ID"]=="33" || $arGradebook["TEST_ID"]=="32") && $arGradebook["COMPLETED"]=="Y") {?>
		
		<?
		
		if (CModule::IncludeModule("learning"))
		{
			$res = CTestAttempt::GetList(
				Array("ID" => "DESC"), 
				Array("TEST_ID" => $arGradebook["TEST_ID"], "COMPLETED"=> "Y", "STUDENT_ID"=> $arGradebook["STUDENT_ID"])
			);

			if ($arAttempt = $res->GetNext())
			{
				if (file_exists($_SERVER["DOCUMENT_ROOT"]."/cert/test_".substr(md5("test_".$arGradebook["STUDENT_ID"]." ".$arAttempt["ID"]), 0, 8).".pdf")) {
					$arCert[]=array("FILE"=>"/cert/test_".substr(md5("test_".$arGradebook["STUDENT_ID"]." ".$arAttempt["ID"]), 0, 8).".pdf", "NAME"=> $arGradebook["TEST_NAME"]);
				} else {
					$file=CreateTestCert($arAttempt["ID"]);
					if (strlen($file)>0) {
						$arCert[]=array("FILE"=> $file, "NAME"=> $arGradebook["TEST_NAME"]);
					}
				}
			}
		}
		//print_r($arCert);
		?>
	
		<?}?>
	<?//}?>
	<li>
		<div class="test-name"><h3><?=$arGradebook["TEST_NAME"]?></h3></div>
<?php
/*
temporary commented due to http://jabber.bx/view.php?id=30693
		<td><?php echo $strQuickInfoPrefix . $arResult['LAST_TEST_INFO'][$arGradebook['TEST_ID']]['LAST_SCORE'] . $strQuickInfoPostfix; ?></td>
		<td><?php
			if ($arResult['LAST_TEST_INFO'][$arGradebook['TEST_ID']]['LAST_COMPLETED'] === 'Y')
				echo GetMessage("LEARNING_PROFILE_YES");
			else
				echo $strQuickInfoPrefix . GetMessage("LEARNING_PROFILE_NO") . $strQuickInfoPostfix;
			?></td>
*/
?>
		<div class="best-score"><?=$arGradebook["RESULT"]/10?><?=(intval($arGradebook["MAX_RESULT"]) > 0 ? " / ".intval($arGradebook["MAX_RESULT"]/10) : "")?></div>
		<div class="learn-result"><?php
			if ($arGradebook["COMPLETED"]=="Y")
				echo GetMessage("LEARNING_PROFILE_YES");
			else
				echo $strQuickInfoPrefix . GetMessage("LEARNING_PROFILE_NO") . $strQuickInfoPostfix;

			?> <?php if ($arGradebook["MARK"]):?>(<?php echo GetMessage("LEARNING_PROFILE_MARK")?>: <?php echo $arGradebook["MARK"]?>)<?php endif?></div>
		<div class="attempts">
			<a title="<?=GetMessage("LEARNING_PROFILE_TEST_DETAIL")?>" href="<?=$arGradebook["ATTEMPT_DETAIL_URL"]?>"><?=$arGradebook["ATTEMPTS"]?></a>
			<?if ($arGradebook["ATTEMPT_LIMIT"]>0):?>
				&nbsp;/&nbsp;<?=$arGradebook["ATTEMPT_LIMIT"]?>
			<?endif?>
		</div>
		<div class="action"><a href="<?=$arGradebook["TEST_DETAIL_URL"]?>"><?=GetMessage("LEARNING_PROFILE_TRY")?></a></div>
	</li>
<?endforeach?>

<?else:?>
	<li>
		<div>-&nbsp;<?=GetMessage("LEARNING_PROFILE_NO_DATA")?>&nbsp;-</div>
	</li>
<?endif?>
</ul>


<?if (!empty($arResult["ATTEMPTS"])):?>

<br /><b><?=GetMessage("LEARNING_ATTEMPTS_TITLE")?></b><br /><br />

<ul class="list">
	<li <?if ($arResult["RECORDS"][0]["TEST_ID"]=="28" || $arResult["RECORDS"][0]["TEST_ID"]=="29" || $arResult["RECORDS"][0]["TEST_ID"]=="34" || $arResult["RECORDS"][0]["TEST_ID"]=="30" || $arResult["RECORDS"][0]["TEST_ID"]=="31" || $arResult["RECORDS"][0]["TEST_ID"]=="32" || $arResult["RECORDS"][0]["TEST_ID"]=="33" || $arResult["RECORDS"][0]["TEST_ID"]=="39") {?>class="babok"<?}?>>
		<div class="head date-test"><h3><?=GetMessage("LEARNING_PROFILE_DATE_END")?></h3></div>
		<div class="head time-test"><h3><?=GetMessage("LEARNING_PROFILE_TIME_DURATION")?></h3></div>
		<div class="head quest-test"><h3><?=GetMessage("LEARNING_PROFILE_QUESTIONS")?></h3></div>
		<div class="head best-score"><h3><?=GetMessage("LEARNING_PROFILE_SCORE")?></h3></div>
		<div class="head learn-result"><h3><?=GetMessage("LEARNING_PROFILE_RESULT")?></h3></div>
		<?if ($arResult["RECORDS"][0]["TEST_ID"]=="28" || $arResult["RECORDS"][0]["TEST_ID"]=="29" || $arResult["RECORDS"][0]["TEST_ID"]=="34" || $arResult["RECORDS"][0]["TEST_ID"]=="30" || $arResult["RECORDS"][0]["TEST_ID"]=="31" || $arResult["RECORDS"][0]["TEST_ID"]=="32" || $arResult["RECORDS"][0]["TEST_ID"]=="33"|| $arResult["RECORDS"][0]["TEST_ID"]=="39") {?><div class="head more-result"></div><?}?>
	</li>

<?foreach ($arResult["ATTEMPTS"] as $key=>$arAttempt):?>
	<?if ($arResult["RECORDS"][0]["TEST_ID"]=="28" || $arResult["RECORDS"][0]["TEST_ID"]=="29" || $arResult["RECORDS"][0]["TEST_ID"]=="30" || $arResult["RECORDS"][0]["TEST_ID"]=="31" || $arResult["RECORDS"][0]["TEST_ID"]=="34" || $arResult["RECORDS"][0]["TEST_ID"]=="39") {?>

		<?//$ATTEMPT_ID = 590;
		$res = CTestResult::GetList(
			Array("ID" => "ASC"), 
			Array("ATTEMPT_ID" => 	$arAttempt["ID"])
		);
		
		$arQuestions=array();
		while ($arQuestionPlan = $res->GetNext())
		{
			
			$QUESTION_ID = $arQuestionPlan["QUESTION_ID"];
			$res1 = CLQuestion::GetList(
				Array("NAME" => "ASC", "SORT"=>"ASC"), 
				Array("ID"=>$QUESTION_ID, "CHECK_PERMISSIONS"=> "N"),
				false,
				array(),
				Array("UF_*")
				);
				if ($arQuestion = $res1->GetNext())
				{
					/*if ($USER->IsAdmin()) {
						print_r($arQuestion);
					}*/
					$arAnswers[0]["COMMENT"]=$arQuestion["UF_1_W_O_C"];
					$arAnswers[1]["COMMENT"]=$arQuestion["UF_2_W_O_C"];
					$arAnswers[2]["COMMENT"]=$arQuestion["UF_3_W_O_C"];
					$arAnswers[3]["COMMENT"]=$arQuestion["UF_4_W_O_C"];
				}
			$res2 = CLAnswer::GetList(
				Array("SORT"=>"ASC"), 
				Array("QUESTION_ID" => $QUESTION_ID)
			);
			$k=0;
			while ($arAnswer = $res2->GetNext())
			{	
				$arQuestionInfo=array();
				
				if (stristr($arQuestionPlan["RESPONSE"], ',')) {
					
					
				
					$exploded=explode(',', $arQuestionPlan["RESPONSE"]);
					
					if (in_array($arAnswer["ID"], $exploded)) {
						
						$arQuestions[$arQuestionPlan["QUESTION_ID"]+100]["QUESTION"]=$arQuestionPlan["QUESTION_NAME"];
						$arQuestions[$arQuestionPlan["QUESTION_ID"]+100]["COMMENT"]=$arAnswers[$k]["COMMENT"];
						$arQuestions[$arQuestionPlan["QUESTION_ID"]+100]["CORRECT"]=$arQuestionPlan["CORRECT"];
						$arQuestions[$arQuestionPlan["QUESTION_ID"]+100]["ANSWER"].=$arAnswer["ANSWER"]." <br/><br/>";
						
						
					}
				}
				$arQuestionInfo=array();
				if ($arAnswer["ID"]==$arQuestionPlan["RESPONSE"]) {
					$arQuestionInfo["QUESTION"]=$arQuestionPlan["QUESTION_NAME"];
					$arQuestionInfo["ANSWER"]=$arAnswer["ANSWER"];
					$arQuestionInfo["COMMENT"]=$arAnswers[$k]["COMMENT"];
					$arQuestionInfo["CORRECT"]=$arQuestionPlan["CORRECT"];
					$arQuestions[$arQuestionPlan["QUESTION_ID"]]=$arQuestionInfo;
				}
				
				$k++;
			}
			
		}
		$arQuestions;
		/*echo "<pre>";
		print_r($arQuestions);
		echo "</pre>";*/
	?>
	<?}?>
	<?if ($arResult["RECORDS"][0]["TEST_ID"]=="32" || $arResult["RECORDS"][0]["TEST_ID"]=="33" || $arResult["RECORDS"][0]["TEST_ID"]=="39" || $arResult["RECORDS"][0]["TEST_ID"]=="40") {?>
		
		<?
		
		$res = CTestResult::GetList(
        Array("ID" => "ASC"), 
        Array("ATTEMPT_ID" => $arAttempt["ID"], "CHECK_PERMISSIONS"=> "N")
		);
		$arThemes=array();
		$t=0;
		while ($arQuestionPlan = $res->GetNext())
		{
			
		   $res1 = CLQuestion::GetByID($arQuestionPlan["QUESTION_ID"]);

				if ($arQuestion = $res1->GetNext())
				{
					
					
					if ($arResult["RECORDS"][0]["TEST_ID"]=="40") {
						 $res4=CLearnLesson::GetByID($arQuestion["LESSON_ID"]);
					} else {
						$res4=CLearnLesson::GetListOfImmediateParents($arQuestion["LESSON_ID"], array(), array("CHECK_PERMISSIONS"=> "N"));
					}
					while ($arLesson1 = $res4->GetNext())
					{
							/*if ($_REQUEST["debug"]=="Y") {
								echo "<pre>";
								print_r($arLesson1);
								echo "</pre>";
							}*/
							/*if ($USER->IsAdmin()) {
							echo "<pre>";
							print_r($arQuestion["LESSON_ID"]);
							print_r($arLesson1);
							}*/
							$arNewLesson="";
							if ($arLesson1["LESSON_ID"]!="158") {
								$arNewLesson=$arLesson1["LESSON_ID"];
							}
							
							if (intval($arNewLesson)>0) {
									$arNew=$arNewLesson;
							}
					}
					
					if ($arResult["RECORDS"][0]["TEST_ID"]=="33" || $arResult["RECORDS"][0]["TEST_ID"]=="39" || $arResult["RECORDS"][0]["TEST_ID"]=="40") {
						
						$arQuestion["LESSON_ID"]=$arNew;
					
					}
					
					$t=intval($arThemes[$arQuestion["LESSON_ID"]]["CORRECT"]);
					
					if ($arQuestionPlan["CORRECT"]=="Y") {
						//echo $t;
						$arThemes[$arQuestion["LESSON_ID"]]["CORRECT"]=$t+1;
						
					}
					$arThemes[$arQuestion["LESSON_ID"]]["ALL"]=$arThemes[$arQuestion["LESSON_ID"]]["ALL"]+1;
					
					
					
				}
			
		}
		
		foreach ($arThemes as $k=>$theme) {
			$res1 = CLesson::GetList(
			Array("SORT"=>"ASC"), 
			Array("ACTIVE" => "Y", "LESSON_ID" => $k, "CHECK_PERMISSIONS"=> "N")
			);

			if ($arLesson = $res1->GetNext())
			{
			
				$arThemes[$k]["NAME"]=$arLesson["NAME"];
			}
		}
		?>
	<?}?>
	<li <?if ($arResult["RECORDS"][0]["TEST_ID"]=="28" || $arResult["RECORDS"][0]["TEST_ID"]=="29"  || $arResult["RECORDS"][0]["TEST_ID"]=="34" || $arResult["RECORDS"][0]["TEST_ID"]=="30" || $arResult["RECORDS"][0]["TEST_ID"]=="31" || $arResult["RECORDS"][0]["TEST_ID"]=="32" || $arResult["RECORDS"][0]["TEST_ID"]=="33" || $arResult["RECORDS"][0]["TEST_ID"]=="39" || $arResult["RECORDS"][0]["TEST_ID"]=="40") {?>class="babok"<?}?>>
		<?if (strlen($arAttempt["DATE_END"])>0):?>
		<div class="date-test"><?=$arAttempt["DATE_END"]?></div>
		<div class="time-test"><?=CCourse::TimeToStr((MakeTimeStamp($arAttempt["DATE_END"]) - MakeTimeStamp($arAttempt["DATE_START"])));?></div>
		<?else:?>
		<div class="date-test"><?=$arAttempt["DATE_START"]?></div>
		<div class="time-test"><?=GetMessage("LEARNING_ATTEMPT_NOT_FINISHED")?></div>
		<?endif?>
		<div class="quest-test"><?=$arAttempt["QUESTIONS"]?></div>
		<div class='best-score'><?=$arAttempt["SCORE"]/10?><?=(intval($arAttempt["MAX_SCORE"]) > 0 ? " / ".intval($arAttempt["MAX_SCORE"]/10) : "")?></div>
		<div class="learn-result"><?=$arAttempt["COMPLETED"]=="Y"?GetMessage("LEARNING_PROFILE_YES"):GetMessage("LEARNING_PROFILE_NO")?></div>
	
		<?if ($arResult["RECORDS"][0]["TEST_ID"]=="28" || $arResult["RECORDS"][0]["TEST_ID"]=="29" || $arResult["RECORDS"][0]["TEST_ID"]=="34" || $arResult["RECORDS"][0]["TEST_ID"]=="30" || $arResult["RECORDS"][0]["TEST_ID"]=="31" || $arResult["RECORDS"][0]["TEST_ID"]==32 || $arResult["RECORDS"][0]["TEST_ID"]=="39" || $arResult["RECORDS"][0]["TEST_ID"]=="40") {?><div class="head more-result"><a <?if ($key=="0") {?>class="open"<?}?> href="#"><?if ($key=="0") {?>Скрыть<?} else {?>Подробнее<?}?></a></div><?}?>
			
			<?if ($arResult["RECORDS"][0]["TEST_ID"]=="28" || $arResult["RECORDS"][0]["TEST_ID"]=="29" || $arResult["RECORDS"][0]["TEST_ID"]=="30" || $arResult["RECORDS"][0]["TEST_ID"]=="31" || $arResult["RECORDS"][0]["TEST_ID"]=="34") {?>
			<ul <?if ($key==0) {?>style="display: block;"<?}?> class="innher-hidden">	
			<li>
				<div class="test-name"><h3>Вопрос</h3></div>
				<div  class="time-test "><h3>Ваш ответ</h3></div>
				<div class="time-test"><h3>Комментарий к ответу</h3></div>
			</li>
			<?foreach ($arQuestions as $question) {?>
			<li>
				<div class="test-name"><h3><?=$question["QUESTION"]?></h3></div>
				<div <?if ($question["CORRECT"]=="Y") {?>style="color: green"<?} else {?>style="color: red"<?}?> class="time-test "><?=$question["ANSWER"]?></div>
				<div <?if ($question["CORRECT"]=="Y") {?>style="color: green"<?} else {?>style="color: red"<?}?>  class="time-test"><?=$question["COMMENT"]?></div>
			</li>
			
			<?}?>
			</ul>
			
		<?}?>
		<?if ($arResult["RECORDS"][0]["TEST_ID"]=="32" || $arResult["RECORDS"][0]["TEST_ID"]=="33" || $arResult["RECORDS"][0]["TEST_ID"]=="39" || $arResult["RECORDS"][0]["TEST_ID"]=="40") {?>

					<ul <?if ($key=="0") {?>style="display: block;"<?}?> class="innher-hidden">
						<li>
							<div style="width: 50%; float: left;" class="test-name head"><h3 style="color: #444">Разбираемые темы</h3></div>
							<div style="width: 25%; float: left; text-align: center;" class="quest-test head"><h3 style="color: #444">Количество правильных ответов</h3></div>
							<div style="width: 25%; float: left; text-align: center;" class="quest-test head"><h3 style="color: #444">Всего вопросов</h3></div>
						</li>
					<?foreach ($arThemes as $theme) {?>
						
							
							<li>
								<div style="width: 50%; float: left;" class="test-name"><h3 style="color: #444"><?=$theme["NAME"]?></h3></div>
								<div style="width: 25%; float: left; text-align: center;" class="quest-test head"><?=intval($theme["CORRECT"])?></div>
								<div style="width: 25%; float: left; text-align: center;" class="quest-test head"><?=intval($theme["ALL"])?></div>
							</li>
						
					<?}?>
					
					</ul>

			<?}?>
	</li>
	
<?endforeach?>

</ul>
<script>
	$(document).ready(function(){
		$('.head.more-result a').click(function() {
			
			if ($(this).hasClass('open')) {
				$(this).parent().parent().find('.innher-hidden').slideUp("fast");
				$(this).removeClass('open');
				$(this).text("Подробнее");
			} else {
				$(this).parent().parent().find('.innher-hidden').slideDown();
				$(this).addClass('open');
				$(this).text("Скрыть");
			}
			return false;
		});
	});
</script>
<br />
<a href="<?=$arResult["CURRENT_PAGE"]?>"><?=GetMessage("LEARNING_BACK_TO_GRADEBOOK")?></a>
<?endif;?>
<?if (count($arCert)!=0) {?>
<br/>
<div class="certificates">
	<h2>Сертификаты</h2>
	<ul class="cert-list">
	<?foreach($arCert as $cert):?>
		
		<li>
			<a target="_blank" href="<?=$cert["FILE"]?>">
				<img src="/images/cert-preview-new.jpg" alt="" width="150"><?=$cert["TEST_NAME"]?>
			</a>
		</li>

	<?endforeach;?>
	</ul>
</div>
<?} else {?>
	<br/><br/><h3>Для просмотра именного сертификата, проверьте, пожалуйста, что у вас заполнены поля "Имя" и "Фамилия" в профиле.</h3>
<?}?>
</div>


<?function CreateTestCert($ATTEMTP_ID)  {?>
	<?CModule::IncludeModule("learning")?>
		<?//$ATTEMTP_ID=3490?>
		<?$res = CTestAttempt::GetByID($ATTEMTP_ID);
			if ($arAttempt = $res->GetNext())
			{
				//echo "<pre>";
				$SCORE=$arAttempt["SCORE"]/10;
				$MAX_SCORE=$arAttempt["MAX_SCORE"]/10;
				$USER_ID=$arAttempt["USER_ID"];
				$TEST_NAME=$arAttempt["TEST_NAME"];
				$TEST_ID=$arAttempt["TEST_ID"];
				//print_r($arAttempt);
			}
		$rsUser = CUser::GetByID($USER_ID);
		$arUser = $rsUser->Fetch();
		//print_r($arUser);
		if (strlen($arUser["LAST_NAME"])>0 && strlen($arUser["NAME"])>0) {
		?>
		<?$res = CTestResult::GetList(
        Array("ID" => "ASC"), 
        Array("ATTEMPT_ID" => $ATTEMTP_ID, "CHECK_PERMISSIONS"=> "N")
		);
		$arThemes=array();
		$t=0;
		while ($arQuestionPlan = $res->GetNext())
		{
		 
			

		   $res1 = CLQuestion::GetByID($arQuestionPlan["QUESTION_ID"]);

				if ($arQuestion = $res1->GetNext())
				{
					if ($TEST_ID=="32") {
						if ($arQuestion["LESSON_ID"]=="149" || $arQuestion["LESSON_ID"]=="156") {
							$METHOD_CODE="METHOD";
						} elseif ($arQuestion["LESSON_ID"]=="150" || $arQuestion["LESSON_ID"]=="151") {
							$METHOD_CODE="MODEL";
						} elseif ($arQuestion["LESSON_ID"]==153) {
							$METHOD_CODE="TZ";
						} elseif ($arQuestion["LESSON_ID"]==154 || $arQuestion["LESSON_ID"]==155 ||  $arQuestion["LESSON_ID"]==157 || $arQuestion["LESSON_ID"]==152) {
							$METHOD_CODE="REQS";
						} 
						$t=intval($arThemes[$METHOD_CODE]["CORRECT"]);
						if ($arQuestionPlan["CORRECT"]=="Y") {
							//echo $t;
							$arThemes[$METHOD_CODE]["CORRECT"]=$t+1;
							
						}
						
						$arThemes[$METHOD_CODE]["ALL"]=$arThemes[$METHOD_CODE]["ALL"]+1;
					} else {
						//print_r($arQuestion["LESSON_ID"]);
						$res4=CLearnLesson::GetListOfImmediateParents($arQuestion["LESSON_ID"]);
						while ($arLesson1 = $res4->GetNext())
						{
							
								echo "<pre>";
								/*print_r($arQuestion["LESSON_ID"]);
								print_r($arLesson1);*/
								$arNewLesson="";
								if ($arLesson1["LESSON_ID"]!="158") {
									$arNewLesson=$arLesson1["LESSON_ID"];
									
								}
								if (intval($arNewLesson)>0) {
									$arNew=$arNewLesson;
								}
								
						}
						
						//print_r($arNew);
						if ($TEST_ID=="33") {
							$arQuestion["LESSON_ID"]=$arNew;
						}
						//print_r($arNewLesson);
						$t=intval($arThemes[$arQuestion["LESSON_ID"]]["CORRECT"]);
						
						if ($arQuestionPlan["CORRECT"]=="Y") {
							//echo $t;
							$arThemes[$arQuestion["LESSON_ID"]]["CORRECT"]=$t+1;
							
						}
						$arThemes[$arQuestion["LESSON_ID"]]["ALL"]=$arThemes[$arQuestion["LESSON_ID"]]["ALL"]+1;
						}
					
					
					
				}
			
		}
		//print_r($arThemes);
		foreach ($arThemes as $k=>$theme) {
			$res1 = CLesson::GetList(
			Array("SORT"=>"ASC"), 
			Array("ACTIVE" => "Y", "LESSON_ID" => $k, "CHECK_PERMISSIONS"=> "N")
			);

			if ($arLesson = $res1->GetNext())
			{
			
				$arThemes[$k]["NAME"]=$arLesson["NAME"];
			}
		}
		
		?>

		<?
		//print_r($arUser["NAME"]);
		$html = '
		<style>
		div {
			text-align: center; font-family: Arial;  font-size: 18pt;
		}
		</style>
		<body style="background:url(/test/test-certificate.jpg) no-repat; position: relative;">
			<div style="padding-top: 206px; text-align: center;font-size: 38px; color: #1f497d; font-family: Calibri; font-weight: bold;">Сертификат</div>
			<div style="padding-top: 64px; text-align: center; font-size: 24px; color: #000; font-family: Calibri;">Данный сертификат подтверждает, что '.$arUser["LAST_NAME"].' '.$arUser["NAME"].' прошел(ла) тестирование по направлению «'.$TEST_NAME.'».<br/>  Количество набранных баллов '.$SCORE.' из '.$MAX_SCORE.'. </div>
			<table style="font-size: 24px; color: #000; font-family: Callibri; width: 100%; padding-top: 40px;" cellpadding=0 cellspacing=0>
				<tr>
					<td style="font-weight: bold; font-size: 24px; color: #000; font-family: Calibri; text-align: center; padding: 20px 0;">Темы тестирования</td>
					<td style="font-weight: bold; font-size: 24px; color: #000; font-family: Calibri; text-align: center;  padding: 20px 0; width: 250px">Набранные баллы</td>
				</tr>';?>
				<?$t=0?>
				
				<?foreach ($arThemes as $key=>$arTheme) {?>
				<?if ($TEST_ID=="32") {?>
					<?$t++?>
					<?if ($key=="MODEL") {?>
						<?$NAME='Моделирование ПО'?>
					<?} elseif ($key=="TZ") {?>
						<?$NAME='Стандарты оформления технических заданий'?>
					<?} elseif ($key=="REQS") {?>
						<?$NAME='Требования к системе: сбор, анализ и документирование'?>
					<?} elseif ($key=="METHOD") {?>
						<?$NAME='Методы сбора информации'?>
					<?}?>
					<?$html .='<tr>
						<td style="font-size: 24px; color: #000; font-family: Calibri;  padding: 10px 0;">'.$t.'. '.$NAME.'</td>
						<td style="font-size: 24px; color: #000; font-family: Calibri; text-align: center;  padding: 10px 0;">'.intval($arTheme["CORRECT"]).'/'.$arTheme["ALL"].'</td>
					</tr>';?>

				<?} else {?>
					<?$t++?>
					<?$html .='<tr>
						<td style="font-size: 24px; color: #000; font-family: Calibri;  padding: 10px 0;">'.$t.'. '.$arTheme["NAME"].'</td>
						<td style="font-size: 24px; color: #000; font-family: Calibri; text-align: center;  padding: 10px 0;">'.intval($arTheme["CORRECT"]).'/'.$arTheme["ALL"].'</td>
					</tr>';
				}?>
				<?}?>
		<?$html .='</table>
				
		</body>';
        $mpdf = new \Mpdf\Mpdf([
            'mode' => 'UTF-8',
            'format' => [250, 351],
        ]);
		$mpdf->allow_charset_conversion = true;
		$mpdf->charset_in = 'cp1251';
		$mpdf->WriteHTML($html);
		$name="test_".substr(md5("test_".$USER_ID." ".$ATTEMTP_ID), 0, 8).".pdf";
		$mpdf->Output($_SERVER["DOCUMENT_ROOT"]."/cert/".$name); 
		return ('/cert/'.$name);
		} else {
			return "";
		}
	}
	?>