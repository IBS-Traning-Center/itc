<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div id="header">
        <strong class="logo"><a href="/">LUXOFT TRAINING</a></strong>
        <a href="#overlay-form" class="btn">Зарегистрироваться</a>
        <ul id="nav">
            <li><a href="#s1">Эксперт</a></li>
            <li><a href="#s3">Программа</a></li>
           <?if ($arResult["COURSE"]["SCHEDULED"]["PROPERTIES"]["course_code"]["VALUE"]=="SDP-033") {?> <li><a href="#s4">Сертификация</a></li><?}?>
            <li><a href="#s4">Стоимость</a></li>
            <li><a href="#s5">Место Проведения</a></li>
	    <li><a href="#s6">Видео</a></li>
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
        <div class="banner" data-parallax="scroll" style="background: url('<?=$arResult["PROPERTIES"]["BANNER_LINK"]["VALUE"]?>')">
            <div class="wrapper">
                <p class="banner__title"><?=$arResult["PROPERTIES"]["BANNER_TITLE"]["VALUE"]?></p>

                <?=htmlspecialchars_decode($arResult["PROPERTIES"]["NAME_EVENT"]["VALUE"]["TEXT"])?>

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
                <p class="banner__date"><?=$dateE_F?></br>

                <?=$arResult["PROPERTIES"]["TIME_START"]["VALUE"]?>-<?=$arResult["PROPERTIES"]["TIME_END"]["VALUE"]?></p>

                <a href="#overlay-form" class="btn">Зарегистрироваться</a>
            </div>
        </div>
		<?CModule::IncludeModule("catalog")?>
	
        <div class="person" id="s1">
            <div class="image">
                <img src="<?=$arResult["PREVIEW_PICTURE"]["SRC"]?>" alt="">
            </div>
		<div class="holder">
			<h2 class="holder__title">Эксперт</h2>
			<h3 class="holder__head"><?=$arResult["PROPERTIES"]["TRAINER_HEADING"]["VALUE"]?></h3>
			<?=htmlspecialchars_decode($arResult["PROPERTIES"]["TRAINER_DESCRIPTION"]["VALUE"]["TEXT"])?>
		</div>
        </div>	
	
			<h2 style="text-align:center; margin-bottom:45px;">Видео</h2>
			<div class="video-wraper" id="s6">
				<?if (strlen($arResult["PROPERTIES"]["VIDEO_LINK"]["VALUE"])>0) {?>
	    				<video volume="-500" controls="controls">
						<source src="<?=$arResult["PROPERTIES"]["VIDEO_LINK"]["VALUE"]?>" type="video/mp4">
	    				</video>
				<?}?>
				<?if ($arResult["PROPERTIES"]["VIDEO_YOUTUBE"]["VALUE"]) {?>
					<?=htmlspecialchars_decode($arResult["PROPERTIES"]["VIDEO_YOUTUBE"]["VALUE"]["TEXT"])?>
				<?}?>
			</div>
        <div class="program" id="s3">
            <!-- ПРОГРАММА -->
            <div class="program-b">
                <div class="wrapper">
                    <h2>программа</h2>
                    <div class="blocks">
                        <div class="block">
                            <h3><span class="ico"><img src="/it-guru/images/description@1x.png" alt=""></span>Описание</h3>
							<?if ($arResult["PROPERTIES"]["DESCRIPTION"]["VALUE"]) {?>
								<?=htmlspecialchars_decode($arResult["PROPERTIES"]["DESCRIPTION"]["VALUE"]["TEXT"])?>
						<?}?>
                        </div>
                        <div class="block">
                            <h3><span class="ico"><img src="/it-guru/images/goals@1x.png" alt=""></span>Цели</h3>
							<?if ($arResult["PROPERTIES"]["PURPOSE"]["VALUE"]) {?>
							<?=htmlspecialchars_decode($arResult["PROPERTIES"]["PURPOSE"]["VALUE"]["TEXT"])?>
						<?}?>
                        </div>
                        <div class="block">
                            <h3><span class="ico"><img src="/it-guru/images/themes@1x.png" alt=""></span>Разбираемые Темы</h3>
							<?if ($arResult["PROPERTIES"]["THEMES"]["VALUE"]) {?>
								<?=htmlspecialchars_decode($arResult["PROPERTIES"]["THEMES"]["VALUE"]["TEXT"])?>
						<?}?>
                        </div>
                        <div class="block">
                            <h3><span class="ico"><img src="/it-guru/images/toolstools@1x.png" alt=""></span>Инструменты и Технологии</h3>
							<?if ($arResult["PROPERTIES"]["TECHNOLOGY"]["VALUE"]) {?>
							<?=htmlspecialchars_decode($arResult["PROPERTIES"]["TECHNOLOGY"]["VALUE"]["TEXT"])?>
						<?}?>
                        </div>
                    </div>
                    <div class="blockrow">
                        <h3><span class="ico"><img src="/it-guru/images/target_audience@1x.png" alt=""></span>Целевая Аудитория</h3>
                        <?if($arResult["PROPERTIES"]["AUDIENCE"]["VALUE"]) {?>
                        <?=htmlspecialchars_decode($arResult["PROPERTIES"]["AUDIENCE"]["VALUE"]["TEXT"])?>
                        <?}?>
                        <div class="blockrow" id="s4"></div>
                    </div>

                    <!-- СТОИМОСТЬ -->
                    <div class="price">

                            <h2><span>стоимость</span></h2>
                            <div class="dates">
                            <span>до <?=date('d.m', strtotime($arResult["PROPERTIES"]["DATE_1"]["VALUE"]))?>
                            <strong><?=$arResult["PROPERTIES"]["PRICE_1"]["VALUE"]?>&nbsp;&#8381;</strong></span>
                                <span>с <?=date('d.m', strtotime($arResult["PROPERTIES"]["DATE_2"]["VALUE"]))?> до
                            <?=date('d.m', strtotime("-1 day", strtotime($arResult["PROPERTIES"]["DATE_EVENT"]["VALUE"]))     )?>
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
                    <div class="centered">
                        <a href="#overlay-form" class="btn">Зарегистрироваться</a>
                    </div>
                    <div class="bonuses">
                        <div class="bonus-h">БОНУСЫ УЧАСТНИКАМ:</div>
                        <div class="bonus-list" style="text-align: center;">
                            <div class="bonus-item first">
                                <img src="../images/bonus-cert.png">
                                <div class="bonus-text">Именной сертификат</div>
                                <div style="clear:both"></div>
                            </div>
                        </div>
                        <div class="clear:both"></div>
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
