<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<style type="text/css">
.header_text {
	margin:0px 0 0px 0px;
	padding:0 10px;
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
	margin:0 0 5px 10px;
	text-decoration:none;
}
h2 a.accord{
	color:#504E5A;
	font-size:12px;
}
.header_accordion  {
	min-height:20px;
}
.open_header {
}
.closed_header {
	background: none;
}
#school_list {
	margin:0 0 0 110px;
}
#stylized input.mybox{
	width:auto;
	float:none;
	margin:0px;
	border:0px solid #AACFE4;
}

#content .header_text blockquote ul {
	list-style-image:none;
	list-style-position:outside;
	list-style-type:none;
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
	$id_category = "";
	if ((isset($_GET["ID"]) and ($_GET["ID"]>0))) {$id_category = $_GET["ID"];}

?>
<?
	if($CURRENT_DEPTH<$arSection["DEPTH_LEVEL"])
		echo "<blockquote><ul>";
	elseif($CURRENT_DEPTH>$arSection["DEPTH_LEVEL"]) {
		echo str_repeat("</ul></blockquote></div>", $CURRENT_DEPTH - $arSection["DEPTH_LEVEL"]);
		echo "</div>";
		}
	if (($CURRENT_DEPTH == $arSection["DEPTH_LEVEL"]) and ($CURRENT_DEPTH == 1) and ($total>0)) {
		echo "</div>";
	}
	$CURRENT_DEPTH = $arSection["DEPTH_LEVEL"];
?>
<?if ($arSection["DEPTH_LEVEL"]==1) {?><div class="" style=""><? $index = $index + 1; } ?>
		<?if ($arSection["DEPTH_LEVEL"]==1) {?>
		<div class="header_accordion">
			<div class=""></div>
			<div style="float:left; width:300px; "><h2 class="">
		<? } else {?>
			<li><input type="checkbox" id="<?=$arSection['ID']?>"  <?if ($id_category == $arSection["ID"]){?>checked="checked" <? } ?>  value="" class="mybox" />
		<? } ?>
			<a class="accord" href="<?=$arSection['SECTION_PAGE_URL']?>"><?=$arSection["NAME"]?></a>

	<?if ($arSection["DEPTH_LEVEL"]==1) {?>
			</h2></div>
		</div>
		<div class="clear"></div>
	<? } else {?>
		</li>
	<? } ?>
	<?if ($arSection["DEPTH_LEVEL"]==1) {?>
			<?if (strlen($arSectionLevel[$ID_SECTION]["PURPOSE"])>0){?>
				<div class="header_text">
			<? } ?>
	<? } ?>


<? $total = $total + 1; ?>
<?endforeach?>
<?
		echo "</ul></blockquote></div>";
        echo "</div>";
?>
</div>
<script type="text/javascript" >
	$(document).ready(function() {
		$("#stylized form").submit(function() {
			var text_info = $("#school_list input:checked").next("a.accord").text();
			$("#text_schools").val(text_info)
			return true;
		});
	});
</script>




