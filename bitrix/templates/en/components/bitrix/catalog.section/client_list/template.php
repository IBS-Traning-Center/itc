<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<p><?=$arResult["NAV_STRING"]?></p>
<?endif?>
<table class="data-table" cellspacing="0" cellpadding="0" border="0" width="100%">
	<thead>
	<tr>
		<td><h2>Название:</h2></td>
		<?if(count($arResult["ITEMS"]) > 0):
			foreach($arResult["ITEMS"][0]["DISPLAY_PROPERTIES"] as $arProperty):?>
				<td><?=$arProperty["NAME"]?></td>
			<?endforeach;
		endif;?>
		<?foreach($arResult["PRICES"] as $code=>$arPrice):?>
			<td><?=$arPrice["TITLE"]?></td>
		<?endforeach?>
	</tr>
	</thead>
	<?  $index = 0;
		$client_name = "";
	?>
	<?if(count($arResult["ITEMS"]) < 5) {?>
		<?foreach($arResult["ITEMS"] as $arElement):?>
		<tr>
			<td>
				<span class="links"><?=$arElement["NAME"]?></span>
			</td>
		</tr>
		<?endforeach;?>
	<? } else {;?>

	<?foreach($arResult["ITEMS"] as $arElement):?>


	<? if ((($index % 2) == 0) and  ($index > 0)){?>
	<tr>
		<td width="40%">
			<span class="links"><?=$client_name?></span>
		</td>
		<td width="40%">
			<span class="links"><?=$arElement["NAME"]?></span>
		</td>
	</tr>

	 <?}?>
    	<? if (($index % 2) <> 0) {?>
		 	<?$client_name = $arElement["NAME"];?>
	  	<?}?>
	<? $index = $index + 1; ?>
	<?endforeach;?>

<? } ?>

</table>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<p><?=$arResult["NAV_STRING"]?></p>
<?endif?>

