<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<? /*,http://jquery.bassistance.de/treeview/lib/jquery.cookie.js http://jquery.bassistance.de/treeview/jquery.treeview.js
		persist: "cookie"*/?>

<script src="/bitrix/templates/en/js/jquery.cookie.js" type="text/javascript"></script>
<script src="/bitrix/templates/en/js/jquery.treeview.js" type="text/javascript"></script>
<script>
$(document).ready(function(){
	$("#navigation").treeview({
		collapsed: false,
		persist: "cookie"

	});
});
</script>
<style>
.ie7 #tr_catalog{
	margin:0 0 0px -10px;
}
#content ul#navigation{margin:0 0 10px -10px; list-style:none outside none;}
.ie7 #content ul#navigation{
	margin:0 0 10px 0px;
	padding: 0px 0 0px 0px;
}
#content ul#navigation li ul{margin:3px 0 10px 20px;}
.ie7 #content ul#navigation li ul{
	margin:3px 0 10px 10px;
	background:none repeat scroll 0 0 #F9F9F7;
}
#content ul#navigation ul{list-style:none outside none;margin:5px 0 0 40px;}
#content ul#navigation ul li{list-style:none outside none;}
#content ul#navigation li  span{border-bottom:1px dashed #22396D;}
ul#navigation li{
	border-bottom:1px solid #CCCCCC;
	margin:0 0 5px 10px;
	text-decoration:none;
	color:#22396D;
	font-size:18px;
	padding:6px 0 5px 25px;
	font-weight:normal;
	list-style:none outside none;
	background:none repeat scroll 0 0 #F9F9F7;
}
ul#navigation li.collapsable{}
ul#navigation li ul li{
	border-bottom:0 dashed #EEEEEE;
	margin:0 0 0 0;
	text-decoration:none;
	color:#22396D;
	font-size:15px;
	padding:0 0 5px;
	background:none repeat scroll 0 0 #F9F9F7;
}
ul#navigation li ul li ul li{
	border-bottom:0 dashed #EEEEEE;
	margin:0 0 0 0;
	text-decoration:none;
	color:#22396D;
	font-size:13px;
	padding:0 0 1px;
	background:none repeat scroll 0 0 #F9F9F7;
}
ul#navigation li a{font-size:12px;font-weight:normal; text-decoration:underline;}
.treeview,.treeview ul{padding:0;margin:0;}
.treeview ul{margin-top:4px;background:white;}
.treeview .hitarea{
	height:16px;

	margin-left:-16px;
	margin-top:4px;
	float:left;
	cursor:pointer;
	/*width:150px;
	position:absolute;*/
	width:15px
}
/* fix for IE6 */
* html .hitarea{display:inline;float:none;}
.treeview li{margin:0;padding:3px 0 3px 16px;}
.treeview a.selected{background:#eee;}
#treecontrol{margin:1em 0;display:none;}
.treeview .hover{color:#FC711B;cursor:pointer;}
.treeview li{}
.treeview li.collapsable,.treeview li.expandable{background:0 -176px;}

ul.treeview li .expandable-hitarea{
	background:url(/bitrix/templates/en/images/but_plus.gif) no-repeat;
}
ul.treeview li .collapsable-hitarea{
	background:url(/bitrix/templates/en/images/but_minus.gif) no-repeat;
}


/*
ul.treeview li ul li .expandable-hitarea{
	background:url(/bitrix/templates/en/images/but_minus.gif) no-repeat;
}
ul.treeview li ul li .collapsable-hitarea{
	background:url(/bitrix/templates/en/images/but_plus.gif) no-repeat;
}
*/


.ie7 #content ul#navigation li{

}
.treeview li.last{background:0 -1766px;}
.treeview li.lastCollapsable,.treeview li.lastExpandable{}
.treeview li.lastCollapsable{background:0 -111px;}
.treeview li.lastExpandable{background:-32px -67px;}

.treeview-red li{}
.treeview-red .hitarea,.treeview-red li.lastCollapsable,.treeview-red li.lastExpandable{}
.treeview-black li{}
.treeview-black .hitarea,.treeview-black li.lastCollapsable,.treeview-black li.lastExpandable{}
.treeview-gray li{}
.treeview-gray .hitarea,.treeview-gray li.lastCollapsable,.treeview-gray li.lastExpandable{}
.treeview .placeholder{height:16px;width:16px;display:block;}
.filetree li{padding:3px 0 2px 16px;}
.filetree span.folder,.filetree span.file{padding:1px 0 1px 16px;display:block;}
.filetree span.folder{}
.filetree li.expandable span.folder{}
.filetree span.file{}

.clases_wrapper {
    font-size: 12px;
    font-weight: normal;
    color: #8a8787;
    /*color: #000;*/
}
.ie7 .clases_wrapper {
	position:relative;
}
.w30 { width: 30px; }
.w30 { width: 30px; }
.w40 { width: 40px; }
.w335 { width: 345px; }
.w425 { width: 425px; }
.tr_school{
	font-weight:bold;
	color:black;
}
.first_one{
	font-weight:bold;
}
.twoplus{
	font-weight:bold;
}
a.orange:link, a.orange:visited {
    text-decoration: none;
}
#content ul#navigation li span.count_elements {
    border-bottom: 0px dashed #22396D;
}
#content ul#navigation li span.go_to_link {
    border-bottom: 0px dashed #22396D;
}
.ie7 .ie_count{
display:inline!important;
float:none!important;
position:absolute;
right:190px;
}
</style>
<?//iwrite($arResult["ELEMENTS"]);?>

<div id="tr_catalog">
<ul id="navigation">
<?
$bFlagIsCourse = false;
$bPreviousIsCourse  = false;
$previousLevel = 0;
$vTotalPrice = 0;
$vTotalPriceUA = 0;
$vTotalDuration = 0;
$bClassPrevious = "";
foreach($arResult["ITEMS"] as $arSection):?>

	<?
	$findme   = 'Класс';
	$pos = strpos($arSection["NAME"], $findme);
	?>
	<?
	if ($arSection["IS_COURSE"] === "Y"){
		$bFlagIsCourse = true;
	}else {
		$bFlagIsCourse = false;
	}

	?>
	<? if ($arSection["ELEMENT_CNT"] !== "0"){?>		
		<?
		if (($bPreviousIsCourse === true) and ($bFlagIsCourse === false) and ($bClassPrevious !== false)){?>
			<div class="clases_wrapper" style="border-bottom:0; background:#F9F9F7;">

				<div class="l w425 toright"><strong class="r">Всего:&nbsp;&nbsp;</strong></div>
				<div class="l w65 toright"><strong><?=$vTotalPrice?> р.</strong></div>
				<div class="l w65 toright"><strong><?=$vTotalPriceUA?> грн.</strong></div>

				<div class="l w40 toright"><strong><?=$vTotalDuration?> ч.</strong></div>



				<div class="clear"></div>
			</div>
		<? } ?>
		<?
		if (!$bFlagIsCourse){
			$vTotalDuration = 0;
			$vTotalPrice =0;
			$vTotalPriceUA =0;
		}
		?>

		<?if ($previousLevel && $arSection["DEPTH_LEVEL"] < $previousLevel):?>
			<?=str_repeat("</ul></li>", ($previousLevel - $arSection["DEPTH_LEVEL"]));?>
		<?endif?>
		<?if (!$bFlagIsCourse):?>
			<li id="cat_<?=$arSection['ID']?>" class="<?if ($arSection["DEPTH_LEVEL"] > 1){?>closed<? } else {?>closed<? } ?>"><span class="<?if ($arSection["DEPTH_LEVEL"] === "1"){?>first_one <? } else {?>twoplus <? } ?><?if ($pos !== false) {?>tr_school<? } ?>"><?=$arSection["NAME"]?></span>

					<?if ($pos !== false) {?>
						
						<span class="go_to_link"><a class="orange" title="см. подробную информацию о всех курсах, входящих  в раздел <?=$arSection['NAME']?>" href="/training/catalog/code/<?=$arSection['CODE']?>/">
						<img border="0" alt="" height="16" width="16" src="/downloads/images/1292491977_note-information.png" /></a>
						</span>
					<? } ?>
						<?if ($arSection["DEPTH_LEVEL"] === "1") {?>
							<div style="display:block; float:right;" class="ie_count"><span class="count_elements" style="text-align:right;">
							<?=$arSection["ELEMENT_CNT"]?> <?echo getCountVal($arSection["ELEMENT_CNT"], array("курс","курса","курсов"));?>
							&nbsp;</div></span><div class="clear"></div>
<div style="font-size:12px; line-height: 140%;color:#555555;"><?=$arSection["DESCRIPTION"]?></div>
<div class="clear"></div>

						<? } ?>
					
					
						<ul>
					
			<?else:?>
			<li>
				<?if ($bFlagIsCourse){?>
					<div class="clases_wrapper">
						<div class="l <?if ($arSection["DEPTH_LEVEL"] == 4){?>w425<?}else {?>w445<? } ?>"><?=$arSection['PROPERTY_PP_COURSE_CODE']?> <a class="goaway" title="" href="/training/catalog/course.html?ID=<?=$arSection['PROPERTY_PP_COURSE_VALUE']?>"><?=$arSection['PROPERTY_PP_COURSE_NAME']?></a></div>
						<div class="l toright w65">&nbsp;<?/*if ($arSection['PARAM']['PROPERTY_COURSE_PRICE_UA_VALUE']){?><?=$arSection['PARAM']['PROPERTY_COURSE_PRICE_UA_VALUE']?> грн.<? } */?></div>
						<div class="l toright w65"><?/*=$arSection['PARAM']['PROPERTY_COURSE_PRICE_VALUE']?> р.<?*/?></div>
						
						<div class="l toright w40"><?=$arSection['PARAM']['PROPERTY_COURSE_DURATION_VALUE']?> ч.</div>


					</div>
					<div class="clear"></div>
					<?
						$vTotalPrice = $vTotalPrice + $arSection['PARAM']['PROPERTY_COURSE_PRICE_VALUE'];
						$vTotalPriceUA = $vTotalPriceUA + $arSection['PARAM']['PROPERTY_COURSE_PRICE_UA_VALUE'];
						$vTotalDuration = $vTotalDuration + $arSection['PARAM']['PROPERTY_COURSE_DURATION_VALUE'];
					?>
				<? } ?>
			</li>
		<?endif?>
	<? } else { ?>
		<?if ($previousLevel && $arSection["DEPTH_LEVEL"] < $previousLevel):?>
			</ul></li>
		<?endif?>	
	<? } ?>
	<?$previousLevel = $arSection["DEPTH_LEVEL"];?>
	<?$bPreviousIsCourse = $bFlagIsCourse;?>
	<?if (!$bFlagIsCourse){?>
		<?$bClassPrevious = $pos;?>
	<? } ?>

<?endforeach?>
<?if ($previousLevel > 1)://close last item tags?>
	<?=str_repeat("</ul></li>", ($previousLevel-1) );?>
<?endif?>
</ul></li>
</ul>
</div>