<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<style type="text/css">
#content #school_list ul li {
	margin-bottom:0px;
}
#content #school_list ul ul {
	margin:5px 0 30px 40px;
}
</style>
<? echo "dgd = ".$arResult["SECTION"]["DEPTH_LEVEL"]; ?>
<?if ($arResult["SECTION"]["DEPTH_LEVEL"] == 1) {?>
	<div id="one_list">

	<p><?=$arResult["SECTION"]["DESCRIPTION"]?></p>
	<?
	//print_r($arResult);

	$CURRENT_DEPTH=$arResult["SECTION"]["DEPTH_LEVEL"]+1;
	foreach($arResult["SECTIONS"] as $arSection):
		//print_r($arSection);
		if ($arSection["DEPTH_LEVEL"]==2)  {
			$ID_SECTION = $arSection["ID"];
			$arSectionLevel[$ID_SECTION]["NAME"] = $arSection["NAME"] ;
			$arSectionLevel[$ID_SECTION]["DESC"] = $arSection["DESCRIPTION"] ;
			$ar_result=CIBlockSection::GetList(Array("SORT"=>"ASC"), Array("IBLOCK_ID"=>"49", "ID"=>$arSection["ID"]), false,Array("UF_PP_PURPOSE","UF_CAT_PRICE","UF_CAT_DURATION", ));
			if($razdel=$ar_result->GetNext()){
				$arSectionLevel[$ID_SECTION]["PURPOSE"] = $razdel["UF_PP_PURPOSE"];
				$arSectionLevel[$ID_SECTION]["PRICE"] = $razdel["UF_CAT_PRICE"];
				$arSectionLevel[$ID_SECTION]["DURATION"] = $razdel["UF_CAT_DURATION"];

             }
		}
	?>
	<?
		if ($arSection["DEPTH_LEVEL"]==2) {?>
	    <h2><?=$arSection["NAME"]?></h2>
	    <blockquote>
	    	<?if (strlen($arSectionLevel[$ID_SECTION]["PURPOSE"])>0){?><p><?=nl2br($arSectionLevel[$ID_SECTION]["PURPOSE"])?></p><? } ?>
        <p>Общая цена: <?=$razdel["UF_CAT_PRICE"]?> р.<br />Продолжительность: <?=$razdel["UF_CAT_DURATION"]?> ч.</p>
	    <span class="links"><a href="<?=$arSection['SECTION_PAGE_URL']?>">Подробнее о классе</a></span><br>
		<?$APPLICATION->IncludeComponent("edu:iblock.element.add", ".default", Array(
			"NAV_ON_PAGE"	=>	"10",
			"USE_CAPTCHA"	=>	"N",
			"USER_MESSAGE_ADD"	=>	"Спасибо. Ваша заявка была успешно добавлена",
			"USER_MESSAGE_EDIT"	=>	"",
			"DEFAULT_INPUT_SIZE"	=>	"60",
			"IBLOCK_TYPE"	=>	"edu",
			"IBLOCK_ID"	=>	"64",
			"PROPERTY_CODES"	=>	array(
				0	=>	"NAME",
				1	=>	"248",
				2	=>	"244",
				3	=>	"246",
				4	=>	"245",
				5	=>	"247",
				6	=>	"249",
				7	=>	"",
			),
			"PROPERTY_CODES_REQUIRED"	=>	array(
				0	=>	"246",
				1	=>	"",
			),
			"PROPERTY_CODES_HIDDEN"	=>	array(
				0	=>	"248",
				1	=>	"",
			),
			"PROPERTY_TYPE_EVENT"	=>	"78",
			"PROPERTY_TEXT_TO_DO"	=>	"Записаться в класс",
			"GROUPS"	=>	array(
				0	=>	"2",
			),
			"STATUS"	=>	array(
			),
			"STATUS_NEW"	=>	"2",
			"ALLOW_EDIT"	=>	"N",
			"ALLOW_DELETE"	=>	"N",
			"ELEMENT_ASSOC"	=>	"CREATED_BY",
			"MAX_USER_ENTRIES"	=>	"100000",
			"MAX_LEVELS"	=>	"100000",
			"LEVEL_LAST"	=>	"Y",
			"MAX_FILE_SIZE"	=>	"0",
			"SEF_MODE"	=>	"N",
			"SEF_FOLDER"	=>	"/training/catalog/",
			"AJAX_MODE"	=>	"Y",
			"AJAX_OPTION_SHADOW"	=>	"Y",
			"AJAX_OPTION_JUMP"	=>	"Y",
			"AJAX_OPTION_STYLE"	=>	"Y",
			"AJAX_OPTION_HISTORY"	=>	"N",
			"CUSTOM_TITLE_NAME"	=>	"Название курса",
			"CUSTOM_TITLE_TAGS"	=>	"",
			"CUSTOM_TITLE_DATE_ACTIVE_FROM"	=>	"",
			"CUSTOM_TITLE_DATE_ACTIVE_TO"	=>	"",
			"CUSTOM_TITLE_IBLOCK_SECTION"	=>	"",
			"CUSTOM_TITLE_PREVIEW_TEXT"	=>	"",
			"CUSTOM_TITLE_PREVIEW_PICTURE"	=>	"",
			"CUSTOM_TITLE_DETAIL_TEXT"	=>	"",
			"CUSTOM_TITLE_DETAIL_PICTURE"	=>	""
			)
		);?>
		</blockquote><br />
	   <? } ?>

	<?endforeach?>
	</div>
<? } ?>






