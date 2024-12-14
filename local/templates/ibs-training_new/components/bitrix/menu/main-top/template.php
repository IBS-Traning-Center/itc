<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?CModule::IncludeModule("sale");
$cntBasketItems = CSaleBasket::GetList(
   array(),
   array( 
      "FUSER_ID" => CSaleBasket::GetBasketUserID(),
      "LID" => SITE_ID,
      "ORDER_ID" => "NULL", 
	  "CAN_BUY"=> "Y"
   ), 
   array()
);?>
<?if (!empty($arResult)):?>
<ul id="main-menu" class="hidden-970">

<?
foreach($arResult as $arItem):
	if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) 
		continue;
?>	
	<?if ($arItem["TEXT"]=="Корзина") {?>
		<li class="hidden-1170"><a <?if ($arItem["SELECTED"]) {?>class="active"<?}?> href="<?=$arItem["LINK"]?>">Корзина <span class="basket-count"><?=$cntBasketItems?></span></a> </li>
		<li class="show-inline-block-1170"><a class="basket-icon-svg" href="<?=$arItem["LINK"]?>"><svg width="23" height="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 242.47 190.87"><path fill="#003c7b" class="cls-1" d="M0,8.9c0,4.6,11.6,29.8,14.1,35.9L43.9,115c2.6,5.9,4.8,11.2,7.5,17.5,2.1,5.1,4.3,12.4,12.6,12.4H200c10.8,0,13.3-17.8-.9-18.1-39.9-.8-89.6.1-130.1.1L20.6,12.3C18,6.4,17,0,8.9,0A8.92,8.92,0,0,0,0,8.9Z"/><path fill="#003c7b" class="cls-1" d="M52,49.9H232c3.7,0,5.4-7.1,6.7-10.3,1.2-2.9,7-10.7,1.3-10.7H44c-5.7,0,.1,6.8,3.8,16.2C48.8,47.8,48.8,49.9,52,49.9Z"/><path fill="#003c7b" class="cls-1" d="M63.9,81.9h156c1.6-3,7.7-16.5,8-20H55.9C56.4,67.6,62.6,76.1,63.9,81.9Z"/><path fill="#003c7b" class="cls-1" d="M80.9,114.9h122c3.4,0,5.8-7.6,6.9-10.1,1.5-3.6,6.9-10.9,1.1-10.9H72.9c-4.7,0-1.9,4,1,10C75.5,107.1,77.3,114.9,80.9,114.9Z"/><path fill="#003c7b" class="cls-1" d="M62.9,171.9c0,27.1,36,23.1,36,1C98.9,151.2,62.9,148.3,62.9,171.9Z"/><path fill="#003c7b" class="cls-1" d="M162.9,172.9c0,23.9,36,23.7,36,0C198.9,149.9,162.9,149.3,162.9,172.9Z"/></svg><span class="basket-count"><?=$cntBasketItems?></span></a> </li>
	<?} else {?>
		<?if($arItem["SELECTED"]):?>
			<li class="hidden-750"><a class="active" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
		<?else:?>
			<li class="hidden-750"><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
		<?endif?>
	<?}?>
<?endforeach?>

</ul>
<?endif?>