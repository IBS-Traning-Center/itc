<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="subscribe-block visible-form">
			<div class="subsribe-block-1">
				<i class="fa fa-envelope-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;<span class="sub-label">Подпишись на ежемесячный DigestLT</span>
			</div>
			<form id="subscribe-form" action="<?=$arResult["FORM_ACTION"]?>" class="subsribe-block-2">
				<input type="checkbox" class="no_redraw" style="display:none;" name="sf_RUB_ID[]" id="sf_RUB_ID_<?=$itemValue["ID"]?>" value="<?=$itemValue["ID"]?>"<?if($itemValue["CHECKED"]) echo " checked"?> />

				<div class="input-sub-wrap"><input type="text" class="subscribe" name="sf_EMAIL" placeholder="Введите адрес электронной почты"></div>
				<div class="input-button-wrap js-tracking"><button data-type="BottomForm" data-action="SubscribeClick"  class="main-button " type="submit">ПОДПИСАТЬСЯ</button></div>
			</form>
		</div>