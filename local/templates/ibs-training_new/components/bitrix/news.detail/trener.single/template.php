<?

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Page\Asset;

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$asset = Asset::getInstance();
$asset->addCss('/local/components/luxoft/courses.detail/templates/.default/style.css');

if (
     is_array($arResult) &&
     is_array($arResult['PROPERTIES'])
) {
    if (is_array($arResult['PROPERTIES']['expert_short'])) {
        $expert_short = nl2br($arResult['PROPERTIES']['expert_short']['VALUE']);
    }

    if (is_array($arResult['PROPERTIES']['expert_name'])) {
        $expert_name = nl2br($arResult['PROPERTIES']['expert_name']['VALUE']);
    }

    if (is_array($arResult['PROPERTIES']['expert_title'])) {
        $expert_title = nl2br($arResult['PROPERTIES']['expert_title']['VALUE']);
    }

    if (is_array($arResult['PROPERTIES']['expert_language'])) {
        $expert_language = nl2br($arResult['PROPERTIES']['expert_language']['VALUE']);
    }

    if (
            is_array($arResult['PROPERTIES']['HTML_AREA']) &&
            is_array($arResult['PROPERTIES']['HTML_AREA']['~VALUE'])
    ) {
        $expert_area = $arResult['PROPERTIES']['HTML_AREA']['~VALUE']['TEXT'];
    }

    if (
        is_array($arResult['PROPERTIES']['HTML_SPECIAL']) &&
        is_array($arResult['PROPERTIES']['HTML_SPECIAL']['~VALUE'])
    ) {
        $expert_special = $arResult['PROPERTIES']['HTML_SPECIAL']['~VALUE']['TEXT'];
    }

    if (
        is_array($arResult['PROPERTIES']['HTML_EXPERIENCE']) &&
        is_array($arResult['PROPERTIES']['HTML_EXPERIENCE']['~VALUE'])
    ) {
        $expert_experience = $arResult['PROPERTIES']['HTML_EXPERIENCE']['~VALUE']['TEXT'];
    }

    if (
        is_array($arResult['PROPERTIES']['HTML_TEACHER']) &&
        is_array($arResult['PROPERTIES']['HTML_TEACHER']['~VALUE'])
    ) {
        $expert_teacher = $arResult['PROPERTIES']['HTML_TEACHER']['~VALUE']['TEXT'];
    }

    if (
        is_array($arResult['PROPERTIES']['HTML_EDU']) &&
        is_array($arResult['PROPERTIES']['HTML_EDU']['~VALUE'])
    ) {
        $expert_edu = $arResult['PROPERTIES']['HTML_EDU']['~VALUE']['TEXT'];
    }

    if (
        is_array($arResult['PROPERTIES']['HTML_CERTIFIED']) &&
        is_array($arResult['PROPERTIES']['HTML_CERTIFIED']['~VALUE'])
    ) {
        $expert_certified = $arResult['PROPERTIES']['HTML_CERTIFIED']['~VALUE']['TEXT'];
    }

    if (
        is_array($arResult['PROPERTIES']['HTML_PUBLICATIONS']) &&
        is_array($arResult['PROPERTIES']['HTML_PUBLICATIONS']['~VALUE'])
    ) {
        $expert_publications = $arResult['PROPERTIES']['HTML_PUBLICATIONS']['~VALUE']['TEXT'];
    }

    if (
        is_array($arResult['PROPERTIES']['HTML_SOCIAL']) &&
        is_array($arResult['PROPERTIES']['HTML_SOCIAL']['~VALUE'])
    ) {
        $expert_social = $arResult['PROPERTIES']['HTML_SOCIAL']['~VALUE']['TEXT'];
    }


    if (
            is_array($arResult['PROPERTIES']['HTML_AREA']) &&
            is_array($arResult['PROPERTIES']['HTML_AREA']['VALUE']) &&
            $arResult['PROPERTIES']['HTML_AREA']['VALUE']['TYPE'] == "text"
    ) {
        $expert_area = nl2br($expert_area);
    }

    if (
        is_array($arResult['PROPERTIES']['HTML_SPECIAL']) &&
        is_array($arResult['PROPERTIES']['HTML_SPECIAL']['VALUE']) &&
        $arResult['PROPERTIES']['HTML_SPECIAL']['VALUE']['TYPE'] == "text"
    ) {
        $expert_special = nl2br($expert_special);
    }

    if (
        is_array($arResult['PROPERTIES']['HTML_EXPERIENCE']) &&
        is_array($arResult['PROPERTIES']['HTML_EXPERIENCE']['VALUE']) &&
        $arResult['PROPERTIES']['HTML_EXPERIENCE']['VALUE']['TYPE'] == "text"
    ) {
        $expert_experience = nl2br($expert_experience);
    }

    if (
        is_array($arResult['PROPERTIES']['HTML_TEACHER']) &&
        is_array($arResult['PROPERTIES']['HTML_TEACHER']['VALUE']) &&
        $arResult['PROPERTIES']['HTML_TEACHER']['VALUE']['TYPE'] == "text"
    ) {
        $expert_teacher = nl2br($expert_teacher);
    }

    if (
        is_array($arResult['PROPERTIES']['HTML_EDU']) &&
        is_array($arResult['PROPERTIES']['HTML_EDU']['VALUE']) &&
        $arResult['PROPERTIES']['HTML_EDU']['VALUE']['TYPE'] == "text"
    ) {
        $expert_edu = nl2br($expert_edu);
    }

    if (
        is_array($arResult['PROPERTIES']['HTML_CERTIFIED']) &&
        is_array($arResult['PROPERTIES']['HTML_CERTIFIED']['VALUE']) &&
        $arResult['PROPERTIES']['HTML_CERTIFIED']['VALUE']['TYPE'] == "text"
    ) {
        $expert_certified = nl2br($expert_certified);
    }

    if (
        is_array($arResult['PROPERTIES']['HTML_PUBLICATIONS']) &&
        is_array($arResult['PROPERTIES']['HTML_PUBLICATIONS']['VALUE']) &&
        $arResult['PROPERTIES']['HTML_PUBLICATIONS']['VALUE']['TYPE'] == "text"
    ) {
        $expert_publications = nl2br($expert_publications);
    }

    if (
        is_array($arResult['PROPERTIES']['HTML_SOCIAL']) &&
        is_array($arResult['PROPERTIES']['HTML_SOCIAL']['VALUE']) &&
        $arResult['PROPERTIES']['HTML_SOCIAL']['VALUE']['TYPE'] == "text"
    ) {
        $expert_social = nl2br($expert_social);
    }

    if (is_array($arResult['PROPERTIES']['expert_featured'])) {
        $expert_featured = nl2br($arResult['PROPERTIES']['expert_featured']['VALUE']);
    }

    if (is_array($arResult['PROPERTIES']['expert_blog'])) {
        $expert_blog = nl2br($arResult['PROPERTIES']['expert_blog']['VALUE']);
    }
}

//iwrite($arResult['PROPERTIES']['expert_featured']);

 //HTML_AREA
 //HTML_SPECIAL
 //HTML_EXPERIENCE
 //HTML_TEACHER
 //HTML_EDU
 //HTML_CERTIFIED

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
<script type="text/javascript" src="/bitrix/templates/.default/en/js/jquery.tools.min.js"></script>
<div class="bg-main-wrap" style="background: url('/static/images/news-jpg.jpg') center 0; background-size: cover;">
		<div class="frame">
			<?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "bread", Array(
				"START_FROM" => "0",	// Номер пункта, начиная с которого будет построена навигационная цепочка
					"PATH" => "",	// Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
					"SITE_ID" => "s1",	// Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
				),
				false
			);?>


			<div class="clearfix heading-white">
				<div class="picture-wrap-trainer">
					<img src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" />
				</div>
				<div class="left-wrap-trainer">
					<h1><?=$arResult["NAME"]?> <?=$expert_name?></h1>
					<div class="expert-short"><?=$expert_short?></div>
				</div>

			</div>

		</div>
</div>
<?
if(CModule::IncludeModule("iblock"))
{
	$ID = &$_GET['ID'];
	//echo "$ID=$ID";
	if (isset($ID) and (is_numeric($ID)))  { } else { $ID = 5114;}
}
//phpinfo();
?>
<div class="not-main-page" id="middle-content">
<div class="frame overflow-hidden no-top-padding clearfix">
<div class="one-big-wrap course-main-info no-margin">
<div class="trainer-shadow-wrap course-main-info" itemscope itemtype="http://data-vocabulary.org/Person">

    <div style="display: none" class="trener-header">
	    <?if($arParams["DISPLAY_NAME"]!="N" && $arResult["NAME"]):?>
		    <h1><span itemprop="name"><?=$arResult["NAME"]?> <?=$expert_name?></span></h1>
	    <?endif;?>
	    <meta itemprop="affiliation" content="Luxoft-Training"/>
        <div class="position"><span itemprop="role"><?=$expert_short?></span></div>
    </div>


<div class="trainer-description-detail">
  <?=$arResult['DETAIL_TEXT']?>
</div>
<div>
  <?if (strlen($expert_area)>0) {?>
    <div class="main-knowledge"><h3>Ключевые области знаний:</h3><?=$expert_area?></div>
  <? } ?>
  <?/*if (strlen($expert_special)>0) {?>
    <div class="main-knowledge"><h3>Специализации:</h3><?=$expert_special?></div>
  <? } */?>
  <?/*if (strlen($expert_experience)>0) {?>
    <div class="main-knowledge"><h3>Профессиональный опыт:</h3><?=$expert_experience?></div>
  <? } */?>
  <?/*if (strlen($expert_teacher)>0) {?>
    <div class="main-knowledge"><h3>Преподавательский опыт:</h3><?=$expert_teacher?></div>
  <? } */?>
  <?/*if (strlen($expert_edu)>0) {?>
    <div class="main-knowledge"><h3>Образование:</h3><?=$expert_edu?></div>
  <? } */?>
  <?/*if (strlen($expert_certified)>0) {?>
    <div class="main-knowledge"><h3>Курсы, сертификаты:</h3><?=$expert_certified?></div>
  <? } */?>
  <?/*if (strlen($expert_publications)>0) {?>
    <div class="main-knowledge"><h3>Публикации:</h3><?=$expert_publications?></div>
  <? } */?>
  <?/*if (strlen($expert_social)>0) {?>
    <div class="main-knowledge"><h3>Социальная сфера:</h3><?=$expert_social?></div>
  <? }*/ ?>
  <?/*if (strlen($expert_language)>0) {?>
    <div class="main-knowledge"><h3>Англ. язык (уровень владения):</h3><?=$expert_language?></div>
  <? } */?>
</div>
	<?//print_r($arResult["CERT"])?>
	<?if (is_array($arResult["CERT"])) {?>
    <div class="cert-wrap">
        <h3>Сертификаты</h3>
        <div class="client-list">
            <a class="prev-client cert"></a>
            <a class="next-client cert"></a>
            <div class="client-slider cert">
                <div class="items">

						<?$t=0?>
						<?foreach ($arResult["CERT"] as $key=>$arCert) {?>

                        <div class="cert-item">
                            <a rel="cert" data-fancybox="gallery" class="fancy" href="<?=$arCert["DETAIL_PICTURE"]["SRC"]?>"><img data-bx-image="<?=$arCert["DETAIL_PICTURE"]["SRC"]?>" src="<?=$arCert["PREVIEW_PICTURE"]["SRC"]?>" title="<?=$arCert["NAME"]?>" border="0" alt="<?=$arCert["NAME"]?>"></a>
                        </div>
						<?$t++?>
						<?}?>

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

					<?foreach ($arResult["VIDEO"] as $key=>$arVideo) {?>

						<div class="cert-item">

                            <a data-fancybox="gallery" class="video-play" data-id="<?=$arVideo["ID"]?>" href="<?=$arVideo["LINK"]?>"><img src="<?=$arVideo["SRC"]?>"  title="<?=$arVideo["NAME"]?>" border="0" width="225" alt="<?=$arVideo["NAME"]?>"></a>
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
        $(function () {
            $(".client-slider.vid").scrollable({next: '.next-client.vid', prev: '.prev-client.vid', circular: false});
            $('.video-play').fancybox({'type': 'iframe', "allowfullscreen": "true", "width": 900, "height": 620});
        })
	</script>

	<?} ?>
	<?//print_r($arResult["NEWS"])?>
	<?if (is_array($arResult["NEWS"])) {?>
    <div class="news-trainer-wrap">
        <h3>Новости</h3>
		<?foreach ( $arResult["NEWS"] as $arNews) {?>
        <div class="news-trainer-item"><a href="<?=$arNews["DETAIL_PAGE_URL"]?>"><?=$arNews["NAME"]?></a></div>
		<?}?>
	</div>
    <?}?>
</div>
</div>
</div>
</div>
</div>

<?php if(count($arResult['courses'])) {?>
    <style>
        .course-detail__courses {
            background: #e9e9eb;
        }
        .course-detail__container {
            max-width: 1170px;
            padding-right: 0;
        }
        .course-others__header {
            margin-bottom: 0;
        }
    </style>
    <div id="courses" class="course-detail__courses">
        <div class="course-others course-detail__container">
            <div class="course-others__header">
                <div class="course-others__title">Курсы с экспертом</div>
            </div>
            <div class="course-others__main">
                <?foreach ($arResult['courses'] as $item) {?>
                    <div class="course-others__item">
                        <div class="course-others-item">
                            <div class="course-others-item__col">
                                <a href="<?=$item['link']?>" class="course-others-item__name"><?=$item['name']?></a>
                                <div class="course-others-item__description"><?=$item['description']?></div>
                                <?php if($item['schedule']) {?>
                                    <div class="course-others-item__schedule">
                                        <?php foreach($item['schedule'] as $scheduleItem) {?>
                                            <div class="course-others-item__schedule-item">
                                                <div class="course-others-item__schedule-item-city"><?=$scheduleItem['city']?>:</div>
                                                <div class="course-others-item__schedule-item-date"><?=($scheduleItem['date']['end']) ? $scheduleItem['date']['start'].' - '.$scheduleItem['date']['end'] : $scheduleItem['date']['start']?></div>
                                            </div>
                                        <?php }?>
                                    </div>
                                <?php }?>
                            </div>
                            <div class="course-others-item__col">
                                <a href="<?=$item['link']?>" class="course-others-item__code"><?=$item['code']?></a>
                                <div class="course-others-item__duration"><?=$item['duration']?> <?=Loc::getMessage('HOURS')?></div>
                                <a href="<?=$item['link']?>" class="course-detail__button course-detail__button_h-s course-detail__button_color-orange">
                                    <span><?=Loc::getMessage('BUTTON_SIGN_UP_SHORT')?></span>
                                </a>
                            </div>
                        </div>
                    </div>
                <?}?>
            </div>
            <div class="course-others__footer"></div>
        </div>
    </div>
<?php }?>