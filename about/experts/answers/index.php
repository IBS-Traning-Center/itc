<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Ответы тренеров IBS Training Center на наиболее часто задаваемы вопросы в области системного и бизнес-анадиза, тестирования ПО  и разработки ПО.");
$APPLICATION->SetTitle("Ответы тренеров на вопросы");
?>
<style>
#ltr_areas_list {
width:60%!important;
}
</style>

    <div class="sp" style="float:right;">
      <a class='ask_notactive sprite1' href='/about/experts/ask/' style=''>

      </a>
    </div>



<?$APPLICATION->IncludeComponent("bitrix:support.faq", "luxtraining.experts", Array(
	"IBLOCK_TYPE" => "edu_const",	// Типы инфоблоков
	"IBLOCK_ID" => "85",	// Список инфоблоков
	"CACHE_TYPE" => "A",	// Тип кеширования
	"CACHE_TIME" => "3600",	// Время кеширования (сек.)
	"CACHE_NOTES" => "",
	"CACHE_GROUPS" => "N",	// Учитывать права доступа
	"AJAX_MODE" => "N",	// Включить режим AJAX
	"SEF_MODE" => "Y",	// Включить поддержку ЧПУ
	"SECTION" => "-",	// Список секций
	"EXPAND_LIST" => "N",	// Показывать вложенные секции
	"AJAX_OPTION_SHADOW" => "Y",	// Включить затенение
	"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
	"AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
	"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
	"AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
	"SEF_FOLDER" => "/about/experts/answers/",	// Каталог ЧПУ (относительно корня сайта)
	"SEF_URL_TEMPLATES" => array(
		"faq" => "",
		"section" => "#SECTION_ID#/",
		"detail" => "#SECTION_ID#/#ELEMENT_ID#",
	),
	"VARIABLE_ALIASES" => array(
		"faq" => "",
		"section" => "",
		"detail" => "",
	)
	),
	false
);?> 
<div class="botborder"></div>
<p> Если вы не нашли ответа на интересующий вас вопрос задайте его нашим экспертам через <a href="/about/experts/ask/" title="" >форму</a> или в письме на <a title="" href="mailto:<?=EMAIL_ADDRESS?>" ><?=EMAIL_ADDRESS?></a>.</p>
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
