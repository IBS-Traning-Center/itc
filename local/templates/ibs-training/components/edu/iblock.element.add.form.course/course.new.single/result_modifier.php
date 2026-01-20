<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
global $USER, $arEventInfo, $arCoursesInfo, $gCourseFormat;
 // если это курс и он онлайновый, то удаляем возмождность выбора оплатвы посредством договора
if ($gCourseFormat) {
	unset($arResult['PROPERTY_LIST_FULL']['392']['ENUM']['126']);}
?>
<?/*and (isset($_REQUEST['ID_TIME']) === false)*/?>
<?//if ((count($arCoursesInfo)>0)  and (isset($_REQUEST['IN_CITY']) !== true) and  ($arParams['SHOW_CITIES'] == "N")){?>
<?
	$vKeyInArray = array_search('313', $arParams['PROPERTY_CODES_HIDDEN']);
	$arParams['PROPERTY_CODES_HIDDEN'][$vKeyInArray] = "";
	$arResult['PROPERTY_HIDDEN'][$vKeyInArray] = "";
	$arResult['PROPERTY_LIST_FULL']['313']['LIST_TYPE'] = "L";
	$arResult['PROPERTY_LIST_FULL']['313']['~LIST_TYPE'] = "L";
	$arResult['PROPERTY_LIST_FULL']['313']['PROPERTY_TYPE'] = "L";
	$arResult['PROPERTY_LIST_FULL']['313']['~PROPERTY_TYPE'] = "L";
	//iwrite($arCoursesInfo);
	foreach ($arCoursesInfo as $arSingleCourse){		$arResult['PROPERTY_LIST_FULL']['313']['ENUM'][$arSingleCourse['ID_TIME']]['ID'] = $arSingleCourse['ID_TIME'];
		$arResult['PROPERTY_LIST_FULL']['313']['ENUM'][$arSingleCourse['ID_TIME']]['~ID'] = $arSingleCourse['ID_TIME'];
		$arResult['PROPERTY_LIST_FULL']['313']['ENUM'][$arSingleCourse['ID_TIME']]['VALUE'] = $arSingleCourse['DATE_BEGIN'].", ".$arSingleCourse['EVENT_CITY'];
		$arResult['PROPERTY_LIST_FULL']['313']['ENUM'][$arSingleCourse['ID_TIME']]['~VALUE'] = $arSingleCourse['ID_TIME'];
		$arResult['PROPERTY_LIST_FULL']['313']['ENUM'][$arSingleCourse['ID_TIME']]['DEF'] = "N";
		$arResult['PROPERTY_LIST_FULL']['313']['ENUM'][$arSingleCourse['ID_TIME']]['~DEF'] = "N";
		if ($_REQUEST['ID_TIME'] == $arSingleCourse['ID_TIME']){
			$arResult['PROPERTY_LIST_FULL']['313']['ENUM'][$arSingleCourse['ID_TIME']]['DEF'] = "Y";
			$arResult['PROPERTY_LIST_FULL']['313']['ENUM'][$arSingleCourse['ID_TIME']]['~DEF'] = "Y";
		}
		
		$arResult['PROPERTY_LIST_FULL']['313']['ENUM'][$arSingleCourse['ID_TIME']]['PROPERTY_ID'] = 313;
		$arResult['PROPERTY_LIST_FULL']['313']['ENUM'][$arSingleCourse['ID_TIME']]['~PROPERTY_ID'] = 313;
	}
	$arResult['PROPERTY_LIST_FULL']['313']['ENUM'][0]['ID'] = 0;
		$arResult['PROPERTY_LIST_FULL']['313']['ENUM'][0]['~ID'] = 0;
		$arResult['PROPERTY_LIST_FULL']['313']['ENUM'][0]['VALUE'] = "Открытая дата";
		$arResult['PROPERTY_LIST_FULL']['313']['ENUM'][0]['~VALUE'] = 0;
		$arResult['PROPERTY_LIST_FULL']['313']['ENUM'][0]['DEF'] = "N";
		$arResult['PROPERTY_LIST_FULL']['313']['ENUM'][0]['~DEF'] = "N";
	$arResult['PROPERTY_LIST_FULL']['313']['NAME'] = "Выбрать дату";
	$arResult['PROPERTY_LIST_FULL']['313']['SORT'] = 5;
	$arResult['COUNT_RECORDS'] = count($arCoursesInfo);

?><?
//print_r($arParams);
?>
<?// } ?>
<?
	///if ((isset($_REQUEST['IN_CITY']) === true) or ($arParams['SHOW_CITIES'] == "Y")){
		//$vKeyInArray = array_search('407', $arParams['PROPERTY_CODES_HIDDEN']);
		//$arParams['PROPERTY_CODES_HIDDEN'][$vKeyInArray] = "";
		//$arResult['PROPERTY_HIDDEN'][$vKeyInArray] = "";
		$arResult['PROPERTY_LIST_FULL']['407']['LIST_TYPE'] = "L";
		$arResult['PROPERTY_LIST_FULL']['407']['~LIST_TYPE'] = "L";
		$arResult['PROPERTY_LIST_FULL']['407']['PROPERTY_TYPE'] = "L";
		$arResult['PROPERTY_LIST_FULL']['407']['~PROPERTY_TYPE'] = "L";


		$arCityInfo = GetAllActiveCitiesInfo();


		foreach ($arCityInfo as $arSingleCity){
		 	$arResult['PROPERTY_LIST_FULL']['407']['ENUM'][$arSingleCity['ID']]['ID'] = $arSingleCity['ID'];
		 	$arResult['PROPERTY_LIST_FULL']['407']['ENUM'][$arSingleCity['ID']]['~ID'] = $arSingleCity['ID'];
		 	$arResult['PROPERTY_LIST_FULL']['407']['ENUM'][$arSingleCity['ID']]['VALUE'] = $arSingleCity['NAME'];
		 	$arResult['PROPERTY_LIST_FULL']['407']['ENUM'][$arSingleCity['ID']]['~VALUE'] = $arSingleCity['NAME'];
		 	$arResult['PROPERTY_LIST_FULL']['407']['ENUM'][$arSingleCity['ID']]['DEF'] = "N";
		 	$arResult['PROPERTY_LIST_FULL']['407']['ENUM'][$arSingleCity['ID']]['~DEF'] = "N";
		 	if ($_REQUEST['IN_CITY'] ===  $arSingleCity['ID']) {		 		$arResult['PROPERTY_LIST_FULL']['407']['ENUM'][$arSingleCity['ID']]['DEF'] = "Y";
		 		$arResult['PROPERTY_LIST_FULL']['407']['ENUM'][$arSingleCity['ID']]['~DEF'] = "Y";
		 	}
		 	$arResult['PROPERTY_LIST_FULL']['407']['ENUM'][$arSingleCity['ID']]['PROPERTY_ID'] = 407;
		 	$arResult['PROPERTY_LIST_FULL']['407']['ENUM'][$arSingleCity['ID']]['~PROPERTY_ID'] = 407;
		}
			$arResult['PROPERTY_LIST_FULL']['407']['NAME'] = "Желаемое место проведения курса";
			$arResult['PROPERTY_LIST_FULL']['407']['SORT'] = 3;
			$arResult['OWN_TITLE'] = "Регистрация на курс в городе: ". $arCityInfo[$_REQUEST['IN_CITY']]['NAME'];
			//iwrite($arResult);
	//}

?>


