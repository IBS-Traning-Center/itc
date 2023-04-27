<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Задать вопрос эксперту");
?> 
<style type="text/css">
.myform {
	overflow:visible!important;
	min-width:500px;
}
input, textarea {
	color:#000000;
}
#stylized input {
	font-size:13px;
}
#stylized input.but {
	width:155px!important;
}
#stylized textarea {
	height:120px;
	width:300px;
}
#stylized .date_select{
	border:1px solid #AACFE4;
	width:186px;
	min-height:20px;

}
#stylized .date_select option{
  padding:3px 2px 0;
}

#stylized label {
    margin-bottom: 7px;
}
#stylized input[type="submit"] {
    margin: 0px 0 5px 0px;
    padding: 4px 2px;
}
</style>
 
<div id="stylized" class="myform"> <?$APPLICATION->IncludeComponent("bitrix:iblock.element.add.form", "experts.ask", array(
	"IBLOCK_TYPE" => "edu_const",
	"IBLOCK_ID" => "85",
	"STATUS_NEW" => "NEW",
	"LIST_URL" => "",
	"USE_CAPTCHA" => "Y",
	"USER_MESSAGE_EDIT" => "",
	"USER_MESSAGE_ADD" => "Спасибо за Ваш вопрос. Ответ эксперта будет опубликован на странице Ответы экспертов. Уведомление о публикации ответа будет отправлено на адрес электронной почты, указанный Вами при регистрации вопроса",
	"DEFAULT_INPUT_SIZE" => "50",
	"RESIZE_IMAGES" => "N",
	"PROPERTY_CODES" => array(
		0 => "NAME",
		1 => "IBLOCK_SECTION",
		2 => "459",
		3 => "460",
		4 => "461",
		5 => "462",
	),
	"PROPERTY_CODES_REQUIRED" => array(
		0 => "IBLOCK_SECTION",
		1 => "459",
		2 => "462",
	),
	"GROUPS" => array(
		0 => "2",
	),
	"STATUS" => "ANY",
	"ELEMENT_ASSOC" => "CREATED_BY",
	"MAX_USER_ENTRIES" => "100000",
	"MAX_LEVELS" => "100000",
	"LEVEL_LAST" => "Y",
	"MAX_FILE_SIZE" => "0",
	"PREVIEW_TEXT_USE_HTML_EDITOR" => "N",
	"DETAIL_TEXT_USE_HTML_EDITOR" => "N",
	"SEF_MODE" => "Y",
	"SEF_FOLDER" => "/about/experts/ask/",
	"CUSTOM_TITLE_NAME" => " ",
	"CUSTOM_TITLE_TAGS" => "",
	"CUSTOM_TITLE_DATE_ACTIVE_FROM" => "",
	"CUSTOM_TITLE_DATE_ACTIVE_TO" => "",
	"CUSTOM_TITLE_IBLOCK_SECTION" => "Направление экспертизы",
	"CUSTOM_TITLE_PREVIEW_TEXT" => "",
	"CUSTOM_TITLE_PREVIEW_PICTURE" => "",
	"CUSTOM_TITLE_DETAIL_TEXT" => "",
	"CUSTOM_TITLE_DETAIL_PICTURE" => ""
	),
	false
);?> 	 </div>
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>