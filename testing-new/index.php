<?php

use Bitrix\Main\Page\Asset;

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

global $APPLICATION;

Asset::getInstance()->addCss(SITE_DIR . 'local/assets/css/testing/testing.css');

$APPLICATION->SetPageProperty('BANNER_TITLE', 'Разработка тестов для IT-специалистов по ключевым компетенциям');
$APPLICATION->SetPageProperty('BACKGROUND_COLOR_BANNER', '#F8F7F7');
$APPLICATION->SetTitle('Тестирование сотрудников IT-подразделения');
?>

<?// Блок - обложка раздела ?>
<section class="start bg--gray">
    <a href="./start-image.jpg" class="start__image h-100 d-none d-xxl-block" target="_blank" data-fancybox>
        <img src="./start-image.jpg" alt="Оценка, тестирование и сертификация IT-специалистов">
    </a>

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

      <h1 class="title--h1">
      <?php $APPLICATION->IncludeFile(SITE_DIR . 'include/testing-new/h1-title.php', [], 
                    ['MODE' => 'html', 'NAME' => 'Заголовок']); ?>
        </h1>

      <p>
      <?php $APPLICATION->IncludeFile(SITE_DIR . 'include/testing-new/under-h1-text.php', [], 
                    ['MODE' => 'html', 'NAME' => 'Заголовок']); ?>
        </p>
      
      <div class="row g-1 g-md-3 g-lg-32">
      <?
		$arFilter = Array("IBLOCK_ID"=>193);
		$arSelect = Array("ID", "NAME", "PREVIEW_PICTURE", "PROPERTY_LINK", "PROPERTY_TARGET");
		$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
		while($ob = $res->GetNextElement())
		{
			$arFields = $ob->GetFields();

			?>
			<div class="col-auto">
				<a href="<?=$arFields['PROPERTY_LINK_VALUE']?>" <?=($arFields['PROPERTY_TARGET_VALUE'] == 'Да') ? ' target="_blank"' : '' ?> class="btn--white">
					<img src="<?=CFile::GetPath($arFields['PREVIEW_PICTURE']);?>" alt="<?=$arFields['NAME']?>">

					<?=$arFields['NAME']?>
				</a>
			</div>
			<?
		}
		?>
        </div>
   </div>
</section>


<? // Блок "Фундаментально. Объективно. Честно."
$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"fundamental",
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
		"IBLOCK_ID" => "192",
		"IBLOCK_TYPE" => "edu_const",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "N",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "3",
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
);?>

<section>
    <div class="testing-content">
        <div class="container">
            <div class="testing-flex testing-content-block">
                <h2><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/testing-new/h2-text-about.php', [], ['MODE' => 'html', 'NAME' => 'h2 текст']); ?></h2>
                <div>
                    <p class="f-20 margin-bottom24"><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/testing/description_1.php', [], ['MODE' => 'html', 'NAME' => 'Описание 1']); ?></p>
                    <p class="f-20"><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/testing/description_2.php', [], ['MODE' => 'html', 'NAME' => 'Описание 2']); ?></p>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="testing-content spaces">
        <div class="container">
            <div class="need-test-block">
                <div class="text-content">
                    <h2><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/testing/h2_test.php', [], ['MODE' => 'html', 'NAME' => 'Заголовок когда нужна оценка']); ?></h2>
                    <div class="ul-content">
                        <?php $APPLICATION->IncludeFile(SITE_DIR . 'include/testing/ul_test.php', [], ['MODE' => 'html', 'NAME' => 'Таблица когда нужна оценка']); ?>
                    </div>
                </div>
                <div class="image-block">
                    <img src="<?= SITE_DIR ?>images/testing/need_test.png" alt="image" style="object-position: center -250px">
                </div>
            </div>
        </div>
    </div>
</section>


<section>
    <div class="testing-content">
        <div class="blue-back bg--lightblue">
            <div class="container">
                <div class="testing-flex testing-content-block">
                    <h2><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/testing/h2_blue_text.php', [], ['MODE' => 'html', 'NAME' => 'h2 текст']); ?></h2>
                    <div>
                        <div class="grid-2-testing">
                            <div>
                                <h2><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/testing/count_people.php', [], ['MODE' => 'html', 'NAME' => 'Количество сотрудников']); ?></h2>
                                <p class="f-20"><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/testing/count_people_text.php', [], ['MODE' => 'html', 'NAME' => 'Количество сотрудников текст']); ?></p>
                            </div>
                            <div>
                                <h2><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/testing/count_test.php', [], ['MODE' => 'html', 'NAME' => 'Количество тестов']); ?></h2>
                                <p class="f-20"><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/testing/count_test_text.php', [], ['MODE' => 'html', 'NAME' => 'Количество тестов текст']); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="bg--gray">
    <div class="our-students-block mt-5">
        <div class="container">
            <h2 class="title--h2"><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/testing-new/h2-clients.php', [], ['MODE' => 'html', 'NAME' => 'Заголовок']); ?></h2>
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


<section class="assessment_types bg--gray spaces">
    <div class="container">
        <h2 class="title--h2 mb-4 mb-xxl-5 text-center"><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/testing-new/h2-assessment.php', [], ['MODE' => 'html', 'NAME' => 'Заголовок']); ?></h2>

        <?
        $APPLICATION->IncludeComponent(
            "bitrix:news.list",
            "assessment_types",
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
                "IBLOCK_ID" => "208",
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
                "PROPERTY_CODE" => array("TESTING","EXPERT","CERT","TEXT_UPPER"),
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
</section>


<section class="testing-advantages spaces">
    <div class="container">
        <h2 class="title--h2 mb-4 mb-xxl-5"><?$APPLICATION->IncludeFile(SITE_DIR . 'include/testing-new/h2-steps.php', [], ['MODE' => 'html', 'NAME' => 'Заголовок']); ?></h2>

        <div class="tabs">
            <div class="tabs__item active" data-tab="testing"><?$APPLICATION->IncludeFile(SITE_DIR . 'include/testing-new/steps-tabs/1.php', [], ['MODE' => 'html', 'NAME' => 'Заголовок']); ?></div>
            <div class="tabs__item" data-tab="expert"><?$APPLICATION->IncludeFile(SITE_DIR . 'include/testing-new/steps-tabs/2.php', [], ['MODE' => 'html', 'NAME' => 'Заголовок']); ?></div>
            <div class="tabs__item" data-tab="cert"><?$APPLICATION->IncludeFile(SITE_DIR . 'include/testing-new/steps-tabs/3.php', [], ['MODE' => 'html', 'NAME' => 'Заголовок']); ?></div>
        </div>

        <div class="container testing-content-block pt-0" data-code="testing">
            <?php $APPLICATION->IncludeComponent(
                'addamant:testing.scheme',
                'steps',
                [
                    'CACHE_TIME' => '36000000',
                    'CACHE_TYPE' => 'A',
                ]
            ); ?>
        </div>

        <div class="container testing-content-block pt-0" data-code="expert" style="display: none;">2
            <?php $APPLICATION->IncludeComponent(
                'addamant:testing.scheme',
                'steps',
                [
                    'CACHE_TIME' => '36000000',
                    'CACHE_TYPE' => 'A',
                ]
            ); ?>
        </div>

        <div class="container testing-content-block pt-0" data-code="cert" style="display: none;">3
            <?php $APPLICATION->IncludeComponent(
                'addamant:testing.scheme',
                'steps',
                [
                    'CACHE_TIME' => '36000000',
                    'CACHE_TYPE' => 'A',
                ]
            ); ?>
        </div>
    </div>
</section>


<section class="bg--lightblue spaces">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-9">
                <h2 class="title--h2"><?$APPLICATION->IncludeFile(SITE_DIR . 'include/testing-new/check-skills-title.php', [], ['MODE' => 'html', 'NAME' => 'Заголовок']); ?></h2>
                <p class="f-32"><?$APPLICATION->IncludeFile(SITE_DIR . 'include/testing-new/check-skills-text.php', [], ['MODE' => 'html', 'NAME' => 'Текст']); ?></p>
            </div>
            <div class="col-3">
                <?$APPLICATION->IncludeFile(SITE_DIR . 'include/testing-new/check-skills-btn.php', [], ['MODE' => 'html', 'NAME' => 'Заголовок']); ?>
            </div>
        </div>
    </div>
</section>

    
<section class="expertise spaces">
    <div class="container">
        <h2 class="title--h2 mb-4 mb-xxl-5"><?$APPLICATION->IncludeFile(SITE_DIR . 'include/testing-new/h2-expertise.php', [], ['MODE' => 'html', 'NAME' => 'Заголовок']); ?></h2>

        <div class="tabs">
            <div class="tabs__item active" data-tab="langs"><?$APPLICATION->IncludeFile(SITE_DIR . 'include/testing-new/expertise-tabs/1.php', [], ['MODE' => 'html', 'NAME' => 'Заголовок']); ?></div>
            <div class="tabs__item" data-tab="roles"><?$APPLICATION->IncludeFile(SITE_DIR . 'include/testing-new/expertise-tabs/2.php', [], ['MODE' => 'html', 'NAME' => 'Заголовок']); ?></div>
            <div class="tabs__item" data-tab="standarts"><?$APPLICATION->IncludeFile(SITE_DIR . 'include/testing-new/expertise-tabs/3.php', [], ['MODE' => 'html', 'NAME' => 'Заголовок']); ?></div>
        </div>

        <div class="testing-content-block">
                <h2 class="margin-bottom24"><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/testing/roles_heading.php', [], ['MODE' => 'html', 'NAME' => 'Роли заголовок']); ?></h2>
                <p class="f-32 margin48"><?php $APPLICATION->IncludeFile(SITE_DIR . 'include/testing/roles_text.php', [], ['MODE' => 'html', 'NAME' => 'Роли текст']); ?></p>
                <?php $APPLICATION->IncludeComponent(
                    'addamant:testing.roles',
                    '.default',
                    [
                        'CACHE_TIME' => '36000000',
                        'CACHE_TYPE' => 'A',
                    ]
                ); ?>
        </div>
    </div>
</section>


<section class="bg--lightblue spaces">
    <div class="container">
        <h2 class="title--h1"><?$APPLICATION->IncludeFile(SITE_DIR . 'include/testing-new/lightblue-form-title.php', [], ['MODE' => 'html', 'NAME' => 'Заголовок']); ?></h2>
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


    <div class="testing-content-block container telegram">
        <?php $APPLICATION->IncludeComponent(
            "addamant:telegram.subscribe",
            ".default",
            array(
                "CACHE_TIME" => "3600",
                "CACHE_TYPE" => "A",
                "SUBSCRIBE_TITLE" => "",
                "SUBSCRIBE_LINK" => "https://t.me/IBS_Training_Center",
                "COMPONENT_TEMPLATE" => ".default"
            ),
            false
        ); ?>
    </div>
</div>

<?$APPLICATION->IncludeComponent(
    "bitrix:form.result.new",
    "main.feedback",
    array(
        "CUSTOM_CLASSES" => "bg--lightblue",
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

<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>