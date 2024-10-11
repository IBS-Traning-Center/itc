<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Бонусы");
?><?if (!$USER->IsAuthorized()) {?> <?$APPLICATION->IncludeComponent(
	"bitrix:system.auth.form",
	"",
	Array(
		"REGISTER_URL" => "register.php",
		"FORGOT_PASSWORD_URL" => "",
		"PROFILE_URL" => "profile.php",
		"SHOW_ERRORS" => "Y"
	)
);?> <?} else {?>
<div class="offclass">
	 <?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"notification",
	Array(
		"IBLOCK_TYPE" => "edu_const",
		"IBLOCK_ID" => "106",
		"NEWS_COUNT" => "20",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"FILTER_NAME" => "arrfilter",
		"FIELD_CODE" => array(0=>"",1=>"",),
		"PROPERTY_CODE" => array(0=>"",1=>"DESCRIPTION",2=>"",),
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"CACHE_FILTER" => "Y",
		"CACHE_GROUPS" => "Y",
		"PREVIEW_TRUNCATE_LEN" => "",
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"SET_TITLE" => "N",
		"SET_STATUS_404" => "N",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"PAGER_TITLE" => "",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"DISPLAY_DATE" => "N",
		"DISPLAY_NAME" => "N",
		"DISPLAY_PICTURE" => "N",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"AJAX_OPTION_ADDITIONAL" => ""
	)
);?>
</div>
<div class="bonuses-box">
	<div class="box">
		 <?$APPLICATION->IncludeComponent(
	"bitrix:sale.personal.account", 
	"acc-big", 
	array(
		"SET_TITLE" => "N",
		"COMPONENT_TEMPLATE" => "acc-big"
	),
	false
);?>
	</div>
	<div class="learn-box" style="float: left; width: 597px;">
		<h2>Как заработать бонусы?</h2>
		<div class="holder-box">
			<div class="holder first">
				<div class="img">
 <img src="/bitrix/templates/personal/images/ico-01.png">
				</div>
				<div class="frame-box">
					<h3>Рекомендуйте курсы Учебного Центра</h3>
					<p>
						 За рекомендацию курсов Учебного Центра (физическим и юридическим лицам) начисляется бонус в размере <b>5%</b><b> от суммы первой продажи без НДС</b> по этим рекомендациям. <br>
						 Бонус начисляется при обращении к сотрудникам Учебного Центра <a href="mailto:<?=EMAIL_ADDRESS?>"><?=EMAIL_ADDRESS?></a> до проведения обучения.
					</p>
				</div>
			</div>
			<div class="holder">
				<div class="img">
 <img src="/bitrix/templates/personal/images/ico-03.png">
				</div>
				<div class="frame-box">
					<h4>Проходите курсы Учебного Центра</h4>
					<p>
						 После прохождения любого курса в размере <b>5% от его стоимости</b>.
					</p>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="bonuses-box">
	<div class="holder">
		<h2>Условия бонусирования</h2>
		<p>
			 Бонусы начисляются только физическим лицам.
		</p>
		<p>
			 Бонусы используются в качестве скидки при регистрации и оплате курсов, <br>
			 следующих за начислением баллов в течение <b>1 года</b>. <br>
			 Если в течение года с момента зачисления баллов не было дополнительных <br>
			 зачислений баллов, то они аннулируются.
		</p>
		<p>
			 Бонусирование измеряется в баллаx, <b>1 балл = 1 рубль</b>.
		</p>
		<p>
			 Бонусы могут суммироваться, но максимальный размер скидки на курсы в рамках программы бонусирования – <b>30%</b>.
		</p>
		<p>
			 Программа бонусирования распространяется только на курсы из открытого расписания Luxoft Training (непартнерские). Бонус за рекомендацию не начисляется на курсы с кодами SDP-031 – SDP-033, SDP-035, SDP-042 – SDP-045.
		</p>
	</div>
</div>
 <?}?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>