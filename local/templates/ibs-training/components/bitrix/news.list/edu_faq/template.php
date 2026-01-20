<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<script type="text/javascript">
$(document).ready(function(){
    $('div.toggler-1').toggleElements(
        { fxAnimation:'slide', fxSpeed:'fast', className:'toggler' } );
	var myList = $('div.toggler-1').find('div.close');
		myList.click(function() {
 			$(this).parent().hide();
		});
});
</script>
<blockquote>
	<ul>
<? $index = 0;?>
<?foreach($arResult["ITEMS"] as $arItem):?>
<? $index=$index+1;?>
<?
 $question =$arItem['PROPERTIES']['question']['VALUE'];
 $answer =   $arItem['PREVIEW_TEXT'];
?>
    <li>
		<div class="toggler-1 opened" title="<?=$index?>. <?=$question?>">
	    	<p><?=$answer?>
	    	<?if ($USER->IsAdmin()) { ?>
				<div id="block_edit<? echo rand(); ?>" style="margin:0px; padding:0px;  class="popupitem" onclick="jsPopup.ShowDialog('/bitrix/admin/iblock_element_edit.php?type=edu&lang=ru&IBLOCK_ID=<?=$arResult[ID]?>&ID=<?=$arItem[ID]?>&filter_section=&return_url=%2F&bxpublic=Y&from_module=iblock', {'width':'700', 'height':'500', 'resize':false })"><img class="admin" src="/images/index/label_edit.jpg" width="15px" height="15px" alt="click me for edit" border="0"></div>
				<? } ?>
			</p>
	    </div>
    </li>
<?endforeach;?>
	</ul>
</blockquote>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>



