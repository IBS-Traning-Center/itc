<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div id="content" class="bg not-main-page">
		<div class="frame white-bg no-y-padding">
			<div class="blog-list">
			<?if($arParams["DISPLAY_TOP_PAGER"]):?>
				<?=$arResult["NAV_STRING"]?><br />
			<?endif;?>
			<?foreach($arResult["ITEMS"] as $arItem):?>
			<div class="blog-item">
								<h2><?echo $arItem["NAME"]?></h2>
								<div class="date-n-trainer">
									<?echo $arItem["DISPLAY_ACTIVE_FROM"]?> &nbsp;&nbsp;
								</div>
								<div class="preview-text">
									<? $content = nl2br($arItem['PROPERTIES']['abstract']['VALUE']['TEXT']); ?>
									<? if ($content=="") {} else { ?>
									<span class=""><?=$content?></span>
									<? } ?>
								</div>
								<div class="links-more">
									<a class="link-more" href="<?echo $arItem["DETAIL_PAGE_URL"]?>">Читать дальше <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
									<span class="wathers"><i class="fa fa-eye" aria-hidden="true"></i> 289</span>
									<span class="comment"><i class="fa fa-comment-o" aria-hidden="true"></i> 1</span>
								</div>
			</div>
			<?endforeach;?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>
</div>
</div>