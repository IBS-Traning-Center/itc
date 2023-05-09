<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<style>
.nameFaq{
	padding-bottom:4px;
}
</style>
<?//elements list?>
<a name="top"></a>
<? //iwrite($arResult['ITEMS']);
?>
<?foreach ($arResult['ITEMS'] as $key=>$val):?>
	<li class="point-faq"><a href="<?=$val["ID"]?>/"><?=$val['NAME']?></a><br/>

<? if ($val['DETAIL_TEXT']){?><div style="padding-left:13px;"><?=$val['DETAIL_TEXT']?></div><? } ?>
<? if ($val['PREVIEW_TEXT']){?><div  style="margin: 3px 0 0 10px;" class="links"><a href="<?=$val["ID"]?>/">подробнее</a></div><? } ?>
<br />
</li>
<?endforeach;?>
<br/>