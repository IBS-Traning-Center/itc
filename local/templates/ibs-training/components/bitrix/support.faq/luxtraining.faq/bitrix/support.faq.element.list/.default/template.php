<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<style>
.nameFaq{
	padding-bottom:4px;
}
</style>
<?//elements list?>
<a name="top"></a>
<?foreach ($arResult['ITEMS'] as $key=>$val):?>
	<li class="point-faq"><a href="#<?=$val["ID"]?>"><?=$val['NAME']?></a><br/></li>
<?endforeach;?>
<br/>
<?foreach ($arResult['ITEMS'] as $key=>$val):?>
<a name="<?=$val["ID"]?>"></a>
<table cellpadding="0" cellspacing="0"  width="100%">
	<tr>
		<th class="nameFaq">
		<?
		//add edit element button
		if(isset($val['EDIT_BUTTON']))
			echo $val['EDIT_BUTTON'];
		?>
		<span class=""><?=$val['NAME']?></span>
		</th>
	</tr>
	<tr>
		<td>
		<?=$val['PREVIEW_TEXT']?>
		<?=$val['DETAIL_TEXT']?>
		<br/>
		<a href="#top"><?=GetMessage("SUPPORT_FAQ_GO_UP")?></a>
		</td>
	</tr>
	<tr>
      <td background="/bitrix/templates/en/components/bitrix/support.faq/luxtraining.faq/bitrix/support.faq.element.list/.default/mc_b.gif"><img width="4" height="23" src="/bitrix/templates/en/components/bitrix/support.faq/luxtraining.faq/bitrix/support.faq.element.list/.default/mc_b.gif"></td>
    </tr>
</table>
<br/>
<?endforeach;?>