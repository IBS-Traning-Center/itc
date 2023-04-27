<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("");
?>
<?fn_subscribers();?>
<?function fn_subscribers() {?>
	<?if(CModule::IncludeModule("subscribe")){ 
		$subscr = CSubscription::GetList(
		array("ID"=>"ASC"),
		array("RUBRIC"=>array(31), "CONFIRMED"=>"Y", "ACTIVE"=>"Y")
		);
		while(($subscr_arr = $subscr->Fetch()))
			$aEmail[] = $subscr_arr["EMAIL"];
	}?>
	<?echo "<pre>";?>
	<?$sctringEmail=implode(" | ", $aEmail)?>
	<?//print_r($sctringEmail);?>
	<?//foreach ($aEmail as $mail) {?>
		<?$arFilter = array(
			'EMAIL' => $sctringEmail,
		);
		$dbUsers = CUser::GetList($by = 'ID', $order = 'ASC', $arFilter);
		while ($arUser = $dbUsers->Fetch()) 
		{
			//print_r($arUser["NAME"]);
			if (strlen($arUser["NAME"])>2) {
				$NAME=$arUser["LAST_NAME"]." ".$arUser["NAME"];
			} else {
				$NAME=$arUser["LOGIN"];
			}
			$arUsers[]=array("EMAIL"=>$arUser["EMAIL"], "ID"=>$arUser["ID"], "NAME"=> $NAME);
			
		}
		?>
	<?//}?>
	<?//print_r($arUsers)?>
	<?$t=0;?>
	<?foreach ($arUsers as $key=>$arOneUser) {
		$arSelect=array("IBLOCK_ID", "NAME", "ID", "PROPERTY_CITY", "PROPERTY_COURSE", "PROPERTY_CATEGORY");
		$arFilter = Array("IBLOCK_ID"=>107,  "PROPERTY_USER"=> $arOneUser["ID"], "ACTIVE"=>"Y");
		$pes = CIBlockElement::GetList(Array("NAME"=>"ASC"), $arFilter, false, false, $arSelect);
		$arLinked=array();
		$arRecommend=array();
		
		if ($ob = $pes->GetNextElement()) {
			$arFields=$ob->GetFields();
			$arProps=$ob->GetProperties();
			$arRecommend["city"]=$arProps["CITY"]["VALUE"];
			if (intval($arProps["CITY"]["VALUE"][0])>0 && (intval($arProps["CATEGORY"]["VALUE"][0])>0 || intval($arFields["PROPERTY_COURSE_VALUE"])>0)) {
				$arRecommend["category"]=$arProps["CATEGORY"]["VALUE"];
				if (intval($arFields["PROPERTY_COURSE_VALUE"])>0) {
					$res = CIBlockElement::GetProperty(6, $arFields["PROPERTY_COURSE_VALUE"], "sort", "asc", array("CODE" => "ID_LINKED_COURSES"));
					while ($ob = $res->GetNext())
					{
						$arLinked[] = $ob['VALUE'];
					}
				}
				$arLinked=array_diff($arLinked, array("", 0));
				$arSelect=array("NAME", "ID", "PROPERTY_PP_COURSE");
				$arFilter = Array("IBLOCK_ID"=>94, "SECTION_ID"=> $arRecommend["category"]);
				$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
				while ($arFields=$res->GetNext()) {
					$arLinked[]=$arFields["PROPERTY_PP_COURSE_VALUE"];
				}
				$arRecCourse="";
				$arRecommend["city"]=array_diff($arRecommend["city"],array('', 0));
				//print_r(date("m.d.Y", strtotime('-1 month')));
				if (count($arLinked)>0 && intval($arLinked[0])>0) {
					//echo "<pre>";
						//print_r("City: ".$arRecommend["city"][0]);
						//print_r("Cat: ".$arRecommend["category"][0]);
						//print_r("Course: ".$arFields["PROPERTY_COURSE_VALUE"]);
					//echo "</pre>";
					$arSelect=array("NAME", "ID", "PROPERTY_schedule_course.XML_ID");
					$arFilter = Array("IBLOCK_ID"=>9, array(">PROPERTY_startdate"=>date("Y-m-d"), ">DATE_CREATE"=>date("d.m.Y", strtotime('-30 day')), "PROPERTY_CITY"=>$arRecommend["city"], "ACTIVE"=>"Y", "PROPERTY_schedule_course"=> $arLinked));
					//print_r($arFilter);
					$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>15), $arSelect);
					if ($res->SelectedRowsCount()>0) {
					while ($arFields=$res->GetNext()) {
							//print_r($arFields);
							$arRecCourse.="- <a href='http://ibs-training.ru/kurs/".$arFields["PROPERTY_SCHEDULE_COURSE_XML_ID"].".html?utm_source=newsletter&utm_medium=email&utm_campaign=recomend' >".$arFields["NAME"].'</a><br/>';
						}
						//echo "<pre>";
						$arSend["FIO"]=$arOneUser["NAME"];
						$arSend["RECCOMEND"]=$arRecCourse;
						$arSend["EMAIL"]=$arOneUser["EMAIL"];
						$t++;
						echo $t;
						print_r($arSend);
						//CEvent::Send("RECOMMENDATION_LETTER", 'ru', $arSend);
					}
				}
			}
		}
			//echo $t;
			if ($t>300) {
				die;
			}
		}
		?>
<?}?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>