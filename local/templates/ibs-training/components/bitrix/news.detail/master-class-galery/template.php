<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<div class="photo-slider padding-bottom clearfix">
	<?foreach ($arResult["PROPERTIES"]["MORE_PICTURE"]["VALUE"] as $picture_id) {?>
		<?$preview_picture=CFile::ResizeImageGet($picture_id, array('width'=>400, 'height'=>9999), BX_RESIZE_IMAGE_PROPORTIONAL, true); 
		$detail_picture=CFile::GetPath($picture_id);
		?>
		<div class="photo-item">
			<a data-fancybox="gallery" href="<?=$detail_picture?>"><img src="<?=$preview_picture["src"]?>" /></a>
		</div>
	<?}?>
</div>