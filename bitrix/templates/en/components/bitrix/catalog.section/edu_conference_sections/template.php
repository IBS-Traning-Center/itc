<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<script type="text/javascript" src="/edu/color.js"></script>
<?$APPLICATION->AddChainItem($arResult["NAME"], "/");?>
<h2>Секция:  <?=$arResult["NAME"]?></h2><br />
<table class="edu" border="0" cellpadding="5" cellspacing="0">
	<tbody>
			<tr class="edu_header">
			<td valign="center" >
				<nobr><p align="left">№</p></nobr>
			</td>
			<td valign="center" width="70">
				<nobr><p align="left">Время проведения</p></nobr>
			</td>
			<td valign="top" width="100%">
				<p align="left">Название секции</p>
			</td>
		</tr>
		<?//print_r($arResultNAME);
		?>
		<?$index = 0;?>
		<?foreach($arResult["ITEMS"] as $cell=>$arElement):?>
        <?$index = $index + 1;?>

		<tr>
        <tr class="ewTableRow" onmouseover="ew_mouseover(this);" onmouseout="ew_mouseout(this);">
            <td><?=$index?></td>

			<td><p align="left"><?=$arElement["PROPERTIES"]["time"]["VALUE"]?></p></td>
			<td width="100%">
				<p align="left"><a href="<?=$arElement["DETAIL_PAGE_URL"]?>"><?=$arElement["NAME"]?></a></p>
				<p align="left">Докладчик: <?=$arElement["PROPERTIES"]["reporter"]["VALUE"]?></p>
			</td>
		</tr>





			</tr>


		<?endforeach; // foreach($arResult["ITEMS"] as $arElement):
		?>



</table>


