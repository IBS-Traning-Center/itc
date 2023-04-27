<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<script type="text/javascript" src="/edu/color.js"></script>
<?$APPLICATION->AddChainItem($arResult["NAME"], "/");?>
<?$APPLICATION->SetTitle($arResult["NAME"]);?>
<h2>Круглый стол:  <?=$arResult["NAME"]?></h2>
<p><?=$arResult["DESCRIPTION"]?></p>
<?
   	$ar_result=CIBlockSection::GetList(Array("SORT"=>"ASC"), Array("IBLOCK_ID"=>"54", "ID"=>$arResult["ID"]), false, Array("UF_ROUNDTABLE_TIME", "UF_ROUNDTABLE_DATE" ,"UF_CITY" ));
		if($razdel=$ar_result->GetNext()){ }
		$dateofroundtable = $razdel["UF_ROUNDTABLE_DATE"];  // зададим дату круглого стола
		$timeofroundtable = $razdel["UF_ROUNDTABLE_TIME"];  // зададим дату круглого стола
		$id_city =  $razdel["UF_CITY"];
		$datecurent = date("d.m.Y");   // зададим дату СЕГОДНЯШНЮЮ
	 	$result = $DB->CompareDates($dateofroundtable, $datecurent); // сравним даты

?>
<p><strong>Дата проведения мероприятия: </strong><span id="from_event_date"><?=$dateofroundtable?></span></p>
<p><strong>Время: </strong><?=$timeofroundtable?></p>

		<?$index = 0;?>
		<?foreach($arResult["ITEMS"] as $cell=>$arElement):?>

        <?if ($index==0) {?>
		<table class="edu" border="0" cellpadding="5" cellspacing="0">
			<tbody>
				<tr class="edu_header">
					<td valign="center" width="70">
					<nobr><p align="left">Время проведения</p></nobr>
					</td>
					<td valign="top" width="100%">
						<p align="left">Название доклада</p>
					</td>
				</tr>
		<? } ?>
		        <tr class="ewTableRow" onmouseover="ew_mouseover(this);" onmouseout="ew_mouseout(this);">
					<td><p align="left"><?=$arElement["PROPERTIES"]["time"]["VALUE"]?></p></td>
					<td width="100%">
						<p align="left"><a href="<?=$arElement["DETAIL_PAGE_URL"]?>"><?=$arElement["NAME"]?></a></p>
						<p align="left">Докладчик: <?=$arElement["PROPERTIES"]["reporter"]["VALUE"]?></p>
					</td>
				</tr>

			<?$index = $index + 1;?>
		<?endforeach; // foreach($arResult["ITEMS"] as $arElement):
		?>
        <?if ($index==0) {?>
 		</table>
        <? } ?>
<?if ($result=="1"){?>
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
			3	=>	"243",
			4	=>	"245",
			5	=>	"246",
			6	=>	"247",
			7	=>	"249",
			8	=>	"",
		),
		"PROPERTY_CODES_REQUIRED"	=>	array(
			0	=>	"246",
			1	=>	"",
		),
		"PROPERTY_CODES_HIDDEN"	=>	array(
			0	=>	"248",
			1	=>	"243",
			2	=>	"",
		),
		"PROPERTY_TYPE_EVENT"	=>	"81",
		"PROPERTY_TEXT_TO_DO"	=>	"Регистрация на мероприятие",
		"GROUPS"	=>	array(
			0	=>	"2",
		),
		"STATUS"	=>	"ANY",
		"STATUS_NEW"	=>	"N",
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
<? } ?>

