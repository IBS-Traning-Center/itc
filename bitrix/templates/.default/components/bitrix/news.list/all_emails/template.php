<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="news-list">
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>
<table class="edu" cellspacing=0 cellpadding=0>
<tr class="edu_header">
<td>Имя</td>
<td>Email</td>
<td>Город</td>
<td>Телефон</td>
<td>Компания</td>
<td>Должность</td>
</tr>
<?foreach($arResult["ITEMS"] as $arItem):?>
<? //iwrite(arItem);
?>


<tr>
<td><?=$arItem["PROPERTIES"]["fullname"]["VALUE"]?></td>
<td><?=$arItem["PROPERTIES"]["email"]["VALUE"]?></td>
<td><?=$arItem["PROPERTIES"]["city"]["VALUE"]?></td>
<td><?=$arItem["PROPERTIES"]["telephone"]["VALUE"]?></td>
<td><?=$arItem["PROPERTIES"]["company"]["VALUE"]?></td>
<td><?=$arItem["PROPERTIES"]["dolgnost"]["VALUE"]?></td>
</tr>



<?endforeach;?>
</table>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>
