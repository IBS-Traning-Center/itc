<?
include($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$APPLICATION->ShowHead();
if (CModule::IncludeModule("iblock")):
	if (intval($_REQUEST["id"])>0) {
		$arSelect=array("NAME", "PREVIEW_TEXT", "PROPERTY_SUBJECT");
		$arFilter = Array("IBLOCK_ID"=>109, "ID"=>intval($_REQUEST["id"]), "ACTIVE_DATE"=>"Y",  "ACTIVE"=>"Y");
		$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
		while($ob = $res->GetNextElement())
		{
		  $arFields = $ob->GetFields();
		  $response=array('title_ru'=>$arFields["PREVIEW_TEXT"], "subject"=>$arFields["PROPERTY_SUBJECT_VALUE"]);
		}
	}

endif?>
<div class="row">
		<h2>Откорректируйте шаблон письма</h2><br/>
		Заголовок <br/>
		<input type="text" style="width: 400px;" value="<?=$arFields["PROPERTY_SUBJECT_VALUE"]?>" class="subject" name="subject"/>
	</div>
	<div class="row">
		Текст письма <br/>
		<?$APPLICATION->IncludeComponent("bitrix:fileman.light_editor","",Array(
			"CONTENT" => $arFields["PREVIEW_TEXT"],
			"INPUT_NAME" => "mailbody",
			"INPUT_ID" => "",
			"WIDTH" => "100%",
			"HEIGHT" => "300px",
			"RESIZABLE" => "Y",
			"AUTO_RESIZE" => "Y",
			"VIDEO_ALLOW_VIDEO" => "Y",
			"VIDEO_MAX_WIDTH" => "640",
			"VIDEO_MAX_HEIGHT" => "480",
			"VIDEO_BUFFER" => "20",
			"VIDEO_LOGO" => "",
			"VIDEO_WMODE" => "transparent",
			"VIDEO_WINDOWLESS" => "Y",
			"VIDEO_SKIN" => "/bitrix/components/bitrix/player/mediaplayer/skins/bitrix.swf",
			"USE_FILE_DIALOGS" => "Y",
			"ID" => "",	
			"JS_OBJ_NAME" => ""
			)
		);?>
</div>
