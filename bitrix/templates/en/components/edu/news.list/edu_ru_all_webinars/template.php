<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<script type="text/javascript" src="/edu/color.js"></script>

<TABLE cellSpacing="0" cellPadding="5"    border="0" class="edu">
<TR class="edu_header">
<TD vAlign=top width="100%">
<P align="left">Название вебинара</P></TD>
<TD vAlign=center width=70 VALIGN="middle">
<nobr><P align="left">Дата <span style="text-align:right; font-size:18px;">&#8595;</span></P></nobr></TD>
<TD vAlign=center width=70 VALIGN="middle">
<P align=center>Время</P></TD></TR>

<?foreach($arResult["ITEMS"] as $arItem):?>

         <?
	      $seminar_name = $arItem["NAME"];
	      //$program_id = $arItem["ID"];
	      $location = $arItem['PROPERTIES']['location']['VALUE'];
	      //$lecturer = $arItem['PROPERTIES']['lecturer']['VALUE'];
	      $startdate = $arItem['PROPERTIES']['startdate']['VALUE'];
	      //$description = nl2br($arItem['PROPERTIES']['description']['VALUE']);
	      //$content = nl2br($arItem['PROPERTIES']['content']['VALUE']);
	      $time = $arItem['PROPERTIES']['time']['VALUE'];
	      //$titlefile = $arItem['PROPERTIES']['titlefile']['VALUE'];
	      //$city_id = $arItem['PROPERTIES']['cities']['VALUE'];

		?>
<TR  class="ewTableAltRow"  onmouseover='ew_mouseover(this);' onmouseout='ew_mouseout(this);'>

<TD width="100%">
<P align="left"></A><A href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><?= $seminar_name ?></A></P><?=$location?></TD>
<TD>
<P align="left"><NOBR><?= $startdate ?></NOBR></P></TD>
<TD>
<P align="left"><NOBR><?= $time ?></NOBR></P></TD>
</TR>


<?endforeach;?>
</TABLE>

<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>