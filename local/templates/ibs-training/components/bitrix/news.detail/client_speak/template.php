<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

	<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arResult["DETAIL_PICTURE"])):?>
		<img class="detail_picture" border="0" src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" width="<?=$arResult["DETAIL_PICTURE"]["WIDTH"]?>" height="<?=$arResult["DETAIL_PICTURE"]["HEIGHT"]?>" alt="<?=$arResult["DETAIL_PICTURE"]["ALT"]?>"  title="<?=$arResult["NAME"]?>" />
	<?endif?>
	<?if($arParams["DISPLAY_DATE"]!="N" && $arResult["DISPLAY_ACTIVE_FROM"]):?>
		<span class="news-date-time"><?=$arResult["DISPLAY_ACTIVE_FROM"]?></span>
	<?endif;?>
         <div class="client_info_label">Clients speak</div>

	   <?
	      $client_name = $arResult["NAME"];
	      $client_position = $arResult['PROPERTIES']['client_position']['VALUE'];
	      $client_text = nl2br($arResult['PROPERTIES']['client_text']['VALUE']['TEXT']);
	   ?>
	    <div class="client_info_about"><?=$client_text?></div>
	    <div class="client_name"><h3><?=$client_name?>,</h3><?=$client_position?></div>




