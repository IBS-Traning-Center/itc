<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div id="header">
        <strong class="logo"><a href="/">LUXOFT TRAINING</a></strong>
        <a href="#regpopup" class="btn">Sign Up</a>
        <ul id="nav">
            <li><a href="#s1">Trainer</a></li>
            <li><a href="#s2">Video</a></li>
            <li><a href="#s3">Training outline</a></li>
			<li><a href="#s4">Price</a></li>
           <?if ($arResult["COURSE"]["SCHEDULED"]["PROPERTIES"]["course_code"]["VALUE"]=="SDP-033") {?> <li><a href="#s4">Certification</a></li><?}?>
            <li><a href="#s5">Location</a></li>
        </ul>
    </div>
	<?
	$cp = $this->__component;
	$cp->arResult['COURSE'] = $arResult["COURSE"];
    $cp->SetResultCacheKeys(array('COURSE'));?>
	<?$arCity=GetIblockElement($arResult["COURSE"]["SCHEDULED"]["PROPERTIES"]["CITY_ID"]["VALUE"])?>
	<?//print_r($arCity);?>
	<?$monthstart=FormatDate("F", strtotime($arResult["COURSE"]["SCHEDULED"]["PROPERTIES"]["STARTDATE"]["VALUE"]));?>
	<?$monthend=FormatDate("F", strtotime($arResult["COURSE"]["SCHEDULED"]["PROPERTIES"]["STARTDATE"]["VALUE"]));?>
	<?echo $monthend?>
	<?if ($monthstart==$monthend) {?>
		<?$string_date=date("j", strtotime($arResult["COURSE"]["SCHEDULED"]["PROPERTIES"]["STARTDATE"]["VALUE"]))." - ".date("j", strtotime($arResult["COURSE"]["SCHEDULED"]["PROPERTIES"]["ENDDATE"]["VALUE"]))." ".strtolower($monthend)?>
	<?} else {?>
		<?$string_date=date("j", strtotime($arResult["COURSE"]["SCHEDULED"]["PROPERTIES"]["STARTDATE"]["VALUE"]))." ".strtolower($monthstart)." - ".date("j", strtotime($arResult["COURSE"]["SCHEDULED"]["PROPERTIES"]["ENDDATE"]["VALUE"]))." ".strtolower($monthend)?>
	<?}?>
	<?$time=$arResult["COURSE"]["SCHEDULED"]["PROPERTIES"]["TIME"]["VALUE"]?>
    <div id="main">
        <div class="banner" data-parallax="scroll" data-image-src="/agile/images/banner.jpg">
            <div class="wrapper">
                <p>Training</p>
                <h1><?=$arResult["COURSE"]["NAME"]?></h1>
                <p><span style="text-transform: capitalize;"><?=$string_date?></span>, <?=$arCity["NAME"]?></p>
				<p><?=$time?></p>
                <a href="#regpopup" class="btn">sign Up</a>
            </div>
        </div>
		<?CModule::IncludeModule("catalog")?>
	
        <div class="person" id="s1">
            <h2>TRAINER</h2>
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
        <div class="video" id="s2" data-parallax="scroll" data-image-src="/agile/images/bg-video.jpg">
            <h2>Video</h2>
            <iframe width="857" height="482" src="https://www.youtube.com/embed/dXOPgZq_pEc" frameborder="0" allowfullscreen></iframe>
        </div>
		
        <div class="program" id="s3">
            <div class="program-b">
                <div class="wrapper">
                    <h2>Training outline</h2>
                    <dl>
                        <dt>Training:</dt>
                        <dd><?=$arResult["COURSE"]["CODE"]?></dd>
                        <dt>Duration:</dt>
                        <dd><?=$arResult["COURSE"]["SCHEDULED"]["PROPERTIES"]["DURATION"]["VALUE"]?> hours</dd>
						<?/*if ($arResult["COURSE"]["SCHEDULED"]["PROPERTIES"]["course_code"]["VALUE"]=="SDP-033") {?>
							<dt>Target Audience:</dt>
							<dd>Scrum Masters</dd>
							<dd>Managers</dd>
						<?}*/?>
                       
                    </dl>
                    <div class="blocks">
                        <div class="block">
                            <h3><span class="ico"><img src="/agile/images/ico01.png" alt=""></span>Description</h3>
							<?=$arResult["COURSE"]["DESCRIPTION"]?>

                        </div>
						
                        
						
                        <div class="block">
                            <h3><span class="ico"><img src="/agile/images/ico03.png" alt=""></span>Roadmap</h3>
							<?if ($arResult["PROPERTIES"]["THEMES"]["VALUE"]) {?>
								<?=htmlspecialchars_decode($arResult["PROPERTIES"]["THEMES"]["VALUE"]["TEXT"])?>
							<?} else {?>
								<?=$arResult["COURSE"]["course_topics"]?>
							<?}?>
                        </div>
						<div class="block">
                            <h3><span class="ico"><img src="/agile/images/ico02.png" alt=""></span>Objectives</h3>
							<?=$arResult["COURSE"]["OBJ"]?>
                        </div>
						<?if ($arResult["PROPERTIES"]["EXT_THEMES"]["VALUE"]) {?>
                        <div class="block">
                            <h3><span class="ico"><img src="/agile/images/ico04.png" alt=""></span>продвинутые темы</h3>
							<?=htmlspecialchars_decode($arResult["PROPERTIES"]["EXT_THEMES"]["VALUE"]["TEXT"])?>
                        </div>
						<?}?>
						<??>
                        <div class="block">
                            <h3><span class="ico"><img src="/agile/images/ico05.png" alt=""></span>Target Audience:</h3>
                           <?=$arResult["COURSE"]["TARGET"]?>
                        </div>
						
                    </div>
					<?//print_r($arResult["COURSE"]);?>
					<?$ar_res = CPrice::GetBasePrice($arResult["COURSE"]["SCHEDULED"]["ID"]);?>
                    <div id="s4" class="price">
						<?//print_r($arResult["COURSE"]["SCHEDULED"]["PROPERTIES"]["startdate"]["VALUE"])?>
                        <h2><span>Price</span></h2>
                        <?/*
						<div class="dates">
							<?$between0=strtotime($arResult["COURSE"]["SCHEDULED"]["PROPERTIES"]["STARTDATE"]["VALUE"]." - 28 day");?>
							<?$between3=strtotime($arResult["COURSE"]["SCHEDULED"]["PROPERTIES"]["STARTDATE"]["VALUE"]." - 15 day");?>
							<?$between4=strtotime($arResult["COURSE"]["SCHEDULED"]["PROPERTIES"]["STARTDATE"]["VALUE"]." - 14 day");?>
							<?//print_r(date("d.m", $between0));?>
						
							<?$between1=strtotime($arResult["COURSE"]["SCHEDULED"]["PROPERTIES"]["STARTDATE"]["VALUE"]);?>
							<?//print_r(date("d.m", $between1));?>
							<span>till <?=date("d.m", $between3)?> <strong><?=number_format( ($ar_res["PRICE"]*0.9), 0, ".", " ")?><?if ($ar_res["CURRENCY"]=="EUR") {?> Euro <?} else {?>&#8381;<?}?></strong></span>
                            <span>from <?=date("d.m", $between4)?> till <?=date("d.m", $between1)?> <strong><?=number_format($ar_res["PRICE"], 0, ".", " ")?> <?if ($ar_res["CURRENCY"]=="EUR") {?> Euro <?} else {?>&#8381;<?}?></strong></span>
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
                        </div>
						*/?>
						
						<?//print_r($arResult["COURSE"]["SCHEDULED"]["PROPERTIES"]["startdate"]["VALUE"])?>
                        
                        <div class="dates">
							<?$between0=strtotime($arResult["COURSE"]["SCHEDULED"]["PROPERTIES"]["STARTDATE"]["VALUE"]." - ".($arResult["PROPERTIES"]["DAYS_OF_CHANGE"]["VALUE"]*2)." day");?>
							<?$between3=strtotime($arResult["COURSE"]["SCHEDULED"]["PROPERTIES"]["STARTDATE"]["VALUE"]." - ".($arResult["PROPERTIES"]["DAYS_OF_CHANGE"]["VALUE"]+1)." day");?>
							<?$between4=strtotime($arResult["COURSE"]["SCHEDULED"]["PROPERTIES"]["STARTDATE"]["VALUE"]." - ".$arResult["PROPERTIES"]["DAYS_OF_CHANGE"]["VALUE"]." day");?>
							<?//print_r(date("d.m", $between0));?>
						
							<?$between1=strtotime($arResult["COURSE"]["SCHEDULED"]["PROPERTIES"]["STARTDATE"]["VALUE"]);?>
							<?//print_r(date("d.m", $between1));?>
							<span>until <?=date("d.m", $between3)?> <strong><?=number_format( ($ar_res["PRICE"]-$arResult["PROPERTIES"]["Discount"]["VALUE"]), 0, ".", " ")?><?if ($ar_res["CURRENCY"]=="GRN") {?> грн. <?} else {?> euro<?}?></strong></span>
                            <span>from <?=date("d.m", $between4)?> until <?=date("d.m", $between1)?> <strong><?=number_format($ar_res["PRICE"], 0, ".", " ")?> <?if ($ar_res["CURRENCY"]=="GRN") {?> грн. <?} else {?>euro<?}?></strong></span>
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
                        </div>
                   
						<?/*<div style="font-size: 33px;" class="centered ">
						
								<strong><?=number_format($ar_res["PRICE"], 0, ".", " ")?> Euro</strong>
					
						</div>*/?>
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
                        <a href="#regpopup" class="btn">sign Up</a>
                    </div>
                </div>
            </div>
        </div>
		<?//if ($arResult["COURSE"]["SCHEDULED"]["PROPERTIES"]["course_code"]["VALUE"]=="SDP-033") {?>
        <div class="advantages" data-parallax="scroll" data-image-src="/agile/images/bg-advantages.jpg">
            <?/*<strong class="logo-psm">PSM I</strong>*/?>
            <h2>BENEFITS</h2>
            <ul>
                <li>
                    <strong>1</strong>
                    <p><?=$arResult["PROPERTIES"]["BEN_1"]["VALUE"]?></p>
                </li>
                <li>
                    <strong>2</strong>
                    <p><?=$arResult["PROPERTIES"]["BEN_2"]["VALUE"]?></p>
                </li>
                <li>
                    <strong>3</strong>
                    <p><?=$arResult["PROPERTIES"]["BEN_3"]["VALUE"]?></p>
                </li>
                <li>
                    <strong>4</strong>
                    <p><?=$arResult["PROPERTIES"]["BEN_4"]["VALUE"]?></p>
                </li>
            </ul>
        </div>