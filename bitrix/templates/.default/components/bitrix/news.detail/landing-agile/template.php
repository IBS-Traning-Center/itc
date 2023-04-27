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
<? /*
<div class="news-detail">
<div class="social-share">
	<?$share_title=$arResult["PROPERTIES"]["TYPE"]["VALUE"]." '".$arResult["NAME"]."'";?>
	<a target="_blank" class="share-button facebook" href="https://www.facebook.com/dialog/feed?app_id=1421562351392582&link=<?=urlencode("http://www.luxoft-training.ru".$APPLICATION->GetCurDir())?>display=popup&caption=<?=rawurlencode(iconv("windows-1251", "UTF-8", "Luxoft Training: Курсы и тренинги для программистов, аналитиков, менеджеров проектов, тестировщиков"))?>&name=<?=rawurlencode(iconv("windows-1251", "UTF-8", $share_title))?>&picture=http://www.luxoft-training.ru//agile/images/landing/new_logo_67.gif&redirect_uri=<?=urlencode("http://www.luxoft-training.ru".$APPLICATION->GetCurDir())?>"></a>
	<a target="_blank" class="share-button vkontakte" href="http://vkontakte.ru/share.php?&description=<?=rawurlencode(iconv("windows-1251", "UTF-8", "Luxoft Training: Курсы и тренинги для программистов, аналитиков, менеджеров проектов, тестировщиков."))?>&title=<?=rawurlencode(iconv("windows-1251", "UTF-8", $share_title))?>&url=<?=urlencode("http://www.luxoft-training.ru".$APPLICATION->GetCurDir())?>&noparse=false"></a>
	<a target="_blank" class="share-button twitter" href="https://twitter.com/share?&text=<?=rawurlencode(iconv("windows-1251", "UTF-8", $share_title))?>&url=<?=urlencode("http://www.luxoft-training.ru".$APPLICATION->GetCurDir())?>&redirect_uri=<?=urlencode("http://www.luxoft-training.ru".$APPLICATION->GetCurDir())?>"></a>
	<a target="_blank" class="share-button linkedin" href="http://www.linkedin.com/shareArticle?mini=true&url=<?=urlencode("http://www.luxoft-training.ru".$APPLICATION->GetCurDir())?>&title=<?=rawurlencode(iconv("windows-1251", "UTF-8", $share_title))?>&summary=<?=rawurlencode(iconv("windows-1251", "UTF-8", 'Luxoft Training: Курсы и тренинги для программистов, аналитиков, менеджеров проектов, тестировщиков.'))?>"></a>
	<a target="_blank" class="share-button plus" href="https://plus.google.com/share?url=<?=urlencode("http://www.luxoft-training.ru".$APPLICATION->GetCurDir())?>"></a>
</div>
	<a href="javascript:void(0)" class="up-btn" data-scroll="body"></a>
    <div class="menu-wrapper">
        <div class="landing-logo"><a href="/" target="_blank"><img alt="Luxoft-training" src="//agile/images/landing/logo_landing.png"/></a></div>
        <div class="reg-btn-right">
            <a class="top-reg-btn reg-over"  rel="#overlay-form" href='javascript:void(0)'>ЗАРЕГИСТРИРОВАТЬСЯ</a>
        </div>
        <div class="top-menu-wrap">
            <a href="javascript:void(0)" data-scroll="#trener-info" class="menu-item">
                <span class="selected-line"></span>
                Тренер
            </a>
            <a href="javascript:void(0)" data-scroll="#scroll-price" class="menu-item active">
                <span class="selected-line"></span>
               Стоимость
			</a>
			<?if (count($arResult["REVIEW"])>0) {?>
			<a href="javascript:void(0)" data-scroll="#review-scroll" class="menu-item">
                <span class="selected-line"></span>
                Отзывы
             </a>
			<?}?>
            <?if (strlen($arResult["PROPERTIES"]["VIDEO"]["VALUE"]["path"])>0) {?>
			<a href="javascript:void(0)" data-scroll="#video-scroll" class="menu-item">
                <span class="selected-line"></span>
                Видео
             </a>
			 <?}?>
			 <a href="javascript:void(0)" data-scroll="#program-scroll" class="menu-item">
                <span class="selected-line"></span>
               Программа
			</a>
             <a href="javascript:void(0)" data-scroll="#partners-scroll" class="menu-item">
                 <span class="selected-line"></span>
                Партнеры
             </a>
            <a href="javascript:void(0)" data-scroll="#map-scroll" class="menu-item">
                <span class="selected-line"></span>
               Контакты
            </a>
        </div>
    </div>
    <div id="top" class="top-part">
         <div id="maximage">
            <img class="detail_picture" border="0" src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" style="width: <?=$arResult["DETAIL_PICTURE"]["WIDTH"]?>px; height:  <?=$arResult["DETAIL_PICTURE"]["HEIGHT"]?>px;" width="<?=$arResult["DETAIL_PICTURE"]["WIDTH"]?>" height="<?=$arResult["DETAIL_PICTURE"]["HEIGHT"]?>" alt="<?=$arResult["NAME"]?>"  title="<?=$arResult["NAME"]?>" />
        </div>
        <div style="opacity: 0.5" class="bg-bg">
        </div>
        <div class="main-info">
            <div class="info-content">
                <span class="h-info"><div class="left-thing"></div><?=$arResult["PROPERTIES"]["TYPE"]["VALUE"]?><div class="right-thing"></div></span>
                <h1><?=$arResult["NAME"]?></h1>
                <div class="datencity"><?=$arResult["PROPERTIES"]["DATE_N_PLACE"]["VALUE"]?></div>
                <a class="btn-reg reg-over"  rel="#overlay-form" title="Регистрация на <?=$arResult["PROPERTIES"]["TYPE"]["VALUE"]?>" href="javascript:void(0)">ЗАРЕГИСТРИРОВАТЬСЯ</a>
             </div>
        </div>
    </div>
    <div id="trener-info">
        <div class="trener-h">
            <h2>Тренер</h2>
        </div>
        <?=$arResult["DETAIL_TEXT"]?>
    </div>
	<div style="clear:both"></div>
	<br />
    <div id="about-scroll" class='about-gray'>
        <div id="about-wrap">
            <div class="trener-h"><h2>О ЧЁМ</h2></div>
            <p>
               <?=$arResult["PREVIEW_TEXT"]?>
            </p>
        </div>
    </div>
	<?if (count($arResult["REASONS"])>0) {?>
    <div class="fv-rsns">
        <div class="rsns-head">
            <h2>
                5 причин, почему нельзя пропускать это событие
            </h2>
        </div>
		<div class="rsn-wrap">
			<?foreach ($arResult["REASONS"] as $arReason) {?>
				<div class="un-rsn">
					<div class="rsn-h">
						<?=$arReason["NAME"]?>
					</div>
					<div class="rsn-descr">
						<?=$arReason["PREVIEW_TEXT"]?>
					</div>
				</div>
			<?}?>
			<div style="clear:both"></div>
		</div>
    </div>
	<?}?>
	<div id="price-wrap" class="price-part">

		 <div id="maximage2">
            <img class="detail_picture" border="0" src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" width="<?=$arResult["DETAIL_PICTURE"]["WIDTH"]?>" height="<?=$arResult["DETAIL_PICTURE"]["HEIGHT"]?>" alt="<?=$arResult["NAME"]?>"  title="<?=$arResult["NAME"]?>" />
		</div>

		<div class="bg-bg">
        </div>
		<div id="scroll-price">
		</div>
		<?if ($arResult["PROPERTIES"]["CURRENCY"]["VALUE_ENUM_ID"]==199) {?>
			<?$valuta='<span class="alsrubl">o</span>'?>
		<?} else {?>
			<?$valuta='$'?>
		<?}?>
		<div class="price-info">
			<div class="price-wrap">
				<div class="price-middle">
					<span class="h-info"><div class="left-thing"></div>СТОИМОСТЬ<div class="right-thing"></div></span>
				</div>
				<div class="price-count">
					<?=number_format($arResult["CURR_PRICE"], '0', '', ' ' )?><?=$valuta?>
				</div>
				<div class="curr-date">
					<?=$arResult["CURR_DATE"]?>
				</div>
				<div class="line-prices">
					<div class="main-line">
					<?if ($arResult["ETAPS_COUNT"]==4) {?>
						<div class="start-place place" style="left:0%; width: 25%">
						<div class="cut">
							<div class="date-prog"><?=FormatDate("j F", strtotime($arResult["PROPERTIES"]["START_DATE"]["VALUE"]))?></div>
						</div>
						<div class="price-down">
								<?=number_format($arResult["PROPERTIES"]["FIRST_PRICE"]["VALUE"], '0', '', ' ' );?><span class="alsrubl">o</span>
						</div>
						<?if ($arResult["CURR_ETAP"]==1) {?><div class="flag-current" style="left: <?=$arResult["CURRENT_PERCENT"]?>%"></div><?}?>
						</div>
						<div class="second-place place" style="left:25%; width: 25%">
							<div class="cut">
								<div class="date-prog"><?=FormatDate("j F", strtotime($arResult["PROPERTIES"]["SECOND_DATE"]["VALUE"]))?></div>
							</div>
							<div class="price-down">
								<?=number_format($arResult["PROPERTIES"]["SECOND_PRICE"]["VALUE"], '0', '', ' ' );?><?=$valuta?>
							</div>
							<?if ($arResult["CURR_ETAP"]==2) {?><div class="flag-current" style="left: <?=$arResult["CURRENT_PERCENT"]?>%"></div><?}?>
						</div>
						<div class="third-place place" style="left:50%;  width: 25%">
							<div class="cut">
								<div class="date-prog"><?=FormatDate("j F", strtotime($arResult["PROPERTIES"]["THIRD_DATE"]["VALUE"]))?></div>
							</div>
							<div class="price-down">
								<?=number_format($arResult["PROPERTIES"]["THIRD_PRICE"]["VALUE"], '0', '', ' ' );?><?=$valuta?>
							</div>
							<?if ($arResult["CURR_ETAP"]==3) {?><div class="flag-current" style="left: <?=$arResult["CURRENT_PERCENT"]?>%"></div><?}?>
						</div>
						<div class="fourth-place place" style="left:75%; width: 25%">
							<div class="cut">
								<div class="date-prog"><?=FormatDate("j F", strtotime($arResult["PROPERTIES"]["FOURTH_DATE"]["VALUE"]))?></div>
							</div>
							<div class="price-down">
								<?=number_format($arResult["PROPERTIES"]["FOURTH_PRICE"]["VALUE"], '0', '', ' ' );?><?=$valuta?>
							</div>
							<?if ($arResult["CURR_ETAP"]==4) {?><div class="flag-current" style="left: <?=$arResult["CURRENT_PERCENT"]?>%"></div><?}?>
						</div>
						<div class="last-place place" style="right:2px;">
							<div class="cut">
								<div class="date-prog"><?=FormatDate("j F", strtotime($arResult["PROPERTIES"]["FIFTH_DATE"]["VALUE"]))?></div>
							</div>
						</div>
					<?} elseif ($arResult["ETAPS_COUNT"]==3) {?>
						<div class="start-place place" style="left:0%; width: 33%">
						<div class="cut">
							<div class="date-prog"><?=FormatDate("j F", strtotime($arResult["PROPERTIES"]["START_DATE"]["VALUE"]))?></div>
						</div>
						<div class="price-down">
								<?=number_format($arResult["PROPERTIES"]["FIRST_PRICE"]["VALUE"], '0', '', ' ' );?><?=$valuta?>
						</div>
						<?if ($arResult["CURR_ETAP"]==1) {?><div class="flag-current" style="left: <?=$arResult["CURRENT_PERCENT"]?>%"></div><?}?>
						</div>
						<div class="second-place place" style="left:33%; width: 34%">
							<div class="cut">
								<div class="date-prog"><?=FormatDate("j F", strtotime($arResult["PROPERTIES"]["SECOND_DATE"]["VALUE"]))?></div>
							</div>
							<div class="price-down">
								<?=number_format($arResult["PROPERTIES"]["SECOND_PRICE"]["VALUE"], '0', '', ' ' );?><?=$valuta?>
							</div>
							<?if ($arResult["CURR_ETAP"]==2) {?><div class="flag-current" style="left: <?=$arResult["CURRENT_PERCENT"]?>%"></div><?}?>
						</div>
						<div class="third-place place" style="left:67%;  width: 33%">
							<div class="cut">
								<div class="date-prog"><?=FormatDate("j F", strtotime($arResult["PROPERTIES"]["THIRD_DATE"]["VALUE"]))?></div>
							</div>
							<div class="price-down">
								<?=number_format($arResult["PROPERTIES"]["THIRD_PRICE"]["VALUE"], '0', '', ' ' );?><?=$valuta?>
							</div>
							<?if ($arResult["CURR_ETAP"]==3) {?><div class="flag-current" style="left: <?=$arResult["CURRENT_PERCENT"]?>%"></div><?}?>
						</div>
						<div class="fourth-place place" style="right:2px;">
							<div class="cut">
								<div class="date-prog"><?=FormatDate("j F", strtotime($arResult["PROPERTIES"]["FOURTH_DATE"]["VALUE"]))?></div>
							</div>
						</div>

					<?} elseif ($arResult["ETAPS_COUNT"]==2) {?>
						<div class="start-place place" style="left:0%; width: 50%">
						<div class="cut">
							<div class="date-prog"><?=FormatDate("j F", strtotime($arResult["PROPERTIES"]["START_DATE"]["VALUE"]))?></div>
						</div>
						<div class="price-down">
								<?=number_format($arResult["PROPERTIES"]["FIRST_PRICE"]["VALUE"], '0', '', ' ' );?><?=$valuta?>
						</div>
						<?if ($arResult["CURR_ETAP"]==1) {?><div class="flag-current" style="left: <?=$arResult["CURRENT_PERCENT"]?>%"></div><?}?>
						</div>
						<div class="second-place place" style="left:50%; width: 50%">
							<div class="cut">
								<div class="date-prog"><?=FormatDate("j F", strtotime($arResult["PROPERTIES"]["SECOND_DATE"]["VALUE"]))?></div>
							</div>
							<div class="price-down">
								<?=number_format($arResult["PROPERTIES"]["SECOND_PRICE"]["VALUE"], '0', '', ' ' );?><?=$valuta?>
							</div>
							<?if ($arResult["CURR_ETAP"]==2) {?><div class="flag-current" style="left: <?=$arResult["CURRENT_PERCENT"]?>%"></div><?}?>
						</div>
						<div class="third-place place" style="right:2px;">
							<div class="cut">
								<div class="date-prog"><?=FormatDate("j F", strtotime($arResult["PROPERTIES"]["THIRD_DATE"]["VALUE"]))?></div>
							</div>
						</div>

					<?} elseif ($arResult["ETAPS_COUNT"]==1) {?>
						<div class="start-place place" style="left:0; width: 100%">
						<div class="cut">
							<div class="date-prog"><?=FormatDate("j F", strtotime($arResult["PROPERTIES"]["START_DATE"]["VALUE"]))?></div>
						</div>
						<div class="price-down">
								<?=number_format($arResult["PROPERTIES"]["FIRST_PRICE"]["VALUE"], '0', '', ' ' );?><?=$valuta?>
						</div>
						<?if ($arResult["CURR_ETAP"]==1) {?><div class="flag-current" style="left: <?=$arResult["CURRENT_PERCENT"]?>%"></div><?}?>
						</div>
						<div class="second-place place" style="right: 2px;">
							<div class="cut">
								<div class="date-prog"><?=FormatDate("j F", strtotime($arResult["PROPERTIES"]["SECOND_DATE"]["VALUE"]))?></div>
							</div>
						</div>

					<?}?>
					</div>
				</div>
				<div class="btn-price-reg">
					<a class="reg-over" rel="#overlay-form" href="javascript:void(0)">ЗАРЕГИСТРИРОВАТЬСЯ СЕЙЧАС</a>
				</div>
				<div class="img-pay-system">
					<img src="//agile/images/landing/pay-systems.png" alt="pay-system">
				</div>
				<div class="bonuses">
					<div class="bonus-h">БОНУСЫ УЧАСТНИКАМ:</div>
					<div class="bonus-list" style="text-align: center;">
						<?if ($arResult["PROPERTIES"]["FARATA_CERT"]["VALUE"]=="Да") {?>
						<div class="bonus-item first">
							<img src="//agile/images/landing/bonus-cert.png"/>
							<div class="bonus-text">Именной сертификат Farata Systems</div>
							<div style="clear:both"></div>
						</div>
						<?}?>
						<?if ($arResult["PROPERTIES"]["LUXOFT_CERT"]["VALUE"]=="Да") {?>
						<div class="bonus-item <?if ($arResult["PROPERTIES"]["FARATA_CERT"]["VALUE"]!="Да") {?>first<?}?>">
							<img src="//agile/images/landing/bonus-cert.png"/>
							<div class="bonus-text" >Именной сертификат Luxoft-Training</div>
							<div style="clear:both"></div>
						</div>
						<?}?>
						<?if ($arResult["PROPERTIES"]["CERT"]["VALUE"]=="Да") {?>
						<div class="bonus-item <?if ($arResult["PROPERTIES"]["FARATA_CERT"]["VALUE"]!="Да") {?>first<?}?>">
							<img src="//agile/images/landing/bonus-cert.png"/>
							<div class="bonus-text" >Именной сертификат</div>
							<div style="clear:both"></div>
						</div>
						<?}?>
						<?if ($arResult["PROPERTIES"]["GERRARD_CERT"]["VALUE"]=="Да") {?>
						<div class="bonus-item ">
							<img src="//agile/images/landing/bonus-cert.png"/>
							<div class="bonus-text" >Сертификат Gerrard Consulting</div>
							<div style="clear:both"></div>
						</div>
						<?}?>
						<?if ($arResult["PROPERTIES"]["BOOK_PRESENT"]["VALUE"]=="Да") {?>
						<div class="bonus-item">
							<img src="//agile/images/landing/book.png"/>
							<div class="bonus-text" >Первым пяти участникам - книга в подарок</div>
							<div style="clear:both"></div>
						</div>
						<?}?>
						<?if ($arResult["PROPERTIES"]["GIFT"]["VALUE"]=="Да") {?>
						<div class="bonus-item">
							<img src="//agile/images/landing/gift.png"/>
							<div class="bonus-text" >Полезный подарок</div>
							<div style="clear:both"></div>
						</div>
						<?}?>
						<?if ($arResult["PROPERTIES"]["BOOK"]["VALUE"]=="Да") {?>
						<div class="bonus-item">
							<img src="//agile/images/landing/book.png"/>
							<div class="bonus-text" >Тематическая книга</div>
							<div style="clear:both"></div>
						</div>
						<?}?>
						<?if ($arResult["PROPERTIES"]["PDF"]["VALUE"]=="Да") {?>
						<div class="bonus-item">
							<img src="//agile/images/landing/pdf.png"/>
							<div class="bonus-text" >Презентация спикера</div>
							<div style="clear:both"></div>
						</div>
						<?}?>
						<?if ($arResult["PROPERTIES"]["MOVIE"]["VALUE"]=="Да") {?>
						<div class="bonus-item">
							<img src="//agile/images/landing/video-play.png"/>
							<div class="bonus-text" style="width: 95px;">Видеозапись<br/> тренинга</div>
							<div style="clear:both"></div>
						</div>
						<?}?>
					</div>
					<div class="clear:both"></div>
				</div>
			</div>
		</div>
	</div>
	<?if (count($arResult["REVIEW"])>0) {?>
		<div id="review-scroll" class="video-wrapper">
		<div class='video-h'>
			<h2>Отзывы</h2>
		</div>
		<div class="review-wrap">
		<?foreach ($arResult["REVIEW"] as $arReview) {?>
			<div class="review-item">
				<div class="review-head">
					<?=$arReview["NAME"]?> <?=$arReview["SURNAME"]?>
				</div>
				<div class="review-body">
					<?=$arReview["REVIEW_TEXT"]?>
				</div>
			</div>
		<?}?>
		</div>
		</div>
	<?}?>
	<?if (strlen($arResult["PROPERTIES"]["VIDEO"]["VALUE"]["path"])>0) {?>
	<div id="video-scroll" class="video-wrapper">
		<div class='video-h'>
			<h2>Видео</h2>
		</div>
		<div class="mc-player">
		<?$APPLICATION->IncludeComponent("bitrix:player", ".default", array(
	"PLAYER_TYPE" => "auto",
	"USE_PLAYLIST" => "N",
	"PATH" => $arResult["PROPERTIES"]["VIDEO"]["VALUE"]["path"],
	"PROVIDER" => "youtube",
	"STREAMER" => "",
	"WIDTH" => "855",
	"HEIGHT" => "510",
	"PREVIEW" => "",
	"FILE_TITLE" => "",
	"FILE_DURATION" => "",
	"FILE_AUTHOR" => "",
	"FILE_DATE" => "",
	"FILE_DESCRIPTION" => "",
	"SKIN_PATH" => "/bitrix/components/bitrix/player/mediaplayer/skins",
	"SKIN" => "bekle.zip",
	"CONTROLBAR" => "bottom",
	"WMODE" => "transparent",
	"LOGO" => "",
	"LOGO_LINK" => "",
	"LOGO_POSITION" => "none",
	"WMODE_WMV" => "window",
	"SHOW_CONTROLS" => "Y",
	"SHOW_DIGITS" => "Y",
	"CONTROLS_BGCOLOR" => "FFFFFF",
	"CONTROLS_COLOR" => "000000",
	"CONTROLS_OVER_COLOR" => "000000",
	"SCREEN_COLOR" => "000000",
	"AUTOSTART" => "N",
	"REPEAT" => "list",
	"VOLUME" => "90",
	"MUTE" => "N",
	"PLUGINS" => array(
		0 => "",
		1 => "",
	),
	"ADDITIONAL_FLASHVARS" => "",
	"ADVANCED_MODE_SETTINGS" => "Y",
	"PLAYER_ID" => "",
	"BUFFER_LENGTH" => "10",
	"DOWNLOAD_LINK" => "",
	"DOWNLOAD_LINK_TARGET" => "_self",
	"ADDITIONAL_WMVVARS" => "",
	"ALLOW_SWF" => "Y"
	),
	false
);?>
	</div>
	</div>
	<?}?>
	<div id="program-scroll" class="course-information-gray">
		<div class="course-center-wrap">
			<div class="course-inform-h">
				<h2>ПРОГРАММА ТРЕНИНГА</h2>
			</div>

			<?if (strlen($arResult["COURSE"]["course_topics"])>0) {?>
				<h3>Разбираемые темы:</h3>
				<div class="descr-wrap">
					<?=$arResult["COURSE"]["course_topics"]?>
				</div>
			<?}?>

		</div>
	</div>
</div>
<div id="partners-scroll" class="partners-wrap">
	<div class="partners-h">
		<h2>Партнеры</h2>
	</div>
	<div class='partners-list'>
		<?$k=0?>
		<?foreach ($arResult["PARTNERS"] as $arPartner) {?>
			<div class="partner-item-wrapper <?if ($k==0) {?> first<?}?>">
				<div class="partner-item">
					<img src="<?=$arPartner["PREVIEW_PICTURE"]["SRC"]?>" title="<?=$arPartner["NAME"]?>" />
				</div>
			</div>
			<?$k++?>
			<?if ($k==3) {?>
				<?$k=0?>
			<?}?>
		<?}?>
	<div style="clear:both"></div>
	</div>
	<div class="partner-btn">
		<a href="javascript: void(0)" rel="#overlay-partner" class="bcm-prtnr">СТАТЬ ПАРТНЕРОМ</a>
	</div>

</div>

<script>
    $(function(){
		setInterval(fn_checkcoord, 100);
      $('.share-button').click(function(){

										window.open($(this).attr('href'),
										"",
										"width="+600+",height="+387+",toolbar=no,left="+600+",top="+387);
										return false;
									});
       $('.menu-item').click(function(){
           obj=$(this).attr('data-scroll');
           //alert(obj);
           var offset = $(obj).offset();
           $('body').scrollTo(offset.top-89, 800);
           //console.info($(document).scrollTop()+" - "+offset.top);
       });
	   $('.up-btn').click(function(){
           obj=$(this).attr('data-scroll');
           //alert(obj);
           var offset = $(obj).offset();
           $('body').scrollTo(offset.top-89, 800);
           //console.info($(document).scrollTop()+" - "+offset.top);
       });
	   $('.bcm-prtnr').overlay({
		mask: {
			color: '#000',
			loadSpeed: 200,
			opacity: 0.5
		},
	   });
	   $('.reg-over').overlay({
		mask: {
			color: '#000',
			loadSpeed: 200,
			opacity: 0.5
		},
	   });
    });
    function fn_checkcoord() {

		var offset = $('#about-wrap').offset();
		if (offset.left>0) {
			var left=offset.left+990;
		} else {
			left = 990;
		}
		//$('.up-btn').css('left', left+"px");
		$('.menu-item').each(function() {
            obj=$(this).attr('data-scroll');
            first=$('.menu-item:first').attr('data-scroll');
			last=$('.menu-item:last').attr('data-scroll');
            //console.info(obj);
            firstoff=$(first).offset();
            //console.info(firstoff.top);
            if (!!obj) {
                var offset = $(obj).offset();
                if ($(document).scrollTop()>offset.top-90) {
					$('.up-btn').fadeIn();
                    $('.menu-item').removeClass('active');
					if ($(document).scrollTop()+$(window).height() >= $(document).height() - 50) {
						 $('.menu-item').removeClass('active');
						 $('.menu-item:last').addClass('active');
					} else {
						$(this).addClass('active');
						//console.info($(document).scrollTop()+$(window).height());
						//console.info($(document).height());
					}
                } else if ($(document).scrollTop()<firstoff.top-90){
                    $('.menu-item').removeClass('active');
					$('.up-btn').fadeOut();
                }
            }
        });
    }
</script>
