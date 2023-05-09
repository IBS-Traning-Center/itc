<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<link rel="stylesheet" type="text/css" href="/bitrix/components/luxoft/table.list/templates/.default/style.css" />
<div class="wid-wrap">
<div class="wid-header">
	<div class="wid-h"><b>Курсы по разработке ПО</b></div>
	<div class="clear"></div>
	<div class="wid-logo">
	<a target="_blank" href="http://ibs-training.ru/?r1=javatalks&r2=widget"><img src="/images/logo_small.png" /></a>
	</div>
	<div class="link-wrap">
		<div><a target="_blank" href="http://ibs-training.ru/timetable/?r1=javatalks&r2=widget">Расписание</a></div>
		<div><a target="_blank" href="http://ibs-training.ru/training/katalog_kursov/?r1=javatalks&r2=widget">Каталог курсов</a></div>
	</div>
	<div class="clear"></div>
</div>


<div class="courses-wraper">
<div class="items">
<div class="four-it">
	<div class="count-h">
	
<?$t=0;?>
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<?$t++?>
	<?if ($t==5) {?>
		</div></div><div class="four-it"><div class="count-h">
		<?$t=1;?>
	<?}?>
	<div class="course-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
		
		<span class="course-name">
		<?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?>
			<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
				<a target="_blank" href="<?echo $arItem["DETAIL_PAGE_URL"]?>&r1=javatalks&r2=widget#tab-record-link"><?echo $arItem["NAME"]?></a>
			<?else:?>
				<b><?echo $arItem["NAME"]?></b>
			<?endif;?>
		<?endif;?>
		</span>
		<span class="date-of-course">
		<?if ($arItem["PROPERTIES"]["startdate"]["VALUE"]) {?>
			<?=$arItem["PROPERTIES"]["startdate"]["VALUE"]?><?}?><?if ($arResult["MULTI_CITY"]=="Y"){?>, <?=$arItem["PROPERTIES"]["city"]["TEXT"]?><?}?>
		</span>
	</div>
<?endforeach;?>

</div>
</div>
</div>

</div>
<script type="text/javascript" src="/bitrix/templates/.default/en/js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="/bitrix/templates/.default/en/js/jquery.tools.min.js"></script>

<script type="text/javascript">
	$(document).ready(function(){
		$('.count-h').each(function(){
			padding=(88-$(this).height())/2;
			$(this).css('padding-top', padding+'px')
		});
		$(".courses-wraper").scrollable({ vertical: true, circular: true}).autoscroll({ autoplay: true, interval: 7000 });;
	});
</script>
