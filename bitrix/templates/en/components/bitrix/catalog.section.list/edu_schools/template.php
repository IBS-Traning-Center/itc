<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<style type="text/css">
#content #school_list ul li {
	margin-bottom:0px;
}
#content #school_list ul ul {
	margin:5px 0 30px 40px;
}
#content blockquote ul li {
	margin-bottom:2px;
}

</style>
<div id="school_list">
<?$index = 0; $CURRENT_DEPTH =0; $total = 0;?>
<?
$CURRENT_DEPTH=$arResult["SECTION"]["DEPTH_LEVEL"]+1;
foreach($arResult["SECTIONS"] as $arSection):
	//print_r($arSection);
	if ($arSection["DEPTH_LEVEL"]==1)  {
		$ID_SECTION = $arSection["ID"];
		$arSectionLevel[$ID_SECTION]["NAME"] = $arSection["NAME"] ;
		$arSectionLevel[$ID_SECTION]["DESC"] = $arSection["DESCRIPTION"] ;
		$ar_result=CIBlockSection::GetList(Array("SORT"=>"ASC"), Array("IBLOCK_ID"=>"49", "ID"=>$arSection["ID"]), false, Array("UF_PP_PURPOSE" ));
		if($razdel=$ar_result->GetNext()){ }
			$arSectionLevel[$ID_SECTION]["PURPOSE"] = $razdel["~UF_PP_PURPOSE"];
	}
?>
<?
	if($CURRENT_DEPTH<$arSection["DEPTH_LEVEL"])
		echo "<blockquote><ul>";
	elseif($CURRENT_DEPTH>$arSection["DEPTH_LEVEL"]) {
		echo str_repeat("</ul></blockquote>", $CURRENT_DEPTH - $arSection["DEPTH_LEVEL"]);
		echo "</div>";
		if ($index == 2)  {?><div class="clear botborder"> </div><? $index =0; }
		}
	if (($CURRENT_DEPTH == $arSection["DEPTH_LEVEL"]) and ($CURRENT_DEPTH == 1) and ($total>0)) {
		echo "</div>";
		if ($index == 2)  {?><div class="clear botborder"> </div><? $index =0; }
	}
	$CURRENT_DEPTH = $arSection["DEPTH_LEVEL"];
?>
<?if ($arSection["DEPTH_LEVEL"]==1) {?><div class="w360 l" style=""><? $index = $index + 1; } ?>
		<?if ($arSection["DEPTH_LEVEL"]==1) {?><h2 class="underline"><? } else {?><li><? } ?><a href="<?=$arSection["SECTION_PAGE_URL"]?>"><?=$arSection["NAME"]?><?if($arParams["COUNT_ELEMENTS"]):?>&nbsp;(<?=$arSection["ELEMENT_CNT"]?>)<?endif;?></a>

	<?if ($arSection["DEPTH_LEVEL"]==1) {?></h2><? } else {?></li><? } ?>
	<?if ($arSection["DEPTH_LEVEL"]==1) {?>
			<?if (strlen($arSectionLevel[$ID_SECTION]["PURPOSE"])>0){?>
				<div class="w350"><p><?=nl2br($arSectionLevel[$ID_SECTION]["PURPOSE"])?></p></div>
			<? } ?>
			<?if (strlen($arSection["PICTURE"]["SRC"])>0){?>
				<div style="width:100px; float:right;"><img src="<?=$arSection['PICTURE']['SRC']?>" width="<?=$arSection['PICTURE']['WIDTH']?>" height="<?=$arSection['PICTURE']['HEIGHT']?>" alt="" style="border:1px solid #999999; vertical-align:top;" border="0">
				</div>
				<div class="clear"></div>
			<? } ?>
	<? } ?>


<? $total = $total + 1; ?>
<?endforeach?>
<?
		echo "</ul></blockquote>";
        echo "</div>";

		?>
<? if ($index == 1)  {?><div class="clear botborder"> </div><? } ?>
</div>
