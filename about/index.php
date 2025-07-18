<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("blue_title", "Тренинги, корпоративное обучение, консалтинг по разработке ПО");
$APPLICATION->SetPageProperty("title", "Информация об Учебном Центре Luxoft");
$APPLICATION->SetPageProperty("keywords", "обучение для разработчиков программного обеспечения,корпоративные курсы,тестировщики обучение, аналитики обучение, дистанционное обучение, ИТ конференции");
$APPLICATION->SetPageProperty("description", "Обучение для программистов: курсы, корпоративное обучение, консалтинг, конференции, бесплатные семинары и вебинары.");
$APPLICATION->SetTitle("Тренинги, корпоративное обучение, консалтинг по разработке ПО");
?> 

<div class="page_about">
   
<?// Блок - обложка раздела ?>
<section class="start bg--blue mb-0 fullwidth">
   <div class="container">
      <?$APPLICATION->IncludeComponent(
         'bitrix:breadcrumb',
         'bread',
         [
            'START_FROM' => '0',
            'PATH' => '',
            'SITE_ID' => 's1',
         ],
         false
      );?>

      <h1 class="title--h1"><?$APPLICATION->IncludeFile(SITE_DIR . 'include/about/h1-title.php', [], ['MODE' => 'html', 'NAME' => 'Заголовок']); ?></h1>

      <p><?$APPLICATION->IncludeFile(SITE_DIR . 'include/about/start-desc.php', [], ['MODE' => 'html', 'NAME' => 'Текст']); ?></p>

      <h2 class="title--h2"><?$APPLICATION->IncludeFile(SITE_DIR . 'include/about/numbers-title.php', [], ['MODE' => 'html', 'NAME' => 'Заголовок']); ?></h2>
      
      <?$APPLICATION->IncludeFile(SITE_DIR . 'include/about/numbers-list.php', [], ['MODE' => 'html', 'NAME' => 'Блок с цифрами']); ?>
   </div>
</section>


<section class="mini-gallery bg--gray spaces">
   <div class="our-students-block m-0 p-0">
      <div class="container">
         <h2 class="title--h2"><?$APPLICATION->IncludeFile(SITE_DIR . 'include/about/clients-title.php', [], ['MODE' => 'html', 'NAME' => 'Заголовок']); ?></h2>
      </div>
      
      <?php $APPLICATION->IncludeComponent(
         "bitrix:news.list",
         "our.clients",
         Array(
            "SPECIAL_TITLE"=>" ", // скрывает заголовок блока
            "ACTIVE_DATE_FORMAT" => "d.m.Y",
            "ADD_SECTIONS_CHAIN" => "N",
            "AJAX_MODE" => "N",
            "AJAX_OPTION_ADDITIONAL" => "",
            "AJAX_OPTION_HISTORY" => "N",
            "AJAX_OPTION_JUMP" => "N",
            "AJAX_OPTION_STYLE" => "Y",
            "CACHE_FILTER" => "N",
            "CACHE_GROUPS" => "Y",
            "CACHE_TIME" => "36000000",
            "CACHE_TYPE" => "A",
            "CHECK_DATES" => "Y",
            "DETAIL_URL" => "",
            "DISPLAY_BOTTOM_PAGER" => "N",
            "DISPLAY_DATE" => "Y",
            "DISPLAY_NAME" => "Y",
            "DISPLAY_PICTURE" => "Y",
            "DISPLAY_PREVIEW_TEXT" => "Y",
            "DISPLAY_TOP_PAGER" => "N",
            "FIELD_CODE" => array("",""),
            "FILTER_NAME" => "",
            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
            "IBLOCK_ID" => "63",
            "IBLOCK_TYPE" => "edu",
            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
            "INCLUDE_SUBSECTIONS" => "Y",
            "MESSAGE_404" => "",
            "NEWS_COUNT" => "500",
            "PAGER_BASE_LINK_ENABLE" => "N",
            "PAGER_DESC_NUMBERING" => "N",
            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
            "PAGER_SHOW_ALL" => "N",
            "PAGER_SHOW_ALWAYS" => "N",
            "PAGER_TEMPLATE" => ".default",
            "PAGER_TITLE" => "Новости",
            "PARENT_SECTION" => "",
            "PARENT_SECTION_CODE" => "",
            "PREVIEW_TRUNCATE_LEN" => "",
            "PROPERTY_CODE" => array("",""),
            "SET_BROWSER_TITLE" => "N",
            "SET_LAST_MODIFIED" => "N",
            "SET_META_DESCRIPTION" => "N",
            "SET_META_KEYWORDS" => "N",
            "SET_STATUS_404" => "N",
            "SET_TITLE" => "N",
            "SHOW_404" => "N",
            "SORT_BY1" => "SORT",
            "SORT_BY2" => "ID",
            "SORT_ORDER1" => "DESC",
            "SORT_ORDER2" => "ASC",
            "STRICT_SECTION_CHECK" => "N"
         )
      );?>
   </div>
</section>


<section class="page_about__desc">
   <div class="container">
      <div class="row position-relative gx-5 m-0 justify-content-lg-between">
         <div class="col-12 page_about__desc__quote">
            <div class="page_about__desc__image--mini">
               <?$APPLICATION->IncludeFile(SITE_DIR . 'include/about/page_about__desc__image.php', [], ['MODE' => 'html', 'NAME'=>'Фото']);?>
            </div>
            <div class="page_about__desc__quote__icon">
               <?$APPLICATION->IncludeFile(SITE_DIR . 'include/about/page_about__desc__quote.php', [], ['MODE' => 'html', 'NAME'=>'Иконка']);?>
            </div>
         </div>
         <div class="col-12 col-lg-9 col-xxl-6">
            <div class="page_about__desc__text">
               <?$APPLICATION->IncludeFile(SITE_DIR . 'include/about/offset_left_text.php', [], ['MODE' => 'html', 'NAME'=>'Текст']);?>
            </div>
         </div>
         <div class="col-12 col-lg-3 col-xxl-6 page_about__desc__image">
            <?$APPLICATION->IncludeFile(SITE_DIR . 'include/about/page_about__desc__image.php', [], ['MODE' => 'html', 'NAME'=>'Фото']);?>
         </div>
      </div>
   </div>
</section>


<? // Блок "25+ лет на рынке" ?>
<section class="history bg--blue spaces">
   <div class="container">
      <div class="row g-4 g-lg-5">
         <div class="col-12 col-xxl-4">
            <?$APPLICATION->IncludeFile(
               SITE_DIR . 'include/about/history_title.php', 
               [], ['MODE' => 'html', 'NAME' => 'Заголовок']);
            ?>
         </div>

         <div class="col-12 col-xxl-8">
            <?$APPLICATION->IncludeComponent(
               "bitrix:news.list",
               "history",
               Array(
                  "ACTIVE_DATE_FORMAT" => "d.m.Y",
                  "ADD_SECTIONS_CHAIN" => "N",
                  "AJAX_MODE" => "N",
                  "AJAX_OPTION_ADDITIONAL" => "",
                  "AJAX_OPTION_HISTORY" => "N",
                  "AJAX_OPTION_JUMP" => "N",
                  "AJAX_OPTION_STYLE" => "Y",
                  "CACHE_FILTER" => "N",
                  "CACHE_GROUPS" => "Y",
                  "CACHE_TIME" => "36000000",
                  "CACHE_TYPE" => "A",
                  "CHECK_DATES" => "Y",
                  "DETAIL_URL" => "",
                  "DISPLAY_BOTTOM_PAGER" => "N",
                  "DISPLAY_DATE" => "N",
                  "DISPLAY_NAME" => "Y",
                  "DISPLAY_PICTURE" => "N",
                  "DISPLAY_PREVIEW_TEXT" => "Y",
                  "DISPLAY_TOP_PAGER" => "N",
                  "FIELD_CODE" => array("NAME","PREVIEW_TEXT",""),
                  "FILTER_NAME" => "",
                  "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                  "IBLOCK_ID" => "204",
                  "IBLOCK_TYPE" => "edu_const",
                  "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                  "INCLUDE_SUBSECTIONS" => "N",
                  "MESSAGE_404" => "",
                  "NEWS_COUNT" => "6",
                  "PAGER_BASE_LINK_ENABLE" => "N",
                  "PAGER_DESC_NUMBERING" => "N",
                  "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                  "PAGER_SHOW_ALL" => "N",
                  "PAGER_SHOW_ALWAYS" => "N",
                  "PAGER_TEMPLATE" => ".default",
                  "PAGER_TITLE" => "",
                  "PARENT_SECTION" => "",
                  "PARENT_SECTION_CODE" => "",
                  "PREVIEW_TRUNCATE_LEN" => "",
                  "PROPERTY_CODE" => array("LABEL",""),
                  "SET_BROWSER_TITLE" => "N",
                  "SET_LAST_MODIFIED" => "N",
                  "SET_META_DESCRIPTION" => "N",
                  "SET_META_KEYWORDS" => "N",
                  "SET_STATUS_404" => "N",
                  "SET_TITLE" => "N",
                  "SHOW_404" => "N",
                  "SORT_BY1" => "SORT",
                  "SORT_BY2" => "SORT",
                  "SORT_ORDER1" => "ASC",
                  "SORT_ORDER2" => "ASC",
                  "STRICT_SECTION_CHECK" => "N"
               )
            );?>
         </div>
      </div>
   </div>
</section>


<?
// Блок "Наши отличия от других УЦ и почему нас выбирают"
$APPLICATION->IncludeComponent(
   "bitrix:news.list",
   "why-us-2",
   Array(
      "CUSTOM_CLASS" => "with-titles spaces",
      "ACTIVE_DATE_FORMAT" => "d.m.Y",
      "ADD_SECTIONS_CHAIN" => "N",
      "AJAX_MODE" => "N",
      "AJAX_OPTION_ADDITIONAL" => "",
      "AJAX_OPTION_HISTORY" => "N",
      "AJAX_OPTION_JUMP" => "N",
      "AJAX_OPTION_STYLE" => "Y",
      "CACHE_FILTER" => "N",
      "CACHE_GROUPS" => "Y",
      "CACHE_TIME" => "36000000",
      "CACHE_TYPE" => "A",
      "CHECK_DATES" => "Y",
      "DETAIL_URL" => "",
      "DISPLAY_BOTTOM_PAGER" => "N",
      "DISPLAY_DATE" => "N",
      "DISPLAY_NAME" => "Y",
      "DISPLAY_PICTURE" => "N",
      "DISPLAY_PREVIEW_TEXT" => "Y",
      "DISPLAY_TOP_PAGER" => "N",
      "FIELD_CODE" => array("NAME","PREVIEW_TEXT",""),
      "FILTER_NAME" => "",
      "HIDE_LINK_WHEN_NO_DETAIL" => "N",
      "IBLOCK_ID" => "205",
      "IBLOCK_TYPE" => "edu_const",
      "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
      "INCLUDE_SUBSECTIONS" => "N",
      "MESSAGE_404" => "",
      "NEWS_COUNT" => "30",
      "PAGER_BASE_LINK_ENABLE" => "N",
      "PAGER_DESC_NUMBERING" => "N",
      "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
      "PAGER_SHOW_ALL" => "N",
      "PAGER_SHOW_ALWAYS" => "N",
      "PAGER_TEMPLATE" => ".default",
      "PAGER_TITLE" => "",
      "PARENT_SECTION" => "",
      "PARENT_SECTION_CODE" => "",
      "PREVIEW_TRUNCATE_LEN" => "",
      "PROPERTY_CODE" => array("ICON",""),
      "SET_BROWSER_TITLE" => "N",
      "SET_LAST_MODIFIED" => "N",
      "SET_META_DESCRIPTION" => "N",
      "SET_META_KEYWORDS" => "N",
      "SET_STATUS_404" => "N",
      "SET_TITLE" => "N",
      "SHOW_404" => "N",
      "SORT_BY1" => "SORT",
      "SORT_BY2" => "SORT",
      "SORT_ORDER1" => "ASC",
      "SORT_ORDER2" => "ASC",
      "STRICT_SECTION_CHECK" => "N"
   )
);
?>

<? // Блок "Наши услуги"
$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"our_services",
	Array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_DATE" => "N",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "N",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array("NAME","PREVIEW_TEXT",""),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "206",
		"IBLOCK_TYPE" => "edu_const",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "N",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "30",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array("LINK",""),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "SORT",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "ASC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N"
	)
);?>


<section class="mini-gallery spaces">
   <div class="container">

      <?$APPLICATION->IncludeComponent(
         "bitrix:catalog.section.list",
         "tabs",
         Array(
            "ADDITIONAL_COUNT_ELEMENTS_FILTER" => "additionalCountFilter",
            "ADD_SECTIONS_CHAIN" => "N",
            "CACHE_FILTER" => "N",
            "CACHE_GROUPS" => "Y",
            "CACHE_TIME" => "36000000",
            "CACHE_TYPE" => "A",
            "COUNT_ELEMENTS" => "N",
            "COUNT_ELEMENTS_FILTER" => "CNT_ACTIVE",
            "FILTER_NAME" => "",
            "HIDE_SECTIONS_WITH_ZERO_COUNT_ELEMENTS" => "N",
            "HIDE_SECTION_NAME" => "N",
            "IBLOCK_ID" => "207",
            "IBLOCK_TYPE" => "edu_const",
            "SECTION_CODE" => "",
            "SECTION_FIELDS" => array("NAME", ""),
            "SECTION_ID" => "",
            "SECTION_URL" => "",
            "SECTION_USER_FIELDS" => array("", ""),
            "SHOW_PARENT_NAME" => "Y",
            "TOP_DEPTH" => "1",
            "VIEW_MODE" => "TEXT"
         )
      );
      
      $arFilter = Array('IBLOCK_ID'=>207, 'IBLOCK_TYPE'=>'edu_const');
      $arSelect = Array('ID', 'NAME', 'CODE', 'UF_SHOW_ITEMS_TEXT', 'UF_SHOW_BOTTOM_TITLE');
      $db_list = CIBlockSection::GetList(
         Array("SORT"=>"ASC"), 
         $arFilter,
         false,
         $arSelect,
         false
      );
      $tabKey = 0;
      while($ar_result = $db_list->GetNext())
      {
         ?>

         <div data-code="<?=$ar_result['CODE'];?>" <?=($tabKey > 0) ? 'style="display: none;"' : '';?>>
            <?
            $GLOBALS[ $ar_result['CODE'].'FilterTabCode' ] = array(
               "SECTION_CODE" => $ar_result['CODE'] // Символьный код раздела
            );
            
            $APPLICATION->IncludeComponent(
               "bitrix:news.list",
               "mini-gallery",
               Array(
                  "ITEMS_TEXT" => intval($ar_result['UF_SHOW_ITEMS_TEXT']),
                  "BOTTOM_TITLE" => intval($ar_result['UF_SHOW_BOTTOM_TITLE']),
                  "USE_IMAGES_GALLERY"=>"Y",
                  "ACTIVE_DATE_FORMAT" => "d.m.Y",
                  "ADD_SECTIONS_CHAIN" => "N",
                  "AJAX_MODE" => "N",
                  "AJAX_OPTION_ADDITIONAL" => "",
                  "AJAX_OPTION_HISTORY" => "N",
                  "AJAX_OPTION_JUMP" => "N",
                  "AJAX_OPTION_STYLE" => "Y",
                  "CACHE_FILTER" => "N",
                  "CACHE_GROUPS" => "Y",
                  "CACHE_TIME" => "36000000",
                  "CACHE_TYPE" => "A",
                  "CHECK_DATES" => "Y",
                  "DETAIL_URL" => "",
                  "DISPLAY_BOTTOM_PAGER" => "N",
                  "DISPLAY_DATE" => "N",
                  "DISPLAY_NAME" => "Y",
                  "DISPLAY_PICTURE" => "N",
                  "DISPLAY_PREVIEW_TEXT" => "Y",
                  "DISPLAY_TOP_PAGER" => "N",
                  "FIELD_CODE" => array("NAME","PREVIEW_TEXT","PREVIEW_PICTURE","DETAIL_PICTURE"),
                  "FILTER_NAME" => $ar_result['CODE'].'FilterTabCode',
                  "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                  "IBLOCK_ID" => "207",
                  "IBLOCK_TYPE" => "edu_const",
                  "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                  "INCLUDE_SUBSECTIONS" => "N",
                  "MESSAGE_404" => "",
                  "NEWS_COUNT" => "30",
                  "PAGER_BASE_LINK_ENABLE" => "N",
                  "PAGER_DESC_NUMBERING" => "N",
                  "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                  "PAGER_SHOW_ALL" => "N",
                  "PAGER_SHOW_ALWAYS" => "N",
                  "PAGER_TEMPLATE" => ".default",
                  "PAGER_TITLE" => "",
                  "PARENT_SECTION" => "",
                  "PARENT_SECTION_CODE" => "",
                  "PREVIEW_TRUNCATE_LEN" => "",
                  "PROPERTY_CODE" => array("",""),
                  "SET_BROWSER_TITLE" => "N",
                  "SET_LAST_MODIFIED" => "N",
                  "SET_META_DESCRIPTION" => "N",
                  "SET_META_KEYWORDS" => "N",
                  "SET_STATUS_404" => "N",
                  "SET_TITLE" => "N",
                  "SHOW_404" => "N",
                  "SORT_BY1" => "SORT",
                  "SORT_BY2" => "SORT",
                  "SORT_ORDER1" => "ASC",
                  "SORT_ORDER2" => "ASC",
                  "STRICT_SECTION_CHECK" => "N"
               )
            );
            ?>
         </div>
      <? $tabKey++;
      }
      ?>
   </div>
</section>


<?
// Блок "Отзывы и кейсы"
$APPLICATION->IncludeComponent(
   "bitrix:news.list",
   "reviews-and-cases",
   Array(
      "ACTIVE_DATE_FORMAT" => "",
      "ADD_SECTIONS_CHAIN" => "N",
      "AJAX_MODE" => "N",
      "AJAX_OPTION_ADDITIONAL" => "",
      "AJAX_OPTION_HISTORY" => "N",
      "AJAX_OPTION_JUMP" => "N",
      "AJAX_OPTION_STYLE" => "Y",
      "CACHE_FILTER" => "N",
      "CACHE_GROUPS" => "Y",
      "CACHE_TIME" => "36000000",
      "CACHE_TYPE" => "A",
      "CHECK_DATES" => "Y",
      "DETAIL_URL" => "",
      "DISPLAY_BOTTOM_PAGER" => "N",
      "DISPLAY_DATE" => "N",
      "DISPLAY_NAME" => "N",
      "DISPLAY_PICTURE" => "N",
      "DISPLAY_PREVIEW_TEXT" => "N",
      "DISPLAY_TOP_PAGER" => "N",
      "FIELD_CODE" => array("NAME","PREVIEW_TEXT","PREVIEW_PICTURE",""),
      "FILTER_NAME" => "",
      "HIDE_LINK_WHEN_NO_DETAIL" => "N",
      "IBLOCK_ID" => "82",
      "IBLOCK_TYPE" => "edu",
      "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
      "INCLUDE_SUBSECTIONS" => "N",
      "MESSAGE_404" => "",
      "NEWS_COUNT" => "30",
      "PAGER_BASE_LINK_ENABLE" => "N",
      "PAGER_DESC_NUMBERING" => "N",
      "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
      "PAGER_SHOW_ALL" => "N",
      "PAGER_SHOW_ALWAYS" => "N",
      "PAGER_TEMPLATE" => "main.pagenavigation",
      "PAGER_TITLE" => "",
      "PARENT_SECTION" => "",
      "PARENT_SECTION_CODE" => "",
      "PREVIEW_TRUNCATE_LEN" => "",
      "PROPERTY_CODE" => array("SHORT_DESC","REVIEW_USER_NAME",""),
      "SET_BROWSER_TITLE" => "N",
      "SET_LAST_MODIFIED" => "N",
      "SET_META_DESCRIPTION" => "N",
      "SET_META_KEYWORDS" => "N",
      "SET_STATUS_404" => "N",
      "SET_TITLE" => "N",
      "SHOW_404" => "N",
      "SORT_BY1" => "SORT",
      "SORT_BY2" => "SORT",
      "SORT_ORDER1" => "ASC",
      "SORT_ORDER2" => "ASC",
      "STRICT_SECTION_CHECK" => "N"
   )
);
?>


<section class="grey-page-block">
   <div class="text-page-block">
      <div class="container">
         <h2 class="title--h2 text-center"><?$APPLICATION->IncludeFile(SITE_DIR . 'include/about/learn-title.php', [], ['MODE' => 'html', 'NAME' => 'Заголовок']); ?></h2>
      </div>
   </div>
</section>


<?$APPLICATION->IncludeComponent(
   "bitrix:form.result.new",
   "main.feedback",
   array(
      "CUSTOM_CLASSES" => "bg--blue",
      "CACHE_TIME" => "3600",
      "CACHE_TYPE" => "A",
      "CHAIN_ITEM_LINK" => "",
      "CHAIN_ITEM_TEXT" => "",
      "EDIT_URL" => "",
      "IGNORE_CUSTOM_TEMPLATE" => "N",
      "LIST_URL" => "",
      "SEF_MODE" => "N",
      "SUCCESS_URL" => "",
      "AJAX_MODE" => "Y",
      "USE_EXTENDED_ERRORS" => "N",
      "VARIABLE_ALIASES" => array("RESULT_ID" => "RESULT_ID", "WEB_FORM_ID" => "WEB_FORM_ID"),
      "WEB_FORM_ID" => "39"
   )
);?>


</div>

<!-- <table cellspacing="0" class="info_1"> 
  <tbody> 
    <tr><td class="facts" style="border: medium none;"> 
        <h2 align="left">Приветствие Директора 
          <br />
         </h2>
       
        <p>Добро Пожаловать в IBS Training Center!
          <br />
         </p>
       
        <p>Я имею честь представить нашу организацию, которая предлагает вам опыт и знания компании Luxoft. 
          <br />
         <span class="links"><a href="/about/greeting" >Подробнее</a></span></p>
       </td><td class="facts"> 
        <h2 align="left">Почему IBS Training Center</h2>
       
        <p>IBS Training Center опирается на талант IT-специалистов высокого класса.</p>
       
        <p>Мы &ndash; это экспертиза, практика, гибкость, результат. 
          <br />
         <span class="links"><a href="/about/why" >Подробнее</a></span> </p>
       </td></tr>
   
    <tr><td class="facts"> 
        <h2 align="left">Эксперты-тренеры</h2>
       
        <p>Более 40 ведущих специалистов компании Luxoft читают курсы в IBS Training Center и консультируют наших клиентов. 
          <br />
         <span class="links"><a href="/about/experts/" >Подробнее</a></span></p>
       </td><td class="facts"> 
        <h2 align="left">Клиенты </h2>
       
        <p>На данный момент экспертизой IBS Training Center воспользовались более 300 компаний как в России, так и за рубежом.
          <br />
         <span class="links"><a href="/about/clients/" >Подробнее</a></span> </p>
       </td></tr>
   
    <tr><td class="facts"> 
        <h2 align="left">Партнеры </h2>
       
        <p>Мы рады предложить партнерство нашим коллегам – Учебным Центрам, а также ИТ-сообществам, порталам, ИТ-клубам. 
          <br />
         <span class="links"><a href="/about/partners/" >Подробнее</a></span></p>
       </td><td class="facts"> 
        <h2 align="left">Филиалы</h2>
       
        <p>Центры обучения расположены в Москве, Санкт-Петербурге, Омске.
          <br />
         <span class="links"><a href="/contacts/" >Подробнее</a></span> </p>
       </td></tr>
   </tbody>
 </table> -->


 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>