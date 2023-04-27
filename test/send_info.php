<? include($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$arInfo=GetFullInfoAboutCourse(62615);
$arSend=array("NAME"=> $arInfo["COURSE_CODE"]." ".$arInfo["COURSE_NAME"], "CITY"=> $arInfo["CITY_NAME"], "DATES"=> $arInfo["STARTDATE"]." - ".$arInfo["ENDDATE"], "TRENER"=> $arInfo["TEACHER_NAME"], "MANAGER"=> $arInfo["CREATED_NAME"], "PRICE"=> $arInfo["PRICE"]);
print_r($arSend);
CEvent::Send('NEW_COURSE_TIME',SITE_ID, $arSend, 'N', 179);