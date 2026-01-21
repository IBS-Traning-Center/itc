<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>


<?foreach($arResult["ITEMS"] as $arItem):?>

<div class=item>

<?if($arParams["DISPLAY_DATE"]!="N" && $arItem["DISPLAY_ACTIVE_FROM"]):?>
<? echo "<h5>".$arItem["DISPLAY_ACTIVE_FROM"]."</h5>";?><?endif ?>

<h3><a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><?echo $arItem["NAME"]?></a></h3>

<? $content = strip_tags(nl2br($arItem['PROPERTIES']['abstract']['VALUE']['TEXT'])); ?>

</div>

<?endforeach;?>

<p>
&#149;&nbsp;<a href=/press/press_releases.html>All Luxoft news</a><br>
&#149;&nbsp;<a href=/press/press_about_luxoft.html>Press about Luxoft</a>
</p>