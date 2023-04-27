<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<style>
.ltrnews-item_text .italic{
font-style:italic;
margin:10px 0px;
}
.ltrnews-item_text h5 {
font-size:13px;
}
</style>
<div class="ltrnews-item">

		<div class="ltrnews-item_image" >
		<?if(is_array($arResult["PREVIEW_PICTURE"])):?>

				<img class="preview_picture" border="0" src="<?=$arResult["PREVIEW_PICTURE"]["SRC"]?>" width="<?=$arResult["PREVIEW_PICTURE"]["WIDTH"]?>" height="<?=$arResult["PREVIEW_PICTURE"]["HEIGHT"]?>" alt="" title="" />

		<?endif?>
		</div>

		<div class="ltrnews-item_text" >
			<h3><?echo $arResult["NAME"]?></h3>
			<?if (strlen($arResult['PROPERTIES']['SHORT_DESC']['VALUE'])>0){?>
			<h5>О компании:</h5>
			<div class="italic"><?=$arResult['PROPERTIES']['SHORT_DESC']['VALUE']?></div>
			<? }?>
			<?echo $arResult["DETAIL_TEXT"];?>
			<?if (strlen($arResult['PROPERTIES']['PDF_FILE']['VALUE'])>0){?>
				<div class="pdf_link"><a href="<?=CFile::GetPath($arResult['PROPERTIES']['PDF_FILE']['VALUE']);?>">Читать отзыв полностью (.pdf)</a></div>
			<? }?>
		</div>
</div>
