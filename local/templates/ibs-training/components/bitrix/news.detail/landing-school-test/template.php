<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div id="header">
        <strong class="logo"><a href="/">LUXOFT TRAINING</a></strong>
        <a href="#overlay-form" class="btn">Зарегистрироваться</a>
        <ul id="nav">
            <li><a href="#s1">Эксперты</a></li>
            <li><a href="#s3">Программа</a></li>
           <?if ($arResult["COURSE"]["SCHEDULED"]["PROPERTIES"]["course_code"]["VALUE"]=="SDP-033") {?> <li><a href="#s4">Сертификация</a></li><?}?>
            <li><a href="#s5">Стоимость</a></li>
            <?/*<li><a href="#s5">Место Проведения</a></li>*/?>
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
        <? /*<div class="banner" data-parallax="scroll" style="background-image: url('<?=CFile::GetPath($arResult["PROPERTIES"]["BANNER_LINK"]["VALUE"])?>')">*/?>
	    <div class="banner" data-parallax="scroll">

		<picture class="banner-picture">    
			<source srcset="<?=CFile::GetPath($arResult["PROPERTIES"]["BANNER_LINK_MOBILE"]["VALUE"])?>" media="(max-width: 767px)">      
			<img srcset="<?=CFile::GetPath($arResult["PROPERTIES"]["BANNER_LINK"]["VALUE"])?>">
		</picture>
		<div class="wrapper">
                <p class="banner__title"><?=$arResult["PROPERTIES"]["BANNER_TITLE"]["VALUE"]?></p>

                <h1><?=$arResult["NAME"]?></h1>

		<?if ($arResult["PROPERTIES"]["DATE_EVENT"]["VALUE"])?>
<? 
$_monthsList = array(
  ".01." => "января",
  ".02." => "февраля",
  ".03." => "марта",
  ".04." => "апреля",
  ".05." => "мая",
  ".06." => "июня",
  ".07." => "июля",
  ".08." => "августа",
  ".09." => "сентября",
  ".10." => "октября",
  ".11." => "ноября",
  ".12." => "декабря"
);

$dateE = date('d.m.Y', strtotime($arResult["PROPERTIES"]["DATE_EVENT"]["VALUE"]));
$_mD = date(".m.", strtotime($dateE));
$dateE_F = str_replace($_mD, " ".$_monthsList[$_mD]." ", $dateE);

?>
                <?/*<p class="banner__date"><?=$dateE_F?></br>*/?>
                <p class="banner__date"><?=$arResult["PROPERTIES"]["DATE_EVENT"]["VALUE"]?></br>

                <?=$arResult["PROPERTIES"]["TIME_START"]["VALUE"]?>-<?=$arResult["PROPERTIES"]["TIME_END"]["VALUE"]?></p>

                <a href="#overlay-form" class="btn">Зарегистрироваться</a>
	     </div>
        </div>
		<?CModule::IncludeModule("catalog")?>
        <div class="person-title">
                <h2 id="s1">Эксперты</h2>
	</div>
	
        <div class="person">
            <div class="image">
                <img src="<?=CFile::GetPath($arResult["PROPERTIES"]["TRAINER_PHOTO_1"]["VALUE"])?>" alt="Фото тренера №1">
            </div>
            <div class="holder">
                

		<?if ( strlen($arResult["PROPERTIES"]["TRAINER_HEADING"]["VALUE"]) > 0 ) {?>
                	<h3 class="holder__head"><?=$arResult["PROPERTIES"]["TRAINER_HEADING"]["VALUE"]?></h3>
		<?}?>
		<?if ($arResult["PROPERTIES"]["TRAINER_DESCRIPTION"]["VALUE"]) {?>
			<?=htmlspecialchars_decode($arResult["PROPERTIES"]["TRAINER_DESCRIPTION"]["VALUE"]["TEXT"])?>
		<?}?>
            </div>
        </div>	


        <div class="person" id="s2">
            <div class="image">
                <img src="<?=CFile::GetPath($arResult["PROPERTIES"]["TRAINER_PHOTO_2"]["VALUE"])?>" alt="Фото тренера №2">
            </div>
            <div class="holder">
		<?if (strlen($arResult["PROPERTIES"]["TRAINER_HEADING_2"]["VALUE"]) > 0) {?>
                	<h3 class="holder__head"><?=$arResult["PROPERTIES"]["TRAINER_HEADING_2"]["VALUE"]?></h3>
		<?}?>
		<?if ($arResult["PROPERTIES"]["TRAINER_DESCRIPTION_2"]["VALUE"]) {?>
			<?=htmlspecialchars_decode($arResult["PROPERTIES"]["TRAINER_DESCRIPTION_2"]["VALUE"]["TEXT"])?>
		<?}?>


            </div>
        </div>	


	<?if (strlen($arResult["PROPERTIES"]["VIDEO_LINK"]["VALUE"])>0) {?>
		<div class="video-wraper">
	    		<video volume="-500" controls="controls">
				<source src="<?=$arResult["PROPERTIES"]["VIDEO_LINK"]["VALUE"]?>" type="video/mp4">
	    		</video>
		</div>
	<?}?>
        <div class="program" id="s3">
            <!-- ПРОГРАММА -->
            <div class="program-b">
                <div class="wrapper">
                    <h2 i>программа</h2>
                    <div class="blocks">
                        <div class="block">
                            <h3><span class="ico"><img src="/school/images/description@1x.png" alt=""></span>Описание</h3>
							<?if ($arResult["PROPERTIES"]["DESCRIPTION"]["VALUE"]) {?>
								<?=htmlspecialchars_decode($arResult["PROPERTIES"]["DESCRIPTION"]["VALUE"]["TEXT"])?>
						<?}?>
                        </div>
                        <div class="block">
                            <h3><span class="ico"><img src="/school/images/goals@1x.png" alt=""></span>Цели</h3>
							<?if ($arResult["PROPERTIES"]["PURPOSE"]["VALUE"]) {?>
							<?=htmlspecialchars_decode($arResult["PROPERTIES"]["PURPOSE"]["VALUE"]["TEXT"])?>
						<?}?>
                        </div>
                        <div class="block">
                            <h3><span class="ico"><img src="/school/images/themes@1x.png" alt=""></span>Разбираемые Темы</h3>
							<?if ($arResult["PROPERTIES"]["THEMES"]["VALUE"]) {?>
								<?=htmlspecialchars_decode($arResult["PROPERTIES"]["THEMES"]["VALUE"]["TEXT"])?>
						<?}?>
                        </div>
                        <div class="block">
                            <h3><span class="ico"><img src="/school/images/toolstools@1x.png" alt=""></span>Инструменты и Технологии</h3>
							<?if ($arResult["PROPERTIES"]["TECHNOLOGY"]["VALUE"]) {?>
							<?=htmlspecialchars_decode($arResult["PROPERTIES"]["TECHNOLOGY"]["VALUE"]["TEXT"])?>
						<?}?>
                        </div>
                    </div>
                    <div class="blockrow">
                        <h3><span class="ico"><img src="/school/images/target_audience@1x.png" alt=""></span>Целевая Аудитория</h3>
                        <?if($arResult["PROPERTIES"]["AUDIENCE"]["VALUE"]) {?>
                        <?=htmlspecialchars_decode($arResult["PROPERTIES"]["AUDIENCE"]["VALUE"]["TEXT"])?>
                        <?}?>
                        <div class="blockrow" id="s4"></div>
                    </div>
                    <?/* Вариант где выводятся сами курсы (не оправдал ожиданий)
                    <div class="blockrow">
                        <h3><span class="ico"><img src="/school/images/ico05.png" alt=""></span>Состав школы</h3>
                        <div class="table" style="padding-top: 0px;" id="s4">
                            <table style="width:100%">
                             <tbody>
                                <?foreach($arResult["SCHOOL_STRUCTURE"] as $Item => $values){?>
                                    <tr style="display:flex; justify-content: space-between; border-bottom: 1px solid #d1dde8">
                                        <td style="border-top:0;"><a target="_blank" href="/kurs/<?=$values['XML_ID']?>.html"><?=$values["NAME"]?></a></td>
                                        <td style="border-top:0;"><a class="btn" style="font-size: 15px; line-height: 35px;" target="_blank" href="/kurs/<?=$values['XML_ID']?>.html">ЗАРЕГИСТРИРОВАТЬСЯ</a></td>
                                    </tr>
                                <?}?>
                             </tbody>
                            </table>
                    </div>
                    */?>
                    <div class="blockrow">
                        <h3><span class="ico"><img src="/school/images/ico05.png" alt=""></span>Состав школы</h3>
                        <div class="table" style="padding-top: 0px; width: 100%;" >
                            <table>
                                <thead>
                                <tr>
                                    <th>Название</th>
                                    <th>место</th>
                                    <th>дата</th>
                                    <th>кол-во часов</th>
                                    <th>стоимость</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?foreach($arResult["SCHOOL_STRUCTURE"] as $Item => $values){?>
                                    <tr style="border-bottom: 1px solid #d1dde8">
                                        <td style="border-top:0;"><a target="_blank" href="/kurs/<?=$values["PROPERTY_SCHEDULE_COURSE_XML_ID"]?>.html"><?=$values["NAME"]?></a></td>
                                        <td><?=$values["PROPERTY_CITY_NAME"]?></td>
                                        <td><?=$values["PROPERTY_STARTDATE_VALUE"]?>-<br><?=$values["PROPERTY_ENDDATE_VALUE"]?></td>
                                        <td><?=$values["PROPERTY_SCHEDULE_DURATION_VALUE"]?></td>
                                        <td><?=number_format($values["PROPERTY_SCHEDULE_PRICE_VALUE"], 0, '', ' ');?> <?=$values["PROPERTIES"]["valuta"]?></td>
                                        <td style="border-top:0;"><a class="btn" style="font-size: 15px; line-height: 35px;" target="_blank" href="/kurs/<?=$values["PROPERTY_SCHEDULE_COURSE_XML_ID"]?>.html">ЗАРЕГИСТРИРОВАТЬСЯ</a></td>
                                    </tr>
                                   <?/* <tr>
                                        <td><a target="_blank" href="/kurs/<?=$value['XML']?>.html"><?=$value["name"]?></a></td>
                                        <td><?=$value["city_name"]?></td>
                                        <td><?=$value["startdate"]?></td>
                                        <td><?=$value["duration"];?></td>
                                        <td><?=number_format($value["price"], 0, '', ' ');?> <?=$value["valuta"]?></td>
                                    </tr>
                                */?>
                                    <?if ($USER->IsAdmin()) {?>
                                        <?//print_r($value)?>
                                    <?}?>
                                <? } ?>
                                </tbody>
                            </table>

                        </div>

				<?//if($arResult["PROPERTIES"]["SCHOOL_STRUCTURE"]["VALUE"]) {?>
                        	<?//=htmlspecialchars_decode($arResult["PROPERTIES"]["SCHOOL_STRUCTUREE"]["VALUE"]["TEXT"])?>
                     		<?//}?>

                    </div>


                    <!-- СТОИМОСТЬ -->
                    <div class="price" id="s5">

                            <h2><span>стоимость</span></h2>
                            <div class="dates" >
                            <span>до <?=date('d.m', strtotime($arResult["PROPERTIES"]["DATE_1"]["VALUE"]))?>
                            <strong><?=$arResult["PROPERTIES"]["PRICE_1"]["VALUE"]?>&nbsp;&#8381;</strong></span>
                                <span>с <?=date('d.m', strtotime($arResult["PROPERTIES"]["DATE_1"]["VALUE"].'+ 1 day'))?> до
                            <?=date('d.m', strtotime($arResult["PROPERTIES"]["DATE_2"]["VALUE"])     )?>
                            <strong><?=$arResult["PROPERTIES"]["PRICE_2"]["VALUE"]?>&nbsp;&#8381;</strong></span>
                            </div>
                            <div class="slider">
                                <div class="bar" >
                                    <span class="circle"></span>
                                </div>
                            </div>


                            <!--<ul class="payments">
                                <li><img src="/agile/images/payment01.png" alt=""></li>
                                <li><img src="/agile/images/payment02.png" alt=""></li>
                                <li><img src="/agile/images/payment03.png" alt=""></li>
                                <li><img src="/agile/images/payment04.png" alt=""></li>
                            </ul>-->
                        </div>
                    <div class="centered" >
                        <a href="#overlay-form" class="btn">Зарегистрироваться</a>
                    </div>
                    <div class="bonuses">
                        <div class="bonus-img"><img src="../images/bonus-cert.png"></div>
                        <div class="bonus-txt">После окончания школы выдаётся сертификат<br> на бланке Luxoft Training</div>
                    </div>
                </div>
            </div>
        </div>






		
<!-- 1******************************************************************************************************************************************************************************************************* -->
<script type="text/javascript">
document.addEventListener('DOMContentLoaded', ()=>{
      var a = document.getElementsByTagName('video')[0]
      a.volume = 0.25
});
</script>
