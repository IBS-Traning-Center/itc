<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<TABLE cellSpacing="0" cellPadding="5"    border="0" class="edu">
<TR class="edu_header">
<TD vAlign=top width="100%">
<P align="left">Название конференции</P></TD>
<TD vAlign=center width=70 VALIGN="middle">
<nobr><P align="left">Дата проведения<span style="text-align:right; font-size:18px;">&#8595;</span></P></nobr></TD>
</TR>

<?foreach($arResult["ITEMS"] as $arItem):?>

         <?
	      $seminar_name = $arItem["NAME"];
	      //$program_id = $arItem["ID"];
	      $link = $arItem['PROPERTIES']['site']['VALUE'];
	      //$lecturer = $arItem['PROPERTIES']['lecturer']['VALUE'];
	      $startdate = $arItem['ACTIVE_FROM'];
	      //$description = nl2br($arItem['PROPERTIES']['description']['VALUE']);
	      //$content = nl2br($arItem['PROPERTIES']['content']['VALUE']);
	      //$time = $arItem['PROPERTIES']['time']['VALUE'];
	      //$titlefile = $arItem['PROPERTIES']['titlefile']['VALUE'];
	      //$city_id = $arItem['PROPERTIES']['cities']['VALUE'];
		?>

<TR  class="ewTableAltRow"  onmouseover='ew_mouseover(this);' onmouseout='ew_mouseout(this);'>

<TD width="100%">
<P align="left"></A><A href="<?echo $link?>"><?= $seminar_name ?></A></P><?=$location?></TD>
<TD>
<P align="left"><NOBR><?= $startdate ?></NOBR></P></TD>

</TR>


<?endforeach;?>
</TABLE>

<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>