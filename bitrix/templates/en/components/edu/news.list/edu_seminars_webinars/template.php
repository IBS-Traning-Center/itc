<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (count($arResult["ITEMS"])>0){ ?>
	<table cellSpacing="0" cellPadding="5" border="0" class="edu">
		<tr class="edu_header">
			<td valign="top" width="70%">
				<p align="left">Название мероприятия</p>
			</td>
			<td  width="100" valign="middle">
				<p align="left" style="text-align:center;"><nobr>Дата <span style="text-align:right; font-size:18px;">&#8595;</span></nobr></p>
			</td>
			<td width="120" valign="middle">
				<p align="center">Время</p>
			</td>
		</tr>
	<?foreach($arResult["ITEMS"] as $arItem):?>
		<?
			//$lecturer = $arItem['PROPERTIES']['lecturer']['VALUE'];
			$arr = ParseDateTime($arItem['PROPERTIES']['startdate']['VALUE'], "DD.MM.YYYY HH:MI:SS");
			$arItem['PROPERTIES']['startdate']['VALUE'] = $arr["DD"].".".$arr["MM"].".".$arr["YYYY"];
			?>
		<tr  class="ewTableAltRow"  onmouseover='ew_mouseover(this);' onmouseout='ew_mouseout(this);'>
			<td width="70%">
				<p align="left"><a  href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"] ?></a></p>
				<?if ($arItem['PROPERTIES']['type_event']['VALUE_ENUM_ID'] == 92){?>
					<strong>Вебинар</strong><? }else {?><strong>Семинар:</strong> <?=$arItem['PROPERTIES']['location']['VALUE']?>
				<? } ?>
				<? if (count($arResult['TRENER_INFO'][$arItem['ID']])) {?>
					<br /><b>Тренер</b>: <a class="orange" href="/about/experts/<?=$arResult['TRENER_INFO'][$arItem['ID']]['CODE']?>.html"><?=$arResult['TRENER_INFO'][$arItem['ID']]['NAME']?> <?=$arResult['TRENER_INFO'][$arItem['ID']]['~PROPERTY_EXPERT_NAME_VALUE']?></a> 
				<? } ?>
			</td>
			<td>
				<div class="nobr tocenter ">
					<nobr><?= $arItem['PROPERTIES']['startdate']['VALUE'] ?></nobr><a  data-type="SeminarList" data-action="AddToCalendar" data-name="<?= $arItem['PROPERTIES']['startdate']['VALUE'] ?> <?=$arItem["NAME"] ?>" rel="nofollow" class="js-tracking" href="/events/seminar/ics.html?ID=<?=$arItem['ID']?>" title="Добавить событие в календарь"><br /><img width="24" border="0" src="/downloads/images/47-ical_24_24.png" style="float:none;"></a>
				</div>
			</td>
			<td>
				<p align="left"><?=$arItem['PROPERTIES']['time']['VALUE'] ?> <?if ($arItem['PROPERTIES']['type_event']['VALUE_ENUM_ID'] == 92){?>(мск.)<? } ?></p>
			</td>
		</tr>
	<?endforeach;?>
	</table>
	<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
		<br /><?=$arResult["NAV_STRING"]?>
	<?endif;?>
<? } ?>

<?if (count($arResult["ITEMS"]) == 0){?>
	<h2>В ближайшее время семинары не запланированы</h2>
<? } ?>