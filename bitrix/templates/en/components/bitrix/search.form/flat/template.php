<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<link href="/bitrix/templates/prototype_3/searchfield.css" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript" src="/bitrix/templates/prototype_3/searchfield.js"></script> 

<div class="search-form">
<form action="<?=$arResult["FORM_ACTION"]?>"  id="searchform">
	<input type="text" name="q" value="" size="40" maxlength="60"  id="searchfield"  />&nbsp;
<input name="s" type="submit" value="<?=GetMessage("BSF_T_SEARCH_BUTTON");?>" />
</form>
</div>