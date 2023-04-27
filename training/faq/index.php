<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("blue_title", "Часто задаваемые вопросы");
$APPLICATION->SetPageProperty("title", "Часто задаваемые вопросы");
$APPLICATION->SetPageProperty("keywords", "оплата обучения,  online оплата,  оборудование для online обучения");
$APPLICATION->SetPageProperty("description", "Часто задаваемые вопросы по организации обучения в сфере разработки ПО");
$APPLICATION->SetTitle("Часто задаваемые вопросы");
?><?$APPLICATION->IncludeComponent("bitrix:support.faq", "luxtraining.faq", array(
	"IBLOCK_TYPE" => "edu_const",
	"IBLOCK_ID" => "72",
	"SECTION" => "-",
	"EXPAND_LIST" => "Y",
	"SHOW_RATING" => "",
	"RATING_TYPE" => "",
	"PATH_TO_USER" => "",
	"SEF_MODE" => "Y",
	"SEF_FOLDER" => "/training/faq/",
	"AJAX_MODE" => "N",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "Y",
	"AJAX_OPTION_HISTORY" => "N",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "3600",
	"CACHE_GROUPS" => "Y",
	"AJAX_OPTION_ADDITIONAL" => "",
	"SEF_URL_TEMPLATES" => array(
		"faq" => "",
		"section" => "#SECTION_ID#/",
		"detail" => "#SECTION_ID#/#ELEMENT_ID#",
	)
	),
	false
);?>
<p> Если вы не нашли ответа на интересующий вас вопрос, даже воспользовавшись поиском &ndash; задайте его через <a href="/mail/form/index.html" title="Форма обратной связи">форму</a> или в письме на <a title="Написать письмо" href="mailto:<?=EMAIL_ADDRESS?>"><?=EMAIL_ADDRESS?></a>.</p>
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
