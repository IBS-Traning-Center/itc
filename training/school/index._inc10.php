<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?> 
<div class="buble_body"> 
  <h2>Подписка на рассылку</h2>
 <?$APPLICATION->IncludeComponent("bitrix:subscribe.form", "simple_form", Array(
	"USE_PERSONALIZATION" => "Y",	// Определять подписку текущего пользователя
	"SHOW_HIDDEN" => "N",	// Показать скрытые рубрики подписки
	"PAGE" => "#SITE_DIR#subscr_edit.html",	// Страница редактирования подписки (доступен макрос #SITE_DIR#)
	"CACHE_TYPE" => "A",	// Тип кеширования
	"CACHE_TIME" => "3600",	// Время кеширования (сек.)
	),
	false
);?>   
  <div class="clear"> </div>
 </div>
 