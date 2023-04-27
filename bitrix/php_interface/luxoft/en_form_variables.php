<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/*
   if(CModule::IncludeModule("form"))
  {



$arVALUE = array();
$FIELD_SID = "hremail"; // символьный идентификатор вопроса
$ANSWER_ID = 624; // ID поля ответа
$arVALUE[$ANSWER_ID] = "hremail@mail.ru";
CFormResult::SetField($RESULT_ID, $FIELD_SID, $arVALUE);


$arVALUE = array();
$FIELD_SID = "code"; // символьный идентификатор вопроса
$ANSWER_ID = 617; // ID поля ответа
$arVALUE[$ANSWER_ID] = "code@mail.ru";
CFormResult::SetField($RESULT_ID, $FIELD_SID, $arVALUE);



}
*/
  // получим данные результата
$arValues = CFormResult::GetDataByIDForHTML($RESULT_ID, "Y");

// выведем ответ на вопрос "Фамилия, имя, отчество"
$id_vacancy= $arValues["form_text_625"]; // "Иванов Василий"

// $id_vacancy= htmlspecialchars($_GET("id"));
//$id_vacancy= 2057;
       if(CModule::IncludeModule("iblock"))
  {
 	    $arFilter = array();
	    $arFilter["ID"] = $id_vacancy;
 	    $items = GetIBlockElementList(1, false, $arSort, 1, $arFilter );
	    while($arItem = $items->GetNext())
 	   {
 	   	  $arIBlockElement = GetIBlockElement($id_vacancy);
 	      $vacancy_name = $arItem["NAME"];
 	      $vacancy_intcode = $arIBlockElement['PROPERTIES']['int_id']['VALUE'];
 	      $vacancy_emailteacher = $arIBlockElement['PROPERTIES']['email']['VALUE'];


 	      $arVALUE = array();
$FIELD_SID = "code"; // символьный идентификатор вопроса
$ANSWER_ID = 617; // ID поля ответа
$arVALUE[$ANSWER_ID] = $vacancy_intcode;
CFormResult::SetField($RESULT_ID, $FIELD_SID, $arVALUE);

 $arVALUE = array();
$FIELD_SID = "hremail"; // символьный идентификатор вопроса
$ANSWER_ID = 624; // ID поля ответа
$arVALUE[$ANSWER_ID] = $vacancy_emailteacher;
CFormResult::SetField($RESULT_ID, $FIELD_SID, $arVALUE);

 $arVALUE = array();
$FIELD_SID = "name"; // символьный идентификатор вопроса
$ANSWER_ID = 618; // ID поля ответа
$arVALUE[$ANSWER_ID] = $vacancy_name;
CFormResult::SetField($RESULT_ID, $FIELD_SID, $arVALUE);
    	   }
  }








//CFormResult::SetField($RESULT_ID, "id_vacancy", $id_vacancy);
// обновим ответ на вопрос "Фамилия, имя, отчество"



//CFormResult::SetField($RESULT_ID, "code", $vacancy_intcode);
//CFormResult::SetField($RESULT_ID, "hremail", $vacancy_emailteacher);
//CFormResult::SetField($RESULT_ID, "name", $vacancy_name);


//$FORM->setInputDefaultValue("question_id", "value");




?>