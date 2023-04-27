
<div class="buble_body"> 
  <h2> Каталог курсов 
    <br />
   по направлениям</h2>
 <span class="links"><a id="catalog_download" data-action="CatalogDownload" data-type="Timetable" data-name="catalog_download" class="dyn-link js-tracking" href="/files/luxoft_training_catalog.pdf" target="_blank" >Cкачать в формате .pdf</a></span> 
  <br />
 <span class="links"><a href="/training/catalog_directions/" target="_blank" >Посмотреть на сайте</a></span> 
  <br />
 </div>
 <br/>
   
 <?if (strlen($_REQUEST["city"])==0 || $_REQUEST["city"]=="moscow") {?> 
<br />
 
<div class="m_banners_left_half m_banners_left_half_background "> 
  <div class="m_banners_text"> 
    <h4><i class="s-icon-yandex-widget"></i> Яндекс.Виджет</h4>
   
    <p class="s-marginleft20"> 									 <a href="http://www.yandex.ru/?add=141956&from=promocode" rel="nofollow" target="_blank" >Скидки на курсы в Москве</a> </p>
   </div>
 </div>
 	 
<br />
 <?}?> <?if ($_REQUEST["city"]=="kiev" || $_REQUEST["city"]=="odessa" || $_REQUEST["city"]=="dnepr")  {?> 
<br />
 
<div class="m_banners_left_half m_banners_left_half_background "> 
  <div class="m_banners_text"> 
    <h4><i class="s-icon-yandex-widget"></i> Яндекс.Виджет</h4>
   
    <p class="s-marginleft20"> 									 <a href="http://www.yandex.ru/?add=143003&from=promocode" rel="nofollow" target="_blank" >Скидки на курсы в Украине</a> </p>
   </div>
 </div>
 	 
<br />
 <?}?> <?$APPLICATION->IncludeComponent(
	"bitrix:advertising.banner",
	"",
	Array(
		"TYPE" => "INT_EVENTS",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "0"
	)
);?> 
<br />
 
<br />
 <?$APPLICATION->IncludeComponent(
	"bitrix:advertising.banner",
	"",
	Array(
		"TYPE" => "INT_EVENTS_SEC",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "0"
	)
);?> 
<br />
 
<br />
 <?$APPLICATION->IncludeComponent(
	"bitrix:advertising.banner",
	"",
	Array(
		"TYPE" => "INT_EVENTS_BOTTOM",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "0"
	)
);?>