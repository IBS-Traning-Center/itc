<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(count($arResult["ITEMS"])>0) {?>
    <div class="news-list">
		<b><?=$arResult["NAME"]?></b>
		<ul>
		<?foreach($arResult["SECTIONS"] as $section) {?>
			<li>
                <br>
                <a href="<?=$section["SECTION_PAGE_URL"]?>"><?=$section["NAME"]?></a>
            </li>
		<?};?>
		</ul>
	</div>
<?}?>
