<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("certificate");
?>
	<?CModule::IncludeModule("learning")?>
		<?$ATTEMTP_ID=3128?>
		<?$res = CTestAttempt::GetByID($ATTEMTP_ID);
			if ($arAttempt = $res->GetNext())
			{
				echo "<pre>";
				$SCORE=$arAttempt["SCORE"]/10;
				$MAX_SCORE=$arAttempt["MAX_SCORE"]/10;
				$USER_ID=$arAttempt["USER_ID"];
			}
		$rsUser = CUser::GetByID($USER_ID);
		$arUser = $rsUser->Fetch();
		//print_r($arUser);
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

				
					
					
				}
			
		}
		//print_r($arThemes);
		
		/*foreach ($arThemes as $k=>$theme) {
			$res1 = CLesson::GetList(
			Array("SORT"=>"ASC"), 
			Array("ACTIVE" => "Y", "LESSON_ID" => $k, "CHECK_PERMISSIONS"=> "N")
			);

			if ($arLesson = $res1->GetNext())
			{
			
				$arThemes[$k]["NAME"]=$arLesson["NAME"];
			}
		}*/
		?>

	<?
	print_r($arUser["NAME"]);
	$html = '
	<style>
	div {
		text-align: center; font-family: Arial;  font-size: 18pt;
	}
	</style>
	<body style="background:url(/test/test-certificate.jpg) no-repat; position: relative;">
		<div style="padding-top: 206px; text-align: center;font-size: 38px; color: #1f497d; font-family: Calibri; font-weight: bold;">Сертификат</div>
		<div style="padding-top: 64px; text-align: center; font-size: 24px; color: #000; font-family: Calibri;">Данный сертификат подтверждает, что '.$arUser["LAST_NAME"].' '.$arUser["NAME"].' прошел(ла) тестирование по направлению «Системный анализ».<br/>  Количество набранных баллов '.$SCORE.' из '.$MAX_SCORE.'. </div>
		<table style="font-size: 24px; color: #000; font-family: Callibri; width: 100%; padding-top: 40px;" cellpadding=0 cellspacing=0>
			<tr>
				<td style="font-weight: bold; font-size: 24px; color: #000; font-family: Calibri; text-align: center; padding: 20px 0;">Темы тестирования</td>
				<td style="font-weight: bold; font-size: 24px; color: #000; font-family: Calibri; text-align: center;  padding: 20px 0; width: 250px">Набранные баллы</td>
			</tr>';?>
			<?$t=0?>
			<?foreach ($arThemes as $key=>$arTheme) {?>
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
				<td style="font-size: 24px; color: #000; font-family: Calibri; text-align: center;  padding: 10px 0;">'.$arTheme["CORRECT"].'/'.$arTheme["ALL"].'</td>
			</tr>';
			}?>
	<?$html .='</table>
			<div style="padding-top: 64px; text-align: center; font-size: 24px; color: #000; font-family: Calibri;">По результатам тестирования присвоена квалификация <br/>«Системный аналитик».</div>
	</body>';
	$mpdf = new \Mpdf\Mpdf([
		'mode' => 'UTF-8',
		'format' => [250, 351],
	]);
	$mpdf->allow_charset_conversion = true;
	$mpdf->charset_in = 'cp1251';
	$mpdf->WriteHTML($html);
	$APPLICATION->RestartBuffer();
	$name="test_".substr(md5("test_".$USER_ID), 0, 8).".pdf";
	$mpdf->Output($_SERVER["DOCUMENT_ROOT"]."/cert/".$name); 
	//LocalRedirect('/cert/'.$name);
	?>
