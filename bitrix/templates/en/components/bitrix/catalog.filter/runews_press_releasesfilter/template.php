<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<form name="<?=$arResult["FILTER_NAME"]."_form"?>" action="" method="post">
    <table class="data-table" cellspacing="0" cellpadding="2">
	<tbody>
		<?foreach($arResult["ITEMS"] as $arItem):?>
			<?if(!array_key_exists("HIDDEN", $arItem)):?>
				<tr>
					<td valign="top"><?=$arItem["INPUT"]?></td>
				</tr>
			<?endif?>
		<?endforeach;?>
	</tbody>
	<tfoot>
		<tr>
			<td colspan="2">
			<input type="submit" name="set_filter" value="Выбрать новости" /><input type="hidden" name="set_filter" value="Y" />&nbsp;&nbsp;</td>
		</tr>
	</tfoot>
	</table>
</form>
