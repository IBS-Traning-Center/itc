<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$expert_short = nl2br($arResult['PROPERTIES']['expert_short']['VALUE']);
$expert_name = nl2br($arResult['PROPERTIES']['expert_name']['VALUE']);
$expert_title = nl2br($arResult['PROPERTIES']['expert_title']['VALUE']);
$expert_language = nl2br($arResult['PROPERTIES']['expert_language']['VALUE']);
$expert_area = $arResult['PROPERTIES']['HTML_AREA']['~VALUE']['TEXT'];
$expert_special = $arResult['PROPERTIES']['HTML_SPECIAL']['~VALUE']['TEXT'];
$expert_experience = $arResult['PROPERTIES']['HTML_EXPERIENCE']['~VALUE']['TEXT'];
$expert_teacher =$arResult['PROPERTIES']['HTML_TEACHER']['~VALUE']['TEXT'];
$expert_edu = $arResult['PROPERTIES']['HTML_EDU']['~VALUE']['TEXT'];
$expert_certified = $arResult['PROPERTIES']['HTML_CERTIFIED']['~VALUE']['TEXT'];
$expert_publications = $arResult['PROPERTIES']['HTML_PUBLICATIONS']['~VALUE']['TEXT'];
$expert_social = $arResult['PROPERTIES']['HTML_SOCIAL']['~VALUE']['TEXT'];

if ($arResult['PROPERTIES']['HTML_AREA']['VALUE']['TYPE'] == "text" )
	$expert_area = nl2br($expert_area);
if ($arResult['PROPERTIES']['HTML_SPECIAL']['VALUE']['TYPE'] == "text" )
	$expert_special = nl2br($expert_special);
if ($arResult['PROPERTIES']['HTML_EXPERIENCE']['VALUE']['TYPE'] == "text" )
	$expert_experience = nl2br($expert_experience);
if ($arResult['PROPERTIES']['HTML_TEACHER']['VALUE']['TYPE'] == "text" )
	$expert_teacher = nl2br($expert_teacher);
if ($arResult['PROPERTIES']['HTML_EDU']['VALUE']['TYPE'] == "text" )
	$expert_edu = nl2br($expert_edu);
if ($arResult['PROPERTIES']['HTML_CERTIFIED']['VALUE']['TYPE'] == "text" )
	$expert_certified = nl2br($expert_certified);
if ($arResult['PROPERTIES']['HTML_PUBLICATIONS']['VALUE']['TYPE'] == "text" )
	$expert_publications = nl2br($expert_publications);
if ($arResult['PROPERTIES']['HTML_SOCIAL']['VALUE']['TYPE'] == "text" )
	$expert_social = nl2br($expert_social); 
//iwrite($arResult['PROPERTIES']['expert_featured']);

 //HTML_AREA
 //HTML_SPECIAL
 //HTML_EXPERIENCE
 //HTML_TEACHER
 //HTML_EDU
 //HTML_CERTIFIED
 
$expert_featured = nl2br($arResult['PROPERTIES']['expert_featured']['VALUE']);
$expert_blog = nl2br($arResult['PROPERTIES']['expert_blog']['VALUE']);

if(($_SERVER["REAL_FILE_PATH"] === "/about/experts/detail.html") and ($arResult['PROPERTIES']['expert_featured']['VALUE_ENUM_ID'] !== "75")){
	$vTempURL= str_replace("experts","treners",$_SERVER["REQUEST_URI"]);
	LocalRedirect($vTempURL, false, "301 Moved permanently");
}
if(($_SERVER["REAL_FILE_PATH"] === "/about/treners/detail.html") and ($arResult['PROPERTIES']['expert_featured']['VALUE_ENUM_ID'] === "75")){
	$vTempURL= str_replace("treners","experts",$_SERVER["REQUEST_URI"]);
	LocalRedirect($vTempURL, false, "301 Moved permanently");
}
?>
<?
$APPLICATION->SetTitle("$expert_name");
$APPLICATION->SetPageProperty("blue_title", $arResult["NAME"] ." ". $expert_name);
$APPLICATION->SetPageProperty("title", $arResult["NAME"] ." ". $expert_name." / Эксперты и Тренеры Luxoft Training");
$APPLICATION->AddChainItem($arResult["NAME"]." ". $expert_name, "");
?>
<div class="trainer-shadow-wrap" itemscope itemtype="http://data-vocabulary.org/Person">
	<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arResult["DETAIL_PICTURE"])):?>
		<img itemprop="photo" class="photo" style="max-width:250px; max-height:350px" border="0" src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" width="<?=$arResult["DETAIL_PICTURE"]["WIDTH"]?>" height="<?=$arResult["DETAIL_PICTURE"]["HEIGHT"]?>" alt="<?=$arResult["DETAIL_PICTURE"]["ALT"]?>"  title="<?=$arResult["NAME"]?>" />
	<?endif?>
    <div class="trener-header">
	    <?if($arParams["DISPLAY_NAME"]!="N" && $arResult["NAME"]):?>
		    <h1><span itemprop="name"><?=$arResult["NAME"]?> <?=$expert_name?></span></h1>
	    <?endif;?>
	    <meta itemprop="affiliation" content="Luxoft-Training"/>
        <div class="position"><span itemprop="role"><?=$expert_short?></span></div>
    </div>
    <div class="clearfix"></div>

<div class="trainer-description">
  <?=$arResult['PREVIEW_TEXT']?>
</div>
<div>
  <?if (strlen($expert_area)>0) {?>
    <div class="main-knowledge"><?=$expert_area?></div>
  <? } ?>
  <?if (strlen($expert_special)>0) {?>
    <div class="main-knowledge"><h3>Специализации:</h3><?=$expert_special?></div>
  <? } ?>
  <?if (strlen($expert_experience)>0) {?>
    <div class="main-knowledge"><h3>Профессиональный опыт:</h3><?=$expert_experience?></div>
  <? } ?>
  <?if (strlen($expert_teacher)>0) {?>
    <div class="main-knowledge"><h3>Преподавательский опыт:</h3><?=$expert_teacher?></div>
  <? } ?>
  <?if (strlen($expert_edu)>0) {?>
    <div class="main-knowledge"><h3>Образование:</h3><?=$expert_edu?></div>
  <? } ?>
  <?if (strlen($expert_certified)>0) {?>
    <div class="main-knowledge"><h3>Курсы, сертификаты:</h3><?=$expert_certified?></div>
  <? } ?>
  <?if (strlen($expert_publications)>0) {?>
    <div class="main-knowledge"><h3>Публикации:</h3><?=$expert_publications?></div>
  <? } ?>
  <?if (strlen($expert_social)>0) {?>
    <div class="main-knowledge"><h3>Социальная сфера:</h3><?=$expert_social?></div>
  <? } ?>
  <?if (strlen($expert_language)>0) {?>
    <div class="main-knowledge"><h3>Англ. язык (уровень владения):</h3><?=$expert_language?></div>
  <? } ?>
</div>
<?if (is_array($arResult["REVIEW"])) {?>
<div class="cert-wrap" style="width: 616px;">
        <h3>Отзывы</h3>
		<br/>
		<?foreach ($arResult["REVIEW"] as $arReview) {?>
		<div class="review-item">
			<div class="review-name"><?=$arReview["NAME"]?></div>
			<div class="review-content"><?=$arReview["REVIEW"]?></div>
		</div>
		<?}?>
</div>
<?}?>
	<?//print_r($arResult["CERT"])?>
	<?/*if (is_array($arResult["CERT"])) {?>
    <div class="cert-wrap">
        <h3>Сертификаты</h3>
        <div class="client-list">
            <a class="prev-client cert"></a>
            <a class="next-client cert"></a>
            <div class="client-slider cert">
                <div class="items">
                    <div class="cert-section">
						<?$t=0?>
						<?foreach ($arResult["CERT"] as $key=>$arCert) {?>
						<?if ($t==5) {?>
							</div><div class="cert-section">
							<?$t=0;?>
						<?}?>
                        <div class="cert-item">
                            <a class="fancy" href="<?=$arCert["DETAIL_PICTURE"]["SRC"]?>"><img data-bx-image="<?=$arCert["DETAIL_PICTURE"]["SRC"]?>" src="<?=$arCert["PREVIEW_PICTURE"]["SRC"]?>" title="<?=$arCert["NAME"]?>" border="0" alt="<?=$arCert["NAME"]?>"></a>
                        </div>
						<?$t++?>
						<?}?>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<script type="text/javascript">
	$('document').ready(function() {
		$(".client-slider.cert").scrollable({next: '.next-client.cert', prev: '.prev-client.cert', circular: false});
	})
	</script>
	<?}?>
	<?if (is_array($arResult["VIDEO"])) {?>
    <div class="video-wrap">
        <h3>Видео</h3>
        <div class="client-list">
            <a class="prev-client vid"></a>
            <a class="next-client vid"></a>
            <div class="client-slider vid">
                <div class="items">
					<?$t=0;?>
					<div class="cert-section">
					<?foreach ($arResult["VIDEO"] as $key=>$arVideo) {?>
                        <div class="cert-item">
						<?if ($t==3) {?>
							</div><div class="cert-section">
							<?$t=0;?>
						<?}?>
                            <a class="video-play" data-id="<?=$arVideo["ID"]?>" href="http://www.youtube.com/embed/<?=$arVideo["ID"]?>?autoplay=1"><img src="<?=$arVideo["SRC"]?>"  title="<?=$arVideo["NAME"]?>" border="0" width="225" alt="<?=$arVideo["NAME"]?>"></a>
                            <div class="video-name"><?=$arVideo["NAME"]?></div>
                        </div>
						<?$t++?>
                     
					<?}?>
					</div>
                </div>
            </div>
        </div>
    </div>
	<script type="text/javascript">
	$('document').ready(function() {
		$(".client-slider.vid").scrollable({next: '.next-client.vid', prev: '.prev-client.vid', circular: false});
$('.video-play').fancybox({'type': 'iframe', "allowfullscreen": "true", "width": 900, "height": 620});
	})
	</script>
	<?} /*?>
    <div class="news-trainer-wrap">
        <h3>Новости</h3>
        <div class="news-trainer-item"><div class="trainer-news-date">20.09.14</div><a href="#">Объектно-ориентированное проектирование на UML.</a></div>
        <div class="news-trainer-item"><div class="trainer-news-date">20.09.14</div><a href="#">За это время он был соруководителем специального семинара </a></div>
    </div>
    <?*/?>
	
</div>


