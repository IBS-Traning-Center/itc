<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Документы");
?><div class="open-wrap">
	<h2>Реквизиты</h2>
</div>
<p id="dat1">
	 АНО ДПО "УЦ ИБС":<br>
	 Адрес юридический:<br>
	 127434, г. Москва, Дмитровское шоссе, д. 9Б, этаж 5, помещение XIII, комната 31<br>
	 Адрес почтовый:<br>
	 127018, Москва, ул. Складочная, д. 3, стр. 1<br>
	 ИНН 7713388004<br>
	 КПП 771301001<br>
	 ОГРН 1107799030470<br>
	 ОКПО 68907823<br>
	 р/с 40703810301400000206 в АО «АЛЬФА-БАНК»<br>
	 к/с 30101810200000000593<br>
	 БИК 044525593<br>
</p>
<h2>Документы</h2>
<p id="dat2">
</p>
 <?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"documents",
	Array(
		"ADD_SECTIONS_CHAIN" => "N",
		"FIELDS" => ['NAME'],
		"IBLOCK_ID" => "181",
		"IBLOCK_TYPE" => "edu_const",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"NEWS_COUNT" => "999",
		"PROPERTY_CODE" => ['FILE','LONG_NAME'],
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_TITLE" => "N",
		"SORT_BY1" => "SORT",
		"SORT_BY2" => "ID",
		"SORT_ORDER1" => "ASC",
		"SORT_ORDER2" => "DESC"
	)
);?>
<li style="color: #ffffff" class="documents__item"> <a style="color: #ffffff" class="documents__link" href="/upload/Счет-оферта_ онлайн_сертификация_с физ_лицом_ИнфиниСофт_сайт.docx" target="_blank">Счет-оферта онлайн сертификация с физ. лицом ИнфиниСофт</a>; </li>
<li style="color: #ffffff" class="documents__item"> <a style="color: #ffffff" class="documents__link" href="/upload/Счет-оферта_оказание_услуг_по_проведению_онлайн_сертификации_с юр_лицом_сайт.docx" target="_blank">Счет-оферта оказание услуг по проведению онлайн сертификации с юр/ лицом</a>; </li>
 <br>
 <br>