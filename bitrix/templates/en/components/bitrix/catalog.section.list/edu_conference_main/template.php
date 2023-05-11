<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>


<? // print_r($arResult);
?>
<h2>Расписание Конференции:</h2>
<script type="text/javascript" src="/edu/color.js"></script>
	<table class="edu" border="0" cellpadding="5" cellspacing="0">
		<tbody>
		<tr class="edu_header">
			<td valign="top" width="100%">
				<p align="left">Название секции</p>
			</td>
			<td valign="center" width="70">
				<nobr><p align="left">Дата проведения</p></nobr>
			</td>
			<td valign="center" width="70"><p align="center">Время</p></td>
		</tr>

<?
$CURRENT_DEPTH=$arResult["SECTION"]["DEPTH_LEVEL"]+1;
foreach($arResult["SECTIONS"] as $arSection):
/*	if($CURRENT_DEPTH<$arSection["DEPTH_LEVEL"])
		echo "<ul>";
	elseif($CURRENT_DEPTH>$arSection["DEPTH_LEVEL"])
		echo str_repeat("</ul>", $CURRENT_DEPTH - $arSection["DEPTH_LEVEL"]);
	$CURRENT_DEPTH = $arSection["DEPTH_LEVEL"];*/
	 //print_r($arSection["DEPTH_LEVEL"]);
?>


<?if ($arSection["DEPTH_LEVEL"]=="2"){?>
        <tr class="ewTableRow" onmouseover="ew_mouseover(this);" onmouseout="ew_mouseout(this);">
			<td width="100%">
				<p align="left"><a href="<?=$arSection["SECTION_PAGE_URL"]?>"><?=$arSection["NAME"]?></a></p></td>
			<td><p align="left"><nobr>28.06.2008</nobr></p></td>
			<td><p align="left"><nobr>9:00 - 19:00</nobr></p></td>
		</tr>
<? } ?>

<?endforeach?>

</tbody></table>
