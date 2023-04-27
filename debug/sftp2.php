<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Title");
?><?
include($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$ftp_server='ftp.luxoft.csod.com';
$ftp_user_name="luxoft";
$ftp_user_pass="KmUny6gB";
include('Net/SFTP.php');
$sftp = new Net_SFTP($ftp_server);
if (!$sftp->login($ftp_user_name, $ftp_user_pass)) {
    exit('Login Failed');
} else {
	echo "<pre>";
	$sftp->chdir('/Reports/Custom_reports/');
	print_r($List = $sftp->rawlist());
	echo "</pre>";
	foreach ($List as $Item => $Attributes) {
		//print_r($Attributes["filename"]);
		if (preg_match("#ToBitrix_48067_".date('m')."_".date('d')."_".date('Y')."(.*)#", $Attributes["filename"])) {
			$filename=$Attributes["filename"];
		}
	}
	$file=$sftp->get('/Reports/Custom_reports/'.$filename);
	file_put_contents("sftp.txt", $file);
	//$file = file_get_contents("sftp.txt");
	$array=explode(PHP_EOL, $file);
	$t=0;
	foreach ($array as $strItem) {
		$arItem=explode("\t", $strItem);
 		if ($arItem["11"]!="Completed") {
			if ($lastCode!=$arItem[9]) {
				if (strlen($arItem[14])>0) {
					$city=$arItem[14];
					$dates=array($arItem[6], $arItem[7]);
					if ($arItem[14]=="Virtual" && stristr($arItem[19], "English")) {
						$city="Virtual_EN";

					}
					//$arResultArray[$arItem[14]]=array();
					if (!is_array($arResultArray[$city][$arItem[9]])) {
						$arResultArray[$city][$arItem[9]]=$arItem;
					}
					$arResultArray[$city][$arItem[9]]["DATES"][]=$dates;
					$arResultArray[$city][$arItem[9]]["DURATION"]=$arResultArray[$city][$arItem[9]]["DURATION"]+($arItem[16]-intval($arItem[21]));
				} else {
					$dates=array($arItem[6], $arItem[7]);
					//$arResultArray[$arItem[15]]=array();
					$city=$arItem[15];
					if ($arItem[15]=="Virtual" && stristr($arItem[19], "English")) {
						$city="Virtual_EN";
					}
					if (!is_array($arResultArray[$city][$arItem[9]])) {
						$arResultArray[$city][$arItem[9]]=$arItem;
					}
					
					$arResultArray[$city][$arItem[9]]["DATES"][]=$dates;
					$arResultArray[$city][$arItem[9]]["DURATION"]=$arResultArray[$city][$arItem[9]]["DURATION"]+($arItem[16]-intval($arItem[21]));
				}
				$lastCode=$arItem[9];
			} else {
				if (strlen($arItem[14])>0) {
					$city=$arItem[14];
					$dates=array($arItem[6], $arItem[7]);
					//$arResultArray[$arItem[14]]=array();
					print_r($arItem[14]);
					if ($arItem[14]=="Virtual") {
						echo stristr($arItem[19], "English");
						
					}
					if ($arItem[14]=="Virtual" && stristr($arItem[19], "English")) {
						$city="Virtual_EN";

					}
					if (!is_array($arResultArray[$city][$arItem[9]])) {
						$arResultArray[$city][$arItem[9]]=$arItem;
					}
					$arResultArray[$city][$arItem[9]]["DATES"][]=$dates;
					$arResultArray[$city][$arItem[9]]["DURATION"]=$arResultArray[$city][$arItem[9]]["DURATION"]+($arItem[16]-intval($arItem[21]));
				} else {
					$dates=array($arItem[6], $arItem[7]);
					//$arResultArray[$arItem[15]]=array();
					$city=$arItem[15];
					
					if ($arItem[15]=="Virtual") {
						echo stristr($arItem[19], "English");
					}
					if ($arItem[15]=="Virtual" && stristr($arItem[19], "English")) {
						$city="Virtual_EN";
					}
					if (!is_array($arResultArray[$city][$arItem[9]])) {
						$arResultArray[$city][$arItem[9]]=$arItem;
					}
					$arResultArray[$city][$arItem[9]]["DATES"][]=$dates;
					$arResultArray[$city][$arItem[9]]["DURATION"]=$arResultArray[$city][$arItem[9]]["DURATION"]+($arItem[16]-intval($arItem[21]));
				}
			}
			
		}
		$t++;
	}
	echo "<h2>Print arResultArray</h2>";
	echo "<pre>";
	print_r($arResultArray);
	CModule::IncludeModule("iblock");
	foreach ($arResultArray as $city=>$arSchedule)
	{
		if ($city=="Omsk" || $city=="St.-Petersburg" || $city=="Moscow" || $city=="Kiev" || $city=="Odessa" || $city=="Dnepropetrovsk" || $city=="Virtual")
		{
			foreach ($arSchedule as $code=>$arCourse)
			{
				$arCourse["DATES_NORMAL"]=checkCommonDates($arCourse["DATES"]);
				$arSelect = Array("ID", "NAME");
				$arFilter = Array("IBLOCK_ID"=> 6, "PROPERTY_31"=>trim($arCourse[0]));
				$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
				if ($ob = $res->GetNextElement())
				{
					$arFields = $ob->GetFields();
					$arCourse["NAME"]=$arFields["NAME"];
					$arPROP=array();
					$arPROP["course_code"]=$arCourse[0];
					$arPROP["schedule_course"]=$arFields["ID"];
					if ($city=="Moscow") {
						$arPROP["city"]=5741;
					} elseif ($city=="Omsk") {
						$arPROP["city"]=5742;
					} elseif ($city=="St.-Petersburg") {
						$arPROP["city"]=5744;
					} elseif ($city=="Kiev") {
						$arPROP["city"]=5745;
					} elseif ($city=="Odessa") {
						$arPROP["city"]=5746;
					} elseif ($city=="Dnepropetrovsk") {
						$arPROP["city"]=5747;
					}  elseif ($city=="Virtual") {
						$arPROP["city"]=14909;
					}
					if ($arCourse[10]=="CommercialDepartmentRequest" || $arCourse[10]=="PTC_COM Corp" || $arCourse[10]=="PTC_COM Open") {
						$arPROP["INIT"]=245;
					} else {
						$arPROP["INIT"]=244;
					}
					$arPROP["FORMAT"]=$arCourse[20];
					$arPROP["startdate"]=$arCourse["DATES_NORMAL"]["START_DATE"];
					if ($arCourse["DATES_NORMAL"]["START_DATE"]!=$arCourse["DATES_NORMAL"]["END_DATE"]) {
						$arPROP["enddate"]=$arCourse["DATES_NORMAL"]["END_DATE"];
					}
					$arPROP["schedule_time"]=$arCourse["DATES_NORMAL"]["GOOD_TIME"];
					if (strlen($arCourse["DATES_NORMAL"]["BAD_TIME"])>0) {
						$arPROP["TIME_INTERVAL"]=$arCourse["DATES_NORMAL"]["BAD_TIME"];
					}
					$ID_TEACHER="";
					$arPROP["schedule_duration"]=round($arCourse["DURATION"]/60);
					if ($arCourse[11]!="N/A") {
						$ID_TEACHER=$arCourse[11];
					} else {
						$ID_TEACHER=$arCourse[12];
					}
					if (strlen($ID_TEACHER)>0) {
						$arSelect1 = Array("ID", "NAME");
						$arFilter1 = Array("IBLOCK_ID"=> 56, "PROPERTY_LMS_ID"=>$ID_TEACHER);
						$res1 = CIBlockElement::GetList(Array(), $arFilter1, false, false, $arSelect1);
						if ($ob1 = $res1->GetNextElement())
						{
							$arTrainerFields = $ob1->GetFields();
							$arPROP["teacher"]=$arTrainerFields["ID"];
							$arPROP["string_teacher"]="";
							
						} else {
							$arPROP["string_teacher"]=$arCourse["12"];
						}
					} else {
						//$arPROP["string_teacher"]=$arCourse["12"];
					}
					$arSelect2 = Array("ID");
					$arFilter2 = Array("IBLOCK_ID"=> 9, "PROPERTY_LMS_ID"=> $code);
					$res2 = CIBlockElement::GetList(Array(), $arFilter2, false, false, $arSelect2);
					if ($ob2 = $res2->GetNextElement()) {
						$arScheduleFields = $ob2->GetFields();
						$arOLD=GetFullInfoAboutCourse($arScheduleFields["ID"]);
						$ID_CITY=$arPROP["city"];
						CModule::IncludeModule("iblock");
						$arNEW=array();
						$res = CIBlockElement::GetByID($arPROP["teacher"]);
						if ($ar_res = $res->GetNext()) {
						   $arNEW["TEACHER_NAME"]=$ar_res["NAME"];
						}
						 $res1 = CIBlockElement::GetByID($ID_CITY);
						if ($ar_res1 = $res1->GetNext()) {
							$arNEW["CITY_NAME"]=$ar_res1["NAME"];
						}
						$arNEW["STARTDATE"]=$arPROP["startdate"];
						$arNEW["ENDDATE"]=$arPROP["enddate"];
						$arNEW["SCHEDULE_TIME"]=$arPROP["schedule_time"];
						$changes=0;
						$arSendFields=array();
						$arSendFields["MODIFIED_BY"]="[Integration with LMS]";
						$arSendFields["NAME"]=$arOLD["COURSE_CODE"]." ".$arOLD["COURSE_NAME"];
						//$arSendFields["CITY_NAME"]=$arOLD["CITY_NAME"];
						foreach ($arNEW as $key=>$VALUE) {
							//print_r($VALUE);
							if ($VALUE!=$arOLD[$key] && strlen($VALUE)>0) {
								$arSendFields[$key]="<s style='color: #FF0000'>".$arOLD[$key]."</s> <span style='color: #008B45'>".$VALUE."</span>";
								$changes++;
							} else {
								$arSendFields[$key]=$arOLD[$key];
							}
						}
						if (intval($changes)>0) {
							print_r($arSendFields);
							CEvent::Send('UPDATE_COURSE_TIME',SITE_ID, $arSendFields, 'N', 180);
						}
						
						CIBlockElement::SetPropertyValuesEx($arScheduleFields["ID"], 9, $arPROP);
						
						if ($arCourse[5]=="Cancelled") {
							$el = new CIBlockElement;
							$arLoadProductArray = Array(
							"ACTIVE"=> "N"
							);
							$result = $el->Update($arScheduleFields["ID"], $arLoadProductArray);
							
						}
						scheduleRU($arScheduleFields["ID"]);
					} else {
						echo ($city.", ".$arCourse["0"].", ".$arCourse["DATES_NORMAL"]["START_DATE"]." - ".$arCourse["DATES_NORMAL"]["END_DATE"].", ".$arCourse["12"]." NEW<br/>");
						$arPROP["LMS_ID"]=$code;
						$el = new CIBlockElement;
						$arLoadProductArray = Array(
							"IBLOCK_SECTION_ID" => false,          
							"IBLOCK_ID"      => 9,
							"PROPERTY_VALUES" => $arPROP,
							"NAME" => $arCourse["NAME"],
						    "ACTIVE" => "Y"         
  					    );
						
						if($PRODUCT_ID = $el->Add($arLoadProductArray)) {
							CModule::IncludeModule("catalog");
							$arCatFields = array(
								"ID" => $PRODUCT_ID, 
								
							);
							CCatalogProduct::Add($arCatFields);
								$arPriceFields = Array(
													  "PRODUCT_ID" => $PRODUCT_ID,
														"CATALOG_GROUP_ID" => 1,
														"PRICE" => 1,
														"CURRENCY" => "EUR"
													);
								CPrice::Add($arPriceFields);
						}
					}
					
					print_r($arPROP);
				} else {
					echo "NOT FOUND";
				}
				//print_r($arCourse);
				
			}
		}
		else
		{
			//print_r($city);
			if (strlen($city)>0) {
				foreach ($arSchedule as $code=>$arCourse) {
					$arCourse["DATES_NORMAL"]=checkCommonDates($arCourse["DATES"]);
					unset($arCourse["DATES"]);
					echo ($arCourse["0"]." ".$arCourse["DATES_NORMAL"]["START_DATE"]." - ".$arCourse["DATES_NORMAL"]["END_DATE"]." ".$arCourse["12"]."<br/>");
					$arSelect = Array("ID", "NAME", "PROPERTY_PRICE");
					$arFilter = Array("IBLOCK_ID"=> 97, "CODE"=>trim($arCourse[0]));
					$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
					if ($ob = $res->GetNextElement())
					{
						$arFields = $ob->GetFields();
						$arCourse["NAME"]=$arFields["NAME"];
						$arPROP=array();
						$arPROP["COURSE_CODE"]=$arCourse[0];
						$arPROP["COURSE_ID"]=$arFields["ID"];
						$arPROP["DURATION"]=intval($arCourse["DURATION"]/60);
						if ($city=="Bucharest") {
							$arPROP["CITY_ID"]=34729;
						} elseif ($city=="Krakow") {
							$arPROP["CITY_ID"]=36978;
						} elseif ($city=="Wroclaw") {
							$arPROP["CITY_ID"]=55979;
						} elseif ($city=="Virtual_EN") {
							$arPROP["CITY_ID"]=37594;
						} 
						$arPROP["TIME"]=$arCourse["DATES_NORMAL"]["GOOD_TIME"];
						if (strlen($arCourse["DATES_NORMAL"]["BAD_TIME"])>0) {
							$arPROP["ADDITIONAL_TIME"]=$arCourse["DATES_NORMAL"]["BAD_TIME"];
						}
						$arPROP["STARTDATE"]=$arCourse["DATES_NORMAL"]["START_DATE"];
						if ($arCourse["DATES_NORMAL"]["START_DATE"]!=$arCourse["DATES_NORMAL"]["END_DATE"]) {
							$arPROP["ENDDATE"]=$arCourse["DATES_NORMAL"]["END_DATE"];
						}
						print_r($arCourse);
						if ($city=="Bucharest") {
							$arPROP["LANG"]=44384;
						} elseif ($city=="Krakow" || $city=="Wroclaw" || $city=="Virtual_EN") {
							$arPROP["LANG"]=44383;
						} 
						$arPROP["LMS_ID"]=$code;
						if ($arCourse[11]!="N/A") {
							$ID_TEACHER=$arCourse[11];
						} else {
							$ID_TEACHER=$arCourse[12];
						}
						$arTrainer="";
						$arSelect1 = Array("ID", "NAME", "PROPERTY_SHORT_NAME");
						$arFilter1 = Array("IBLOCK_ID"=> 98, "PROPERTY_LMS_ID"=>$ID_TEACHER);
						$res1 = CIBlockElement::GetList(Array(), $arFilter1, false, false, $arSelect1);
						if ($ob1 = $res1->GetNextElement())
						{
							$arTrainerFields = $ob1->GetFields();
							$arPROP["TRAINER_ID"]=$arTrainerFields["ID"];
							$arTrainer=$arTrainerFields["NAME"]." ".$arTrainerFields["PROPERTY_SHORT_NAME_VALUE"];
							
						} else {
							$arPROP["TRAINER_SIMPLE"]=$arCourse["12"];
						}
						print_r($arPROP);
						$arSelect2 = Array("ID");
						$arFilter2 = Array("IBLOCK_ID"=> 99, "PROPERTY_LMS_ID"=> $code);
						$res2 = CIBlockElement::GetList(Array(), $arFilter2, false, false, $arSelect2);
						if ($ob2 = $res2->GetNextElement()) {
							$arScheduleFields = $ob2->GetFields();
							echo "UPDATE_COURSE";
							print_r($arPROP);
							CIBlockElement::SetPropertyValuesEx($arScheduleFields["ID"], 99, $arPROP);
							if ($arCourse[5]=="Cancelled") {
								$el = new CIBlockElement;
								$arLoadProductArray = Array(
								"ACTIVE"=> "N"
								);
								//$result = $el->Update($arScheduleFields["ID"], $arLoadProductArray);
							}
							scheduleCOM($arScheduleFields["ID"]);
						} else {
							$arPROP["LMS_ID"]=$code;
							$el = new CIBlockElement;
							$arLoadProductArray = Array(
								"IBLOCK_SECTION_ID" => false,          
								"IBLOCK_ID"      => 99,
								"PROPERTY_VALUES" => $arPROP,
								"NAME" => $arCourse["NAME"],
								"ACTIVE_FROM"=> date("d.m.Y"),
								"ACTIVE" => "Y"         
							);
							echo "ADD_COURSE";
							$arSendNewFields=array("NAME"=> $arPROP["COURSE_CODE"]." ".$arCourse["NAME"], "CITY"=> $city, "DATES"=> $arPROP["STARTDATE"]." - ".$arPROP["ENDDATE"], "TRENER"=> $arTrainer, "PRICE"=> intval($arFields["PROPERTY_PRICE_VALUE"])." euro");
							print_r($arSendNewFields);
							
							print_r($arLoadProductArray);

							if($PRODUCT_ID = $el->Add($arLoadProductArray)) {
							CEvent::Send('NEW_COURSE_TIMETABLE_EN',SITE_ID, $arSendNewFields, 'N', 189);
							CModule::IncludeModule("catalog");
							$arCatFields = array(
								"ID" => $PRODUCT_ID, 
								
							);
							CCatalogProduct::Add($arCatFields);
							$arPriceFields = Array(
													  "PRODUCT_ID" => $PRODUCT_ID,
														"CATALOG_GROUP_ID" => 1,
														"PRICE" => $arFields["PROPERTY_PRICE_VALUE"],
														"CURRENCY" => "EUR"
													);
								CPrice::Add($arPriceFields);
							} else {
													  echo $el->LAST_ERROR;
													}
						}
					} else {
						echo "NOT_FOUND - ".$arCourse[0]."<br/>";
						print_r($arCourse);
					}
				}
			}
		}
	}
	
	echo "</pre>";
}

function checkCommonDates($arDates) {
	foreach ($arDates as $key=>$date) {
		if ($key==0) {
			$firstDate=date("d.m.Y", strtotime($date[0]));
		}
		$lastDate=date("d.m.Y", strtotime($date[1]));
		$time=date("H:i", strtotime($date[0]))."-".date("H:i", strtotime($date[1]));
		$arTime[$time]["DATES"][]=$lastDate;
		$arTime[$time]["NAME"]=$time;
	}
	$arResult["START_DATE"]=$firstDate;
	$arResult["END_DATE"]=$lastDate;
	$arResult["TIME"]=$arTime;
	$last_max=0;
	foreach ($arResult["TIME"] as $time=>$dates) {
		
		if (count($dates["DATES"])>$last_max) {
			$last_max=count($dates["DATES"]);
			$good_time=$time;
		}
		
	}
	unset($arResult["TIME"][$good_time]);
	foreach ($arResult["TIME"] as $time=>$bad_dates) {
		$string_dates[]=implode(", ", $bad_dates["DATES"])." ".$time;
		
	}
	if (is_array($string_dates)) {
		$all_dates=implode("; ",$string_dates);
	}
	$arResult["BAD_TIME"]=$all_dates;
	$arResult["GOOD_TIME"]=$good_time;
	
	return $arResult;
}

?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>