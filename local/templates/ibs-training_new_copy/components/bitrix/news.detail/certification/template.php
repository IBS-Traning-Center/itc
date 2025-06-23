<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>

<div class="certification-detail">
	<?// Блок - обложка раздела ?>
	<section class="start bg--green">
		<a href="<?=$arResult["PREVIEW_PICTURE"]["SRC"];?>" class="start__image d-none d-xxl-block" target="_blank" data-fancybox>
			<img src="<?=$arResult["PREVIEW_PICTURE"]["SRC"];?>" alt="Образец сертификата">
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
	
			<h1 class="title--h1"><?=$arResult["NAME"];?></h1>
	
			<?=$arResult["PREVIEW_TEXT"];
			
			if($arResult['PROPERTIES']["START_BUTTONS"]['VALUE'] != NULL) :
			?>
				<div class="row g-1 g-md-3 g-lg-32">
					<?
					$arFilter = Array("IBLOCK_ID"=>193, "ID" => $arResult['PROPERTIES']["START_BUTTONS"]['VALUE']);
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
			<?endif;?>
		</div>
	</section>


	<? // Блок "Фундаментально. Объективно. Честно."
	if($arResult['PROPERTIES']['SHOW_FUNDAMENTAL']['VALUE'] === 'Y'):
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
		);
		?>
		<div class="row g-1 g-md-3 g-lg-32 justify-content-center fundamental__btns">
			<div class="col-12 col-sm-auto">
				<a class="btn-main btn--dark" data-scroll="levels">Пройти бесплатный тест</a>
			</div>
			<div class="col-12 col-sm-auto">
				<a href="/timetable/certification/" target="_blank" class="btn--light">Посмотреть расписание</a>
			</div>
		</div>
	<?endif;?>


	<? // Блок "Отличия бизнес-аналитика от системного аналитика"
	if($arResult['PROPERTIES']['SHOW_DIFFERENCE']['VALUE'] === 'Y'):
	?>
	<section class="differences">
		<div class="container">
			<h2 class="title--h2 text-md-center">
				<?$APPLICATION->IncludeFile(SITE_DIR . 'include/certification/differences-title.php', [], ['MODE' => 'html', 'NAME' => 'Заголовок']); ?>
			</h2>

			<?$APPLICATION->IncludeComponent(
				"bitrix:news.list",
				"differences",
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
					"IBLOCK_ID" => "199",
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
					"PROPERTY_CODE" => array("ICON","STICKER","LABEL"),
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
			endif;
			?>

			<div class="differences__btn">
				<?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH.'/include/differences__btn.php', [], ['MODE' => 'html']);?>
			</div>
		</div>
</section>

	<?
	// Блок "Бизнес-аналитик на рынке труда"
	$APPLICATION->IncludeComponent(
		"bitrix:news.list",
		"why-us",
		Array(
			"CUSTOM_CLASS" => "with-titles",
			"CUSTOM_TITLE" => "Бизнес-аналитик на рынке труда",
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
			"IBLOCK_ID" => "200",
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
	);?>

	<?// Блок с детальным текстом курса, редактируется в админке?>
	<section class="basically">
		<div class="container">
			<div class="row g-4 g-lg-5 w-100 flex-column flex-md-row">
				<div class="col-12 col-md-4">
					<img src="<?=$arResult['DETAIL_PICTURE']['SRC']?>" alt="detail-image" class="basically__image">
				</div>

				<div class="col-12 col-md-8">
					<?=$arResult['DETAIL_TEXT'];?>
				</div>
			</div>

			<?
			if(!empty($arResult['PROPERTIES']['BASICALLY']['VALUE'])):
			?>
			<h2 class="title--h2"><?=$arResult['PROPERTIES']['BASICALLY']['NAME']?></h2>

			<ul class="basically__list">
				<?
				foreach ($arResult['PROPERTIES']['BASICALLY']['VALUE'] as $key => $item) {
					?>
					<li><?=$item?></li>
					<?
				}
				?>
			</ul>
			<?endif;?>
		</div>
	</section>


	<? // Блок "Уровни сертификации"
	if(!empty($arResult['PROPERTIES']['LEVELS']['VALUE'])):
		$APPLICATION->IncludeComponent(
			"bitrix:news.list",
			"levels",
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
				"IBLOCK_ID" => "202",
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
				"PROPERTY_CODE" => array("UP_TITLE","TYPE","ICON","COST","PERIOD","PROPS_TITLE","PROPS","BUTTONS_CODE"),
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
	endif;?>


	<? // Блок "Для чего нужна сертификация"
	if(!empty($arResult['PROPERTIES']['FOR_BA']['VALUE'])):
	?>
	<section class="basically">
		<div class="container">
			<h2 class="title--h2">Для&nbsp;чего нужна сертификация</h2>

			<div class="tabs">
				<div class="tabs__item active" data-tab="analyse">Бизнес-аналитику</div>
				<div class="tabs__item" data-tab="company">Компании</div>
			</div>

			<ul class="basically__list" data-code="analyse">
				<?
				foreach ($arResult['PROPERTIES']['FOR_BA']['VALUE'] as $key => $item) {
					?>
					<li><?=$item?></li>
					<?
				}
				?>
			</ul>

			<ul class="basically__list" data-code="company" style="display: none;">
				<?
				foreach ($arResult['PROPERTIES']['FOR_COMPANY']['VALUE'] as $key => $item) {
					?>
					<li><?=$item?></li>
					<?
				}
				?>
			</ul>

			<a class="btn-main btn--dark" data-scroll="mainFeedbackFormBlock">Записаться на&nbsp;сертификацию</a>
		</div>
	</section>
	<?endif;?>

	
	<? // Блок "Почему стоит пройти сертификацию у нас"
	if(!empty($arResult['PROPERTIES']['SHOW_WHY_US']['VALUE'])):
	?>
	<section class="guarantees">
		<div class="container">
			<div class="row">
				<div class="col-12 col-lg-6">
					<?
					$sectionWhyUs = [];
					$arFilter = Array('IBLOCK_ID'=>201, 'IBLOCK_TYPE'=>'edu_const');
					$arSelect = Array('ID', 'NAME', 'PICTURE', 'UF_*');
					$db_list = CIBlockSection::GetList(
						Array("SORT"=>"ASC"), 
						$arFilter,
						false,
						$arSelect,
						false
					);
					
					while($ar_result = $db_list->GetNext())
					{
						$sectionWhyUs[] = $ar_result;
					}
					$sectionWhyUs = $sectionWhyUs[0];
					?>
					
					<h2 class="title--h2"><?=$sectionWhyUs['UF_BLOCK_TITLE']?></h2>

					<div class="guarantees__content">
						<img src="<?=CFile::GetPath($sectionWhyUs['PICTURE'])?>" alt="<?=$sectionWhyUs['NAME']?>" class="guarantees__image">
						
						<p><?=$sectionWhyUs['NAME']?></p>
					</div>
				</div>

				<div class="col-12 col-lg-6">
					<ul class="guarantees__list">
					<?
					$arFilter = Array("IBLOCK_ID"=>201, "SECTION_ID" => intval($sectionWhyUs['ID']));
					$arSelect = Array("ID", "NAME", "PROPERTY_NUMBER",);
					$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
					while($ob = $res->GetNextElement())
					{
						$arFields = $ob->GetFields();
						?>
							<li>
								<span><?=$arFields['PROPERTY_NUMBER_VALUE']?></span>
								<?=$arFields['NAME']?>
							</li>
						<?
					}
					?>
					</ul>
				</div>
			</div>
		</div>
	</section>
	<?endif;?>


	<?// Блок "Сертифицируйтесь.." c 2 кнопками?>
	<section class="basically basically--white">
		<div class="container">
			<h2 class="title--h2 text-center">Сертифицируйтесь в&nbsp;IBS и&nbsp;откройте новые горизонты возможностей!</h2>

			<div class="row g-32 justify-content-center mb-0">
				<div class="col-auto">
					<a class="btn-main btn--dark" data-scroll="levels">Пройти бесплатный тест</a>
				</div>

				<div class="col-auto">
					<a href="/timetable/certification/" target="_blank" class="btn--light">Посмотреть расписание</a>
				</div>
			</div>
		</div>
	</section>


	<? // Блок "Акции и скидки"
	$APPLICATION->IncludeComponent(
		"bitrix:news.list",
		"promo",
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
			"IBLOCK_ID" => "198",
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
			"PROPERTY_CODE" => array("DISCOUNT",""),
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


	// Блок "Как пройти сертификацию"
	$APPLICATION->IncludeComponent(
		"bitrix:news.list",
		"how-to-cert",
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
			"IBLOCK_ID" => "197",
			"IBLOCK_TYPE" => "edu_const",
			"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
			"INCLUDE_SUBSECTIONS" => "N",
			"MESSAGE_404" => "",
			"NEWS_COUNT" => "4",
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
			

	// Форма
	$APPLICATION->IncludeComponent(
		"bitrix:form.result.new",
		"main.feedback",
		array(
			"CUSTOM_CLASSES" => "bg--green",
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
			"WEB_FORM_ID" => "47"
		)
	);
?>
</div>



