<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<style type="text/css">


</style>



<style type="text/css">


.header_text {
	border-top:1px dashed #eee;
	background:#F9F9F7 none repeat scroll 0 0;
	margin:0 0 4px;
	padding:10px 10px 5px;
}
#content .header_text ul {
	list-style-image:url(/bitrix/templates/en/images/list_index_bigger_no_up.gif);
	list-style-position:outside;
	list-style-type:circle;
	margin:0 0 5px 20px;
}
#content .header_text ul li {
	margin:0 0 0px 10px;
}
#content .header_text  blockquote ul {
	list-style:none;
	margin:0 0 5px 0px;
}
#content .header_text blockquote ul li {
	margin:0 0 0px 0px;
}
blockquote {
	margin:0;
}
.header_accordion a.accord {
	border-bottom:1px dashed #22396D;
	margin:0 0 25px 10px;
	text-decoration:none;
}
h2 a.accord{

}
.header_accordion  {
	min-height:40px;
}
.open_header {
	background:#F9F9F7 none repeat scroll 0 0;
}
.closed_header {
	background: none;
}
</style>
<script type="text/javascript">
ddaccordion.init({
	headerclass: "header_accordion",
	contentclass: "header_text",
	revealtype: "click",
	mouseoverdelay: 200,
	collapseprev: false,
	defaultexpanded: [],
	onemustopen: false,
	animatedefault: false,
	persiststate: false,
	toggleclass: ["closed_header", "open_header"],
	togglehtml: ["prefix", "", ""],
	animatespeed: "fast", //speed of animation: integer in milliseconds (ie: 200), or keywords "fast", "normal", or "slow"
	oninit:function(headers, expandedindices){
	},
	onopenclose:function(header, index, state, isuseractivated){
	}
})

</script>




<div id="school_list">
<?$index = 0; $CURRENT_DEPTH =0; $total = 0;?>
<?
//функция для склонения слова курсы
function numDeclin($text,$type,$numero)
{
$declins = array();
$declins["I"] = array("","а","ы");
$declins["Ik1"] = array("ок","ка","ки");
$declins["Ik2"] = array("ек","ка","ки");
$declins["II"] = array("ов","","а");
$declins["IIn"] = array("й","е","я");
$declins["IIj"] = array("ев","й","я");
$declins["III"] = array("ей","ь","и");
$declins["IIIer"] = array("ерей","ь","ери");

$lc=substr($numero,strlen($numero)-1,1);
if(strlen($numero)>"1" && substr($numero,strlen($numero)-2,1)=="1")
	{$cntr = $declins[$type][0];}
elseif($lc=="1")
	{$cntr = $declins[$type][1];}
elseif($lc>"1" && $lc<"5")
	{$cntr = $declins[$type][2];}
else
	{$cntr = $declins[$type][0];}

return $numero." ".$text.$cntr;
}

$CURRENT_DEPTH=$arResult["SECTION"]["DEPTH_LEVEL"]+1;
foreach($arResult["SECTIONS"] as $arSection):
	//print_r($arSection);
	if ($arSection["DEPTH_LEVEL"]==1)  {
		$ID_SECTION = $arSection["ID"];
		$arSectionLevel[$ID_SECTION]["NAME"] = $arSection["NAME"] ;
		$arSectionLevel[$ID_SECTION]["DESC"] = $arSection["DESCRIPTION"] ;
		$ar_result=CIBlockSection::GetList(Array("SORT"=>"ASC"), Array("IBLOCK_ID"=>"49", "ID"=>$arSection["ID"]), false, Array("UF_PP_PURPOSE", "UF_IS_ONLINE"));
		if($razdel=$ar_result->GetNext()){ }
			$arSectionLevel[$ID_SECTION]["PURPOSE"] = $razdel["~UF_PP_PURPOSE"];

        //получим число классов
		$arFilter = Array(
			"IBLOCK_ID"=>49,
			"SECTION_ID"=>$arSection["ID"],
			"ACTIVE"=>"Y"
			);

		$number_of_classes = CIBlockSection::GetCount($arFilter);


	}
if ($razdel["UF_IS_ONLINE"] == 0){
?>
<?
	if($CURRENT_DEPTH<$arSection["DEPTH_LEVEL"])
		echo "<blockquote><ul>";
	elseif($CURRENT_DEPTH>$arSection["DEPTH_LEVEL"]) {
		echo str_repeat("</ul></blockquote></div><!--.w500 -->", $CURRENT_DEPTH - $arSection["DEPTH_LEVEL"]);
		echo "</div>";
		}
	if (($CURRENT_DEPTH == $arSection["DEPTH_LEVEL"]) and ($CURRENT_DEPTH == 1) and ($total>0)) {
		echo "</div>";
	}
	$CURRENT_DEPTH = $arSection["DEPTH_LEVEL"];
?>
<?if ($arSection["DEPTH_LEVEL"]==1) {?><div class=""><? $index = $index + 1; } ?>
		<?if ($arSection["DEPTH_LEVEL"]==1) {?>
		<div class="header_accordion">
			<div class="botborder_no_indent"></div>
			<div style="float:left; width:300px; "><h2 class=""><span class="header_links">
		<? } else {?>
			<li>&bull;&nbsp;
		<? } ?>
			<a class="accord" href="<?=$arSection["SECTION_PAGE_URL"]?>"><?=$arSection["NAME"]?></a>

	<?if ($arSection["DEPTH_LEVEL"]==1) {?>
			</span></h2></div>
			<div style="float:left; width:105px; ">
				<? echo numDeclin("класс", "II", $number_of_classes);?>
			</div>
			<div style="float:right; width:75px; ">
				<?if($arParams["COUNT_ELEMENTS"]):?>&nbsp;<? echo numDeclin("курс", "II", $arSection["ELEMENT_CNT"]);?><?endif;?>
			</div>
		</div>
		<div class="clear"></div>
	<? } else {?>
		</li>
	<? } ?>
	<?if ($arSection["DEPTH_LEVEL"]==1) {?>
			<?if (strlen($arSectionLevel[$ID_SECTION]["PURPOSE"])>0){?>
				<div class="header_text"><p><?=$arSectionLevel[$ID_SECTION]["PURPOSE"]?></p>
			<? } ?>
	<? } ?>

<? } ?>
<? $total = $total + 1; ?>
<?endforeach?>
<?
		echo "</ul></blockquote></div>";
        echo "</div>";

		?>
</div>

<?/*
<div class="catalog-section-list">
<ul>
<?
$CURRENT_DEPTH=$arResult["SECTION"]["DEPTH_LEVEL"]+1;
foreach($arResult["SECTIONS"] as $arSection):
	if($CURRENT_DEPTH<$arSection["DEPTH_LEVEL"])
		echo "<ul>";
	elseif($CURRENT_DEPTH>$arSection["DEPTH_LEVEL"])
		echo str_repeat("</ul>", $CURRENT_DEPTH - $arSection["DEPTH_LEVEL"]);
	$CURRENT_DEPTH = $arSection["DEPTH_LEVEL"];
?>
	<li><a href="<?=$arSection["SECTION_PAGE_URL"]?>"><?=$arSection["NAME"]?><?if($arParams["COUNT_ELEMENTS"]):?>&nbsp;(<?=$arSection["ELEMENT_CNT"]?>)<?endif;?></a></li>
<?endforeach?>
</ul>
</div>

*/?>

