<?php
use \Bitrix\Main\Loader;
AddEventHandler("iblock", "OnBeforeIBlockElementAdd", Array("IBlockHandlerClass", "OnBeforeIBlockElementAddHandlerN"));
AddEventHandler("iblock", "OnAfterIBlockElementUpdate", Array("IBlockHandlerClass", "OnAfterIBlockElementUpdateHandlerN"));
AddEventHandler("iblock", "OnAfterIBlockElementAdd",    Array("IBlockHandlerClass", "OnAfterIBlockElementUpdateHandlerN"));
AddEventHandler("iblock", "OnAfterIBlockElementAdd",    "OnAfterIBlockElementUpdateHandlerSend");
AddEventHandler("iblock", "OnBeforeIBlockElementUpdate",    "OnBeforeIBlockElementUpdateHandlerSend");

function OnAfterIBlockElementUpdateHandlerSend($arFields) {
	global $DB, $USER;
    if($arFields["IBLOCK_ID"] == 9) {
       $arInfo=GetFullInfoAboutCourse($arFields["ID"]);
	   $arSend=array(
	       "NAME"=> $arInfo["COURSE_CODE"]." ".$arInfo["COURSE_NAME"],
           "CITY"=> $arInfo["CITY_NAME"],
           "DATES"=> $arInfo["STARTDATE"]." - ".$arInfo["ENDDATE"],
           "TRENER"=> $arInfo["TEACHER_NAME"],
           "MANAGER"=> $arInfo["CREATED_NAME"], "PRICE"=> $arInfo["PRICE"],
           "DURATION" => (!empty($arInfo["SCHEDULE_DURATION"])) ? $arInfo["SCHEDULE_DURATION"] : $arInfo["SCHEDULE_DURATION_COURSE"]
       );
	   if (intval($arInfo["PRICE_ONLY"])==0) {
			$arSend["PRICE"]= "не указана";
	   }
	   CEvent::Send('NEW_COURSE_TIME',SITE_ID, $arSend, 'N', 179);
    }
	if($arFields["IBLOCK_ID"] == 6) {
        //print_r($arFields["ID"]);
        $filter = array(
            "ID" => intval($arFields["ID"]),
            "CHECK_PERMISSIONS" => "N",
        );
        if ($TYPE != "")
            $filter["IBLOCK_TYPE"] = $TYPE;

        $iblockElement = CIBlockElement::GetList(array(), $filter);
        if($obIBlockElement = $iblockElement->GetNextElement())
        {
            $arIBlockElement = $obIBlockElement->GetFields();
            if ($arIBlock = GetIBlock($arIBlockElement["IBLOCK_ID"], $TYPE))
            {
                $arIBlockElement["IBLOCK_ID"] = $arIBlock["ID"];
                $arIBlockElement["IBLOCK_NAME"] = $arIBlock["NAME"];
                $arIBlockElement["~IBLOCK_NAME"] = $arIBlock["~NAME"];
                $arIBlockElement["PROPERTIES"] = $obIBlockElement->GetProperties();


            }
        }
        $arSend["NAME"]=$arIBlockElement["NAME"];
        $arSend["CODE"]=$arIBlockElement["CODE"];
        $arSend["DURATION"]=$arIBlockElement["PROPERTIES"]["course_duration"]["VALUE"];
        $arSend["LINK"]="http://ibs-training.ru/kurs/".$arIBlockElement["XML_ID"].'.html';
        $arSend["RU_PRICE"]=$arIBlockElement["PROPERTIES"]["course_price"]["VALUE"]." руб.";
		$arSend["UA_PRICE"]=fn_getMostNewCityPrice($arIBlockElement["PROPERTIES"]["course_price"]["VALUE"], $arIBlockElement["PROPERTIES"]["COURSE_PRICE_UA"]["VALUE"], CITY_ID_KIEV, $arIBlockElement["PROPERTIES"]["course_duration"]["VALUE"])." грн.";
        /*if (intval($arIBlockElement["PROPERTIES"]["COURSE_PRICE_UA"]["VALUE"])>0) {
            $arSend["UA_PRICE"]=$arIBlockElement["PROPERTIES"]["COURSE_PRICE_UA"]["VALUE"]." грн.";
        } else {
            $arSend["UA_PRICE"]="не указана";
        }*/
        CEvent::Send('NEW_CURS', SITE_ID, $arSend, 'N');
    }
}
function OnBeforeIBlockElementUpdateHandlerSend($arFields) {
    global $DB, $USER;

	if($arFields["IBLOCK_ID"] == 9) {
        if (intval($arFields["MODIFIED_BY"])>0) {
            $arOLD = GetFullInfoAboutCourse($arFields["ID"]);
            $ID_TEACHER = $arFields["PROPERTY_VALUES"][210][$arOLD["ID_TIME"].':210']["VALUE"];
			$ID_CITY = $arFields["PROPERTY_VALUES"][50][$arOLD["ID_TIME"].':50']["VALUE"];

			if ($arFields["ACTIVE"] == "Y") {
				$arNEW["ACTIVE"] = "Да";
			} else {
				$arNEW["ACTIVE"] = "Нет";
			}

			if (is_array($arFields["PROPERTY_VALUES"][432])) {
				if (strlen($arFields["PROPERTY_VALUES"][432][$arOLD["ID_TIME"] . ':432']["VALUE"]) > 0) {
					$arNEW["IS_CLOSE"] = "ДА";
				} else {
					$arNEW["IS_CLOSE"] = "Нет";
				}
			} else {
				$arNEW["IS_CLOSE"] = "Нет";
			}

			if (!Loader::includeModule('iblock')) {
				return;
			}


			$res = CIBlockElement::GetByID($ID_TEACHER);
            if ($ar_res = $res->GetNext()) {
               $arNEW["TEACHER_NAME"] = $ar_res["NAME"];
            }

			$res1 = CIBlockElement::GetByID($ID_CITY);
            if ($ar_res1 = $res1->GetNext()) {
                $arNEW["CITY_NAME"] = $ar_res1["NAME"];
            }

            $arNEW["STARTDATE"] 		= $arFields["PROPERTY_VALUES"][52][$arOLD["ID_TIME"].':52']["VALUE"];
            $arNEW["ENDDATE"] 			= $arFields["PROPERTY_VALUES"][53][$arOLD["ID_TIME"].':53']["VALUE"];
            $arNEW["SCHEDULE_TIME"] 	= $arFields["PROPERTY_VALUES"][54][$arOLD["ID_TIME"].':54']["VALUE"];
            $arNEW["SCHEDULE_DURATION"] = $arFields["PROPERTY_VALUES"][57][$arOLD["ID_TIME"].':57']["VALUE"];
            $changes = 0;

            $rsUser = CUser::GetByID($arFields["MODIFIED_BY"]);
            $arUser = $rsUser->Fetch();
            $arSendFields["MODIFIED_BY"] = "[{$arUser["EMAIL"]}] {$arUser["LAST_NAME"]} {$arUser["NAME"]}";
            $arSendFields["NAME"] = "{$arOLD["COURSE_CODE"]} {$arOLD["COURSE_NAME"]}";

			foreach ($arNEW as $key => $VALUE) {
				if ($VALUE != $arOLD[$key]) {
					$arSendFields[$key] = "<s style='color: #FF0000'>" . $arOLD[$key] . "</s> <span style='color: #008B45'>" . $VALUE . "</span>";
					$changes++;
				} else {
					$arSendFields[$key] = $arOLD[$key];
				}
			}

            if (intval($changes)>0) {
                CEvent::Send('UPDATE_COURSE_TIME',SITE_ID, $arSendFields, 'N', 180);
            }
        }
    }

}

AddEventHandler("search", "BeforeIndex", "BeforeIndexHandlerRU");
function BeforeIndexHandlerRu($arFields)
{
    if(!CModule::IncludeModule("iblock")) // подключаем модуль
        return $arFields;
    if($arFields["MODULE_ID"] == "iblock" && $arFields["PARAM2"] == D_COURSE_ID_IBLOCK)
    {

        $res = CIBlockElement::GetByID($arFields["ITEM_ID"]);
        if($ar_res = $res->GetNext())
            $arFields["TITLE"] = $ar_res["CODE"]." ".$arFields["TITLE"];
    }
	//echo $arFields["TITLE"] ;
	//die;
    return $arFields;
}
class IBlockHandlerClass
{
    static function OnBeforeIBlockElementAddHandlerN(&$arFields)
    {
		//iwrite($arFields);
		//die();
		global $DB;
		if($arFields["IBLOCK_ID"] == D_EXPERTS_ANSWERS) {
			$ELEMENT_ID = $arFields["ID"];
			$IBLOCK_ID = $arFields["IBLOCK_ID"];
			if (strlen($arFields["ACTIVE_FROM"]) == 0)
				$arFields["ACTIVE_FROM"] = date("d.m.Y");
			if (!strlen($arFields["NAME"])>0)
				$arFields["NAME"] = "Новый вопрос от ".date("d.m.Y H:i:s");
		}
	}
	static function OnAfterIBlockElementUpdateHandlerN(&$arFields)
    {
		global $DB, $USER;

		/**
		* D_HISTORY_CALENDAR
		*
		*
		 */
		if($arFields["IBLOCK_ID"] == D_HISTORY_CALENDAR) {
			$arSelect = array("ID", "PROPERTY_EVENT_FULL_DATE");
			$arFilter = array("ID"=>$arFields["ID"], "IBLOCK_ID"=>D_HISTORY_CALENDAR);
			$res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
			while($ob = $res->GetNextElement())
			{
				$ar_fields = $ob->GetFields();
				$site_format = CSite::GetDateFormat(); // DD.MM.YYYY HH:MI:SS
				if ($arr = ParseDateTime($ar_fields['PROPERTY_EVENT_FULL_DATE_VALUE'], $site_format))
				{
					$arArray['EVENT_DAY'] = $arr["DD"];
					$arArray['EVENT_MONTH'] = $arr["MM"];
					$arArray['EVENT_YEAR'] = $arr["YYYY"];
					CIBlockElement::SetPropertyValuesEx($arFields["ID"], D_HISTORY_CALENDAR, $arArray);
				}
			}
		}/* D_HISTORY_CALENDAR ENDS */

		/**
		* D_TEMPCATALOG_IBLOCK
		*
		*
		 */
		if($arFields["IBLOCK_ID"] == D_TEMPCATALOG_IBLOCK) {
			$arSelect = array("ID", "PROPERTY_PP_COURSE.ID", "PROPERTY_PP_COURSE.NAME", "PROPERTY_PP_COURSE.CODE", "PROPERTY_PP_COURSE_CODE");
			$arFilter = array("ID"=>$arFields["ID"], "IBLOCK_ID"=>D_TEMPCATALOG_IBLOCK);
			$res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
			while($ob = $res->GetNextElement())
			{
				$ar_fields = $ob->GetFields();
				if ($ar_fields['PROPERTY_PP_COURSE_CODE_VALUE'] !== $ar_fields['PROPERTY_PP_COURSE_CODE']){
					CIBlockElement::SetPropertyValuesEx($arFields["ID"], D_TEMPCATALOG_IBLOCK, array("PP_COURSE_CODE" => $ar_fields['PROPERTY_PP_COURSE_CODE']));
				}
				if($arFields["NAME"] !==  $ar_fields['PROPERTY_PP_COURSE_CODE']." ".$ar_fields['PROPERTY_PP_COURSE_NAME']){
					$el = new CIBlockElement;
					$r = $el->Update($arFields["ID"], array("NAME" =>$ar_fields['PROPERTY_PP_COURSE_CODE']." ".$ar_fields['PROPERTY_PP_COURSE_NAME'] ), false, false, false);
				}
			}
		}/* D_TEMPCATALOG_IBLOCK ENDS */

		/**
		* D_TEMPCATALOG_DIRECTIONS_IBLOCK
		*
		*
		 */
		if($arFields["IBLOCK_ID"] == D_TEMPCATALOG_DIRECTIONS_IBLOCK) {
			$arSelect = array("ID", "PROPERTY_PP_COURSE.ID", "PROPERTY_PP_COURSE.NAME", "PROPERTY_PP_COURSE.CODE", "PROPERTY_PP_COURSE_CODE");
			$arFilter = array("ID"=>$arFields["ID"], "IBLOCK_ID"=>D_TEMPCATALOG_DIRECTIONS_IBLOCK);
			$res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
			while($ob = $res->GetNextElement())
			{
				$ar_fields = $ob->GetFields();
				if ($ar_fields['PROPERTY_PP_COURSE_CODE_VALUE'] !== $ar_fields['PROPERTY_PP_COURSE_CODE']){
					CIBlockElement::SetPropertyValuesEx($arFields["ID"], D_TEMPCATALOG_DIRECTIONS_IBLOCK, array("PP_COURSE_CODE" => $ar_fields['PROPERTY_PP_COURSE_CODE']));
				}
				if($arFields["NAME"] !==  $ar_fields['PROPERTY_PP_COURSE_CODE']." ".$ar_fields['PROPERTY_PP_COURSE_NAME']){
					$el = new CIBlockElement;
					$r = $el->Update($arFields["ID"], array("NAME" =>$ar_fields['PROPERTY_PP_COURSE_CODE']." ".$ar_fields['PROPERTY_PP_COURSE_NAME'] ), false, false, false);
				}
			}
		}/* D_TEMPCATALOG_DIRECTIONS_IBLOCK ENDS */

        /**
		* D_EXPERTS_ANSWERS
		*
		*
		 */
		if($arFields["IBLOCK_ID"] == D_EXPERTS_ANSWERS) {
			$arSelect = array(
				"ID",
				"ACTIVE",
				"PROPERTY_ANSW_QUESTION",
				"IBLOCK_SECTION_ID",
				"IBLOCK_SECTION_ID.NAME",
				"PROPERTY_ANSW_COMMENTS",
				"PROPERTY_ANSW_NAME",
				"PROPERTY_ANSW_EMAIL",
				"PROPERTY_ANSW_IS_SEND",
				"PROPERTY_ANSW_ID_EXPERT",
				"PREVIEW_TEXT",
				"DETAIL_TEXT",
				);
			$arFilter = array("ID"=>$arFields["ID"], "IBLOCK_ID"=>D_EXPERTS_ANSWERS);
			$res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
			while($ob = $res->GetNextElement())
			{
				$ar_fields = $ob->GetFields();
				$arSend['ANSW_ID'] = $ar_fields['ID'];
				$arSend['ANSW_ACTIVE'] = $ar_fields['ACTIVE'];
				$arSend['ANSW_QUESTION'] = $ar_fields['PROPERTY_ANSW_QUESTION_VALUE'];
				$arSend['ANSW_COMMENTS'] = $ar_fields['PROPERTY_ANSW_COMMENTS_VALUE'];
				$arSend['ANSW_NAME'] = $ar_fields['PROPERTY_ANSW_NAME_VALUE'];
				$arSend['ANSW_EMAIL'] = $ar_fields['PROPERTY_ANSW_EMAIL_VALUE'];
				$arSend['ANSW_IS_SEND'] = $ar_fields['PROPERTY_ANSW_IS_SEND_VALUE'];
				$arSend['ANSW_IS_SEND_ENUM_ID'] = $ar_fields['PROPERTY_ANSW_IS_SEND_ENUM_ID'];
				$arSend['ANSW_ID_EXPERT'] = $ar_fields['PROPERTY_ANSW_ID_EXPERT_VALUE'];
				$arSend['ANSW_GROUP_ID'] = $ar_fields['IBLOCK_SECTION_ID'];
				$arSend['ANSW_PREVIEW_TEXT'] = $ar_fields['PREVIEW_TEXT'];
				$arSend['ANSW_DETAIL_TEXT'] = $ar_fields['DETAIL_TEXT'];
				}
			$res = CIBlockSection::GetByID($arSend['ANSW_GROUP_ID']);
			if($ar_res = $res->GetNext())
				$arSend['ANSW_GROUP_NAME'] = $ar_res['NAME'];
			if($GLOBALS['APPLICATION']->GetCurPage() !=='/bitrix/admin/iblock_element_edit.php')
			{
				CEvent::Send('ELEMENTS_AFTER_ADD',SITE_ID, $arSend, 'N', T_EMAIL_QUESTIONS_TO_LTR);
			}

			if($GLOBALS['APPLICATION']->GetCurPage() =='/bitrix/admin/iblock_element_edit.php')
			{
				if ($arSend['ANSW_IS_SEND_ENUM_ID'] == ENUM_SEND_INFO_ANSWER){
					if ($arSend['ANSW_DETAIL_TEXT'] && $arSend['ANSW_ACTIVE'] == "Y") {
						CEvent::Send('ELEMENTS_AFTER_ADD',SITE_ID, $arSend, 'N', T_EMAIL_QUESTIONS_TO_AUTHOR);
					}
					CIBlockElement::SetPropertyValuesEx($arSend["ANSW_ID"], false, array("ANSW_IS_SEND" => ""));
				}
			}
		}/* D_EXPERTS_ANSWERS ENDS */


		/**
		* D_TIMETABLE_ID_IBLOCK
		*
		* в Расписании курсов полю код курса присваиваем его значение
		*
		* кроме того создадим триггер - связка расписание курсов - эксперт
		* при создании курса в расписании нужно обновить карточку курса для тренера если этот курс он читает впервые
		 */

		if($arFields["IBLOCK_ID"] == D_TIMETABLE_ID_IBLOCK) {
			$ELEMENT_ID = $arFields["ID"];
			$IBLOCK_ID = $arFields["IBLOCK_ID"];
			$arInfo = GetFullInfoAboutCourse($arFields["ID"]);

			if (($arInfo["COURSE_CODE_IN_TIMETABLE"] !== $arInfo["COURSE_CODE"])  || (strlen($arInfo["ID_COURSE_TYPE"]) == 0)){
				$arSelectCourse = Array("ID", "PROPERTY_COURSE_IDCATEGORY");
				$arFilterCourse = Array("IBLOCK_ID"=>D_COURSE_ID_IBLOCK, "ID"=>$arInfo["ID_COURSE"]);
				$resCourse = CIBlockElement::GetList(Array(), $arFilterCourse, false, false, $arSelectCourse);
				while($ar_fieldsCourse = $resCourse->GetNext())
				{
					CIBlockElement::SetPropertyValuesEx($arFields["ID"], D_TIMETABLE_ID_IBLOCK, array("schedule_course_type" => $ar_fieldsCourse["PROPERTY_COURSE_IDCATEGORY_VALUE"], "course_code" => $arInfo["COURSE_CODE"]));
				}
			}

			if ((strlen($arInfo["SCHEDULE_DURATION"]) == 0) || (strlen($arInfo["SCHEDULE_PRICE"]) == 0)){

					$arSelectCourse = Array("ID", "PROPERTY_COURSE_PRICE", "PROPERTY_COURSE_PRICE_UA", "PROPERTY_COURSE_DURATION");
					$arFilterCourse = Array("IBLOCK_ID"=>D_COURSE_ID_IBLOCK, "ID"=>$arInfo["ID_COURSE"]);
					$resCourse = CIBlockElement::GetList(Array(), $arFilterCourse, false, false, $arSelectCourse);
					while($ar_fieldsCourse = $resCourse->GetNext())
					{
					if (!$arInfo["SCHEDULE_PRICE"]) {
						$priceUA=round(($ar_fieldsCourse["PROPERTY_COURSE_PRICE_VALUE"]/35-$ar_fieldsCourse["PROPERTY_COURSE_PRICE_VALUE"]/35*0.3)/10)*10;
							$arVariables["schedule_price"]=fn_getMostNewCityPrice($ar_fieldsCourse["PROPERTY_COURSE_PRICE_VALUE"], $ar_fieldsCourse["PROPERTY_COURSE_PRICE_UA_VALUE"], $arInfo["ID_CITY"], $ar_fieldsCourse["PROPERTY_COURSE_DURATION_VALUE"]);
						/*if ($arInfo["ID_CITY"]==CITY_ID_MOSCOW) {
					      $arVariables["schedule_price"] = $ar_fieldsCourse["PROPERTY_COURSE_PRICE_VALUE"];
                       } elseif ($arInfo["ID_CITY"]==CITY_ID_SPB){
                          $arVariables["schedule_price"] = round(($ar_fieldsCourse["PROPERTY_COURSE_PRICE_VALUE"]-$ar_fieldsCourse["PROPERTY_COURSE_PRICE_VALUE"]/100*10)/10)*10;
                       } elseif ($arInfo["ID_CITY"]==CITY_ID_OMSK){
                          $arVariables["schedule_price"] = round(($ar_fieldsCourse["PROPERTY_COURSE_PRICE_VALUE"]-$ar_fieldsCourse["PROPERTY_COURSE_PRICE_VALUE"]/100*20)/10)*10;
                       } elseif ($arInfo["ID_CITY"]==CITY_ID_KIEV){
                          $arVariables["schedule_price"] = round($priceUA/2);
                       } elseif ($arInfo["ID_CITY"]==CITY_ID_ODESSA){
                          $arVariables["schedule_price"] = round(round(($priceUA-$priceUA/100*10)/10)*10/2.5);
                       } elseif ($arInfo["ID_CITY"]==CITY_ID_DNEPR){
                        $arVariables["schedule_price"] = round(round(($priceUA-$priceUA/100*20)/10)*10/2.5);
                       } else {
						 $arVariables["schedule_price"] = $ar_fieldsCourse["PROPERTY_COURSE_PRICE_VALUE"];
					   }*/

					}
					if (!$arInfo["SCHEDULE_DURATION"]){
						$arVariables["schedule_duration"] = $ar_fieldsCourse["PROPERTY_COURSE_DURATION_VALUE"];
					}
					CIBlockElement::SetPropertyValuesEx($arFields["ID"], D_TIMETABLE_ID_IBLOCK, $arVariables);

					}
			}


			if  ($arInfo["ID_TEACHER"]){
				$arSelectTeacher = Array("PROPERTY_COURSES","NAME", "ID");
				$arFilterTeacher = Array("IBLOCK_ID" =>D_EXPERT_ID_IBLOCK, "ID" => $arInfo["ID_TEACHER"]);
				$resTeacher = CIBlockElement::GetList(Array(), $arFilterTeacher, false, false, $arSelectTeacher);
				while($ar_fieldsTeacher = $resTeacher->GetNext())
				{
					if (in_array($arInfo["ID_TEACHER"], $ar_fieldsTeacher['PROPERTY_COURSES_VALUE'])) {
						// не делаем ничего ибо в базе уже существует
						// запись что он преподает данный курс
					} else {
						 $arCourses = $ar_fieldsTeacher['PROPERTY_COURSES_VALUE'];
						 $arCourses[] = $arInfo["ID_COURSE"];
						 //iwrite($arCourses);
						 foreach ($arCourses as  $valueCourse) {
							if (IsCourseActive($valueCourse)) {
								$arCoursesFormatted['courses'][] = array('VALUE' => $valueCourse);
							}
						 }
						 if (count($arCoursesFormatted['courses'])>0){
							CIBlockElement::SetPropertyValuesEx($arInfo["ID_TEACHER"], D_EXPERT_ID_IBLOCK, $arCoursesFormatted);
						 }
					}
				}
			}

			/*
			*	полю ACTIVE_TO, ACTIVE FROM, NAME присвоем значения
			*
			**/
			if (!$arInfo["ENDDATE"]){
				$arInfo["ENDDATE"] = $arInfo["STARTDATE"];
			}
			$arInfo["CURRENT_DATE"] = $arFields['ACTIVE_FROM'] ? $arFields['ACTIVE_FROM'] : date("d.m.Y");

			/*
			* так как Update вызывает событие OnAfterIBlockElementUpdate, нужно условие выхода
			*
			*/
			if(($arFields["NAME"] !==  $arInfo['COURSE_NAME']) || ($arInfo["ENDDATE"] !== $arFields['ACTIVE_TO'])) {
				$el = new CIBlockElement;
				$r = $el->Update($arFields["ID"],
				array(
					"NAME" =>$arInfo['COURSE_NAME'],
					"ACTIVE_FROM" =>$arInfo["CURRENT_DATE"],
					"ACTIVE_TO" =>$arInfo['ENDDATE']
				),
				false, false, false);
			}

        } /* D_TIMETABLE_ID_IBLOCK  ENDS*/
	}
}
