<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$cp = $this->__component;
$cp->arResult['COURSE'] = $arResult["COURSE"];
$cp->SetResultCacheKeys(array('COURSE'));
$arCity = GetIblockElement($arResult["COURSE"]["SCHEDULED"]["PROPERTIES"]["city"]["VALUE"]);
$monthstart = FormatDate("F", strtotime($arResult["COURSE"]["SCHEDULED"]["PROPERTIES"]["startdate"]["VALUE"]));
$monthend = FormatDate("F", strtotime($arResult["COURSE"]["SCHEDULED"]["PROPERTIES"]["enddate"]["VALUE"]));
if (strlen($arResult["COURSE"]["SCHEDULED"]["PROPERTIES"]["enddate"]["VALUE"]) > 0) {
    if ($monthstart == $monthend) {
        $string_date = date("j", strtotime($arResult["COURSE"]["SCHEDULED"]["PROPERTIES"]["startdate"]["VALUE"])) . " - " . date("j", strtotime($arResult["COURSE"]["SCHEDULED"]["PROPERTIES"]["enddate"]["VALUE"])) . " " . strtolower($monthend);
    } else {
        $string_date = date("j", strtotime($arResult["COURSE"]["SCHEDULED"]["PROPERTIES"]["startdate"]["VALUE"])) . " " . strtolower($monthstart) . " - " . date("j", strtotime($arResult["COURSE"]["SCHEDULED"]["PROPERTIES"]["enddate"]["VALUE"])) . " " . strtolower($monthend);
    }
} else {
    $string_date = date("j", strtotime($arResult["COURSE"]["SCHEDULED"]["PROPERTIES"]["startdate"]["VALUE"])) . "  " . strtolower($monthstart);
}

CModule::IncludeModule("catalog");
$ar_res = CPrice::GetBasePrice($arResult["COURSE"]["SCHEDULED"]["ID"]);

$between1 = strtotime($arResult["COURSE"]["SCHEDULED"]["PROPERTIES"]["startdate"]["VALUE"]);
$between0 = strtotime($arResult["COURSE"]["SCHEDULED"]["PROPERTIES"]["startdate"]["VALUE"] . " - 28 day");
$between3 = strtotime($arResult["COURSE"]["SCHEDULED"]["PROPERTIES"]["startdate"]["VALUE"] . " - 15 day");
$between4 = strtotime($arResult["COURSE"]["SCHEDULED"]["PROPERTIES"]["startdate"]["VALUE"] . " - 14 day");
if (!empty($arResult['PROPERTIES']['DATE_CHANGE']['VALUE'])) {
    $between3 = strtotime($arResult['PROPERTIES']['DATE_CHANGE']['VALUE']);
    $between4 = strtotime($arResult['PROPERTIES']['DATE_CHANGE']['VALUE'] . " + 1 day");
}
if(strtotime("now") < $between4 ) {
    $GLOBALS['DISCOUNT_TIME'] = 10;
}

$salePrice = number_format(($ar_res["PRICE"] * 0.9), 0, ".", " ");
$displaySalePrice = '<strong>' . $salePrice . (($ar_res["CURRENCY"] == "GRN") ? ' грн.' : ' &#8381;') . '</strong>';

$price = number_format(($ar_res["PRICE"]), 0, ".", " ");
$displayPrice = '<strong>' . $price . (($ar_res["CURRENCY"] == "GRN") ? ' грн.' : ' &#8381;') . '</strong>';

$all = $between1 - $between0;
$my = ($between1 - time());
if (time() > $between0) {
    $percent = 100 - ($my / $all) * 100;
} else {
    $percent = 2;
}
?>
    <div id="header">
        <strong class="logo"><a href="/">LUXOFT TRAINING</a></strong>


	<nav>
 		<input id="menuToggle" class="checkbox3" type="checkbox">
                <label for="menuToggle">
			<div class="hamburger">
                		<span class="bar bar1"></span>
                		<span class="bar bar2"></span>
                		<span class="bar bar3"></span>
                		<span class="bar bar4"></span>
            		</div>
		</label>
            	<ul class="menu clearfix">
            		<li><a href="#s1">Тренер</a></li>
            		<li><a href="#s2">Видео</a></li>
            		<li><a href="#s3">Программа тренинга</a></li>
            		<li><a href="#s5">
                        <?if($arResult['ID'] != '105499') {?>
                            Место проведения
                        <?} else {?>
                            Контакты
                        <?}?>
                    </a></li>
			<li><a href="#regpopup" class="btn">Зарегистрироваться</a></li>
            	</ul>
        </nav>




    </div>
    </nav>
    <div id="main">
    <div class="banner" style="background-image:url('/agile/images/banner.jpg');">
            <p>Тренинг</p>
            <h1><?= $arResult["COURSE"]["NAME"] ?></h1>
            <p><span style="text-transform: lowercase;"><?= $string_date ?></span>, <?= $arCity["NAME"] ?></p>
            <a href="#regpopup" class="btn">Зарегистрироваться</a>
    </div>
    <div class="person" id="s1">
        <h2>ТРЕНЕР</h2>
        <div class="holder">
            <div class="image">
                <img src="<?= $arResult["PREVIEW_PICTURE"]["SRC"] ?>" alt="">
            </div>
            <div class="description">
                <h3><?= $arResult["PROPERTIES"]["TRAINER_HEADING"]["VALUE"] ?></h3>
                <?= $arResult["PREVIEW_TEXT"] ?>
            </div>
        </div>
    </div>
    <div class="video thumb-wrap" id="s2" style="background-image:url('/agile/images/bg-video.jpg');">
        <h2>Видео</h2>
        	<iframe width="857" height="482" src="https://www.youtube.com/embed/dXOPgZq_pEc" frameborder="0" allowfullscreen></iframe>
    </div>
    <div class="program" id="s3">
                <h2>Программа тренинга</h2>
                <div class="blocks">
                    <div class="block">
                        <h3><span class="ico"><img src="/agile/images/description@1x.png" alt=""></span>Описание</h3>
                        <?= $arResult["COURSE"]["course_description"] ?>
                    </div>
                    <? if (strlen($arResult["COURSE"]["course_puproses"]) > 0) { ?>
                        <div class="block">
                            <h3><span class="ico"><img src="/agile/images/goals@1x.png" alt=""></span>Цели</h3>
                            <? if ($arResult["PROPERTIES"]["PURPOSE"]["VALUE"]) { ?>
                                <?= htmlspecialchars_decode($arResult["PROPERTIES"]["PURPOSE"]["VALUE"]["TEXT"]) ?>
                            <? } else { ?>
                                <?= $arResult["COURSE"]["course_puproses"] ?>
                            <? } ?>
                        </div>
                    <? } ?>
                    <div class="block">
                        <h3><span class="ico"><img src="/agile/images/themes@1x.png" alt=""></span>Разбираемые темы</h3>
                        <? if ($arResult["PROPERTIES"]["THEMES"]["VALUE"]) { ?>
                            <?= htmlspecialchars_decode($arResult["PROPERTIES"]["THEMES"]["VALUE"]["TEXT"]) ?>
                        <? } else { ?>
                            <?= $arResult["COURSE"]["course_topics"] ?>
                        <? } ?>
                    </div>
                    <? if ($arResult["PROPERTIES"]["ADVANTAGES"]["VALUE"]) { ?>
                        <div class="block">
                            <h3><span class="ico"><img src="/agile/images/advantages.png" alt=""></span>Преимущества</h3>
                            <?= htmlspecialchars_decode($arResult["PROPERTIES"]["ADVANTAGES"]["VALUE"]["TEXT"]) ?>
                        </div>
                    <? } ?>
                    <? if ($arResult["PROPERTIES"]["EXT_THEMES"]["VALUE"]) { ?>
                        <div class="block">
                            <h3><span class="ico"><img src="/agile/images/ico04.png" alt=""></span>Продвинутые темы</h3>
                            <?= htmlspecialchars_decode($arResult["PROPERTIES"]["EXT_THEMES"]["VALUE"]["TEXT"]) ?>
                        </div>
                    <? } ?>
                </div>
                <? if (!empty($arResult['PROPERTIES']['AUDIENCE']['VALUE']['TEXT'])) { ?>
                    <div class="blockrow">
                        <h3><span class="ico"><img src="/agile/images/target_audience@1x.png" alt=""></span>Целевая аудитория</h3>
                        <? if (!empty($arResult['PROPERTIES']['AUDIENCE']['VALUE']['TEXT'])) { ?>
                            <?= $arResult['PROPERTIES']['AUDIENCE']['VALUE']['TEXT'] ?>
                        <? } else { ?>
                            <?= $arResult["COURSE"]["course_audience"] ?>
                        <? } ?>
                    </div>
                <? } ?>
                <div class="price">
                    <h2><span>стоимость</span></h2>
                    <div class="dates">
                        <span>до <?= date("d.m", $between3) ?> <?= $displaySalePrice ?></span>
                        <span>с <?= date("d.m", $between4) ?> до <?= date("d.m", $between1) ?> <?= $displayPrice ?></span>
                    </div>
                    <div class="slider">
                        <div class="bar" style="width:<?= $percent ?>%;">
                            <span class="circle"></span>
                        </div>
                    </div>
                </div>
                <?if($arResult['ID'] != '105499') {?>
                    <ul class="payments">
                        <li><img src="/agile/images/payment01.png" alt=""></li>
                        <li><img src="/agile/images/payment02.png" alt=""></li>
                        <li><img src="/agile/images/payment03.png" alt=""></li>
                        <li><img src="/agile/images/payment04.png" alt=""></li>
                    </ul>
                <?}?>
                <div class="centered">
                    <a href="#regpopup" class="btn">Зарегистрироваться</a>
                </div>
    </div>
    <script type="application/ld+json">
        {
          "@context": "http://schema.org",
          "@type": "Event",
          "name": "<?= $arResult["COURSE"]["NAME"] ?>",
          "startDate": "<?= FormatDate("Y-m-d", strtotime($arResult["COURSE"]["SCHEDULED"]["PROPERTIES"]["startdate"]["VALUE"])) ?>" ,
          "location": {
            "@type": "Place",
            "name": "г. Москва, ул. Складочная",
            "address": {
              "@type": "PostalAddress",
              "streetAddress": "Складочная",
              "addressLocality": "д. 3, стр. 1"
              }
          },
          "image": "https://www.luxoft-training.ru/agile/images/agile-nice-photo.jpg",
          "description": "<?= HTMLToTxt($arResult["COURSE"]["course_description"]) ?>",
          "endDate": "<?= FormatDate("Y-m-d", strtotime($arResult["COURSE"]["SCHEDULED"]["PROPERTIES"]["enddate"]["VALUE"])) ?>",
          "offers": {
            "@type": "Offer",
            "url": "https://www.luxoft-training.ru<?= $APPLICATION->GetCurPage() ?>",
            "price": "<?= $ar_res["PRICE"] ?>",
            "priceCurrency": "RUR",
            "availability": "http://schema.org/InStock"
         },
          "performer": {
            "@type": "PerformingGroup",
            "name": "<?= $arResult["PROPERTIES"]["TRAINER_HEADING"]["VALUE"] ?>"
          }
        }
    </script>
<? if ($arResult["COURSE"]["SCHEDULED"]["PROPERTIES"]["course_code"]["VALUE"] == "SDP-033") { ?>
    <div class="advantages" data-parallax="scroll" data-image-src="/agile/images/bg-advantages.jpg">
        <strong class="logo-psm">PSM I</strong>
        <h2>Преимущества PSM I сертификата</h2>
        <ul>
            <li>
                <strong>1</strong>
                <p>Прохождение сложного теста дает чувство реального достижения.</p>
            </li>
            <li>
                <strong>2</strong>
                <p>PSM I больше ценится в сообществе ИТ организаций, благодаря сложному тесту, а не факту прохождения
                    тренинга.</p>
            </li>
            <li>
                <strong>3</strong>
                <p>Microsoft® использует PSM I тест как обязательное условие проверки компетенции для участии в проектах
                    Silver and Gold Application Lifecycle Management (ALM).</p>
            </li>
            <li>
                <strong>4</strong>
                <p>PSM I тест постоянно обновляется при новых редакциях основного документа Scrum Guide, поэтому
                    проверка знаний всегда актуальна.</p>
            </li>
        </ul>
    </div>
<? } ?>