<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
//CFormResult::SetField($RESULT_ID, "code", $_SERVER["REMOTE_ADDR"]);
//CFormResult::SetField($RESULT_ID, "name", $_SERVER["REMOTE_ADDR"]);
//CFormResult::SetField($RESULT_ID, "hremail", $_SERVER["REMOTE_ADDR"]);
  asd
  $host = "localhost";
  $user = "root";
  $password = "";
  $database= "sitemanager6";
       if(!mysql_connect($host,$user,$password ))
          {
           echo   "Can not establish connection";
           exit;
          }
          mysql_select_db($database);

 $sql_query = "SELECT * FROM `luxoft_edu_courses` ORDER BY `course_creationtime` DESC";
 $sql_query2 = "SELECT * FROM `luxoft_edu_courses` WHERE (`id_course` = 185)";

 $qwe= mysql_query($sql_query);
    for ($i=0; $i<mysql_num_rows($qwe); $i++)
               {
              $data=mysql_fetch_array($qwe);
              $id_course = $data2['id_course'];
	$group_id = $data2['group_id'];
//	if (isset($id_group) and (is_numeric($id_group)) ) {} else { $id_group = 1; }
    $sSqlWrk3 =
"SELECT *
FROM `luxoft_edu_groups`
WHERE id_group = ". $group_id ."
";


		$course_code = stripslashes($data2['course_code']);
	$course_name = stripslashes($data2['course_name']);
	$course_price = stripslashes($data2['course_price']);
		$course_duration = stripslashes($data2['course_duration']);
    	$course_description = nl2br(stripslashes($data2['course_description']));
        $course_puproses = nl2br(stripslashes($data2['course_puproses']));
		$course_topics = nl2br(stripslashes($data2['course_topics']));
		$course_audience = nl2br(stripslashes($data2['course_audience']));
    	$course_required = nl2br(stripslashes($data2['course_required']));
    	$course_linkedcourses = nl2br(stripslashes($data2['course_linkedcourses']));
	$course_trainers = nl2br(stripslashes($data2['course_trainers']));
	$course_owner = nl2br(stripslashes($data2['course_owner']));
  	$course_addsources= nl2br(stripslashes($data2['course_addsources']));
    $course_classrequirements = nl2br(stripslashes($data2['course_classrequirements']));
    	$course_other = nl2br(stripslashes($data2['course_other']));
		$course_titlefile = nl2br(stripslashes($data2['course_titlefile']));
		$course_file = nl2br(stripslashes($data2['course_file']));
        }

        echo "$course_name";

//
//  if(CModule::IncludeModule("iblock"))
//{
//   /*************************************************­***********************************
//             ПАРАМЕТРЫ НОВОГО ЭЛЕМЕНТА
//   **************************************************­***********************************/
//
//   $IBLOCK_ID = "6"; // код инфоблока, в котором нужно создать новый элемент (заменить на нужный)
//   $SECTION_ID = ""; // код секции инфоблока, в которой нужно создать новый элемент
//
//   $NewElementName = "Название нового элемента"; //название нового элемента
//
//   $ACTIVE = "Y"; // Признак активности нового элемента Y|N
//
//   $PREVIEW_TEXT = "текст для анонса";
//   $PREVIEW_TEXT_TYPE = "html"; // формат данных для анонса html|text
//
//   $DETAIL_TEXT = "текст детального описания";
//   $DETAIL_TEXT_TYPE = "html"; // формат данных для детального описания html|text
//
//   $PREVIEW_PICTURE = ""; // массив описывающий файл с картинкой для анонса, см. CFile::MakeFileArray()
//   $DETAIL_PICTURE = ""; // массив описывающий файл с картинкой для детального описания, см. CFile::MakeFileArray()
//
//
//   /*************************************************­***********************************
//          ОПИСАНИЕ МАССИВА ДЛЯ СВОЙСТВА С ТИПОМ html/text
//   **************************************************­***********************************/
//
//   $HTML_TEXT_PROPERTY_CODE = "COMMENTS"; // код свойства с типом html/text (заменить на нужный)
//   $HTML_TEXT_PROPERTY_VALUE = "текст"; // Значение для свойства с типом html/text
//   $HTML_TEXT_PROPERTY_TYPE = "html"; // Формат данных: html|text
//
//   $ArrProp = array();
//   $ArrProp[$HTML_TEXT_PROPERTY_CODE][0] = Array("VALUE" => Array ("TEXT" => $HTML_TEXT_PROPERTY_VALUE, "TYPE" => $HTML_TEXT_PROPERTY_TYPE));
//
//
//
//   /*************************************************­***********************************
//             ДОБАВЛЕНИЕ НОВОГО ЭЛЕМЕНТА
//   **************************************************­***********************************/
//
//   $arNewElementValues = Array(
//     "MODIFIED_BY"       => $USER->GetID(), // элемент изменен текущим пользователем
//     "IBLOCK_SECTION"    => $SECTION_ID,
//     "IBLOCK_ID"         => $IBLOCK_ID,
//     "PROPERTY_VALUES"   => $ArrProp,
//     "NAME"              => $NewElementName,
//     "ACTIVE"            => $ACTIVE,
//     "PREVIEW_TEXT"      => $PREVIEW_TEXT,
//     "PREVIEW_TEXT_TYPE"     => $PREVIEW_TEXT_TYPE,
//     "DETAIL_TEXT"       => $DETAIL_TEXT,
//     "DETAIL_TEXT_TYPE"     => $DETAIL_TEXT_TYPE,
//     "PREVIEW_PICTURE"    => $PREVIEW_PICTURE,
//     "DETAIL_PICTURE"    => $DETAIL_PICTURE
//     );
//
//   $NewElement = new CIBlockElement;
//
//   if($NEW_ELEMENT_ID = $NewElement->Add($arNewElementValues))
//   {
//        echo "New element ID: ".$NEW_ELEMENT_ID;
//   }
//   else
//   {
//        echo "Error: ".$NewElement->LAST_ERROR;
//   }
//}
//
?>