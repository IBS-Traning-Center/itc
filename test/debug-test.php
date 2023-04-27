<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Title");
?>

<?include($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");


// DOWNLOAD REMOTE FILES
/*
$ftp_server='ftp.luxoft.csod.com';
$ftp_user_name="luxoft";
$ftp_user_pass="KmUny6gB";
include('Net/SFTP.php');
$sftp = new Net_SFTP($ftp_server); // создаем sftp клиент
if (!$sftp->login($ftp_user_name, $ftp_user_pass)) // попытка логина на sftp сервер
{
    exit('Login Failed');
} 
else // успешно
{

	$sftp->chdir('/Reports/Custom_reports/'); // переходим в нужную директорию
	$files = $sftp->rawlist();
	$List = array_filter($files, function($var) { return preg_match("/(ToBitrix_)/i", $var['filename']); }); // берем только файлы для Битрикс


echo "<hr>";

	foreach ($List as $Item => $Attributes) 
	{
		if ($Attributes['size'] > 356) 
		{
			$filename = $Attributes['filename'];

			$sftp->get('/Reports/Custom_reports/'.$filename, '/home/bitrix/ext_www/new.luxoft-training.ru/test/Cources/'.$filename);
			echo "<pre> ";
			echo  $filename . ' added';
			echo "</pre>";
		}
	}



}
*/


// PARSING DOWNLOADED FILES HERE -> CREATE ARRAY OF COURSES

/*
	chdir(getcwd().'/Cources/');
	$files = scandir(getcwd());
	foreach($files as $Item) // цикл по файлам
	{	

		if(strlen($Item) < 3) continue;
		$content = file_get_contents(getcwd().'/'.$Item);

		$array = explode(PHP_EOL, $content);

		foreach($array as $sItem) // цикл по записям о проведении курсов (одна запись - один день проведения определенного курса)	
		{
			$arItem= explode("\t", $sItem); // массив параметров расписания курса 
			
			$course_status = $arItem[5];
			$course_code = $arItem[9];
			$course_city = $arItem[14];
			$course_location = $arItem[15];

			$course_start_date = $arItem[6];
			$course_end_date = $arItem[7];
			$course_duration = $arItem[16];
			$course_lang = $arItem[19];
			$course_time_break = $arItem[21];
			
			switch($course_status)
			{
				case "Approved":
				{

					$dates=array($course_start_date, $course_end_date);
					$city = strlen($course_city) > 0 ? $course_city : $course_location;
	
					if ($city=="Virtual" && stristr($course_lang, "English")) 
					{
						$city="Virtual_EN";
					}
					if (!is_array($arResultArray[$city][$course_code])) 
					{
						$arResultArray[$city][$course_code]=$arItem;
					}
					$arResultArray[$city][$course_code]["DATES"][]=$dates;
					$arResultArray[$city][$course_code]["DURATION"]=$arResultArray[$city][$course_code]["DURATION"]+($course_duration-intval($course_time_break));
					break;
				}
				case "Cancelled":
				{
					break;
				}
			}
			
		}
	}
	
	//echo '<pre>';
	//print_r($arResultArray);
	//echo '</pre>';

	//
	//$_SESSION['results'] = $arResultArray;

*/

// CREATING BITRIX INFOBLOCKS

$cities = ["Omsk" => 5742,"St.-Petersburg" => 5744, "Moscow" => 5741, "Kiev" => 5745, "Odessa" => 5746, "Dnepropetrovsk" => 5747, "Virtual" => 14909];

// временно для отладки
session_start();
$arResultArray = $_SESSION['results'];

echo count($arResultArray);
	
CModule::IncludeModule("iblock");
foreach ($arResultArray as $city=>$arSchedule) // цикл по городам
{
	if(in_array($city, array_keys($cities))) // курсы на русском
	{
		foreach ($arSchedule as $code=>$arCourse) // цикл по курсам
		{
			$arCourse["DATES_NORMAL"] = checkCommonDates($arCourse["DATES"]);

			$cCode = $arCourse[0];
			$cFormat = $arCourse[20];
			$cInstructorID = $arCourse[11];
			$cInstructorName = $arCourse[12];

			$arSelect = Array("ID", "NAME");
			$arFilter = Array("IBLOCK_ID"=> 6, "PROPERTY_31"=>trim($cCode)); // PROPERTY_31 это CODE (таблица b_iblock_element_prop_s6)
			
			// Метод GetList вернет объект класса CIBlockResult		
			$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
echo '<hr>';
echo 'PROPERTY_31 это CODE (таблица b_iblock_element_prop_s6)';
echo '<pre>';
print_r($res2);
echo '</pre>';
			
/*
			// Метод GetNextElement класса CIBlockResult вернет объект _CIBElement в котором храняться свойства элемента инфоблока 
			if ($ob = $res->GetNextElement())  
			{
				$arFields = $ob->GetFields(); // Метод возвращает массив с полями элемента информационного блока (таблица b_iblock_element)

				$arCourse["NAME"]=$arFields["NAME"];
				$arPROP=array();
				$arPROP["course_code"]=$cCode;
				$arPROP["schedule_course"]=$arFields["ID"];

				$arPROP["city"] = $cities[$city];


				if ($arCourse[10]=="CommercialDepartmentRequest" || $arCourse[10]=="PTC_COM Corp" || $arCourse[10]=="PTC_COM Open") 
				{
					$arPROP["INIT"]=245;
				} 
				else 
				{
					$arPROP["INIT"]=244;
				}

				$arPROP["FORMAT"]=$cFormat;

				// Даты курса, длительность
				$arPROP["startdate"]=$arCourse["DATES_NORMAL"]["START_DATE"];
				if ($arCourse["DATES_NORMAL"]["START_DATE"]!=$arCourse["DATES_NORMAL"]["END_DATE"]) 
				{
					$arPROP["enddate"]=$arCourse["DATES_NORMAL"]["END_DATE"];
				}

				$arPROP["schedule_time"]=$arCourse["DATES_NORMAL"]["GOOD_TIME"];

				if (strlen($arCourse["DATES_NORMAL"]["BAD_TIME"])>0) 
				{
					$arPROP["TIME_INTERVAL"]=$arCourse["DATES_NORMAL"]["BAD_TIME"];
				}
				$arPROP["schedule_duration"]=round($arCourse["DURATION"]/60);

				// Преподаватель курса
				$ID_TEACHER="";
				$ID_TEACHER= $cInstructorID!="N/A" ? $cInstructorID : $cInstructorName;
				if (strlen($ID_TEACHER) > 0) // пробуем получить Инструктора
				{
					$arSelect1 = Array("ID", "NAME");
					$arFilter1 = Array("IBLOCK_ID"=> 56, "PROPERTY_LMS_ID"=>$ID_TEACHER);
					$res1 = CIBlockElement::GetList(Array(), $arFilter1, false, false, $arSelect1);

					if ($ob1 = $res1->GetNextElement())
					{
						$arTrainerFields = $ob1->GetFields();
						$arPROP["teacher"]=$arTrainerFields["ID"];
						$arPROP["string_teacher"]="";
					} 
					else 
					{
						$arPROP["string_teacher"]=$cInstructorName;
					}
				} 
				else 
				{
					echo 'Error Instructor Id/Name'.$arCourse;
					//$arPROP["string_teacher"]=$arCourse["12"];
				}
*/				
				// Расписание
				$arSelect2 = Array("ID");
				$arFilter2 = Array("IBLOCK_ID"=> 9, "PROPERTY_LMS_ID"=> $code);
				$res2 = CIBlockElement::GetList(Array(), $arFilter2, false, false, $arSelect2);
echo 'PROPERTY_LMS_ID';
echo '<pre>';
print_r($res2);
echo '</pre>';
/*
				if ($ob2 = $res2->GetNextElement()) 
				{
					$arScheduleFields = $ob2->GetFields();
					$arOLD=GetFullInfoAboutCourse($arScheduleFields["ID"]);
					$ID_CITY=$arPROP["city"];
					CModule::IncludeModule("iblock");
					$arNEW=array();
					$res = CIBlockElement::GetByID($arPROP["teacher"]);
					if ($ar_res = $res->GetNext()) 
					{
						$arNEW["TEACHER_NAME"]=$ar_res["NAME"];
					}
					$res1 = CIBlockElement::GetByID($ID_CITY);
					if ($ar_res1 = $res1->GetNext()) 
					{
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
					foreach ($arNEW as $key=>$VALUE) 
					{
						//print_r($VALUE);
						if ($VALUE!=$arOLD[$key] && strlen($VALUE)>0) 
						{
							$arSendFields[$key]="<s style='color: #FF0000'>".$arOLD[$key]."</s> <span style='color: #008B45'>".$VALUE."</span>";
							$changes++;
						} 
						else 
						{
							$arSendFields[$key]=$arOLD[$key];
						}
					}
					if (intval($changes)>0) 
					{
						print_r($arSendFields);
						CEvent::Send('UPDATE_COURSE_TIME',SITE_ID, $arSendFields, 'N', 180);
					}
						
					CIBlockElement::SetPropertyValuesEx($arScheduleFields["ID"], 9, $arPROP);
						
					if ($arCourse[5]=="Cancelled") 
					{
						$el = new CIBlockElement;
						$arLoadProductArray = Array("ACTIVE"=> "N");
						$result = $el->Update($arScheduleFields["ID"], $arLoadProductArray);
					}
					scheduleRU($arScheduleFields["ID"]);
				} 
				else 
				{
					echo ($city.", ".$arCourse["0"].", ".$arCourse["DATES_NORMAL"]["START_DATE"]." - ".$arCourse["DATES_NORMAL"]["END_DATE"].", ".$arCourse["12"]." NEW<br/>");
					$arPROP["LMS_ID"]=$code;
					$el = new CIBlockElement;
					$arLoadProductArray = Array(
							"IBLOCK_SECTION_ID" => false,          
							"IBLOCK_ID"      => 9,
							"PROPERTY_VALUES" => $arPROP,
							"NAME" => $arCourse["NAME"],
						    "ACTIVE" => "Y");
						
					if($PRODUCT_ID = $el->Add($arLoadProductArray)) 
					{
						CModule::IncludeModule("catalog");
						$arCatFields = array("ID" => $PRODUCT_ID, );
						CCatalogProduct::Add($arCatFields);
						$arPriceFields = Array(
									"PRODUCT_ID" => $PRODUCT_ID,
									"CATALOG_GROUP_ID" => 1,
									"PRICE" => 1,
									"CURRENCY" => "EUR");
						CPrice::Add($arPriceFields);
					}
				}
*/
				//print_r($arPROP);
		}	
	}
}


function checkCommonDates($arDates) 
{
	foreach ($arDates as $key=>$date) 
	{
		if ($key==0) 
		{
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
	foreach ($arResult["TIME"] as $time=>$dates) 
	{
		if (count($dates["DATES"])>$last_max) 
		{
			$last_max=count($dates["DATES"]);
			$good_time=$time;
		}
		
	}
	unset($arResult["TIME"][$good_time]);
	foreach ($arResult["TIME"] as $time=>$bad_dates)
	{
		$string_dates[]=implode(", ", $bad_dates["DATES"])." ".$time;
	}
	if (is_array($string_dates)) 
	{
		$all_dates=implode("; ",$string_dates);
	}
	$arResult["BAD_TIME"]=$all_dates;
	$arResult["GOOD_TIME"]=$good_time;
	
	return $arResult;
}

// Очистка сессии
//session_unset();
//session_destroy();

?>



<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>