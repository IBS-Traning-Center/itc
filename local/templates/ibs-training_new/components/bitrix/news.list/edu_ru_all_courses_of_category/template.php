<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
	//$APPLICATION->SetTitle($arResult['NAME']);
	//iwrite($arResult);
?>
<table cellSpacing="0" cellPadding="5"  border="0" class="edu">
	<tr class="edu_header">
		<td>
			<p><nobr>Код курса</nobr></p>
		</td>
		<td vAlign=top width="100%">
			<p>Название курса</p>
		</td>
		<td vAlign=center width=70 VALIGN="middle">
			<p class="nobr">Продол-ть</p>
		</td>
		<td vAlign=center width=70 VALIGN="middle">
			<p class="nobr">Цена</p>
		</td>
	</tr>
 <?//print_r($arResult);?>
<?foreach($arResult["ITEMS"] as $arItem):?>
        <?
	      $course_duration = $arItem['PROPERTIES']['course_duration']['VALUE'];
	      $course_price = $arItem['PROPERTIES']['course_price']['VALUE'];
	      $course_code = $arItem['PROPERTIES']['course_code']['VALUE'];
	      $course_id = $arItem["ID"];
        ?>
		<tr  class="ewTableAltRow"  onmouseover='ew_mouseover(this);' onmouseout='ew_mouseout(this);'>
			<td class="td_code" width=70>
				<p class="nobr"><?echo $course_code?></p>
			</td>
			<td vAlign=top width="100%">
				<p class=""><a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><?echo $arItem["NAME"]?></a></p>
			</td>
			<td vAlign=center width=70>
				<p class="nobr"><?=$course_duration?> ч.</p>
			</td>
			<td vAlign=center width=70>
				<p class="nobr"><?if (strlen($course_price)>0){?><?=$course_price?> р.<? } ?></p>
			</td>
		</tr>
<?endforeach;?>
</table>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>

