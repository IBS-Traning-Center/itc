<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div id="header">
        <strong class="logo"><a href="/">LUXOFT TRAINING</a></strong>
        <a href="#regpopup" class="btn">Зарегистрироваться</a>
        <ul id="nav">
            <li><a href="#s1">Тренер</a></li>
            
            <li><a href="#s3">Программа тренинга</a></li>
           <?if ($arResult["COURSE"]["SCHEDULED"]["PROPERTIES"]["course_code"]["VALUE"]=="SDP-033") {?> <li><a href="#s4">Сертификация</a></li><?}?>
            <li><a href="#s5">Место проведения</a></li>
        </ul>
    </div>
	<?
	$cp = $this->__component;
	$cp->arResult['COURSE'] = $arResult["COURSE"];
    $cp->SetResultCacheKeys(array('COURSE'));?>
	<?$arCity=GetIblockElement($arResult["COURSE"]["SCHEDULED"]["PROPERTIES"]["city"]["VALUE"])?>
	<?//print_r($arCity);?>
	<?$monthstart=FormatDate("F", strtotime($arResult["COURSE"]["SCHEDULED"]["PROPERTIES"]["startdate"]["VALUE"]));?>
	<?$monthend=FormatDate("F", strtotime($arResult["COURSE"]["SCHEDULED"]["PROPERTIES"]["enddate"]["VALUE"]));?>
	<?//echo $monthend?>
	<?if (strlen($arResult["COURSE"]["SCHEDULED"]["PROPERTIES"]["enddate"]["VALUE"])>0) {?>
	<?if ($monthstart==$monthend) {?>
		<?$string_date=date("j", strtotime($arResult["COURSE"]["SCHEDULED"]["PROPERTIES"]["startdate"]["VALUE"]))." - ".date("j", strtotime($arResult["COURSE"]["SCHEDULED"]["PROPERTIES"]["enddate"]["VALUE"]))." ".strtolower($monthend)?>
	<?} else {?>
		<?$string_date=date("j", strtotime($arResult["COURSE"]["SCHEDULED"]["PROPERTIES"]["startdate"]["VALUE"]))." ".strtolower($monthstart)." - ".date("j", strtotime($arResult["COURSE"]["SCHEDULED"]["PROPERTIES"]["enddate"]["VALUE"]))." ".strtolower($monthend)?>
	<?}?>
	<?} else {?>
		<?$string_date=date("j", strtotime($arResult["COURSE"]["SCHEDULED"]["PROPERTIES"]["startdate"]["VALUE"]))."  ".strtolower($monthstart)?>
	<?}?>
    <div id="main">
        <div class="banner" data-parallax="scroll" data-image-src="/agile/images/banner.jpg">
            <div class="wrapper">
                <p>Тренинг</p>
                <h1><?=$arResult["COURSE"]["NAME"]?></h1>
                <p><span style="text-transform: lowercase;"><?=$string_date?></span>, <?=$arCity["NAME"]?></p>
                <a href="#regpopup" class="btn">Зарегистрироваться</a>
            </div>
        </div>
		<?CModule::IncludeModule("catalog")?>
	
        <div class="person" id="s1">
            <h2>ТРЕНЕР</h2>
            <div class="holder">
                <div class="image">
                    <img src="<?=$arResult["PREVIEW_PICTURE"]["SRC"]?>" alt="">
                </div>
                <div class="holder">
                    <h3><?=$arResult["PROPERTIES"]["TRAINER_HEADING"]["VALUE"]?></h3>
					<?=$arResult["PREVIEW_TEXT"]?>
                   
                </div>
            </div>
        </div>
        <?/*<div class="video" id="s2" data-parallax="scroll" data-image-src="/agile/images/bg-video.jpg">
            <h2>Видео</h2>
            <iframe width="857" height="482" src="https://www.youtube.com/embed/dXOPgZq_pEc" frameborder="0" allowfullscreen></iframe>
        </div>*/?>
		
        <div class="program" id="s3">
            <div class="program-b">
                <div class="wrapper">
                    <h2>программа тренинга</h2>
                    <dl>
                        <dt>Курс:</dt>
                        <dd><?=$arResult["COURSE"]["SCHEDULED"]["PROPERTIES"]["course_code"]["VALUE"]?></dd>
                        <dt>Длительность:</dt>
                        <dd><?=$arResult["COURSE"]["SCHEDULED"]["PROPERTIES"]["schedule_duration"]["VALUE"]?> ч.</dd>
						<?if ($arResult["COURSE"]["SCHEDULED"]["PROPERTIES"]["course_code"]["VALUE"]=="SDP-033") {?>
							<dt>Тип курса:</dt>
							<dd>Подготовка к сертификации: Курсы для подготовки к прохождению внешней сертификации</dd>
						<?}?>
                        <dt>Целевая аудитория:</dt>
                        <dd><?=$arResult["COURSE"]["course_audience"]?></dd>
                    </dl>
                    <div class="blocks">
                        <div class="block">
                            <h3><span class="ico"><img src="/agile/images/ico01.png" alt=""></span>описание</h3>
							<?=$arResult["COURSE"]["course_description"]?>
                        </div>
						<?if (strlen($arResult["COURSE"]["course_puproses"])>0) {?>
                        <div class="block">
                            <h3><span class="ico"><img src="/agile/images/ico02.png" alt=""></span>цели</h3>
							<?=$arResult["COURSE"]["course_puproses"]?>
                        </div>
						<?}?>
                        <div class="block">
                            <h3><span class="ico"><img src="/agile/images/ico03.png" alt=""></span>разбираемые темы</h3>
							<?if ($arResult["PROPERTIES"]["THEMES"]["VALUE"]) {?>
								<?=htmlspecialchars_decode($arResult["PROPERTIES"]["THEMES"]["VALUE"]["TEXT"])?>
							<?} else {?>
								<?=$arResult["COURSE"]["course_topics"]?>
							<?}?>
                        </div>
						<?if ($arResult["PROPERTIES"]["EXT_THEMES"]["VALUE"]) {?>
                        <div class="block">
                            <h3><span class="ico"><img src="/agile/images/ico04.png" alt=""></span>продвинутые темы</h3>
							<?=htmlspecialchars_decode($arResult["PROPERTIES"]["EXT_THEMES"]["VALUE"]["TEXT"])?>
                        </div>
						<?}?>
                        <div class="block">
                            <h3><span class="ico"><img src="/agile/images/ico05.png" alt=""></span>тип курса</h3>
                            <?if ($arResult["COURSE"]["SCHEDULED"]["PROPERTIES"]["course_code"]["VALUE"]=="SDP-033") {?><p>Подготовка к сертификации: Курсы для подготовки к прохождению внешней сертификации</p><?}?>
                            <p>Целевая аудитория: <?=$arResult["COURSE"]["course_audience"]?></p>
                        </div>
                    </div>
					<?$ar_res = CPrice::GetBasePrice($arResult["COURSE"]["SCHEDULED"]["ID"]);?>
                    <div class="price">
						<?//print_r($arResult["COURSE"]["SCHEDULED"]["PROPERTIES"]["startdate"]["VALUE"])?>
                        <h2><span>стоимость</span></h2>
                        <?/*
						<div class="dates">
							<?$between0=strtotime($arResult["COURSE"]["SCHEDULED"]["PROPERTIES"]["startdate"]["VALUE"]." - 28 day");?>
							<?$between3=strtotime($arResult["COURSE"]["SCHEDULED"]["PROPERTIES"]["startdate"]["VALUE"]." - 15 day");?>
							<?$between4=strtotime($arResult["COURSE"]["SCHEDULED"]["PROPERTIES"]["startdate"]["VALUE"]." - 14 day");?>
							<?//print_r(date("d.m", $between0));?>
						
							<?$between1=strtotime($arResult["COURSE"]["SCHEDULED"]["PROPERTIES"]["startdate"]["VALUE"]);?>
							<?//print_r(date("d.m", $between1));?>
							<span>до <?=date("d.m", $between3)?> <strong><?=number_format( ($ar_res["PRICE"]*0.9), 0, ".", " ")?><?if ($ar_res["CURRENCY"]=="GRN") {?> грн. <?} else {?>&#8381;<?}?></strong></span>
                            <span>с <?=date("d.m", $between4)?> до <?=date("d.m", $between1)?> <strong><?=number_format($ar_res["PRICE"], 0, ".", " ")?> <?if ($ar_res["CURRENCY"]=="GRN") {?> грн. <?} else {?>&#8381;<?}?></strong></span>
                        </div>
                        <div class="slider">
							<?$all=$between1-$between0?>
							<?$my=($between1-time())?>
							<?if (time()>$between0) {?>
								<?$percent=100-($my/$all)*100?>
							<?} else {?>
								<?$percent=2?>
							<?}?>
                            <div class="bar" style="width:<?=$percent?>%;">
                                <span class="circle"></span>
                            </div>
							
                        </div>*/?>
						<?//print_r($arResult["PROPERTIES"]);?>
						<strong style="text-align: center; display: block; font-size: 40px; line-height: 40px;"><?=number_format($arResult["PROPERTIES"]["PRICE_1"]["VALUE"], 0, ".", " ")?> <?if ($ar_res["CURRENCY"]=="GRN") {?> грн. <?} else {?>&#8381;<?}?></strong>
                    </div>
					<?/*
                    <ul class="payments">
                        <li><img src="/agile/images/payment01.png" alt=""></li>
                        <li><img src="/agile/images/payment02.png" alt=""></li>
                        <li><img src="/agile/images/payment03.png" alt=""></li>
                        <li><img src="/agile/images/payment04.png" alt=""></li>
                    </ul>
					*/?>
                    <div class="centered">
                        <a href="#regpopup" class="btn">Зарегистрироваться</a>
                    </div>
                </div>
            </div>
        </div>
		<?if ($arResult["COURSE"]["SCHEDULED"]["PROPERTIES"]["course_code"]["VALUE"]=="SDP-033") {?>
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
                    <p>PSM I больше ценится в сообществе ИТ организаций, благодаря сложному тесту, а не факту прохождения тренинга.</p>
                </li>
                <li>
                    <strong>3</strong>
                    <p>Microsoft® использует PSM I тест как обязательное условие проверки компетенции для участии в проектах Silver and Gold Application Lifecycle Management (ALM).</p>
                </li>
                <li>
                    <strong>4</strong>
                    <p>PSM I тест постоянно обновляется при новых редакциях основного документа Scrum Guide, поэтому проверка знаний всегда актуальна.</p>
                </li>
            </ul>
        </div>
		<?}?>