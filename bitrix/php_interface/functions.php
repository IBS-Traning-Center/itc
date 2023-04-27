<?

function checkUserGroup($groups, $userID = null) {
    global $USER;
    $result = false;
    if($userID == null) {
        $user_groups = $USER->GetGroups();
    } else {
        $user_groups = \CUser::GetUserGroup($userID);
    }
	$user_groups = explode(',', $user_groups);
    if($user_groups) {
        foreach ($user_groups as $user_group) {
            if(in_array($user_group, $groups)) {
				$result = true;
				break;
            }
        }
    }
    return $result;
}

function seconds2times($seconds)
{
    $times = array();

    // считать нули в значениях
    $count_zero = false;

    // количество секунд в году не учитывает високосный год
    // поэтому функция считает что в году 365 дней
    // секунд в минуте|часе|сутках|году
    $periods = array(60, 3600, 86400, 31536000);

    for ($i = 3; $i >= 0; $i--)
    {
        $period = floor($seconds/$periods[$i]);
        if (($period > 0) || ($period == 0 && $count_zero))
        {
            $times[$i+1] = $period;
            $seconds -= $period * $periods[$i];

            $count_zero = true;
        }
    }

    $times[0] = $seconds;
    return $times;
}
function CreateReccommend($USER_ID=0, $COURSE_ID=0, $CITY=0) {
	CModule::IncludeModule("iblock");
	if (intval($COURSE_ID)>0) {
	$arFilter = Array("IBLOCK_ID"=>94,  "PROPERTY_PP_COURSE"=> $COURSE_ID, "ACTIVE"=>"Y");
	$arSelect=array("ID", "NAME", "IBLOCK_SECTION_ID");
	$pes = CIBlockElement::GetList(Array("NAME"=>"ASC"), $arFilter, false, false, $arSelect);
	if ($arFields=$pes->GetNext()) {
		$category=$arFields["IBLOCK_SECTION_ID"];
	}
	$arSelect=array("NAME", "ID");
	$arFilter = Array("IBLOCK_ID"=>107,  "PROPERTY_USER"=> $USER_ID, "ACTIVE"=>"Y");
	$res = CIBlockElement::GetList(Array("NAME"=>"ASC"), $arFilter, false, false, $arSelect);
	if ($arFields=$res->GetNext()) {
		$PRODUCT_ID=$arFields["ID"];
	} else {
			$el = new CIBlockElement;
			$arLoadProductArray = Array(
				  "IBLOCK_SECTION_ID" => false,          // элемент лежит в корне раздела
				  "IBLOCK_ID"      => 107,
				  "NAME"           => $USER_ID."_reccomend",
				  "ACTIVE"         => "Y",            // активен
				  );

				if($PRODUCT_ID = $el->Add($arLoadProductArray))
				  echo $PRODUCT_ID;
				else
				  echo "Error: ".$el->LAST_ERROR;

		}
	}
	CIBlockElement::SetPropertyValuesEx($PRODUCT_ID, false, array("USER"=>$USER_ID, "COURSE"=>$COURSE_ID, "CATEGORY"=>$category, "CITY"=>$CITY));
}
function fn_externalID($ID){
/*
    if (CModule::IncludeModule("iblock")) {

        if (intval($ID)>0) {
            $res = CIBlockElement::GetByID($ID);
            if  ($ar_res = $res->GetNext()) {}
                if (($ar_res["XML_ID"]!= strtolower(codeTranslite($ar_res['NAME']))) and (strlen($ar_res["XML_ID"])>0)) {
                    //echo strlen($ar_res["XML_ID"]);
                    //echo imTranslite($ar_res['NAME']);
                    $arLoadProductArray=array("XML_ID" => strtolower(codeTranslite($ar_res['NAME'])));
                    $mel = new CIBlockElement;
                    if ($mel->Update($ID, $arLoadProductArray)) {
                        die;
                    } else {
                       echo $mel->LAST_ERROR;
                    }
                }



        }
    }
*/

}
/* узнает процент скидки из свойства применяет к отправленной цене и возращает цену со скидкой*/
function fn_GetCourseDis($ID, $price) {
    if (CModule::IncludeModule("iblock")) {
        $arSelect = array("ID", "PROPERTY_LINK_DISCOUNT");
        $arFilter = array("ID"=>$ID, "IBLOCK_ID"=>D_TIMETABLE_ID_IBLOCK, "ACTIVE"=> "Y");
        $res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
        if($item = $res->GetNext())
        {
            $discount=100-intval($item["PROPERTY_LINK_DISCOUNT_VALUE"]);
            $discount_price=$price*$discount/100;

        }
    }
    return $discount_price;
}

function codeTranslite($str){
// транслитерация корректно работает на страницах с любой кодировкой
// ISO 9-95
   static $tbl= array(
      'а'=>'a', 'б'=>'b', 'в'=>'v', 'г'=>'g', 'д'=>'d', 'е'=>'e', 'ж'=>'g', 'з'=>'z',
      'и'=>'i', 'й'=>'y', 'к'=>'k', 'л'=>'l', 'м'=>'m', 'н'=>'n', 'о'=>'o', 'п'=>'p',
      'р'=>'r', 'с'=>'s', 'т'=>'t', 'у'=>'u', 'ф'=>'f', 'ы'=>'y', 'э'=>'e', 'А'=>'A',
      'Б'=>'B', 'В'=>'V', 'Г'=>'G', 'Д'=>'D', 'Е'=>'E', 'Ж'=>'G', 'З'=>'Z', 'И'=>'I',
      'Й'=>'Y', 'К'=>'K', 'Л'=>'L', 'М'=>'M', 'Н'=>'N', 'О'=>'O', 'П'=>'P', 'Р'=>'R',
      'С'=>'S', 'Т'=>'T', 'У'=>'U', 'Ф'=>'F', 'Ы'=>'Y', 'Э'=>'E', 'ё'=>"yo", 'х'=>"h",
      'ц'=>"ts", 'ч'=>"ch", 'ш'=>"sh", 'щ'=>"shch", 'ъ'=>"", 'ь'=>"", 'ю'=>"yu", 'я'=>"ya",
      'Ё'=>"YO", 'Х'=>"H", 'Ц'=>"TS", 'Ч'=>"CH", 'Ш'=>"SH", 'Щ'=>"SHCH", 'Ъ'=>"", 'Ь'=>"",
      'Ю'=>"YU", 'Я'=>"YA", ' '=>"_", '№'=>"", '«'=>"", '»'=>"", '—'=>"-", "/"=> "-", '"'=>"", "&quot;"=>"", "."=>"",
       "("=>"", ")"=>"", ","=>"", "?"=>"", "+"=> "plus", ":"=>"", "#"=>"", "&"=>"",  "“" => "", "”"=>"", "–"=>"-"
   );
    return strtr($str, $tbl);
}
/* устанавливаем скидку на курс в расписании */
function fn_randomDiscount($ID, $long=0){
    if(CModule::IncludeModule("iblock")){
        if (intval($ID)>0) {
            if (intval($long)==0){
                $val=rand(0,1);
            } else {
                if ($long>=20) {
                   $val=1;
                } else {
                    $val=0;
                }
            }
            $discount=0;
            if ($val==1){
                $discount=5;
            } else {
                $discount=3;
            }
          CIBlockElement::SetPropertyValuesEx($ID, false, array( "LINK_DISCOUNT" => $discount));
        }
    }
}
//получаем ID способа оплаты по ID заявки на курс
/*возращает массив:
(
    [TIMETABLE_ID] => 20084    ID курса в расписании
    [PAYMENT_ID] => 124        метод оплаты: 124 - Не определен; 125  - online; 126 - договор;
)*/
function GetIDMethodPayment($ID){
	if(CModule::IncludeModule("iblock")){
		$arIDMethodPayment = array();
		$arSelect = array("ID", "PROPERTY_TIMETABLE_ID", "PROPERTY_PAYMENT_ID");
		$arFilter = array("ID"=>$ID, "IBLOCK_ID"=>D_RECORDS_IBLOCK, "ACTIVE"=> "Y");
		$res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
		while($ob = $res->GetNextElement())
		{
			$ar_fields = $ob->GetFields();
			$arIDMethodPayment["TIMETABLE_ID"] = $ar_fields["PROPERTY_TIMETABLE_ID_VALUE"];
			$arIDMethodPayment["PAYMENT_ID"] = $ar_fields["PROPERTY_PAYMENT_ID_ENUM_ID"];
		}
	}
	return $arIDMethodPayment;
}
/*Возвращает количество активных классов*/
function fn_activeClassCount(){
    if (CModule::IncludeModule("iblock")) {
        $arGroupBy  = Array();
        $arOrder = Array();
        $arSelectFields = Array("ID");
        $arFilter = Array("IBLOCK_ID"=>D_TIMETABLECLASSES_ID_IBLOCK, "ACTIVE"=>"Y", ">=PROPERTY_startdate" => date("Y-m-d"));
        $count = CIBlockElement::GetList($arOrder, $arFilter, $arGroupBy, false, $arSelectFields);
        return $count;
    }
}


function GetInfoRecordByID($ID){
	if(CModule::IncludeModule("iblock")){
		$arSelect = array(
			"ID",
			"NAME",
			"PROPERTY_TIMETABLE_ID",
			"PROPERTY_PAYMENT_ID",
			"PROPERTY_ID_CITY_ORDER",
			"PROPERTY_FULLNAME",
			"PROPERTY_EMAIL",
			"PROPERTY_TYPE",
			"PROPERTY_DATE",
			"PROPERTY_COMPANY",
			"PROPERTY_TELEPHONE",
			"PROPERTY_CITY",
			"PROPERTY_DOLGNOST",
			"PROPERTY_EVENT_CITY",
			"PROPERTY_EVENT_ID",
			"PROPERTY_COMMENT"
		);
		$arFilter = array("ID"=>$ID, "IBLOCK_ID"=>D_RECORDS_IBLOCK);
		$res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
		while($ob = $res->GetNextElement())
		{
			$ar_fields = $ob->GetFields();
			$arInfo = bitrixCleaningArray($ar_fields, true);
		}
		return $arInfo;
	}
}
//получаем ID + NAME  классов (которые в расписании) по ID курса в расписании
//придется перебирать ибо список курсов хранится в виде сериализованного массива
//возвразается  массив вида
/*Array
(
    [14] => Array
        (
            [ID] => 20632
            [NAME] =>  Класс системного аналитика. Разработка проекта системы на UML (онлайн)
        )

    [15] => Array
        (
            [ID] => 20640
            [NAME] =>  Класс тестировщика (онлайн)
        )

)*/
  function GetArrClassesContainsThisCourse($ID){
	if(CModule::IncludeModule("iblock")){
		global $DB;
		$arSearchClasses = array();
		$arSelect = array("ID", "NAME", "PROPERTY_STARTDATE","PROPERTY_ENDDATE", "PROPERTY_PRSCHEDULE_COURSES");
		$arFilter = array(
			"IBLOCK_ID"=>D_TIMETABLECLASSES_ID_IBLOCK,
			"ACTIVE"=> "Y",
			">=PROPERTY_STARTDATE" => ConvertDateTime(date($DB->DateFormatToPHP(CSite::GetDateFormat("SHORT")), time()), "YYYY-MM-DD", "ru")
		);
		$res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
		$index = 0 ;
		while($ob = $res->GetNextElement())
		{
			//iwrite($ar_fields);
			$ar_fields = $ob->GetFields();
   		  	$arUnserClassesContent = unserialize($ar_fields["~PROPERTY_PRSCHEDULE_COURSES_VALUE"]);
		    foreach ($arUnserClassesContent as $arClassContent) {
	           	//если есть совпадения
            	//то добавляем в итоговый выходной массив
            	if ($arClassContent['VALUE'] == $ID ) {
            		$arSearchClasses[$index]["ID"] = $ar_fields['ID'];
					$arSearchClasses[$index]["NAME"] = $ar_fields['NAME'];
					$arSearchClasses[$index]["STARTDATE"] = $ar_fields['PROPERTY_STARTDATE_VALUE'];
					$arSearchClasses[$index]["ENDDATE"] = $ar_fields['PROPERTY_ENDDATE_VALUE'];
            	}
			}
    		$index = $index + 1;
		}
	}
	return $arSearchClasses;
}

function getClassFullInfo($idClass)
{
	CModule::IncludeModule("iblock");
	$arFilter = Array("IBLOCK_ID"=>D_TIMETABLECLASSES_ID_IBLOCK, "ID"=>$idClass );
	$arSelectFields = Array("ID", "NAME", "PROPERTY_CITY", "PROPERTY_CITY.NAME", "PROPERTY_STARTDATE",
	 "PROPERTY_ENDDATE", "PROPERTY_PRSCHEDULE_TIME", "PROPERTY_PRSCHEDULE_COURSES", "PROPERTY_PRSCHEDULE_PRICE"
	);
	$res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelectFields);
	while($ob = $res->GetNextElement())
	{
		$arFields = $ob->GetFields();
		//print_r($arFields);
	}
	$fullClassInfo = "<p>В рамках класса будут проведены следующие курсы:</p>";
	$prschedule_courses = unserialize($arFields['~PROPERTY_PRSCHEDULE_COURSES_VALUE']);
	foreach ($prschedule_courses as $v1) {
		foreach ($v1 as $key => $value) {
			if ($key==="VALUE" ){
				$rty[] = "$value";
				$id_value =$value;
				$rty[] = $value;
			}
			if ($key==="DURATION" ){
				$duration = $value;
			}
			if ($key==="PRICE" ){
				$price =$value;
			}
			$arProgramsInfo["$id_value"]["duration"] = $duration;
			$arProgramsInfo["$id_value"]["price"] = $price;
		}
	}

	foreach ($arProgramsInfo as $key => $arValue) {
		$arSelectFields = Array("ID", "NAME", "PROPERTY_COURSE_CODE", "PROPERTY_SCHEDULE_COURSE", "PROPERTY_STARTDATE", "PROPERTY_ENDDATE", "PROPERTY_SCHEDULE_TIME");
		$arFilter = Array("IBLOCK_ID"=>D_TIMETABLE_ID_IBLOCK, "ACTIVE"=>"Y", "ID" => $key);
		$arOrder = Array("PROPERTY_STARTDATE" => "ASC");
		$res = CIBlockElement::GetList($arOrder, $arFilter, false, false, $arSelectFields);
		$index = 0;
		while($ob = $res->GetNextElement())
		{
			$arFieldsCourse = $ob->GetFields();//print_r($arFields);
			$pp_id = $key;
			$pp_duration =  $arProgramsInfo["$key"]["duration"];
			$pp_price =  $arProgramsInfo["$key"]["price"];
			$prschedule_startdate = $arFieldsCourse['PROPERTY_STARTDATE_VALUE'];
			$prschedule_enddate = $arFieldsCourse['PROPERTY_ENDDATE_VALUE'];
			if ($prschedule_enddate == "") { } else  {$prschedule_startdate .= " - " . $prschedule_enddate;}
			$fullClassInfo .= "<p>Курс: <strong>".$arFieldsCourse['NAME']."</strong><br/>";
			$fullClassInfo .= "Дата проведения: ".$prschedule_startdate."<br/>";
			$fullClassInfo .= "Время: ".$arFieldsCourse['PROPERTY_SCHEDULE_TIME_VALUE']."<br/>";
			$fullClassInfo .= "Стоимость: ".$arProgramsInfo[$key]['price']."</p>";
		}
	}
		$fullClassInfo .= "Общая стоимость: ".$arFields['PROPERTY_PRSCHEDULE_PRICE_VALUE'];
		return $fullClassInfo;
}

/*
IsCourseActive
Активен ли курс по карточке
*/
function IsCourseActive($ID){
	if(CModule::IncludeModule("iblock")){
		$arInfo = array();
		$arSelect = array(
		 "ID",
		 "ACTIVE",
		 );
		$arFilter = array("ID"=>$ID, "IBLOCK_ID"=>D_COURSE_ID_IBLOCK);
		$res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
		while($ob = $res->GetNextElement())
		{
			$ar_fields = $ob->GetFields();
			$arInfo["ACTIVE"] = $ar_fields["ACTIVE"];
			if ($arInfo["ACTIVE"] == "Y")
				return true;
			 else
				return false;

		}
	}
}
/*
GetCourseInfoByID
информация о курсе по его ID в в списке курссов - инфо-карточка курса
*/
function GetCourseInfoByID($ID){
	if(CModule::IncludeModule("iblock")){

	}
}


/*
GetFullInfoAboutCourse
информация о курсе по его ID в расписании
*/
function GetFullInfoAboutCourse($ID){
	if(CModule::IncludeModule("iblock")){
		$arInfo = array();
		$arSelect = array(
		 "ID",
		 "DETAIL_PAGE_URL",
		 "PROPERTY_CITY",
		 "ACTIVE",
		 "PROPERTY_IS_CLOSE",
		 "PROPERTY_CAN_BUY",
		 "PROPERTY_CITY.NAME",
		 "PROPERTY_SCHEDULE_COURSE",
		 "PROPERTY_SCHEDULE_COURSE.CODE",
		 "PROPERTY_SCHEDULE_COURSE.NAME",
		 "PROPERTY_SCHEDULE_COURSE.PROPERTY_COURSE_PRICE_UA",
         "PROPERTY_STARTDATE",
         "PROPERTY_ENDDATE",
         "PROPERTY_SCHEDULE_TIME",
         "PROPERTY_SCHEDULE_DURATION",
         "PROPERTY_SCHEDULE_COURSE_TYPE",
         "PROPERTY_SCHEDULE_COURSE_TYPE.NAME",
         "PROPERTY_TEACHER",
         "PROPERTY_TEACHER.NAME",
		 "PROPERTY_SCHEDULE_PRICE",
		 "PROPERTY_COURSE_CODE",
		 "CREATED_BY",
		 "CATALOG_GROUP_1"
		 );
		$arFilter = array("ID"=>$ID, "IBLOCK_ID"=>D_TIMETABLE_ID_IBLOCK);
		$res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
		while($ob = $res->GetNextElement())
		{
			$ar_fields = $ob->GetFields();
			/*echo "<pre>";
			print_r($ar_fields);
			echo "</pre>";*/
			if ($ar_fields["ACTIVE"]=="Y") {
                $arInfo["ACTIVE"]="Да";
            } else {
                $arInfo["ACTIVE"]="Нет";
            }
            if (strlen($ar_fields["PROPERTY_IS_CLOSE_VALUE"])>0) {
                $arInfo["IS_CLOSE"]="ДА";
            } else {
                $arInfo["IS_CLOSE"]="Нет";
            }
			$rsUser = CUser::GetByID($ar_fields["CREATED_BY"]);
			$arUser = $rsUser->Fetch();
			$arInfo["ID_CITY"] = $ar_fields["PROPERTY_CITY_VALUE"];
			$arInfo["CITY_NAME"] = $ar_fields["PROPERTY_CITY_NAME"];
			$arInfo["CREATED_BY"] = $ar_fields["CREATED_BY"];
			$arInfo["CREATED_NAME"] =$arUser["LAST_NAME"]." ".$arUser["NAME"]." [".$arUser["EMAIL"]."] ";
			$arInfo["ID_COURSE"] = $ar_fields["PROPERTY_SCHEDULE_COURSE_VALUE"];
			$arInfo["STARTDATE"] = $ar_fields["PROPERTY_STARTDATE_VALUE"];
			$arInfo["ENDDATE"] = $ar_fields["PROPERTY_ENDDATE_VALUE"];
			$arInfo["COURSE_CODE"] = $ar_fields["PROPERTY_SCHEDULE_COURSE_CODE"];
			$arInfo["CAN_BUY"] = $ar_fields["PROPERTY_CAN_BUY"];
			$arInfo["COURSE_CODE_IN_TIMETABLE"] = $ar_fields["PROPERTY_COURSE_CODE_VALUE"];
			$arInfo["COURSE_NAME"] = $ar_fields["PROPERTY_SCHEDULE_COURSE_NAME"];
			$arInfo["SCHEDULE_TIME"] = $ar_fields["PROPERTY_SCHEDULE_TIME_VALUE"];
			$arInfo["SCHEDULE_PRICE"] = $ar_fields["PROPERTY_SCHEDULE_PRICE_VALUE"];
			$arInfo["COURSE_NAME"] = $ar_fields["PROPERTY_SCHEDULE_COURSE_NAME"];
			$arInfo["SCHEDULE_DURATION"] = $ar_fields["PROPERTY_SCHEDULE_DURATION_VALUE"];
			$arInfo["ID_COURSE_TYPE"] = $ar_fields["PROPERTY_SCHEDULE_COURSE_TYPE_VALUE"];
			//$arInfo["COURSE_TYPE_NAME"] = $ar_fields["PROPERTY_SCHEDULE_COURSE_TYPE_NAME"];
			$arInfo["ID_TEACHER"] = $ar_fields["PROPERTY_TEACHER_VALUE"];
			$arInfo["PRICE_ONLY"]=intval($ar_fields["CATALOG_PRICE_1"]);
			$arInfo["PRICE"] = intval($ar_fields["CATALOG_PRICE_1"])." ".$ar_fields["CATALOG_CURRENCY_1"];
			$arInfo["TEACHER_NAME"] = $ar_fields["PROPERTY_TEACHER_NAME"];
			$arInfo["ID_TIME"] = $ar_fields["ID"];
			$arInfo["DETAIL_PAGE_URL"] = $ar_fields["DETAIL_PAGE_URL"];
			//$arInfo["ID_COURSE_OWNER"] = $ar_fields["PROPERTY_ID_COURSE_OWNER_ENUM_ID"];
			$arInfo["TYPE"] = "COURSE";
		}

		if(empty($arInfo["SCHEDULE_DURATION"]) && !empty($arInfo["ID_COURSE"])) {
            $arSelect = array(
                "ID", "PROPERTY_COURSE_DURATION"
            );
            $arFilter = array("ID"=>$arInfo["ID_COURSE"], "IBLOCK_ID"=>D_COURSE_ID_IBLOCK);
            $res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
            if($ob = $res->GetNext() && !empty($ob['PROPERTY_COURSE_DURATION_VALUE'])) {
                $arInfo["SCHEDULE_DURATION_COURSE"] = $ob['PROPERTY_COURSE_DURATION_VALUE'];
            }
        }

	}
	return $arInfo;
}
function GetListCoursesOfArrayByDateASC($arCourses){
	if(CModule::IncludeModule("iblock")){
		$arInfo = array();
		$arSelect = array(
		 "ID",
		 );
		$arFilter = array("ID"=>$arCourses, "IBLOCK_ID"=>D_TIMETABLE_ID_IBLOCK, "ACTIVE"=> "Y");
		$res = CIBlockElement::GetList(array("PROPERTY_STARTDATE" => "ASC"), $arFilter, false, false, $arSelect);
		while($ob = $res->GetNextElement())
		{
			$ar_fields = $ob->GetFields();
			$arInfo["ID"] = $ar_fields["ID"];
			$arCoursesN[] = $arInfo["ID"];
		}
	}
	return $arCoursesN;
}


function GetFullInfoAboutClass($ID){
	if(CModule::IncludeModule("iblock")){
		$arInfo = array();
		$arSelect = array(
		 "ID",
		 "PROPERTY_CITY",
		 "PROPERTY_CITY.NAME",
         "PROPERTY_STARTDATE",
         "PROPERTY_ENDDATE",
         "PROPERTY_PRSCHEDULE_TIME",
         "PROPERTY_PRSCHEDULE_DURATION",

		 );
		$arFilter = array("ID"=>$ID, "IBLOCK_ID"=>D_TIMETABLECLASSES_ID_IBLOCK, "ACTIVE"=> "Y");
		$res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
		while($ob = $res->GetNextElement())
		{
			$ar_fields = $ob->GetFields();
			//iwrite($ar_fields);
			$arInfo["ID_CITY"] = $ar_fields["PROPERTY_CITY_VALUE"];
			$arInfo["CITY_NAME"] = $ar_fields["PROPERTY_CITY_NAME"];
			$arInfo["ID_COURSE"] = $ar_fields["PROPERTY_SCHEDULE_COURSE_VALUE"];
			$arInfo["STARTDATE"] = $ar_fields["PROPERTY_STARTDATE_VALUE"];
			$arInfo["ENDDATE"] = $ar_fields["PROPERTY_ENDDATE_VALUE"];
			$arInfo["ID_CLASS"] = $ar_fields["ID"];
			$arInfo["TYPE"] = "CLASS";
			$arInfo["SCHEDULE_TIME"] = $ar_fields["PROPERTY_PRSCHEDULE_TIME_VALUE"];
		}
	}
	return $arInfo;
}


/*
получаем инфо по заказу
GetOrderIDInfo
на выходе имеем след массив:
Array
(
    [0] => Array
        (
            [TYPE] => COURSE
            [ID_TIME] => 21225
            [TEACHER_NAME] => Александров
            [ID_TEACHER] => 11130
            [SCHEDULE_TIME] => 10:00-19:00
            [COURSE_CODE] => TST-012
            [ENDDATE] =>
            [STARTDATE] => 23.11.2010
            [ID_COURSE] => 6090
            [CITY_NAME] => Санкт-Петербург
            [ID_CITY] => 5744
        )

    [1] => Array
        (
            [TYPE] => COURSE
            [ID_TIME] => 21228
            [TEACHER_NAME] => Александров
            [ID_TEACHER] => 11130
            [SCHEDULE_TIME] => 15:00-19:00
            [COURSE_CODE] => TST-002
            [ENDDATE] =>
            [STARTDATE] => 24.11.2010
            [ID_COURSE] => 6096
            [CITY_NAME] => Санкт-Петербург
            [ID_CITY] => 5744
        )

*/
function GetOrderIDInfo($ORDER_ID){
	$db_basket = CSaleBasket::GetList(($b="NAME"), ($o="ASC"), array("ORDER_ID"=>$ORDER_ID));
	$index = 0 ;
	while ($arItems = $db_basket->Fetch())
	{
		//iwrite($arItems)
		$dbBasketProps = CSaleBasket::GetPropsList(
			array("SORT" => "ASC", "ID" => "DESC"),
			array(
					"BASKET_ID" => $arItems["ID"],
					"!CODE" => array("CATALOG.XML_ID", "PRODUCT.XML_ID")
				),
			false,
			false,
			array("NAME", "VALUE")
		);
		while($arBasketPropsTmp = $dbBasketProps->GetNext())
		{
				$arOrderIDInfo[$index][$arBasketPropsTmp['NAME']] = $arBasketPropsTmp["VALUE"];
		}
		$index = $index + 1;
	}
	return $arOrderIDInfo;

}

function GetListIDCoursesByExpertID($vIDExpert){
	if(CModule::IncludeModule("iblock")){
		$arInfo = array();
		$arSelect = array(
		 "ID",
		 "PROPERTY_COURSES"
		 );
		$arFilter = array("ID"=>$vIDExpert, "IBLOCK_ID"=>D_EXPERT_ID_IBLOCK, "ACTIVE"=> "Y");
		$res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
		while($ob = $res->GetNextElement())
		{
			$ar_fields = $ob->GetFields();
			//iwrite($ar_fields);
			$arListCoursesID = $ar_fields['PROPERTY_COURSES_VALUE'];
		}
	}
	return $arListCoursesID;
}

function GetInfoAboutExpertByID($vIDExpert){
	$arInfo = array();
	if(CModule::IncludeModule("iblock")){
		if ($vIDExpert > 0) {
			$arFilter = array("IBLOCK_ID"=>D_EXPERT_ID_IBLOCK, "ID"=>$vIDExpert);
			$arSelectFields = array(
				"ID",
				"NAME",
				"CODE",
				"PROPERTY_EXPERT_NAME",
				"PROPERTY_EXPERT_SHORT",
				"PROPERTY_EXPERT_TITLE"
			);
			$res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelectFields);

			while($ob = $res->GetNextElement())
			{
				$arFields = $ob->GetFields();
				$arInfo['EXPERT_ID'] = $arFields['ID'];
				$arInfo['EXPERT_NAME'] = $arFields['NAME'];
				$arInfo['EXPERT_NAME_FULL'] = $arFields['PROPERTY_EXPERT_NAME_VALUE'];
				$arInfo['EXPERT_SHORT'] = $arFields['PROPERTY_EXPERT_SHORT_VALUE'];
				$arInfo['EXPERT_TITLE'] = $arFields['PROPERTY_EXPERT_TITLE_VALUE'];
				$arInfo['EXPERT_CODE'] = $arFields['CODE'];
			}
		} else { return false;}
	}
	return $arInfo;
}


function GetCoursesNamesCodesByArray($arCoursesID){
	if(CModule::IncludeModule("iblock")){
		$arInfo = array();
		$arSelect = array(
			"NAME",
			"CODE",
			"ID"
		);
		$arFilter = array("ID"=>$arCoursesID, "IBLOCK_ID"=>D_COURSE_ID_IBLOCK, "ACTIVE"=> "Y");
		$res = CIBlockElement::GetList(array("RAND" => "ASC"), $arFilter, false, false, $arSelect);
		$index = 0;
		while($ob = $res->GetNextElement())
		{
			$ar_fields = $ob->GetFields();
			$arCoursesNamesCodes[$index]['ID'] = $ar_fields['ID'];
			$arCoursesNamesCodes[$index]['CODE'] = $ar_fields['CODE'];
			$arCoursesNamesCodes[$index]['NAME'] = $ar_fields['NAME'];
			$index = $index + 1;
		}
	}
	return $arCoursesNamesCodes;
}


function GetLinkedCoursesArray($ID){
	if(CModule::IncludeModule("iblock")){
		$arLinkedCourses = array();
		$arSelect = array(
			"ID",
			"PROPERTY_ID_LINKED_COURSES"
		);
		$arFilter = array("ID"=>$ID, "IBLOCK_ID"=>D_COURSE_ID_IBLOCK, "ACTIVE"=> "Y");
		$res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
		while($ob = $res->GetNextElement())
		{
			$ar_fields = $ob->GetFields();
			$arLinkedCourses = $ar_fields['PROPERTY_ID_LINKED_COURSES_VALUE'];
		}
	}
	return $arLinkedCourses;
}
function GetPredvCoursesArray($ID){
	if(CModule::IncludeModule("iblock")){
		$arPredvCourses = array();
		$arSelect = array(
			"ID",
			"PROPERTY_ID_PREDV_COURSES"
		);
		$arFilter = array("ID"=>$ID, "IBLOCK_ID"=>D_COURSE_ID_IBLOCK, "ACTIVE"=> "Y");
		$res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
		while($ob = $res->GetNextElement())
		{
			$ar_fields = $ob->GetFields();
			$arPredvCourses = $ar_fields['PROPERTY_ID_PREDV_COURSES_VALUE'];
		}
	}
	return $arPredvCourses;
}





/*
GetAllTimetableCoursesArray
получаем массив связанных курсов  и то каогда они стоят в расписании
Array
(
    [0] => Array
        (
            [COURSE_ID] => 6088
            [COURSE_NAME] => Практические рекомендации по проектированию тестов
            [COURSE_CODE] => TST-016
            [COURSE_DURATION] => 6
            [COURSE_FORMAT_ID] => Очный
            [TIMETABLE] => Array
                (
                    [0] => Array
                        (
                            [TIMETABLE_ID] => 21229
                            [TIMETABLE_NAME] => Практические рекомендации по проектированию тестов
                            [TIMETABLE_STARTDATE] => 25.11.2010
                            [TIMETABLE_ENDDATE] =>
                            [TIMETABLE_CITY_NAME] => Санкт-Петербург
                            [TIMETABLE_CITY_ID] => 5744
                            [TIMETABLE_DURATION] => 6
                        )

                )

        )

    [1] => Array
        (
            [COURSE_ID] => 6086
            [COURSE_NAME] => Usability Testing
            [COURSE_CODE] => TST-019
            [COURSE_DURATION] => 8
            [COURSE_FORMAT_ID] => Очный
            [TIMETABLE] => Array
                (
                    [0] => Array
                        (
                            [TIMETABLE_ID] => 21287
                            [TIMETABLE_NAME] => Usability Testing
                            [TIMETABLE_STARTDATE] => 08.12.2010
                            [TIMETABLE_ENDDATE] => 09.12.2010
                            [TIMETABLE_CITY_NAME] => Омск
                            [TIMETABLE_CITY_ID] => 5742
                            [TIMETABLE_DURATION] => 8
                        )

                )

        )






*/
function GetAllTimetableCoursesArray($arCoursesID, $vCountRecords = 5){
	if(CModule::IncludeModule("iblock")){
		$arAllTimetableCourses = array();
		$arOrder = array(
			"PROPERTY_COURSE_CODE" =>"ASC"
		);
		$arFilter = array("IBLOCK_ID"=>D_COURSE_ID_IBLOCK, "ACTIVE"=>"Y" , "ID"=>$arCoursesID);
		$arGroupBy = false;
		$arNavStartParams = false;
		$arSelectFields = array(
			"ID",
			"NAME",
			"PROPERTY_COURSE_CODE",
			"PROPERTY_COURSE_FORMAT",
			"PROPERTY_COURSE_DURATION",
			"PROPERTY_ID_COURSE_OWNER",
			"PROPERTY_COURSE_PRICE",
			"PROPERTY_COURSE_PRICE_UA"
			);
		$res = CIBlockElement::GetList($arOrder, $arFilter, $arGroupBy, $arNavStartParams, $arSelectFields);
		$index = 0; $tempVariable ="";
		while($ob = $res->GetNextElement())
		{
			$arFields = $ob->GetFields();
			$arAllTimetableCourses[$index]['COURSE_ID'] = $arFields['ID'];
			$arAllTimetableCourses[$index]['COURSE_NAME'] = $arFields['NAME'];
			$arAllTimetableCourses[$index]['COURSE_CODE'] = $arFields['PROPERTY_COURSE_CODE_VALUE'];
			$arAllTimetableCourses[$index]['COURSE_DURATION'] = $arFields['PROPERTY_COURSE_DURATION_VALUE'];
			$arAllTimetableCourses[$index]['COURSE_OWNER'] = $arFields['PROPERTY_ID_COURSE_OWNER_ENUM_ID'];
			$arAllTimetableCourses[$index]['COURSE_PRICE_RUB'] = $arFields['PROPERTY_COURSE_PRICE_VALUE'];
			$arAllTimetableCourses[$index]['COURSE_PRICE'] = $arFields['PROPERTY_COURSE_PRICE_VALUE'];
			$arAllTimetableCourses[$index]['COURSE_PRICE_UA'] = $arFields['PROPERTY_COURSE_PRICE_UA_VALUE'];
			$arAllTimetableCourses[$index]['COURSE_FORMAT_ID'] = $arFields['PROPERTY_COURSE_FORMAT_VALUE'];
			$arAllTimetableCourses[$index]['TIMETABLE'] = array();

			$arFilterTimetable = Array(
				"IBLOCK_ID"=>D_TIMETABLE_ID_IBLOCK,
				"PROPERTY_SCHEDULE_COURSE"=>$arFields["ID"],
				"ACTIVE" => "Y",
				">PROPERTY_STARTDATE" => date("Y-m-d")
			);
			$arGroupByTimetable = false;
			$arNavStartParamsTimetable = array("nTopCount" => $vCountRecords);
			$arOrderTimetable = array("PROPERTY_STARTDATE" => "ASC");
			$arSelectFieldsTimetable = Array(
				"ID",
				"NAME",
				"PROPERTY_STARTDATE",
				"PROPERTY_SCHEDULE_DURATION",
				"PROPERTY_SCHEDULE_PRICE",
				"PROPERTY_ENDDATE",
				"PROPERTY_CITY.NAME",
				"PROPERTY_CITY"
			);
			$indexTimetable = false;
			$resTimetable = CIBlockElement::GetList($arOrderTimetable, $arFilterTimetable, $arGroupByTimetable,
			$arNavStartParamsTimetable, $arSelectFieldsTimetable);
			$number = 0;
			$dateSomeCourses = "";
			while($obTimetable = $resTimetable->GetNextElement())
			{
				$arFieldsTimetable = $obTimetable->GetFields();
				$indexTimetable = true;
				$arAllTimetableCourses[$index]['TIMETABLE'][$number]['TIMETABLE_ID'] = $arFieldsTimetable['ID'];
				$arAllTimetableCourses[$index]['TIMETABLE'][$number]['TIMETABLE_NAME'] = $arFieldsTimetable['NAME'];
				$arAllTimetableCourses[$index]['TIMETABLE'][$number]['TIMETABLE_STARTDATE'] = $arFieldsTimetable['PROPERTY_STARTDATE_VALUE'];
				$arAllTimetableCourses[$index]['TIMETABLE'][$number]['TIMETABLE_ENDDATE'] = $arFieldsTimetable['PROPERTY_ENDDATE_VALUE'];
				$arAllTimetableCourses[$index]['TIMETABLE'][$number]['TIMETABLE_CITY_NAME'] = $arFieldsTimetable['PROPERTY_CITY_NAME'];
				$arAllTimetableCourses[$index]['TIMETABLE'][$number]['TIMETABLE_CITY_ID'] = $arFieldsTimetable['PROPERTY_CITY_VALUE'];
				$arAllTimetableCourses[$index]['TIMETABLE'][$number]['TIMETABLE_DURATION'] = $arFieldsTimetable['PROPERTY_SCHEDULE_DURATION_VALUE'];
				$arAllTimetableCourses[$index]['TIMETABLE'][$number]['TIMETABLE_PRICE'] = $arFieldsTimetable['PROPERTY_SCHEDULE_PRICE_VALUE'];
				$number = $number + 1;
			}
			$index = $index + 1;
		}
	}
	return $arAllTimetableCourses;
}

function printLinkedCoursesToEmail($ID){
	$stringToEmail = "";
	$arLinkedCoursesArray  = GetLinkedCoursesArray($ID);
	if (count($arLinkedCoursesArray)>0)  {
		$arTimetableCoursesArray =  GetAllTimetableCoursesArray($arLinkedCoursesArray);
		$index = 0;
		foreach  ($arTimetableCoursesArray as $arCourse) {
			$stringToEmail .= "<a href='http://ibs-training.ru/training/catalog/course.html?ID=".$arCourse['COURSE_ID']."'>".$arCourse['COURSE_CODE']." - ".$arCourse['COURSE_NAME']."</a><br />";
			$index = $index + 1;
		}
		if ($index > 0) {
			$stringBegin = "<strong>Приглашаем также посетить тренинги по связанным темам:</strong><br /><br />";
			$stringToEmail = $stringBegin.$stringToEmail;
		}
	}
	return $stringToEmail;
}
function GetAllActiveCitiesInfo(){
		if(CModule::IncludeModule("iblock")){
			$arSelect = array("ID", "NAME", "PROPERTY_IS_SITEACTIVE");
			$arFilter = array("IBLOCK_ID"=>D_CITIES_IBLOCK, "ACTIVE"=> "Y", "=PROPERTY_IS_SITEACTIVE"=>CITY_IS_SITEACTIVE);
			$res = CIBlockElement::GetList(array("SORT"=>"ASC"), $arFilter, false, false, $arSelect);
			while($ob = $res->GetNextElement())
			{
				$ar_fields = $ob->GetFields();
				$arCityInfo[$ar_fields['ID']]["ID"] = $ar_fields["ID"];
				$arCityInfo[$ar_fields['ID']]["NAME"] = $ar_fields["NAME"];
			}
			//iwrite($arCityInfo);
		}
	return $arCityInfo;
}
function GetCityNameByID($ID){
		if(CModule::IncludeModule("iblock")){
			$arSelect = array("ID", "NAME");
			$arFilter = array("IBLOCK_ID"=>D_CITIES_IBLOCK, "ID"=>$ID);
			$res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
			while($ob = $res->GetNextElement())
			{
				$ar_fields = $ob->GetFields();
				$vCityName = $ar_fields["NAME"];
			}
		}
	return $vCityName;
}
function GetCityCodeByID($ID){
		if(CModule::IncludeModule("iblock")){
			$arSelect = array("ID", "CODE");
			$arFilter = array("IBLOCK_ID"=>D_CITIES_IBLOCK, "ID"=>$ID);
			$res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
			while($ob = $res->GetNextElement())
			{
				$ar_fields = $ob->GetFields();
				$vCityCode = $ar_fields["CODE"];
			}
		}
	return $vCityCode;
}
function fn_getCityPrice($price, $cityid) {
	$priceUA=$price/35;
	if ($cityid==CITY_ID_MOSCOW) {
			$priceOut = $price;
		} elseif ($cityid==CITY_ID_SPB){
			$priceOut = round(($price-$price/100*10)/10)*10;
		} elseif ($cityid==CITY_ID_OMSK){
			$priceOut = round(($price-$price/100*20)/10)*10;
		} elseif ($cityid==CITY_ID_KIEV){
			$priceOut = round(($priceUA-$priceUA/100*58)/10)*10;
		} elseif ($cityid==CITY_ID_ODESSA){
			$priceOut = round(($priceUA-$priceUA/100*70)/10)*10;
		} elseif ($cityid==CITY_ID_DNEPR){
			$priceOut = round(($priceUA-$priceUA/100*73)/10)*10;
		} else {
			$priceOut = $price;
		}
		return $priceOut;
}
function fn_getNewCityPrice($price, $cityid, $duration) {
    if ($cityid == CITY_ID_MOSCOW) {
        $priceOut = $price;
    } elseif ($cityid == CITY_ID_SPB) {
        $priceOut = round(($price - $price / 100 * 10) / 10) * 10;
    } elseif ($cityid == CITY_ID_OMSK) {
        $priceOut = round(($price - $price / 100 * 25) / 10) * 10;
    } elseif ($cityid == CITY_ID_KIEV) {
        if ($duration <= 39) {
            $priceOut = $duration * 300;
        } else {
            $priceOut = $duration * 225;
        }
    } elseif ($cityid == CITY_ID_ODESSA) {
        if ($duration <= 39) {
            $priceOut = $duration * 270;
        } else {
            $priceOut = $duration * 200;
        }
    } elseif ($cityid == CITY_ID_DNEPR) {
        if ($duration <= 39) {
            $priceOut = $duration * 270;
        } else {
            $priceOut = $duration * 200;
        }
    } else {
        $priceOut = $price;
    }
    return $priceOut;
}
function fn_getMostNewCityPrice($price, $price_ua, $cityid, $duration) {
	//$priceUA=$price/35;
	if ($cityid==CITY_ID_MOSCOW) {
			$priceOut = $price;
		} elseif ($cityid==CITY_ID_SPB){
			$priceOut = round(($price-$price/100*10)/10)*10;
		} elseif ($cityid==CITY_ID_OMSK){
			$priceOut = round(($price-$price/100*25)/10)*10;
		} elseif ($cityid==CITY_ID_KIEV){
			if (intval($price_ua)>0) {
				$priceOut=$price_ua;

			} else {
				if ($duration<=39) {
					$priceOut= 	$duration * 300;
				} else {
					$priceOut= 	$duration * 225;
				}
			}
		} elseif ($cityid==CITY_ID_ODESSA){
			if (intval($price_ua)>0) {
				$priceOut=round($price_ua*0.9, -2);

			} else {
				if ($duration<=39) {
					$priceOut= 	$duration * 270;
				} else {
					$priceOut= 	$duration * 200;
				}
			}
		} elseif ($cityid==CITY_ID_DNEPR){
			if (intval($price_ua)>0) {
				$priceOut=round($price_ua*0.9, -2);

			} else {
				if ($duration<=39) {
					$priceOut= 	$duration * 270;
				} else {
					$priceOut= 	$duration * 200;
				}
			}
		} else {
			$priceOut = $price;
		}
		return $priceOut;
}
function GetHTMLSubcribeBlockCourseCity($CITY_ID){
		global $APPLICATION;
		if(CModule::IncludeModule("iblock")){
		ob_start();
			$data  = date("Y-m-d");
			$GLOBALS["arrFilter"] = array("PROPERTY_CITY" => intval($CITY_ID), "ACTIVE" => "Y" ,">=PROPERTY_STARTDATE" => $data);
			$APPLICATION->IncludeComponent(
				"bitrix:news.list",
				"subcribe.cities.new",
				Array(
				"IBLOCK_TYPE" => "edu",	// Тип информационного блока (используется только для проверки)
				"IBLOCK_ID" => "9",	// Код информационного блока
				"NEWS_COUNT" => "100",	// Количество новостей на странице
				"SORT_BY1" => "PROPERTY_STARTDATE",	// Поле для первой сортировки новостей
				"SORT_ORDER1" => "ASC",	// Направление для первой сортировки новостей
				"SORT_BY2" => "SORT",	// Поле для второй сортировки новостей
				"SORT_ORDER2" => "ASC",	// Направление для второй сортировки новостей
				"FILTER_NAME" => "arrFilter",	// Фильтр
				"FIELD_CODE" => array(	// Поля
					0 => "",
					1 => "",
				),
				"PROPERTY_CODE" => array(	// Свойства
					0 => "course_сode",
					1 => "startdate",
					2 => "enddate",
					3 => "schedule_time",
					4 => "schedule_description",
					5 => "schedule_price",
					6 => "schedule_duration",
					7 => "hot_checkbox",
					8 => "prschedule_startdate",
					9 => "prschedule_enddate",
					10 => "prschedule_time",
					11 => "prschedule_desc",
					12 => "",
				),
				"CHECK_DATES" => "N",	// Показывать только активные на данный момент элементы
				"DETAIL_URL" => "/edu/catalog/course.html?ID=#ELEMENT_ID#",	// URL страницы детального просмотра (по умолчанию - из настроек инфоблока)
				"AJAX_MODE" => "N",	// Включить режим AJAX
				"AJAX_OPTION_SHADOW" => "Y",	// Включить затенение
				"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
				"AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
				"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
				"CACHE_TYPE" => "N",	// Тип кеширования
				"CACHE_TIME" => "36000",	// Время кеширования (сек.)
				"CACHE_FILTER" => "Y",	// Кэшировать при установленном фильтре
				"PREVIEW_TRUNCATE_LEN" => "",	// Максимальная длина анонса для вывода (только для типа текст)
				"ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
				"DISPLAY_PANEL" => "N",	// Добавлять в админ. панель кнопки для данного компонента
				"SET_TITLE" => "N",	// Устанавливать заголовок страницы
				"INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// Включать инфоблок в цепочку навигации
				"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
				"HIDE_LINK_WHEN_NO_DETAIL" => "N",	// Скрывать ссылку, если нет детального описания
				"PARENT_SECTION" => "",	// ID раздела
				"PARENT_SECTION_CODE" => "",	// Код раздела
				"DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
				"DISPLAY_BOTTOM_PAGER" => "N",	// Выводить под списком
				"PAGER_TITLE" => "",	// Название категорий
				"PAGER_SHOW_ALWAYS" => "N",	// Выводить всегда
				"PAGER_TEMPLATE" => "",	// Название шаблона
				"PAGER_DESC_NUMBERING" => "N",	// Использовать обратную навигацию
				"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Время кеширования страниц для обратной навигации
				"DISPLAY_DATE" => "N",
				"DISPLAY_NAME" => "Y",
				"DISPLAY_PICTURE" => "N",
				"DISPLAY_PREVIEW_TEXT" => "N",
				"AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
				)
			);
		$contentHtml = ob_get_contents();
		ob_end_clean();
		}
	return $contentHtml;
}
function GetHTMLSubscribeBlogs() {
    global $APPLICATION;
    if(CModule::IncludeModule("iblock")){
        ob_start();
         $APPLICATION->IncludeComponent("bitrix:blog.new_posts", "subscribe.snippet.new", array(
        "GROUP_ID" => "2",
        "BLOG_URL" => "",
        "MESSAGE_COUNT" => "10",
        "MESSAGE_LENGTH" => "200",
        "PREVIEW_WIDTH" => "80",
        "PREVIEW_HEIGHT" => "80",
        "DATE_TIME_FORMAT" => "d.m.Y",
        "PATH_TO_BLOG" => "blog_blog.php?page=blog&blog=#blog#",
        "PATH_TO_POST" => "/blog/#blog#/#post_id#.html",
        "PATH_TO_USER" => "blog_user.php?page=user&user_id=#user_id#",
        "PATH_TO_GROUP_BLOG_POST" => "",
        "CACHE_TYPE" => "N",
        "CACHE_TIME" => "86400",
        "PATH_TO_SMILE" => "/bitrix/images/blog/smile/",
        "USE_SOCNET" => "N",
        "BLOG_VAR" => "blog",
        "POST_VAR" => "post_id",
        "USER_VAR" => "user_id",
        "PAGE_VAR" => "page",
        "SEO_USER" => "Y"
    ),
    false
    );
    $contentHtml = ob_get_contents();
    ob_end_clean();
    }
    return $contentHtml;

}

function GetHTMLSubscribeNews() {
global $APPLICATION;
if(CModule::IncludeModule("iblock")){
ob_start();
$APPLICATION->IncludeComponent("bitrix:news.list", "subscribe-news", array(
        "IBLOCK_TYPE" => "edu",
        "IBLOCK_ID" => "23",
        "NEWS_COUNT" => "20",
        "SORT_BY1" => "ACTIVE_FROM",
        "SORT_ORDER1" => "DESC",
        "SORT_BY2" => "SORT",
        "SORT_ORDER2" => "ASC",
        "FILTER_NAME" => "",
        "FIELD_CODE" => array(
            0 => "",
            1 => "",
        ),
        "PROPERTY_CODE" => array(
            0 => "",
            1 => "DESCRIPTION",
            2 => "",
        ),
        "CHECK_DATES" => "Y",
        "DETAIL_URL" => "",
        "AJAX_MODE" => "N",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "AJAX_OPTION_HISTORY" => "N",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "3600",
        "CACHE_FILTER" => "Y",
        "CACHE_GROUPS" => "N",
        "PREVIEW_TRUNCATE_LEN" => "",
        "ACTIVE_DATE_FORMAT" => "d.m.Y",
        "SET_TITLE" => "N",
        "SET_STATUS_404" => "N",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
        "ADD_SECTIONS_CHAIN" => "N",
        "HIDE_LINK_WHEN_NO_DETAIL" => "Y",
        "PARENT_SECTION" => "",
        "PARENT_SECTION_CODE" => "",
        "DISPLAY_TOP_PAGER" => "N",
        "DISPLAY_BOTTOM_PAGER" => "N",
        "PAGER_TITLE" => "Новости",
        "PAGER_SHOW_ALWAYS" => "N",
        "PAGER_TEMPLATE" => "",
        "PAGER_DESC_NUMBERING" => "N",
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
        "PAGER_SHOW_ALL" => "N",
        "DISPLAY_DATE" => "N",
        "DISPLAY_NAME" => "Y",
        "DISPLAY_PICTURE" => "N",
        "DISPLAY_PREVIEW_TEXT" => "Y",
        "AJAX_OPTION_ADDITIONAL" => ""
    ),
    false
);
    $contentHtml = ob_get_contents();
    ob_end_clean();
}
return $contentHtml;
}

function CreateSubscribeSnippetsCourses($arCities){
	foreach($arCities as $vIDCity){
		$vHTML = GetHTMLSubcribeBlockCourseCity($vIDCity);
		if(file_exists($_SERVER["DOCUMENT_ROOT"]."/bitrix/templates/.default/snippets/subscribe/c_courses_".$vIDCity)){
			//unlink($_SERVER["DOCUMENT_ROOT"]."/bitrix/templates/.default/snippets/subscribe/c_courses_".$vIDCity);
		}
		file_put_contents($_SERVER["DOCUMENT_ROOT"]."/bitrix/templates/.default/snippets/subscribe/c_courses_".$vIDCity.".snp", $vHTML);
	}
}
function CreateSubscribeSnippetsNews() {
    $vHTML = GetHTMLSubscribeNews();
    file_put_contents($_SERVER["DOCUMENT_ROOT"]."/bitrix/templates/.default/snippets/subscribe/c_news.snp", $vHTML);
}
function CreateSubscribeSnippetsBlogs() {
    $vHTML = GetHTMLSubscribeBlogs();
    file_put_contents($_SERVER["DOCUMENT_ROOT"]."/bitrix/templates/.default/snippets/subscribe/c_blogs.snp", $vHTML);
}
/****** CRON FUNCTIONS *******/
function GenerateSubscribeSnippets(){
	global $USER;
	if (!is_object($USER))
		$USER = new CUser;

	$arCities= array(
		CITY_ID_OMSK,
		CITY_ID_MOSCOW,
		CITY_ID_KIEV,
		CITY_ID_DNEPR,
		CITY_ID_ODESSA,
		CITY_ID_SPB,
        CITY_ID_NOVOSIBIRSK,
        CITY_ID_MINSK,
        CITY_ID_ONLINE,
	);
	CreateSubscribeSnippetsCourses($arCities);
	CreateSubscribeSnippetsNews();
	CreateSubscribeSnippetsBlogs();
	return "GenerateSubscribeSnippets();";
}

function CheckCourseInCatalog(){
	global $USER;
	if (!is_object($USER))
		$USER = new CUser;
	if(CModule::IncludeModule("iblock")){
		$arSelect = array("ID", "CODE", "PROPERTY_IS_IN_CATALOG");
		$arFilter = array("ACTIVE"=>"Y", "IBLOCK_ID"=>D_COURSE_ID_IBLOCK);
		$res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
		while($ob = $res->GetNextElement())
		{
			$arCourse = $ob->GetFields();
			$resCount = CIBlockElement::GetList(array(), array("ACTIVE"=>"Y", "IBLOCK_ID"=>D_NEWCATALOG_IBLOCK, "=PROPERTY_PP_COURSE" =>$arCourse['ID']), array(), false, array("ID"));
			if ((!$resCount) and (!$arCourse['PROPERTY_IS_IN_CATALOG_ENUM_ID']))
				CIBlockElement::SetPropertyValuesEx($arCourse['ID'], D_COURSE_ID_IBLOCK, array("IS_IN_CATALOG" => 143));
			if (($resCount) and ($arCourse['PROPERTY_IS_IN_CATALOG_ENUM_ID']))
				CIBlockElement::SetPropertyValuesEx($arCourse['ID'], D_COURSE_ID_IBLOCK, array("IS_IN_CATALOG" => ""));
			//echo $arCourse['CODE']."  - ".$resCount."<br />";
		}
		//return $arCourse;
	}
	return "CheckCourseInCatalog();";
}
/****** CRON FUNCTIONS ENDS *******/

/*
GetCountRegisteredForEvent
получаем число регистраций на мероприятие
возращает число
*/

function GetCountRegisteredForEvent($ID){
		if(CModule::IncludeModule("iblock")){
			if ($ID > 0) {
				$arSelect = array("ID", "NAME");
				$arFilter = array("IBLOCK_ID"=>D_RECORDS_IBLOCK, "ACTIVE"=> "Y", "=PROPERTY_EVENT_ID"=>$ID);
				$vCountRegisteredForEvent = CIBlockElement::GetList(array(), $arFilter, array(), false, $arSelect);
			} else {
				return false;
			}
		}
	return $vCountRegisteredForEvent;
}
function GetMaxCountForEvent($ID){
	if(CModule::IncludeModule("iblock")){
		$arSelect = array("ID", "PROPERTY_MAX_NUM");
		if ($ID > 0) {} else {return false;}
		$arFilter = array("IBLOCK_ID"=>D_SEMINARS_IBLOCK, "ACTIVE"=> "Y", "ID"=>$ID);
		$res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
		while($ob = $res->GetNextElement())
		{
			$ar_fields = $ob->GetFields();
			$vCountRegisteredForEvent = $ar_fields['PROPERTY_MAX_NUM_VALUE'];
			if ((strlen($vCountRegisteredForEvent)  ==  0) or ($vCountRegisteredForEvent == 0)){
				return false;
			}
		}
	}
	return $vCountRegisteredForEvent;
}
/*
получиим список записей на определнный курс
*/
function GetArActiveElementRecordsByID($ID, $ID_CITY_ORDER=false, $bUseEmpty = false){
	CModule::IncludeModule("iblock");
	if ($ID > 0) {} else {return false;}
	$arSelect = array(
		"ID",
		"NAME",
		"PROPERTY_USER_ID",
		"PROPERTY_RECORD_ID",
		"PROPERTY_DATE_ON",
		"PROPERTY_DATE_OFF",
		"PROPERTY_ID_CITY_ORDER"
	);
	$arFilter = array(
		"IBLOCK_ID"=>D_ELEMENTSUBSCRIBE_IBLOCK,
		"ACTIVE"=> "Y",
		"=PROPERTY_RECORD_ID"=>$ID
	);
	if ($ID_CITY_ORDER) {
		//$arFilter["=PROPERTY_ID_CITY_ORDER"] = $ID_CITY_ORDER;
	}
	if ($bUseEmpty){
		$arFilter[] =  array(
			"LOGIC" => "OR",
			array("=PROPERTY_ID_CITY_ORDER" => $ID_CITY_ORDER),
			array("PROPERTY_ID_CITY_ORDER" => false),
		);
	}
	$res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
	$index = 0;
	iwrite($arFilter);

		//iwrite($arFilter2);
	while($ob = $res->GetNextElement())
	{
		$ar_fields = $ob->GetFields();
		$arTemp["ID"] = $ar_fields['ID'];
		$arTemp["NAME"] = $ar_fields['NAME'];
		$arTemp["USER_ID"] = $ar_fields['PROPERTY_USER_ID_VALUE'];
		$arTemp["DATE_ON"] = $ar_fields['PROPERTY_DATE_ON_VALUE'];
		$arTemp["DATE_OFF"] = $ar_fields['PROPERTY_DATE_OFF_VALUE'];
		$arTemp["ID_CITY_ORDER"] = $ar_fields['PROPERTY_ID_CITY_ORDER_VALUE'];
		$ArActiveElementRecordsByID[] = $arTemp;
		$index = $index + 1;
		if ($index == 0){ return false; }
	}
	return $ArActiveElementRecordsByID;
}







/***** INTHR INTEGRATION ******/

/**
* Get ID city by Name / Code / External ID
*
* @param string $vCityName
* @return int
 */
function GetIDCityByName($vCityName){
	if(CModule::IncludeModule("iblock")){
		$arSelect = array("ID");
		$arFilter = array("IBLOCK_ID"=>D_CITIES_IBLOCK, array("LOGIC" => "OR", array("=NAME"=>strtolower(trim($vCityName))), array("=XML_ID"=>strtolower(trim($vCityName))), array("=CODE"=>strtolower(trim($vCityName)))));
		$res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
		while($ob = $res->GetNextElement())
		{
			$ar_fields = $ob->GetFields();
			if (strlen($ar_fields["ID"])>0)
				return $ar_fields["ID"];
		}
	}
	return false;
}


/**
* Make field XML_ID empty in  IBLOCK
*
* use it only 1 time
*
* @param integer $iblockID
* @return boolean
 */
function EmptyExternalIDInIBlock($iblockID){
	if(CModule::IncludeModule("iblock")){
		$arSelect = array("ID");
		$arFilter = array("IBLOCK_ID"=>$iblockID, "!XML_ID"=>0);
		$res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
		while($ob = $res->GetNextElement())
		{
			$ar_fields = $ob->GetFields();
				$el = new CIBlockElement;
				$arArray = Array("XML_ID"    => "0");
				$result = $el->Update($ar_fields['ID'], $arArray, false, false);
		}
		return true;
	}
	return false;
}
/**
* Get ID Course by XML_ID
*
*
*
* @param integer $vExternalID
* @return integer or false in case of failure
 */
function GetIDCourseByExternalID($vExternalID){
	if(CModule::IncludeModule("iblock")){
		$arSelect = array("ID");
		$arFilter = array("IBLOCK_ID"=>D_COURSE_ID_IBLOCK,  "=XML_ID"=>intval(trim($vExternalID)));
		$res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
		while($ob = $res->GetNextElement())
		{
			$ar_fields = $ob->GetFields();
			$arVar[] = $ar_fields['ID'];
		}
		if (count($arVar) == 1) {
			return $arVar[0];
		}
	}
	return false;
}


/**
* Get ID Course by CODE
*
* Code should be unique or return false
*
* for any case check situation when 2 or more records are found
* it is possible only in first time of  service use
* but we should do this despite of this
*
* @param string $vCourseCode
* @return integer or false in case of failure
 */
function GetIDCourseByCourseCode($vCourseCode){
	if(CModule::IncludeModule("iblock")){
		$arSelect = array("ID");
		$arFilter = array("IBLOCK_ID"=>D_COURSE_ID_IBLOCK,  "=CODE"=>strtoupper(trim($vCourseCode)));
		$res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
		while($ob = $res->GetNextElement())
		{
			$ar_fields = $ob->GetFields();
			$arVar[] = $ar_fields['ID'];
		}
		if (count($arVar) == 1)
			return $arVar[0];
		if (count($arVar) > 1){
			$arFilter["ACTIVE"] = "Y";
			$resActive = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
			while($obActive = $resActive->GetNextElement())
			{
				$ar_fieldsActive = $obActive->GetFields();
				$arVarActive[] = $ar_fieldsActive['ID'];
			}
			if (count($arVarActive) == 1)
				return $arVarActive[0];
		}
	}
	return false;
}

/**
* Get ID Expert by XML_ID
*
*
*
* @param integer $vExternalID
* @return integer or false in case of failure
 */
function GetIDExpertByExternalID($vExternalID){
	if(CModule::IncludeModule("iblock")){
		$arSelect = array("ID");
		$arFilter = array("IBLOCK_ID"=>D_EXPERT_ID_IBLOCK,  "=XML_ID"=>intval(trim($vExternalID)));
		$res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
		while($ob = $res->GetNextElement())
		{
			$ar_fields = $ob->GetFields();
			$arVar[] = $ar_fields['ID'];
		}
		if (count($arVar) == 1) {
			return $arVar[0];
		}
	}
	return false;
}
/**
* Get ID Expert by surname
*
* Code should be unique or return false
*
* for any case check situation when 2 or more records are found
* it is possible only in first time of  service use
* but we should do this despite of this
*
* @param string $vCourseCode
* @return integer or false in case of failure
 */
function GetIDExpertBySurname($vExpertSurname){
	if(CModule::IncludeModule("iblock")){
		$arSelect = array("ID");
		$arFilter = array("IBLOCK_ID"=>D_EXPERT_ID_IBLOCK,  "=NAME"=>strtolower(trim($vExpertSurname)));
		$res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
		while($ob = $res->GetNextElement())
		{
			$ar_fields = $ob->GetFields();
			$arVar[] = $ar_fields['ID'];
		}
		if (count($arVar) == 1)
			return $arVar[0];
		if (count($arVar) > 1){
			$arFilter["ACTIVE"] = "Y";
			$resActive = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
			while($obActive = $resActive->GetNextElement())
			{
				$ar_fieldsActive = $obActive->GetFields();
				$arVarActive[] = $ar_fieldsActive['ID'];
			}
			if (count($arVarActive) == 1)
				return $arVarActive[0];
		}
	}
	return false;
}
function imTranslite($str){
// транслитерация корректно работает на страницах с любой кодировкой
// ISO 9-95
   static $tbl= array(
      'а'=>'a', 'б'=>'b', 'в'=>'v', 'г'=>'g', 'д'=>'d', 'е'=>'e', 'ж'=>'g', 'з'=>'z',
      'и'=>'i', 'й'=>'y', 'к'=>'k', 'л'=>'l', 'м'=>'m', 'н'=>'n', 'о'=>'o', 'п'=>'p',
      'р'=>'r', 'с'=>'s', 'т'=>'t', 'у'=>'u', 'ф'=>'f', 'ы'=>'y', 'э'=>'e', 'А'=>'A',
      'Б'=>'B', 'В'=>'V', 'Г'=>'G', 'Д'=>'D', 'Е'=>'E', 'Ж'=>'G', 'З'=>'Z', 'И'=>'I',
      'Й'=>'Y', 'К'=>'K', 'Л'=>'L', 'М'=>'M', 'Н'=>'N', 'О'=>'O', 'П'=>'P', 'Р'=>'R',
      'С'=>'S', 'Т'=>'T', 'У'=>'U', 'Ф'=>'F', 'Ы'=>'Y', 'Э'=>'E', 'ё'=>"yo", 'х'=>"h",
      'ц'=>"ts", 'ч'=>"ch", 'ш'=>"sh", 'щ'=>"shch", 'ъ'=>"", 'ь'=>"", 'ю'=>"yu", 'я'=>"ya",
      'Ё'=>"YO", 'Х'=>"H", 'Ц'=>"TS", 'Ч'=>"CH", 'Ш'=>"SH", 'Щ'=>"SHCH", 'Ъ'=>"", 'Ь'=>"",
      'Ю'=>"YU", 'Я'=>"YA", ' '=>"_", '№'=>"", '«'=>"<", '»'=>">", '—'=>"-"
   );
    return strtr($str, $tbl);
 }
function log_array() {
   $arArgs = func_get_args();
   $sResult = '';
   foreach($arArgs as $arArg) {
      $sResult .= "\n\n".print_r($arArg, true);
   }

   AddMessage2Log($sResult, 'log_array -> ');
}
/***** INTHR INTEGRATION  ENDS******/

/*A needed a function to find the keys which contain part of a string, not equalling a string...*/
function array_keys_contain($input, $search_value, $strict = false)
{
	$tmpkeys = array();
	$keys = array_keys($input);
	foreach ($keys as $k)
	{
		if ($strict && strpos($k, $search_value) !== FALSE)
			$tmpkeys[] = $k;
		elseif (!$strict && stripos($k, $search_value) !== FALSE)
			$tmpkeys[] = $k;
	}
	return $tmpkeys;
}
function deleteKeys($arr, $str){
	$arrNew = array_keys_contain($arr, $str);
	$arrNewInverted = array_flip($arrNew);
	$arrN = array_diff_key($arr, $arrNewInverted);
	return $arrN;
}

function bitrixCleaningArray($arrN, $bFlagEmptyTilde = true){
	foreach($arrN as $key => $value){
		if (strpos($key, "VALUE_ID")!== false){
			unset($arrN[$key]);
			continue;
		}
		if (strpos($key, "_DESCRIPTION")!== false){
			unset($arrN[$key]);
			continue;
		}
		if ($bFlagEmptyTilde){
			if (strpos($key, "~PROPERTY_")!== false){
				unset($arrN[$key]);
				continue;
			}
		}
		if (strpos($key, "PROPERTY_")!== false){
			$newKey = str_replace("PROPERTY_","",$key);
			$newKey = str_replace("_VALUE","",$newKey);
			unset($arrN[$key]);
			$arrN[$newKey] = $value;
		}
	}
	return $arrN;
}


?>
