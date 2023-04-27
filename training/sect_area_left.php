<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?> 
<div class="buble_body"> 
  <h2> Каталог курсов 
    <br />
   по направлениям</h2>
 <span class="links"><a id="catalog_download" data-action="CatalogDownload" data-type="Catalog" data-name="catalog_download" class="dyn-link js-tracking" href="/files/luxoft_training_catalog.pdf" target="_blank" >Cкачать в формате .pdf</a></span> </div>
 
<style>
    .usuallab {
        font-weight: normal;
        color: #00528D;
        margin-bottom: 3px;
    }
</style>
 
<script>

	
</script>
 
<div class="buble_body price-radio"> 
  <h2>Цены в городах:</h2>
 	<form> 
    <div style="margin-bottom: 3px;"><input type="radio" class="price-down" name="price-download" data-file="luxoft_training_price_moscow.xls" checked="" id="mosk-price" /> <label class="usuallab" for="mosk-price">Москва</label></div>
   
    <div style="margin-bottom: 3px;"><input type="radio" class="price-down" name="price-download" data-file="luxoft_training_price_spb.xls" id="spb-price" /> <label class="usuallab" for="spb-price">Санкт-Петербург</label></div>
   
    <div style="margin-bottom: 3px;"><input type="radio" class="price-down" name="price-download" data-file="luxoft_training_price_omsk.xls" id="omsk-price" /> <label class="usuallab" for="omsk-price">Омск</label></div>
   
    <div style="margin-bottom: 3px;"><input type="radio" class="price-down" name="price-download" data-file="luxoft_training_price_kiev.xls" id="kiev-price" /> <label class="usuallab" for="kiev-price">Киев</label></div>
   
    <div style="margin-bottom: 3px;"><input type="radio" class="price-down" name="price-download" data-file="luxoft_training_price_odessa.xls" id="odessa-price" /> <label class="usuallab" for="odessa-price">Одесса</label></div>
   
    <div style="margin-bottom: 3px;"><input type="radio" class="price-down" name="price-download" data-file="luxoft_training_price_dnepropetrovsk.xls" id="dnepr-price" /> <label class="usuallab" for="dnepr-price">Днепропетровск</label></div>
   
    <br />
   <span class="links"><a id="cat-price-download" data-action="PriceDownload" data-type="Catalog" data-name="price_download" class="dyn-link js-tracking" href="/files/luxoft_training_price_moscow.xls" >Скачать в формате .xls</a></span> 	</form></div>
<br/>
 
 <?$APPLICATION->IncludeComponent(
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